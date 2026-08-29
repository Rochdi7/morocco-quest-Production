"""Steps 3 & 4 - n-gram keyword extraction and gap analysis.

Reads out/onpage_audit.csv, out/serp_results.csv, out/serp_features.json.
Writes out/keyword_frequency.csv and out/gap_report.md.

Usage: python analyze.py [--top 10]
"""
from __future__ import annotations

import argparse
import csv
import json
import re
import statistics
import sys
from collections import Counter, defaultdict

from common import OUT

EN_STOP = set("""
a an the and or but if then than that this these those of in on at to for from by with
without within into onto over under about across after before during is are was were be
been being do does did doing have has had having can could should would will shall may
might must not no nor so such as it its you your yours we our ours they them their
he she his her me my more most other some any all each both few own same too very just
there here one two three via per up out off down again now
""".split())

FR_STOP = set("""
le la les un une des du au aux et ou mais donc car que qui quoi dont
ce cet cette ces son sa ses leur leurs notre nos votre vos mon ma mes ton ta tes
pour par avec sans sous sur dans chez vers entre pendant depuis avant apres après
est sont etait était etre être ete été avoir ont avait fait faire plus moins tres très
tout tous toute toutes autre autres meme même aussi bien elle ils elles nous vous
sur cela ceci celui celle comme quand ainsi deja déjà jamais
""".split())

STOP = EN_STOP | FR_STOP

# FR-only spellings - presence is decisive evidence of French.
# Deliberately excludes words identical in EN (destination, management, transfer...).
FR_STRONG = set("""
sejour séjour receptif réceptif evenementiel événementiel seminaire séminaire
congres congrès reunion réunion maroc marocain marocaine hebergement hébergement
decouverte découverte prestataire agence voyage voyages entreprise organisation
evenement événement desert désert nos notre votre vos mesure
""".split())

TOKEN_RE = re.compile(r"[a-zàâäéèêëîïôöùûüçœ0-9][a-zàâäéèêëîïôöùûüçœ0-9'’-]*", re.I)


def tokenize(text: str) -> list[str]:
    return [t.lower() for t in TOKEN_RE.findall(text or "")]


def ngrams(tokens: list[str], n: int) -> list[str]:
    """n-grams with light stopword filtering.

    Keeps grams like "best dmc" and "dmc in marrakech" - only drops grams that
    are entirely stopwords, or that both start and end on one.
    """
    out = []
    for i in range(len(tokens) - n + 1):
        gram = tokens[i:i + n]
        if n == 1:
            w = gram[0]
            if w in STOP or len(w) < 3 or w.isdigit():
                continue
            out.append(w)
            continue
        if all(t in STOP for t in gram):
            continue
        if gram[0] in STOP and gram[-1] in STOP:
            continue
        if all(len(t) < 3 for t in gram):
            continue
        out.append(" ".join(gram))
    return out


def guess_lang(gram: str) -> str:
    words = set(gram.split())
    if any(re.search(r"[àâäéèêëîïôöùûüçœ]", w) for w in words):
        return "FR"
    if words & FR_STRONG:
        return "FR"
    if (words & FR_STOP) and not (words & EN_STOP):
        return "FR"
    return "EN"


def read_csv(path):
    if not path.exists():
        print(f"! missing {path}")
        return []
    with path.open(encoding="utf-8-sig") as fh:
        return list(csv.DictReader(fh))


