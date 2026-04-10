<?php

namespace App\service\Accommodation;

class LocalService extends SerpApiService
{
    private array $categories = [
        'restaurants' => 'restaurant',
        'attractions' => 'tourist_attraction',
        'shopping' => 'shopping_mall',
        'transport' => 'transit_station'
    ];
    
    public function getNearbyPlaces(string $query, string $location): ?array
    {
        $params = [
            'q' => $query . ' in ' . $location,
            'location' => $location,
            'num' => 12
        ];
        
        $result = $this->request('google_local', $params);
        
        if ($result && isset($result['local_results'])) {
            $places = [];
            foreach (array_slice($result['local_results'], 0, 8) as $place) {
                $places[] = [
                    'name' => $place['title'] ?? 'Unknown',
                    'type' => $place['type'] ?? 'place',
                    'rating' => $place['rating'] ?? null,
                    'reviews' => $place['reviews'] ?? null,
                    'address' => $place['address'] ?? null,
                    'distance' => $place['distance'] ?? null,
                    'price' => $place['price'] ?? null,
                    'image' => $place['thumbnail'] ?? null
                ];
            }
            
            return [
                'places' => $places,
                'total' => count($places)
            ];
        }
        
        return null;
    }
    
    public function getAttractionsByCategory(string $category, string $location): ?array
    {
        $query = $this->categories[$category] ?? $category;
        return $this->getNearbyPlaces($query, $location);
    }
}