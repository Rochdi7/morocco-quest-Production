# Performance / rendering / mobile evidence - morocco-quest.com - 2026-10-14

Status: PARTIAL. Section 1 (lab, headers, TTFB) done. Section 2 (raw vs rendered) and Section 3 (mobile) NOT MEASURED: the rendering script was interrupted by intermittent connection timeouts, then the coordinator asked for this file first. Raw HTML for 5 URLs is saved in the scratchpad (/tmp/sp/raw1-5.html) but not yet compared.

## 0. Data sources and limits
- Field data (CrUX via PSI): NOT AVAILABLE. Anonymous PSI call returned HTTP 429 (daily quota). Not retried. PSI lab median-of-3 for / and /dmc-marrakech: NOT MEASURED. CrUX history: NOT MEASURED (no API key).
- Lab numbers are "local lab": Playwright/Chromium on a laptop, 390x844 mobile viewport, CDP throttling 150ms RTT / 1.6 Mbps / 4x CPU, fresh browser context per URL. They are NOT Core Web Vitals and not comparable to PSI scores. Use for element identification and relative comparison only. TBT is approximated from long tasks after FCP and is inflated by the 4x CPU throttle.
- Lighthouse CLI not installed; not run.
- Raw per-request data: evidence/perf/lab_raw.json.

## 1. Lab results (local lab, mobile emulation)
| URL | FCP ms | LCP ms | LCP element | CLS | TBT~ ms | Transfer KB (reqs) | Font KB | Notes |
|---|---|---|---|---|---|---|---|---|
| / | 3424 | 4368 | hero section bg (ait-benhaddou-...-mobile.webp, 56KB, preloaded) | 0.00 | 7107 | 1131 (61) | 67 | FA Pro not loaded; icon subset 1KB; GTM 116KB; 1351 DOM nodes |
| /tours | 1976 | 1976 | IMG logo-white.bg.webp (PRELOADER logo) | 0.003 | 4245 | 1983 (47) | 987 | FA Pro brands+solid+light |
| /dmc-marrakech | 3244 | 4620 | hero section bg (koutoubia-dmc-hero.webp, 98KB) | 0.00 | 5731 | 2150 (46) | 987 | HTML 113KB gz; 1965 DOM nodes |
| /experiences | 7604* | 8592* | P.hub-intro-text | 0.005 | 3879 | 2002 (46) | 640 | *TTFB 1036ms this run, noisy; first run LCP was the logo at 1368ms |
| /destinations/marrakech | 3484 | 3484 | IMG preloader logo | 0.001 | 4822 | 1957 (46) | 987 | |
| tour: /tours/royal-cities-of-morocco-6-day-luxury-imperial-cultural-tour | 3396 | 3396 | IMG preloader logo | 0.002 | 2972 | 3160 (64) | 1799 | Google Maps JS + tiles ~476KB; 27 scripts, 824KB |
| activity: /activities/magical-hot-air-balloon-ride-over-marrakech-with-berber-breakfast | 3264 | 3264 | IMG preloader logo | 0.009 | 5165 | 3217 (62) | 1799 | Maps loaded without interaction (14 maps requests) |
| blog: /blog/top-10-unforgettable-experiences-to-have-in-morocco | 3448 | 3448 | IMG preloader logo | 0.000 (0.111 in first run) | 3002 | 2346 (60) | 1403 | gravatar 404 |

On 6 of 8 sampled URLs the LCP candidate is still the full-screen preloader logo (/assets/img/logo-white.bg.webp), as in the 2026-09-28 audit. Home and /dmc-marrakech now report the real hero.

