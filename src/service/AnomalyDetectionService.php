<?php

namespace App\service;

use App\Entity\Bookingtrans;
use App\Repository\BookingtransRepository;
use Phpml\Clustering\KMeans;
use Phpml\Math\Distance\Euclidean;

class AnomalyDetectionService
{
    private BookingtransRepository $bookingRepo;

    // Cache to prevent N^2 KMeans clustering per request
    private ?array $centroids = null;
    private ?float $meanDistance = null;
    private ?float $stdDev = null;

    public function __construct(BookingtransRepository $bookingRepo)
    {
        $this->bookingRepo = $bookingRepo;
    }

    private function trainModel(): void
    {
        // Already trained for this request?
        if ($this->centroids !== null) return;

        $bookings = $this->bookingRepo->findBy(['bookingStatus' => 'CONFIRMED']);
        $samples = [];
        
        foreach ($bookings as $bk) {
            $samples[] = [
                (float) $bk->getTotalSeats(),
                (float) $bk->getTotalPrice(),
                (float) $bk->getAdultsCount(),
                (float) $bk->getChildrenCount(),
                $bk->isInsuranceIncluded() ? 1.0 : 0.0
            ];
        }

        if (count($samples) < 5) {
            $this->centroids = [];
            $this->meanDistance = 0.0;
            $this->stdDev = 0.0;
            return;
        }

        $clustersCount = min(3, max(1, (int)(count($samples) / 5)));
        $kmeans = new KMeans($clustersCount);
        $clusters = $kmeans->cluster($samples);

        $euclidean = new Euclidean();
        $allDistances = [];
        $centroids = [];

        foreach ($clusters as $i => $cluster) {
            if (count($cluster) === 0) continue;
            
            $centroid = [];
            for ($k = 0; $k < 5; $k++) {
                $centroid[$k] = array_sum(array_column($cluster, $k)) / count($cluster);
            }
            $centroids[] = $centroid;

            foreach ($cluster as $sample) {
                $allDistances[] = $euclidean->distance($sample, $centroid);
            }
        }

        $this->centroids = $centroids;

        if (count($allDistances) > 0) {
            $this->meanDistance = array_sum($allDistances) / count($allDistances);
            $variance = 0.0;
            foreach ($allDistances as $d) {
                $variance += pow($d - $this->meanDistance, 2);
            }
            $this->stdDev = sqrt($variance / count($allDistances));
        } else {
            $this->meanDistance = 0.0;
            $this->stdDev = 0.0;
        }
    }

    public function isAnomalous(Bookingtrans $b): array
    {
        $this->trainModel();

        if (empty($this->centroids) || $this->stdDev < 0.01) {
            return ['suspicious' => false, 'reason' => 'Not enough variance for clustering', 'riskScore' => 0.0];
        }

        $target = [
            (float) $b->getTotalSeats(),
            (float) $b->getTotalPrice(),
            (float) $b->getAdultsCount(),
            (float) $b->getChildrenCount(),
            $b->isInsuranceIncluded() ? 1.0 : 0.0
        ];

        $euclidean = new Euclidean();
        $minDist = PHP_FLOAT_MAX;
        $nearestCentroid = null;

        foreach ($this->centroids as $c) {
            $d = $euclidean->distance($target, $c);
            if ($d < $minDist) {
                $minDist = $d;
                $nearestCentroid = $c;
            }
        }

        $deviations = ($minDist - $this->meanDistance) / $this->stdDev;

        if ($deviations > 2.5) {
            $priceDiff = $target[1] - $nearestCentroid[1];
            $pricePercent = $nearestCentroid[1] > 0 ? abs($priceDiff / $nearestCentroid[1]) * 100 : 0;
            $riskScore = min(0.99, 0.5 + ($deviations / 10));

            $reason = 'Statistically unusual dimensions (outlier).';
            if ($pricePercent > 150) {
                $reason = sprintf('Total price %d%% %s cluster average', (int)$pricePercent, $priceDiff > 0 ? 'above' : 'below');
            } elseif ($target[0] > $nearestCentroid[0] * 2) {
                $reason = 'Seat density unusually high for this tier.';
            }

            return ['suspicious' => true, 'reason' => $reason, 'riskScore' => round($riskScore, 2)];
        }

        return ['suspicious' => false, 'reason' => '', 'riskScore' => 0.0];
    }
}
