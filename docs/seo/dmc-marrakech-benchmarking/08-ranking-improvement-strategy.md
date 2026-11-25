# 08 — Ranking Improvement Strategy: "DMC Marrakech"

No one can guarantee position #1. This plan ranks actions by the evidence in reports 01–07 and gives no timeframes.

## Diagnosis in one paragraph

Google Morocco shows only about 8 pages it considers truly relevant to "dmc marrakech". Almost all are **homepages of DMC-only companies**, often with DMC in the domain, plus the **tourism board's DMC directory**. Morocco Quest's page is the most complete and technically clean page in the set, but it's an **inner page with no external links, on a domain Google reads as a private-tours company**. Between Aug 26 and Nov 24 it fell from #35 to outside the top ~94. In the same window the title and H1 were rewritten to lead with "Morocco DMC" and push "DMC Marrakech" to the end. That timing is a correlation, not proof, but it is the clearest controllable change. **The gap is relevance and trust signals for this exact entity, not word count and not raw link volume.**

## Stage A — Quick wins (implemented in this pass, local only, not deployed)

| Action | Why | Files | Expected benefit | Difficulty | Measure |
|---|---|---|---|---|---|
| A1. Title: `DMC Marrakech \| Morocco DMC & MICE \| Morocco Quest` | Every ranking dedicated page leads with the exact phrase. Reverses the Aug 29 demotion. Brand restored for entity match with "Morocco Quest DMC" profiles | `app/Http/Controllers/DmcController.php` | Restores primary-keyword prominence; brand CTR | Low | GSC position/impressions for "dmc marrakech" and the page's SERP title |
| A2. Meta description leads with "DMC Marrakech", states audience + 24h quote | Bolding and CTR; the old description led with "Morocco DMC" | same | CTR | Low | GSC CTR |
| A3. H1: `DMC Marrakech: Destination Management Company for Travel Agents & MICE Planners` | Removes the keyword-stacked "Morocco DMC & DMC Marrakech"; adds "destination management company" naturally | `resources/views/dmc-marrakech.blade.php` | Clearer primary topic; better phrasing | Low | Rank tracking |
| A4. Service schema: `alternateName` (Marrakech DMC / Morocco DMC / Destination Management Company Marrakech), `audience` BusinessAudience, `hasOfferCatalog` with the 6 service lines visible on the page | Makes the B2B entity explicit in structured data | same | Entity understanding (not a ranking guarantee) | Low | Rich Results Test / Schema validator |
| A5. One contextual homepage link: "…a white-label **DMC in Marrakech**…" | The homepage holds most of the domain's equity and had no body link to the DMC page (nav only) | `resources/views/home.blade.php` | Internal authority flow and anchor relevance | Low | Next crawl; GSC Links report |

## Stage B — Competitive improvements (need owner input; not implemented)

| # | Action | Why | Files | Benefit | Difficulty | Dependency |
|---|---|---|---|---|---|---|
| B1 | **Trust block with verifiable facts**: licence number, legal name, year DMC operations began, groups/pax in 2025–26, memberships | Every winner shows track record. "Licensed & insured" appears 12× with no proof | `dmc-marrakech.blade.php` + `hasCredential`/`memberOf` in schema | High (E-E-A-T, conversion) | Low once facts exist | **Owner facts (O-9)** |
| B2 | **2–3 real case studies** (anonymised OK): pax, dates, services, one outcome. Replace the 3 illustrative "Example:" blocks | Competitors' "sample programmes"/"they trusted us" are their strongest proof | `partials/dmc-guide.blade.php` | High | Medium | Owner data |
| B3 | **Testimonials**: confirm each is a real client statement. Make attributable (full name + company, or link the TripAdvisor/Google review) or remove | Unverifiable testimonials are a policy and trust risk | `partials/dmc-testimonials.blade.php` (shared by 8 pages) | Medium–High | Low | **Owner confirmation** |
| B4 | **Client/partner logos** with permission | Matches your-morocco-dmc / originallymorocco | new partial | Medium | Low | Permissions |
| B5 | Reconcile scale claims (20+ groups/yr vs 400+ delegates vs groups of 500+) | Consistency for buyers | `dmc-marrakech.blade.php` | Low–Medium | Low | Owner facts |
| B6 | Name real venues and suppliers (e.g. Palais des Congrès de Marrakech) **only where operated** | Entity matching | `partials/dmc-guide.blade.php` | Medium | Low | Owner facts |
| B7 | Curate DMC product cards (Marrakech/Agafay/incentive-relevant) instead of `latest()->take(3)` | Remove off-topic B2C cards (Agadir half-day tour) from a B2B page | `partials/dmc-products.blade.php` (optional param, default unchanged for other pages) | Low | Low | none |
| B8 | Schema `alternateName` "Morocco Quest DMC" sitewide | Matches TripAdvisor/Instagram/GBP naming | `layouts/app2.blade.php`, `layouts/app.blade.php` | Low–Medium | Low | **Owner decision O-13** |
| B9 | Supporting blog posts linking to `/dmc-marrakech` with varied anchors (buyer guide, case study) | Topical depth and internal links | Blog (DB content via admin) | Medium | Medium | Content time |
| B10 | French version (hreflang) targeting "agence réceptive / DMC Marrakech" | French-language results are a different set; several winners are bilingual | New route + hreflang | Medium | High | Strategy decision |

