# Crawl-architecture audit and fix, 24 October 2026

**Site:** https://morocco-quest.com
**Trigger:** Screaming Frog force-directed crawl diagrams (184 nodes) showing two clusters and `/tag/sahara` with 110 inlinks.
**Scope:** internal linking, crawl depth, indexability, archives, sitemap. Deployed to production as commit `199240c` on 24 October 2026 and verified by a second crawl the same day.

Companion files: `crawl-architecture-2026-10-24.csv` (149 rows), `evidence/crawl-2026-10-24-before.json` (baseline) and `evidence/crawl-2026-10-24-after.json` (post-deploy crawl, same crawler and settings).

---

## 1. Executive summary

The two clusters in the diagram are real but mostly harmless: the blog family (index, 16 posts, 33 categories, 60 tags) shares a sidebar that links every tag and category, while the commercial pages never link to tags. The shape is amplified by the way the diagram is drawn, which places each URL under the first page that linked to it. The incentive-travel article sits in the middle only because it was the first blog page the crawler reached.

Three real defects sat inside that structure, and all three are now fixed in code:

1. The sidebar listed **seven empty tags that return 404**, so 110 pages carried about 770 dead links.
2. Every blog-family page linked **all 67 noindex tag archives**, and every post ended with the same consumer "plan your trip" block, even corporate articles.
3. **Destination pages linked no activities at all** because the activity-to-place table is empty on production, leaving 9 activities with a single inlink.

Also fixed: `/activities` rendered "No activity categories found" and sat in the sitemap as a duplicate of `/experiences`.

Verified by the test suite (62 tests, 6 new) and by a production re-crawl after deploy: 0 dead links, 7 fewer URLs (the 404 tags), 20 tag links per blog page instead of 67, and activity links on every destination page.

## 2. SEO skills discovered and used

| Skill family | Found | Used |
|---|---|---|
| AgricIDaniel/claude-seo v1.9.0 (`~/.claude/skills/seo*`, 15 agents) | Yes | `seo-technical` crawlability and indexability checks (noindex intent, crawl depth, canonical conflicts), `seo-sitemap` quality gates, the `seo-audit` crawl configuration (1 req/s, robots respected) |
| aaron-he-zhu/seo-geo-claude-skills v9.9.10 plugin (`aaron-seo-geo`) | Yes | `internal-linking-optimizer` (orphan disposition, contextual source/target/anchor plan, varied anchors), `technical-seo-checker` (crawl waste, redirect chains, noindex blockers) |
| seranking/seo-skills | **Not installed.** The aaron plugin lists an SE Ranking MCP connector, but it is not authorised in this session, so no SE Ranking data was used. | No |

Methodology: baseline crawl with the repo's audit crawler, source-code tracing of each shared template, targeted live fetches, code fixes with regression tests, then the full test suite.

## 3. Screenshot observations

- Tree view: the `tag/` folder is a ring of 60 noindex (pink) and 7 404 nodes; one pink tooltip shows `/tag/agafay-desert`, 404, 110 inlinks, 0 outlinks.
- Crawl view: the ring hangs off the incentive-travel post, 184 nodes total.
- `/tag/sahara`: 200, noindex, 110 inlinks, 141 outlinks, 8 followed, 486 words.

## 4. Root causes with evidence

| # | Cause | Evidence |
|---|---|---|
| 1 | `TagController`, `CategoryController` and `BlogController` each built the sidebar with `Tag::orderBy('name')->get()`, including tags with no posts. Empty tags have returned 404 since 29 Sept. | Code before fix; crawl: 7 × 404 each linked from 110 pages |
| 2 | The sidebar on every blog, category and tag page carries the full tag cloud and category list. Commercial templates do not. | Crawl: up to 67 tag links per blog-family page, 0 on commercial pages |
| 3 | The crawl tree is a shortest-path tree, so each URL appears under one parent. The incentive post is the first `/blog/` link on the homepage, so the whole archive ring attaches to it. | Homepage link order; the post's own inlink count (111) equals the other posts' |
| 4 | `activity_place` pivot is empty on production, so `$place->activities()` returns nothing. | No destination page links any `/activities/` URL in either crawl; 9 activities have 1 inlink |
| 5 | The "Plan your Morocco trip" block under every post was identical and B2C-only. | `blog-details.blade.php` before fix; live incentive post body linked `/dmc-marrakech` but not `/team-building-marrakech` |
| 6 | `ActivityController::index()` passed `$activities` to a view that reads `$activityCategories`. | Live HTML "No activity categories found"; same H1 as `/experiences`; listed in sitemap |

## 5. Baseline crawl (today, before changes)

Crawler: `docs/reports/seo-audit-2026-10-14/evidence/technical/crawl.py`, 1 request/s, robots.txt respected, no query strings followed, raw HTML (the site is server-rendered; a 14 Oct Playwright check found identical titles, canonicals, H1s and link counts in raw and rendered HTML).

| Metric | Value |
|---|---|
| URLs fetched | 185 |
| 200 / 404 | 178 / 7 |
| Indexable | 117 |
| Noindex (tag archives) | 60 |
| Sitemap URLs | 84, all 200 and indexable |
| Orphan | `/tours/type/one-day` (not discovered; live 200) |
| Blog-family pages carrying the sidebar | 116 |
| Dead-link instances | 7 × 110 = 770 |
| Destination pages linking an activity | 0 of 8 |
| Blog posts linking `/team-building-marrakech` in the body | 0 of 16 (menu links only) |

