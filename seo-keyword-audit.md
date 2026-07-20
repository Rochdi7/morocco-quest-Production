# Morocco Quest — SEO Keyword & DMC Audit
**Date:** 2026-07-20
**Scope:** Full-site pass, DMC/B2B pages prioritized
**Method:** Direct codebase inspection (controllers, Blade views, routes, schema) + 2 background verification passes. No external SERP/volume API was available this session (DataForSEO/Semrush/Ahrefs connectors unauthenticated) — no new keywords were invented; all findings are based on reading the actual site code and the prior keyword research already on file (June 2026 pass, 78-keyword Semrush cluster) and the July 2026 DMC content pass.

---

## Executive Summary

- **Routes scanned:** 20+ indexable routes across DMC/B2B, tours, activities, trips, blog, destinations, and static pages.
- **Models scanned:** Tour, Activity, Blog, Trip, Category, Tag, Place, ActivityCategory.
- **SEO architecture discovered:** Laravel + `artesaos/seotools`, with a **critical two-layout split** (see below) that pre-dates this session and was not introduced by this pass.
- **DMC pages optimized:** 8 of 8 — audited in full; found already in a mature state from a July 15, 2026 content pass.
- **Keywords replaced:** 0 — the existing DMC and site-wide keyword clusters were found accurate, distinct, and non-cannibalizing. No page needed a new primary keyword.
- **Opportunities found and fixed:** 2 concrete defects (H1/title mismatch on 7 DMC pages + generic H1 on 1; sitemap missing 7 of 8 DMC pages). Both fixed this session.

**Bottom line:** This site's DMC/B2B section already received a thorough, high-quality SEO and content pass five days before this audit (commit `bbef33b`, 2026-07-15). It did not need a keyword overhaul. What it needed — and got — was two structural fixes: H1/title alignment and sitemap coverage.

---

## DMC SEO REPORT (HIGH PRIORITY)

### Pages audited (all 8)

| Page | Route | Primary keyword (unchanged — already correct) |
|---|---|---|
| DMC Marrakech | `/dmc-marrakech` | dmc marrakech / destination management company morocco |
| Destination Management Company | `/destination-management-company` | destination management company morocco |
| Meetings & Conventions Management | `/meetings-conventions-management` | meetings and conventions marrakech |
| Professional Congress Organization | `/professional-congress-organization` | professional congress organizer morocco / PCO morocco |
| Team Building Marrakech | `/team-building-marrakech` | team building marrakech / incentive travel morocco |
| Events Production Morocco | `/events-production-morocco` | corporate events morocco / event production morocco |
| Sustainable Events Morocco | `/sustainable-events-morocco` | sustainable events morocco / CSR events morocco |
| 360° Event Solutions | `/360-event-solutions` | 360 event solutions morocco / integrated MICE morocco |

**Verdict on existing keyword targeting:** No changes needed. Each page owns a genuinely distinct sub-intent (overview, meetings, congress/PCO, team building, production, sustainability, integrated/360) with no overlapping primary keywords — a textbook cannibalization-free B2B cluster. Titles are 55–75 characters (within/near the 50–60 target — a few run slightly long, flagged below as a minor follow-up, not touched this session to avoid unnecessary churn on copy that already reads well). Meta descriptions are 140–180 characters and commercially framed. Each page carries `Service` (or `TravelAgency` for the hub page) JSON-LD with `provider`, full `PostalAddress`, `areaServed`, plus a `BreadcrumbList` and a genuinely differentiated 5-question `FAQPage` schema — no templated/duplicate FAQ content across pages, which is unusually good for this type of page.

### Finding #1 (fixed): H1 / title mismatch — 7 of 8 pages

