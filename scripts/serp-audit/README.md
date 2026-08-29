# SERP Competitive Analysis — "dmc marrakech"

Playwright-based SERP scraper, on-page competitor crawler, n-gram keyword
extractor and gap-report generator.

## Install

```bash
pip install playwright beautifulsoup4 lxml
python -m playwright install chromium
```

## Run

```bash
cd scripts/serp-audit
python run_all.py --mine https://morocco-quest.com/dmc-marrakech
```

Chromium opens **headed** — that's intentional. If Google shows a consent
screen or CAPTCHA, solve it once in that window; the profile in `./profile/`
persists, so later runs skip it.

### Individual stages

```bash
python serp_scrape.py                                   # step 1
python onpage_crawl.py --mine <url> [--limit 40]        # step 2
python analyze.py --top 10                              # steps 3 + 4
```

Re-analyse without re-scraping (uses `./cache/`):

```bash
python onpage_crawl.py --mine <url> --from-cache
python analyze.py --top 10
```

## Deliverables (`./out/`)

| File | Contents |
|---|---|
| `serp_results.csv` | Every organic result across all 10 pages: rank, page, url, domain, title, snippet |
| `serp_unique_domains.csv` | Deduped by domain, highest-ranking URL kept |
| `serp_features.json` | People Also Ask, related searches, Local Pack |
| `onpage_audit.csv` | One row per URL, ~43 fields (see below) |
| `keyword_frequency.csv` | n-gram, count, distinct-domain count, in-title flag, EN/FR |
| `gap_report.md` | 12-section written analysis |

### On-page fields

Title + length, meta description + length, all H1/H2/H3 in order, canonical,
hreflang, og:/twitter:, JSON-LD schema types (TravelAgency, LocalBusiness,
Organization, FAQPage, BreadcrumbList, AggregateRating), body word count,
internal/external link counts, image count + alt coverage, multilingual
detection, phone / address / contact form / WhatsApp / licence number,
load time, HTTP status, HTTPS redirect, and CWV proxies (render-blocking
refs, lazy images, images with explicit dimensions).

## Behaviour

- `robots.txt` checked per host before every competitor fetch; disallowed URLs
  are recorded with `error=robots.txt disallow` and skipped.
- 2s minimum delay between page fetches; 3–8s randomised between SERP pages.
- Raw HTML cached in `./cache/` — re-analysis never re-scrapes.
- CAPTCHA/block detection saves the HTML as `cache/BLOCKED-serp-pN.html` and
  exits cleanly (exit code 2) rather than hammering.
- Every URL is wrapped in try/except; one dead host cannot kill the run.

## Note on the report

`gap_report.md` sections 1–10 and 12 are computed from the scraped data.
Section 11 outputs the **signal** for the title/description/H1 rewrites
(highest-signal EN and FR title terms, target lengths, and the H1→H2
structure of the top 5). The rewrites themselves are written by hand from
those patterns — competitor copy is never reproduced verbatim.
