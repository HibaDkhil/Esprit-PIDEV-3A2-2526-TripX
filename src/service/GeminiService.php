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

        $prompt = "You are Aria, the TripX travel assistant. Talk like a real person in a chat: natural, warm, concise.\n\n";

        $prompt .= "CONVERSATION STYLE (most important):\n";
        $prompt .= "- Greetings (hi, hello), thanks, jokes, \"no\", \"yes\", or short follow-ups → reply in 1–4 sentences. Do NOT dump lists or catalogue data.\n";
        $prompt .= "- Answer the *latest* message. If they disagree or say \"no\", acknowledge it and ask what they'd prefer next.\n";
        $prompt .= "- Only give bullet lists or several picks when they clearly want ideas, options, or a plan (e.g. trip ideas, where to go, hotels, activities).\n";
        $prompt .= "- Never repeat the same long template twice in a row. Vary your wording.\n\n";

        if ($userInfo && isset($userInfo['firstName'])) {
            $prompt .= "User's first name: " . $userInfo['firstName'] . ".\n\n";
        }

        if ($preferences) {
            $prompt .= "Saved preferences (use when relevant):\n";
            if (isset($preferences['budgetMinPerNight']) && $preferences['budgetMinPerNight']) {
                $prompt .= "- Budget: roughly $" . $preferences['budgetMinPerNight'] . "–" . ($preferences['budgetMaxPerNight'] ?? 'open') . " per night\n";
            }
            if (isset($preferences['preferredClimate']) && $preferences['preferredClimate']) {
                $prompt .= "- Climate: " . $preferences['preferredClimate'] . "\n";
            }
            if (isset($preferences['travelPace']) && $preferences['travelPace']) {
                $prompt .= "- Pace: " . $preferences['travelPace'] . "\n";
            }
            if (isset($preferences['groupType']) && $preferences['groupType']) {
                $prompt .= "- Group: " . $preferences['groupType'] . "\n";
            }
            $prompt .= "\n";
        }

        if (!empty($destinations)) {
            $prompt .= "TripX catalogue — destinations you may recommend (only these; if none fit, say so honestly):\n";
            $lines = [];
            foreach (array_slice($destinations, 0, 40) as $dest) {
                $lines[] = $dest['name'] . " (" . $dest['country'] . ", " . ($dest['type'] ?? 'place') . ")";
            }
            $prompt .= implode("; ", $lines) . "\n\n";
        }

        if (!empty($activities)) {
            $prompt .= "Sample activities in the system (name — tie to destinations when you mention them):\n";
            $actLines = [];
            foreach (array_slice($activities, 0, 25) as $a) {
                $actLines[] = $a['name'] . " (" . ($a['category'] ?? 'activity') . ")";
            }
            $prompt .= implode("; ", $actLines) . "\n\n";
        }

        if (!empty($accommodations)) {
            $prompt .= "Hotels / stays in TripX data you can name when asked about accommodation:\n";
            $prompt .= implode(", ", array_slice($accommodations, 0, 12)) . "\n\n";
        }

        $prompt .= "RULES:\n";
        $prompt .= "1. Prefer destinations from the TripX list; mention real hotel names from the accommodation list when relevant.\n";
        $prompt .= "2. Keep replies readable: short chat by default, longer only when they want detail.\n";
        $prompt .= "3. Light emoji is OK (not every line).\n\n";
        $prompt .= "User message:\n" . $userMessage . "\n\n";
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