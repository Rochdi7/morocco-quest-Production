# 06 — Technical SEO Audit: /dmc-marrakech

Live checks on 2026-11-24 unless stated. Stack: **Laravel/Blade** (not static HTML as the brief assumed). The page is `resources/views/dmc-marrakech.blade.php`, with metadata set in `app/Http/Controllers/DmcController.php` (SEOTools) and rendered by `layouts/app2.blade.php`. No stack change was made or is needed.

## Summary

| Area | Status | Evidence | Priority |
|---|---|---|---|
| Status code / redirects | OK | 200; http→https and www→apex are single 301s; trailing slash 301 | — |
| Indexability | OK | `index,follow`, no X-Robots-Tag, not blocked in robots.txt | — |
| Canonical | OK | self-referencing absolute URL | — |
| Sitemap | OK | listed in `/sitemap.xml` | — |
| Google-chosen canonical / index state | **UNKNOWN** | Needs GSC URL Inspection; no GSC access for this property | HIGH (access) |
| Cannibalising tag page | Fixed earlier | `/tag/morocco-dmc` is now `noindex,follow` (Semrush still shows it at #20 for "morocco dmc" from an older crawl) | monitor |
| H1 | Fixed now | Exactly 1 H1; rewritten to lead with "DMC Marrakech" | — |
| Heading hierarchy | OK | H1 → 10 H2 → H3 (accordion headers) → H4 in bodies | — |
| Structured data | OK, enriched | WebSite, TravelAgency (global `#organization`), Service, BreadcrumbList, FAQPage. All JSON parses. Service now adds `alternateName`, `audience` (BusinessAudience) and `hasOfferCatalog` | — |
| Image alt | OK | 24/24 live (22/22 local render; product cards depend on DB) | — |
| JS rendering | OK | Title, H1, body, FAQ and links are server-rendered Blade. Accordions are in the DOM (collapsed, not injected) | — |
| HTML weight | WATCH | 362 KB raw HTML (inline world-map SVG partial is 945 lines) | LOW |
| TTFB (warm) | OK | 0.56 s single fetch (competitors 0.95–5.8 s) | — |
| Cold TTFB / stalls | RISK | 2026-10-14 evidence: cold TTFB 11–15 s and connect stalls after idle on the shared host | HIGH (hosting) |
| LCP (lab) | WATCH | ~4.6 s local mobile lab, hero CSS background (2026-10-14). Hero is preloaded with `fetchpriority=high` | MEDIUM |
| Icon fonts | WATCH | FontAwesome Pro ~987 KB on inner pages (subset only on home) | MEDIUM |
| PageSpeed Insights today | NOT MEASURED | Keyless PSI API returned 429 (daily quota). Add a PSI API key to measure | — |
| CrUX field data | NOT AVAILABLE | Not in PSI response history; likely too little traffic | — |
| Edge cache | NOTE | Host returns `X-nginx-cache`, `Cache-Control: max-age=7200`, so changes can take up to 2 h to appear | deploy note |
| Homepage page-cache | NOTE | `CacheGuestPage` (6 h) means the new homepage link only shows after `php artisan cache:clear` on deploy (confirmed locally: the stale cached homepage was served until cleared) | deploy note |
| Mobile layout | OK | Selenium 390×844: H1 wraps to 3 lines, scrollWidth 390 (no overflow). Homepage line verified at 390 and 1366 | — |
| Duplicate content | OK | Explainer `/destination-management-company` has a distinct title/H1/intent; testimonials partial is shared across 8 DMC pages (small, acceptable) | LOW |
| Broken internal links | OK | Covered by the 2026-10-30 crawl (commit 37567cb); no new links except one homepage → /dmc-marrakech | — |

## Issues not fixed in this pass (with reasons)

1. **No GSC access for morocco-quest.com.** The service account in `~/.config/claude-seo/` is attached only to another property. Add the service-account email as a user on the Morocco Quest property (or a Domain property `sc-domain:morocco-quest.com`). Then run URL Inspection on `/dmc-marrakech` and a 90-day query report filtered to `dmc`.
2. **Cold-start TTFB on shared hosting** is a crawl and LCP risk. It's an infrastructure item, outside this page's code.
3. **FontAwesome Pro on inner pages** is a performance project already documented in `docs/reports/seo-audit-2026-10-14/evidence/perf/performance.md`. It's not specific to this keyword.
4. **World-map SVG inlined (945 lines)**: could become an external cached SVG `<img>`. Low SEO impact, and it's a design element, so it was left as is.
