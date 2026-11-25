# 11 — Morocco DMC Landscape: 50-Site Benchmark (global view)

**Data file:** [03-morocco-50-site-benchmark.csv](03-morocco-50-site-benchmark.csv) (51 rows, 34 columns; Morocco Quest is the reference row). The earlier 7-site detailed comparison is kept as [03a-competitor-comparison-top7-detailed.csv](03a-competitor-comparison-top7-detailed.csv).

## How the 50 were chosen (no hand-picking)

1. **8 real Google Morocco searches** (gl=ma, desktop, non-personalised, project scraper `scripts/serp-audit`), 2026-11-24, plus the 2026-08-26 run:
   `dmc marrakech` (EN, FR, Aug) · `morocco dmc` · `dmc morocco` · `destination management company morocco` · `agence réceptive maroc dmc` · `mice agency marrakech`.
2. Every result was pooled and given a **visibility score** = Σ 1/position across the searches. A site ranking #1 in one search scores 1.0; #10 in two searches scores 0.2.
3. **Removed:** directories and networks (Visit Marrakech MICE, Global DMC Partners, DMC Network, Euromic, Evintra…), media, hotels and riads, social platforms, non-Morocco "DMC" brands (Crestron, D-Link, Wacker, DMC embroidery thread…), Local Morocco Tours (out of scope), and duplicate domains of the same company (Suenos Travel, S'Tours).
4. The **top 50 Morocco DMC / MICE / inbound operators** by visibility were kept.

**Measured per site:** HTTP status, TTFB, title, meta description, H1, word count, schema types, FAQ, image alt %, canonical, robots, hreflang languages, "DMC" in domain, MICE and B2B term counts, testimonial mentions, stated track record ("since 1994"), licence mention, phone/WhatsApp/form, and **Semrush Authority Score, referring domains and backlinks** (Semrush, 2026-11-24).
12 sites block simple fetches or need JavaScript. Those were re-read in headless Chrome. 6 returned too little content to measure on-page (site down, account suspended, bot wall, or a near-empty page), and the CSV notes each one.

## The landscape in numbers

| Metric | 50 competitors (median) | Range | Morocco Quest | Where MQ stands |
|---|---|---|---|---|
| Semrush Authority Score | **9** | 2 – 36 | **2** | Bottom group: only 6 of 49 are at AS ≤ 2 |
| Referring domains | 2,302 | 146 – 5,569 | 2,103 | Middle (15 of 49 have fewer) |
| Main-content words | 1,002 | 146 – 5,042 | 3,713 | **5th of 45** (top 11%) |
| Title length (chars) | 55 | 0 – 150 | 47 → 50 after the fix | OK |
| TTFB (s, single fetch from Morocco) | 1.08 | 0.24 – 7.92 | 0.87 | Better than median |
| Image alt coverage | 88% | 0 – 100% | 100% | Top |
| Has FAQ | 11 of 44 | | yes | Ahead |
| Has any schema | 31 of 44 | | yes (5 types) | Ahead |
| Phone link / WhatsApp / form | 32 / 15 / 27 of 44 | | all three | Ahead |
| **States a track record** ("since 19xx", "20 years") | **24 of 44** | 1993 → 2019 | **no** | **Gap** |
| **Multi-language (hreflang)** | **21 of 44** | mostly EN+FR | English only | **Gap** |
| "DMC" in domain name | 10 of 50 (4 of the top 10) | | no | Structural (not fixable) |
| .ma domain | 9 of 50 | | .com | Neutral |

## What the global view changes

1. **Authority quality *is* a real gap.** The 7-site view suggested the backlink profiles were similar. Across 50 sites, Morocco Quest's **referring-domain count is average (2,103 vs. 2,302 median), but its Authority Score of 2 is in the bottom 12%** (median 9). The links Morocco Quest has are lower quality than the market's, so better links matter more than more links. The citation plan in `07` (Visit Marrakech MICE, GBP, DMC networks, partner agencies, trade press) moves up in priority.
2. **Content length is confirmed not to matter.** The 10 most visible operators have 14–4,565 words (median under 900). Morocco Quest is already 5th of 45.
3. **Track record is the market norm.** Half the market leads with years in business (Midfar and dmcmorocco "since 1993", Visit Morocco "since 1994", Activ Travel and Atlas Outdoor 1996, Monarch 1997). Morocco Quest says nothing. State the real start year of DMC operations and real volumes (owner facts, O-9).
4. **French matters.** 21 of 44 competitors run hreflang multi-language sites (mostly EN+FR), and the French search "agence réceptive maroc dmc" returns a different set of winners. The French version (strategy item B10) moves from "optional" to "recommended".
5. **The top of the market is fragile.** Two of the top-10 visible sites are broken today: **micemorocco.com returns 503** and **boardingpassdmc.ma shows "Account Suspended"** (it still ranks #6 for "dmc marrakech"). Google will drop them, and those positions will open up. A solid, well-cited page is positioned to take them.
6. **Morocco Quest is technically ahead of most of the market**: schema, FAQ, alt text, canonical, contact paths and speed are all better than the median. The remaining gaps are **trust (track record, verifiable proof), authority quality, and French**, not on-page SEO.

## Most dangerous competitors (high visibility + high authority)

| Website | Why |
|---|---|
| [journeybeyondtravel.com](https://www.journeybeyondtravel.com/morocco/destination-management-company) | AS 36 (highest), 3,385 referring domains, ranks on "dmc morocco" with a dedicated DMC page on a strong tours domain. It's the same model as Morocco Quest, done with more authority. |
| [visitmoroccodmc.com](https://visitmoroccodmc.com) | #1 "dmc morocco", "since 1994", AS 9, only 447 words. Wins on brand and age. |
| [your-morocco-dmc.com](https://your-morocco-dmc.com) | #1 "morocco dmc", #4 "dmc marrakech", client logos and sample programmes. |
| [attendance.ma](https://www.attendance.ma) | #1 "dmc marrakech" (Aug), #3 now, .ma, Marrakech MICE focus. |
| [nolimits.ma](https://www.nolimits.ma) | #5 across 4 searches, 4,565-word bilingual site. |
| [monarchtravel.com](https://www.monarchtravel.com) / [activ-travel.net](https://activ-travel.net) | AS 13–14, "since 1997" / "founded in 1996", rank on 3 searches each. |

## All 50 sites (with links)

Ranked by visibility across the 8 Google Morocco searches. "AS" is Semrush Authority Score; "n/m" means not measurable on-page.

| # | Website | Best Google MA position | Semrush AS | Ref. domains | Words | Track record | Note |
|---|---|---|---|---|---|---|---|
| ref | [morocco-quest.com](https://morocco-quest.com/dmc-marrakech) | #35 (dmc marrakech (Aug)) | 2 | 2103 | 3713 | — | OUR PAGE (live, before this session's changes are deployed) |
| 1 | [visitmoroccodmc.com](https://visitmoroccodmc.com) | #1 (dmc morocco) | 9 | 2540 | 447 | since 1994 |  |
| 2 | [your-morocco-dmc.com](https://your-morocco-dmc.com) | #1 (morocco dmc) | 6 | 2140 | 1233 | — |  |
| 3 | [attendance.ma](https://www.attendance.ma) | #1 (dmc marrakech (Aug)) | 4 | 1111 | 861 | since 2019 |  |
| 4 | [nolimits.ma](https://www.nolimits.ma) | #3 (agence receptive maroc dmc) | 9 | 247 | 4565 | — |  |
| 5 | [micemorocco.com](https://micemorocco.com) | #1 (mice agency marrakech) | 8 | 2381 | 22 | — | Site DOWN (HTTP 503) on 2026-11-24 although it ranks |
| 6 | [dmc-marrakech.com](https://dmc-marrakech.com) | #2 (dmc marrakech (Nov)) | 6 | 2324 | 761 | — |  |
| 7 | [boardingpassdmc.ma](https://boardingpassdmc.ma) | #4 (destination mgmt co morocco) | 13 | 148 | 14 | — | Site shows 'Account Suspended' although it ranks #6 for dmc marrakech |
| 8 | [journeybeyondtravel.com](https://www.journeybeyondtravel.com) | #3 (destination mgmt co morocco) | 36 | 3385 | 457 | 20 years |  |
| 9 | [travelconsultinggroup.net](https://travelconsultinggroup.net) | #3 (dmc morocco) | 2 | 275 | 433 | — |  |
| 10 | [monarchtravel.com](https://monarchtravel.com) | #5 (morocco dmc) | 14 | 2162 | 948 | since 1997 |  |
| 11 | [happytravel.ma](https://www.happytravel.ma) | #2 (agence receptive maroc dmc) | 7 | 211 | 793 | depuis 2000 |  |
| 12 | [morocco-discovery.com](https://www.morocco-discovery.com) | #3 (morocco dmc) | 6 | 5496 | 4048 | — |  |
| 13 | [amazingmorocco.com](https://www.amazingmorocco.com) | #7 (dmc marrakech (Aug)) | 16 | 1793 | 146 | — |  |
| 14 | [dmcmarrakech.com](https://dmcmarrakech.com) | #4 (dmc marrakech (Aug)) | 7 | 2305 | 1566 | 15+ years | Unstable (connection reset); on-page from copy fetched 2026-11-24 ~12:10 UTC |
| 15 | [exploremoroccodmc.com](https://exploremoroccodmc.com) | #4 (morocco dmc) | 2 | 148 | 1313 | since 2019 |  |
| 16 | [activ-travel.net](https://www.activ-travel.net) | #11 (dmc marrakech (Aug)) | 13 | 5569 | 1433 | founded in 1996 |  |
| 17 | [suenos-travel.com](https://www.suenos-travel.com) | #4 (agence receptive maroc dmc) | 9 | 2274 | 598 | — |  |
| 18 | [atlasandsaharatours.com](https://www.atlasandsaharatours.com) | #4 (mice agency marrakech) | 18 | 2352 | 5042 | since 2005 |  |
| 19 | [excel-travel-morocco.com](https://excel-travel-morocco.com) | #14 (dmc marrakech (Aug)) | 14 | 2280 | 1328 | — |  |
| 20 | [moroccogoevents.com](https://www.moroccogoevents.com) | #6 (mice agency marrakech) | 6 | 4418 | 894 | 15 years |  |
| 21 | [midfar.ma](https://midfar.ma) | #7 (destination mgmt co morocco) | 2 | 243 | 523 | depuis 1993 |  |
| 22 | [tetrapylon.com](https://tetrapylon.com) | #12 (destination mgmt co morocco) | 16 | 1675 | 743 | — |  |
| 23 | [dmcmorocco.com](https://dmcmorocco.com) | #10 (dmc morocco) | 6 | 2313 | 1612 | since 1993 |  |
| 24 | [astrolabevoyage.com](https://astrolabevoyage.com) | #9 (mice agency marrakech) | 6 | 2131 | 952 | 15+ years |  |
| 25 | [mountain-voyage.com](https://www.mountain-voyage.com) | #7 (morocco dmc) | 13 | 2418 | 1309 | established in 2006 |  |
| 26 | [celestetrails.com](https://celestetrails.com) | #6 (agence receptive maroc dmc) | 6 | 2333 | 2868 | est. 2014 |  |
| 27 | [travellink.ma](https://travellink.ma) | #14 (morocco dmc) | 9 | 324 | 84 | 33 years |  |
| 28 | [dmc-morocco.com](http://dmc-morocco.com) | #16 (dmc morocco) | 2 | 2302 | 0 | — | Blocks automated access (403); on-page not measurable |
| 29 | [str-cee.com](https://str-cee.com) | #19 (morocco dmc) | 13 | 1160 | 1560 | 45 years |  |
| 30 | [rocketdmc.com](https://rocketdmc.com) | #18 (morocco dmc) | 13 | 2594 | 218 | — |  |
| 31 | [originallymorocco.com](https://www.originallymorocco.com) | #27 (dmc marrakech (Aug)) | 7 | 2196 | 1360 | since 2006 |  |
| 32 | [upholidays.ma](https://upholidays.ma) | #7 (agence receptive maroc dmc) | no data | no data | 1539 | 15 ans |  |
| 33 | [atlas-outdoor.com](https://www.atlas-outdoor.com) | #15 (agence receptive maroc dmc) | 12 | 2578 | 832 | since 1996 |  |
| 34 | [mttmorocco.ma](https://mttmorocco.ma) | #8 (mice agency marrakech) | 8 | 232 | 11 | — | Bot-protection wall (on-page not measurable) |
| 35 | [viewmorocco.com](https://www.viewmorocco.com) | #23 (morocco dmc) | 13 | 2839 | 1198 | — |  |
| 36 | [indigo-dmc.com](https://www.indigo-dmc.com) | #16 (agence receptive maroc dmc) | 13 | 1962 | 527 | — |  |
| 37 | [morocco-excursion.com](https://morocco-excursion.com) | #18 (agence receptive maroc dmc) | 19 | 3101 | 1052 | — |  |
| 38 | [afkarts.com](https://www.afkarts.com) | #10 (mice agency marrakech) | 2 | 3065 | 806 | — |  |
| 39 | [across-morocco.com](https://across-morocco.com) | #20 (destination mgmt co morocco) | 6 | 2496 | 654 | — |  |
| 40 | [moroccohospitalityservices.com](https://moroccohospitalityservices.com) | #18 (dmc marrakech (Aug)) | 7 | 2529 | 597 | 12 years |  |
| 41 | [vmmorocco.com](https://www.vmmorocco.com) | #18 (destination mgmt co morocco) | 9 | 2230 | 308 | — |  |
| 42 | [journeyviamorocco.com](https://journeyviamorocco.com) | #11 (destination mgmt co morocco) | 9 | 2340 | 1512 | — |  |
| 43 | [easy-mice.com](https://easy-mice.com) | #11 (mice agency marrakech) | 2 | 2256 | 61 | — |  |
| 44 | [liberty-int.com](https://www.liberty-int.com) | #28 (destination mgmt co morocco) | 29 | 3583 | 1441 | 35+ years |  |
| 45 | [mymorocco.ma](https://www.mymorocco.ma) | #12 (mice agency marrakech) | 4 | 369 | 1244 | — |  |
| 46 | [experiencemorocco.com](https://www.experiencemorocco.com) | #32 (morocco dmc) | 23 | 2344 | 4980 | 4 years |  |
| 47 | [puremoroccotours.com](https://puremoroccotours.com) | #26 (morocco dmc) | 17 | 2317 | 618 | — |  |
| 48 | [marrakesh-travel-agency.com](https://marrakesh-travel-agency.com) | #13 (mice agency marrakech) | 7 | 2863 | 3304 | — |  |
| 49 | [edenmyevent.com](https://edenmyevent.com) | #15 (mice agency marrakech) | 13 | 2176 | 711 | — |  |
| 50 | [moroccovoyages21.com](https://www.moroccovoyages21.com) | #16 (mice agency marrakech) | 5 | 146 | 3196 | depuis 2000 |  |
## Limits
- Visibility is from one non-personalised desktop session in Morocco per search. Positions move daily.
- Word counts and term counts are automated heuristics on the ranking URL (usually the homepage), not full-site audits.
- Semrush AS and referring domains are third-party estimates. Semrush has no data for upholidays.ma.
- Track-record text is taken from what each site *claims*. It was not verified.
