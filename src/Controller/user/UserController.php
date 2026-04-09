<?php

namespace App\Controller\user;

use App\Entity\User;
use App\service\PreferenceService;
use App\service\UserProfileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;

class UserController extends AbstractController
{
    private UserProfileService $profileService;
    private PreferenceService $preferenceService;
    private Security $security;

    public function __construct(UserProfileService $profileService, PreferenceService $preferenceService, Security $security)
    {
        $this->profileService = $profileService;
        $this->preferenceService = $preferenceService;
        $this->security = $security;
    }

    /**
     * Display user profile page
     */
    #[Route('/profile', name: 'users', methods: ['GET'])]
    public function profile(): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'Please log in to view your profile.');
            return $this->redirectToRoute('app_login');
        }

        // Get enriched profile data from service
        $profileData = $this->profileService->getProfileData($user);

        return $this->render('front/users.html.twig', $profileData);
    }

    /**
     * Update user profile information
     */
    #[Route('/profile/update', name: 'profile_update', methods: ['POST'])]
    public function updateProfile(Request $request): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user) {
            return $this->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json(['success' => false, 'error' => 'Invalid data'], 400);
        }
        $firstName = trim((string)($data['firstName'] ?? ''));
        $lastName = trim((string)($data['lastName'] ?? ''));
        $email = trim((string)($data['email'] ?? ''));
        if ($firstName === '' || $lastName === '' || $email === '') {
            return $this->json(['success' => false, 'error' => 'First name, last name, and email are required.'], 400);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->json(['success' => false, 'error' => 'Please enter a valid email address.'], 400);
        }

        try {
            $this->profileService->updateProfile($user, $data);
            return $this->json(['success' => true, 'message' => 'Profile updated successfully']);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => 'Failed to update profile: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Change user password
     */
    #[Route('/profile/password', name: 'profile_password', methods: ['POST'])]
    public function changePassword(Request $request): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user) {
            return $this->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        $data = json_decode($request->getContent(), true);
        $password = $data['password'] ?? '';

        if (strlen($password) < 6) {
            return $this->json([
                'success' => false,
                'error' => 'Password must be at least 6 characters'
            ], 400);
        }

        try {
            $this->profileService->changePassword($user, $password);
            return $this->json(['success' => true, 'message' => 'Password updated successfully']);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => 'Failed to update password: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user statistics (for AJAX updates)
     */
    #[Route('/profile/stats', name: 'profile_stats', methods: ['GET'])]
    public function getStats(): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $profileData = $this->profileService->getProfileData($user);

        return $this->json([
            'totalMinutes' => $profileData['totalMinutes'],
            'pageVisits' => $profileData['pageVisits'],
            'aiInteractions' => $profileData['aiInteractions'],
            'engagementScore' => $profileData['engagementScore'],
            'travelPersona' => $profileData['travelPersona'],
        ]);
    }

    #[Route('/profile/preferences', name: 'profile_preferences', methods: ['POST'])]
    public function saveTravelPreferences(Request $request): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        $data = json_decode($request->getContent(), true);
        if (!is_array($data)) {
            return $this->json(['success' => false, 'error' => 'Invalid data'], 400);
        }

        try {
            $ok = $this->preferenceService->savePreferences((int) $user->getUserId(), $data);
            if (!$ok) {
                return $this->json(['success' => false, 'error' => 'Could not save preferences'], 500);
            }

            return $this->json(['success' => true, 'message' => 'Travel preferences saved']);
        } catch (\Throwable $e) {
            return $this->json(['success' => false, 'error' => 'Failed to save preferences'], 500);
        }
    }

    #[Route('/profile/delete', name: 'profile_delete', methods: ['POST'])]
    public function deleteAccount(): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        try {
            $this->profileService->deleteAccount($user);
            $this->security->logout(false);
            return $this->json(['success' => true, 'message' => 'Account deleted']);
        } catch (\Throwable $e) {
            return $this->json(['success' => false, 'error' => 'Failed to delete account'], 500);
        }
    }
}
