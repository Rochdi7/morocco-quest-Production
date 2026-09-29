# Final re-audit: state of `fix/seo-audit-2026`

**Date:** 2026-09-29. **Branch:** `fix/seo-audit-2026`.
- 27 commits on top of `main` @ `8137253`.
- This pass's work is **uncommitted** in the working tree (commits were not authorized for this pass).
- Nothing pushed, merged or deployed.

> **Sensitive:** this file describes security issues. Everything under `docs/` is publicly downloadable on the live site until the `.htaccess` fix (commit `530b923`) is deployed. Don't publish it elsewhere.

## 1. How the state was verified (not taken from earlier reports)
- **Git:** branch, 27 commits and working tree reviewed. No stray or unrelated changes; the two pre-existing untracked docs are left alone.
- **Tests:**
  - Full suite run before this pass: 47 passed, 1 failed (`ExampleTest`, pre-existing).
  - After this pass: **56 passed, 0 failed**.
- **Scratch database:** a copy of the local SQLite DB (outside the repo) was migrated and filled with **synthetic** tours, activities, posts and comments. The app was served from it, so real local data was not modified.
- **Checks run against the scratch site:**
  - a Selenium console-error sweep on 22 page types, desktop and mobile
  - a link, metadata and status crawl of 68 URLs
  - JSON-LD parsing
  - local Lighthouse
- **Apache rules:** a local Apache 2.4 vhost ran the real root `.htaccess` for the exposure check.
- **Production:** read-only GETs only, used to compare live behaviour with the repo.

## 2. Previous fixes: independently re-verified

| Fix | Evidence this pass | Result |
|---|---|---|
| P0-1 repo files blocked | `scripts/security/check-exposure.sh` against local Apache | PASS (46 private paths 403/404, public assets served) |
| P0-2 XSS | Tests with malicious and legitimate input (`l'Atlas`, Arabic, `&`, quotes) | Pass |
| P0-3 comment moderation | Tests; rendered blog post shows the approved comment only; honeypot present in forms | Pass |
| P0-4 cache leak | Two-visitor middleware test | Pass |
| P0-5 GA4 | `gtag/js?id=G-QXBGN7DKMB` still returns **404** from Google | **Blocked: needs the correct ID** |
| P0-6 blog search | Tests: 200 / redirect / no 500 on arrays | Pass |
| P0-7 tours pagination | Tests and live-style check: page 1 → 200, page past the end → 404 | Pass |
| P1 items (1, 2, 4–10, 12) | P1 test suite + local crawl | Pass |

## 3. New findings this pass, and what was done

