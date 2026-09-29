# Final deployment readiness

**Date:** 2026-09-29. **Branch:** `fix/seo-audit-2026`.
- 27 commits + this pass's **uncommitted** changes (37 modified and 6 new files; commits not yet authorized).
- `main` is untouched at `8137253`.
- **Production has not been modified in any way.**

> A locally fixed issue is not a production-resolved issue. Nothing below is live until you commit, merge and deploy.
> **Sensitive:** `docs/` is web-readable on production until the `.htaccess` fix is deployed. Deploy that fix before or together with any docs.

## A. Fixed and verified locally

| Issue | Files | Evidence |
|---|---|---|
| P0-1 repo internals downloadable | `.htaccess`, `scripts/security/check-exposure.sh` | Exposure script PASS on local Apache (46 blocked, 12 public OK) |
| P0-2 reflected XSS (`/search`, `/search-bar`) | `app/Support/EscapedSEOMeta.php`, `AppServiceProvider`, search controllers, `Controller::stringInput` | 3 tests (malicious + legitimate input, arrays) |
| P0-3 spam comments | migration `2026_09_28_000001`, `Comment`, `Blog`, `CommentController`, `BlogController`, Filament, honeypot partial, routes | 8 tests (moderation, honeypot, self-approve, rate limit, replies) |
| P0-4 cache leaking form data | `CacheGuestPage` | 3 tests incl. two-visitor simulation |
| P0-6 `/blog/search` 500 | `BlogController` | 2 tests |
| P0-7 `/tours?page=N` 500 | `TourController`, `tours-list` | 2 tests |
| P1-1 duplicate robots / P1-2 soft 404 / P1-7 404 meta | `SeoHelper`, Tour/Activity controllers, `errors/404` | P1 tests |
| P1-4 sitemap (lastmod, empty places, DB activity categories) | `SitemapController`, sitemap view | P1 + final tests |
| P1-5 thin archives | Tag/Category controllers, `blog` view | P1 tests |
| P1-6 OG/Twitter | `SyncedOpenGraph`, `config/seotools.php`, layouts | 4 data-provider tests + local crawl (0 og:twitter, 0 missing og images) |
| P1-8/9 robots.txt, llms.txt | `robots.txt`, `llms.txt` (+ `public/` copies) | robotparser check; all llms links 200 |
| P1-10 cookie-policy duplicate tags | `cookie-policy` view | Test |
| P1-12 slug stability | Category/ActivityCategory models, Filament resources | 3 tests |
| P1-14 JS console errors (FAQ counters stuck at 0, 360 selector, SVG attribute, missing placeholder images, hard-coded asset domain) | `assets/js/main.js` + `main.min.js`, `360-event-solutions`, `dmc-world-map`, 6 views, `type-filter` | Selenium sweep of 22 page types × desktop/mobile: **0 errors** (only the intentional Gravatar 404) |
| Pagination canonicals | `SeoHelper::paginated`, Tag/Category controllers | Test + crawl |
| Schema: 31 invalid nodes, SearchAction, BlogPosting, TravelAgency, **ItemList, TouristDestination, Service** | tour/activity/blog views, layouts, listing views, `partials/schema-itemlist`, `dmc-marrakech` | 6 schema tests + JSON-LD parse on 13 pages: 0 errors, 0 duplicate entities, ItemList URLs all visible |
| Internal links, nav, placeholder text, extra H1s | header partials, `tours-list`, `activity-detail`, `blog-details` | 5 tests + Selenium nav check (desktop dropdown, mobile expand) |
| Bootstrap Icons subset (130 KB → 0.7 KB) | `assets/plugins/bootstrap-icons/*subset*`, layouts | Glyph outlines identical (fontTools); pixel check of mobile menu (`/tours` identical); WhatsApp icon renders |
| `ExampleTest` harness | `tests/Feature/ExampleTest.php` | Suite: **56 passed, 0 failed** |

## B. Fixed but not fully verified
- **P0-5 GA4:** the code sends page views, but the configured ID `G-QXBGN7DKMB` does not exist (Google returns 404). It is unverifiable until the owner supplies the correct ID.
- **LCP/performance:**
  - `/dmc-marrakech` hero is preloaded (local discovery fail → pass, load delay 397 → 26 ms).
  - Inner-page heroes are inline.
  - Preloader logo has `fetchpriority=high` (discovery passes).
  - Tour map is lazy-loaded.
  - Bootstrap Icons −130 KB.
  - **Real PSI/LCP gains can only be measured on production.** Local Lighthouse totals vary 6–15 s run to run on the dev server and are not comparable. Production baseline (PSI mobile, median of 3, 2026-09-28): `/` 82, `/tours` 86, `/dmc-marrakech` **66 (LCP 11.97 s)**, tour 83, blog 85.
- **Exposure fix on the real host:** proven on a local Apache with the same `.htaccess`. Confirm on production with the script after deploy.

## C. Still unresolved (technical)

