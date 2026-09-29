# SEO audit fix plan and tracker

**Audit:** `docs/reports/SEO_AUDIT_2026-09-28.md` (repo `main` at `8137253`).
**Branch:** `fix/seo-audit-2026`. Local commits only: not pushed, not deployed.
**Last updated:** 2026-09-29 (final pass: see `FINAL_REAUDIT.md` and `FINAL_DEPLOYMENT_READINESS.md`; P1-14, P3-4, pagination canonicals, icon subset and hero/LCP discovery are now done as uncommitted changes).

> **Status legend**
> - ✅ **Fixed + tested locally.** Not live until deployed.
> - 🟡 **Partly fixed** (the fixable part is done).
> - ⛔ **Needs an owner decision or owner-supplied information.**
> - 🖥 **Needs a production or server change.**
> - ⏸ **Deliberately not done.** The reason is given.

## Phase 0: pre-flight findings (inspection before any change)

| Item | Finding |
|---|---|
| Repo state | `main` @ `8137253`, clean except 2 untracked docs (`docs/CHATGPT_SEO_CONTEXT_BRIEF.md`, `docs/reports/SEO_AUDIT_2026-09-28.md`). Both are kept untracked. |
| Stack | Laravel 12.14.1, PHP 8.2 locally (production is 8.3), Filament 3.3, artesaos/seotools 1.3 |
| Local environment | `APP_ENV=local`. SQLite `database/database.sqlite`. File cache and file sessions. Tests use in-memory SQLite and the array mailer. The database is isolated from production. |
| Local mail | `.env` has `MAIL_MAILER=smtp`, so no form was submitted in the browser. Forms were only exercised in tests (array mailer). |
| Scheduled tasks and queues | No scheduler entries. Queue is `sync`. |
| Web root | The repo root is the web root (`index.php` at root, assets in `/assets`), so `public/` is **not** the web root. |
| Pre-existing test failure | `tests/Feature/ExampleTest` fails on `main`: it GETs `/` without `RefreshDatabase` ("no such table: blogs"). It is unrelated and left untouched. |
| Local vs production | These differ in data only. Production has 8 tours, 23 activities, 16 posts and 60 comments; the local DB has almost none. Code-level behaviour was verified locally. Production data checks are listed as owner or deploy steps. |

## Tracker

Severity: P0 (critical) → P4. "Owner?" marks whether the item needs your decision or information.

### P0: security, privacy, availability

