# Keyword map (Semrush US, 2026-09-30)

**Rule:** one primary keyword per page, so no two pages compete for the same query.

**Where the data comes from:**
- Semrush Keyword Overview, **US database** (`mounir keywords.xlsx`, 211 keywords with data).
- Volume = monthly searches (US). KD = keyword difficulty (0–100).
- Rankings noted as "rank #N" come from the live Google check on 2026-09-28.

## Code pages (branch `seo/keyword-mapping-2026-09`)

| Page | Primary (vol / KD) | Secondary | New title | Why |
|---|---|---|---|---|
| `/` | morocco tours (2900 / 41) | private morocco tours (320), morocco desert tour (390) | Private Morocco Tours & Sahara Desert Trips \| Morocco Quest | The biggest head term plus the top B2C modifier. The H1 already says "Morocco Tours & Private Sahara Desert Trips". |
| `/tours` | morocco travel packages (1900 / **18**) | morocco tour packages (720 / 30), morocco vacation packages (1000), morocco group tours (210) | Morocco Tour & Travel Packages \| Private Trips \| Morocco Quest | Highest volume at the lowest KD in the dataset. H1 is now "Morocco Tour Packages". |
| `/tours/type/multi-day` | 5 day morocco tour (110 / 8) | 9 day (30), 6/8 day, morocco multi day tours | Morocco Multi-Day Tours \| 5 to 9 Day Itineraries \| Morocco Quest | Also fixes the false "3, 5 & 7 day" claim: the tours are 5, 6, 8 and 9 days. |
| `/experiences` | things to do in morocco (4400 / **10**) | things to do in marrakech (2900 / 24), morocco activities (110) | Things to Do in Morocco & Marrakech \| Morocco Quest | Largest easy opportunity. The description no longer lists unsold camel/quad rides. |
| `/activities/category/city-tours` | casablanca city tour (260 / 18) | marrakech medina tour (90), fes medina tour | Morocco City Tours: Marrakech, Fes & Casablanca | |
| `/activities/category/day-trips` | day trips from marrakech (480 / 38) | essaouira day trip (90 / 7), atlas mountains day trip (70), day trips from rabat/fes | Day Trips from Marrakech, Fes & Rabat | |
| `/activities/category/food-culinary-tours` | marrakech food tour (140 / 14) | marrakech cooking class (90), moroccan cooking class (50) | Food Tours & Cooking Classes in Morocco | |
| `/activities/category/local-experiences` | berber experience morocco (20 / 9) | berber village tour | Local & Berber Experiences in Morocco | Low volume; built for relevance |
| `/activities/category/outdoor-activities` | (no Semrush data for outdoor seeds) | hot air balloon, atlas mountains day trip | Outdoor Activities in Morocco: Hikes & Balloons | Re-run the outdoor seeds (see the end of this file) |
| `/activities/category/wellness-experiences` | hammam marrakech (480 / 26) | best hammam in marrakech (210), marrakech spa (170) | Hammam & Spa Experiences in Marrakech | |
| `/destination-management-company` | what is a dmc (480 / 16) | dmc services (480), destination management services (140), destination management company (2900) | What Is a DMC? Destination Management Company Morocco | The page *is* a DMC explainer, so it now targets the explainer query. |
| `/faq` | is morocco safe (6600 / 39) | best time to visit morocco (3600), do i need a visa (390), morocco tour cost | Morocco Travel FAQ: Safety, Best Time & Visas | The FAQ really answers these (safety, documents/visa, cost, packing, booking). |
| `/about` | morocco travel agency (170 / 28) | licensed tour operator morocco | About Morocco Quest \| Morocco Travel Agency in Marrakech | |
| `/blog` | morocco travel guide (880 / 38) | morocco travel blog (70), morocco itinerary (720), marrakech travel guide (320) | Morocco Travel Guide & Blog \| Itineraries & Tips | |

**Deliberately unchanged:**