## 6. URLs and templates responsible

- `resources/views/blog.blade.php` and `blog-details.blade.php` sidebar widgets (tag cloud, categories).
- `blog-details.blade.php` "plan your trip" block.
- `TourController::byPlace()` activity list.
- `ActivityController::index()` and the `/activities` sitemap entry.

## 7. Before and after (production crawls, 24 October 2026)

Same crawler, same settings, before and about one hour after deploy.

| Measure | Before | After |
|---|---|---|
| URLs discovered | 185 | 178 |
| HTTP 404 URLs / link instances | 7 / 770 | 0 / 0 |
| Tag links per blog-family page (max / median) | 67 / 67 | 29 / 20 |
| Destination pages linking at least one activity | 0 of 8 | 8 of 8 |
| Activities with 2 or fewer linking pages | 11 (9 with one) | 8 (2 with one: High Atlas hike, Had El Brachoua; their titles name no place) |
| Pages linking the 5-day Sahara tour | 12 | 17 |
| MICE posts: block under the body | consumer tours | team building, DMC hub, meetings and conventions |
| `/activities` | empty listing, self-canonical, in sitemap | category hub, canonical `/experiences`, out of sitemap |
| Sitemap URLs | 84 | 83 |
| Indexable URLs | 117 | 116 |

Every tag page stays reachable: each post still links its own tags in its footer, and tag archives stay `noindex,follow`.

## 8. Files changed

| File | Change |
|---|---|
| `app/Support/BlogSidebar.php` (new) | Shared cached sidebar: non-empty categories, top 20 non-empty tags, cache key `blog_sidebar_v2` |
| `app/Support/BlogRelatedLinks.php` (new) | Topic detection (MICE, desert, general) and existence-checked link sets |
| `app/Http/Controllers/BlogController.php`, `CategoryController.php`, `TagController.php` | Use `BlogSidebar::data()` instead of three inline copies |
| `app/Providers/AppServiceProvider.php` | Cache bust targets the new key |
| `resources/views/blog-details.blade.php` | Topic-aware cross-link block replaces the fixed one |
| `app/Http/Controllers/TourController.php` | Title-match fallback when a place has no pivot rows |
| `app/Http/Controllers/ActivityController.php` | `/activities` without `?category` serves the category hub (canonical `/experiences`) |
| `app/Http/Controllers/SitemapController.php` | Removed the `/activities` entry |
| `tests/Feature/CrawlArchitectureTest.php` (new) | 6 regression tests |

No CSS, copy, URLs, analytics, forms or database rows were changed.

## 9. Fixes implemented

1. Sidebar lists only archives with posts, and caps the tag cloud at 20.
2. Blog cross-link block chosen by topic, with natural, varied anchors.
3. Destination pages list local activities even while the pivot is empty.
4. `/activities` renders content and canonicalises to `/experiences`; removed from the sitemap.

## 10. Fixes deliberately not implemented

| Item | Why |
|---|---|
| 301 `/activities` → `/experiences` | URL change; owner decision O-3. Canonical covers the duplicate meanwhile. |
| `/tours/type/one-day` orphan | Needs the day-trips hub decision (O-3). Linking it now would create a fourth competing hub. |
| `%20` tour-type URLs | URL migration; owner decision O-2. |
| Making tag archives indexable | 60 tags for 16 posts, most with one post; they duplicate the posts. Noindex stays. |
| `nofollow` on tag links or robots.txt blocks | Would hide the posts behind them from crawlers and would not remove noindex URLs from results. |
| Redirecting tags or editing post titles/body copy | Content lives in the database; the incentive post title ending "| Morocco DMC" should be edited in Filament. |
| Filling `activity_place` | Data entry in Filament, not code. |

## 11. Tests and verification

- `php artisan test`: 62 passed, 339 assertions (6 new tests cover each fix).
- `pint` applied to the two new support classes and the new test only; the touched controllers already failed pint before this change and were left as they were.
- Deployed: `git pull` on the server to `199240c`, then `cache:clear`, `view:clear`, `optimize`.
- Live spot checks after deploy: incentive post shows the corporate block; Sahara post links the 5-day Sahara tour; craft post keeps the general block; `/destinations/fez`, `/marrakech`, `/rabat` list 5, 8 and 4 activities; `/activities` renders categories with canonical `/experiences`; sitemap has no `/activities` entry.
- Full re-crawl: figures in section 7. Non-200 list is empty.

## 12. Remaining risks and limitations

- The title fallback can attach an activity to a place whose name appears in the title for another reason; today's titles do not show that, but filling the pivot is the proper fix.
- Topic detection is keyword-based on title, slug, categories and tags. A post about events that is not corporate would get the MICE block; review after deploy.
- No Search Console data was available, so no click or impression impact can be measured yet.
- Crawler differences: Screaming Frog counted 184 URLs with the default settings; this crawler found 185. Link counts match (110 inlinks on tag pages).

## 13. Follow-up needing your decision

1. **O-3:** one day-trips hub (`/activities/category/day-trips` recommended), then 301 `/tours/type/one-day` and `/activities`.
2. **O-2:** 301 the `%20` tour-type URLs to slugs.
3. Fill `activity_place` in Filament so destination pages list the right activities without the fallback.
4. Edit the incentive post title to drop "| Morocco DMC"; merge duplicate categories (O-12).
5. Attach the High Atlas hike and Had El Brachoua activities to their places in Filament (their titles name no place, so the fallback cannot find them).
