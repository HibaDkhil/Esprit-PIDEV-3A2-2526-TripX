<?php

namespace App\service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * ARIA AI service powering the Experience Lab real-time commentary.
 * Uses your existing Groq API key from the environment.
 */
class AriaExperienceService
{
    private const GROQ_API_URL = 'https://api.groq.com/openai/v1/chat/completions';
    private const MODEL = 'llama3-8b-8192';

    private string $systemPrompt = <<<PROMPT
You are ARIA, TripX's charming AI travel concierge. You are enthusiastic, persuasive, and commercially savvy.
Your goal is to:
1. React to the traveler's preferences with genuine excitement
2. Suggest specific experiences that match their choices
3. Create FOMO (Fear of Missing Out) through urgency and exclusivity
4. Gently push premium options and current offers
5. Keep responses SHORT (2-4 sentences max), punchy, and emoji-rich.
Always end with something that makes them want to continue booking.
PROMPT;

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $groqApiKey,
    ) {
    }

    public function getLiveComment(array $answers): string
    {
        if (empty($this->groqApiKey)) {
            return $this->getFallbackComment($answers);
        }

        $userMessage = $this->buildLivePrompt($answers);

        try {
            $response = $this->httpClient->request('POST', self::GROQ_API_URL, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->groqApiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => self::MODEL,
                    'max_tokens' => 150,
                    'messages' => [
                        ['role' => 'system', 'content' => $this->systemPrompt],
                        ['role' => 'user', 'content' => $userMessage],
                    ],
                ],
                'timeout' => 8,
            ]);

            $data = $response->toArray();
            return $data['choices'][0]['message']['content'] ?? $this->getFallbackComment($answers);
        } catch (\Throwable) {
            return $this->getFallbackComment($answers);
        }
    }

    public function getFinalPitch(?array $destination, int $budget, int $savings, ?array $offer): string
    {
        $destName = $destination['name'] ?? 'your dream destination';

        if (empty($this->groqApiKey)) {
            return $this->buildFallbackPitch($destName, $budget, $savings, $offer);
        }

        $prompt = sprintf(
            'The traveler just completed their TripX profile. Their top destination is %s. '
            . 'Total estimated budget: $%d. Savings with offer: $%d. '
            . 'Offer name: %s. '
            . 'Write a POWERFUL 3-sentence commercial closing pitch. Create urgency. Use emojis.',
            $destName,
            $budget,
            $savings,
            $offer['name'] ?? 'special deal'
        );

        try {
            $response = $this->httpClient->request('POST', self::GROQ_API_URL, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->groqApiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => self::MODEL,
                    'max_tokens' => 200,
                    'messages' => [
                        ['role' => 'system', 'content' => $this->systemPrompt],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ],
                'timeout' => 8,
            ]);

            $data = $response->toArray();
            return $data['choices'][0]['message']['content'] ?? $this->buildFallbackPitch($destName, $budget, $savings, $offer);
        } catch (\Throwable) {
            return $this->buildFallbackPitch($destName, $budget, $savings, $offer);
        }
    }

    public function getDestinationAdvice(array $answers, array $destinations): string
    {
        $topDestinations = array_slice(array_map(
            fn (array $destination) => sprintf(
                '%s (%s, %s%% match)',
                $destination['name'] ?? 'Unknown',
                $destination['country'] ?? 'unknown country',
                $destination['matchScore'] ?? 90
            ),
            $destinations
        ), 0, 3);

        if (empty($this->groqApiKey)) {
            return $this->getFallbackDestinationAdvice($answers, $destinations);
        }

        $prompt = sprintf(
            'Traveler preferences: %s. Current top destination matches: %s. '
            . 'Give realtime advice on which destination to pick and why. Keep it to 2 short sentences.',
            json_encode($answers, JSON_UNESCAPED_SLASHES),
            implode('; ', $topDestinations)
        );

        try {
            $response = $this->httpClient->request('POST', self::GROQ_API_URL, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->groqApiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => self::MODEL,
                    'max_tokens' => 140,
                    'messages' => [
                        ['role' => 'system', 'content' => $this->systemPrompt],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ],
                'timeout' => 8,
            ]);

            $data = $response->toArray();
            return $data['choices'][0]['message']['content'] ?? $this->getFallbackDestinationAdvice($answers, $destinations);
        } catch (\Throwable) {
            return $this->getFallbackDestinationAdvice($answers, $destinations);
        }
    }

    public function getDeepDiveSimulation(array $plan): string
    {
        if (empty($this->groqApiKey)) {
            return $this->getFallbackSimulation($plan);
        }

        $dest = $plan['destination']['name'] ?? 'Paradise';
        $accs = implode(', ', array_column($plan['accommodations'] ?? [], 'name'));
        $acts = implode(', ', array_column($plan['activities'] ?? [], 'name'));

        $prompt = "Write a LONG, EVOCATIVE, SENSORY STORY (minimum 300 words) about a traveler experiencing a trip to $dest. "
                . "The traveler stays at $accs and does $acts. "
                . "Describe the smells, the sounds, the emotions, and the magic. "
                . "Use a poetic, high-end travel magazine style. Divide it into Day 1, Day 3, and The Final Sunset. "
                . "Use many emojis. Make it feel like a real deep-dive simulation.";

        try {
            $response = $this->httpClient->request('POST', self::GROQ_API_URL, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->groqApiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => self::MODEL,
                    'max_tokens' => 1000,
                    'messages' => [
                        ['role' => 'system', 'content' => "You are ARIA, a master storyteller and travel concierge. Your prose is lush, detailed, and captivating."],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ],
                'timeout' => 15,
            ]);

            $data = $response->toArray();
            return $data['choices'][0]['message']['content'] ?? $this->getFallbackSimulation($plan);
        } catch (\Throwable) {
            return $this->getFallbackSimulation($plan);
        }
    }

    // ─── Private helpers ─────────────────────────────────────────────────────

    private function buildLivePrompt(array $answers): string
    {
        $parts = [];
        if (!empty($answers['weather']))
            $parts[] = 'weather preference: ' . $answers['weather'];
        if (!empty($answers['group']))
            $parts[] = 'traveling as: ' . $answers['group'];
        if (!empty($answers['climate']))
            $parts[] = 'climate: ' . $answers['climate'];
        if (!empty($answers['budget']))
            $parts[] = 'budget level: ' . $answers['budget'];
        if (!empty($answers['interests']))
            $parts[] = 'interests: ' . implode(', ', (array) $answers['interests']);
        if (!empty($answers['duration']))
            $parts[] = 'duration: ' . $answers['duration'];

        return 'The traveler just answered: ' . implode('; ', $parts)
            . '. React with personalized excitement and a tempting suggestion!';
    }

    private function getFallbackComment(array $answers): string
    {
        $comments = [
            'budget' => [
                'budget' => "🎒 Smart traveler alert! We have incredible budget-friendly gems that will blow your mind WITHOUT blowing your wallet. Your adventure awaits!",
                'comfort' => "💼 Perfect choice! Comfort travelers like you get the BEST value — premium experiences at sensible prices. Let me show you what I've found!",
                'luxury' => "💎 Oh là là! You have exquisite taste! I'm pulling up our most exclusive 5-star experiences right now. This is going to be SPECTACULAR!",
            ],
            'group' => [
                'solo' => "🎒 Solo explorer mode: ACTIVATED! The world is your oyster and I've found destinations where solo travelers absolutely THRIVE!",
                'couple' => "💑 Romance is in the air! I'm curating the most enchanting couple experiences — think candlelit dinners, sunset views, and pure magic ✨",
                'family' => "👨‍👩‍👧 Family adventure incoming! I've selected kid-friendly destinations that adults secretly love even more. Everyone wins!",
                'friends' => "👯 Squad goals! The BEST trips happen with your crew. I'm finding destinations with epic group experiences and nightlife you'll talk about forever!",
            ],
        ];

        $budget = $answers['budget'] ?? 'comfort';
        $group = $answers['group'] ?? 'solo';

        if (isset($comments['budget'][$budget]))
            return $comments['budget'][$budget];
        if (isset($comments['group'][$group]))
            return $comments['group'][$group];

        return "✨ I'm analyzing your perfect trip profile right now! The results are looking AMAZING — you're going to love what I've found for you! 🌍";
    }

    private function buildFallbackPitch(string $destName, int $budget, int $savings, ?array $offer): string
    {
        $offerLine = $offer
            ? sprintf(' With the **%s** offer, you SAVE $%d instantly!', $offer['name'], $savings)
            : '';

        return sprintf(
            '🎉 Congratulations! Your dream trip to **%s** is ready! '
            . 'Total estimated cost: **$%d**.%s '
            . 'This personalized plan is exclusively yours for the next 48 hours — after that, prices may change. '
            . 'Ready to make memories? Click BOOK NOW and let the adventure begin! ✈️🌟',
            $destName,
            $budget,
            $offerLine
        );
    }

    private function getFallbackDestinationAdvice(array $answers, array $destinations): string
    {
        $top = $destinations[0]['name'] ?? 'the first match';
        $duration = $answers['duration'] ?? 'your selected duration';
        $interests = implode(', ', (array) ($answers['interests'] ?? []));

        return sprintf(
            '%s is leading right now for %s, especially with your %s interests. Add it to the simulator and compare the budget before prices shift.',
            $top,
            $duration,
            $interests ?: 'travel'
        );
    }

    private function getFallbackSimulation(array $plan): string
    {
        $dest = $plan['destination']['name'] ?? 'your destination';
        return "✨ Close your eyes. You arrive in **$dest**, and the air is thick with the scent of adventure. "
             . "The sun dips below the horizon as you check into your stay. Every detail has been crafted for you. "
             . "Tomorrow, you'll explore hidden gems and taste flavors you never knew existed. "
             . "This isn't just a trip; it's a transformation. You feel the pulse of the city, the whisper of the waves... "
             . "A LOT OF TEXT WOULD NORMALLY BE HERE FROM THE AI! (API fallback active). 🌍✨";
    }
}
