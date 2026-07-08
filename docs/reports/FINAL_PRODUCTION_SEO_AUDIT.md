# Morocco Quest — Final Production SEO Audit
**Date:** July 8, 2026 | **Status:** Post-Implementation | **Branch:** main

---

## Executive Summary

Morocco Quest's SEO architecture is **functionally complete but not production-ready**. All critical infrastructure is in place: canonical URLs, structured data on every page, meta tags populated, sitemap, robots.txt, and mobile-responsive design. However, five systemic bugs and several content gaps prevent the site from performing at its potential.

**Overall Score: 63/100**

| Dimension | Score |
|---|---|
| Technical SEO | 71/100 |
| Content SEO | 69/100 |
| Schema / Structured Data | 60/100 |
| GEO (AI Search Visibility) | 73/100 |
| AEO (Answer Engine Optimization) | 61/100 |
| Local SEO | 41/100 |
| Performance (CWV) | ~65/100 (estimated, no CrUX data) |
| Image SEO | 55/100 |
| Crawlability | 78/100 |
| Indexability | 82/100 |
| Internal Linking | 74/100 |
| **OVERALL** | **63/100** |

---

## Is Morocco Quest Production-Ready?

**No — with two asterisks.**

The site can be indexed and will rank for long-tail queries today. However, five bugs listed below will actively suppress ranking potential, degrade social share quality, and produce incorrect structured data results in Google Search Console. These are not cosmetic issues — they affect how Google and AI crawlers understand and represent the site.

**Is the SEO architecture complete?** Yes, structurally. The framework (SeoHelper, per-model SEO fields, canonical strategy, schema types per page type) is solid and extensible. The gaps are content-level and bug-level, not architecture-level.

---

## What Prevents 100/100

1. **Duplicate schema blocks** — every detail page emits two `@type` blocks (one from content layer, one from SEOTools JsonLd). Google deduplicates but flags as ambiguous.
2. **FAQPage mainEntity is empty** — the FAQ schema on the homepage exists but has no questions. Silently fails rich result eligibility.
3. **No GBP claim confirmed** — Local SEO score is anchored by a missing or unverified Google Business Profile. This alone accounts for ~15 lost Local SEO points.
4. **No AggregateRating schema** — All tour and activity pages are missing star ratings. This is the highest-impact missing schema for conversion and click-through rate in travel.
5. **Twitter/OG double-encoded entities** — social share cards display `&amp;amp;` as literal text on every share from the homepage.
6. **Thin content on money pages** — the Hot Air Balloon activity page (~534 words) and the Agafay vs Sahara blog (~923 words) are below content floor.
7. **Heading hierarchy failures** — Blog 5 (Morocco Safety) has H1→H3 with no H2. Tours listing has zero H2s.
8. **No hreflang** — site targets English-speaking travelers globally but has no language/region signals.
9. **No WebSite schema sitewide** — search engines cannot surface a sitelinks search box.
10. **og:type mismatches** — tour pages claim `article`, blog pages claim `website` (inverted).

---

## Issues by Severity

### P0 — Fix Immediately (Production Bugs)

#### 1. Duplicate Schema Blocks on Every Detail Page
- **Severity:** Critical
- **Affected URLs:** All tour detail pages, all activity detail pages, all blog detail pages
- **Root Cause:** Artesaos SEOTools `JsonLd` facade emits a second JSON-LD block with the same `@type` as the richer content-layer block in each Blade template. Both blocks render in `<head>`.
- **Impact:** Google may ignore one block or flag schema errors in Search Console. Rich result eligibility compromised on all detail pages.
- **Fix:** Disable SEOTools JsonLd output entirely, or remove the `@push('jsonld')` blocks and rely only on SEOTools. Disabling SEOTools JsonLd is cleaner: in `config/seotools.php` add `'json-ld' => ['defaults' => ['type' => false]]`, then remove `JsonLd::` calls from all controllers.
- **Type:** Code
- **Effort:** 2–4 hours

#### 2. FAQPage mainEntity Is Empty
- **Severity:** Critical
- **Affected URLs:** `/` (homepage)
- **Root Cause:** FAQPage schema is declared but no `mainEntity` (Question/Answer pairs) are populated.
- **Impact:** FAQPage rich result will never trigger. Google will eventually flag as invalid schema.
- **Fix:** Add real Q&A pairs to the schema — at least 4 questions. Preferably pulled from FAQ content already on the page.
- **Type:** Code + Content
- **Effort:** 1 hour

