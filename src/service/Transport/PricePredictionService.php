<?php

namespace App\service\Transport;

use App\Entity\Transport;
use App\Entity\Schedule;
use App\Repository\BookingtransRepository;
use App\service\TransportService;
use App\service\ScheduleService;

/**
 * Transport-module price prediction service.
 * Uses PHP-ML LeastSquares regression trained on confirmed bookings.
 * Falls back to heuristics when there are fewer than 2 training samples
 * or when the matrix is singular (collinear dataset).
 */
class PricePredictionService
{
    public function __construct(
        private readonly BookingtransRepository $bookingRepo,
        private readonly TransportService $transportService,
        private readonly ScheduleService $scheduleService,
    ) {}

    public function predictPrice(Transport $t, Schedule $s, int $seats, string $cls, bool $insurance): float
    {
        $bookings = $this->bookingRepo->findBy(['bookingStatus' => 'CONFIRMED']);
        $samples  = [];
        $targets  = [];

        foreach ($bookings as $b) {
            $bTrans = $this->transportService->findById($b->getTransportId());
            $bSched = $b->getScheduleId()
                ? $this->scheduleService->findById($b->getScheduleId())
                : null;

            if (!$bTrans) {
                continue;
            }

            $type       = $bTrans->getTransportType() === 'FLIGHT' ? 1 : 0;
            $bCls       = $bSched ? $bSched->getTravelClass() : 'ECONOMY';
            $clsIdx     = $this->getClassIndex($bCls);
            $seatsCount = $b->getTotalSeats();
            $multiplier = $bSched ? $bSched->getPriceMultiplier() : 1.0;
            $eco        = $bTrans->getSustainabilityRating();
            $ins        = $b->isInsuranceIncluded() ? 1 : 0;

            $samples[] = [$type, $clsIdx, $seatsCount, $multiplier, $eco, $ins];
            $targets[]  = $b->getTotalPrice();
        }

        $targetType     = $t->getTransportType() === 'FLIGHT' ? 1 : 0;
        $targetCls      = $this->getClassIndex($cls);
        $targetMult     = $s->getPriceMultiplier() ?? 1.0;
        $targetEco      = $t->getSustainabilityRating();
        $targetIns      = $insurance ? 1 : 0;
        $targetFeatures = [$targetType, $targetCls, $seats, $targetMult, $targetEco, $targetIns];

        if (count($samples) < 2) {
            return $this->heuristicPrice($t->getBasePrice(), $seats, $targetMult, $targetCls, $insurance);
        }

        try {
            /** @phpstan-ignore-next-line */
            $regression = new \Phpml\Regression\LeastSquares();
            $regression->train($samples, $targets);
            $rawPrediction = (float) $regression->predict($targetFeatures);
        } catch (\Throwable) {
            $rawPrediction = $this->heuristicPrice($t->getBasePrice(), $seats, $targetMult, $targetCls, $insurance);
        }

        // Market-reality multipliers
        $ecoScore  = max(1.0, min(10.0, (float) $t->getSustainabilityRating()));
        $ecoSurge  = 1.0 + ((10.0 - $ecoScore) * 0.025); // up to +22.5% for low sustainability
        $seatSurge = 1.0 + ($seats * 0.035);              // yield-management surge per seat

        return round(max(0.0, $rawPrediction * $ecoSurge * $seatSurge), 2);
    }

    public function getAdvancedPredictionMetrics(float $actualPrice, float $predictedPrice): array
    {
        $diff    = $actualPrice - $predictedPrice;
        $percent = $predictedPrice > 0 ? ($diff / $predictedPrice) * 100 : 0.0;

        $label = 'NORMAL';
        $color = '#f39c12';
        if ($percent < -5) {
            $label = 'CHEAP';
            $color = '#27ae60';
        } elseif ($percent > 5) {
            $label = 'EXPENSIVE';
            $color = '#c0392b';
        }

        $fairnessScore = max(0, 100 - (int) abs($percent));

        return [
            'label'             => $label,
            'color'             => $color,
            'fairnessScore'     => $fairnessScore,
            'marketComparison'  => sprintf(
                '%s%.1f%% %s market average',
                $percent > 0 ? '+' : '',
                abs($percent),
                $percent > 0 ? 'above' : 'below'
            ),
        ];
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function getClassIndex(string $cls): int
    {
        return match (strtoupper($cls)) {
            'ECONOMY'  => 0,
            'PREMIUM'  => 1,
            'BUSINESS' => 2,
            'FIRST'    => 3,
            default    => 0,
        };
    }

    private function heuristicPrice(float $base, int $seats, float $mult, int $clsIdx, bool $insurance): float
    {
        $price = $base * $seats * $mult;

        $price *= match ($clsIdx) {
            1 => 1.5,
            2 => 2.5,
            3 => 4.0,
            default => 1.0,
        };

        if ($insurance) {
            $price += 50 * $seats;
        }

        return round($price, 2);
    }
}
