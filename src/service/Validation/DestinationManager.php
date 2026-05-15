<?php

namespace App\service\Validation;

use App\Entity\Destination;

final class DestinationManager
{
    public function validate(Destination $destination): bool
    {
        if (!in_array($destination->getType(), ['city', 'beach', 'mountain', 'countryside', 'desert', 'island', 'forest', 'cruise', 'other'], true)) {
            throw new \InvalidArgumentException('Destination type must be valid.');
        }

        if (!in_array($destination->getBestSeason(), ['spring', 'summer', 'autumn', 'winter', 'all_year'], true)) {
            throw new \InvalidArgumentException('Destination best season must be valid.');
        }

        $latitude = $destination->getLatitude();
        if ($latitude !== null && ((float) $latitude < -90 || (float) $latitude > 90)) {
            throw new \InvalidArgumentException('Destination latitude must be between -90 and 90.');
        }

        $longitude = $destination->getLongitude();
        if ($longitude !== null && ((float) $longitude < -180 || (float) $longitude > 180)) {
            throw new \InvalidArgumentException('Destination longitude must be between -180 and 180.');
        }

        $budget = $destination->getEstimatedBudget();
        if ($budget !== null && (float) $budget < 0) {
            throw new \InvalidArgumentException('Destination estimated budget must be positive or zero.');
        }

        if (($destination->getPopularity() ?? 0) < 0) {
            throw new \InvalidArgumentException('Destination popularity must be positive or zero.');
        }

        return true;
    }
}
