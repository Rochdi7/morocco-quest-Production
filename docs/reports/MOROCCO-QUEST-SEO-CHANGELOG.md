# Morocco Quest — SEO Implementation Changelog
**Branch:** `seo-fixes-july-2026`
**Period covered:** June 7 – July 8, 2026
**Stack:** Laravel 10 / Blade / artesaos/seotools / Filament v3

---

## Rollback Notes

All changes are Blade template and controller edits — no database migrations required.
To rollback: `git checkout main` from the `seo-fixes-july-2026` branch, or `git revert d10c636`.
No schema migrations were written. No Filament resources were modified. Admin panel is unaffected.

---

## Commit 1 — `e1c8f1a` — June 7 docs: add June 2026 client SEO report
- **File:** `docs/reports/CLIENT_REPORT_JUNE_2026.md` (new file)
- **What:** Client-facing summary of the full June SEO pass
- **Affects:** Static documentation only. No page rendering change.

---

## Commit 2 — `d10c636` — July 8 seo: July 2026 SEO fixes pass

### 2.1 `app/Http/Controllers/SitemapController.php`

| Item | Before | After |
|------|--------|-------|
| Static pages | 9 entries | 14 entries |
| Dynamic models | Tour, Activity, Post, Blog | + Trip, Place |
| Missing routes | — | `tours.multi_day`, `tours.one_day`, `destinations.index`, `activity-categories.index`, `terms.conditions`, `privacy.policy` |
| Imports | No Trip or Place | Added `use App\Models\Trip`, `use App\Models\Place` |
| New helper | — | `addPlacePages()` — chunks Place slugs → `tours.byPlace` URLs |

**Why:** Sitemap was missing ~50+ trip detail pages, all destination-specific tour pages, and 5 static hub pages. Google cannot efficiently crawl what isn't submitted.

**Affects:** Dynamic pages (trips, place-filtered tours). No visual change.

**Rollback:** Revert the controller to the previous import list and `$urls` array.

**Migration commands:** None.

---

### 2.2 `resources/views/activity-detail.blade.php`

| Item | Before | After |
|------|--------|-------|
| BreadcrumbList schema | Missing | Added via `@push('jsonld')` |
| Schema positions | Home → Activity | Home → Activities hub → Activity detail |

**Why:** Activity detail was the only detail page without BreadcrumbList schema. Every other detail page (tour, trip, blog post, destination) already had it.

**Affects:** Dynamic pages (individual activity pages). No visual change.

**Rollback:** Remove the second `<script type="application/ld+json">` block from the `@push('jsonld')` section.

---

### 2.3 `resources/views/contact.blade.php`

| Item | Before | After |
|------|--------|-------|
| Schema delivery | `@section('structured_data')` — **not rendered** by `app2.blade.php` (no `@yield('structured_data')` exists) | Migrated to `@push('jsonld')` — correctly injected into `@stack('jsonld')` in head |
| BreadcrumbList | Missing | Added: Home → Contact |
| OG image | Set inside the dead `@section` block | Moved to `@section('og_image')` which is yielded by the layout |
| Duplicate meta tags | OG/Twitter tags in `@section` that never rendered | Removed — layout already generates these from `$metaTitle`/`$metaDescription` |

**Why:** The contact page had a `@section('structured_data')` block that `app2.blade.php` never yields. The TravelAgency + ContactPage schema was silently dropped on every page load. This also means contact had zero structured data in the `<head>`.

**Affects:** Static page (`/contact`). No visual change. Schema now actually appears in source.

**Rollback:** Revert entire contact.blade.php to prior version. Note: the bug (schema not rendering) will return.

---

### 2.4 `resources/views/home.blade.php`

| Item | Before | After |
|------|--------|-------|
| Heading count | ~24 (`<h1>` × 1, `<h2>` × 7, `<h3>` × 1, `<h5>` × 7, `<h6>` × 3) | ~20 (`<h2>` reduced by 4) |
| Modal popup headings | 4× `<h2 style="color: black;">` inside `.mfp-hide` modals | 4× `<p class="popup-heading">` |
| Visual appearance | Black bold heading in modal | Identical — `.popup-heading { color:#000; font-size:1.5rem; font-weight:700 }` |
| CSS added | — | One inline `<style>` rule before the modals |

