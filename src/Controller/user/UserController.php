<?php

namespace App\Controller\user;

use App\Entity\User;
use App\service\LoyaltyService;
use App\service\PreferenceService;
use App\service\UserProfileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\ORM\EntityManagerInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticator;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Dompdf\Dompdf;
use Dompdf\Options;


class UserController extends AbstractController
{
    private UserProfileService $profileService;
    private PreferenceService $preferenceService;
    private Security $security;
    private LoyaltyService $loyaltyService;
    private EntityManagerInterface $entityManager;

    public function __construct(
        UserProfileService $profileService, 
        PreferenceService $preferenceService, 
        Security $security, 
        LoyaltyService $loyaltyService,
        EntityManagerInterface $entityManager
    ) {
        $this->profileService = $profileService;
        $this->preferenceService = $preferenceService;
        $this->security = $security;
        $this->loyaltyService = $loyaltyService;
        $this->entityManager = $entityManager;
    }

    /**
     * Display user profile page
     */
    #[Route('/profile', name: 'users', methods: ['GET'])]
    public function profile(Request $request): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'Please log in to view your profile.');
            return $this->redirectToRoute('app_login');
        }

        // Get enriched profile data from service
        $profileData = $this->profileService->getProfileData($user);

        $styles = ['adventurer', 'adventurer-neutral', 'avataaars', 'bottts', 'croodles', 'dylan', 'fun-emoji', 'glass', 'identicon', 'initials', 'lorelei', 'micah', 'miniavs', 'notionists', 'open-peeps'];

        // Get avatar style from session
        $avatarStyle = $request->getSession()->get('user_avatar_style');

        // If not in session, try database
        if (!$avatarStyle && $user->getAvatarId() !== null) {
            $idx = $user->getAvatarId();
            if (isset($styles[$idx])) {
                $avatarStyle = $styles[$idx];
                $request->getSession()->set('user_avatar_style', $avatarStyle);
            }
        }

        // Fallback
        $avatarStyle = $avatarStyle ?: 'adventurer';

        // Merge avatar style into profile data
        $profileData['userAvatarStyle'] = $avatarStyle;

        // Real loyalty data
        $loyalty = $this->loyaltyService->getOrCreate((int) $user->getUserId());
        $profileData['loyalty'] = $loyalty;

        return $this->render('front/users.html.twig', $profileData);
    }

    /**
     * Save user avatar style
     */
    #[Route('/profile/avatar', name: 'profile_avatar', methods: ['POST'])]
    public function saveAvatar(Request $request, \Doctrine\ORM\EntityManagerInterface $em): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user) {
            return $this->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        $data = json_decode($request->getContent(), true);
        $avatarStyle = $data['style'] ?? 'adventurer';

        $styles = ['adventurer', 'adventurer-neutral', 'avataaars', 'bottts', 'croodles', 'dylan', 'fun-emoji', 'glass', 'identicon', 'initials', 'lorelei', 'micah', 'miniavs', 'notionists', 'open-peeps'];
        $idx = array_search($avatarStyle, $styles);

        if ($idx !== false) {
            $user->setAvatarId($idx);
            $em->flush();
        }

        // Store avatar style in session
        $request->getSession()->set('user_avatar_style', $avatarStyle);

        return $this->json(['success' => true, 'style' => $avatarStyle]);
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
        $firstName = trim((string) ($data['firstName'] ?? ''));
        $lastName = trim((string) ($data['lastName'] ?? ''));
        $email = trim((string) ($data['email'] ?? ''));
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

    private function getRewardForPoints(int $points): string
    {
        $user = $this->getUser();
        $id = $user ? ($user->getUserId() ?? $user->getId()) : '000';
        $year = date('Y');

        if ($points > 100) {
            return "15% DISCOUNT VOUCHER (CODE: TRIPX-PLATINUM-{$id}-{$year})";
        }
        if ($points > 50) {
            return "Exclusive Travel Tips Access";
        }
        return "Early Explorer Badge";
    }

    #[Route('/profile/report/generate', name: 'profile_report_generate', methods: ['GET'])]
    public function generateReport(): JsonResponse
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        $profileData = $this->profileService->getProfileData($user);

        $loyalty = $profileData['loyalty'] ?? null;
        $loyaltyData = null;
        if ($loyalty) {
            $pts = $loyalty->getTotalPoints();
            $loyaltyData = [
                'points' => $pts,
                'reward' => $this->getRewardForPoints($pts)
            ];
        }

        return $this->json([
            'success' => true,
            'report' => [
                'persona' => $profileData['travelPersona'],
                'emoji' => '🌍',
                'insights' => 'Based on your ' . $profileData['pageVisits'] . ' page visits and ' . $profileData['totalMinutes'] . ' minutes spent, we noticed you have a strong preference for ' . strtolower($profileData['travelPersona']) . ' experiences. Keep exploring to unlock more tailored recommendations.',
                'stats' => [
                    'engagement' => $profileData['engagementScore']
                ],
                'loyalty' => $loyaltyData,
                'picks' => array_map(function($pick) {
                    return [
                        'name' => $pick['name'],
                        'desc' => $pick['desc'],
                        'emoji' => $pick['emoji'],
                        'match' => $pick['match']
                    ];
                }, $profileData['ariaPicks'] ?? [])
            ]
        ]);
    }

    #[Route('/profile/report/export', name: 'profile_report_export', methods: ['GET'])]
    public function exportReport(): Response
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $profileData = $this->profileService->getProfileData($user);

        $loyalty = $profileData['loyalty'] ?? null;
        $loyaltyData = null;
        if ($loyalty) {
            $pts = $loyalty->getTotalPoints();
            $loyaltyData = [
                'points' => $pts,
                'reward' => $this->getRewardForPoints($pts)
            ];
        }

        $reportData = [
            'userName' => $user->getFirstName() . ' ' . $user->getLastName(),
            'generatedDate' => date('F j, Y'),
            'persona' => $profileData['travelPersona'],
            'stats' => [
                'engagement' => $profileData['engagementScore'],
                'minutes' => $profileData['totalMinutes'],
                'visits' => $profileData['pageVisits'],
                'aiChats' => $profileData['aiInteractions'],
            ],
            'insights' => 'Based on your ' . $profileData['pageVisits'] . ' page visits and ' . $profileData['totalMinutes'] . ' minutes spent, we noticed you have a strong preference for ' . strtolower($profileData['travelPersona']) . ' experiences. Keep exploring to unlock more tailored recommendations.',
            'loyalty' => $loyaltyData,
            'picks' => $profileData['ariaPicks'] ?? []
        ];

        // Using Dompdf
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Helvetica');
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('front/report/ai_fiche_pdf.html.twig', [
            'report' => $reportData,
            'user' => $user
        ]);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfOutput = $dompdf->output();
            return new Response($pdfOutput, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="TripX_AI_Fiche_' . $user->getUserId() . '.pdf"'
        ]);
    }

    #[Route('/profile/2fa/setup', name: 'profile_2fa_setup')]
    public function setup2fa(Request $request, GoogleAuthenticator $googleAuthenticator): Response
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        // Generate secret if not exists in session (or user already has it)
        $secret = $user->getGoogleAuthenticatorSecret();
        if (!$secret) {
            $secret = $request->getSession()->get('2fa_setup_secret');
            if (!$secret) {
                $secret = $googleAuthenticator->generateSecret();
                $request->getSession()->set('2fa_setup_secret', $secret);
            }
        }

        // Refetch user and set secret temporarily for QR generation
        $managedUser = $this->entityManager->getRepository(User::class)->find($user->getUserId());
        $managedUser->setGoogleAuthenticatorSecret($secret);

        // Build a standard otpauth URI so authenticator apps read issuer/account consistently.
        $issuer = 'TripX';
        $label = rawurlencode($issuer . ':' . $managedUser->getEmail());
        $qrCodeContent = sprintf(
            'otpauth://totp/%s?secret=%s&issuer=%s&algorithm=SHA1&digits=6&period=30',
            $label,
            rawurlencode($secret),
            rawurlencode($issuer)
        );

        // Generate QR code
        $qrCode = Builder::create()
            ->writer(new PngWriter())
            ->data($qrCodeContent)
            ->size(200)
            ->margin(10)
            ->build();

        return $this->render('front/2fa_setup.html.twig', [
            'qrCode' => $qrCode->getDataUri(),
            'secret' => $secret
        ]);
    }

    #[Route('/profile/2fa/enable', name: 'profile_2fa_enable', methods: ['POST'])]
    public function enable2fa(Request $request, GoogleAuthenticator $googleAuthenticator): JsonResponse
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->json(['success' => false, 'error' => 'Unauthorized']);
        }

        $code = $request->request->get('code');
        $rawCode = $code; // Keep raw for debugging
        if ($code) {
            $code = str_replace([' ', '-'], '', trim($code));
        }
        
        $secret = $user->getGoogleAuthenticatorSecret();
        $isSetup = false;
        
        if (!$secret) {
            $secret = $request->getSession()->get('2fa_setup_secret');
            if (!$secret) {
                return $this->json(['success' => false, 'error' => 'Session expired. Reload page.']);
            }
            $isSetup = true;
        }

        // Refetch user to ensure we have a managed entity
        $managedUser = $this->entityManager->getRepository(User::class)->find($user->getUserId());
        $managedUser->setGoogleAuthenticatorSecret($secret);

        // Check using both the Scheb validator and a local TOTP fallback with a wider drift window.
        $totp = \OTPHP\TOTP::create($secret, 30, 'sha1', 6);
        $bundleCheck = $googleAuthenticator->checkCode($managedUser, $code);
        $localCheck = $totp->verify($code, null, 120);

        if ($bundleCheck || $localCheck) {
            if ($isSetup) {
                $this->entityManager->flush();
                $request->getSession()->remove('2fa_setup_secret');
            }
            return $this->json(['success' => true]);
        }

        $message = 'Invalid code';
        if ($this->getParameter('kernel.environment') === 'dev') {
            $message .= sprintf(
                '. Debug: entered=%s current=%s prev=%s next=%s secret=%s',
                $code ?? 'null',
                $totp->at(time()),
                $totp->at(time() - 30),
                $totp->at(time() + 30),
                $secret
            );
        }

        return $this->json(['success' => false, 'error' => $message]);
    }

    #[Route('/profile/2fa/disable', name: 'profile_2fa_disable', methods: ['POST'])]
    public function disable2fa(): JsonResponse
    {
        $user = $this->getUser();
        $user->setGoogleAuthenticatorSecret(null);
        $this->entityManager->flush();

        return $this->json(['success' => true]);
    }

}
