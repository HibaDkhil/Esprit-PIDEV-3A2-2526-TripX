<?php

namespace App\service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class WeatherService
{
    private HttpClientInterface $httpClient;
    private LoggerInterface $logger;
    private string $apiKey;

    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger, string $apiKey = '')
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
        // The API key should be injected via services.yaml ideally, but we'll handle fallback to env here or passed value
        $this->apiKey = $apiKey ?: (isset($_ENV['OPENWEATHER_API_KEY']) ? $_ENV['OPENWEATHER_API_KEY'] : '');
    }

    /**
     * Get current weather for coordinates.
     * Returns an array with temp, condition, and icon code.
     */
    public function getWeather(float $lat, float $lng): ?array
    {
        if (empty($this->apiKey) || $this->apiKey === 'your_openweather_api_key_here') {
            $this->logger->warning('WeatherService: OPENWEATHER_API_KEY is not set or is placeholder.');
            return null;
        }

        try {
            $response = $this->httpClient->request('GET', 'https://api.openweathermap.org/data/2.5/weather', [
                'query' => [
                    'lat' => $lat,
                    'lon' => $lng,
                    'appid' => $this->apiKey,
                    'units' => 'metric', // Use Celsius
                ],
            ]);

            if ($response->getStatusCode() !== 200) {
                $this->logger->error('WeatherService: API returned status ' . $response->getStatusCode());
                return null;
            }

            $data = $response->toArray();

            return [
                'temp' => round($data['main']['temp']),
                'condition' => ucfirst($data['weather'][0]['description'] ?? 'Clear'),
                'icon' => $data['weather'][0]['icon'] ?? '01d',
                'humidity' => $data['main']['humidity'] ?? null,
                'wind' => $data['wind']['speed'] ?? null,
            ];

        } catch (\Exception $e) {
            $this->logger->error('WeatherService: Exception during API call: ' . $e->getMessage());
            return null;
        }
    }
}
