# 19 — Verified Business Facts Needed

The new `/dmc-marrakech` and `/fr/dmc-marrakech` pages contain **only facts Morocco Quest already publishes consistently**. Everything else was left out of the public page.

**Facts used (already published elsewhere on the site):**
- Founded in **2022 by Mounir Akajia** (/about, schema `foundingDate`).
- Office at **Khalid Ibn Al Walid Street, Gueliz, Marrakech 40000** (footer, /contact, schema).
- Phone **+212 654 069 718**, email **sales@morocco-quest.com**.
- Google Maps profile <https://maps.app.goo.gl/FtVJocKLhRVvvF377>.
- Tripadvisor listing "Morocco Quest Dmc".
- Instagram handle **@moroccoquestdmc**.
- 4 guides with published bios on /about.
- Service languages EN/FR/ES/AR.
- The 24-hour proposal turnaround (an existing stated policy).

**Removed from the page because nothing supports them publicly:**
- "Moroccan Ministry of Tourism licensed".
- "IATA compatible".
- "100% licensed & insured".
- "20+ groups handled / year".
- "11 countries served" (with the world map).
- "We have delivered programmes for 400+ delegates".
- "groups of 500+".
- "We never compete with you".
- "Trade accounts with credit terms".
- "Site-inspection costs are typically credited back".
- The 4 anonymised testimonials ("Sophie M.", "James T.", "Dr. Elena R.", "Michael B.").
- "a 3,500-seat congress centre" (contradicted by venue directories: largest room ≈1,489).
- "over 30,000 beds" (sources give ≈75,000).
- "direct flights from 100+ European cities".

Each item below has a ready slot in the code. Fill it in `resources/content/dmc-marrakech/en.php` and `fr.php`, and it renders automatically.

| # | Missing fact | Why it matters | Where it will appear | Evidence you need to provide | Priority |
|---|---|---|---|---|---|
| F1 | **Tourism licence number** and the exact legal entity name (as on the licence) | The top trust signal for B2B buyers; the page's own checklist tells buyers to ask for it | Facts bar (new item), FAQ "Are you licensed?", schema `hasCredential` | Scan or photo of the licence (Ministry of Tourism / ODV agrément) showing number, entity and validity | **P0** |
| F2 | **Company registration** (RC, ICE) and **liability insurance** (insurer, cover) | Buyers' checklist items 1 and 3; credibility for contracting | Footer/legal line on the DMC page; FAQ | RC/ICE certificate; insurance certificate (current) | P1 |
| F3 | **Year DMC (B2B/group) activity started**, if different from 2022 | Half the market states years in business (report 11) | Facts bar "Founded" → "DMC operations since YYYY" | Earliest group/MICE invoice or contract (date only) | P1 |
| F4 | **Real volumes**: groups / pax handled in 2025 (and 2026 YTD) | Replaces the removed "20+ groups / year" claim | Facts bar | Internal booking report (totals only) | P1 |
| F5 | **2–3 real case studies**: client type (anonymised OK), pax, month/year, venues used, services delivered, one outcome or quote | The biggest experience gap vs competitors; the section is built and hidden until filled | `case_studies` → "Programmes delivered" section (renders when non-empty) | Programme summary + **written permission** + 2–4 original photos per case | **P0** |
| F6 | **Original event photos** from real MQ programmes (hero candidate, gala, conference desk, transfers, team on site) | All current page images are existing site stock, **not** MQ projects; originals prove experience | Hero (replacing the illustrative gala), service tiles, guide topics, case studies | Photos you own the rights to, ideally ≥1920 px; written consent from identifiable guests or delete them | P1 |
| F7 | **Named B2B contact person** (name, role, languages, photo, direct email/WhatsApp) | Competitor #2 shows a named contact; buyers want a person | "B2B desk" card next to the form (currently company-level only) | Name, role, photo, consent to publish | P1 |
| F8 | **Attributable testimonials** (full name + company, or a link to the public review) | Replaces the removed anonymous quotes | Reviews section (currently links to Tripadvisor and Google only) | Written approval from each quoted person, or the public review URL | P1 |
| F9 | **Memberships / certifications** (e.g. national tour-operator association, CRT Marrakech-Safi listing once approved, SITE, MPI, ICCA) | Institutional trust; competitor #1's logo strip | `memberships` → logo strip (renders when non-empty); schema `memberOf` | Membership certificate + official logo file + usage permission | P2 |
| F10 | **Client / partner logos** | Social proof used by benchmark leaders | Optional strip above the reviews | Written permission per logo | P2 |
| F11 | **Venues actually used** (Palais des Congrès, named hotels, Agafay camps, palaces) | Named entities strengthen relevance; only true ones may be named as experience | Services guide ("venues we have worked with") | Your confirmation per venue (invoices not required) | P2 |
| F12 | **Payment terms and invoicing currencies** confirmation | The FAQ states deposit / interim / balance and EUR/USD/GBP/MAD (carried over from the old page) | FAQ "payment terms" | Confirm the wording or correct it | P1 |
| F13 | **Client non-solicitation policy** for trade partners | The old page claimed "we never compete with you" while MQ also sells direct; the new copy says only "white-label delivery and confidential net rates" | "Who we are", FAQ "Who do you work with?" | Your written policy (if any) | P2 |
| F14 | **Guides' consent and current status** (4 guides shown with photos) | People shown must be current and agree to appear on a B2B page | "Some of the guides who lead our groups" | Confirmation that all four still work with MQ and agree | P1 |
| F15 | **Google Business Profile access** (owner/manager) and current category, rating and review count | The map pack and AI Overview lead the SERP (report 14) | Facts bar could show "⭐ x.x on Google (n reviews)" — only with a live, linked figure | Manager access, or a screenshot of the profile | **P0** |

## Site-wide claims to review (outside this page, not changed)

| Location | Claim | Issue |
|---|---|---|
| `layouts/app2.blade.php`, `layouts/app.blade.php`, `HomeController` schema `description` | "licensed Moroccan travel agency" | Needs F1 to stay |
| `/about` "Recognition & Excellence" block | "ISO Quality Label — Excellence in World Travel 2023", "Adventure Operator Award 2022", "Customer Choice Award 2024" | No issuing body or link; verify or remove |
| `partials/dmc-testimonials.blade.php` (still used on the 7 other DMC pages) | 4 anonymised testimonials | Same as F8: verify or remove sitewide |
| 7 other DMC pages | Several unsourced numbers (e.g. capacities, group sizes) | Review with the same standard in a later pass |
| Image files with misleading names/alt text on other pages | `morocco-quest-atlas-mountains-road-nationwide-coverage.webp` (shows a red wall), `destination management company (1).webp` (shows a passport flat lay), `morocco-quest-koutoubia-mosque-marrakech-why-us.webp` (shows a handshake), `morocco-quest-marrakech-koutoubia-dmc-hero.webp` (shows auditorium seats), `morocco-quest-marrakech-medina-souk-incentive-program.webp` (shows a boardroom) | No longer used on /dmc-marrakech; check alt text wherever else they appear |

## Image provenance (owner to confirm)
All 21 images on the page come from **existing files already published on morocco-quest.com** (report 22). Their original source and licence are not recorded in the repo. Please confirm you hold the rights (own photos, or stock with a commercial licence). No AI-generated or newly downloaded images were used.