### Findings
1. Preloader overlay (.preloader, z-index 9999) covers every page; inline script force-hides it 1500ms after CSS-ready (0.5s fade), main.js hides it ~800ms after load. The logo img has fetchpriority=high and becomes LCP on inner pages; users see a dark screen for >=1.5s. Medium-High.
2. FontAwesome Pro still loaded on all inner pages: 640-987KB on listing pages, 1.4-1.8MB on tour/activity/blog (fa-light 455KB, fa-regular 416KB, fa-sharp-light 396KB, fa-solid 347KB, fa-brands 117KB). The icon subset was applied only on home (fonts 67KB). woff2 + immutable cache, so repeat views are cheap. High for first visit.
3. Stylesheets in head: 11 on home, 13-14 on inner pages (bootstrap, style.min, fontawesome.min render-blocking; plugin CSS uses preload/onload swap). No blocking head scripts detected.
4. Google Maps JS API loads without interaction on tour and activity pages: ~400KB, 14 requests plus gstatic 75KB. The "lazy maps" fix is not evident in this test. Medium. A browser Maps key (AIzaSy...) is visible in tile URLs (normal); referrer restriction not verifiable here.
5. Third parties: GTM/gtag 116KB (loaded via requestIdleCallback, 3s timeout - good); ahrefs analytics 3KB (home); jsdelivr 19KB (inner pages); Google Maps; gravatar (blog, 404 avatar). Home enquiry form has g-recaptcha markup but no recaptcha script request was seen on home.
6. Compression: HTML, CSS, JS, fonts are gzip only. No Brotli on own origin even when requesting br (third parties serve br). Low-Medium.
7. Caching: own CSS/JS/fonts/images are public, max-age=31536000, immutable (good). HTML carries two Cache-Control headers (no-cache, private AND max-age=7200), an Expires header, Set-Cookie XSRF-TOKEN and morocco_quest_session on cacheable HTML, and an X-nginx-cache: WordPress header on a Laravel site. Conflicting directives and cookies on public HTML make cache behaviour ambiguous. Medium.
8. Images: sampled images are webp, apart from one PNG (assets/img/bg/destination.png, 49KB on home) and one JPG (blog 7b.jpg, 100KB). Largest heroes 56-170KB. Home has 30 image requests (555KB). Home has a malformed srcset (console warnings "Dropped srcset candidate .../blogs/Tangier" - unencoded filename). Low.
9. CLS: <=0.01 everywhere except one blog run at 0.111 (not reproduced). Possible intermittent shift; needs field data. Low.
10. Console/network: srcset warnings (home); gravatar 404 (blog); gtag/js ERR_BLOCKED_BY_ORB on every page in headless (probable automation artefact, unconfirmed). No 4xx/5xx on own origin among the 8 sampled pages. Console errors for the mobile viewport set: not measured separately (the lab run above was mobile-emulated, so these are the mobile results).

## 1b. TTFB (curl)
| Case | Result |
|---|---|
| / warm | 0.42-0.46 s |
| /tours, /dmc-marrakech, /experiences warm | 0.43-0.49 s |
| /destinations/marrakech, tour detail warm | 0.46-0.52 s |
| / cold (after idle) | 15.5 s TTFB (earlier brief: 11 s) |
| first requests after idle (5-URL fetch) | connect times 3.1 s, 7.1 s, 7.2 s, 15.2 s; two connect timeouts (20 s, 60 s); one connection reset |
Query-string cache-busting did not produce a cold response (~0.46 s), so true cold TTFB was observed only after idle expiry. Warm TTFB ~0.45 s is above the 0.2 s guidance but acceptable; cold hits and intermittent connection stalls (3-15 s connect, timeouts, resets) are a serious LCP/crawl risk. Cause (host load, rate limiting of my own requests, cache expiry) not determined. HIGH.

## 2. Rendering: raw HTML vs rendered DOM - NOT MEASURED
Planned for /, /dmc-marrakech, tour, activity, blog (script /tmp/sp/rend.py). Partial facts from raw home HTML: title/H1/links are server-rendered (Blade); 2 tel:+212654069718 links, a wa.me/212654069718 floating WhatsApp button, and an enquiry form with CSRF token and g-recaptcha markup are in raw HTML. JSON-LD counts, word counts, accordion/tab hidden content: not measured.

## 3. Mobile 390x844 - NOT MEASURED
Not done: screenshots (none written to evidence/screenshots), visual preloader timing, mobile menu link list, tap targets, horizontal overflow, cookie banner, visible contact paths on tour pages. Indirect: preloader force-hide at 1500ms; .vs-menu-wrapper mobile menu exists in markup; no cookie banner seen in home HTML grep (not verified visually).

## 4. Versus prior audit (2026-09-28 section K)
- Home: LCP element is now the preloaded hero; icon subset effective (67KB fonts vs ~1MB). Improved.
- /dmc-marrakech: LCP element is now the hero image (local lab 4.6s throttled; not comparable to PSI 11.97s). Improved.
- Inner pages: LCP still preloader logo; FA Pro still 0.6-1.8MB. Not fixed.
- Maps: still loaded without interaction on tour/activity. Not confirmed fixed.
- CrUX/PSI field data: still unavailable.
