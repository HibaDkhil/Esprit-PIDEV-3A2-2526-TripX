<?php

namespace App\Controller\admin;

use App\Entity\Booking;
use App\service\BookingService;
use App\service\DestinationService;
use App\service\ActivityService;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\ExpressionLanguage\Expression;

#[Route('/admin/bookings-des', name: 'admin_bookings_des_')]
#[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
class BookingDesController extends AbstractController
{
    private BookingService $bookingService;
    private BookingRepository $bookingRepo;
    private DestinationService $destinationService;
    private ActivityService $activityService;
    private EntityManagerInterface $em;

    public function __construct(
        BookingService $bookingService,
        BookingRepository $bookingRepo,
        DestinationService $destinationService,
        ActivityService $activityService,
        EntityManagerInterface $em,
    ) {
        $this->bookingService = $bookingService;
        $this->bookingRepo = $bookingRepo;
        $this->destinationService = $destinationService;
        $this->activityService = $activityService;
        $this->em = $em;
    }

    /**
     * List all destination/activity bookings with stats.
     */
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $query = $request->query->get('q', '');
        $items = $this->bookingService->getAll($query);

        // Build destination name map for display
        $destNames = [];
        $allDests = $this->destinationService->getAll();
        foreach ($allDests as $d) {
            $destNames[$d->getDestinationId()] = $d->getName();
        }

        // Stats
        $total = count($items);
        $pending = 0;
        $revenue = 0.0;
        foreach ($items as $b) {
            if ($b->getStatus() === 'pending') {
                $pending++;
            }
            if ($b->getStatus() !== 'cancelled') {
                $revenue += (float) $b->getTotalAmount();
            }
        }

        return $this->render('admin/bookings.html.twig', [
            'items' => $items,
            'destNames' => $destNames,
            'currentQuery' => $query,
            'stats' => [
                'total' => $total,
                'pending' => $pending,
                'revenue' => $revenue,
            ],
        ]);
    }

    #[Route('/api/sort', name: 'api_sort', methods: ['GET'])]
    public function sortBookings(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $sort = $request->query->get('sort', 'bookingId');
        $order = $request->query->get('order', 'ASC');
        
        $allowedSorts = ['bookingId', 'status', 'totalAmount', 'bookingDate', 'destinationId', 'activityId'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'bookingId';
        }
        
        $qb = $this->bookingRepo->createQueryBuilder('b')->orderBy('b.' . $sort, $order);
        
        $q = $request->query->get('q');
        if (!empty($q)) {
            $qb->where('b.status LIKE :q OR b.budget LIKE :q')
               ->setParameter('q', '%' . $q . '%');
        }
        
        $bookings = $qb->getQuery()->getResult();
        
        $destNames = [];
        $allDests = $this->destinationService->getAll();
        foreach ($allDests as $d) {
            $destNames[$d->getDestinationId()] = $d->getName();
        }
        
        $data = [];
        foreach ($bookings as $b) {
            $isDest = (bool) $b->getDestinationId();
            $label = $isDest ? 'DESTINATION' : 'ACTIVITY';
            $destName = $destNames[$b->getDestinationId()] ?? 'Unknown';
            if (!$isDest) $destName = 'Activity #' . $b->getActivityId();
            
            $data[] = [
                'id' => $b->getBookingId(),
                'reference' => $b->getBookingReference(),
                'userEmail' => $b->getUserEmail() ?: '—',
                'destName' => $destName,
                'startAt' => $b->getStartAt() ? $b->getStartAt()->format('M d, Y') : '',
                'endAt' => $b->getEndAt() ? $b->getEndAt()->format('M d, Y') : '',
                'numGuests' => $b->getNumGuests(),
                'totalPrice' => $b->getTotalAmount(),
                'status' => $b->getStatus(),
                'url_confirm' => $this->generateUrl('admin_bookings_des_confirm', ['id' => $b->getBookingId()]),
                'url_reject' => $this->generateUrl('admin_bookings_des_reject', ['id' => $b->getBookingId()]),
                'url_delete' => $this->generateUrl('admin_bookings_des_delete', ['id' => $b->getBookingId()]),
            ];
        }
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($data);
    }

    /**
     * Confirm a pending booking.
     */
    #[Route('/{id}/confirm', name: 'confirm', requirements: ['id' => '\d+'])]
    public function confirm(int $id): Response
    {
        $booking = $this->bookingRepo->find($id);
        if (!$booking) {
            $this->addFlash('error', 'Booking not found.');
            return $this->redirectToRoute('admin_bookings_des_index');
        }

        if ($booking->getStatus() !== 'pending') {
            $this->addFlash('error', 'Only pending bookings can be confirmed.');
            return $this->redirectToRoute('admin_bookings_des_index');
        }

        $booking->setStatus('confirmed');
        $this->em->flush();

        $this->addFlash('success', 'Booking #' . $booking->getBookingReference() . ' confirmed.');
        return $this->redirectToRoute('admin_bookings_des_index');
    }

    /**
     * Reject a pending booking.
     */
    #[Route('/{id}/reject', name: 'reject', requirements: ['id' => '\d+'])]
    public function reject(int $id): Response
    {
        $booking = $this->bookingRepo->find($id);
        if (!$booking) {
            $this->addFlash('error', 'Booking not found.');
            return $this->redirectToRoute('admin_bookings_des_index');
        }

        if ($booking->getStatus() !== 'pending') {
            $this->addFlash('error', 'Only pending bookings can be rejected.');
            return $this->redirectToRoute('admin_bookings_des_index');
        }

        $booking->setStatus('cancelled');
        $this->em->flush();

        $this->addFlash('success', 'Booking #' . $booking->getBookingReference() . ' rejected.');
        return $this->redirectToRoute('admin_bookings_des_index');
    }

    /**
     * Delete a booking permanently.
     */
    #[Route('/{id}/delete', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete(int $id): Response
    {
        if ($this->bookingService->delete($id)) {
            $this->addFlash('success', 'Booking deleted.');
        } else {
            $this->addFlash('error', 'Booking not found.');
        }

        return $this->redirectToRoute('admin_bookings_des_index');
    }
}
