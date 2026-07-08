# Sprint C Validation Checklist
**Date:** July 8, 2026

---

## Deploy Commands (run on server via PuTTY)

```bash
cd /home2/hxnglwte/public_html/website_ad320cd7
git pull origin main
php artisan optimize
php artisan config:clear
```

---

## Schema Validation

### What to check in browser source on each page type:

**Tour detail page** (e.g. `/tours/5-day-marrakech-sahara-luxury-desert-discovery`):
- Should have exactly ONE `TouristTrip` JSON-LD block (in `@push('jsonld')`)
- Should have ONE `BreadcrumbList` JSON-LD block
- Should have ONE `TravelAgency` JSON-LD block (from layout)
- Should NOT have a second `TouristTrip` block from SEOTools
- `og:type` should be `product`

**Activity detail page** (e.g. `/activities/hot-air-balloon-marrakech`):
- Should have exactly ONE `TouristAttraction` JSON-LD block
- Should have ONE `BreadcrumbList` JSON-LD block
- Should NOT have a second `TouristAttraction` from SEOTools
- `og:type` should be `product`
- Description in JSON-LD should not contain `&nbsp;`

**Blog detail page** (e.g. `/blog/luxury-sahara-desert-tour-in-morocco`):
- Should have exactly ONE `BlogPosting` JSON-LD block
- Should have ONE `BreadcrumbList` JSON-LD block
- Should NOT have a second `BlogPosting` from SEOTools
- `og:type` should be `article`

**FAQ page** (`/faq`):
- Should have `FAQPage` JSON-LD with 8 `mainEntity` Question objects
- Should have `BreadcrumbList` JSON-LD
- Rich Results Test should validate FAQPage

**Homepage** (`/`):
- Should have `FAQPage` JSON-LD with 5 `mainEntity` Question objects
- Should have `TravelAgency` JSON-LD with sameAs
- Should have `WebSite` JSON-LD with SearchAction
- `og:type` should be `website`

---

## Rich Results Test URLs

Run these in Google's Rich Results Test (search.google.com/test/rich-results):

| Page | Expected Result |
|---|---|
| `https://morocco-quest.com/tours/[any-tour-slug]` | TouristTrip + BreadcrumbList — Valid |
| `https://morocco-quest.com/activities/[any-activity-slug]` | TouristAttraction + BreadcrumbList — Valid |
| `https://morocco-quest.com/blog/[any-blog-slug]` | BlogPosting + BreadcrumbList — Valid |
| `https://morocco-quest.com/faq` | FAQPage (8 questions) + BreadcrumbList — Valid |
| `https://morocco-quest.com/` | FAQPage (5 questions) + TravelAgency + WebSite — Valid |

---

## OpenGraph / Twitter Validation

Run these in the Facebook Sharing Debugger (developers.facebook.com/tools/debug) and Twitter Card Validator (cards-dev.twitter.com/validator):

| Page | og:type | Expected Twitter card |
|---|---|---|
| Homepage | `website` | Site-wide title/description |
| Any tour detail | `product` | Tour-specific title + image |
| Any activity detail | `product` | Activity-specific title + image |
| Any blog post | `article` | Blog-specific title + image |

---

## robots.txt Validation

Fetch `https://morocco-quest.com/robots.txt` and confirm:

```
User-agent: GPTBot
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: PerplexityBot
Allow: /

User-agent: Google-Extended
Allow: /

User-agent: OAI-SearchBot
Allow: /
```

---

## Route Regression Check

```bash
php artisan route:list | grep -E "tours|activities|blog|faq"
```

No routes should have changed. All fixes are in controllers and templates only.

---

## Audit Finding Resolution

| Finding | Status | Notes |
|---|---|---|
| Duplicate JSON-LD blocks on detail pages | FIXED | `JsonLd::generate()` disabled in app2 |
| FAQPage mainEntity empty on /faq | FIXED | Schema restored via `@push('jsonld')` |
| og:type="article" on tour pages | FIXED | Changed to `product` in TourController |
| og:type="website" on blog pages | FIXED | Added `setType('article')` in BlogController |
| og:type="website" on activity pages | FIXED | Added `setType('product')` in ActivityController |
| OAI-SearchBot missing from robots.txt | FIXED | Added to robots.txt |
| `&nbsp;` in Activity JSON-LD descriptions | FIXED | html_entity_decode() added in schema layer |
| Twitter/OG double-encoded entities homepage | FALSE POSITIVE | Verified: single-encoded correctly |
| sameAs missing from TravelAgency schema | FALSE POSITIVE | Already present in both layouts |
| WebSite schema missing sitewide | FALSE POSITIVE | Already in structured-data-global.blade.php |
| Tours listing thin content / no H2 | FALSE POSITIVE | hub-intro section already exists in tours-list.blade.php |
| FAQPage mainEntity empty on homepage | FALSE POSITIVE | Homepage FAQPage has 5 complete Q&As |
| No AggregateRating schema | DEFERRED | Requires review system — marketing decision |
| GBP not confirmed | DEFERRED | Marketing action required |
| Blog image URL with space | DEFERRED | Content/file rename by Mounir |
| Blog 5 heading hierarchy (H1→H3) | DEFERRED | Content edit by Mounir |
| Blog 6 thin content (~923 words) | DEFERRED | Content expansion by Mounir |
| Hot Air Balloon thin content (~534 words) | DEFERRED | Content expansion by Mounir |
| Tour 1/2 seo_title vs H1 mismatch | DEFERRED | Filament edit by Mounir |
| No hreflang | DEFERRED | Low priority — no multi-language version planned |
| Place filter pages identical H1 / missing canonical | DEFERRED | Route/controller change — separate sprint |

---

## Final Production Score Estimate

| Dimension | Pre-Sprint C | Post-Sprint C |
|---|---|---|
| Technical SEO | 71 | 76 |
| Schema / Structured Data | 60 | 78 |
| Content SEO | 69 | 69 (no content edits this sprint) |
| GEO / AI Visibility | 73 | 75 |
| AEO | 61 | 68 (FAQPage on /faq now live) |
| Local SEO | 41 | 41 (requires GBP) |
| **OVERALL** | **63** | **~72** |

Score ceiling without GBP + reviews: **~82/100**
Score ceiling with GBP + reviews: **~90/100**
