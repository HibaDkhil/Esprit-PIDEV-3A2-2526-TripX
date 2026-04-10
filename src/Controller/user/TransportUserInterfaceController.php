<?php

/**
 * ============================================================================
 * TRANSPORT MODULE (user-facing)
 * ============================================================================
 * Routes are prefixed with /user/transport (see class Route attribute below).
 *
 * Features:
 *  - Schedules listing + AJAX search (user_transport_schedules_search)
 *  - Browse transports by type / provider (FLIGHT | VEHICLE)
 *  - Booking form + POST submit (Bookingtrans entity, BookingtransService)
 *  - My bookings, cancel, add schedule, AI route helper, PDF receipt
 *
 * Related entities: Transport, Schedule, Bookingtrans, DestinationTrans
 * Admin CRUD: App\Controller\admin\TransportAdminController
 * ============================================================================
 */
namespace App\Controller\user;

use App\Entity\User;
use App\Entity\Bookingtrans;
use App\service\BookingtransService;
use App\service\ScheduleService;
use App\service\TransportService;
use App\service\TransportOptimalRouteService;
use App\service\ValidationService;
use App\service\DestinationTransService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/user/transport')]
class TransportUserInterfaceController extends AbstractController
{
    private TransportService $transportService;
    private ScheduleService $scheduleService;
    private BookingtransService $bookingService;
    private TransportOptimalRouteService $routeService;
    private ValidationService $validation;
    private ValidatorInterface $validator;
    private DestinationTransService $destService;

    public function __construct(
        TransportService $transportService,
        ScheduleService $scheduleService,
        BookingtransService $bookingService,
        TransportOptimalRouteService $routeService,
        ValidationService $validation,
        ValidatorInterface $validator,
        DestinationTransService $destService
    ) {
        $this->transportService = $transportService;
        $this->scheduleService  = $scheduleService;
        $this->bookingService   = $bookingService;
        $this->routeService     = $routeService;
        $this->validation       = $validation;
        $this->validator        = $validator;
        $this->destService      = $destService;
    }

