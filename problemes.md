# Morocco Quest — Fix Homepage SEO + PageSpeed to 90+ / 100

## Context
Site: Laravel 10/11, Blade views in `resources/views/`, homepage controller at `app/Http/Controllers/HomepageController.php`, homepage view `resources/views/home.blade.php`. Live URL: https://morocco-quest.com/

Two audits were run and both flag real, fixable issues:
1. **Seobility check**: https://www.seobility.net/en/seocheck/check/?url=https%3A%2F%2Fmorocco-quest.com%2F&mode=standard
2. **PageSpeed Insights** (mobile): https://pagespeed.web.dev/analysis?url=https://morocco-quest.com

Current scores: PSI Mobile Performance **45**, Desktop Performance **61**, Accessibility 95, Best Practices 92-96, SEO 92. Target: **90+ on every PSI category, ideally 100 on Performance/SEO**, and fix the Seobility warnings (title pixel width, meta description length, duplicate anchor texts, too many external links, heading count/H1 keyword mismatch).

## Step 0 — Use Selenium to independently verify current state
Before making changes, write a small Python (or Node/Playwright-in-Selenium-style) script using Selenium WebDriver to:
1. Navigate to `https://www.seobility.net/en/seocheck/check/?url=https%3A%2F%2Fmorocco-quest.com%2F&mode=standard`, wait for the scan to complete, and scrape the full report (title pixel width, meta description pixel width, duplicate anchor texts list, external link count, heading count, H1 vs title keyword overlap).
2. Navigate to `https://morocco-quest.com/` directly, open DevTools/console (via Selenium's `driver.get_log('browser')` or by injecting a script), and:
   - Enumerate all `<a>` tags, group by visible anchor text, and print any anchor text used more than once along with the `href` of each duplicate — this is how you'll find and fix the "some anchor texts used more than once" warning.
   - Enumerate all external `<a>` (href starting with http and not morocco-quest.com), count them, and print them grouped by destination domain — this is the "39 external links" warning; identify which are non-essential (e.g. repeated social icons, badge/logo links in a partners strip) that can be deduplicated, moved to `rel="nofollow"`, or consolidated.
   - Enumerate all `<h1>`-`<h6>` tags in DOM order and print text — this is the "30 headings, not proportional to content" and "H1 keywords not reflected in other headings" warning.
3. Save the scraped results to `docs/reports/seobility_scan_<date>.json` so before/after can be diffed.
4. After making the fixes below, re-run the same script against the local/staging build (or production after deploy) and confirm each flagged item is resolved. Print a clear PASS/FAIL summary per check.

Use `webdriver-manager` or `selenium.webdriver.chrome.service` to auto-manage the chromedriver binary — don't assume it's pre-installed. If Selenium/Chrome isn't available in this environment, fall back to `requests` + `BeautifulSoup` for the static HTML checks (anchors, headings) and note that the live Seobility JS-rendered report couldn't be scraped, then ask the user to paste the report text.

## Step 1 — Fix Seobility on-page issues (homepage: `resources/views/home.blade.php` + `HomepageController.php`)

1. **Title too long (704px, must be <580px)**: Current title in `HomepageController.php:25` is `"Morocco Tours & Private Sahara Desert Trips from Marrakech | Morocco Quest"`. Shorten to something like `"Morocco Tours & Sahara Desert Trips | Morocco Quest"` (~50-55 chars). Keep the primary keyword phrase intact, drop the redundant "from Marrakech" or the brand pipe padding — test with a pixel-width calculator (Roboto/Arial 18px desktop rendering ≈ 580px cutoff, roughly 55-60 characters).
2. **Meta description too long (1002px vs 1000px max)**: Current description at `HomepageController.php:26` is slightly over. Trim by ~5-10 characters, e.g. remove "direct, " or shorten "small group tours & luxury morocco tour packages" to "small-group & luxury tour packages".
3. **H1 doesn't reuse title keywords in subheadings**: Audit `home.blade.php` for H2-H6 tags. Ensure at least one subheading naturally includes "Morocco tours" or "Sahara desert" phrasing (don't force it awkwardly — pick the most natural existing section heading, e.g. a tours or destinations section title).
4. **30 headings is disproportionate to ~968 words**: Count actual `<h1>`-`<h6>` in `home.blade.php`. Many are likely component/card titles (tour cards, activity cards) rendered as `<h3>`/`<h4>` per loop item. Convert repetitive card titles that are purely presentational (not real content sections) to styled `<p class="fw-bold">` or `<span>` with the same visual weight, and keep true heading semantics only for actual page sections (Hero H1, "Featured Tours" H2, "Latest From Blog" H2, etc). Do NOT remove headings that carry real SEO value — only demote structurally-redundant repeated card titles.
5. **Duplicate anchor texts**: From the Selenium scrape in Step 0, find anchor texts like "Read More", "Book Now", "View Details" repeated across multiple cards with different hrefs. Make them accessible/unique by adding visually-hidden context, e.g.:
   ```html
   <a href="{{ route('tour.show', $tour->slug) }}">
     View Details <span class="visually-hidden">for {{ $tour->title }}</span>
   </a>
   ```
   This satisfies both accessibility (screen readers) and the SEO duplicate-anchor-text check without changing visible design.
6. **39 external links, too many**: From the Selenium scrape, identify the external links (likely: social share icons repeated in header+footer, partner/press logos like TripAdvisor/IAGTO/TUI badges, payment badges). Options: (a) add `rel="nofollow noopener"` to non-editorial external links (badges, social icons) so they don't dilute link equity — this doesn't reduce the count but is best practice; (b) if the same external link (e.g. Facebook icon) appears in both header and footer, consider removing the duplicate instance if not essential to UX; (c) consolidate partner-logo strips if any logos link to the same low-value external homepage repeatedly.

