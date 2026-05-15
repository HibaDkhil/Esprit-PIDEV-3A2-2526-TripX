<?php

namespace App\service\Validation;

use App\Entity\Transport;

final class TransportManager
{
    public function validate(Transport $transport): bool
    {
        if (!in_array($transport->getTransportType(), ['FLIGHT', 'VEHICLE'], true)) {
            throw new \InvalidArgumentException('Transport type must be FLIGHT or VEHICLE.');
        }

        if ($transport->getBasePrice() <= 0) {
            throw new \InvalidArgumentException('Transport base price must be greater than zero.');
        }

        if ($transport->getCapacity() <= 0) {
            throw new \InvalidArgumentException('Transport capacity must be greater than zero.');
        }

        if ($transport->getAvailableUnits() <= 0) {
            throw new \InvalidArgumentException('Transport available units must be greater than zero.');
        }

        if ($transport->getAvailableUnits() > $transport->getCapacity()) {
            throw new \InvalidArgumentException('Transport available units cannot exceed capacity.');
        }

        $rating = $transport->getSustainabilityRating();
        if ($rating < 0 || $rating > 5) {
            throw new \InvalidArgumentException('Transport sustainability rating must be between 0 and 5.');
        }

        return true;
    }
}
