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
    public function destinations(): Response
    {
        $destinations = $this->destinationService->getAll();
        return $this->render('front/destinations.html.twig', [
            'destinations' => $destinations
        ]);
    }

    #[Route('/activities', name: 'activities')]
    public function activities(): Response
    {
        $activities = $this->activityService->getAll();
        return $this->render('front/activities.html.twig', [
            'activities' => $activities
        ]);
    }

    #[Route('/accommodations', name: 'accommodations')]
    public function accommodations(): Response
    {
        return $this->render('front/accommodations.html.twig');
    }

    #[Route('/transport', name: 'transport')]
    public function transport(): Response
    {
        return $this->render('front/transport.html.twig');
    }

    #[Route('/offers', name: 'offers')]
    public function offers(): Response
    {
        return $this->render('front/offers.html.twig');
    }

    #[Route('/blog', name: 'blog')]
    public function blog(): Response
    {
        return $this->render('front/blog.html.twig');
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
    public function search(Request $request): Response
    {
        $query = $request->query->get('q', '');
        return $this->render('front/search_results.html.twig', [
            'query' => $query
        ]);
    }
}