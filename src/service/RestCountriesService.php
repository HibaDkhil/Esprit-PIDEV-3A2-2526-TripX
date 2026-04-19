<?php

namespace App\service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class RestCountriesService
{
    private HttpClientInterface $httpClient;
    private LoggerInterface $logger;

    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    /**
     * Fetch country information including flag and local time based on timezones
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
                    $this->logger->warning('RestCountriesService: API returned status ' . $response->getStatusCode() . ' for ' . $countryName);
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
                
                $localTimeStr = $dt->format('l, g:i A'); // e.g. "Tuesday, 3:45 PM"
            }

            return [
                'flag' => $flagUrl,
                'timezones' => $timezones,
                'localTime' => $localTimeStr
            ];

        } catch (\Exception $e) {
            $this->logger->error('RestCountriesService: Exception during API call: ' . $e->getMessage());
            return null;
        }
    }
}
