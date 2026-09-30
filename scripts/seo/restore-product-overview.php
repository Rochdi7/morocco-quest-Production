<?php
// Restore `overview` from a backup written by 2026-09-30-product-overview-keywords.php.
//   BACKUP=storage/app/overview_backup_<stamp>.json php artisan tinker --execute="require base_path('scripts/seo/restore-product-overview.php');"
//   APPLY=1 BACKUP=... (same command) to write.
use Illuminate\Support\Facades\DB;

$file = getenv('BACKUP');
$path = $file && is_file($file) ? $file : ($file ? base_path($file) : null);
if (! $path || ! is_file($path)) {
    echo "Set BACKUP=path/to/overview_backup_*.json\n";
    return;
}

$rows = json_decode(file_get_contents($path), true) ?: [];
$apply = getenv('APPLY') === '1';

foreach ($rows as $r) {
    echo $r['table'] . '/' . $r['slug'] . "\n";
    if ($apply) {
        DB::table($r['table'])->where('slug', $r['slug'])->update([
            'overview' => $r['overview'],
            'updated_at' => now(),
        ]);
    }
}

echo $apply ? 'RESTORED ' . count($rows) . " overviews.\n" : "DRY RUN. Re-run with APPLY=1 to restore.\n";
