<?php

namespace App\service;

use App\Entity\Pack;
use App\Entity\PacksBooking;
use App\Entity\LoyaltyPoints;
use App\Entity\Destination;
use Doctrine\ORM\EntityManagerInterface;

/**
 * PackRecommendationService
 * ─────────────────────────
 * Scores every active pack for the logged-in user from 0–100.
 *
 * SCORING BREAKDOWN (100 pts total)
 * ─────────────────────────────────
 *  1. POPULARITY          (15 pts) — how many confirmed/completed bookings this pack has globally
 *  2. DESTINATION TYPE    (20 pts) — beach/city/mountain/island etc. matches user's past destination types
 *  3. CATEGORY MATCH      (15 pts) — pack category matches user's historically booked categories
 *  4. SEASONAL FIT        (15 pts) — destination best_season matches current month's season
 *  5. PRICE TIER FIT      (20 pts) — budget/mid/premium/luxury tier matches user's spending history
 *  6. DURATION PREFERENCE (15 pts) — short/medium/long trip matches user's preferred duration
 *
 * NEW USERS (no booking history):
 *  - Score is driven by seasonal fit + popularity + price tier spread
 *  - Packs still get meaningfully different scores (not all the same)
 *  - Neutral pts distributed across factors to create natural spread
 */
class PackRecommendationService
{
    // Price tier boundaries (per-person base price)
    private const TIER_BUDGET   = 1000;   // < 1000
    private const TIER_MID      = 3000;   // 1000 – 3000
    private const TIER_PREMIUM  = 6000;   // 3000 – 6000
    private const TIER_LUXURY   = PHP_INT_MAX; // > 6000

    // Duration tier boundaries (days)
    private const DUR_SHORT  = 4;   // 1–4 days
    private const DUR_MEDIUM = 7;   // 5–7 days
    // long = 8+ days

    public function __construct(
        private readonly EntityManagerInterface $em
    ) {}

    // ─────────────────────────────────────────────────────────────────────────
    //  PUBLIC API
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Score all active packs for a user and return them sorted best-first.
     * Each item: ['pack'=>Pack, 'score'=>int, 'label'=>string, 'color'=>string, 'reasons'=>string[]]
     */
    public function getScoredPacks(int $userId, array $activePacks): array
    {
        if (empty($activePacks)) return [];

        $ctx     = $this->buildContext($userId, $activePacks);
        $results = [];

        foreach ($activePacks as $pack) {
            [$score, $reasons] = $this->score($pack, $ctx);
            $results[] = [
                'pack'    => $pack,
                'score'   => $score,
                'label'   => $this->label($score),
                'color'   => $this->color($score),
                'reasons' => $reasons,
            ];
        }

        usort($results, fn($a, $b) => $b['score'] <=> $a['score']);
        return $results;
    }

