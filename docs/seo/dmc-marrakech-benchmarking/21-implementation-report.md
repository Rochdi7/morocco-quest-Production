# 21 — Implementation Report (Phase 3, 2026-11-24/25)

**Status:**
- Implemented and validated **locally**.
- **Not committed, not pushed, not deployed.**
- The live site is unchanged.

Baseline for the target keyword "dmc marrakech" (Google Morocco, desktop, non-personalised, 2026-11-24): **#15 / #18 / #15** across three checks. This is a range, not a fixed position (report 14).

## 1. What was built

`/dmc-marrakech` was rebuilt section by section from the blueprint (report 16), and a French version was added at **`/fr/dmc-marrakech`**. Both use one Blade template, and their copy lives in versioned content files:

| # | Section | Content source | Notes |
|---|---|---|---|
| 1 | Hero | H1 "DMC Marrakech: Destination Management Company for Travel Agents & MICE Planners" / FR "DMC Marrakech : agence réceptive pour séminaires, voyages incentive et événements d'entreprise"; B2B lead; **two CTAs** (quote anchor + WhatsApp with a prefilled B2B message) | Real `<img>` + `srcset` (640/960/1280) + preload with `fetchpriority=high`, replacing the CSS background of stock auditorium seats |
| 2 | Verified facts bar | Gueliz office (Maps link), founded 2022 by Mounir Akajia, coverage, languages, 24h proposals, independent reviews | Only facts the company already publishes; unverifiable stats removed (report 19) |
| 3 | Who we are | DMC definition (citable), company story, white-label model, 4 bullets, **4 named guides with photos** → /about | — |
| 4 | Core DMC services | 8 tiles with images, each linking to its guide topic **and** the matching sister page | Sister pages: events production, team building, meetings & conventions, 360° solutions, tours |
| 5 | Services guide | 8 topics in native `<details>` (no JS): meetings/seminars, incentives, events/galas, team building, transport, hotels/riads, excursions/dining, responsible management; 4 images | Tile anchors open the right topic (small inline script) |
| 6 | Marrakech for event planners | 12-row facts table with **numbered citations**, a drive-time diagram (inline SVG), and 6 linked sources | Corrected facts: largest Palais des Congrès room ≈1,489 people (was "3,500-seat"); ≈75,000 beds (was "30,000") |
| 7 | Programmes | 3 **sample formats**, explicitly labelled "illustrative, not records of past events"; a **case-study section that renders only when real cases are added** | No fabricated projects |
| 8 | Morocco-wide coverage | 8 destinations + links to /destinations and multi-day tours | — |
| 9 | Why choose Morocco Quest | 6 evidence-based points (local office, tailored planning, supplier coordination, operational support, transparent quotes, multilingual B2B) | No superiority claims |
| 10 | How to choose a DMC in Marrakech | 8-point buyer's checklist (licence, local office, insurance, staff on site, references, supplier contracts, payment terms, contingency) | Neutral; MQ answers in writing |
| 11 | How we work | 6 steps: briefing → requirements & budget → proposal → supplier coordination → on-site execution → follow-up | — |
| 12 | Quote request | Same backend contract (`contact.submit`, same field names, `page_source` = `dmc-marrakech` / `dmc-marrakech-fr`); native date input (flatpickr removed from this page); labelled select; B2B desk card (address, languages, WhatsApp, phone, email) | Named contact pending (F7) |
| 13 | Testimonials & memberships | Anonymous testimonials **removed** from this page; links to **Tripadvisor** and **Google Maps** reviews; membership strip renders only when real memberships are added | — |
| 14 | FAQ | 10 buyer questions, with "séminaire" / "team building" phrasing in context | **FAQPage schema removed**: not eligible for FAQ rich results (limited to government/health sites since Aug 2023) |
| 15 | Related services, products, final CTA | Related grid (FR labels on the FR page); **curated Marrakech products** (city break, Sahara, Essaouira duo; balloon, cooking class, medina tour) with fallback to the latest items; final CTA | — |

## 2. Files changed

