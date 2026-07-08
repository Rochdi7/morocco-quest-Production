# Morocco Quest — Production Content Audit
**Date:** 2026-07-08
**Audited by:** Laravel Tinker (read-only, no data modified)
**Branch:** main (sprint-b-seo-fields merged)

---

## Summary

| Model | Records | Images | Overviews | Custom SEO | Issues |
|-------|---------|--------|-----------|------------|--------|
| Tours | 8 | 8/8 ✓ | 8/8 ✓ | 0/8 ✗ | None critical |
| Activities | 23 | 23/23 ✓ | 23/23 ✓ | 0/23 ✗ | 2 near-duplicate pairs |
| Blogs | 15 | 15/15 ✓ | 15/15 ✓ | 0/15 ✗ | None |
| Places | 8 | 8/8 ✓ | 8/8 ✓ | N/A | None |
| ActivityCategories | 6 | — | — | N/A | **1 leading space in name** |

---

## 1. Tours

### Schema (29 columns)
`id, title, subtitle, slug, seo_title, meta_description, overview, includes, excludes, faq, map_embed_code, transportation, accommodation, departure, altitude, best_season, tour_type, group_size, min_age, max_age, price_adult, old_price_adult, price_child, old_price_child, discount, duration_days, created_at, updated_at, is_popular`

**Note:** No `status` or `published` column — all 8 tours are permanently live.

### Content Status

| ID | Title (short) | Type | Duration | Overview | Price | Images | Itinerary Days | Places | Popular |
|----|--------------|------|----------|----------|-------|--------|----------------|--------|---------|
| 1 | Marrakech City Break | Garden, Art | 5d | ✓ | ✓ | 1 | 5 | 1 | ✓ |
| 2 | Tangier City Break | Garden, Art, Cultural | 5d | ✓ | ✓ | 1 | 5 | 1 | ✓ |
| 3 | Rabat City Break | Cultural, Garden | 5d | ✓ | ✓ | 1 | 5 | 1 | ✓ |
| 4 | 8-Day Cultural Discovery | Classical | 8d | ✓ | ✓ | 1 | 8 | 1 | ✗ |
| 5 | Marrakech & Sahara | Adventure | 5d | ✓ | ✓ | 1 | 5 | 1 | ✓ |
| 6 | Royal Cities 6-Day | Classical, Cultural | 6d | ✓ | ✓ | 1 | 6 | 4 | ✓ |
| 7 | Andalusian Rail Tour | Classical, Cultural | 9d | ✓ | ✓ | 1 | 9 | 4 | ✗ |
| 8 | Marrakech & Essaouira | Cultural | 5d | ✓ | ✓ | 1 | 5 | 2 | ✓ |

### Issues Found

| Severity | Issue | Detail |
|----------|-------|--------|
| Low | No custom SEO fields set | All 8 tours using auto-generated titles/descriptions. Sprint B fields available in Filament — Mounir needs to fill them. |
| Low | Only 1 image per tour | Google image search and gallery UX benefit from 3–5 images per tour. |
| Info | Tours 4 & 7 not marked popular | May be intentional (longer, more niche tours). Review if they should appear in popular sections. |

### Duplicate Slugs
None.

---

## 2. Activities

### Schema (31 columns)
Same as tours plus `activity_category_id` and `discount_percentage`. Duration column is `duration_days` (value = hours in practice).

**Note:** No `status` column — all 23 activities are permanently live.

### Content Status

