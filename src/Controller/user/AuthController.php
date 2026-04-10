<?php

namespace App\Controller\user;

use App\Entity\User;
use App\Entity\Preference;
use App\service\AuthService;
use App\service\PreferenceService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class AuthController extends AbstractController
{
    private AuthService $authService;
    private Security $security;
    private PreferenceService $preferenceService;

    public function __construct(
        AuthService $authService,
        Security $security,
        PreferenceService $preferenceService
    ) {
        $this->authService = $authService;
        $this->security = $security;
        $this->preferenceService = $preferenceService;
    }

    /* ── LOGIN PAGE ── */
    #[Route('/', name: 'app_login')]
    #[Route('/login')]
    public function login(Request $request, Security $security, AuthenticationUtils $authUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('index');
        }

        return $this->render('front/login.html.twig', [
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
        ]);
    }

    /* ── LOGOUT ── */
    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method should never be reached.');
    }

    /* ── REGISTER ── */
    #[Route('/register', name: 'app_register', methods: ['POST'])]
    public function register(Request $request): Response
    {
        if (!$this->isCsrfTokenValid('register', $request->request->get('_csrf_token'))) {
            $this->addFlash('error', 'Invalid CSRF token.');
            return $this->redirectToRoute('app_login', ['signup' => 1]);
        }
        $data = [
            'first_name'   => trim((string)$request->request->get('first_name', '')),
            'last_name'    => trim((string)$request->request->get('last_name', '')),
            'email'        => trim((string)$request->request->get('email', '')),
            'password'     => (string)$request->request->get('password', ''),
            'phone_number' => trim((string)$request->request->get('phone_number', '')),
        ];
        $confirmPw = (string)$request->request->get('confirm_password', '');

        if (!$data['first_name'] || !$data['last_name'] || !$data['email'] || !$data['password']) {
            $this->addFlash('error', 'Please fill all required fields.');
            return $this->redirectToRoute('app_login', ['signup' => 1]);
        }

        if ($data['password'] !== $confirmPw) {
            $this->addFlash('error', 'Passwords do not match.');
            return $this->redirectToRoute('app_login', ['signup' => 1]);
        }

        if (strlen($data['password']) < 8) {
            $this->addFlash('error', 'Password must be at least 8 characters.');
            return $this->redirectToRoute('app_login', ['signup' => 1]);
        }

        if ($this->authService->findUserByEmail($data['email'])) {
            $this->addFlash('error', 'An account with this email already exists.');
            return $this->redirectToRoute('app_login', ['signup' => 1]);
        }

        try {
            $user = $this->authService->registerUser($data);
            error_log("NEW USER CREATED: " . $user->getUserId() . " " . $user->getEmail());
            
            // Log the user in
            $this->security->login($user, 'form_login', 'main');
            
            $request->getSession()->set('onboarding_user_id', $user->getUserId());
            $this->addFlash('success', 'Account created! Please complete your profile.');
            
            return $this->redirectToRoute('app_onboarding');
        } catch (\Exception $e) {
            error_log("REGISTRATION FAILED: " . $e->getMessage());
            $this->addFlash('error', 'An error occurred during registration: ' . $e->getMessage());
            return $this->redirectToRoute('app_login', ['signup' => 1]);
        }
    }

    /* ── ONBOARDING PAGE ── */
    #[Route('/onboarding', name: 'app_onboarding')]
    public function onboarding(Request $request, EntityManagerInterface $em): Response
    {
        $userId = $request->getSession()->get('onboarding_user_id');
        
        if (!$userId) {
            return $this->redirectToRoute('app_login');
        }
        
        $existingPrefs = $em->getRepository(Preference::class)->findOneBy(['userId' => $userId]);
        if ($existingPrefs && $existingPrefs->getTravelPace()) {
            $request->getSession()->remove('onboarding_user_id');
            return $this->redirectToRoute('index');
        }
        
        return $this->render('front/onboarding.html.twig');
    }

    /* ── SAVE PREFERENCES ── */
    #[Route('/preferences/save', name: 'app_save_preferences', methods: ['POST'])]
    public function savePreferences(Request $request): JsonResponse
    {
        $userId = $request->getSession()->get('onboarding_user_id');
        error_log("SAVE PREFS REQUEST FOR USER ID: " . ($userId ?? 'NULL'));

        if (!$userId) {
            return new JsonResponse(['success' => false, 'message' => 'Session expired'], 401);
        }

        $data = json_decode($request->getContent(), true) ?? [];
        error_log("DATA RECEIVED: " . json_encode($data));
        
        if ($this->preferenceService->savePreferences((int)$userId, $data)) {
            error_log("PREFERENCES SAVED SUCCESSFULLY FOR ID: " . $userId);
            $request->getSession()->remove('onboarding_user_id');
            return new JsonResponse(['success' => true]);
        }

        error_log("PREFERENCES SAVE FAILED FOR ID: " . $userId);
        return new JsonResponse(['success' => false, 'message' => 'Saving failed'], 500);
    }
    
}