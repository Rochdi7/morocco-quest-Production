<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * Generates resized srcset variants for images on the public storage disk.
 *
 * Run on the server after deploy (and again whenever new tour/activity/blog
 * images are uploaded):
 *
 *   php artisan images:variants
 *
 * Originals are never modified. Variants are written next to the original as
 * {basename}-{width}w.{ext} and picked up automatically by
 * App\Support\ResponsiveImage::srcset() in the card views.
 */
class GenerateImageVariants extends Command
{
    protected $signature = 'images:variants
        {--dir=images : Directory on the public disk to scan (recursive)}
        {--quality=72 : WebP/JPEG quality for generated variants}
        {--force : Regenerate variants even if they already exist}';

    protected $description = 'Generate resized srcset variants (480/800/1200/1600w) for storage images';

    private const WIDTHS = [480, 800, 1200, 1600];

    public function handle(): int
    {
        if (!function_exists('imagecreatefromwebp') || !function_exists('imagewebp')) {
            $this->error('PHP GD with WebP support is required (gd extension).');

            return self::FAILURE;
        }

        $disk = Storage::disk('public');
        $dir = (string) $this->option('dir');
        $quality = (int) $this->option('quality');
        $force = (bool) $this->option('force');

        $created = 0;
        $skipped = 0;
        $savedBytes = 0;

        foreach ($disk->allFiles($dir) as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            // Never process files that are themselves generated variants.
            if (!in_array($ext, ['webp', 'jpg', 'jpeg', 'png'], true)
                || preg_match('/-\d+w\.(webp|jpe?g|png)$/i', $file)) {
                continue;
            }

            $absolute = $disk->path($file);
            $source = $this->loadImage($absolute, $ext);
            if ($source === false) {
                $this->warn("Unreadable image skipped: {$file}");

                continue;
            }

            $sourceWidth = imagesx($source);
            $base = substr($file, 0, -(strlen($ext) + 1));

            foreach (self::WIDTHS as $width) {
                // Only downscale — an upscaled variant would waste bytes.
                if ($sourceWidth <= $width) {
                    continue;
                }

                $variant = "{$base}-{$width}w.{$ext}";
                if (!$force && $disk->exists($variant)) {
                    $skipped++;

                    continue;
                }

                $resized = imagescale($source, $width, -1, IMG_BICUBIC);
                if ($resized === false) {
                    $this->warn("Resize failed: {$file} @ {$width}w");

                    continue;
                }

                if ($ext === 'png') {
                    imagealphablending($resized, false);
                    imagesavealpha($resized, true);
                }

                $target = $disk->path($variant);
                $ok = match ($ext) {
                    'webp' => imagewebp($resized, $target, $quality),
                    'jpg', 'jpeg' => imagejpeg($resized, $target, $quality),
                    'png' => imagepng($resized, $target, 9),
                };
                imagedestroy($resized);

                if ($ok) {
                    $created++;
                    $savedBytes += max(0, filesize($absolute) - filesize($target));
                } else {
                    $this->warn("Write failed: {$variant}");
                }
            }

            imagedestroy($source);
        }

        $savedMb = round($savedBytes / 1048576, 1);
        $this->info("Variants created: {$created}, already existed: {$skipped}.");
        $this->info("Per-request transfer saving when the smallest fitting variant is served: ~{$savedMb} MB across all variants.");

        return self::SUCCESS;
    }

    private function loadImage(string $path, string $ext): \GdImage|false
    {
        return match ($ext) {
            'webp' => @imagecreatefromwebp($path),
            'jpg', 'jpeg' => @imagecreatefromjpeg($path),
            'png' => @imagecreatefrompng($path),
            default => false,
        };
    }
}
