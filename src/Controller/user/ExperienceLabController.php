<?php

namespace App\Controller\user;

use App\Repository\DestinationRepository;
use App\Repository\AccommodationRepository;
use App\Repository\ActivityRepository;
use App\Repository\TransportRepository;
use App\Repository\OfferRepository;
use App\Repository\PackRepository;
use App\service\AriaExperienceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/experience-lab', name: 'experience_lab_')]
class ExperienceLabController extends AbstractController
{
    public function __construct(
        private readonly DestinationRepository $destinationRepository,
        private readonly AccommodationRepository $accommodationRepository,
        private readonly ActivityRepository $activityRepository,
        private readonly TransportRepository $transportRepository,
        private readonly OfferRepository $offerRepository,
        private readonly PackRepository $packRepository,
        private readonly \App\Repository\UserTripPlanRepository $planRepository,
        private readonly \Doctrine\ORM\EntityManagerInterface $entityManager,
        private readonly AriaExperienceService $ariaService,
    ) {
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('front/experience_lab_index.html.twig');
    }

    #[Route('/live-results', name: 'live_results', methods: ['POST'])]
    public function liveResults(Request $request): JsonResponse
    {
        $answers = $request->toArray();

        $destinations = $this->destinationRepository->findAll();
        $accommodations = $this->accommodationRepository->findAll();
        $activities = $this->activityRepository->findAll();

        $scoredDestinations = $this->scoreDestinations($destinations, $answers);
        $scoredAccommodations = $this->scoreAccommodations($accommodations, $answers);
        $scoredActivities = $this->scoreActivities($activities, $answers);
        $matchedOffers = $this->matchOffersAndPacks($answers);
        $ariaComment = $this->ariaService->getLiveComment($answers);
        $destinationAdvice = $this->ariaService->getDestinationAdvice($answers, $scoredDestinations);

        return new JsonResponse([
            'destinations' => array_slice($scoredDestinations, 0, 6),
            'accommodations' => array_slice($scoredAccommodations, 0, 6),
            'activities' => array_slice($scoredActivities, 0, 9),
            'offers' => $matchedOffers,
            'ariaComment' => $ariaComment,
            'destinationAdvice' => $destinationAdvice,
        ]);
    }

    #[Route('/generate-plan', name: 'generate_plan', methods: ['POST'])]
    public function generatePlan(Request $request, SessionInterface $session): JsonResponse
    {
        $payload = $request->toArray();
        $answers = $payload['answers'] ?? $payload;
        $cart = $payload['cart'] ?? [];

        // If cart is empty, we might be doing a general generation
        $destinations = !empty($cart['destinations']) ? $cart['destinations'] : [];
        $accommodations = !empty($cart['accommodations']) ? $cart['accommodations'] : [];
        $activities = !empty($cart['activities']) ? $cart['activities'] : [];
        $offers = !empty($cart['offers']) ? $cart['offers'] : [];

        $budgetStats = $this->calculateCartBudget($answers, $destinations, $accommodations, $activities, $offers);
        $totalBudget = $budgetStats['total'];
        
        // If no destination selected but we are in "general" mode, pick top scored
        if (empty($destinations)) {
            $allDests = $this->destinationRepository->findAll();
            $scoredDests = $this->scoreDestinations($allDests, $answers);
            $destinations = [($scoredDests[0] ?? null)];
        }

        $topDestination = $destinations[0];
        $savings = 0;
        if (!empty($offers)) {
            $discount = (float) ($offers[0]['discount'] ?? 0);
            $savings = $budgetStats['savings'];
        }

        $ariaFinalPitch = $this->ariaService->getFinalPitch($topDestination, $totalBudget, $savings, $offers[0] ?? null);

        $plan = [
            'destination' => $topDestination,
            'accommodations' => $accommodations,
            'activities' => $activities,
            'offer' => $offers[0] ?? null,
            'estimatedBudget' => $totalBudget,
            'budgetStats' => $budgetStats,
            'savings' => $savings,
            'ariaFinalPitch' => $ariaFinalPitch,
        ];

        return new JsonResponse($plan);
    }

