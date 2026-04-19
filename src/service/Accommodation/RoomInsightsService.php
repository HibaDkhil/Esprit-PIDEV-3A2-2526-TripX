<?php

namespace App\service\Accommodation;

use App\Entity\Room;
use App\Repository\RoomRepository;
use App\Repository\RoomImagesRepository;
use Doctrine\ORM\EntityManagerInterface;

class RoomInsightsService
{
    private RoomRepository $roomRepo;
    private RoomImagesRepository $imgRepo;
    private EntityManagerInterface $em;
    private ?string $raggedGemini;

    public function __construct(
        RoomRepository $roomRepo,
        RoomImagesRepository $imgRepo,
        EntityManagerInterface $em,
        string $raggedGemini = ''
    ) {
        $this->roomRepo = $roomRepo;
        $this->imgRepo = $imgRepo;
        $this->em = $em;
        $this->raggedGemini = $raggedGemini ?: null;

        error_log('RoomInsightsService - Gemini Key loaded: ' . ($this->raggedGemini ? 'YES (length: ' . strlen($this->raggedGemini) . ')' : 'NO'));
    }

    public function analyzeRooms(array $rooms): array
    {
        if (empty($rooms)) {
            return [
                'summary' => $this->getEmptySummary(),
                'rooms' => [],
                'criticalIssues' => [],
                'warnings' => [],
                'tips' => []
            ];
        }

        $prices = array_filter(array_map(fn($r) => $r->getPricePerNight(), $rooms));
        $avgPrice = !empty($prices) ? array_sum($prices) / count($prices) : 0;
        $medianPrice = $this->calculateMedian($prices);
        $priceStdDev = $this->calculateStdDev($prices, $avgPrice);

        $roomAnalysis = [];
        $criticalIssues = [];
        $warnings = [];
        $allTips = [];

        foreach ($rooms as $room) {
            $analysis = $this->analyzeSingleRoom($room, $avgPrice, $medianPrice, $priceStdDev);
            $roomAnalysis[$room->getId()] = $analysis;

            if ($analysis['severity'] === 'critical') {
                $criticalIssues[] = $analysis;
            } elseif ($analysis['severity'] === 'warning') {
                $warnings[] = $analysis;
            }

            foreach ($analysis['tips'] as $tip) {
                $allTips[] = $tip;
            }
        }

        $aiInsights = $this->getGeminiInsights($rooms, $roomAnalysis, $avgPrice);

        return [
            'summary' => [
                'totalRooms' => count($rooms),
                'avgPrice' => round($avgPrice, 2),
                'medianPrice' => round($medianPrice, 2),
                'priceStdDev' => round($priceStdDev, 2),
                'criticalCount' => count($criticalIssues),
                'warningCount' => count($warnings),
                'averageQualityScore' => !empty($roomAnalysis) ? round(array_sum(array_column($roomAnalysis, 'qualityScore')) / count($roomAnalysis), 1) : 0,
                'aiInsights' => $aiInsights
            ],
            'rooms' => $roomAnalysis,
            'criticalIssues' => $criticalIssues,
            'warnings' => $warnings,
            'tips' => array_slice(array_unique($allTips), 0, 5)
        ];
    }

