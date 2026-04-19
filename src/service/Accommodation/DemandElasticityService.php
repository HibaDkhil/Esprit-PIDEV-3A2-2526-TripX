<?php

namespace App\service\Accommodation;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Demand Elasticity Estimator using log-log OLS regression.
 *
 * Economic concept: Price Elasticity of Demand (PED)
 *   β = Δln(occupancy) / Δln(price)
 *
 * Method:
 *   1. Group all confirmed bookings into price buckets (€20 wide)
 *   2. For each bucket: compute occupancy rate = booked_nights / available_room_nights
 *   3. OLS regression on log(mid_price) ~ log(occupancy_rate)
 *   4. Slope β = elasticity coefficient
 *
 * Interpretation:
 *   β < -1  → elastic demand   (price-sensitive guests)
 *   -1 < β < 0 → inelastic     (guests absorb price increases)
 *   β ≈ 0   → perfectly inelastic (demand unaffected by price)
 */
class DemandElasticityService
{
    private const BUCKET_SIZE   = 20;   // €20 price buckets
    private const MIN_BUCKETS   = 3;    // need at least 3 points for regression
    private const DAYS_WINDOW   = 365;  // rolling window for occupancy denominator

    public function __construct(private readonly EntityManagerInterface $em) {}

    // ── Public API ────────────────────────────────────────────────────

    public function computeSnapshot(): array
    {
        $buckets = $this->buildBuckets();

        if (count($buckets) < self::MIN_BUCKETS) {
            return $this->failSnapshot(
                count($buckets),
                'Not enough price diversity in confirmed bookings to estimate elasticity '.
                '(need ≥ ' . self::MIN_BUCKETS . ' distinct price ranges, have ' . count($buckets) . ').'
            );
        }

        // Log-log transform
        $logPrices = [];
        $logOccs   = [];
        foreach ($buckets as $b) {
            if ($b['midPrice'] > 0 && $b['occupancyPct'] > 0) {
                $logPrices[] = log($b['midPrice']);
                $logOccs[]   = log($b['occupancyPct']);
            }
        }

        if (count($logPrices) < self::MIN_BUCKETS) {
            return $this->failSnapshot(count($buckets),
                'Occupancy rates are zero for too many price buckets — add more confirmed bookings.');
        }

        [$beta, $alpha, $r2] = $this->olsRegression($logPrices, $logOccs);

        $interpretation = $this->interpret($beta);
        $deltaAt5       = round($beta * 5.0, 2);   // % change in occ if price +5%
        $deltaAt10      = round($beta * 10.0, 2);   // % change in occ if price +10%
        $deltaAtM5      = round($beta * -5.0, 2);   // % change if price -5%

        return [
            'modelTrained'       => true,
            'bucketCount'        => count($buckets),
            'beta'               => round($beta, 4),
            'alpha'              => round($alpha, 4),
            'r2'                 => round($r2, 4),
            'interpretation'     => $interpretation['label'],
            'interpretationDesc' => $interpretation['desc'],
            'deltaOccAt5pct'     => $deltaAt5,
            'deltaOccAt10pct'    => $deltaAt10,
            'deltaOccAtMinus5'   => $deltaAtM5,
            'buckets'            => $buckets,
            'narrative'          => $this->narrative($beta, $deltaAt5, $r2, count($buckets)),
        ];
    }

    // ── Build price buckets with occupancy rates ───────────────────────

