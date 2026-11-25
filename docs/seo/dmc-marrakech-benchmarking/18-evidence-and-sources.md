# 18 — Evidence & Sources (Phase 2)

All evidence is under `evidence/phase2/` (≈37 MB, mostly full-page PNG screenshots). **Before any commit**, decide whether to keep the screenshots in git or move them to storage outside the repo. Nothing has been committed.

## 1. Competitor and target URLs

| Role | URL | Ranking evidence |
|---|---|---|
| Competitor #1 | <https://mice.visitmarrakech.com/se-reunir/les-agences-receptives-dmc/> | #1 for "dmc marrakech" (Google MA) in 3 of 4 runs |
| C1 profile example | <https://mice.visitmarrakech.com/listing/intrepid-dmc-marrakech/> | #19 (run 2) |
| C1 full list | <https://mice.visitmarrakech.com/travel-trade/?type=agences-dmc-voyages> | — |
| C1 EN version | <https://mice.visitmarrakech.com/en/se-reunir/les-agences-receptives-dmc/> | Not captured: the bot challenge (HTTP 402) did not clear |
| Competitor #2 | <https://dmc-marrakech.com/> | #2 in 3 of 4 runs; #1 in the Semrush US snapshot |
| C2 network pages | <https://dmcprofessionals.com/dmc-marrakech/>, <https://bodyandsoulinternational.com/dmc-marrakesh> | Do not link to dmc-marrakech.com (checked) |
| Morocco Quest | <https://morocco-quest.com/dmc-marrakech> | #15 / #18 / #15 in runs 1–3 |
| Map pack businesses | "Dmc Marrakech" (Atlas Business Center, 72 Bd Abdelkrim Al Khattabi), "EXCEL TRAVEL MOROCCO", "Originally Morocco - DMC Marrakech incentive" | Run 3 Places block + AI Overview |

## 2. SERP captures (Google, gl=ma, hl=en, num=10, pws=0, desktop 1366×900, non-logged-in persistent profile, tz Africa/Casablanca)

| File | Query | Time (UTC) | Notes |
|---|---|---|---|
| `serp/serp-check-2026-11-24.json`, `serp/dmc-marrakech-p1.html`, `-p2.html`, `screenshots/serp-dmc-marrakech-p1.png` | dmc marrakech | 13:23 | Page 1 = generic "Marrakech" set; page 2 includes MQ #15 |
| same JSON, `serp/dmc-marrakech-morocco-p1/p2.html`, `screenshots/serp-dmc-marrakech-morocco-p1.png` | dmc marrakech morocco | 13:24 | #1 attendance.ma, #2 your-morocco-dmc.com |
| same JSON, `serp/marrakech-destination-management-company-p1/p2.html`, screenshot | marrakech destination management company | 13:24 | #1 your-morocco-dmc.com, #2 C1; map pack present |
| `serp/serp-recheck-dmc-marrakech-run2.json` | dmc marrakech | 13:25 | C1 #1, C2 #2, MQ #18 |
| `serp/serp-recheck-dmc-marrakech-run3.json`, `serp/dmc-marrakech-p1-run3.html`, `-p2-run3.html`, `screenshots/serp-dmc-marrakech-p1-run3.png` | dmc marrakech | 13:26 | Map pack + AI Overview (FR) above C1 #1, C2 #2; MQ #15 |
| `../serp-google-ma-*.csv` (phase 1) | 8 queries | ~12:15–12:50 | 10-page scrapes; pages 2+ can come from a different result set (see 14 §1) |

**Sponsored results:** none detected (no `data-text-ad` blocks and no "Sponsored" label) in any of the captures above.
**Rankings that differed between runs:** run 1 served a generic result set on page 1. Runs 2–3 and the 12:15 scrape served the DMC set. MQ's position varied between #15 and #18.

## 3. Page captures (Playwright Chromium 1366×900 + Pixel 7 emulation)

| Data | Files |
|---|---|
| Rendered HTML | `html/*.html` |
| Structured extraction (meta, OG, hreflang, headings, images with natural/rendered size and bytes, CSS backgrounds, links, JSON-LD, text, contact methods, lab perf) | `data/c1.json`, `data/c1x.json`, `data/c2.json`, `data/mq.json` |
| Desktop first screen / full page / mobile first screen | `screenshots/<label>-desktop-hero.png`, `-desktop-full.png`, `-mobile-hero.png` |
| Side-by-side mobile heroes | `screenshots/mobile-hero-comparison-c1-c2-mq.jpg` |

**Access notes:**
- C1 sits behind a JavaScript bot challenge (HTTP 401/402 with `noindex,nofollow`) for automated clients. It was captured with a visible browser after the challenge cleared.
- C1's EN page couldn't be captured.

### Lab mobile performance (identical conditions: 150 ms RTT, 1.6 Mbps down, 4× CPU, Pixel 7)