    private function analyzeSingleRoom(Room $room, float $avgPrice, float $medianPrice, float $priceStdDev): array
    {
        $price = $room->getPricePerNight() ?? 0;
        $priceDeviation = $avgPrice > 0 ? (($price - $avgPrice) / $avgPrice) * 100 : 0;
        $isPriceHigh = $priceDeviation > 100;
        $isPriceLow = $priceDeviation < -50;
        $isPriceExtreme = $price > ($avgPrice + 3 * $priceStdDev) && $priceStdDev > 0;

        $capacity = $room->getCapacity() ?? 1;
        $pricePerPerson = $price / $capacity;
        $isPricePerPersonHigh = $pricePerPerson > 300 && $capacity <= 2;

        $imageCount = $this->imgRepo->count(['room' => $room]);
        $hasImages = $imageCount > 0;
        $hasMultipleImages = $imageCount >= 3;

        $amenities = $room->getAmenities() ?? '';
        $amenitiesCount = !empty($amenities) ? count(array_filter(explode(',', $amenities))) : 0;
        $hasGoodAmenities = $amenitiesCount >= 5;

        $qualityScore = $this->calculateQualityScore($room, $imageCount, $amenitiesCount);

        $severity = 'good';
        $issues = [];
        $tips = [];

        if ($isPriceExtreme || $isPriceHigh) {
            $severity = 'critical';
            $issues[] = [
                'type' => 'price_too_high',
                'message' => "Price {$price} is extremely high (" . round($priceDeviation) . "% above average)",
                'suggestion' => "Suggested price range: " . round($avgPrice * 0.8, 2) . " - " . round($avgPrice * 1.2, 2)
            ];
            $tips[] = "Consider reducing price from {$price} to around " . round($avgPrice, 2) . " to match market rates";
        } elseif ($isPriceLow) {
            $severity = 'warning';
            $issues[] = [
                'type' => 'price_too_low',
                'message' => "Price {$price} is significantly below average (" . round(abs($priceDeviation)) . "% below)",
                'suggestion' => "You could increase price to " . round($avgPrice * 0.9, 2)
            ];
            $tips[] = "Room price seems low for this market, potential revenue opportunity of +" . round($priceDeviation * -1) . "%";
        }

        if ($isPricePerPersonHigh) {
            $severity = $severity === 'good' ? 'warning' : $severity;
            $issues[] = [
                'type' => 'price_per_person_high',
                'message' => "Price per person (${pricePerPerson}) is high for this capacity",
                'suggestion' => "Consider adjusting for solo travelers"
            ];
        }

        if (!$hasImages) {
            $severity = $severity === 'good' ? 'warning' : $severity;
            $issues[] = [
                'type' => 'no_images',
                'message' => "Room has no images",
                'suggestion' => "Add at least 3 high-quality photos to increase bookings"
            ];
            $tips[] = "Add photos to this room - listings with images get 3x more bookings";
        } elseif (!$hasMultipleImages) {
            $issues[] = [
                'type' => 'few_images',
                'message' => "Room has only {$imageCount} image(s)",
                'suggestion' => "Add more photos to showcase the room"
            ];
            $tips[] = "Add more photos to improve guest confidence";
        }

        if (!$hasGoodAmenities && $amenitiesCount > 0) {
            $issues[] = [
                'type' => 'few_amenities',
                'message' => "Only {$amenitiesCount} amenities listed",
                'suggestion' => "Add more amenities to attract guests"
            ];
            $tips[] = "Add popular amenities like WiFi, AC, breakfast to increase bookings";
        } elseif ($amenitiesCount === 0) {
            $severity = $severity === 'good' ? 'warning' : $severity;
            $issues[] = [
                'type' => 'no_amenities',
                'message' => "No amenities listed",
                'suggestion' => "Add amenities to help guests find your room"
            ];
        }

        return [
            'id' => $room->getId(),
            'roomName' => $room->getRoomName(),
            'roomType' => $room->getRoomType(),
            'price' => $price,
            'capacity' => $capacity,
            'pricePerPerson' => round($pricePerPerson, 2),
            'priceDeviation' => round($priceDeviation, 1),
            'isAvailable' => $room->isAvailable(),
            'imageCount' => $imageCount,
            'amenitiesCount' => $amenitiesCount,
            'qualityScore' => $qualityScore,
            'severity' => $severity,
            'issues' => $issues,
            'tips' => $tips
        ];
    }

    private function calculateQualityScore(Room $room, int $imageCount, int $amenitiesCount): int
    {
        $score = 50;
        $score += min(20, $imageCount * 5);
        $score += min(15, $amenitiesCount * 3);
        if ($room->isAvailable()) $score += 5;
        $nameLength = strlen($room->getRoomName() ?? '');
        if ($nameLength > 10 && $nameLength < 50) $score += 5;
        return min(100, max(0, $score));
    }

