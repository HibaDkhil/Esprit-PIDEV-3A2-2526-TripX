<?php

namespace App\service;

use App\Entity\Booking;
use App\Entity\Destination;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class DestinationBookingMailerService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send a booking confirmation email after a destination booking is created.
     */
    public function sendBookingConfirmation(Booking $booking, Destination $destination): void
    {
        // Overriding recipient for testing as requested
        $recipientEmail = 'meddeb780@gmail.com';
        if (!$recipientEmail) {
            return; // No email address to send to
        }

        $email = (new TemplatedEmail())
            ->from(new Address('comptetest740@gmail.com', 'TripX Destinations'))
            ->to($recipientEmail)
            ->subject('Booking Confirmation — TripX #' . $booking->getBookingReference())
            ->htmlTemplate('emails/destination_booking_confirmation.html.twig')
            ->context([
                'booking' => $booking,
                'destination' => $destination,
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            // Log or silently ignore in dev — the booking is still saved
        }
    }
}
