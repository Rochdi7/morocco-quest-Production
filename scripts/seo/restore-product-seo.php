<?php
// Restore seo_title / meta_description from a backup written by
// 2026-09-30-product-seo-titles.php. Usage (dry run, then apply):
//   BACKUP=storage/app/seo_backup_YYYYMMDD_HHMMSS.json php artisan tinker --execute="require base_path('scripts/seo/restore-product-seo.php');"
//   APPLY=1 BACKUP=... php artisan tinker --execute="require base_path('scripts/seo/restore-product-seo.php');"
use Illuminate\Support\Facades\DB;

$file = getenv('BACKUP');
if (! $file || ! is_file(base_path($file)) && ! is_file($file)) {
    echo "Set BACKUP=path/to/seo_backup_*.json\n";
    return;
}
$rows = json_decode(file_get_contents(is_file($file) ? $file : base_path($file)), true) ?: [];
$apply = getenv('APPLY') === '1';
foreach ($rows as $r) {
    echo "{$r['table']}/{$r['slug']} -> " . ($r['seo_title'] ?? '(empty)') . "\n";
    if ($apply) {
        DB::table($r['table'])->where('slug', $r['slug'])->update([
            'seo_title' => $r['seo_title'], 'meta_description' => $r['meta_description'], 'updated_at' => now(),
        ]);
    }
}
echo $apply ? "RESTORED " . count($rows) . " rows.\n" : "DRY RUN. Re-run with APPLY=1 to restore.\n";
