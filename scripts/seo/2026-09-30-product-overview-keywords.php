<?php
// Morocco Quest: work each product's target keyword (Semrush US, 2026-09-30)
// into the opening sentence of its overview, the text Google weighs most.
// Each edit is an exact find -> replace on the stored overview HTML. If an
// expected phrase is not found exactly once, that product is SKIPPED (never
// guessed). Only `overview` changes (plus one seo_title correction), via
// direct DB updates: no model events, so slugs/URLs cannot change.
//
//   Preview:  php artisan tinker --execute="require base_path('scripts/seo/2026-09-30-product-overview-keywords.php');"
//   Apply:    APPLY=1 php artisan tinker --execute="require base_path('scripts/seo/2026-09-30-product-overview-keywords.php');"
//   Undo:     APPLY=1 BACKUP=storage/app/overview_backup_<stamp>.json php artisan tinker --execute="require base_path('scripts/seo/restore-product-overview.php');"
use Illuminate\Support\Facades\DB;

$apply = getenv('APPLY') === '1';

// [table, slug, [[find, replace], ...]]
$edits = json_decode(<<<'JSON'
[
 ["tours", "5-day-tangier-luxury-city-break-art-culture-coastal-charms", [
   ["on this <strong>5-day Tangier luxury city break</strong>", "on this <strong>5-day Tangier trip</strong>, a luxury city break"]]],
 ["tours", "5-day-rabat-luxury-city-break-rich-history-local-flavors", [
   ["on this <strong>5-day Rabat luxury city break</strong>", "on this <strong>5-day Rabat tour</strong>, a luxury city break"]]],
 ["tours", "5-day-marrakech-sahara-luxury-desert-discovery-adventure-tour", [
   ["<strong>5-day Marrakech to Sahara luxury desert tour</strong>", "<strong>5-day luxury Sahara desert tour from Marrakech</strong>"]]],
 ["tours", "royal-cities-of-morocco-6-day-luxury-imperial-cultural-tour", [
   ["<strong>6-day Royal Cities of Morocco luxury tour</strong>", "<strong>6-day imperial cities tour</strong> of the Royal Cities of Morocco"]]],
 ["activities", "a-day-in-the-high-atlas-hike-tea-ritual-berber-hospitality", [
   ["<p>&nbsp;Escape the bustle of Marrakech and journey into the heart of the High Atlas Mountains", "<p>Escape the bustle of Marrakech on this <strong>Atlas Mountains day trip</strong> and journey into the heart of the High Atlas"]]],
 ["activities", "authentic-3-hour-moroccan-cooking-class-in-marrakech-morning-afternoon-sessions", [
   ["<p>&nbsp;Discover the flavors of Morocco", "<p>Discover the flavors of Morocco"],
   ["a 3-hour hands-on cooking class at the Moroccan Culinary Arts Museum in Marrakech", "a 3-hour hands-on <strong>Moroccan cooking class in Marrakech</strong> at the Moroccan Culinary Arts Museum"]]],
 ["activities", "marrakech-medina-hidden-gems-tour-discover-authentic-local-life-with-a-private-guide", [
   ["<p>&nbsp;Uncover the soul of Marrakech", "<p>Uncover the soul of Marrakech"],
   [", a captivating journey through the city", ", a private <strong>Marrakech medina tour</strong> and captivating journey through the city"]]],
 ["activities", "marrakech-garden-trail-from-majestic-cacti-to-medina-secrets", [
   ["Discover the green heart of Marrakech through its most enchanting gardens", "Discover the green heart of the city on this <strong>Marrakech gardens tour</strong>, taking in its most enchanting gardens, including the Majorelle Garden and Le Jardin Secret"]]],
 ["activities", "fez-full-day-city-tour-private-cultural-journey-through-moroccos-spiritual-capital", [
   ["on an immersive full-day Fez city tour", "on an immersive full-day <strong>Fez medina tour</strong>"]]],
 ["activities", "rabat-unveiled-a-journey-through-moroccos-regal-capital", [
   ["<p>&nbsp;Dive into the soul of", "<p>Dive into the soul of"],
   ["<strong>4-hour city tour of Rabat</strong>", "<strong>4-hour Rabat city tour</strong>"]]],
 ["activities", "tangier-full-day-city-tour-private-cultural-journey-at-the-gateway-of-africa", [
   ["Experience the timeless allure of Tangier on a refined full-day city tour", "Experience the timeless allure of the city on a refined full-day <strong>Tangier city tour</strong>"]]],
 ["activities", "chefchaouen-full-day-city-tour-private-blue-city-walking-experience", [
   ["Discover the serene beauty of Chefchaouen on an immersive full-day city tour", "Discover the serene beauty of the Blue City on an immersive full-day <strong>Chefchaouen tour</strong>"]]],
 ["activities", "casablanca-half-day-city-tour-private-cultural-coastal-experience", [
   ["on a refined half-day city tour", "on a refined half-day <strong>Casablanca city tour</strong>"]]]
]
JSON, true);

// The Rabat activity is a 4-hour tour; the 2026-09-30 title said "Day".
$titleFixes = [
    ['activities', 'rabat-unveiled-a-journey-through-moroccos-regal-capital',
     'Private City Tour of Rabat', 'Rabat City Tour: Private 4-Hour Guided Tour | Morocco Quest'],
];

$backup = [];
$done = 0;
foreach ($edits as [$table, $slug, $pairs]) {
    $row = DB::table($table)->where('slug', $slug)->first(['id', 'overview']);
    if (! $row) { echo "MISSING  {$table}/{$slug}\n"; continue; }
    $html = (string) $row->overview;
    $new = $html;
    $problem = null;
    foreach ($pairs as [$find, $replace]) {
        $n = substr_count($new, $find);
        if ($n !== 1) { $problem = "phrase found {$n}x: " . mb_substr(strip_tags($find), 0, 60); break; }
        $new = str_replace($find, $replace, $new);
    }
    if ($problem) { echo "SKIPPED  {$table}/{$slug}  ({$problem})\n"; continue; }
    $backup[] = ['table' => $table, 'slug' => $slug, 'overview' => $html];
    $plain = fn ($h) => trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($h), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
    echo "OK       {$table}/{$slug}\n   before: " . mb_substr($plain($html), 0, 150) . "\n   after:  " . mb_substr($plain($new), 0, 150) . "\n";
    if ($apply) {
        DB::table($table)->where('id', $row->id)->update(['overview' => $new, 'updated_at' => now()]);
        $done++;
    }
}

foreach ($titleFixes as [$table, $slug, $mustContainNot, $title]) {
    $cur = DB::table($table)->where('slug', $slug)->value('seo_title');
    echo "TITLE    {$table}/{$slug}\n   {$cur}\n   -> {$title}\n";
    if ($apply && $cur !== null) {
        DB::table($table)->where('slug', $slug)->update(['seo_title' => $title, 'updated_at' => now()]);
    }
}

$file = storage_path('app/overview_backup_' . date('Ymd_His') . '.json');
file_put_contents($file, json_encode($backup, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "\nBackup of previous overviews: {$file}\n";
echo $apply ? "APPLIED {$done} overviews + title fix.\n" : "DRY RUN only (nothing changed). Re-run with APPLY=1 to write.\n";