**Why:** The 4 `<h2>` tags in hidden modal popups inflated the heading count. Google's guidelines recommend heading counts proportional to body text. These popup headings don't contribute to the page's semantic outline since they appear in `display:none` containers.

**Affects:** Static page (`/`). Visually identical — popup modals still render the same bold title.

**Rollback:** Change `<p class="popup-heading">` back to `<h2 style="color: black;">` on 4 lines.

---

### 2.5 `resources/views/partials/footer.blade.php`

| Item | Before | After |
|------|--------|-------|
| Useful Links rel attribute | `rel="noopener noreferrer"` | `rel="noopener noreferrer nofollow"` |
| Links affected | 10 third-party utility links | All 10 |
| Social links (Facebook, X, Instagram) | `rel="noopener noreferrer"` | Unchanged (social profiles are brand-owned) |

**Links with nofollow added:**
1. https://www.acces-maroc.ma — Morocco e-Visa
2. https://visaguide.world/africa/morocco-visa/ — Visa Requirements
3. https://www.xe.com/currencyconverter/ — Currency Converter
4. https://www.accuweather.com — Weather Forecast
5. https://www.thebrokebackpacker.com — Packing Guide
6. https://www.travelinsurance.com/ — Travel Insurance
7. https://www.iatatravelcentre.com — COVID-19 Info
8. https://www.who.int/countries/mar/ — Travel Health
9. https://www.intrepidtravel.com — Travel Tips
10. https://www.power-plugs-sockets.com/morocco/ — Electrical Plugs

**Why:** These are utility links to third-party tools, not editorial endorsements. Passing PageRank to them dilutes the site's link equity budget. `nofollow` tells Google not to follow these links for ranking purposes while still showing them to users.

**Affects:** All pages (shared partial). No visual change.

**Rollback:** Remove `nofollow` from the 10 `rel` attributes.

---

### 2.6 `resources/views/trips-details.blade.php`

| Item | Before | After |
|------|--------|-------|
| TouristTrip schema | Had `name`, `description`, `url`, `provider`, `image`, `itinerary` | + conditional `offers` block |
| Offers condition | — | Only emitted when `$trip->price_adult` is not empty |
| Offer fields | — | `@type: Offer`, `price`, `priceCurrency: USD`, `availability: InStock`, `url` |

**Why:** The June pass added `Offer` schema to `tour-detail` and `activity-detail` pages, but `trips-details` was missed. Consistent Offer coverage enables Google to surface pricing in rich results.

**Affects:** Dynamic pages (individual trip detail pages where price is set). No visual change.

**Rollback:** Remove the `@if(!empty($trip->price_adult))...@endif` offers block from the TouristTrip JSON-LD.

---

## What Was NOT Changed (Out of Scope)

| Item | Reason |
|------|--------|
| `aggregateRating` on TravelAgency | Requires real verified review count — Google penalises fake ratings |
| Backlink campaign | External marketing, not a code task |
| Image WebP srcsets | Requires image processing pipeline — out of scope |
| Cloudflare caching | Server infrastructure, not code |
| Test suite SQLite migration | Pre-existing issue; `blogs` table not created in in-memory SQLite test DB — unrelated to SEO work |
| Filament CRUD resources | No new fields were added; existing admin panel untouched |
| Database migrations | No schema changes were made |

---

## Artisan Commands Run

```bash
php artisan config:clear   # ✅ Configuration cache cleared
php artisan cache:clear    # ✅ Application cache cleared
php artisan view:clear     # ✅ Compiled views cleared
php artisan route:list     # ✅ 84 routes, no errors
php artisan test           # ✅ Unit tests: 1 passed
                           # ⚠️  Feature test: 1 failed (pre-existing: SQLite missing blogs table)
```

---

*Generated: 2026-07-08 | Branch: seo-fixes-july-2026*
