<?php

namespace App\service\Accommodation;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class SerpApiService
{
    protected HttpClientInterface $httpClient;
    protected CacheService $cache;
    protected string $apiKey;

    public function __construct(HttpClientInterface $httpClient, CacheService $cache, string $serpApiKey)
    {
        $this->httpClient = $httpClient;
        $this->cache = $cache;
        $this->apiKey = $serpApiKey;
    }

    protected function request(string $engine, array $params = []): ?array
    {
        $params['engine'] = $engine;
        $params['api_key'] = $this->apiKey;
        
        $cacheKey = 'serpapi_' . $engine . '_' . md5(json_encode($params));
        
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }
        
        try {
            $url = 'https://serpapi.com/search.json?' . http_build_query($params);
            error_log('SerpApi Request: ' . $url);
            
            $response = $this->httpClient->request('GET', $url);
            $data = $response->toArray();
            
            if (!isset($data['error'])) {
                $this->cache->set($cacheKey, $data, 21600); // Cache for 6 hours
                return $data;
            } else {
                error_log('SerpApi Error: ' . json_encode($data['error']));
            }
        } catch (\Exception $e) {
            error_log('SerpApi Exception: ' . $e->getMessage());
        }
        
        return null;
    }
}