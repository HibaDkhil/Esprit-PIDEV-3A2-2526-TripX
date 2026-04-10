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
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\FormFactoryInterface;


class AuthController extends AbstractController
{
    private AuthService $authService;
    private Security $security;
    private PreferenceService $preferenceService;

    // ADD THIS METHOD - this tells Symfony what services your controller needs
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

    /* ── LOGIN PAGE ── */
    #[Route('/', name: 'app_login')]
    #[Route('/login')]
    public function login(Request $request, AuthenticationUtils $authUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('index');
        }

        // This will work now because we declared form.factory in getSubscribedServices
        $registrationForm = $this->createForm(RegistrationFormType::class, new User());

        return $this->render('front/login.html.twig', [
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
            'form' => $registrationForm->createView(),
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
    public function register(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $user->getPlainPassword();

            // Safety guard – should never be null after validation, but just in case
            if (!$plainPassword) {
                $this->addFlash('signup_error', 'Password is required.');
                return $this->redirectToRoute('app_login', ['signup' => 1]);
            }

            $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));
            $user->setRole('user');
            $user->setStatus('active');
            $user->setEmailVerified(true);

            $em->persist($user);
            $em->flush();

            $request->getSession()->set('onboarding_user_id', $user->getUserId());

            return $this->redirectToRoute('app_onboarding');
        }

        // If the form is submitted but invalid (or failed validation)
        return $this->render('front/login.html.twig', [
            'last_username' => '', // not needed on signup error side
            'error' => null, // not needed on signup error side
            'form' => $form->createView(),
            'show_signup' => true,
        ]);
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
    public function savePreferences(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $userId = $request->getSession()->get('onboarding_user_id');

        if (!$userId) {
            return new JsonResponse(['success' => false, 'message' => 'Session expired'], 401);
        }

        $data = json_decode($request->getContent(), true) ?? [];

        if ($this->preferenceService->savePreferences((int) $userId, $data)) {
            $user = $em->getRepository(User::class)->find($userId);
            if ($user) {
                // Programmatically log in the user so they can access the platform instantly
                $this->security->login($user);
            }
            $request->getSession()->remove('onboarding_user_id');
            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse(['success' => false, 'message' => 'Saving failed'], 500);
    }
    
}