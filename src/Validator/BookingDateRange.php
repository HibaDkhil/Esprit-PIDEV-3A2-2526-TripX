<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Custom class-level constraint that enforces business rules on booking date ranges:
 * - End date must be at least 1 day after start date.
 * - Total trip duration must not exceed 90 days.
 *
 * @Annotation
 * @Target({"CLASS", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class BookingDateRange extends Constraint
{
    public string $messageMinDuration = 'The booking must be at least 1 day long.';
    public string $messageMaxDuration = 'A booking cannot exceed {{ limit }} days.';
    public int $maxDays = 90;

    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }
}
