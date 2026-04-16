<?php

namespace App\service;

use Phpml\Math\Distance\Euclidean;
use App\Entity\Schedule;

class RouteRecommendationService
{
    private BookingtransService $bookingService;
    private ScheduleService $scheduleService;
    private TransportService $transportService;

    public function __construct(
        BookingtransService $bookingService,
        ScheduleService $scheduleService,
        TransportService $transportService
    ) {
        $this->bookingService = $bookingService;
        $this->scheduleService = $scheduleService;
        $this->transportService = $transportService;
    }

    public function getRecommendations(int $userId, int $limit = 3): array
    {
        $allBookings = $this->bookingService->getBookingsByUserId($userId);
        if (count($allBookings) === 0) {
            return []; // No booking history to deduce preferences
        }

        // 1. Build vector profiles from user's confirmed/paid history
        $userVectors = [];
        $bookedScheduleIds = [];

        foreach ($allBookings as $b) {
            if ($b->getBookingStatus() === 'CANCELLED') continue;
            
            $sId = $b->getScheduleId();
            if ($sId) {
                $bookedScheduleIds[] = $sId;
                $sched = $this->scheduleService->findById($sId);
                $trans = $this->transportService->findById($b->getTransportId());
                if ($sched && $trans) {
                    $userVectors[] = $this->extractFeatures($sched, $trans);
                }
            }
        }

        if (count($userVectors) === 0) {
            return [];
        }

        // 2. Load all available remaining active schedules
        $allSchedules = $this->scheduleService->getAllSchedules();
        $unbookedSchedules = [];
        $unbookedVectors = [];

        foreach ($allSchedules as $s) {
            if ($s->getStatus() === 'CANCELLED') continue;
            if (in_array($s->getScheduleId(), $bookedScheduleIds)) continue; // Filter already consumed

            $trans = $this->transportService->findById($s->getTransportId());
            if ($trans && $trans->isActive()) {
                $unbookedSchedules[] = $s;
                $unbookedVectors[] = $this->extractFeatures($s, $trans);
            }
        }

        if (count($unbookedSchedules) === 0) {
            return [];
        }

        // 3. Collaborative K-Nearest Neighbors scoring (k target evaluation via Euclidean proximity)
        $euclidean = new Euclidean();
        $scheduleScores = [];

        foreach ($unbookedSchedules as $idx => $candidate) {
            $candidateVector = $unbookedVectors[$idx];
            
            $minDist = PHP_FLOAT_MAX;
            foreach ($userVectors as $uv) {
                $d = $euclidean->distance($candidateVector, $uv);
                if ($d < $minDist) {
                    $minDist = $d;
                }
            }
            $scheduleScores[] = [
                'schedule' => $candidate,
                'distance' => $minDist
            ];
        }

        // 4. Sort candidates from nearest match (closest distance = most statistically comparable) to furthest
        usort($scheduleScores, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        $recommendations = [];
        $kLimit = min($limit, count($scheduleScores));
        for ($i = 0; $i < $kLimit; $i++) {
            $recommendations[] = $scheduleScores[$i]['schedule'];
        }

        return $recommendations;
    }

    private function extractFeatures(Schedule $s, \App\Entity\Transport $t): array
    {
        $type = $t->getTransportType() === 'FLIGHT' ? 1.0 : 0.0;
        
        $clsIdx = match (strtoupper($s->getTravelClass())) {
            'ECONOMY' => 0.0,
            'PREMIUM' => 1.0,
            'BUSINESS' => 2.0,
            'FIRST' => 3.0,
            default => 0.0,
        };

        $depId = (float) $s->getDepartureDestinationId();
        $arrId = (float) $s->getArrivalDestinationId();

        $price = $t->getBasePrice() * $s->getPriceMultiplier();
        if ($price < 100) $priceRange = 0.0;
        elseif ($price <= 300) $priceRange = 1.0;
        else $priceRange = 2.0;

        return [$type, $clsIdx, $depId, $arrId, $priceRange];
    }
}
