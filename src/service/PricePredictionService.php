<?php

namespace App\service;

use App\Entity\Activity;
use App\Entity\Destination;
use App\Entity\PriceAlert;
use App\Entity\UserActivityLog;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Mock price intelligence for MVP — replace trend math with ML when booking history exists.
 */
class PricePredictionService
{
    /** @var list<int> */
    private const FALLBACK_ACTIVITY_IDS = [1, 2, 3, 4];

    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function buildHomeCarouselCards(?int $userId): array
    {
        $activities = $this->loadFeaturedActivities(4);
        $out = [];
        foreach ($activities as $activity) {
            $dest = $this->em->find(Destination::class, $activity->getDestinationId());
            $row = $this->computePredictionRow($activity, $dest, new \DateTimeImmutable());
            $out[] = $row;
            $this->logAnalytics($userId, 'PRICE_PREDICTION_HOME', (string) $activity->getActivityId(), $row);
        }
        $this->em->flush();

        return $out;
    }

    /**
     * @return array{
     *   rising: list<array<string, mixed>>,
     *   deals: list<array<string, mixed>>,
     *   track: list<array<string, mixed>>,
     *   destination_cards: list<array<string, mixed>>,
     *   user_alerts: list<array<string, mixed>>
     * }
     */
    public function buildDashboardPayload(?int $userId): array
    {
        $activities = $this->loadFeaturedActivities(12);
        $rising = [];
        $deals = [];
        $track = [];

        foreach ($activities as $idx => $activity) {
            $dest = $this->em->find(Destination::class, $activity->getDestinationId());
            $row = $this->computePredictionRow($activity, $dest, new \DateTimeImmutable(), useSeasonalTrend: true);
            $row = $this->normalizeDashboardBucket($row, $idx);
            $this->logAnalytics($userId, 'PRICE_PREDICTION_DASHBOARD', (string) $activity->getActivityId(), $row);

            if ($row['badge'] === 'rising') {
                $rising[] = $row;
            } elseif ($row['badge'] === 'dropping') {
                $deals[] = $row;
            } else {
                $track[] = $row;
            }
        }
        $this->em->flush();

        $destinationCards = $this->buildDestinationPreviewCards();

        $userAlerts = [];
        if ($userId !== null) {
            try {
                $alerts = $this->em->getRepository(PriceAlert::class)->findBy(
                    ['userId' => $userId, 'isActive' => true],
                    ['createdAt' => 'DESC'],
                    10
                );
                foreach ($alerts as $alert) {
                    $act = $this->em->find(Activity::class, $alert->getActivityId());
                    if (!$act) {
                        continue;
                    }
                    $d = $this->em->find(Destination::class, $act->getDestinationId());
                    $userAlerts[] = [
                        'activity_id' => $act->getActivityId(),
                        'name' => $act->getName(),
                        'destination' => $d?->getName() ?? '',
                        'country' => $d?->getCountry() ?? '',
                        'target_price' => $alert->getTargetPrice(),
                        'direction' => $alert->getDirection(),
                    ];
                }
            } catch (\Throwable) {
            }
        }

        return [
            'rising' => $rising,
            'deals' => $deals,
            'track' => $track,
            'destination_cards' => $destinationCards,
            'user_alerts' => $userAlerts,
        ];
    }