| Page | Reason |
|---|---|
| `/dmc-marrakech` | Already "Morocco DMC \| … \| DMC Marrakech". That covers morocco dmc (260 / **0**) and dmc marrakech (40 / 12). |
| `/professional-congress-organization` | Ranks #1 |
| `/sustainable-events-morocco` | Ranks #3 |
| `/events-production-morocco` | Ranks #5 |
| `/team-building-marrakech` | team building marrakech (50 / 2) is already the title |
| `/meetings-conventions-management` | Already targets mice marrakech |
| `/360-event-solutions` | No volume data; protect as it is |
| `/tours/type/one-day` | Already "Morocco Day Tours & Day Trips from Marrakech" |
| `/destinations`, `/destinations/*` | No Semrush data returned (see the end of this file) |
| `/contact` and legal pages | Branded, low value |

## Tours and activities (database: `scripts/seo/2026-09-30-product-seo-titles.php`)

Only `seo_title` and `meta_description` change. The product name, H1 and URL stay the same.

Every description was fact-checked against the live page text. Terms not found on the page ("scrub", "courtyard gardens", "viewpoints", "Fes el-Bali") were removed.

| Product | Target keyword (vol / KD) | New SEO title |
|---|---|---|
| Tour: 5-day Marrakech city break | marrakech city break / luxury marrakech tour | 5-Day Luxury Marrakech City Break & Private Tour |
| Tour: 5-day Tangier | tangier trip (40 / 15) | 5-Day Tangier Trip: Luxury City Break & Tour |
| Tour: 5-day Rabat | rabat tour (30 / 18) | 5-Day Rabat Tour: Luxury City Break & History |
| Tour: 8-day cultural | 8 day morocco tour, luxury morocco tours (320) | 8-Day Luxury Morocco Tour: Culture, Art & Food |
| Tour: 5-day Sahara | sahara desert tours from marrakech (170 / **15**), morocco desert tour (390) | 5-Day Luxury Sahara Desert Tour from Marrakech |
| Tour: Royal Cities 6-day | 6 day morocco tour, imperial cities | 6-Day Imperial Cities Tour of Morocco |
| Tour: 9-day Andalusian rail | 9 day morocco tour (30 / 8), morocco train tour | 9-Day Morocco Train Tour: Tangier to Fez |
| Tour: Marrakech + Essaouira | marrakech and essaouira tour | 5-Day Marrakech & Essaouira Private Luxury Tour |
| Activity: High Atlas hike | atlas mountains day trip (70 / 15) | Atlas Mountains Day Trip & Hike from Marrakech |
| Activity: Hot air balloon | hot air balloon marrakech (480 / 41) | Hot Air Balloon Marrakech: Sunrise Ride |
| Activity: Cooking class | marrakech cooking class (90 / 16) | Moroccan Cooking Class in Marrakech (3 Hours) |
| Activity: Medina hidden gems | marrakech medina tour (90 / 16) | Marrakech Medina Tour with a Private Guide |
| Activity: Rabat unveiled | rabat city tour (20 / 9) | Rabat City Tour: Private Guided Day |
| Activity: Volubilis & Meknes | volubilis tour (90 / 10) | Volubilis Tour & Meknes Day Trip from Fez |
| Activity: Garden trail | secret garden marrakech (210), marrakech gardens tour (20) | Marrakech Gardens Tour: Majorelle & Secret Garden |
| Activity: Hammam | hammam marrakech (480 / 26) | Hammam Marrakech: Private Hammam & Massage |
| Activity: Tangier city tour | tangier city tour (20) | Tangier City Tour: Private Full-Day Guide |
| Activity: Chefchaouen city tour | chefchaouen tour (40 / 17) | Chefchaouen Tour: Private Blue City Walk |
| Activity: Fez city tour | fes medina tour (20), fes guided tour (20) | Fes Medina Tour: Private Full-Day Guided Tour |
| Activity: Casablanca half-day | casablanca city tour (260 / 18) | Casablanca City Tour: Private Half-Day Tour |

**Left as they are** (already well targeted, or no keyword with volume):
- Chefchaouen day trip from Rabat
- Chefchaouen day trip from Fez
- Essaouira day trip from Marrakech
- Flavors of Fez (Palais Amani)
- Flavours of Rabat
- Rural Had El Brachoua
- Château Roslane
- Agadir half-day
- Tangier by Al Boraq
- Both Atlas Gardens activities: near-duplicates waiting on the merge decision (O-11)

