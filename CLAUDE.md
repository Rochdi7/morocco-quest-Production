# Morocco Quest — CLAUDE.md

Laravel + Filament travel agency site. Marrakech-based private tour operator.
Read this file completely before touching any code.

---

## 1. Stack

| Layer | Tech |
|---|---|
| Backend | Laravel (PHP 8+) |
| Admin panel | Filament |
| Frontend | Blade templates (`resources/views/`) |
| Build | Vite (`vite.config.js`) |
| DB | MySQL (via `.env` — never expose) |
| Assets | `public/assets/` — static CSS/JS/images |

---

## 2. Project structure — what lives where

```
app/
  Http/Controllers/       ← TourController, BlogController, ActivityController,
                            TripController, InquiryController, etc.
  Models/                 ← Tour, Blog, Activity, Trip, Place, Category, Tag,
                            ActivityCategory, Comment, ItineraryDay, TourImage,
                            TripImage, ActivityImage
resources/views/
  layouts/
    app.blade.php         ← base layout (older pages)
    app2.blade.php        ← main layout — canonical, OG, Twitter, JSON-LD slots
  partials/               ← shared nav, footer, components
  home.blade.php
  tour-detail.blade.php   ← TouristTrip + BreadcrumbList schema, @push('jsonld')
  tours-list.blade.php
  trips.blade.php / trips-details.blade.php
  activities.blade.php / activity-detail.blade.php / activity-categories.blade.php
  blog.blade.php / blog-details.blade.php
  destinations.blade.php
  about.blade.php / contact.blade.php / faq.blade.php
  sitemap.blade.php       ← XML sitemap template
routes/web.php            ← all public + admin routes
seo-keyword-map.md        ← Semrush keyword assignments — read before any SEO edit
```

---

## 3. Layout slots — how SEO meta is injected

Every page extends `layouts/app2.blade.php` (most) or `layouts/app.blade.php`.
The layout exposes these `@yield` / `@stack` slots:

| Slot | Purpose | Example |
|---|---|---|
| `@section('title')` | `<title>` tag | `@section('title', 'Tours from Marrakech \| Morocco Quest')` |
| `@section('description')` | meta description | 150–160 chars, primary keyword in first 60 |
| `@section('keywords')` | meta keywords | comma-separated, primary KW first |
| `@section('canonical')` | canonical URL | use `{{ route('tours.show', $tour->slug) }}` |
| `@section('og_type')` | OG type | `website` / `article` |
| `@section('og_title')` | OG title | usually same as title |
| `@section('og_description')` | OG description | ≤ 200 chars |
| `@section('og_image')` | OG image URL | use `asset(...)` or model image URL |
| `@push('jsonld')` | JSON-LD schema blocks | `<script type="application/ld+json">...</script>` |

**Rule:** Never hardcode SEO meta in the layout itself. The layout defaults
are fallbacks only. Every individual view MUST define its own `@section('title')`
and `@section('description')`.

---

## 4. Canonical URL rule

Always use named routes:
```blade
@section('canonical', route('tours.show', $tour->slug))
@section('canonical', route('blog.show', $blog->slug))
@section('canonical', route('activities.show', $activity->slug))
```

Never hardcode `https://...` strings in views — they break in staging/local.
The layout uses `url()->current()` as a fallback; this is acceptable only on
pages with no dynamic slug.

---

## 5. Schema patterns — copy-paste templates

### TouristTrip (tour-detail.blade.php)
```blade
@php
$tourSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'TouristTrip',
    'name' => $tour->title,
    'description' => Str::limit(strip_tags($tour->overview ?? $tour->subtitle ?? ''), 300),
    'url' => route('tours.show', $tour->slug),
    'image' => $tour->firstImage?->image_path
                ? asset('storage/' . $tour->firstImage->image_path)
                : asset('assets/img/logo-bg.png'),
    'touristType' => 'Private',
    'duration' => 'P' . ($tour->duration_days ?? 3) . 'D',
    'itinerary' => [
        '@type' => 'ItemList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1,
             'item' => ['@type' => 'Place', 'name' => $tour->departure ?? 'Marrakech, Morocco',
                        'address' => ['@type' => 'PostalAddress', 'addressCountry' => 'MA']]],
        ],
    ],
    'provider' => [
        '@type' => 'TravelAgency',
        'name' => 'Morocco Quest',
        'url' => url('/'),
    ],
    'offers' => [
        '@type' => 'Offer',
        'availability' => 'https://schema.org/InStock',
        'priceCurrency' => 'USD',
        'url' => route('tours.show', $tour->slug),
    ],
];
if (!empty($tour->price_adult)) {
    $tourSchema['offers']['price'] = (string) $tour->price_adult;
}
@endphp
@push('jsonld')
<script type="application/ld+json">{!! json_encode($tourSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}</script>
@endpush
```

### BreadcrumbList (any detail page)
```blade
@php
$breadcrumb = [
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tours', 'item' => route('tours.index')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $tour->title, 'item' => route('tours.show', $tour->slug)],
    ],
];
@endphp
@push('jsonld')
<script type="application/ld+json">{!! json_encode($breadcrumb, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
```

