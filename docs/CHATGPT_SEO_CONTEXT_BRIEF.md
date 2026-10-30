# Morocco Quest: SEO context brief for writing the next audit prompt

**To ChatGPT:** this brief describes the whole SEO history and the current code state of morocco-quest.com. It draws on 30+ internal reports (June to September 2026) plus a fresh scan of the codebase on 2026-09-28. Read all of it, then **write me one detailed prompt for Claude Code** (an AI coding agent with full repo access, shell, and web search) to run a **new, full SEO + keyword audit**. The prompt should:
- target the open problems and contradictions listed below
- skip work that is already done
- follow the project rules in section 7
- produce a prioritized, evidence-based report before any code changes are made

Where the old docs and the current code disagree, the current code (section 4) wins.

---

## 1. Business

- **Site:** https://morocco-quest.com, "Morocco Quest DMC". Licensed travel agency in Marrakech, founded 2022. Phone +212 654 069 718. GBP location "Morocco Quest DMC" at 31.6343547,-8.00426.
- **Two audiences:**
  - **B2C:** English-speaking travellers (US, UK, EU, France, Spain) buying private Morocco tours, Sahara desert tours from Marrakech, small-group tours (max 8), luxury trips, and day activities.
  - **B2B/MICE (highest commercial value):** travel agents, tour operators, MICE planners, incentive houses, PCOs, corporate buyers. Trade-only, white-label, net rates, groups of 2 to 500+. Markets: UK, EU, North America, GCC, Asia.
- **Content in the database:** 8 tours (€786 to €2,015, all multi-day), 23 activities, 15 blog posts (author Mounir Akajia), 8 places, 6 categories, 0 trips.
- **Leads:** about 2 to 3 web forms a month plus about 10 direct B2B emails a month. Email volume to sales@: May 1, Jun 7, Jul 20, Aug 39. Leads are stored in a `leads` table (since 2026-08-26) and shown in the Filament admin at `/adminPanel`.

## 2. Stack

- **Framework:** Laravel 12 + Filament admin, on cPanel shared hosting with PHP 8.3. Docroot is the repo root; static assets live in `/assets` at the root, not `public/`.
- **Two layouts with different meta systems. This is the most important quirk:**
  - `layouts/app.blade.php` is used only by the homepage. Meta comes from Blade `@section('title'|'description'|'keywords')`. It never calls `SEOMeta::generate()`, so the SEO code in `HomepageController` is dead.
  - `layouts/app2.blade.php` is used by every other page. Meta comes only from controller `SEOMeta`/`OpenGraph`/`Twitter` calls. It has no `@yield('title')`, so view-level `@section('title')` is ignored.
  - `JsonLd::generate()` is disabled in app2, so every controller `JsonLd::` call is dead. Live page schema comes only from `@push('jsonld')` in Blade views.
  - Both layouts emit a global `WebSite` (`#website`, SearchAction) and `TravelAgency` (`#organization`). Pages reference these by `@id`.
- **Helpers:**
  - `app/Support/SeoHelper.php`: `setCollection()`, `setDetail()`, `noindex()`, `ogImage()`.
  - `config/seotools.php`: default values.
- **Filament SEO fields:**
  - Tours, activities and blogs have `seo_title` (70), `meta_description` (160), `canonical_url`, `og_title`, `og_description`, `og_image`, `sitemap_priority` and `sitemap_changefreq`.
  - Places, activity categories, blog categories and tags have no SEO fields.
  - The last content audit found all `seo_title`/`meta_description` values NULL. Nobody has re-checked since.
- **Caching:** the `CacheGuestPage` middleware keeps a 6-hour full-page HTML cache (home + 8 DMC pages). Every deploy needs `php artisan cache:clear && view:clear && optimize`, and a cache-warm visit before any PageSpeed test.
- **Performance:**
  - PurgeCSS copies live in `assets/css/purged/` (sitewide) and `assets/css/purged-home/`. The config is `purgecss.config.js`, and its safelist must keep `animate-elements`, `^slick` and `^hero-`.
  - Minified JS lives in `assets/js/main.min.js`. Rebuild it with terser after any change to `main.js`.
  - `php artisan images:variants` generates srcset variants and must be run on the production server.
