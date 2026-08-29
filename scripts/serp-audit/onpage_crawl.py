"""Step 2 - On-page crawl of every unique competitor URL (+ your own page).

Respects robots.txt, 2s minimum delay, caches raw HTML in ./cache/ so
re-analysis never needs a re-scrape. Writes out/onpage_audit.csv.

Usage:
  python onpage_crawl.py --mine https://morocco-quest.com/dmc-marrakech
  python onpage_crawl.py --mine <url> --from-cache      # no network
"""
from __future__ import annotations

import argparse
import csv
import json
import re
import sys
import time
import urllib.robotparser as robotparser
from urllib.parse import urljoin, urlparse

from bs4 import BeautifulSoup
from playwright.sync_api import sync_playwright, TimeoutError as PWTimeout

from common import (
    OUT, PROFILE, USER_AGENT, CRAWL_MIN_DELAY,
    domain_of, read_cache, write_cache, cache_path,
)

SCHEMA_TYPES_OF_INTEREST = [
    "TravelAgency", "LocalBusiness", "Organization", "FAQPage",
    "BreadcrumbList", "AggregateRating", "Product", "Service",
    "WebSite", "WebPage", "Event", "Review", "TouristAttraction",
]

# Phone: an international +NNN prefix or a leading 0 (national format).
# Bare digit runs such as "ISO 9001 2015" are rejected.
PHONE_RE = re.compile(r"(\+\d[\d\s().\-]{7,}\d|\b0\d[\d\s().\-]{7,}\d)")
TEL_HREF_RE = re.compile(r"""href=["']tel:([^"']+)""", re.I)
WHATSAPP_RE = re.compile(r"(wa\.me/|api\.whatsapp\.com|whatsapp://|web\.whatsapp)", re.I)
LICENSE_RE = re.compile(
    r"\b(?:ODV|O\.D\.V|licen[cs]e|autorisation|agr[ée]ment|RC\s*n|IF\s*n|ICE)\s*[:°n]?\s*[\w\-/]{2,}",
    re.I)
ADDRESS_RE = re.compile(
    r"\b(?:rue|avenue|av\.|bd\.?|boulevard|quartier|residence|résidence|imm\.|"
    r"street|road|marrakech|casablanca|gueliz|guéliz|hivernage|menara)\b[^\n]{0,60}",
    re.I)

_robots_cache: dict[str, robotparser.RobotFileParser | None] = {}


def robots_allows(url: str) -> bool:
    """True if robots.txt permits our UA. Fails open on fetch error."""
    parsed = urlparse(url)
    root = f"{parsed.scheme}://{parsed.netloc}"
    if root not in _robots_cache:
        rp = robotparser.RobotFileParser()
        rp.set_url(urljoin(root, "/robots.txt"))
        try:
            rp.read()
        except Exception:
            rp = None                      # unreachable robots.txt -> allow
        _robots_cache[root] = rp
    rp = _robots_cache[root]
    if rp is None:
        return True
    try:
        return rp.can_fetch(USER_AGENT, url)
    except Exception:
        return True


def collect_schema(soup: BeautifulSoup) -> tuple[list[str], str]:
    """Return (schema types found, raw JSON-LD joined)."""
    found, raws = [], []

    def walk(node):
        if isinstance(node, dict):
            t = node.get("@type")
            if isinstance(t, str):
                found.append(t)
            elif isinstance(t, list):
                found.extend([x for x in t if isinstance(x, str)])
            for v in node.values():
                walk(v)
        elif isinstance(node, list):
            for v in node:
                walk(v)

    for tag in soup.find_all("script", type=lambda v: v and "ld+json" in v.lower()):
        raw = tag.string or tag.get_text() or ""
        raws.append(raw.strip()[:2000])
        try:
            walk(json.loads(raw))
        except Exception:
            # Salvage @type from malformed JSON-LD
            found.extend(re.findall(r'"@type"\s*:\s*"([A-Za-z]+)"', raw))

    # Microdata fallback
    for el in soup.select("[itemtype]"):
        it = el.get("itemtype", "")
        if "schema.org/" in it:
            found.append(it.rsplit("/", 1)[-1])

    seen, uniq = set(), []
    for t in found:
        if t not in seen:
            seen.add(t)
            uniq.append(t)
    return uniq, " || ".join(raws)


def body_word_count(soup: BeautifulSoup) -> int:
    clone = BeautifulSoup(str(soup), "lxml")
    for bad in clone(["script", "style", "noscript", "nav", "footer", "header", "svg"]):
        bad.decompose()
    main = clone.find("main") or clone.find("article") or clone.body or clone
    return len(re.findall(r"\b[\w’'-]+\b", main.get_text(" ", strip=True)))


