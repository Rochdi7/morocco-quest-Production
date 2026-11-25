# 15 — Missing Sections & Image Recommendations for /dmc-marrakech

Basis: the live page (`resources/views/dmc-marrakech.blade.php` + partials), compared with C1 (Visit Marrakech DMC directory) and C2 (dmc-marrakech.com), plus the 50-site benchmark (report 11). Nothing here is implemented yet.
**Rule for every item:** if it needs a business fact (licence, client, number, photo), the owner must supply it. Nothing may be invented.

Current page order, for reference:
1. Hero (H1)
2. Trust bar (4 stats + world map)
3. "A Marrakech DMC Built for Repeat B2B Business"
4. "We Operate Across All of Morocco"
5. "What Makes Morocco Quest Different…"
6. Services guide (7 collapsed accordions)
7. Quote form
8. FAQ (15)
9. Testimonials
10. Related DMC services
11. Products (latest 3 tours + 3 activities)
12. Final CTA

## A. Missing sections and content

| # | Missing item | Evidence | Exact recommendation (position, content) | Needs owner input |
|---|---|---|---|---|
| A1 | **Verifiable trust block** | C1 shows official logos, C2 a named company + address; 24 of 44 benchmarked DMCs state years in business; MQ says "Licensed & insured" ×11 with no number | **Directly under the hero, replacing the 4-stat bar's unprovable stats.** Show: legal company name; Ministry of Tourism licence number; year DMC operations started; number of groups/pax handled in 2025; Marrakech office (Gueliz) address; Google rating with a link to the profile. 4–6 items, each linkable or checkable | **Yes**: licence no., start year, 2025 volumes, rating link |
| A2 | **Case studies / programmes delivered** (2–3) | C2 has none, but your-morocco-dmc ("Sample Marrakech incentive programs") and dmcmarrakech.com do; MQ's 3 "Example:" blocks are illustrative only | **New H2 "Programmes We Delivered in Marrakech", placed after the services guide and before the quote form.** Each case: client type (anonymised OK, e.g. "UK pharmaceutical incentive house"), pax, month/year, length, venues used (named), services delivered, one measurable outcome or client quote, 1–2 original photos. Replace the 3 italic "Example:" lines in the guide with links to these cases | **Yes**: real programmes + photos + permission |
| A3 | **Named B2B contact person** | C2: named contact with photo + "Help with your request?" | **Inside the quote-form section (right column on desktop, above the form on mobile):** "Your B2B contact" with photo, name, role, languages, direct email/WhatsApp, response time | **Yes**: person, photo, consent |
| A4 | **Founder / company story (short)** | About page: "Founded by Mounir Akajia in 2022"; not on the DMC page | **2–3 sentences inside "A Marrakech DMC Built for Repeat B2B Business"**: who runs the DMC desk, since when, base in Gueliz, Marrakech, linking to /about | Confirm wording |
| A5 | **Memberships & partners strip** | C1's institutional logo strip is its strongest trust visual | **After the testimonials:** a logo row of real memberships (e.g. national tour-operator association, CRT listing once accepted, SITE/MPI if applicable) and suppliers you may name. **Only real, permitted logos** | **Yes** |
| A6 | **Marrakech planner facts** | C2 "Travel facts" table; useful, quick, citable (GEO/AI Overviews) | **Compact table at the end of the "Marrakech as a MICE Destination" accordion, or as its own small H3 after it:** RAK airport and direct-flight regions, flight time from London/Paris, currency, time zone, language, visa note for main markets, best seasons for events, Ramadan note, main venue types | No (public facts; verify before publishing) |
| A7 | **Named venues** | Nobody in the top 2 names venues; MQ says "a 3,500-seat congress centre" without naming it | In the MICE accordion, **name the venues MQ has actually worked with** (e.g. Palais des Congrès de Marrakech, named Hivernage/Palmeraie hotels), each one line | **Yes**: only venues actually used |
| A8 | **Missing service lines** | C2 lists product launches, seminars, themed dinners, reward/motivation trips | Add to the MICE accordion as bullets **only if offered**. "Seminars" also links to the FR opportunity ("séminaire marrakech" 210/mo in France) | Confirm services |
| A9 | **Verifiable testimonials** | Current 4 quotes are first-name + initial, no source (`partials/dmc-testimonials.blade.php`, shared by 8 DMC pages) | Replace with quotes the owner can attribute (full name + company, or a link to the Google/TripAdvisor review). If none can be verified, **remove the section** rather than keep unverifiable quotes. Never add Review/AggregateRating schema for self-collected quotes | **Yes** |
| A10 | **Curated DMC products** | The products partial shows the *latest* 3 tours + 3 activities (currently including "Agadir Half-Day City Tour", "Tangier Day Trip from Rabat") | Show Marrakech/MICE-relevant items (Agafay experiences, Marrakech-based multi-day tours, team-building activities). Add an optional curated list parameter to `partials/dmc-products.blade.php` so the other 7 DMC pages are unchanged | Choose items |
| A11 | **Consistent scale claims** | "20+ groups/year" vs "400+ delegates" vs "groups of 500+" | Align all numbers with A1's verified figures | **Yes** |
| A12 | **French version** | C1's #1 page is FR; FR demand: "dmc marrakech" 20/mo, "dmc maroc" 20, "agence événementielle marrakech" 30, "séminaire marrakech" 210 (Semrush FR) | Separate FR page (e.g. `/fr/dmc-marrakech`) with hreflang en/fr/x-default. Translated *and* localised (agence réceptive, séminaires, incentive) | Strategy decision |
| A13 | **Internal links into the page** | 0 external links to the page; homepage body link exists only locally | Deploy the homepage link. Add one contextual link from each relevant blog post (incentive Agafay post already links), from /about ("our DMC desk") and from /contact ("B2B enquiries") | No |
| A14 | **"How to choose a DMC in Marrakech" checklist** | The "list" intent (C1) shows searchers compare DMCs | Short H3 at the end of the FAQ or guide: 6–8 checks (licence, local office, own staff on site, insurance, references, supplier contracts, payment terms, emergency process), answering each for MQ with facts | Facts for MQ's answers |