- **Tracking:**
  - GTM `GTM-WVCGDJ98`, loaded on idle.
  - GA4 has an ID conflict: the older notes say `G-YK31305QT6` loads through GTM only, but the current code loads `G-QXBGN7DKMB` directly with `send_page_view:false`. **This needs verifying.**
  - Lead events: `generate_lead`, `click_whatsapp`, `click_phone`, `click_email` and `click_cta`, plus a server-side click beacon at `/track/click`.

## 3. Current URL map and keyword targets

| URL | Primary keyword (documented) | Schema live |
|---|---|---|
| `/` | morocco tours (+ private morocco tours, sahara desert tours morocco, morocco tour package) | global only (homepage FAQPage was removed on purpose) |
| `/tours` | morocco tour package / private morocco tours | Breadcrumb |
| `/tours/type/multi-day` | morocco multi day tours | none |
| `/tours/type/one-day` | morocco day tours | none (noindex when empty) |
| `/tours/type/{Garden%20Tours…}` | morocco {type} | none; URLs contain encoded spaces and capital letters |
| `/tours/{slug}` | tour title | TouristTrip + Offer (USD, hardcoded) + Breadcrumb |
| `/destinations` | morocco tour destinations | Breadcrumb |
| `/destinations/{slug}` (`/tours/place/*` 301s here) | tours in {city} morocco | Breadcrumb only; every city page has the same H1, "Private Morocco Tours" (doorway risk) |
| `/experiences` (`/activity-categories` 301s here) | things to do in morocco | Breadcrumb |
| `/activities` | morocco day tours / day trips | overlaps `/experiences`, which renders the same view |
| `/activities/category/{slug}` | {category} in morocco | Breadcrumb |
| `/activities/type/{type}` (11 types) | morocco {type} | none |
| `/activities/{slug}` | activity title | TouristAttraction + Offer + Breadcrumb |
| `/blog`, `/blog/{slug}` | morocco travel blog / post title | Breadcrumb / BlogPosting + Breadcrumb |
| `/category/{slug}`, `/tag/{slug}` | category or tag name | Breadcrumb; both use the `blog` view with a generic H1; possible cannibalization if a category and a tag share a name |
| `/about` | local morocco tour operator / morocco tour company | Breadcrumb (rich block commented out) |
| `/contact` | contact / book morocco tour operator | ContactPage + ContactPoint + Breadcrumb |
| `/faq` | morocco tours faq | FAQPage (11 questions, visible on the page) + Breadcrumb |
| `/dmc-marrakech` | dmc marrakech | FAQPage + Breadcrumb (no Service) |
| `/destination-management-company` | destination management company morocco | Service + FAQPage + Breadcrumb |
| `/meetings-conventions-management` | meetings and conventions marrakech | same |
| `/professional-congress-organization` | professional congress organizer morocco / PCO | same |
| `/team-building-marrakech` | team building marrakech / incentive travel morocco | same |
| `/events-production-morocco` | event production morocco | same |
| `/sustainable-events-morocco` | sustainable events morocco (no competitor found) | same |
| `/360-event-solutions` | 360 event solutions / integrated MICE morocco | same |
| legal pages | branded only | none |

Notes:
- The internal "78-keyword Semrush cluster" is referenced in the reports, but no raw data file exists.
- There has never been real search volume, keyword difficulty or position data per keyword. A Semrush Position Tracking campaign was created on 2026-08-12, and its data has not been pulled.

## 4. Current code-level issues (fresh scan, 2026-09-28, not yet fixed)

1. **`/blog/search?query=…` returns a 500.** `BlogController.php:111` references an undefined `$post->og_title`.
2. **The Filament `og_image` produces a broken URL.** It stores a relative path (`seo/og/…`) without `asset('storage/…')`. TourController also adds `og:image` twice.
3. **Two robots meta tags on noindex pages.** Pages get `index,follow` from the config default plus `noindex,follow` from SeoHelper.
4. **Homepage issues:**
   - The `og:image` is the logo PNG, not the hero.
   - The title/description in `home.blade.php:2` and in HomepageController differ, and the controller version is dead.
   - The homepage title is about 75 characters long.