#### 3. Twitter/OG Double-Encoded Entities on Homepage
- **Severity:** Critical
- **Affected URLs:** `/` (homepage) — affects every social share
- **Root Cause:** The `&` in the site name is being HTML-encoded twice, producing `&amp;amp;` which renders as `&amp;` in social preview cards.
- **Impact:** Every homepage share on Twitter/X, Facebook, WhatsApp shows "Morocco Tours &amp; Private Sahara Desert Trips" — visually broken brand name.
- **Fix:** Locate the OG/Twitter title in the template or config where `&` is being escaped and use raw (unescaped) output. In Blade: use `{!! !!}` instead of `{{ }}` for these meta values, or decode at the config level.
- **Type:** Code
- **Effort:** 30 minutes

#### 4. og:type Inversion Across Page Types
- **Severity:** High
- **Affected URLs:** Tour 1 (tour page claims `article`), Blogs 4/5/6 (blog pages claim `website`)
- **Root Cause:** og:type is either hardcoded incorrectly or inherited from a wrong default.
- **Impact:** Social crawlers (Facebook, LinkedIn) serve wrong content type, affecting how shares are rendered.
- **Fix:** Set `og:type="product"` or `"service"` on tour/activity pages; `og:type="article"` on blog pages. One-line conditional in the OG meta template.
- **Type:** Code
- **Effort:** 30 minutes

---

### P1 — High Priority (Ranking Impact)

#### 5. No AggregateRating Schema on Tours and Activities
- **Severity:** High
- **Affected URLs:** All 8 tour pages, all 23 activity pages
- **Impact:** Without star ratings in schema, pages cannot earn gold star snippets in SERPs. This is the highest-CTR schema element in travel. Competitors with AggregateRating consistently outperform on click-through even at lower positions.
- **Fix:** Add TripAdvisor or internal review data as `AggregateRating` within each TouristTrip/TouristAttraction schema block. If no review system exists, implement a minimal review widget and collect reviews before adding schema.
- **Type:** Code + Content + Marketing
- **Effort:** 1–2 weeks (requires review system or data)

#### 6. Tour H1/Title Mismatches
- **Severity:** High
- **Affected URLs:** Tour 1 (title drops "5-Day"), Tour 2 (title drops "Imperial")
- **Impact:** Google uses title tag and H1 as primary relevance signals. Dropping exact-match keywords from one but not the other creates inconsistency. Lost keyword coverage for "5-day sahara tour" and "imperial tour morocco" queries.
- **Fix:** Align `seo_title` field values to match H1 phrasing. Update in Filament admin.
- **Type:** Content
- **Effort:** 30 minutes

#### 7. Tours Listing Page — Thin Content and No H2s
- **Severity:** High**
- **Affected URL:** `/tours`
- **Current state:** ~408 stripped words, zero H2 headings, meta description 178 chars (over limit).
- **Impact:** Google may classify as thin category page. No crawlable editorial signal for "morocco tour packages" query.
- **Fix:** Add 250–350 word introductory section, add 2–3 H2 category headings, shorten meta description to ≤155 chars.
- **Type:** Content
- **Effort:** 2 hours

#### 8. Blog 5 (Morocco Safety 2026) — Broken Heading Hierarchy
- **Severity:** High
- **Affected URL:** `/blog/is-morocco-safe-for-american-travelers-2026` (slug approximate)
- **Current state:** H1 jumps directly to H3 — no H2 exists on the page.
- **Impact:** WCAG accessibility failure. Google cannot construct topic hierarchy. Hurts ranking on YMYL (safety) query.
- **Fix:** Promote all H3 section headings to H2, or add grouping H2 headings above them. Add ≥2 citations to US State Dept / FCDO Morocco pages.
- **Type:** Content
- **Effort:** 1 hour

#### 9. Blog 6 (Agafay vs Sahara) — Thin Content
- **Severity:** High
- **Affected URL:** `/blog/agafay-vs-sahara` (slug approximate)
- **Current state:** ~923 stripped words, only 3 H2s, no factual comparison data (distances, drive times, costs, seasons).
- **Impact:** This is a competitive comparison query. Competing pages at 2,000–2,500 words with data tables will outrank it. High AI-content-perception risk.
- **Fix:** Expand to 2,000+ words. Add: Agafay distance (40 km, ~45 min from Marrakech), Merzouga distance (560 km, ~9 hours), specific camp names, seasonal comparison table, price range comparison.
- **Type:** Content
- **Effort:** 3–4 hours (Mounir to write)

