# /dmc-marrakech Keyword Investigation — 2026-08-12

**Method note:** Semrush MCP connector was not authorized in this session and no manual Semrush export was provided. Per your instruction, this investigation was done via live Google/web search and direct competitor page fetches instead of Semrush. This is directionally reliable (real live SERP composition, real competitor on-page content) but does not include exact search volume, KD%, or Morocco Quest's precise current position/impressions — those numbers can only come from Semrush, GSC, or the new Position Tracking campaign once it has data.

---

## Current Evidence

### The "dmc marrakech" SERP is dense and mature
Live search for "dmc marrakech" surfaces at least 7 dedicated, exact-topic competitors on page 1 alone, none of which is morocco-quest.com:

- **dmc-marrakech.com** (MidFar DMC) — exact-match domain, H1 "DMC Marrakech", 4.9/5 review schema, long-form authority content
- **Attendance MICE** (attendance.ma) — Marrakech-based, MICE/conferencing focus
- **Your Morocco DMC** (your-morocco-dmc.com)
- **Originally Morocco** (originallymorocco.com) — ~2,500-3,000 words, founded 2006, 30+ client/partner logos, FAQ section
- **View Morocco** — has a Tripadvisor company listing (real reviews, real trust signals)
- **dmcmarrakech.com** — separate competitor, same near-exact-match domain pattern

A `site:morocco-quest.com` search for "dmc marrakech" surfaces the page and correctly describes its content, confirming the page is indexed and topically on-target — but it did not surface in the open "dmc marrakech" query itself in this session's checks, consistent with your screenshot showing it on page 6+.

