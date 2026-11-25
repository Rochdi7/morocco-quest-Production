# 01 — Ranking Baseline: "DMC Marrakech"

Date of research: **2026-11-24** (UTC). Target: `https://morocco-quest.com/dmc-marrakech`.

## Data sources and what each one can prove

| Source | What it measured | Status |
|---|---|---|
| Google, live, via the project's own scraper (`scripts/serp-audit/serp_scrape.py`, Playwright, `gl=ma`, `pws=0`, persistent non-logged-in profile, desktop 1366px, `Africa/Casablanca` timezone) | Real Google organic results, top ~100 | **Measured.** Ran without a CAPTCHA. Raw output in `evidence/` |
| Same tool, 2026-08-26 run | Earlier baseline | **Measured** (kept in `scripts/serp-audit/out/`, gitignored) |
| Headless Selenium Google check | — | Blocked by a Google CAPTCHA on the first query. Not retried or worked around. |
| Semrush API (US database; the MA/UK/FR/mobile-US databases returned "no data" for this keyword) | Keyword volume, KD, SERP snapshot, Morocco Quest positions, backlinks | **Third-party estimate.** Semrush's crawl date isn't exposed and can lag Google by weeks. |
| SE Ranking API | — | Subscription expired (403), so no SERP data. |
| Google Search Console | — | **Not available.** The configured service account only has access to a different property (not Morocco Quest). That property's data was not read or used. |

**No figure in this report comes from Search Console.** Impressions, clicks and average position remain unknown until Morocco Quest's GSC property is shared with the service account or exported by hand.

## Verified position — primary keyword

| Keyword | Location | Lang | Device | Date/time (UTC) | Position | Ranking URL |
|---|---|---|---|---|---|---|
| dmc marrakech | Google Morocco (gl=ma) | en | desktop | 2026-11-24 ~12:15 | **Not in top 94** | — |
| dmc marrakech | Google Morocco (gl=ma) | fr | desktop | 2026-11-24 ~12:20 | **Not in top 47** | — |
| morocco dmc | Google Morocco (gl=ma) | en | desktop | 2026-11-24 ~12:22 | **Not in top 48** | — |
| dmc marrakech | Google Morocco (gl=ma) | en | desktop | 2026-08-26 23:09 | **#35** (page 4) | /dmc-marrakech |
| dmc marrakech | Semrush US snapshot | en | desktop | snapshot (date n/a) | Not in top 30 | — |
| morocco dmc | Semrush US snapshot | en | desktop | snapshot | #20 | **/tag/morocco-dmc** (the wrong URL) |
| dmc morocco | Semrush US snapshot | en | desktop | snapshot | #43 | /dmc-marrakech |

**Your "page 3" observation could not be reproduced in a non-personalised session.** A logged-in browser that has visited morocco-quest.com before gets personalised results, which can show the site higher than anonymous users see it. The honest baseline is **"outside the top ~94 in Google Morocco, down from #35 in late August."**

**Mobile:** not verified. Semrush has no mobile data for this keyword, SE Ranking access has expired, and headless mobile Google was CAPTCHA-blocked. The desktop SERP is the only measured one.
**Morocco vs. other markets:** Morocco measured live. US via Semrush only. UK/FR have no Semrush data.

## Current SERP — Google Morocco, "dmc marrakech", en, 2026-11-24

| # | Domain | Ranking URL type | Notes |
|---|---|---|---|
| 1 | [mice.visitmarrakech.com](https://mice.visitmarrakech.com/se-reunir/les-agences-receptives-dmc/) | Directory: "Les agences réceptives (DMC)" from the Marrakech tourism board | **A listing page, not a competitor.** Getting listed there is a citation opportunity. |
| 2 | [dmc-marrakech.com](https://dmc-marrakech.com/) | Homepage, exact-match domain | Title "Home", no meta description, 761 words |
| 3 | [attendance.ma](https://www.attendance.ma/) | Homepage | Marrakech MICE DMC |
| 4 | [your-morocco-dmc.com](https://your-morocco-dmc.com/home/) | Homepage | Partial-match domain |
| 5 | [nolimits.ma](https://www.nolimits.ma/) | Homepage | "Marrakech DMC / MICE" |
| 6 | [boardingpassdmc.ma](https://boardingpassdmc.ma/) | Homepage | DMC in domain |
| 7 | [globaldmcpartners.com](https://www.globaldmcpartners.com/destination/morocco/marrakech/) | Network destination page | **Membership network**, also a citation opportunity |
| 8 | [dmcmarrakech.com](https://dmcmarrakech.com/) | Homepage, exact-match domain | |
| 9+ | Generic "Marrakech" results (WTO, WIPO, hotels, YouTube) | — | Google runs out of relevant DMC pages after about 8 results |

SERP features seen: related searches ("Meilleur agence de voyage Marrakech", "Dmc fil maroc"…). On 2026-08-26 there was also a **Local Pack** (a Google Business Profile literally named "Dmc Marrakech", Originally Morocco, Excel Travel Morocco). Today's run didn't capture one, so the Local Pack appears intermittently. No People Also Ask box or AI Overview was detected.

**Key insight:** after position 8 Google fills page 1 and 2 with *unrelated* Marrakech pages. Google has very few pages it considers relevant to this query. A relevant, trusted page should be able to reach page 1. Morocco Quest is currently not trusted or relevant enough to be in even that small set.

## Indexing and canonical (live, 2026-11-24)

| Check | Result |
|---|---|
| HTTP status | 200 (TTFB 0.56 s from this machine) |
| `http://` and `www.` variants | 301 → `https://morocco-quest.com/dmc-marrakech` |
| Trailing slash `/dmc-marrakech/` | 301 |
| `<meta name="robots">` | `index,follow` |
| X-Robots-Tag header | none |
| Canonical | `https://morocco-quest.com/dmc-marrakech` (self) |
| robots.txt | not blocked |
| sitemap.xml | listed (5th URL) |
| Google-selected canonical | **unverifiable without GSC URL Inspection** |
| Indexed? | Ranked #35 in August, and Semrush sees it for "dmc morocco" (#43), so it is very likely indexed. Confirm with GSC URL Inspection. |

## Competing Morocco Quest URLs (cannibalisation)

| URL | Keyword | Status today |
|---|---|---|
| `/tag/morocco-dmc` | "morocco dmc" (#20 in Semrush US) | **Now `noindex,follow`** (live). This stops the cannibalisation once Google re-crawls it. Semrush's #20 is a pre-noindex snapshot. |
| `/destination-management-company` | "what is a DMC" (explainer intent) | Distinct intent: title "What Is a DMC? Destination Management Company Morocco". No overlap with the primary keyword. |
| Other 6 DMC service pages | Sub-intents (meetings, PCO, team building…) | No overlap with the primary keyword. |

---

## ⚠ Correction (added 2026-11-24, Phase 2; see 14 §1 and 18 §6)
The "not in top 94" result above is **superseded**. That scrape requested pages 2–10 as separate requests, and Google served those pages from a different, generic "Marrakech" result set. Three focused re-checks (13:23, 13:25, 13:26 UTC, same conditions) found **morocco-quest.com/dmc-marrakech at #15, #18 and #15 (page 2)**. There is **no evidence of a drop** since August (#35). The "Key insight" paragraph about Google running out of relevant pages after #8 also reflects that artefact. In the DMC result set, page 2 contains DMC sites (dmcmarrakech.com, Visit Morocco DMC, Mountain Voyage, Morocco Quest…). A map pack and an AI Overview can appear above organic #1.
