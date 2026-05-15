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
            'show_registration_verification' => $session->has('registration_verify_code') && $session->has('registration_user_id'),
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
            $normalizedEmail = mb_strtolower(trim((string) $user->getEmail()));
            $user->setEmail($normalizedEmail);

            $existingUser = $em->getRepository(User::class)->findOneBy(['email' => $normalizedEmail]);
            $isReusingPendingAccount = false;

            if ($existingUser) {
                if ($existingUser->isEmailVerified() || $existingUser->getStatus() === 'active') {
                    if ($request->isXmlHttpRequest()) {
                        return new JsonResponse([
                            'success' => false,
                            'message' => 'There is already an active account with this email address.',
                            'field_errors' => ['email' => 'There is already an active account with this email address.'],
                        ], 409);
                    }
                    $this->addFlash('signup_error', 'There is already an active account with this email address.');
                    return $this->redirectToRoute('app_login', ['signup' => 1]);
                }

                // Reuse stale/unverified registrations instead of blocking the email forever.
                $existingUser->setFirstName((string) $user->getFirstName());
                $existingUser->setLastName((string) $user->getLastName());
                $existingUser->setPhoneNumber($user->getPhoneNumber());
                $existingUser->setPlainPassword($user->getPlainPassword());
                $existingUser->setStatus('pending_verification');
                $existingUser->setEmailVerified(false);
                $user = $existingUser;
                $isReusingPendingAccount = true;
            }

            $plainPassword = $user->getPlainPassword();
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
                if ($request->isXmlHttpRequest()) {
                    return new JsonResponse([
                        'success' => false,
                        'message' => implode(' ', $errors),
                        'field_errors' => ['plainPassword' => $errors[0]],
                    ], 422);
                }
                foreach ($errors as $error) {
                    $this->addFlash('signup_error', $error);
                }
                return $this->redirectToRoute('app_login', ['signup' => 1]);
            }

            $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));
            $user->setRole('user');
            $user->setStatus('pending_verification');
            $user->setEmailVerified(false);

            try {
                if (!$isReusingPendingAccount) {
                    $em->persist($user);
                }
                $em->flush();
            } catch (\Throwable $e) {
                $message = 'Failed to save the new account.';
                if ($this->getParameter('kernel.environment') === 'dev') {
                    $message .= ' Debug: ' . $e->getMessage();
                }

                if ($request->isXmlHttpRequest()) {
                    return new JsonResponse(['success' => false, 'message' => $message], 500);
                }

                $this->addFlash('signup_error', $message);
                return $this->redirectToRoute('app_login', ['signup' => 1]);
            }

            // Generate 6-digit verification code
            $code = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $session = $request->getSession();
            $session->set('registration_verify_code', $code);
            $session->set('registration_user_id', $user->getUserId());
            
            $email = (new Email())
                ->from('comptetest740@gmail.com')
                ->to($user->getEmail())
                ->subject('TripX — Your Verification Code: ' . $code)
                ->html('
                    <div style="font-family:sans-serif;max-width:520px;margin:auto;padding:32px;background:#0b1220;color:#e2e8f0;border-top: 4px solid #00a6ed;">
                        <h2 style="color:#00a6ed;margin-bottom:8px;">Welcome to TripX! ✈</h2>
                        <p style="font-size: 16px;">Use the code below to verify your email address and continue setting up your account.</p>
                        <div style="background:rgba(255,255,255,0.05); padding:24px; text-align:center; border-radius:12px; margin:24px 0;">
                            <span style="font-size:32px; letter-spacing:8px; font-weight:800; color:#fff;">' . $code . '</span>
                        </div>
                        <p style="color:#9ca3af; font-size:14px;">If you did not create an account, no further action is required.</p>
                    </div>
                ');

            try {
                $mailer->send($email);
                if ($request->isXmlHttpRequest()) {
                    return new JsonResponse([
                        'success' => true,
                        'message' => $isReusingPendingAccount
                            ? 'A new verification code was sent to your email.'
                            : 'Verification code sent to your email.',
                    ]);
                }
                $this->addFlash(
                    'success',
                    $isReusingPendingAccount
                        ? 'A new verification code was sent to your email.'
                        : 'Verification code sent to your email.'
                );
            } catch (\Throwable $e) {
                if (!$isReusingPendingAccount) {
                    $em->remove($user);
                    $em->flush();
                }

                $session->remove('registration_verify_code');
                $session->remove('registration_user_id');

                $message = 'Account was not completed because the verification email could not be sent.';
                if ($this->getParameter('kernel.environment') === 'dev') {
                    $message .= ' Debug: ' . $e->getMessage();
                }

                if ($request->isXmlHttpRequest()) {
                    return new JsonResponse(['success' => false, 'message' => $message], 500);
                }

                $this->addFlash('signup_error', $message);
                return $this->redirectToRoute('app_login', ['signup' => 1]);
            }

            return $this->redirectToRoute('app_login', ['signup' => 1, 'verify' => 1]);
        }

        // Collect all form errors
        if ($request->isXmlHttpRequest()) {
            $errs = [];
            $fieldErrors = [];
            foreach ($form->getErrors(true) as $error) {
                $errs[] = $error->getMessage();
                $origin = $error->getOrigin();
                if ($origin) {
                    $fieldErrors[$origin->getName()] = $error->getMessage();
                }
            }
            return new JsonResponse([
                'success' => false,
                'message' => implode(' ', $errs),
                'field_errors' => $fieldErrors,
            ], 422);
        }

        foreach ($form->getErrors(true) as $error) {
            $this->addFlash('signup_error', $error->getMessage());
        }

        return $this->redirectToRoute('app_login', ['signup' => 1]);
    }

    #[Route('/verify-registration', name: 'app_verify_registration', methods: ['POST'])]
    public function verifyRegistration(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $inputCode = $data['code'] ?? '';
        $session = $request->getSession();

        $storedCode = $session->get('registration_verify_code');
        $userId = $session->get('registration_user_id');

        if (!$storedCode || !$userId) {
            return new JsonResponse(['success' => false, 'message' => 'Session expired. Please sign up again.'], 400);
        }

        if ($inputCode !== $storedCode) {
            return new JsonResponse(['success' => false, 'message' => 'Incorrect code.'], 400);
        }

        $user = $em->getRepository(User::class)->find($userId);
        if (!$user) {
            return new JsonResponse(['success' => false, 'message' => 'User not found.'], 404);
        }

        $user->setEmailVerified(true);
        $user->setStatus('active');
        $em->flush();

        $session->remove('registration_verify_code');
        $session->set('onboarding_user_id', $user->getUserId());

        return new JsonResponse(['success' => true]);
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

        try {
            if ($this->preferenceService->savePreferences((int) $userId, $data)) {
                $user = $em->getRepository(User::class)->find($userId);
                if ($user) {
                    // The main firewall has multiple authenticators, so the form login one must be explicit.
                    $this->security->login($user, 'form_login', 'main');
                }
                $request->getSession()->remove('onboarding_user_id');
                return new JsonResponse(['success' => true]);
            }
        } catch (\Throwable $e) {
            $message = 'Failed to finish onboarding.';
            if ($this->getParameter('kernel.environment') === 'dev') {
                $message .= ' Debug: ' . $e->getMessage();
            }

            return new JsonResponse(['success' => false, 'message' => $message], 500);
        }

        return new JsonResponse(['success' => false, 'message' => 'Saving failed'], 500);
    }
}