## Gaps: keywords with no page yet (content opportunities)

| Keyword (vol / KD) | Suggested page |
|---|---|
| morocco itinerary 7 days (320 / **8**), morocco 5/10 day itinerary (70) | Blog guide "7-Day Morocco Itinerary" linking to the multi-day tours |
| agafay desert day trip (140 / 21), agafay desert dinner (40 / 10), agafay desert tour (70) | Agafay activity, **only if you sell it** (O-10) |
| marrakech to merzouga tour (110), luxury desert camp morocco (140) | Sahara hub or a 3-day Merzouga tour (O-10) |
| best time to visit morocco (3600), what to wear in morocco (590), is morocco safe (6600) | Dedicated blog guides (the FAQ gives short answers) |
| morocco family tours (170 / 23), morocco group tours (210 / 21) | Only if you run family or small-group departures |
| destination management company (2900 / 19) | Strengthen `/destination-management-company` with a longer explainer |

## Seeds Semrush returned no data for (re-run on the US and UK databases)

- **Imperial and cultural tours:** imperial cities of morocco tour, royal cities morocco tour, morocco cultural tour, fes to marrakech tour, casablanca to marrakech tour, morocco train tour, spain and morocco tour, al boraq train tour
- **Outdoor:** atlas mountains hike, high atlas trekking, toubkal trek, imlil hiking, quad biking marrakech, camel ride marrakech, morocco hiking tours
- **Destinations:** morocco destinations, best places to visit in morocco, marrakech tours, fes tours, fez tours, tangier tours, rabat tours, casablanca tours, chefchaouen tours, essaouira tours, agadir tours
- **DMC:** sustainable events morocco, green events morocco, csr events morocco, 360 event solutions, mice packages morocco
- **About:** morocco tour company, moroccan travel agency

## Pass 2: on-page rules applied to every static page (2026-09-30)

**Rules** (Seobility on-page checks):
- title ≤ 580 px
- description ≤ 1000 px
- no repeated words in the title (the "Morocco Quest" brand is exempt; the homepage scores 100% with it)
- title keywords present in the H1
- every title unique

**Verified** with Arial pixel widths calibrated against Seobility's own homepage measurement (557 px title / 951 px description).

**Result:**
- all 36 static pages pass
- titles are 432–580 px
- descriptions are 805–977 px
- 0 duplicate titles

**What changed:**

| Area | Change |
|---|---|
| 8 destination pages | "Tours in {City} \| Private Day Trips \| Morocco Quest". Keyword-stuffed descriptions ("Best morocco tours in X. Private morocco tours…") replaced with one clean sentence. |
| Tour/activity type pages | "{Type}s in Morocco \| Private & Guided \| Morocco Quest", with a matching H1 (was "Discover Our Exclusive Tours") |
| Multi-day | Title 538 px, H1 "Morocco Multi-Day Tours" |
| One-day | Title 546 px, H1 "Morocco Day Tours & Day Trips" |
| `/destinations` | Title 574 px |
| `/activities` | Title 432 px. False "camel rides, quad biking" copy removed. |
| 6 activity categories | Each gets its own H1 matching its title (was "Private Morocco Tour Activities") |
| `/experiences` | H1 "Things to Do in Morocco & Marrakech" |
| FAQ | Title 522 px (keeps "best time", 3,600 searches). H1 "Morocco Travel FAQ: Safety, Best Time & Visas". |
| Blog | Title 509 px, H1 "Morocco Travel Guide & Blog" |
| `/dmc-marrakech` | "Morocco DMC Marrakech \| MICE & Incentive Travel": covers both "morocco dmc" and "dmc marrakech" with DMC written once |
| Sustainable, 360 | Titles under 580 px, primary keyword kept first |
| DMC explainer | Description 1005 → 952 px |

**Still flagged by Seobility on the homepage** (not meta issues; next pass):
- 39 external links
- repeated or over-long anchor texts
- 0.62 s response time (target 0.4 s)
- only 10 referring domains