    /**
     * Resolves the logged-in user id for Bookingtrans ownership (no hard-coded fallback).
     */
    private function getCurrentUserId(): int
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw new AccessDeniedException('You must be logged in for transport bookings.');
        }
        $id = $user->getUserId() ?? $user->getId();
        if ($id === null) {
            throw new \LogicException('Authenticated user has no user id.');
        }

        return (int) $id;
    }

    // ════════════════════════════════════════
    // HELPERS
    // ════════════════════════════════════════

    private function buildTransportMap(): array
    {
        $map = [];
        foreach ($this->transportService->getAllTransports() as $t) {
            $map[$t->getTransportId()] = $t;
        }
        return $map;
    }

    private function buildDestinationMap(): array
    {
        $map = [];
        foreach ($this->destService->getAllDestinations() as $d) {
            $name = $d->getCity() ?: $d->getName();
            if ($d->getCountry()) {
                $name .= ', ' . $d->getCountry();
            }
            $map[$d->getDestinationId()] = $name;
        }
        return $map;
    }

    private function getBookedSeatsForSchedule(int $scheduleId): int
    {
        $total = 0;
        foreach ($this->bookingService->getAllBookings() as $b) {
            if ($b->getScheduleId() == $scheduleId && $b->getBookingStatus() !== 'CANCELLED') {
                $total += $b->getTotalSeats();
            }
        }
        return $total;
    }

    private function isVehicleScheduleUnavailable(int $scheduleId): bool
    {
        foreach ($this->bookingService->getAllBookings() as $b) {
           if ($b->getScheduleId() == $scheduleId && $b->getBookingStatus() !== 'CANCELLED') {
                return true;
            }
        }
        return false;
    }

    private function classMultiplier(string $cls): float
    {
        return match($cls) {
            'PREMIUM'  => 1.5,
            'BUSINESS' => 2.2,
            'FIRST'    => 3.0,
            default    => 1.0,
        };
    }

    private function calculatePrice(float $basePrice, float $schedMult, string $cls, int $seats, bool $insurance): float
    {
        return $basePrice * $schedMult * $this->classMultiplier($cls) * $seats + ($insurance ? 25.0 * $seats : 0);
    }

    private function isValidCoordinates(float $lat, float $lon): bool
    {
        return $lat >= -90 && $lat <= 90 && $lon >= -180 && $lon <= 180;
    }
    // ════════════════════════════════════════

    // ★★★ NEW — AJAX SCHEDULE SEARCH (DQL via repository QB) ★★★

    // ════════════════════════════════════════

    /**
     * AJAX: filtered schedules for the Schedules tab (used by doAjaxSearch() in the template).
     */
    #[Route('/schedules/search', name: 'user_transport_schedules_search', methods: ['GET'])]

    public function schedulesSearch(Request $request): JsonResponse

    {

        $type    = $request->query->get('type', 'all');

        $cls     = $request->query->get('cls',  'any');

        $depDate = $request->query->get('depDate', '');

        $rsStart = $request->query->get('rsStart', '');

        $rsEnd   = $request->query->get('rsEnd',   '');


        // Build maps of transport IDs by type

        $flightIds  = [];

        $vehicleIds = [];

        $tMap       = [];

        foreach ($this->transportService->getAllTransports() as $t) {

            if (!$t->isActive()) continue;

            $tMap[$t->getTransportId()] = $t;

            if ($t->getTransportType() === 'FLIGHT')  $flightIds[]  = $t->getTransportId();

            else                                         $vehicleIds[] = $t->getTransportId();

        }


        // Determine which IDs to query

        $ids = match($type) {

            'flight'  => $flightIds,

            'vehicle' => $vehicleIds,

            default   => array_merge($flightIds, $vehicleIds),

        };


        // ★ DQL/QueryBuilder search through ScheduleRepository (not PHP array_filter)

        $schedules = $this->scheduleService->searchSchedulesByType(

            $ids, $cls, $depDate, $rsStart, $rsEnd

        );


        // Build JSON result
        $destMap = $this->buildDestinationMap();
        $result = [];

        foreach ($schedules as $s) {

            $t = $tMap[$s->getTransportId()] ?? null;

            if (!$t) continue;

            $isFlight  = $t->getTransportType() === 'FLIGHT';

            $classMult = match($s->getTravelClass()) {

                'PREMIUM'  => 1.5, 'BUSINESS' => 2.2, 'FIRST' => 3.0, default => 1.0

            };

            // Availability

            $status = $s->getStatus();
            $isBookableStatus = in_array($status, ['ON_TIME', 'DELAYED']);

            if ($isFlight) {
                $rem   = $t->getCapacity() - $this->getBookedSeatsForSchedule($s->getScheduleId());
                $un    = $rem <= 0 || !$isBookableStatus;
                $avail = [
                    'unavailable' => $un,
                    'text'        => !$isBookableStatus ? $status : ($rem <= 0 ? 'Fully Booked' : $rem . ' seat(s) left'),
                    'color'       => $un ? '#c0392b' : ($rem <= 5 ? '#E07020' : '#27ae60'),
                ];
            } else {
                $isBooked = $this->isVehicleScheduleUnavailable($s->getScheduleId());
                $un       = $isBooked || !$isBookableStatus;
                $avail    = [
                    'unavailable' => $un,
                    'text'        => !$isBookableStatus ? $status : ($un ? 'Unavailable' : 'Available'),
                    'color'       => $un ? '#c0392b' : '#27ae60'
                ];
            }

            $result[] = [

                'scheduleId'              => $s->getScheduleId(),

                'transportId'             => $t->getTransportId(),

                'transportType'           => $t->getTransportType(),

                'providerName'            => $t->getProviderName(),

                'vehicleModel'            => $t->getVehicleModel(),

                'travelClass'             => $s->getTravelClass(),

                'status'                  => $s->getStatus() ?: 'ON_TIME',

                'departureDestinationId'  => $s->getDepartureDestinationId(),
                'departureDestinationName'=> $destMap[$s->getDepartureDestinationId()] ?? 'Unknown',

                'arrivalDestinationId'    => $s->getArrivalDestinationId(),
                'arrivalDestinationName'  => $destMap[$s->getArrivalDestinationId()] ?? 'Unknown',

                'departureDatetime'       => $s->getDepartureDatetime()?->format('d M Y H:i'),

                'arrivalDatetime'         => $s->getArrivalDatetime()?->format('H:i'),

                'rentalStart'             => $s->getRentalStart()?->format('d M Y'),

                'rentalEnd'               => $s->getRentalEnd()?->format('d M Y'),

                'price'                   => $t->getBasePrice() * $s->getPriceMultiplier() * $classMult,

                'sustainabilityRating'    => $t->getSustainabilityRating(),

                'delayMinutes'            => $s->getDelayMinutes(),

                'availability'            => $avail,

                'bookUrl'                 => $this->generateUrl('user_transport_book_form', [

                    'transportId' => $t->getTransportId(),

                    'scheduleId'  => $s->getScheduleId(),

                ]),

            ];

        }

        return new JsonResponse(['schedules' => $result, 'count' => count($result)]);

    }

    // ★★★ END NEW AJAX SEARCH ★★★

    // ════════════════════════════════════════
    // SCHEDULES TAB
    // ════════════════════════════════════════

    /**
     * Main schedules grid: filter by ?type= flight|vehicle|all and optional date/class params.
     */
    #[Route('', name: 'user_transport_index')]
    #[Route('/schedules', name: 'user_transport_schedules')]
    public function schedules(Request $request): Response
    {
        $allSchedules = $this->scheduleService->getAllSchedules();
        $transportMap = $this->buildTransportMap();

        $schedules = $allSchedules; // Remove CANCELLED filter

        $type = $request->query->get('type', 'all');

        if ($type === 'flight') {
            $schedules = array_filter($schedules, function($s) use ($transportMap) {
                $t = $transportMap[$s->getTransportId()] ?? null;
                return $t && $t->getTransportType() === 'FLIGHT';
            });
        } elseif ($type === 'vehicle') {
            $schedules = array_filter($schedules, function($s) use ($transportMap) {
                $t = $transportMap[$s->getTransportId()] ?? null;
                return $t && $t->getTransportType() === 'VEHICLE';
            });
        }

        $from    = $request->query->get('from', '');
        $cls     = $request->query->get('cls', 'any');
        $depDate = $request->query->get('depDate', '');
        $rsStart = $request->query->get('rsStart', '');
        $rsEnd   = $request->query->get('rsEnd', '');
        $to      = $request->query->get('to', '');

        $destMap = $this->buildDestinationMap();

        if ($from) {
            $schedules = array_filter($schedules, fn($s) => stripos($destMap[$s->getDepartureDestinationId()] ?? ('Destination #' . $s->getDepartureDestinationId()), $from) !== false);
        }
        if ($cls && $cls !== 'any') {
            if ($this->validation->isValidTravelClass($cls)) {
                $schedules = array_filter($schedules, fn($s) => $s->getTravelClass() === $cls);
            }
        }
        if ($depDate) {
            $depD = new DateTime($depDate);
            $schedules = array_filter($schedules, function($s) use ($depD) {
                if (!$s->getDepartureDatetime()) return false;
                return $s->getDepartureDatetime()->format('Y-m-d') === $depD->format('Y-m-d');
            });
        }
        if ($rsStart) {
            $rsS = new DateTime($rsStart);
            $schedules = array_filter($schedules, function($s) use ($rsS) {
                if (!$s->getRentalStart()) return true;
                return $s->getRentalStart() <= $rsS;
            });
        }
        if ($rsEnd) {
            $rsE = new DateTime($rsEnd);
            $schedules = array_filter($schedules, function($s) use ($rsE) {
                if (!$s->getRentalEnd()) return true;
                return $s->getRentalEnd() >= $rsE;
            });
        }

        $availability = [];
        foreach ($schedules as $s) {
            $t = $transportMap[$s->getTransportId()] ?? null;
            if (!$t) continue;
            $status = $s->getStatus();
            $isBookableStatus = in_array($status, ['ON_TIME', 'DELAYED']);

            if ($t->getTransportType() === 'FLIGHT') {
                $booked    = $this->getBookedSeatsForSchedule($s->getScheduleId());
                $remaining = $t->getCapacity() - $booked;
                $un        = $remaining <= 0 || !$isBookableStatus;
                $availability[$s->getScheduleId()] = [
                    'unavailable' => $un,
                    'text'        => !$isBookableStatus ? $status : ($remaining <= 0 ? 'Fully Booked' : $remaining . ' seat(s) left'),
                    'color'       => $un ? '#c0392b' : ($remaining <= 5 ? '#E07020' : '#27ae60'),
                ];
            } else {
                $isBooked = $this->isVehicleScheduleUnavailable($s->getScheduleId());
                $un       = $isBooked || !$isBookableStatus;
                $availability[$s->getScheduleId()] = [
                    'unavailable' => $un,
                    'text'        => !$isBookableStatus ? $status : ($un ? 'Unavailable' : 'Available'),
                    'color'       => $un ? '#c0392b' : '#27ae60',
                ];
            }
        }

        return $this->render('front/TransportUserInterface.html.twig', [
            'tab'          => 'schedules',
            'schedules'    => array_values($schedules),
            'transportMap' => $transportMap,
            'destMap'      => $destMap,
            'availability' => $availability,
            'type'         => $type,
            'filters'      => compact('from', 'cls', 'depDate', 'rsStart', 'rsEnd', 'to'),
        ]);
    }

    // ════════════════════════════════════════
    // TRANSPORT TAB
    // ════════════════════════════════════════

    /** Step 1: pick FLIGHT vs VEHICLE, then provider, then transport cards. */
    #[Route('/browse', name: 'user_transport_browse')]
    public function browse(Request $request): Response
    {
        $transportType = $request->query->get('transportType', '');

        $from    = $request->query->get('from', '');
        $to      = $request->query->get('to', '');
        $depDate = $request->query->get('depDate', '');
        $rsEnd   = $request->query->get('rsEnd', '');

        if (!$transportType) {
            return $this->render('front/TransportUserInterface.html.twig', [
                'tab'     => 'transport',
                'view'    => 'type_select',
                'filters' => compact('from', 'to', 'depDate', 'rsEnd'),
            ]);
        }

        if (!in_array($transportType, ['FLIGHT', 'VEHICLE'])) {
            $this->addFlash('error', 'Invalid transport type.');
            return $this->redirectToRoute('user_transport_browse');
        }

        $transports = array_filter(
            $this->transportService->getAllTransports(),
            function($t) use ($transportType, $from, $to) {
                if ($t->getTransportType() !== $transportType || !$t->isActive()) return false;
                if ($from && stripos($t->getProviderName() . ' ' . $t->getVehicleModel(), $from) === false) return false;
                return true;
            }
        );

        $providers = [];
        foreach ($transports as $t) {
            $prov = $t->getProviderName();
            if (!isset($providers[$prov])) $providers[$prov] = 0;
            $providers[$prov]++;
        }

        return $this->render('front/TransportUserInterface.html.twig', [
            'tab'           => 'transport',
            'view'          => 'providers',
            'transportType' => $transportType,
            'providers'     => $providers,
            'filters'       => compact('from', 'to', 'depDate', 'rsEnd'),
        ]);
    }

    /** Lists active transports for a given provider + type. */
    #[Route('/browse/provider', name: 'user_transport_provider')]
    public function providerTransports(Request $request): Response
    {
        $transportType = $request->query->get('transportType', '');
        $provider      = $request->query->get('provider', '');

        if (empty($provider) || !in_array($transportType, ['FLIGHT', 'VEHICLE'])) {
            $this->addFlash('error', 'Invalid provider or transport type.');
            return $this->redirectToRoute('user_transport_browse');
        }

        $from    = $request->query->get('from', '');
        $to      = $request->query->get('to', '');
        $depDate = $request->query->get('depDate', '');
        $rsEnd   = $request->query->get('rsEnd', '');

        $transports = array_filter(
            $this->transportService->getAllTransports(),
            function($t) use ($transportType, $provider, $from, $to) {
                if ($t->getTransportType() !== $transportType || $t->getProviderName() !== $provider || !$t->isActive()) return false;
                if ($from && stripos($t->getVehicleModel(), $from) === false) return false;
                return true;
            }
        );

        return $this->render('front/TransportUserInterface.html.twig', [
            'tab'           => 'transport',
            'view'          => 'transport_cards',
            'transportType' => $transportType,
            'provider'      => $provider,
            'transports'    => array_values($transports),
            'filters'       => compact('from', 'to', 'depDate', 'rsEnd'),
        ]);
    }

    /** Single transport + its non-cancelled schedules and availability hints. */
    #[Route('/browse/detail/{id}', name: 'user_transport_detail')]
    public function transportDetail(int $id): Response
    {
        $transport = $this->transportService->findById($id);
        if (!$transport) {
            $this->addFlash('error', 'Transport not found.');
            return $this->redirectToRoute('user_transport_browse');
        }

        if (!$transport->isActive()) {
            $this->addFlash('error', 'This transport is not currently active.');
            return $this->redirectToRoute('user_transport_browse');
        }

        $schedules = array_filter(
            $this->scheduleService->getAllSchedules(),
            fn($s) => $s->getTransportId() === $id && $s->getStatus() !== 'CANCELLED'
        );

        $availability = [];
        foreach ($schedules as $s) {
            $status = $s->getStatus();
            $isBookable = in_array($status, ['ON_TIME', 'DELAYED']);

            if ($transport->getTransportType() === 'FLIGHT') {
                $rem = $transport->getCapacity() - $this->getBookedSeatsForSchedule($s->getScheduleId());
                $un  = $rem <= 0 || !$isBookable;
                $availability[$s->getScheduleId()] = [
                    'unavailable' => $un,
                    'text'        => !$isBookable ? $status : ($rem <= 0 ? 'Full' : $rem . ' seats left'),
                ];
            } else {
                $isBooked = $this->isVehicleScheduleUnavailable($s->getScheduleId());
                $un       = $isBooked || !$isBookable;
                $availability[$s->getScheduleId()] = [
                    'unavailable' => $un,
                    'text'        => !$isBookable ? $status : ($un ? 'Booked' : 'Available'),
                ];
            }
        }

        return $this->render('front/TransportUserInterface.html.twig', [
            'tab'          => 'transport',
            'view'         => 'detail',
            'transport'    => $transport,
            'schedules'    => array_values($schedules),
            'availability' => $availability,
            'destMap'      => $this->buildDestinationMap(),
        ]);
    }

    // ════════════════════════════════════════
    // BOOKING FORM
    // ════════════════════════════════════════

    /** Booking wizard: requires transportId; scheduleId optional but recommended. */
    #[Route('/book', name: 'user_transport_book_form', methods: ['GET'])]
    public function bookForm(Request $request): Response
    {
        $transportId = (int) $request->query->get('transportId');
        $scheduleId  = (int) $request->query->get('scheduleId', 0);

        if ($transportId <= 0) {
            $this->addFlash('error', 'Invalid transport ID.');
            return $this->redirectToRoute('user_transport_schedules');
        }

        $transport = $this->transportService->findById($transportId);
        if (!$transport) {
            $this->addFlash('error', 'Transport not found.');
            return $this->redirectToRoute('user_transport_schedules');
        }

        if (!$transport->isActive()) {
            $this->addFlash('error', 'This transport is not currently active.');
            return $this->redirectToRoute('user_transport_schedules');
        }

        $schedule = null;
        if ($scheduleId > 0) {
            $schedule = $this->scheduleService->findById($scheduleId);
        }

        if ($schedule) {
            if ($schedule->getStatus() === 'CANCELLED') {
                $this->addFlash('error', 'This schedule has been cancelled.');
                return $this->redirectToRoute('user_transport_schedules');
            }
            if ($transport->getTransportType() === 'FLIGHT') {
                $rem = $transport->getCapacity() - $this->getBookedSeatsForSchedule($scheduleId);
                if ($rem <= 0) {
                    $this->addFlash('error', 'This flight is fully booked.');
                    return $this->redirectToRoute('user_transport_schedules');
                }
            } else {
                if ($this->isVehicleScheduleUnavailable($scheduleId)) {
                    $this->addFlash('error', 'This vehicle is already booked.');
                    return $this->redirectToRoute('user_transport_schedules');
                }
            }
        }

        return $this->render('front/TransportUserInterface.html.twig', [
            'tab'       => 'booking_form',
            'transport' => $transport,
            'schedule'  => $schedule,
            'destMap'   => $this->buildDestinationMap(),
        ]);
    }

    /** Persists Bookingtrans for the logged-in user (see getCurrentUserId). */
    #[Route('/book', name: 'user_transport_book_submit', methods: ['POST'])]
    public function bookSubmit(Request $request): Response
    {
        // ── CSRF ──
        if (!$this->isCsrfTokenValid('booking_form', $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid security token.');
            return $this->redirectToRoute('user_transport_schedules');
        }

        $transportId = (int) $request->request->get('transportId');
        $scheduleId  = (int) $request->request->get('scheduleId', 0);
        $adults      = (int) $request->request->get('adults', 1);
        $children    = (int) $request->request->get('children', 0);
        $cls         = $request->request->get('travelClass', 'ECONOMY');
        $insurance   = (bool) $request->request->get('insurance', false);

        // ── VALIDATION ──
        if ($transportId <= 0) {
            $this->addFlash('error', 'Invalid transport ID.');
            return $this->redirectToRoute('user_transport_schedules');
        }

        $transport = $this->transportService->findById($transportId);
        if (!$transport) {
            $this->addFlash('error', 'Transport not found.');
            return $this->redirectToRoute('user_transport_schedules');
        }

        if (!$this->validation->isValidSeats($adults)) {
            $this->addFlash('error', 'At least 1 adult is required.');
            return $this->redirectToRoute('user_transport_book_form', [
                'transportId' => $transportId,
                'scheduleId'  => $scheduleId,
            ]);
        }

        if ($children < 0) {
            $this->addFlash('error', 'Children count cannot be negative.');
            return $this->redirectToRoute('user_transport_book_form', [
                'transportId' => $transportId,
                'scheduleId'  => $scheduleId,
            ]);
        }

        if (!$this->validation->isValidTravelClass($cls)) {
            $this->addFlash('error', 'Invalid travel class selected.');
            return $this->redirectToRoute('user_transport_book_form', [
                'transportId' => $transportId,
                'scheduleId'  => $scheduleId,
            ]);
        }

        $seats = $adults + $children;
        if (!$this->validation->isValidSeats($seats)) {
            $this->addFlash('error', 'Total seats must be at least 1.');
            return $this->redirectToRoute('user_transport_book_form', [
                'transportId' => $transportId,
                'scheduleId'  => $scheduleId,
            ]);
        }
        // ── END VALIDATION ──

        $schedule  = null;
        $schedMult = 1.0;
        if ($scheduleId > 0) {
            $schedule = $this->scheduleService->findById($scheduleId);
            if ($schedule) $schedMult = $schedule->getPriceMultiplier();
        }

        // Re-check availability at moment of submit
        if ($schedule) {
            if ($transport->getTransportType() === 'FLIGHT') {
                $rem = $transport->getCapacity() - $this->getBookedSeatsForSchedule($scheduleId);
                if ($rem < $seats) {
                    $this->addFlash('error', 'Not enough seats! Requested: ' . $seats . ' | Available: ' . $rem);
                    return $this->redirectToRoute('user_transport_book_form', [
                        'transportId' => $transportId,
                        'scheduleId'  => $scheduleId,
                    ]);
                }
            } else {
                if ($this->isVehicleScheduleUnavailable($scheduleId)) {
                    $this->addFlash('error', 'This vehicle schedule is no longer available.');
                    return $this->redirectToRoute('user_transport_schedules');
                }
            }
        }

        $totalPrice = $this->calculatePrice($transport->getBasePrice(), $schedMult, $cls, $seats, $insurance);

        if (!$this->validation->isPositive($totalPrice)) {
            $this->addFlash('error', 'Calculated price is invalid. Please try again.');
            return $this->redirectToRoute('user_transport_book_form', [
                'transportId' => $transportId,
                'scheduleId'  => $scheduleId,
            ]);
        }

        $booking = new Bookingtrans();
        $booking->setUserId($this->getCurrentUserId());
        $booking->setTransportId($transportId);
        $booking->setScheduleId($scheduleId > 0 ? $scheduleId : null);
        $booking->setAdultsCount($adults);
        $booking->setChildrenCount($children);
        $booking->setTotalSeats($seats);
        $booking->setTotalPrice($totalPrice);
        $booking->setBookingStatus('PENDING');
        $booking->setPaymentStatus('UNPAID');
        $booking->setInsuranceIncluded($insurance);
        $booking->setBookingDate(new DateTime());
        $booking->setAiPricePrediction(0.0);
        $booking->setComparisonScore(0.0);
        // ★ Symfony Validator on booking entity (uses Assert on Bookingtrans)

        $violations = $this->validator->validate($booking);

        if (count($violations) > 0) {

            $errors = [];

            foreach ($violations as $v) {

                $errors[$v->getPropertyPath()][] = $v->getMessage();

            }

            return $this->render('front/TransportUserInterface.html.twig', [
                'tab'       => 'booking_form',
                'transport' => $transport,
                'schedule'  => $schedule,
                'errors'    => $errors,       // ★ pass errors to Twig for inline display
                'formData'  => $request->request->all(),
                'destMap'   => $this->buildDestinationMap(),
            ]);
        }

        // ★ End Symfony Validator block

        // ── VEHICLE COORDINATES WITH RANGE VALIDATION ──
        if ($transport->getTransportType() === 'VEHICLE') {
            $pickupLat  = $request->request->get('pickupLat')  !== '' ? (float) $request->request->get('pickupLat')  : null;
            $pickupLon  = $request->request->get('pickupLon')  !== '' ? (float) $request->request->get('pickupLon')  : null;
            $dropoffLat = $request->request->get('dropoffLat') !== '' ? (float) $request->request->get('dropoffLat') : null;
            $dropoffLon = $request->request->get('dropoffLon') !== '' ? (float) $request->request->get('dropoffLon') : null;

            if ($pickupLat === null || $pickupLon === null || $dropoffLat === null || $dropoffLon === null) {
                $this->addFlash('error', 'Pickup and drop-off coordinates are required for vehicle booking.');
                return $this->redirectToRoute('user_transport_book_form', [
                    'transportId' => $transportId,
                    'scheduleId'  => $scheduleId,
                ]);
            }

            if (!$this->isValidCoordinates($pickupLat, $pickupLon)) {
                $this->addFlash('error', 'Pickup coordinates are out of valid range. Latitude: -90 to 90, Longitude: -180 to 180.');
                return $this->redirectToRoute('user_transport_book_form', [
                    'transportId' => $transportId,
                    'scheduleId'  => $scheduleId,
                ]);
            }

            if (!$this->isValidCoordinates($dropoffLat, $dropoffLon)) {
                $this->addFlash('error', 'Drop-off coordinates are out of valid range. Latitude: -90 to 90, Longitude: -180 to 180.');
                return $this->redirectToRoute('user_transport_book_form', [
                    'transportId' => $transportId,
                    'scheduleId'  => $scheduleId,
                ]);
            }

            $pickupAddress  = $request->request->get('pickupAddress', '');
            $dropoffAddress = $request->request->get('dropoffAddress', '');

            if (empty($pickupAddress)) {
                $this->addFlash('error', 'Pickup address is required. Please resolve it using the map.');
                return $this->redirectToRoute('user_transport_book_form', [
                    'transportId' => $transportId,
                    'scheduleId'  => $scheduleId,
                ]);
            }

            if (empty($dropoffAddress)) {
                $this->addFlash('error', 'Drop-off address is required. Please resolve it using the map.');
                return $this->redirectToRoute('user_transport_book_form', [
                    'transportId' => $transportId,
                    'scheduleId'  => $scheduleId,
                ]);
            }

            $booking->setPickupLatitude($pickupLat);
            $booking->setPickupLongitude($pickupLon);
            $booking->setDropoffLatitude($dropoffLat);
            $booking->setDropoffLongitude($dropoffLon);
            $booking->setPickupAddress($pickupAddress);
            $booking->setDropoffAddress($dropoffAddress);
        }

        $this->bookingService->addBookingtrans($booking);

        $this->addFlash('success', sprintf(
            'Booking submitted! Provider: %s | Type: %s | Seats: %d | Total: %.2f EUR | Status: PENDING — awaiting admin confirmation.',
            $transport->getProviderName(),
            $transport->getTransportType(),
            $seats,
            $totalPrice
        ));

        return $this->redirectToRoute('user_transport_mybookings');
    }

    /** Lists Bookingtrans rows for the current user with summary stats. */
    #[Route('/my-bookings', name: 'user_transport_mybookings')]
    public function myBookings(): Response
    {
        $userId       = $this->getCurrentUserId();
        $bookings     = $this->bookingService->getBookingsByUserId($userId);
        $transportMap = $this->buildTransportMap();

        $total = count($bookings);
        $conf  = count(array_filter($bookings, fn($b) => $b->getBookingStatus() === 'CONFIRMED'));
        $pend  = count(array_filter($bookings, fn($b) => $b->getBookingStatus() === 'PENDING'));
        $spent = array_sum(array_map(
            fn($b) => $b->getBookingStatus() !== 'CANCELLED' ? $b->getTotalPrice() : 0,
            $bookings
        ));

        return $this->render('front/TransportUserInterface.html.twig', [
            'tab'          => 'my_bookings',
            'bookings'     => $bookings,
            'transportMap' => $transportMap,
            'stats'        => compact('total', 'conf', 'pend', 'spent'),
            'destMap'      => $this->buildDestinationMap(),
        ]);
    }

    /** User-initiated cancel (PENDING only); CSRF booking_cancel. */
    #[Route('/my-bookings/cancel/{id}', name: 'user_booking_cancel', methods: ['POST'])]
    public function cancelBooking(int $id, Request $request): Response
    {
        // ── CSRF ──
        if (!$this->isCsrfTokenValid('booking_cancel', $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid security token.');
            return $this->redirectToRoute('user_transport_mybookings');
        }

        $booking = null;
        foreach ($this->bookingService->getBookingsByUserId($this->getCurrentUserId()) as $b) {
            if ($b->getBookingId() === $id) { $booking = $b; break; }
        }

        if (!$booking) {
            $this->addFlash('error', 'Booking not found.');
            return $this->redirectToRoute('user_transport_mybookings');
        }

        // ── VALIDATION ──
        if ($booking->getBookingStatus() !== 'PENDING') {
            $this->addFlash('error', 'Only PENDING bookings can be cancelled by the user.');
            return $this->redirectToRoute('user_transport_mybookings');
        }

        $booking->setBookingStatus('CANCELLED');
        $booking->setCancellationReason('Cancelled by user');
        $this->bookingService->updateBookingtrans($booking);
        $this->addFlash('success', 'Booking #' . $id . ' cancelled successfully.');
        return $this->redirectToRoute('user_transport_mybookings');
    }

    /** Attach a schedule to a booking that was created without one (e.g. open-dated). */
    #[Route('/my-bookings/add-schedule/{bookingId}', name: 'user_booking_add_schedule', methods: ['GET', 'POST'])]
    public function addScheduleToBooking(int $bookingId, Request $request): Response
    {
        $booking      = null;
        $transportMap = $this->buildTransportMap();

        foreach ($this->bookingService->getBookingsByUserId($this->getCurrentUserId()) as $b) {
            if ($b->getBookingId() === $bookingId) { $booking = $b; break; }
        }

        if (!$booking) {
            $this->addFlash('error', 'Booking not found.');
            return $this->redirectToRoute('user_transport_mybookings');
        }

        // ── VALIDATION ──
        if ($booking->getBookingStatus() === 'CANCELLED') {
            $this->addFlash('error', 'Cannot add a schedule to a cancelled booking.');
            return $this->redirectToRoute('user_transport_mybookings');
        }

        if ($booking->getScheduleId() > 0) {
            $this->addFlash('error', 'This booking already has a schedule assigned.');
            return $this->redirectToRoute('user_transport_mybookings');
        }

        $transport = $transportMap[$booking->getTransportId()] ?? null;
        $isFlight  = $transport && $transport->getTransportType() === 'FLIGHT';

        if ($request->isMethod('POST')) {

            // ── CSRF ──
            if (!$this->isCsrfTokenValid('add_schedule', $request->request->get('_token'))) {
                $this->addFlash('error', 'Invalid security token.');
                return $this->redirectToRoute('user_transport_mybookings');
            }

            $scheduleId = (int) $request->request->get('scheduleId');
            if ($scheduleId <= 0) {
                $this->addFlash('error', 'Please select a valid schedule.');
                return $this->redirectToRoute('user_booking_add_schedule', ['bookingId' => $bookingId]);
            }

            $schedule = $this->scheduleService->findById($scheduleId);
            if (!$schedule || $schedule->getStatus() === 'CANCELLED') {
                $this->addFlash('error', 'Selected schedule is not available.');
                return $this->redirectToRoute('user_booking_add_schedule', ['bookingId' => $bookingId]);
            }

            // Re-check availability
            if ($isFlight) {
                $rem = $transport->getCapacity() - $this->getBookedSeatsForSchedule($scheduleId);
                if ($rem < $booking->getTotalSeats()) {
                    $this->addFlash('error', 'Not enough seats on this schedule.');
                    return $this->redirectToRoute('user_booking_add_schedule', ['bookingId' => $bookingId]);
                }
            } else {
                if ($this->isVehicleScheduleUnavailable($scheduleId)) {
                    $this->addFlash('error', 'This vehicle schedule is already booked.');
                    return $this->redirectToRoute('user_booking_add_schedule', ['bookingId' => $bookingId]);
                }
            }

            $booking->setScheduleId($scheduleId);
            $this->bookingService->updateBookingtrans($booking);
            $this->addFlash('success', 'Schedule #' . $scheduleId . ' linked to Booking #' . $bookingId . '!');
            return $this->redirectToRoute('user_transport_mybookings');
        }

        $schedules = array_filter(
            $this->scheduleService->getAllSchedules(),
            function($s) use ($booking, $isFlight, $transportMap) {
                if ($s->getTransportId() !== $booking->getTransportId()) return false;
                if ($s->getStatus() === 'CANCELLED') return false;
                if ($isFlight) {
                    $t   = $transportMap[$s->getTransportId()] ?? null;
                    $rem = $t ? ($t->getCapacity() - $this->getBookedSeatsForSchedule($s->getScheduleId())) : 0;
                    return $rem >= $booking->getTotalSeats();
                } else {
                    return !$this->isVehicleScheduleUnavailable($s->getScheduleId());
                }
            }
        );

        return $this->render('front/TransportUserInterface.html.twig', [
            'tab'          => 'my_bookings',
            'view'         => 'add_schedule',
            'booking'      => $booking,
            'transport'    => $transport,
            'schedules'    => array_values($schedules),
            'transportMap' => $transportMap,
            'bookings'     => $this->bookingService->getBookingsByUserId($this->getCurrentUserId()),
            'stats'        => ['total' => 0, 'conf' => 0, 'pend' => 0, 'spent' => 0],
            'destMap'      => $this->buildDestinationMap(),
        ]);
    }

    /** Vehicle booking helper: optimal route text from TransportOptimalRouteService (AJAX). */
    #[Route('/route-ai', name: 'user_transport_route_ai', methods: ['POST'])]
    public function routeAi(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $pickupLat   = (float) ($data['pickupLat']   ?? 0);
        $pickupLon   = (float) ($data['pickupLon']   ?? 0);
        $dropoffLat  = (float) ($data['dropoffLat']  ?? 0);
        $dropoffLon  = (float) ($data['dropoffLon']  ?? 0);
        $pickupAddr  = $data['pickupAddress']  ?? '';
        $dropoffAddr = $data['dropoffAddress'] ?? '';

        // ── VALIDATION ──
        if (!$this->isValidCoordinates($pickupLat, $pickupLon)) {
            return new JsonResponse(['success' => false, 'result' => 'Invalid pickup coordinates.']);
        }
        if (!$this->isValidCoordinates($dropoffLat, $dropoffLon)) {
            return new JsonResponse(['success' => false, 'result' => 'Invalid drop-off coordinates.']);
        }
        if ($pickupLat === $dropoffLat && $pickupLon === $dropoffLon) {
            return new JsonResponse(['success' => false, 'result' => 'Pickup and drop-off cannot be the same location.']);
        }

        try {
            $result = $this->routeService->generateTransportOptimalRouteReport(
                $pickupLat, $pickupLon, $dropoffLat, $dropoffLon, $pickupAddr, $dropoffAddr
            );
            return new JsonResponse(['success' => true, 'result' => $result]);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => false, 'result' => 'Error: ' . $e->getMessage()]);
        }
    }

    /** Dompdf receipt download; restricted to booking owner. */
    #[Route('/my-bookings/receipt/{id}', name: 'user_booking_receipt_pdf')]
    public function exportReceiptPdf(int $id): Response
    {
        $booking = $this->bookingService->findById($id);
        if (!$booking) throw $this->createNotFoundException('Booking not found.');
        
        // Security: ensure user only downloads their own receipt
        if ($booking->getUserId() !== $this->getCurrentUserId()) {
            throw $this->createAccessDeniedException('You do not have access to this receipt.');
        }

        $transport = $this->transportService->findById($booking->getTransportId());
        $schedule = $booking->getScheduleId() > 0 ? $this->scheduleService->findById($booking->getScheduleId()) : null;

        $qrCodeBase64 = null;
        if ($booking->getQrCode()) {
            $path = $this->getParameter('kernel.project_dir') . '/public/' . $booking->getQrCode();
            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $qrCodeBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        }

        $html = $this->renderView('admin/booking_receipt_pdf.html.twig', [
            'booking' => $booking,
            'transport' => $transport,
            'schedule' => $schedule,
            'qrCodeBase64' => $qrCodeBase64,
            'destMap' => $this->buildDestinationMap(),
        ]);

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="TripX_Receipt_#'. $id .'.pdf"',
        ]);
    }
    
}