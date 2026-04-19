<?php
namespace App\Repository;

use App\Entity\Schedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ScheduleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Schedule::class);
    }

    // ★★★ NEW — DQL/QueryBuilder search used by the AJAX endpoint ★★★

    // $transportIds : array of transport IDs already filtered by type (FLIGHT or VEHICLE)

    // $cls          : travel class ('ECONOMY','PREMIUM','BUSINESS','FIRST') or '' / 'any'

    // $depDate      : departure date string 'Y-m-d' (flights only)

    // $rsStart      : rental start date string (vehicles only)

    // $rsEnd        : rental end date string (vehicles only)

    public function searchSchedulesByType(

        array  $transportIds,

        string $cls     = '',

        string $depDate = '',

        string $rsStart = '',

        string $rsEnd   = ''

    ): array {

        // Guard: if no matching transports, return empty immediately

        if (empty($transportIds)) {

            return [];

        }


        $qb = $this->createQueryBuilder('s')

            ->where('s.transportId IN (:ids)')          // filter by transport type set

            ->setParameter('ids', $transportIds);


        // ── Travel class filter (flights) ──

        if ($cls !== '' && $cls !== 'any') {

            $qb->andWhere('s.travelClass = :cls')

               ->setParameter('cls', strtoupper($cls));

        }


        // ── Departure date filter (flights) ──

        if ($depDate !== '') {

            $start = new \DateTime($depDate . ' 00:00:00');

            $end   = new \DateTime($depDate . ' 23:59:59');

            $qb->andWhere('s.departureDatetime BETWEEN :depStart AND :depEnd')

               ->setParameter('depStart', $start)

               ->setParameter('depEnd', $end);

        }


        // ── Rental start filter (vehicles) ──

        if ($rsStart !== '') {

            $rsS = new \DateTime($rsStart);

            // rentalStart must be on or before the requested start

            $qb->andWhere('s.rentalStart IS NULL OR s.rentalStart <= :rsStart')

               ->setParameter('rsStart', $rsS);

        }


        // ── Rental end filter (vehicles) ──

        if ($rsEnd !== '') {

            $rsE = new \DateTime($rsEnd);

            // rentalEnd must be on or after the requested end

            $qb->andWhere('s.rentalEnd IS NULL OR s.rentalEnd >= :rsEnd')

               ->setParameter('rsEnd', $rsE);

        }


        return $qb

            ->orderBy('s.departureDatetime', 'ASC')

            ->getQuery()

            ->getResult();

    }

    // ★★★ END NEW ★★★
}