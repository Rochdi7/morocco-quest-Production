# Morocco Quest: SEO action plan (14 October 2026)

An execution checklist, ordered by priority and then by dependency. Evidence references (F-n) point to `EVIDENCE.md`. Owner decisions (O-n) refer to `docs/seo-fix/OWNER_DECISIONS.md`.

**Effort:** S = up to half a day, M = up to 2 days, L = more than 2 days.
**Priority:** P0 critical, P1 high, P2 medium, P3 low.

---

## P0: measurement and access (do first; nothing else can be judged without it)

- [ ] **A-01 · P0 · Restore GA4 tracking**
  - **Issue:** The GA4 ID `G-QXBGN7DKMB` does not exist (Google returns 404) and the GTM container publishes zero tags, so no visit or enquiry is recorded (F-1).
  - **Component:** `layouts/app.blade.php`, `layouts/app2.blade.php` (gtag config); GTM container `GTM-WVCGDJ98`.
  - **Action:** In GA4 → Admin → Data streams, copy the real measurement ID and replace the old one in both layouts. Keep page views on one path only (gtag *or* a GTM GA4 tag, not both). Mark `generate_lead` as a key event. The event already carries a `form_type` parameter (`layouts/app.blade.php:81-88`); register it as a custom dimension and report enquiries with `form_type` ≠ newsletter, so sign-ups are not counted as sales leads.
  - **Benefit:** Organic sessions and enquiries become measurable; every later action needs this.
  - **Effort:** S · **Dependencies:** owner GA4 access (O-1) · **Risk:** Low
  - **Acceptance:** GA4 Realtime shows `page_view` from your own visit; DevTools Network shows a `/g/collect` request with the new ID.
  - **Validation:** Visit 3 pages in an incognito window and confirm each appears in Realtime within 60 seconds. Submit one test enquiry *yourself* and confirm `generate_lead` fires.
  - **Success metric:** Organic sessions and organic `generate_lead` counts visible in GA4 within 48 hours.

- [ ] **A-02 · P0 · Give the audit tooling Search Console access (or export data)**
  - **Issue:** No Search Console data is available for morocco-quest.com; the service account only sees local-morocco-tours.com.
  - **Component:** Google Search Console property for morocco-quest.com.
  - **Action:** Either add `claude-seo@claude-seo-509618.iam.gserviceaccount.com` as a *Restricted* user on the `sc-domain:morocco-quest.com` property, or export: Performance (16 months, queries and pages), Pages (indexing) report, Sitemaps, Crawl stats → Host status, Links.
  - **Benefit:** Real rankings, impressions, indexation and crawl errors replace estimates.
  - **Effort:** S · **Dependencies:** owner · **Risk:** Low (read-only role)
  - **Acceptance:** `python scripts/gsc_query.py sites` lists morocco-quest.com.
  - **Validation:** Run a 28-day query and a URL inspection on `/dmc-marrakech`.
  - **Success metric:** Baseline clicks, impressions and indexed-page count recorded in the README measurement table.

---

## P1: high-impact fixes (days 1–30)