| Page | LCP | LCP element | FCP | CLS | TTFB | Requests | Transfer | DOM nodes |
|---|---|---|---|---|---|---|---|---|
| C1 | 27,788 ms | Hero bg `DSC_8997.jpg` | 9,772 ms | 0.005 | 204 ms | 94 | 5.5 MB | 1,176 |
| C2 | 8,480 ms | Hero bg `dmc-marrakech-db8ea7b9.webp` | 2,796 ms | **0.112** | 1,091 ms | 25 | 560 KB | 281 |
| MQ (live) | **5,128 ms** | Hero bg `morocco-quest-marrakech-koutoubia-dmc-hero.webp` | 2,272 ms | 0.008 | 614 ms | 48 | 2.0 MB | 1,975 |

These are lab numbers, valid for **relative** comparison only (not Core Web Vitals field data; PSI's keyless quota was exhausted).

### Semantic term counts (main text)

| Term | C1 | C2 | MQ |
|---|---|---|---|
| dmc marrakech | 2 | 11 | 10 |
| destination management | 3 | 2 | 10 |
| incentive | 2 | 5 | 20 |
| mice | 3 | 1 | 14 |
| congress / congrès | 0 / 4 | 1 / 0 | 9 / 0 |
| séminaire / seminar | 3 / 0 | 0 / 1 | 0 / 0 |
| team building | 0 | 1 (teambuilding) | 10 |
| venue | 0 | 4 | 16 |
| hotel / riad | 0 / 0 | 2 / 1 | 21 / 14 |
| transfer | 0 | 0 | 11 |
| net rate / b2b / white-label | 0 | 0 | 12 / 8 / 5 |
| sur mesure / tailor-made | 7 / 0 | 0 / 0 | 0 / 2 |
| since / years (track record) | 0 | 1 | **0** |
| rating | 0 | 3 | **0** |
| words (main text) | ~959 | 757 | ~3,988 |

## 4. Other technical evidence

| Check | Result |
|---|---|
| Wayback first capture | dmc-marrakech.com **2016-01-12**; mice.visitmarrakech.com 2019-02-13; morocco-quest.com **2025-03-30** |
| dmc-marrakech.com robots.txt / sitemap | Default Joomla robots; `/sitemap.xml` 404; `www` → apex **302** |
| C1 headers | Cloudflare, WordPress (PHP 8.0.30), `s-maxage=216000` |
| C2 headers | Apache, Joomla/YOOtheme, `no-store` HTML |
| MQ organisation data (repo) | `layouts/app2.blade.php`: TravelAgency, Khalid Ibn Al Walid Street, **Gueliz, Marrakech**, foundingDate 2022, alternateName "Morocco Quest Tours & Travel"; /about: founded by Mounir Akajia in 2022 |

## 5. Semrush data and API usage (this phase)

| Call | Units | Result |
|---|---|---|
| `backlinks_refdomains` dmc-marrakech.com (20 lines, by AS) | 800 | Top 20 all spam/SEO-tool domains (max AS 14) |
| `backlinks_anchors` dmc-marrakech.com (9 lines) | 360 | 1,989 RDs with the "premium seo links… dmc-marrakech.com" anchor |
| `backlinks_refdomains` morocco-quest.com (20) | 800 | heartmybackpack.com AS 46, globeslice.com AS 20, then spam |
| `backlinks_anchors` morocco-quest.com (14) | 560 | 1,872 RDs with the "expert seo backlink services… morocco-quest.com" anchor |
| `backlinks_overview` visitmarrakech.com (root) | 40 | AS 47, 5,349 RDs, 44,365 backlinks |
| `backlinks_refdomains` mice.visitmarrakech.com (15) | 640 | greatruns.com 45, audiala.com 39, glarity.app 35, villatajmarrakech.com 29… |
| `phrase_these` US (12 keywords) | 40 | Only "team building marrakech" (40/mo) has volume; the rest return 0/none |
| `phrase_these` FR (6 keywords) | 60 | dmc marrakech 20, dmc maroc 20, agence événementielle marrakech 30, **séminaire marrakech 210**, agence réceptive marrakech 0, agence mice marrakech 0 |
| **Phase 2 total** | **≈3,300** | Balance 43,740 (session total ≈6,260 of 50,000) |

Reused without new calls: keyword volumes/KD from report 04; domain overviews for C2 and MQ from report 07; the 50-site data from report 11.

## 6. Verified vs hypothesis summary

| Statement | Status |
|---|---|
| C1 is #1 and C2 is #2 for "dmc marrakech" in Google MA (3 of 4 runs) | Verified |
| MQ ranks #15–#18 (page 2) | Verified (3 runs) |
| The earlier "not in top 94" was a pagination artefact | Verified (mechanism observed: page sets differ between requests) |
| C2's backlinks are spam and don't explain its rank | Verified (top 20 RDs + anchors) |
| C2 ranks mainly on its exact-match domain, age and topical purity | Hypothesis consistent with all evidence |
| Google treats "dmc marrakech" partly as navigational to businesses named "DMC Marrakech" | Hypothesis (supported by EMD, GBP names and AI Overview wording) |
| C1 ranks on institutional authority + list-intent match | Verified authority; intent match is a strong hypothesis |
| Images and speed don't decide this SERP | Verified (C1: one photo, LCP 27.8 s, ranks #1) |
| A map pack and AI Overview appear for this query | Verified (run 3; and the "marrakech destination management company" capture) |
