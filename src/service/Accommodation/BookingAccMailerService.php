<?php

namespace App\service\Accommodation;

use App\Entity\BookingAcc;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class BookingAccMailerService
{
    public function __construct(
        private MailerInterface $mailer,
        private UserRepository $userRepo,
        private string $fromEmail,
        private string $fromName,
    ) {}

    // ── Public API ────────────────────────────────────────────────────

    public function sendConfirmation(BookingAcc $booking): void
    {
        $user = $this->resolveUser($booking);
        if (!$user) return;

        $email = $this->buildEmail(
            to:       $user->getEmail(),
            name:     $user->getFirstName() . ' ' . $user->getLastName(),
            subject:  '✅ Booking Confirmed — ' . $this->accName($booking),
            template: 'emails/bookingAcc_confirmed.html.twig',
            context:  $this->buildContext($booking, $user),
        );

        $this->dispatch($email);
    }

    public function sendCancellation(BookingAcc $booking): void
    {
        $user = $this->resolveUser($booking);
        if (!$user) return;

        $email = $this->buildEmail(
            to:       $user->getEmail(),
            name:     $user->getFirstName() . ' ' . $user->getLastName(),
            subject:  '🚫 Booking Cancelled — ' . $this->accName($booking),
            template: 'emails/bookingAcc_cancelled.html.twig',
            context:  $this->buildContext($booking, $user),
        );

        $this->dispatch($email);
    }

    public function sendRejection(BookingAcc $booking): void
    {
        $user = $this->resolveUser($booking);
        if (!$user) return;

        $email = $this->buildEmail(
            to:       $user->getEmail(),
            name:     $user->getFirstName() . ' ' . $user->getLastName(),
            subject:  '❌ Booking Update — ' . $this->accName($booking),
            template: 'emails/bookingAcc_rejected.html.twig',
            context:  $this->buildContext($booking, $user),
        );

        $this->dispatch($email);
    }

    // ── Internals ─────────────────────────────────────────────────────

    private function resolveUser(BookingAcc $booking): ?User
    {
        if (!$booking->getUserId()) return null;
        return $this->userRepo->find($booking->getUserId());
    }

    private function buildEmail(
        string $to,
        string $name,
        string $subject,
        string $template,
        array  $context,
    ): TemplatedEmail {
        return (new TemplatedEmail())
            ->from(new Address($this->fromEmail, $this->fromName))
            ->to(new Address($to, $name))
            ->subject($subject)
            ->htmlTemplate($template)
            ->context($context);
    }

    private function buildContext(BookingAcc $booking, User $user): array
    {
        $room = $booking->getRoom();
        $acc  = $room?->getAccommodation();

        $checkIn  = $booking->getCheckIn();
        $checkOut = $booking->getCheckOut();
        $nights   = ($checkIn && $checkOut)
            ? (int) round(($checkOut->getTimestamp() - $checkIn->getTimestamp()) / 86400)
            : 0;

        return [
            // User
            'userName'        => $user->getFirstName(),
            'userFullName'    => $user->getFirstName() . ' ' . $user->getLastName(),
            'userEmail'       => $user->getEmail(),

            // Booking
            'bookingId'       => $booking->getId(),
            'checkIn'         => $checkIn,
            'checkOut'        => $checkOut,
            'nights'          => $nights,
            'guests'          => $booking->getNumberOfGuests(),
            'totalPrice'      => $booking->getTotalPrice(),
            'phoneNumber'     => $booking->getPhoneNumber(),
            'specialRequests' => $booking->getSpecialRequests(),
            'arrivalTime'     => $booking->getEstimatedArrivalTime(),
            'cancelReason'    => $booking->getCancelReason(),
            'rejectionReason' => $booking->getRejectionReason(),
            'createdAt'       => $booking->getCreatedAt(),

            // Room
            'roomName'        => $room?->getRoomName() ?? '—',
            'roomType'        => $room?->getRoomType() ?? '—',
            'roomCapacity'    => $room?->getCapacity(),
            'roomPrice'       => $room?->getPricePerNight(),

            // Accommodation
            'accName'         => $acc?->getName() ?? '—',
            'accType'         => $acc?->getType() ?? '—',
            'accCity'         => $acc?->getCity() ?? '—',
            'accCountry'      => $acc?->getCountry() ?? '—',
            'accAddress'      => $acc?->getAddress() ?? '—',
            'accPhone'        => $acc?->getPhone() ?? '—',
            'accEmail'        => $acc?->getEmail() ?? '—',
            'accStars'        => $acc?->getStars() ?? 0,
            'accImage'        => $acc?->getImagePath(),

            // Meta
            'year'            => (int) date('Y'),
        ];
    }

    private function accName(BookingAcc $booking): string
    {
        return $booking->getRoom()?->getAccommodation()?->getName() ?? 'Your Booking';
    }

    private function dispatch(TemplatedEmail $email): void
    {
        try {
            $this->mailer->send($email);
            error_log('[BookingAccMailer] Sent OK to: ' . $email->getTo()[0]->getAddress());
        } catch (\Throwable $e) {
            error_log('[BookingAccMailer] FAILED: ' . $e->getMessage());
        }
    }
}