### BlogPosting (blog-details.blade.php)
```blade
@php
$blogSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $blog->title,
    'description' => Str::limit(strip_tags($blog->excerpt ?? $blog->body ?? ''), 300),
    'url' => route('blog.show', $blog->slug),
    'image' => $blog->image ? asset('storage/' . $blog->image) : asset('assets/img/logo-bg.png'),
    'datePublished' => $blog->created_at->toIso8601String(),
    'dateModified' => $blog->updated_at->toIso8601String(),
    'author' => ['@type' => 'Person', 'name' => 'Morocco Quest Team'],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Morocco Quest',
        'logo' => ['@type' => 'ImageObject', 'url' => asset('assets/img/logo-bg.png')],
    ],
];
@endphp
@push('jsonld')
<script type="application/ld+json">{!! json_encode($blogSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
```

### FAQPage (hub pages — visible in HTML body too)
FAQPage JSON-LD only generates rich results when the Q/A text is also **visible
to users** in the page HTML. Always pair schema with a visible `<section>` block.
```blade
@php
$faqSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [
        ['@type' => 'Question', 'name' => 'Question text here?',
         'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Answer text here.']],
    ],
];
@endphp
@push('jsonld')
<script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

{{-- REQUIRED: same Q/A must be visible in HTML body --}}
<section class="faq-section">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-item">
            <h3>Question text here?</h3>
            <p>Answer text here.</p>
        </div>
    </div>
</section>
```

---

## 6. SEO keyword assignments (from seo-keyword-map.md)

Read `seo-keyword-map.md` before every SEO edit. Do not guess keywords.
Only use exact Semrush keywords listed in that file.

Key assignments:
| Page | Primary keyword |
|---|---|
| `/` (homepage) | `morocco private tours` |
| `/tours` | `marrakech desert tours` |
| `/desert-tours/` (to create) | `marrakech desert tours` |
| `/luxury-desert-tours-marrakech/` (to create) | `luxury desert tours marrakech` |
| `/tours/marrakech-to-sahara-desert/` (to create) | `sahara desert tour from marrakech` |
| `/tours/marrakech-to-fes-desert/` (to create) | `fes to marrakech desert tour` |
| `/blog/best-morocco-itinerary/` (to create) | `best morocco itinerary` |

Cannibalization rules (never violate):
- Homepage owns `morocco private tours` — no other page uses it as primary.
- `/tours` owns `marrakech desert tours` — activities/trekking pages must NOT use it.
- Blog posts are informational only — never assign a commercial primary keyword to a blog.
- `/private-tours/sahara/` and `/tours/private-sahara-from-marrakech/` — build only ONE of these.

---

## 7. Routes — known issues to be aware of

```php
// BUG: /destinations is registered twice (lines 55 and 60)
// Fix: remove the second registration
Route::get('/destinations', [TourController::class, 'listPlaces'])->name('destinations.index');
```

When adding new SEO landing pages, register them in `routes/web.php` as
`Route::get(...)` with a named route. Never create orphan Blade views without
a route.

---

## 8. robots.txt — AI crawlers

The current `robots.txt` (generated in `routes/web.php`) does NOT explicitly
allow AI crawlers. Add these before the `Sitemap:` line:

```
User-agent: GPTBot
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: PerplexityBot
Allow: /

User-agent: Google-Extended
Allow: /

User-agent: CCBot
Allow: /
```

---

## 9. Strict rules — never violate

- ❌ Never expose `.env` values, credentials, or SMTP config.
- ❌ Never hardcode canonical URLs — use named routes.
- ❌ Never add SEO meta to the shared layout — use `@section` in child views.
- ❌ Never use the same primary keyword on two different pages (check `seo-keyword-map.md`).
- ❌ Never rename a tour/activity/trip slug that is already live — it carries SEO equity.
- ❌ Never add FAQPage JSON-LD without a matching visible HTML FAQ section — Google suppresses hidden FAQ rich results.
- ❌ Never deploy without regenerating the sitemap (`/sitemap.xml` is dynamic — it self-updates from the DB, but `<lastmod>` values must reflect actual `updated_at` DB timestamps).
- ❌ Never touch `node_modules/`, `vendor/`, or compiled assets in `public/build/` directly.

---

## 10. How to run locally

```bash
cd "C:\Users\ASUS\Desktop\Projects\morocco-quest-Production"
php artisan serve          # start Laravel dev server → http://localhost:8000
npm run dev                # start Vite for asset hot-reload (separate terminal)
```

Database: configure `.env` with local MySQL credentials.
Filament admin: `/admin` (requires auth).

---

## 11. SEO skills available

Run any of these from Claude Code terminal:

```
/seo-pass        ← full 9-phase SEO production pass (docs/skills/seo-pass.md in localmoroccotours project — same rules apply here)
/seo             ← comprehensive site audit
/seo-schema      ← schema validation + generation
/seo-technical   ← crawlability, redirects, indexability
/seo-content     ← E-E-A-T, thin content, readability
/seo-geo         ← AI Overviews, ChatGPT, Perplexity citation readiness
/seo-page        ← single-page deep analysis
/seo-sitemap     ← XML sitemap validation
```

Before running `/seo`, read `seo-keyword-map.md` — keyword assignments are
already done; don't re-derive them.

---

## 12. Response style

Follow `caveman.md` (in project root):
- Output format: **NOW / DONE / BLOCKED / NEXT**
- Short. Action first. No theory.
- Exact file paths always.
- No cloud, no deploy, no enterprise complexity.
