# Morocco Quest — Controllers SEO Audit
**Date:** 2026-07-08
**Branch:** seo-fixes-july-2026
**Scope:** Read-only audit of all 6 SEO-relevant controllers. No code was changed.

---

## Table of Contents
1. [ActivityController](#1-activitycontroller)
2. [TourController](#2-tourcontroller)
3. [TripController](#3-tripcontroller)
4. [BlogController](#4-blogcontroller)
5. [StaticPageController](#5-staticpagecontroller)
6. [SitemapController](#6-sitemapcontroller)
7. [Specific ActivityController Questions](#7-specific-activitycontroller-questions)
8. [Summary — Priority Fixes](#8-summary--priority-fixes)

---

## 1. ActivityController

**File:** `app/Http/Controllers/ActivityController.php`

### Methods audited: `listCategories`, `showByCategory`, `index`, `show`, `showByType`

---

### 1.1 `listCategories()` — Activity hub page

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `CollectionPage` ✅ Correct for a listing of category cards | OK |
| Title | Hardcoded, descriptive ✅ | OK |
| Description | 160 chars, clear ✅ | OK |
| Canonical | `url()->current()` — correct ✅ | OK |
| OG image | **Missing** — no `OpenGraph::addImage()` call | Medium |
| Keywords | 10 terms hardcoded. Duplicates with `showByCategory` and `index` | Low |
| Filament SEO fields | Not used — title/description are hardcoded strings | Medium |
| Pagination canonical | Page 2 canonical is the same as page 1 (`url()->current()` includes `?page=2`) | Medium |

**Notes:**
- `url()->current()` on a paginated listing includes `?page=2`, so page 2 and page 1 share the same canonical as written — but `url()->current()` in Laravel actually does include the query string. For pagination this should be `url()->full()` or explicitly strip `?page` to point back to page 1 on inner pages. Currently sets canonical to the paginated URL which is the correct SEO behaviour (each page gets its own canonical), but page 1 should ideally be `url()->current()` without the page param and inner pages should rel-prev/rel-next.

---

### 1.2 `showByCategory($category_slug)` — Category listing

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `TouristTrip` ❌ **Wrong** — this is a listing/collection of activities by category, not a single trip | High |
| Correct type | Should be `CollectionPage` or `ItemList` | High |
| Title | Dynamic from `$category->name` ✅ | OK |
| Description | Dynamic from `$category->name` ✅ | OK |
| OG image | **Missing** — no `OpenGraph::addImage()` | Medium |
| Keywords | Mix of hardcoded + dynamic `$category->name`. Keyword `"morocco tours"` duplicated across all category pages → cannibalization risk | Medium |
| Filament SEO fields | Not used — title/description constructed from `$category->name` only; no `$category->seo_title` or `$category->meta_description` | Medium |
| Canonical | `url()->current()` — OK for pagination, but no `rel=prev/next` links | Low |

---

### 1.3 `index(Request $request)` — All activities (optionally filtered by `?category=slug`)

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `TouristTrip` ❌ **Wrong** — listing page, not a single trip | High |
| Correct type | `CollectionPage` | High |
| Canonical on filtered views | When `?category=hiking` is in URL, canonical is `url()->current()` which includes the query string. This creates thin-content duplicates indexed separately | High |
| Keyword overlap | Keywords for `index` and `showByCategory` are nearly identical → keyword cannibalization | Medium |
| OG image | **Missing** | Medium |
| Filament SEO fields | Not used | Medium |

**Notes:**
- The `index` action with `?category=slug` duplicates what `showByCategory` already does. Google will see two near-identical pages for the same category. Either the `?category=` param should get a `noindex` header, or the canonical should point to the canonical category URL `/activity-categories/{slug}`.

---

### 1.4 `show($slug)` — Single activity detail

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `TouristTrip` — acceptable but `TouristAttraction` would be more precise for day activities | Low |
| Title | Dynamic from `$activity->title` ✅ | OK |
| Description | `Str::limit(strip_tags($activity->overview ?? ''), 160)` ✅ | OK |
| OG image | `$activity->first_image_url` — dynamic ✅ | OK |
| OG image fallback | If `$activity->first_image_url` is null, `addImage(null)` is called → likely outputs empty `og:image` tag | Medium |
| Twitter card | ✅ Added via `OpenGraph::addProperty` | OK |
| Canonical | `url()->current()` ✅ | OK |
| Keywords | 13 terms hardcoded + dynamic title + category name → keyword stuffing on detail pages (13 generic + 2 dynamic = 15 terms for a single activity page) | Medium |
| Filament SEO fields | Not used. Description comes from `$activity->overview`. If Filament has `seo_title` or `meta_description` fields on the Activity model, they are ignored | Medium |
| Offer schema | ❌ Missing — no pricing schema even if `$activity->price` exists in the model | Medium |
| datePublished / dateModified | ❌ Missing from schema (present in BlogPosting but not TouristTrip; not required but useful) | Low |

---

### 1.5 `showByType($slugType)` — Filter by tour type string

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `TouristTrip` ❌ **Wrong** — listing page | High |
| Correct type | `CollectionPage` | High |
| Type map hardcoded | Map of slug → human type is hardcoded in both ActivityController AND TourController with different entries — risk of drift | Low |
| OG image | **Missing** | Medium |
| Canonical | `url()->current()` — OK | OK |
| Keyword cannibalization | Keywords nearly identical to `showByCategory` and `index` — the three listing methods share the same 6–8 keywords | Medium |

---

## 2. TourController

**File:** `app/Http/Controllers/TourController.php`

### Methods audited: `listPlaces`, `index`, `show`, `byPlace`, `showMultiDay`, `showOneDay`, `showByType`

---

### 2.1 `listPlaces()` — Destinations hub

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `CollectionPage` ✅ Correct | OK |
| OG image | **Missing** | Medium |
| Filament SEO fields | Hardcoded — no CMS-editable SEO title | Medium |

---

### 2.2 `index(Request $request)` — Tours listing with filters

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | **Not set** — `JsonLd::setTitle()->setDescription()` called but no `.setType()` call | High |
| Correct type | Should be `CollectionPage` | High |
| Canonical with `?place=` | `url()->current()` includes query string. `?place=Marrakech` and `/tours/marrakech` (via `byPlace`) create two indexable pages for the same content | High |
| Canonical with `?searchDate=` + `?guests=` | These filter params are indexable — no `noindex` or canonical normalization → thin-content duplicates | High |
| OG image | **Missing** | Medium |
| Keyword cannibalization | Keywords for `index` and `byPlace` are near-identical | Medium |

---

### 2.3 `show($slug)` — Tour detail

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `TouristTrip` ✅ Correct | OK |
| 301 redirect on old slugs | ✅ Smart recovery logic present | OK |
| Title | Dynamic from `$tour->title` ✅ | OK |
| Description | `Str::limit(strip_tags($tour->overview), 160)` ✅ | OK |
| OG image | `$tour->first_image_url` — dynamic ✅ | OK |
| OG image fallback | No fallback if `first_image_url` is null — `addImage(null)` | Medium |
| OG type | Set to `article` — acceptable but `product` or leaving it as `website` could be argued | Low |
| Offer schema | ❌ Missing from controller JSON-LD (Offer was added to `tour-detail.blade.php` view directly; controller's `JsonLd` block does not include it — view-level JSON-LD and controller-level JSON-LD are separate blocks, both emit, so this is fine if tour-detail.blade.php has the Offer block) | Note |
| Keywords | 12 hardcoded + dynamic title + duration + place names → up to ~15 terms → keyword stuffing | Medium |
| Filament SEO fields | Not used — title constructed by formula, description from `overview` text | Medium |
| `duration` keyword | `$tour->duration` is added to keywords array raw — could be a string like "7 days" or null (array_filter handles null) | Low |

---

### 2.4 `byPlace($slug)` — Tours by destination

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `TouristTrip` ❌ **Wrong** — destination listing page | High |
| Correct type | `CollectionPage` or `ItemList` | High |
| OG image | No `addImage()` — `$place->image_path` exists on the model (used in `listPlaces`) but not used here | Medium |
| Canonical | `url()->current()` ✅ | OK |

---

### 2.5 `showMultiDay()` — Multi-day tours hub

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `TouristTrip` ❌ **Wrong** — listing page | High |
| Correct type | `CollectionPage` | High |
| Data scope | Fetches ALL tours without a `tour_type` filter — the multi-day page shows ALL tours regardless of type | Medium |
| OG image | **Missing** | Medium |

---

### 2.6 `showOneDay()` — Day tours hub

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `TouristTrip` ❌ **Wrong** — listing page | High |
| Correct type | `CollectionPage` | High |
| OG image | **Missing** | Medium |

---

### 2.7 `showByType($type)` — Tours by type

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `TouristTrip` ❌ **Wrong** — listing page | High |
| Correct type | `CollectionPage` | High |
| OG image | **Missing** | Medium |

---

## 3. TripController

**File:** `app/Http/Controllers/TripController.php`

### Methods audited: `index`, `show`

---

### 3.1 `index()` — Trips listing

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `CollectionPage` ✅ Correct | OK |
| OG type | `website` ✅ | OK |
| OG site name | `setSiteName('Morocco Quest')` ✅ | OK |
| OG image | **Missing** | Medium |
| Filament SEO fields | Hardcoded | Medium |
| Keywords | Reasonable 9-term cluster, minimal cannibalization | OK |

---

### 3.2 `show(string $slug)` — Trip detail

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `TouristTrip` ✅ Correct | OK |
| Title | Dynamic from `$trip->title` ✅ | OK |
| Description | `Str::limit(strip_tags($trip->overview ?? ''), 160)` ✅ | OK |
| OG image | Dynamic with fallback to `morocco-quest-social-share.webp` ✅ **Best fallback pattern in all controllers** | OK |
| Twitter card | ✅ Present | OK |
| Canonical | `url()->current()` ✅ | OK |
| Offer schema | Conditional offer added to `trips-details.blade.php` (July 8 fix) — controller does not duplicate it ✅ | OK |
| Keywords | Dynamic `duration_days` keyword ✅ | OK |
| Filament SEO fields | Description comes from `$trip->overview` — if Filament has `meta_description` it is ignored | Medium |

**Note:** TripController has the cleanest SEO implementation of all detail controllers — consistent types, OG fallback image, no wrong schema types.

---

## 4. BlogController

**File:** `app/Http/Controllers/BlogController.php`

### Methods audited: `index`, `search`, `show`

---

### 4.1 `index()` — Blog listing

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `Blog` ✅ Correct (schema.org/Blog is a valid type for a blog index) | OK |
| Keywords | Dynamic from DB categories + tags, capped at 40, deduplicated ✅ **Best keyword generation pattern** | OK |
| OG image | **Missing** | Medium |
| Sidebar cache | `Cache::remember('blog_sidebar_v1', 3600, ...)` ✅ | OK |

---

### 4.2 `search($request)` — Blog search results

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `SearchResultsPage` ✅ Correct | OK |
| Canonical | `url()->current()` includes `?query=` — search result pages are typically `noindex` | Medium |
| Indexability | No `noindex` directive on search result pages → Google may index `/blog/search?query=sahara` as a thin-content page | Medium |

---

### 4.3 `show($slug)` — Blog post detail

| Check | Finding | Severity |
|-------|---------|----------|
| Schema type | `BlogPosting` ✅ Correct | OK |
| `datePublished` | ✅ From `$post->created_at` | OK |
| `dateModified` | ✅ From `$post->updated_at` with fallback | OK |
| `author` | ✅ From `$post->user->name` with fallback | OK |
| `publisher` with logo | ✅ Organization block with ImageObject | OK |
| `mainEntityOfPage` | ✅ Present | OK |
| OG image | Dynamic from `$post->featured_image_url` ✅ | OK |
| OG image fallback | If `featured_image_url` is null, `addImage(null)` is called — no fallback | Medium |
| Commercial keywords merged | 9 base keywords merged with post tags → up to ~17 terms total per post | Medium |
| Filament SEO fields | `$post->summary` used as fallback for description ✅ (uses `$post->summary ?? $post->content`) | OK |

**Note:** BlogController `show()` is the **most complete** schema implementation in the project — it has datePublished, dateModified, author, publisher, mainEntityOfPage. All other controllers are missing these enrichments.

---

## 5. StaticPageController

**File:** `app/Http/Controllers/StaticPageController.php`

### Methods audited: `about`, `faq`, `contact`, `terms`, `cookie`, `privacy`

---

### 5.1 General pattern

All static pages use a private `setSeo()` helper that calls `SEOMeta`, `OpenGraph`, and `JsonLd`. The pattern is clean and consistent.

| Check | Finding | Severity |
|-------|---------|----------|
| Schema types | `AboutPage` ✅, `FAQPage` ✅, `ContactPage` ✅, `TermsOfService` ✅, `PrivacyPolicy` ✅ — all correct | OK |
| `WebPage` on cookie | `WebPage` is acceptable for a non-standard page | OK |
| OG image | **Missing on all 6 static pages** — no `OpenGraph::addImage()` in `setSeo()` helper | Medium |
| Filament SEO fields | N/A — static pages have no CMS backend | OK |
| Canonical | `url()->current()` ✅ | OK |
| `contact()` schema type | Controller sets `ContactPage` but `contact.blade.php` pushes `TravelAgency` schema via `@push('jsonld')`. Both will emit. The `TravelAgency` from the view is the richer one and they do not conflict (two separate `<script>` blocks) ✅ | OK |

---

### 5.2 `setSeo()` helper — missing OG image slot

The helper signature:
```php
private function setSeo($title, $description, $type = 'WebPage', $keywords = [])
```
Has no `$image` parameter, so all static pages emit OG tags with no image. Facebook/Twitter/LinkedIn will show a blank card when these pages are shared. The default fallback image from `config/seotools.php` (if configured) would apply — this should be verified.

---

## 6. SitemapController

**File:** `app/Http/Controllers/SitemapController.php`
**Status:** Already audited and updated on July 8. See `MOROCCO-QUEST-SEO-CHANGELOG.md §2.1`.

| Check | Finding |
|-------|---------|
| Coverage | 14 static + Tour + Trip + Activity + Post + Blog + Place pages ✅ |
| Status filter | Published/active filtering for models with `status` column ✅ |
| Chunk size | 200 per chunk for models, 100 for Place ✅ |
| Error handling | `\Throwable` catch + `Log::warning` — safe ✅ |
| Route existence guard | `Route::has()` check before each model ✅ |
| Schema injection | N/A — XML only |
| Possible duplication | Both `Post::class` and `Blog::class` are added with `blog.show` route. If `posts` and `blogs` are the same table or one is an alias, this could create duplicate sitemap entries | Low |

---

## 7. Specific ActivityController Questions

The user asked five specific questions about ActivityController:

---

### Q1: Is `JsonLd::setType('TouristTrip')` correct for category/listing pages?

**No — it is incorrect on 3 methods.**

| Method | Current type | Correct type |
|--------|-------------|-------------|
| `showByCategory` | `TouristTrip` ❌ | `CollectionPage` |
| `index` | `TouristTrip` ❌ | `CollectionPage` |
| `showByType` | `TouristTrip` ❌ | `CollectionPage` |
| `listCategories` | `CollectionPage` ✅ | ✅ Already correct |
| `show` | `TouristTrip` ✅ | ✅ Correct for detail page (or `TouristAttraction`) |

**Why it matters:** `TouristTrip` is a schema.org type for a single, specific trip (with itinerary, duration, etc.). Google's Rich Results support for `TouristTrip` requires it to represent one concrete product. Using it on a listing page tells Google that the entire category listing IS a single trip — structurally incorrect and potentially confusing to rich result parsers.

---

### Q2: Should `showByCategory`, `index`, and `showByType` use `CollectionPage` / `ItemList` instead?

**Yes — `CollectionPage` is the minimum correct type. `ItemList` can optionally be nested inside it.**

Recommended pattern:
```php
// In controller — change the type
JsonLd::setTitle($title)->setDescription($description)->setType('CollectionPage');
```

For richer schema, the view's `@push('jsonld')` block could add an `ItemList` schema with the actual activity names and URLs from `$activities`. This is optional but gives Google structured list data for rich snippets.

---

### Q3: Should `show()` generate richer `TouristTrip` schema from activity data?

**Yes.** The current `show()` method uses the artesaos JsonLd facade which emits a minimal schema with only `name`, `description`, `url`, and `image`. The activity model likely has fields that could enrich the schema:

| Field | Schema property | Current status |
|-------|----------------|----------------|
| `$activity->overview` | `description` | ✅ Used |
| `$activity->first_image_url` | `image` | ✅ Used |
| `$activity->price` or pricing field | `offers.price` | ❌ Missing |
| `$activity->duration` | `duration` (ISO 8601) | ❌ Missing |
| `$activity->category->name` | `touristType` or `about` | ❌ Missing |
| Location / place data | `location.name` | ❌ Missing |

The richer approach — already used in `activity-detail.blade.php` for BreadcrumbList — would be to emit the enriched schema via `@push('jsonld')` in the Blade view rather than through the artesaos facade, since the facade's fluent API makes it awkward to express nested objects like `offers` or `location`.

---

### Q4: Should title/description come from Filament SEO fields?

**Ideally yes, with the current formula as fallback.**

Currently every controller builds SEO title/description from fixed string templates. If the `Activity`, `Tour`, or `Trip` model has Filament-managed fields like `seo_title` or `meta_description`, they are completely ignored.

Check the model for SEO columns:
```bash
php artisan tinker --execute="print_r(\Schema::getColumnListing('activities'));"
```

If `seo_title` / `meta_description` exist on the model:
```php
// Recommended pattern in show()
$title = $activity->seo_title 
    ?: $activity->title . ' | Morocco Day Tours & Activities | Morocco Quest';

$description = $activity->meta_description 
    ?: Str::limit(strip_tags($activity->overview ?? ''), 160);
```

This lets the Filament admin override SEO on a per-activity basis without code changes.

---

### Q5: Are keywords overused or outdated?

**Yes — two distinct problems:**

**Overuse (stuffing):**
- `ActivityController::show()` injects 13 hardcoded generic keywords + dynamic title + category → ~15 terms per activity page
- All listing methods (`showByCategory`, `index`, `showByType`) share the same ~8 generic keywords → keyword cannibalization: multiple URLs compete for `"morocco day tours"`, `"private morocco tours"`, etc.

**Outdated / missing terms:**
- None of the activity keywords include year variants (`"morocco tours 2026"`, `"things to do in marrakech 2026"`) — these are high-intent terms used by users who want current availability
- `"marrakech day trips"`, `"day excursions from marrakech"` appear in some pages but inconsistently

**Recommendation:** Each page type should own a distinct primary cluster:

| Page | Primary cluster |
|------|----------------|
| `listCategories` | `things to do in morocco`, `morocco experiences` |
| `showByCategory` | `[category] in morocco`, `[category] tours morocco` |
| `showByType` | `morocco [type]`, `[type] tours morocco` |
| `show` | `$activity->title` + location + duration-specific terms |

---

### Q6 (implicit): Are canonical URLs correct for query parameters and pagination?

**Partial concern.**

- Pagination: `url()->current()` on page 2 returns `http://...?page=2` — each paginated page gets a unique canonical pointing to itself. This is technically correct but Google prefers `rel="prev"` / `rel="next"` link tags to chain paginated series. These are absent from all listing pages.
- Filter params: `ActivityController::index()` with `?category=hiking` canonical points to the filtered URL. This is a near-duplicate of `showByCategory('hiking')`. One of them should declare the other as canonical.
- `TourController::index()` with `?place=`, `?searchDate=`, `?guests=` — all three filter params create indexable thin-content duplicates with no canonical normalization or `noindex`.

---

### Q7 (implicit): Does OpenGraph image have a safe fallback?

**Only in TripController `show()`. All other controllers lack a fallback.**

| Method | OG image source | Fallback |
|--------|----------------|---------|
| `ActivityController::show` | `$activity->first_image_url` | ❌ None — `addImage(null)` if null |
| `TourController::show` | `$tour->first_image_url` | ❌ None |
| `TripController::show` | `$trip->images?->first()` | ✅ `morocco-quest-social-share.webp` |
| `BlogController::show` | `$post->featured_image_url` | ❌ None |
| All listing pages | N/A | ❌ No image at all |
| StaticPageController (all) | N/A | ❌ No image at all |

**Recommended pattern** (from TripController — copy to all others):
```php
$image = $activity->first_image_url 
    ?: asset('assets/img/morocco-quest-social-share.webp');
```

---

## 8. Summary — Priority Fixes

### High priority (schema correctness — affects Google Rich Results)

| # | Issue | File | Method | Fix |
|---|-------|------|--------|-----|
| H1 | `TouristTrip` on listing pages × 8 methods | ActivityController, TourController | `showByCategory`, `index`, `showByType`, `byPlace`, `showMultiDay`, `showOneDay`, `showByType` (Tour) | Change `setType('TouristTrip')` → `setType('CollectionPage')` |
| H2 | Schema type missing on `TourController::index` | TourController | `index` | Add `->setType('CollectionPage')` |
| H3 | `?category=`, `?place=`, `?searchDate=`, `?guests=` filter URLs indexable as thin content | ActivityController, TourController | `index` (both) | Add `noindex` for filtered views or point canonical to the canonical category/place URL |

### Medium priority (OG sharing + SEO field utilisation)

| # | Issue | Affects |
|---|-------|---------|
| M1 | OG image missing on all listing pages and all static pages | 10+ pages |
| M2 | OG image no fallback on Activity, Tour, Blog detail controllers | 3 controllers |
| M3 | `BlogController::search` not `noindex` | Blog search result pages |
| M4 | Filament SEO fields ignored on all detail pages | Activity, Tour, Trip |
| M5 | `Offer` schema missing from activity detail controller (present in view for tours — verify activity-detail.blade.php has it) | Activity detail pages |
| M6 | Possible duplicate sitemap entries: `Post` + `Blog` both use `blog.show` route | SitemapController |

### Low priority (keyword hygiene)

| # | Issue |
|---|-------|
| L1 | Keyword stuffing on detail pages (~13–15 terms) — reduce to 5–7 per page |
| L2 | Keyword cannibalization: `"morocco day tours"` appears in 6+ methods |
| L3 | No `rel="prev"` / `rel="next"` on any paginated listing |
| L4 | Type map duplicated in ActivityController and TourController — risk of drift |

---

*Morocco Quest Controllers SEO Audit | 2026-07-08 | Audit only — no code changed*
