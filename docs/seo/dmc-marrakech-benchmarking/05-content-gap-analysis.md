# 05 — Content Gap Analysis

## What Google rewards for "DMC Marrakech"

The searcher is a **B2B buyer**: a travel agency, tour operator, incentive house or corporate planner looking for a **local operating partner in Marrakech**. Google answers with:

1. **DMC company homepages** (7 of the top 8 in Morocco). The dominant page type is "the company itself".
2. **DMC directories/networks** (Visit Marrakech MICE list, Global DMC Partners).
3. Platform listings (TripAdvisor, Facebook) in the US index.

Intent mix, from the ranking pages: **destination management company (core) + MICE/incentive specialist (secondary) + ground handler for the trade (tertiary)**. Leisure "tours" pages don't rank for this query.

## How Morocco Quest compares on topics

| Topic Google associates with the query | Top competitors | Morocco Quest /dmc-marrakech | Gap? |
|---|---|---|---|
| "DMC Marrakech" stated as identity (H1/title) | all dedicated pages | now yes (was "Morocco DMC & DMC Marrakech") | **Fixed in this pass** |
| Destination management services | yes | yes (guide accordion, 7 subsections) | no |
| MICE / conferences / gala dinners | yes | yes, detailed with examples | no |
| Incentive travel | yes | yes | no |
| Team building | some | yes (12 formats) | no |
| Ground handling / transfers / fleet | partial | yes | no |
| Hotel and riad contracting, net rates | rare | yes | no (Morocco Quest is ahead) |
| B2B process (brief → quote → contract → ops) | rare | yes (7-step process) | no (ahead) |
| Nationwide coverage | yes | yes | no |
| FAQs | 3 of 8 | 15 Q&A | no (ahead) |
| **Sample programmes / case studies with real outcomes** | your-morocco-dmc ("Sample Marrakech incentive programs"), dmcmarrakech ("case study") | 3 illustrative "Example:" programmes with no client, date or result | **YES — HIGH** |
| **Named clients / partner logos** | your-morocco-dmc ("They trusted us"), originallymorocco (30+ logos) | none | **YES — HIGH** (needs owner facts) |
| **Track record ("since 19xx", "20+ years")** | visitmoroccodmc (1994), originallymorocco (20+ yrs), bodyandsoul (1992) | not stated on this page; About page says founded 2022 | **YES — cannot be invented**; lead with operating facts instead |
| **Verifiable licence / memberships** | some show licence numbers | "Licensed & insured" ×12 with **no licence number** | **YES — HIGH** (owner item O-9) |
| **Verifiable reviews** | GBP 5.0★, TripAdvisor | 4 anonymised testimonials ("Sophie M.") with no source link | **YES — MEDIUM/HIGH** |
| Venue-level specifics (Palais des Congrès, named hotels) | some | generic ("a 3,500-seat congress centre") | MEDIUM |
| French-language version ("agence réceptive Marrakech") | nolimits (es/fr), astrolabe (fr), excel-travel (fr) | English only | MEDIUM (strategic) |

## Missing entities

- **Palais des Congrès de Marrakech** (the 3,500-seat centre the page alludes to but doesn't name). Naming it helps entity matching. Only add it with the true capacity and only if Morocco Quest really operates there.
- **Marrakech Menara Airport (RAK)**: already present.
- **Visit Marrakech / CRT Marrakech, ONMT**: no mention. Relevant only if there's a real membership.
- **Hivernage, Palmeraie, Agafay, Medina**: present.

## Missing B2B information (needs owner facts; not invented)

1. Licence number (ODV / Ministry of Tourism) and the company's legal name.
2. Year the DMC activity started, plus a verifiable volume: groups or pax handled in 2025 and 2026.
3. Two or three **real case studies**: client type (anonymised if under NDA), pax, dates, services delivered, one outcome.
4. Client and partner logos that Morocco Quest has written permission to show.
5. Memberships (SITE, MPI, ICCA, a national tour-operator association) if any.
6. Testimonials that can be **attributed and verified** (full name + company, or a link to the TripAdvisor/Google review).
7. A downloadable B2B fact sheet or rate-request PDF, if it exists.

## Weak or problematic content on the current page

| Issue | Evidence | Risk | Priority |
|---|---|---|---|
| Testimonials can't be verified | `partials/dmc-testimonials.blade.php`: first-name + initial only, no source | If they aren't real client statements, they're a liability under Google's spam/reviews policies and consumer-protection rules. If they are real, they're under-used. | HIGH (owner must confirm) |
| Claims without proof | "IATA compatible", "Moroccan Ministry of Tourism licensed", "400+ delegates" | Unverifiable claims are weak E-E-A-T signals. A licence number turns a claim into proof. | HIGH (owner) |
| Inconsistent scale signals | trust bar "20+ groups handled / year" vs FAQ "400+ delegates", "groups of 500+" | A careful buyer notices the mismatch | MEDIUM |
| Most of the long-form copy sits in collapsed accordions | `partials/dmc-guide.blade.php` | Google indexes it, but the visible first screen carries less of the topic | LOW (keep; design choice) |
| Product cards show the latest 3 tours/activities (e.g. "Agadir Half-Day City Tour") | `partials/dmc-products.blade.php` uses `latest()->take(3)` | Off-topic B2C cards dilute a B2B DMC page | LOW |

## Supporting content (topical authority)

The site already has 8 DMC pages that each own a sub-intent (see `docs/seo-fix/KEYWORD_MAP.md`). There's no need for a new landing page; another "DMC Marrakech" page would cannibalise. Content worth adding as **blog posts that link to /dmc-marrakech** (one link each, varied anchors):

- "How to choose a DMC in Marrakech: 10 questions to ask" (buyer guide; links with the anchor "DMC in Marrakech")
- "Palais des Congrès de Marrakech: a planner's logistics guide" (only if operated there)
- A real case study: "Delivering a [N]-pax incentive in Marrakech & Agafay"
- French: "Agence réceptive à Marrakech : ce que fait un DMC" (only if a French section is planned with hreflang; otherwise skip)
