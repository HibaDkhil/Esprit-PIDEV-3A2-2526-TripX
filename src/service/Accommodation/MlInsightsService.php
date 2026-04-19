<?php

namespace App\service\Accommodation;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Aggregates PriceRegressionService + DemandElasticityService
 * and adds an occupancy forecast layer.
 *
 * Mirrors AccommodationMlInsightsService.java logic.
 */
class MlInsightsService
{
    public function __construct(
        private readonly EntityManagerInterface  $em,
        private readonly PriceRegressionService  $regression,
        private readonly DemandElasticityService $elasticity,
    ) {}

    // ── Public API ────────────────────────────────────────────────────

    public function computeGlobalSnapshot(): array
    {
        $totalRooms = (int) $this->em->getConnection()
            ->fetchOne("SELECT COUNT(*) FROM room");

        if ($totalRooms <= 0) {
            return $this->emptySnapshot('No rooms found. Add room inventory to start ML forecasting.');
        }

        // Occupancy signals (rolling windows)
        $occ30  = $this->historicOccupancy(30, 0,  $totalRooms);
        $occ60  = $this->historicOccupancy(30, 30, $totalRooms);

        // Booking momentum (recent vs previous 14-day window)
        $conf14     = $this->confirmedCount(14, 0);
        $confPrev14 = $this->confirmedCount(14, 14);
        $momentum   = $this->momentum($conf14, $confPrev14);

        // Weighted forecast
        $forecastOcc = $this->clamp(
            $occ30 * 0.65 + $occ60 * 0.25 + ($momentum * 100.0) * 0.10,
            0, 100
        );

        // Run ML models
        $regSnap  = $this->regression->computeSnapshot();
        $elSnap   = $this->elasticity->computeSnapshot();

        // Price adjustment: prefer regression; fall back to heuristic
        $priceAdj = $regSnap['modelTrained']
            ? $regSnap['suggestedAdjustmentPct']
            : $this->clamp((($forecastOcc / 100.0) - 0.55) * 35.0, -12.0, 12.0);

        // Confidence: prefer regression model confidence
        $conf90 = $this->confirmedCount(90, 0);
        $fallbackConf = $this->clamp(30 + ($conf90 * 65.0 / 120.0), 30, 92);
        $confidence   = $regSnap['modelTrained'] ? $regSnap['confidencePct'] : $fallbackConf;

        return [
            'forecastOccupancyPct'       => round($forecastOcc, 1),
            'momentum'                   => round($momentum * 100.0, 1),
            'suggestedPriceAdjustmentPct'=> round($priceAdj, 1),
            'modelConfidencePct'         => round($confidence, 1),
            'decisionSummary'            => $this->decisionSummary($forecastOcc, $priceAdj, $momentum, $confidence, $regSnap),
            'regression'                 => $regSnap,
            'elasticity'                 => $elSnap,
        ];
    }

    // ── Occupancy helpers ─────────────────────────────────────────────

    private function historicOccupancy(int $windowDays, int $offsetDays, int $totalRooms): float
    {
        if ($totalRooms <= 0 || $windowDays <= 0) { return 0.0; }

        $sql = "
            SELECT COALESCE(SUM(
                DATEDIFF(
                    LEAST(check_out,  DATE_SUB(CURDATE(), INTERVAL :end DAY)),
                    GREATEST(check_in, DATE_SUB(CURDATE(), INTERVAL :start DAY))
                )
            ), 0) AS booked_nights
            FROM bookingacc
            WHERE status    = 'CONFIRMED'
              AND check_in  < DATE_SUB(CURDATE(), INTERVAL :end   DAY)
              AND check_out > DATE_SUB(CURDATE(), INTERVAL :start DAY)
        ";

        $bookedNights = (float) $this->em->getConnection()->fetchOne($sql, [
            'end'   => $offsetDays,
            'start' => $offsetDays + $windowDays,
        ]);

        $capacity = $totalRooms * (float) $windowDays;
        return $capacity > 0 ? $this->clamp(($bookedNights / $capacity) * 100.0, 0, 100) : 0.0;
    }

    private function confirmedCount(int $windowDays, int $offsetDays): int
    {
        $sql = "
            SELECT COUNT(*) FROM bookingacc
            WHERE status     = 'CONFIRMED'
              AND created_at >= DATE_SUB(CURDATE(), INTERVAL :start DAY)
              AND created_at <  DATE_SUB(CURDATE(), INTERVAL :end   DAY)
        ";
        return (int) $this->em->getConnection()->fetchOne($sql, [
            'start' => $offsetDays + $windowDays,
            'end'   => $offsetDays,
        ]);
    }

    private function momentum(int $recent, int $previous): float
    {
        if ($recent <= 0 && $previous <= 0) { return 0.5; }
        if ($previous <= 0) { return 0.8; }
        $growth = ($recent - $previous) / (float) $previous;
        return $this->clamp(0.5 + $growth * 0.3, 0, 1);
    }

    // ── Decision narrative ────────────────────────────────────────────

    private function decisionSummary(
        float $occ,
        float $adj,
        float $momentum,
        float $conf,
        array $reg
    ): string {
        $dir  = $adj > 1.0 ? 'increase' : ($adj < -1.0 ? 'decrease' : 'hold');
        $sign = $adj >= 0 ? '+' : '';

        if ($reg['modelTrained']) {
            return sprintf(
                'True ML regression suggests to %s prices (%s%.1f%%). '.
                'Forecast occupancy: %.1f%%, R²: %.3f, samples: %d, confidence: %.1f%%.',
                $dir, $sign, $adj, $occ, $reg['r2'], $reg['sampleSize'], $conf
            );
        }

        return sprintf(
            'ML fallback: %s prices (%s%.1f%%) until enough confirmed bookings exist. '.
            'Forecast occupancy: %.1f%%, momentum: %.1f%%, confidence: %.1f%%.',
            $dir, $sign, $adj, $occ, $momentum * 100.0, $conf
        );
    }

    private function emptySnapshot(string $msg): array
    {
        return [
            'forecastOccupancyPct'        => 0.0,
            'momentum'                    => 0.0,
            'suggestedPriceAdjustmentPct' => 0.0,
            'modelConfidencePct'          => 20.0,
            'decisionSummary'             => $msg,
            'regression'                  => ['modelTrained' => false, 'narrative' => $msg],
            'elasticity'                  => ['modelTrained' => false, 'narrative' => $msg],
        ];
    }

    private function clamp(float $v, float $min, float $max): float
    {
        return max($min, min($max, $v));
    }
}