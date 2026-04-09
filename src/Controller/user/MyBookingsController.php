<?php

namespace App\Controller\user;

use App\service\BookingtransService;
use App\Repository\BookingAccRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyBookingsController extends AbstractController
{
    private BookingtransService $bookingTransService;
    private BookingAccRepository $bookingAccRepo;

    public function __construct(BookingtransService $bookingTransService, BookingAccRepository $bookingAccRepo)
    {
        $this->bookingTransService = $bookingTransService;
        $this->bookingAccRepo = $bookingAccRepo;
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

        $totalSpent = 0;
        $confirmedCount = 0;
        $pendingCount = 0;
        $totalBookings = count($transBookings) + count($accBookings);

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
