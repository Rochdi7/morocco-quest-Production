# 13 — Competitor #2 Deep Audit: dmc-marrakech.com (MidFar DMC / Body and Soul International)

**URL:** <https://dmc-marrakech.com/>
**Operator:** MidFar Events & Travels (local DMC, **address in Casablanca**), site copyright **Body and Soul International BV** (a Dutch DMC network that also runs bodyandsoulinternational.com and dmcprofessionals.com).
**Audit date:** 2026-11-24. **[V]** = verified, **[H]** = hypothesis.

## 1. Ranking verification

| Query (Google MA, en, desktop, non-personalised) | Time (UTC) | Position |
|---|---|---|
| dmc marrakech | ~12:15 (10-page scrape) | **#2** |
| dmc marrakech | 13:25 (run 2) | **#2** |
| dmc marrakech | 13:26 (run 3) | **#2** organic (map pack + AI Overview above) |
| dmc marrakech | 13:23 (run 1) | not on page 1 (generic "Marrakech" result set served) |
| dmc marrakech morocco | 13:24 | #4 |
| marrakech destination management company | 13:24 | not in top 20 |
| dmc marrakech (Semrush US snapshot) | — | **#1** |

- **Snippet [V]:** title "DMC Marrakech" (Google rewrote it, because the real `<title>` is "Home"), site name "dmc-marrakech.com". Description written by Google from body text: "MidFar is an experienced DMC organising events in Marrakech and the rest of Morocco. Luxury stays, guided escorts through historical treasures, …" (the site has **no meta description**).
- **No ads** on these SERPs.

## 2. Site structure [V]

- **One indexable page.** The homepage's only internal link is to itself; the other links are mailto: and 3 external links (dmcprofessionals.com/dmc-marrakech/, a PDF infographic on dmcprofessionals.com, and a public-holiday site).
- No sitemap.xml (404). robots.txt is the default Joomla file (blocks /administrator/, /cache/… only).
- CMS: **Joomla + YOOtheme**. `www.` → apex is a 302 (not 301).
- **Domain age:** first Wayback Machine capture **2016-01-12** (about 10 years). Schema `dateCreated` of the current article is 2022-09-26.

## 3. Content architecture (section by section)

| # | Section [V] | Content | SEO contribution | Value type | MQ equivalent | MQ action |
|---|---|---|---|---|---|---|
| 1 | Top line | "DMC Marrakech for the best incentives and events" (low-contrast text over the hero) | Exact phrase near the top | Relevance | MQ hero subtitle (not keyword-led) | Covered by the new H1 |
| 2 | Hero | Photo of **Bab Agnaou** (Marrakech gate), 1366×323 CSS background WebP (164 KB, LCP element). "DISCOVER Marrakech" H3 + **H1 "DMC Marrakech"** (huge) | **Exact-match H1** | Relevance | H1 (new local version) starts "DMC Marrakech:" | Done locally, pending deploy |
| 3 | "DMC Marrakech" H3 + 3 paragraphs | **Destination copy, not B2B:** "city of roses… snake charmers… bucket list… camel ride… luxury tent" | Repeats "DMC Marrakech" + Marrakech entities (souks, riads, desert) | Relevance (weak, B2C tone) | MQ covers far more | — |
| 4 | **Company box "MidFar"** | Logo, **full postal address (Casablanca)**, email | NAP; entity | Trust | MQ footer has a Marrakech address | Show MQ's **Marrakech (Gueliz) address** on the DMC page itself, a local advantage |
| 5 | **Rating** | "4.9/5 rating (11 votes)" star widget (self-hosted, no source, no schema) | None directly (no rating markup) | Credibility/CTR | No rating shown | Show the **real Google/TripAdvisor rating with a link** (never a self-hosted score) |
| 6 | **"Get in touch with us"** | **Named contact person with photo** (Hind El Ouali El Alami, MidFar) + "Help with your request?" button | E-E-A-T (a real person) | Trust + conversion | MQ has no named B2B contact | Add a named B2B account manager with a photo (owner to supply) |
| 7 | "More about MidFar DMC" | ~120 words: departments for MICE and for tour operating, "creative proposals" | Company description | Trust | MQ has longer "why us" | — |
| 8 | Travel facts Morocco | Table: currency, language, local time, public holidays link + Majorelle-style blue fountain photo | Practical info for planners | Helpful content | **None** | Add a compact "Marrakech facts for planners" block (see 16) |
| 9 | Travel highlights + Map + More about Morocco | Medina souks, Djemaa el-Fna, Koutoubia, hammam; static Morocco map (1763×1700 JPEG, 175 KB shown at 373 px); links to Event ideas / Incentive ideas / Infographic on dmcprofessionals.com | Marrakech entities | Relevance | MQ mentions medina, Jemaa, Koutoubia | Optional |
| 10 | "About MidFar DMC Marrakech" | ~250 words of marketing copy ("Marrakech's leading DMC… premier destination management company"), "DMC Marrakech" bolded | Exact phrase repetition | Relevance | MQ has the B2B equivalent | — |
| 11 | **"DMC Services Marrakech"** | One comma-separated list of 27 services: conferences, conventions, congresses, conference logistics, corporate functions, corporate group travel, corporate meetings, corporate travel, events, event support, gala dinners, guides, ground handling, hotel bookings, local excursions, meetings, meeting venues, **product launches**, restaurant venues, **reward trips**, **seminars**, special interest groups, teambuilding, **themed dinners**, transport, **stimulation and motivation trips**, venue finding | Dense entity/keyword list | Relevance | MQ covers most in depth; **missing: product launches, seminars, themed dinners, reward/motivation trips** | Add these as real services if MQ offers them |
| 12 | YouTube embed | Video `lz8Voj48zsA` | Engagement (hypothesis) | — | None | Optional: a real MQ programme video |
| 13 | Footer | "Copyright © Body and Soul International BV" | — | — | — | — |

