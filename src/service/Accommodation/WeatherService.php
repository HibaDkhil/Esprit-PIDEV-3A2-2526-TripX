<?php

namespace App\service\Accommodation;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherService
{
    private HttpClientInterface $httpClient;
    private CacheService $cache;
    private string $apiKey;

    public function __construct(HttpClientInterface $httpClient, CacheService $cache, string $openWeatherApiKey)
    {
        $this->httpClient = $httpClient;
        $this->cache = $cache;
        $this->apiKey = $openWeatherApiKey;
    }

    public function getCurrentWeather(string $city, string $country = null): ?array
    {
        $query = $city;
        if ($country) {
            $query .= ',' . $country;
        }
        
        $cacheKey = "weather_current_{$query}";
        
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }
        
        try {
            $response = $this->httpClient->request('GET', 'https://api.openweathermap.org/data/2.5/weather', [
                'query' => [
                    'q' => $query,
                    'appid' => $this->apiKey,
                    'units' => 'metric',
                    'lang' => 'en'
                ]
            ]);
            
            $data = $response->toArray();
            
            if (isset($data['main'])) {
                $weatherData = [
                    'temp' => round($data['main']['temp']),
                    'temp_min' => round($data['main']['temp_min']),
                    'temp_max' => round($data['main']['temp_max']),
                    'feels_like' => round($data['main']['feels_like']),
                    'humidity' => $data['main']['humidity'],
                    'pressure' => $data['main']['pressure'],
                    'condition' => $data['weather'][0]['main'],
                    'description' => ucfirst($data['weather'][0]['description']),
                    'icon' => $data['weather'][0]['icon'],
                    'wind_speed' => $data['wind']['speed'],
                    'city' => $data['name'],
                    'country' => $data['sys']['country']
                ];
                
                $this->cache->set($cacheKey, $weatherData, 3600);
                return $weatherData;
            }
        } catch (\Exception $e) {
            // Log error
            error_log('Weather API error: ' . $e->getMessage());
        }
        
        return null;
    }

    public function getForecast(string $city, string $country = null, int $days = 5): ?array
    {
        $query = $city;
        if ($country) {
            $query .= ',' . $country;
        }
        
        $cacheKey = "weather_forecast_{$query}_{$days}";
        
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }
        
        try {
            $response = $this->httpClient->request('GET', 'https://api.openweathermap.org/data/2.5/forecast', [
                'query' => [
                    'q' => $query,
                    'appid' => $this->apiKey,
                    'units' => 'metric',
                    'cnt' => $days * 8,
                    'lang' => 'en'
                ]
            ]);
            
            $data = $response->toArray();
            
            if (isset($data['list'])) {
                $forecast = [];
                $dates = [];
                
                foreach ($data['list'] as $item) {
                    $date = date('Y-m-d', $item['dt']);
                    if (!in_array($date, $dates) && count($forecast) < $days) {
                        $dates[] = $date;
                        $forecast[] = [
                            'date' => $date,
                            'day' => date('D', $item['dt']),
                            'temp' => round($item['main']['temp']),
                            'temp_min' => round($item['main']['temp_min']),
                            'temp_max' => round($item['main']['temp_max']),
                            'condition' => $item['weather'][0]['main'],
                            'description' => ucfirst($item['weather'][0]['description']),
                            'icon' => $item['weather'][0]['icon']
                        ];
                    }
                }
                
                $this->cache->set($cacheKey, $forecast, 21600);
                return $forecast;
            }
        } catch (\Exception $e) {
            error_log('Weather Forecast API error: ' . $e->getMessage());
        }
        
        return null;
    }
}