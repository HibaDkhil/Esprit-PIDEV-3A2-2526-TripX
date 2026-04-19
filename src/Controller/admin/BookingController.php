<?php

namespace App\Controller\admin;

use App\Entity\BookingAcc;
use App\Repository\BookingAccRepository;
use App\Repository\AccommodationRepository;
use App\service\Accommodation\MlInsightsService;
use App\service\Accommodation\CalendarSyncAccService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;

#[Route('/admin/accommodations/bookings', name: 'admin_accommodations_bookings_')]
class BookingController extends AbstractController
{
    public function __construct(
        private BookingAccRepository    $bookingRepo,
        private AccommodationRepository $accRepo,
        private EntityManagerInterface  $em,
        private MlInsightsService       $mlInsights,
        private CalendarSyncAccService  $calendarSync,
    ) {}

    // ── List page ─────────────────────────────────────────────────────
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $status    = $request->query->get('status', '');
        $search    = $request->query->get('search', '');
        $dateFrom  = $request->query->get('dateFrom', '');
        $dateTo    = $request->query->get('dateTo', '');
        $accFilter = $request->query->get('accommodation', '');

        // Use repository method for filtered bookings
        $bookings = $this->bookingRepo->findFilteredBookings(
            $status ?: null,
            $search ?: null,
            $dateFrom ?: null,
            $dateTo ?: null,
            $accFilter ? (int) $accFilter : null
        );

        // Get counts using repository
        $total     = $this->bookingRepo->count([]);
        $pending   = $this->bookingRepo->count(['status' => 'PENDING']);
        $confirmed = $this->bookingRepo->count(['status' => 'CONFIRMED']);
        $cancelled = $this->bookingRepo->count(['status' => 'CANCELLED']);
        $rejected  = $this->bookingRepo->count(['status' => 'REJECTED']);

        // Get revenue using repository method
        $revenue = $this->bookingRepo->getFilteredRevenue();

        $accommodations = $this->accRepo->findBy([], ['name' => 'ASC']);

