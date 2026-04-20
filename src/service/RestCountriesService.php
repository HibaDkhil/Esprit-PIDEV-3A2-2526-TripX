<?php

namespace App\service;

use App\service\Accommodation\CacheService;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class RestCountriesService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private ?CacheService $cache = null,
        private ?LoggerInterface $logger = null
    ) {}

    /**
     * Get detailed country information with caching (from first version)
     * 
     * @return array{
     *   name?: string,
     *   cca2?: string,
     *   flagSvg?: string,
     *   flagPng?: string,
     *   region?: string,
     *   subregion?: string,
     *   capital?: string,
     *   currencies?: array<int, array{code: string, name?: string, symbol?: string}>,
     *   languages?: string[],
     * }|null
     */
    public function getCountryByName(string $countryName): ?array
    {
        $countryName = trim($countryName);
        if ($countryName === '') {
            return null;
        }

        $cacheKey = 'restcountries_name_' . mb_strtolower($countryName);
        if ($this->cache && $this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        try {
            $resp = $this->httpClient->request('GET', 'https://restcountries.com/v3.1/name/' . rawurlencode($countryName), [
                'query' => [
                    'fullText' => 'true',
                    'fields' => 'name,cca2,flags,region,subregion,capital,currencies,languages',
                ],
            ]);

            $arr = $resp->toArray(false);
            if (!is_array($arr) || !isset($arr[0]) || !is_array($arr[0])) {
                if ($this->cache) {
                    $this->cache->set($cacheKey, null, 86400);
                }
                return null;
            }

            $country = $this->normalizeCountryData($arr[0]);
            if ($this->cache) {
                $this->cache->set($cacheKey, $country, 86400); // 24h
            }
            return $country;
        } catch (\Throwable $e) {
            if ($this->logger) {
                $this->logger->error('RestCountries error (getCountryByName): ' . $e->getMessage());
            } else {
                error_log('RestCountries error: ' . $e->getMessage());
            }
            return null;
        }
    }

    /**
     * Fetch country information including flag and local time based on timezones (from second version)
     */
    public function getCountryInfo(string $countryName): ?array
    {
        if (empty(trim($countryName))) {
            return null;
        }

        try {
            $response = $this->httpClient->request('GET', 'https://restcountries.com/v3.1/name/' . urlencode($countryName), [
                'query' => [
                    'fullText' => 'true'
                ],
                'timeout' => 3.0 // Short timeout to avoid blocking page load
            ]);

            if ($response->getStatusCode() !== 200) {
                // Try a fuzzy search if exact match fails
                $response = $this->httpClient->request('GET', 'https://restcountries.com/v3.1/name/' . urlencode($countryName), [
                    'timeout' => 3.0
                ]);

                if ($response->getStatusCode() !== 200) {
                    if ($this->logger) {
                        $this->logger->warning('RestCountriesService: API returned status ' . $response->getStatusCode() . ' for ' . $countryName);
                    }
                    return null;
                }
            }

            $data = $response->toArray();

            if (empty($data) || !isset($data[0])) {
                return null;
            }

            $countryData = $data[0];
            $flagUrl = $countryData['flags']['svg'] ?? null;
            $timezones = $countryData['timezones'] ?? [];

            // Calculate current local time
            $localTimeStr = null;
            if (!empty($timezones)) {
                $localTimeStr = $this->calculateLocalTime($timezones);
            }

            return [
                'flag' => $flagUrl,
                'timezones' => $timezones,
                'localTime' => $localTimeStr
            ];

        } catch (\Exception $e) {
            if ($this->logger) {
                $this->logger->error('RestCountriesService: Exception during API call: ' . $e->getMessage());
            }
            return null;
        }
    }

    /**
     * Calculate local time based on timezone offset
     */
    private function calculateLocalTime(array $timezones): ?string
    {
        if (empty($timezones)) {
            return null;
        }

        // Use the first timezone generally
        $firstTz = $timezones[0]; // e.g., "UTC+01:00", "UTC-05:00", "UTC"
        
        $offset = 0;
        if ($firstTz !== 'UTC') {
            // Extract +01:00 or -05:00
            $offsetStr = str_replace('UTC', '', $firstTz);
            $sign = substr($offsetStr, 0, 1) === '-' ? -1 : 1;
            $parts = explode(':', substr($offsetStr, 1));
            if (count($parts) === 2) {
                $offset = $sign * ((int)$parts[0] * 3600 + (int)$parts[1] * 60);
            }
        }

        // Create a timezone with the exact offset in seconds
        $tzName = timezone_name_from_abbr('', $offset, 0);
        if (!$tzName) {
            // Fallback formatting if timezone alias can't be guessed
            $gmtString = 'GMT' . ($offset >= 0 ? '+' : '-') . gmdate('H:i', abs($offset));
            $dt = new \DateTime('now', new \DateTimeZone($gmtString));
        } else {
            $dt = new \DateTime('now', new \DateTimeZone($tzName));
        }
        
        return $dt->format('l, g:i A'); // e.g. "Tuesday, 3:45 PM"
    }

    /**
     * Normalize country data from API response
     * 
     * @param array<string,mixed> $countryData
     * @return array<string,mixed>
     */
    private function normalizeCountryData(array $countryData): array
    {
        $currencies = [];
        if (isset($countryData['currencies']) && is_array($countryData['currencies'])) {
            foreach ($countryData['currencies'] as $code => $meta) {
                if (!is_array($meta)) {
                    continue;
                }
                $currencies[] = [
                    'code' => (string) $code,
                    'name' => isset($meta['name']) ? (string) $meta['name'] : null,
                    'symbol' => isset($meta['symbol']) ? (string) $meta['symbol'] : null,
                ];
            }
        }

        $languages = [];
        if (isset($countryData['languages']) && is_array($countryData['languages'])) {
            foreach ($countryData['languages'] as $lang) {
                if (is_string($lang) && $lang !== '') {
                    $languages[] = $lang;
                }
            }
        }

        $capital = null;
        if (isset($countryData['capital']) && is_array($countryData['capital']) && isset($countryData['capital'][0]) && is_string($countryData['capital'][0])) {
            $capital = $countryData['capital'][0];
        }

        return [
            'name' => $countryData['name']['common'] ?? null,
            'cca2' => $countryData['cca2'] ?? null,
            'flagSvg' => $countryData['flags']['svg'] ?? null,
            'flagPng' => $countryData['flags']['png'] ?? null,
            'region' => $countryData['region'] ?? null,
            'subregion' => $countryData['subregion'] ?? null,
            'capital' => $capital,
            'currencies' => $currencies,
            'languages' => $languages,
        ];
    }
}