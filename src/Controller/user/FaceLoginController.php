<?php
// src/Controller/user/FaceLoginController.php

namespace App\Controller\user;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\SecurityBundle\Security;

#[Route('/face', name: 'face_')]
class FaceLoginController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly EventDispatcherInterface $dispatcher,
        private readonly Security $security,
    ) {}

    /* ═══════════════════════════════════════════
       GET /face/login-page  – camera UI for login
    ═══════════════════════════════════════════ */
    #[Route('/login-page', name: 'login_page', methods: ['GET'])]
    public function loginPage(): Response
    {
        // Only redirect if fully authenticated (prevents bypassing if 2FA is needed)
        if ($this->getUser() && $this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('index');
        }
        return $this->render('front/face_login.html.twig');
    }

    /* ═══════════════════════════════════════════
       GET /face/setup  – camera UI for registration
       (must be logged in with email first)
    ═══════════════════════════════════════════ */
    #[Route('/setup', name: 'setup', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function setup(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('front/face_setup.html.twig', [
            'user'               => $user,
            'already_registered' => $user->getFaceDescriptor() !== null,
        ]);
    }

    /* ═══════════════════════════════════════════
       POST /face/register  – store face for current user
    ═══════════════════════════════════════════ */
    #[Route('/register', name: 'register', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function register(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        $data = json_decode($request->getContent(), true);
        $descriptor = $data['descriptor'] ?? null;

        if (!$descriptor || !is_array($descriptor)) {
            return $this->json(['success' => false, 'message' => 'No face descriptor received.'], 400);
        }

        try {
            // Store the descriptor (array of 128 floats)
            $user->setFaceDescriptor($descriptor);
            $this->em->flush();

            return $this->json([
                'success'  => true,
                'message'  => 'Face registered successfully! You can now use face login.',
                'redirect' => $this->generateUrl('users'),
            ]);

        } catch (\Exception $e) {
            return $this->json(['success' => false, 'message' => 'Error saving face data: ' . $e->getMessage()], 500);
        }
    }

    /* ═══════════════════════════════════════════
       POST /face/login  – authenticate via face
    ═══════════════════════════════════════════ */
    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $capturedDescriptor = $data['descriptor'] ?? null;

        if (!$capturedDescriptor || !is_array($capturedDescriptor)) {
            return $this->json(['success' => false, 'message' => 'No face descriptor received.'], 400);
        }

        // Check for Face-ID-specific session lockout
        $session = $request->getSession();
        $lockedUntil = $session->get('face_locked_until');
        if ($lockedUntil && time() < $lockedUntil) {
            $secondsLeft = $lockedUntil - time();
            return $this->json([
                'success' => false,
                'message' => "Biometric Lock: Too many failed scans. Please wait {$secondsLeft}s.",
            ], 429);
        }

        try {
            // Find the best match among all users with a registered face
            $users = $this->em->getRepository(User::class)->createQueryBuilder('u')
                ->where('u.faceDescriptor IS NOT NULL')
                ->getQuery()
                ->getResult();

            $bestMatch = null;
            $minDistance = 0.4; // Threshold for face-api.js

            /** @var User $user */
            foreach ($users as $user) {
                $storedDescriptor = $user->getFaceDescriptor();
                $distance = $this->euclideanDistance($capturedDescriptor, $storedDescriptor);

                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $bestMatch = $user;
                }
            }

            if (!$bestMatch) {
                $attempts = $session->get('face_login_attempts', 0) + 1;
                $session->set('face_login_attempts', $attempts);
                
                if ($attempts >= 3) {
                    $session->set('face_locked_until', time() + 60); // 1 minute lock
                    $session->remove('face_login_attempts');
                    return $this->json([
                        'success' => false,
                        'message' => 'Security Lock: Too many attempts. Please wait 1 minute.',
                    ], 429);
                }

                return $this->json([
                    'success' => false,
                    'message' => 'Face not recognised. Please try again or use password.',
                ], 401);
            }

            // Success - clear attempts
            $session->remove('face_login_attempts');
            $session->remove('face_locked_until');

            $user = $bestMatch;
            $confidence = round((1 - $minDistance) * 100, 1);

            if ($user->getStatus() === 'banned' || $user->getStatus() === 'suspended') {
                return $this->json([
                    'success' => false,
                    'message' => 'Your account has been suspended.',
                ], 403);
            }

            // Log the user in explicitly telling Symfony which firewall and provider to use
            // On some symfony versions, using 'form_login' works, on others we might need the full ID
            // or just the firewall name if it's the primary one.
            try {
                $this->security->login($user, 'security.authenticator.form_login.main', 'main');
            } catch (\Throwable $e) {
                // Fallback to simpler login if the explicit authenticator ID fails
                try {
                    $this->security->login($user, 'main');
                } catch (\Throwable $e2) {
                    throw new \Exception("Auth failed: " . $e2->getMessage());
                }
            }
            
            // If 2FA is required, the token in session will be a TwoFactorToken
            // We can check if the redirect is needed by looking at the token later or letting
            // the success handler (which we won't trigger manually here) handle it.
            // Actually, Security::login does NOT return a response in some versions, 
            // but we can check if the user is fully and truly authenticated.
            
            return $this->json([
                'success'    => true,
                'message'    => "Welcome back, {$user->getFirstName()}!",
                'confidence' => $confidence,
                'redirect'   => $this->generateUrl('index'),
            ]);

            return $this->json([
                'success'    => true,
                'message'    => "Welcome back, {$user->getFirstName()}!",
                'confidence' => $confidence,
                'redirect'   => $this->generateUrl('index'),
            ]);

        } catch (\Exception $e) {
            return $this->json(['success' => false, 'message' => 'Login error: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/remove', name: 'remove', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function remove(): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        $user->setFaceDescriptor(null);
        $this->em->flush();

        return $this->json([
            'success' => true,
            'message' => 'Face data unlinked from your account.',
        ]);
    }

    #[Route('/dev-reset-lock', name: 'dev_reset_lock', methods: ['GET'])]
    public function devResetLock(Request $request): Response
    {
        // Only allow on localhost for safety
        if (in_array($request->getClientIp(), ['127.0.0.1', '::1'])) {
            $session = $request->getSession();
            $session->remove('locked_until');
            $session->remove('login_attempts');
            $session->remove('login_block_count');
        }
        return new Response('Lock cleared');
    }

    private function euclideanDistance($a, $b): float
    {
        if (!is_array($a) || !is_array($b)) return 1.0;
        
        $sum = 0;
        // Use the smaller count to avoid undefined index if they differ
        $count = min(count($a), count($b));
        
        for ($i = 0; $i < $count; $i++) {
            $valA = (float)($a[$i] ?? 0);
            $valB = (float)($b[$i] ?? 0);
            $sum += ($valA - $valB) ** 2;
        }
        
        return sqrt($sum);
    }
}