| ID | Slug (short) | Category | Duration | Overview | Price | Images | Popular |
|----|-------------|----------|----------|----------|-------|--------|---------|
| 1 | high-atlas-hike | 1 Local | 7h | ✓ | ✓ | 1 | ✓ |
| 2 | hot-air-balloon | 2 Outdoor | 5h | ✓ | ✓ | 1 | ✓ |
| 3 | cooking-class | 6 Food | 4h | ✓ | ✓ | 1 | ✓ |
| 4 | marrakech-medina-tour | 3 City | 6h | ✓ | ✓ | 1 | ✓ |
| 5 | atlas-gardens-aromatic | 4 Day Trips | 6h | ✓ | ✓ | 1 | ✓ |
| 6 | flavors-of-fez | 6 Food | 4h | ✓ | ✓ | 1 | ✓ |
| 7 | rabat-unveiled | 3 City | 4h | ✓ | ✓ | 1 | ✓ |
| 8 | chefchaouen-from-rabat | 4 Day Trips | 13h | ✓ | ✓ | 1 | ✓ |
| 9 | volubilis-meknes | 4 Day Trips | 6h | ✓ | ✓ | 1 | ✗ |
| 10 | marrakech-garden-trail | 2 Outdoor | 7h | ✓ | ✓ | 1 | ✓ |
| 11 | flavours-of-rabat | 6 Food | 4h | ✓ | ✓ | 1 | ✓ |
| 12 | rural-morocco-brachoua | 4 Day Trips | 10h | ✓ | ✓ | 1 | ✗ |
| 13 | atlas-gardens-botanical | 4 Day Trips | 6h | ✓ | ✓ | 1 | ✓ |
| 14 | chateau-roslane-fez | 6 Food | 7h | ✓ | ✓ | 1 | ✓ |
| 15 | wellness-hammam | 5 Wellness | 2h | ✓ | ✓ | 1 | ✗ |
| 16 | essaouira-day-trip | 4 Day Trips | 11h | ✓ | ✓ | 1 | ✓ |
| 17 | tangier-city-tour | 3 City | 8h | ✓ | ✓ | 1 | ✓ |
| 18 | chefchaouen-city-tour | 3 City | 8h | ✓ | ✓ | 1 | ✗ |
| 19 | fez-city-tour | 3 City | 8h | ✓ | ✓ | 1 | ✗ |
| 20 | casablanca-half-day | 3 City | 4h | ✓ | ✓ | 1 | ✓ |
| 21 | agadir-half-day | 3 City | 4h | ✓ | ✓ | 1 | ✓ |
| 22 | tangier-from-rabat | 4 Day Trips | 9h | ✓ | ✓ | 1 | ✗ |
| 23 | chefchaouen-from-fez | 4 Day Trips | 12h | ✓ | ✓ | 1 | ✗ |

### Issues Found

| Severity | Issue | Detail |
|----------|-------|--------|
| Medium | Near-duplicate content: Atlas Gardens (IDs 5 & 13) | ID 5: "aromatic delights" / ID 13: "private botanical escape" — both are Atlas Gardens day trips from Marrakech. Google may see these as competing pages for the same query. Recommend adding cross-links between them and ensuring each overview strongly signals what makes it distinct. |
| Low | Three Chefchaouen activities (IDs 8, 18, 23) | Legitimately distinct by departure city (Rabat / standalone city tour / Fez). Ensure each overview leads with the departure city to signal different intent to Google. |
| Low | No custom SEO fields set | All 23 activities using auto-generated titles/descriptions. |
| Low | Only 1 image per activity | |
| Info | 9 activities not marked popular | IDs 9, 12, 15, 18, 19, 22, 23 — review whether Fez city tour (19) and Chefchaouen city tour (18) should be popular. |

### Duplicate Slugs
None.

---

## 3. Blogs

### Schema (17 columns)
`id, title, subtitle, slug, seo_title, meta_description, written_by, summary, content, quote, quote_author, featured_image, featured_image_alt, featured_image_caption, featured_image_description, created_at, updated_at`

**Notes:**
- Author field is `written_by` (not `author` — querying `author` throws SQL error)
- No `status` or `published_at` column — all 15 blogs are permanently live, no drafts possible

### Content Status

