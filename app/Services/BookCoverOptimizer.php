<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

/**
 * Converts book cover images to a small WebP version.
 *
 * Covers are displayed at most a few hundred CSS pixels wide, so 480px wide
 * is sharp on high-density screens while keeping files around 20-40 KB.
 */
class BookCoverOptimizer
{
    public const MAX_WIDTH = 480;

    public const QUALITY = 80;

    /**
     * Convert the image at the given public disk path to WebP, scaled down to
     * MAX_WIDTH. The original is deleted when the new file has a different path.
     *
     * @param string $storagePath Path on the public disk (e.g. "books/abc.png")
     * @return string Path of the optimized image (e.g. "books/abc.webp")
     */
    public function optimize(string $storagePath): string
    {
        if (!function_exists('imagewebp') || !function_exists('imagecreatefromwebp')) {
            throw new \RuntimeException('PHP GD is installed without WebP support (configure gd with --with-webp)');
        }

        $disk = Storage::disk('public');
        $image = ImageManager::gd()->read($disk->path($storagePath));

        // Already optimized (e.g. saved again without a new upload)
        if (strtolower(pathinfo($storagePath, PATHINFO_EXTENSION)) === 'webp' && $image->width() <= self::MAX_WIDTH) {
            return $storagePath;
        }

        $newPath = preg_replace('/\.[^.\/]+$/', '', $storagePath) . '.webp';

        $encoded = $image->scaleDown(width: self::MAX_WIDTH)->toWebp(self::QUALITY);
        $disk->put($newPath, (string) $encoded);

        if ($newPath !== $storagePath) {
            $disk->delete($storagePath);
        }

        return $newPath;
    }
}