    private function getGeminiInsights(array $rooms, array $roomAnalysis, float $avgPrice): array
    {
        if (empty($this->raggedGemini)) {
            error_log('Gemini API key not configured, using fallback analysis');
            return $this->getFallbackInsights($rooms, $roomAnalysis, $avgPrice);
        }

        try {
            $prompt = $this->buildPrompt($rooms, $roomAnalysis, $avgPrice);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,
               'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $this->raggedGemini
            );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => 'You are a hotel revenue management expert. Provide concise, actionable insights for room pricing and optimization. Keep responses under 150 words. Do not use emojis. ' . $prompt
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'maxOutputTokens' => 1024,
                    'temperature' => 0.7
                ]
            ]));

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200) {
                $data = json_decode($response, true);
                $content = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
                return [
                    'generated' => true,
                    'insights'  => $content,
                    'model'     => 'Gemini 2.0 Flash'
                ];
            } else {
                error_log('Gemini API error: HTTP ' . $httpCode . ' - ' . $response);
            }
        } catch (\Exception $e) {
            error_log('Gemini API error: ' . $e->getMessage());
        }

        return $this->getFallbackInsights($rooms, $roomAnalysis, $avgPrice);
    }

    private function buildPrompt(array $rooms, array $roomAnalysis, float $avgPrice): string
    {
        $criticalCount = count(array_filter($roomAnalysis, fn($a) => $a['severity'] === 'critical'));
        $warningCount  = count(array_filter($roomAnalysis, fn($a) => $a['severity'] === 'warning'));
        $avgQuality    = !empty($roomAnalysis) ? round(array_sum(array_column($roomAnalysis, 'qualityScore')) / count($roomAnalysis), 1) : 0;

        $priceIssues = [];
        foreach ($roomAnalysis as $analysis) {
            foreach ($analysis['issues'] as $issue) {
                if (strpos($issue['type'], 'price') !== false) {
                    $priceIssues[] = $analysis['roomName'] . ': ' . $issue['message'];
                }
            }
        }

        $prompt  = "Analyze this hotel's room inventory:\n";
        $prompt .= "- Total rooms: " . count($rooms) . "\n";
        $prompt .= "- Average price: €{$avgPrice}\n";
        $prompt .= "- Average quality score: {$avgQuality}/100\n";
        $prompt .= "- Critical issues: {$criticalCount}\n";
        $prompt .= "- Warnings: {$warningCount}\n";

        if (!empty($priceIssues)) {
            $prompt .= "- Price issues: " . implode('; ', array_slice($priceIssues, 0, 3)) . "\n";
        }

        $prompt .= "\nProvide: 1) Key observation about pricing strategy, 2) One actionable recommendation to improve revenue, 3) One operational tip. Keep concise.";

        return $prompt;
    }

    private function getFallbackInsights(array $rooms, array $roomAnalysis, float $avgPrice): array
    {
        $criticalCount  = count(array_filter($roomAnalysis, fn($a) => $a['severity'] === 'critical'));
        $highPriceRooms = count(array_filter($roomAnalysis, fn($a) => $a['priceDeviation'] > 50));
        $lowPriceRooms  = count(array_filter($roomAnalysis, fn($a) => $a['priceDeviation'] < -30));

        $insight = "Based on analysis of " . count($rooms) . " rooms";

        if ($criticalCount > 0) {
            $insight .= ", {$criticalCount} room(s) require immediate attention due to pricing anomalies";
        } else {
            $insight .= ", pricing is generally consistent with market rates";
        }

        if ($highPriceRooms > 0) $insight .= ". {$highPriceRooms} room(s) appear overpriced and may benefit from reduction";
        if ($lowPriceRooms > 0)  $insight .= ". {$lowPriceRooms} room(s) are underpriced, presenting revenue opportunity";

        $insight .= ". Focus on adding photos to rooms with fewer than 3 images to improve conversion.";

        return [
            'generated' => false,
            'insights'  => $insight,
            'model'     => 'Rule-based'
        ];
    }

    private function calculateMedian(array $values): float
    {
        $count = count($values);
        if ($count === 0) return 0;
        sort($values);
        $middle = floor(($count - 1) / 2);
        if ($count % 2) return $values[$middle];
        return ($values[$middle] + $values[$middle + 1]) / 2;
    }

    private function calculateStdDev(array $values, float $mean): float
    {
        $count = count($values);
        if ($count < 2) return 0;
        $variance = array_sum(array_map(fn($x) => pow($x - $mean, 2), $values)) / $count;
        return sqrt($variance);
    }

    private function getEmptySummary(): array
    {
        return [
            'totalRooms' => 0,
            'avgPrice' => 0,
            'medianPrice' => 0,
            'priceStdDev' => 0,
            'criticalCount' => 0,
            'warningCount' => 0,
            'averageQualityScore' => 0,
            'aiInsights' => [
                'generated' => false,
                'insights'  => 'No rooms to analyze. Add rooms to see AI insights.',
                'model'     => 'N/A'
            ]
        ];
    }
}