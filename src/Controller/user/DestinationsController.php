<?php

namespace App\Controller\user;

use App\Entity\Booking;
use App\Entity\Review;
use App\Entity\User;
use App\form\BookingFrontType;
use App\form\ReviewType;
use App\service\BookingService;
use App\service\DestinationService;
use App\service\ActivityService;
use App\service\ReviewService;
use App\service\WeatherService;
use App\service\DestinationBookingMailerService;
use Doctrine\ORM\EntityManagerInterface;
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
    private WeatherService $weatherService;
    private ReviewService $reviewService;
    private DestinationBookingMailerService $mailerService;
    private EntityManagerInterface $em;

    public function __construct(
        DestinationService $destinationService,
        ActivityService $activityService,
        BookingService $bookingService,
        ReviewService $reviewService,
        DestinationBookingMailerService $mailerService,
        WeatherService $weatherService,
        EntityManagerInterface $em,
    ) {
        $this->destinationService = $destinationService;
        $this->activityService = $activityService;
        $this->bookingService = $bookingService;
        $this->reviewService = $reviewService;
        $this->mailerService = $mailerService;
        $this->weatherService = $weatherService;
        $this->em = $em;
    }

    /**
     * Destination detail page — shows overview + activities + reviews for this destination.
     */
    #[Route('/destinations/{id}', name: 'destination_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id, \App\service\RestCountriesService $restCountriesService): Response
    {
        $destination = $this->destinationService->find((string) $id);
        if (!$destination) {
            $this->addFlash('error', 'Destination not found.');
            return $this->redirectToRoute('destinations');
        }

        // Get activities linked to this destination
        $activities = $this->activityService->getAll();
        $destActivities = array_filter($activities, fn($a) => $a->getDestinationId() == $id);

        // Get reviews for this destination
        $reviews = $this->reviewService->getByDestination($id);
        $reviewCount = $this->reviewService->countByDestination($id);

        // Build review form for logged-in users
        $reviewForm = null;
        $existingReview = null;
        /** @var User|null $user */
        $user = $this->getUser();
        if ($user) {
            $existingReview = $this->reviewService->findByUserAndDestination($user->getUserId(), $id);
            if (!$existingReview) {
                $review = new Review();
                $reviewForm = $this->createForm(ReviewType::class, $review, [
                    'action' => $this->generateUrl('destination_submit_review', ['id' => $id]),
                ]);
            }
        }

        // Build user name map for reviews
        $userRepo = $this->em->getRepository(User::class);
        $userNames = [];
        foreach ($reviews as $r) {
            if (!isset($userNames[$r->getUserId()])) {
                $u = $userRepo->find($r->getUserId());
                $userNames[$r->getUserId()] = $u ? ($u->getFirstName() . ' ' . $u->getLastName()) : 'Anonymous';
            }
        }

        // Get Weather data
        $weatherData = null;
        if ($destination->getLatitude() && $destination->getLongitude()) {
            $weatherData = $this->weatherService->getWeather(
                (float)$destination->getLatitude(),
                (float)$destination->getLongitude()
            );
        }

        // Get country data from REST Countries API
        $countryData = null;
        if ($destination->getCountry()) {
            $countryData = $restCountriesService->getCountryInfo($destination->getCountry());
        }

        return $this->render('front/destination-detail.html.twig', [
            'destination' => $destination,
            'activities' => $destActivities,
            'reviews' => $reviews,
            'reviewCount' => $reviewCount,
            'reviewForm' => $reviewForm?->createView(),
            'existingReview' => $existingReview,
            'userNames' => $userNames,
            'weather' => $weatherData,
            'countryData' => $countryData,
        ]);
    }

    /**
     * Submit a review for a destination.
     */
    #[Route('/destinations/{id}/review', name: 'destination_submit_review', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function submitReview(int $id, Request $request): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $destination = $this->destinationService->find((string) $id);
        if (!$destination) {
            $this->addFlash('error', 'Destination not found.');
            return $this->redirectToRoute('destinations');
        }

        // Prevent duplicate reviews
        $existing = $this->reviewService->findByUserAndDestination($user->getUserId(), $id);
        if ($existing) {
            $this->addFlash('error', 'You have already reviewed this destination.');
            return $this->redirectToRoute('destination_detail', ['id' => $id]);
        }

        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $review->setDestinationId((string) $id);
            $review->setUserId($user->getUserId());

            $this->reviewService->save($review);
            $this->reviewService->recalculateAverageRating($id);

            $this->addFlash('success', 'Thank you for your review!');
        } else {
            $this->addFlash('error', 'Please correct the errors in your review.');
        }

        return $this->redirectToRoute('destination_detail', ['id' => $id]);
    }

    /**
     * Delete own review.
     */
    #[Route('/destinations/{destId}/review/{id}/delete', name: 'destination_delete_review', requirements: ['destId' => '\d+', 'id' => '\d+'], methods: ['POST'])]
    public function deleteReview(int $destId, int $id, Request $request): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $review = $this->reviewService->find($id);
        if (!$review || $review->getUserId() !== $user->getUserId()) {
            $this->addFlash('error', 'You can only delete your own reviews.');
            return $this->redirectToRoute('destination_detail', ['id' => $destId]);
        }

        $this->reviewService->delete($id);
        $this->reviewService->recalculateAverageRating($destId);

        $this->addFlash('success', 'Your review has been deleted.');
        return $this->redirectToRoute('destination_detail', ['id' => $destId]);
    }

    /**
     * Booking form — GET shows the form, POST processes it.
     */
    #[Route('/destinations/{destinationId}/book', name: 'booking_form', requirements: ['destinationId' => '\d+'], methods: ['GET', 'POST'])]
    public function bookingForm(int $destinationId, Request $request, ValidatorInterface $validator): Response
    {
        $destination = $this->destinationService->find((string) $destinationId);
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
            $booking->setDestinationId((string) $destinationId);
            $booking->setUserId($user->getUserId());
            $booking->setUserEmail($user->getEmail());

            // Calculate total from budget × guests
            $budgetPerPerson = $request->request->get('userBudget', $destination->getEstimatedBudget() ?? 100);
            $total = (float) $budgetPerPerson * max(1, $booking->getNumGuests());
            $booking->setTotalAmount(number_format($total, 2, '.', ''));
            $booking->setCurrency('EUR');

            $this->bookingService->save($booking);

            // Send booking confirmation email via SMTP (Gmail)
            $this->mailerService->sendBookingConfirmation($booking, $destination);

            $this->addFlash('success', 'Booking confirmed! Reference: ' . $booking->getBookingReference());
            return $this->redirectToRoute('my_bookings');
        }

        return $this->render('front/booking_form.html.twig', [
            'destination' => $destination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Download a PDF invoice for a destination booking (user-facing).
     */
    #[Route('/bookings/{id}/invoice', name: 'booking_des_invoice_pdf', requirements: ['id' => '\d+'])]
    public function invoicePdf(int $id): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $booking = $this->bookingService->find($id);
        if (!$booking || $booking->getUserId() !== $user->getUserId()) {
            $this->addFlash('error', 'Booking not found or access denied.');
            return $this->redirectToRoute('my_bookings');
        }

        // Get destination details
        $destination = $booking->getDestinationId()
            ? $this->destinationService->find($booking->getDestinationId())
            : null;

        $html = $this->renderView('pdf/destination_booking_invoice.html.twig', [
            'booking' => $booking,
            'destination' => $destination,
        ]);

        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Helvetica');

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'TripX-Invoice-' . $booking->getBookingReference() . '.pdf';

        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