def detect_languages(soup: BeautifulSoup, html: str, base_domain: str) -> str:
    langs = set()
    hl = (soup.html.get("lang") if soup.html else "") or ""
    if hl:
        langs.add(hl.split("-")[0].lower())
    for link in soup.find_all("link", rel=lambda v: v and "alternate" in str(v).lower()):
        hlang = link.get("hreflang")
        if hlang:
            langs.add(hlang.split("-")[0].lower())
    # Language switcher links (/fr/, /en/, ?lang=es ...)
    for a in soup.find_all("a", href=True):
        m = re.search(r"/(fr|en|es|ar|de|it)(/|$)|[?&]lang=(fr|en|es|ar|de|it)\b",
                      a["href"], re.I)
        if m:
            langs.add((m.group(1) or m.group(3)).lower())
    langs.discard("x")
    return ",".join(sorted(langs))


def audit_html(url: str, html: str, load_ms: int, status: int,
               https_ok: str, is_mine: bool) -> dict:
    soup = BeautifulSoup(html, "lxml")
    base_domain = domain_of(url)

    title = (soup.title.get_text(strip=True) if soup.title else "")
    md_tag = soup.find("meta", attrs={"name": re.compile("^description$", re.I)})
    meta_desc = (md_tag.get("content") or "").strip() if md_tag else ""

    def heads(level):
        return [h.get_text(" ", strip=True) for h in soup.find_all(level)]

    h1s, h2s, h3s = heads("h1"), heads("h2"), heads("h3")

    canon_tag = soup.find("link", rel=lambda v: v and "canonical" in str(v).lower())
    canonical = canon_tag.get("href", "") if canon_tag else ""

    hreflangs = [
        f"{l.get('hreflang')}>{l.get('href')}"
        for l in soup.find_all("link", rel=lambda v: v and "alternate" in str(v).lower())
        if l.get("hreflang")
    ]

    og = {m.get("property"): m.get("content", "")
          for m in soup.find_all("meta", property=re.compile(r"^og:", re.I))}
    tw = {m.get("name"): m.get("content", "")
          for m in soup.find_all("meta", attrs={"name": re.compile(r"^twitter:", re.I)})}

    schema_types, schema_raw = collect_schema(soup)
    interesting = [t for t in schema_types if t in SCHEMA_TYPES_OF_INTEREST]

    internal = external = 0
    for a in soup.find_all("a", href=True):
        href = a["href"].strip()
        if href.startswith(("#", "mailto:", "tel:", "javascript:")):
            continue
        d = domain_of(urljoin(url, href))
        if not d or d == base_domain:
            internal += 1
        else:
            external += 1

    imgs = soup.find_all("img")
    with_alt = sum(1 for i in imgs if (i.get("alt") or "").strip())

    text = soup.get_text(" ", strip=True)
    phone_m = PHONE_RE.search(text) or TEL_HREF_RE.search(html)
    has_form = bool(soup.find("form") and soup.find(["input", "textarea"]))
    wa_m = WHATSAPP_RE.search(html)
    lic_m = LICENSE_RE.search(text)
    addr_m = ADDRESS_RE.search(text)

    # Naive CWV signals from the served HTML
    render_blocking = len(soup.find_all("script", src=True)) + len(
        soup.find_all("link", rel="stylesheet"))
    lazy_imgs = sum(1 for i in imgs if (i.get("loading") or "").lower() == "lazy")
    dim_imgs = sum(1 for i in imgs if i.get("width") and i.get("height"))

    return {
        "url": url,
        "is_mine": "YES" if is_mine else "",
        "domain": base_domain,
        "http_status": status,
        "https_redirect_ok": https_ok,
        "load_ms": load_ms,
        "title": title,
        "title_len": len(title),
        "meta_description": meta_desc,
        "meta_desc_len": len(meta_desc),
        "h1_count": len(h1s),
        "h1": " | ".join(h1s),
        "h2": " | ".join(h2s),
        "h3": " | ".join(h3s[:25]),
        "canonical": canonical,
        "hreflang": " ; ".join(hreflangs),
        "languages_detected": detect_languages(soup, html, base_domain),
        "is_multilingual": "YES" if len(
            [l for l in detect_languages(soup, html, base_domain).split(",") if l]) > 1 else "",
        "og_tags": " ; ".join(f"{k}={v[:70]}" for k, v in og.items()),
        "twitter_tags": " ; ".join(f"{k}={v[:70]}" for k, v in tw.items()),
        "schema_types_all": ",".join(schema_types),
        "schema_types_key": ",".join(interesting),
        "has_TravelAgency": "YES" if "TravelAgency" in schema_types else "",
        "has_LocalBusiness": "YES" if "LocalBusiness" in schema_types else "",
        "has_Organization": "YES" if "Organization" in schema_types else "",
        "has_FAQPage": "YES" if "FAQPage" in schema_types else "",
        "has_BreadcrumbList": "YES" if "BreadcrumbList" in schema_types else "",
        "has_AggregateRating": "YES" if "AggregateRating" in schema_types else "",
        "word_count": body_word_count(soup),
        "internal_links": internal,
        "external_links": external,
        "img_count": len(imgs),
        "img_with_alt": with_alt,
        "img_alt_pct": round(100 * with_alt / len(imgs)) if imgs else 0,
        "has_phone": phone_m.group(1).strip()[:30] if phone_m else "",
        "has_address": addr_m.group(0).strip()[:60] if addr_m else "",
        "has_contact_form": "YES" if has_form else "",
        "has_whatsapp": "YES" if wa_m else "",
        "license_number": lic_m.group(0).strip()[:60] if lic_m else "",
        "script_and_css_refs": render_blocking,
        "imgs_lazy": lazy_imgs,
        "imgs_with_dimensions": dim_imgs,
        "schema_raw_excerpt": schema_raw[:600],
        "error": "",
    }


