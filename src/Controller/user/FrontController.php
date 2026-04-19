<?php

namespace App\Controller\user;

use App\service\UserProfileService;
use App\service\PricePredictionService;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Component\Pager\PaginatorInterface;

class FrontController extends AbstractController
{
    private $profileService;
    private $destinationService;
    private $activityService;
    private PricePredictionService $pricePredictionService;

    public function __construct(
        UserProfileService $profileService,
        \App\service\DestinationService $destinationService,
        \App\service\ActivityService $activityService,
        PricePredictionService $pricePredictionService,
    ) {
        $this->profileService = $profileService;
        $this->destinationService = $destinationService;
        $this->activityService = $activityService;
        $this->pricePredictionService = $pricePredictionService;
    }

    #[Route('/home', name: 'index')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getUser();
        $uid = $user instanceof User ? $user->getUserId() : null;

        return $this->render('front/index.html.twig', [
            'price_prediction_cards' => $this->pricePredictionService->buildHomeCarouselCards($uid),
        ]);
    }

    #[Route('/destinations', name: 'destinations')]
    public function destinations(Request $request, PaginatorInterface $paginator): Response
    {
        $limit = $request->query->getInt('limit', 6);
        $pagination = $paginator->paginate(
            $this->destinationService->getAllQuery(),
            $request->query->getInt('page', 1),
            $limit
        );
        return $this->render('front/destinations.html.twig', [
            'destinations' => $pagination,
            'currentLimit' => $limit,
        ]);
    }

    #[Route('/activities', name: 'activities')]
    public function activities(Request $request, PaginatorInterface $paginator): Response
    {
        $limit = $request->query->getInt('limit', 8);
        // Fetch all activities for the map markers (independent query)
        $allActivities = $this->activityService->getAllQuery()->getResult();

        $pagination = $paginator->paginate(
            $this->activityService->getAllQuery(),
            $request->query->getInt('page', 1),
            $limit
        );

        return $this->render('front/activities.html.twig', [
            'activities' => $pagination,
            'allActivities' => $allActivities,
            'currentLimit' => $limit,
        ]);
    }

    /*
     * Accommodations listing + AJAX search are handled by FrontAccommodationController
     * (same path/name) — do not duplicate that route here.
     * @see \App\Controller\user\FrontAccommodationController::index
     */

    /**
     * Nav link "Transport" — forwards to the full transport module (schedules, bookings, API).
     * Static mockup page: templates/front/transport.html.twig (reference design only).
     */
    #[Route('/transport', name: 'transport')]
    public function transport(): Response
    {
        return $this->redirectToRoute('user_transport_index', [], Response::HTTP_FOUND);
    }

    #[Route('/offers', name: 'offers')]
    public function offers(): Response
    {
        return $this->render('front/offers.html.twig');
    }

    

    #[Route('/users', name: 'users')]
    public function users(): Response
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $data = $this->profileService->getProfileData($user);
        return $this->render('front/users.html.twig', $data);
    }

    #[Route('/profile/update', name: 'profile_update', methods: ['POST'])]
    public function updateProfile(Request $request): JsonResponse
    {
        $user = $this->getUser();
        if (!$user instanceof User) return new JsonResponse(['success' => false], 401);

        $data = json_decode($request->getContent(), true);
        if ($data) {
            $this->profileService->updateProfile($user, $data);
            return new JsonResponse(['success' => true]);
        }
        return new JsonResponse(['success' => false], 400);
    }

    #[Route('/profile/password', name: 'profile_password', methods: ['POST'])]
    public function changePassword(Request $request): JsonResponse
    {
        $user = $this->getUser();
        if (!$user instanceof User) return new JsonResponse(['success' => false], 401);

        $data = json_decode($request->getContent(), true);
        if (!empty($data['password'])) {
            $this->profileService->changePassword($user, $data['password']);
            return new JsonResponse(['success' => true]);
        }
        return new JsonResponse(['success' => false], 400);
    }

    /**
     * API: returns activities with destination coordinates for the Leaflet map.
     */
    #[Route('/api/activities/map-data', name: 'api_activities_map_data', methods: ['GET'])]
    public function activitiesMapData(): JsonResponse
    {
        try {
            // Using a simple check to ensure we only get activities with destinations that have coordinates
            $activities = $this->activityService->getAll();
            $data = [];
            foreach ($activities as $act) {
                try {
                    $dest = $act->getDestination();
                    if (!$dest || $dest->getLatitude() === null || $dest->getLongitude() === null) {
                        continue;
                    }
                    $data[] = [
                        'id'           => $act->getActivityId(),
                        'name'         => $act->getName(),
                        'category'     => $act->getCategory(),
                        'price'        => $act->getPrice(),
                        'duration'     => $act->getDurationMinutes(),
                        'destination'  => $dest->getName(),
                        'country'      => $dest->getCountry(),
                        'lat'          => (float) $dest->getLatitude(),
                        'lng'          => (float) $dest->getLongitude(),
                    ];
                } catch (\Exception $e) {
                    // Skip broken records
                    continue;
                }
            }
            return new JsonResponse($data);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Internal Server Error'], 500);
        }
    }

    #[Route('/search', name: 'search')]
    public function search(Request $request): Response
    {
        $query = $request->query->get('q', '');
        return $this->render('front/search_results.html.twig', [
            'query' => $query
        ]);
    }
}