def build_keywords(rows: list[dict], top_n: int) -> list[dict]:
    """Frequency + distinct-domain counts for 1/2/3-grams."""
    counts: Counter = Counter()
    domains: defaultdict[str, set] = defaultdict(set)
    in_title: defaultdict[str, set] = defaultdict(set)
    top_domains: defaultdict[str, set] = defaultdict(set)

    for idx, r in enumerate(rows):
        if r.get("error") or r.get("is_mine"):
            continue
        dom = r.get("domain", "")
        is_top = idx <= top_n
        title_tokens = tokenize(r.get("title", ""))
        body_text = " ".join([
            r.get("title", ""), r.get("meta_description", ""),
            r.get("h1", ""), r.get("h2", ""), r.get("h3", ""),
        ])
        body_tokens = tokenize(body_text)

        title_grams = set()
        for n in (1, 2, 3):
            title_grams |= set(ngrams(title_tokens, n))

        seen_here = set()
        for n in (1, 2, 3):
            for g in ngrams(body_tokens, n):
                counts[g] += 1
                if g not in seen_here:
                    seen_here.add(g)
                    domains[g].add(dom)
                    if is_top:
                        top_domains[g].add(dom)
                if g in title_grams:
                    in_title[g].add(dom)

    out = []
    for gram, cnt in counts.items():
        dcount = len(domains[gram])
        if dcount < 2 and cnt < 4:
            continue
        out.append({
            "ngram": gram,
            "n": len(gram.split()),
            "count": cnt,
            "distinct_domains": dcount,
            "top10_domains": len(top_domains[gram]),
            "in_title_domains": len(in_title[gram]),
            "placement": "TITLE+BODY" if in_title[gram] else "BODY_ONLY",
            "language": guess_lang(gram),
        })
    out.sort(key=lambda r: (-r["distinct_domains"], -r["count"]))
    return out


def median(vals):
    vals = [v for v in vals if v]
    return int(statistics.median(vals)) if vals else 0


THEMES = {
    "MICE / conferences": r"\bmice\b|congress|convention|conference|congr[èe]s|s[ée]minaire",
    "Incentive travel": r"incentive",
    "Team building": r"team ?building|teambuilding",
    "Transfers / transport": r"transfer|transport|navette|shuttle|chauffeur",
    "Licensed guides": r"guide|licensed|agr[ée]{1,2}|licen[cs]e",
    "FAQ section": r"\bfaq\b|frequently asked|questions fr[ée]quentes",
    "Venues / hotels": r"venue|hotel|riad|palais|lieu",
    "Gala / events production": r"gala|production|staging|sc[ée]nograph|lighting",
    "Excursions / day tours": r"excursion|day trip|circuit|tour\b",
    "Desert / Agafay / Sahara": r"agafay|sahara|desert|d[ée]sert|merzouga",
    "Sustainability / CSR": r"sustainab|csr|rse|responsib|durable",
    "Testimonials / references": r"testimonial|t[ée]moignage|client|reference|r[ée]f[ée]rence",
    "Blog / guides": r"\bblog\b|guide to|how to choose|comment choisir",
    "Contact / quote form": r"quote|devis|proposal|request|contact",
}


