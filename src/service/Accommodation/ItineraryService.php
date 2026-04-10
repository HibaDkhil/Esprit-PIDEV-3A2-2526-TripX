<?php

namespace App\service\Accommodation;

class ItineraryService
{
    private CacheService $cache;
    private string $apiKey;

    public function __construct(CacheService $cache, string $geminiApiKey)
    {
        $this->cache  = $cache;
        $this->apiKey = $geminiApiKey;

        error_log('ItineraryService - Gemini Key loaded: ' . ($this->apiKey ? 'YES (length: ' . strlen($this->apiKey) . ')' : 'NO'));
    }

    public function generateItinerary(string $city, array $attractions, int $days = 3): ?string
    {
        $cacheKey = 'itinerary_gemini_' . $city . '_' . md5(implode(',', $attractions) . $days);

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $attractionsList = !empty($attractions)
            ? implode(', ', array_slice($attractions, 0, 8))
            : 'top local attractions';

        $dayBlocks = '';
        for ($i = 1; $i <= $days; $i++) {
            $dayBlocks .= "🌟 DAY {$i}: [Day Title]\n";
            $dayBlocks .= "• Morning: [activity with time]\n";
            $dayBlocks .= "• Afternoon: [activity with time]\n";
            $dayBlocks .= "• Evening: [activity with time]\n";
            $dayBlocks .= "• Dinner recommendation: [restaurant name]\n\n";
        }

        $prompt = "You are a travel expert. Create detailed, practical itineraries using emojis for visual appeal.\n\n"
            . "Create a {$days}-day travel itinerary for {$city}.\n"
            . "Popular attractions: {$attractionsList}.\n\n"
            . "Format the itinerary EXACTLY like this:\n\n"
            . $dayBlocks
            . "💡 Travel Tips:\n"
            . "- [tip 1]\n- [tip 2]\n- [tip 3]\n\n"
            . "Use actual place names and realistic times. Keep it engaging and practical.";

        if (empty($this->apiKey)) {
            error_log('ItineraryService: No API key configured, using mock');
            return $this->getMockItinerary($city, $days);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $this->apiKey
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'contents' => [
                [
                    'parts' => [['text' => $prompt]]
                ]
            ],
            'generationConfig' => [
                'temperature'     => 0.7,
                'maxOutputTokens' => 2000,
            ],
        ]));

        $response  = curl_exec($ch);
        $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            error_log('ItineraryService: cURL error: ' . $curlError);
            return $this->getMockItinerary($city, $days);
        }

        if ($httpCode !== 200) {
            error_log('ItineraryService: Gemini HTTP ' . $httpCode . ' - ' . $response);
            return $this->getMockItinerary($city, $days);
        }

        $data      = json_decode($response, true);
        $itinerary = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$itinerary) {
            error_log('ItineraryService: Empty Gemini response: ' . json_encode($data));
            return $this->getMockItinerary($city, $days);
        }

        $this->cache->set($cacheKey, $itinerary, 604800);
        return $itinerary;
    }

    private function getMockItinerary(string $city, int $days): string
    {
        $templates = [
            ['title' => 'Cultural Immersion',  'morning' => 'Breakfast at a local café (9:00 AM)',          'afternoon' => 'Historic district & main landmarks (11:00 AM)', 'evening' => 'Authentic local cuisine experience (7:00 PM)',    'dinner' => 'La Belle Époque'],
            ['title' => 'Arts & Architecture', 'morning' => 'City art museum & galleries (10:00 AM)',        'afternoon' => 'Walking tour of architectural sites (1:00 PM)', 'evening' => 'Sunset from the iconic viewpoint (6:00 PM)',     'dinner' => 'Le Jardin Secret'],
            ['title' => 'Nature & Relaxation', 'morning' => 'City park or botanical gardens (9:30 AM)',      'afternoon' => 'Local markets & boutiques (1:00 PM)',           'evening' => 'Rooftop farewell dinner (7:30 PM)',              'dinner' => 'Le Toit Terrasse'],
            ['title' => 'Hidden Gems',         'morning' => 'Neighbourhood walking tour (9:00 AM)',          'afternoon' => 'Local artisan workshops (1:30 PM)',             'evening' => 'Jazz bar or live music venue (8:00 PM)',         'dinner' => 'Bistrot du Coin'],
            ['title' => 'Day Trip',            'morning' => 'Scenic trip to nearby town (8:30 AM)',          'afternoon' => 'Explore the surrounding countryside (12:00 PM)','evening' => 'Return & relaxed dinner (7:00 PM)',              'dinner' => 'Le Grand Café'],
            ['title' => 'Shopping & Leisure',  'morning' => 'Famous shopping streets (10:00 AM)',            'afternoon' => 'Afternoon tea & people-watching (2:00 PM)',     'evening' => 'Rooftop cocktails with city views (6:30 PM)',    'dinner' => 'Brasserie Lumière'],
            ['title' => 'Gastronomy Tour',     'morning' => 'Food market & tasting tour (9:00 AM)',          'afternoon' => 'Cooking class with local chef (1:00 PM)',       'evening' => 'Fine dining experience (7:30 PM)',               'dinner' => 'Chez le Chef'],
        ];

        $lines = [];
        for ($i = 1; $i <= $days; $i++) {
            $t       = $templates[($i - 1) % count($templates)];
            $lines[] = "🌟 DAY {$i}: {$t['title']}";
            $lines[] = "• Morning: {$t['morning']}";
            $lines[] = "• Afternoon: {$t['afternoon']}";
            $lines[] = "• Evening: {$t['evening']}";
            $lines[] = "• Dinner recommendation: {$t['dinner']}";
            $lines[] = '';
        }

        $lines[] = "💡 Travel Tips:";
        $lines[] = "• Book popular attractions in advance to skip queues";
        $lines[] = "• Learn a few local phrases — locals appreciate the effort";
        $lines[] = "• Use public transport for an authentic experience";
        $lines[] = "• Keep some cash for local markets and small shops";
        $lines[] = "• Check the local weather forecast before each day";

        return implode("\n", $lines);
    }
}