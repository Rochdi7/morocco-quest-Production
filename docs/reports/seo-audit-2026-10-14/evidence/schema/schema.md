# Structured data audit, morocco-quest.com, 2026-10-14

Method: live HTML fetched (1.2s spacing), every ld+json block parsed. Raw blocks are saved next to this file (`<slug>.ldN.json`). Microdata/RDFa: none on any page. No JSON parse errors on the 19 pages fetched. All 5 sampled image/logo URLs return 200 image/webp (the blog image only when the spaces are percent-encoded).

Not yet covered: meetings-conventions-management, professional-congress-organization, events-production-morocco, sustainable-events-morocco, 360-event-solutions (views use the same Service + Breadcrumb + FAQ pattern as team-building-marrakech, lines 8/27/38), /tours/type/Garden%20Tours etc., legal pages.

## Per-template table

| URL | Types present | Errors | Warnings | Rich-result impact | Source | Fix |
|---|---|---|---|---|---|---|
| / | WebSite, TravelAgency | none | No BreadcrumbList (fine for home). Home TravelAgency areaServed/knowsAbout differ from every other page (6 areas vs 8) because home uses a different layout | Org logo OK (200). Sitelinks search box is no longer a Google feature | resources/views/layouts/app.blade.php:147,165 (home) vs layouts/app2.blade.php:110,128 (all others) | One shared partial for WebSite/TravelAgency so both layouts emit identical entities |
| /tours | + BreadcrumbList, ItemList (8) | none | ItemList is name+url only, matches 8 visible cards | Breadcrumb eligible | resources/views/tours-list.blade.php:8,31 | none |
| /experiences | + Breadcrumb, ItemList (6 categories) | none | | Breadcrumb eligible | resources/views/activity-categories.blade.php:8-21 | none |
| /activities | WebSite, TravelAgency, Breadcrumb only | ItemList missing (was claimed fixed) | Page body shows "No activity categories found at the moment" and zero activities; indexable, self-canonical, in sitemap. Breadcrumb points to /experiences | Breadcrumb eligible but page is empty (SEO/quality issue) | app/Http/Controllers/ActivityController.php:177 passes `$activities`; view expects `$activityCategories` (activity-categories.blade.php:18, :146) | Pass the right variable, or 301 /activities to /experiences |
| /destinations | + Breadcrumb, ItemList (7) | none | | Breadcrumb eligible | resources/views/destinations.blade.php:8 | none |
| /destinations/marrakech | + Breadcrumb, ItemList (5 tours), TouristDestination | none | TouristDestination minimal (name, url, containedInPlace); no description/image/geo, no @id | none (not a Google rich result) | destination detail view | Add description, image, geo |
| /dmc-marrakech | + Service, Breadcrumb, FAQPage (15 Q) | none | Service provider uses @id ref (good). FAQPage on a commercial site | FAQ rich result not eligible (gov/health only); Info priority. Keeps AI-citation value. Confirm all 15 Q are visible | resources/views/dmc-marrakech.blade.php:34,47,57 | none |
| /destination-management-company | Service, Breadcrumb, FAQPage | none | same pattern | same | destination-management-company.blade.php:8,27,38 | none |
| /team-building-marrakech | Service, Breadcrumb, FAQPage | none | Service names use "Morocco Quest DMC" suffix while org name is "Morocco Quest" | same | team-building-marrakech.blade.php:8,27,38 | Pick one brand string |
| /about | + Breadcrumb | none | No AboutPage, no founder Person | Breadcrumb eligible | about.blade.php:7,31 | optional AboutPage |
| /contact | + ContactPage, Breadcrumb | none | ContactPage.mainEntity re-declares TravelAgency with same @id and a different phone format (+212654069718 vs +212-654-069-718); node duplicated | none | contact.blade.php:30-31 | mainEntity as `{"@id": ...}` only; one phone format |
| /faq | + Breadcrumb, FAQPage (11 Q) | none | Commercial site | FAQ rich result not eligible; Info only | faq.blade.php:8,18 | none |
| /blog | + Breadcrumb | none | No post ItemList | Breadcrumb eligible | blog.blade.php:8 | optional |
| /blog/agafay-vs-sahara... | + BlogPosting, Breadcrumb | none | `image` URL has raw spaces ("Cozy Afternoon at Agafay Camp.webp"). `author` Person has no `url`. publisher typed Organization but shares @id with TravelAgency (type conflict on merge). Single image only (Google prefers 16x9, 4x3, 1x1). datePublished 2025-06-12 | Article eligible; unencoded image URL is an eligibility risk. Image-fallback bug is fixed | resources/views/blog-details.blade.php:12-47 | rawurlencode image path; add author url; publisher as `{"@id": ...}` |
| /tours/5-day-marrakech... | + TouristTrip, Breadcrumb | none | `touristType` hardcoded Adventure/Cultural/Desert/Luxury for every tour (city break tagged Desert). No offers (correct: page says Price On Request) | Breadcrumb eligible. No Product/merchant/Offer rich result possible without visible prices | resources/views/tour-detail.blade.php:26-34 (touristType), 41-49 (breadcrumb) | Derive touristType per tour or drop it |
| /activities/magical-hot-air-balloon... | + TouristTrip, Breadcrumb | none | touristType hardcoded Cultural/Adventure/Day Trip on all 23. Breadcrumb level 2 "Activities" -> /experiences | Breadcrumb eligible | resources/views/activity-detail.blade.php:19, 27-34 | per-activity touristType; verify visible breadcrumb matches |
| /tours/type/multi-day | WebSite, TravelAgency only | no Breadcrumb, no ItemList | 8 tours listed visibly | none lost | resources/views/type-filter.blade.php (no ld+json) | Add Breadcrumb + ItemList via partials/schema-itemlist.blade.php |
| /tours/type/one-day | same | same | Lists 12 activities under a /tours/ URL; visible text "Unknown Location" on cards | none | type-filter.blade.php:133 | Fix location fallback; add schema |
| /activities/category/city-tours | + Breadcrumb, ItemList (7) | none | 7 items match 7 visible cards | Breadcrumb eligible | activities-by-category.blade.php:8 | none |

