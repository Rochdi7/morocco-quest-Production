# 12 — Competitor #1 Deep Audit: Visit Marrakech MICE "Les agences réceptives (DMC)"

**URL:** <https://mice.visitmarrakech.com/se-reunir/les-agences-receptives-dmc/>
**Publisher:** Conseil Régional du Tourisme (CRT) de Marrakech-Safi, the official regional tourism board ("The Official Website of Marrakech MICE").
**Audit date:** 2026-11-24. **Evidence:** `evidence/phase2/` (rendered HTML, screenshots, JSON data). Legend: **[V]** = verified on the page, the SERP or Semrush; **[H]** = hypothesis (an explanation consistent with the evidence, not provable from outside Google).

## 1. Ranking verification

| Query (Google Morocco, gl=ma, hl=en, desktop, non-personalised) | Run | Position | Ranking URL |
|---|---|---|---|
| dmc marrakech | 2026-11-24 ~12:15 UTC (10-page scrape) | **#1** | /se-reunir/les-agences-receptives-dmc/ |
| dmc marrakech | 2026-11-24 13:25 UTC (run 2) | **#1** | same |
| dmc marrakech | 2026-11-24 13:26 UTC (run 3) | **#1** of the organic results; a **map pack and AI Overview were shown above it** | same |
| dmc marrakech | 2026-11-24 13:23 UTC (run 1) | Not on page 1. Google served a generic "Marrakech" result set (Wikipedia, UNESCO) | — |
| dmc marrakech morocco | 13:24 UTC | #3 | same |
| marrakech destination management company | 13:24 UTC | #2 | same |

- **No sponsored results** were detected for any of these queries [V].
- **Search snippet** [V]: title "Les agences réceptives (DMC) - MICE in Marrakech", site name "Visit Marrakech", snippet "Les agences réceptives (DMC - Destination Management Companies) de Marrakech possèdent l'expertise, les contacts et la créativité pour concevoir des expériences…" with "Translate this page". **The page that ranks #1 is in French** for an English-interface search.
- A second URL from the same site also ranks: `/listing/intrepid-dmc-marrakech/` at **#19** (run 2). Individual DMC profile pages on this directory can rank on their own [V].

## 2. What the page is

It is **not a DMC**. It is the official **directory of Marrakech destination management companies**: one intro paragraph plus **49 DMC cards**. Each card shows a name, a 1-line description and a link to a profile page. Companies listed include Originally Morocco, Monarch Travel, Mountain Voyage, Across Morocco, Morocco Discovery, Travel Link, Unitour, S'Tours, Voyages 21, Marrakech Gardens Travel, InTour, Intrepid DMC, Abercrombie & Kent, L'Atelier du Voyage, KMT, Golden Palms and others.
**Morocco Quest is not listed** (checked on the directory page and on the "full list" page `/travel-trade/?type=agences-dmc-voyages`) [V].

### Indexed page structure (site sections, from navigation) [V]
- **Se réunir:** Centres de congrès et d'exposition · Lieux événementiels · Hôtels réceptifs · **Les agences réceptives (DMC)**
- **La destination**, **Votre événement**, **Espace communication** (news), **Infos pratiques**, **Trouver un prestataire** (provider search)
- **Profile pages** `/listing/<slug>/`: name, phone, **website link (followed — no `rel` attribute)**, description, address, map, "Nearby listings", plus "**Claim Business**" and "**Application Form**" functions
- Language versions: FR (canonical) and EN (`/en/…`, declared with hreflang). The EN version sat behind a bot challenge during this audit.

## 3. Content architecture (section by section)

