# SERP / competitor / keyword-intent findings, morocco-quest.com (2026-10-14)

Read-only. Nothing in the repo was edited.

## 0. Method and limits (read first)

| Item | Detail |
|---|---|
| Tool used | WebSearch, standard mode, one call per query, 2026-10-14. **This is NOT Google and has no locale control** (it is US-only). Order of results is indicative only and is never reported as a rank. |
| Playwright scraper (`scripts/serp-audit`) | Present (`serp_scrape.py`, `run_all.py`). **Not run.** It is hard-wired to one query ("dmc marrakech", `common.py`), opens headed Chromium and applies anti-automation-detection patches (STEALTH_JS), so it cannot run unattended. Running it here would mean evading Google's bot checks without a human present. Google gl=ma rank re-checks need an operator to run it manually, or GSC / a rank tracker. |
| Morocco Quest presence today | **morocco-quest.com did not appear in any of the 26 WebSearch result sets**, including a brand query ("morocco-quest.com"), which returned unrelated "quest" pages. Because this search index differs from Google, treat this as "not observed in this tool", not "not ranking". |
| Positions quoted for MQ | Only those from the prior audit: Google, gl=ma, hl=en, 2026-09-28 (`docs/reports/SEO_AUDIT_2026-09-28.md` §E). They were **not re-observed today**. |
| Competitor pages | Fetched with WebFetch, which returns converted page text. Competitor JSON-LD is NOT visible, so competitor schema is "not assessed". MQ schema was read directly from the HTML. |
| Numbers | Search volume / KD appear only as "Semrush data per repo file (`docs/seo-fix/KEYWORD_MAP.md`), US database, dated 2026-09-30, unverified today". |
| Not assessed | Google AI Overviews, PAA, local packs, SERP features for gl=ma, French-locale SERPs beyond two WebSearch queries, backlinks, GSC. |
| Fetch failures | Intrepid page fetch returned 404 (details come from search snippets); accessmorocco.com fetch failed (Access details come from search snippets, self-reported). |

## 1. Headline observations

1. **B2B SERPs are mixed-intent and thin on strong commercial pages.**
   - For "dmc morocco" and "destination management company morocco", results combine DMC homepages and trade pages (Journey Beyond Travel, Attendance, Local Morocco Tours, Access Morocco), trade-press profiles and directories.
   - The ambiguous term "DMC" also returns a car-parts factory (Dika Morocco Castings).
2. **Competitor DMC pages lead with verifiable trust that MQ lacks.**
   - Local Morocco Tours shows a guide licence number, a 2012 founding year, a TripAdvisor 4.9 rating and six named testimonials.
   - Access Morocco claims founding in 2007, 60+ staff, a SITE Crystal Award and DMC Network membership (self-reported, from search snippets).
   - MQ `/dmc-marrakech` has about 3,900 words but no licence number, no memberships, no named clients, and testimonials by first name and city only. It has no aggregate rating.
3. **Cannibalization is confirmed on the MQ site, though not re-observed in today's SERPs.**
   - The blog post "Incentive Trips in Marrakech & Agafay" has the title tag "Marrakech & Agafay Incentive Trips | Morocco DMC".
   - It is about 3,280 words, versus about 1,770 on `/team-building-marrakech` (title "Team Building Marrakech | Incentive Travel Morocco").
   - The prior audit saw Google rank the blog #9 for "incentive travel morocco" while the service page did not appear.
4. **B2C: MQ's product pages are a different page type from what wins.**
   - Winning results show prices, review counts and 2-3 day products (Intrepid, marketplaces).
   - MQ shows "Price On Request" on all 8 tours, no reviews anywhere, and no Offer/Review/AggregateRating schema on the tour page (only TouristTrip).
5. **Product/page gaps (no URL in the sitemap):** Ait Benhaddou / Ouarzazate day trip, Agafay dinner, Merzouga 2-3 day product, family tours, a Morocco itinerary guide, a Casablanca DMC page, French pages.
6. **`/experiences` is a category page, not a listicle.** About 330 words, six categories (23 activities in total), no prices. For "things to do in marrakech" the result types are editorial listicles (G Adventures, Contiki, Airalo, Fora, bloggers). Its copy also mentions quad biking and a belly-dancer show; the sitemap has no such activity pages, so check the copy against what is sold.

