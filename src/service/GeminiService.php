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
        // If it still says gemini-*, use a solid Groq model instead
        $this->model = (strpos($geminiModel, 'gemini') !== false) ? 'llama-3.3-70b-versatile' : $geminiModel;
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

        if ($this->apiKey === '' || $this->apiKey === 'your_api_key_here') {
            throw new \RuntimeException('AI API key is not configured (set GEMINI_API_KEY in .env).');
        }

        // Build OpenAI-style messages
        $messages = $this->buildMessages($userMessage, $context);

        $response = $this->httpClient->request('POST', "https://api.groq.com/openai/v1/chat/completions", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => $this->model,
                'messages' => $messages,
                'temperature' => 0.8,
                'max_tokens' => 1024,
            ],
            'verify_peer' => false,
            'verify_host' => false
        ]);

        $status = $response->getStatusCode();
        $data = $response->toArray(false);

        if ($status >= 400) {
            $msg = $data['error']['message'] ?? ('HTTP ' . $status);
            throw new \RuntimeException('Groq API: ' . $msg);
        }

        if (!isset($data['choices'][0]['message']['content'])) {
            throw new \RuntimeException('Groq returned no text.');
        }

        return $data['choices'][0]['message']['content'];
    }

    private function buildMessages(string $userMessage, array $context): array
    {
        $userInfo = $context['user'] ?? [];
        $preferences = $context['preferences'] ?? [];
        $destinations = $context['destinations'] ?? [];
        $activities = $context['activities'] ?? [];
        $history = $context['history'] ?? [];

        $systemPrompt = "You are Aria, the TripX travel assistant. Your goal is to provide a highly personalized, natural, and fluid conversational experience—exactly like ChatGPT.\n\n";
        $systemPrompt .= "CONVERSATION STYLE & RULES:\n";
        $systemPrompt .= "- Natural Dialogue: NEVER use canned or repetitive intro sentences. Start each response uniquely.\n";
        $systemPrompt .= "- Real-Time Intelligence: Engage in a back-and-forth dialogue. Acknowledge mistakes naturally.\n";
        $systemPrompt .= "- Stay in Character: You are Aria. You are helpful, enthusiastic, and knowledgeable about the world.\n\n";

        if ($userInfo && isset($userInfo['firstName'])) {
            $systemPrompt .= "The user you are speaking to is named " . $userInfo['firstName'] . ".\n";
        }

        $knowledge = "TripX Catalogue Info:\n";
        if (!empty($destinations)) {
            $names = [];
            foreach (array_slice($destinations, 0, 15) as $dest) { $names[] = $dest['name']; }
            $knowledge .= "- Available Destinations: " . implode(", ", $names) . "\n";
        }
        if (!empty($activities)) {
            $actNames = [];
            foreach (array_slice($activities, 0, 10) as $a) { $actNames[] = $a['name']; }
            $knowledge .= "- Sample Activities: " . implode(", ", $actNames) . "\n";
        }

        if ($preferences) {
            $knowledge .= "User Preferences:\n";
            if (isset($preferences['preferredClimate'])) $knowledge .= "- Climate: " . $preferences['preferredClimate'] . "\n";
            if (isset($preferences['travelPace'])) $knowledge .= "- Pace: " . $preferences['travelPace'] . "\n";
        }

        $messages = [
            ['role' => 'system', 'content' => $systemPrompt . "\n" . $knowledge]
        ];

        // Add history
        foreach ($history as $h) {
            $role = ($h['role'] === 'user') ? 'user' : 'assistant';
            $messages[] = ['role' => $role, 'content' => $h['content']];
        }

        // Add current user message
        $messages[] = ['role' => 'user', 'content' => $userMessage];

        return $messages;
    }

    public function analyzeImage(string $imageBase64, string $userMessage, string $mimeType = 'image/jpeg'): string
    {
        // Groq uses slightly different model for vision
        $visionModel = 'llama-3.2-11b-vision-preview';

        $response = $this->httpClient->request('POST', "https://api.groq.com/openai/v1/chat/completions", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => $visionModel,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => "You are Aria, a travel assistant. Analyze this image and respond to the user's message: \"$userMessage\". Identify landmarks if present."
                            ],
                            [
                                'type' => 'image_url',
                                'image_url' => [
                                    'url' => "data:{$mimeType};base64,{$imageBase64}"
                                ]
                            ]
                        ]
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
            ],
            'verify_peer' => false,
            'verify_host' => false
        ]);

        $status = $response->getStatusCode();
        $data = $response->toArray(false);

        if ($status >= 400) {
            throw new \RuntimeException('Groq Vision API: ' . ($data['error']['message'] ?? ('HTTP ' . $status)));
        }

        return $data['choices'][0]['message']['content'] ?? 'I cannot see the image clearly right now.';
    }
}