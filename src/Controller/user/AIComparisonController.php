<?php

namespace App\Controller\user;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AIComparisonController extends AbstractController
{
    private EntityManagerInterface $em;
    private HttpClientInterface $httpClient;
    
    public function __construct(EntityManagerInterface $em, HttpClientInterface $httpClient)
    {
        $this->em = $em;
        $this->httpClient = $httpClient;
    }
    
    #[Route('/accommodations/compare', name: 'accommodations_compare', methods: ['POST'])]
    public function compare(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $ids = $data['ids'] ?? [];
        
        if (count($ids) < 2 || count($ids) > 3) {
            return $this->json(['error' => 'Please select 2 or 3 accommodations to compare'], 400);
        }
        
        // Fetch accommodations with their details
        $conn = $this->em->getConnection();
        $accommodations = [];
        
        foreach ($ids as $id) {
            $accommodation = $conn->fetchAssociative(
                "SELECT a.*, 
                        MIN(r.price_per_night) as min_price,
                        COUNT(DISTINCT r.id) as available_rooms
                 FROM accommodation a
                 LEFT JOIN room r ON r.accommodation_id = a.id AND r.is_available = 1
                 WHERE a.id = :id AND a.status = 'Active'
                 GROUP BY a.id",
                ['id' => $id]
            );
            
            if ($accommodation) {
                // Clean up amenities
                $amenities = $accommodation['accommodation_amenities'] ?? '';
                if (!empty($amenities)) {
                    $amenitiesArray = array_filter(array_map('trim', explode(',', $amenities)));
                    $amenities = implode(', ', $amenitiesArray);
                }
                
                $accommodations[] = [
                    'id' => (int) $accommodation['id'],
                    'name' => $accommodation['name'] ?? 'Unknown',
                    'type' => $accommodation['type'] ?? 'Not specified',
                    'city' => $accommodation['city'] ?? 'Not specified',
                    'country' => $accommodation['country'] ?? 'Not specified',
                    'stars' => (int) ($accommodation['stars'] ?? 0),
                    'rating' => (float) ($accommodation['rating'] ?? 0),
                    'minPrice' => (float) ($accommodation['min_price'] ?? 0),
                    'availableRooms' => (int) ($accommodation['available_rooms'] ?? 0),
                    'amenities' => $amenities ?: 'None listed',
                    'description' => $accommodation['description'] ?? 'No description available'
                ];
            }
        }
        
        if (count($accommodations) < 2) {
            return $this->json(['error' => 'Could not find the selected accommodations'], 404);
        }
        
        // Call Groq AI API
        $aiAnalysis = $this->callGroqAI($accommodations);
        
        return $this->json([
            'accommodations' => $accommodations,
            'ranking' => $aiAnalysis['ranking'] ?? [],
            'comparison' => $aiAnalysis['comparison'] ?? [],
            'insights' => $aiAnalysis['insights'] ?? 'Analysis complete. All properties offer unique experiences.'
        ]);
    }
    
    private function callGroqAI(array $accommodations): array
    {
        $apiKey = $_ENV['GROQ_API_KEY'] ?? getenv('GROQ_API_KEY');
        
        if (empty($apiKey)) {
            return $this->fallbackAnalysis($accommodations);
        }
        
        // Prepare the prompt for Groq
        $prompt = $this->buildPrompt($accommodations);
        
        try {
            $response = $this->httpClient->request('POST', 'https://api.groq.com/openai/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'mixtral-8x7b-32768',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You are a travel and hospitality expert specializing in accommodation comparison. Provide detailed, unbiased comparisons with scores out of 10 for each property. Return your analysis in valid JSON format with the following structure: {"ranking":[{"name":"Property Name","score":8.5}],"comparison":[{"name":"Property Name","price":150,"stars":4,"rating":4.5,"amenities":"..."}],"insights":"Your detailed insights here"}'
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 2000,
                ]
            ]);
            
            $result = $response->toArray();
            $content = $result['choices'][0]['message']['content'] ?? '';
            
            // Extract JSON from the response
            $jsonMatch = preg_match('/\{.*\}/s', $content, $matches);
            if ($jsonMatch) {
                $analysis = json_decode($matches[0], true);
                if (json_last_error() === JSON_ERROR_NONE && isset($analysis['ranking'])) {
                    return $analysis;
                }
            }
            
