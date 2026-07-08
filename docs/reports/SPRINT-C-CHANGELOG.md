# Sprint C Changelog
**Date:** July 8, 2026 | **Branch:** main

---

## Verification First — What We Checked Before Touching Anything

Every reported audit finding was verified in code before any fix was applied. Several were false positives or already handled.

---

## False Positives From the Audit

### 1. FAQPage mainEntity empty on homepage — FALSE POSITIVE
The audit reported an empty FAQPage on the homepage. Verified in `resources/views/home.blade.php`: the homepage FAQPage schema has 5 real Question/Answer pairs with complete answers. It was fully populated already. No fix needed on homepage.

### 2. Twitter/OG double-encoded entities (`&amp;amp;`) — FALSE POSITIVE
The audit claimed `&amp;amp;` in Twitter/OG meta on the homepage. Verified in the layout: `app.blade.php` outputs `{{ $metaTitle }}` (which double-escapes HTML) but `home.blade.php` passes `'Morocco Tours & Private Sahara Desert Trips from Marrakech | Morocco Quest'` as a plain PHP string with a literal `&`. Blade `{{ }}` encodes it once to `&amp;` — which is correct HTML. The `&amp;amp;` would only appear if the string were encoded before entering the template. It is not. Not a real bug at the code level.

### 3. sameAs missing from TravelAgency schema — FALSE POSITIVE
Verified in `app2.blade.php` and `app.blade.php`: both layouts have `sameAs` arrays containing Facebook, Instagram, and TripAdvisor URLs. Already present. No fix needed.

### 4. WebSite schema missing — FALSE POSITIVE
Verified in `resources/views/partials/structured-data-global.blade.php`: a `WebSite` schema with `SearchAction` potentialAction is emitted on every page that uses `app.blade.php`. Also confirmed `app2.blade.php` includes the `structured-data-global.blade.php` partial. Already present. No fix needed.

### 5. Tours listing page thin content — ALREADY FIXED
Verified in `resources/views/tours-list.blade.php`: a `hub-intro` section with ~220 words of editorial copy already exists between the breadcrumb and the tour cards, including named entity anchors (Marrakech, Erg Chebbi, Merzouga) and contextual internal links. The audit was running against an older state of this page.

### 6. Homepage og:type double-encode (`&amp;amp;amp;`) — FALSE POSITIVE
The content agent reported `&amp;amp;amp;` in Twitter/OG meta. This was triple-encoded in the agent's own analysis output, not in the actual HTML. The `og:title` tag in `app.blade.php` uses `{{ $metaTitle }}` which single-encodes `&` to `&amp;` — correct behaviour for an HTML attribute value.

---

## Real Fixes Implemented

### FIX 1 — Duplicate JSON-LD blocks on all detail pages
**File:** `resources/views/layouts/app2.blade.php`

**Root cause:** `app2.blade.php` called `{!! JsonLd::generate() !!}` which emitted a SEOTools-generated JSON-LD block (e.g. `TouristTrip`, `TouristAttraction`, `BlogPosting`). The same pages also use `@push('jsonld')` in their Blade templates to emit a richer, hand-crafted block of the same `@type`. Result: two same-type schema blocks in `<head>` on every tour, activity, and blog detail page.

**Fix:** Commented out `{!! JsonLd::generate() !!}`. The hand-crafted Blade schemas are richer (include Offer, BreadcrumbList, author, publisher, image dimensions) and take precedence.

**Before:**
```blade
{!! JsonLd::generate() !!}
```

**After:**
```blade
{{-- JsonLd::generate() disabled: detail pages push richer hand-crafted schema via @stack('jsonld').
     Emitting both would produce duplicate @type blocks on every tour/activity/blog page. --}}
```

**Rollback:** Uncomment the line. No data changed.

---

### FIX 2 — og:type="article" on tour detail pages
**File:** `app/Http/Controllers/TourController.php`

**Root cause:** `TourController::show()` explicitly called `OpenGraph::setType('article')`. Tour pages are product/service pages, not articles.

**Fix:** Changed `'article'` → `'product'`.

**Before:**
```php
OpenGraph::setType('article')->addImage($image, ['height' => 630, 'width' => 1200]);
```

**After:**
```php
OpenGraph::setType('product')->addImage($image, ['height' => 630, 'width' => 1200]);
```

**Rollback:** Change `'product'` back to `'article'`. Not recommended.

---

### FIX 3 — og:type="website" on blog detail pages
**File:** `app/Http/Controllers/BlogController.php`

**Root cause:** `BlogController::show()` never called `OpenGraph::setType()`, so the og:type defaulted to `'website'` from `config/seotools.php`. The `@section('og_type', 'article')` in `blog-details.blade.php` has no effect because `app2.blade.php` uses `OpenGraph::generate()` not `@yield('og_type')`.

**Fix:** Added `->setType('article')` to the OpenGraph chain in `BlogController::show()`.

**Before:**
```php
OpenGraph::setTitle($title)->setDescription($description)->setUrl($url)->addImage($image);
```

**After:**
```php
OpenGraph::setTitle($title)->setDescription($description)->setUrl($url)->setType('article')->addImage($image);
```

**Rollback:** Remove `->setType('article')`.

---

### FIX 4 — FAQPage schema commented out on /faq page
**File:** `resources/views/faq.blade.php`

**Root cause:** The entire FAQPage JSON-LD (with 8 Question/Answer pairs) was inside a `{{-- @section('structured_data')...@endsection --}}` Blade comment. It was never rendered.

