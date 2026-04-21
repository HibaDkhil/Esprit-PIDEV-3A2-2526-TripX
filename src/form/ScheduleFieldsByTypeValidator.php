<?php

namespace App\Form;

use App\Entity\Schedule;
use App\service\TransportService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ScheduleFieldsByTypeValidator extends ConstraintValidator
{
    private TransportService $transportService;

    public function __construct(TransportService $transportService)
    {
        $this->transportService = $transportService;
    }

    /**
     * @param mixed $value The object to validate (Schedule)
     * @param Constraint $constraint The constraint (ScheduleFieldsByType)
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof ScheduleFieldsByType) {
            throw new UnexpectedTypeException($constraint, ScheduleFieldsByType::class);
        }

        if (!$value instanceof Schedule) {
            return;
        }

        $transportId = $value->getTransportId();
        if ($transportId <= 0) {
            return; // Basic transportId validation will catch this
        }

        $transport = $this->transportService->findById($transportId);
        if (!$transport) {
            return; // Should be handled by other constraints or referential integrity
        }

        $type = $transport->getTransportType();

        if ($type === 'FLIGHT') {
            if (!$value->getDepartureDatetime()) {
                $this->context->buildViolation($constraint->messageFlight)
                    ->atPath('departureDatetime')
                    ->addViolation();
            }
            if (!$value->getArrivalDatetime()) {
                $this->context->buildViolation($constraint->messageFlight)
                    ->atPath('arrivalDatetime')
                    ->addViolation();
            }
        } elseif ($type === 'VEHICLE') {
            if (!$value->getRentalStart()) {
                $this->context->buildViolation($constraint->messageVehicle)
                    ->atPath('rentalStart')
                    ->addViolation();
            }
            if (!$value->getRentalEnd()) {
                $this->context->buildViolation($constraint->messageVehicle)
                    ->atPath('rentalEnd')
                    ->addViolation();
            }
        }
    }
}
