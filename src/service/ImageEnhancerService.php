<?php

namespace App\service;

use Psr\Log\LoggerInterface;

/**
 * Blog Image Enhancer Service
 *
 * Provides two primary image enhancement features:
 *  1. AI Background Removal via Pixian.ai
 *  2. Smart Sharpening via PHP GD convolution
 */
class ImageEnhancerService
{
    private string $pixianId;
    private string $pixianSecret;
    private string $appEnv;
    private ?LoggerInterface $logger;

    public function __construct(
        string $pixianId,
        string $pixianSecret,
        string $appEnv,
        ?LoggerInterface $logger = null
    ) {
        $this->pixianId     = $pixianId;
        $this->pixianSecret = $pixianSecret;
        $this->appEnv       = $appEnv;
        $this->logger       = $logger;
    }

    // ── AI Background Removal (Pixian.ai) ────────────────────────────────

    /**
     * Remove the background from an image using the Pixian.ai API.
     *
     * @param string $filePath Absolute path to the source image file
     * @return string|null     Absolute path to the result PNG, or null on failure
     */
    public function removeBackground(string $filePath): ?string
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            $this->log('warning', 'removeBackground: file not found or unreadable', ['path' => $filePath]);
            return null;
        }

        if ($this->pixianId === '' || $this->pixianId === 'replace-with-your-pixian-id') {
            $this->log('warning', 'removeBackground: Pixian API credentials not configured');
            return null;
        }

        $curlFile = new \CURLFile($filePath);

        $postFields = [
            'image' => $curlFile,
        ];

        // In dev mode, use the free test endpoint to avoid consuming credits
        if ($this->appEnv === 'dev') {
            $postFields['test'] = 'true';
        }

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => 'https://api.pixian.ai/v2/remove-background',
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $postFields,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_HTTPHEADER     => [
                'Accept: image/png',
            ],
            CURLOPT_USERPWD        => $this->pixianId . ':' . $this->pixianSecret,
        ]);

        $response   = curl_exec($ch);
        $httpCode   = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError  = curl_error($ch);
        curl_close($ch);

        if ($curlError !== '') {
            $this->log('error', 'removeBackground: cURL error', ['error' => $curlError]);
            return null;
        }

        if ($httpCode !== 200 || empty($response)) {
            $this->log('error', 'removeBackground: API returned non-200', [
                'httpCode' => $httpCode,
                'response' => substr((string) $response, 0, 500),
            ]);
            return null;
        }

        // Save the result as a PNG next to the original
        $info       = pathinfo($filePath);
        $outputPath = $info['dirname'] . '/' . $info['filename'] . '-nobg.png';

        if (file_put_contents($outputPath, $response) === false) {
            $this->log('error', 'removeBackground: could not write output file', ['path' => $outputPath]);
            return null;
        }

        $this->log('info', 'removeBackground: success', ['output' => $outputPath]);
        return $outputPath;
    }

    // ── Smart Sharpening (Local GD) ──────────────────────────────────────

    /**
     * Sharpen an image using a convolution matrix (PHP GD).
     *
     * The sharpening matrix increases edge contrast to make details pop.
     * The result overwrites the original file with an optimized version.
     *
     * @param string $filePath Absolute path to the image file
     * @return bool            True on success, false on failure
     */
    public function sharpen(string $filePath): bool
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            $this->log('warning', 'sharpen: file not found or unreadable', ['path' => $filePath]);
            return false;
        }

        if (!extension_loaded('gd')) {
            $this->log('error', 'sharpen: PHP GD extension is not loaded');
            return false;
        }

        $image = $this->createGdImageFromFile($filePath);
        if ($image === null) {
            return false;
        }

        // Sharpening convolution matrix
        $sharpenMatrix = [
            [-1, -1, -1],
            [-1, 16, -1],
            [-1, -1, -1],
        ];
        $divisor = 8; // sum of matrix = 8
        $offset  = 0;

        $result = imageconvolution($image, $sharpenMatrix, $divisor, $offset);
        if (!$result) {
            $this->log('error', 'sharpen: imageconvolution failed', ['path' => $filePath]);
            imagedestroy($image);
            return false;
        }

        // Save back in the original format with optimized quality
        $saved = $this->saveGdImage($image, $filePath);
        imagedestroy($image);

        if ($saved) {
            $this->log('info', 'sharpen: success', ['path' => $filePath]);
        }

        return $saved;
    }

    // ── Internal helpers ─────────────────────────────────────────────────

    /**
     * Create a GD image resource from a file path.
     */
    private function createGdImageFromFile(string $filePath): ?\GdImage
    {
        $mime = mime_content_type($filePath);

        $image = match ($mime) {
            'image/jpeg', 'image/jpg' => @imagecreatefromjpeg($filePath),
            'image/png'               => @imagecreatefrompng($filePath),
            'image/webp'              => @imagecreatefromwebp($filePath),
            'image/gif'               => @imagecreatefromgif($filePath),
            default                   => false,
        };

        if ($image === false) {
            $this->log('error', 'createGdImageFromFile: unsupported or corrupt image', [
                'path' => $filePath,
                'mime' => $mime,
            ]);
            return null;
        }

        return $image;
    }

    /**
     * Save a GD image back to disk in a web-friendly format with optimized quality.
     */
    private function saveGdImage(\GdImage $image, string $filePath): bool
    {
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        return match ($ext) {
            'jpg', 'jpeg' => imagejpeg($image, $filePath, 88),
            'png'         => imagepng($image, $filePath, 6),
            'webp'        => imagewebp($image, $filePath, 85),
            'gif'         => imagegif($image, $filePath),
            default       => imagejpeg($image, $filePath, 88),
        };
    }

    private function log(string $level, string $message, array $context = []): void
    {
        if ($this->logger !== null) {
            $this->logger->log($level, '[ImageEnhancer] ' . $message, $context);
        }
    }
}
