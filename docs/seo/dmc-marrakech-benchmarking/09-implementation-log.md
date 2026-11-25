# 09 — Implementation Log (2026-11-24)

Branch: `main` (working tree, **uncommitted, not deployed**). Diff: 3 source files, +37 / −8 lines.

| # | File | Change | Reason (evidence) |
|---|---|---|---|
| 1 | `app/Http/Controllers/DmcController.php` | Title `Morocco DMC Marrakech \| MICE & Incentive Travel` → **`DMC Marrakech \| Morocco DMC & MICE \| Morocco Quest`** (520 px Arial 20, limit 580) | Exact primary phrase leads (matches all ranking dedicated pages); "Morocco DMC" (260/mo) kept second; brand restored. The page was #35 in Google MA when "DMC Marrakech" led (Aug 26) and is outside the top 94 since the lead changed (01) |
| 2 | same | Description → `DMC Marrakech for travel agents, tour operators and MICE planners: white-label ground handling, hotels, transfers and incentives. Quote in 24h.` (~145 chars) | Primary phrase first; states B2B audience, services and the 24 h quote that is already on the page |
| 3 | same | `$keywords` array: `dmc marrakech` moved to first; old volume comment replaced with dated rationale | Keep code intent consistent with the primary keyword (meta keywords carry no ranking weight) |
| 4 | `resources/views/dmc-marrakech.blade.php` | H1 `Morocco DMC & DMC Marrakech – Destination Management & MICE` → **`DMC Marrakech: Destination Management Company for Travel Agents & MICE Planners`** | Removes keyword stacking (DMC twice); covers "destination management company (marrakech)" naturally; names the B2B audience |
| 5 | same | Service JSON-LD: added `alternateName` [Marrakech DMC, Morocco DMC, Destination Management Company Marrakech], `audience` (BusinessAudience), `hasOfferCatalog` (6 Offer→Service items mirroring visible page sections) | Makes the B2B DMC entity and its services explicit. Every item corresponds to visible content; no ratings or reviews added |
| 6 | `resources/views/home.blade.php` | One sentence under "Why Choose Morocco Quest for Private Tours?": "…work with us as a white-label **DMC in Marrakech** for groups, incentives and MICE programmes across Morocco." | Homepage had no contextual body link to the DMC page (only nav/menu). Uses existing classes (`text-white-color`, `fade-anim`), so no CSS change. Purged home CSS already contains both classes |
| 7 | `docs/seo/dmc-marrakech-benchmarking/` | 10 deliverables + `evidence/` (raw Google SERP CSVs/JSON from 2026-11-24) | Reporting |

## Deliberately not changed
- URL `/dmc-marrakech` (no evidence the URL is a factor; no migration risk taken).
- Body copy, testimonials, trust-bar numbers and licence claims: **need owner verification** (see 05, 08 B1–B6). Nothing was invented.
- `/destination-management-company` and the other 6 DMC pages (distinct intents; no cannibalisation).
- `scripts/serp-audit/out/` was overwritten by today's scrape, then **restored from a backup** to the 2026-08-26 baseline (folder is gitignored). Today's data is under `evidence/`.
- `docs/reports/COMPETITOR_PRICE_BENCHMARK_2026-11.md` is untracked and appeared at 12:17 during this session. **Not created by this work; left untouched.**

## Tooling and API usage
- Semrush: ~1,280 API units (keyword volumes, KD, 3 SERP snapshots, 2 position lookups, 9 backlink overviews, 2 AS profiles). Several calls returned `no_data` (MA/UK/FR/mobile-US databases).
- SE Ranking: 403, subscription expired.
- Google: project scraper (3 runs, 20 result pages total, no CAPTCHA). One headless Selenium attempt was CAPTCHA-blocked and **not** circumvented.
- GSC: the configured service account is attached to a different property. One query was sent by mistake (default property); its output file was **deleted without being read**, and no data from it is used anywhere.

## Deploy checklist (when you choose to deploy — not done here)
1. Deploy the 3 files.
2. `php artisan view:clear && php artisan cache:clear` (the homepage is page-cached for 6 h by `CacheGuestPage`).
3. Allow up to 2 h for the host edge cache (`max-age=7200`), or purge it in the hosting panel.
4. GSC: URL Inspection → Request indexing for `/dmc-marrakech` and `/`.
5. Re-run `scripts/serp-audit/serp_scrape.py` two weeks later and compare with `evidence/serp-google-ma-en-dmc-marrakech-2026-11-24.csv`.

Rollback: `git checkout -- app/Http/Controllers/DmcController.php resources/views/dmc-marrakech.blade.php resources/views/home.blade.php` (before commit), or revert the commit.