        return $this->render('admin/bookingsAcc.html.twig', [
            'bookings'       => $bookings,
            'total'          => $total,
            'pending'        => $pending,
            'confirmed'      => $confirmed,
            'cancelled'      => $cancelled,
            'rejected'       => $rejected,
            'revenue'        => $revenue,
            'accommodations' => $accommodations,
            'filters'        => compact('status', 'search', 'dateFrom', 'dateTo', 'accFilter'),
        ]);
    }

    // ── HTML Dashboard Export (Management Review) ─────────────────────
    #[Route('/export/dashboard', name: 'export_dashboard', methods: ['GET'])]
    public function exportDashboard(Request $request): Response
    {
        $status    = $request->query->get('status', '');
        $search    = $request->query->get('q', '');
        $dateFrom  = $request->query->get('dateFrom', '');
        $dateTo    = $request->query->get('dateTo', '');
        $accFilter = $request->query->get('accommodation', '');

        // Use repository method for filtered bookings
        $bookings = $this->bookingRepo->findFilteredBookings(
            $status ?: null,
            $search ?: null,
            $dateFrom ?: null,
            $dateTo ?: null,
            $accFilter ? (int) $accFilter : null
        );
        
        $bookingsArray = array_map(fn($b) => $this->serializeBooking($b), $bookings);

        return $this->render('admin/bookings_export_dashboard.html.twig', [
            'bookings' => $bookingsArray,
            'filters' => compact('status', 'search', 'dateFrom', 'dateTo', 'accFilter'),
            'generatedAt' => new \DateTime(),
        ]);
    }

    // ── Excel Export (.xlsx) for Data Analysis ────────────────────────
    #[Route('/export/excel', name: 'export_excel', methods: ['GET'])]
    public function exportExcel(Request $request): Response
    {
        $status    = $request->query->get('status', '');
        $search    = $request->query->get('q', '');
        $dateFrom  = $request->query->get('dateFrom', '');
        $dateTo    = $request->query->get('dateTo', '');
        $accFilter = $request->query->get('accommodation', '');

        // Use repository method for filtered bookings
        $bookings = $this->bookingRepo->findFilteredBookings(
            $status ?: null,
            $search ?: null,
            $dateFrom ?: null,
            $dateTo ?: null,
            $accFilter ? (int) $accFilter : null
        );
        
        $bookingsArray = array_map(fn($b) => $this->serializeBooking($b), $bookings);

        $spreadsheet = new Spreadsheet();
        
        // ── Sheet 1: Summary Dashboard ─────────────────────────────────
        $summarySheet = $spreadsheet->getActiveSheet();
        $summarySheet->setTitle('Summary Dashboard');
        
        // Calculate stats
        $totalRevenue = 0;
        $confirmedCount = 0;
        $pendingCount = 0;
        $cancelledCount = 0;
        $rejectedCount = 0;
        
        foreach ($bookingsArray as $b) {
            if ($b['status'] === 'CONFIRMED') {
                $confirmedCount++;
                $totalRevenue += (float)($b['totalPrice'] ?? 0);
            } elseif ($b['status'] === 'PENDING') {
                $pendingCount++;
            } elseif ($b['status'] === 'CANCELLED') {
                $cancelledCount++;
            } elseif ($b['status'] === 'REJECTED') {
                $rejectedCount++;
            }
        }
        
        // Header
        $summarySheet->setCellValue('A1', 'TRIPX BOOKINGS REPORT');
        $summarySheet->mergeCells('A1:D1');
        $summarySheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $summarySheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('7F77DD');
        $summarySheet->getStyle('A1')->getFont()->setColor(new Color(Color::COLOR_WHITE));
        
        $summarySheet->setCellValue('A3', 'Generated:');
        $summarySheet->setCellValue('B3', date('Y-m-d H:i:s'));
        $summarySheet->setCellValue('A4', 'Total Bookings:');
        $summarySheet->setCellValue('B4', count($bookingsArray));
        $summarySheet->setCellValue('A5', 'Total Revenue:');
        $summarySheet->setCellValue('B5', '€' . number_format($totalRevenue, 2));
        
        // KPI Table
        $summarySheet->setCellValue('A7', 'KPI');
        $summarySheet->setCellValue('B7', 'Value');
        $summarySheet->setCellValue('C7', 'Target');
        $summarySheet->setCellValue('D7', 'Status');
        $summarySheet->getStyle('A7:D7')->getFont()->setBold(true);
        $summarySheet->getStyle('A7:D7')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E5E7EB');
        
        $summarySheet->setCellValue('A8', 'Total Revenue');
        $summarySheet->setCellValue('B8', '€' . number_format($totalRevenue, 2));
        $summarySheet->setCellValue('C8', '€' . number_format($totalRevenue * 1.1, 2));
        $summarySheet->setCellValue('D8', $totalRevenue > 50000 ? '✓ Exceeded' : '● On Track');
        
        $summarySheet->setCellValue('A9', 'Confirmed Rate');
        $summarySheet->setCellValue('B9', round(($confirmedCount / max(1, count($bookingsArray))) * 100, 1) . '%');
        $summarySheet->setCellValue('C9', '70%');
        $summarySheet->setCellValue('D9', (($confirmedCount / max(1, count($bookingsArray))) * 100) > 70 ? '✓ Excellent' : '⚠ Low');
        
        $summarySheet->setCellValue('A10', 'Cancellation Rate');
        $summarySheet->setCellValue('B10', round(($cancelledCount / max(1, count($bookingsArray))) * 100, 1) . '%');
        $summarySheet->setCellValue('C10', '<8%');
        $summarySheet->setCellValue('D10', (($cancelledCount / max(1, count($bookingsArray))) * 100) < 8 ? '✓ Good' : '⚠ High');
        
        $summarySheet->getColumnDimension('A')->setWidth(20);
        $summarySheet->getColumnDimension('B')->setWidth(15);
        $summarySheet->getColumnDimension('C')->setWidth(15);
        $summarySheet->getColumnDimension('D')->setWidth(15);
        
        // ── Sheet 2: Accommodation Performance ─────────────────────────
        $accSheet = $spreadsheet->createSheet();
        $accSheet->setTitle('By Accommodation');
        
        // Get accommodation performance from repository
        $accPerformance = $this->bookingRepo->getAccommodationPerformance(
            $status ?: null,
            $search ?: null,
            $dateFrom ?: null,
            $dateTo ?: null,
            $accFilter ? (int) $accFilter : null
        );
        
        $accSheet->setCellValue('A1', 'Accommodation Performance Ranking');
        $accSheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        
        $accSheet->setCellValue('A3', 'Rank');
        $accSheet->setCellValue('B3', 'Accommodation');
        $accSheet->setCellValue('C3', 'Bookings');
        $accSheet->setCellValue('D3', 'Revenue');
        $accSheet->setCellValue('E3', 'Avg Price');
        $accSheet->getStyle('A3:E3')->getFont()->setBold(true);
        $accSheet->getStyle('A3:E3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('7F77DD');
        $accSheet->getStyle('A3:E3')->getFont()->setColor(new Color(Color::COLOR_WHITE));
        
        // Sort by revenue
        uasort($accPerformance, fn($a, $b) => $b['revenue'] <=> $a['revenue']);
        
        $row = 4;
        $rank = 1;
        foreach ($accPerformance as $name => $stats) {
            $avgPrice = $stats['bookings'] > 0 ? $stats['revenue'] / $stats['bookings'] : 0;
            $accSheet->setCellValue('A' . $row, $rank);
            $accSheet->setCellValue('B' . $row, $name);
            $accSheet->setCellValue('C' . $row, $stats['bookings']);
            $accSheet->setCellValue('D' . $row, $stats['revenue']);
            $accSheet->setCellValue('E' . $row, round($avgPrice, 2));
            
            if ($stats['revenue'] > 10000) {
                $accSheet->getStyle('D' . $row)->getFont()->setColor(new Color('006400'));
            }
            $row++;
            $rank++;
        }
        
        foreach (range('A', 'E') as $col) {
            $accSheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // ── Sheet 3: Detailed Bookings ─────────────────────────────────
        $detailsSheet = $spreadsheet->createSheet();
        $detailsSheet->setTitle('Detailed Bookings');
        
        $headers = ['ID', 'Created', 'Accommodation', 'Room', 'Check-in', 'Check-out', 'Guests', 'Total', 'Status', 'Phone'];
        foreach ($headers as $idx => $header) {
            $col = chr(65 + $idx);
            $detailsSheet->setCellValue($col . '1', $header);
        }
        $detailsSheet->getStyle('A1:J1')->getFont()->setBold(true);
        $detailsSheet->getStyle('A1:J1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('7F77DD');
        $detailsSheet->getStyle('A1:J1')->getFont()->setColor(new Color(Color::COLOR_WHITE));
        
        $row = 2;
        foreach ($bookingsArray as $b) {
            $detailsSheet->setCellValue('A' . $row, $b['id']);
            $detailsSheet->setCellValue('B' . $row, $b['createdAt'] ?? '');
            $detailsSheet->setCellValue('C' . $row, $b['accName'] ?? '');
            $detailsSheet->setCellValue('D' . $row, $b['roomName'] ?? '');
            $detailsSheet->setCellValue('E' . $row, $b['checkIn'] ?? '');
            $detailsSheet->setCellValue('F' . $row, $b['checkOut'] ?? '');
            $detailsSheet->setCellValue('G' . $row, $b['numberOfGuests'] ?? 1);
            $detailsSheet->setCellValue('H' . $row, $b['totalPrice'] ?? 0);
            $detailsSheet->setCellValue('I' . $row, $b['status'] ?? '');
            $detailsSheet->setCellValue('J' . $row, $b['phoneNumber'] ?? '');
            
            $status = $b['status'] ?? '';
            if ($status === 'CONFIRMED') {
                $detailsSheet->getStyle('I' . $row)->getFont()->setColor(new Color('006400')); // Dark Green
            } elseif ($status === 'PENDING') {
                $detailsSheet->getStyle('I' . $row)->getFont()->setColor(new Color('FF8C00')); // Dark Orange
            } elseif ($status === 'CANCELLED') {
                $detailsSheet->getStyle('I' . $row)->getFont()->setColor(new Color('808080')); // Gray
            } elseif ($status === 'REJECTED') {
                $detailsSheet->getStyle('I' . $row)->getFont()->setColor(new Color('8B0000')); // Dark Red
            }
            $row++;
        }
        
        foreach (range('A', 'J') as $col) {
            $detailsSheet->getColumnDimension($col)->setAutoSize(true);
        }
        $detailsSheet->freezePane('A2');
        
        // Save and return Excel file
        $writer = new Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), 'bookings_export_');
        $writer->save($tempFile);
        
        $response = new Response(file_get_contents($tempFile));
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment; filename="bookings_report_' . date('Y-m-d_His') . '.xlsx"');
        @unlink($tempFile);
        
        return $response;
    }

    // ── ML Insights AJAX ──────────────────────────────────────────────
    #[Route('/ml-insights', name: 'ml_insights', methods: ['GET'])]
    public function mlInsights(): JsonResponse
    {
        try {
            $snapshot = $this->mlInsights->computeGlobalSnapshot();
            return $this->json(['success' => true, 'data' => $snapshot]);
        } catch (\Throwable $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Search AJAX ───────────────────────────────────────────────────
    #[Route('/search', name: 'search', methods: ['GET'])]
    public function search(Request $request): JsonResponse
    {
        $status    = $request->query->get('status', '');
        $search    = $request->query->get('q', '');
        $dateFrom  = $request->query->get('dateFrom', '');
        $dateTo    = $request->query->get('dateTo', '');
        $accFilter = $request->query->get('accommodation', '');

        // Use repository method for filtered bookings
        $bookings = $this->bookingRepo->findFilteredBookings(
            $status ?: null,
            $search ?: null,
            $dateFrom ?: null,
            $dateTo ?: null,
            $accFilter ? (int) $accFilter : null
        );
        
        $data = array_map(fn($b) => $this->serializeBooking($b), $bookings);

        return $this->json(['bookings' => $data, 'count' => count($data)]);
    }

    // ── View single booking ───────────────────────────────────────────
    #[Route('/{id}', name: 'view', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function view(int $id): JsonResponse
    {
        $b = $this->bookingRepo->find($id);
        if (!$b) { 
            return $this->json(['error' => 'Not found'], 404); 
        }
        return $this->json($this->serializeBooking($b, true));
    }

    // ── Confirm → AUTO-SYNC to Google Calendar ────────────────────────
    #[Route('/{id}/confirm', name: 'confirm', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function confirm(int $id): JsonResponse
    {
        try {
            $b = $this->bookingRepo->find($id);
            if (!$b) { 
                return $this->json(['error' => 'Not found'], 404); 
            }
            if ($b->getStatus() !== 'PENDING') {
                return $this->json(['error' => 'Only pending bookings can be confirmed'], 400);
            }

            $b->setStatus('CONFIRMED');
            $this->em->flush();

            try {
                $this->calendarSync->syncAfterStatusChange($id, 'CONFIRMED');
            } catch (\Throwable $calEx) {
                error_log('Calendar sync error on confirm #' . $id . ': ' . $calEx->getMessage());
            }

            $this->em->refresh($b);

            return $this->json([
                'success'        => true,
                'message'        => 'Booking confirmed and synced to Google Calendar',
                'status'         => 'CONFIRMED',
                'calendarStatus' => $b->getCalendarSyncStatus(),
            ]);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Reject → DELETE Calendar event if exists ──────────────────────
    #[Route('/{id}/reject', name: 'reject', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function reject(int $id, Request $request): JsonResponse
    {
        try {
            $b = $this->bookingRepo->find($id);
            if (!$b) { 
                return $this->json(['error' => 'Not found'], 404); 
            }

            $data   = json_decode($request->getContent(), true) ?? [];
            $reason = $data['reason'] ?? $request->request->get('reason', '');

            $b->setStatus('REJECTED');
            $b->setRejectionReason($reason);
            $b->setRejectedAt(new \DateTime());
            $this->em->flush();

            try {
                $this->calendarSync->syncAfterStatusChange($id, 'REJECTED');
            } catch (\Throwable $calEx) {
                error_log('Calendar sync error on reject #' . $id . ': ' . $calEx->getMessage());
            }

            return $this->json(['success' => true, 'message' => 'Booking rejected', 'status' => 'REJECTED']);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Cancel → DELETE Calendar event ───────────────────────────────
    #[Route('/{id}/cancel', name: 'cancel', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function cancel(int $id, Request $request): JsonResponse
    {
        try {
            $b = $this->bookingRepo->find($id);
            if (!$b) { 
                return $this->json(['error' => 'Not found'], 404); 
            }

            $data   = json_decode($request->getContent(), true) ?? [];
            $reason = $data['reason'] ?? $request->request->get('reason', '');

            $b->setStatus('CANCELLED');
            $b->setCancelReason($reason);
            $b->setCancelledAt(new \DateTime());
            $this->em->flush();

            try {
                $this->calendarSync->syncAfterStatusChange($id, 'CANCELLED');
            } catch (\Throwable $calEx) {
                error_log('Calendar sync error on cancel #' . $id . ': ' . $calEx->getMessage());
            }

            return $this->json(['success' => true, 'message' => 'Booking cancelled', 'status' => 'CANCELLED']);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ── Stats AJAX ────────────────────────────────────────────────────
    #[Route('/stats', name: 'stats', methods: ['GET'])]
    public function stats(Request $request): JsonResponse
    {
        // Get filters from request for filtered stats
        $status    = $request->query->get('status', '');
        $search    = $request->query->get('q', '');
        $dateFrom  = $request->query->get('dateFrom', '');
        $dateTo    = $request->query->get('dateTo', '');
        $accFilter = $request->query->get('accommodation', '');

        // Get counts based on filters
        $total = $this->bookingRepo->countFilteredBookings(
            $status ?: null,
            $search ?: null,
            $dateFrom ?: null,
            $dateTo ?: null,
            $accFilter ? (int) $accFilter : null
        );
        
        // Get status-specific counts with same filters
        $pending = $this->bookingRepo->countFilteredBookings(
            'PENDING',
            $search ?: null,
            $dateFrom ?: null,
            $dateTo ?: null,
            $accFilter ? (int) $accFilter : null
        );
        
        $confirmed = $this->bookingRepo->countFilteredBookings(
            'CONFIRMED',
            $search ?: null,
            $dateFrom ?: null,
            $dateTo ?: null,
            $accFilter ? (int) $accFilter : null
        );
        
        $cancelled = $this->bookingRepo->countFilteredBookings(
            'CANCELLED',
            $search ?: null,
            $dateFrom ?: null,
            $dateTo ?: null,
            $accFilter ? (int) $accFilter : null
        );
        
        $rejected = $this->bookingRepo->countFilteredBookings(
            'REJECTED',
            $search ?: null,
            $dateFrom ?: null,
            $dateTo ?: null,
            $accFilter ? (int) $accFilter : null
        );
        
        // Get revenue based on filters
        $revenue = $this->bookingRepo->getFilteredRevenue(
            $status ?: null,
            $search ?: null,
            $dateFrom ?: null,
            $dateTo ?: null,
            $accFilter ? (int) $accFilter : null
        );

        return $this->json(compact('total', 'pending', 'confirmed', 'cancelled', 'rejected', 'revenue'));
    }

    // ── Serialize helper ──────────────────────────────────────────────
    private function serializeBooking(BookingAcc $b, bool $full = false): array
    {
        $room = $b->getRoom();
        $acc  = $room?->getAccommodation();

        $data = [
            'id'             => $b->getId(),
            'status'         => $b->getStatus(),
            'checkIn'        => $b->getCheckIn()?->format('Y-m-d'),
            'checkOut'       => $b->getCheckOut()?->format('Y-m-d'),
            'totalPrice'     => $b->getTotalPrice(),
            'numberOfGuests' => $b->getNumberOfGuests(),
            'phoneNumber'    => $b->getPhoneNumber(),
            'createdAt'      => $b->getCreatedAt()?->format('Y-m-d H:i'),
            'userId'         => $b->getUserId(),
            'roomName'       => $room?->getRoomName(),
            'roomType'       => $room?->getRoomType(),
            'roomId'         => $room?->getId(),
            'accName'        => $acc?->getName(),
            'accCity'        => $acc?->getCity(),
            'accCountry'     => $acc?->getCountry(),
            'accId'          => $acc?->getId(),
            'calendarStatus' => $b->getCalendarSyncStatus(),
        ];

        if ($full) {
            $data = array_merge($data, [
                'specialRequests'       => $b->getSpecialRequests(),
                'estimatedArrivalTime'  => $b->getEstimatedArrivalTime(),
                'cancelReason'          => $b->getCancelReason(),
                'rejectionReason'       => $b->getRejectionReason(),
                'cancelledAt'           => $b->getCancelledAt()?->format('Y-m-d H:i'),
                'rejectedAt'            => $b->getRejectedAt()?->format('Y-m-d H:i'),
                'googleCalendarEventId' => $b->getGoogleCalendarEventId(),
                'calendarLastError'     => $b->getCalendarLastError(),
                'calendarSyncedAt'      => $b->getCalendarSyncedAt()?->format('Y-m-d H:i'),
                'roomCapacity'          => $room?->getCapacity(),
                'roomPrice'             => $room?->getPricePerNight(),
                'accType'               => $acc?->getType(),
                'accStars'              => $acc?->getStars(),
                'accPhone'              => $acc?->getPhone(),
                'accEmail'              => $acc?->getEmail(),
            ]);
        }

        return $data;
    }
}