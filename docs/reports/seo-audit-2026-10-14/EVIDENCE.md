# Evidence log: Morocco Quest SEO audit, 14 October 2026

This file records what was checked, how, and what came back. It separates **verified facts** (observed directly today) from **carried-forward observations** (from the 28 September 2026 audit, not re-checked) and **hypotheses** (reasoned, not proven).

All checks were read-only GET requests at roughly one request per second or slower. No form was submitted, no account was changed, and no file outside this folder was modified.

## 1. Tools and data sources

| Tool / source | Used | Notes |
|---|---|---|
| claude-seo skill v1.9.0 (AgricIDaniel) at `~/.claude/skills/seo*` | Yes | `seo-audit` workflow: fetch, crawl, specialist delegation, scoring. Scripts used: `google_auth.py --check`, `backlinks_auth.py --check`, `drift_history.py`, `gsc_query.py sites/sitemaps`. Installed as standalone skills plus 15 agents, not as a marketplace plugin. |
| Specialist agents (claude-seo) | Yes | seo-sxo (SERP/competitors), seo-performance, seo-schema, seo-local (local/backlinks/GEO), seo-content. The content and performance agents hit their turn limits; their unfinished parts (content analysis, rendering, mobile) were completed directly by the lead auditor and are logged below. |
| Custom polite crawler (`evidence/technical/crawl.py`) | Yes | Python requests + BeautifulSoup, robots.txt respected, 1 s delay, no query-string URLs followed. |
| Playwright (Chromium, headless) | Yes | Raw-vs-rendered comparison and mobile checks on 5 URLs (`evidence/perf/render_mobile.json`, `evidence/screenshots/`). Local lab data only. |
| Google Search Console API | Attempted | The configured service account can only see `https://www.local-morocco-tours.com/`. **No data for morocco-quest.com.** |
| GA4 Data API | No | No property ID configured, and the site's GA4 measurement ID is invalid (see F-1). |
| PageSpeed Insights / CrUX | Attempted | Anonymous API returned HTTP 429 (no API key). **No field data and no PSI lab data today.** |
| Moz / Bing Webmaster / Ahrefs / Semrush | No | Not configured or not authenticated. Semrush numbers quoted in this audit come from the repo file `docs/seo-fix/KEYWORD_MAP.md` (US database, 30 September 2026) and are labelled as such. |
| WebSearch | Yes | 26 queries. It is not Google and is US-based, so **no positions are claimed from it**. |

## 2. Crawl coverage

| Measure | Value |
|---|---|
| Crawl date | 2026-10-14, about 21:20–21:30 UTC |
| URLs in sitemap.xml | 84 (all returned 200 and are indexable) |
| URLs fetched | 185 |
| HTTP 200 HTML pages | 178 |
| HTTP 404 | 7 (all empty tag pages) |
| Indexable (200, self-canonical, no noindex) | 118 |
| Noindex | 60 (tag archives, intentional) |
| Language | `lang="en"` on all 178 pages; no hreflang |
| Not reached by the crawl | `/tours/type/one-day` (no internal link, not in sitemap); checked separately: 200, indexable |

Raw data: `evidence/technical/crawl.json`. Summary output: `evidence/technical/crawl_analysis.txt`.

## 3. Verified findings with evidence

### F-1. Analytics records nothing (verified)

- The homepage loads `GTM-WVCGDJ98` and `gtag.js?id=G-QXBGN7DKMB` with `send_page_view: true`.
- `https://www.googletagmanager.com/gtag/js?id=G-QXBGN7DKMB` returned **HTTP 404** today. Google serves 404 for measurement IDs that do not exist.
- The published GTM container (version 2) was downloaded and parsed: its `"tags"` array is **empty**.
- Conclusion: no GA4 page views or conversions are being recorded from either path. This was first reported on 2026-09-28 (owner decision O-1) and is still open.

### F-2. Security exposures from the previous audit are fixed (verified)

All returned 404 today: `/.git/config`, `/.git/index`, `/.git/HEAD`, `/LEADS_AUDIT_REPORT.md`, `/clear_opcache.php`, `/vendor/composer/installed.json`, `/composer.json`, `/readme.html`, `/problemes.md`, `/seo_audit.py`, `/docs/reports/SEO_AUDIT_2026-09-28.md`, `/storage/logs/laravel.log`. `/.env` returns 403.

The search-page XSS marker (`"><b>mqaudit123</b>`) now comes back HTML-escaped in the title and description. `/blog/search?query=sahara` returns 200 (was 500). `/tours?page=2` returns 404 (was 500).

Still public but harmless: `/urllist.txt` (48 old URLs including the `%20` type URLs). Recommend deleting it.

### F-3. Seven 404 tag pages linked from 110 pages (verified, new)