    /**
     * @return list<Activity>
     */
    private function loadFeaturedActivities(int $limit): array
    {
        $qb = $this->em->createQueryBuilder()
            ->select('a')
            ->from(Activity::class, 'a')
            ->where('a.isActive = :on')
            ->setParameter('on', true)
            ->orderBy('a.averageRating', 'DESC')
            ->setMaxResults($limit);

        /** @var list<Activity> $found */
        $found = $qb->getQuery()->getResult();

        if (count($found) >= min(3, $limit)) {
            return array_slice($found, 0, $limit);
        }

        $merged = [];
        foreach ($found as $a) {
            $merged[$a->getActivityId() ?? ''] = $a;
        }
        foreach (self::FALLBACK_ACTIVITY_IDS as $id) {
            if (count($merged) >= $limit) {
                break;
            }
            $a = $this->em->find(Activity::class, (string) $id);
            if ($a && !isset($merged[$a->getActivityId() ?? ''])) {
                $merged[$a->getActivityId() ?? ''] = $a;
            }
        }

        return array_values($merged);
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function buildDestinationPreviewCards(): array
    {
        $dests = $this->em->getRepository(Destination::class)->findBy([], ['popularity' => 'DESC'], 6);
        $cards = [];
        foreach ($dests as $dest) {
            $budget = (float) ($dest->getEstimatedBudget() ?? 0);
            if ($budget <= 0) {
                $budget = 120.0;
            }
            $row = $this->computeRawPrediction($budget, $dest->getPopularity() ?? 0, new \DateTimeImmutable(), true);
            $cards[] = [
                'destination_id' => $dest->getDestinationId(),
                'name' => $dest->getName(),
                'country' => $dest->getCountry(),
                'current_price' => round($budget, 2),
                'predicted_price' => $row['predicted'],
                'percent_change' => $row['percent_change'],
                'direction' => $row['direction'],
                'badge' => $row['badge'],
                'recommendation' => $row['recommendation'],
                'sparkline' => $this->sparklinePoints($budget, $row['predicted']),
            ];
        }

        return $cards;
    }

    /**
     * @return array<string, mixed>
     */
    private function computePredictionRow(Activity $activity, ?Destination $dest, \DateTimeInterface $at, bool $useSeasonalTrend = false): array
    {
        $current = (float) ($activity->getPrice() ?? 0);
        if ($current <= 0) {
            $current = 49.0;
        }

        $pop = (int) ($dest?->getPopularity() ?? 0);
        $raw = $this->computeRawPrediction($current, $pop, $at, $useSeasonalTrend);

        $days = random_int(3, 10);

        return [
            'activity_id' => $activity->getActivityId(),
            'activity_name' => $activity->getName(),
            'category' => $activity->getCategory(),
            'destination_id' => $dest?->getDestinationId(),
            'destination_name' => $dest?->getName() ?? 'Unknown',
            'country' => $dest?->getCountry() ?? '',
            'currency' => $activity->getCurrency() ?? 'USD',
            'current_price' => round($current, 2),
            'predicted_price' => $raw['predicted'],
            'percent_change' => $raw['percent_change'],
            'direction' => $raw['direction'],
            'badge' => $raw['badge'],
            'recommendation' => $raw['recommendation'],
            'days' => $days,
            'sparkline' => $this->sparklinePoints($current, $raw['predicted']),
            'book_url' => '/activities?book=' . urlencode((string) $activity->getActivityId()),
        ];
    }

    /**
     * Ensures Rising / Best deals / Watchlist tabs always have content (deterministic buckets).
     *
     * @param array<string, mixed> $row
     * @return array<string, mixed>
     */
    private function normalizeDashboardBucket(array $row, int $index): array
    {
        $current = (float) $row['current_price'];
        $bucket = $index % 3;

        if ($bucket === 0) {
            $pct = (float) random_int(28, 85) / 10;
            $pred = max(1.0, round($current * (1 + $pct / 100), 2));
            $row['badge'] = 'rising';
            $row['percent_change'] = $pct;
            $row['predicted_price'] = $pred;
            $row['direction'] = 'up';
            $row['recommendation'] = 'Price rising — book before it climbs';
        } elseif ($bucket === 1) {
            $pct = -(float) random_int(30, 110) / 10;
            $pred = max(1.0, round($current * (1 + $pct / 100), 2));
            $row['badge'] = 'dropping';
            $row['percent_change'] = $pct;
            $row['predicted_price'] = $pred;
            $row['direction'] = 'down';
            $row['recommendation'] = 'Price dropping — good time to wait or grab a deal';
        } else {
            $pct = (float) random_int(-18, 18) / 10;
            $pred = max(1.0, round($current * (1 + $pct / 100), 2));
            $row['badge'] = 'track';
            $row['percent_change'] = $pct;
            $row['predicted_price'] = $pred;
            $row['direction'] = abs($pct) < 0.5 ? 'flat' : ($pct > 0 ? 'up' : 'down');
            $row['recommendation'] = 'Stable range — watch for a better window';
        }

        $row['sparkline'] = $this->sparklinePoints($current, (float) $row['predicted_price']);

        return $row;
    }

    /**
     * @return array{predicted: float, percent_change: float, direction: string, badge: string, recommendation: string}
     */
    private function computeRawPrediction(float $currentPrice, int $popularity, \DateTimeInterface $at, bool $useSeasonalTrend): array
    {
        if ($useSeasonalTrend) {
            $season = $this->seasonTrendPercent($at);
            $popAdj = min(12, max(-8, $popularity / 25));
            $base = $currentPrice * (1 + ($season + $popAdj) / 100);
        } else {
            $jitter = (random_int(-2500, 4000) / 10000);
            $base = $currentPrice * (1 + $jitter);
        }

        $noise = (random_int(-80, 80) / 1000);
        $predicted = max(1, round($base * (1 + $noise), 2));
        $pct = $currentPrice > 0 ? round(($predicted - $currentPrice) / $currentPrice * 100, 1) : 0.0;
        $direction = $predicted > $currentPrice ? 'up' : ($predicted < $currentPrice ? 'down' : 'flat');

        if (abs($pct) < 2.0) {
            $badge = 'track';
            $recommendation = 'Track price';
        } elseif ($direction === 'up') {
            $badge = 'rising';
            $recommendation = 'Book now';
        } else {
            $badge = 'dropping';
            $recommendation = 'Wait';
        }

        return [
            'predicted' => $predicted,
            'percent_change' => $pct,
            'direction' => $direction,
            'badge' => $badge,
            'recommendation' => $recommendation,
        ];
    }

    private function seasonTrendPercent(\DateTimeInterface $at): float
    {
        $m = (int) $at->format('n');
        if (in_array($m, [6, 7, 8, 12, 1], true)) {
            return (float) random_int(1500, 3000) / 100;
        }
        if (in_array($m, [4, 5, 9, 10], true)) {
            return (float) random_int(500, 1000) / 100;
        }

        return (float) random_int(-2000, -1000) / 100;
    }

    /**
     * @return list<float>
     */
    private function sparklinePoints(float $from, float $to): array
    {
        $pts = [];
        for ($i = 0; $i < 7; $i++) {
            $t = $i / 6;
            $v = $from + ($to - $from) * $t + (random_int(-35, 35) / 100);
            $pts[] = round(max(0.5, $v), 2);
        }

        return $pts;
    }

    /**
     * @param array<string, mixed> $row
     */
    private function logAnalytics(?int $userId, string $type, string $activityId, array $row): void
    {
        if ($userId === null) {
            return;
        }
        try {
            $log = new UserActivityLog();
            $log->setUserId($userId);
            $log->setActivityType($type);
            $log->setTargetType('ACTIVITY');
            $log->setTargetId(json_encode([
                'activityId' => $activityId,
                'predicted' => $row['predicted_price'] ?? $row['predicted'] ?? null,
                'current' => $row['current_price'] ?? null,
                'pct' => $row['percent_change'] ?? null,
            ], JSON_THROW_ON_ERROR));
            $log->setTimestamp(new \DateTime());
            $this->em->persist($log);
        } catch (\Throwable) {
        }
    }
}
