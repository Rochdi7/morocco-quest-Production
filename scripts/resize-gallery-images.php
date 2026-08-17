<?php
// One-off: generate correctly-sized WebP variants for the homepage destination
// gallery images (Lighthouse "properly size images" + "efficient encoding" findings).
// Originals are left untouched (still used as the Magnific Popup lightbox href at
// full resolution) -- only new, smaller-width files are added for inline <img>/srcset use.

chdir(__DIR__ . '/..');

$jobs = [
    // agafay: displayed up to 960w per existing sizes attr. Source is 4032x1624 --
    // add a real 960w variant (the srcset's "960w" descriptor pointed at the untouched
    // 4032px original) and fix the already-referenced-but-missing 480w variant.
    [
        'src' => 'assets/img/agafay-desert-luxury-camp-camel-trek-morocco.webp',
        'variants' => [
            ['suffix' => '-480', 'width' => 480],
            ['suffix' => '-960', 'width' => 960],
        ],
    ],
    // Quarter-tile gallery images: CSS box is 600x540, object-fit: cover.
    // 1200w covers 2x retina at that box size; add a 600w variant for mobile
    // (col-sm-6 stacks these at roughly half a phone viewport width).
    [
        'src' => 'assets/img/moroccan_traditional_mechoui_evening_firepit.webp',
        'variants' => [
            ['suffix' => '-600', 'width' => 600],
            ['suffix' => '-1200', 'width' => 1200],
        ],
    ],
    [
        'src' => 'assets/img/gnawa_musician_morocco_local_encounter.webp',
        'variants' => [
            ['suffix' => '-600', 'width' => 600],
            ['suffix' => '-1200', 'width' => 1200],
        ],
    ],
    [
        'src' => 'assets/img/souk_experience_morocco_cultural_discoveries.webp',
        'variants' => [
            ['suffix' => '-600', 'width' => 600],
            ['suffix' => '-1200', 'width' => 1200],
        ],
    ],
];

function loadWebp(string $path)
{
    $img = imagecreatefromwebp($path);
    if (!$img) {
        throw new RuntimeException("Failed to load $path");
    }
    return $img;
}

function resizeTo(\GdImage $src, int $targetWidth): \GdImage
{
    $srcW = imagesx($src);
    $srcH = imagesy($src);
    if ($targetWidth >= $srcW) {
        return $src;
    }
    $targetHeight = (int) round($srcH * ($targetWidth / $srcW));
    $dst = imagecreatetruecolor($targetWidth, $targetHeight);
    imagealphablending($dst, false);
    imagesavealpha($dst, true);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $targetWidth, $targetHeight, $srcW, $srcH);
    return $dst;
}

foreach ($jobs as $job) {
    $src = $job['src'];
    $img = loadWebp($src);
    $ext = '.webp';
    $base = substr($src, 0, -strlen($ext));

    foreach ($job['variants'] as $variant) {
        $resized = resizeTo($img, $variant['width']);
        $outPath = $base . $variant['suffix'] . $ext;
        imagewebp($resized, $outPath, 82);
        if ($resized !== $img) {
            imagedestroy($resized);
        }
        $after = filesize($outPath);
        printf("%-70s -> %5dw  %6d KB\n", basename($outPath), $variant['width'], round($after / 1024));
    }
    imagedestroy($img);
}