**Not recommended:**
- More generic text (the page is already the longest in the market).
- A second "DMC Marrakech" page (cannibalisation).
- Copying C2's tourist-brochure prose.
- Self-hosted star ratings.

## B. Image and visual plan

**General specs:**
- WebP, plus AVIF if the pipeline allows.
- Hero ≤150 KB, content images ≤120 KB at their largest served width.
- Generate 480/800/1200/1600w variants (the project already has `php artisan images:variants`).
- Explicit width/height, and `loading="lazy"` below the fold.
- Hero eager with `fetchpriority="high"` (already preloaded).
- Descriptive kebab-case filenames.
- Alt text describes the scene + place + MQ role, without stuffing.
- **Original photos are strongly preferred everywhere they claim experience.** Stock is acceptable only for pure destination scenery.

| # | Section & position | Image type | Subject to photograph | Aspect / dimensions | Suggested filename | Suggested ALT | Original vs stock |
|---|---|---|---|---|---|---|---|
| I1 | **Hero** (top) | Event photo with people | A real MQ programme in Marrakech: gala dinner in a Palmeraie venue, or a delegate group arriving at an Agafay camp with MQ staff visible | 16:9, 1920×1080 source (serve 1600w desktop); separate 4:5 mobile crop 1080×1350 | `dmc-marrakech-incentive-gala-dinner-palmeraie.webp` | "Incentive group gala dinner at a Palmeraie venue in Marrakech, organised by Morocco Quest DMC" | **Original required** (it replaces the stock auditorium seats) |
| I2 | "A Marrakech DMC Built for Repeat B2B Business" (right column) | Team photo | MQ operations team / account managers in front of the Gueliz office or on site with a group | 4:3, 1200×900 | `morocco-quest-dmc-team-marrakech-office.webp` | "Morocco Quest DMC operations team at the Marrakech office in Gueliz" | **Original** |
| I3 | Same section (current image) | Keep | Existing "tour group at Ben Youssef Madrasa" | Re-export at 1200×768 (currently a 3105×1988 source) | **Rename** `destination management company (1).webp` → `dmc-marrakech-group-ben-youssef-madrasa.webp` | keep current alt | Keep if original |
| I4 | MICE accordion / new "Meetings & conferences" visual | Conference | Plenary or breakout set up by MQ: hospitality desk, signage, delegates, in a named Marrakech venue | 3:2, 1200×800 | `mice-conference-marrakech-hivernage-venue.webp` | "Conference delegates at a Hivernage venue in Marrakech during a Morocco Quest DMC programme" | **Original** |
| I5 | Incentive accordion | Experience | Real incentive group at sunset in Agafay (camels/quads) or a private riad dinner | 3:2, 1200×800 | `incentive-travel-agafay-desert-sunset-group.webp` | "Incentive travel group at sunset in the Agafay desert near Marrakech" | Original preferred |
| I6 | Team building (12 activities) | Activity | A real team in a medina treasure hunt or tagine cooking challenge | 4:3, 1200×900 | `team-building-marrakech-cooking-challenge.webp` | "Corporate team during a tagine cooking challenge in Marrakech" | Original preferred |
| I7 | Transfers & logistics (accommodation & transfer accordion) | Operations | MQ vehicles (minivan/coach) with driver and a meet-and-greet sign at Marrakech Menara Airport (RAK) | 3:2, 1200×800 | `airport-meet-greet-marrakech-menara-dmc.webp` | "Morocco Quest DMC meet-and-greet with a group transfer at Marrakech Menara Airport" | **Original** (proves operations) |
| I8 | Accommodation (same accordion) | Venue | Riad buy-out courtyard or partner hotel, **with permission** | 3:2, 1200×800 | `riad-buyout-marrakech-medina-group.webp` | "Exclusive-use riad courtyard in the Marrakech medina for a small incentive group" | Original or partner-supplied |
| I9 | **Case studies (A2)** | Project photos | 1–2 per case from the actual programme | 3:2, 1200×800 | `case-study-<client-type>-<venue>-<yyyy>.webp` | "<Programme type> for <pax> guests at <venue>, Marrakech, <month year>" | **Original required** |
| I10 | **B2B contact (A3)** | Portrait | Named account manager | 1:1, 600×600 | `morocco-quest-dmc-<firstname>-b2b-account-manager.webp` | "<Name>, B2B account manager at Morocco Quest DMC" | **Original** |
| I11 | **Memberships strip (A5)** | Logos | Real membership/partner logos | SVG or 176×80 WebP | `logo-<organisation>.svg` | "<Organisation> logo" | Official files only |
| I12 | Planner facts (A6) | Map/infographic | Simple map: Marrakech + RAK + Agafay + Atlas + Essaouira with drive times | 4:3, 1200×900 (or inline SVG) | `marrakech-dmc-planner-map-drive-times.webp` | "Map of Marrakech with drive times to Agafay, the Atlas Mountains and Essaouira" | Original graphic |
| I13 | **Open Graph** | Social card | Hero crop + logo + "DMC Marrakech" text | 1200×630 | `og-dmc-marrakech-morocco-quest.webp` (or .jpg for wider compatibility) | n/a (og:image:alt "Morocco Quest DMC — DMC Marrakech") | Original |
| I14 | Optional gallery (after case studies) | 6–8 images | Mix of I4–I9 | 4:3, 800×600 thumbs, lazy | `dmc-marrakech-gallery-<nn>-<subject>.webp` | Describe each scene | Original |
| I15 | Optional video | 30–60 s reel | Real programme highlights | 16:9, poster 1280×720 | `dmc-marrakech-programme-reel.mp4` + poster | Poster alt as I1 | Original. Use a lite-YouTube facade or lazy `<video>`, never autoplaying heavy video above the fold |