#### 10. Activity: Hot Air Balloon Page — Thin Content and Title Missing Key Differentiator
- **Severity:** High
- **Affected URL:** `/activities/hot-air-balloon-marrakech` (slug approximate)
- **Current state:** ~534 stripped words. Title drops "Berber Breakfast."
- **Impact:** Below content floor for a paying product page. "Berber Breakfast" is a unique selling point and searchable modifier; its absence from the title loses query coverage.
- **Fix:** Expand to 900+ words: pre-flight logistics, safety/equipment, pilot credentials, breakfast details, best time of year, cancellation policy. Update `seo_title` to include "Berber Breakfast."
- **Type:** Content
- **Effort:** 2 hours (Mounir to write)

---

### P2 — Medium Priority (Visibility and Trust)

#### 11. No WebSite Schema Sitewide
- **Severity:** Medium
- **Impact:** Google cannot surface the sitelinks search box. Missed brand SERP real estate.
- **Fix:** Add `WebSite` schema with `SearchAction` potentialAction to homepage controller.
- **Type:** Code
- **Effort:** 1 hour

#### 12. Place Filter Pages Missing Canonical and Robots Meta
- **Severity:** Medium
- **Affected URLs:** `/tours/place/*`
- **Impact:** Place filter pages are potentially duplicate content with identical H1s. Without noindex or canonical pointing to the parent tours page, Google may index thin filter pages.
- **Fix:** Add `SeoHelper::noindex()` to the place filter controller, or set canonical to `/tours`.
- **Type:** Code
- **Effort:** 1 hour

#### 13. &nbsp; in Activity TouristAttraction JSON-LD Description
- **Severity:** Medium
- **Affected URLs:** Multiple activity detail pages
- **Impact:** HTML entity inside JSON-LD is technically invalid. Google may not parse the description correctly for rich results.
- **Fix:** Strip HTML entities from description before passing to schema. Use `html_entity_decode(strip_tags($description))` in the schema population layer.
- **Type:** Code
- **Effort:** 30 minutes

#### 14. Blog OG Image URL Contains Literal Space
- **Severity:** Medium
- **Affected URL:** One or more blog detail pages
- **Root Cause:** Image filename contains a space: `luxury sahara desert camp morocco sunset.jpg`. URL is not encoded.
- **Impact:** OG image will fail to load in social previews (HTTP 404 on the image).
- **Fix:** Rename the file to use hyphens, update the DB record, or URL-encode the filename in the image accessor.
- **Type:** Code + Content
- **Effort:** 30 minutes

#### 15. Twitter Cards Show Homepage Defaults on All Interior Pages
- **Severity:** Medium
- **Affected URLs:** All interior pages
- **Root Cause:** Twitter meta is being set via `OpenGraph::addProperty()` in `SeoHelper::setCollection()` and `setDetail()` but the `<meta name="twitter:*">` tags may not be rendering these values due to how Artesaos SEOTools separates Twitter from OG output.
- **Impact:** When someone shares any tour, activity, or blog on Twitter/X, the card shows the site-wide default title/description/image instead of the page-specific content.
- **Fix:** Use `SEOTools::metatags()->addTwitterMeta()` or the dedicated Twitter facade if available. Verify in HTML source that `name="twitter:title"` on a detail page shows the page title, not the config default.
- **Type:** Code
- **Effort:** 1–2 hours

#### 16. Tour ID 5 Name Contains Mojibake (U+FFFD)
- **Severity:** Medium
- **Impact:** Replacement character in tour name may appear in schema output and page title.
- **Fix:** Run `DB::table('tours')->where('id',5)->update(['name' => 'correct name here'])` in Tinker. Verify current value first.
- **Type:** Content
- **Effort:** 15 minutes

#### 17. Homepage Title Tag Too Long (~75 chars)
- **Severity:** Medium
- **Affected URL:** `/`
- **Impact:** Google truncates at ~60 chars in SERPs. "from Marrakech | Morocco Quest" is cut.
- **Fix:** Shorten to: `Morocco Tours & Sahara Desert Trips | Morocco Quest` (52 chars).
- **Type:** Content
- **Effort:** 15 minutes (update config default or homepage controller)