5. **The 404 page gets the homepage's default title and description,** because app2 ignores `@section`.
6. **Soft 404s and thin pages:**
   - `/tours/type/{anything}` and `/activities/type/{anything}` return 200 for unknown or empty types.
   - `/tours/type/multi-day-tours` redirects with a 302 instead of a 301.
   - Places with 0 tours appear in the sitemap.
7. **Pagination:** `?page=N` canonicalizes to page 1. There is no rel=prev/next. Pages without an explicit canonical fall back to `url()->full()`, which keeps the query string.
8. **Generic H1s** on destination, category, tag and type-filter pages ("Discover Our Exclusive Tours").
9. **Sitemap problems:**
   - `lastmod = now` on static URLs.
   - Type URLs contain encoded spaces.
   - Missing: `/tours/type/one-day`, `/category/*`, `/tag/*`, activity categories stored in the database, `/activities/type/*`.
   - No image sitemap.
10. **robots.txt and llms.txt drift:**
    - `public/robots.txt` (the served copy) blocks `/search`, so Google cannot see the noindex on those pages.
    - It is missing CCBot, Applebot-Extended and Amazonbot, which the root copy has.
    - It has no llms.txt pointer.
    - `public/llms.txt` still lists `/activity-categories`, which now redirects.
11. **Missing schema:**
    - ItemList on listings.
    - Itinerary on TouristTrip.
    - Place/TouristDestination on destinations.
    - Service on `/dmc-marrakech`.
    - Organization/LocalBusiness (the SERP gap tool flagged these).
    - Schema image sources do not match the OG image sources.
    - An Ahrefs "schema validation error on 31 URLs" was never diagnosed because the validator text is missing.
12. **Images without alt text** in home, tour-detail, activity-detail, blog-details, activity-categories, search-bar and search/results, plus 14 empty `alt=""`.
13. **No hreflang or i18n,** although the schema and llms.txt claim EN/FR/ES/AR service. 4 of 12 "dmc marrakech" competitors are multilingual.
14. **Slug stability:** ActivityCategory and Category regenerate their slug when the name changes. ActivityCategory has no 301 redirect tracking.
15. **Dead code:**
    - `HomeController`, `TripController` (its views are deleted), the Trip/Post models, `index.blade.php` and `category-details.blade.php`.
    - `JsonLd::` calls in 11+ controllers.
    - `StaticPageController::contact()`.
16. **Data quality:**
    - Activity category " Wellness Experiences" has a leading space.
    - Activities 5 and 13 are near-duplicates.
    - Blog 7's slug contains "2025".
    - Tour 5's name contains a U+FFFD character.
    - Activity `duration_days` actually stores hours.
    - Only one image per tour or activity.
    - There are no Sahara/Merzouga or Ouarzazate Place records.
    - Test/junk URLs appeared in an old crawl: `/activities/dfgdfg`, `/blog/testte`.

## 5. Already done (do NOT redo)

