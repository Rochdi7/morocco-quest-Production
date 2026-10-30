# Morocco Quest SEO audit, 14 October 2026

**Website:** https://morocco-quest.com
**Audit type:** read-only. Nothing on the live site, in the code, or in any account was changed.
**Previous audit:** 28 September 2026 (`docs/reports/SEO_AUDIT_2026-09-28.md`). Its fixes were deployed on 29–30 September. This audit checks what those fixes achieved and what is still holding the site back.

Companion files in this folder:

| File | What it is |
|---|---|
| `ACTION-PLAN.md` | Checklist of 26 actions with acceptance criteria and validation steps |
| `URL-AUDIT.csv` | Every discovered URL with status, indexability, metadata, issue and action |
| `KEYWORD-MAP.csv` | 28 target queries mapped to pages, with evidence and limits |
| `EVIDENCE.md` | What was checked, how, and what came back (findings F-1 to F-16) |
| `evidence/` | Crawl data, SERP notes, schema dumps, performance data, screenshots |

---

## A. Executive summary

### Overall assessment

The site is in much better technical shape than two weeks ago. All seven critical security and server problems found on 28 September are fixed on the live site, and all 31 structured-data errors are gone.

What holds Morocco Quest back now is mostly **not technical**. It is three things:

1. **You cannot measure anything.** Google Analytics records no visits or enquiries, and the audit had no Search Console access.
2. **Buyers and Google have little reason to trust the claims.** Awards cannot be verified and contradict each other, testimonials are anonymous and repeated, and no licence number is shown.
3. **Product pages don't match what people search for.** Every tour says "Price On Request", there is no short Sahara trip, and several hub pages compete with each other.

**SEO health score: 66 / 100** (up from 59 on 28 September). This is the auditor's weighted score using the claude-seo method. It is not a Google metric. The breakdown is in section C.

### The most important verified findings