## 2. Per-query tables

"Not observed" means not seen in WebSearch (US, 2026-10-14; not Google). Prior Google positions are quoted only where the 2026-09-28 audit recorded them.

### 2.1 B2B / DMC / MICE

| Query | Dominant intent / page type (observed) | Competitor URLs seen | MQ presence | MQ target URL and fit | Gap | Action | Priority | Confidence |
|---|---|---|---|---|---|---|---|---|
| dmc morocco | Commercial B2B DMC homepages and trade pages, mixed with trade-press profiles. "DMC" is ambiguous. | journeybeyondtravel.com/morocco/destination-management-company; travelcourier.ca (Attendance DMC profile); adalte.com (Atlas Voyages catalog); traveldailynews.com (Access) | Not observed. Prior Google gl=ma: not in top ~20. | `/dmc-marrakech` (fetched). Good fit (H1 "Morocco DMC & DMC Marrakech", net-rate form, FAQ, FAQPage/Service schema). | Trust evidence (see §3); no press or directory presence. | Add licence number, memberships, named clients or logos, case studies, rating. Get listed in trade press / directories. | P1 | Medium: tool is not Google. |
| destination management company morocco | Competitor DMC pages (Journey Beyond Travel on two URLs) plus press and directories. | journeybeyondtravel.com (/morocco/destination-management-company and /?p=10061 duplicate); cmacgroup.com blog; imexevents.com exhibitor pages; magpie.travel | Not observed. Prior: not in top ~19. | `/destination-management-company` (fetched, ~1,890 words). Title retargeted to "What Is a DMC?" (explainer) but this query is commercial. | Explainer-vs-commercial mismatch. Two MQ pages claim "DMC Morocco". | Make `/dmc-marrakech` the commercial target. Keep the explainer informational and cross-link. See §4. | P1 | Medium |
| dmc marrakech | Commercial B2B, including exact-match pages. | local-morocco-tours.com/dmc-marrakech/ and /dmc-morocco/; travelcourier.ca (Attendance); eglobaltravelmedia.com.au (Access Marrakech opening); slideshare (Extra Mile sample incentive) | Not observed. Prior: ~#35 (repo data 2026-08-26). | `/dmc-marrakech`. Good fit. | Trust and licence proof; no press mentions. | Same as above, plus a sample programme PDF and a Google Business Profile. | P1 | Medium |
| dmc casablanca | Results not DMC-relevant (shore excursions, jobs). SERP weak; page type unclear. | expedia.com (Travel Gateway DMC shore excursion); jobsquare.ma | Not observed. | No Casablanca-specific MQ page; `/dmc-marrakech` has an "all of Morocco" section. | No Casablanca DMC page. | Low priority; consider a short Casablanca section. Re-check in Google first. | P3 | Low |
| morocco incoming tour operator | Mixed: directories, trade-news profiles, operator pages. | annuaire-gratuit.ma (Morocco Incoming); kerix.net (Monarch Travel); magpie.travel (Safe Morocco Travels); go2hr.ca | Not observed. | `/dmc-marrakech` (trade copy, net rates). Partial. | Wording/long-tail only. | Add "inbound / incoming tour operator" wording; no new page. | P3 | Low |
| incentive travel morocco | Editorial and trade-press guides and case studies, plus DMC pages. | invoyage.net (editorial, ~1,100 words, no DMC named); siteglobal.com Access case study PDF; micebook.com; commsbusiness.co.uk; genuinemorocco.com | Not observed. Prior Google: #9 **via the blog post, not the service page**. | `/team-building-marrakech` (title includes "Incentive Travel Morocco") vs the blog post. | Cannibalization; no standalone incentive page; no case study. | Differentiate (§4). Build a case-study-led incentive page. | P1 | Medium |
| mice morocco | Ambiguous: WebSearch returned rodent/wildlife pages. | none relevant | Not observed. | `/meetings-conventions-management` (title "MICE Marrakech", ~1,490 words). | Query not assessable in this tool. | Re-test in Google gl=ma as "mice morocco" and "mice marrakech". | P3 | Low |
| corporate events morocco | Venue and vendor listings plus event vendors. | retreatsandvenues.com; kasbahdutoubkal.com/corporate; boutiquesouk.com/events; goodfirms.co (Newcom Morocco); travelfeed.com | Not observed. | `/events-production-morocco` (title "Corporate Events Morocco \| Event Production Marrakech"). | Query is vendor/venue-led; MQ page is a production page. | Keep. Add client references and corporate-events wording in H2s. | P2 | Low |
| meetings and conferences morocco | Informational (UIA statistics, event listings, ONMT guide). | uia.org; travelfeed.com; traveldailynews.com; ccme.org.ma | Not observed. Prior: "meetings and conventions marrakech" ~#15. | `/meetings-conventions-management`. | Wrong intent for a service page. | Do not chase. Optional data-led "Morocco as a MICE destination" guide. | P3 | Low |
| team building marrakech | Activity lists and agency pages. | surfoffice.com/team-building/marrakesh; waterbynature.com; jobsquare.ma blog; agency.aleia.io; goafricaonline.com | Not observed. Prior: not verified (scrape invalid). | `/team-building-marrakech` (fetched). Title on-target; H1 is a slogan. | H1 lacks the keyword; unsourced metrics ("100% on-site team delivery"); no named case. | Rewrite H1 to carry "Team Building Marrakech". Add an activity-format table and a named case. | P2 | Medium |
| event production morocco | Studios and agencies (Casablanca, Marrakech), directories. | goodfirms.co/company/diese-event; newswire.ca (Touareg Prod'); kerix.net; clutch.co/ma/agencies/event; boutiquesouk.com/events | Not observed. Prior: **#5** (gl=ma). | `/events-production-morocco`. Fits. | Competitors show equipment and clients. | Protect. Add equipment detail and project references. | P2 | Medium (prior rank not re-verified) |
| sustainable events morocco | Informational and event-industry news (ISO 20121 COP22 PDF, trade fairs). | unfccc.int (ISO 20121 at COP22); moroccoworldnews.com; globy.com; afrik21.africa | Not observed. Prior: **#3**. | `/sustainable-events-morocco`. | Little service-provider competition. | Protect; no change. | P3 | Medium (prior rank not re-verified) |
| dmc maroc (FR) | Same operators as English, plus a Moroccan trade press item. | journeybeyondtravel.com (EN page appears on FR query); tourmag.com (Event and Events / Interface DMC); adalte.com; ma.indeed.com | Not observed. Prior: not seen. | None. MQ has no French pages (prior audit §J). | No FR content. | Defer until EN trust signals are in place; then consider one FR DMC page. | P3 | Low |
| agence événementielle marrakech (FR) | Directory-led. | annuaire-gratuit.ma; telecontact.ma; mariages.net (MAEV); kerix.net | Not observed. | None. | FR, wedding/directory intent. | Not a priority; directory citations (telecontact) are a cheap option. | P3 | Low |

### 2.2 B2C tours

| Query | Dominant intent / page type (observed) | Competitor URLs seen | MQ presence | MQ target URL and fit | Gap | Action | Priority | Confidence |
|---|---|---|---|---|---|---|---|---|
| private morocco tours | Operator pages with itineraries and "from" prices, plus aggregator pages. | sun-trails.com/private-morocco-tours; onthegotours.com; magpie.travel/companies/private-morocco-tours; moroccofriendlytravel.com; gateway2morocco | Not observed. Prior: not in top ~20. | `/tours` (8 tours; fetched) and home. Partial fit: all 8 "Price On Request", no reviews. | No price signal; no reviews; no proof. | Show "from" prices; add reviews and a third-party review profile. | P1 | Medium |
| luxury morocco tours | Luxury operators and editorial; all show prices or ranges. | scottdunn.com/morocco/tours; roughguides.com/morocco/tours/morocco-luxury-tour; virtuoso.com; artisansofleisure.com; sun-trails.com/morocco-luxury-tours | Not observed. | `/tours` (all titles say "Luxury"). | Strong brands dominate the head term. | Target long-tail ("8 day luxury Morocco tour", "luxury Sahara camp"). | P2 | Medium |
| morocco itinerary | Editorial itineraries (7, 10, 14 days). | lonelyplanet.com/articles/best-morocco-itineraries; roughguides.com/morocco/itineraries; travelstride.com/i/morocco-itinerary; theworldtravelguy.com; bigworldsmallpockets.com | Not observed. | No itinerary guide. Closest: blog "Ultimate Guide to MQ Multi-Day Tours" (a brochure). | Page-type gap. | Publish "7 days in Morocco" with embedded tour links. | P1 | Medium |
| things to do in marrakech | Editorial listicles and guides. | gadventures.com/blog/things-to-do-in-marrakech; contiki.com; airalo.com/blog; foratravel.com; imvoyager.com | Not observed. Prior: not seen. | `/experiences` (~330 words, six categories, no prices). Wrong page type. | Real guide missing. | Build a long-form guide at a blog URL; link to the activities. | P1 | Medium |
| sahara desert tours from marrakech | Product pages; one operator with many locale URLs, plus marketplaces. | intrepidtravel.com/{eu,uk,nl,ie,de,za,mt,au...}/morocco/sahara-desert-from-marrakech | Not observed. Prior: not in top ~20. | `/tours/5-day-marrakech-sahara-luxury-desert-discovery-adventure-tour` (fetched): 5 days, Price On Request, no reviews. | Only a 5-day product; competitors sell 3-day. No FAQ; no review markup. | Create a Sahara hub with 2-3 products, prices, reviews, FAQ. | P1 | Medium |
| merzouga tours | Marketplace/aggregator listings (3-day private tours listed from $549 to $1,414 per person across sites). | headout.com/merzouga-desert-tours; magpie.travel; uk.trip.com; moroccofriendlytravel.com; expedia/travelocity | Not observed. Prior: not seen. | The same 5-day tour; blog posts "Luxury Sahara Desert Tour" and "Luxury Morocco Desert Camps". | No Merzouga 2-3 day product. | Fold into the Sahara hub or add a Merzouga product. | P2 | Medium |
| ait benhaddou tour | Day-trip product pages from Marrakech. | airbnb.com/experiences/7204467; hellotickets.com; headout.com; travelstride.com | Not observed. | No page; it is a stop in the 5-day tour. | No product. | Add a private day trip only if it is operationally sold. | P2 | Medium |
| agafay desert dinner | Marketplace and hotel listings (about $39-217 pp). | byfood.com; barcelo.com; musement.com; expedia.com; fourseasons.com | Not observed. | No product; blog posts mention Agafay. | No product page. | Add only if MQ sells it (O-10 in the prior audit). | P3 | Medium |
| morocco cultural tours | Aggregator listing pages. | travelstride.com/ltt/morocco-culture-tours; travelstride.com/trip-list/morocco-cultural | Not observed. | `/tours` (6-day Royal Cities, 8-day Cultural). | Aggregator-led. | Use "cultural" wording in tour H1/H2; no new page. | P3 | Low (only 2 results returned) |
| morocco family tours | Operator pages and guides. | explore.co.uk; onthegotours.com; responsibletravel.com; kerdowney.com; encounterstravel.com | Not observed. | No page (blog "Family travel in Morocco" is informational). | No product. | Only if MQ runs family departures. | P3 | Low |

Semrush data per repo file `docs/seo-fix/KEYWORD_MAP.md`, US database, dated 2026-09-30, unverified today (volume / KD): morocco dmc 260/0; dmc marrakech 40/12; destination management company 2,900/19; what is a dmc 480/16; team building marrakech 50/2; private morocco tours 320; luxury morocco tours 320; morocco itinerary 720; morocco itinerary 7 days 320/8; things to do in marrakech 2,900/24; sahara desert tours from marrakech 170/15; marrakech to merzouga tour 110; agafay desert dinner 40/10; morocco family tours 170/23. This is a US database, so it may not reflect B2B buyers in other markets.

## 3. Competitor comparison, top three commercially important queries

All "observed" statements come from WebFetch text on 2026-10-14. Competitor schema is **not assessed**. MQ schema was read from the HTML.

### 3.1 dmc marrakech / dmc morocco

| Dimension | Local Morocco Tours (/dmc-marrakech/) | Journey Beyond Travel (/morocco/destination-management-company) | Morocco Quest (/dmc-marrakech) |
|---|---|---|---|
| Title / H1 | Title "DMC Marrakech & Morocco - Ground Handler for Travel Agents"; H1 "DMC Marrakech: net rates in 24 hours, white-label on the ground." | H1 "Destination Management Company (DMC) in Morocco" | Title "Morocco DMC Marrakech \| MICE & Incentive Travel"; H1 "Morocco DMC & DMC Marrakech - Destination Management & MICE" |
| Depth (approx.) | ~1,600-2,000 words | ~2,000-2,300 words | ~3,900 words |
| Structure | Trade-process led: how we contract, net rates, match your group | Trade terms: deposits, FOC, net rates, FAM trips | Broad hub: services, incentives, team building, FAQ |
| Trust evidence | Founded 2012; Ministry of Tourism licence; founder guide licence MA76175; TripAdvisor 4.9 and badge shown; six named testimonials with job titles | Founded about 2007; two guidebooks by the director; TripAdvisor link only; no client names or licence number | "Ministry of Tourism licensed" but no number; no memberships; no named clients; four testimonials (first name + city); anonymised example programmes; stats unsourced |
| Schema | Not assessed | Not assessed | TravelAgency, Service, FAQPage, BreadcrumbList |
| CTA / enquiry | "Request net rates" form (24h reply), WhatsApp ops desk, phone | Email / phone; US $479 pp deposit for new partners | B2B quote form, WhatsApp, email, phone |

- **Observation:** MQ matches or exceeds these competitors on depth and schema, and lags on verifiable trust (licence number, ratings, named clients).
- **Hypothesis (unproven):** the trust gap, not content volume, is the likeliest reason MQ trails; ranking factors are not measurable here.

### 3.2 incentive travel morocco

| Dimension | Access Holidays & Events / Access Morocco (search snippets; site fetch failed) | inVOYAGE editorial article | Morocco Quest (/team-building-marrakech + blog post) |
|---|---|---|---|
| Format | DMC site plus a SITE case study PDF | Trade-press editorial, ~1,100 words, no DMC named | Service page (~1,770 words) and blog post (~3,280 words, title "Marrakech & Agafay Incentive Trips \| Morocco DMC") |
| Trust evidence (self-reported) | Founded 2007; offices in Casablanca and Marrakech; 60+ staff; SITE Crystal Award case study; DMC Network partner (2024) | Third-party editorial | Anonymous testimonials; no award, membership or named case |
| Schema | Not assessed | Not assessed | Service/FAQPage on the service page; BlogPosting on the blog |
| CTA | Not fetched | None | "Request a Proposal" form, WhatsApp |

- **Observation:** the dominant evidence types in this SERP are case studies and editorial guides, not service pages. The MQ blog post is the larger, more targeted asset.
- **Hypothesis:** an incentive page built around a documented, named programme would outperform the generic service page.

### 3.3 sahara desert tours from marrakech (B2C)

| Dimension | Intrepid Travel (from search snippets; page fetch returned 404) | Morocco Quest 5-day tour (fetched) |
|---|---|---|
| Product | 3-day Marrakech to Sahara via Todra Valley and Ait Benhaddou | 5 days / 4 nights (Marrakech, Ait Benhaddou, Dades, Todgha, Erg Chebbi camp) |
| Price | Displayed ("lowest-priced upcoming departure") | "Price On Request" |
| Reviews | Rating 4.9; about 101-237 reviews depending on the country page | None shown |
| Duplicates | Same page on roughly ten country folders | n/a |
| Schema | Not assessed | TouristTrip + BreadcrumbList; no Offer, Review or AggregateRating |
| CTA | Date-based booking (per snippet) | "Send Inquiry" form, WhatsApp |
| Content issues | n/a | Camp listed under the "Dades" heading in Accommodation; "4 nights" but only 3 clearly assigned; no FAQ on the page |

- **Observation:** MQ's product is a longer, higher-end, request-only format. The SERP rewards short priced and reviewed products.
- **Hypothesis:** a priced 3-day private option plus reviews is a more realistic target than the head term.

## 4. Cannibalization (MQ-side evidence; SERP evidence is from the prior audit)

| Pair | Evidence | Treatment |
|---|---|---|
| Blog "Incentive Trips in Marrakech & Agafay" vs `/team-building-marrakech` | Both target incentive travel. Google ranked the blog #9, not the service page (prior audit, 2026-09-28). | Make the blog an editorial guide (re-title away from "Morocco DMC"), link it to the service page; add an incentive section or page with a named case. |
| `/dmc-marrakech` vs `/destination-management-company` | Both target "DMC Morocco"; the second is retitled "What Is a DMC?" while the SERP for "destination management company morocco" is commercial. | Keep the commercial target on `/dmc-marrakech`; keep the explainer informational and link it. |
| Blog "Unlocking Marrakech: the Ultimate Hub for MICE Experiences" (~1,050 words) vs `/meetings-conventions-management` | Both target MICE Marrakech. | Cross-link; keep the blog editorial. |
| Blogs "Luxury Sahara Desert Tour in Morocco", "Luxury Morocco & Desert Camps", "Agafay vs Sahara" vs the Sahara tour page | Overlapping desert topics. | Consolidate into one Sahara hub plus an Agafay comparison (as the prior audit recommended). |
| `/activities` vs `/experiences` | Same H1 in the prior audit (not re-checked today). | Per the prior audit. |

## 5. Competitor set (by SERP overlap in today's results plus prior audit)

| Competitor | Type | Queries where it appeared (WebSearch today unless marked) |
|---|---|---|
| journeybeyondtravel.com | DMC / inbound tour operator (US-Morocco) | dmc morocco, destination management company morocco, dmc maroc |
| Attendance DMC (attendance.ma) | DMC | dmc morocco, dmc marrakech; prior audit |
| local-morocco-tours.com | DMC / ground handler | dmc marrakech (two URLs) |
| Access Holidays & Events (Access Morocco) | MICE / incentive DMC | incentive travel morocco, destination management company morocco, dmc morocco |
| Extra Mile "Morocco DMC" | DMC | dmc marrakech, dmc maroc |
| nolimits.ma, originallymorocco, visitmoroccodmc, your-morocco-dmc | DMC | prior audit only (not re-observed) |
| sun-trails.com | Private-tour operator | private morocco tours, luxury morocco tours |
| moroccofriendlytravel.com | Tour operator | private morocco tours, merzouga tours, family tours |
| Intrepid Travel | Group-tour brand | sahara desert tours from marrakech |
| Marketplaces (GetYourGuide, Viator, TripAdvisor in prior audit; Expedia, Headout, Magpie, Musement, byFood today) | Marketplace | merzouga, ait benhaddou, agafay dinner |
| Boutique Souk, Dièse Event, Touareg Prod' | Event production / vendors | corporate events, event production |

## 6. Sources

- Semrush data per repo file `docs/seo-fix/KEYWORD_MAP.md`, dated 2026-09-30, unverified today.
- Prior Google positions: `docs/reports/SEO_AUDIT_2026-09-28.md` §E, F, G (gl=ma).
- MQ title/H1/schema/word counts extracted directly from live HTML on 2026-10-14 by a temporary script (kept outside the repo).
