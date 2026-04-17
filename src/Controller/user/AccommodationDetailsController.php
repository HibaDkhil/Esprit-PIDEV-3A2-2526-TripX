<?php

/**
 * =============================================================================
 * ACCOMMODATION DETAIL + BOOKING FLOWS (single property)
 * =============================================================================
 * GET /accommodations/{id} — gallery, rooms, reviews, weather-side data, booking UI.
 * JSON endpoints for itinerary, reviews, etc. live in this controller.
 * Listing/search: FrontAccommodationController
 * =============================================================================
 */
namespace App\Controller\user;

use App\Entity\Accommodation;
use App\Entity\BookingAcc;
use App\Entity\Room;
use App\Repository\AccommodationRepository;
use App\Repository\RoomImagesRepository;
use App\service\Accommodation\WeatherService;
use App\service\Accommodation\FlightService;
use App\service\Accommodation\LocalService;
use App\service\Accommodation\ImageService;
use App\service\Accommodation\ReviewService;
use App\service\Accommodation\ItineraryService;
use App\service\NotificationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AccommodationDetailsController extends AbstractController
{
    private AccommodationRepository $accommodationRepo;
    private EntityManagerInterface $em;
    private WeatherService $weatherService;
    private FlightService $flightService;
    private LocalService $localService;
    private ImageService $imageService;
    private ReviewService $reviewService;
    private ItineraryService $itineraryService;
    private RoomImagesRepository $roomImagesRepo;
    private NotificationService $notificationService;

    /**
     * Maps city names to their primary IATA airport codes.
     */
    private array $airportCodes = [
        'Paris'      => 'CDG',
        'London'     => 'LHR',
        'New York'   => 'JFK',
        'Rome'       => 'FCO',
        'Barcelona'  => 'BCN',
        'Amsterdam'  => 'AMS',
        'Berlin'     => 'BER',
        'Madrid'     => 'MAD',
        'Lisbon'     => 'LIS',
        'Dublin'     => 'DUB',
        'Vienna'     => 'VIE',
        'Prague'     => 'PRG',
        'Budapest'   => 'BUD',
        'Athens'     => 'ATH',
        'Istanbul'   => 'IST',
        'Dubai'      => 'DXB',
        'Singapore'  => 'SIN',
        'Bangkok'    => 'BKK',
        'Sydney'     => 'SYD',
        'Milan'      => 'MXP',
        'Munich'     => 'MUC',
        'Zurich'     => 'ZRH',
        'Brussels'   => 'BRU',
        'Copenhagen' => 'CPH',
        'Stockholm'  => 'ARN',
        'Oslo'       => 'OSL',
        'Helsinki'   => 'HEL',
        'Warsaw'     => 'WAW',
        'Venice'     => 'VCE',
        'Florence'   => 'FLR',
        'Naples'     => 'NAP',
        'Porto'      => 'OPO',
        'Edinburgh'  => 'EDI',
        'Glasgow'    => 'GLA',
        'Manchester' => 'MAN',
        'Liverpool'  => 'LPL',
        'Birmingham' => 'BHX',
        'Tunis'      => 'TUN',
        'Sfax'       => 'SFA',
        'Casablanca' => 'CMN',
        'Cairo'      => 'CAI',
        'Algiers'    => 'ALG',
    ];

    public function __construct(
        AccommodationRepository $accommodationRepo,
        EntityManagerInterface $em,
        WeatherService $weatherService,
        FlightService $flightService,
        LocalService $localService,
        ImageService $imageService,
        ReviewService $reviewService,
        ItineraryService $itineraryService,
        RoomImagesRepository $roomImagesRepo,
        NotificationService $notificationService
    ) {
        $this->accommodationRepo = $accommodationRepo;
        $this->em                = $em;
        $this->weatherService    = $weatherService;
        $this->flightService     = $flightService;
        $this->localService      = $localService;
        $this->imageService      = $imageService;
        $this->reviewService     = $reviewService;
        $this->itineraryService  = $itineraryService;
        $this->roomImagesRepo    = $roomImagesRepo;
        $this->notificationService = $notificationService;
    }

    /**
     * DEBUG ENDPOINT - Test all APIs at once
     */
    #[Route('/debug/all-apis', name: 'debug_all_apis', methods: ['GET'])]
    public function debugAllApis(): JsonResponse
    {
        $results = [];

        // 1. Test Gemini/Itinerary API
        $results['gemini'] = $this->debugGeminiApi();
        
        // 2. Test SerpApi (Images)
        $results['serpapi_images'] = $this->debugSerpApiImages();
        
        // 3. Test SerpApi (Local)
        $results['serpapi_local'] = $this->debugSerpApiLocal();
        
        // 4. Test Weather API
        $results['weather'] = $this->debugWeatherApi();
        
        // 5. Check if services are properly injected
        $results['service_status'] = [
            'weatherService' => $this->weatherService ? 'OK' : 'NULL',
            'imageService' => $this->imageService ? 'OK' : 'NULL',
            'localService' => $this->localService ? 'OK' : 'NULL',
            'reviewService' => $this->reviewService ? 'OK' : 'NULL',
            'itineraryService' => $this->itineraryService ? 'OK' : 'NULL',
            'flightService' => $this->flightService ? 'OK' : 'NULL',
        ];
        
        // 6. Environment variables status
        $results['env_status'] = [
            'SERPAPI_API_KEY' => $this->getEnvStatus('SERPAPI_API_KEY'),
            'OPENWEATHER_API_KEY' => $this->getEnvStatus('OPENWEATHER_API_KEY'),
            'RAGHED_GEMINI' => $this->getEnvStatus('RAGHED_GEMINI'),
        ];
        
        return $this->json($results);
    }

    private function debugGeminiApi(): array
    {
        $apiKey = $_ENV['RAGHED_GEMINI'] ?? getenv('RAGHED_GEMINI');
        
        if (empty($apiKey)) {
            return ['error' => 'GEMINI API key is missing from .env', 'key_found' => false];
        }
        
        $result = [
            'key_found' => true,
            'key_length' => strlen($apiKey),
            'key_prefix' => substr($apiKey, 0, 10) . '...',
        ];
        
        // Test with a simple prompt
        $prompt = "Say 'API works' in one word.";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $apiKey
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 100,
            ],
        ]));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        
        $result['http_code'] = $httpCode;
        
        if ($curlError) {
            $result['curl_error'] = $curlError;
            return $result;
        }
        
        if ($httpCode === 200) {
            $data = json_decode($response, true);
            $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
            $result['success'] = true;
            $result['response'] = $text;
        } else {
            $result['success'] = false;
            $result['response_preview'] = substr($response, 0, 500);
        }
        
        return $result;
    }

    private function debugSerpApiImages(): array
    {
        try {
            $images = $this->imageService->getDestinationImages('Paris', 'France');
            
            if ($images && isset($images['images']) && count($images['images']) > 0) {
                return [
                    'success' => true,
                    'image_count' => $images['total'] ?? count($images['images']),
                    'first_image' => $images['images'][0]['url'] ?? null,
                ];
            } else {
                return [
                    'success' => false,
                    'error' => 'No images returned',
                    'raw_response' => $images,
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ];
        }
    }

    private function debugSerpApiLocal(): array
    {
        try {
            $places = $this->localService->getNearbyPlaces('restaurant', 'Paris');
            
            if ($places && isset($places['places']) && count($places['places']) > 0) {
                return [
                    'success' => true,
                    'place_count' => $places['total'] ?? count($places['places']),
                    'first_place' => $places['places'][0]['name'] ?? null,
                ];
            } else {
                return [
                    'success' => false,
                    'error' => 'No places returned',
                    'raw_response' => $places,
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ];
        }
    }

    private function debugWeatherApi(): array
    {
        try {
            $weather = $this->weatherService->getCurrentWeather('Paris', 'France');
            
            if ($weather && isset($weather['temp'])) {
                return [
                    'success' => true,
                    'temperature' => $weather['temp'],
                    'condition' => $weather['condition'] ?? null,
                    'city' => $weather['city'] ?? null,
                ];
            } else {
                return [
                    'success' => false,
                    'error' => 'No weather data returned',
                    'raw_response' => $weather,
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ];
        }
    }

    private function getEnvStatus(string $key): array
    {
        $value = $_ENV[$key] ?? getenv($key);
        
        return [
            'exists' => !empty($value),
            'length' => $value ? strlen($value) : 0,
            'prefix' => $value ? substr($value, 0, 10) . '...' : null,
        ];
    }

    /**
     * DEBUG: Test itinerary generation specifically
     */
    #[Route('/debug/itinerary/{id}', name: 'debug_itinerary', methods: ['GET'])]
    public function debugItinerary(int $id): JsonResponse
    {
        $accommodation = $this->accommodationRepo->find($id);
        
        if (!$accommodation) {
            return $this->json(['error' => 'Accommodation not found'], 404);
        }
        
        $results = [];
        
        // Check if service exists
        $results['service_exists'] = $this->itineraryService ? true : false;
        
        if (!$this->itineraryService) {
            $results['error'] = 'ItineraryService is null - check services.yaml configuration';
            return $this->json($results);
        }
        
        // Test with mock data first
        $results['test_city'] = $accommodation->getCity();
        
        // Try to generate a simple 1-day itinerary
        try {
            $itinerary = $this->itineraryService->generateItinerary(
                $accommodation->getCity(),
                ['Eiffel Tower', 'Louvre Museum'],
                1
            );
            
            $results['generated'] = true;
            $results['itinerary_length'] = strlen($itinerary ?? '');
            $results['itinerary_preview'] = $itinerary ? substr($itinerary, 0, 500) : null;
            $results['is_mock'] = strpos($itinerary ?? '', 'Cultural Immersion') !== false;
        } catch (\Exception $e) {
            $results['error'] = $e->getMessage();
            $results['trace'] = $e->getTraceAsString();
        }
        
        return $this->json($results);
    }

    #[Route('/accommodations/{id}', name: 'accommodation_details', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        $accommodation = $this->accommodationRepo->find($id);

        if (!$accommodation || $accommodation->getStatus() !== 'Active') {
            throw $this->createNotFoundException('Accommodation not found');
        }

        // ── Resolve logged-in user's display name for the payment wallet ──────────
        $user         = $this->getUser();
        $userName     = 'GUEST USER';
        $userFullName = 'Guest User';

        if ($user && method_exists($user, 'getFirstName') && method_exists($user, 'getLastName')) {
            $first        = trim($user->getFirstName() ?? '');
            $last         = trim($user->getLastName()  ?? '');
            $userFullName = trim($first . ' ' . $last) ?: 'Guest User';
            $userName     = strtoupper($userFullName);
        } elseif ($user && method_exists($user, 'getUserIdentifier')) {
            // Fallback: use email prefix when name methods are unavailable
            $email        = $user->getUserIdentifier();
            $userFullName = ucfirst(explode('@', $email)[0]);
            $userName     = strtoupper($userFullName);
        }

        return $this->render('front/accommodation_details.html.twig', [
            'accommodation' => $accommodation,
            'userName'      => $userName,       // e.g. "BRUCE WAYNE"   — for card display
            'userFullName'  => $userFullName,   // e.g. "Bruce Wayne"   — for JS use
        ]);
    }

    #[Route('/api/weather/{id}', name: 'api_weather', methods: ['GET'])]
    public function getWeather(int $id): JsonResponse
    {
        $accommodation = $this->accommodationRepo->find($id);

        if (!$accommodation) {
            return $this->json(['error' => 'Not found'], 404);
        }

        $current  = $this->weatherService->getCurrentWeather($accommodation->getCity(), $accommodation->getCountry());
        $forecast = $this->weatherService->getForecast($accommodation->getCity(), $accommodation->getCountry());

        return $this->json([
            'current'  => $current,
            'forecast' => $forecast
        ]);
    }

    #[Route('/api/flights/{id}', name: 'api_flights', methods: ['GET'])]
    public function getFlights(int $id, Request $request): JsonResponse
    {
        $accommodation = $this->accommodationRepo->find($id);

        if (!$accommodation) {
            return $this->json(['error' => 'Not found'], 404);
        }

        $departure   = $request->query->get('departure', 'CDG');
        $date        = $request->query->get('date');
        $arrivalCode = $this->getAirportCode($accommodation->getCity());

        if (!$arrivalCode) {
            error_log('AccommodationDetailsController: No airport code for city: ' . $accommodation->getCity());
            $arrivalCode = $accommodation->getCity();
        }

        $flights  = $this->flightService->getFlights($departure, $arrivalCode, $date);
        $insights = $this->flightService->getPriceInsights($departure, $arrivalCode);

        return $this->json([
            'flights'      => $flights,
            'insights'     => $insights,
            'destination'  => $accommodation->getCity(),
            'arrival_code' => $arrivalCode
        ]);
    }

    #[Route('/api/nearby/{id}', name: 'api_nearby', methods: ['GET'])]
    public function getNearby(int $id): JsonResponse
    {
        $accommodation = $this->accommodationRepo->find($id);

        if (!$accommodation) {
            return $this->json(['error' => 'Not found'], 404);
        }

        $categories = [
            'restaurants' => $this->localService->getAttractionsByCategory('restaurants', $accommodation->getCity()),
            'attractions' => $this->localService->getAttractionsByCategory('attractions', $accommodation->getCity()),
            'shopping'    => $this->localService->getAttractionsByCategory('shopping', $accommodation->getCity()),
            'transport'   => $this->localService->getAttractionsByCategory('transport', $accommodation->getCity())
        ];

        return $this->json($categories);
    }

    #[Route('/api/images/{id}', name: 'api_images', methods: ['GET'])]
    public function getImages(int $id): JsonResponse
    {
        $accommodation = $this->accommodationRepo->find($id);

        if (!$accommodation) {
            return $this->json(['error' => 'Not found'], 404);
        }

        $images = $this->imageService->getDestinationImages($accommodation->getCity(), $accommodation->getCountry());

        return $this->json($images);
    }

    #[Route('/api/reviews/{id}', name: 'api_reviews', methods: ['GET'])]
    public function getReviews(int $id): JsonResponse
    {
        $accommodation = $this->accommodationRepo->find($id);

        if (!$accommodation) {
            return $this->json(['error' => 'Not found'], 404);
        }

        $dataId = method_exists($accommodation, 'getSerpApiDataId')
            ? $accommodation->getSerpApiDataId()
            : null;

        $reviews = $this->reviewService->getReviews(
            $accommodation->getName(),
            $accommodation->getCity(),
            $dataId
        );

        return $this->json($reviews);
    }

    #[Route('/api/itinerary/{id}', name: 'api_itinerary', methods: ['POST'])]
    public function generateItinerary(int $id, Request $request): JsonResponse
    {
        $accommodation = $this->accommodationRepo->find($id);

        if (!$accommodation) {
            return $this->json(['error' => 'Accommodation not found'], 404);
        }

        $data = json_decode($request->getContent(), true);
        $days = (int) ($data['days'] ?? 3);

        // Check if itinerary service is available
        if (!$this->itineraryService) {
            error_log('ItineraryService is null in AccommodationDetailsController');
            return $this->json([
                'error' => 'Itinerary service is not available',
                'itinerary' => $this->getFallbackItinerary($accommodation->getCity(), $days)
            ]);
        }

        $attractions = [];
        
        try {
            $nearby = $this->localService->getAttractionsByCategory('attractions', $accommodation->getCity());
            if ($nearby && isset($nearby['places'])) {
                foreach ($nearby['places'] as $place) {
                    $attractions[] = $place['name'];
                }
            }
        } catch (\Exception $e) {
            error_log('Error fetching attractions for itinerary: ' . $e->getMessage());
            // Use default attractions if local service fails
            $attractions = ['local attractions', 'cultural sites', 'restaurants', 'shopping areas'];
        }

        try {
            $itinerary = $this->itineraryService->generateItinerary(
                $accommodation->getCity(),
                $attractions,
                $days
            );
            
            // Check if we got mock data (indicates API failure)
            $isMock = $itinerary && strpos($itinerary, 'Cultural Immersion') !== false;
            
            return $this->json([
                'itinerary' => $itinerary,
                'city' => $accommodation->getCity(),
                'days' => $days,
                'is_mock' => $isMock,
                'api_working' => !$isMock
            ]);
        } catch (\Exception $e) {
            error_log('Itinerary generation exception: ' . $e->getMessage());
            return $this->json([
                'error' => 'Failed to generate itinerary: ' . $e->getMessage(),
                'itinerary' => $this->getFallbackItinerary($accommodation->getCity(), $days)
            ]);
        }
    }

    private function getFallbackItinerary(string $city, int $days): string
    {
        $lines = [];
        for ($i = 1; $i <= $days; $i++) {
            $lines[] = "🌟 DAY {$i}: Explore {$city}";
            $lines[] = "• Morning: Start your day with breakfast at a local café";
            $lines[] = "• Afternoon: Visit the main attractions and landmarks";
            $lines[] = "• Evening: Enjoy dinner at a traditional restaurant";
            $lines[] = "• Dinner recommendation: Ask locals for their favorite spot";
            $lines[] = "";
        }
        $lines[] = "💡 Travel Tips:";
        $lines[] = "• Book popular attractions in advance";
        $lines[] = "• Learn basic local phrases";
        $lines[] = "• Use public transportation";
        $lines[] = "• Check weather forecast before heading out";
        
        return implode("\n", $lines);
    }

    #[Route('/api/accommodation/rooms/{id}', name: 'api_accommodation_rooms', methods: ['GET'])]
    public function getRooms(int $id): JsonResponse
    {
        $accommodation = $this->accommodationRepo->find($id);

        if (!$accommodation) {
            return $this->json(['error' => 'Not found'], 404);
        }

        $conn  = $this->em->getConnection();
        $rooms = $conn->fetchAllAssociative(
            'SELECT * FROM room WHERE accommodation_id = :id AND is_available = 1 ORDER BY price_per_night ASC',
            ['id' => $id]
        );

        return $this->json(['rooms' => $rooms]);
    }

    #[Route('/api/room/images/{id}', name: 'api_room_images', methods: ['GET'])]
    public function getRoomImages(int $id): JsonResponse
    {
        $room = $this->em->getRepository(Room::class)->find($id);

        if (!$room) {
            return $this->json(['error' => 'Room not found'], 404);
        }

        $images = $this->roomImagesRepo->findBy(
            ['room' => $room],
            ['displayOrder' => 'ASC']
        );

        return $this->json([
            'images' => array_map(fn($img) => [
                'id'        => $img->getId(),
                'filePath'  => $img->getFilePath(),
                'isPrimary' => $img->isPrimary(),
            ], $images)
        ]);
    }

    /**
     * POST /api/book
     *
     * Creates a new BookingAcc record from the booking drawer.
     * Uses Symfony Validator for comprehensive validation.
     *
     * Expected JSON body:
     * {
     *   "room_id":           int,
     *   "check_in":          "YYYY-MM-DD",
     *   "check_out":         "YYYY-MM-DD",
     *   "guests":            int,
     *   "phone":             string,
     *   "special_requests":  string (optional),
     *   "estimated_arrival": string (optional, e.g. "14:00")
     * }
     */
    #[Route('/api/book', name: 'api_book', methods: ['POST'])]
    public function createBooking(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // ── Validate required fields presence ──────────────────────────────────────
        if (empty($data['room_id'])) {
            return $this->json(['error' => 'Missing room_id', 'field' => 'room_id'], 400);
        }
        if (empty($data['check_in'])) {
            return $this->json(['error' => 'Missing check-in date', 'field' => 'check_in'], 400);
        }
        if (empty($data['check_out'])) {
            return $this->json(['error' => 'Missing check-out date', 'field' => 'check_out'], 400);
        }
        if (empty($data['phone'])) {
            return $this->json(['error' => 'Phone number is required', 'field' => 'phone'], 400);
        }

        // ── Find the room ─────────────────────────────────────────────────
        $room = $this->em->getRepository(Room::class)->find((int) $data['room_id']);

        if (!$room) {
            return $this->json(['error' => 'Room not found', 'field' => 'room_id'], 404);
        }

        if (!$room->isAvailable()) {
            return $this->json(['error' => 'Room is no longer available', 'field' => 'room_id'], 409);
        }

        // ── Parse and validate dates ───────────────────────────────────────────────────
        try {
            $checkIn  = new \DateTime($data['check_in']);
            $checkOut = new \DateTime($data['check_out']);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Invalid date format. Use YYYY-MM-DD', 'field' => 'date_format'], 400);
        }

        $today = new \DateTime('today');
        if ($checkIn < $today) {
            return $this->json(['error' => 'Check-in date cannot be in the past', 'field' => 'check_in'], 400);
        }

        $nights = (int) $checkIn->diff($checkOut)->days;

        if ($nights <= 0) {
            return $this->json(['error' => 'Check-out must be after check-in', 'field' => 'dates'], 400);
        }

        if ($nights > 90) {
            return $this->json(['error' => 'Maximum stay is 90 nights', 'field' => 'nights'], 400);
        }

        // ── Validate guest count against room capacity ────────────────────────────────
        $guests       = (int) ($data['guests'] ?? 1);
        $roomCapacity = $room->getCapacity() ?? 4;

        if ($guests < 1) {
            return $this->json(['error' => 'Number of guests must be at least 1', 'field' => 'guests'], 400);
        }

        if ($guests > $roomCapacity) {
            return $this->json(['error' => 'Maximum capacity for this room is ' . $roomCapacity . ' guests', 'field' => 'guests'], 400);
        }

        // ── Validate arrival time format (if provided) ────────────────────────────────
        $estimatedArrival = $data['estimated_arrival'] ?? null;
        if ($estimatedArrival && !preg_match('/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/', $estimatedArrival)) {
            return $this->json(['error' => 'Estimated arrival time must be in HH:MM format (e.g., 14:00)', 'field' => 'estimated_arrival'], 400);
        }

        // ── Validate phone number format ──────────────────────────────────────────────
        $phone      = $data['phone'];
        $cleanPhone = preg_replace('/[\s\-\(\)\+]/', '', $phone);
        if (!preg_match('/^[0-9]{8,15}$/', $cleanPhone)) {
            return $this->json(['error' => 'Phone number must contain 8-15 digits', 'field' => 'phone'], 400);
        }

        // ── Check for conflicting bookings ────────────────────────────────────────────
        $conn      = $this->em->getConnection();
        $conflicts = $conn->fetchOne(
            'SELECT COUNT(*) FROM bookingacc
             WHERE room_id = :roomId
               AND status NOT IN (\'CANCELLED\', \'REJECTED\')
               AND check_in  < :checkOut
               AND check_out > :checkIn',
            [
                'roomId'   => $room->getId(),
                'checkIn'  => $checkIn->format('Y-m-d'),
                'checkOut' => $checkOut->format('Y-m-d'),
            ]
        );

        if ($conflicts > 0) {
            return $this->json(['error' => 'Room is not available for the selected dates', 'field' => 'dates'], 409);
        }

        // ── Calculate pricing ─────────────────────────────────────────────────────────
        $pricePerNight = (float) $room->getPricePerNight();
        $subtotal      = $pricePerNight * $nights;
        $tax           = round($subtotal * 0.10, 2);
        $totalPrice    = round($subtotal + $tax, 2);

        // ── Determine user ID ─────────────────────────────────────────────────────────
        $user   = $this->getUser();
        $userId = $user ? $user->getId() : 1;

        // ── Create and validate the booking entity ─────────────────────────────────────
        $booking = new BookingAcc();
        $booking->setUserId($userId);
        $booking->setRoom($room);
        $booking->setCheckIn($checkIn);
        $booking->setCheckOut($checkOut);
        $booking->setTotalPrice((string) $totalPrice);
        $booking->setNumberOfGuests($guests);
        $booking->setPhoneNumber($phone);
        $booking->setSpecialRequests($data['special_requests'] ?? null);
        $booking->setEstimatedArrivalTime($estimatedArrival);
        $booking->setStatus('PENDING');
        $booking->setCreatedAt(new \DateTime());
        $booking->setCalendarSyncStatus('NOT_SYNCED');

        // ── Symfony Validator validation ──────────────────────────────────────────────
        $errors = $validator->validate($booking);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $field                  = $error->getPropertyPath();
                $errorMessages[$field]  = $error->getMessage();
            }

            return $this->json([
                'success' => false,
                'errors'  => $errorMessages,
                'message' => 'Validation failed'
            ], Response::HTTP_BAD_REQUEST);
        }

        // ── Persist the booking ───────────────────────────────────────────────────────
        $this->em->persist($booking);
        $this->em->flush();

        // ── CREATE NOTIFICATION FOR ADMIN ──────────────────────────────────────────────
        // Get user name for notification
        $userName = 'Guest';
        if ($user) {
            if (method_exists($user, 'getFirstName') && method_exists($user, 'getLastName')) {
                $userName = trim($user->getFirstName() . ' ' . $user->getLastName());
                if (empty($userName)) {
                    $userName = $user->getUserIdentifier();
                }
            } else {
                $userName = $user->getUserIdentifier();
            }
        }
        
        // Get accommodation name
        $accommodation = $room->getAccommodation();
        $accommodationName = $accommodation ? $accommodation->getName() : 'Accommodation';
        
        // Create the notification
        $this->notificationService->createNewBookingNotification(
            $booking->getId(),
            $userName,
            $accommodationName,
            $accommodation ? $accommodation->getId() : null
        );
        
        // Log that notification was created
        error_log('[Booking] New booking #' . $booking->getId() . ' created by ' . $userName . ' at ' . $accommodationName . ' - Admin notified');

        // ── Generate a human-readable reference ───────────────────────────────────────
        $reference = sprintf(
            'TRX-%s-%s',
            date('Y'),
            strtoupper(substr(md5($booking->getId() . $checkIn->format('Ymd')), 0, 8))
        );

        return $this->json([
            'success'    => true,
            'booking_id' => $booking->getId(),
            'reference'  => $reference,
            'nights'     => $nights,
            'subtotal'   => $subtotal,
            'tax'        => $tax,
            'total'      => $totalPrice,
            'status'     => 'PENDING',
        ], 201);
    }

    /**
     * Resolves a city name to its primary IATA airport code.
     */
    private function getAirportCode(string $city): ?string
    {
        return $this->airportCodes[$city] ?? null;
    }
}