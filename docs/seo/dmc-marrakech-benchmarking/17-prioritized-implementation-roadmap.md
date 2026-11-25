# 17 — Prioritised Implementation Roadmap: "DMC Marrakech"

**Priorities:**
- **P0** = critical: highest impact per effort, or a blocker for other work.
- **P1** = high impact.
- **P2** = important.
- **P3** = long-term.

Impact estimates are judgements from the evidence in 12–14, not guarantees. ⚑ = needs owner facts or assets. Nothing below is implemented yet; the first-pass local edits (title, description, H1, Service schema, homepage link) are **uncommitted and undeployed** and appear as P0-1.

## 1. Content improvements

| P | Task | Current situation | Required improvement | SEO impact | Effort | Files / pages |
|---|---|---|---|---|---|---|
| P1 | Align all scale claims ⚑ | "20+ groups/yr" vs "400+ delegates" vs "groups of 500+" | One verified set of numbers used everywhere | Medium (trust consistency) | Low | `dmc-marrakech.blade.php` (trust bar, FAQ), `partials/dmc-guide.blade.php` |
| P1 | Replace the illustrative "Example:" programmes ⚑ | 3 italic invented-style examples in the guide | Link to real case studies (section 2, P1) | Medium–High (E-E-A-T) | Low (after case studies) | `partials/dmc-guide.blade.php` |
| P2 | Name real venues and suppliers ⚑ | "a 3,500-seat congress centre" (unnamed) | Name venues actually used (Palais des Congrès, hotels) | Medium (entities) | Low | `partials/dmc-guide.blade.php` |
| P2 | Add missing service lines (if offered) ⚑ | No product launches, seminars, themed dinners, reward trips | Bullets in the MICE accordion | Low–Medium | Low | `partials/dmc-guide.blade.php` |
| P2 | Prune the FAQ from 15 to about 12 and add 2 trade questions ⚑ | 15 FAQs, some generic | Keep the most useful, add "agencies only or direct?" and "licence?" | Low–Medium | Low | `dmc-marrakech.blade.php` (`$dmcFaqs`) |
| P3 | Supporting blog posts (buyer guide, case-study write-ups) | 1 blog post links in | 2–4 posts linking to /dmc-marrakech with varied anchors | Medium (topical cluster) | Medium | Blog (admin/DB) |

## 2. New sections