    /**
     * Score a single pack for a user (pack details page).
     */
    public function scoreOne(int $userId, Pack $pack): array
    {
        $ctx = $this->buildContext($userId, [$pack]);
        [$score, $reasons] = $this->score($pack, $ctx);
        return [
            'pack'    => $pack,
            'score'   => $score,
            'label'   => $this->label($score),
            'color'   => $this->color($score),
            'reasons' => $reasons,
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    //  CONTEXT BUILDER — runs once per request, shared across all pack scores
    // ─────────────────────────────────────────────────────────────────────────

    private function buildContext(int $userId, array $activePacks): array
    {
        // ── 1. User's non-cancelled bookings ──────────────────────────────────
        /** @var PacksBooking[] $userBookings */
        $userBookings  = $this->em->createQueryBuilder()
            ->select('b')
            ->from(PacksBooking::class, 'b')
            ->where('b.userId = :uid AND b.status != :c')
            ->setParameter('uid', $userId)
            ->setParameter('c', 'CANCELLED')
            ->getQuery()->getResult();

        $bookedPackIds = array_map(fn($b) => (int) $b->getPackId(), $userBookings);
        $hasHistory    = !empty($bookedPackIds);

        // ── 2. Analyse packs the user has booked ─────────────────────────────
        $bookedCategoryIds  = [];
        $bookedDestIds      = [];
        $bookedDestTypes    = [];   // beach, city, mountain …
        $bookedPriceTiers   = [];   // budget, mid, premium, luxury
        $bookedDurationTiers= [];   // short, medium, long
        $pricesSpent        = [];

        if ($hasHistory) {
            /** @var Pack[] $pastPacks */
            $pastPacks = $this->em->createQueryBuilder()
                ->select('p')
                ->from(Pack::class, 'p')
                ->where('p.idPack IN (:ids)')
                ->setParameter('ids', $bookedPackIds)
                ->getQuery()->getResult();

            foreach ($pastPacks as $p) {
                if ($p->getCategoryId())
                    $bookedCategoryIds[] = (int) $p->getCategoryId();
                if ($p->getDestinationId())
                    $bookedDestIds[] = (string) $p->getDestinationId();
                if ($p->getBasePrice())
                    $pricesSpent[] = (float) $p->getBasePrice();
                if ($p->getDurationDays())
                    $bookedDurationTiers[] = $this->durationTier((int) $p->getDurationDays());
                $bookedPriceTiers[] = $this->priceTier((float) ($p->getBasePrice() ?? 0));

                // Resolve destination type
                if ($p->getDestinationId()) {
                    $dest = $this->em->getRepository(Destination::class)->find($p->getDestinationId());
                    if ($dest && $dest->getType()) {
                        $bookedDestTypes[] = strtolower(trim($dest->getType()));
                    }
                }
            }
        }

        // ── 3. Loyalty level ──────────────────────────────────────────────────
        $lp    = $this->em->getRepository(LoyaltyPoints::class)->findOneBy(['userId' => $userId]);
        $level = $lp ? $lp->computeLevel() : 'BRONZE';

        // ── 4. Global pack popularity ─────────────────────────────────────────
        $rawPop = $this->em->createQueryBuilder()
            ->select('b.packId AS packId, COUNT(b.idBooking) AS cnt')
            ->from(PacksBooking::class, 'b')
            ->where("b.status IN ('CONFIRMED','COMPLETED')")
            ->groupBy('b.packId')
            ->getQuery()->getArrayResult();

        $popularityMap = [];
        foreach ($rawPop as $row) {
            $popularityMap[(int) $row['packId']] = (int) $row['cnt'];
        }
        $maxPop = max(array_values($popularityMap) ?: [1]);

        // ── 5. Current season ─────────────────────────────────────────────────
        $month  = (int) (new \DateTime())->format('n');
        $season = match (true) {
            in_array($month, [12, 1, 2])  => 'winter',
            in_array($month, [3, 4, 5])   => 'spring',
            in_array($month, [6, 7, 8])   => 'summer',
            default                        => 'autumn',
        };

        // ── 6. Pre-load all destinations for the active packs (batch query) ───
        $destIds = array_filter(array_unique(
            array_map(fn($p) => $p->getDestinationId(), $activePacks)
        ));
        $destinations = [];
        if (!empty($destIds)) {
            $rows = $this->em->createQueryBuilder()
                ->select('d')
                ->from(Destination::class, 'd')
                ->where('d.destinationId IN (:ids)')
                ->setParameter('ids', $destIds)
                ->getQuery()->getResult();
            foreach ($rows as $d) {
                $destinations[(string) $d->getDestinationId()] = $d;
            }
        }

        // ── 7. Preferred tiers (most frequent in history) ─────────────────────
        $preferredPriceTier    = $this->mostFrequent($bookedPriceTiers);
        $preferredDurationTier = $this->mostFrequent($bookedDurationTiers);
        $preferredDestTypes    = array_unique($bookedDestTypes);
        $avgPrice              = count($pricesSpent) ? array_sum($pricesSpent) / count($pricesSpent) : null;

        return [
            'hasHistory'            => $hasHistory,
            'bookedPackIds'         => $bookedPackIds,
            'bookedCategoryIds'     => array_unique($bookedCategoryIds),
            'bookedDestIds'         => array_unique($bookedDestIds),
            'preferredDestTypes'    => $preferredDestTypes,
            'preferredPriceTier'    => $preferredPriceTier,
            'preferredDurationTier' => $preferredDurationTier,
            'avgPrice'              => $avgPrice,
            'level'                 => $level,
            'popularityMap'         => $popularityMap,
            'maxPop'                => $maxPop,
            'season'                => $season,
            'bookingCount'          => count($userBookings),
            'destinations'          => $destinations,
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    //  SCORING ENGINE
    // ─────────────────────────────────────────────────────────────────────────

    private function score(Pack $pack, array $ctx): array
    {
        $pts     = 0;
        $reasons = [];
        $pid     = $pack->getIdPack();

        /** @var Destination|null $dest */
        $dest = $pack->getDestinationId()
            ? ($ctx['destinations'][(string) $pack->getDestinationId()] ?? null)
            : null;

        // ── FACTOR 1: POPULARITY (max 15 pts) ────────────────────────────────
        $popCount = $ctx['popularityMap'][$pid] ?? 0;
        $popPts   = (int) round(($popCount / $ctx['maxPop']) * 15);
        $pts     += $popPts;

        if ($popPts >= 12)     $reasons[] = '🔥 Most booked pack on TripX';
        elseif ($popPts >= 7)  $reasons[] = '👍 Popular among travellers';
        elseif ($popPts >= 3)  $reasons[] = '📈 Gaining popularity';

        // ── FACTOR 2: DESTINATION TYPE MATCH (max 20 pts) ────────────────────
        if ($dest) {
            $destType = strtolower(trim((string) $dest->getType()));

            if ($ctx['hasHistory']) {
                if (in_array($destType, $ctx['preferredDestTypes'])) {
                    $pts      += 20;
                    $reasons[] = '🗺️ Your favourite type of destination (' . $destType . ')';
                } elseif ($this->isTypeCompatible($destType, $ctx['preferredDestTypes'])) {
                    $pts      += 10;
                    $reasons[] = '🌍 Similar destination type to your past trips';
                }
            } else {
                // New user — give pts based on destination rating/popularity
                $rating  = (float) ($dest->getAverageRating() ?? 0);
                $newPts  = (int) round(($rating / 5.0) * 14); // max 14 for new users
                $pts    += $newPts;
                if ($newPts >= 10) $reasons[] = '⭐ Highly rated destination';
            }
        }

        // ── FACTOR 3: CATEGORY MATCH (max 15 pts) ────────────────────────────
        if ($ctx['hasHistory']) {
            if ($pack->getCategoryId() && in_array((int) $pack->getCategoryId(), $ctx['bookedCategoryIds'])) {
                $pts      += 15;
                $reasons[] = '🎯 Matches your travel style';
            } elseif (in_array($pid, $ctx['bookedPackIds'])) {
                $pts      += 15;
                $reasons[] = '⭐ You\'ve booked this pack before';
            }
        } else {
            // New user — category neutral pts (all get same, so no impact on spread)
            $pts += 5;
        }

        // ── FACTOR 4: SEASONAL FIT (max 15 pts) ──────────────────────────────
        if ($dest) {
            $best = strtolower(trim((string) $dest->getBestSeason()));
            $now  = $ctx['season'];

            if ($best === 'all_year') {
                $pts      += 15;
                $reasons[] = '🌐 Great destination all year round';
            } elseif ($best === $now) {
                $pts      += 15;
                $reasons[] = '☀️ Perfect season to visit ' . $dest->getName();
            } elseif ($this->seasonsAdjacent($best, $now)) {
                $pts      += 8;
                $reasons[] = '🌤️ Good time of year for this destination';
            }
            // off-season: 0 pts — this creates meaningful spread for new users too
        }

        // ── FACTOR 5: PRICE TIER FIT (max 20 pts) ────────────────────────────
        $packPrice = (float) ($pack->getBasePrice() ?? 0);
        $packTier  = $this->priceTier($packPrice);

        if ($ctx['hasHistory'] && $ctx['preferredPriceTier']) {
            if ($packTier === $ctx['preferredPriceTier']) {
                $pts      += 20;
                $reasons[] = '💰 Right in your usual price range';
            } elseif ($this->isTierAdjacent($packTier, $ctx['preferredPriceTier'])) {
                $pts      += 10;
                $reasons[] = '💳 Close to your price range';
            }
            // Different tier: 0 pts — creates differentiation
        } else {
            // New user — spread pts based on price tier diversity
            // Give moderate pts to mid-range packs, fewer to extremes
            $newPts = match ($packTier) {
                'budget'  => 14, // accessible, good starter
                'mid'     => 20, // best fit for unknown preference
                'premium' => 12, // specific taste
                'luxury'  => 6,  // very specific taste
            };
            $pts += $newPts;
        }

        // ── FACTOR 6: DURATION PREFERENCE (max 15 pts) ───────────────────────
        $packDurTier = $this->durationTier((int) ($pack->getDurationDays() ?? 0));

        if ($ctx['hasHistory'] && $ctx['preferredDurationTier']) {
            if ($packDurTier === $ctx['preferredDurationTier']) {
                $pts      += 15;
                $reasons[] = '📅 Matches your preferred trip length';
            } elseif ($this->isDurationAdjacent($packDurTier, $ctx['preferredDurationTier'])) {
                $pts      += 7;
                $reasons[] = '🗓️ Similar trip length to what you\'ve enjoyed';
            }
        } else {
            // New user — medium trips slightly preferred
            $newPts = match ($packDurTier) {
                'short'  => 10,
                'medium' => 15,
                'long'   => 12,
            };
            $pts += $newPts;
        }

        // ── LOYALTY LABEL (no pts, just a reason shown) ───────────────────────
        if ($ctx['level'] === 'GOLD')        $reasons[] = '🥇 Gold member — extra discount applied at checkout';
        elseif ($ctx['level'] === 'SILVER')  $reasons[] = '🥈 Silver member — discount applied at checkout';

        // ── NEW USER FALLBACK REASON ──────────────────────────────────────────
        if (!$ctx['hasHistory'] && empty($reasons)) {
            $reasons[] = '🌍 Great pick to start your journey';
        }

        return [max(0, min(100, $pts)), $reasons];
    }

    // ─────────────────────────────────────────────────────────────────────────
    //  TIER HELPERS
    // ─────────────────────────────────────────────────────────────────────────

    private function priceTier(float $price): string
    {
        return match (true) {
            $price < self::TIER_BUDGET  => 'budget',
            $price < self::TIER_MID     => 'mid',
            $price < self::TIER_PREMIUM => 'premium',
            default                      => 'luxury',
        };
    }

    private function durationTier(int $days): string
    {
        return match (true) {
            $days <= self::DUR_SHORT  => 'short',
            $days <= self::DUR_MEDIUM => 'medium',
            default                   => 'long',
        };
    }

    private function isTierAdjacent(string $a, string $b): bool
    {
        $order = ['budget', 'mid', 'premium', 'luxury'];
        $ia = array_search($a, $order);
        $ib = array_search($b, $order);
        if ($ia === false || $ib === false) return false;
        return abs($ia - $ib) === 1;
    }

    private function isDurationAdjacent(string $a, string $b): bool
    {
        $order = ['short', 'medium', 'long'];
        $ia = array_search($a, $order);
        $ib = array_search($b, $order);
        if ($ia === false || $ib === false) return false;
        return abs($ia - $ib) === 1;
    }

    /**
     * Destination types that are "compatible" with the user's preference.
     * e.g. someone who books beach also likes islands.
     */
    private function isTypeCompatible(string $packType, array $userTypes): bool
    {
        $compatible = [
            'beach'      => ['island', 'other'],
            'island'     => ['beach', 'other'],
            'mountain'   => ['countryside', 'other'],
            'countryside'=> ['mountain', 'other'],
            'city'       => ['other'],
            'desert'     => ['other'],
            'forest'     => ['countryside', 'other'],
            'cruise'     => ['island', 'beach'],
            'other'      => [],
        ];

        $friends = $compatible[$packType] ?? [];
        foreach ($userTypes as $ut) {
            if ($packType === $ut) return true; // exact match handled upstream
            if (in_array($ut, $friends)) return true;
        }
        return false;
    }

    private function seasonsAdjacent(string $a, string $b): bool
    {
        $order = ['spring', 'summer', 'autumn', 'winter'];
        $ia    = array_search($a, $order);
        $ib    = array_search($b, $order);
        if ($ia === false || $ib === false) return false;
        $diff = abs($ia - $ib);
        return $diff === 1 || $diff === 3; // handles winter ↔ spring wrap
    }

    private function mostFrequent(array $arr): ?string
    {
        if (empty($arr)) return null;
        $counts = array_count_values($arr);
        arsort($counts);
        return array_key_first($counts);
    }

    // ─────────────────────────────────────────────────────────────────────────
    //  LABEL & COLOUR
    // ─────────────────────────────────────────────────────────────────────────

    private function label(int $score): string
    {
        return match (true) {
            $score >= 80 => 'Perfect Match',
            $score >= 60 => 'Great Fit',
            $score >= 40 => 'Good Pick',
            default      => 'Explore',
        };
    }

    private function color(int $score): string
    {
        return match (true) {
            $score >= 80 => '#10b981', // emerald
            $score >= 60 => '#6366f1', // indigo
            $score >= 40 => '#f59e0b', // amber
            default      => '#9ca3af', // grey
        };
    }
}