| ID | Slug (short) | Author | Summary | Content | Image | SEO | Published |
|----|-------------|--------|---------|---------|-------|-----|-----------|
| 1 | top-10-unforgettable-experiences | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2025-05-21 |
| 2 | best-time-to-visit-morocco | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2025-05-26 |
| 3 | luxury-travel-in-morocco | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2025-05-26 |
| 4 | craft-holidays-in-morocco | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2025-06-02 |
| 5 | family-travel-in-morocco | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2025-06-08 |
| 6 | agafay-vs-sahara | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2025-06-12 |
| 7 | moroccos-must-see-festivals-2025 | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2025-06-17 |
| 8 | gnawa-museum-marrakech | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2025-10-06 |
| 9 | luxury-sahara-desert-tour | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2025-12-03 |
| 10 | marrakech-mice-experiences | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2026-01-04 |
| 11 | planning-trip-morocco-2026 | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2026-04-12 |
| 12 | luxury-morocco-desert-camps | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2026-04-14 |
| 13 | is-morocco-safe-americans-2026 | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2026-05-23 |
| 14 | tangier-total-solar-eclipse | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2026-06-09 |
| 15 | guide-multi-day-tours | Mounir Akajia | ✓ | ✓ | ✓ | ✗ | 2026-06-14 |

### Issues Found

| Severity | Issue | Detail |
|----------|-------|--------|
| Low | No custom SEO fields set | All 15 blogs using auto-generated titles/descriptions from `summary`. |
| Info | Blog 7 references "2025" in slug | `moroccos-must-see-festivals-and-moussems-in-2025` — will age badly in search. Write a 2026 edition as a new post. |
| Info | No draft/publish control | No `status` or `published_at` column. Saving = immediately live. Future improvement: add these columns to allow Mounir to draft posts. |

### Duplicate Slugs
None.

---

## 4. Places

### Schema (7 columns)
`id, name, slug, image_path, description, created_at, updated_at`

| ID | Name | Image | Description |
|----|------|-------|-------------|
| 1 | Marrakech | ✓ | ✓ |
| 2 | Tangier | ✓ | ✓ |
| 3 | Rabat | ✓ | ✓ |
| 4 | Fez | ✓ | ✓ |
| 5 | Casablanca | ✓ | ✓ |
| 6 | Chefchaouen | ✓ | ✓ |
| 7 | Essaouira | ✓ | ✓ |
| 8 | Agadir | ✓ | ✓ |

**No issues.** All 8 destinations fully populated.

**Gap:** Sahara/Merzouga and Ouarzazate are not Place records despite being featured in tour content.

---

## 5. ActivityCategories

### Schema (7 columns)
`id, name, slug, image_path, description, created_at, updated_at`

| ID | Name | Slug | Issue |
|----|------|------|-------|
| 1 | Local Experiences | local-experiences | — |
| 2 | Outdoor Activities | outdoor-activities | — |
| 3 | City Tours | city-tours | — |
| 4 | Day Trips | day-trips | — |
| 5 | ` Wellness Experiences` | wellness-experiences | **⚠ Leading space in name** |
| 6 | Food & Culinary Tours | food-culinary-tours | — |

### Issues Found

| Severity | Issue | Detail |
|----------|-------|--------|
| **Medium** | Leading space in category 5 name | `" Wellness Experiences"` has a space before the W. Displays as "` Wellness Experiences`" in nav, breadcrumbs, and any Blade `{{ $category->name }}` output. Fix: Filament → Activity Categories → Edit ID 5 → remove the space → Save. No migration needed. |

---

## 6. Database Statistics

| Table | Rows |
|-------|------|
| tours | 8 |
| activities | 23 |
| blogs | 15 |
| places | 8 |
| activity_categories | 6 |
| tour_images | 8 (1 per tour) |
| activity_images | 23 (1 per activity) |
| itinerary_days | 71 |
| place_tour | 15 |

**Total content records: 154**

Tour–place links: Single-city tours have 1 place each. Tour 6 (Royal Cities) and Tour 7 (Andalusian Rail) correctly have 4 places. Tour 8 (Marrakech+Essaouira) has 2. All correct.

---

## 7. Missing Content

| Item | Count | Action |
|------|-------|--------|
| Custom `seo_title` | 46 records (8+23+15) | Fill via Filament SEO section |
| Custom `meta_description` | 46 records | Same |
| Additional images per tour | 8 tours × 0 extra = 0 extra | Upload 2–4 more per tour |
| Additional images per activity | 23 activities × 0 extra | Upload 2–4 more per activity |
| Sahara/Merzouga as Place | Missing | Optional: add as Place records |

