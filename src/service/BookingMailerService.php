<?php
namespace App\service;

use App\Entity\Bookingtrans;
use App\Entity\Transport;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class BookingMailerService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendBookingConfirmation(Bookingtrans $booking, Transport $transport, string $userEmail): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address('no-reply@tripx.com', 'TripX Notifications'))
            ->to($userEmail)
            ->subject('Booking Confirmed: TripX Reservation #' . $booking->getBookingId())
            ->htmlTemplate('emails/booking_confirmed.html.twig')
            ->context([
                'booking' => $booking,
                'transport' => $transport,
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            // Silently ignore mailer errors in dev if MailHog isn't running
        }
    }

    public function sendBookingCancellation(Bookingtrans $booking, Transport $transport, string $reason, string $userEmail): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address('no-reply@tripx.com', 'TripX Notifications'))
            ->to($userEmail)
            ->subject('Booking Cancelled: TripX Reservation #' . $booking->getBookingId())
            ->htmlTemplate('emails/booking_cancelled.html.twig')
            ->context([
                'booking' => $booking,
                'transport' => $transport,
                'reason' => $reason,
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            // Silently ignore mailer errors in dev if MailHog isn't running
        }
    }

    public function sendBookingPending(Bookingtrans $booking, Transport $transport, string $userEmail): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address('no-reply@tripx.com', 'TripX Notifications'))
            ->to($userEmail)
            ->subject('Booking Received (Pending): TripX Reservation #' . $booking->getBookingId())
            ->htmlTemplate('emails/booking_pending.html.twig')
            ->context([
                'booking' => $booking,
                'transport' => $transport,
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            // Silently ignore mailer errors in dev if MailHog isn't running
        }
    }

    public function sendScheduleUpdateNotification(Bookingtrans $booking, Transport $transport, string $updateType, string $userEmail, ?int $delayMinutes = null): void
    {
        $subject = ($updateType === 'CANCELLED') 
            ? 'URGENT: Your TripX Transport Schedule has been Cancelled' 
            : 'UPDATE: Your TripX Transport Schedule is Delayed';

        $email = (new TemplatedEmail())
            ->from(new Address('no-reply@tripx.com', 'TripX Notifications'))
            ->to($userEmail)
            ->subject($subject)
            ->htmlTemplate('emails/schedule_update.html.twig')
            ->context([
                'booking'    => $booking,
                'transport'  => $transport,
                'updateType' => $updateType,
                'delay'      => $delayMinutes,
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            // Silently ignore mailer errors
        }
    }
}