**Fix:** Extracted the FAQPage JSON-LD from the dead comment block and added it as a proper `@push('jsonld')` entry above `@section('content')`. The old `@section` block (which also had meta/OG/Twitter tags) remains commented — those are handled by SEOTools in `app2.blade.php`.

**Result:** `/faq` now emits a valid FAQPage schema with 8 Question/Answer pairs, eligible for Google rich results.

**Rollback:** Remove the new `@push('jsonld')` FAQPage block from `faq.blade.php`.

---

### FIX 5 — og:type="website" on activity detail pages
**File:** `app/Http/Controllers/ActivityController.php`

**Root cause:** `ActivityController::show()` never set og:type, defaulting to `'website'`.

**Fix:** Added `OpenGraph::setType('product');` before the Twitter property chain in `ActivityController::show()`.

**Rollback:** Remove the `OpenGraph::setType('product');` line.

---

### FIX 6 — OAI-SearchBot missing from robots.txt
**File:** `public/robots.txt`

**Root cause:** `OAI-SearchBot` (OpenAI's web crawler) was not explicitly listed as allowed.

**Fix:** Added:
```
User-agent: OAI-SearchBot
Allow: /
```

**Rollback:** Remove those two lines.

---

### FIX 7 — `&nbsp;` and HTML entities in schema descriptions and meta fallbacks
**Files:** `resources/views/activity-detail.blade.php`, `app/Http/Controllers/ActivityController.php`, `app/Http/Controllers/TourController.php`

**Root cause:** The `overview` field in the database can contain HTML markup (including `&nbsp;` entities). `strip_tags()` removes HTML tags but leaves HTML entities intact. JSON-LD descriptions containing `&nbsp;` are technically invalid (JSON-LD is not HTML) and Google may reject or misparse them.

**Fix:** Added `html_entity_decode(..., ENT_QUOTES | ENT_HTML5, 'UTF-8')` after `strip_tags()` in all three locations where overview text is used in schema or meta fallbacks.

**Before:**
```php
Str::limit(strip_tags($activity->overview ?? ''), 300)
```

**After:**
```php
Str::limit(html_entity_decode(strip_tags($activity->overview ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 300)
```

**Rollback:** Remove the `html_entity_decode()` wrapper, leaving only `strip_tags()`.

---

## Files Changed

| File | Change |
|---|---|
| `resources/views/layouts/app2.blade.php` | Disabled `JsonLd::generate()` |
| `app/Http/Controllers/TourController.php` | og:type `article` → `product`; html_entity_decode on description fallback |
| `app/Http/Controllers/BlogController.php` | Added `OpenGraph::setType('article')` |
| `app/Http/Controllers/ActivityController.php` | Added `OpenGraph::setType('product')`; html_entity_decode on description fallback |
| `resources/views/activity-detail.blade.php` | html_entity_decode on schema description |
| `resources/views/faq.blade.php` | Restored FAQPage JSON-LD via `@push('jsonld')` |
| `public/robots.txt` | Added OAI-SearchBot Allow |

---

## Remaining Improvements (Require Content or Marketing — No Code Needed)

These were verified as real issues but cannot be fixed by code alone:

| Item | Owner | Action Required |
|---|---|---|
| Blog 6 (Agafay vs Sahara) — ~923 words, no comparison data | Mounir | Expand to 2,000+ words with drive times, distances, camp names, comparison table |
| Blog 5 (Morocco Safety 2026) — H1→H3 jump, no H2 | Mounir | Promote H3s to H2 or add grouping H2 headings; add 2 external citations (US State Dept, FCDO) |
| Hot Air Balloon activity — ~534 words, title missing "Berber Breakfast" | Mounir | Expand to 900+ words; update seo_title in Filament to include "Berber Breakfast" |
| Tour 1 seo_title drops "5-Day" vs H1 | Mounir | Update seo_title in Filament to match H1 |
| Tour 2 seo_title drops "Imperial" vs H1 | Mounir | Update seo_title in Filament to match H1 |
| All meta descriptions missing CTA verbs | Mounir | Rewrite in Filament: end each with "Book now." or "Start planning." |
| Homepage title ~75 chars (truncates in SERPs) | Mounir | Shorten in Filament to ≤60 chars |
| No AggregateRating schema | Dev + Marketing | Requires review collection system first |
| No confirmed Google Business Profile | Marketing | Claim at business.google.com; set category "Tour Operator" |
| Blog image filename with space | Mounir | Rename file; update DB record |
| Place filter pages `/tours/place/*` — identical H1s | Dev or Mounir | Either noindex (1 line of code) or add unique editorial content per place |
| Blog posts too short for AI citation (Blogs 5 + 6) | Mounir | Expand both to 1,800+ words with factual claims and Q&A passages |
| No external citations in blog content | Mounir | Add 2–4 outbound links per post to authoritative sources |

---

## What Now Depends Only on Content, Backlinks, Reviews, and Marketing

The SEO code architecture is complete. Future score improvements require:

1. **Content growth** — longer blog posts, more factual detail on activity pages, editorial copy on category pages
2. **Backlinks** — zero off-page signals were in scope; a link from a Morocco travel publication or tourism board would have outsized impact
3. **Reviews** — AggregateRating schema (star snippets) requires a review pipeline first; this single item is estimated to increase SERP CTR by 15–30%
4. **Google Business Profile** — must be claimed and verified by a human; no code can substitute
5. **Brand citations** — being mentioned (without a link) on TripAdvisor, travel blogs, or social media strengthens entity recognition in Google's Knowledge Graph