**Absent [V]:** testimonials, case studies, client logos, certifications, licence number, FAQ, quote form (only email), phone, WhatsApp, prices, team page, MICE photography, breadcrumb, Open Graph.

## 4. Visual and image audit

| Element | Competitor implementation [V] | Morocco Quest status | Recommendation |
|---|---|---|---|
| Hero image | Bab Agnaou gate, Marrakech-specific, likely stock, 1366×323 strip, WebP 164 KB, CSS bg (no alt) | Auditorium seats (generic, not Marrakech), WebP 98 KB, CSS bg | Use a **Marrakech-identifiable *and* event-specific** original image |
| Destination imagery | Blue fountain (400×300, **no alt**), spice cones (500×343, alt "Destination Management Marrakech"), Morocco map (no alt, oversized) | Atlas road, Koutoubia, Ben Youssef group (100% alt) | MQ is ahead; keep |
| People / team | **1 contact-person photo** (132×157 webp, alt = name) | **None** | Add a team / account-manager photo |
| MICE / corporate events | **None** | None (footer thumbnails only) | Add a real one (see 15) |
| Team building | None | None | Add |
| Gallery | None | None | Add a small real gallery |
| Logo | MidFar logo ×2 (one without alt) | Brand logo | — |
| Video | YouTube embed | None | Optional |
| Image SEO | Hashed filenames (`dmc-marrakech-db8ea7b9.webp`), 3 of 6 without alt, no srcset, eager 175 KB map | Descriptive filenames (except "destination management company (1).webp"), 100% alt, WebP, srcset on cards | MQ is ahead |

**Conclusion [V]:** this competitor's images are few, generic and partly unoptimised. **They are not why it ranks.**

## 5. Technical SEO [V]

| Item | Finding |
|---|---|
| Title | **"Home"** (Google rewrites it in the SERP to "DMC Marrakech") |
| Meta description | **missing** |
| Canonical | **missing** |
| Robots meta | none (indexable) |
| hreflang / lang | none / `en-gb` |
| Open Graph / Twitter | **none** |
| Headings | H3 before H1; 1 H1 "DMC Marrakech"; the rest are H3 (no H2) |
| Schema | Organization **named "Destination Management Company Marrakech"**, WebSite (same name), WebPage, Article (author Els van Oldenbarneveld, `userInteractionCount` 61,419) |
| Breadcrumb | none |
| Internal links | none (single page) |
| Lab mobile perf (identical throttling) | LCP **8.5 s**, FCP 2.8 s, **CLS 0.112** (above the 0.1 "good" threshold), TTFB 1.09 s, 25 requests, 560 KB, 281 DOM nodes |
| Cache headers | `no-store, no-cache` on HTML |
| www → apex | 302 (should be 301) |

Technically it's **weaker than Morocco Quest on almost every item**.

## 6. Authority and backlinks (Semrush, 2026-11-24)

