<?php

namespace App\Form;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"CLASS", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class ScheduleFieldsByType extends Constraint
{
    public string $messageFlight = 'Departure and arrival times are mandatory for flights.';
    public string $messageVehicle = 'Rental start and end dates are mandatory for vehicles.';

    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }
}