| # | Finding | Status |
|---|---|---|
| 1 | Google Analytics records nothing. The GA4 ID in the code does not exist, and the Tag Manager container has no tags. | Verified, still open since 28 Sept |
| 2 | The server sometimes takes 11–15 seconds to answer the first request after a quiet period, and some connections time out. Warm pages answer in 0.45 s. | Verified, new |
| 3 | `/activities` shows "No activity categories found" because of a code bug, and duplicates `/experiences`. | Verified, new |
| 4 | Seven empty tag pages now return 404 but are still linked from 110 blog pages. | Verified, new (side effect of a 29 Sept fix) |
| 5 | Awards on the homepage and About page contradict each other. The linked TripAdvisor listing has 1 review and no Travellers' Choice badge. | Verified |
| 6 | The same three anonymous five-star testimonials appear on every DMC page. No licence number, named client or case study is shown. | Verified |
| 7 | "Day trips" are split across three URLs, and one of them has no internal links at all. | Verified |
| 8 | All tours show "Price On Request". The 8-day tour has two "Day 01"s; the Sahara camp is listed under "Dades". | Verified |
| 9 | A blog post outranked the incentive service page for "incentive travel morocco" (#9 on 28 Sept). | Carried forward, not re-checked |

### Biggest opportunities

- **"DMC Marrakech" and "Morocco DMC" (B2B).** The page is built and long. Adding verifiable proof (licence, named clients, case studies, real reviews) is the most likely way to move it.
- **"Incentive travel Morocco".** The site already ranks with a blog post. Linking that post to the service page is a cheap test.
- **Sahara trips from Marrakech (B2C).** This needs a real 2–3 day product with a visible price.
- **Protect the pages that already rank:** professional congress organiser (#1), sustainable events (#3), event production (#5).

### Do these first

1. **Fix Google Analytics** with the correct ID (A-01).
2. **Give Search Console access** or export its reports (A-02).
3. **Investigate the slow first-request problem** with your host (A-03).
4. **Fix the two broken hub problems:** the empty `/activities` page and the 404 tag links (A-04, A-05).
5. **Remove or prove every award, testimonial and licence claim** (A-07).

### What this audit could not verify

- Rankings, clicks, impressions and indexation from Google itself: no Search Console access.
- Real-user Core Web Vitals: no PageSpeed API key, and the site likely has too little traffic for Chrome field data.
- Backlinks: no Ahrefs, Semrush, Moz or Bing data, and Common Crawl timed out.
- Today's Google positions: the search tool used is not Google. Positions quoted are from 28 September.

---

## B. Scope and methodology

| Item | Detail |
|---|---|
| Date | 14 October 2026, about 21:15–23:30 UTC |
| Site | https://morocco-quest.com (canonical host; `http`, `www` and trailing-slash variants all 301 to it in one hop) |
| SEO skill | **claude-seo v1.9.0** by AgricIDaniel, installed as skills in `~/.claude/skills/seo*` with 15 agents. Not installed as a marketplace plugin, but its scripts and agents were all present. |
| Workflow | `seo-audit`: credential checks, homepage fetch, crawl, parallel specialists, scoring, report |
| Specialists used | seo-sxo (search results and competitors), seo-performance, seo-schema, seo-local (local, backlinks, AI search), seo-content. The content and performance specialists hit their turn limits; the lead auditor completed their unfinished parts (content analysis, rendering, mobile) directly. |
| Not used | seo-google (no usable Search Console property), seo-dataforseo (not installed), seo-ecommerce (not an e-commerce site), seo-drift (no baseline existed), seo-maps (needs DataForSEO) |
| Crawl | Custom polite crawler, robots.txt respected, 1 request per second. 185 URLs fetched: 178 pages with status 200, 7 with 404. 118 indexable, 60 noindex (tag archives). All 84 sitemap URLs return 200. |
| Browser automation | Playwright (headless Chromium): raw vs rendered comparison and mobile checks on 5 pages, 6 screenshots |
| Source code | Read-only checks of controllers, routes and Blade views to locate causes |
| Data sources | Live site, Google Tag Manager public container, WebSearch (not Google), WebFetch, the repo's Semrush keyword file dated 30 Sept (US database) |

**How to read terms used below:**
- *Indexable* means Google is allowed to add the page to its index.
- *Canonical* is the URL a page tells Google is the "main" version.
- *Cannibalization* means two of your pages compete for the same search, so neither does well.
- *LCP* (Largest Contentful Paint) is how long the main visible element takes to appear.

---

## C. Scorecard

Scores are the auditor's judgement on a 0–100 scale from the evidence listed. They are not Google metrics and should only be used to compare this audit with later ones.

| Area | Score | Coverage | Evidence and reasoning |
|---|---|---|---|
| **Technical SEO** | 70 | Full crawl | Security fixed, clean redirects, sitemap valid (84 URLs, all 200, all indexable), robots.txt correct, server-rendered HTML. Deductions: 7 linked 404s, empty `/activities`, duplicate `%20` URLs, one orphan hub, cold-start stalls. |
| Crawlability | 75 | Full crawl | Everything important is reachable through links except `/tours/type/one-day`. 770 links point to 404 tags. |
| Indexation | Not scored | None | No Search Console data. Signals on the pages themselves are correct (no accidental noindex, canonicals self-referencing). |
| **On-page SEO** | 72 | 118 indexable pages | Unique titles and H1s almost everywhere. One duplicate category pair, 28 category titles over 65 characters, two page pairs share an H1. |
| **Content quality** | 50 | 25 key pages read in full | Long, structured DMC and tour pages, but thin hubs (91–253 words), repeated DMC blocks, unverifiable claims, product data errors, no prices. |
| Internal linking | 55 | Full link graph | Menus link the main hubs. 9 activities have only one linking page. Blog posts barely link to products. About 2,800 links have no text. |
| **Schema** | 82 | 19 templates | All 31 earlier errors fixed. Minor: image URLs with spaces, no breadcrumbs on type pages, hard-coded traveller types. |
| **Performance** | 55 | 8 URLs, local lab only | Homepage improved (hero is now LCP). Inner pages still load 0.6–1.8 MB of icon fonts, the preloader logo is the LCP element, and the first request after idle can take 11–15 s. |
| **AI search readiness** | 70 | robots.txt, llms.txt, key pages | AI crawlers allowed, llms.txt works, clear service descriptions. Weak on verifiable facts and named sources. |
| Images | 85 | Full crawl | WebP throughout, alt text present (2 decorative empties per DMC page). |
| International | Not scored | Full crawl | English only, no hreflang, which is consistent and error-free. No evidence yet that other languages would pay off. |
| Backlinks | 15 | Very limited | No referring domain could be verified today. Treat this as "unknown, probably weak" until real data arrives. |
| Conversion readiness | 45 | 5 pages on mobile | Phone, WhatsApp and forms on every page. But no prices, no attributable reviews, and **no tracking at all**. |

**Weighted health score (claude-seo weights):** Technical 22%, Content 23%, On-page 20%, Schema 10%, Performance 10%, AI readiness 10%, Images 5% gives **66 / 100**.

---

## D. Critical problems

### D-1. Analytics records nothing (P0, confidence high)

- **Evidence:** `gtag/js?id=G-QXBGN7DKMB` returns HTTP 404 from Google. The published Tag Manager container `GTM-WVCGDJ98` has an empty tag list (EVIDENCE F-1).
- **Affected:** every page.
- **Business impact:** you cannot see organic traffic, which pages bring enquiries, or whether any change in this plan works.
- **Fix:** in GA4 → Admin → Data streams, copy the real measurement ID into both layouts. Send page views from one place only. Mark `generate_lead` as a key event and use its existing `form_type` parameter to separate enquiries from newsletter sign-ups.
- **Validate:** GA4 Realtime shows your own visit; the browser Network tab shows a `/g/collect` request.

### D-2. Slow and failed first requests (P1, confidence high that it happens, unknown cause)

- **Evidence:** first requests took 11 s and 15.5 s; connects after idle took 3–15 s; two timeouts, one reset, one outright connection failure. Warm requests took 0.45 s (F-7).
- **Affected:** the whole site, mostly after quiet periods.
- **Business impact:** visitors leave a page that takes 15 seconds. If Googlebot hits the same stalls, it may crawl less. That part is a hypothesis until Search Console Crawl stats are checked.
- **Fix:** check Search Console → Settings → Crawl stats → Host status; ask the host about idle worker suspension or connection limits; add an uptime monitor that also keeps the cache warm.
- **Validate:** 14 days of uptime monitor data with no failures and response times under 1.5 s.

### D-3. `/activities` is empty and duplicates `/experiences` (P1, confidence high)

- **Evidence:** live page reads "No activity categories found". `ActivityController::index()` passes `$activities` while the view checks `$activityCategories` (F-4). Both pages use the H1 "Things to Do in Morocco & Marrakech". The shared intro advertises quad biking, Erg Chebbi camel treks and Toubkal hikes, which have no product pages.
- **Fix:** 301 `/activities` to `/experiences` (owner decision O-3), keep `?category=` links working, remove it from the sitemap, and remove claims for products you don't sell.
- **Validate:** `curl -I /activities` shows 301; the intro only lists real products.

### D-4. Links to 404 tag pages on 110 pages (P1, confidence high)

- **Evidence:** 7 tags return 404 but appear in the tag sidebar on the blog index, all 16 posts, 33 categories and 60 tags (F-3).
- **Fix:** list only tags that have at least one post.
- **Validate:** re-run the crawl; zero 404s.

### D-5. Claims that cannot be verified (P1, confidence high that they're unverifiable)

- **Evidence (F-8, F-16):**
  - Homepage awards: TripAdvisor Travellers' Choice 2022, Tui 2024, IAGTO 2025.
  - About page awards: a different set, including "ISO Quality Label".
  - The company was founded in 2022. The TripAdvisor listing linked from the site has 1 review (August 2025), no badge, and is categorised "Food & Drink".
  - The homepage "What Our Travelers Say" heading has nothing under it.
  - The same three anonymous five-star testimonials repeat across the DMC pages.
  - "Licensed" appears up to 12 times with no licence number.
- **Business impact:** B2B buyers check these things. Unsupported awards and anonymous reviews damage trust with buyers and with Google's quality guidelines. Testimonials that are not real client quotes are also a consumer-protection risk.
- **Fix:** keep only what you can link to proof; publish the licence number; replace anonymous testimonials with named ones (with permission) or link to a real review profile.
- **Validate:** each remaining claim can be checked by a stranger in one click.

---

## E. Keyword opportunities

All volume and difficulty figures are **Semrush US data from the repo file dated 30 September, not re-verified**. Positions are from Google (Morocco) on 28 September unless stated. The full list is in `KEYWORD-MAP.csv`.

| Keyword | Intent | Audience | Target URL | Ranking evidence | Difficulty / uncertainty | Value | Action |
|---|---|---|---|---|---|---|---|
| dmc marrakech / morocco dmc | Commercial B2B | Agents, MICE planners | `/dmc-marrakech` | ~#35 (Aug); not top 20 for "morocco dmc" | Low KD (0–12) but trust-led results | Very high per deal | Add verifiable proof (A-07, A-21) |
| incentive travel morocco | B2B, mixed editorial and commercial | Incentive planners | `/team-building-marrakech` | #9 via the blog post | Moderate | Very high | Link the blog post to the service page (A-08); add a case study |
| professional congress organizer morocco | Commercial B2B | Associations | `/professional-congress-organization` | #1 | Low competition | High | Protect; no changes |
| sustainable events / event production morocco | B2B | Event buyers | their own pages | #3 / #5 | Low competition | Medium | Protect; add references |
| sahara desert tours from marrakech | Transactional | Leisure travellers | 5-day Sahara tour | Not in top 20 | 170 / KD 15; results show priced 3-day tours with reviews | High | Real 3-day product with a price (A-18) |
| private morocco tours | Commercial | Couples, families | `/tours` | Not in top 20 | 320; operators with prices rank | High | "From" prices and reviews (A-10) |
| day trips from marrakech | Commercial | Visitors in Marrakech | one hub to choose | Not checked | 480 / KD 38; marketplaces strong | Medium | Consolidate three URLs into one (A-06) |
| things to do in marrakech | Informational | First-time visitors | none (should be a guide) | Not seen | 2,900 / KD 24; editorial guides rank | Medium (assisted leads) | Write a first-hand guide linking to activities (A-19) |
| morocco itinerary (7 days) | Informational | Trip planners | none | Not checked | 320 / KD 8 | Medium | Itinerary guide linking to tours (A-19) |
| things to do in morocco | Informational | Planners | `/experiences` (assigned) | Not checked | 4,400 / KD 10 | Low-medium | Move the target to the top-10 blog post; keep `/experiences` commercial (A-17) |

**Best balance of value and realistic opportunity:** the B2B terms "dmc marrakech / morocco dmc" and "incentive travel morocco". You already have relevant pages and some rankings, competition is small, and one deal is worth many B2C bookings.

---

## F. Competitor analysis

Competitors were chosen by overlap in search results (today's WebSearch plus the Google results from 28 September). Competitor structured data could not be inspected. Details are in `evidence/serp/serp_findings.md`.

| Competitor | Query | What they show that Morocco Quest doesn't (observed) | What Morocco Quest can do | Next step |
|---|---|---|---|---|
| local-morocco-tours.com `/dmc-marrakech/` | dmc marrakech | Founded 2012; Ministry of Tourism licence; a named guide licence number; TripAdvisor 4.9 with badge; six named testimonials with job titles; "net rates in 24 hours" form | Show your licence number, real named B2B testimonials and a sample programme | A-07 |
| journeybeyondtravel.com `/morocco/destination-management-company` | dmc morocco, destination management company morocco, dmc maroc | Founded around 2007; director wrote two guidebooks; trade terms published (deposits, free places, familiarisation trips) | Publish your trade terms and process in plain numbers | A-07, then content |
| Access Holidays & Events (Access Morocco) | incentive travel morocco | Founded 2007; 60+ staff; SITE Crystal Award case study; DMC network membership (self-reported) | One real, named incentive case study with numbers (group size, nights, activities) | A-08 |
| Intrepid Travel `/morocco/sahara-desert-from-marrakech` | sahara desert tours from marrakech | 3-day product; price shown; 4.9 rating with 100+ reviews | A 3-day private product with a "from" price; collect reviews | A-10, A-18 |
| sun-trails.com, moroccofriendlytravel.com | private morocco tours | Itineraries with "from" prices | Show prices on your 8 tours | A-10 |
| GetYourGuide, Viator, Headout | merzouga, ait benhaddou, agafay | Marketplace scale and reviews | List real day products there (also a brand signal); don't compete head-on with thin pages | A-23 (optional) |
| Editorial sites (Lonely Planet, Rough Guides, G Adventures blog) | morocco itinerary, things to do in marrakech | Long first-hand guides | Guides written from your guides' experience, with your photos | A-19 |

**Observation vs hypothesis.** The table describes what competitors show. It is a *hypothesis* that these features cause their rankings; trust signals are the most consistent difference, but links and brand age also differ and could not be measured.

**Note:** local-morocco-tours.com is also the only property the configured Search Console service account can see. If that site is yours or a client's, the competitor comparison above is between two of your own sites.

---

## G. Page-by-page action plan

### Improve these existing pages before creating new ones

| URL | Change | Why |
|---|---|---|
| `/dmc-marrakech` | Add licence number, 2–3 named clients (with permission), one case study, memberships you really hold, page-specific testimonials. Remove the "20+ groups / 11 countries / 100% licensed" stats unless you can back them. | Main B2B money page; trust is the clearest gap against competitors |
| `/team-building-marrakech` | Add a format table (group sizes, durations, indicative budgets) and one real case. Keep the H1. | It should win "incentive travel morocco" instead of the blog |
| Blog: incentive-trips-in-marrakech-agafay… | Drop "Morocco DMC" from the title; add 3 contextual links to service pages | Hands its ranking relevance to the service pages |
| `/` | Remove or prove the awards; fill or remove the testimonials heading; fix "Select Division"; replace 2 dead outbound links | First impression and trust |
| `/about` | Align awards with the homepage (or remove); add the licence number and team credentials | Company identity page for buyers and quality raters |
| `/tours` and all 8 tours | "From" prices if possible; fix 8-day day numbering and Sahara camp location | Matches what ranking pages show |
| `/experiences` | Make it the one activity hub; distinct H1; commercial title | Removes the duplicate with `/activities` |
| `/activities/category/day-trips` | Make it the one day-trips hub; menu "One-Day Tours" points here | Ends the three-way split |
| 6 destination pages under 260 words | Unique intro per city: what you offer there, season, starting points | Thin, interchangeable pages |
| 4 activity categories under 160 words | Unique intro and product links | Thin pages |

### Pages that compete with each other

| Pages | Verdict | Action |
|---|---|---|
| `/activities` vs `/experiences` | Confirmed duplicate | 301 `/activities` → `/experiences` (check Search Console clicks first) |
| `/experiences` vs `/activities/category/day-trips` vs `/tours/type/one-day` | Confirmed split of the day-trip intent | One hub; 301 the orphan |
| `/tours/type/Garden%20Tours` vs `/tours/type/garden-tours` (also Art, Classical) | Confirmed duplicate URLs | 301 the `%20` versions |
| Incentive blog post vs `/team-building-marrakech` | Confirmed by Google results (28 Sept) | Differentiate and link; don't merge |
| `/dmc-marrakech` vs `/destination-management-company` | Probable overlap | Hub stays commercial; explainer stays educational and links to the hub |
| 3 desert blog posts vs the 5-day Sahara tour | Probable overlap | Sahara hub; merge the thinnest post only after checking its clicks |
| `/faq` vs blog "Is Morocco safe for American travelers in 2026" | Same question, two pages | Let the blog post own the query; the FAQ links to it |
| `/category/morocco-travel` vs `/category/morocco-travel-1` | Confirmed duplicate | Merge with a 301 |

### Highest-value internal links to add

| From | To | Suggested anchor |
|---|---|---|
| Incentive blog post | `/team-building-marrakech` | incentive travel and team building in Marrakech |
| Incentive blog post | `/dmc-marrakech` | our Morocco DMC services |
| MICE blog post ("Unlocking Marrakech…") | `/meetings-conventions-management` | meetings and conventions in Marrakech |
| `/destinations/marrakech` | hot air balloon, medina tour, hammam, cooking class activities | each activity's name |
| `/destinations/fez` | Volubilis & Meknes, Château Roslane, Fez city tour | each activity's name |
| `/destinations/rabat` | Rabat city tour, Chefchaouen day trip from Rabat | each activity's name |
| 5-day Sahara tour | hot air balloon activity | add a sunrise balloon flight over Marrakech |
| Royal Cities tour | Volubilis & Meknes activity | Volubilis and Meknes day trip |
| Desert blog posts (3) | 5-day Sahara tour (later the Sahara hub) | private Sahara desert tour from Marrakech |
| `/team-building-marrakech` | High Atlas hike, balloon, cooking class | each activity's name |

---

## H. Technical remediation plan

| Step | Work | Depends on | Risk | Validation |
|---|---|---|---|---|
| 1 | Correct GA4 ID; single page-view path; lead event | GA4 access | Low | Realtime + `/g/collect` |
| 2 | Search Console access or exports | Owner | Low | `gsc_query.py sites` lists the site |
| 3 | Investigate first-request stalls with the host; add uptime monitor | Step 2 for Crawl stats | Low | 14 days of monitor data |
| 4 | Only list tags with posts in the sidebar | — | Low | Crawl shows 0 × 404 |
| 5 | 301 `/activities` → `/experiences`; drop it from the sitemap | O-3 | Low | `curl -I` |
| 6 | One day-trips hub; menu target; 301 `/tours/type/one-day` | Step 5, O-3 | Medium | Crawl + manual menu check |
| 7 | 301 `%20` type URLs to slugs; update menu and sitemap; delete `/urllist.txt` | O-2 | Low | Crawl |
| 8 | Schema: encode image URLs, breadcrumbs on type pages, real `touristType`, one business node on `/contact` | — | Low | Rich Results Test |
| 9 | Inner-page performance: icon-font subset (after the O-15 query), preloader decision, click-to-load maps | O-15, O-16 | Medium (visual QA) | PageSpeed median of 3 |
| 10 | Category consolidation and noindex for archives with fewer than 3 posts | O-12 | Low | Crawl |

Re-run the crawler in `evidence/technical/` after each deployment and compare the non-200 list and duplicate checks. Remember the project's deploy rule: clear the page cache after every deploy.

**Technical work needed before content expansion:** steps 1–6. New pages are wasted effort while you can't measure them (1–2), the first visit can stall (3), and the hub structure is still being decided (5–6).

---

## I. Content and authority roadmap

| Topic / page | Intent | Audience | Unique value you can add | Evidence to include |
|---|---|---|---|---|
| DMC proof pack on `/dmc-marrakech` | Commercial B2B | Agents, MICE planners | You are on the ground in Marrakech | Licence number, named clients, 2–3 case studies with numbers, venue capacities you've used, response-time promise you actually meet |
| Incentive case study (new section or page) | B2B | Incentive planners | A real programme you ran | Group size, dates, itinerary, suppliers, photos, client quote with name and company |
| Sahara hub + 3-day private Merzouga tour | Transactional | Leisure travellers | Your own camps and drivers | "From" price, route map, night-by-night plan, real photos, reviews |
| Things to do in Marrakech | Informational | First-time visitors | Guides' first-hand picks | Opening times, prices, walking times, your photos, links to activities |
| 7-day Morocco itinerary | Informational | Planners | Routes you actually run | Drive times, overnight stops, seasons, links to multi-day tours |
| Destination intros (6 cities) | Commercial | Visitors | What you do in each city | Specific products, starting points, best months |
| Partner and directory listings | Authority | — | Real relationships | Official Marrakech MICE / DMC list, partner hotels and camps, trade press, SITE or MPI only if you join |

Do not create pages only because a keyword has search volume, and do not create Ait Benhaddou, Agafay or family-tour pages unless you sell those products.

---

## J. Measurement plan

**Establish the baseline (week 1, after A-01 and A-02):**

| Metric | Source | Baseline today |
|---|---|---|
| Organic clicks and impressions, last 3 and 16 months | Search Console | Unknown (no access) |
| Indexed pages vs sitemap (84) | Search Console Pages report | Unknown |
| Position for the 10 priority queries in `KEYWORD-MAP.csv` | Search Console, Morocco and top source countries | Only the 28 Sept spot checks |
| Organic sessions and organic enquiries | GA4 | **Zero recorded (tracking broken)** |
| Crawl host status | Search Console Crawl stats | Unknown; stalls seen in this audit |
| Core Web Vitals | Search Console CWV report / CrUX | No field data |
| Referring domains | Search Console Links | None verified |

**Check weekly:** crawl errors, uptime monitor, the 404 list, Search Console coverage.

**Review monthly:** clicks, impressions and position per priority page; enquiries per landing page; new referring domains.

**How to tell if a change worked:**

| Change | Leading indicator | When to judge |
|---|---|---|
| Analytics fix | Sessions appear in GA4 | 48 hours |
| Hub consolidation (A-05, A-06, A-11) | One URL gets the impressions; old URLs drop out | 4–8 weeks |
| Blog → service links (A-08) | `/team-building-marrakech` starts getting impressions for incentive queries | 8–12 weeks |
| Trust evidence (A-07) | DMC enquiry rate; branded searches | 8–12 weeks |
| Prices (A-10) | Click-through rate on tour pages; product enquiries | 4–8 weeks |
| New Sahara product and guides | Impressions for their target queries | 8–16 weeks |

Rankings move slowly, vary by country and device, and cannot be guaranteed. Judge results on clicks and qualified enquiries, not on a third-party SEO score.

---

## K. Limitations and access needed

| Missing | Why it matters | How to provide it safely |
|---|---|---|
| Search Console for morocco-quest.com | Real queries, positions, indexation, crawl errors, links | Add `claude-seo@claude-seo-509618.iam.gserviceaccount.com` as a **Restricted** user, or export Performance (16 months), Pages, Sitemaps, Crawl stats and Links as CSV |
| Correct GA4 measurement ID and GA4 property ID | Traffic and enquiry measurement | Copy from GA4 → Admin → Data streams; add `ga4_property_id` to `~/.config/claude-seo/google-api.json` |
| Google API key | PageSpeed and Chrome real-user data | Create a key restricted to the PageSpeed Insights and CrUX APIs; store it in the same config file, never in chat |
| Backlink data | Real off-site picture | Search Console Links export, or an Ahrefs/Semrush referring-domains CSV |
| Google Business Profile access | Local pack visibility | Owner checks category, reviews, hours and website |
| TripAdvisor | Which listing is yours | Claim the right listing; ask TripAdvisor to merge or remove the others |
| Proof for awards, testimonials, licence | Trust fixes (A-07) | Certificates, issuer links, client permissions, licence number |
| Host information | Cold-start stalls (A-03) | Plan type, PHP worker limits, error logs for 14 Oct 21:00–23:30 UTC |
| Production DB query O-15 | Safe icon-font subsetting | Run the read-only query in `docs/seo-fix/OWNER_DECISIONS.md` |

Other limits:
- WebSearch is not Google, so today's positions were not measured.
- Competitor schema and backlinks were not measured.
- Lab performance numbers come from a local machine and are only good for finding problems, not for scoring.

---

## Answers to your questions

**1. What are the biggest problems preventing better performance in Google?**
No measurement, weak verifiable trust signals, product pages without prices or short Sahara options, overlapping hub pages, and slow first requests. Technical hygiene is mostly good now.

**2. Which findings are confirmed, and which are hypotheses?**
- **Confirmed** (observed today): broken analytics, slow first requests, empty `/activities`, 404 tag links, duplicate URLs, the orphan one-day page, unverifiable awards and repeated testimonials, product data errors, schema leftovers.
- **Hypotheses:**
  - Trust is the main gap for DMC queries.
  - Prices and reviews are the main gap for Sahara queries.
  - The stalls affect Googlebot.
  - `/experiences` is the wrong page type for "things to do" queries.

  See EVIDENCE §5.

**3. Which five fixes first?**
- A-01 analytics.
- A-02 Search Console access.
- A-03 first-request stalls.
- A-04 and A-05: the 404 tag links and the empty `/activities` page.
- A-07 trust claims.

**4. Which existing pages to improve before creating new ones?**
- `/dmc-marrakech`, `/team-building-marrakech` and the incentive blog post.
- The homepage, `/about` and the 8 tours.
- `/experiences`, the day-trips hub, and the thin destination and category pages.

**5. Best balance of commercial value and realistic opportunity?**
"dmc marrakech / morocco dmc" and "incentive travel morocco". Next comes a priced 3-day Sahara product, if you run one.

**6. Which pages compete with one another?**
- `/activities` and `/experiences`.
- The three day-trip URLs.
- The `%20` and slug type URLs.
- The incentive blog post and `/team-building-marrakech`.
- `/dmc-marrakech` and `/destination-management-company`.
- The desert blog posts and the Sahara tour.
- `/faq` and the safety blog post.
- The two "morocco-travel" categories.

**7. What should improve about trust, content and credibility?**
- One consistent brand name.
- A licence number on the site.
- Only provable awards.
- Named testimonials or a linked review profile.
- Real case studies and prices.
- Correct itineraries.
- Your own photos and guide names in guides.

**8. What technical work is necessary before content expansion?**
Analytics, Search Console, the stall investigation, and settling the hub URLs. These are steps 1–6 in section H.

**9. What can be done in the first 7 days?**
- A-01 analytics.
- A-02 Search Console access.
- A-04 tag links.
- A-05 `/activities`.
- A-08 blog links.
- A-09 product data fixes.
- Start A-03 with the host and start collecting proof for A-07.

**10. Days 8–30?**
- A-06 day-trips hub.
- A-07 trust changes.
- A-10 price decision.
- A-11 URL clean-up.
- A-12 internal links.
- A-13 hub intros.
- A-16 schema.
- A-17 keyword retargeting.
- A-21 Google Business Profile and TripAdvisor.

**11. Days 31–90?**
- A-14 categories.
- A-15 performance.
- A-18 Sahara hub and product.
- A-19 guides.
- A-23 authority building.
- Then adjust based on measured Search Console and GA4 data.

**12. How will I know each change worked?**
See the table in section J. Each action in `ACTION-PLAN.md` has its own acceptance check and success metric.

**13. Which tools or access are still needed?**
Search Console, the correct GA4 IDs, a Google API key, backlink exports, Google Business Profile and TripAdvisor access, host information. See section K.

**14. Which recommendations should I avoid for now because the evidence is insufficient?**
- A French site or `/fr/` section: there is no enquiry data showing French demand yet.
- Disavowing links: there is no link data at all.
- Redirecting or merging blog posts before checking their clicks.
- Pages for Ait Benhaddou, Agafay dinners, family tours or "DMC Casablanca" unless you sell those products.
- AggregateRating or Review schema without real on-page reviews.
- More title-length tuning: titles are already fine, and the remaining gaps are trust and product fit.

---

## Roadmap

### Phase A: first 7 days

- **Deliverables:**
  - Working GA4 with an enquiry event.
  - Search Console access or exports.
  - Host ticket opened for the stalls.
  - Tag sidebar fix.
  - `/activities` redirect.
  - Incentive blog links.
  - Itinerary corrections.
  - Owner evidence collection started (licence, awards, client permissions).
- **Dependencies:** owner access to GA4, Search Console and the host; decision O-3.
- **Effort:** about 2–3 developer days plus owner time.
- **Success metrics:**
  - Visits recorded in GA4.
  - The crawl shows zero internal 404s.
  - `/activities` returns 301.

### Phase B: days 8–30

- **Deliverables:**
  - Day-trips hub.
  - `%20` URL migration.
  - Trust changes on the homepage, About and DMC pages.
  - Price decision implemented.
  - Internal links.
  - Hub intros.
  - Schema clean-up.
  - Google Business Profile completed.
  - Baseline report from Search Console and GA4.
- **Dependencies:** Phase A measurement; owner decisions O-2, O-4, O-5, O-6, O-9.
- **Effort:** about 5–8 developer days plus content writing.
- **Success metrics:**
  - One URL per intent in Search Console.
  - DMC page impressions trending up.
  - Enquiries attributed by landing page.

### Phase C: days 31–90

- **Deliverables:**
  - Sahara hub and 3-day product (if real).
  - Two first-hand guides.
  - Category consolidation.
  - Inner-page performance work.
  - Directory and partner listings.
  - One incentive case study.
  - Monthly reviews that adjust priorities.
- **Dependencies:** Phases A–B; real products and photos.
- **Effort:** about 10–15 days spread over the period.
- **Success metrics:**
  - Organic clicks and qualified enquiries vs the Phase B baseline.
  - New relevant referring domains.
  - Crawl host status clean.

New pages and links do not produce rankings automatically. Treat every Phase C item as a test and keep what the data supports.

---

## Final quality gate

- **The audit ran:**
  - Crawl of 185 URLs.
  - 5 specialist agents.
  - Playwright rendering and mobile checks.
  - Direct verification of every finding marked "verified".
- **Corrections made during verification:**
  - A specialist's claim that the `/team-building-marrakech` H1 lacks the keyword was checked and rejected (the H1 starts "Team Building Marrakech").
  - A claim that the firewall blocks normal browsers was checked and rejected (only the bare `Mozilla/5.0` string is blocked).
- **No changes anywhere:** no website source file, database, setting or account was changed. No commit, push or deployment was made. No form was submitted.
- **Output location:** all output is in `docs/reports/seo-audit-2026-10-14/`. `.htaccess` returns 404 for the whole `docs/` path, so these files are not publicly served even if deployed.
