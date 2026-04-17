<?php

namespace App\service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeminiService
{
    private string $apiKey;
    private string $model;
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient, string $geminiApiKey, string $geminiModel)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $geminiApiKey;
        $this->model = $geminiModel;
    }

    public function chat(string $userMessage, array $context = []): string
    {
        // Truncate context to prevent 400 errors (too large payload)
        if (isset($context['activities']) && is_array($context['activities']) && count($context['activities']) > 50) {
            $context['activities'] = array_slice($context['activities'], 0, 50);
        }
        if (isset($context['destinations']) && is_array($context['destinations']) && count($context['destinations']) > 20) {
            $context['destinations'] = array_slice($context['destinations'], 0, 20);
        }

        $prompt = $this->buildPrompt($userMessage, $context);
    
    // Log for debugging
    error_log('ARIA Prompt: ' . substr($prompt, 0, 500));
    
    if ($this->apiKey === '' || $this->apiKey === 'your_api_key_here') {
        throw new \RuntimeException('Gemini API key is not configured (set GEMINI_API_KEY in .env).');
    }

    $response = $this->httpClient->request('POST', "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}", [
        'json' => [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.88,
                'maxOutputTokens' => 1024,
            ]
        ],
        'verify_peer' => false,
        'verify_host' => false
    ]);

    $status = $response->getStatusCode();
    $data = $response->toArray(false);

    error_log('ARIA Response: ' . json_encode($data));

    if ($status >= 400) {
        $msg = $data['error']['message'] ?? ('HTTP ' . $status);
        throw new \RuntimeException('Gemini API: ' . $msg);
    }

    if (isset($data['promptFeedback']['blockReason'])) {
        throw new \RuntimeException('Gemini blocked this request (' . ($data['promptFeedback']['blockReason'] ?? 'policy') . ').');
    }

    if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
        $reason = $data['candidates'][0]['finishReason'] ?? ($data['error']['message'] ?? json_encode($data));
        throw new \RuntimeException('Gemini returned no text: ' . $reason);
    }

    return $data['candidates'][0]['content']['parts'][0]['text'];
}

    private function buildPrompt(string $userMessage, array $context): string
    {
        $userInfo = $context['user'] ?? [];
        $preferences = $context['preferences'] ?? [];
        $destinations = $context['destinations'] ?? [];
        $activities = $context['activities'] ?? [];
        $accommodations = $context['accommodations'] ?? [];
        $history = $context['history'] ?? [];

        $prompt = "You are Aria, the TripX travel assistant. Talk like a real person in a chat: natural, warm, concise.\n\n";

        $prompt .= "CONVERSATION STYLE (most important):\n";
        $prompt .= "- Greetings: Only greet the user by name (Hi [Name]!) if this is the absolute start of the conversation. If there is already history, just respond normally to the latest message.\n";
        $prompt .= "- DO NOT ask clarifying questions unless absolutely necessary. Be extremely proactive. If a user asks for 'anything' or 'suggestions', instantly pick 2-3 specific options from the provided TripX catalogue and present them with enthusiasm.\n";
        $prompt .= "- Answer the *latest* message concisely. Total response length: 1–3 sentences usually.\n";
        $prompt .= "- When a user asks for a hotel, flight, or activity, output actual names from the provided catalogue immediately.\n\n";

        if ($userInfo && isset($userInfo['firstName'])) {
            $prompt .= "User's first name: " . $userInfo['firstName'] . ".\n\n";
        }

        if (!empty($history)) {
            $prompt .= "RECENT CONVERSATION HISTORY:\n";
            foreach ($history as $h) {
                $role = $h['role'] === 'user' ? 'User' : 'Aria';
                $prompt .= $role . ": " . $h['content'] . "\n";
            }
            $prompt .= "\n";
        }

        if ($preferences) {
            $prompt .= "Saved preferences (use when relevant):\n";
            if (isset($preferences['budgetMinPerNight']) && $preferences['budgetMinPerNight']) {
                $prompt .= "- Budget: $" . $preferences['budgetMinPerNight'] . "–" . ($preferences['budgetMaxPerNight'] ?? 'open') . "\n";
            }
            if (isset($preferences['preferredClimate']) && $preferences['preferredClimate']) {
                $prompt .= "- Climate: " . $preferences['preferredClimate'] . "\n";
            }
            if (isset($preferences['travelPace']) && $preferences['travelPace']) {
                $prompt .= "- Pace: " . $preferences['travelPace'] . "\n";
            }
            $prompt .= "\n";
        }

        if (!empty($destinations)) {
            $prompt .= "TripX catalogue — destinations: ";
            $lines = [];
            foreach (array_slice($destinations, 0, 15) as $dest) {
                $lines[] = $dest['name'];
            }
            $prompt .= implode(", ", $lines) . "\n\n";
        }

        if (!empty($activities)) {
            $prompt .= "Sample activities: ";
            $actLines = [];
            foreach (array_slice($activities, 0, 10) as $a) {
                $actLines[] = $a['name'];
            }
            $prompt .= implode(", ", $actLines) . "\n\n";
        }

        $prompt .= "User message: " . $userMessage . "\n";
        $prompt .= "Aria:";

        return $prompt;
    }


    public function analyzeImage(string $imageBase64, string $userMessage, string $mimeType = 'image/jpeg'): string
    {
        $prompt = "You are Aria, a travel assistant. The user uploaded a travel-related image and said: \"$userMessage\". ";
        $prompt .= "Analyze the image and respond helpfully. If it's a travel photo (landmark, beach, mountain, etc.), ";
        $prompt .= "identify it if possible and suggest similar destinations. Be friendly and enthusiastic! Respond in 2-3 sentences.";

        if ($this->apiKey === '' || $this->apiKey === 'your_api_key_here') {
            throw new \RuntimeException('Gemini API key is not configured (set GEMINI_API_KEY in .env).');
        }

        $response = $this->httpClient->request('POST', "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}", [
            'json' => [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                            ['inlineData' => [
                                'mimeType' => $mimeType ?: 'image/jpeg',
                                'data' => $imageBase64
                            ]]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 500,
                ]
            ],
            'verify_peer' => false,
            'verify_host' => false
        ]);

        $status = $response->getStatusCode();
        $data = $response->toArray(false);

        if ($status >= 400) {
            throw new \RuntimeException('Gemini API: ' . ($data['error']['message'] ?? ('HTTP ' . $status)));
        }

        if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            throw new \RuntimeException('Gemini returned no text for this image.');
        }

        return $data['candidates'][0]['content']['parts'][0]['text'];
    }
    
}