| File | Change |
|---|---|
| `app/Http/Controllers/DmcController.php` | Rewritten: `index()` (EN) + `indexFr()` (FR) share `render()`; loads content files; sets title, description, canonical, keywords, **hreflang en/fr/x-default**, OG (locale + alternate + 1200×630 card + alt), Twitter; `app()->setLocale()` for `<html lang>`. **P0-6 fixed**: the incorrect "fell out of the top ~94" comment is replaced by the verified baseline |
| `resources/views/dmc-marrakech.blade.php` | Rewritten as the single template for both languages (15 sections); WebPage + Service + BreadcrumbList JSON-LD; no FAQPage |
| `resources/content/dmc-marrakech/en.php` · `fr.php` (**new**) | All copy, image alt text, sources, FAQ, form labels; empty `case_studies` / `memberships` slots |
| `assets/css/dmc-marrakech.css` (**new**, 18.6 KB, 4.5 KB gzipped) | Page-scoped `.dmcm-` styles, render-blocking (no late CSS / CLS), WCAG AA colours, 24 px targets |
| `assets/img/dmc-marrakech/` (**new**, 42 files) | Responsive WebP variants + OG card (report 22) |
| `routes/web.php` | `GET /fr/dmc-marrakech` → `DmcController@indexFr`, name `dmc.marrakech.fr`, inside the existing page-cache group |
| `app/Http/Controllers/SitemapController.php` | Adds `/fr/dmc-marrakech` |
| `resources/views/partials/dmc-related.blade.php` | Optional `$relatedHeading`, `$relatedIntro`, `$relatedMore`, `$relatedItems` overrides (defaults unchanged for the 7 other pages) |
| `resources/views/partials/dmc-products.blade.php` | Optional `$curatedTourSlugs` / `$curatedActivitySlugs` (fallback to latest; separate cache keys) and label overrides (defaults unchanged) |
| `resources/views/layouts/app2.blade.php`, `layouts/app.blade.php` | Organization `alternateName` → `["Morocco Quest DMC", "Morocco Quest Tours & Travel"]` (matches logo, Tripadvisor, Instagram, Google Maps) |
| `resources/views/home.blade.php` | (Phase 1) contextual link "DMC in Marrakech" under "Why Choose Morocco Quest" |
| `resources/views/about.blade.php` | Contextual link "destination management company (DMC) in Marrakech" |
| `resources/views/contact.blade.php` | Contextual link "DMC team in Marrakech" for group/MICE requests |
| `resources/views/tours-list.blade.php` | **Marrakech destination page only**: "DMC Marrakech team" link for group/event intent |
| `resources/views/partials/footer.blade.php` | Guard: `if (typeof Toastify !== 'function') return;`. Fixes a pre-existing "Toastify is not defined" JS error after any form submission on pages without Toastify |
| `tests/Feature/DmcMarrakechPageTest.php` (**new**) | 7 tests: lang/canonical/H1, hreflang reciprocity, JSON-LD validity, no FAQPage/AggregateRating, FR URL in the sitemap |

Kept but no longer included on this page: `partials/dmc-guide.blade.php` (content migrated into the content files), `partials/dmc-testimonials.blade.php` and `partials/dmc-world-map.blade.php` (both still used elsewhere or harmless). The guide partial can be deleted after approval.

## 3. Before / after

| Item | Before (live) | After (local) |
|---|---|---|
| Title | Morocco DMC Marrakech \| MICE & Incentive Travel | **DMC Marrakech \| Morocco DMC & MICE \| Morocco Quest** (520 px) · FR: DMC Marrakech \| Agence réceptive & MICE \| Morocco Quest (546 px) |
| Description | Morocco DMC for travel agents… | DMC Marrakech for travel agents, tour operators and MICE planners: white-label ground handling, hotels, transfers and incentives. Quote in 24h. |
| H1 | Morocco DMC & DMC Marrakech – Destination Management & MICE | DMC Marrakech: Destination Management Company for Travel Agents & MICE Planners |
| Languages | EN only | **EN + FR**, reciprocal hreflang + x-default, `<html lang>` per page, visible language switch |
| Hero | CSS background, stock auditorium seats, file misnamed "koutoubia", no alt | `<img>` with srcset, alt text and preload: lantern-lit Moroccan gala dinner |
| Trust content | Unverifiable stats + 4 anonymous testimonials | Company-published facts + links to independent reviews; 15 facts requested (report 19) |
| Destination facts | Unsourced, two wrong numbers | 12 facts, 6 cited sources |
| Case studies | Italic "Example:" lines | Clearly labelled sample formats + a case-study slot that renders only with real cases |
| Mislabelled images on the page | 3 (alt text describing a different picture) | 0 (every image visually checked) |
| Schema | WebSite, TravelAgency, Service, BreadcrumbList, FAQPage | WebSite, TravelAgency (alternateName "Morocco Quest DMC"), **WebPage**, Service (audience, catalogue of 8 offers, languages), BreadcrumbList; FAQPage removed (ineligible) |
| Open Graph image | Generic Aït Benhaddou banner | DMC-specific 1200×630 card with `og:image:alt` |
| HTML size | 362 KB | **171 KB** (EN) |
| DOM elements (Lighthouse) | 1,813 | **1,330** |
| Main-content words | ~3,700 (incl. unverifiable claims) | ~3,000 EN / ~3,350 FR |
| Third-party scripts added | flatpickr (jsDelivr) on this page | **removed** (native date input) |

## 4. Validation results