| # | Finding | Severity | Evidence | Action |
|---|---|---|---|---|
| R1 | `/faq` stat counters stayed at **"0"**: `main.js` called `$.fn.isInViewport`, a plugin no layout loads (TypeError) | High (visible, broken) | Console `e.isInViewport is not a function`; counters read 0 | **Fixed:** native IntersectionObserver; `main.min.js` rebuilt (the build was verified byte-identical before the edit). All four counters now reveal. See owner item O-14 about what they claim. |
| R2 | `/360-event-solutions`: `querySelector('#360-enquiry …')` is an invalid selector (id starts with a digit) and threw, so the post-submit alert never scrolled into view | Medium | Console DOMException | **Fixed** (`getElementById`) |
| R3 | `/dmc-marrakech` world-map SVG had an invalid `height="auto"` attribute | Low | Console error | **Fixed:** attribute removed; the inline style already sets `height:auto` |
| R4 | Fallback images `tour-placeholder.png`, `activity/…placeholder.png` and `activities/…placeholder.png` don't exist (404) | Medium | Console 404s | **Fixed:** use the existing `placeholder-image.webp` (6 references, including the tour-inquiry email) |
| R5 | `/tours/type/*` hero and decorative icons hard-coded to `https://morocco-quest.com/...` | Low | Console (local) | **Fixed:** `asset()` |
| R6 | Only 4 Bootstrap Icons glyphs are used, but the full 130 KB font loads on every page | Medium (perf) | Code scan of classes and CSS `content` codepoints | **Fixed:** subset font (680 B woff2), glyph outlines verified identical, pixel check of the mobile menu and WhatsApp button |
| R7 | 20+ inner-page heroes are `data-bg-src` backgrounds that JS applies after deferred scripts | Medium (perf/UX) | Code | **Fixed:** the same background also set inline on 25 views (no visual change; `[data-bg-src]` CSS sizes it) |
| R8 | The inner-page LCP element is the **preloader logo**, which had no priority hint (LCP discovery failing) | Medium (perf) | Local Lighthouse LCP element + discovery audit | **Fixed:** `fetchpriority="high"` on the logo; discovery now passes. The preloader is kept (design). |
| R9 | Paginated listings (`/tours?page=2`, `/blog?page=2`, archives) canonicalised to page 1 with page 1's title | Medium (SEO) | Local crawl: duplicate title and canonical | **Fixed:** page 2+ is self-canonical with a "– Page N" title, only when the canonical is the page's own URL (filtered pages untouched) |
| R10 | Sitemap listed 6 hard-coded activity-category slugs | Low | Crawl: 4 × 404 on the scratch data | **Fixed:** DB-driven, only categories with at least one activity |
| R11 | P3-4: no ItemList / TouristDestination on listings; no Service on `/dmc-marrakech` | Low | JSON-LD scan | **Fixed:** ItemList built from the rendered cards (every URL is a visible link; positions continue across pages), TouristDestination on destination pages, Service on the DMC hub. 0 duplicate entities. |
| R12 | Destination breadcrumb skipped the "Destinations" level | Low | JSON-LD | **Fixed** |
| R13 | `tests/Feature/ExampleTest` failed ("no such table: blogs") | Test harness | Suite | **Fixed** root cause (missing `RefreshDatabase`); the assertion is unchanged |
| R14 | Audit claim "`/team-building-marrakech` H1 is a slogan without the keyword" | — | Live H1 = "Team Building Marrakech: Nobody Remembers…" | **False positive** in the 2026-09-28 audit; no change needed |
| R15 | Gravatar `d=404` requests show as console 404s on blog posts with comments | Info | Console | **Intentional:** 404 triggers the initials fallback. Not changed. |
| R16 | Local `.env` sets `CACHE_DRIVER` (Laravel ≤10 name); Laravel 12 reads `CACHE_STORE`, so the cache silently defaults to the **database** store | Info (deploy) | `config/cache.php` | Documented. Check production `.env`, so that `cache:clear` clears the store actually used. |
| R17 | `storage/framework/cache/facade-*.php` is committed to git, so every `cache:clear` shows it as deleted | Info | `git status` | Documented. Recommend untracking it (not done: it would touch unrelated history). |

## 4. Still open (not safely fixable without decisions or data)

| Item | Severity | Why it's open | Next action |
|---|---|---|---|
| P0-5 GA4 measurement ID | High | `G-QXBGN7DKMB` doesn't exist | Owner supplies the ID (O-1) |
| Font Awesome subsetting (Pro kit; 82 icons in code, about 1–1.4 MB of fonts on inner pages) | Medium (perf) | FA classes may also live in **database content** (posts, overviews) that can't be inspected locally; a subset would turn those into blank boxes | Run the SQL in `OWNER_DECISIONS.md` O-15 on production (read-only), then subset |
| Preloader overlay remains the LCP element on inner pages | Medium (perf) | Removing or shortening it is a design decision | O-16 |
| Real LCP/PSI numbers after these changes | — | Can only be measured on production after deploy (local Lighthouse varies 6–15 s run to run on the dev server) | Post-deploy PSI, median of 3 |
| `%20` type URLs, `/activities` duplicate, day-trip hubs | Medium | URL migrations need approval | O-2, O-3 |
| Content, evidence and product items (prices, awards, DMC proof, tour data) | Medium | Business facts | See `OWNER_DECISIONS.md` |
| Brotli, moving the web root to `public/` | Low | Hosting-level | See `FINAL_DEPLOYMENT_READINESS.md` §E |
