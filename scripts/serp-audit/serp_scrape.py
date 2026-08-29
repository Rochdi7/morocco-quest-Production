"""Step 1 - SERP collection for a query across the first N Google result pages.

Headed Chromium with a persistent profile so the consent cookie survives runs.
Writes out/serp_results.csv plus out/serp_features.json (PAA, related, local pack).
"""
from __future__ import annotations

import csv
import json
import re
import sys
from urllib.parse import quote_plus, urlparse, parse_qs

from playwright.sync_api import sync_playwright, TimeoutError as PWTimeout

from common import (
    CACHE, OUT, PROFILE, QUERY, GL, HL, PAGES, USER_AGENT,
    jitter, domain_of, is_google_internal, looks_blocked, write_cache,
)

LAUNCH_ARGS = [
    "--disable-blink-features=AutomationControlled",
    "--disable-features=IsolateOrigins,site-per-process",
    "--no-first-run",
    "--no-default-browser-check",
]

STEALTH_JS = """
Object.defineProperty(navigator, 'webdriver', {get: () => undefined});
Object.defineProperty(navigator, 'languages', {get: () => ['en-US','en','fr']});
Object.defineProperty(navigator, 'plugins', {get: () => [1,2,3,4,5]});
window.chrome = window.chrome || {runtime: {}};
"""


def serp_url(page_idx: int) -> str:
    start = page_idx * 10
    return (
        f"https://www.google.com/search?q={quote_plus(QUERY)}"
        f"&gl={GL}&hl={HL}&num=10&start={start}&pws=0"
    )


def dismiss_consent(page) -> None:
    """Click through Google's consent interstitial if it appears."""
    selectors = [
        "button:has-text('Accept all')",
        "button:has-text('Tout accepter')",
        "button:has-text('I agree')",
        "#L2AGLb",
        "form[action*='consent'] button",
    ]
    for sel in selectors:
        try:
            el = page.locator(sel).first
            if el.count() and el.is_visible(timeout=1500):
                el.click(timeout=3000)
                page.wait_for_timeout(1200)
                return
        except Exception:
            continue


def unwrap(href: str) -> str:
    """Resolve a SERP anchor href to a real destination URL.

    Google serves several link shapes:
      - a plain https:// URL (older / some locales)
      - /url?q=<url>            (legacy redirect)
      - /goto?url=<opaque>      (current; the payload is an encrypted token,
                                 NOT a decodable URL - callers must fall back
                                 to the <cite> breadcrumb or translate link)
    """
    if not href:
        return ""
    if href.startswith("/url?") or "/url?q=" in href:
        qs = parse_qs(urlparse(href).query)
        for key in ("q", "url"):
            if key in qs and qs[key]:
                val = qs[key][0]
                if val.startswith("http"):
                    return val
        return ""
    if href.startswith("/"):
        return ""          # /goto?url=... and friends - unresolvable from href
    return href if href.startswith("http") else ""


def clean_cite(text: str) -> str:
    """Turn a <cite> breadcrumb into a usable URL.

    Google renders these as 'https://example.com › path › leaf', often
    truncated with an ellipsis. The origin is always intact and exact, so we
    keep the origin and drop the (possibly lossy) breadcrumb tail.
    """
    if not text:
        return ""
    t = text.strip().split(" › ")[0].split("›")[0].strip()
    t = t.replace(" ", "")
    if not t:
        return ""
    if not t.startswith("http"):
        t = "https://" + t.lstrip("/")
    m = re.match(r"(https?://[^/?#\s]+)", t)
    return m.group(1) if m else ""


