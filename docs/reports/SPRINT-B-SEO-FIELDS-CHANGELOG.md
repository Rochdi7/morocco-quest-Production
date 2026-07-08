# Sprint B — SEO Fields Changelog
**Branch:** `sprint-b-seo-fields`
**Date:** 2026-07-08
**Scope:** Add `seo_title` + `meta_description` DB fields to tours, activities, blogs with Filament admin UI and controller fallback logic.

---

## Safety Guarantees

| Constraint | Status |
|-----------|--------|
| Design changed | ❌ No |
| Layout changed | ❌ No |
| Itineraries changed | ❌ No |
| Existing content modified | ❌ No |
| Existing records touched | ❌ No — fields are NULL by default |
| Routes changed | ❌ No |
| Filament admin broken | ❌ No — new section is collapsed by default |
| Fake SEO data added | ❌ No |

---

## Files Changed (12 total)

### Migrations (3 new)

| File | What |
|------|------|
| `database/migrations/2026_07_08_111033_add_seo_fields_to_tours_table.php` | Adds `seo_title VARCHAR(70) NULL`, `meta_description VARCHAR(160) NULL` to `tours` |
| `database/migrations/2026_07_08_111035_add_seo_fields_to_activities_table.php` | Same columns on `activities` |
| `database/migrations/2026_07_08_111036_add_seo_fields_to_blogs_table.php` | Same columns on `blogs` |

All fields: `nullable`, no default value, no existing records touched.

### Models (3 modified)

| File | Change |
|------|--------|
| `app/Models/Tour.php` | Added `seo_title`, `meta_description` to `$fillable` |
| `app/Models/Activity.php` | Same |
| `app/Models/Blog.php` | Same |

### Filament Resources (3 modified)

| File | Change |
|------|--------|
| `app/Filament/Resources/TourResource.php` | New collapsed **SEO** section with `seo_title` + `meta_description` fields |
| `app/Filament/Resources/ActivityResource.php` | Same |
| `app/Filament/Resources/BlogResource.php` | Same |

SEO section is **collapsed by default** — Mounir only sees it when he clicks to expand. Fields include:
- Max-length validation (70 chars / 160 chars)
- Helper text explaining the limits
- Placeholder examples

### Controllers (3 modified)

| File | Change |
|------|--------|
| `app/Http/Controllers/TourController.php` | `show()` — fallback: `$tour->seo_title ?: auto-title` |
| `app/Http/Controllers/ActivityController.php` | `show()` — fallback: `$activity->seo_title ?: auto-title` |
| `app/Http/Controllers/BlogController.php` | `show()` — fallback: `$post->seo_title ?: auto-title` |

---

## Fallback Logic (All 3 Controllers)

```php
// Title: DB field takes priority, falls back to auto-generated
$title = $model->seo_title
    ?: $model->title . ' | Suffix | Morocco Quest';

// Description: DB field takes priority, falls back to trimmed overview/summary
$description = $model->meta_description
    ?: Str::limit(strip_tags($model->overview ?? ''), 155);
```

**Effect:** If Mounir leaves `seo_title` and `meta_description` empty (which they all are now), behaviour is identical to before this sprint. The moment he fills in a field for a specific tour, that value is used instead.

---

## Filament UI — What Mounir Sees

On each Tour / Activity / Blog edit page, a new **SEO** section appears at the bottom (collapsed):

```
▶ SEO
  Optional. Override the auto-generated meta title and description for search engines.

  SEO Title
  [________________________________________________] (max 70 chars)
  Leave blank to auto-generate from tour title.

  Meta Description
  [________________________________________________]
  [________________________________________________]
  [________________________________________________] (max 160 chars)
  Leave blank to auto-generate from tour overview.
```

---

## Deploy Steps (Server)

Run on PuTTY after merging to main:

```bash
git pull
php artisan migrate
php artisan optimize
```

Verify migrations ran:
```bash
php artisan tinker << 'EOF'
$cols = DB::select("SHOW COLUMNS FROM tours WHERE Field IN ('seo_title', 'meta_description')");
foreach($cols as $c) { echo $c->Field . ' | ' . $c->Type . ' | null:' . $c->Null . PHP_EOL; }
$cols2 = DB::select("SHOW COLUMNS FROM activities WHERE Field IN ('seo_title', 'meta_description')");
foreach($cols2 as $c) { echo $c->Field . ' | ' . $c->Type . ' | null:' . $c->Null . PHP_EOL; }
$cols3 = DB::select("SHOW COLUMNS FROM blogs WHERE Field IN ('seo_title', 'meta_description')");
foreach($cols3 as $c) { echo $c->Field . ' | ' . $c->Type . ' | null:' . $c->Null . PHP_EOL; }
EOF
```

Expected output:
```
seo_title | varchar(70) | null:YES
meta_description | varchar(160) | null:YES
seo_title | varchar(70) | null:YES
meta_description | varchar(160) | null:YES
seo_title | varchar(70) | null:YES
meta_description | varchar(160) | null:YES
```

---

## Rollback

```bash
php artisan migrate:rollback --step=3
```

Or per table:
```bash
php artisan migrate:rollback --path=database/migrations/2026_07_08_111033_add_seo_fields_to_tours_table.php
```

---

## Next Steps for Mounir

1. Go to `/adminPanel/tours` → edit any tour → scroll to **SEO** section
2. Enter a custom SEO Title (max 70 chars) and Meta Description (max 160 chars)
3. Save — the tour detail page will use your custom values immediately
4. Leave fields empty to keep the auto-generated values

**Priority pages to fill first:**
- Top 3 tours (highest traffic)
- Sahara desert tour page
- Any page currently ranking on page 2 for target keywords

---

## Remaining Sprint Work

| # | Task | Sprint |
|---|------|--------|
| C1 | AEO content blocks (quick facts, FAQ per tour) | Sprint C |
| C2 | `aggregateRating` schema when reviews available | Sprint C |
| C3 | `rel=prev/next` pagination links | Sprint C |
| C4 | Twitter card image per tour (currently uses OG fallback) | Sprint C |

---

*Sprint B SEO Fields Changelog | 2026-07-08 | Branch: sprint-b-seo-fields*
