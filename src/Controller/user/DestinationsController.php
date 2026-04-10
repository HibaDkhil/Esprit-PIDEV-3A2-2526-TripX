<?php

namespace App\Controller\user;

use App\Entity\Booking;
use App\Entity\User;
use App\form\BookingFrontType;
use App\service\BookingService;
use App\service\DestinationService;
use App\service\ActivityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DestinationsController extends AbstractController
{
    private DestinationService $destinationService;
    private ActivityService $activityService;
    private BookingService $bookingService;

    public function __construct(
        DestinationService $destinationService,
        ActivityService $activityService,
        BookingService $bookingService,
    ) {
        $this->destinationService = $destinationService;
        $this->activityService = $activityService;
        $this->bookingService = $bookingService;
    }

    /**
     * Destination detail page — shows overview + activities for this destination.
     */
    #[Route('/destinations/{id}', name: 'destination_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id): Response
    {
        $destination = $this->destinationService->find($id);
        if (!$destination) {
            $this->addFlash('error', 'Destination not found.');
            return $this->redirectToRoute('destinations');
        }

        // Get activities linked to this destination
        $activities = $this->activityService->getAll();
        $destActivities = array_filter($activities, fn($a) => $a->getDestinationId() == $id);

        return $this->render('front/destination-detail.html.twig', [
            'destination' => $destination,
            'activities' => $destActivities,
        ]);
    }

    /**
     * Booking form — GET shows the form, POST processes it.
     */
    #[Route('/destinations/{destinationId}/book', name: 'booking_form', requirements: ['destinationId' => '\d+'], methods: ['GET', 'POST'])]
    public function bookingForm(int $destinationId, Request $request, ValidatorInterface $validator): Response
    {
        $destination = $this->destinationService->find($destinationId);
        if (!$destination) {
            $this->addFlash('error', 'Destination not found.');
            return $this->redirectToRoute('destinations');
        }

        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $booking = new Booking();
        $form = $this->createForm(BookingFrontType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set fields not in the form
            $booking->setDestinationId($destinationId);
            $booking->setUserId($user->getUserId());
            $booking->setUserEmail($user->getEmail());

            // Calculate total from budget × guests
            $budgetPerPerson = $request->request->get('userBudget', $destination->getEstimatedBudget() ?? 100);
            $total = (float) $budgetPerPerson * max(1, $booking->getNumGuests());
            $booking->setTotalAmount(number_format($total, 2, '.', ''));
            $booking->setCurrency('EUR');

            $this->bookingService->save($booking);

            $this->addFlash('success', 'Booking confirmed! Reference: ' . $booking->getBookingReference());
            return $this->redirectToRoute('my_bookings');
        }

        return $this->render('front/booking_form.html.twig', [
            'destination' => $destination,
            'form' => $form->createView(),
        ]);
    }
}
