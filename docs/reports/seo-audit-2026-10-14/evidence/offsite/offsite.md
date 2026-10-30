# Off-site audit: morocco-quest.com (2026-10-14, read-only)

Method: curl/WebFetch of public pages, low rate. The WAF returns "406 Not Acceptable" to a browser-style User-Agent (Mozilla/5.0) and 200 to curl's default UA. Raw HTML snapshots: p_.html, p_contact.html, p_about.html. WebSearch was NOT available in this run; Bing/DDG via WebFetch returned only generic results (DDG captcha), so "no third-party mentions found" means "not discoverable with these tools", not "none exist".

## 1. NAP

| Source | Name | Address | Phone | Notes |
|---|---|---|---|---|
| Footer / home | Morocco Quest | - | +212-654-069-718 | |
| /contact visible | Morocco Quest | Khalid Ibn Al Walid Street, Gueliz, Marrakech, 40000, Morocco | +212 654 069 718 | Maps embed labelled "Morocco Quest DMC" 31.6343547,-8.00426; short link maps.app.goo.gl/FtVJocKLhRVvvF377 |
| /about visible | Morocco Quest | same street address | +212-654-069-718 | |
| JSON-LD TravelAgency (all 3 pages) | name "Morocco Quest", alternateName "Morocco Quest Tours & Travel" | Khalid Ibn Al Walid Street, Gueliz; 40000; Marrakech; Marrakech-Safi; MA | +212-654-069-718 | geo 31.6343547 / -8.00426 (strings); email sales@morocco-quest.com; hasMap set; aggregateRating null; openingHoursSpecification null |
| JSON-LD sameAs | - | - | - | Facebook profile.php?id=61578772746041, Instagram /moroccoquestdmc/, TripAdvisor d33367694 |
| llms.txt | "Morocco Quest (also known as Morocco Quest DMC)" | Marrakech | +212-654-069-718 | |
| GBP (via Maps embed label) | Morocco Quest DMC | - | not re-verified | |
| Instagram | Morocco Quest DMC (19 followers) | - | - | no website link visible in bio |
| Facebook | "Morocco Quest DMC \| Marrakesh" (title only; followers not readable) | - | - | |
| TripAdvisor d33367694 | Morocco Quest DMC | "Marrakech" only | none | no website, no phone |

Findings:
- Phone and address are consistent across visible HTML, JSON-LD and llms.txt. Digit formatting varies (+212-654-069-718 / +212 654 069 718 / +212654069718) but it is one number.
- CHANGED since 09-28: JSON-LD now contains street address and postal code (the earlier audit said missing).
- Name still split: site schema "Morocco Quest" (alt "Morocco Quest Tours & Travel") vs "Morocco Quest DMC" on GBP, IG, FB, TA. llms.txt bridges with "also known as". Choose one canonical name; add "Morocco Quest DMC" as alternateName.
- Schema gaps: no openingHoursSpecification; geo values are strings (use numbers).
- The site links GBP (maps.app.goo.gl), TripAdvisor (d33367694) on /contact and /about, plus sameAs. Facebook/IG linked. No LinkedIn, Yelp or Google review link (g.page) found.

## 2. Citations and brand mentions

