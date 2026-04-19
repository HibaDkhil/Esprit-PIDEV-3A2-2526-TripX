<?php

namespace App\service;

use App\Entity\Transport;
use App\Entity\Schedule;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class AccessibilitySpeechService
{
    private HttpClientInterface $client;
    private string $apiKey;

    public function __construct(
        HttpClientInterface $client,
        #[Autowire(env: 'ELEVENLABS_API_KEY')] string $apiKey = ''
    ) {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function speakTransportDetails(Transport $t, ?Schedule $s = null, int $seats = 1, string $travelClass = 'ECONOMY'): string
    {
        $provider = $t->getProviderName();
        $model = $t->getVehicleModel();

        $message = "Your Trip X booking is being processed. You are traveling with {$provider} on a {$model}. ";

        if ($s) {
            if ($t->getTransportType() === 'FLIGHT') {
                $depTime = $s->getDepartureDatetime() ? $s->getDepartureDatetime()->format('H:i') : '';
                if ($depTime) {
                    $message .= "Departure is at {$depTime}. ";
                }
            } else {
                $start = $s->getRentalStart() ? $s->getRentalStart()->format('F jS') : '';
                if ($start) {
                    $message .= "Rental starts on {$start}. ";
                }
            }

            // Enhanced Price Logic: Handle multipliers and seat counts
            $classMult = match (strtoupper($travelClass)) {
                'PREMIUM' => 1.5,
                'BUSINESS' => 2.2,
                'FIRST' => 3.0,
                default => 1.0,
            };

            $unitPrice = $t->getBasePrice() * $s->getPriceMultiplier() * $classMult;
            $totalPrice = $unitPrice * $seats;
            
            $formattedPrice = number_format($totalPrice, 0);
            $message .= "The total price for {$seats} passenger" . ($seats > 1 ? "s" : "") . " is {$formattedPrice} euros. ";
        } else {
            $formattedPrice = number_format($t->getBasePrice(), 0);
            $message .= "The base price is {$formattedPrice} euros. ";
        }

        $message .= "Have a safe trip!";

        // Fallback if no API key
        if (empty($this->apiKey)) {
            $encodedText = urlencode($message);
            return 'BROWSER_TTS:' . $message;
        }

        try {
            // ElevenLabs voice ID — "Adam" (Standard American for clear English accent)
            $voiceId = 'pNInz6obpgnuMvtmZi4L';

            $response = $this->client->request('POST',
                "https://api.elevenlabs.io/v1/text-to-speech/{$voiceId}", [
                'headers' => [
                    'xi-api-key'   => $this->apiKey,
                    'Content-Type' => 'application/json',
                    'Accept'       => 'audio/mpeg',
                ],
                'json' => [
                    'text'     => $message,
                    'model_id' => 'eleven_multilingual_v2',
                    'voice_settings' => [
                        'stability'        => 0.5,
                        'similarity_boost' => 0.75,
                    ],
                ],
            ]);

            // ElevenLabs returns raw MP3 bytes directly
            $audioBytes = $response->getContent();
            return 'data:audio/mpeg;base64,' . base64_encode($audioBytes);

        } catch (\Exception $e) {
            // Fallback if API call fails (matches the Twig template's preferred fallback)
            return 'BROWSER_TTS:' . $message;
        }
    }
}