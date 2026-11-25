# 14 — Top 2 vs Morocco Quest: Three-Way Comparison

C1 = Visit Marrakech MICE DMC directory (#1). C2 = dmc-marrakech.com (#2). MQ = morocco-quest.com/dmc-marrakech (**live version**; the local, undeployed changes are noted where relevant). **[V]** verified, **[H]** hypothesis.

## 1. Corrected Morocco Quest ranking (important)

| Query (Google MA, en, desktop, non-personalised, 2026-11-24) | MQ position | Ranking URL | SERP title shown |
|---|---|---|---|
| dmc marrakech, run 1 (13:23 UTC) | **#15** (page 2) | /dmc-marrakech | Morocco DMC Marrakech \| MICE & Incentive Travel |
| dmc marrakech, run 2 (13:25 UTC) | **#18** (page 2) | /dmc-marrakech | same |
| dmc marrakech, run 3 (13:26 UTC) | **#15** (page 2) | /dmc-marrakech | same |
| dmc marrakech morocco | not in top 20 | — | — |
| marrakech destination management company | not in top 20 | — | — |

**Correction to report 01:** the earlier "not in top 94" (12:15 UTC) is **not reliable**. That scrape requested pages 2–10 separately, and Google served page 1 from the DMC result set but pages 2+ from a *different*, generic "Marrakech" result set (three out of four runs today served the DMC set). The three focused re-checks put MQ consistently on **page 2 (#15–#18)**. With the map pack and AI Overview above the organic results, page 2 on desktop *feels* like page 3 on many screens, which matches your original observation.
**Consequences:**
- There's **no evidence of a ranking drop** since August (#35). The position has improved since then, or was always variable.
- The causal story "the Aug 29 title change caused a drop" is **withdrawn**. Restoring "DMC Marrakech" as the title lead is still justified (it matches every ranking page), but not as a recovery fix.
- The controller comment written in the first pass (`DmcController.php`, uncommitted) repeats the "top ~94" claim and must be corrected during implementation (roadmap item P0-6).

## 2. The SERP is more than ten blue links [V]

In run 3, Google showed, **above the organic #1**:
1. **A map pack ("Places")** with 3 Google Business Profiles:
   - **"Dmc Marrakech"**: 5.0★ (4 reviews), Tour agency, Atlas Business Center, 72 Bd Abdelkrim Al Khattabi, Marrakech.
   - **"MOROCCO DMC - TRAVEL AGENCY Morocco MARRAKECH | EXCEL TRAVEL MOROCCO"**: 4.4★ (22), Tour agency.
   - **"Originally Morocco - DMC Marrakech incentive"**: 5.0★ (3), Travel agency, Centre d'Affaires Valencia, Bd Abdelkrim Al Khattabi.
2. **An AI Overview (in French)** that names exactly those three businesses, taken from their Business Profiles.

The same map pack also appeared for "marrakech destination management company".
**Implication:** Visibility for "DMC Marrakech" in Morocco is a three-surface contest: **map pack + AI Overview + organic**. The map pack leaders have only **3–22 reviews**, so the bar is low. Morocco Quest has a Marrakech (Gueliz) office and a Google profile reportedly named "Morocco Quest DMC" (owner item O-13), but **it doesn't appear in the pack**. This is the **fastest realistic route to the top of the page**.

## 3. Head-to-head table

| Factor | C1 Visit Marrakech (#1) | C2 dmc-marrakech.com (#2) | Morocco Quest (#15–18) | Verdict / why it matters |
|---|---|---|---|---|
| Page type | Official directory of 49 DMCs | Single-page DMC site (EMD) | Inner B2B page on a B2C-led site | Google rewards *directory* and *exact-entity* pages for this query |
| Domain age (first archive) | 2019 | **2016** | **2025-03** | MQ is the youngest; can't be changed, only compensated |
| Domain-level authority (Semrush AS / RDs) | **47 / 5,349** (root) | 6 / 2,324 (94% spam) | 2 / 2,103 (94.5% spam) | Only C1 has real authority |
| Real referring sites in top 20 | Travel and Marrakech sites, official bodies | None (spam only) | 2 real (AS 46, AS 20 travel blogs) | MQ beats C2 on real links |
| Links to the ranking URL | Whole-site authority + 49 listed DMCs | Homepage = whole domain | **0 external** to /dmc-marrakech | The biggest MQ gap among link factors |
| Title | "Les agences réceptives (DMC) \| MICE in Marrakech" | "Home" (rewritten by Google) | "Morocco DMC Marrakech \| MICE…" (local fix: "DMC Marrakech \| Morocco DMC & MICE \| Morocco Quest") | Deploy the fix |
| H1 | "Les agences réceptives (DMC)" | "DMC Marrakech" | live: "Morocco DMC & DMC Marrakech – …" (local fix: "DMC Marrakech: Destination Management Company…") | Deploy the fix |
| Meta description | Long FR | **None** | Present | MQ ahead |
| Content depth (main words) | ~960 | 757 | **~3,990** | MQ ahead. Depth is not the gap |
| Search intent | "Find DMCs in Marrakech" (list) | "A DMC named DMC Marrakech" | "Hire this DMC" (B2B, detailed) | MQ fits the hire intent; the list intent can only be met by getting listed |
| Services coverage | None | 27 services as a list | ~30 services in depth (MICE, incentives, team building ×12, transfers, hotels, dining, nationwide) | MQ ahead; add product launches, seminars, themed dinners if offered |
| Marrakech-specific info | Generic | Souks, Djemaa, Koutoubia, hammam, planner facts | Medina, Jemaa, Koutoubia, Agafay, Palmeraie, Hivernage, RAK airport, seasons | MQ ahead; add a compact facts block |
| MICE expertise shown | Implicit (official MICE site) | List only | Detailed, with 3 example programmes | MQ ahead in text, **behind in proof** |
| Original photography | 1 real B2B event photo | Generic destination photos | Generic hero (auditorium seats) + destination photos; **no real MQ event photo** | Nobody wins here; an opportunity for MQ |
| Conversion | None | Email + named contact | Form, phone, WhatsApp, email, 24h quote | MQ ahead |
| Testimonials | None | "4.9/5 (11 votes)" self-hosted | 4 anonymised quotes (unverified) | Make MQ's verifiable |
| Company credibility | Official CRT, institutional logos | Address (Casablanca), named person | Licence claim without number, "20+ groups/yr", Marrakech address in footer only, founder not named on this page | **MQ's weakest area** |
| Experience signals | — | "experienced DMC", 2 departments | Generic "licensed", examples | Add real years, volumes and case studies |
| Internal linking to the page | Hub of its site | n/a (single page) | Nav ×3, 7 DMC pages, 1 blog post, homepage (local only) | Good; deploy the homepage link |
| Breadcrumb | Yes | No | Yes | — |
| Schema | Breadcrumb, WebPage, Org | Org named "Destination Management Company Marrakech", Article | TravelAgency (geo, address), Service (enriched locally), FAQPage, Breadcrumb | MQ ahead. Note: FAQ rich results are limited to gov/health sites since 2023, so FAQPage helps understanding, not SERP display |
| Open Graph | Yes (SVG logo image) | None | Yes (generic Aït Benhaddou image) | Use a DMC-specific OG image |
| hreflang / languages | **FR + EN** | EN | EN only | FR demand: "dmc marrakech" 20/mo FR, "séminaire marrakech" 210/mo FR |
| Lab mobile perf (identical throttling: 150 ms RTT, 1.6 Mbps, 4× CPU) | LCP 27.8 s, 5.5 MB | LCP 8.5 s, CLS **0.112** | **LCP 5.1 s**, CLS 0.008, 2.0 MB, 1,975 DOM nodes | MQ is fastest of the three. Performance is not the gap |
| TTFB (lab) | 0.20 s | 1.09 s | 0.61 s | — |
| Map pack presence | — | (via the "Dmc Marrakech" GBP? not verified as the same business) | **Not present** | **Biggest visibility gap** |
| Directory presence on C1 | — | Not listed | **Not listed** | High-value fix |

## 4. Weaknesses and how to address them

| # | MQ weakness | Why it matters | How to address |
|---|---|---|---|
| W1 | **Absent from the map pack and AI Overview** | They sit above organic #1, with weak incumbents (3–22 reviews) | Optimise the GBP "Morocco Quest DMC": primary category, Marrakech address, services (DMC, MICE, incentives), photos, and genuine B2B reviews requested from real clients (P0) |
| W2 | **Not listed in the official Marrakech DMC directory** (the #1 result) | Missing from the page most searchers click, and missing its AS 47 link | Apply via CRT Marrakech-Safi (P0) |
| W3 | **No verifiable proof** (licence no., years of DMC activity, named clients, case studies, attributable reviews) | Both the market and Google's quality guidelines reward demonstrable experience; MQ's claims are generic | Owner supplies facts; build a trust block + 2–3 case studies (P1) |
| W4 | **Young domain, B2C-led topical identity, zero links to /dmc-marrakech** | C2's exact-match domain and topical purity beat MQ's inner page | Concentrate signals on the page: listings + partner links pointing to /dmc-marrakech, consistent "Morocco Quest DMC" naming, the homepage link (P0–P2) |
| W5 | **No original event photography; generic hero** | Doesn't prove experience; the hero filename/content mismatch weakens image relevance | Commission or collect real programme photos (P1–P2) |
| W6 | **English only** | The #1 page is French; FR demand exists; 21 of 44 benchmarked competitors are multilingual | French version of the DMC page with hreflang (P2) |
| W7 | Live title/H1 still keyword-stacked | Deploying the local fix aligns with the ranking pattern | Deploy (P0) |

## 5. What Morocco Quest already does better than both

Content depth and B2B usefulness, service coverage, conversion paths, schema, image SEO, speed, and real (non-spam) top links. **The page doesn't need to be rebuilt; it needs proof, presence (GBP and directory) and focus.**