| Listing | Name | Phone / URL | Data | Status |
|---|---|---|---|---|
| TripAdvisor d33367694 (linked by site) | Morocco Quest DMC | no phone, no website | 5.0, 1 review (Aug 2025), categorised "Food & Drink" (#300 of 793), no Travellers' Choice badge | Weak: wrong category, 1 review, no NAP. Owner must claim. |
| TripAdvisor d14018375 | Morocco Quest | none shown | 4.9, 28 reviews, outdoor activities; reviews praise a guide "Khalid", 7-12 day private tours | Ownership NOT established (09-28 audit says it names a different operator). Do not assume it is ours. |
| TripAdvisor d33367636 | Morocco Quest Tours | none | 0 reviews, Fun & Games | Orphan duplicate, owner unverified |
| TripAdvisor d32994486 | "Morocco Tour Quest" | none | 5.0, 12 reviews, Transportation | Different name, owner unverified |
| moroccoquest.com | MoroccoQuest | +212 669 54 16 99, Contact@Moroccoquest.com, Najd Mabrouka, Marrakesh 40160 | no mention of morocco-quest.com | Confirmed separate business; brand confusion persists |
| visitmarrakech MICE DMC directory (mice.visitmarrakech.com/travel-trade/?type=agences-dmc-voyages) | 0 matches for "Morocco Quest" in server HTML; list appears JS-loaded | - | - | Inconclusive. Contact: mice.visitmarrakech.com/nous-contacter/ |
| Yelp / LinkedIn / Google Maps profile | not discoverable with available tools | - | - | Owner to confirm |

Third-party directory citations verifiable with matching NAP: none.

TripAdvisor details come from WebFetch summaries (TripAdvisor returns 403 to curl), so treat ratings and counts as moderate confidence.

## 3. Backlinks / referring domains

- commoncrawl_graph.py morocco-quest.com: FAILED again (killed at the 120 s timeout, no output), same as 09-28.
- "morocco-quest.com -site:" style queries: no usable results (Bing returned generic Morocco pages; DDG captcha).
- CHANGED: coloredmorocco.com (the 09-28 "only verified backlink"): its homepage and 25 of 27 pages in its page-sitemap contain no link to or mention of morocco-quest.com. It still shows WhatsApp +212654069718, the same phone as Morocco Quest. morocco-quest.com pages do not link to it either. The link is NOT reproducible today.

Verifiable referring domains today: **none**. (If coloredmorocco.com is the same operator, say so openly on both sites or separate the numbers; shared phone is a NAP entanglement.)

Owner should provide: (1) GSC > Links export (top linking sites, linked pages, anchor text), (2) Ahrefs or Semrush referring-domains CSV (the historical DR 0.2 to 6 and 274 to 413 RD figures are unverified), (3) Bing Webmaster Tools backlinks export, (4) any known partner, hotel or press links.

## 4. Award verification

| Claim | Where | Evidence | Verdict |
|---|---|---|---|
| TripAdvisor Travellers' Choice 2022 | home | Linked TA listing d33367694 has no badge and its only review is Aug 2025, so it cannot hold a 2022 award. Listing d14018375 (28 reviews) not shown to be ours | Unverified; contradicted by the linked listing |
| Tui Sustainability Award (Tui Cruises) 2024 | home | No public record found | Unverified |
| IAGTO Supplier's Awards 2025 | home | No public record found (iagto.com/awards 404; search empty) | Unverified |
| ISO Quality Label "Excellence in World Travel" 2023 | /about | No issuer, certificate number or standard cited | Unverified; wording implausible |
| Adventure Operator Award "Best Adventure Tours" 2022 | /about | none | Unverified |
| Customer Choice Award "Customer Service Excellence" 2024 | /about | none | Unverified |
| Consistency | home vs /about | Home shows TA/Tui/IAGTO; /about shows three different awards; none overlap | Contradictory |

Risk: unproven award claims can breach advertising/consumer rules and damage trust. Remove each claim or link evidence (issuer page or certificate).

## 5. GEO (secondary)

- robots.txt: 200. All named AI crawlers (GPTBot, OAI-SearchBot, ChatGPT-User, ClaudeBot, Claude-SearchBot, PerplexityBot, Google-Extended, CCBot, Applebot-Extended, Amazonbot) allowed except admin/login/track paths. Sitemap declared (84 URLs in sitemap.xml).
- llms.txt: 200 text/plain. It is an emerging, non-standard convention and not a Google ranking factor.
- llms.txt link check (HEAD, 1.5 s spacing): 18 of 19 return 200 (/, /tours, /tours/type/multi-day, /tours/type/one-day, /destinations, /experiences, /blog, /faq, /about, /contact, and 8 DMC/MICE pages). The TripAdvisor URL returns 403 to bots (anti-bot, not a site defect). Raw output: llms_check.txt.
- Factual clarity: llms.txt and /contact state who/where/phone clearly. It claims "licensed" but no licence/registration number appears on fetched pages. EN/FR/ES service is claimed while the site is English only (per 09-28). llms.txt points to a TA listing with 1 review.

## 6. Authority opportunities (realistic, no buying)

| Opportunity | Requires real membership / evidence? |
|---|---|
| Listing in Marrakech MICE "agences réceptives (DMC)" directory (contact form) | Likely company registration/licence proof |
| ONMT / CRT Marrakech-Safi supplier directories | Licence proof |
| FNAV or other Moroccan travel association | Real membership |
| SITE, MPI, ICCA | Paid membership; list only if joined |
| Partner hotels, riads, desert camps "partners" pages | Real commercial relationship |
| TripAdvisor: claim listing, fix category, merge duplicates | Account ownership |
| GBP: category, hours, reviews, review link | GBP access |
| Trade press (Travel Courier, regional blogs): Tangier 2027 eclipse guide, Agafay incentive data | Real expertise; manual pitch |
| GetYourGuide / Viator | Supplier approval |
| LinkedIn company page, Yelp, Bing Places, Apple Business Connect | Owner accounts; consistent name and NAP |

## 7. Changes vs 2026-09-28

- JSON-LD now has street address and postal code (fixed).
- coloredmorocco backlink no longer found.
- /about shows a second, different award set; all still unverified.
- commoncrawl still fails.
