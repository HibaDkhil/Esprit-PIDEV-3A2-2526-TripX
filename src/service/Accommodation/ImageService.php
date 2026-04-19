<?php

namespace App\service\Accommodation;

class ImageService extends SerpApiService
{
    public function getDestinationImages(string $city, string $country = null): ?array
    {
        $query = $city;
        if ($country) {
            $query .= ' ' . $country;
        }
        $query .= ' travel landmarks';
        
        $params = [
            'q' => $query,
            'num' => 12
        ];
        
        $result = $this->request('google_images', $params);
        
        if ($result && isset($result['images_results'])) {
            $images = [];
            foreach (array_slice($result['images_results'], 0, 12) as $image) {
                $images[] = [
                    'url' => $image['original'] ?? $image['thumbnail'] ?? null,
                    'thumbnail' => $image['thumbnail'] ?? null,
                    'title' => $image['title'] ?? null,
                    'source' => $image['source'] ?? null,
                    'width' => $image['original_width'] ?? null,
                    'height' => $image['original_height'] ?? null
                ];
            }
            
            return [
                'images' => $images,
                'city' => $city,
                'total' => count($images)
            ];
        }
        
        return null;
    }
}