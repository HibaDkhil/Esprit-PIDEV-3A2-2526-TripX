<?php

namespace App\service\HealthCheck;

use Laminas\Diagnostics\Check\CheckInterface;
use Laminas\Diagnostics\Result\ResultInterface;
use Laminas\Diagnostics\Result\Success;
use Laminas\Diagnostics\Result\Failure;
use Laminas\Diagnostics\Result\Warning;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ElevenLabsStatusCheck implements CheckInterface
{
    private HttpClientInterface $client;
    private string $apiKey;

    public function __construct(HttpClientInterface $client, string $elevenLabsApiKey)
    {
        $this->client = $client;
        $this->apiKey = $elevenLabsApiKey;
    }

    public function check(): ResultInterface
    {
        $apiKey = trim($this->apiKey);
        if (empty($apiKey)) {
            return new Failure('ElevenLabs API Key is missing in the .env configuration.');
        }

        try {
            // Since this API key is highly restricted (TTS generation only),
            // we perform a "heartbeat" by sending a POST to the TTS endpoint.
            // Even if the request is malformed (no text), a 400/422 status 
            // confirms the API key was AUTHENTICATED.
            $voiceId = 'EXAVITQu4vr4xnSDxMaL'; // Rachel - common default
            $response = $this->client->request('POST', "https://api.elevenlabs.io/v1/text-to-speech/{$voiceId}", [
                'headers' => [
                    'xi-api-key' => $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [], // Empty payload to avoid consuming quota
                'timeout' => 5,
            ]);

            $status = $response->getStatusCode();

            // If we get 200, 400, or 422, the API key is VALID.
            // A 401 would mean the key is invalid.
            if ($status === 200 || $status === 400 || $status === 422) {
                return new Success('Successfully authenticated with ElevenLabs API.');
            }

            return new Warning('API returned status ' . $status . ': ' . $response->getContent(false));

        } catch (\Exception $e) {
            // Connection errors are failures
            return new Failure('Connection to ElevenLabs failed: ' . $e->getMessage());
        }
    }

    private function extractTier(array $userData): string
    {
        return $userData['subscription']['tier'] ?? 'unknown tier';
    }

    public function getLabel(): string
    {
        return 'ElevenLabs Status Check';
    }
}
