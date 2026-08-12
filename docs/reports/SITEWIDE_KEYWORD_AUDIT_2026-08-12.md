# Morocco Quest — Site-Wide Keyword Audit

**Date:** 2026-08-12
**Method:** SERP-overlap-style research (adapted from the `seo-cluster` skill's methodology) using live WebSearch — no Semrush/Ahrefs API access this session. Current keyword targeting read directly from each controller's `$title`/`$description`/`$keywords` and cross-checked against real Google search results for the head term(s) each page targets.
**Scope:** Every indexable page category site-wide — DMC/B2B section, tours/activities hubs, static pages, blog.

---

## How to read this

For each page: **current keywords** (from the actual controller code, not assumed) → **SERP evidence** (who/what actually ranks for that term) → **verdict**: KEEP or CHANGE, with reasoning.

---

## DMC / B2B Section (8 pages) — KEEP, already audited today

Full findings in `docs/reports/DMC_KEYWORD_INVESTIGATION_2026-08-12.md` (same day, earlier session). Re-confirmed, not re-derived: title/H1/H2 keyword alignment is correct across all 8 pages (`dmc-marrakech`, `destination-management-company`, `meetings-conventions-management`, `professional-congress-organization`, `team-building-marrakech`, `events-production-morocco`, `sustainable-events-morocco`, `360-event-solutions`). The page-6+ ranking problem is domain authority and content depth versus 10-20-year-old competitors, not wrong keyword targeting. **No changes recommended.**

---

## Homepage — KEEP

**Current:** `HomepageController.php:25-27`
- Title: "Morocco Tours & Private Sahara Desert Trips from Marrakech | Morocco Quest"
- Keywords: morocco tours, private morocco tours, morocco tour package, sahara desert tours morocco, morocco desert tours from marrakech, small group tours morocco, luxury morocco tours, morocco guided tours

**SERP evidence:** Searched "morocco tours private" and "sahara desert tours from marrakech" — both dominated by large OTAs (TourRadar, TripAdvisor, GetYourGuide, Viator, Black Tomato) and long-established boutique operators (Authentic Morocco — 30+ years, Sun-Trails — since 2009). No page-1 presence for morocco-quest.com in either search.

**Verdict: KEEP.** These are the correct head terms for a Marrakech-based private tour operator — a young domain shouldn't expect to rank on bare "morocco tours" against OTAs regardless of keyword choice; that's an authority problem, not a targeting problem. Changing the keywords here wouldn't fix the underlying issue and would abandon terms with real, large search volume that the business genuinely serves. No change.

---

## Tours Index (`/tours`) — KEEP

**Current:** `TourController::index()` — 'morocco tour packages', 'morocco tours', 'private morocco tours', 'sahara desert tours morocco'

**SERP evidence:** "morocco multi day tours packages" search confirms this exact phrasing (multi-day, private, 2-17 days, Sahara/Atlas/Imperial Cities) matches how the market actually searches and how competing itineraries are structured/named.

**Verdict: KEEP.**

---

## Destinations Hub (`/destinations`) — KEEP

**Current:** `TourController::listPlaces()` — 'morocco tour destinations', 'morocco tours', 'marrakech tours', 'sahara desert tours morocco', 'private morocco tours'

**SERP evidence:** "morocco tour destinations marrakech fes" search confirms the same destination entities Morocco Quest already covers (Atlas Mountains, Ait Ben Haddou, Todra Gorges, Erg Chebbi) are exactly what ranks — the page's existing entity coverage (confirmed in project memory: Marrakech, Fes, Casablanca, Chefchaouen, Sahara/Merzouga, Atlas Mountains all present) is aligned with real search/content patterns, not generic.

**Verdict: KEEP.**

---

## Activity Categories (`/activity-categories`) — KEEP

**Current:** `ActivityController::listCategories()` — 'things to do in morocco', 'things to do in marrakech', 'morocco activities', 'morocco day tours', 'morocco experiences'

**SERP evidence:** "things to do in marrakech" search confirms this exact phrase is the dominant query pattern (souks, Bahia Palace, Jardin Majorelle, Atlas day trips, hammams) — all already reflected in Morocco Quest's activity categories (per site content: camel rides, quad biking, desert hikes, cooking classes, hot air balloon — confirmed via `ActivityController::showByType()` descriptions).

**Verdict: KEEP.** This is a strong long-tail fit; "things to do in X" is a well-established high-intent pattern the page already targets correctly.

---

## Day Tours / Activities Index — KEEP

**Current:** `ActivityController::index()` — 'morocco day tours', 'morocco activities', 'things to do in marrakech', 'morocco day trips'

**SERP evidence:** "morocco day tours activities" search confirms this phrasing matches real demand, and the specific experiences named in results (Essaouira, Chefchaouen, Fes tanneries, hot-air balloon, cooking class, Agafay Desert) are the same entities already present in Morocco Quest's activity descriptions.

**Verdict: KEEP.**

---

## About Page (`/about`) — KEEP

**Current:** `StaticPageController::about()` — 'morocco tour company', 'morocco tour agency', 'morocco tour operator', 'local morocco tour company', 'marrakech tour operator'

**SERP evidence:** "local morocco tour operator marrakech" search surfaces a different, more winnable competitive set than the bare "morocco tours" head term — smaller boutique operators (Authentic Morocco, Top Morocco Travel, Attractive Tours) rather than giant OTAs. This is a genuinely better-fit niche for a young domain, and it's exactly what About already targets.

**Verdict: KEEP.**

---

## FAQ, Contact, Blog Index, Legal Pages — KEEP

These are informational/support pages, not primary ranking targets. Their keywords (booking cost/policy questions for FAQ; contact/booking intent for Contact; travel-blog + itinerary terms for Blog index) are appropriately scoped to their actual page purpose — no commercial head-term competition to win or lose here, and changing them wouldn't move any needle. Already verified clean of duplicate/boilerplate keyword stuffing in the July 2026 audit on file.

**Verdict: KEEP, no further action.**

---

## Tour/Activity Type & Category Pages (`tours/type/*`, `activities/category/*`) — KEEP

**Current:** Dynamic per-type descriptions (garden tours, art tours, cultural tours, adventure tours, day trips, local experiences, outdoor activities, city tours) — confirmed via `TourController::showByType()` and `ActivityController::showByType()` descriptionMap.

**SERP evidence:** "camel trekking sahara tours quad biking marrakech agency" search confirms these specific activity-type terms (camel trekking, quad biking, Agafay Desert) are how this market actually segments and searches — dozens of competitors have entire pages built around exactly these type-terms (agafay-desert.com, marrakechquadbiking.com, morocco-cameltrekking.com). Morocco Quest's type-page structure already mirrors this correctly.

**Verdict: KEEP.**

---

## Individual Tour/Activity Detail Pages — No sitewide verdict (data-driven)

These use per-record `seo_title`/`meta_description` from the database (`Tour::$seo_title`, `Activity::$seo_title`) with a title/keyword fallback pattern, not hardcoded controller strings. This dev environment has 0 Tour/Activity records, so individual page-level keyword auditing isn't possible from here — would need production data or a sample of real tour/activity titles to check.

**Verdict: Not assessable in this session — flag for a future pass with production data.**

---

## Summary Table

| Page/Section | Current primary keyword | SERP evidence | Verdict |
|---|---|---|---|
| DMC/B2B (8 pages) | dmc marrakech + cluster | Re-confirmed from today's earlier audit | **KEEP** |
| Homepage | morocco tours / sahara desert trips | OTA-dominated SERP, but correct terms for the business | **KEEP** |
| `/tours` | morocco tour packages | Matches real multi-day tour market structure | **KEEP** |
| `/destinations` | morocco tour destinations | Entity coverage matches real ranking pages | **KEEP** |
| `/activity-categories` | things to do in marrakech | Exact-match to dominant real query pattern | **KEEP** |
| `/activities` (index) | morocco day tours | Matches real demand + entity coverage | **KEEP** |
| `/about` | local morocco tour operator | Better-fit niche competitive set than OTA head terms | **KEEP** |
| FAQ / Contact / Blog / Legal | Informational/support terms | Not commercial ranking targets | **KEEP** |
| `tours/type/*`, `activities/category/*` | Type-specific (camel trekking, quad biking, etc.) | Matches real market segmentation | **KEEP** |
| Individual tour/activity pages | DB-driven, per-record | Not assessable — dev DB empty | **Not assessed** |

---

## Overall Verdict

**No keyword changes recommended anywhere on the site.** Every page category checked has keyword targeting that already matches real search demand and real SERP structure, confirmed via live search rather than assumption. This is consistent with the two prior on-file audits (June 2026 site-wide pass, July 2026 DMC pass) reaching the same conclusion independently.

The site's actual ranking constraint — visible in every SERP checked today, not just DMC — is **domain authority and competitive maturity**, not keyword selection. Every head term checked is dominated either by large OTAs (TripAdvisor, Viator, GetYourGuide, TourRadar) or by operators with 10-30 years of operating history. Morocco Quest (founded 2022, DR ~6 as of Aug 2026) is correctly targeted but under-ranking on authority — the same finding as the DMC section, now confirmed sitewide.

**What would actually move rankings, in priority order (not implemented — these are content/authority/business decisions, not code fixes):**
1. Continued backlink building (already the #1 priority in the owner's own August 2026 client report)
2. Content depth expansion on the highest-value pages (matches the DMC finding: competitors run 2,500-3,000+ word pages vs. Morocco Quest's shorter pages)
3. Visible trust signals (reviews, client mentions) — same gap identified in the DMC audit, likely applies sitewide
4. Time — a 4-year-old domain will not out-rank 20-year-old operators on backlinks/authority alone in months; the SEO fundamentals are correctly in place for when authority catches up

**No code was changed in this session** — this was a research/audit pass only, per your instruction to report findings before implementing.
