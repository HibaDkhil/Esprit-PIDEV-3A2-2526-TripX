<?php

namespace App\service\Accommodation;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Ridge Linear Regression trained from confirmed bookings.
 *
 * Features (8, index 0 = intercept):
 *   [0] intercept       [1] price_per_night
 *   [2] capacity        [3] stars
 *   [4] rating          [5] is_weekend (0/1)
 *   [6] month_sin       [7] month_cos
 */
class PriceRegressionService
{
    private const FEATURE_COUNT     = 8;
    private const RIDGE_LAMBDA      = 0.12;
    private const DEFAULT_WEEKEND_R = 2.0 / 7.0;

    public function __construct(private readonly EntityManagerInterface $em) {}

    // ─── Public API ───────────────────────────────────────────────────

    public function computeSnapshot(): array
    {
        $rows = $this->loadTrainingRows();
        $n    = count($rows);

        if ($n < 10) {
            return $this->emptySnapshot($n,
                "Not enough confirmed bookings for regression training (need ≥ 10, have $n).");
        }

        $std     = new class(self::FEATURE_COUNT) {
            public array $mean = [];
            public array $std  = [];
            public function __construct(public int $m) {}
        };

        $X       = $this->buildFeatureMatrix($rows, $std);
        $y       = array_column($rows, 'target');
        $weights = $this->trainRidge($X, $y);

        if ($weights === null) {
            return $this->emptySnapshot($n,
                'Price model training failed — unstable covariance matrix.');
        }

        $eval = $this->evaluate($X, $y, $weights);

        $predRows = $this->loadPredictionRows();
        if (empty($predRows)) {
            return array_merge($this->baseStats($n, $eval), [
                'narrative' => 'Regression trained but no available rooms found.',
            ]);
        }

        $sumPred    = 0.0;
        $sumCurrent = 0.0;
        $valid      = 0;

        foreach ($predRows as $pr) {
            $features = $this->buildPredictionFeatures($pr, $std);
            $pred     = $this->dot($features, $weights);
            if (is_finite($pred) && $pred > 0) {
                $sumPred    += $pred;
                $sumCurrent += (float)$pr['base_price'];
                $valid++;
            }
        }

        if ($valid === 0 || $sumCurrent <= 0.0) {
            return array_merge($this->baseStats($n, $eval), [
                'narrative' => 'Regression trained but predictions could not be aggregated.',
            ]);
        }

        $curAvg  = $sumCurrent / $valid;
        $predAvg = $sumPred    / $valid;
        $adjPct  = $this->clamp((($predAvg - $curAvg) / $curAvg) * 100.0, -15.0, 15.0);
        $conf    = $this->confidence($eval['r2'], $n);

        return [
            'modelTrained'           => true,
            'sampleSize'             => $n,
            'r2'                     => round($eval['r2'],  4),
            'rmse'                   => round($eval['rmse'], 2),
            'currentAvgNightly'      => round($curAvg,  2),
            'predictedAvgNightly'    => round($predAvg, 2),
            'suggestedAdjustmentPct' => round($adjPct,  1),
            'confidencePct'          => round($conf,    1),
            'narrative'              => $this->narrative($adjPct, $predAvg, $curAvg, $eval['r2'], $n),
        ];
    }

    // ─── Data loading ─────────────────────────────────────────────────

    private function loadTrainingRows(): array
    {
        $sql = "
            SELECT
                r.price_per_night           AS base_price,
                COALESCE(r.capacity, 2)     AS capacity,
                COALESCE(a.stars, 3)        AS stars,
                COALESCE(a.rating, 3.0)     AS rating,
                DAYOFWEEK(b.check_in)       AS dow,
                MONTH(b.check_in)           AS month_num,
                DATEDIFF(b.check_out, b.check_in) AS nights,
                b.total_price               AS total_price
            FROM bookingacc b
            JOIN room r          ON b.room_id = r.id
            JOIN accommodation a ON r.accommodation_id = a.id
            WHERE b.status = 'CONFIRMED'
              AND b.total_price > 0
              AND r.price_per_night > 0
              AND DATEDIFF(b.check_out, b.check_in) > 0
        ";

        $results = $this->em->getConnection()->executeQuery($sql)->fetchAllAssociative();
        $rows    = [];

        foreach ($results as $row) {
            $nights = (int)$row['nights'];
            if ($nights <= 0) continue;
            $nightly = (float)$row['total_price'] / $nights;
            if (!is_finite($nightly) || $nightly <= 0) continue;

            $dow = (int)$row['dow'];
            $m   = (int)$row['month_num'];
            $rows[] = [
                'base_price' => (float)$row['base_price'],
                'capacity'   => (int)$row['capacity'],
                'stars'      => (int)$row['stars'],
                'rating'     => (float)$row['rating'],
                'is_weekend' => ($dow === 1 || $dow === 7) ? 1.0 : 0.0,
                'month_sin'  => sin(2.0 * M_PI * $m / 12.0),
                'month_cos'  => cos(2.0 * M_PI * $m / 12.0),
                'target'     => $nightly,
            ];
        }

        return $rows;
    }