`/tag/agafay-desert`, `/tag/moroccan-music`, `/tag/morocco-travel-blog`, `/tag/spiritual-traditions`, `/tag/team-building-activities`, `/tag/unique-morocco-tours`, `/tag/yearroundtravel` all return 404. Each is linked from the same 110 pages: the blog index, 16 posts, 33 categories and 60 tags, through the tag sidebar. The 29 September fix made empty tags return 404 but did not remove them from the sidebar.

### F-4. `/activities` renders an empty listing (verified, new)

- Live HTML contains "No activity categories found at the moment".
- Cause in code: `ActivityController::index()` (`app/Http/Controllers/ActivityController.php:180`) renders the `activity-categories` view with `compact('activities', ...)`, while `resources/views/activity-categories.blade.php:77` checks `$activityCategories`.
- The page is indexable, in the sitemap, and shares its H1 "Things to Do in Morocco & Marrakech" with `/experiences`.
- Its intro still advertises "camel treks into the Agafay Desert and Erg Chebbi dunes, quad-biking circuits…, sunrise hikes on Jebel Toubkal" (`activity-categories.blade.php:69`). The audit found no matching activity pages for quad biking or Toubkal.

### F-5. Day-trip intent split across three URLs; one is orphaned (verified)

- Main and mobile menu: "One-Day Tours" links to `/experiences`; "Day Trips" links to `/activities/category/day-trips`.
- `/tours/type/one-day` returns 200, is indexable, has H1 "Morocco Day Tours & Day Trips", is **not in the sitemap and has no internal links**. Its 12 cards show "Unknown Location" and "Price On Request".

### F-6. `%20` type URLs duplicated by slug versions (verified)

`/tours/type/Garden%20Tours` and `/tours/type/garden-tours` both return 200 with identical titles and H1s, each canonicalised to itself. The same applies to Art and Classical tours. The menu (on every page) and the sitemap link the `%20` versions. Code: `TourController::showByType` maps both forms to the same type.

### F-7. Cold-start latency and connection stalls (verified, cause unknown)