### Retain / replace / optimise

| Existing image | Decision | Reason |
|---|---|---|
| Hero `morocco-quest-marrakech-koutoubia-dmc-hero.webp` (auditorium seats) | **Replace** (I1) | Generic stock-like; not Marrakech; **filename says Koutoubia but the image shows seats**; CSS background with no alt |
| `destination management company (1).webp` | **Rename + resize** (I3) | Spaces/parentheses in filename; 3105 px source shown at 534 px |
| `morocco-quest-atlas-mountains-road-nationwide-coverage.webp` | Retain | Relevant, optimised, good alt |
| `morocco-quest-koutoubia-mosque-marrakech-why-us.webp` | Retain (or swap for I2) | Relevant landmark; the team photo would add more trust |
| Cloud / balloon decorative PNGs | Retain, but set `alt=""` | Decorative images shouldn't carry alt text |
| World-map SVG (trust bar) | Retain or simplify | Design element; ~945-line inline SVG adds DOM weight (page has 1,975 nodes) |
| Product-card images | Retain the mechanism, curate items (A10) | — |
| OG image (generic Aït Benhaddou banner) | **Replace** (I13) | Not DMC-specific |

### Layout ideas inspired by competitors (not copied)

- From C1's institutional logo strip → a "memberships & partners" row (A5) with MQ's own real affiliations.
- From C1's hero (real trade event) → I1 using MQ's own event.
- From C2's contact person card → a "Your B2B contact" card in the form section (A3).
- From C2's "Travel facts" table → a richer "Marrakech planner facts" block with drive-time map (A6 + I12).
- From C2's flat service list → keep MQ's structured accordions, but add a scannable **service index** (6–8 icon tiles linking to each accordion/anchor) right after the intro, so the breadth is visible without opening accordions.
