# 23 — Final Action Checklist

State on 2026-11-25:
- Implementation complete **locally**.
- Nothing committed, pushed or deployed.
- Live site unchanged.

## 1. Completed (local, validated)

- [x] `/dmc-marrakech` rebuilt to the 15-section blueprint (report 16), with copy in `resources/content/dmc-marrakech/en.php`
- [x] **French page `/fr/dmc-marrakech`**: localised copy, title, description, H1, `lang="fr"`, canonical, reciprocal hreflang (en/fr/x-default), language switch, sitemap entry
- [x] Title / description / H1 lead with "DMC Marrakech"; secondary keywords placed in context (Marrakech DMC, Morocco DMC, destination management company, MICE, incentive travel, corporate events, team building; FR: séminaire, agence réceptive, voyages incentive, organisation d'événements)
- [x] Hero: real `<img>` with srcset + preload, two CTAs (quote, WhatsApp B2B)
- [x] Verified facts bar (company-published facts only); unverifiable claims and anonymous testimonials removed from this page
- [x] 8 service tiles + 8-topic services guide with internal links to all sister DMC pages
- [x] Marrakech planner facts with 6 cited sources; two wrong numbers corrected
- [x] Sample programmes labelled as illustrative; case-study and membership slots ready (hidden until filled)
- [x] Buyer's checklist, 6-step process, quote form (same backend contract), B2B desk card, independent review links, 10-question FAQ
- [x] Schema: WebPage, Service (audience + 8-offer catalogue), BreadcrumbList; Organization `alternateName` "Morocco Quest DMC"; FAQPage removed (ineligible); no ratings markup
- [x] DMC-specific 1200×630 OG/Twitter card
- [x] 42 responsive WebP variants; every image visually checked; 8 mislabelled/branded images avoided (report 22)
- [x] Contextual internal links from home, /about, /contact and the Marrakech destination page
- [x] Footer "Toastify is not defined" JS error fixed site-wide (guard)
- [x] **P0-6** incorrect code comment replaced with the verified baseline
- [x] Accessibility 82 → **100** (Lighthouse, EN and FR); HTML 362 → 171 KB; DOM 1,813 → 1,330
- [x] Tests: **71 passed** (7 new); 15 pages regression-checked; 0 JS errors; no horizontal overflow on mobile
- [x] Screenshots: `evidence/phase3/screenshots/` (full pages EN/FR × desktop/mobile) and `…/sections/` (64 section shots)
- [x] Reports 19–23 written; roadmap (17) updated

## 2. Needs your approval, then deployment (exact steps)

```bash
# 1. Review
git status
git diff --stat
git diff app/Http/Controllers/DmcController.php resources/views/dmc-marrakech.blade.php
php artisan test                                   # expect 71 passed

# 2. Commit on a branch (as your own account, no AI attribution)
git checkout -b seo/dmc-marrakech-phase3
git add app/Http/Controllers/DmcController.php app/Http/Controllers/SitemapController.php \
        routes/web.php resources/views/dmc-marrakech.blade.php resources/content/dmc-marrakech \
        resources/views/partials/dmc-products.blade.php resources/views/partials/dmc-related.blade.php \
        resources/views/partials/footer.blade.php resources/views/layouts/app.blade.php \
        resources/views/layouts/app2.blade.php resources/views/home.blade.php resources/views/about.blade.php \
        resources/views/contact.blade.php resources/views/tours-list.blade.php \
        assets/css/dmc-marrakech.css assets/img/dmc-marrakech tests/Feature/DmcMarrakechPageTest.php \
        docs/seo/dmc-marrakech-benchmarking
#   Decide first whether to include ~51 MB of evidence screenshots in git
#   (evidence/phase2 ≈ 37 MB of PNGs, evidence/phase3 ≈ 14 MB of JPEGs).
#   docs/reports/COMPETITOR_*_2026-11.md are not part of this work.
git commit -m "seo: DMC Marrakech page rebuild + French version (/fr/dmc-marrakech)"
git push -u origin seo/dmc-marrakech-phase3      # then merge to main per your usual flow

# 3. On the production server after the code is live
php artisan route:clear     # new route /fr/dmc-marrakech (also route:cache if you use it)
php artisan view:clear
php artisan cache:clear     # REQUIRED: /dmc-marrakech and the homepage use the full-page cache
# purge the host edge cache (Cache-Control max-age=7200) in the hosting panel, or wait ~2 h

# 4. Smoke test on production
curl -sI https://morocco-quest.com/dmc-marrakech     | head -1   # 200
curl -sI https://morocco-quest.com/fr/dmc-marrakech  | head -1   # 200
curl -s  https://morocco-quest.com/sitemap.xml | grep -c "fr/dmc-marrakech"   # 1
```
Then in a browser:
1. Submit **one real enquiry** from each language page (to confirm the reCAPTCHA + SMTP path), and check the sales inbox.
2. Run **Rich Results Test** and **PageSpeed Insights** (mobile and desktop) on both URLs and record the numbers in report 21.

## 3. Requires your business information (report 19)
- [ ] F1 Tourism licence number + legal entity (**P0**)
- [ ] F5 2–3 real case studies with permission and photos (**P0**)
- [ ] F15 Google Business Profile access, category, rating (**P0**)
- [ ] F2 RC/ICE + liability insurance
- [ ] F3 Start year of DMC activity · F4 2025 volumes
- [ ] F6 Original programme photos (replace the illustrative hero first)
- [ ] F7 Named B2B contact (name, role, photo, consent)
- [ ] F8 Attributable testimonials · F14 Guides' consent
- [ ] F9 Memberships/certifications · F10 Client logos · F11 Venues actually used
- [ ] F12 Confirm payment terms/currencies wording · F13 Client non-solicitation policy
- [ ] Confirm licences for all 21 reused site images (report 22)

## 4. Requires external approval
- [ ] **Visit Marrakech MICE / CRT Marrakech-Safi DMC directory** listing (report 20 §B). Do not claim it until approved
- [ ] Google Business Profile edits (report 20 §A), with no duplicate profile and no keyword-stuffed name
- [ ] Tripadvisor listing completion (website link, description)
- [ ] Network memberships (Global DMC Partners, DMC Network, Euromic) when eligible

## 5. Requires Google Search Console access
Current state: the configured service account (`~/.config/claude-seo/service_account.json`) has access **only** to `https://www.local-morocco-tours.com/`. **Nothing about morocco-quest.com indexing has been verified.**

To enable:
1. In Search Console for **morocco-quest.com** (Domain property `sc-domain:morocco-quest.com` preferred) → Settings → Users and permissions → Add user → the service account's `client_email` → Full (or Restricted for read-only).
2. Then the following can run:
   - URL Inspection for both URLs: indexing state and Google-selected canonical.
   - 90-day Search Analytics filtered on `page contains dmc-marrakech` and `query contains dmc`: impressions, clicks, CTR, average position.
   - A cannibalisation check: queries where `/destination-management-company`, `/tag/morocco-dmc` or the homepage receive "dmc" impressions.

After deploy (manual, in the GSC UI):
- [ ] URL Inspection → **Request indexing** for `https://morocco-quest.com/dmc-marrakech` and `https://morocco-quest.com/fr/dmc-marrakech`
- [ ] Resubmit `https://morocco-quest.com/sitemap.xml`
- [ ] After 7–14 days: check that the FR page shows "User-declared canonical = Google-selected canonical" and that hreflang shows no errors

## 6. Requires external backlinks or partnerships (report 20 §C)
- [ ] Partner agencies / tour operators → "our Morocco ground partner" links to `/dmc-marrakech`
- [ ] Hotels, riads, camps and venues booked regularly → partner/case-study mentions
- [ ] Cvent Supplier Network profile; dmcfinder / 1dmcworld / dmc.inside.travel profiles (vetted, not pay-to-list)
- [ ] Trade press story once a real case study exists (FR: TourMaG, DéplacementsPros, Voyages d'Affaires; EN: TravelDailyNews, Travel Courier)
- [ ] Two supporting blog posts ("How to choose a DMC in Marrakech", "Marrakech MICE facts for planners") linking to both language pages

## 7. Monitoring (what to measure, no promised outcome)

| KPI | Tool | Baseline (2026-11-24) | Cadence |
|---|---|---|---|
| Organic position, "dmc marrakech" (Google MA, desktop) | `scripts/serp-audit` focused 2-page check × 3 runs (report 18) | #15 / #18 / #15 | Every 2 weeks |
| Position, "dmc marrakech" (Google FR / fr) and "séminaire marrakech" | Same method with `gl=fr`, `hl=fr` | Not measured | Monthly from 4 weeks after deploy |
| Map pack / AI Overview presence | Same SERP capture | Absent | Every 2 weeks |
| Impressions / clicks / CTR / position for queries containing "dmc" | GSC (after access) | Unknown | Weekly |
| Indexed + canonical for both URLs | GSC URL Inspection | Unknown | After deploy, then monthly |
| Non-spam referring domains to the two URLs | Semrush URL backlinks | 0 | Monthly |
| GBP reviews / rating | GBP | Owner to report | Monthly |
| B2B enquiries by `page_source` (`dmc-marrakech`, `dmc-marrakech-fr`) | Contact logs / GA4 | Owner to report | Monthly |