| # | Section | What it contains [V] | SEO contribution | Type of value | Morocco Quest equivalent | What MQ should do |
|---|---|---|---|---|---|---|
| 1 | Top bar + header | "The Official Website of Marrakech MICE", FR/EN switch, social icons, Visit Marrakech logo | Brand/entity signal (official body) | Trust | Brand header exists | — (MQ can't be "official"; cite real memberships instead) |
| 2 | Hero | Full-width **real photo of a B2B travel-trade workshop** (buyers and sellers at numbered tables with laptops; `DSC_8997.jpg`, 1351×500, ~484 KB JPEG), H1 overlay "Les agences réceptives (DMC)" | H1 = exact topic in French; image communicates "trade/B2B" | Relevance + credibility | Hero = stock-style photo of empty auditorium seats | Replace with an original photo of a real MQ B2B programme (see 15) |
| 3 | Breadcrumb | Home › Se réunir › Les agences réceptives (DMC) | Site hierarchy; BreadcrumbList schema | Technical | Yes (visible + schema) | Keep |
| 4 | Intro (H2 "Vos partenaires pour un événement inoubliable") | ~70 words: organising seminars, congresses, weddings or corporate trips in Marrakech needs local experts; DMCs have the expertise, contacts and creativity | Defines the entity "DMC" in Marrakech context | Topical relevance | MQ has a much longer intro | Keep MQ's, but add the definition sentence early (see 16) |
| 5 | **49 DMC cards** (H4 each) | Name + truncated description + link to profile | **Breadth of entities**: it answers "which DMCs exist in Marrakech?" | **Relevance (primary)** | No equivalent (MQ is one company) | Don't copy. Get listed in it (see 17, P0) |
| 6 | "Consultez la liste complète" | Link to the full provider list | Internal linking | Navigation | — | — |
| 7 | Institutional partner logo strip | CRT, ARIH, ARWM, **ONMT**, **UNWTO**, WTCF, Ville de Marrakech, Région Marrakech-Safi, Mechouar Kasbah, Association | Strong trust/entity association | Trust | None | Add a "Memberships & partners" strip **only with real memberships** |
| 8 | Footer | CRT legal info, phone, email contact@visitmarrakech.com, links to sister portals (pro, open data, calendar) | Publisher transparency | Trust | MQ has full footer | — |

**Absent from this page [V]:** services detail, MICE/incentive descriptions, team building, transport, hotels, itineraries, company history, testimonials, case studies, FAQ, quote form, prices. **None of these explain its #1 rank**, because it has none of them.

## 4. Visual and image audit

| Element | Competitor implementation [V] | Morocco Quest status | Recommendation |
|---|---|---|---|
| Hero image | Real event photo (B2B workshop, people, name cards, laptops). JPEG ~484 KB, CSS background (no alt), LCP element | CSS-background stock-style auditorium seats (`morocco-quest-marrakech-koutoubia-dmc-hero.webp`, 98 KB, **filename says Koutoubia but the image shows seats**) | Replace with an original photo of MQ staff/guests at a real programme, keep WebP, keep preload, and give the hero an `<img>` with alt (or keep the background and add a visible figure below) |
| Destination imagery | None on this page | Atlas road, Koutoubia, Ben Youssef group | Keep MQ's; they're more relevant than C1's |
| MICE photography | Hero only (trade workshop) | None of a real MQ event | Add (see 15) |
| Corporate events | None | Footer thumbnails only (gala dinner, lantern dinner, 91×89 px) | Add a real gala/dinner photo section |
| Team building | None | None (text only) | Add |
| Image gallery | None | None | Add a small, real "Programmes we delivered" gallery |
| Logos | 10 institutional SVG logos (176×80) | None | Add only real memberships/partners |
| Video | None | None | Optional |
| Image SEO | 1 photo, no alt (CSS bg), no descriptive filename (`DSC_8997.jpg`), not WebP | 24 images, 100% alt, WebP, lazy-loaded below the fold | MQ is technically ahead |

**Conclusion [V]:** imagery is **not** a ranking reason for competitor #1. It has a single photo.

## 5. Technical SEO

| Item | Finding [V] | Comment |
|---|---|---|
| Indexability | `robots: max-image-preview:large` (index allowed); 200 for real browsers | **Bots without JavaScript get a 401/402 challenge page with `noindex,nofollow`.** Googlebot is evidently let through, since it ranks |
| Canonical | Self, FR | — |
| hreflang | fr + en | **Bilingual** |
| Title / meta | "Les agences réceptives (DMC) \| MICE in Marrakech"; long FR description (auto-generated from the intro) | Title is short and exact; FR |
| Headings | H1 → H2 → 49×H4 (no H3) | Hierarchy skips H3; doesn't matter for its rank |
| Schema | AIOSEO graph: BreadcrumbList, WebPage, WebSite, Organization, Person, ImageObject. No Service/LocalBusiness/FAQ | Basic |
| Open Graph | Present; og:image is an SVG logo | Weak |
| Stack | WordPress + Elementor + Cloudflare, `s-maxage=216000` | — |
| Lab mobile perf (same throttling for all three sites) | LCP **27.8 s**, FCP 9.8 s, CLS 0.005, 94 requests, **5.5 MB**, 1,176 DOM nodes | **Very slow, yet #1**, so performance is not deciding this SERP |
| URL | `/se-reunir/les-agences-receptives-dmc/` (FR slug) | Descriptive |

## 6. Authority and backlinks (Semrush, 2026-11-24)

| Metric | visitmarrakech.com (root) | mice.visitmarrakech.com (subdomain) | morocco-quest.com |
|---|---|---|---|
| Authority Score | **47** | (shares root) | 2 |
| Referring domains | **5,349** | — | 2,103 |
| Backlinks | 44,365 (33,101 follow) | — | 2,205 |
| Strongest referring domains (subdomain) | — | greatruns.com (AS 45), audiala.com (39), glarity.app (35), villatajmarrakech.com (29), helloaxel.com (25), travelradio.live (21), moroccotravelexperts.com (18), voyage-au-maroc.net, workshopcentermarrakech.com | heartmybackpack.com (46), globeslice.com (20), then spam-network domains |

- **Relevance of its links [V]:** real travel, Marrakech and Morocco sites (villas, travel blogs, tour sites, radio). Its outbound links also go to official bodies (ONMT/visitmorocco.com, Ville de Marrakech, Région).
- **Harmful links:** none seen in the top 15.
- **Anchor text:** not pulled for this subdomain (cost/benefit). Its authority is clearly organic and institutional.

## 7. Why it ranks #1 (assessment)

1. **[V] Exact intent match for a "category + city" query.** Someone searching "DMC Marrakech" often wants *a list of DMCs in Marrakech*. A complete, official list of 49 DMCs satisfies that better than any single company page.
2. **[V] Institutional authority:** official tourism board, root domain AS 47 with 5,349 referring domains, real tourism links, and an 8-year-old subdomain (archived since 2019).
3. **[V] Exact topical title/H1** ("agences réceptives (DMC)"), bilingual FR/EN with hreflang.
4. **[H] Entity hub effect:** the page links to 49 DMC profiles, and many of those DMCs (in the 50-site benchmark) link back. That makes it the hub of the Marrakech DMC entity cluster.
5. **Not reasons [V]:** content depth (≈960 words of real content), images (one), speed (LCP 27.8 s lab), schema (basic), conversion (none).

## 8. What Morocco Quest should take from competitor #1

- **Don't compete with it; join it.** Apply to be listed (CRT Marrakech-Safi: contact@visitmarrakech.com, tel. 0524 43 34 07, or the "Application Form / Claim Business" on the listing pages). A listing gives:
  1. Brand presence on the #1 result.
  2. A followed link from an AS 47 official tourism domain.
  3. A profile page that can rank on its own (Intrepid's profile ranks #19).
- **Copy the concept, not the content:**
  - Add an official-style **"Memberships & partners"** strip using real logos only.
  - Use a **real B2B event photograph** in the hero.
  - Write a **French version** (the #1 page is French, and "dmc marrakech" has measurable demand in France: 20/mo per Semrush FR).
