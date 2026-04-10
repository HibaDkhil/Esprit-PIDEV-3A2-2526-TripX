<?php

namespace App\service\Accommodation;

use App\Repository\BookingAccRepository;
use Doctrine\ORM\EntityManagerInterface;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;

/**
 * PHP port of Java AccommodationBookingCalendarSyncService.
 *
 * Called automatically by BookingController after status changes:
 *   - CONFIRMED → creates a Google Calendar event
 *   - CANCELLED  → deletes the Google Calendar event
 *   - REJECTED   → deletes the Google Calendar event (if one exists)
 */
class CalendarSyncAccService
{
    private const TIMEZONE      = 'Africa/Tunis';
    private const CHECKIN_HOUR  = 14; // 14:00
    private const CHECKOUT_HOUR = 11; // 11:00

    public function __construct(
        private readonly GoogleCalendarAccService $calendarClient,
        private readonly BookingAccRepository     $bookingRepo,
        private readonly EntityManagerInterface   $em,
    ) {}

    // ── Public API (mirrors Java syncAfterStatusChange) ───────────────

    public function syncAfterStatusChange(int $bookingId, string $targetStatus): void
    {
        $status = strtoupper(trim($targetStatus));

        match ($status) {
            'CONFIRMED' => $this->createEventForConfirmedBooking($bookingId),
            'CANCELLED', 'REJECTED' => $this->deleteEventForBooking($bookingId),
            default => null,   // PENDING — no calendar action needed
        };
    }

    // ── Create event ──────────────────────────────────────────────────

    private function createEventForConfirmedBooking(int $bookingId): void
    {
        $booking = $this->bookingRepo->find($bookingId);
        if (!$booking) { return; }

        if (!$this->calendarClient->isAuthorized()) {
            $this->persistSyncState(
                $bookingId, null, 'FAILED',
                'Google Calendar not connected. Visit /admin/google-acc/authorize.'
            );
            return;
        }

        try {
            $service = $this->calendarClient->getCalendarService();
            $event   = $this->buildEvent($booking);
            $created = $service->events->insert('primary', $event);

            $this->persistSyncState($bookingId, $created->getId(), 'SYNCED', null);

        } catch (\Throwable $e) {
            $this->persistSyncState($bookingId, null, 'FAILED', $this->safeError($e->getMessage()));
        }
    }

    // ── Delete event ──────────────────────────────────────────────────

    private function deleteEventForBooking(int $bookingId): void
    {
        $booking = $this->bookingRepo->find($bookingId);
        if (!$booking) { return; }

        $eventId = $booking->getGoogleCalendarEventId();

        if (!$eventId) {
            // No calendar event was ever created — just clear sync status
            $this->persistSyncState($bookingId, null, 'NOT_SYNCED', null);
            return;
        }

        if (!$this->calendarClient->isAuthorized()) {
            $this->persistSyncState(
                $bookingId, $eventId, 'FAILED',
                'Google Calendar not connected — could not delete event.'
            );
            return;
        }

        try {
            $service = $this->calendarClient->getCalendarService();
            $service->events->delete('primary', $eventId);
            $this->persistSyncState($bookingId, null, 'NOT_SYNCED', null);

        } catch (\Throwable $e) {
            $this->persistSyncState($bookingId, $eventId, 'FAILED', $this->safeError($e->getMessage()));
        }
    }

    // ── Build Google Calendar Event object ────────────────────────────

    private function buildEvent(\App\Entity\BookingAcc $b): Event
    {
        $room = $b->getRoom();
        $acc  = $room?->getAccommodation();

        $summary = sprintf(
            'TripX Booking #%d — %s',
            $b->getId(),
            $acc?->getName() ?? 'Accommodation'
        );

        $description = implode("\n", array_filter([
            'Accommodation: ' . ($acc?->getName()     ?? '—'),
            'City: '          . ($acc?->getCity()     ?? '—'),
            'Room: '          . ($room?->getRoomName() ?? '—'),
            'Room type: '     . ($room?->getRoomType() ?? '—'),
            'Guests: '        . $b->getNumberOfGuests(),
            'Phone: '         . ($b->getPhoneNumber()         ?: '—'),
            'Special requests: ' . ($b->getSpecialRequests()  ?: '—'),
            'Estimated arrival: ' . ($b->getEstimatedArrivalTime() ?: '—'),
            'Total price: €'  . number_format((float) $b->getTotalPrice(), 2),
            'Status: '        . $b->getStatus(),
        ]));

        // Check-in at 14:00, check-out at 11:00 (mirrors Java logic)
        $startDt = $this->toRfc3339($b->getCheckIn(),  self::CHECKIN_HOUR,  0);
        $endDt   = $this->toRfc3339($b->getCheckOut(), self::CHECKOUT_HOUR, 0);

        $start = new EventDateTime();
        $start->setDateTime($startDt);
        $start->setTimeZone(self::TIMEZONE);

        $end = new EventDateTime();
        $end->setDateTime($endDt);
        $end->setTimeZone(self::TIMEZONE);

        $event = new Event();
        $event->setSummary($summary);
        $event->setDescription($description);
        $event->setStart($start);
        $event->setEnd($end);

        return $event;
    }

    // ── Persist sync state to DB ──────────────────────────────────────

    private function persistSyncState(
        int     $bookingId,
        ?string $eventId,
        string  $syncStatus,
        ?string $lastError
    ): void {
        $booking = $this->bookingRepo->find($bookingId);
        if (!$booking) { return; }

        $booking->setGoogleCalendarEventId($eventId);
        $booking->setCalendarSyncStatus($syncStatus);
        $booking->setCalendarLastError($lastError);
        $booking->setCalendarSyncedAt($syncStatus === 'SYNCED' ? new \DateTime() : null);

        try {
            $this->em->flush();
        } catch (\Throwable $e) {
            // Log but don't crash the booking flow
            error_log('CalendarSyncAccService: could not persist sync state — ' . $e->getMessage());
        }
    }

    // ── Helpers ───────────────────────────────────────────────────────

    private function toRfc3339(?\DateTimeInterface $date, int $hour, int $minute): string
    {
        if (!$date) {
            throw new \InvalidArgumentException('Booking date is null — cannot build calendar event.');
        }

        $dt = new \DateTime($date->format('Y-m-d'), new \DateTimeZone(self::TIMEZONE));
        $dt->setTime($hour, $minute);
        return $dt->format(\DateTime::RFC3339);
    }

    private function safeError(string $message): string
    {
        $compact = preg_replace('/\s+/', ' ', trim($message));
        return strlen($compact) > 500 ? substr($compact, 0, 500) : $compact;
    }
}