    private function loadPredictionRows(): array
    {
        $sql = "
            SELECT r.price_per_night AS base_price,
                   COALESCE(r.capacity, 2)  AS capacity,
                   COALESCE(a.stars, 3)     AS stars,
                   COALESCE(a.rating, 3.0)  AS rating
            FROM room r
            JOIN accommodation a ON r.accommodation_id = a.id
            WHERE r.price_per_night > 0
              AND r.is_available = 1
        ";

        return $this->em->getConnection()->executeQuery($sql)->fetchAllAssociative();
    }

    // ─── Feature engineering ──────────────────────────────────────────

    private function buildFeatureMatrix(array $rows, object $std): array
    {
        $n = count($rows);
        $m = self::FEATURE_COUNT;
        $X = [];

        foreach ($rows as $i => $row) {
            $X[$i] = [
                1.0,
                (float)$row['base_price'],
                (float)$row['capacity'],
                (float)$row['stars'],
                (float)$row['rating'],
                (float)$row['is_weekend'],
                (float)$row['month_sin'],
                (float)$row['month_cos'],
            ];
        }

        // Fit mean/std (skip intercept col 0)
        $std->mean = array_fill(0, $m, 0.0);
        $std->std  = array_fill(0, $m, 1.0);

        for ($j = 1; $j < $m; $j++) {
            $sum = 0.0;
            foreach ($X as $row) $sum += $row[$j];
            $std->mean[$j] = $sum / $n;
        }
        for ($j = 1; $j < $m; $j++) {
            $var = 0.0;
            foreach ($X as $row) $var += ($row[$j] - $std->mean[$j]) ** 2;
            $s = sqrt($var / max(1, $n - 1));
            $std->std[$j] = $s < 1e-9 ? 1.0 : $s;
        }

        // Standardize
        foreach ($X as $i => $row) {
            for ($j = 1; $j < $m; $j++) {
                $X[$i][$j] = ($row[$j] - $std->mean[$j]) / $std->std[$j];
            }
        }

        return $X;
    }

    private function buildPredictionFeatures(array $pr, object $std): array
    {
        $month = (int)date('n');
        $raw = [
            1.0,
            (float)$pr['base_price'],
            (float)$pr['capacity'],
            (float)$pr['stars'],
            (float)$pr['rating'],
            self::DEFAULT_WEEKEND_R,
            sin(2.0 * M_PI * $month / 12.0),
            cos(2.0 * M_PI * $month / 12.0),
        ];

        $m = self::FEATURE_COUNT;
        for ($j = 1; $j < $m; $j++) {
            $raw[$j] = ($raw[$j] - $std->mean[$j]) / $std->std[$j];
        }
        return $raw;
    }

    // ─── Ridge regression ─────────────────────────────────────────────

    private function trainRidge(array $X, array $y): ?array
    {
        $n = count($X);
        $m = self::FEATURE_COUNT;

        // A = X'X + λI,  b = X'y
        $A = array_fill(0, $m, array_fill(0, $m, 0.0));
        $b = array_fill(0, $m, 0.0);

        for ($r = 0; $r < $n; $r++) {
            for ($i = 0; $i < $m; $i++) {
                $b[$i] += $X[$r][$i] * $y[$r];
                for ($j = 0; $j < $m; $j++) {
                    $A[$i][$j] += $X[$r][$i] * $X[$r][$j];
                }
            }
        }

        for ($i = 0; $i < $m; $i++) {
            $A[$i][$i] += ($i === 0) ? 1e-8 : self::RIDGE_LAMBDA;
        }

        return $this->solveGaussian($A, $b);
    }