def blank_row(url: str, err: str) -> dict:
    row = {k: "" for k in FIELDS}
    row["url"] = url
    row["domain"] = domain_of(url)
    row["error"] = err
    return row


FIELDS = [
    "url", "is_mine", "domain", "http_status", "https_redirect_ok", "load_ms",
    "title", "title_len", "meta_description", "meta_desc_len",
    "h1_count", "h1", "h2", "h3", "canonical", "hreflang",
    "languages_detected", "is_multilingual", "og_tags", "twitter_tags",
    "schema_types_all", "schema_types_key",
    "has_TravelAgency", "has_LocalBusiness", "has_Organization",
    "has_FAQPage", "has_BreadcrumbList", "has_AggregateRating",
    "word_count", "internal_links", "external_links",
    "img_count", "img_with_alt", "img_alt_pct",
    "has_phone", "has_address", "has_contact_form", "has_whatsapp",
    "license_number", "script_and_css_refs", "imgs_lazy",
    "imgs_with_dimensions", "schema_raw_excerpt", "error",
]


def load_targets(mine: str | None, limit: int) -> list[tuple[str, bool]]:
    src = OUT / "serp_unique_domains.csv"
    targets: list[tuple[str, bool]] = []
    if src.exists():
        with src.open(encoding="utf-8-sig") as fh:
            for r in csv.DictReader(fh):
                targets.append((r["url"], False))
                if len(targets) >= limit:
                    break
    else:
        print(f"! {src} not found - run serp_scrape.py first.")
    if mine:
        targets.insert(0, (mine, True))
    return targets


def main() -> int:
    ap = argparse.ArgumentParser()
    ap.add_argument("--mine", help="Your own page URL to audit alongside competitors")
    ap.add_argument("--limit", type=int, default=40, help="Max competitor URLs")
    ap.add_argument("--from-cache", action="store_true",
                    help="Re-analyse cached HTML only, no network")
    args = ap.parse_args()

    targets = load_targets(args.mine, args.limit)
    if not targets:
        return 1
    print(f"[crawl] {len(targets)} target(s)")

    rows: list[dict] = []
    pw = ctx = page = None
    if not args.from_cache:
        pw = sync_playwright().start()
        ctx = pw.chromium.launch_persistent_context(
            user_data_dir=str(PROFILE / "crawl"),
            headless=False,
            args=["--disable-blink-features=AutomationControlled"],
            user_agent=USER_AGENT,
            viewport={"width": 1366, "height": 900},
            locale="en-US",
        )
        page = ctx.pages[0] if ctx.pages else ctx.new_page()

    try:
        for i, (url, is_mine) in enumerate(targets, 1):
            tag = " (MINE)" if is_mine else ""
            print(f"[{i}/{len(targets)}] {url}{tag}")
            try:
                cached = read_cache(url)
                status, load_ms, https_ok = 0, 0, ""

                if cached and (args.from_cache or True):
                    html = cached
                    print("    (cache hit)")
                elif args.from_cache:
                    rows.append(blank_row(url, "no cache"))
                    continue
                else:
                    html = None

                if html is None:
                    if not robots_allows(url):
                        print("    robots.txt disallows - skipped")
                        rows.append(blank_row(url, "robots.txt disallow"))
                        continue
                    t0 = time.time()
                    resp = page.goto(url, wait_until="domcontentloaded", timeout=40000)
                    page.wait_for_timeout(1200)
                    load_ms = int((time.time() - t0) * 1000)
                    status = resp.status if resp else 0
                    final = page.url
                    https_ok = "YES" if final.startswith("https://") else "NO"
                    html = page.content()
                    write_cache(url, html)
                    time.sleep(CRAWL_MIN_DELAY)

                rows.append(audit_html(url, html, load_ms, status, https_ok, is_mine))

            except PWTimeout:
                print("    ! timeout")
                rows.append(blank_row(url, "timeout"))
            except Exception as exc:
                print(f"    ! {type(exc).__name__}: {exc}")
                rows.append(blank_row(url, f"{type(exc).__name__}: {exc}"[:200]))
    finally:
        if ctx:
            try:
                ctx.close()
            except Exception:
                pass
        if pw:
            pw.stop()

    dest = OUT / "onpage_audit.csv"
    with dest.open("w", newline="", encoding="utf-8-sig") as fh:
        w = csv.DictWriter(fh, fieldnames=FIELDS, extrasaction="ignore")
        w.writeheader()
        w.writerows(rows)

    ok = sum(1 for r in rows if not r["error"])
    print(f"\n[done] {ok}/{len(rows)} audited -> {dest}")
    return 0


if __name__ == "__main__":
    sys.exit(main())