| Metric | dmc-marrakech.com | morocco-quest.com |
|---|---|---|
| Authority Score | 6 | 2 |
| Referring domains / backlinks | 2,324 / 2,760 | 2,103 / 2,205 |
| Share of RDs at AS 0–2 | 94.0% | 94.5% |
| Top anchor | "premium seo links for higher search engine rankings for dmc-marrakech.com" (**1,989 domains**) | "expert seo backlink services morocco-quest.com for higher search engine visibility" (**1,872 domains**) |
| Other anchors | "dmc-marrakech.com" (140 RDs), "expert white hat seo links…" (103), "high quality dofollow backlinks… pbn…" (94), "link insertions…" (14) | "reliable pbn backlinks…" (97), "high quality dofollow backlinks… pbn…" (79), "morocco-quest.com" (49), "link insertions…" (18), "morocco quest" (3), real editorial anchors: "fes festival of world sacred music", "gnawa performance", "moussem of tan-tan" |
| Top referring domains by AS | best-seo-domains.com (14), seo-revealed.club (14), screenshots.wiki (12), sergechel.info (12), sweetbonanzacz.com (12), blinks.sbs (9)… **all spam/SEO-tool sites** | heartmybackpack.com (**46**, real travel blog), globeslice.com (**20**, real), then the same spam network |

**Reading [V]:**
- Both domains receive the **same automated spam-link pattern**: identical anchor templates pointing at thousands of sites. That's unsolicited "SEO spam" noise, and Google's systems are designed to ignore it.
- **dmc-marrakech.com's top 20 referring domains contain no tourism, Moroccan, DMC or trade-press site.** Its link profile **does not explain its rank**.
- **Morocco Quest actually has better real links at the top** (AS 46 and AS 20 travel sites).
- **Harmful links:** both profiles are mostly spam. A disavow isn't required by default (Google ignores such links). Consider one only if a manual action ever appears in GSC.
- **Network links [V]:** the network sites checked (dmcprofessionals.com, bodyandsoulinternational.com) link to dmcprofessionals.com/dmc-marrakech/, **not** to dmc-marrakech.com. A private network boost is therefore **not evidenced**.

## 7. Why it ranks #2 (assessment)

1. **[V] Exact-match domain = the query.** For a low-volume B2B query (40/mo US, 20/mo FR), a 10-year-old domain literally named "dmc-marrakech", with H1 "DMC Marrakech" and Organization name "Destination Management Company Marrakech", is a very strong relevance match.
2. **[H] The query behaves partly like a brand/navigational search.** Several businesses are literally named "DMC Marrakech": dmc-marrakech.com, dmcmarrakech.com, and a Google Business Profile "Dmc Marrakech" (5.0★, 4 reviews) that leads the map pack. Google rewards the site whose name matches the query.
3. **[V] Topical purity:** the only page on the domain is about DMC Marrakech. Every signal points one way.
4. **[V] Domain age** (2016) vs morocco-quest.com (first archived 2025-03).
5. **Not reasons [V]:** content depth (757 words, mostly B2C tone), technical SEO (title "Home", no description, no canonical), images (6, generic), backlinks (spam), speed (LCP 8.5 s lab, CLS 0.11), conversion (email only).

## 8. What competitor #2 does better than #1, and what they share

- **#2 better than #1:**
  - It's an actual DMC with a services list.
  - It names a contact person with a photo.
  - It shows planner facts.
  - It's fully in English.
- **Both share:**
  - An exact topical H1 ("DMC" / "agences réceptives (DMC)").
  - Old domains (2016 / 2019).
  - Weak conversion and image SEO.
  - Slow pages.
  - **No reliance on long content or many images.**
  - Each is the *whole site's* topic: the directory section of the official MICE site, and a single-topic EMD.

## 9. What Morocco Quest should take from competitor #2

- Make the **entity explicit:**
  - Use the exact phrase as the H1 lead (done locally).
  - Add schema `alternateName` "Morocco Quest DMC" (owner decision O-13) and `name`/`alternateName` on the Service (done locally).
- Add a **named B2B contact person with a photo** and a **planner facts block**.
- Add the missing services **only if offered:** product launches, seminars, themed dinners, reward/motivation trips.
- **Show the Marrakech office address on the DMC page.** MidFar is based in Casablanca; Morocco Quest's Gueliz office is a genuine local-relevance advantage, especially for the map pack (see 14 §4).
