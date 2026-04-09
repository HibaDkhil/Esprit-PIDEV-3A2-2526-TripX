<?php
namespace App\service;

use DateTime;

class ValidationService
{
    private const VALID_CLASSES = ['ECONOMY', 'PREMIUM', 'BUSINESS', 'FIRST'];
    private const VALID_BOOKING_STATUS = ['PENDING', 'CONFIRMED', 'CANCELLED'];
    private const VALID_PAYMENT_STATUS = ['UNPAID', 'PAID', 'REFUNDED'];

    public function isPositive(float $value): bool
    {
        return $value > 0;
    }

    public function isValidSeats(int $seats): bool
    {
        return $seats > 0;
    }

    public function isFutureDate(DateTime $date): bool
    {
        return $date !== null && $date > new DateTime();
    }

    public function isValidReturnDate(DateTime $departure, DateTime $arrival): bool
    {
        return $departure !== null && $arrival !== null && $arrival > $departure;
    }

    public function isValidTravelClass(string $travelClass): bool
    {
        return in_array($travelClass, self::VALID_CLASSES);
    }

    public function isValidBookingStatus(string $status): bool
    {
        return in_array($status, self::VALID_BOOKING_STATUS);
    }

    public function isValidPaymentStatus(string $status): bool
    {
        return in_array($status, self::VALID_PAYMENT_STATUS);
    }
}