## Cross-site checks
- Entity IDs: single `https://morocco-quest.com#organization` and `#website` everywhere. No duplicate Organization/TravelAgency with different names. Only variations: Organization type label on blog publisher, and the /contact re-declaration.
- Logo `logo-bg-wide.webp` returns 200. Wide aspect may crop poorly in Google; dimensions not measured.
- No `offers`, `AggregateRating` or `Review` anywhere; consistent with visible "Price On Request". Do not add ratings without genuine on-page reviews. "10% OFF" badges are visible on cards but not in schema (consistent).
- Brand: schema name "Morocco Quest", alternateName "Morocco Quest Tours & Travel"; DMC Service names say "Morocco Quest DMC"; Tripadvisor sameAs is "Morocco Quest Dmc"; GBP is "Morocco Quest DMC".
- No HowTo or SpecialAnnouncement. All @context https://schema.org, URLs absolute, dates ISO 8601.

## Fixed since 2026-09-28 checklist
- [x] Offers removed from activities; TouristAttraction -> TouristTrip (activity-detail.blade.php:11-14).
- [x] `duration` removed from TouristTrip; `itinerary` ItemList added on tours.
- [x] No schema price vs "Price On Request" contradiction.
- [x] SearchAction uses `?query=` (layouts/app2.blade.php:121).
- [x] TravelAgency has streetAddress, postalCode, email, foundingDate.
- [x] BlogPosting image uses the post featured image (blog-details.blade.php:18-21), but URL not encoded.
- [x] ItemList on /tours, /experiences, /destinations, /destinations/marrakech, category pages.
- [x] TouristDestination on destination page; Service on DMC pages.
- [x] Blog publisher references shared @id.
- [ ] BlogPosting author still has no `url`.
- [ ] ItemList on /activities absent because the page renders empty (controller bug).
- [ ] Brand/alternateName mismatch only partly resolved.
- [ ] /tours/type/* pages have no breadcrumb/ItemList.
