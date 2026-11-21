<?php

namespace App\Services;

use App\Models\Actie;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Typography\FontFactory;

class ImageGeneratorService
{
    private ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    /**
     * Generate an Instagram post image (4:5 ratio) for an actie
     *
     * @param Actie $actie
     * @return string Base64 encoded image data
     */
    public function generateActieImage(Actie $actie): string
    {
        // Instagram post dimensions (4:5 ratio)
        $width = 1080;
        $height = 1350;

        // Create a blank canvas with a gradient background
        $image = $this->imageManager->create($width, $height);
        
        // Add a colored background (using a gradient-like effect)
        $image = $image->fill('#2563eb'); // Blue background
        
        // Add a semi-transparent overlay rectangle for text area
        $image->drawRectangle(40, 100, function ($rectangle) use ($width, $height) {
            $rectangle->size($width - 80, $height - 200);
            $rectangle->background('rgba(255, 255, 255, 0.95)');
        });

        // Add title
        $title = $this->truncateText($actie->title, 60);
        $image->text($title, 80, 180, function (FontFactory $font) {
            $font->filename(public_path('fonts/ubuntu.bold.woff2'));
            $font->size(64);
            $font->color('#1e293b');
            $font->lineHeight(1.3);
            $font->wrap(920);
        });

        // Calculate Y position for next elements
        $currentY = 350;

        // Add date if available
        if ($actie->start_date) {
            $dateText = \Carbon\Carbon::parse($actie->start_date)->format('d-m-Y');
            if ($actie->start_time) {
                $dateText .= ' om ' . substr($actie->start_time, 0, 5);
            }
            
            $image->text('Datum: ' . $dateText, 80, $currentY, function (FontFactory $font) {
                $font->filename(public_path('fonts/ubuntu.regular.woff2'));
                $font->size(42);
                $font->color('#475569');
            });
            
            $currentY += 80;
        }

        // Add location if available
        if ($actie->location_human) {
            $locationText = $this->truncateText($actie->location_human, 40);
            $image->text('Locatie: ' . $locationText, 80, $currentY, function (FontFactory $font) {
                $font->filename(public_path('fonts/ubuntu.regular.woff2'));
                $font->size(42);
                $font->color('#475569');
            });
            
            $currentY += 100;
        }

        // Add organizer information
        $organizers = $actie->organizers;
        if ($organizers->isNotEmpty()) {
            $organizerNames = $organizers->pluck('name')->take(2)->join(', ');
            if ($organizers->count() > 2) {
                $organizerNames .= ' +' . ($organizers->count() - 2);
            }
            
            $organizerText = $this->truncateText($organizerNames, 50);
            
            $image->text('Door:', 80, $currentY, function (FontFactory $font) {
                $font->filename(public_path('fonts/ubuntu.medium.woff2'));
                $font->size(36);
                $font->color('#64748b');
            });
            
            $currentY += 60;
            
            $image->text($organizerText, 80, $currentY, function (FontFactory $font) {
                $font->filename(public_path('fonts/ubuntu.bold.woff2'));
                $font->size(48);
                $font->color('#0f172a');
            });
        }

        // Add footer with website
        $image->text('watkanikdoen.nl', $width / 2, $height - 80, function (FontFactory $font) use ($width) {
            $font->filename(public_path('fonts/ubuntu.bold.woff2'));
            $font->size(40);
            $font->color('#ffffff');
            $font->align('center');
        });

        // Encode the image as PNG
        return $image->toPng()->toString();
    }

    /**
     * Truncate text to a maximum length
     *
     * @param string $text
     * @param int $maxLength
     * @return string
     */
    private function truncateText(string $text, int $maxLength): string
    {
        if (mb_strlen($text) <= $maxLength) {
            return $text;
        }

        return mb_substr($text, 0, $maxLength - 3) . '...';
    }

    /**
     * Save generated image to storage
     *
     * @param string $imageData
     * @param string $filename
     * @return string Storage path
     */
    public function saveImage(string $imageData, string $filename): string
    {
        $path = 'generated-images/' . date('Y/m');
        $fullPath = storage_path('app/public/' . $path);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        $filePath = $path . '/' . $filename;
        file_put_contents(storage_path('app/public/' . $filePath), $imageData);

        return $filePath;
    }
}
