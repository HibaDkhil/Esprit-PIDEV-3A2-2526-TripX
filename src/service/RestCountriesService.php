<?php

namespace App\service;

use App\service\Accommodation\CacheService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RestCountriesService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheService $cache
    ) {}

    /**
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
        if ($this->cache->has($cacheKey)) {
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
                $this->cache->set($cacheKey, null, 86400);
                return null;
            }

            $country = $this->normalize($arr[0]);
            $this->cache->set($cacheKey, $country, 86400); // 24h
            return $country;
        } catch (\Throwable $e) {
            error_log('RestCountries error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * @param array<string,mixed> $c
     * @return array<string,mixed>
     */
    private function normalize(array $c): array
    {
        $currencies = [];
        if (isset($c['currencies']) && is_array($c['currencies'])) {
            foreach ($c['currencies'] as $code => $meta) {
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
        if (isset($c['languages']) && is_array($c['languages'])) {
            foreach ($c['languages'] as $lang) {
                if (is_string($lang) && $lang !== '') {
                    $languages[] = $lang;
                }
            }
        }

        $capital = null;
        if (isset($c['capital']) && is_array($c['capital']) && isset($c['capital'][0]) && is_string($c['capital'][0])) {
            $capital = $c['capital'][0];
        }

        return [
            'name' => $c['name']['common'] ?? null,
            'cca2' => $c['cca2'] ?? null,
            'flagSvg' => $c['flags']['svg'] ?? null,
            'flagPng' => $c['flags']['png'] ?? null,
            'region' => $c['region'] ?? null,
            'subregion' => $c['subregion'] ?? null,
            'capital' => $capital,
            'currencies' => $currencies,
            'languages' => $languages,
        ];
    }
}