**Rejected on purpose:** a new "DMC Marrakech" landing page or subdomain (cannibalisation and thin duplication); changing the URL (no evidence the URL is the problem; a migration would reset signals); adding more words (already the longest page).

## Stage C — Authority building (off-site)

| # | Action | Why | Benefit | Difficulty | Measure |
|---|---|---|---|---|---|
| C1 | Get listed on **mice.visitmarrakech.com** DMC directory | #1 result for the query; official .ma citation | High | Medium | Listing live; referral sessions |
| C2 | Optimise **Google Business Profile** "Morocco Quest DMC": category, services (DMC, MICE, incentives), photos, B2B reviews | A Local Pack appears for this query intermittently | High for local visibility | Low | GBP Insights: searches for "dmc marrakech" |
| C3 | Free/vetted DMC listings: Cvent Supplier Network, dmcfinder, 1dmcworld, dmcnetwork; apply to Global DMC Partners / Euromic if eligible | These pages rank for the query and pass topical relevance | Medium | Low–High | Referring domains to `/dmc-marrakech` |
| C4 | Ask existing partner agencies to cite Morocco Quest as their Morocco ground partner, linking to `/dmc-marrakech` | The most relevant B2B links available | Medium–High | Low | Semrush/GSC links |
| C5 | Trade-press story backed by a real case study (TravelDailyNews, Travel Courier, eGlobal Travel Media) | Editorial authority | Medium | Medium | Mentions + links |
| C6 | Collect TripAdvisor reviews from B2B clients on "Morocco Quest Dmc" | TripAdvisor DMC listings rank in this SERP | Medium | Low | Review count |

**Not recommended:** buying links, link exchanges, mass directory submissions, or renaming the GBP to include keywords.

## Prioritised roadmap

1. **Deploy Stage A** (then run `php artisan cache:clear`; edge cache ≤ 2 h). Request indexing of `/dmc-marrakech` and `/` in GSC.
2. **Get GSC access** for morocco-quest.com (blocking issue for measurement).
3. **C1 + C2 + C6** (citations the searcher actually sees).
4. **B1 + B3** as soon as the owner supplies facts. **B2** next.
5. **C3 + C4**, then **B9**, then optionally **B10**.

## How to measure progress

| Metric | Tool | Cadence | Baseline |
|---|---|---|---|
| Position for "dmc marrakech" in Google Morocco (desktop) | `python scripts/serp-audit/serp_scrape.py` (gl=ma) | every 2 weeks | not in top 94 (2026-11-24) |
| Impressions/clicks/avg position, query contains "dmc" | GSC (once access is granted) | weekly | unknown |
| Google-selected canonical + index status | GSC URL Inspection | after deploy | unknown |
| Semrush US positions: dmc marrakech / morocco dmc / dmc morocco | Semrush Position Tracking (campaign created 2026-08-12) | weekly | not in top 30 / #20 (tag page) / #43 |
| Referring domains to `/dmc-marrakech` | Semrush `backlinks_overview` (url) | monthly | 0 |
| B2B enquiries from the page (`page_source=dmc-marrakech`) | Contact form logs / GA4 | monthly | owner to supply |

## Update after the 50-site benchmark (see 11)
- **C1–C4 (quality citations) move up**: Morocco Quest's Authority Score (2) is in the bottom 12% of 50 operators, while its referring-domain count is average.
- **B10 (French version) moves from optional to recommended**: 21 of 44 competitors run multi-language sites, and French searches return a different set of winners.
- **B1 (track record) is confirmed as the market norm**: 24 of 44 operators state years in business.
- **Opportunity:** micemorocco.com (503) and boardingpassdmc.ma (account suspended) are broken but still ranking, so those positions will open up.
