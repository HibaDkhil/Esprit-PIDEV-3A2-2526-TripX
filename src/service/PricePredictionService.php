<?php
namespace App\service;

use Phpml\Regression\LeastSquares;
use App\Repository\BookingtransRepository;
use App\Entity\Transport;
use App\Entity\Schedule;

class PricePredictionService
{
    private BookingtransRepository $bookingRepo;
    private TransportService $transportService;
    private ScheduleService $scheduleService;

    public function __construct(
        BookingtransRepository $bookingRepo,
        TransportService $transportService,
        ScheduleService $scheduleService
    ) {
        $this->bookingRepo = $bookingRepo;
        $this->transportService = $transportService;
        $this->scheduleService = $scheduleService;
    }

    public function predictPrice(Transport $t, Schedule $s, int $seats, string $cls, bool $insurance): float
    {
        $bookings = $this->bookingRepo->findBy(['bookingStatus' => 'CONFIRMED']);
        $samples = [];
        $targets = [];

        foreach ($bookings as $b) {
            $b_trans = $this->transportService->findById($b->getTransportId());
            $b_sched = $b->getScheduleId() ? $this->scheduleService->findById($b->getScheduleId()) : null;

            if (!$b_trans) continue;

            $type = $b_trans->getTransportType() === 'FLIGHT' ? 1 : 0;
            $b_cls = $b_sched ? $b_sched->getTravelClass() : 'ECONOMY';
            $clsIdx = $this->getClassIndex($b_cls);
            $seatsCount = $b->getTotalSeats();
            $multiplier = $b_sched ? $b_sched->getPriceMultiplier() : 1.0;
            $eco = $b_trans->getSustainabilityRating();
            $ins = $b->isInsuranceIncluded() ? 1 : 0;

            $samples[] = [$type, $clsIdx, $seatsCount, $multiplier, $eco, $ins];
            $targets[] = $b->getTotalPrice();
        }

        // Feature array: [transportType, travelClassIndex, totalSeats, priceMultiplier, sustainabilityRating, insuranceIncluded]
        $targetType = $t->getTransportType() === 'FLIGHT' ? 1 : 0;
        $targetCls  = $this->getClassIndex($cls);
        $targetMult = $s->getPriceMultiplier();
        $targetEco  = $t->getSustainabilityRating();
        $targetIns  = $insurance ? 1 : 0;
        $targetFeatures = [$targetType, $targetCls, $seats, $targetMult, $targetEco, $targetIns];

        if (count($samples) < 2) {
            // Fallback heuristics if we lack enough confirmed bookings
            $base = $t->getBasePrice() * $seats * $targetMult;
            if ($targetCls === 1) $base *= 1.5;
            if ($targetCls === 2) $base *= 2.5;
            if ($targetCls === 3) $base *= 4.0;
            if ($insurance) $base += 50 * $seats;
            return round($base, 2);
        }

        try {
            $regression = new LeastSquares();
            $regression->train($samples, $targets);
            $rawPrediction = $regression->predict($targetFeatures);
        } catch (\Phpml\Exception\MatrixException $e) {
            // Fallback heuristics if matrix is singular (collinear dataset)
            $rawPrediction = $t->getBasePrice() * $seats * $targetMult;
            if ($targetCls === 1) $rawPrediction *= 1.5;
            if ($targetCls === 2) $rawPrediction *= 2.5;
            if ($targetCls === 3) $rawPrediction *= 4.0;
            if ($insurance) $rawPrediction += 50 * $seats;
        }

        // Apply advanced market reality heuristics (Simulating competitor surges)
        // Competitors penalize poor sustainability (low rating increases market average)
        $ecoScore = max(1.0, min(10.0, $t->getSustainabilityRating()));
        $ecoSurge = 1.0 + ((10.0 - $ecoScore) * 0.025); // Adds up to 22.5% market surcharge for gas guzzlers

        // Competitors leverage yield management (more seats requested simultaneously = higher rate per seat)
        $seatSurge = 1.0 + ($seats * 0.035);

        $marketPrediction = max(0, $rawPrediction * $ecoSurge * $seatSurge);

        return round($marketPrediction, 2);
    }

    private function getClassIndex(string $cls): int
    {
        return match (strtoupper($cls)) {
            'ECONOMY' => 0,
            'PREMIUM' => 1,
            'BUSINESS' => 2,
            'FIRST' => 3,
            default => 0,
        };
    }

    public function getAdvancedPredictionMetrics(float $actualPrice, float $predictedPrice): array
    {
        $diff = $actualPrice - $predictedPrice;
        $percent = $predictedPrice > 0 ? ($diff / $predictedPrice) * 100 : 0;

        $label = 'NORMAL';
        $color = '#f39c12';
        if ($percent < -5) {
            $label = 'CHEAP';
            $color = '#27ae60';
        } elseif ($percent > 5) {
            $label = 'EXPENSIVE';
            $color = '#c0392b';
        }

        $fairnessScore = max(0, 100 - abs($percent));

        $marketComparison = sprintf("%s%.1f%% %s market average",
            $percent > 0 ? '+' : '',
            abs($percent),
            $percent > 0 ? 'above' : 'below'
        );

        return [
            'label' => $label,
            'color' => $color,
            'fairnessScore' => round($fairnessScore),
            'marketComparison' => $marketComparison
        ];
    }

    public function buildHomeCarouselCards(?int $userId = null): array
    {
        // Simulated AI recommendations for MVP homepage
        return [
            [
                'activity_id' => 1,
                'activity_name' => 'Eiffel Tower Night Tour',
                'destination_name' => 'Paris',
                'country' => 'France',
                'current_price' => 120,
                'predicted_price' => 145,
                'badge' => 'rising',
                'percent_change' => 20.8,
                'days' => 14,
                'recommendation' => 'Book now',
                'sparkline' => [100, 105, 110, 115, 120, 130, 145],
                'book_url' => '#'
            ],
            [
                'activity_id' => 2,
                'activity_name' => 'Mt. Fuji Excursion',
                'destination_name' => 'Tokyo',
                'country' => 'Japan',
                'current_price' => 85,
                'predicted_price' => 70,
                'badge' => 'dropping',
                'percent_change' => -17.6,
                'days' => 7,
                'recommendation' => 'Wait',
                'sparkline' => [95, 90, 88, 85, 80, 75, 70],
                'book_url' => '#'
            ],
            [
                'activity_id' => 3,
                'activity_name' => 'Swiss Alps Ski Pass',
                'destination_name' => 'Zermatt',
                'country' => 'Switzerland',
                'current_price' => 250,
                'predicted_price' => 255,
                'badge' => 'track',
                'percent_change' => 2.0,
                'days' => 30,
                'recommendation' => 'Stable',
                'sparkline' => [245, 248, 250, 250, 248, 252, 255],
                'book_url' => '#'
            ]
        ];
    }
}

