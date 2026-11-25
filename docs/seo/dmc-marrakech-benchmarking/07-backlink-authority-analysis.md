# 07 — Backlink & Authority Analysis

All figures are **Semrush Backlink Analytics, root-domain scope, pulled 2026-11-24**. They are third-party index estimates, not Google's link graph. Nothing here was taken from memory or estimated by hand.

## Domain comparison

| Domain | Authority Score | Backlinks | Referring domains | Follow | Nofollow |
|---|---|---|---|---|---|
| **[morocco-quest.com](https://morocco-quest.com/)** | **2** | 2,205 | 2,103 | 2,125 | 80 |
| [dmc-marrakech.com](https://dmc-marrakech.com/) (#2 MA) | 6 | 2,760 | 2,324 | 2,627 | 133 |
| [dmcmarrakech.com](https://dmcmarrakech.com/) (#8 MA) | 7 | 2,767 | 2,305 | 2,659 | 108 |
| [attendance.ma](https://www.attendance.ma/) (#3 MA) | 4 | 38,167 | 1,111 | 37,606 | 529 |
| [your-morocco-dmc.com](https://your-morocco-dmc.com/) (#4 MA) | 6 | 2,293 | 2,140 | 2,178 | 115 |
| [originallymorocco.com](https://www.originallymorocco.com/) | 7 | 7,682 | 2,196 | 7,563 | 119 |
| [visitmoroccodmc.com](https://visitmoroccodmc.com/) | 9 | 4,934 | 2,540 | 4,358 | 576 |

### Referring-domain quality (Authority Score distribution)

| AS band | morocco-quest.com | dmc-marrakech.com |
|---|---|---|
| 0 | 336 | 357 |
| 1 | 2 | 2 |
| 2 | 1,650 | 1,826 |
| 3–6 | 108 | 132 |
| 7–14 | 5 | 8 |
| 20 | 1 | — |
| 46 | 1 | — |
| **Share at AS 0–2** | **94.5%** | **94.0%** |

**Reading:** the two profiles are nearly identical in shape. Both are dominated by about 2,000 very-low-authority domains, a pattern typical of auto-generated directory or scraper links, which Google largely ignores. The **raw referring-domain gap is small** (2,103 vs. 2,140–2,540), and Morocco Quest even has the single strongest link in the comparison (one AS 46 domain).

So **"buy or build more links" is not the main lever.** What differs:

| Factor | Competitors | Morocco Quest |
|---|---|---|
| Where the equity lands | Homepage = ranking URL, so all domain equity supports "DMC Marrakech" | Equity lands on a B2C homepage; `/dmc-marrakech` has **no external backlinks** (Semrush: no data for the URL) |
| Topical relevance of the domain | Whole site is DMC/MICE | Site is mainly private tours; DMC is a section |
| Brand/entity strength for "DMC" | Brand names contain DMC; GBPs named "… DMC Marrakech" | TripAdvisor and Instagram use "Morocco Quest DMC", but schema `alternateName` is "Morocco Quest Tours & Travel" (owner item O-13) |
| Relevant citations | Tourism board DMC list, DMC networks, TripAdvisor | TripAdvisor listing exists (d33367694); no DMC-directory citations found |

Anchor text was not pulled (40 units per row). Given that the dominant links are low-quality, a row-by-row anchor audit wasn't worth the units for this decision. It can be done later for `/dmc-marrakech` once that URL has links.

## Link and citation opportunities, ranked by relevance to this SERP

Each is a **genuine business listing or editorial mention**. No paid links, PBNs or link exchanges.

| # | Opportunity | Why it matters for this keyword | Requirement | Effort |
|---|---|---|---|---|
| 1 | **Visit Marrakech MICE "Les agences réceptives (DMC)"** directory ([mice.visitmarrakech.com](https://mice.visitmarrakech.com/se-reunir/les-agences-receptives-dmc/)) | It's the **#1 result** for "dmc marrakech" in Morocco. A listing puts the brand on the top result and earns an official .ma link | Licensed agency; contact the CRT Marrakech / convention bureau | Medium |
| 2 | **Google Business Profile** (the brand already uses "Morocco Quest DMC") | Local Pack appeared for this query on 2026-08-26 (GBPs named "Dmc Marrakech", Originally Morocco, Excel Travel) | Accurate category (Tour agency / Travel agency), DMC services listed, real reviews from B2B clients, website link. **Don't stuff keywords into the business name** (against GBP guidelines) | Low |
| 3 | **[TripAdvisor listing "Morocco Quest Dmc"](https://www.tripadvisor.com/Attraction_Review-g293734-d33367694-Reviews-Morocco_Quest_Dmc-Marrakech_Marrakech_Safi.html)** | TripAdvisor DMC listings rank #6 and #17 (US) | Collect reviews from real clients; link to /dmc-marrakech from the listing if allowed | Low |
| 4 | **[Cvent Supplier Network](https://www.cvent.com/venues/)** (DMC category, Marrakech) | Cvent DMC pages appeared repeatedly in web results for "destination management company Marrakech" | Free supplier profile | Low |
| 5 | **DMC networks / finders**: [dmcnetwork.com](https://www.dmcnetwork.com/), [1dmcworld.com](https://www.1dmcworld.com/africa/country/dmc-morocco-marrakesh/), [dmcfinder.com](https://dmcfinder.com/), [globaldmcpartners.com](https://www.globaldmcpartners.com/), [euromic.com](https://www.euromic.com/our-destinations/africa/morocco/) | All rank for "dmc marrakech" or "morocco dmc" | Vetting or membership fees; Global DMC Partners and Euromic are selective | Medium–High |
| 6 | **ONMT / Visit Morocco** professional listings; IMEX/ITB exhibitor lists via the ONMT stand | Official, topically perfect | Trade-show participation | High |
| 7 | **Trade press**: [TravelDailyNews](https://www.traveldailynews.com/), [Travel Courier](https://www.travelcourier.ca/), [eGlobal Travel Media](https://eglobaltravelmedia.com.au/) (all appeared in results for Morocco DMC news) | Editorial mention + relevant link | A real news hook (new programme, case study, award) | Medium |
| 8 | **Client/partner agencies** that already buy from Morocco Quest | "Our Morocco partner" links from real customers are the most relevant B2B links possible | Ask existing partners | Low |

## Data limitations
- Semrush's index differs from Google's, and AS is a Semrush metric, not a Google one.
- Morocco Quest's own client report (Aug 2026) quoted a different tool's figures (DR 6, 413 RDs). Tools measure differently, so don't mix the two series.
- Anchor-text and per-link quality checks were not run, to conserve API units.

## Update: 50-site benchmark (see 11)
Across 50 Morocco DMC operators, the **median Semrush Authority Score is 9** and Morocco Quest's **2 is in the bottom 12%** (only 6 of 49 are at AS ≤ 2). Its referring-domain count (2,103) is close to the median (2,302). So the gap is **link quality, not link quantity**. The relevant citations listed above matter more than the 7-site comparison suggested.
