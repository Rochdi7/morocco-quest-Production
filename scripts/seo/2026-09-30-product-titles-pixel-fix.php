<?php
// Morocco Quest: shorten 11 product SEO titles to Seobility's 580 px limit and
// remove repeated words ("tour" / "hammam" twice). Only seo_title changes, via
// direct DB updates (no model events, URLs cannot change).
//   Preview: php artisan tinker --execute="require base_path('scripts/seo/2026-09-30-product-titles-pixel-fix.php');"
//   Apply:   APPLY=1 php artisan tinker --execute="require base_path('scripts/seo/2026-09-30-product-titles-pixel-fix.php');"
//   Undo:    APPLY=1 BACKUP=storage/app/seo_backup_<stamp>.json php artisan tinker --execute="require base_path('scripts/seo/restore-product-seo.php');"
use Illuminate\Support\Facades\DB;

$apply = getenv('APPLY') === '1';
$map = json_decode(<<<'JSON'
[
 [
  "tours",
  "5-day-marrakech-luxury-city-break-gardens-culture-relaxation",
  "5-Day Luxury Marrakech City Break | Morocco Quest"
 ],
 [
  "tours",
  "8-day-morocco-luxury-cultural-discovery-art-heritage-culinary-delights",
  "8-Day Luxury Morocco Tour: Culture & Food | Morocco Quest"
 ],
 [
  "tours",
  "5-day-marrakech-sahara-luxury-desert-discovery-adventure-tour",
  "5-Day Sahara Desert Tour from Marrakech | Morocco Quest"
 ],
 [
  "tours",
  "5-day-marrakech-essaouira-luxury-duo-private-morocco-tour",
  "5-Day Marrakech & Essaouira Private Tour | Morocco Quest"
 ],
 [
  "activities",
  "a-day-in-the-high-atlas-hike-tea-ritual-berber-hospitality",
  "Atlas Mountains Day Trip from Marrakech | Morocco Quest"
 ],
 [
  "activities",
  "authentic-3-hour-moroccan-cooking-class-in-marrakech-morning-afternoon-sessions",
  "Moroccan Cooking Class in Marrakech | Morocco Quest"
 ],
 [
  "activities",
  "rabat-unveiled-a-journey-through-moroccos-regal-capital",
  "Rabat City Tour: 4-Hour Private Guide | Morocco Quest"
 ],
 [
  "activities",
  "marrakech-garden-trail-from-majestic-cacti-to-medina-secrets",
  "Majorelle & Secret Garden Tour Marrakech | Morocco Quest"
 ],
 [
  "activities",
  "moroccan-wellness-ritual-private-hammam-massage-experience-in-marrakech",
  "Private Hammam & Massage in Marrakech | Morocco Quest"
 ],
 [
  "activities",
  "fez-full-day-city-tour-private-cultural-journey-through-moroccos-spiritual-capital",
  "Fes Medina Tour: Private Full-Day Guide | Morocco Quest"
 ],
 [
  "activities",
  "casablanca-half-day-city-tour-private-cultural-coastal-experience",
  "Casablanca City Tour: Private Half-Day | Morocco Quest"
 ]
]
JSON, true);

$backup = [];
$done = 0;
foreach ($map as [$table, $slug, $title]) {
    $row = DB::table($table)->where('slug', $slug)->first(['id', 'seo_title', 'meta_description']);
    if (! $row) { echo "MISSING  {$table}/{$slug}
"; continue; }
    $backup[] = ['table' => $table, 'slug' => $slug, 'seo_title' => $row->seo_title, 'meta_description' => $row->meta_description];
    echo str_pad($table, 11) . $slug . "
   " . $row->seo_title . "
-> " . $title . "
";
    if ($apply) {
        DB::table($table)->where('id', $row->id)->update(['seo_title' => $title, 'updated_at' => now()]);
        $done++;
    }
}
$file = storage_path('app/seo_backup_' . date('Ymd_His') . '.json');
file_put_contents($file, json_encode($backup, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "
Backup: {$file}
";
echo $apply ? "APPLIED {$done} titles.
" : "DRY RUN only. Re-run with APPLY=1 to write.
";
