<?php

namespace App\service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageEnhancerService
{
    private string $pixianApiId;
    private string $pixianApiSecret;
    private bool $isProduction;

    public function __construct(string $pixianApiId = null, string $pixianApiSecret = null)
    {
        $this->pixianApiId = $pixianApiId ?? $_ENV['PIXIAN_API_ID'] ?? '';
        $this->pixianApiSecret = $pixianApiSecret ?? $_ENV['PIXIAN_API_SECRET'] ?? '';
        $this->isProduction = ($_ENV['APP_ENV'] ?? 'dev') === 'prod';
    }

    // REMOVE BACKGROUND USING PIXIAN.AI
    public function removeBackground(UploadedFile $file, string $targetDir): ?string
    {
        if (empty($this->pixianApiId) || empty($this->pixianApiSecret)) {
            return null; // No API configured
        }

        $ch = curl_init('https://api.pixian.ai/api/v2/remove-background');

        // Add test=true for development (free)
        if (!$this->isProduction) {
            $ch = curl_init('https://api.pixian.ai/api/v2/remove-background?test=true');
        }

        curl_setopt($ch, CURLOPT_USERPWD, $this->pixianApiId . ':' . $this->pixianApiSecret);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'image' => new \CURLFile($file->getPathname(), $file->getMimeType(), $file->getClientOriginalName()),
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        // Ensure it works on local environments that might not have updated cacert.pem
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($httpCode === 200 && $response) {
            $newFilename = 'nobg_' . uniqid() . '.png';
            file_put_contents($targetDir . '/' . $newFilename, $response);
            return '/uploads/enhanced/' . $newFilename;
        }

        // Log error for debugging
        error_log('Pixian API error: ' . $error . ' HTTP: ' . $httpCode);

        return null;
    }

    // ENHANCE IMAGE USING GD LIBRARY (FREE - Sharpening)
    public function enhanceWithGD(UploadedFile $file, string $targetDir): string
    {
        $image = null;
        $mime = $file->getMimeType();

        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($file->getPathname());
                break;
            case 'image/png':
                $image = imagecreatefrompng($file->getPathname());
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($file->getPathname());
                break;
            default:
                $image = imagecreatefromstring(file_get_contents($file->getPathname()));
        }

        if (!$image) {
            // Fallback: just save original
            $newFilename = uniqid() . '.' . $file->guessExtension();
            $file->move($targetDir, $newFilename);
            return '/uploads/posts/' . $newFilename;
        }

        // Apply sharpening filter
        $sharpenMatrix = [
            [-1, -1, -1],
            [-1, 16, -1],
            [-1, -1, -1]
        ];
        imageconvolution($image, $sharpenMatrix, 8, 0);

        $newFilename = 'enhanced_' . uniqid() . '.jpg';
        imagejpeg($image, $targetDir . '/' . $newFilename, 90);
        imagedestroy($image);

        return '/uploads/posts/' . $newFilename;
    }

    // FULL PROCESS: Enhance + Remove Background
    public function processImage(UploadedFile $file, string $targetDir): array
    {
        $results = [
            'original' => null,
            'enhanced' => null,
            'no_background' => null,
        ];

        // Save original
        $originalName = uniqid() . '.' . $file->guessExtension();
        $file->move($targetDir, $originalName);
        $results['original'] = '/uploads/posts/' . $originalName;

        // Create enhanced version
        $tempFile = new UploadedFile($targetDir . '/' . $originalName, $originalName);
        $results['enhanced'] = $this->enhanceWithGD($tempFile, $targetDir);

        // Create no-background version
        $noBgFile = new UploadedFile($targetDir . '/' . $originalName, $originalName);
        $noBgResult = $this->removeBackground($noBgFile, $targetDir);
        if ($noBgResult) {
            $results['no_background'] = $noBgResult;
        }

        return $results;
    }
}