| Check | Result |
|---|---|
| HTTP | `/dmc-marrakech` 200, `/fr/dmc-marrakech` 200 |
| Title / description / H1 | As above; exactly 1 H1 per page |
| Canonical | Self-referencing on each language |
| hreflang | en ↔ fr + x-default (→ EN) on both pages |
| Robots | `index,follow`; no accidental noindex |
| Sitemap | FR URL added (EN already present) |
| Structured data | All JSON-LD blocks parse; no FAQPage, no AggregateRating (tested). Run Google's Rich Results Test after deploy (needs the public URL) |
| Internal links | 34 unique internal links per page; all resolve except 6 footer activity-category links that 404 **locally only** (local DB lacks them; **200 on live**) |
| Images | 41 `<img>`, all with alt; the page's own images all have width/height (the only exceptions are the pre-existing layout logos) |
| Mobile | iPhone 13 and 1366 px desktop: no horizontal overflow; hero, tiles, tables and form stack correctly |
| JavaScript errors | 0 (after the footer Toastify guard) |
| CTAs | Quote buttons → `#dmc-enquiry`; WhatsApp `wa.me/212654069718` with an EN/FR prefilled text; `tel:` and `mailto:` links; language switch EN ↔ FR |
| Form | Posts to `contact.submit`, redirects back to the same language page, shows the error block in the page language, keeps old input. **A full send was not executed**: local reCAPTCHA is enabled and mail is live SMTP to the sales inbox. Do one real test submission after deploy |
| Tile → guide anchors | Open the right `<details>` topic |
| Mobile menu | Opens (6 visible links) |
| Test suite | **71 passed (389 assertions)**: 64 existing + 7 new |
| Other pages | Home, 7 sister DMC pages, about, contact, tours, activities, destinations: 200, 1 H1, valid JSON-LD |

### Lighthouse (mobile, simulated throttling, local `php artisan serve`, median of 3 runs)

Local absolute numbers are much worse than production (single-threaded dev server; see the project note that local Lighthouse runs about 30 points lower). Compare **before vs after only**.

| Metric | Before (EN) | After (EN) | After (FR) |
|---|---|---|---|
| Performance | 50 | 49 | 42 |
| **Accessibility** | 82 | **100** (final run) | **100** (final run) |
| Best practices | 100 | 100 | 100 |
| SEO | 100 | 100 | 100 |
| LCP | 17.3 s | 15.3 s | 16.2 s |
| CLS | 0 | 0 | 0 |
| TBT | 283 ms | 342 ms | 576 ms* |
| Total transfer | 3,516 KB | 3,283 KB | 3,287 KB |
| DOM elements | 1,813 | 1,330 | 1,330 |

\*FR TBT was dominated by an "Unattributable" 5.4 s long-task block in one run, which looks like local machine noise. The page's own scripts didn't change between EN and FR.

**LCP element:** now the hero `<img>`, preloaded. On the local server the remaining LCP time is "load delay" and "render delay" behind the three render-blocking stylesheets (site-wide purged Bootstrap + theme CSS) and the site-wide preloader overlay. Those are site-wide architecture items (report 06 / perf audit 2026-10-14), not part of this page. Run PageSpeed Insights on production after deploy for real figures (the keyless PSI quota was exhausted during this work).

## 5. Rollback plan

Nothing is committed, so rollback is local:
```bash
# discard the code changes (keeps docs and research)
git checkout -- app/Http/Controllers/DmcController.php app/Http/Controllers/SitemapController.php \
  resources/views/dmc-marrakech.blade.php resources/views/home.blade.php resources/views/about.blade.php \
  resources/views/contact.blade.php resources/views/tours-list.blade.php resources/views/layouts/app.blade.php \
  resources/views/layouts/app2.blade.php resources/views/partials/dmc-products.blade.php \
  resources/views/partials/dmc-related.blade.php resources/views/partials/footer.blade.php routes/web.php
rm -r resources/content/dmc-marrakech assets/img/dmc-marrakech assets/css/dmc-marrakech.css tests/Feature/DmcMarrakechPageTest.php
```
After deployment, revert the commit and redeploy, then `php artisan view:clear && php artisan cache:clear` (the DMC routes use the full-page cache). If `/fr/dmc-marrakech` was indexed, leave it returning 404/410 or 301 it to `/dmc-marrakech`.

## 6. Remaining limitations
- **No Search Console access** for morocco-quest.com (the service account sees only another property): indexing, canonical selection, impressions and queries are **unverified**.
- All page images are **illustrative existing site assets**, not documented MQ events. Their provenance/licence must be confirmed (report 19).
- Company facts in report 19 (licence, volumes, case studies, named contact, memberships, testimonials) are still missing. Those slots are ready.
- The site header/footer/navigation remain English on the FR page (no site-wide i18n exists). The FR page links to English sister pages, labelled "(en anglais)".
- The performance score is limited by site-wide CSS/preloader architecture.
- No ranking change can be promised; measure as in report 23.
