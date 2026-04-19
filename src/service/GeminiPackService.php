<?php

namespace App\service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeminiPackService
{
    private const ENDPOINT = 'https://api.groq.com/openai/v1/chat/completions';

    public function __construct(
        private HttpClientInterface $httpClient,
        private string $apiKey
    ) {}

    public function generateJson(string $prompt): array
    {
        $response = $this->httpClient->request('POST', self::ENDPOINT, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'model'    => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
            ],
        ]);

        $data = $response->toArray();
        $text = $data['choices'][0]['message']['content'] ?? '';

        // Strip markdown fences if present
        $text = preg_replace('/^```(?:json)?\s*/i', '', trim($text));
        $text = preg_replace('/\s*```$/', '', $text);

        $decoded = json_decode(trim($text), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Invalid JSON from API: ' . json_last_error_msg() . "\nRaw: $text");
        }

        return $decoded;
    }
}