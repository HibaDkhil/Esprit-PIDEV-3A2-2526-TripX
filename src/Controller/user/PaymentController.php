<?php

namespace App\Controller\user;

use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaymentController extends AbstractController
{
    #[Route('/payment/checkout/{id}', name: 'payment_checkout')]
    public function checkout(Booking $booking, EntityManagerInterface $em): Response
    {
        // Mock Stripe Secret Key - The user should configure this in .env
        $stripeSecretKey = $_ENV['STRIPE_SECRET_KEY'] ?? 'sk_test_mock_key';
        Stripe::setApiKey($stripeSecretKey);

        $amount = (float) $booking->getTotalAmount();
        
        // If amount is zero (e.g. not set), default to a minimum or handle it
        if ($amount <= 0) {
            $amount = 100.0; // dummy 100
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => strtolower($booking->getCurrency() ?: 'eur'),
                    'product_data' => [
                        'name' => 'Booking ID: ' . $booking->getBookingReference(),
                    ],
                    'unit_amount' => (int) ($amount * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'client_reference_id' => $booking->getId(),
            'success_url' => $this->generateUrl('payment_success', ['id' => $booking->getId()], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('payment_cancel', ['id' => $booking->getId()], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return $this->redirect($session->url, 303);
    }

    #[Route('/payment/success/{id}', name: 'payment_success')]
    public function success(Booking $booking, EntityManagerInterface $em): Response
    {
        $booking->setPaymentStatus('paid');
        $booking->setStatus('confirmed'); // Elevate core status as a result of secure payment

        $em->flush();

        $this->addFlash('success', 'Payment successful! Your destination booking is now confirmed and paid.');
        return $this->redirectToRoute('my_bookings');
    }

    #[Route('/payment/webhook', name: 'payment_webhook')]
    public function webhook(Request $request, EntityManagerInterface $em): Response
    {
        // Simple placeholder webhook for Stripe checkout.session.completed 
        // In reality, verify Stripe-Signature header here
        
        $payload = json_decode($request->getContent(), true);

        if (isset($payload['type']) && $payload['type'] === 'checkout.session.completed') {
            // Retrieve booking ID dynamically from metadata if embedded or via client_reference_id
            $bookingId = $payload['data']['object']['client_reference_id'] ?? null;
            
            if ($bookingId) {
                $booking = $em->getRepository(Booking::class)->find($bookingId);
                if ($booking) {
                    $booking->setPaymentStatus('paid');
                    $booking->setStatus('confirmed');
                    $em->flush();
                }
            }
        }

        return new Response('Webhook received', 200);
    }

    #[Route('/payment/cancel/{id}', name: 'payment_cancel')]
    public function cancel(Booking $booking): Response
    {
        $this->addFlash('error', 'Payment cancelled.');
        return $this->redirectToRoute('my_bookings');
    }
}
