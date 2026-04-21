<?php

namespace App\Controller\user;

use App\Entity\User;
use App\Entity\Preference;
use App\service\AuthService;
use App\service\PreferenceService;
use App\form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AuthController extends AbstractController
{
    private AuthService $authService;
    private Security $security;
    private PreferenceService $preferenceService;

    public static function getSubscribedServices(): array
    {
        $services = parent::getSubscribedServices();
        $services['form.factory'] = '?'.FormFactoryInterface::class;
        return $services;
    }

    public function setAuthService(AuthService $authService): void
    {
        $this->authService = $authService;
    }

    public function setSecurity(Security $security): void
    {
        $this->security = $security;
    }

    public function setPreferenceService(PreferenceService $preferenceService): void
    {
        $this->preferenceService = $preferenceService;
    }

    /* ── LOGIN PAGE with brute force protection ── */
    #[Route('/', name: 'app_login')]
    #[Route('/login')]
    public function login(Request $request, AuthenticationUtils $authUtils, EntityManagerInterface $em): Response
    {
        // Only redirect if fully authenticated
        if ($this->getUser() && $this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('index');
        }

        $lastUsername = $authUtils->getLastUsername();

        $registrationForm = $this->createForm(RegistrationFormType::class, new User());
        $session = $request->getSession();

        return $this->render('front/login.html.twig', [
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
            'form' => $registrationForm->createView(),
            'lock_until' => $session->get('locked_until'),
            'error_type' => $session->get('login_error_type'),
        ]);
    }

    /* ── LOGOUT ── */
    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method should never be reached.');
    }

    /* ── REGISTER with password strength validation ── */
    
    #[Route('/register', name: 'app_register', methods: ['POST'])]
    public function register(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Check if email already exists
            $existingUser = $em->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
            if ($existingUser) {
                $this->addFlash('signup_error', 'There is already an account with this email address.');
                return $this->redirectToRoute('app_login', ['signup' => 1]);
            }

            $plainPassword = $user->getPlainPassword();

        // Extra password strength check (uppercase, lowercase)
        $errors = [];
            if (strlen($plainPassword) < 8) {
                $errors[] = 'Password must be at least 8 characters.';
            }
            if (!preg_match('/[A-Z]/', $plainPassword)) {
                $errors[] = 'Password must contain at least 1 uppercase letter.';
            }
            if (!preg_match('/[a-z]/', $plainPassword)) {
                $errors[] = 'Password must contain at least 1 lowercase letter.';
            }
            if (!preg_match('/[0-9]/', $plainPassword)) {
                $errors[] = 'Password must contain at least 1 number.';
            }
        
            if (!empty($errors)) {
            foreach ($errors as $error) {
                $this->addFlash('signup_error', $error);
            }
            return $this->redirectToRoute('app_login', ['signup' => 1]);
        }

        $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));
        $user->setRole('user');
        $user->setStatus('pending_verification');
        $user->setEmailVerified(false);

        $avatarService = new \App\service\AvatarService();
        $user->setAvatarId($user->getUserId());
        $em->persist($user);
        $em->flush();

        $token = hash('sha256', $user->getId() . $user->getEmail() . $this->getParameter('kernel.secret'));
        $verifyUrl = $this->generateUrl('app_verify_email', ['id' => $user->getId(), 'token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);
        
        $email = (new Email())
            ->from('comptetest740@gmail.com')
            ->to($user->getEmail())
            ->subject('TripX — Verify Your Email ✈')
            ->html('
                <div style="font-family:sans-serif;max-width:520px;margin:auto;padding:32px;background:#0b1220;color:#e2e8f0;border-top: 4px solid #00a6ed;">
                    <h2 style="color:#00a6ed;margin-bottom:8px;">Welcome to TripX! ✈</h2>
                    <p style="font-size: 16px;">Please click the button below to verify your email address and continue setting up your account.</p>
                    <div style="margin: 32px 0; text-align: center;">
                        <a href="' . $verifyUrl . '" style="background: #00a6ed; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px;">Verify Email Address</a>
                    </div>
                    <p style="color:#9ca3af; font-size:14px;">If you did not create an account, no further action is required.</p>
                </div>
            ');

        try {
            $mailer->send($email);
            $this->addFlash('success', 'Account created! Please check your email to verify your account.');
        } catch (\Exception $e) {
            $this->addFlash('signup_error', 'Account created but failed to send verification email.');
        }

        return $this->redirectToRoute('app_login', ['signup' => 1]);
    }

    // Collect all form errors
    foreach ($form->getErrors(true) as $error) {
        $this->addFlash('signup_error', $error->getMessage());
    }

    return $this->redirectToRoute('app_login', ['signup' => 1]);
}

    #[Route('/verify-email', name: 'app_verify_email')]
    public function verifyEmail(Request $request, EntityManagerInterface $em): Response
    {
        $id = $request->query->get('id');
        $token = $request->query->get('token');

        if (!$id || !$token) {
            $this->addFlash('error', 'Invalid verification link.');
            return $this->redirectToRoute('app_login');
        }

        $user = $em->getRepository(User::class)->find($id);

        if (!$user) {
            $this->addFlash('error', 'User not found.');
            return $this->redirectToRoute('app_login');
        }

        if ($user->isEmailVerified()) {
            $this->addFlash('success', 'Your email is already verified. Please sign in or continue.');
            return $this->redirectToRoute('app_login');
        }

        $expectedToken = hash('sha256', $user->getId() . $user->getEmail() . $this->getParameter('kernel.secret'));

        if (!hash_equals($expectedToken, $token)) {
            $this->addFlash('error', 'Invalid or expired verification link.');
            return $this->redirectToRoute('app_login');
        }

        $user->setEmailVerified(true);
        $user->setStatus('active');
        $em->flush();

        $this->addFlash('success', 'Email verified successfully! Let\'s setup your preferences.');
        $request->getSession()->set('onboarding_user_id', $user->getUserId());

        return $this->redirectToRoute('app_onboarding');
    }

    /* ── ONBOARDING PAGE with session persistence ── */
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
    public function savePreferences(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $userId = $request->getSession()->get('onboarding_user_id');

        if (!$userId) {
            return new JsonResponse(['success' => false, 'message' => 'Session expired, please login again'], 401);
        }

        $data = json_decode($request->getContent(), true) ?? [];

        if ($this->preferenceService->savePreferences((int) $userId, $data)) {
            $user = $em->getRepository(User::class)->find($userId);
            if ($user) {
                $this->security->login($user);
            }
            $request->getSession()->remove('onboarding_user_id');
            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse(['success' => false, 'message' => 'Saving failed'], 500);
    }
}