| P | Task | Current situation | Required improvement | SEO impact | Effort | Files / pages |
|---|---|---|---|---|---|---|
| P1 | **Verified facts bar** ⚑ | 4 unprovable stats | Licence no., start year, 2025 volumes, Gueliz office, linked Google rating | **High** (proof; the market norm) | Low once facts exist | `dmc-marrakech.blade.php` (trust bar) |
| P1 | **Programmes we delivered** (2–3 cases) ⚑ | None | Case cards with real data and photos | **High** (experience) | Medium | New partial `partials/dmc-case-studies.blade.php` |
| P1 | **Service index tiles** | Breadth hidden inside collapsed accordions | 8 linked tiles after the intro | Medium (relevance, UX, internal links) | Low | `dmc-marrakech.blade.php` |
| P2 | **Marrakech planner facts** | None (C2 has a facts table) | Facts table + drive-time map | Medium (helpful/citable content) | Low | `partials/dmc-guide.blade.php` or a new block |
| P2 | **How to choose a DMC** checklist | None | 6–8 checks answered with MQ facts | Medium | Low | `dmc-marrakech.blade.php` |
| P2 | Visible "How we work" steps | Hidden in an accordion | Move to its own H2 timeline | Low–Medium | Low | `dmc-marrakech.blade.php`, `partials/dmc-guide.blade.php` |
| P2 | **French DMC page** (`/fr/dmc-marrakech`) with hreflang | English only | Localised FR page + hreflang en/fr/x-default | **Medium–High** (#1 result is FR; "séminaire marrakech" 210/mo FR) | High | New route/view/controller, sitemap |

## 3. Image and visual improvements

| P | Task | Current situation | Required improvement | SEO impact | Effort | Files / pages |
|---|---|---|---|---|---|---|
| P1 | **Replace the hero** (I1) ⚑ | Stock auditorium seats; filename "koutoubia"; CSS bg with no alt | Original Marrakech event photo as `<img>`/`<picture>` with alt, preloaded | Medium (experience signal, image relevance, CTR) | Medium (photo) + Low (code) | `dmc-marrakech.blade.php`, `public/assets/img/` |
| P1 | **DMC-specific OG image** (I13) | Generic Aït Benhaddou | 1200×630 DMC card | Low–Medium (sharing CTR) | Low | `DmcController.php` |
| P1 | **B2B contact portrait** (I10) ⚑ | None | Named manager photo | Medium (trust) | Low | form section |
| P2 | Section photos I4–I8 ⚑ | Accordions are text only | Original MICE, incentive, team-building, transfer and riad photos | Medium | Medium | `partials/dmc-guide.blade.php` |
| P2 | Rename/resize `destination management company (1).webp` (I3) | Spaces in filename; 3105 px source | `dmc-marrakech-group-ben-youssef-madrasa.webp` at 1200 px | Low | Low | `dmc-marrakech.blade.php`, asset |
| P2 | Decorative icons `alt=""` | "Cloud illustration" / "Hot air balloon illustration" | Empty alt | Low (accessibility) | Low | `dmc-marrakech.blade.php` |
| P3 | Gallery (I14) and video reel (I15) ⚑ | None | 6–8 real photos; a lite video facade | Low–Medium | Medium | new partial |
| P3 | Simplify the inline world-map SVG | 945-line SVG; 1,975 DOM nodes | External cached SVG `<img>` | Low (performance) | Low | `partials/dmc-world-map.blade.php` |

## 4. Technical SEO

| P | Task | Current situation | Required improvement | SEO impact | Effort | Files / pages |
|---|---|---|---|---|---|---|
| **P0-1** | **Deploy the first-pass edits** | Local only: title/description/H1, Service schema, homepage link | Deploy, then `php artisan view:clear && php artisan cache:clear`; purge the edge cache (max-age 7200) | Medium (aligns with the ranking pattern) | Low | `DmcController.php`, `dmc-marrakech.blade.php`, `home.blade.php` |
| **P0-2** | **GSC access for morocco-quest.com** | Service account sees another property only | Add the account to the MQ property; URL Inspection + Request indexing for `/dmc-marrakech`; 90-day query report | Enables measurement (no direct ranking effect) | Low | Search Console |
| **P0-6** | **Correct the controller comment** | Says the page "fell out of the top ~94" (disproved) | Replace with the verified baseline (#15–18 on 2026-11-24) | None (accuracy) | Trivial | `DmcController.php` |
| P1 | `alternateName: "Morocco Quest DMC"` sitewide ⚑ (O-13) | Schema says "Morocco Quest Tours & Travel"; TripAdvisor/Instagram/GBP say "Morocco Quest DMC" | Unify the entity name | Medium (entity matching for a semi-navigational query) | Trivial | `layouts/app2.blade.php`, `layouts/app.blade.php` |
| P1 | `hasCredential` / `memberOf` ⚑ | None | Add once the licence and memberships are confirmed | Low–Medium | Trivial | layouts |
| P2 | B2B `ContactPoint` in schema | None | contactType "sales", languages, email/phone | Low | Trivial | layouts or page |
| P3 | Performance backlog (FontAwesome Pro, cold TTFB) | Documented in the 2026-10-14 audit | Per that audit | Low for this keyword (MQ is already fastest of the three) | Medium | — |

## 5. Internal linking

| P | Task | Current situation | Required improvement | SEO impact | Effort | Files / pages |
|---|---|---|---|---|---|---|
| P0 | Homepage contextual link (part of P0-1) | Local only | Deploy | Medium | — | `home.blade.php` |
| P1 | Service-index tiles → sister DMC pages | Related-services partial at the bottom only | Contextual links high on the page (P1 above) | Medium | Low | `dmc-marrakech.blade.php` |
| P2 | Links from /about and /contact | None contextual | "Our DMC desk in Marrakech" → /dmc-marrakech | Low–Medium | Low | `about.blade.php`, `contact.blade.php` |
| P2 | Links from relevant blog posts | 1 post | 3–5 posts, varied natural anchors (no exact-match repetition) | Medium | Low | Blog (admin) |

## 6. Backlinks and authority (including local presence)

| P | Task | Current situation | Required improvement | SEO impact | Effort | Files / pages |
|---|---|---|---|---|---|---|
| **P0-3** | **Apply for a listing on Visit Marrakech MICE "Les agences réceptives (DMC)"** | Not listed (49 competitors are) | Contact the CRT Marrakech-Safi (contact@visitmarrakech.com, 0524 43 34 07) or use the listing "Application Form"; supply name, description, website `https://morocco-quest.com/dmc-marrakech`, phone, Gueliz address | **High**: presence on the #1 result + a followed link from AS 47 + a profile page that can rank | Low–Medium | Off-site |
| **P0-4** | **Google Business Profile "Morocco Quest DMC"** ⚑ | Not in the map pack (incumbents: 3–22 reviews) | Verify the profile; primary category (e.g. Tour agency / Travel agency, matching the incumbents); Gueliz address; services: DMC, MICE, incentive travel, team building, ground handling; business description; 10+ real photos (I1–I8); website → /dmc-marrakech (or homepage + services link); **ask real B2B clients for reviews**; no keywords in the business name beyond the real name | **High** (map pack + AI Overview sit above organic #1) | Low–Medium | GBP (off-site) |
| P1 | Partner-agency citations ⚑ | None | Ask agencies you deliver for to list "Morocco Quest DMC" as their Morocco ground partner, linking to /dmc-marrakech | High (most relevant links possible) | Medium | Off-site |
| P1 | TripAdvisor "Morocco Quest Dmc" reviews | Listing exists | Collect real reviews; consistent NAP | Medium | Low | Off-site |
| P2 | DMC directories: Cvent Supplier Network, dmcfinder, 1dmcworld, DMC Network / Global DMC Partners (if eligible) | None | Accurate profiles linking to /dmc-marrakech | Medium | Medium | Off-site |
| P3 | Trade press with a real case study (TravelDailyNews, Travel Courier, eGlobal Travel Media) and trade fairs via ONMT | None | One news story per real milestone | Medium | Medium–High | Off-site |
| — | **Spam links** | ~1,870 domains with automated SEO-spam anchors (same as competitors) | No action by default (Google ignores them); disavow only if GSC ever shows a manual action | — | — | — |
| ✗ | Buying links, PBNs, link exchanges | — | **Not recommended** | — | — | — |

## 7. Trust and credibility

| P | Task | Current situation | Required improvement | SEO impact | Effort | Files / pages |
|---|---|---|---|---|---|---|
| **P0-5** | **Owner fact sheet** ⚑ (unblocks P1) | Missing: licence no., legal name, DMC start year, volumes, clients, memberships, reviewable testimonials, photos | One document with these facts and permissions | Enabler | Low (owner) | — |
| P1 | Verify or remove the testimonials ⚑ | 4 anonymised quotes, shared by 8 pages | Attributable quotes or removal; never self-serving review schema | Medium (trust/policy risk) | Low | `partials/dmc-testimonials.blade.php` |
| P1 | Named B2B contact card ⚑ | None | Name, photo, role, languages, direct contacts | Medium | Low | form section |
| P1 | Founder/company line on the page | Founder only on /about | 2 sentences + link | Low–Medium | Low | `dmc-marrakech.blade.php` |
| P2 | Memberships & partners logo strip ⚑ | None | Real logos only (including the Visit Marrakech listing once live) | Medium | Low | new partial |
| P2 | Resolve "trade-only" vs direct-to-consumer messaging (O-9) ⚑ | Page says "we never compete with you"; the site sells B2C | Honest wording (e.g. a separate B2B desk with net rates and client confidentiality) | Low–Medium (trust) | Low | `dmc-marrakech.blade.php` |

## 8. Conversion optimisation

| P | Task | Current situation | Required improvement | SEO impact | Effort | Files / pages |
|---|---|---|---|---|---|---|
| P1 | Hero CTAs | Text only in the hero; CTA further down | 2 buttons in the hero (quote + WhatsApp B2B) | Indirect (engagement) | Low | `dmc-marrakech.blade.php` |
| P1 | Curated product cards | Latest 3 tours/activities (e.g. Agadir, Tangier) | Marrakech/MICE-relevant items via an optional curated list | Low (relevance) | Low | `partials/dmc-products.blade.php` (optional param; other 7 pages unchanged) |
| P2 | Downloadable B2B fact sheet ⚑ | None | PDF: services, process, terms, contacts | Low | Low | `public/` asset |
| P2 | Form tracking | `page_source=dmc-marrakech` exists | Confirm GA4 event for B2B form submissions | Measurement | Low | GA4 |

## Sequence

1. **This week:** P0-1 (deploy + cache clear), P0-2 (GSC), P0-3 (Visit Marrakech application), P0-4 (GBP), P0-5 (owner fact sheet), P0-6 (comment fix).
2. **Next:** P1 content/sections using the fact sheet (verified facts bar, case studies, contact card, testimonials, hero photo, service index, OG image, alternateName).
3. **Then:** P2 (French page, planner facts, section photos, internal links, directories).
4. **Ongoing:** P3.

## Measurement

| KPI | Tool | Baseline (2026-11-24) |
|---|---|---|
| Organic position, "dmc marrakech" (Google MA, desktop) | `scripts/serp-audit` focused re-check (3 runs; report the median) | **#15–18** |
| Map-pack presence for "dmc marrakech" | Same SERP capture (Places block) | Not present |
| Mention in the AI Overview | Same capture | Not mentioned |
| GSC impressions/clicks/position for queries containing "dmc" | GSC | Unknown (no access) |
| Visit Marrakech listing live | Manual | No |
| GBP reviews (count/rating) | GBP | ⚑ owner to report |
| Referring domains to /dmc-marrakech (non-spam) | Semrush (URL) | 0 |
| B2B form submissions from the page | Contact logs / GA4 | ⚑ owner to report |

---

## Status after Phase 3 (2026-11-25), implemented locally, not deployed

| Item | Status |
|---|---|
| P0-1 Deploy first-pass edits | Superseded by the full Phase 3 rebuild. **Awaiting approval + deploy** (report 23 §2) |
| P0-2 GSC access | **Open**: the service account still sees only another property |
| P0-3 Visit Marrakech listing | **Open**: checklist ready (report 20 §B); needs licence (F1) |
| P0-4 Google Business Profile | **Open**: checklist + review strategy ready (report 20 §A); needs access (F15) |
| P0-5 Owner fact sheet | **Open**: itemised in report 19 (F1–F15) |
| P0-6 Controller comment | **Done**: verified baseline (#15/#18/#15) in `DmcController.php` |
| P1 Verified facts bar | **Done** with published facts; licence/volumes slots wait for F1/F3/F4 |
| P1 Case studies | **Slot built** (renders when filled); illustrative sample formats shown meanwhile, clearly labelled |
| P1 Service index tiles | **Done** (8 tiles, linked to the guide + sister pages) |
| P1 Hero replacement | **Done** with an illustrative existing image; the original MQ photo (F6) is still recommended |
| P1 OG image | **Done** (1200×630 DMC card) |
| P1 B2B contact card | **Done** at company level; named person pending (F7) |
| P1 Testimonials | **Removed** from this page; review links added; still on the 7 other DMC pages (report 19) |
| P1 `alternateName` "Morocco Quest DMC" | **Done** (both layouts) |
| P1 Hero CTAs | **Done** (quote + WhatsApp) |
| P1 Curated products | **Done** (curated slugs with fallback) |
| P1 Consistent scale claims | **Done**: unverifiable numbers removed |
| P2 French page | **Done**: `/fr/dmc-marrakech` with hreflang and sitemap |
| P2 Planner facts | **Done**: 12 facts, 6 sources, drive-time diagram |
| P2 How to choose a DMC / How we work | **Done** |
| P2 Named venues | Partly: Palais des Congrès named as a destination venue; "venues we've worked with" waits for F11 |
| P2 Section photos | **Done** with existing illustrative images (report 22); originals pending |
| P2 Internal links | **Done**: home, about, contact, Marrakech destination page |
| P2 Rename the "destination management company (1).webp" image | **Done for this page** (not used); the old file remains for other pages |
| P2 Directories / partner links | **Open**: report 20 §C |
| P3 Gallery / video | Open (needs original media) |
| P3 World-map SVG | **Done for this page** (removed; HTML 362 → 171 KB) |
| P3 Performance backlog | Open: site-wide CSS/preloader architecture limits LCP (report 21 §4) |
