<?php
namespace App\Controller\admin;

use App\service\TransportService;
use App\service\BookingtransService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/admin/overview')]
class OverviewController extends AbstractController
{
    private TransportService $transportService;
    private BookingtransService $bookingService;
    private HttpClientInterface $httpClient;
    private string $groqApiKey;

    public function __construct(
        TransportService $transportService,
        BookingtransService $bookingService,
        HttpClientInterface $httpClient,
        string $groqApiKey
    ) {
        $this->transportService = $transportService;
        $this->bookingService   = $bookingService;
        $this->httpClient       = $httpClient;
        $this->groqApiKey       = $groqApiKey;
    }

    // ════════════════════════════════
    // MAIN OVERVIEW PAGE
    // ════════════════════════════════

    #[Route('', name: 'admin_overview')]
    public function index(): Response
    {
        $stats = $this->getTransportStats();

        return $this->render('admin/overview.html.twig', [
            'stats' => $stats,
        ]);
    }

    // ════════════════════════════════
    // CHARTS DATA (AJAX)
    // ════════════════════════════════

    #[Route('/charts-data', name: 'admin_overview_charts', methods: ['GET'])]
    public function chartsData(): JsonResponse
    {
        $transports = $this->transportService->getAllTransports();
        $tmap = [];
        foreach ($transports as $t) {
            $tmap[$t->getTransportId()] = $t->getProviderName();
        }

        $bookings = $this->bookingService->getAllBookings();

        // 1. Doughnut Chart: Bookings per status
        $statusCounts = ['CONFIRMED' => 0, 'PENDING' => 0, 'CANCELLED' => 0];

        // 2. Line Chart: Revenue by week (last 8 weeks)
        $revenueByWeek = [];
        $currentDate = new \DateTime();
        // pre-fill the last 8 weeks with 0 revenue to maintain chronological order on the chart
        for ($i = 7; $i >= 0; $i--) {
            $weekLabel = (clone $currentDate)->modify("-$i weeks")->format('W-Y');
            $revenueByWeek[$weekLabel] = 0;
        }

        // 3. Bar Chart: Top 5 providers by confirmed bookings
        $providers = [];

        foreach ($bookings as $b) {
            $status = $b->getBookingStatus();
            if (isset($statusCounts[$status])) {
                $statusCounts[$status]++;
            }

            if ($status === 'CONFIRMED' && $b->getBookingDate()) {
                // Add to weekly revenue
                $weekKey = $b->getBookingDate()->format('W-Y');
                if (isset($revenueByWeek[$weekKey])) {
                    $revenueByWeek[$weekKey] += $b->getTotalPrice();
                }

                // Add to providers count
                $provider = $tmap[$b->getTransportId()] ?? 'Unknown';
                $providers[$provider] = ($providers[$provider] ?? 0) + 1;
            }
        }

        arsort($providers);
        $topProviders = array_slice($providers, 0, 5, true);

        return new JsonResponse([
            'statuses' => $statusCounts,
            'weeklyRevenue' => $revenueByWeek,
            'topProviders' => $topProviders
        ]);
    }

    // ════════════════════════════════
    // AI ANALYZE (AJAX)
    // ════════════════════════════════

    #[Route('/analyze-transport', name: 'admin_overview_analyze', methods: ['POST'])]
    public function analyzeTransport(): JsonResponse
    {
        $stats = $this->getTransportStats();

        if (empty($this->groqApiKey)) {
            return new JsonResponse([
                'success' => false,
                'result'  => 'TRANSPORTAI key not configured in .env file.'
            ]);
        }

        try {
            $result = $this->callGroqTransportApi($stats);
            return new JsonResponse(['success' => true, 'result' => $result]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'result'  => 'Could not reach Groq API. Error: ' . $e->getMessage()
            ]);
        }
    }

    // ════════════════════════════════
    // HELPERS
    // ════════════════════════════════

    private function getTransportStats(): array
    {
        $transports = $this->transportService->getAllTransports();
        $bookings   = $this->bookingService->getAllBookings();

        $confirmed = 0;
        $pending   = 0;
        $cancelled = 0;
        $revenue   = 0.0;

        foreach ($bookings as $b) {
            $status = strtoupper($b->getBookingStatus());
            if ($status === 'CONFIRMED') {
                $confirmed++;
                $revenue += $b->getTotalPrice();
            } elseif ($status === 'PENDING') {
                $pending++;
            } elseif ($status === 'CANCELLED') {
                $cancelled++;
            }
        }

        $total    = count($bookings);
        $vehicles = count($transports);

        $confirmationRate     = $total > 0 ? round($confirmed * 100.0 / $total, 1) : 0;
        $cancellationRate     = $total > 0 ? round($cancelled * 100.0 / $total, 1) : 0;
        $avgRevenuePerBooking = $confirmed > 0 ? round($revenue / $confirmed, 2) : 0;

        return [
            'vehicles'             => $vehicles,
            'total'                => $total,
            'confirmed'            => $confirmed,
            'pending'              => $pending,
            'cancelled'            => $cancelled,
            'revenue'              => round($revenue, 2),
            'confirmationRate'     => $confirmationRate,
            'cancellationRate'     => $cancellationRate,
            'avgRevenuePerBooking' => $avgRevenuePerBooking,
        ];
    }

    private function callGroqTransportApi(array $stats): string
    {
        $prompt = sprintf(
            "You are a transport logistics analyst for TripX, a travel platform. " .
            "Analyze the following transport KPIs and provide 4-5 concise, actionable insights " .
            "and specific recommendations to improve fleet utilization and revenue:\n\n" .
            "• Total vehicles in fleet: %d\n" .
            "• Total bookings received: %d\n" .
            "• Confirmed bookings: %d (%.1f%% confirmation rate)\n" .
            "• Pending bookings: %d\n" .
            "• Cancelled bookings: %d (%.1f%% cancellation rate)\n" .
            "• Total revenue from confirmed bookings: %.2f EUR\n" .
            "• Average revenue per confirmed booking: %.2f EUR\n\n" .
            "Be concise, use bullet points, and focus on reducing cancellations, improving " .
            "confirmation rate, and maximising fleet revenue.",
            $stats['vehicles'],
            $stats['total'],
            $stats['confirmed'], $stats['confirmationRate'],
            $stats['pending'],
            $stats['cancelled'], $stats['cancellationRate'],
            $stats['revenue'],
            $stats['avgRevenuePerBooking']
        );

        $response = $this->httpClient->request('POST', 'https://api.groq.com/openai/v1/chat/completions', [
            'timeout'     => 30,
            'verify_peer' => false,
            'verify_host' => false,
            'headers'     => [
                'Authorization' => 'Bearer ' . trim($this->groqApiKey),
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'model'      => 'llama-3.1-8b-instant',
                'max_tokens' => 450,
                'messages'   => [
                    ['role' => 'user', 'content' => $prompt]
                ],
            ],
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode !== 200) {
            return 'Groq API returned error ' . $statusCode . ': ' . $response->getContent(false);
        }

        $data = $response->toArray();
        return $data['choices'][0]['message']['content'] ?? 'No response from AI.';
    }
}