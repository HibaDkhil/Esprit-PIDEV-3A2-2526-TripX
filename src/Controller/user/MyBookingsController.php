<?php

namespace App\Controller\user;

use App\service\BookingtransService;
use App\service\BookingService;
use App\service\DestinationService;
use App\Repository\BookingAccRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyBookingsController extends AbstractController
{
    private BookingtransService $bookingTransService;
    private BookingAccRepository $bookingAccRepo;
    private BookingService $bookingDesService;
    private DestinationService $destinationService;

    public function __construct(
        BookingtransService $bookingTransService,
        BookingAccRepository $bookingAccRepo,
        BookingService $bookingDesService,
        DestinationService $destinationService,
    ) {
        $this->bookingTransService = $bookingTransService;
        $this->bookingAccRepo = $bookingAccRepo;
        $this->bookingDesService = $bookingDesService;
        $this->destinationService = $destinationService;
    }

    #[Route('/my-bookings', name: 'my_bookings')]
    public function index(): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $userId = $user->getUserId();

        // Get Transport Bookings
        $transBookings = $this->bookingTransService->getBookingsByUserId($userId);
        
        // Get Accommodation Bookings
        $accBookings = $this->bookingAccRepo->findBy(['userId' => $userId]);

        // Get Destination/Activity Bookings
        $desBookings = $this->bookingDesService->getByUser($userId);

        // Build destination name map
        $destNameMap = [];
        $allDests = $this->destinationService->getAll();
        foreach ($allDests as $d) {
            $destNameMap[$d->getDestinationId()] = $d->getName();
        }

        $totalSpent = 0;
        $confirmedCount = 0;
        $pendingCount = 0;
        $totalBookings = count($transBookings) + count($accBookings) + count($desBookings);

        foreach ($transBookings as $b) {
            if ($b->getBookingStatus() !== 'CANCELLED') {
                $totalSpent += $b->getTotalPrice();
            }
            if ($b->getBookingStatus() === 'CONFIRMED') $confirmedCount++;
            if ($b->getBookingStatus() === 'PENDING') $pendingCount++;
        }

        foreach ($accBookings as $b) {
            if ($b->getStatus() !== 'CANCELLED' && $b->getStatus() !== 'REJECTED') {
                $totalSpent += $b->getTotalPrice();
            }
            if ($b->getStatus() === 'CONFIRMED') $confirmedCount++;
            if ($b->getStatus() === 'PENDING') $pendingCount++;
        }

        foreach ($desBookings as $b) {
            if ($b->getStatus() !== 'cancelled') {
                $totalSpent += (float) $b->getTotalAmount();
            }
            if ($b->getStatus() === 'confirmed') $confirmedCount++;
            if ($b->getStatus() === 'pending') $pendingCount++;
        }

        // We sort them combined later in twig or here
        $allBookings = [];
        
        foreach ($transBookings as $t) {
            $allBookings[] = [
                'type' => 'transport',
                'id' => $t->getBookingId(),
                'status' => $t->getBookingStatus(),
                'price' => $t->getTotalPrice(),
                'date' => $t->getBookingDate(),
                'entity' => $t
            ];
        }

        foreach ($accBookings as $a) {
            $allBookings[] = [
                'type' => 'accommodation',
                'id' => $a->getId(),
                'status' => $a->getStatus(),
                'price' => $a->getTotalPrice(),
                'date' => $a->getCreatedAt(),
                'entity' => $a
            ];
        }

        foreach ($desBookings as $d) {
            $allBookings[] = [
                'type' => 'destination',
                'id' => $d->getBookingId(),
                'status' => strtoupper($d->getStatus()),
                'price' => (float) $d->getTotalAmount(),
                'date' => $d->getCreatedAt(),
                'entity' => $d,
                'destName' => $destNameMap[$d->getDestinationId()] ?? 'Destination #' . $d->getDestinationId(),
            ];
        }

        usort($allBookings, function($a, $b) {
            if (!$a['date'] || !$b['date']) return 0;
            return $b['date'] <=> $a['date']; // Newest first
        });

        return $this->render('front/my_bookings.html.twig', [
            'totalBookings' => $totalBookings,
            'totalSpent' => $totalSpent,
            'confirmedCount' => $confirmedCount,
            'pendingCount' => $pendingCount,
            'allBookings' => $allBookings,
        ]);
    }
}