    #[Route('/simulate', name: 'simulate', methods: ['POST'])]
    public function simulate(Request $request): JsonResponse
    {
        $plan = $request->toArray();
        $narrative = $this->ariaService->getDeepDiveSimulation($plan);
        return new JsonResponse(['narrative' => $narrative]);
    }

    #[Route('/save-plan', name: 'save_plan', methods: ['POST'])]
    public function savePlan(Request $request): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['error' => 'User not logged in'], 403);
        }

        $data = $request->toArray();
        $plan = new \App\Entity\UserTripPlan();
        $plan->setUserId($user->getId());
        $plan->setTitle($data['title'] ?? 'My Trip to ' . ($data['destination']['name'] ?? 'Unknown'));
        $plan->setPlanData($data);

        $this->entityManager->persist($plan);
        $this->entityManager->flush();

        return new JsonResponse(['status' => 'saved', 'id' => $plan->getId()]);
    }

    #[Route('/my-plans', name: 'my_plans', methods: ['GET'])]
    public function getSavedPlans(): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) return new JsonResponse([]);

        $plans = $this->planRepository->findBy(['userId' => $user->getId()], ['createdAt' => 'DESC']);
        $result = [];
        foreach ($plans as $p) {
            $result[] = [
                'id' => $p->getId(),
                'title' => $p->getTitle(),
                'date' => $p->getCreatedAt()->format('Y-m-d H:i'),
                'data' => $p->getPlanData(),
            ];
        }
        return new JsonResponse($result);
    }

    #[Route('/delete-plan/{id}', name: 'delete_plan', methods: ['DELETE'])]
    public function deletePlan(int $id): JsonResponse
    {
        $user = $this->getUser();
        $plan = $this->planRepository->find($id);

        if ($plan && $plan->getUserId() === $user?->getId()) {
            $this->entityManager->remove($plan);
            $this->entityManager->flush();
            return new JsonResponse(['status' => 'deleted']);
        }
        return new JsonResponse(['status' => 'error'], 403);
    }

    // ─── Scoring helpers ────────────────────────────────────────────────────────

    private function scoreDestinations(array $destinations, array $answers): array
    {
        $scored = [];
        foreach ($destinations as $dest) {
            $score = rand(45, 75);
            // Destination has no getClimate() — use type & bestSeason for scoring
            $type = strtolower($dest->getType() ?? '');
            $season = strtolower($dest->getBestSeason() ?? '');
            $weather = $answers['weather'] ?? '';
            $climate = $answers['climate'] ?? '';

            if ($weather === 'sunny' && in_array($type, ['beach', 'island', 'desert']))
                $score += 20;
            if ($weather === 'cool' && in_array($type, ['mountain', 'forest']))
                $score += 20;
            if ($weather === 'rainy' && in_array($type, ['forest', 'countryside']))
                $score += 15;
            if ($climate === 'tropical' && in_array($type, ['beach', 'island']))
                $score += 10;
            if ($climate === 'mediterranean' && $type === 'city')
                $score += 10;
            if ($climate === 'arid' && $type === 'desert')
                $score += 10;
            if ($climate === 'polar' && $type === 'mountain')
                $score += 10;
            $score = min(99, $score);

            $scored[] = [
                'id' => $dest->getId(),
                'name' => $dest->getName(),
                'country' => $dest->getCountry() ?? '',
                'description' => $dest->getDescription() ? substr($dest->getDescription(), 0, 120) : '',
                'image' => $dest->getImageUrl(),
                'climate' => $dest->getType() ?? '',
                'matchScore' => $score,
            ];
        }
        usort($scored, fn($a, $b) => $b['matchScore'] <=> $a['matchScore']);
        return $scored;
    }

    private function scoreAccommodations(array $accommodations, array $answers): array
    {
        $budgetMap = ['budget' => [0, 80], 'comfort' => [80, 200], 'luxury' => [200, 99999]];
        $range = $budgetMap[$answers['budget'] ?? 'comfort'] ?? [0, 99999];
        $scored = [];
        foreach ($accommodations as $acc) {
            // Accommodation has no getPricePerNight(); use stars as a proxy
            $stars = $acc->getStars() ?? 3;
            $price = $stars * 50; // rough estimate: 1★≈50, 3★≈150, 5★≈250
            $score = ($price >= $range[0] && $price <= $range[1]) ? rand(65, 99) : rand(20, 45);

            // Boost by group type
            $group = $answers['group'] ?? '';
            if ($group === 'couple' && in_array($acc->getType(), ['Boutique', 'Villa', 'Resort']))
                $score = min(99, $score + 10);
            if ($group === 'family' && in_array($acc->getType(), ['Resort', 'Apartment']))
                $score = min(99, $score + 10);
            if ($group === 'solo' && in_array($acc->getType(), ['Hostel', 'Guest House']))
                $score = min(99, $score + 10);

            $scored[] = [
                'id' => $acc->getId(),
                'name' => $acc->getName(),
                'type' => $acc->getType() ?? '',
                'city' => $acc->getCity() ?? '',
                'country' => $acc->getCountry() ?? '',
                'price' => $price,
                'stars' => $stars,
                'image' => $acc->getImagePath(),
                'matchScore' => $score,
            ];
        }
        usort($scored, fn($a, $b) => $b['matchScore'] <=> $a['matchScore']);
        return $scored;
    }

    private function scoreActivities(array $activities, array $answers): array
    {
        $interestMap = [
            'culture' => ['museum', 'history', 'art', 'heritage', 'tour', 'monument', 'culture', 'civilisation'],
            'adventure' => ['surf', 'hike', 'climb', 'dive', 'extreme', 'trek', 'rafting', 'adventure', 'paragliding'],
            'food' => ['cook', 'restaurant', 'cuisine', 'food', 'tasting', 'gastro', 'culinary', 'wine'],
            'beach' => ['beach', 'swim', 'snorkel', 'boat', 'sea', 'sand', 'sunset', 'sail'],
            'nature' => ['park', 'forest', 'wildlife', 'garden', 'nature', 'trail', 'safari', 'eco'],
            'nightlife' => ['club', 'bar', 'concert', 'party', 'show', 'festival', 'nightlife', 'music'],
            'wellness' => ['spa', 'yoga', 'meditation', 'relax', 'massage', 'retreat', 'thermal', 'wellness'],
            'shopping' => ['market', 'shop', 'mall', 'bazaar', 'souvenir', 'boutique', 'fashion', 'craft'],
            'business' => ['conference', 'meeting', 'business', 'seminar', 'networking', 'expo', 'summit'],
        ];
        $selectedInterests = $answers['interests'] ?? [];
        $keywords = [];
        foreach ($selectedInterests as $interest) {
            $keywords = array_merge($keywords, $interestMap[$interest] ?? []);
        }
        $scored = [];
        foreach ($activities as $act) {
            $name = strtolower($act->getName() ?? '');
            $desc = strtolower($act->getDescription() ?? '');
            $cat = strtolower($act->getCategory() ?? '');
            $score = 40;
            foreach ($keywords as $kw) {
                if (str_contains($name, $kw) || str_contains($desc, $kw) || str_contains($cat, $kw))
                    $score += 15;
            }
            // Duration label
            $mins = $act->getDurationMinutes() ?? 0;
            $dur = $mins >= 60 ? round($mins / 60, 1) . 'h' : $mins . 'min';

            $scored[] = [
                'id' => $act->getId(),
                'name' => $act->getName(),
                'category' => $act->getCategory() ?? '',
                'price' => $act->getPrice() ? (float) $act->getPrice() : 0,
                'duration' => $dur,
                'image' => null, // Activity has no image field
                'matchScore' => min(99, $score + rand(0, 8)),
            ];
        }
        usort($scored, fn($a, $b) => $b['matchScore'] <=> $a['matchScore']);
        return $scored;
    }

    private function matchOffersAndPacks(array $answers): array
    {
        $result = [];

        // Offers — use getTitle() and getDiscountValue()
        foreach ($this->offerRepository->findAll() as $offer) {
            $result[] = [
                'type' => 'offer',
                'id' => $offer->getId(),
                'name' => $offer->getTitle(),
                'description' => substr($offer->getDescription() ?? '', 0, 100),
                'discount' => (float) ($offer->getDiscountValue() ?? rand(10, 35)),
                'validUntil' => $offer->getEndDate() ? $offer->getEndDate()->format('Y-m-d') : null,
                'matchScore' => rand(70, 98),
            ];
        }

        // Packs — use getTitle() and getBasePrice()
        foreach ($this->packRepository->findAll() as $pack) {
            $result[] = [
                'type' => 'pack',
                'id' => $pack->getId(),
                'name' => $pack->getTitle(),
                'description' => substr($pack->getDescription() ?? '', 0, 100),
                'discount' => rand(10, 30), // packs don't have a discount field
                'price' => $pack->getBasePrice(),
                'matchScore' => rand(65, 95),
            ];
        }

        usort($result, fn($a, $b) => $b['matchScore'] <=> $a['matchScore']);
        return array_slice($result, 0, 3);
    }

    private function estimateBudget(array $answers, array $accs, array $acts): int
    {
        $duration = match ($answers['duration'] ?? '5-7 days') {
            'weekend' => 2,
            '5-7 days' => 6,
            '10-14 days' => 12,
            '2+ weeks' => 18,
            default => 6,
        };
        $accPrice = !empty($accs) ? (float) ($accs[0]['price'] ?? 100) : 100;
        $actTotal = array_sum(array_column(array_slice($acts, 0, 5), 'price'));
        return (int) (($accPrice * $duration) + $actTotal + 300);
    }

    private function calculateCartBudget(array $answers, array $destinations, array $accommodations, array $activities, array $offers): array
    {
        $days = match ($answers['duration'] ?? '5-7 days') {
            'weekend' => 3,
            '10-14 days' => 12,
            '2+ weeks' => 18,
            default => 6,
        };
        $nights = max(1, $days - 1);
        $travelers = match ($answers['group'] ?? 'solo') {
            'couple' => 2,
            'family' => 4,
            'friends' => 3,
            default => 1,
        };

        $lodgingNightly = array_sum(array_map(fn ($item) => (float) ($item['price'] ?? 0), $accommodations));
        $lodging = $lodgingNightly * $nights;
        $activityTotal = array_sum(array_map(fn ($item) => (float) ($item['price'] ?? 0), $activities)) * $travelers;
        $packTotal = array_sum(array_map(fn ($item) => (float) ($item['price'] ?? 0), array_filter($offers, fn ($item) => !empty($item['price']))));
        $transport = !empty($destinations) ? 300 * $travelers * count($destinations) : 0;
        $subtotal = $lodging + $activityTotal + $packTotal + $transport;
        $discountRate = min(60, array_sum(array_map(fn ($item) => (float) ($item['discount'] ?? 0), $offers)));
        $savings = (int) round($subtotal * ($discountRate / 100));
        $total = max(0, (int) round($subtotal - $savings));

        return [
            'days' => $days,
            'nights' => $nights,
            'travelers' => $travelers,
            'lodging' => (int) round($lodging),
            'activities' => (int) round($activityTotal),
            'transport' => (int) round($transport),
            'packs' => (int) round($packTotal),
            'discountRate' => $discountRate,
            'savings' => $savings,
            'total' => $total,
            'perPerson' => $travelers > 0 ? (int) round($total / $travelers) : $total,
        ];
    }

    private function getBestTransport(array $transports): ?array
    {
        if (empty($transports))
            return null;
        $t = $transports[0];
        return [
            'id' => $t->getTransportId(),
            'name' => $t->getProviderName() . ' — ' . $t->getVehicleModel(),
            'type' => $t->getTransportType(),
            'price' => $t->getBasePrice(),
        ];
    }
}