## Step 2 — Fix PageSpeed Performance (mobile 45 → 90+, desktop 61 → 90+)

Priority order, by estimated impact from the PSI report:

1. **Render-blocking CSS (Est savings 450ms)**: `assets/plugins/bootstrap.min.css` (48.2 KiB) and `assets/css/style.min.css` (48.1 KiB) block first render.
   - Inline critical above-the-fold CSS in `<head>` (extract via a critical-CSS tool like `critical` npm package or manually for the hero section) and defer the rest with `<link rel="preload" as="style" onload="this.rel='stylesheet'">` + `<noscript>` fallback.
   - Check if the full Bootstrap CSS is needed or if only a subset of utility classes are used — consider a purged/custom build.

2. **LCP is 12.5s (target <2.5s) — biggest single problem.** LCP element is the hero background image `ait-benhaddou-*.webp` set via inline `background-image` on a `<section class="hero-layout1">`.
   - CSS `background-image` cannot be preloaded efficiently and delays LCP. Convert the hero to a real `<img>` element (or add `<link rel="preload" as="image" href="...ait-benhaddou....webp" fetchpriority="high">` in `<head>` if kept as background) so the browser discovers it immediately instead of after CSS parses.
   - Add `fetchpriority="high"` to the hero image tag.
   - Resource load delay (490ms) + duration (850ms) + render delay (740ms) — reducing render-blocking CSS (item 1) directly cuts the "resource load delay" portion since the image is currently discovered late (it's referenced inside the blocked CSS/inline style).

3. **Unused/oversized images — Est savings 277 KiB total**. In `resources/views/home.blade.php` (and wherever tour/activity cards are rendered), for each `<img>`:
   - Add explicit `srcset`/responsive sizes so images aren't served at 2-3x their displayed size (e.g. the 960x641 tour image displayed at 676x451 wastes 97 KiB; the logo displayed at 228x73 but served at 478x154).
   - Re-encode WEBP images at higher compression (target ~80% quality) for the flagged tour/activity images — check `app/Http/Controllers/*` or wherever image upload/processing happens (likely `Intervention/Image` or similar) and see if a resize-on-upload step exists; if not, generate properly-sized derivatives (e.g. via a Laravel image optimization package or `spatie/laravel-image-optimizer`) rather than serving originals.
   - This applies sitewide, not just homepage — check `tours-list.blade.php`, `activity-categories.blade.php` too since they likely reuse the same card partials.

4. **Forced reflow from GSAP/ScrollTrigger/SplitText** (`assets/js/gsap.min.js`, `ScrollTrigger.min.js`, `SplitText.min.js`, `main.js`): these read layout properties (offsetWidth etc.) causing reflow during animation setup.
   - Defer GSAP init until after `DOMContentLoaded` / move to `window.load` if it's currently running eagerly and blocking.
   - Consider lazy-initializing ScrollTrigger/SplitText only for elements actually in/near viewport rather than the whole page on load.
   - Load these third-party animation libs with `defer` (confirm `<script>` tags in the layout already use `defer`; if not add it).

5. **Third-party scripts (1,097 KiB Google reCAPTCHA + 273 KiB GTM = biggest 3rd-party cost, 612ms + 219ms main-thread time)**:
   - reCAPTCHA (`www.gstatic.com/recaptcha/...`) — only load it on pages/forms that actually need it (contact form), not injected sitewide via a shared layout. Check `resources/views/contact.blade.php` and the main layout for where the recaptcha script tag lives; if it's in a shared header/footer partial, move it to load only when the contact form component renders, and load it lazily (on form focus/interaction) rather than eagerly on page load.
   - Google Tag Manager (`gtag/js` + `gtm.js`) — load with `defer` or delay via a "load on user interaction / after 3s idle" pattern (many perf-focused sites delay GTM until first scroll/click/timeout using a small idle-load snippet) since analytics doesn't need to block LCP.

6. **Cache lifetimes (Est savings 14 KiB, minor)**: Some third-party badge images (cdnlogo.com IAGTO/TripAdvisor svgs) have no cache TTL set — this is on the third-party's server, not fixable directly, but consider self-hosting these static partner-logo SVGs instead of hotlinking `static.cdnlogo.com`, which also removes an external DNS/connection cost.

7. **Font display**: add `font-display: swap` to any `@font-face` declarations for the self-hosted Rubik/Roboto fonts (check `assets/css/style.min.css` source or the SCSS source if present) — minor (30ms) but free.

## Step 3 — Verify
1. Re-run the Selenium script from Step 0 against the deployed changes and confirm: title <580px, description <1000px, no duplicate anchor text without unique accessible labels, external link count reduced/nofollowed, heading count reduced to something proportional (~10-15 for ~968 words), H1 keywords echoed in at least one subheading.
2. Run PageSpeed Insights again (mobile + desktop) on `https://morocco-quest.com/` and confirm Performance ≥90 on both, and Accessibility/Best Practices/SEO stay ≥95 (don't regress them while fixing performance).
3. Do NOT test only on localhost — Laravel apps often behave very differently in production (real CDN, real image sizes, real network). If changes are tested locally first, still do a final production PSI + Seobility check after deploy before declaring done.
4. Report before/after scores in a short table.

## Constraints
- Don't remove real content or gut the animations entirely — the goal is deferred/optimized loading, not deleting the GSAP hero effects.
- Don't touch unrelated pages unless the same img/component partials are shared (in which case fixing the partial fixes all pages using it — call that out explicitly rather than silently).
- Keep all changes to `resources/views/*.blade.php`, `app/Http/Controllers/HomepageController.php`, `public/assets/**` (CSS/JS), and image processing config only — no schema/DB changes needed for this task.
</content>
