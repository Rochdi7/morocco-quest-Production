# SEO audit fixes: changelog

The branch is `fix/seo-audit-2026` (base `8137253`). It has 26 local commits, authored by rochdi karouali, touching 52 files (+1543 / −226). It is **not pushed and not deployed.**

| # | Commit | Area | Change | Indexing / URL impact |
|---|---|---|---|---|
| 1 | `530b923` | P0-1 | Root `.htaccess` returns 404 for `.git`, dotfiles, docs, vendor, config, tooling, `*.md`, and `*.php` other than `index.php` | None (only private files) |
| 2 | `783cb41` | P0-2 | `EscapedSEOMeta`, `stringInput()`, request input kept out of keywords | Titles render escaped; visible text is unchanged |
| 3 | `cb144ff` | P0-6 | `/blog/search` no longer returns 500 | None (noindex page) |
| 4 | `e700123` | P0-7 | `/tours?page=N` no longer returns 500; out-of-range → 404 | Empty pages now 404 |
| 5 | `b9c791d` | P0-4 | Page cache skips sessions with flashed state | None |
| 6 | `6e9ee81` | P0-3 | Comment moderation + migration `2026_09_28_000001` | Existing comments are hidden until approved |
| 7 | `f3e4bb8` | P0-5 | gtag `send_page_view:true` | Analytics only |
| 8 | `86e78f0` | tests | P0 regression tests | — |
| 9 | `518e340` | P0-2 | No double-escaping of the search term in H1s | None |
| 10 | `249567c` | tests | Legitimate-input and two-visitor tests; `scripts/security/check-exposure.sh` | — |
| 11 | `4f79681` | P1-1/2/7 | Single robots tag, 404 for unknown types, proper 404 meta, 301 aliases | Unknown type URLs → 404; empty known types → noindex |
| 12 | `d26e636` | P1-4 | Sitemap: real lastmod; empty destinations dropped | Sitemap only |
| 13 | `7bce67b` | P1-8/9 | robots.txt groups; `/adminPanel/` blocked; llms.txt refreshed | AI bots can no longer crawl login/admin |
| 14 | `119df8a` | P1-6 | Default OG image, per-page Twitter cards, relative og_image, homepage escaping | Social previews only |
| 15 | `ed984eb` | P1-10 | `/cookie-policy` stray head tags removed | One canonical |
| 16 | `532ed3e` | P1-12 | Stable category slugs; ActivityCategory 301 tracking | Prevents future URL changes |
| 17 | `038391d` | P1-5 | Tags noindex, empty archives 404, unique archive H1s | **67 tag pages → noindex,follow** |
| 18 | `9454ff0` | tests | P1 regression tests | — |
| 19 | `d074838` | P3-1/2/3 | JSON-LD fixes (31 nodes), SearchAction, TravelAgency, BlogPosting | Structured data only |
| 20 | `6f0ffc5` | P3-5 | Nav: All Morocco Tours, Destinations; Info Hub → /about | New internal links |
| 21 | `6041d9c` | P3-5 | Reply links → `#reply-form-N` | None |
| 22 | `e16870d` | P2-4/P3-6 | Destination activity links + H1; activity → category link; accurate intro | New internal links; H1 changes on 8 destination pages |
| 23 | `66588dc` | P2-2 | Placeholder activity highlights removed | Content |
| 24 | `b543800` | P2-7 | In-body `<h1>` rendered as `<h2>` | Heading structure |
| 25 | `2ae25b5` | P1-13 | `/dmc-marrakech` hero preload + inline background | Performance |
| 26 | `05c2352` | P1-13 | Tour map iframe lazy-loaded | Performance |

## Not changed on purpose
- **URLs:** no route or slug was renamed. Only the `multi-day-tours`/`one-day-tours` aliases changed, from 302 to 301 to the same targets.
- **Kept as they are:**
  - the main CSS (still synchronous)
  - GSAP
  - the preloader
  - booking, contact and lead forms
  - Filament features
- **Production data:** no stored content was edited.

## Final pass (2026-09-29): uncommitted working-tree changes

Commits were not authorized for this pass, so the following changes are **not committed**:

| Area | Change | Files |
|---|---|---|
| JS errors | FAQ counters used a missing jQuery plugin (stuck at 0); now native IntersectionObserver. `main.min.js` rebuilt. | `assets/js/main.js`, `assets/js/main.min.js` |
| JS errors | Invalid `#360-enquiry` selector; invalid SVG `height="auto"`; missing placeholder images; hard-coded asset domain | `360-event-solutions`, `partials/dmc-world-map`, `activity-categories`, `activity-detail`, `search/results`, `tour-detail`, `emails/tours/inquiry`, `type-filter` |
| Schema | ItemList (tours, destinations, experiences, activity categories), TouristDestination, Service on `/dmc-marrakech`, destination breadcrumb level | `partials/schema-itemlist` (new), `tours-list`, `destinations`, `activity-categories`, `activities-by-category`, `dmc-marrakech` |
| Pagination | Page 2+ self-canonical with "– Page N" title | `app/Support/SeoHelper.php`, Tag/Category controllers |
| Sitemap | Activity categories from the DB (with at least one activity) | `SitemapController` |
| Performance | Bootstrap Icons subset (130 KB → 0.7 KB); inline hero backgrounds on 25 views; preloader logo `fetchpriority=high` | `assets/plugins/bootstrap-icons/*subset*` (new), layouts, 25 views |
| Tests | `ExampleTest` gets `RefreshDatabase`; new `FinalPassTest` (8 tests) | `tests/Feature/*` |
| Docs | `FINAL_REAUDIT.md`, `OWNER_DECISIONS.md`, `FINAL_DEPLOYMENT_READINESS.md` | `docs/seo-fix/` |
