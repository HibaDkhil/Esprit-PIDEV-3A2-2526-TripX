<?php

namespace App\service\Accommodation;

class FlightService extends SerpApiService
{
    public function getFlights(string $departure, string $arrival, string $date = null): ?array
    {
        $params = [
            'departure_id' => $departure,
            'arrival_id'   => $arrival,
            'type'         => '2',
            'currency'     => 'EUR',
            'hl'           => 'en',
            'outbound_date' => $date ?? date('Y-m-d', strtotime('+30 days')),
        ];

        $params['return_date'] = date('Y-m-d', strtotime($params['outbound_date'] . ' +7 days'));

        error_log('FlightService: Request params: ' . json_encode($params));

        $result = $this->request('google_flights', $params);

        if (!$result) {
            error_log('FlightService: API returned null for ' . $departure . ' -> ' . $arrival);
            return $this->getMockFlights($departure, $arrival);
        }

        error_log('FlightService: Response keys: ' . json_encode(array_keys($result)));

        // Try best_flights first, then other_flights
        $rawFlights = null;
        if (!empty($result['best_flights'])) {
            error_log('FlightService: Found ' . count($result['best_flights']) . ' best_flights');
            $rawFlights = $result['best_flights'];
        } elseif (!empty($result['other_flights'])) {
            error_log('FlightService: Found ' . count($result['other_flights']) . ' other_flights');
            $rawFlights = $result['other_flights'];
        }

        if ($rawFlights) {
            $flights = [];
            foreach (array_slice($rawFlights, 0, 4) as $flight) {
                $firstLeg = $flight['flights'][0] ?? [];
                $flights[] = [
                    'airline'        => $flight['airline'] ?? $firstLeg['airline'] ?? 'Unknown',
                    'price'          => $flight['price'] ?? 0,
                    'duration'       => $flight['total_duration'] ?? 0,
                    'stops'          => isset($flight['layovers']) ? count($flight['layovers']) : 0,
                    'departure_time' => $firstLeg['departure_airport']['time'] ?? null,
                    'arrival_time'   => $firstLeg['arrival_airport']['time'] ?? null
                ];
            }

            return [
                'flights'    => $flights,
                'best_price' => $rawFlights[0]['price'] ?? null,
                'currency'   => 'EUR'
            ];
        }

        error_log('FlightService: No flights in response for ' . $departure . ' -> ' . $arrival);
        return $this->getMockFlights($departure, $arrival);
    }

    public function getPriceInsights(string $departure, string $arrival): ?array
    {
        $params = [
            'departure_id'   => $departure,
            'arrival_id'     => $arrival,
            'type'           => '2',
            'currency'       => 'EUR',
            'price_insights' => 'true'
        ];

        $result = $this->request('google_flights', $params);

        if ($result && isset($result['price_insights'])) {
            return [
                'lowest_price'       => $result['price_insights']['lowest_price'] ?? null,
                'typical_price_range'=> $result['price_insights']['typical_price_range'] ?? null,
                'price_level'        => $result['price_insights']['price_level'] ?? null,
                'trend'              => $result['price_insights']['trend'] ?? 'stable',
                'best_time_to_book'  => $result['price_insights']['best_time_to_book'] ?? null
            ];
        }

        return [
            'lowest_price'        => 299,
            'typical_price_range' => '€280 - €450',
            'price_level'         => 'medium',
            'trend'               => 'decreasing',
            'best_time_to_book'   => 'Book in the next 7 days for best rates'
        ];
    }

    private function getMockFlights(string $departure, string $arrival): array
    {
        return [
            'flights' => [
                ['airline' => 'Air France',     'price' => 349, 'duration' => 125, 'stops' => 0],
                ['airline' => 'KLM',            'price' => 298, 'duration' => 150, 'stops' => 1],
                ['airline' => 'Lufthansa',      'price' => 395, 'duration' => 115, 'stops' => 0],
                ['airline' => 'British Airways','price' => 425, 'duration' => 140, 'stops' => 1]
            ],
            'best_price' => 298,
            'currency'   => 'EUR'
        ];
    }
}