<?php
// Morocco Quest: keyword-mapped SEO titles/descriptions for tours & activities.
// Source: Semrush US keyword research, 2026-09-30.
// Only seo_title + meta_description change (direct DB update, no model events,
// so slugs/URLs can never change). Dry run by default; APPLY=1 writes:
//   php artisan tinker --execute="require base_path('scripts/seo/2026-09-30-product-seo-titles.php');"
//   APPLY=1 php artisan tinker --execute="require base_path('scripts/seo/2026-09-30-product-seo-titles.php');"
use Illuminate\Support\Facades\DB;

$apply = getenv('APPLY') === '1';
$map = json_decode(<<<'JSON'
[
 [
  "tours",
  "5-day-marrakech-luxury-city-break-gardens-culture-relaxation",
  "5-Day Luxury Marrakech City Break & Private Tour | Morocco Quest",
  "A 5-day luxury Marrakech city break with private guides: gardens, the medina, culture and relaxation in a hand-picked riad. Tailor-made by locals."
 ],
 [
  "tours",
  "5-day-tangier-luxury-city-break-art-culture-coastal-charms",
  "5-Day Tangier Trip: Luxury City Break & Tour | Morocco Quest",
  "Plan a 5-day luxury trip to Tangier: art, culture, the kasbah and Atlantic coastal charm, with private guided tours arranged by Morocco Quest."
 ],
 [
  "tours",
  "5-day-rabat-luxury-city-break-rich-history-local-flavors",
  "5-Day Rabat Tour: Luxury City Break & History | Morocco Quest",
  "A 5-day luxury Rabat tour: royal history, the Kasbah of the Udayas, local flavors and private guided visits of Morocco's capital with Morocco Quest."
 ],
 [
  "tours",
  "8-day-morocco-luxury-cultural-discovery-art-heritage-culinary-delights",
  "8-Day Luxury Morocco Tour: Culture, Art & Food | Morocco Quest",
  "An 8-day luxury Morocco tour of art, heritage and cuisine: private guides, curated stays and authentic cultural experiences, planned by locals."
 ],
 [
  "tours",
  "5-day-marrakech-sahara-luxury-desert-discovery-adventure-tour",
  "5-Day Luxury Sahara Desert Tour from Marrakech | Morocco Quest",
  "A 5-day luxury Sahara desert tour from Marrakech to the Erg Chebbi dunes of Merzouga: private 4x4, a camel ride and a luxury desert camp."
 ],
 [
  "tours",
  "royal-cities-of-morocco-6-day-luxury-imperial-cultural-tour",
  "6-Day Imperial Cities Tour of Morocco | Morocco Quest",
  "Explore Morocco's royal imperial cities on a 6-day private luxury tour: palaces, medinas and heritage sites with expert local guides."
 ],
 [
  "tours",
  "9-day-andalusian-morocco-train-tour",
  "9-Day Morocco Train Tour: Tangier to Fez | Morocco Quest",
  "A 9-day Morocco rail tour from Tangier to Fez and Chefchaouen: comfortable train travel, private guides and luxury stays with Morocco Quest."
 ],
 [
  "tours",
  "5-day-marrakech-essaouira-luxury-duo-private-morocco-tour",
  "5-Day Marrakech & Essaouira Private Luxury Tour | Morocco Quest",
  "Combine Marrakech and coastal Essaouira on a 5-day private luxury tour: medina, souks and Atlantic breezes, with a tailor-made itinerary."
 ],
 [
  "activities",
  "a-day-in-the-high-atlas-hike-tea-ritual-berber-hospitality",
  "Atlas Mountains Day Trip & Hike from Marrakech | Morocco Quest",
  "A private Atlas Mountains day trip from Marrakech: a guided hike, Berber village hospitality and a traditional mint-tea ritual in the mountains."
 ],
 [
  "activities",
  "magical-hot-air-balloon-ride-over-marrakech-with-berber-breakfast",
  "Hot Air Balloon Marrakech: Sunrise Ride | Morocco Quest",
  "Book a hot air balloon ride over Marrakech at sunrise, with views of the Atlas Mountains and a traditional Berber breakfast after landing."
 ],
 [
  "activities",
  "authentic-3-hour-moroccan-cooking-class-in-marrakech-morning-afternoon-sessions",
  "Moroccan Cooking Class in Marrakech (3 Hours) | Morocco Quest",
  "Join a 3-hour Moroccan cooking class in Marrakech: learn the spices, cook a traditional tagine and enjoy your meal. Morning or afternoon sessions."
 ],
 [
  "activities",
  "marrakech-medina-hidden-gems-tour-discover-authentic-local-life-with-a-private-guide",
  "Marrakech Medina Tour with a Private Guide | Morocco Quest",
  "Explore the hidden gems of the Marrakech medina with a private local guide: souks, artisans, riads and authentic daily life off the tourist trail."
 ],
 [
  "activities",
  "rabat-unveiled-a-journey-through-moroccos-regal-capital",
  "Rabat City Tour: Private Guided Day | Morocco Quest",
  "A private Rabat city tour of Morocco's royal capital: the Kasbah of the Udayas, Hassan Tower, the medina and royal landmarks with a local guide."
 ],
 [
  "activities",
  "volubilis-meknes-a-timeless-escape-from-fes",
  "Volubilis Tour & Meknes Day Trip from Fez | Morocco Quest",
  "A private Volubilis and Meknes day trip from Fez: explore the Roman ruins of Volubilis and the imperial city of Meknes with an expert guide."
 ],
 [
  "activities",
  "marrakech-garden-trail-from-majestic-cacti-to-medina-secrets",
  "Marrakech Gardens Tour: Majorelle & Secret Garden | Morocco Quest",
  "A private Marrakech gardens tour: Majorelle Garden, majestic cacti and Le Jardin Secret in the medina, with a local guide at your own pace."
 ],
 [
  "activities",
  "moroccan-wellness-ritual-private-hammam-massage-experience-in-marrakech",
  "Hammam Marrakech: Private Hammam & Massage | Morocco Quest",
  "Relax with a private hammam and massage in Marrakech: a traditional Moroccan wellness ritual with black soap and a soothing massage."
 ],
 [
  "activities",
  "tangier-full-day-city-tour-private-cultural-journey-at-the-gateway-of-africa",
  "Tangier City Tour: Private Full-Day Guide | Morocco Quest",
  "A private full-day Tangier city tour at the gateway of Africa: the kasbah, medina, Cap Spartel and cultural landmarks with a local guide."
 ],
 [
  "activities",
  "chefchaouen-full-day-city-tour-private-blue-city-walking-experience",
  "Chefchaouen Tour: Private Blue City Walk | Morocco Quest",
  "A private full-day Chefchaouen tour: the blue streets and medina of Morocco's Blue City, Ras El Ma and the Spanish Mosque, with a local guide."
 ],
 [
  "activities",
  "fez-full-day-city-tour-private-cultural-journey-through-moroccos-spiritual-capital",
  "Fes Medina Tour: Private Full-Day Guided Tour | Morocco Quest",
  "A private full-day Fes medina tour of Morocco's spiritual capital: the tanneries, historic madrasas and souks with an expert local guide."
 ],
 [
  "activities",
  "casablanca-half-day-city-tour-private-cultural-coastal-experience",
  "Casablanca City Tour: Private Half-Day Tour | Morocco Quest",
  "A private half-day Casablanca city tour: the Hassan II Mosque, the Corniche, the Habous quarter and coastal landmarks with a local guide."
 ]
]
JSON, true);

$backup = [];
foreach ($map as [$table, $slug, $title, $desc]) {
    $row = DB::table($table)->where('slug', $slug)->first(['id', 'slug', 'seo_title', 'meta_description']);
    if (! $row) { echo "MISSING  {$table}/{$slug}
"; continue; }
    $backup[] = ['table' => $table, 'slug' => $slug, 'seo_title' => $row->seo_title, 'meta_description' => $row->meta_description];
    echo str_pad($table, 11) . $slug . "
   title: " . ($row->seo_title ?? '(empty)') . "
       -> " . $title . "
";
    if ($apply) {
        DB::table($table)->where('id', $row->id)->update([
            'seo_title' => $title, 'meta_description' => $desc, 'updated_at' => now(),
        ]);
    }
}

$file = storage_path('app/seo_backup_' . date('Ymd_His') . '.json');
file_put_contents($file, json_encode($backup, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "
Backup of previous values: {$file}
";
echo $apply ? "APPLIED " . count($backup) . " rows.
" : "DRY RUN only (nothing changed). Re-run with APPLY=1 to write.
";