### Competitor content depth
- `dmc-marrakech.com`: exact-match domain + H1, "DMC Marrakech" repeated through headings and body, long-form destination + service content, travel-fact schema, 4.9/5 rating shown.
- `originallymorocco.com`: ~2,500–3,000 words, founded 2006 (20 years of operating history vs. Morocco Quest's 2022 founding), client testimonials, 30+ partner logos, FAQ section, multiple named package pages.

### Morocco Quest's actual page
- Real prose word count on `/dmc-marrakech` is roughly 500–700 words of paragraph copy (plus structured stat/FAQ content) — noticeably thinner than the two competitors fetched.
- On-page SEO fundamentals are already solid, confirmed by direct inspection of the Blade view and controller:
  - Title: `"DMC Marrakech | Destination Management Company Morocco | Morocco Quest"` (controller-set, live)
  - H1: `"DMC Marrakech: Net-Rate Ground Handling for Agents, Operators & MICE"` — shares keywords with the title
  - H2s reuse "DMC" / "Marrakech" / "DMC Morocco Partner" naturally across 6 sections
  - `FAQPage` schema present with 5 genuinely differentiated Q&As
  - `BreadcrumbList` schema present
  - Meta description under 160 chars (fixed earlier this session)
- **Found a real discrepancy while reading this page:** `dmc-marrakech.blade.php` line 3 has a hardcoded `@section('title', 'DMC Marrakech | Morocco Ground Handler for Travel Agents & MICE | Morocco Quest')` that does **not** match the title `DmcController::index()` actually sets (`'DMC Marrakech | Destination Management Company Morocco | Morocco Quest'`). Because `layouts.app2` renders via `SEOMeta::generate()` (controller-driven), the Blade `@section('title')` is dead code — but it's confusing to maintain and should eventually be deleted or reconciled.

### Domain authority (from your own August 2026 client report, already on file)
- Domain Rating: 0.2 → 6 (as of the report period ending 2026-08-10)
- Backlinks: 280 → 438
- Referring domains: 274 → 413
- Founded: 2022 (per About page), vs. Originally Morocco's 2006

This is real, measured progress, but still very early-stage authority against competitors that have operated for 10-20 years with established review profiles (Tripadvisor listings, 4.9/5 schema ratings) and dozens of visible client/partner logos.

### Search volume, KD%, exact position — not available
I could not retrieve Semrush's Keyword Overview numbers or Organic Research position data this session (no tool access, no manual paste provided). These are needed to fully complete the "record volume/KD/position" part of your brief — flagged as a gap below, not fabricated.

---

## Diagnosis

**COMPETITIVE**, not targeting or intent mismatch, and not cannibalization.

The page is correctly targeted (title/H1/H2/schema all align with "DMC Marrakech" and the surrounding cluster), and there's no evidence of a second Morocco Quest page competing for the same query — the DMC section's 8 pages each own a distinct sub-intent (confirmed in the 2026-07-20 audit already on file, re-verified today: no title/keyword overlap found across `dmc-marrakech`, `destination-management-company`, `meetings-conventions-management`, etc.).

The page 6+ ranking is best explained by:
1. **Young domain authority** relative to a SERP full of established, exact-match-domain, decade-plus-old competitors with visible trust signals (reviews, client logos, awards).
2. **Thinner content depth** (~500-700 words of prose) than the two competitors directly compared (~2,500-3,000 words).
3. **No visible trust/social proof** on the page itself — no client logos, no named case studies, no visible review score — while at least two direct competitors lead with exactly that.

This is not a quick on-page fix. It's a genuine authority-and-depth gap in a mature, competitive B2B niche.

---

## Recommended Keyword Map

| Page | Primary keyword | Secondary keywords | Intent | Evidence |
|---|---|---|---|---|
| `/dmc-marrakech` | dmc marrakech | destination management company morocco, dmc morocco, morocco ground handler, b2b tour operator morocco | Commercial/B2B navigational | Already correctly targeted — confirmed via title/H1/H2 inspection; SERP is dominated by identically-targeted competitors |
| `/destination-management-company` | destination management company morocco | dmc morocco, morocco inbound tour operator, morocco ground services | Commercial/informational | Distinct sub-intent from dmc-marrakech (explainer vs. hub), confirmed no overlap in July audit |
| `/meetings-conventions-management` | meetings and conventions marrakech | conference organizer marrakech, corporate meetings morocco | Commercial | Matches "Palais des Congrès de Marrakech" venue-driven demand seen in live SERP research |
| `/professional-congress-organization` | professional congress organizer morocco | PCO morocco, medical congress morocco, conference logistics morocco | Commercial | Narrow, well-differentiated B2B sub-niche; low direct competition observed in this session's searches |
| `/team-building-marrakech` | team building marrakech | incentive travel morocco, atlas mountains team building | Commercial | Matches competitor service listings (Originally Morocco, Attendance MICE both list team-building as a core service) |
| `/events-production-morocco` | event production morocco | corporate events morocco, mice event logistics morocco | Commercial | Matches "Event Morocco DMC" and "Sahara Experience Events" competitor positioning found in live search |
| `/sustainable-events-morocco` | sustainable events morocco | csr events morocco, esg travel morocco | Commercial, niche | No direct competitor found targeting this specific angle in this session's research — a genuine differentiation opportunity, not a red ocean |
| `/360-event-solutions` | 360 event solutions morocco | integrated mice morocco, full-service dmc morocco | Commercial | Positions against "full-service" competitor claims (Originally Morocco, Tetrapylon) |

No keyword changes are recommended for any of these 8 pages — this matches the July 2026 audit's conclusion and today's re-verification. The map above documents current targeting, not a proposed rewrite.

---

## Implementation

**No content rewrite applied.** The evidence points to an authority/depth gap, not a targeting defect — rewriting title/H1/meta on a page that's already correctly optimized would not address the actual cause and risks disrupting metadata that's already working (confirmed clean in this session's earlier technical fixes: title suffix bug fixed, meta description trimmed to spec).

One small, low-risk cleanup applied:

**Fixed:** `resources/views/dmc-marrakech.blade.php` — removed the dead, mismatched `@section('title', ...)` line that doesn't match the live controller-set title. This was inert (never rendered, since `layouts.app2` reads from `SEOMeta::generate()`), but leaving a contradicting title string in the view invites a future editor to "fix" the wrong one and accidentally break the live title.

No other file was changed. Title, H1, meta description, schema, and body copy on all 8 DMC pages are left as-is, since evidence didn't support changing them.

---

## What Would Actually Move This Keyword (not implemented — needs your decision)

Since the diagnosis is competitive/authority, not on-page, the highest-leverage next steps are outside a single Claude session's normal SEO-pass scope:

1. **Add visible trust signals to `/dmc-marrakech`**: real client logos (even 3-5 named agencies/operators you've worked with), a named case study or two, or a visible review score if you have Tripadvisor/Google reviews for the DMC side of the business specifically. Every top-ranking competitor has this; Morocco Quest's page currently doesn't.
2. **Expand body content depth** on `/dmc-marrakech` itself — more specific, non-templated detail on process, sample itineraries, or named venue partnerships (e.g. specific riads, the Palais des Congrès) — to close the ~500-700 vs. ~2,500-3,000 word gap versus top competitors. This is a content task, not a code task; I can draft it if you want, following the "don't force keywords, build a real semantic cluster" instruction in your brief.
3. **Backlink building specifically to the 8 DMC pages** (already flagged as next-month priority in your August client report) — this is the single highest-leverage lever given the diagnosis is authority-driven, not on-page.
4. **Consider a Google Business Profile / directory presence** for the DMC/B2B side specifically, since competitors' Tripadvisor listings and review schema are functioning as real differentiators in this SERP.

---

## Position Tracking

Position Tracking campaign created on Aug 12, 2026 — currently no historical data; wait for Semrush collection for future trend monitoring. Its current 0% visibility was **not** used as evidence anywhere in this diagnosis.

---

## Gaps in This Investigation (being honest, not claiming complete)

- No Semrush Keyword Overview data (search volume, KD%, exact SERP feature list) for "dmc marrakech" — need Semrush access or a manual paste to complete this.
- No Semrush Organic Research/Positions export for `/dmc-marrakech` — couldn't confirm exact current position number, just the qualitative "page 6+" from your screenshot.
- No Keyword Gap run against the 4 named competitor domains (monarchtravel.com, travel-design-dmc.com, eventplannermarrakech.com, moroccohospitalityservices.com) — these weren't the domains that actually surfaced in live search results (a different competitor set showed up: dmc-marrakech.com, originallymorocco.com, attendance.ma, your-morocco-dmc.com, etc.), so the gap analysis above is based on the domains that genuinely rank, not the 4 you listed. If those 4 are known direct competitors from your own market knowledge, worth telling me so I can specifically fetch and compare their pages too.
- Could not confirm whether Google shows a Local Pack or AI Overview for "dmc marrakech" — direct Google SERP fetching was blocked in this environment; WebSearch's summarized results are a reliable proxy for ranking domains but don't expose SERP-feature layout.