- [ ] **A-03 · P1 · Find the cause of cold-start stalls**
  - **Issue:** First requests after idle took 11–15.5 s, some connections timed out or were reset; warm requests take 0.45 s (F-7).
  - **Component:** Hosting (Apache, the host's nginx cache layer, PHP-FPM), Laravel page cache.
  - **Action:** Check Search Console → Settings → Crawl stats → Host status for DNS, connection and robots.txt failures. Ask the host whether the account is on a plan that suspends idle PHP workers or rate-limits connections. Review server error logs for the same times. Consider an uptime monitor that requests the homepage every 5 minutes (it also keeps the cache warm), and confirm the 6-hour page cache is not cleared more often than needed.
  - **Benefit:** Reliable crawling and fewer visitors abandoning a slow first page.
  - **Effort:** M · **Dependencies:** A-02 for crawl stats; host support · **Risk:** Low
  - **Acceptance:** Crawl stats show host status "no significant availability issues" for 90 days; 20 cold requests spaced 30 minutes apart all complete in under 2 s.
  - **Validation:** Uptime monitor history (response time and failures) over 14 days.
  - **Success metric:** Zero connection failures and 95th-percentile response under 1.5 s in the monitor.

- [ ] **A-04 · P1 · Stop linking to 404 tag pages**
  - **Issue:** 7 empty tags return 404 but appear in the tag sidebar on 110 pages (F-3).
  - **Component:** The tag sidebar/tag cloud partial used by `blog`, `blog-details` and archive views.
  - **Action:** Only list tags with at least one published post (for example `Tag::has('blogs')`), matching the rule that now 404s empty tags.
  - **Benefit:** Removes about 770 broken internal links; cleaner crawl.
  - **Effort:** S · **Dependencies:** none · **Risk:** Low
  - **Acceptance:** No page links to a URL that returns 404.
  - **Validation:** Re-run `evidence/technical/crawl.py`; the non-200 list is empty.
  - **Success metric:** 0 internal 404 links in the crawl.

- [ ] **A-05 · P1 · Fix the empty `/activities` page and settle its future**
  - **Issue:** `/activities` shows "No activity categories found" because `ActivityController::index()` passes `$activities` to a view that reads `$activityCategories`. It also duplicates `/experiences`' H1 and advertises products that are not sold (F-4).
  - **Component:** `app/Http/Controllers/ActivityController.php:138-180`, `resources/views/activity-categories.blade.php:69,77`, route group at `routes/web.php:89`.
  - **Action:** Short term: 301 `/activities` to `/experiences` (keep `/activities?category=x` working by redirecting to `/activities/category/x`), and remove it from the sitemap. Remove the camel/quad/Toubkal claims from the shared intro unless those products exist. This is owner decision O-3.
  - **Benefit:** Removes an empty indexable page and a duplicate; removes misleading claims.
  - **Effort:** S · **Dependencies:** O-3 approval · **Risk:** Low (check Search Console for any clicks to `/activities` first)
  - **Acceptance:** `/activities` returns 301 to `/experiences`; no page text promises unsold products.
  - **Validation:** `curl -I https://morocco-quest.com/activities`; read the `/experiences` intro.
  - **Success metric:** `/experiences` is the only URL getting impressions for activity-hub queries.

- [ ] **A-06 · P1 · One day-trips hub, linked from the menu**
  - **Issue:** "One-Day Tours" in the menu goes to `/experiences`, "Day Trips" goes to `/activities/category/day-trips`, and `/tours/type/one-day` is orphaned with "Unknown Location" on 12 cards (F-5).
  - **Component:** `resources/views/partials/header.blade.php`, `TourController` one-day method, `type-filter.blade.php:133`, `SitemapController`.
  - **Action:** Pick one hub. Recommended: `/activities/category/day-trips` (already linked and in the sitemap). 301 `/tours/type/one-day` to it, point the "One-Day Tours" menu item to it, and fix the "Unknown Location" fallback anywhere it remains.
  - **Benefit:** One URL collects all day-trip signals; menu labels match destinations.
  - **Effort:** M · **Dependencies:** O-3 · **Risk:** Medium (URL change; low traffic today)
  - **Acceptance:** One indexable day-trip hub; the menu label and target match; no "Unknown Location" text.
  - **Validation:** Crawl plus a manual menu check on mobile.
  - **Success metric:** Impressions for "day trips from marrakech" queries concentrate on one URL (Search Console, 8 weeks).

- [ ] **A-07 · P1 · Substantiate or remove unverifiable trust claims**
  - **Issue:** Awards on the homepage and About page don't match each other and can't be verified. The homepage has an empty testimonials heading. The same anonymous five-star testimonials repeat on every DMC page. "Licensed" appears with no licence number (F-8).
  - **Component:** `home.blade.php` awards and testimonials sections, `about.blade.php` awards, DMC testimonial partial, DMC hero stats.
  - **Action:** Keep only awards you can prove (link the certificate or listing). Replace anonymous testimonials with attributable ones (name, company, with permission) or link to a third-party review profile. If the shared testimonials are not real client quotes, remove them now. Publish the tourism licence (ODV/agency) number in the footer, on `/about` and on `/dmc-marrakech`.
  - **Benefit:** Trust for B2B buyers and quality raters; removes consumer-protection risk from unverifiable reviews.
  - **Effort:** M · **Dependencies:** owner evidence (O-5, O-6, O-9) · **Risk:** Low
  - **Acceptance:** Every award and testimonial on the site can be traced to a source; the licence number is visible on 3 pages.
  - **Validation:** Manual review against the evidence folder; a second person can verify each claim from a link.
  - **Success metric:** DMC enquiry rate (after A-01) and qualitative buyer feedback.

- [ ] **A-08 · P1 · Separate the incentive blog post from the service page**
  - **Issue:** The blog post "Incentive Trips in Marrakech & Agafay…" ranked #9 for "incentive travel morocco" on 28 September while `/team-building-marrakech` did not appear. The post's title ends with "Morocco DMC".
  - **Component:** That blog post's content and SEO title (Filament); `/team-building-marrakech`.
  - **Action:** Keep the post as the informational guide. Remove "Morocco DMC" from its title. Add 2–3 contextual links in the body: "incentive travel and team building in Marrakech" → `/team-building-marrakech`, "Morocco DMC services" → `/dmc-marrakech`, "meetings and conventions in Marrakech" → `/meetings-conventions-management`. Do **not** redirect or merge it.
  - **Benefit:** Passes the post's relevance to the service page without losing its ranking.
  - **Effort:** S · **Dependencies:** none · **Risk:** Low
  - **Acceptance:** The post links the 3 service pages with descriptive anchors.
  - **Validation:** View source; crawl inlinks for `/team-building-marrakech` increase.
  - **Success metric:** `/team-building-marrakech` gains impressions for "incentive travel morocco" in Search Console within 8–12 weeks.

- [ ] **A-09 · P1 · Correct product data errors**
  - **Issue:** 8-day tour shows "Day 01" twice and no Day 08; the Sahara tour lists its desert camp under "Dades" (F-9). These feed the TouristTrip itinerary schema.
  - **Component:** Tour records in Filament.
  - **Action:** Fix the day numbering and accommodation grouping. Re-read each tour's itinerary against its night count.
  - **Effort:** S · **Dependencies:** owner (O-8) · **Risk:** Low
  - **Acceptance:** Day numbers run 01 to N with no repeats; each hotel or camp is under the correct stop.
  - **Validation:** Read each tour page; check the JSON-LD `itinerary` list.
  - **Success metric:** No factual errors on product pages.

- [ ] **A-10 · P1 · Decide on visible prices**
  - **Issue:** All tours and activities say "Price On Request" while tour pages promise "Best Price". Pages that rank for Sahara and private-tour queries show prices (prior SERP evidence).
  - **Component:** Tour and activity templates, Filament price fields.
  - **Action:** Show "From $X per person" (or EUR, one currency) where a price exists. If prices stay hidden, remove "Best Price" wording. If prices are shown, add a matching `offers` block to the TouristTrip schema.
  - **Effort:** M · **Dependencies:** owner decision (O-4) · **Risk:** Low
  - **Acceptance:** Every product shows either a real "from" price or no price claim at all; schema matches the page.
  - **Validation:** Google Rich Results Test on one tour.
  - **Success metric:** Click-through rate on tour pages (Search Console) and product-page enquiry rate (GA4).

---

## P2: improvements (days 8–60)

- [ ] **A-11 · P2 · Migrate `%20` type URLs to slugs**
  - **Issue:** `/tours/type/Garden%20Tours` and `/tours/type/garden-tours` (and Art, Classical) are duplicate indexable pages (F-6).
  - **Component:** `header.blade.php`, `SitemapController`, `TourController::showByType`.
  - **Action:** 301 each `%20` URL to its slug, link the slug in menu and sitemap, delete `/urllist.txt`.
  - **Effort:** S · **Dependencies:** O-2 · **Risk:** Low
  - **Acceptance:** No `%20` URL in menu, sitemap or crawl; old URLs return 301.
  - **Validation:** Crawl and `curl -I`.
  - **Success metric:** One URL per tour type in Search Console.

- [ ] **A-12 · P2 · Add internal links to weakly linked products and cities**
  - **Issue:** 9 activities are linked from one page only; Casablanca, Chefchaouen and Essaouira destination pages from two.
  - **Component:** Destination, tour and blog templates/content.
  - **Action:** Add links from each destination page to its activities; from tours to activities that fit their route (for example the Sahara tour → hot air balloon); from relevant blog posts to products. See the internal-link table in the README.
  - **Effort:** M · **Dependencies:** none · **Risk:** Low
  - **Acceptance:** Every activity has at least 3 linking pages other than listings.
  - **Validation:** Re-run the crawl and the inlink count.
  - **Success metric:** Impressions for activity pages (Search Console) after 8 weeks.

- [ ] **A-13 · P2 · Write real intros for thin hubs**
  - **Issue:** 4 activity categories have 91–152 words of main content; 6 destination pages have 186–253.
  - **Component:** Category and destination records or views.
  - **Action:** For each, write 150–300 words that only that page can say: what is offered there, typical duration and price band, best season, where tours start, and links to the products. No city-swap templates.
  - **Effort:** M · **Dependencies:** owner knowledge · **Risk:** Low
  - **Acceptance:** Each page has unique, specific copy; no shared paragraph between two pages.
  - **Validation:** Text comparison across pages (the crawl's `text_sample`).
  - **Success metric:** Impressions per destination page.

- [ ] **A-14 · P2 · Consolidate blog categories**
  - **Issue:** 34 blog category archives are indexable, outside the sitemap, mostly holding 1–2 posts, with duplicates (`morocco-travel` vs `morocco-travel-1`) and typos (`travel-avice`).
  - **Component:** Categories in Filament; `CategoryController`/blog archive view.
  - **Action:** Reduce to about 6 real topics (for example Sahara & desert, Marrakech, Imperial cities, Travel planning, MICE & incentives, Culture & festivals). Merge the rest with 301s (slug changes are now redirect-tracked). Noindex any category with fewer than 3 posts.
  - **Effort:** M · **Dependencies:** O-12 · **Risk:** Low
  - **Acceptance:** No indexable archive with fewer than 3 posts; no duplicate titles.
  - **Validation:** Crawl.
  - **Success metric:** Indexable URL count drops by about 28 without loss of clicks.

- [ ] **A-15 · P2 · Performance on inner pages**
  - **Issue:** Font Awesome Pro adds 0.64–1.8 MB on inner pages; the preloader logo is the LCP element on 6 of 8 sampled pages; Maps loads without interaction on product pages (F-13).
  - **Component:** `layouts/app2.blade.php`, preloader partial, tour/activity map embed.
  - **Action:** Run the read-only O-15 query; if 0, subset Font Awesome like the homepage. Decide on the preloader (O-16): remove it on inner pages or cap it at under 1 s. Replace the Maps iframe with a static image or "Show map" button that loads the iframe on click.
  - **Effort:** M · **Dependencies:** O-15, O-16 · **Risk:** Medium (visual QA needed)
  - **Acceptance:** Inner-page font transfer under 150 KB; LCP element is the page hero, not the logo; no Maps requests before interaction.
  - **Validation:** PageSpeed Insights, median of 3 runs, mobile, on `/tours`, one tour, one activity.
  - **Success metric:** Lab LCP under 2.5 s; CrUX field data once available.

- [ ] **A-16 · P2 · Structured data clean-up**
  - **Issue:** Blog image URLs contain raw spaces; `/tours/type/*` have no BreadcrumbList or ItemList; `touristType` is hard-coded; `/contact` re-declares the business with a different phone format (F-12).
  - **Component:** `blog-details.blade.php:18-21`, `type-filter.blade.php`, `tour-detail.blade.php:33`, `activity-detail.blade.php:19`, `contact.blade.php:30-31`.
  - **Action:** URL-encode image paths (`rawurlencode` the filename); add Breadcrumb + ItemList to type pages; derive `touristType` from the tour's real type or drop it; reference the global `#organization` node on `/contact` instead of redeclaring it.
  - **Effort:** S · **Dependencies:** none · **Risk:** Low
  - **Acceptance:** Rich Results Test passes with no warnings on a blog post and a type page.
  - **Validation:** Rich Results Test and Schema.org validator.
  - **Success metric:** Search Console Enhancements show 0 invalid items.

- [ ] **A-17 · P2 · Correct the keyword-to-page targets that don't match intent**
  - **Issue:** `/experiences` (a product grid) targets "things to do in morocco"; `/faq` targets "is morocco safe" while a dedicated blog post exists (KEYWORD-MAP.csv).
  - **Component:** SEO titles/descriptions for `/experiences`, `/faq`, the top-10 experiences post and the safety post.
  - **Action:** Give `/experiences` a commercial target ("Morocco day tours & activities"). Let the top-10 post target "things to do in morocco". Let the safety post own "is morocco safe"; the FAQ links to it.
  - **Effort:** S · **Dependencies:** A-05 · **Risk:** Low
  - **Acceptance:** One page per intent in KEYWORD-MAP.csv.
  - **Validation:** Search Console queries per page after 8 weeks.
  - **Success metric:** Fewer pages sharing the same top queries.

- [ ] **A-18 · P2 · Build the Sahara hub (only with a real 2–3 day product)**
  - **Issue:** The only Sahara product is a 5-day luxury tour at "Price On Request"; three blog posts overlap it.
  - **Action:** If you operate it, publish a 3-day Marrakech–Merzouga private tour with a "from" price, and a Sahara hub page comparing 2-, 3- and 5-day options and Agafay vs Erg Chebbi. Link the desert blog posts to the hub. Merge the thin Agafay-vs-Sahara post into the hub or the camps post (301), after checking its clicks.
  - **Effort:** L · **Dependencies:** O-10, A-10 · **Risk:** Low
  - **Acceptance:** Hub plus product live, linked from home, `/tours` and the desert posts.
  - **Validation:** Crawl and Search Console.
  - **Success metric:** Impressions and enquiries for Sahara queries after 12 weeks.

- [ ] **A-19 · P2 · Editorial guides with first-hand detail**
  - **Action:** "Things to do in Marrakech" (linking to activities) and "7-day Morocco itinerary" (linking to multi-day tours). Use your own photos, guide names, real drive times, costs and seasonal advice.
  - **Effort:** L · **Dependencies:** A-12 · **Risk:** Low
  - **Acceptance:** Each guide is clearly written from experience, has original photos and at least 5 product links.
  - **Success metric:** Impressions and clicks per guide; assisted enquiries in GA4.

- [ ] **A-20 · P2 · Fix or remove the sitewide outbound resources block**
  - **Issue:** Every page carries 11 outbound "travel resources" links; two return 404, and one page has a malformed X link (F-14).
  - **Action:** Replace the 404 links, fix the X profile link, and consider showing the block only on `/faq` or blog pages.
  - **Effort:** S · **Risk:** Low
  - **Acceptance:** 0 broken outbound links in the crawl.

- [ ] **A-21 · P2 · Google Business Profile and review profile clean-up**
  - **Action:** Complete the "Morocco Quest DMC" profile (category, website, full address, photos, services), ask real clients for reviews, and resolve the duplicate TripAdvisor listings (O-17). Use one brand name across the site schema and profiles.
  - **Effort:** M · **Dependencies:** owner accounts · **Risk:** Low
  - **Acceptance:** Profile 100% complete; one TripAdvisor listing linked from the site.
  - **Success metric:** Appearance in the local pack for "dmc marrakech" (manual check monthly); review count.

---

## P3: longer-term and small items (days 31–90)

- [ ] **A-22 · P3 · Mobile polish:** replace "Select Division" with "Destination or activity"; enlarge sub-24 px tap targets (social icons); add "All tours" and "Destinations" to the mobile menu. *S · Acceptance:* no placeholder text; menu matches desktop hubs.
- [ ] **A-23 · P3 · Authority building:** apply for the official Marrakech MICE / DMC listings, join SITE or MPI only if it is a real business fit, ask partner hotels, riads and camps for a partner-page link, and pitch the 2027 Tangier eclipse guide to travel press. *L · Success:* new relevant referring domains (Search Console Links).
- [ ] **A-24 · P3 · Refresh or retire dated content:** "Morocco's must-see festivals and moussems in 2025 and 2026". *S.*
- [ ] **A-25 · P3 · French pilot (deferred):** one French DMC page with hreflang, only after A-07 and only if French-speaking buyers are confirmed in enquiries. *L.*
- [ ] **A-26 · P3 · Keep llms.txt current** whenever URLs change (A-05, A-06, A-11). *S.* This is an AI-search convenience, not a Google ranking factor.

---

## Dependency map

- A-01 and A-02 come first: they create the baseline used to judge everything else.
- A-05 → A-06 → A-17 (settle the hub URLs before retargeting keywords).
- A-07 and A-10 need owner evidence and decisions; start collecting it on day 1.
- A-10 → A-18 (a Sahara product page without a price repeats the current gap).
- A-12 → A-19 (guides need well-linked products to point at).
