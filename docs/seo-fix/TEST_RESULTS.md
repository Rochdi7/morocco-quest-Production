# Test results

- **Run on:** 2026-09-29, branch `fix/seo-audit-2026`, local only.
- **Environment:** PHP 8.2, SQLite in-memory for tests; local site via `php artisan serve` (SQLite) and a temporary XAMPP Apache 2.4.58 vhost for `.htaccess`.

## Automated suite (`php artisan test`)

| Suite | Result |
|---|---|
| `P0SecurityFixesTest` | 18/18 pass |
| `P1TechnicalSeoTest` | 17/17 pass (includes 4 data-provider cases) |
| `StructuredDataTest` | 6/6 pass |
| `InternalLinkingTest` | 4/4 pass |
| `LeadsTabsTest` (existing) | pass |
| `Unit/ExampleTest` (existing) | pass |
| `Feature/ExampleTest` (existing) | **fails, pre-existing.** It fails identically on `main` @ `8137253`: it requests `/` without `RefreshDatabase` ("no such table: blogs"). Not caused by these changes, and left untouched. |
| **Total** | **47 passed, 1 failed (pre-existing)**, 214 assertions |

**Scenarios covered:**
- **Malicious input:**
  - `"><b>…` in `/search` and `/search-bar`
  - array parameters (`?query[]=`)
  - oversized comments
  - honeypot hits
  - self-approval attempts
  - replies to unapproved comments
  - rate limiting
- **Legitimate input:** `l'Atlas`, `Aït Benhaddou`, `مراكش`, `Fès & Meknès`, `Tours "Sahara"`, each escaped exactly once.
- **Pagination boundaries:** page 1, the last valid page, and out-of-range pages.
- **Empty results:** empty type pages, archives, destinations and blog search.
- **Cache:** two simulated visitors, one with validation errors and `old()` input; the other visitor never receives that data.
- **Metadata:**
  - exactly one robots tag
  - 404 meta
  - twitter:title = `<title>` on 4 page types
  - `/cookie-policy` starts with `<!DOCTYPE>` and has one canonical
- **Sitemap:** valid XML, no fake lastmod, empty destinations excluded.
- **Slugs:** stable on rename; an explicit ActivityCategory slug change 301s from the old URL.
- **Schema:** JSON-LD parses; TouristTrip has no duration/offers but has an itinerary; BlogPosting image/publisher/headline; SearchAction; TravelAgency address.
- **Links:** destination → activities, activity → category, nav hubs, accurate intro copy, lazy map iframe.

## Other checks

| Check | Result |
|---|---|
| `php -l` on every changed PHP file | Clean |
| Blade compile (`php artisan view:cache`) | Clean |
| `php artisan migrate:status` | One new pending migration, `2026_09_28_000001_add_is_approved_to_comments_table`. **Not run on production.** |
| `.htaccess` (local Apache, `bash scripts/security/check-exposure.sh http://127.0.0.1:8799` with `DELAY=0`) | **PASS**: 46 private paths → 403/404; 12 public paths still served |
| Production baseline (same script, read-only GET) | 28 private paths served **200** and 4 PHP files **execute (500)**. This is expected to go to PASS after the deploy. |
| Rendered JSON-LD on 8 local page types (Python parse) | 0 errors |
| robots.txt (Python `robotparser`) | Pages and assets allowed for Googlebot and AI bots; `/adminPanel/`, `/login` and `/track/` blocked for all |
| Navigation (Selenium, desktop 1366 px + mobile 390 px, `/` and `/tours`) | Dropdown shows the new items; the mobile expand toggle still opens submenus without navigating away |
| `/dmc-marrakech` local Lighthouse (lab, local dev server) | LCP discovery: fail → **pass**; LCP resource load delay 397 → 26 ms; load duration 726 → 34 ms. Absolute LCP/score are not comparable to PSI (the local dev server has multi-second TTFB). |
| GA4 page view (Selenium, collect requests blocked) | **Cannot verify:** `gtag/js?id=G-QXBGN7DKMB` returns HTTP 404, so the tag never initialises. Needs the correct ID. |

## Not performed, and why
- **Production verification of any fix:** nothing is deployed.
- **PSI before/after on production:** needs the deploy. Compare medians of 3 runs.
- **Consent-granted/denied analytics:** the site has no consent mechanism (no CMP, no Consent Mode) to test.
- **Real form submissions:** forbidden. Forms were exercised only through tests with the array mailer.
- **Static analysis:** none is configured in the project (no PHPStan/Psalm).
