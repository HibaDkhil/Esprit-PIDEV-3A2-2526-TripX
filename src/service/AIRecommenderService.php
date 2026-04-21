<?php

namespace App\service;

use App\Entity\Destination;
use App\Entity\Accommodation;
use App\Entity\Activity;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AIRecommenderService
{
    private EntityManagerInterface $em;
    private HttpClientInterface $httpClient;
    private ?string $geminiApiKey;

    public function __construct(EntityManagerInterface $em, HttpClientInterface $httpClient, string $geminiApiKey = '')
    {
        $this->em = $em;
        $this->httpClient = $httpClient;
        $this->geminiApiKey = trim($geminiApiKey);
    }

    public function generateTripPlan(User $user): string
    {
        if (!$this->geminiApiKey) {
            return "<div class='alert alert-warning'>AI Assistant is currently unavailable (Missing API Key).</div>";
        }

        // Fetch valid data from the website's database
        $destinations = $this->em->getRepository(Destination::class)->findBy([], null, 20);
        $accommodations = $this->em->getRepository(Accommodation::class)->findBy([], null, 20);
        $activities = $this->em->getRepository(Activity::class)->findBy([], null, 20);

        $destNames = array_map(fn($d) => $d->getName() . ' (' . $d->getCountry() . ')', $destinations);
        $accNames = array_map(fn($a) => $a->getName() . ' in ' . $a->getCity(), $accommodations);
        $actNames = array_map(fn($a) => $a->getName(), $activities);

        $prompt = "You are an expert travel agent for the platform TripX. You are talking to user '{$user->getFirstName()}'.\n\n";
        $prompt .= "Available TripX Destinations:\n- " . implode("\n- ", $destNames) . "\n\n";
        $prompt .= "Available TripX Accommodations:\n- " . implode("\n- ", $accNames) . "\n\n";
        $prompt .= "Available TripX Activities:\n- " . implode("\n- ", $actNames) . "\n\n";
        $prompt .= "Task:\nGenerate a short, inspiring 3-day personalized trip itinerary for the user.\n";
        $prompt .= "IMPORTANT:\n";
        $prompt .= "1. You MUST use at least one destination, accommodation, and activity from the provided lists above to make it realistic for our platform.\n";
        $prompt .= "2. Write the response in valid HTML (using tags like <strong>, <ul>, <li>, <h3>, <br>) suitable to be injected directly into a sidebar widget. Do not wrap it in ```html markdown blocks. Keep it very short and easy to read (max 200 words).\n";
        $prompt .= "3. Be engaging and make it sound like an exclusive TripX recommendation.";

        try {
            // FIXED: Use gemini-2.5-flash (available from your API call)
            $url = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=' . $this->geminiApiKey;

            $response = $this->httpClient->request('POST', $url, [
                'verify_peer' => false,
                'verify_host' => false,
                'json' => [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 1500
                    ]
                ]
            ]);

            $data = $response->toArray();

            $html = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if ($html) {
                $html = preg_replace('/```html\n?/', '', $html);
                $html = preg_replace('/```\n?/', '', $html);
                return trim($html);
            }

            return "<div class='text-muted'>Could not generate a plan right now. Try again later!</div>";
        } catch (\Exception $e) {
            return "<div class='text-danger'>Error connecting to AI Recommender. Please try again. " . $e->getMessage() . "</div>";
        }
    }
}
