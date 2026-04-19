<?php
namespace App\service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TransportOptimalRouteService
{
    private HttpClientInterface $httpClient;
    private string $groqApiKey;

    public function __construct(HttpClientInterface $httpClient, string $groqApiKey)
    {
        $this->httpClient = $httpClient;
        $this->groqApiKey = $groqApiKey;
    }

    public function generateTransportOptimalRouteReport(
        float $pickupLat, float $pickupLon,
        float $dropoffLat, float $dropoffLon,
        string $pickupAddress, string $dropoffAddress
    ): string {
        try {
            $metrics = $this->fetchRouteMetrics($pickupLat, $pickupLon, $dropoffLat, $dropoffLon);
        } catch (\Exception $e) {
            return "Could not fetch route from routing engine.\nReason: " . $e->getMessage();
        }

        $plainSummary = $this->buildPlainSummary($metrics, $pickupAddress, $dropoffAddress);

        if (empty($this->groqApiKey)) {
            return $plainSummary . "\n\nAI note: API key is missing in .env file.";
        }

        $aiText = $this->askGroq($metrics, $pickupAddress, $dropoffAddress);

        if (empty($aiText)) {
            return $plainSummary . "\n\nAI note: Groq response unavailable. Showing routing engine result.";
        }

        return $aiText . "\n\n---\n" . $plainSummary;
    }

    private function fetchRouteMetrics(
        float $pickupLat, float $pickupLon,
        float $dropoffLat, float $dropoffLon
    ): array {
        $url = "https://router.project-osrm.org/route/v1/driving/"
            . $pickupLon . "," . $pickupLat . ";"
            . $dropoffLon . "," . $dropoffLat
            . "?overview=false&alternatives=false&steps=false";

        $response = $this->httpClient->request('GET', $url, [
            'timeout' => 12,
            'headers' => ['Accept' => 'application/json'],
            'verify_peer' => false,
            'verify_host' => false,
        ]);

        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            throw new \RuntimeException("Routing API HTTP " . $response->getStatusCode());
        }

        $data = $response->toArray();

        if (empty($data['routes'][0])) {
            throw new \RuntimeException("No route data found in response.");
        }

        $route = $data['routes'][0];

        return [
            'distanceKm'      => $route['distance'] / 1000.0,
            'durationMinutes' => $route['duration'] / 60.0,
        ];
    }

    private function askGroq(array $metrics, string $pickupAddress, string $dropoffAddress): ?string
    {
        try {
            $userPrompt = "Pickup: " . $this->safeText($pickupAddress) . "\n"
                . "Drop-off: " . $this->safeText($dropoffAddress) . "\n"
                . "Estimated distance: " . number_format($metrics['distanceKm'], 2) . " km\n"
                . "Estimated duration: " . round($metrics['durationMinutes']) . " minutes\n\n"
                . "Give a concise travel recommendation: best route choice, expected travel time, and one practical tip.";

            $response = $this->httpClient->request('POST', 'https://api.groq.com/openai/v1/chat/completions', [
                'timeout'     => 30,
                'verify_peer' => false,
                'verify_host' => false,
                'headers'     => [
                    'Authorization' => 'Bearer ' . trim($this->groqApiKey),
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'model'       => 'llama-3.1-8b-instant',
                    'temperature' => 0.2,
                    'max_tokens'  => 220,
                    'messages'    => [
                        [
                            'role'    => 'system',
                            'content' => 'You are a travel route assistant. Be concise and practical.',
                        ],
                        [
                            'role'    => 'user',
                            'content' => $userPrompt,
                        ],
                    ],
                ],
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode >= 300) {
                // Return the actual error from Groq so we can debug it
                $body = $response->getContent(false);
                return "AI error (HTTP $statusCode): $body";
            }

            $data = $response->toArray();
            return $data['choices'][0]['message']['content'] ?? null;

        } catch (\Exception $ex) {
            // Return the actual exception message so we can debug it
            return "AI exception: " . $ex->getMessage();
        }
    }

    private function buildPlainSummary(array $metrics, string $pickupAddress, string $dropoffAddress): string
    {
        return "Route engine summary\n"
            . "From: " . $this->safeText($pickupAddress) . "\n"
            . "To: " . $this->safeText($dropoffAddress) . "\n"
            . "Distance: " . number_format($metrics['distanceKm'], 2) . " km\n"
            . "Fastest time (est.): " . round($metrics['durationMinutes']) . " minutes";
    }

    private function safeText(?string $value): string
    {
        if (empty($value) || $value === 'Address not resolved yet.') return 'N/A';
        return $value;
    }
}