#### 18. Homepage Meta Description Too Long (~163 chars)
- **Severity:** Medium
- **Affected URL:** `/`
- **Impact:** Truncated in SERPs at ~155 chars.
- **Fix:** Trim to 150–155 chars, ending on a complete sentence.
- **Type:** Content
- **Effort:** 15 minutes

#### 19. All Meta Descriptions Missing CTA Verbs
- **Severity:** Medium
- **Affected URLs:** All 8 audit pages
- **Impact:** Passive descriptions reduce CTR vs. competitors using "Book now," "Start planning," "Explore."
- **Fix:** Rewrite meta descriptions to end with a CTA: "Book your private tour today." or "Start planning — free consultation."
- **Type:** Content
- **Effort:** 2 hours (all pages)

---

### P3 — Local SEO (Requires Marketing Action)

#### 20. No Confirmed Google Business Profile
- **Severity:** Critical for Local
- **Affected URLs:** All
- **Impact:** Without a GBP listing, Morocco Quest cannot appear in the Local Pack (map results) for "morocco tours marrakech" or similar queries. This is likely the highest-ROI single action available.
- **Fix:** Claim and verify GBP at business.google.com. Set category: "Tour Operator." Add phone, address (if applicable), hours, photos, and booking link.
- **Type:** Marketing
- **Effort:** 1–3 days (Google verification)

#### 21. No sameAs Array in Organization Schema
- **Severity:** Medium
- **Affected URLs:** Homepage (TravelAgency schema)
- **Impact:** Google uses `sameAs` to associate schema entities with known Knowledge Graph entities. Without it, brand entity recognition is weaker.
- **Fix:** Add `"sameAs": ["https://www.tripadvisor.com/...", "https://www.facebook.com/moroccoquest", "https://www.instagram.com/moroccoquest"]` to the TravelAgency schema.
- **Type:** Code
- **Effort:** 30 minutes

#### 22. Phone Number Format Inconsistency
- **Severity:** Low
- **Impact:** NAP inconsistency hurts Local SEO citation trust. If phone appears in different formats across pages, Whitespark/BrightLocal citations will not match.
- **Fix:** Standardize to E.164: `+212 6XX-XXX-XXX` across all pages, schema, and GBP.
- **Type:** Code + Content
- **Effort:** 1 hour

#### 23. Location Pages Have Identical H1 (Doorway Page Risk)
- **Severity:** Medium
- **Affected URLs:** `/tours/place/*`
- **Impact:** Pages with identical H1s and thin, formulaic content are at risk of being classified as doorway pages under Google's spam policy.
- **Fix:** Either consolidate (canonical to parent) or differentiate each place page with unique editorial content (150+ words specific to that location).
- **Type:** Content + Code
- **Effort:** 4–8 hours

---

### P3 — GEO / AEO (AI Search Readiness)

#### 24. OAI-SearchBot Missing from robots.txt
- **Severity:** Medium for GEO
- **Impact:** OpenAI's crawler (OAI-SearchBot) is not explicitly allowed. While not blocked, explicit allowance is a GEO best practice to ensure AI citation coverage.
- **Fix:** Add to `robots.txt`: `User-agent: OAI-SearchBot\nAllow: /`
- **Type:** Code
- **Effort:** 5 minutes

#### 25. Blog Posts Too Short for AI Citation
- **Severity:** Medium for AEO
- **Impact:** AI systems (Perplexity, ChatGPT, Google AI Overviews) prefer citing sources with 1,500+ word articles with clear factual claims. Blogs under 1,000 words are rarely cited.
- **Affected:** Blogs 5 and 6 (safety and Agafay vs Sahara) — both under 1,300 words.
- **Fix:** Expand to 1,800–2,500 words with factual claims, statistics, and clear Q&A-formatted passages.
- **Type:** Content
- **Effort:** 4–8 hours (writing)

#### 26. No External Citations in Blog Content
- **Severity:** Medium for AEO + E-E-A-T
- **Impact:** AI systems use citation networks to assess source credibility. Zero outbound links to authoritative sources (government, industry bodies, academic) signals weak E-E-A-T.
- **Fix:** Add 2–4 external links per blog post to: Morocco Ministry of Tourism, US State Dept travel advisory, UNESCO, Lonely Planet (for comparison terms). Use `rel="nofollow"` only where link equity concerns exist.
- **Type:** Content
- **Effort:** 1 hour per blog post