- **Cannibalization pass (June):** every page got its own keyword set. Titles use `setTitle($t,false)`, which fixed the doubled suffix. 9 descriptions were trimmed to 160 characters or fewer.
- **H1s:** H1s on the DMC, About, Contact and homepage were aligned with their titles (a brand hook plus the keyword). Pages with multiple H1s were fixed. Modal H2s were demoted.
- **Content additions:**
  - Unique intros and H2s on the hub pages.
  - A "Departing from {city}" block on tour detail pages.
  - Entity mentions on About (Tizi n'Tichka, Aït Benhaddou, Dadès, Todra, Drâa, Saghro, Chefchaouen, Fes el-Bali, Volubilis).
  - Blog to hub cross-link blocks, and an "Explore more in {Place}" block.
- **DMC section:** 8 pages, each with its own controller, meta, Service schema, a real 5 to 6 question FAQ, a cross-link partial, nav links and a sitemap entry.
- **Schema cleanup:** duplicate TravelAgency blocks consolidated into `@id` references, the site-wide GeoCoordinates corrected, the dead global schema partial deleted, and BlogPosting ported into the Blade view (it now renders).
- **Honesty cleanup:**
  - Removed hidden keyword-stuffing text and a hidden H2 from the homepage.
  - Fixed a false "15+ years" claim.
  - Replaced the wrong Google Maps embed ("Colored Morocco Tours") with the correct one.
  - Removed a wrong-brand YouTube link.
  - Rewrote the Privacy and Cookie policies to match the real tech stack.
- **Search and filters:** search pages and filter URLs (`?place`, `?searchDate`, `?guests`, `?category`) get `noindex,follow` plus a canonical to the clean URL.
- **Redirects:** `/trips` was removed and 301s to `/tours`. The `/tours/place/*` → `/destinations/*` and `/activity-categories` → `/experiences` 301s are in place. The slug-redirect table is active for tours, activities, blogs, categories, places and tags.
- **Performance:** defer on all scripts, self-hosted icons and fonts, PurgeCSS, the 6-hour page cache (cut TTFB, which was driving LCP), a preloader cap, and srcset. Mobile PSI went from about 45 to about 83. The LCP element is the hero CSS background image (Aït Benhaddou).
- **Security headers and redirects:** HSTS, CSP baseline, HTTPS + non-www + trailing-slash 301s, and APP_DEBUG turned off.
- **AI crawlers:** allowed in robots.txt, and llms.txt was created.

## 6. Metrics and history

**Audit scores**
- `seo_audit.py` (static Blade check): 95/100 (June).
- Static code audits: 91/100 (July).
- **Live multi-agent production audit: 63/100 (2026-07-08; Local 41, Schema 60, E-E-A-T 58).** After Sprint C it was estimated at about 72, but was never re-measured.
- Seobility on-page: 71% → estimated 88 to 92% (never re-tested).
- Ahrefs Site Audit: 96/100 (August).

**Ahrefs issue counts (Jun to Aug crawls)**
- 120 titles too long.
- 104 URLs not in the sitemap.
- 31 schema errors.
- 28 slow pages.
- 16 pages with only one dofollow internal link.

**Google Search Console**

| Period | Clicks | Impressions | CTR | Avg position |
|---|---|---|---|---|
| Jun 8 to Jul 8 | 46 | 4.09K | 1.1% | 13.3 |
| Jul 8 to Aug 10 | 47 | 2.8K | 1.7% | 18.6 |

- Index coverage: 107 indexed, 73 not indexed.

**Backlinks (Ahrefs)**
- Domain Rating 0.2 → 6.
- Referring domains 274 → 413 (mostly nofollow; dofollow only 6%).

**Rankings**
- "dmc marrakech": page 3 (per the August report) versus page 6+ (per a screenshot). The two sources contradict each other.
- Not on page 1 for "morocco tours private" or "sahara desert tours from marrakech".
- The conclusion of the August reports is that the limit is **domain authority and content depth, not keyword choice**.

**DMC competitive gap**
- Competitors: dmc-marrakech.com, originallymorocco.com (founded 2006), attendance.ma, your-morocco-dmc.com, visitmoroccodmc.com, nolimits.ma, excel-travel-morocco.com.
- Our `/dmc-marrakech` has about 500 to 700 words of prose, against 2,500 to 3,000 for competitors.
- We have no client logos, case studies or reviews.
- We are not in the Local Pack, and the Google Business Profile is reportedly unclaimed or unoptimized.

**PageSpeed (mobile, August)**
- About 80 to 86, and the score swings ±7 between single runs. Always compare the median of 3 runs.
- A round of async CSS behind the preloader crashed the score to 43 and was reverted. Never repeat that.

## 7. Project rules the new audit must follow

1. **Audit first, report, then fix only what is approved.** Verify every agent or tool finding in the actual code: an earlier sprint rejected 6 false positives.
2. **No fabrication:**
   - No invented volume, keyword difficulty, CPC or rankings.
   - No fake reviews or aggregateRating (it requires 10+ real reviews).
   - No invented social or GBP URLs.
   - No "X years" claims that contradict the 2022 founding date.
3. **No hidden text, and no FAQ schema for questions that are not visible on the page.**
4. **Keyword changes need SERP evidence.** Empty tracking data is not evidence.
5. **Edit the file that is actually live:**
   - Homepage meta lives in `home.blade.php` `@section`.
   - Meta for the other pages lives in controller SEOMeta.
   - Schema lives in Blade `@push('jsonld')`.
   - Never add controller `JsonLd::` calls, and never re-enable `JsonLd::generate()` in app2.
6. **Assets and URLs:**
   - Use `base_path()` for asset files, never `public_path()`. A `public_path()` + `filemtime()` call once caused a sitewide 500.
   - Never rename URL slugs without a 301.
   - Use `route()`/`url()` and never hardcode domains.
7. **CSS and design:**
   - Never async-load the main CSS; it caused the CLS crash.
   - Do not remove GSAP animations.
   - Do not change design, booking or payment flows.
   - Do not touch the WordPress `qqv_*` tables in the shared database.
8. **Before committing, check `git diff` for stray edits.** The owner edits files locally and on the server. Commits must be authored by the owner only, with no AI co-author trailers.
9. **Deploy sequence:** `git pull && php artisan cache:clear && php artisan view:clear && php artisan optimize`. Also run `php artisan images:variants` on the server after new uploads.
10. **Verify against production.** The dev database is mostly empty, so detail pages, the category vs tag collision and Filament field contents can only be checked on the live site or with a production data export.

## 8. Tools available in the repo

- **`seo_audit.py`:** static Blade check covering title, description, H1, alt, canonical and JSON-LD.
- **`scripts/serp-audit/`:** Playwright scraper for Google SERP pages 1 to 10, an on-page crawl of 43 fields and a gap report. The query is currently "dmc marrakech"; change it in `common.py`.
- **Artisan commands:** `images:variants`, `leads:import-maildir`, `leads:create-viewer`.
- **Paid-data connectors:** Semrush and Ahrefs connectors exist but are not authenticated. The audit should either ask for exports or run in "manual data" mode (CSV from GSC, Ahrefs or Semrush pasted by the owner).

## 9. Suggested focus for the new audit (my priorities; ChatGPT, feel free to refine)

1. Fix and verify the live bugs in section 4 (the /blog/search 500, broken og:image, double robots meta, 404 meta, soft 404s).
2. Technical indexation: sitemap completeness and accuracy against the Ahrefs "104 not in sitemap" finding, the robots.txt conflict, pagination canonicals, and the encoded-space type URLs.
3. Keywords, driven by real data (GSC queries export plus Semrush): map each query to a page, find real cannibalization (the /tours and /destinations keyword sets now overlap the homepage again; /experiences overlaps /activities; category vs tag), and CTR opportunities where position is 5 to 20 but CTR is low.
4. Content depth and E-E-A-T for the DMC hub and the top tours: word count against competitors, case studies, real testimonials, author bylines on blog posts, and thin blog posts (the Agafay vs Sahara post has about 900 words; the hot-air-balloon page has about 530).
5. Schema completion: ItemList, itinerary, Service on `/dmc-marrakech`, and a diagnosis of the 31 Ahrefs schema errors using the Rich Results Test.
6. Local SEO: GBP optimization, NAP consistency, and the Local Pack for "dmc marrakech".
7. International: decide whether FR/ES versions with hreflang are worth building (B2B markets are FR/ES/GCC).
8. Filament SEO fields: populate `seo_title`/`meta_description` for all tours, activities and blogs, and add the fields to places and categories.
9. Measurement: settle the GA4 ID conflict and confirm that `generate_lead` reaches GA4.

Output expected from the audit: an evidence table of **issue → URL/file:line → severity → proof → fix → effort**, a keyword-to-URL map with data sources, and a phased fix plan. **No code changes until the owner approves.**
