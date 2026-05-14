<?php

namespace App\Controller\user;

use App\service\UserProfileService;
use App\service\PricePredictionService;
use App\Entity\User;
use App\Repository\AccommodationRepository;
use App\service\PackService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        private AccommodationRepository $accommodationRepository,
        private PackService $packService,
        private \Knp\Component\Pager\PaginatorInterface $paginator,
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

        // Fetch top 3 active accommodations
        $accommodations = $this->accommodationRepository->findBy(['status' => 'Active'], ['id' => 'DESC'], 3);

        // Fetch top 2 active packs (offers)
        $packs = $this->packService->getActivePacks(2);

        return $this->render('front/index.html.twig', [
            'price_prediction_cards' => $this->pricePredictionService->buildHomeCarouselCards($uid),
            'accommodations' => $accommodations,
            'packs' => $packs,
        ]);
    }

    #[Route('/destinations', name: 'destinations')]
    public function destinations(Request $request, \App\Repository\DestinationRepository $destRepo): Response
    {
        $query = $request->query->get('q', '');
        $limit = max(1, (int) $request->query->get('limit', 12));
        $page  = max(1, (int) $request->query->get('page', 1));

        $pagination = $this->paginator->paginate(
            $destRepo->searchQuery($query),
            $page,
            $limit
        );

        return $this->render('front/destinations.html.twig', [
            'destinations' => $pagination,
            'currentLimit' => $limit,
            'searchQuery'  => $query
        ]);
    }

    #[Route('/activities', name: 'activities')]
    public function activities(Request $request, \App\Repository\ActivityRepository $activityRepository): Response
    {
        $query = $request->query->get('q', '');
        $limit = max(1, (int) $request->query->get('limit', 16));
        $page  = max(1, (int) $request->query->get('page', 1));

        // Use the query-based search for pagination efficiency
        $pagination = $this->paginator->paginate(
            $activityRepository->searchQuery($query),
            $page,
            $limit
        );

        // Still need all activities for the map (worldwide view)
        $allActivities = $this->activityService->getAll($query);

        return $this->render('front/activities.html.twig', [
            'activities'   => $pagination,
            'allActivities'=> $allActivities,
            'currentLimit' => $limit,
            'searchQuery'  => $query
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

    #[Route('/search', name: 'search')]
    public function search(Request $request, \Doctrine\ORM\EntityManagerInterface $em): Response
    {
        $query = $request->query->get('q', '');
        
        $user = $this->getUser();
        if ($user instanceof User && !empty($query)) {
            $log = new \App\Entity\UserActivityLog();
            $log->setUserId($user->getUserId());
            $log->setActivityType('SEARCH');
            $log->setTargetId($query);
            $log->setTargetType('QUERY');
            $log->setTimestamp(new \DateTimeImmutable());
            $em->persist($log);
            $em->flush();
        }

        return $this->render('front/search_results.html.twig', [
            'query' => $query
        ]);
    }

    #[Route('/community', name: 'group_chat')]
    public function groupChat(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('front/group_chat.html.twig');
    }
}
