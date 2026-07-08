# Morocco Quest — Safe SEO Cleanup Changelog
**Branch:** `safe-seo-cleanup-july-2026`
**Date:** 2026-07-08
**Based on:** Production audit + MOROCCO-QUEST-PRODUCTION-AUDIT-JULY-2026.md

---

## Safety Guarantees

| Constraint | Status |
|-----------|--------|
| Design changed | ❌ No design changes |
| Layout changed | ❌ No layout changes |
| Itineraries changed | ❌ Zero itinerary content touched |
| Database records deleted | ❌ No records deleted |
| WordPress tables touched | ❌ Skipped completely |
| Filament admin behavior changed | ❌ No Filament changes |
| Booking/contact logic changed | ❌ Not touched |
| Production routes broken | ❌ All routes preserved |
| Fake data added | ❌ None |

---

## Phase 0 — Branch

New branch: `safe-seo-cleanup-july-2026` (from `main`)

---

## Phase 1 — Trips Feature Disabled Safely

**Problem:** `/trips` was live and indexed with 0 trip records — a blank paginated page wasting crawl budget.

**Solution chosen:** Option A — 301 redirect when empty.

### `app/Http/Controllers/TripController.php`

```php
// Before
public function index(): View
{
    $query = Trip::query();
    ...
    return view('trips', ...);
}

// After
public function index(): \Illuminate\Http\RedirectResponse|View
{
    if (Trip::count() === 0) {
        return redirect()->route('tours.index', [], 301);
    }
    ...
    return view('trips', ...);
}
```

**Effect:** `/trips` now 301 redirects to `/tours` until real trip records are added. The redirect is permanent so Google transfers link equity to `/tours`. The moment a trip is added in Filament, the page works normally — no code change needed.

### `app/Http/Controllers/SitemapController.php`

Removed from static URL list:
- `route('trips.index')` — was priority 0.9, daily

Removed from model loop:
- `Trip::class` → `trips.show` — had 0 records, generated no URLs but was noisy

Also removed:
- `Post::class` → `blog.show` — duplicate of `Blog::class`, both pointing to `blog.show`. `Post` model defaults to `posts` table which may not exist or may be empty. `Blog::class` is the correct model.
- `route('tours.one_day')` — removed from static list since there are no one-day tours in the DB (all 8 tours are multi-day)

Removed unused imports: `Trip`, `Post`

### Views updated (4 internal links redirected from `trips.index` to `tours.multi_day`)

| File | Before | After |
|------|--------|-------|
| `resources/views/blog-details.blade.php:175` | `route('trips.index')` | `route('tours.multi_day')` |
| `resources/views/activity-categories.blade.php:64` | `route('trips.index')` | `route('tours.multi_day')` |
| `resources/views/dmc-marrakech.blade.php:596` | `route('trips.index')` | `route('tours.multi_day')` |
| `resources/views/tours-list.blade.php:64` | `route('trips.index')` | `route('tours.multi_day')` |

---

## Phase 2 — tour_type Data Fix (Server-side via Tinker)

**Problem:** Tours 6 and 7 had empty `tour_type` — invisible on type-filter pages.

**This is a data fix, not a code fix. Run on the server:**

```bash
php artisan tinker << 'EOF'
// First verify current state
$tours = DB::table('tours')->whereIn('id', [6, 7])->select('id', 'title', 'slug', 'tour_type')->get();
foreach($tours as $t) { echo $t->id . ' | ' . $t->tour_type . ' | ' . $t->slug . PHP_EOL; }

// Tour 6: Royal Cities of Morocco — 6-Day Luxury Imperial
DB::table('tours')->where('id', 6)->update(['tour_type' => 'Classical Tours, Cultural Tour']);

// Tour 7: 9-Day Andalusian Morocco Rail Tour
DB::table('tours')->where('id', 7)->update(['tour_type' => 'Classical Tours, Cultural Tour']);

// Verify after
$tours = DB::table('tours')->select('id', 'title', 'slug', 'tour_type')->get();
foreach($tours as $t) { echo $t->id . ' | ' . $t->tour_type . ' | ' . substr($t->title, 0, 40) . PHP_EOL; }
EOF
```

