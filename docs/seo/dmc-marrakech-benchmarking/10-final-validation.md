# 10 — Final Validation (local, 2026-11-24)

Validated on a local `php artisan serve` render of the working tree. Production is unchanged.

## Before / after

| Element | Before (live) | After (local render) |
|---|---|---|
| `<title>` | Morocco DMC Marrakech \| MICE & Incentive Travel (47 ch, 462 px) | DMC Marrakech \| Morocco DMC & MICE \| Morocco Quest (50 ch, 520 px) |
| Meta description | Morocco DMC for travel agents, tour operators and MICE planners. Group tours, team building and incentives across Marrakech and Morocco. | DMC Marrakech for travel agents, tour operators and MICE planners: white-label ground handling, hotels, transfers and incentives. Quote in 24h. |
| og:title / twitter:title | old title | new title (same source variable) |
| H1 | Morocco DMC & DMC Marrakech – Destination Management & MICE | DMC Marrakech: Destination Management Company for Travel Agents & MICE Planners |
| H1 count | 1 | 1 |
| H2 structure | 10 H2 | unchanged (10 H2) |
| Canonical | self | self (unchanged; renders as the request host) |
| Robots | index,follow | index,follow |
| JSON-LD | WebSite, TravelAgency, Service, BreadcrumbList, FAQPage | same types; Service enriched; all 5 blocks parse as valid JSON |
| Image alt | 24/24 | 22/22 (local DB has fewer product cards) |
| Main-content words | 3,713 | 3,648 (difference is DB-driven product cards; body copy unchanged) |
| Homepage contextual link to /dmc-marrakech | none | 1 ("DMC in Marrakech"), visible and white on dark background at 390 px and 1366 px |

## Checklist

| # | Check | Result |
|---|---|---|
| 1 | HTML/Blade validity | `php -l` OK on controller; all 14 sampled pages render HTTP 200 |
| 2 | Title & description | Verified in rendered HTML (above) |
| 3 | H1/H2 hierarchy | 1 H1 → 10 H2 → H3/H4 (unchanged structure) |
| 4 | Canonical | self-referencing |
| 5 | Robots | `index,follow` on all 8 DMC pages, home, about, contact, blog, tours, activities |
| 6 | Structured data | All JSON-LD blocks parse (0 invalid on 14 pages). Service uses only schema.org properties valid for Service (`alternateName`, `audience`, `hasOfferCatalog`). **Rich Results Test / validator.schema.org not run (needs the public URL after deploy).** |
| 7 | Internal links | New link uses `route('dmc.marrakech')`, so there's no hardcoded URL |
| 8 | Image alt | 0 missing |
| 9 | Mobile layout | Selenium 390×844 and 1366×900: no horizontal overflow (scrollWidth = viewport); H1 wraps to 3 lines |
| 10 | CTAs | Unchanged markup (form `route('contact.submit')`, tel, mailto, #dmc-enquiry anchors). Form submission not tested end-to-end (would send a real enquiry) |
| 11 | PageSpeed | **Not measured**: PSI keyless quota 429. Changes are text/schema only (+~1 KB HTML), so no expected performance effect |
| 12 | Other pages undamaged | 14 pages: 200, 1 H1 each, valid JSON-LD. **Test suite: 64 passed (343 assertions)** |
| 13 | Correct URL indexable | yes |
| 14 | Duplicate content | none introduced; no new pages |
| 15 | Git diff reviewed | 3 source files, +37/−8; see 09 |

## Remaining issues
1. **No GSC data.** Biggest measurement gap (see 06).
2. **Unverified trust content** (testimonials, licence, scale claims): owner decision.
3. **Authority/citations** (Stage C): off-site work.
4. PSI and Rich Results Test should be run after deploy.

## Deployment readiness
**Ready to deploy as a low-risk change** (metadata, H1, schema enrichment, one homepage sentence; all tests pass). Not deployed, per instructions. Follow the deploy checklist in `09-implementation-log.md`, especially the cache clear.
