<?php

namespace App\service\Accommodation;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageWatermarkService
{
    public function __construct(private string $projectDir) {}

    /**
     * Apply watermark to uploaded image and save it
     */
    public function applyWatermarkToUpload(UploadedFile $file, string $targetPath): void
    {
        $absolutePath = $this->projectDir . '/public/' . ltrim($targetPath, '/');
        $absoluteDir  = dirname($absolutePath);

        // Create directory if it doesn't exist
        if (!is_dir($absoluteDir)) {
            mkdir($absoluteDir, 0777, true);
        }

        // Move the uploaded file
        $file->move($absoluteDir, basename($absolutePath));

        // Apply watermark
        $this->addWatermark($absolutePath);
    }

    /**
     * Add watermark to an existing image
     */
    private function addWatermark(string $imagePath): void
    {
        $watermarkPath = $this->projectDir . '/public/images/watermark.png';

        if (!file_exists($watermarkPath)) {
            return; // No watermark file, skip
        }

        try {
            $manager = new ImageManager(Driver::class);
            $image   = $manager->read($imagePath);

            $watermark = $manager->read($watermarkPath);

            // Resize watermark to ~18% of image width
            $watermark->scale(width: (int)($image->width() * 0.18));

            // Place watermark at bottom-right with margin
            $image->place(
                element: $watermark,
                position: 'bottom-right',
                offsetX: 25,
                offsetY: 25
            );

            // Save with good quality
            $image->save($imagePath, quality: 88);

        } catch (\Exception $e) {
            // Log error but don't break upload
            error_log('Watermark failed: ' . $e->getMessage());
        }
    }

    public function isWatermarkAvailable(): bool
    {
        return file_exists($this->projectDir . '/public/images/watermark.png');
    }
}