**Why these types:**
- Tour 6 (Royal Cities): Imperial cities of Fes, Meknes, Rabat, Casablanca — Classical Tours + Cultural Tour
- Tour 7 (Andalusian Rail): Heritage rail journey from Tangier — Classical Tours + Cultural Tour

---

## Phase 3 — showMultiDay() Filter Fixed

**Problem:** `showMultiDay()` fetched ALL tours with no filter — it would show one-day activities on the multi-day tours page.

**Before:**
```php
$tours = Tour::with(['firstImage', 'places'])->paginate(12);
```

**After:**
```php
$multiDayTypes = ['Classical Tours', 'Cultural Tour', 'Garden Tour', 'Art Tour', 'Adventure Tours'];
$tours = Tour::where(function ($q) use ($multiDayTypes) {
        foreach ($multiDayTypes as $type) {
            $q->orWhere('tour_type', 'LIKE', "%{$type}%");
        }
    })
    ->orWhereRaw('CAST(duration_days AS UNSIGNED) > 1')
    ->with(['firstImage', 'places'])
    ->paginate(12);
```

The `duration_days > 1` fallback ensures tours 6 & 7 (empty type, 6 and 9 days) still appear until the data fix (Phase 2) is run.

**showOneDay() — noindex when empty:**

```php
if ($tours->isEmpty() && $activities->isEmpty()) {
    SeoHelper::noindex();
}
```

If no one-day tours exist (currently true — all 8 tours are multi-day), the page gets `noindex,follow` automatically. When one-day tours are added, this resolves on its own.

---

## Phase 4 — OG Fallback Image Path Updated

**Updated constant in `app/Support/SeoHelper.php`:**

```php
// Before
const FALLBACK_OG_IMAGE = 'assets/img/placeholder-image.webp';

// After
const FALLBACK_OG_IMAGE = 'assets/img/morocco-quest-og.webp';
```

**⚠️ MANUAL ACTION REQUIRED:**

Upload a branded 1200×630 image to:
```
public/assets/img/morocco-quest-og.webp
```

Specifications:
- Size: exactly 1200 × 630 pixels
- Format: WebP (or rename constant to `.jpg` if uploading JPEG)
- Content: Morocco Quest logo + desert/atlas/medina background
- File size: ideally under 200KB

Until this image is uploaded, the fallback will return a broken OG image URL. The old `placeholder-image.webp` (3KB) is still on disk at the old path.

**Temporary workaround:** If you cannot create the image immediately, revert the constant to `placeholder-image.webp` until ready.

---

## Phase 5 — robots.txt Created

**New file:** `public/robots.txt`

```text
User-agent: *
Allow: /

Disallow: /adminPanel/
Disallow: /login
Disallow: /register
Disallow: /password/
Disallow: /search
Disallow: /search-bar

User-agent: GPTBot
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: PerplexityBot
Allow: /

User-agent: Google-Extended
Allow: /

Sitemap: https://morocco-quest.com/sitemap.xml
```

**Effect:** Google and AI crawlers now have explicit crawl directives. Admin panel, login, and search result pages are blocked. AI crawlers (GPTBot, ClaudeBot, PerplexityBot, Google-Extended) are explicitly allowed for GEO/AEO visibility.

---

## Phase 6 — Search Pages Noindexed

**SearchController** (`/search`) and **SearchBarController** (`/search-bar`) now get:
- `SeoHelper::noindex()` → `<meta name="robots" content="noindex,follow">`
- Canonical → `route('home')` (was pointing to the filter URL itself)

```php
// Added to both controllers before SEOMeta::setTitle(...)
SeoHelper::noindex();

SEOMeta::setTitle($title)
    ->setDescription(Str::limit($description, 160))
    ->setCanonical(route('home'))  // was: $url (the filter URL)
    ->addKeyword($keywordArray);
```

---

## Phase 7 — Twitter Cards Added to All Pages

