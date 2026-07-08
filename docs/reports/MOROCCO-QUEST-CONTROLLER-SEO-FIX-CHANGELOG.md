# Morocco Quest — Controller SEO Fix Changelog
**Branch:** `seo-fixes-july-2026`
**Date:** 2026-07-08
**Based on audit:** `MOROCCO-QUEST-CONTROLLERS-SEO-AUDIT.md`
**Artisan validation:** route:list ✅ (84 routes) | Unit tests ✅ (1/1) | Feature test ⚠️ pre-existing SQLite issue

---

## New File: `app/Support/SeoHelper.php`

**Purpose:** Single source of truth for OG image fallback, `CollectionPage` wiring, `TouristTrip` wiring, and `noindex` injection. Eliminates ~60 lines of copy-pasted SEO boilerplate across 4 controllers.

| Method | What it does |
|--------|-------------|
| `SeoHelper::ogImage(?string $imageUrl): string` | Returns the URL as-is if non-empty, otherwise returns `asset('assets/img/placeholder-image.webp')`. Never returns null. |
| `SeoHelper::setCollection(...)` | Calls SEOMeta + OpenGraph + JsonLd with `CollectionPage` type. Used on all listing pages. |
| `SeoHelper::setDetail(...)` | Calls SEOMeta + OpenGraph + JsonLd with `TouristTrip` (or overridden type). Used on detail pages. |
| `SeoHelper::noindex()` | Adds `<meta name="robots" content="noindex,follow">` via SEOMeta. Used on filter/search result URLs. |

**Fallback image:** `public/assets/img/placeholder-image.webp` (confirmed present on disk).

---

## Fix 1 — Schema types corrected (8 listing pages)

### Before / After — schema type per method

| Controller | Method | Before | After |
|-----------|--------|--------|-------|
| ActivityController | `listCategories` | `CollectionPage` ✅ | `CollectionPage` ✅ (unchanged) |
| ActivityController | `showByCategory` | `TouristTrip` ❌ | `CollectionPage` ✅ |
| ActivityController | `index` | `TouristTrip` ❌ | `CollectionPage` ✅ |
| ActivityController | `showByType` | `TouristTrip` ❌ | `CollectionPage` ✅ |
| ActivityController | `show` | `TouristTrip` ❌ | `TouristAttraction` ✅ (matches view schema) |
| TourController | `listPlaces` | `CollectionPage` ✅ | `CollectionPage` ✅ (unchanged) |
| TourController | `index` | *(no type set)* ❌ | `CollectionPage` ✅ |
| TourController | `show` | `TouristTrip` ✅ | `TouristTrip` ✅ (unchanged) |
| TourController | `byPlace` | `TouristTrip` ❌ | `CollectionPage` ✅ |
| TourController | `showMultiDay` | `TouristTrip` ❌ | `CollectionPage` ✅ |
| TourController | `showOneDay` | `TouristTrip` ❌ | `CollectionPage` ✅ |
| TourController | `showByType` | `TouristTrip` ❌ | `CollectionPage` ✅ |
| TripController | `index` | `CollectionPage` ✅ | `CollectionPage` ✅ (unchanged) |
| TripController | `show` | `TouristTrip` ✅ | `TouristTrip` ✅ (unchanged) |

**Note on `ActivityController::show`:** The Blade view `activity-detail.blade.php` already emits a rich `TouristAttraction` schema via `@push('jsonld')`. The controller's artesaos JsonLd type is now aligned to `TouristAttraction` so both blocks agree. The view-level schema (with Offer, BreadcrumbList) is the richer one and continues to render via `@stack('jsonld')`.

---

## Fix 2 — Canonical duplicate URLs

### ActivityController — `?category=slug` filter

**Before:** `index(?category=hiking)` set canonical to `url()->current()` → `activities?category=hiking`. This created a duplicate of `activities/category/hiking` (handled by `showByCategory`).

**After:** When `?category=slug` is present and the category resolves, canonical is redirected to `route('activities.byCategory', $category->slug)` and `noindex,follow` is added. The filter still works visually for users; Google is told the clean URL is authoritative.

```php
// ActivityController::index() — new logic
if ($categorySlug && $category) {
    $canonical = route('activities.byCategory', $category->slug);
    SeoHelper::noindex();
} else {
    $canonical = url()->current();
}
```

### TourController — `?place=`, `?searchDate=`, `?guests=` filters

**Before:** All three query params generated indexable pages with `url()->current()` canonical → thin-content duplicates.

**After:**
- `?searchDate=` or `?guests=` → canonical set to `route('tours.index')` + `noindex,follow`
- `?place=MarrakechName` → canonical set to clean `route('tours.byPlace', $place->slug)` if slug resolves, otherwise `tours.index`; + `noindex,follow`
- Clean listing `/tours` (no params) → canonical unchanged, indexable ✅
- Clean place listing `/tours/place/{slug}` → canonical unchanged, indexable ✅

