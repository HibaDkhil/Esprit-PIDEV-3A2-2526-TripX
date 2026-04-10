<?php

namespace App\Controller\admin;

use App\service\Accommodation\GoogleCalendarAccService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * One-time OAuth setup for Google Calendar (Accommodation module).
 * After the admin visits /authorize once, all syncing is fully automatic.
 *
 * Routes:
 *   GET /admin/google-acc/authorize  → redirect to Google consent screen
 *   GET /admin/google-acc/callback   → receive token, save, done
 *   GET /admin/google-acc/status     → JSON status (for AJAX badge in UI)
 *   POST /admin/google-acc/revoke    → disconnect
 */
#[Route('/admin/google-acc', name: 'admin_google_acc_')]
class GoogleCalendarAccController extends AbstractController
{
    public function __construct(
        private readonly GoogleCalendarAccService $calendarService,
    ) {}

    // ── Status page (shown in bookings page header) ───────────────────
    #[Route('/status', name: 'status', methods: ['GET'])]
    public function status(): Response
    {
        $authorized = $this->calendarService->isAuthorized();
        return $this->json([
            'connected' => $authorized,
            'label'     => $authorized ? 'Google Calendar connected' : 'Google Calendar not connected',
            'authorizeUrl' => $this->generateUrl('admin_google_acc_authorize', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
    }

    // ── Step 1: Redirect admin to Google consent screen ───────────────
    #[Route('/authorize', name: 'authorize', methods: ['GET'])]
    public function authorize(Request $request): Response
    {
        // If already connected, skip
        if ($this->calendarService->isAuthorized()) {
            $this->addFlash('success', '✅ Google Calendar is already connected!');
            return $this->redirectToRoute('admin_accommodations_bookings_index');
        }

        $callbackUrl  = $this->generateUrl('admin_google_acc_callback', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $authUrl      = $this->calendarService->getAuthorizationUrl($callbackUrl);

        return $this->redirect($authUrl);
    }

#[Route('/callback', name: 'callback', methods: ['GET'])]
public function callback(Request $request): Response
{
    // TEMPORARY DEBUG
    $debugFile = $this->getParameter('kernel.project_dir') . '/var/google_debug.txt';
    $code  = $request->query->get('code');
    $error = $request->query->get('error');
    
    file_put_contents($debugFile, date('Y-m-d H:i:s') . "\n");
    file_put_contents($debugFile, "Code: " . substr($code ?? 'null', 0, 30) . "\n", FILE_APPEND);
    file_put_contents($debugFile, "Error: " . ($error ?? 'none') . "\n", FILE_APPEND);
    
    try {
        $callbackUrl = $this->generateUrl('admin_google_acc_callback', [], UrlGeneratorInterface::ABSOLUTE_URL);
        file_put_contents($debugFile, "CallbackURL: " . $callbackUrl . "\n", FILE_APPEND);
        $this->calendarService->exchangeCodeForToken($code, $callbackUrl);
        file_put_contents($debugFile, "SUCCESS - token saved\n", FILE_APPEND);
        $this->addFlash('success', '✅ Connected!');
    } catch (\Throwable $e) {
        file_put_contents($debugFile, "ERROR: " . $e->getMessage() . "\n", FILE_APPEND);
        file_put_contents($debugFile, "TRACE: " . $e->getTraceAsString() . "\n", FILE_APPEND);
        $this->addFlash('error', '❌ ' . $e->getMessage());
    }
    
    return $this->redirectToRoute('admin_accommodations_bookings_index');
}
    // ── Disconnect (optional) ─────────────────────────────────────────
    #[Route('/revoke', name: 'revoke', methods: ['POST'])]
    public function revoke(): Response
    {
        try {
            $this->calendarService->revokeToken();
            $this->addFlash('success', '🔌 Google Calendar disconnected.');
        } catch (\Throwable $e) {
            $this->addFlash('error', '❌ Error revoking token: ' . $e->getMessage());
        }
        return $this->redirectToRoute('admin_accommodations_bookings_index');
    }
}