            // Fallback if JSON parsing fails
            return $this->fallbackAnalysis($accommodations);
            
        } catch (\Exception $e) {
            // Log error and return fallback
            error_log('Groq API error: ' . $e->getMessage());
            return $this->fallbackAnalysis($accommodations);
        }
    }
    
    private function buildPrompt(array $accommodations): string
    {
        $prompt = "Compare the following accommodations and provide a detailed analysis:\n\n";
        
        foreach ($accommodations as $index => $acc) {
            $prompt .= sprintf(
                "Property %d: %s\n- Type: %s\n- Location: %s, %s\n- Star Rating: %d/5\n- Guest Rating: %.1f/5\n- Price per night: €%.0f\n- Available Rooms: %d\n- Amenities: %s\n- Description: %s\n\n",
                $index + 1,
                $acc['name'],
                $acc['type'],
                $acc['city'],
                $acc['country'],
                $acc['stars'],
                $acc['rating'],
                $acc['minPrice'],
                $acc['availableRooms'],
                $acc['amenities'],
                substr($acc['description'], 0, 200)
            );
        }
        
        $prompt .= "Please provide:\n1. A ranking with scores out of 10 for each property\n2. A side-by-side comparison table of key features\n3. Intelligent insights about which property might be best for different types of travelers (business, family, luxury, budget)\n4. Highlight unique selling points of each property\n\nReturn only valid JSON.";
        
        return $prompt;
    }
    
    private function fallbackAnalysis(array $accommodations): array
    {
        // Calculate simple ranking based on stars, rating, and price
        $ranking = [];
        foreach ($accommodations as $acc) {
            // Score calculation: stars (30%), rating (50%), price value (20%)
            $maxPrice = max(array_column($accommodations, 'minPrice'));
            $minPrice = min(array_column($accommodations, 'minPrice'));
            
            $priceScore = 0;
            if ($maxPrice > $minPrice) {
                $priceScore = (($maxPrice - $acc['minPrice']) / ($maxPrice - $minPrice)) * 10;
            } else {
                $priceScore = 8;
            }
            
            $starsScore = ($acc['stars'] / 5) * 10;
            $ratingScore = ($acc['rating'] / 5) * 10;
            
            $totalScore = ($starsScore * 0.3) + ($ratingScore * 0.5) + ($priceScore * 0.2);
            $ranking[] = [
                'name' => $acc['name'],
                'score' => round($totalScore, 1)
            ];
        }
        
        // Sort by score descending
        usort($ranking, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });
        
        // Prepare comparison data
        $comparison = [];
        foreach ($accommodations as $acc) {
            $comparison[] = [
                'name' => $acc['name'],
                'type' => $acc['type'],
                'city' => $acc['city'],
                'stars' => $acc['stars'] . ' ★',
                'rating' => $acc['rating'] . ' / 5',
                'price' => '€' . number_format($acc['minPrice'], 0),
                'available_rooms' => $acc['availableRooms'],
                'amenities' => substr($acc['amenities'], 0, 80) . (strlen($acc['amenities']) > 80 ? '...' : '')
            ];
        }
        
        // Generate insights
        $bestOverall = $ranking[0]['name'];
        $bestValueIndex = array_search(min(array_column($accommodations, 'minPrice')), array_column($accommodations, 'minPrice'));
        $bestValue = $accommodations[$bestValueIndex]['name'];
        $highestRatedIndex = array_search(max(array_column($accommodations, 'rating')), array_column($accommodations, 'rating'));
        $highestRated = $accommodations[$highestRatedIndex]['name'];
        
        $insights = sprintf(
            "🏆 **Best Overall**: %s (Score: %.1f/10)\n\n💰 **Best Value**: %s at €%.0f per night\n\n⭐ **Highest Rated**: %s with a guest rating of %.1f/5\n\n**Recommendations**:\n- For **luxury seekers**: %s offers premium amenities and service\n- For **budget travelers**: %s provides excellent value for money\n- For **business travelers**: Look for properties with business amenities like WiFi, meeting rooms, and central locations\n- For **families**: Consider properties with family-friendly amenities like pools, spacious rooms, and central locations",
            $bestOverall,
            $ranking[0]['score'],
            $bestValue,
            $accommodations[$bestValueIndex]['minPrice'],
            $highestRated,
            $accommodations[$highestRatedIndex]['rating'],
            $bestOverall,
            $bestValue
        );
        
        return [
            'ranking' => $ranking,
            'comparison' => $comparison,
            'insights' => $insights
        ];
    }
}