```php
// TourController::index() — new logic
if ($isFiltered) {
    $canonical = route('tours.index');
    SeoHelper::noindex();
} elseif ($hasPlace) {
    $place     = Place::where('name', $placeName)->whereNotNull('slug')->first();
    $canonical = $place ? route('tours.byPlace', $place->slug) : route('tours.index');
    SeoHelper::noindex();
} else {
    $canonical = url()->current();
}
```

### BlogController — search results

**Before:** `/blog/search?query=sahara` was indexable, no noindex.

**After:** Canonical points to `route('blog.index')` + `noindex,follow`. Search result pages never rank as standalone content.

---

## Fix 3 — OG image fallback

**Before:** Multiple controllers called `OpenGraph::addImage($image)` and `JsonLd::addImage($image)` where `$image` could be `null` (when a tour/activity/post has no uploaded image). This emitted an empty `og:image` tag.

**After:** All image resolution goes through `SeoHelper::ogImage()`:
```php
public static function ogImage(?string $imageUrl): string
{
    return $imageUrl ?: asset('assets/img/placeholder-image.webp');
}
```

| Controller | Method | Before | After |
|-----------|--------|--------|-------|
| ActivityController | `show` | `addImage($activity->first_image_url)` — null risk | `addImage(SeoHelper::ogImage($activity->first_image_url))` ✅ |
| TourController | `show` | `addImage($tour->first_image_url)` — null risk | `addImage(SeoHelper::ogImage($tour->first_image_url))` ✅ |
| TripController | `show` | Had fallback to `morocco-quest-social-share.webp` (file doesn't exist on disk) | Now uses `SeoHelper::ogImage()` → `placeholder-image.webp` (confirmed on disk) ✅ |
| BlogController | `show` | `addImage($post->featured_image_url)` — null risk | `addImage(SeoHelper::ogImage($post->featured_image_url))` ✅ |
| All listing pages | all | No OG image at all | `SeoHelper::setCollection(...)` passes `$image` → fallback if null ✅ |
| StaticPageController | all 6 methods | No OG image | `setSeo()` now calls `addImage(SeoHelper::ogImage(null))` → `placeholder-image.webp` ✅ |

---

## Fix 4 — Keyword stuffing reduced

**Before:** Detail pages carried 13–15 hardcoded generic commercial keywords (e.g. `morocco camel tours`, `quad biking marrakech`, `morocco food tour`) on every single activity/tour regardless of actual content.

**After:** Detail pages use 4–5 focused, page-specific keywords:

```php
// ActivityController::show() — before: 13 generic terms
// After: 3 generic + 2 dynamic
$keywordArray = array_filter([
    strtolower($activity->title),
    optional($activity->category)->name ? strtolower(...) : null,
    'morocco activities',
    'morocco day tours',
    'morocco quest',
]);
```

```php
// TourController::show() — before: 12 generic + duration + places
// After: 2 generic + dynamic title + place names only
$keywordArray = array_filter(array_unique([
    strtolower($tour->title),
    'morocco tours',
    'private morocco tours',
    'morocco tour package',
    ...$tour->places->pluck('name')->map(fn($n) => strtolower($n))->toArray(),
]));
```

```php
// TripController::show() — before: 8 generic + duration
// After: 3 focused + dynamic title + duration
$keywordArray = array_filter(array_unique([
    strtolower($trip->title),
    'morocco trip packages',
    'morocco multi day tours',
    'private morocco tours',
    $trip->duration_days ? 'morocco ' . $trip->duration_days . ' day tour' : null,
]));
```

Listing pages reduced from 7–10 overlapping terms to 4–5 distinct cluster terms per page.

---

## Fix 5 — Filament/database SEO fields

No `seo_title`, `meta_description`, `og_image`, or `canonical_url` columns exist on `activities`, `tours`, `trips`, or `blogs` tables (verified via `Schema::getColumnListing()`).

**Recommended migrations for a future pass** (not implemented — no migrations added per instructions):

```sql
-- For activities, tours, trips tables:
ALTER TABLE activities ADD COLUMN seo_title VARCHAR(70) NULL;
ALTER TABLE activities ADD COLUMN meta_description VARCHAR(160) NULL;
ALTER TABLE tours     ADD COLUMN seo_title VARCHAR(70) NULL;
ALTER TABLE tours     ADD COLUMN meta_description VARCHAR(160) NULL;
ALTER TABLE trips     ADD COLUMN seo_title VARCHAR(70) NULL;
ALTER TABLE trips     ADD COLUMN meta_description VARCHAR(160) NULL;
```

Once added, wire them in controllers using the fallback pattern:
```php
$title = $activity->seo_title
    ?: $activity->title . ' | Morocco Day Tours & Activities | Morocco Quest';

$description = $activity->meta_description
    ?: Str::limit(strip_tags($activity->overview ?? ''), 155);
```

Filament resource forms would then need a new `TextInput::make('seo_title')` and `Textarea::make('meta_description')` section — implement when migrations are approved.

---

## Fix 6 — Richer schema stays in Blade, not controllers

`activity-detail.blade.php` already contains a rich `TouristAttraction` schema block via `@push('jsonld')` with conditional Offer, image, and URL. This is the correct architecture — controller handles basic meta tags, Blade view handles the nested JSON-LD object.

No changes made to Blade views under this fix. The controller `JsonLd::setType('TouristAttraction')` now aligns with the view's schema type, eliminating the previous conflict where controller said `TouristTrip` and view said `TouristAttraction`.

The `@stack('jsonld')` in `app2.blade.php` (line 98) renders both the artesaos `JsonLd::generate()` output (line 170) and the `@push` blocks, so both emit as separate `<script>` blocks in `<head>` — this is intentional and correct.

---

## Fix 7 — SeoHelper service

`app/Support/SeoHelper.php` created (not `app/Services/` since `app/Support/` already existed with `MediaUrl.php`).

The helper is intentionally minimal — it wraps the artesaos facades rather than replacing them. Controllers that need additional artesaos calls (e.g. `OpenGraph::setType('article')` on tour detail, Twitter card properties) continue calling the facades directly after `SeoHelper::setDetail()`. The helper only removes the repetitive base setup.

---

## StaticPageController — `setSeo()` helper updated

| Before | After |
|--------|-------|
| `private function setSeo($title, $description, $type, $keywords)` — no types | `private function setSeo(string $title, string $description, string $type, array $keywords): void` — fully typed |
| No OG image | `OpenGraph::addImage(SeoHelper::ogImage(null))` → `placeholder-image.webp` |
| 10 keywords per static page | 4–5 focused keywords per page |

---

## Files Modified

| File | Type | Changes |
|------|------|---------|
| `app/Support/SeoHelper.php` | **New** | OG fallback, setCollection, setDetail, noindex helpers |
| `app/Http/Controllers/ActivityController.php` | Modified | Fix 1+2+3+4: schema types, canonical, OG fallback, keyword reduction |
| `app/Http/Controllers/TourController.php` | Modified | Fix 1+2+3+4: schema types, filter noindex, OG fallback, keyword reduction |
| `app/Http/Controllers/TripController.php` | Modified | Fix 3+4: OG fallback via SeoHelper, keyword reduction, unused `Request` import removed |
| `app/Http/Controllers/BlogController.php` | Modified | Fix 3+4: OG fallback, keyword reduction, search noindex, unused `Storage` import removed |
| `app/Http/Controllers/StaticPageController.php` | Modified | Fix 3+4: OG image added to all static pages, keyword reduction, typed `setSeo()` |

---

## Rollback Notes

All changes are PHP controller edits — no database migrations, no Blade view changes, no config changes.

To rollback:
```bash
git diff HEAD app/Http/Controllers/ActivityController.php  # review first
git checkout HEAD -- app/Http/Controllers/ActivityController.php
git checkout HEAD -- app/Http/Controllers/TourController.php
git checkout HEAD -- app/Http/Controllers/TripController.php
git checkout HEAD -- app/Http/Controllers/BlogController.php
git checkout HEAD -- app/Http/Controllers/StaticPageController.php
git rm app/Support/SeoHelper.php
```

---

## Remaining Issues (not fixed here)

| Issue | Reason not fixed |
|-------|-----------------|
| `seo_title` / `meta_description` Filament fields | No DB columns exist — migration required (see Fix 5) |
| `rel="prev"` / `rel="next"` pagination links | Requires Blade layout change — separate pass |
| `Post` + `Blog` duplicate sitemap entries | Separate pass — need to confirm if they are the same table |
| OG image for listing pages when Place/Category has no image | Falls back to `placeholder-image.webp` — acceptable; a branded OG image per destination would be ideal |
| `showMultiDay` fetches ALL tours (no `tour_type` filter) | Data logic bug outside SEO scope |

---

## Artisan Commands Run

```
php artisan route:list   ✅  84 routes, no errors
php artisan test         ✅  Unit: 1 passed
                         ⚠️  Feature: 1 failed — pre-existing SQLite issue (no blogs table in test DB)
php artisan config:clear ✅
php artisan cache:clear  ✅
php artisan view:clear   ✅
```

---

*Morocco Quest Controller SEO Fix Changelog | 2026-07-08 | Branch: seo-fixes-july-2026*