    private function evaluate(array $X, array $y, array $w): array
    {
        $n    = count($y);
        $yBar = array_sum($y) / $n;
        $sse  = 0.0;
        $sst  = 0.0;

        foreach ($y as $i => $yi) {
            $pred = $this->dot($X[$i], $w);
            $sse += ($yi - $pred) ** 2;
            $sst += ($yi - $yBar) ** 2;
        }

        return [
            'rmse' => sqrt($sse / $n),
            'r2'   => $sst > 0 ? $this->clamp(1.0 - $sse / $sst, -1.0, 1.0) : 0.0,
        ];
    }

    // ─── Gaussian elimination ─────────────────────────────────────────

    private function solveGaussian(array $A, array $b): ?array
    {
        $n = count($b);
        $aug = [];
        for ($i = 0; $i < $n; $i++) {
            $aug[$i] = $A[$i];
            $aug[$i][$n] = $b[$i];
        }

        for ($p = 0; $p < $n; $p++) {
            // Partial pivot
            $max = $p;
            for ($r = $p + 1; $r < $n; $r++) {
                if (abs($aug[$r][$p]) > abs($aug[$max][$p])) $max = $r;
            }
            if (abs($aug[$max][$p]) < 1e-12) return null;
            if ($max !== $p) [$aug[$p], $aug[$max]] = [$aug[$max], $aug[$p]];

            $pv = $aug[$p][$p];
            for ($c = $p; $c <= $n; $c++) $aug[$p][$c] /= $pv;

            for ($r = 0; $r < $n; $r++) {
                if ($r === $p) continue;
                $f = $aug[$r][$p];
                for ($c = $p; $c <= $n; $c++) $aug[$r][$c] -= $f * $aug[$p][$c];
            }
        }

        return array_map(fn($row) => $row[$n], $aug);
    }

    // ─── Helpers ──────────────────────────────────────────────────────

    private function dot(array $a, array $b): float
    {
        $s = 0.0;
        foreach ($a as $i => $v) $s += $v * $b[$i];
        return $s;
    }

    private function confidence(float $r2, int $n): float
    {
        $quality = $this->clamp(($r2 + 0.2) * 100.0 / 1.2, 0, 100);
        $volume  = $this->clamp($n * 100.0 / 250.0, 0, 100);
        return $this->clamp($quality * 0.65 + $volume * 0.35, 10, 95);
    }

    private function clamp(float $v, float $min, float $max): float
    {
        return max($min, min($max, $v));
    }

    private function narrative(float $adj, float $pred, float $cur, float $r2, int $n): string
    {
        $dir = $adj > 1.0 ? 'increase' : ($adj < -1.0 ? 'decrease' : 'hold');
        $sign = $adj >= 0 ? '+' : '';
        return "True ML regression recommends to $dir prices ({$sign}" . round($adj, 1) . "%). "
            . "Predicted avg nightly: €" . round($pred, 1) . " vs current €" . round($cur, 1)
            . " (R²: " . round($r2, 3) . ", samples: $n).";
    }

    private function emptySnapshot(int $n, string $msg): array
    {
        return [
            'modelTrained'           => false,
            'sampleSize'             => $n,
            'r2'                     => 0.0,
            'rmse'                   => 0.0,
            'currentAvgNightly'      => 0.0,
            'predictedAvgNightly'    => 0.0,
            'suggestedAdjustmentPct' => 0.0,
            'confidencePct'          => 20.0,
            'narrative'              => $msg,
        ];
    }

    private function baseStats(int $n, array $eval): array
    {
        return [
            'modelTrained'           => true,
            'sampleSize'             => $n,
            'r2'                     => round($eval['r2'], 4),
            'rmse'                   => round($eval['rmse'], 2),
            'currentAvgNightly'      => 0.0,
            'predictedAvgNightly'    => 0.0,
            'suggestedAdjustmentPct' => 0.0,
            'confidencePct'          => round($this->confidence($eval['r2'], $n), 1),
        ];
    }
}