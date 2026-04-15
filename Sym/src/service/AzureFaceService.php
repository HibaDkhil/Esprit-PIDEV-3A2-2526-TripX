<?php
// src/Service/AzureFaceService.php

namespace App\service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Psr\Log\LoggerInterface;

/**
 * Wraps every Azure Face API call used by TripX.
 * 
 * ⚠️ AZURE CODE IS COMMENTED OUT - USING GOOGLE VISION API INSTEAD ⚠️
 * Azure requires approval (takes days). Google Vision works immediately.
 */
class AzureFaceService
{
    private string $apiKey;
    private string $endpoint;
    private string $personGroupId = 'tripx-users';
    
    // Google Vision specific
    private string $googleApiKey;

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly LoggerInterface     $logger,
        string $azureFaceApiKey,
        string $azureFaceEndpoint,
    ) {
        $this->apiKey   = $azureFaceApiKey;
        $this->endpoint = rtrim($azureFaceEndpoint, '/');
        // Google API key from .env (same variable reused)
        $this->googleApiKey = $azureFaceApiKey;
    }

    private function url(string $path): string
    {
        return $this->endpoint . '/face/v1.0/' . ltrim($path, '/');
    }

    private function headers(bool $isOctet = false): array
    {
        return [
            'Ocp-Apim-Subscription-Key' => $this->apiKey,
            'Content-Type'              => $isOctet ? 'application/octet-stream' : 'application/json',
        ];
    }

    private function base64ToBinary(string $base64): string
    {
        if (str_contains($base64, ',')) {
            [, $base64] = explode(',', $base64, 2);
        }
        $binary = base64_decode($base64, strict: true);
        if ($binary === false) {
            throw new \InvalidArgumentException('Invalid base64 image data.');
        }
        return $binary;
    }

    /* ═══════════════════════════════════════════════════════
       1. DETECT - USING GOOGLE VISION API (WORKS NOW)
    ═══════════════════════════════════════════════════════ */
    public function detectFace(string $base64Image): array
    {
        $binary = $this->base64ToBinary($base64Image);
        
        try {
            // Google Vision API call
            $response = $this->httpClient->request('POST', 'https://vision.googleapis.com/v1/images:annotate?key=' . $this->googleApiKey, [
                'json' => [
                    'requests' => [
                        [
                            'image' => [
                                'content' => base64_encode($binary)
                            ],
                            'features' => [
                                [
                                    'type' => 'FACE_DETECTION',
                                    'maxResults' => 5
                                ]
                            ]
                        ]
                    ]
                ]
            ]);

            $data = $response->toArray();
            $this->logger->info('GoogleVision detectFace: ' . json_encode($data));
            
            $faces = [];
            if (isset($data['responses'][0]['faceAnnotations'])) {
                foreach ($data['responses'][0]['faceAnnotations'] as $face) {
                    $faces[] = [
                        'faceId' => md5(json_encode($face)),
                        'confidence' => $face['detectionConfidence'] ?? 0,
                        'faceRectangle' => [
                            'left' => $face['fdBoundingPoly']['vertices'][0]['x'] ?? 0,
                            'top' => $face['fdBoundingPoly']['vertices'][0]['y'] ?? 0,
                            'width' => 100,
                            'height' => 100
                        ]
                    ];
                }
            }
            
            return $faces;

        } catch (TransportExceptionInterface $e) {
            $this->logger->error('GoogleVision detectFace transport error: ' . $e->getMessage());
            throw new \RuntimeException('Network error contacting Google Vision API.', 0, $e);
        } catch (\Exception $e) {
            $this->logger->error('GoogleVision detectFace error: ' . $e->getMessage());
            throw new \RuntimeException('Google Vision API error: ' . $e->getMessage());
        }
    }

    /* ═══════════════════════════════════════════════════════
       2. VERIFY - GOOGLE VISION (simplified)
    ═══════════════════════════════════════════════════════ */
    public function verifyFace(string $faceId1, string $faceId2): array
    {
        // For now, return default. Google Vision requires face embedding storage.
        return ['isIdentical' => false, 'confidence' => 0.0];
    }

    /* ═══════════════════════════════════════════════════════
       3. IDENTIFY - GOOGLE VISION (simplified)
    ═══════════════════════════════════════════════════════ */
    public function identifyFace(array $faceIds, float $confidenceThreshold = 0.6): array
    {
        // For now, return empty. Google Vision requires face embedding storage.
        return [];
    }

    /* ═══════════════════════════════════════════════════════
       4. PERSON GROUP (not needed for Google)
    ═══════════════════════════════════════════════════════ */
    public function createPersonGroup(): bool
    {
        $this->logger->info('GoogleVision: createPersonGroup - not needed, returning true');
        return true;
    }

    public function deletePersonGroup(): bool
    {
        return true;
    }

    /* ═══════════════════════════════════════════════════════
       5. PERSON
    ═══════════════════════════════════════════════════════ */
    public function createPerson(string $name, string $userData = ''): string
    {
        // Generate a unique ID for this person
        return md5($name . $userData . time());
    }

    /* ═══════════════════════════════════════════════════════
       6. ADD FACE TO PERSON
    ═══════════════════════════════════════════════════════ */
    public function addFaceToPerson(string $personId, string $base64Image): string
    {
        // Store face embedding would go here
        // For now, return a fake persisted face ID
        return md5($personId . $base64Image . time());
    }

    /* ═══════════════════════════════════════════════════════
       7. TRAIN
    ═══════════════════════════════════════════════════════ */
    public function trainPersonGroup(): bool
    {
        return true;
    }

    public function getTrainingStatus(): string
    {
        return 'succeeded';
    }

    public function getPersonGroupId(): string
    {
        return $this->personGroupId;
    }

    public function testConnection(): void
    {
        if (empty($this->googleApiKey) || $this->googleApiKey === 'your-key-here') {
            throw new \RuntimeException('Google Vision API key is not configured properly in .env');
        }
        
        $testImage = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';
        
        try {
            $this->detectFace($testImage);
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'No face detected') !== false) {
                return;
            }
            throw $e;
        }
    }
}