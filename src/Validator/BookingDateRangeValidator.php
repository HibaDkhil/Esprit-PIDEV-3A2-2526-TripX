<?php

namespace App\Validator;

use App\Entity\Booking;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class BookingDateRangeValidator extends ConstraintValidator
{
    /**
     * @param mixed $value The object to validate (Booking)
     * @param Constraint $constraint The constraint (BookingDateRange)
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof BookingDateRange) {
            throw new UnexpectedTypeException($constraint, BookingDateRange::class);
        }

        if (!$value instanceof Booking) {
            return;
        }

        $startAt = $value->getStartAt();
        $endAt = $value->getEndAt();

        // Both dates required for cross-field validation (individual NotBlank handles nulls)
        if (!$startAt || !$endAt) {
            return;
        }

        // Minimum duration: at least 1 day
        $diff = $startAt->diff($endAt);
        $totalDays = $diff->days;

        if ($diff->invert || $totalDays < 1) {
            $this->context->buildViolation($constraint->messageMinDuration)
                ->atPath('endAt')
                ->addViolation();
            return;
        }

        // Maximum duration
        if ($totalDays > $constraint->maxDays) {
            $this->context->buildViolation($constraint->messageMaxDuration)
                ->setParameter('{{ limit }}', (string) $constraint->maxDays)
                ->atPath('endAt')
                ->addViolation();
        }
    }
}
