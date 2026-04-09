<?php

/**
 * =============================================================================
 * ACCOMMODATION MODULE (public listing + AJAX search for users)
 * =============================================================================
 * Route GET /accommodations — catalog with room price bounds and filters.
 * Route GET /accommodations/search — JSON for live filter UI.
 *
 * Detail page: AccommodationDetailsController (/accommodations/{id})
 * Bookings:    AccommodationDetailsController (POST booking) + BookingAcc entity
 * Admin CRUD:   controllers under App\Controller\admin for accommodations/rooms
 * =============================================================================
 */
namespace App\Controller\user;

use App\Entity\Accommodation;
use App\Entity\BookingAcc;
use App\Entity\Room;
use App\Repository\AccommodationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontAccommodationController extends AbstractController
{
    public function __construct(
        private readonly AccommodationRepository $accRepo,
        private readonly EntityManagerInterface $em,
    ) {}

    #[Route('/accommodations', name: 'accommodations', methods: ['GET'])]
    public function index(): Response
    {
        $accommodations = $this->getAccommodationsWithRoomData([]);

        $priceBounds = $this->em->createQueryBuilder()
            ->select('COALESCE(MIN(r.pricePerNight), 0) as minPrice')
            ->addSelect('COALESCE(MAX(r.pricePerNight), 2000) as maxPrice')
            ->from(Room::class, 'r')
            ->join('r.accommodation', 'a')
            ->where('a.status = :status')
            ->andWhere('r.isAvailable = :available')
            ->setParameter('status', 'Active')
            ->setParameter('available', true)
            ->getQuery()
            ->getSingleResult();

        $types = $this->em->createQueryBuilder()
            ->select('DISTINCT a.type')
            ->from(Accommodation::class, 'a')
            ->where('a.status = :status')
            ->andWhere('a.type IS NOT NULL')
            ->andWhere('a.type != :empty')
            ->setParameter('status', 'Active')
            ->setParameter('empty', '')
            ->orderBy('a.type', 'ASC')
            ->getQuery()
            ->getSingleColumnResult();

        return $this->render('front/accommodations.html.twig', [
            'accommodations' => $accommodations,
            'minPrice'       => (int) ($priceBounds['minPrice'] ?? 0),
            'maxPrice'       => (int) ($priceBounds['maxPrice'] ?? 2000),
            'types'          => $types,
            'totalCount'     => count($accommodations),
        ]);
    }

    #[Route('/accommodations/search', name: 'accommodations_search', methods: ['GET'])]
    public function search(Request $request): JsonResponse
    {
        try {
            $allQuery     = $request->query->all();
            $starsRaw     = $allQuery['stars']     ?? [];
            $amenitiesRaw = $allQuery['amenities'] ?? [];

            $filters = [
                'q'         => trim($request->query->get('q', '')),
                'type'      => trim($request->query->get('type', '')),
                'minPrice'  => $request->query->get('minPrice', ''),
                'maxPrice'  => $request->query->get('maxPrice', ''),
                'stars'     => is_array($starsRaw)     ? $starsRaw     : [],
                'amenities' => is_array($amenitiesRaw) ? $amenitiesRaw : [],
                'checkIn'   => trim($request->query->get('checkIn', '')),
                'checkOut'  => trim($request->query->get('checkOut', '')),
                'sort'      => $request->query->get('sort', 'rating'),
                'minRating' => $request->query->get('minRating', ''),
            ];

            $items = $this->getAccommodationsWithRoomData($filters);

            return $this->json([
                'count'          => count($items),
                'accommodations' => $items,
            ]);

        } catch (\Throwable $e) {
            return $this->json([
                'error'          => $e->getMessage(),
                'count'          => 0,
                'accommodations' => [],
            ], 500);
        }
    }

    private function getAccommodationsWithRoomData(array $filters): array
    {
        // Query 1: Get accommodations
        $qb = $this->em->createQueryBuilder()
            ->select('a')
            ->from(Accommodation::class, 'a')
            ->where('a.status = :status')
            ->setParameter('status', 'Active');

        $this->applySearchFilters($qb, $filters);
        $this->applyStarFilters($qb, $filters);
        $this->applyRatingFilter($qb, $filters);
        $this->applyAmenitiesFilter($qb, $filters);
        $this->applySorting($qb, $filters['sort'] ?? 'rating');

        $accommodations = $qb->getQuery()->getResult();

        if (empty($accommodations)) {
            return [];
        }

        // Query 2: Get room data for all accommodations at once
        $accIds = array_map(fn($a) => $a->getId(), $accommodations);

        $roomDataQuery = $this->em->createQueryBuilder()
            ->select('IDENTITY(r.accommodation) as accId')
            ->addSelect('MIN(r.pricePerNight) as minPrice')
            ->addSelect('COUNT(r.id) as availableRooms')
            ->from(Room::class, 'r')
            ->where('r.isAvailable = :available')
            ->andWhere('IDENTITY(r.accommodation) IN (:ids)')
            ->setParameter('available', true)
            ->setParameter('ids', $accIds)
            ->groupBy('r.accommodation');

        // Add date availability filter if provided
        $checkIn = $filters['checkIn'] ?? '';
        $checkOut = $filters['checkOut'] ?? '';
        
        if ($checkIn !== '' && $checkOut !== '') {
            try {
                $ci = new \DateTime($checkIn);
                $co = new \DateTime($checkOut);
                if ($ci < $co) {
                    // Exclude rooms that have overlapping bookings
                    $bookingSubquery = $this->em->createQueryBuilder()
                        ->select('IDENTITY(b.room)')
                        ->from(BookingAcc::class, 'b')
                        ->where('b.status IN (:statuses)')
                        ->andWhere('b.checkIn < :checkOut')
                        ->andWhere('b.checkOut > :checkIn')
                        ->setParameter('statuses', ['CONFIRMED', 'PENDING'])
                        ->setParameter('checkIn', $ci->format('Y-m-d'))
                        ->setParameter('checkOut', $co->format('Y-m-d'));
                    
                    $roomDataQuery->andWhere($roomDataQuery->expr()->notIn('r.id', $bookingSubquery->getDQL()));
                }
            } catch (\Exception $e) {
                // Invalid dates - skip
            }
        }

        $roomData = $roomDataQuery->getQuery()->getResult();

        // Index room data by accommodation ID
        $roomMap = [];
        foreach ($roomData as $rd) {
            $roomMap[$rd['accId']] = $rd;
        }

        // Apply price filter in PHP (since we can't do it in DQL without subquery join)
        $minPriceFilter = $filters['minPrice'] ?? '';
        $maxPriceFilter = $filters['maxPrice'] ?? '';

        $results = [];
        foreach ($accommodations as $acc) {
            $id    = $acc->getId();
            $rd    = $roomMap[$id] ?? null;
            $price = $rd ? (int) round((float) $rd['minPrice']) : null;
            $rooms = $rd ? (int) $rd['availableRooms'] : 0;

            // Apply price filters
            if ($minPriceFilter !== '' && is_numeric($minPriceFilter) && $price !== null) {
                if ($price < (float) $minPriceFilter) continue;
            }
            if ($maxPriceFilter !== '' && is_numeric($maxPriceFilter) && $price !== null) {
                if ($price > (float) $maxPriceFilter) continue;
            }

            // Apply date filter (must have available rooms)
            if ($checkIn !== '' && $checkOut !== '' && $rooms === 0) {
                continue;
            }

            $amenities = $acc->getAccommodationAmenities() ?? '';
            if (!empty($amenities)) {
                $amenities = implode(', ', array_filter(array_map('trim', explode(',', $amenities))));
            }

            $results[] = [
                'id'             => $id,
                'name'           => $acc->getName(),
                'type'           => $acc->getType() ?? '',
                'city'           => $acc->getCity() ?? '',
                'country'        => $acc->getCountry() ?? '',
                'stars'          => $acc->getStars() ?? 0,
                'rating'         => $acc->getRating() !== null ? round((float) $acc->getRating(), 1) : null,
                'imagePath'      => $acc->getImagePath(),
                'latitude'       => $acc->getLatitude() !== null ? (float) $acc->getLatitude() : null,
                'longitude'      => $acc->getLongitude() !== null ? (float) $acc->getLongitude() : null,
                'description'    => $acc->getDescription() ?? '',
                'amenities'      => $amenities,
                'phone'          => $acc->getPhone() ?? '',
                'email'          => $acc->getEmail() ?? '',
                'minPrice'       => $price,
                'availableRooms' => $rooms,
            ];
        }

        return $results;
    }

    private function applySearchFilters(QueryBuilder $qb, array $filters): void
    {
        $q = $filters['q'] ?? '';
        if (!empty($q)) {
            $qb->andWhere('(a.name LIKE :q OR a.city LIKE :q OR a.country LIKE :q OR a.type LIKE :q)')
               ->setParameter('q', '%' . $q . '%');
        }

        $type = $filters['type'] ?? '';
        if (!empty($type)) {
            $qb->andWhere('a.type = :type')
               ->setParameter('type', $type);
        }
    }

    private function applyStarFilters(QueryBuilder $qb, array $filters): void
    {
        $stars = array_filter(
            array_map('intval', (array) ($filters['stars'] ?? [])),
            fn($s) => $s >= 1 && $s <= 5
        );
        
        if (!empty($stars)) {
            $qb->andWhere('a.stars IN (:stars)')
               ->setParameter('stars', $stars);
        }
    }

    private function applyRatingFilter(QueryBuilder $qb, array $filters): void
    {
        $minRating = $filters['minRating'] ?? '';
        if ($minRating !== '' && is_numeric($minRating) && (float) $minRating > 0) {
            $qb->andWhere('a.rating >= :minRating OR a.rating IS NULL')
               ->setParameter('minRating', (float) $minRating);
        }
    }

    private function applyAmenitiesFilter(QueryBuilder $qb, array $filters): void
    {
        $amenities = array_filter((array) ($filters['amenities'] ?? []));
        
        foreach ($amenities as $i => $amenity) {
            $paramName = 'am' . $i;
            $qb->andWhere("a.accommodationAmenities LIKE :{$paramName}")
               ->setParameter($paramName, '%' . trim($amenity) . '%');
        }
    }

    private function applySorting(QueryBuilder $qb, string $sort): void
    {
        switch ($sort) {
            case 'price_asc':
            case 'price_desc':
                // Price sorting is handled after PHP filtering
                // We'll sort the final results array
                break;
            case 'stars':
                $qb->orderBy('a.stars', 'DESC');
                break;
            case 'name':
                $qb->orderBy('a.name', 'ASC');
                break;
            case 'rating':
            default:
                $qb->orderBy('a.rating', 'DESC')
                   ->addOrderBy('a.stars', 'DESC');
                break;
        }
    }
}