| Observation | Value | Source |
|---|---|---|
| First request to `/` (this audit's first request) | 11.0 s total | curl, 21:20 UTC |
| Same URL, next 3 requests | 0.44–0.47 s TTFB | curl |
| Cold `/` during performance test | 15.5 s TTFB | performance agent |
| First requests after idle | connect 3.1–15.2 s, two connect timeouts, one reset | performance agent |
| One request from the lead auditor | `Failed to connect … port 443 after 21058 ms` | curl, retried OK seconds later |
| Playwright cold load of `/` | 47.6 s to `load` event | render_mobile.json |

Warm pages are fast because of the page cache. Whether Googlebot sees the same stalls cannot be confirmed without Search Console **Crawl stats → Host status**. This is a hypothesis about crawl impact, but the stalls themselves are verified.

### F-8. Trust claims that cannot be verified (verified as present; truth not verifiable)

- Homepage, "Recognized Excellence Awards": TripAdvisor Travellers' Choice 2022, Tui Sustainability Award 2024, IAGTO Supplier's Award 2025. The About page says the company was founded in 2022 by Mounir Akajia. The About page lists a different set of awards (for example "ISO Quality Label", "Excellence in World Travel 2023").
- Homepage heading "What Our Travelers Say" has no testimonials under it.
- The four DMC pages checked (`/dmc-marrakech`, `/destination-management-company`, `/meetings-conventions-management`, `/team-building-marrakech`) share 13 identical sentences, including the same three anonymous five-star testimonials attributed only by role and city (for example "Tour Operator — London, UK", "Incentive Travel Director — Paris, France", "Scientific Committee Chair — Madrid, Spain").
- DMC pages say "Licensed" up to 12 times and "IATA compatible" with no licence number.
- The `/dmc-marrakech` hero states "20+ Groups handled / year", "11 Countries served", "100% Licensed & insured".

### F-9. Product data errors (verified)

- 8-day cultural tour: itinerary shows "Day 01" twice and no "Day 08" (sequence: 01, 01, 02 … 07).
- 5-day Sahara tour: the Madu luxury desert camp is listed under a "Dades:" accommodation heading.
- All 8 tours and all sampled activities show "Price On Request"; tour pages also show "Best Price" wording.
- Homepage search box first field reads "Select Division" (screenshot `evidence/screenshots/mobile-home.jpg`).

### F-10. Rendering is server-side and consistent (verified)

For 5 URLs (home, `/dmc-marrakech`, Sahara tour, balloon activity, a blog post), title, meta description, canonical, H1, internal link count and JSON-LD block count are **identical** in raw HTML and the rendered DOM. Rendered pages show 30–140 more words (counters and widgets). Google does not need JavaScript to see the SEO content.

### F-11. Mobile checks (verified, 390 × 844 viewport)

- No horizontal overflow on any of the 5 pages.
- Every page has `tel:` links, a WhatsApp link and at least 3 forms.
- 1–8 tap targets smaller than 24 px per page (social icons and similar).
- The mobile menu shows: Multi-Day Tours, One-Day Tours (→ `/experiences`), Blog, DMC, Info Hub (→ `/about`), Contact. It does not link `/tours` or `/destinations` directly.
- The full-screen preloader was still visible 1 s after `load` on `/dmc-marrakech`.

### F-12. Structured data (verified by the schema agent, see `evidence/schema/schema.md`)

19 URLs parsed with no JSON errors. All 31 schema errors from 28 September are fixed. Open: blog image URLs with raw spaces, no BreadcrumbList on `/tours/type/*`, hard-coded `touristType`, home vs inner-layout TravelAgency differences, `/contact` re-declaring the business node with a different phone format.

### F-13. Performance lab data (local Chromium, not Core Web Vitals)

See `evidence/perf/performance.md`. Inner pages still load Font Awesome Pro (0.64–1.8 MB of fonts), the preloader logo is the LCP element on 6 of 8 URLs, and Google Maps loads without interaction on tour and activity pages. The homepage improved: LCP is now the preloaded hero image and its font payload is about 67 KB.

### F-14. External links (verified)

Every page carries the same block of 11 outbound "travel resources" links. Two of them return 404: `intrepidtravel.com/adventures/morocco-travel-tips/` and `thebrokebackpacker.com/what-to-pack-for-morocco/`. One page links to the malformed `https://x.com/mounirakajiamounirakajia`.

### F-15. Server firewall note (verified, not an SEO problem)

ModSecurity returns 406 to the bare user agent `Mozilla/5.0`. Googlebot (desktop and smartphone), Google-InspectionTool, Bingbot, facebookexternalhit, normal browsers and curl all receive 200.

### F-16. Off-site, local and backlinks (verified with limits, see `evidence/offsite/offsite.md`)

- **NAP consistent:** name, phone +212 654 069 718 and the Gueliz address (Khalid Ibn Al Walid Street, 40000) match on `/`, `/contact`, `/about`, JSON-LD and llms.txt. The JSON-LD now includes street and postal code (fixed since 28 September).
- **Brand name split persists:** site schema uses "Morocco Quest" (alternate "Morocco Quest Tours & Travel"); the Google Business Profile label, Instagram, Facebook and TripAdvisor use "Morocco Quest DMC".
- **Linked TripAdvisor listing d33367694:** 1 review (August 2025), categorised "Food & Drink", no phone or website, no Travellers' Choice badge (read through WebFetch summaries because TripAdvisor blocks curl). This **contradicts** the homepage claim "TripAdvisor Travellers' Choice 2022".
- **Backlinks:** no referring domain could be verified today. The coloredmorocco.com link reported on 28 September was not found on its homepage or 25 of 27 sitemap pages (it still shares the WhatsApp number). `commoncrawl_graph.py` timed out after 120 s. This is a tooling limit, not proof that no links exist.
- **llms.txt:** 18 of 19 links return 200; the TripAdvisor link returns 403 to bots.
- **Correction to the agent's note:** the agent reported that the firewall blocks "a browser-style user agent". Direct testing (F-15) shows only the bare `Mozilla/5.0` string is blocked; full browser strings and Googlebot receive 200.

## 4. Carried forward from 28 September 2026 (not re-checked today)

- Google positions (gl=ma): professional congress organizer morocco #1, sustainable events morocco #3, events production morocco #5, incentive travel morocco #9 (blog post), meetings and conventions marrakech ~#15, dmc marrakech ~#35 (repo data 26 August). Not in the top ~20 for B2C head terms.
- Local pack: absent from all 12 captured.
- Brand confusion with moroccoquest.com and four TripAdvisor "Morocco Quest" listings.

## 5. Hypotheses (not proven)

- H-1: Trust evidence, not word count, is the main gap for "dmc marrakech / morocco dmc". Competitors show licence numbers, ratings and named testimonials.
- H-2: Price visibility and reviews are the main gaps for B2C Sahara and private-tour queries, where ranking pages show prices and ratings.
- H-3: Cold-start stalls may reduce Googlebot crawl rate. Needs Search Console Crawl stats.
- H-4: `/experiences` (a product grid) is a poor match for "things to do in morocco/marrakech", where editorial guides usually rank.

## 6. Files in `evidence/`

| Folder | Content |
|---|---|
| `technical/` | crawler, analysis script, `crawl.json`, `crawl_analysis.txt` |
| `serp/` | `serp_findings.md`, `keyword_rows.csv` |
| `schema/` | `schema.md`, raw JSON-LD per page |
| `perf/` | `performance.md`, `lab_raw.json`, `render_mobile.json` |
| `screenshots/` | 6 mobile captures |
| `content/raw/` | page text and HTML used for the content analysis |
| `offsite/` | NAP, citations, backlinks, llms.txt checks |