---

## 8. Duplicate / Near-Duplicate Content

| Severity | Records | Issue |
|----------|---------|-------|
| Medium | Activities 5 & 13 | Both Atlas Gardens day trips from Marrakech. Different angles (aromatic vs botanical) but Google may consolidate. Add cross-links + differentiate overviews. |
| Low | Activities 8, 18, 23 | Three Chefchaouen activities — distinct by departure city (Rabat / city tour / Fez). Ensure each overview leads with departure city. |
| Info | Blog 7 | "2025" hardcoded in slug — will become stale content signal. |

**No exact duplicate slugs on any model.**

---

## 9. SEO Fields Status

Sprint B deployed: `seo_title` (max 70) and `meta_description` (max 160) exist on tours, activities, blogs. All 46 records are NULL — auto-generated fallbacks active.

### Priority order for Mounir to fill in Filament:

**Tours — fill all 8, start with:**
1. Tour 5 — Marrakech & Sahara (highest demand keyword)
2. Tour 6 — Royal Cities 6-Day
3. Tour 4 — 8-Day Cultural Discovery
4. Tours 1–3 — City breaks
5. Tours 7–8 — Remaining

**Activities — start with top 8:**
1. Activity 2 — Hot air balloon (high search volume)
2. Activity 1 — High Atlas hike
3. Activity 3 — Cooking class
4. Activity 4 — Marrakech medina tour
5. Activity 16 — Essaouira day trip
6. Activities 17 & 19 — Tangier & Fez city tours
7. Activity 5 or 13 — Atlas Gardens (whichever is the primary page)
8. Remaining

**Blogs — start with highest-traffic topics:**
1. Blog 9 — Luxury Sahara desert tour
2. Blog 13 — Is Morocco safe for Americans 2026
3. Blog 6 — Agafay vs Sahara
4. Blog 2 — Best time to visit Morocco
5. Blog 3 — Luxury travel in Morocco
6. Remaining

---

## 10. Recommendations

### Critical — Fix immediately (5 minutes in Filament)
| # | Action | Where |
|---|--------|-------|
| C1 | Remove leading space from "` Wellness Experiences`" | Filament → Activity Categories → Edit ID 5 |

### High Priority — This week
| # | Action | Where |
|---|--------|-------|
| H1 | Fill `seo_title` + `meta_description` for top 5 tours | Filament → Tours → SEO section (collapsed) |
| H2 | Fill `seo_title` + `meta_description` for top 5 activities | Filament → Activities → SEO section |
| H3 | Fill `seo_title` + `meta_description` for top 5 blogs | Filament → Blogs → SEO section |
| H4 | Upload 2–3 more images for top 3 tours (Sahara, Royal Cities, Marrakech) | Filament → Tours → Images |

### Medium Priority — This month
| # | Action | Where |
|---|--------|-------|
| M1 | Upload 2–3 more images for top 5 activities | Filament → Activities |
| M2 | Differentiate Atlas Gardens activities 5 & 13 more clearly in overview text | Filament → Activities |
| M3 | Consider marking Fez city tour (ID 19) as popular | Filament → Activities → is_popular |
| M4 | Write 2026 festivals blog to supersede ageing blog 7 (2025 slug) | Filament → Blogs |
| M5 | Complete SEO fields for all remaining tours, activities, blogs | Filament |

### Low Priority / Future Sprints
| # | Action | Sprint |
|---|--------|--------|
| L1 | Add `status` / `published_at` to blogs to enable drafts | Sprint C migration |
| L2 | AEO content blocks: quick facts + FAQ schema per tour/activity | Sprint C |
| L3 | `aggregateRating` schema when ≥10 verified reviews available | Sprint C |
| L4 | `rel=prev/next` pagination links | Sprint C |
| L5 | Add Sahara/Merzouga and Ouarzazate as Place records | Filament → Places |

---

*Audit performed 2026-07-08 — read-only, no data modified. 154 content records inspected across 9 tables.*