def main() -> int:
    ap = argparse.ArgumentParser()
    ap.add_argument("--top", type=int, default=10, help="Size of the 'top N' cohort")
    args = ap.parse_args()

    audit = read_csv(OUT / "onpage_audit.csv")
    serp = read_csv(OUT / "serp_results.csv")
    feat_path = OUT / "serp_features.json"
    features = json.loads(feat_path.read_text(encoding="utf-8")) if feat_path.exists() \
        else {"paa": [], "related": [], "local": []}

    if not audit:
        print("! run onpage_crawl.py first")
        return 1

    mine = next((r for r in audit if r.get("is_mine")), None)
    comps = [r for r in audit if not r.get("is_mine") and not r.get("error")]
    top = comps[:args.top]

    kws = build_keywords(audit, args.top)
    kw_path = OUT / "keyword_frequency.csv"
    with kw_path.open("w", newline="", encoding="utf-8-sig") as fh:
        w = csv.DictWriter(fh, fieldnames=[
            "ngram", "n", "count", "distinct_domains", "top10_domains",
            "in_title_domains", "placement", "language"])
        w.writeheader()
        w.writerows(kws)
    print(f"[kw] {len(kws)} n-grams -> {kw_path}")

    my_title_grams = set()
    if mine:
        t = tokenize(mine.get("title", ""))
        for n in (1, 2, 3):
            my_title_grams |= set(ngrams(t, n))

    title_gaps = [k for k in kws
                  if k["in_title_domains"] >= 5 and k["ngram"] not in my_title_grams]
    title_gaps.sort(key=lambda k: -k["in_title_domains"])

    schema_keys = ["TravelAgency", "LocalBusiness", "Organization",
                   "FAQPage", "BreadcrumbList", "AggregateRating"]
    schema_tbl = []
    for s in schema_keys:
        col = f"has_{s}"
        n = sum(1 for r in top if r.get(col) == "YES")
        schema_tbl.append({
            "type": s, "competitors_with": n, "of": len(top),
            "mine": "YES" if mine and mine.get(col) == "YES" else "NO",
        })

    def gi(r, k):
        try:
            return int(r.get(k) or 0)
        except (ValueError, TypeError):
            return 0

    med_wc = median([gi(r, "word_count") for r in top])
    my_wc = gi(mine, "word_count") if mine else 0

    lang_counter = Counter()
    for r in top:
        langs = [l for l in (r.get("languages_detected") or "").split(",") if l]
        if not langs:
            lang_counter["unknown"] += 1
        elif len(langs) > 1:
            lang_counter["multilingual"] += 1
        else:
            lang_counter[langs[0]] += 1

    exact_h1 = sum(1 for r in top
                   if re.search(r"\bdmc\b.{0,15}\bmarrakech\b", r.get("h1", ""), re.I))
    dmc_h1 = sum(1 for r in top if re.search(r"\bdmc\b", r.get("h1", ""), re.I))

    def pct(n, d):
        return f"{round(100*n/d)}%" if d else "n/a"

    theme_rows = []
    for name, pat in THEMES.items():
        rx = re.compile(pat, re.I)
        n = sum(1 for r in top
                if rx.search(" ".join([r.get("h1", ""), r.get("h2", ""),
                                       r.get("h3", ""), r.get("title", "")])))
        mine_has = bool(mine and rx.search(" ".join([
            mine.get("h1", ""), mine.get("h2", ""),
            mine.get("h3", ""), mine.get("title", "")])))
        theme_rows.append((name, n, len(top), mine_has))
    theme_rows.sort(key=lambda t: -t[1])

    L: list[str] = []
    A = L.append
    A('# Gap Report — "dmc marrakech"\n')
    pages = len({r["page"] for r in serp}) if serp else 0
    A(f"Cohort: top {len(top)} unique competitor domains "
      f"(from {len(serp)} SERP rows across {pages} pages).\n")
    if mine:
        A(f"Your page: `{mine['url']}`\n")
    else:
        A("> No `--mine` page supplied — comparison columns are competitor-only.\n")

    A("\n## 1. Head-to-head comparison\n")
    A("| Field | Mine | Competitor median / spread |")
    A("|---|---|---|")

    def row(label, mine_val, comp_vals):
        nums = [v for v in comp_vals if isinstance(v, int)]
        comp = (f"median {median(nums)} (min {min(nums)} / max {max(nums)})"
                if nums else "n/a")
        A(f"| {label} | {mine_val} | {comp} |")

    if mine:
        row("Title length", gi(mine, "title_len"), [gi(r, "title_len") for r in top])
        row("Meta description length", gi(mine, "meta_desc_len"),
            [gi(r, "meta_desc_len") for r in top])
        row("H1 count", gi(mine, "h1_count"), [gi(r, "h1_count") for r in top])
        row("Word count", my_wc, [gi(r, "word_count") for r in top])
        row("Internal links", gi(mine, "internal_links"),
            [gi(r, "internal_links") for r in top])
        row("External links", gi(mine, "external_links"),
            [gi(r, "external_links") for r in top])
        row("Images", gi(mine, "img_count"), [gi(r, "img_count") for r in top])
        row("Image alt coverage %", gi(mine, "img_alt_pct"),
            [gi(r, "img_alt_pct") for r in top])
        for label, key in [("Contact form", "has_contact_form"),
                           ("WhatsApp link", "has_whatsapp"),
                           ("Phone visible", "has_phone"),
                           ("Address visible", "has_address"),
                           ("Licence / ODV number", "license_number"),
                           ("Multilingual", "is_multilingual"),
                           ("Canonical tag", "canonical"),
                           ("hreflang tags", "hreflang")]:
            A(f"| {label} | {'YES' if mine.get(key) else 'NO'} | "
              f"{sum(1 for r in top if r.get(key))}/{len(top)} have it |")

    A("\n### Per-competitor detail\n")
    A("| # | Domain | Title len | Words | Schema (key) | Langs | Form | WA |")
    A("|---|---|---|---|---|---|---|---|")
    if mine:
        A(f"| — | **{mine['domain']} (MINE)** | {mine.get('title_len','')} | "
          f"{mine.get('word_count','')} | {mine.get('schema_types_key','') or '—'} | "
          f"{mine.get('languages_detected','') or '—'} | "
          f"{'Y' if mine.get('has_contact_form') else 'N'} | "
          f"{'Y' if mine.get('has_whatsapp') else 'N'} |")
    for i, r in enumerate(top, 1):
        A(f"| {i} | {r['domain']} | {r.get('title_len','')} | {r.get('word_count','')} | "
          f"{r.get('schema_types_key','') or '—'} | "
          f"{r.get('languages_detected','') or '—'} | "
          f"{'Y' if r.get('has_contact_form') else 'N'} | "
          f"{'Y' if r.get('has_whatsapp') else 'N'} |")

    A("\n## 2. Title-tag keywords held by 5+ top competitors that your title lacks\n")
    if not mine:
        A("_Supply `--mine <url>` to compute this._\n")
    elif not title_gaps:
        A("None — your title already covers every term used by 5+ competitors.\n")
    else:
        A("| n-gram | Competitor titles using it | Lang |")
        A("|---|---|---|")
        for k in title_gaps[:25]:
            A(f"| `{k['ngram']}` | {k['in_title_domains']} | {k['language']} |")

    A("\n## 3. Schema types\n")
    A("| Type | Competitors with it | Mine |")
    A("|---|---|---|")
    for s in schema_tbl:
        flag = "" if s["mine"] == "YES" or s["competitors_with"] == 0 else "  ← **GAP**"
        A(f"| {s['type']} | {s['competitors_with']}/{s['of']} | {s['mine']}{flag} |")

    A("\n## 4. Word count\n")
    A(f"- Median page-1 competitor: **{med_wc} words**")
    A(f"- Yours: **{my_wc} words**" if mine else "- Yours: n/a")
    if mine and med_wc:
        delta = my_wc - med_wc
        A(f"- Delta: **{delta:+d}** ({'above' if delta > 0 else 'below'} the median)")

    A("\n## 5. Language of page-1 results\n")
    A("| Language profile | Domains |")
    A("|---|---|")
    for lang, n in lang_counter.most_common():
        A(f"| {lang} | {n} |")
    dom_lang = lang_counter.most_common(1)[0][0] if lang_counter else "n/a"
    A(f"\n**Dominant profile on page 1: `{dom_lang}`.**\n")

    A("\n## 6. Does the H1 target the exact phrase?\n")
    A(f"- H1 contains \"DMC … Marrakech\": **{exact_h1}/{len(top)}** ({pct(exact_h1, len(top))})")
    A(f"- H1 contains \"DMC\" at all: **{dmc_h1}/{len(top)}** ({pct(dmc_h1, len(top))})")
    if mine:
        A(f"- Your H1: `{mine.get('h1','')[:160]}`")

    A("\n## 7. Content sections competitors cover\n")
    A("| Theme | Competitors covering | You |")
    A("|---|---|---|")
    for name, n, tot, has in theme_rows:
        flag = "" if has or n < 3 else "  ← **GAP**"
        A(f"| {name} | {n}/{tot} | {'YES' if has else 'NO'}{flag} |")

    A("\n## 8. Local Pack\n")
    local = features.get("local", [])
    if local:
        A("| Business | Category / rating / reviews (as shown) |")
        A("|---|---|")
        for b in local[:12]:
            meta = (b.get("meta", "") or "").replace("\n", " ")[:110]
            A(f"| {b.get('name','')} | {meta} |")
    else:
        A("_No Local Pack captured (absent for this query, or rendered in a "
          "layout the scraper did not match)._\n")

    A("\n## 9. PAA and related searches (keyword goldmine)\n")
    paa = features.get("paa", [])
    rel = features.get("related", [])
    A(f"**People Also Ask ({len(paa)}):**\n")
    for q in paa[:30]:
        A(f"- {q}")
    A(f"\n**Related / people also search for ({len(rel)}):**\n")
    for t in rel[:40]:
        A(f"- {t}")

    A("\n## 10. Top shared vocabulary (by distinct domains)\n")
    A("| n-gram | Domains | Count | Placement | Lang |")
    A("|---|---|---|---|---|")
    for k in kws[:40]:
        A(f"| `{k['ngram']}` | {k['distinct_domains']} | {k['count']} | "
          f"{k['placement']} | {k['language']} |")

    A("\n---\n")
    A("## 11. Rewrite inputs\n")
    A("> Signal for the human rewrite. Title/description/H1 options are written "
      "by hand from these patterns — never lifted from competitor copy.\n")
    en_title_terms = [k["ngram"] for k in kws
                      if k["in_title_domains"] >= 3 and k["language"] == "EN"][:10]
    fr_title_terms = [k["ngram"] for k in kws
                      if k["in_title_domains"] >= 2 and k["language"] == "FR"][:10]
    A(f"- Highest-signal EN title terms: {', '.join(f'`{t}`' for t in en_title_terms) or '—'}")
    A(f"- Highest-signal FR title terms: {', '.join(f'`{t}`' for t in fr_title_terms) or '—'}")
    A(f"- Title length to aim for: 55–60 chars (competitor median "
      f"{median([gi(r,'title_len') for r in top])})")
    A(f"- Meta description: 150–158 chars (competitor median "
      f"{median([gi(r,'meta_desc_len') for r in top])})")
    A("\n### Structural pattern of the top 5 (H1 → H2 order)\n")
    for r in top[:5]:
        A(f"\n**{r['domain']}**")
        A(f"- H1: {r.get('h1','')[:120] or '—'}")
        for h in [h for h in (r.get("h2", "") or "").split(" | ") if h][:8]:
            A(f"  - H2: {h[:110]}")

    A("\n## 12. Prioritised actions\n")
    A("### Quick wins")
    quick = []
    if mine:
        if not (55 <= gi(mine, "title_len") <= 60):
            quick.append(f"Title is {gi(mine,'title_len')} chars — retarget 55–60.")
        if not (150 <= gi(mine, "meta_desc_len") <= 158):
            quick.append(f"Meta description is {gi(mine,'meta_desc_len')} chars — retarget 150–158.")
        if gi(mine, "img_alt_pct") < 90:
            quick.append(f"Image alt coverage {gi(mine,'img_alt_pct')}% — bring to 100%.")
        if gi(mine, "h1_count") != 1:
            quick.append(f"{gi(mine,'h1_count')} H1s — should be exactly 1.")
        for s in schema_tbl:
            if s["mine"] == "NO" and s["competitors_with"] >= 3:
                quick.append(f"Add {s['type']} schema ({s['competitors_with']} competitors have it).")
        if not mine.get("has_whatsapp") and sum(1 for r in top if r.get("has_whatsapp")) >= 3:
            quick.append("Add a WhatsApp contact link — common on page 1.")
        for k in title_gaps[:5]:
            quick.append(f"Consider `{k['ngram']}` in the title ({k['in_title_domains']} competitors use it).")
    for q in quick or ["(none detected)"]:
        A(f"- {q}")

    A("\n### Structural work")
    struct = []
    if mine and med_wc and my_wc < med_wc * 0.85:
        struct.append(f"Expand body copy toward the page-1 median ({med_wc} words).")
    for name, n, tot, has in theme_rows:
        if not has and n >= max(3, tot // 2):
            struct.append(f"Add a section covering **{name}** — {n}/{tot} competitors have it.")
    if lang_counter.get("multilingual", 0) >= 3 and mine and not mine.get("is_multilingual"):
        struct.append("Add FR/EN variants with hreflang — multilingual pages dominate page 1.")
    for s in struct or ["(none detected)"]:
        A(f"- {s}")

    dest = OUT / "gap_report.md"
    dest.write_text("\n".join(L), encoding="utf-8")
    print(f"[gap] -> {dest}")
    print(f"[gap] title gaps: {len(title_gaps)} | median comp words: {med_wc} | mine: {my_wc}")
    return 0


if __name__ == "__main__":
    sys.exit(main())