#### 27. No hreflang Implementation
- **Severity:** Low-Medium
- **Impact:** Site targets multiple English-speaking markets (US, UK, Australia) with no language/region disambiguation.
- **Fix:** If there is no French/Arabic version planned, add `<link rel="alternate" hreflang="en" href="...">` for the canonical English variant at minimum.
- **Type:** Code
- **Effort:** 2 hours

---

## Development vs. Content vs. Marketing Breakdown

| Fix Type | Count | Issues |
|---|---|---|
| **Code (developer)** | 12 | Duplicate schema, FAQPage, OG double-encode, og:type, WebSite schema, place canonical, &nbsp; in JSON-LD, image URL space, Twitter cards, mojibake, hreflang, OAI-SearchBot robots.txt |
| **Content (Mounir)** | 10 | All meta CTA rewrites, title/H1 alignment, Tours listing editorial, Blog 5 headings + citations, Blog 6 expansion, Hot Air Balloon expansion, homepage title/description trim, sameAs links, phone format, location page differentiation |
| **Marketing** | 2 | GBP claim, review collection for AggregateRating |

---

## Competitor Maturity Estimate

Based on the SEO infrastructure observed, the estimated SEO maturity of direct competitors (Moroccan private tour operators ranking for "morocco tours from marrakech," "sahara desert tours morocco") is approximately **55–65/100**.

Most competitors in this segment have:
- Google Business Profile claimed (Morocco Quest does not — confirmed gap)
- Basic meta tags but inconsistent canonical usage
- Minimal structured data (usually just Organization or breadcrumbs, rarely TouristTrip)
- No dedicated SEO fields system; meta descriptions are often auto-generated from first paragraph
- Thin activity pages (similar depth to Morocco Quest)
- No AEO/GEO optimization

Morocco Quest's current score of 63/100 places it **at or slightly above** the average competitor, but the five P0 bugs artificially depress it. With P0 bugs fixed and GBP claimed, the real score rises to approximately **72–75/100**, which would represent a material competitive advantage in this segment.

---

## Sprint C Recommended Priority Order

| Priority | Fix | Effort | Owner |
|---|---|---|---|
| 1 | Fix Twitter/OG double-encoded entities | 30 min | Dev |
| 2 | Fix FAQPage mainEntity — add real Q&A pairs | 1 hr | Dev + Mounir |
| 3 | Fix og:type inversion on tours/blogs | 30 min | Dev |
| 4 | Disable SEOTools JsonLd OR blade @push — eliminate duplicate schema | 2–4 hr | Dev |
| 5 | Fix Blog 5 heading hierarchy (H1→H2→H3) + add 2 external citations | 1 hr | Mounir |
| 6 | Add editorial content + H2s to /tours listing | 2 hr | Mounir |
| 7 | Fix Blog 6 (Agafay vs Sahara) — expand to 2,000+ words with data | 4 hr | Mounir |
| 8 | Expand Hot Air Balloon page + fix title | 2 hr | Mounir |
| 9 | Claim and verify Google Business Profile | 1–3 days | Marketing |
| 10 | Add WebSite schema + sameAs to TravelAgency schema | 1 hr | Dev |
| 11 | Fix place filter pages (canonical or noindex) | 1 hr | Dev |
| 12 | Add OAI-SearchBot to robots.txt | 5 min | Dev |
| 13 | Fix &nbsp; in Activity JSON-LD + blog image URL space | 30 min | Dev |
| 14 | Align Tour 1 + Tour 2 seo_title to match H1 phrasing | 15 min | Mounir (Filament) |
| 15 | Shorten homepage title and meta description | 15 min | Mounir (Filament) |
| 16 | Rewrite all meta descriptions with CTA verbs | 2 hr | Mounir (Filament) |
| 17 | Standardize phone format sitewide | 1 hr | Dev + Mounir |
| 18 | Plan AggregateRating — review system or TripAdvisor import | 2+ weeks | Dev + Marketing |
| 19 | Add hreflang (en) | 2 hr | Dev |

---

*Audit compiled from: Technical SEO agent, GEO/AEO agent, Schema agent, Local SEO agent, Content SEO agent. All agents ran on July 8, 2026 against production at morocco-quest.com.*