**`app/Support/SeoHelper.php`** — both `setCollection()` and `setDetail()` now emit Twitter card tags:

```php
OpenGraph::addProperty('twitter:card', 'summary_large_image');
OpenGraph::addProperty('twitter:title', $title);
OpenGraph::addProperty('twitter:description', $description);
OpenGraph::addProperty('twitter:image', $safeImage);
```

**Effect:** Every listing page and every detail page now has Twitter card meta. Previously only 3 pages (homepage, trip detail, activity detail) had these tags.

---

## Phase 8 — Cookie Policy (No Change Needed)

`/cookie-policy` was already present in the footer alongside Privacy Policy and Terms. No change required.

---

## Phase 9 — Content Optimization (Deferred)

AEO/GEO content blocks (quick facts, FAQ per tour, "best for" summaries) are a separate content sprint. They require:
- Decision on which Blade views to modify
- Approval from Mounir on additional copy per tour/activity

Not implemented in this pass — tracked as Sprint C.

---

## Phase 10 — llms.txt Updated

Removed: `/trips` link (no content)
Removed: `/tours/type/one-day` (no one-day tours exist)
Added: Top 5 tours with direct URLs and descriptions
Added: Top 5 activities with direct URLs and descriptions

---

## Files Modified

| File | Change |
|------|--------|
| `app/Http/Controllers/TripController.php` | 301 redirect when trips count = 0 |
| `app/Http/Controllers/TourController.php` | showMultiDay() filter fix; showOneDay() noindex when empty |
| `app/Http/Controllers/SitemapController.php` | Remove trips, Post model, one-day static entry |
| `app/Http/Controllers/SearchController.php` | Add SeoHelper import + noindex + canonical fix |
| `app/Http/Controllers/SearchBarController.php` | Add SeoHelper import + noindex + canonical fix |
| `app/Support/SeoHelper.php` | Twitter cards in setCollection() + setDetail(); OG path updated |
| `public/robots.txt` | **New** — crawl directives for Google + AI crawlers |
| `public/llms.txt` | Updated — removed trips, added top tours + activities |
| `resources/views/blog-details.blade.php` | trips.index → tours.multi_day |
| `resources/views/activity-categories.blade.php` | trips.index → tours.multi_day |
| `resources/views/dmc-marrakech.blade.php` | trips.index → tours.multi_day |
| `resources/views/tours-list.blade.php` | trips.index → tours.multi_day |

---

## Rollback Steps

```bash
git checkout main
# Branch safe-seo-cleanup-july-2026 is preserved and can be re-merged
```

To rollback individual files:
```bash
git checkout main -- app/Http/Controllers/TripController.php
git checkout main -- app/Http/Controllers/SitemapController.php
git checkout main -- app/Support/SeoHelper.php
git rm public/robots.txt
```

---

## Manual Actions Required (Not in Code)

| # | Action | Priority |
|---|--------|----------|
| M1 | Upload branded 1200×630 OG image to `public/assets/img/morocco-quest-og.webp` | **High** — do before deploy |
| M2 | Run tinker command to fix tour_type on tours 6 & 7 | High |
| M3 | Merge `safe-seo-cleanup-july-2026` into `main` on server | High |
| M4 | Submit `https://morocco-quest.com/sitemap.xml` to Google Search Console | Medium |
| M5 | Verify `https://morocco-quest.com/robots.txt` is accessible | Medium |

---

## Remaining Issues (Not in This Sprint)

| Issue | Sprint |
|-------|--------|
| Filament `seo_title` / `meta_description` fields | Sprint B (migration required) |
| AEO content blocks per tour/activity | Sprint C (content approval needed) |
| `aggregateRating` schema | Sprint C (needs verified reviews) |
| Google Business Profile claim | Manual |
| WordPress `qqv_*` table cleanup | Skipped per instructions |
| Pagination `rel=prev/next` | Sprint B |

---

*Morocco Quest Safe SEO Cleanup Changelog | 2026-07-08 | Branch: safe-seo-cleanup-july-2026*