| ID | Issue | Root cause | Fix (files) | Status | Owner? |
|---|---|---|---|---|---|
| P0-1 | `.git`, docs, `composer.json`, tooling and PHP scripts downloadable | Web root = repo root, no deny rules | 404 rules at the top of root `.htaccess`. Also `scripts/security/check-exposure.sh`. | ✅ 🖥 | No. Moving the web root to `public/` is a hosting change, documented in `DEPLOYMENT_READINESS.md`. |
| P0-2 | Reflected XSS: `/search?query=`, `/search-bar?place=` | SEOTools prints title/keywords unescaped, and request input was added to the keywords | `EscapedSEOMeta` (escapes title and keywords sitewide), request input removed from keywords, `stringInput()`, double-escaping in the H1 removed | ✅ | No |
| P0-3 | Spam comments published instantly | No approval field | Migration `is_approved` (default false), public queries only show approved comments, honeypot, validation, 5 per 10 min limit, Filament Approve/Pending | ✅ 🖥 | **Yes:** approve the genuine comments after the migration |
| P0-4 | Page cache could store and serve `old()` name/email/phone | Cache bypass only checked `success`/`error` | Bypass on `errors`, `_old_input` and any flashed key | ✅ | No |
| P0-5 | GA4 records no page views | GTM publishes 0 tags, and gtag had `send_page_view:false`. **And `G-QXBGN7DKMB` returns HTTP 404 from Google** (the ID doesn't exist). | Direct gtag with `send_page_view:true`, as the single page-view source | 🟡 ⛔ | **Yes:** the correct measurement ID |
| P0-6 | `/blog/search?query=` → 500 | Undefined `$post` | Uses the page's own meta; non-string queries are handled | ✅ | No |
| P0-7 | `/tours?page≥2` → 500 | Undefined `$query` in the `tours-list` empty branch | Guarded, and out-of-range pages return 404 | ✅ | No |

### P1: technical SEO

| ID | Issue | Fix | Status | Owner? |
|---|---|---|---|---|
| P1-1 | Two robots tags on noindex pages | `SeoHelper::noindex()` → `setRobots()` | ✅ | No |
| P1-2 | Soft 404 on `/tours/type/{x}` and `/activities/type/{x}`; `multi-day-tours` redirected with 302 | Unknown type or past-the-end page → 404. Known but empty type → 200 + noindex. The alias redirect is now 301. | ✅ | No |
| P1-3 | `%20` type URLs (`/tours/type/Garden%20Tours`) in nav and sitemap | Would change indexed URLs; needs a migration plan (slug URLs + 301 from `%20`) | ⏸ ⛔ | **Yes:** approve the URL migration |
| P1-4 | Sitemap: `lastmod=now()`, empty destinations, missing one-day | Real `lastmod` (listings = newest content, static pages = none); empty destinations dropped | 🟡 | `/tours/type/one-day` waits on P1-11 |
| P1-5 | ~100 thin, indexable tag/category archives | Tags noindex,follow; empty archives 404; unique H1s. Categories stay indexable. | ✅ | Term merges (301s) need approval (see P2) |
| P1-6 | Default og:image 404; Twitter tags = homepage on every page; invalid `og:twitter:*`; tour og:image twice; Filament relative `og_image` | `SyncedOpenGraph`, default image changed to `morocco-quest-og.webp`, `ogImage()` resolves storage paths, duplicate removed, homepage escaping fixed | ✅ | `twitter:site @MoroccoQuest`: confirm that handle exists |
| P1-7 | 404 page used the homepage meta and `index,follow` | 404 view sets its own title and noindex | ✅ | No |
| P1-8 | Named bots in robots.txt skipped the `*` Disallows; real admin path not blocked | Rules repeated per group; `/adminPanel/`, `/csrf-refresh` and `/track/` added | ✅ | No |
| P1-9 | llms.txt: `/trips` (404), `/activity-categories` (301), 7 DMC pages missing, false pricing claim | Rewritten from existing facts; `public/` copies synced | ✅ | No |
| P1-10 | `/cookie-policy` had 2 canonicals and 2 og:images | Stray tags printed before `<!DOCTYPE>` removed | ✅ | No |
| P1-11 | `/experiences` vs `/activities` duplicate; 3 day-trip hubs | Needs redirects of established URLs | ⏸ ⛔ | **Yes** |
| P1-12 | Category/ActivityCategory slug regenerated on rename | Slug set only when empty; Filament suggests one only on create; ActivityCategory now tracks slug changes with 301s | ✅ | No |
| P1-13 | Performance | `/dmc-marrakech` hero preload + inline background; lazy tour map iframe | 🟡 | FontAwesome/bootstrap-icons subsetting, the preloader and Brotli are pending (see below) |
| P1-14 | Console JS errors (`isInViewport`, `#360-enquiry`, SVG height) | Not done this pass (needs a `main.js` rebuild and QA) | ⏸ | No |

### P2: content and cannibalization

| ID | Issue | Status | Owner? |
|---|---|---|---|
| P2-1 | Schema prices vs "Price On Request" | ✅ Prices removed from the schema until they're shown on the page | **Yes:** decide whether to display "From" prices, and the currency (USD vs EUR) |
| P2-2 | Placeholder highlights on 23 activity pages | ✅ Removed (there's no highlights field) | Optional: add a real highlights field |
| P2-3 | Awards that contradict each other; empty testimonials section | ⛔ | **Yes:** proof, or permission to remove the claims |
| P2-4 | Destination pages: shared H1 and false intro | ✅ Own H1, accurate intro, local activity links | No |
| P2-5 | `/experiences` intro lists unsold experiences; multi-day "3, 5 & 7 day" promise | ⛔ | **Yes:** confirm the real offer |
| P2-6 | Tour data errors: 8-day itinerary, Dades/Merzouga, "airporot" | ⛔ Production data (Filament) | **Yes:** edit in Filament |
| P2-7 | Incentive post has 14 H1s | ✅ In-body H1s rendered as H2 | The incentive blog → service page link is a content edit |
| P2-8 | DMC trust signals (licence, clients, memberships) | ⛔ | **Yes:** evidence |
| P2-9 / P2-10 | New products and guides (Sahara 2–3-day, Aït Benhaddou, Agafay, "things to do") | ⛔ | **Yes:** only if they are real products |
| P2-11 | Atlas Gardens duplicate activities | ⛔ A merge would need a 301 | **Yes** |

### P3: schema, links, local

| ID | Issue | Status |
|---|---|---|
| P3-1 | 31 invalid nodes (`offers` on TouristAttraction, `duration` on TouristTrip) | ✅ Activities are now TouristTrip with image and provider; tours have an itinerary and no duration |
| P3-2 | SearchAction `?q=`; BlogPosting image/publisher/headline; breadcrumb label; entity leaks | ✅ |
| P3-3 | TravelAgency: street, postcode, email, foundingDate, hasMap | ✅ `alternateName` "Morocco Quest DMC" is ⛔ a brand decision |
| P3-4 | ItemList / TouristDestination / Service on `/dmc-marrakech` | ⏸ Next pass |
| P3-5 | Nav hubs; Info Hub `#`; REPLY `javascript:` | ✅ The "author `#`" item doesn't reproduce live |
| P3-6 | Activity → category/destination links; destination → activities | ✅ Blog → product links are content edits (⛔ Filament) |
| P3-7 / P3-8 | Google Business Profile, TripAdvisor | ⛔ Owner accounts |

### P4

The FR pilot, authority building and marketplaces are all ⛔ owner decisions. No code was changed for them.

## Dependencies
- P0-5 needs the owner's GA4 ID before it can be verified.
- P1-4 (one-day in the sitemap) depends on P1-11 (the day-trip hub decision).
- P1-3 must happen before any sitemap or nav change to type URLs.
- P0-3 needs `php artisan migrate` on production, then comment approval.
- All docs under `docs/` are web-readable until P0-1 is deployed. Deploy P0-1 **before or together with** anything that adds docs.

## Rollback
See `ROLLBACK_PLAN.md`. Each fix is its own commit and can be reverted with `git revert <sha>`.
