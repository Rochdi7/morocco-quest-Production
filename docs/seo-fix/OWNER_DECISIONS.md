# Owner decisions

Nothing below was changed on your behalf. Each item says what is needed, why it matters, and what happens technically once you decide.

## A. Fixed technically without owner input (for reference)

These were clear-cut and are covered by tests:
- security (P0-1 to P0-4, P0-6, P0-7)
- robots meta, soft 404s, 404 meta
- sitemap lastmod and empty destinations
- robots.txt and llms.txt
- OG and Twitter tags
- duplicate canonical
- stable slugs
- tag noindex, empty-archive 404s
- schema validity
- nav hubs
- destination ↔ activity links
- placeholder text
- extra H1s in blog bodies
- JS errors
- icon subset
- hero and LCP discovery
- paginated canonicals

## B. Requires your approval

| ID | Decision needed | SEO / technical implications | What I'd do once decided |
|---|---|---|---|
| **O-1** | **The correct GA4 measurement ID.** `G-QXBGN7DKMB` returns 404 from Google, so GA4 records nothing. Check GA4 → Admin → Data streams. | No analytics data at all until this is fixed. The code already sends page views from gtag, so don't also add a GA4 page-view tag in GTM, or every view counts twice. | Replace the ID in both layouts (`layouts/app.blade.php`, `app2.blade.php`), then verify in GA4 Realtime. |
| **O-2** | **Migrate `%20` type URLs** (`/tours/type/Garden%20Tours` → `/tours/type/garden-tours`)? | URLs with spaces are fragile and look unprofessional, and they are linked sitewide. Changing them needs a 301 from each old URL; a short ranking wobble is possible. Low traffic today, so the risk is low. | Slug-based type routes, 301 from the `%20` forms, update nav and sitemap, resubmit the sitemap. |
| **O-3** | **Consolidate `/activities` into `/experiences`**, and choose **one** day-trips hub (`/tours/type/one-day` vs `/activities/category/day-trips`). | `/activities` duplicates `/experiences` (same H1) and shows "No activity categories found". Three URLs compete for "day trips". Consolidating concentrates signals. | 301 `/activities` → `/experiences` (keep `?category=` behaviour), 301 the losing day-trip URL, update nav, sitemap and llms.txt. |
| **O-4** | **Show prices?** "From $X" on tours and activities, and **USD or EUR**? | Price is the top "People also ask" question for these searches. The schema currently has **no** Offer because pages say "Price On Request" (markup must match the page). Showing prices would let the Offer come back. | Render "From …" on cards and detail pages, and restore the `offers` schema with the right currency. |
| **O-5** | **Awards:** provide proof (certificates, links) for the homepage awards (TripAdvisor Travellers' Choice 2022, Tui, IAGTO) and the /about awards, **or approve removing** them. | Unverifiable or contradictory awards (founded 2022; IAGTO is golf tourism) are a trust and E-E-A-T risk and could be treated as misleading. | Keep the verified ones with links, and remove the rest. |
| **O-6** | **Homepage "What Our Travelers Say"** heading has no testimonials under it. Provide real, attributable testimonials, or remove the heading. | An empty section looks unfinished. Fake reviews are not an option. | Fill it or remove it. |
| **O-7** | **Hub claims:** `/experiences` intro advertises camel, quad, Toubkal and Gnawa experiences, and `/tours/type/multi-day` promises "3, 5 & 7 day" tours but lists 5/6/8/9-day ones. Confirm what you actually sell. | Inaccurate copy hurts trust and intent match. | Rewrite the copy to match your real offer. |
| **O-8** | **Tour data (Filament):** 8-day tour has two "Day 01" and no Day 08; the Sahara tour lists its Merzouga camp under "Dades"; "airporot" typo on the Tangier tour. | Visible errors on product pages. The itinerary also feeds the schema `itinerary`. | You edit them in Filament (production data); I don't touch production data. |
| **O-9** | **DMC evidence:** licence (ODV) number, named clients you may cite, memberships (SITE/MPI/ICCA), 2–3 case studies, venue capacities, attributable testimonials. Also reconcile "trade-only, we never compete with you" with the direct-to-consumer site. | This is the main gap against the DMCs ranking for "dmc marrakech". "Licensed & insured" appears 12 times with no licence shown. | Add a trust block to the DMC pages, and optionally `hasCredential` / `memberOf` in schema once facts are supplied. |
| **O-10** | **New products and guides:** a real 2–3-day Merzouga tour, an Aït Benhaddou day trip, an Agafay dinner; "things to do in Marrakech/Fes" guides. | Page 1 of Google for these queries is product pages. Build them only if the products are real and bookable. | Create them in Filament; the templates already support them. |
| **O-11** | **Atlas Gardens duplicate activities:** keep one of `atlas-gardens-aromatic-delights…` and `atlas-gardens-day-trip…-botanical-escape`? | Near-duplicate products compete with each other. | Merge the content and 301 the other URL. |
| **O-12** | **Taxonomy merges:** `morocco-travel` + `morocco-travel-1`, typos `travel-avice`, `pottey`, `marrakech-inceincentive-trips`, duplicate tag pairs. | Tags are already noindex (done). Merging cleans URLs and the sidebar. | Rename/merge in Filament; slug changes are now 301-tracked automatically. |
| **O-13** | **Brand and social:** schema `alternateName` is "Morocco Quest Tours & Travel", while the Google profile, TripAdvisor and Instagram use **"Morocco Quest DMC"**. Also, is **@MoroccoQuest** (the `twitter:site` default) really your X/Twitter account? | Name consistency across the Google profile, the site and schema helps entity recognition. A wrong `twitter:site` attributes cards to someone else. | Set `alternateName` to "Morocco Quest DMC", and set or remove `twitter:site` in `config/seotools.php`. |
| **O-14** | **FAQ counters now display** (they were stuck at 0 because of a JS error): **1,100 Happy Travelers, 150 Tours Organized, 4 Years Experience, 8 Awards Won.** In the code, "150" and "8" are marked `{{-- Example Count --}}`. | These become visible claims after deploy. "8 Awards Won" overlaps O-5. **Confirm or correct them before deploying** (edit `resources/views/faq.blade.php`). | Update the numbers, or remove any counter you can't substantiate. |
| **O-15** | **Font Awesome subset:** run this read-only query on production and send the counts. | FA Pro fonts are about 1–1.4 MB per inner page. Subsetting to the 82 icons used in code is safe only if no icons live in DB content. | If the counts are 0, subset the FA fonts (same method as Bootstrap Icons, glyphs verified identical). |
| **O-16** | **Preloader:** keep the full-screen overlay (currently the LCP element), shorten it, or drop it on inner pages? | Lighthouse measures LCP on the overlay logo; the real hero only shows after the fade (about 2.2 s cap). It's a design choice. | Test a variant on staging with PSI, median of 3. |
| **O-17** | **Google Business Profile and TripAdvisor:** complete the Google profile (category, website, full address, photos, reviews) and merge or claim the duplicate TripAdvisor listings (d33367636 into d33367694; report d14018375, which appears to be another company). | Local pack visibility and brand confusion (moroccoquest.com is a different company). | Account actions only you can take. |
| **O-18** | **Secrets rotation (optional):** no credentials were ever committed, but `.git` was public. Rotating DB, mail, reCAPTCHA and `APP_KEY` is cheap insurance. | Rotating `APP_KEY` logs everyone out and invalidates encrypted values. Do it deliberately. | Server-side; not done. |

**O-15 query** (read-only, run on the production database):

```sql
SELECT 'blogs', COUNT(*) FROM blogs WHERE content LIKE '%fa-%' OR summary LIKE '%fa-%'
UNION ALL SELECT 'tours', COUNT(*) FROM tours WHERE overview LIKE '%fa-%' OR itinerary LIKE '%fa-%' OR includes LIKE '%fa-%' OR excludes LIKE '%fa-%'
UNION ALL SELECT 'activities', COUNT(*) FROM activities WHERE overview LIKE '%fa-%';
```