def extract_organic(page, page_no: int, rank_offset: int) -> list[dict]:
    """Pull organic results from the rendered SERP DOM."""
    js = """
    () => {
      const out = [];
      const seenTitle = new Set();
      const blocks = document.querySelectorAll(
        'div.g, div[data-hveid] div.yuRUbf, div.MjjYud, div.tF2Cxc');
      for (const b of blocks) {
        const h3 = b.querySelector('h3');
        if (!h3) continue;
        const a = b.querySelector('a[href]');
        if (!a) continue;

        const title = h3.innerText.trim();
        if (!title || seenTitle.has(title)) continue;
        seenTitle.add(title);

        // Current Google hides the destination behind /goto?url=<token>.
        // The <cite> breadcrumb and the "Translate this page" link both
        // still carry the real origin.
        const citeEl = b.querySelector('cite');
        const cite = citeEl ? citeEl.innerText.trim() : '';

        let translated = '';
        const tr = b.querySelector('a[href*="translate.google.com/translate?u="]');
        if (tr) {
          try {
            translated = decodeURIComponent(
              tr.getAttribute('href').split('u=')[1].split('&')[0]);
          } catch (e) { translated = ''; }
        }

        let snippet = '';
        const sn = b.querySelector(
          'div[data-sncf], div.VwiC3b, div.IsZvec, .lyLwlc, div[data-snf]');
        if (sn) snippet = sn.innerText.trim();

        out.push({
          href: a.getAttribute('href') || '',
          cite, translated, title, snippet,
        });
      }
      return out;
    }
    """
    try:
        raw = page.evaluate(js)
    except Exception as exc:
        print(f"  ! organic extract failed p{page_no}: {exc}")
        return []

    rows, rank = [], rank_offset
    for r in raw:
        # Preference order: real href > full translate URL > cite origin.
        url = unwrap(r.get("href", ""))
        if not url:
            t = r.get("translated", "")
            if t and t.startswith("http") and not is_google_internal(t):
                url = t
        if not url:
            url = clean_cite(r.get("cite", ""))
        if not url or is_google_internal(url):
            continue
        rank += 1
        rows.append({
            "rank": rank,
            "page": page_no,
            "url": url,
            "domain": domain_of(url),
            "serp_title": r.get("title", ""),
            "serp_snippet": (r.get("snippet") or "").replace("\n", " ").strip(),
        })
    return rows


def extract_features(page) -> dict:
    """Local pack, People Also Ask, people-also-search-for, related searches."""
    js = """
    () => {
      const txt = el => (el ? el.innerText.trim() : '');
      const uniq = a => [...new Set(a.filter(Boolean))];

      // People Also Ask
      const paa = uniq([...document.querySelectorAll(
        'div[jsname="yEVEwb"], div[data-q], [aria-level="3"][role="heading"]'
      )].map(e => e.getAttribute('data-q') || txt(e))
       .filter(t => t && t.length > 8 && t.includes('?')));

      // Related searches / people also search for
      const related = uniq([...document.querySelectorAll(
        'a[data-xbu], div.y6Uyxe b, div.s75CSd, div.AJLUJb div, a.k8XOCe'
      )].map(txt).filter(t => t && t.length > 2 && t.length < 90));

      // Local pack
      const local = [];
      const packRoot = document.querySelector('div[data-rc_ludocids], div.rllt__details, div[jscontroller][data-hveid] .VkpGBb');
      const cards = document.querySelectorAll('div.VkpGBb, div[jsname="jXK9ad"]');
      for (const c of cards) {
        const name = txt(c.querySelector('div.dbg0pd, div.OSrXXb, .qBF1Pd'));
        if (!name) continue;
        const meta = txt(c.querySelector('div.rllt__details'));
        local.push({name, meta});
      }
      return {paa, related, local};
    }
    """
    try:
        return page.evaluate(js)
    except Exception:
        return {"paa": [], "related": [], "local": []}


def expand_paa(page) -> None:
    """Click PAA accordions so nested questions render."""
    try:
        items = page.locator('div[jsname="Cpkphb"], div[jsname="N760b"]')
        for i in range(min(items.count(), 4)):
            try:
                items.nth(i).click(timeout=2000)
                page.wait_for_timeout(700)
            except Exception:
                continue
    except Exception:
        pass