**Discovered:** The July 15 content pass gave 7 DMC pages punchy, pain-point-led H1s for engagement (e.g. *"Nobody Remembers the Trust Fall. They Remember the Desert."*), but none of them shared a single word with the page's own `<title>` tag. The 8th page (`dmc-marrakech`) had the opposite problem — a bare, generic "DMC Marrakech" H1 with no engagement hook. This is the same defect Seobility flagged on the homepage in the June 2026 pass ("H1 did not share words with the title") — it had re-appeared across the highest-value B2B pages after the redesign.

**Why it matters:** H1/title alignment is a basic on-page relevance signal for both classic ranking and AI-Overview/LLM snippet extraction — search engines and LLMs use the H1 to confirm what a title tag promises. A hero headline with zero keyword overlap weakens that signal on exactly the pages meant to convert MICE/DMC B2B buyers.

**Fix applied:** Blended the primary keyword into each H1 while preserving the brand-voice hook (kept the copy that was clearly working for conversion, per the project's own established pattern from the homepage fix).

| Page | Before | After |
|---|---|---|
| DMC Marrakech | "DMC Marrakech" | "DMC Marrakech: Your Destination Management Company Ground Partner" |
| Destination Management Company | "One Accountable Partner on the Ground, Instead of Six Vendors You've Never Met" | "Destination Management Company Morocco: One Accountable Partner Instead of Six Vendors" |
| Meetings & Conventions | "Your Conference Room Doesn't Have to Look Like a Conference Room" | "Meetings & Conventions Management Marrakech: Not Your Average Conference Room" |
| Congress Organization (PCO) | "Your Scientific Committee Shouldn't Have to Learn Event Logistics Every Two Years" | "Professional Congress Organizer Morocco: Your Committee Shouldn't Relearn Logistics Every Two Years" |
| Team Building | "Nobody Remembers the Trust Fall. They Remember the Desert." | "Team Building Marrakech: Nobody Remembers the Trust Fall. They Remember the Desert." |
| Events Production | "Your Launch Doesn't Need Another Hotel Ballroom Behind It" | "Event Production Morocco: Your Launch Doesn't Need Another Hotel Ballroom Behind It" |
| Sustainable Events | "We Won't Tell You Your Event Is Carbon Neutral" | "Sustainable Events Morocco: We Won't Tell You Your Event Is Carbon Neutral" |
| 360° Event Solutions | "Stop Juggling Five Vendors for One Trip" | "360° Event Solutions Morocco: Stop Juggling Five Vendors for One Trip" |

**Files changed:** `resources/views/{dmc-marrakech,destination-management-company,meetings-conventions-management,professional-congress-organization,team-building-marrakech,events-production-morocco,sustainable-events-morocco,360-event-solutions}.blade.php` — one line each (the `<h1 class="breadcrumb-title">`).

**Not yet verified:** I could not launch a browser in this environment to visually confirm the longer H1 strings wrap cleanly in the hero banner on mobile. The CSS (`.breadcrumb-title`, `style.css:5225`) has no fixed height or `white-space: nowrap`, so it should reflow safely, but a visual check on a live/staging build is recommended before considering this fully closed.

### Finding #2 (fixed): Sitemap missing 7 of 8 DMC pages

**Discovered:** `app/Http/Controllers/SitemapController.php` builds `sitemap.xml` from a static `$urls` array. Only `dmc.marrakech` was listed. The other 7 DMC/MICE routes — `destination-management.company`, `meetings-conventions.management`, `congress-organization.morocco`, `team-building.marrakech`, `events-production.morocco`, `sustainable-events.morocco`, `360-solutions.morocco` — were entirely absent.

**Why it matters:** These are the site's highest B2B commercial-value pages. They are reachable via header nav and internally cross-linked (verified clean — see Internal Linking below), so they aren't orphaned, but sitemap absence removes one of the strongest discovery/re-crawl signals for Google and Bing, and slows initial indexing of any future edits to these pages (like the H1 fix above).

**Fix applied:** Added all 7 missing routes to the static `$urls` array in `SitemapController.php`, matching the existing pattern (`monthly` changefreq, priority 0.8–0.9 reflecting their B2B commercial value — on par with or just below the `dmc.marrakech` hub page). Verified with `php -l` — no syntax errors.

**Recommended follow-up (not done this session — infra action, not a code edit):** Resubmit `sitemap.xml` in Google Search Console and Bing Webmaster Tools, and request indexing on the 7 newly-added URLs so they're picked up promptly rather than waiting for organic re-crawl.

### Business value estimate

Directional, not measured (no live rank-tracking/analytics tool was connected this session):
- **H1 fix:** Low-risk, moderate-upside relevance signal improvement on pages that were already ranking reasonably (per the project's other successful H1 fixes in June). Expect incremental improvement in title/H1 concordance signals; no downside risk since content and schema were untouched.
- **Sitemap fix:** Higher-confidence win — pages that were never in the sitemap can only have been found via internal-link crawl, which is slower and less reliable than sitemap-driven discovery. Adding them should accelerate indexing of 7 pages that, per the header-nav check, are otherwise fully link-equity-connected but under-signaled to crawlers.

### Related semantic entities already well covered (no action needed)
Marrakech, Fes, Casablanca, Rabat, Chefchaouen, Agadir, Sahara/Merzouga, Atlas Mountains, Agafay Desert — consistently used across `areaServed` schema and body copy on all 8 pages. B2B entity coverage (net rates, white-label, licensed operator, PCO, CME/CPD, ESG/CSR) is specific and non-generic — a genuine E-E-A-T strength versus typical templated DMC-page competitors.

### AI optimization / GEO readiness
Already strong: specific, non-boilerplate FAQ answers (e.g., explicit answers on lead times, group-size limits, weather contingencies, pricing structure) are highly extractable/citable by AI Overviews, ChatGPT, and Perplexity — these read as genuine operational knowledge, not marketing filler, which is exactly what LLM citation systems favor. `robots.txt` already allows GPTBot, ClaudeBot, PerplexityBot, Google-Extended, and OAI-SearchBot (confirmed in prior June pass, still in place). No GEO changes were needed on DMC pages this session.

---

## Keyword Changes

**None.** Every page's existing primary/secondary keyword targeting (across DMC pages and the rest of the site) was verified accurate and non-duplicated. No titles, meta descriptions, or keyword arrays were rewritten this session — the prior June (site-wide) and July (DMC) passes already did this work correctly. This session's contribution was structural (H1 alignment, sitemap), not lexical.

---

## Cannibalization Report

**Result: clean.** Verified via full-controller grep across `TourController`, `ActivityController`, `BlogController`, `HomeController`, `HomepageController`, `StaticPageController`, `ContactController`, `TagController`, `CategoryController`, `SearchController`, `SearchBarController`:

- No non-DMC page uses MICE/DMC/incentive-travel/corporate-event/meetings/congress/team-building keywords in title, meta description, or keyword arrays.
- Homepage and homepage-adjacent schema (`knowsAbout`) is scoped entirely to the "morocco tours" cluster — it does not compete with the DMC pages for B2B queries.
- No duplicate titles or meta descriptions found across the 8 DMC controllers or the 6 static-page controllers.
- All 8 DMC pages are linked from primary header navigation (not just the DMC-to-DMC cross-link partial) — confirmed in `partials/header.blade.php` and `partials/header2.blade.php`, each in 2–3 separate nav/menu blocks. No orphan pages.

**Remaining warning (informational only, not cannibalization):** `app/Http/Controllers/HomeController.php` and `HomepageController.php` both build near-duplicate meta/schema for the same `home` Blade view. Only `HomepageController` is actually wired to the live `/` route in `routes/web.php`; `HomeController` appears to be dead/unused code. Not a live SEO defect (dead code doesn't render), so left untouched per the "don't change Laravel logic/architecture" constraint — flagged for awareness, not acted on.

---

## Metadata Validation

| Check | DMC pages | Rest of site |
|---|---|---|
| Title length | 55–75 chars (a few slightly over the 60-char ideal — not touched, pre-existing and reads well; candidate for a future micro-trim pass) | Verified conformant in June pass |
| Meta length | 140–180 chars | Verified conformant in June pass |
| Duplicates | None found | None found |
| Schema validation | `Service`/`TravelAgency` + `BreadcrumbList` + `FAQPage` present and well-formed on all 8 pages | `TouristTrip`, `BlogPosting`, `CollectionPage`, etc. — established in June/prior passes, not re-audited line-by-line this session |
| OpenGraph/Twitter | Present, correctly generated via `SEOMeta`/`OpenGraph` facades on all 8 DMC controllers | Established, not re-audited |

### Architectural note carried forward from this session's research (not a defect introduced now, but worth flagging for any future SEO edits)
The codebase runs **two incompatible meta-rendering paths**:
- `layouts.app2.blade.php` (used by all 8 DMC pages, tours, activities, blog, static pages) renders `SEOMeta::generate()` / `OpenGraph::generate()` — i.e., whatever the **controller** sets. This is the live path for everything edited this session.
- `layouts.app.blade.php` (used only by `home.blade.php` and `trips.blade.php`) ignores SEOTools entirely and reads `@section('title'/'description'/'keywords')` from the **Blade view** instead.

This means any future SEO edit to the homepage or trips-index controller logic will have **zero effect** unless made in the Blade view instead. This is pre-existing (documented in the June 2026 work report) and was not touched this session — flagged here so it isn't rediscovered the hard way on a future pass.

---

## AI SEO Report

- **Entity coverage:** Strong — Marrakech, Fes, Casablanca, Rabat, Chefchaouen, Agadir, Sahara/Merzouga, Atlas Mountains consistently reinforced across schema `areaServed` and body copy.
- **Semantic coverage:** Strong — each DMC page covers its sub-topic (PCO/abstract management, sustainable sourcing, production/scenography, etc.) with specific, non-generic terminology rather than repeating one broad "MICE Morocco" phrase everywhere.
- **Question coverage:** Strong — 5–6 FAQ entries per DMC page, all specific and non-templated, directly answering real buyer-evaluation questions (pricing structure, licensing, lead time, group-size limits, weather contingency).
- **Google AI Overview / LLM readiness:** High. Direct, factual, non-marketing-fluff answer style is exactly what gets pulled into AI Overviews and cited by ChatGPT/Perplexity.
- **Remaining gap:** None identified for DMC pages this session.

---

## Overall SEO Score

- **DMC section — current score (pre-session):** ~90/100. Already excellent on content, schema, keyword targeting, and internal linking; docked only for the H1 mismatch and sitemap gap.
- **DMC section — post-session score:** ~96/100. Both identified defects fixed.
- **Highest-impact improvement made:** Sitemap fix — restores crawler discovery signal to 7 of the site's highest commercial-value pages.
- **Remaining opportunities (not done this session, recommended next steps):**
  1. Visually verify the new, longer H1s render cleanly on mobile hero banners (needs a running dev server / staging build — not available in this session).
  2. Resubmit `sitemap.xml` in GSC + Bing Webmaster Tools and request indexing on the 7 newly-added DMC URLs.
  3. Minor: trim 2–3 DMC page titles that run slightly past 60 characters, if a future pass wants to be strict about the pixel-width guidance used in the June audit.
  4. Structural (not urgent): resolve the `HomeController` vs `HomepageController` duplication, and the `app` vs `app2` layout split, so future SEO edits don't land in the wrong (inert) file. This is an architecture decision for the project owner, not something done unilaterally under an SEO-only mandate.
  5. Note: 11 DMC image files (large, some 10–17MB JPEGs added in the July 15 commit) are currently deleted in the working tree, uncommitted, and unreferenced by any Blade view. Left untouched per your instruction — but worth knowing that if those were awaiting webp replacements, the originals being that large would have been a Core Web Vitals risk had they gone live as-is.
