<?php

namespace App\service;

use App\service\Accommodation\CacheService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CalendarificService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheService $cache,
        private string $calendarificApiKey
    ) {}

    /**
     * Fetch holidays for a given country (ISO 3166-1 alpha-2, ex: "TN", "FR").
     *
     * @return array{ok: bool, meta?: array<string,mixed>, holidays: array<int, array<string,mixed>>, error?: string}
     */
    public function getHolidays(string $countryCode, int $year, ?int $month = null, ?int $day = null): array
    {
        $countryCode = strtoupper(trim($countryCode));
        if ($countryCode === '' || $year < 1970 || $year > 2100) {
            return ['ok' => false, 'error' => 'Invalid countryCode/year', 'holidays' => []];
        }

        if ($this->calendarificApiKey === '' || $this->calendarificApiKey === 'your_api_key_here') {
            // Keep module functional even without key (demo can enable later).
            return ['ok' => false, 'error' => 'CALENDARIFIC_API_KEY is not configured', 'holidays' => []];
        }

        $cacheKey = 'calendarific_' . $countryCode . '_' . $year . '_' . ($month ?? 'all') . '_' . ($day ?? 'all');
        if ($this->cache->has($cacheKey)) {
            $cached = $this->cache->get($cacheKey);
            return is_array($cached) ? $cached : ['ok' => false, 'holidays' => []];
        }

        try {
            $query = [
                'api_key' => $this->calendarificApiKey,
                'country' => $countryCode,
                'year' => $year,
            ];
            if ($month !== null) $query['month'] = $month;
            if ($day !== null) $query['day'] = $day;

            $resp = $this->httpClient->request('GET', 'https://calendarific.com/api/v2/holidays', [
                'query' => $query,
            ]);

            $data = $resp->toArray(false);
            $meta = (isset($data['meta']) && is_array($data['meta'])) ? $data['meta'] : null;
            $code = is_array($meta) && isset($meta['code']) ? (int) $meta['code'] : $resp->getStatusCode();

            if ($code >= 400) {
                $msg = null;
                if (isset($meta['error_type']) && is_string($meta['error_type'])) $msg = $meta['error_type'];
                if (isset($meta['error_detail']) && is_string($meta['error_detail'])) $msg = ($msg ? ($msg . ': ' . $meta['error_detail']) : $meta['error_detail']);
                if (!$msg) $msg = 'Calendarific request failed (HTTP ' . $code . ')';

                $result = [
                    'ok' => false,
                    'error' => $msg,
                    'meta' => is_array($meta) ? $meta : null,
                    'holidays' => [],
                ];
                $this->cache->set($cacheKey, $result, 900); // cache errors shortly (15m)
                return $result;
            }

            $holidays = $data['response']['holidays'] ?? [];
            if (!is_array($holidays)) $holidays = [];

            // Cache for 12h (holidays don't change often but this keeps it responsive).
            $result = [
                'ok' => true,
                'meta' => is_array($meta) ? $meta : null,
                'holidays' => $holidays,
            ];
            $this->cache->set($cacheKey, $result, 43200);
            return $result;
        } catch (\Throwable $e) {
            error_log('Calendarific error: ' . $e->getMessage());
            return ['ok' => false, 'error' => $e->getMessage(), 'holidays' => []];
        }
    }
}

