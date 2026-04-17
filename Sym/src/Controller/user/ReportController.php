<?php

namespace App\Controller\user;

use App\Entity\User;
use App\service\UserProfileService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    private $profileService;

    public function __construct(UserProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    #[Route('/profile/report/generate', name: 'profile_report_generate')]
    public function generateReport(): JsonResponse
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return new JsonResponse(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $data = $this->profileService->getProfileData($user);
        $report = $this->buildReportMetadata($data);

        return new JsonResponse([
            'success' => true,
            'report' => $report
        ]);
    }

    #[Route('/profile/report/export', name: 'profile_report_export')]
    public function exportPdf(): Response
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return new Response('Unauthorized', 401);
        }

        $data = $this->profileService->getProfileData($user);
        $report = $this->buildReportMetadata($data);

        $html = $this->renderView('front/report/ai_fiche_pdf.html.twig', [
            'report' => $report,
            'data' => $data,
            'user' => $user
        ]);

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return new Response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="TripX_AI_Behavioral_Report.pdf"'
            ]
        );
    }

    private function buildReportMetadata(array $data): array
    {
        $persona = $data['travelPersona'];
        $user = $data['user'];

        $emojis = [
            'AI-Powered Explorer' => '🤖',
            'Luxury Wanderer' => '💎',
            'Budget Backpacker' => '🎒',
            'Beach Seeker' => '🏖️',
            'Mountain Soul' => '🏔️',
            'Slow Travel Connoisseur' => '☕',
            'Adrenaline Chaser' => '⚡',
            'Family Adventure Planner' => '👨‍👩‍👧',
            'Solo Pathfinder' => '🧭',
            'Romantic Voyager' => '💑',
            'Cultural Wanderer' => '🏛️',
            'Culinary Nomad' => '🍜',
            'Research-Driven Planner' => '📊',
            'Global Nomad' => '🌍',
            'Free Spirit' => '🌈'
        ];

        // Advanced insight generation (simulated intelligence)
        $insights = "Based on your activity of " . $data['pageVisits'] . " interactions, I've observed a strong affinity for " . 
                    ($data['lastPageVisited'] ?? 'exploring new sections') . ". ";
        
        if ($data['aiInteractions'] > 5) {
            $insights .= "You rely heavily on AI assistance, suggesting a tech-forward approach to travel planning. ";
        }
        
        if ($data['totalMinutes'] > 60) {
            $insights .= "Your deep-diving behavior shows you value thorough research and detail. ";
        } else {
            $insights .= "You exhibit a high-efficiency browsing pattern, quickly identifying what matters. ";
        }

        $insights .= "Your preferred style leans towards " . ($data['preferences']?->getStylePreferences() ?? 'Global Exploring') . ".";

        $loyaltyPoints = ($data['engagementScore'] * 10) + ($data['pageVisits'] * 5) + ($data['totalMinutes'] * 2);
        
        $reward = null;
        if ($data['engagementScore'] >= 80) {
            $reward = "Premium Activity Voucher (100% Free)";
        } elseif ($data['engagementScore'] >= 50) {
            $reward = "15% Flight Discount Code";
        } elseif ($data['engagementScore'] >= 20) {
            $reward = "Complimentary Lounge Access";
        } else {
            $reward = "Exclusive Local Travel Guide";
        }

        return [
            'userName' => $user->getFirstName() . ' ' . $user->getLastName(),
            'persona' => $persona,
            'emoji' => $emojis[$persona] ?? '🌍',
            'insights' => $insights,
            'picks' => $data['ariaPicks'],
            'stats' => [
                'engagement' => $data['engagementScore'],
                'minutes' => $data['totalMinutes'],
                'visits' => $data['pageVisits'],
                'aiChats' => $data['aiInteractions']
            ],
            'loyalty' => [
                'points' => $loyaltyPoints,
                'reward' => $reward
            ],
            'generatedDate' => (new \DateTime())->format('M d, Y')
        ];
    }
}