| Issue | Severity | Root cause | Next action |
|---|---|---|---|
| Font Awesome Pro fonts (about 1–1.4 MB per inner page) | Medium (perf) | Icons might also be used inside DB content that can't be checked locally | Owner runs the O-15 query; if 0, subset like Bootstrap Icons |
| Preloader overlay is the LCP element | Medium (perf) | Design choice | O-16; test variants with PSI |
| No Brotli (gzip only) | Low | Hosting | Enable in cPanel if available |
| `storage/framework/cache/facade-*.php` is tracked in git | Low | Committed by mistake earlier | `git rm --cached` it in a separate housekeeping commit |
| Local `.env` uses `CACHE_DRIVER` (Laravel 12 reads `CACHE_STORE`) | Info | Old key name | Check production `.env`; see §E |

## D. Owner decisions
See `OWNER_DECISIONS.md` (O-1 … O-18). **Before deploying, at minimum:**
- **O-14:** confirm the FAQ counters (1,100 / 150 / 4 / 8), which become visible with this deploy.
- **O-1:** the GA4 ID. It can also follow in a later deploy.

## E. Database and infrastructure

| Item | Required? | Risk | Rollback |
|---|---|---|---|
| Migration `2026_09_28_000001_add_is_approved_to_comments_table` (adds `comments.is_approved` bool default false + index) | **Yes** | Low: additive column. **All existing comments become hidden until approved in Filament** (about 8 genuine among about 60). | `php artisan migrate:rollback --step=1` (re-exposes all comments, spam included) |
| Cache clear after deploy | Yes | None. Clears the 6-hour page cache so new HTML is served. Check which store is live: Laravel 12 uses `CACHE_STORE` (default `database`), and older `.env` files set `CACHE_DRIVER`. | — |
| `.htaccess` | Applies with `git pull` | Low. Blocks only private paths; public assets verified. If any legitimate URL 404s, remove the matching line. | Revert commit `530b923` |
| Web root → `public/` | Optional, later | Medium: assets live at the repo root and would need moving or symlinking. Staging first. | Point the web root back |
| New env vars | None | — | — |

## F. SEO and performance summary
- **Indexing changes this deploy brings:**
  - 67 tag pages become noindex,follow.
  - Empty archives, unknown type pages and out-of-range pages return 404.
  - Pages 2+ of listings become self-canonical with "– Page N" titles.
  - The sitemap gains real lastmod values, drops empty destinations and lists DB-backed activity categories.
  - 8 destination pages get their own H1.
- **Kept as they are:**
  - **no URL was renamed**
  - main CSS still synchronous
  - GSAP
  - preloader design
  - forms
- **Measurement limits:**
  - no Search Console access (the service account only sees another property)
  - no CrUX field data (low traffic)
  - the lab numbers above are production baselines, not post-fix results

## G. Deployment checklist (for the owner; not executed here)

**Before:**
1. Resolve **O-14** (FAQ counters). Ideally also O-1 (GA4 ID).
2. Review the diff. Commit this pass's working-tree changes on `fix/seo-audit-2026` (explicit approval required).
3. Take backups:
   - database export (cPanel → phpMyAdmin/Backup)
   - `git rev-parse HEAD > ~/pre-seo-fix-commit.txt` on the server
4. Merge `fix/seo-audit-2026` into `main` locally, run `php artisan test` (expect 56 passing), then push.

**Deploy** (server, in order):
```bash
cd <site root>            # repo root is the web root on this host
git pull
php artisan migrate --force       # comments.is_approved only
php artisan cache:clear           # page cache (check CACHE_STORE in .env)
php artisan view:clear
php artisan optimize
```
5. Visit `/` once to warm the page cache.

**After:**
6. `bash scripts/security/check-exposure.sh https://morocco-quest.com` → **PASS**
7. `/search?query=%22%3E%3Cb%3Ex%3C%2Fb%3E`: no raw `<b>x</b>` in the source.
8. `/blog/search?query=sahara` → 200. `/tours?page=2` → 200 if there are more than 8 tours, else 404 (never 500).
9. `/tours/type/nonexistent` → 404. `/faq`: counters show numbers.
10. Filament → Comments → Pending: approve the genuine comments, then delete the spam.
11. View the source of `/about`: one robots tag, `twitter:title` = `<title>`, no `og:twitter:`.
12. `/sitemap.xml`, `/robots.txt`, `/llms.txt` load with the new content.
13. Rich Results Test on one tour, one activity, one blog post and `/tours`: no errors.
14. Check the mobile menu icons and the WhatsApp button, since Bootstrap Icons is now a subset.
15. PageSpeed mobile, median of 3, on `/`, `/tours`, `/dmc-marrakech`, one tour and one post. Compare with §B.
16. GA4 Realtime `page_view`, once O-1 is done.
17. Resubmit the sitemap in GSC and Bing.

**Rollback:** `git checkout "$(cat ~/pre-seo-fix-commit.txt)"`, optionally `php artisan migrate:rollback --step=1`, then clear caches (details in `ROLLBACK_PLAN.md`).
