<?php

namespace App\service;

use App\Entity\Destination;
use App\Repository\DestinationRepository;

/**
 * Scores and ranks destinations based on user preferences using a weighted algorithm.
 *
 * Weights:
 *   Rating    → 30%
 *   Climate   → 25%
 *   Popularity→ 20%
 *   Type      → 15%
 *   Budget    → 10%
 */
class RecommendationService
{
    private DestinationRepository $repository;

    private const WEIGHT_RATING     = 30;
    private const WEIGHT_CLIMATE    = 25;
    private const WEIGHT_POPULARITY = 20;
    private const WEIGHT_TYPE       = 15;
    private const WEIGHT_BUDGET     = 10;

    public function __construct(DestinationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return scored & sorted destination recommendations.
     *
     * @param array $preferences User preferences:
     *   - season:    string|null  (spring, summer, autumn, winter, all_year)
     *   - type:      string|null  (city, beach, mountain, …)
     *   - minRating: float|null   (0–5)
     *   - maxBudget: float|null
     *   - minBudget: float|null
     * @param int $limit Max results to return
     *
     * @return array<int, array{destination: Destination, score: float, matchReasons: string[]}>
     */
    public function getRecommendations(array $preferences, int $limit = 9): array
    {
        $destinations = $this->repository->findAll();

        if (empty($destinations)) {
            return [];
        }

        // Pre-compute normalisation values
        $maxPopularity = max(1, max(array_map(fn(Destination $d) => $d->getPopularity() ?? 0, $destinations)));
        $maxBudget     = max(1, max(array_map(fn(Destination $d) => (float) ($d->getEstimatedBudget() ?? 0), $destinations)));

        $scored = [];
        foreach ($destinations as $dest) {
            $result = $this->scoreDestination($dest, $preferences, $maxPopularity, $maxBudget);
            $scored[] = $result;
        }

        // Sort descending by score
        usort($scored, fn($a, $b) => $b['score'] <=> $a['score']);

        return array_slice($scored, 0, $limit);
    }

    /**
     * Compute a 0–100 score for a single destination against preferences.
     *
     * @return array{destination: Destination, score: float, matchReasons: string[]}
     */
    public function scoreDestination(
        Destination $dest,
        array $preferences,
        float $maxPopularity = 1,
        float $maxBudget = 1,
    ): array {
        $score  = 0.0;
        $reasons = [];

        // ── Rating (30 pts) ──
        $rating = (float) ($dest->getAverageRating() ?? 0);
        $ratingScore = ($rating / 5.0) * self::WEIGHT_RATING;
        $score += $ratingScore;
        if ($rating >= 4.0) {
            $reasons[] = '⭐ High rating (' . number_format($rating, 1) . '/5)';
        } elseif ($rating >= 3.0) {
            $reasons[] = '⭐ Good rating (' . number_format($rating, 1) . '/5)';
        }

        // ── Climate / Season (25 pts) ──
        $prefSeason = $preferences['season'] ?? null;
        if ($prefSeason) {
            $destSeason = strtolower($dest->getBestSeason() ?? '');
            $prefSeason = strtolower($prefSeason);
            if ($destSeason === $prefSeason) {
                $score += self::WEIGHT_CLIMATE;
                $reasons[] = '🌤️ Perfect season match';
            } elseif ($destSeason === 'all_year') {
                $score += self::WEIGHT_CLIMATE * 0.8;
                $reasons[] = '🌍 Great all year round';
            } else {
                $score += self::WEIGHT_CLIMATE * 0.2;
            }
        } else {
            // No preference → give 80% of possible points
            $score += self::WEIGHT_CLIMATE * 0.8;
        }

        // ── Popularity (20 pts) ──
        $popularity = $dest->getPopularity() ?? 0;
        $popScore = ($popularity / max(1, $maxPopularity)) * self::WEIGHT_POPULARITY;
        $score += $popScore;
        if ($popularity > 0 && ($popularity / max(1, $maxPopularity)) >= 0.7) {
            $reasons[] = '🔥 Trending destination';
        }

        // ── Type (15 pts) ──
        $prefType = $preferences['type'] ?? null;
        if ($prefType) {
            $destType = strtolower($dest->getType() ?? '');
            $prefType = strtolower($prefType);
            if ($destType === $prefType) {
                $score += self::WEIGHT_TYPE;
                $reasons[] = '🏷️ ' . ucfirst($prefType) . ' match';
            } else {
                $score += self::WEIGHT_TYPE * 0.15;
            }
        } else {
            $score += self::WEIGHT_TYPE * 0.8;
        }

        // ── Budget (10 pts) ──
        $prefMaxBudget = isset($preferences['maxBudget']) ? (float) $preferences['maxBudget'] : null;
        $destBudget    = (float) ($dest->getEstimatedBudget() ?? 0);

        if ($prefMaxBudget && $prefMaxBudget > 0) {
            if ($destBudget <= $prefMaxBudget) {
                // Closer to budget target → higher score (but still within)
                $ratio = $destBudget / $prefMaxBudget;
                $score += self::WEIGHT_BUDGET * max(0.3, $ratio);
                if ($destBudget <= $prefMaxBudget * 0.6) {
                    $reasons[] = '💰 Great value (€' . number_format($destBudget, 0) . ')';
                } else {
                    $reasons[] = '💶 Within budget (€' . number_format($destBudget, 0) . ')';
                }
            } else {
                // Over budget — small penalty
                $score += self::WEIGHT_BUDGET * 0.1;
                $reasons[] = '⚠️ Over budget (€' . number_format($destBudget, 0) . ')';
            }
        } else {
            $score += self::WEIGHT_BUDGET * 0.8;
        }

        // Ensure 0–100 range
        $score = min(100.0, max(0.0, round($score, 1)));

        // Fallback reason
        if (empty($reasons)) {
            $reasons[] = '✅ Matches your profile';
        }

        return [
            'destination'  => $dest,
            'score'        => $score,
            'matchReasons' => $reasons,
        ];
    }
}