def main() -> int:
    all_rows: list[dict] = []
    features = {"paa": [], "related": [], "local": []}
    blocked = False

    with sync_playwright() as p:
        ctx = p.chromium.launch_persistent_context(
            user_data_dir=str(PROFILE),
            headless=False,
            args=LAUNCH_ARGS,
            user_agent=USER_AGENT,
            viewport={"width": 1366, "height": 900},
            locale="en-US",
            timezone_id="Africa/Casablanca",
        )
        ctx.add_init_script(STEALTH_JS)
        page = ctx.pages[0] if ctx.pages else ctx.new_page()

        for i in range(PAGES):
            url = serp_url(i)
            print(f"[serp] page {i+1}/{PAGES} start={i*10}")
            try:
                page.goto(url, wait_until="domcontentloaded", timeout=45000)
            except PWTimeout:
                print("  ! navigation timeout, skipping page")
                continue
            except Exception as exc:
                print(f"  ! navigation failed: {exc}")
                continue

            if i == 0:
                dismiss_consent(page)

            try:
                page.wait_for_timeout(1500)
                html = page.content()
            except Exception:
                html = ""

            if looks_blocked(html):
                blocked = True
                dump = CACHE / f"BLOCKED-serp-p{i+1}.html"
                dump.write_text(html or "", encoding="utf-8", errors="replace")
                print(f"  !! CAPTCHA / block detected. Saved {dump}. Exiting cleanly.")
                break

            write_cache(url, html, ".html")
            expand_paa(page)

            rows = extract_organic(page, i + 1, len(all_rows))
            print(f"  + {len(rows)} organic results")
            all_rows.extend(rows)

            f = extract_features(page)
            features["paa"].extend(f.get("paa", []))
            features["related"].extend(f.get("related", []))
            if i == 0:
                features["local"] = f.get("local", [])

            if not rows and i > 0:
                print("  (no results on this page - end of SERP)")
                break

            if i < PAGES - 1:
                jitter()

        ctx.close()

    # Dedupe features
    for k in ("paa", "related"):
        seen, uniq = set(), []
        for t in features[k]:
            key = t.lower().strip()
            if key and key not in seen:
                seen.add(key)
                uniq.append(t.strip())
        features[k] = uniq

    # Full ranked SERP (all pages, before dedupe)
    serp_csv = OUT / "serp_results.csv"
    with serp_csv.open("w", newline="", encoding="utf-8-sig") as fh:
        w = csv.DictWriter(fh, fieldnames=[
            "rank", "page", "url", "domain", "serp_title", "serp_snippet"])
        w.writeheader()
        w.writerows(all_rows)

    # Dedupe by domain, keep highest-ranking URL
    best: dict[str, dict] = {}
    for r in all_rows:
        d = r["domain"]
        if d and (d not in best or r["rank"] < best[d]["rank"]):
            best[d] = r
    uniq_rows = sorted(best.values(), key=lambda r: r["rank"])

    uniq_csv = OUT / "serp_unique_domains.csv"
    with uniq_csv.open("w", newline="", encoding="utf-8-sig") as fh:
        w = csv.DictWriter(fh, fieldnames=[
            "rank", "page", "url", "domain", "serp_title", "serp_snippet"])
        w.writeheader()
        w.writerows(uniq_rows)

    (OUT / "serp_features.json").write_text(
        json.dumps(features, indent=2, ensure_ascii=False), encoding="utf-8")

    print(f"\n[done] {len(all_rows)} results | {len(uniq_rows)} unique domains")
    print(f"  PAA: {len(features['paa'])} | related: {len(features['related'])} "
          f"| local pack: {len(features['local'])}")
    print(f"  -> {serp_csv}\n  -> {uniq_csv}\n  -> {OUT/'serp_features.json'}")
    return 2 if blocked else 0


if __name__ == "__main__":
    sys.exit(main())