    /**
     * Returns array of buckets sorted by midPrice:
     * [label, minPrice, maxPrice, midPrice, bookingCount, totalNights, occupancyPct]
     */
    private function buildBuckets(): array
    {
        // Total available room-nights in window (denominator for occupancy)
        $totalRooms      = (int) $this->em->getConnection()
            ->fetchOne("SELECT COUNT(*) FROM room WHERE price_per_night > 0");
        $availableNights = max(1, $totalRooms * self::DAYS_WINDOW);

        // Load confirmed bookings with room price
        $sql = "
            SELECT FLOOR(r.price_per_night / :bucket) * :bucket  AS bucket_floor,
                   COUNT(*)                                        AS booking_count,
                   SUM(DATEDIFF(b.check_out, b.check_in))         AS total_nights
            FROM bookingacc b
            JOIN room r ON b.room_id = r.id
            WHERE b.status          = 'CONFIRMED'
              AND r.price_per_night > 0
              AND DATEDIFF(b.check_out, b.check_in) > 0
            GROUP BY bucket_floor
            ORDER BY bucket_floor ASC
        ";

        $rows = $this->em->getConnection()->fetchAllAssociative($sql, [
            'bucket' => self::BUCKET_SIZE,
        ]);

        $buckets = [];
        foreach ($rows as $row) {
            $floor   = (float) $row['bucket_floor'];
            $nights  = (int)   $row['total_nights'];
            $count   = (int)   $row['booking_count'];
            $mid     = $floor + self::BUCKET_SIZE / 2.0;

            // Occupancy rate for this bucket (capped at 100%)
            $occ = min(100.0, ($nights / $availableNights) * 100.0 * count($rows));

            // If occ is tiny re-scale: use share of max bucket nights
            // (avoids all buckets being < 1%)
            $buckets[] = [
                'label'        => sprintf('€%.0f–%.0f', $floor, $floor + self::BUCKET_SIZE),
                'minPrice'     => $floor,
                'maxPrice'     => $floor + self::BUCKET_SIZE,
                'midPrice'     => $mid,
                'bookingCount' => $count,
                'totalNights'  => $nights,
                'occupancyPct' => round($occ, 2),
            ];
        }

        // Re-normalise occupancy so max bucket = 100% (relative demand curve)
        $maxNights = max(array_column($buckets, 'totalNights') ?: [1]);
        foreach ($buckets as &$b) {
            $b['occupancyPct'] = $maxNights > 0
                ? round(($b['totalNights'] / $maxNights) * 100.0, 2)
                : 0.0;
        }
        unset($b);

        return $buckets;
    }

    // ── OLS regression on two arrays ──────────────────────────────────

    /**
     * Simple OLS: y = α + β·x
     * Returns [beta, alpha, r2]
     */
    private function olsRegression(array $x, array $y): array
    {
        $n    = count($x);
        $xMean = array_sum($x) / $n;
        $yMean = array_sum($y) / $n;

        $num = $den = 0.0;
        for ($i = 0; $i < $n; $i++) {
            $dx  = $x[$i] - $xMean;
            $num += $dx * ($y[$i] - $yMean);
            $den += $dx * $dx;
        }

        if (abs($den) < 1e-12) {
            return [0.0, $yMean, 0.0];
        }

        $beta  = $num / $den;
        $alpha = $yMean - $beta * $xMean;

        // R²
        $sse = $sst = 0.0;
        for ($i = 0; $i < $n; $i++) {
            $pred = $alpha + $beta * $x[$i];
            $sse += ($y[$i] - $pred) ** 2;
            $sst += ($y[$i] - $yMean) ** 2;
        }
        $r2 = $sst > 0 ? max(-1.0, min(1.0, 1.0 - $sse / $sst)) : 0.0;

        return [$beta, $alpha, $r2];
    }

    // ── Interpretation ────────────────────────────────────────────────

    private function interpret(float $beta): array
    {
        if ($beta < -2.0) {
            return ['label' => 'Highly elastic',   'desc' => 'Guests are very price-sensitive. Small increases cause large demand drops.'];
        }
        if ($beta < -1.0) {
            return ['label' => 'Elastic demand',   'desc' => 'Price increases lead to proportionally larger occupancy drops.'];
        }
        if ($beta < -0.2) {
            return ['label' => 'Inelastic demand', 'desc' => 'Guests can absorb moderate price increases without much occupancy loss.'];
        }
        if ($beta < 0.0) {
            return ['label' => 'Weakly inelastic', 'desc' => 'Demand is nearly unresponsive to price in observed range.'];
        }
        return ['label' => 'Atypical',             'desc' => 'Positive elasticity — higher prices correlate with more bookings (luxury/prestige effect).'];
    }

    private function narrative(float $beta, float $delta5, float $r2, int $buckets): string
    {
        $interp = $this->interpret($beta);
        $sign   = $delta5 >= 0 ? '+' : '';
        return sprintf(
            'Demand elasticity β = %.3f (%s). A 5%% price increase is estimated to change '.
            'occupancy by %s%.2f%%. R²: %.3f across %d price buckets.',
            $beta, $interp['label'], $sign, $delta5, $r2, $buckets
        );
    }

    private function failSnapshot(int $buckets, string $msg): array
    {
        return [
            'modelTrained'       => false,
            'bucketCount'        => $buckets,
            'beta'               => 0.0,
            'alpha'              => 0.0,
            'r2'                 => 0.0,
            'interpretation'     => 'Insufficient data',
            'interpretationDesc' => $msg,
            'deltaOccAt5pct'     => 0.0,
            'deltaOccAt10pct'    => 0.0,
            'deltaOccAtMinus5'   => 0.0,
            'buckets'            => [],
            'narrative'          => $msg,
        ];
    }
}