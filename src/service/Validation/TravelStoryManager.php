<?php

namespace App\service\Validation;

use App\Entity\TravelStory;

final class TravelStoryManager
{
    public function validate(TravelStory $story): bool
    {
        $today = new \DateTimeImmutable('today');
        $startDate = $story->getStartDate();
        $endDate = $story->getEndDate();

        if ($startDate instanceof \DateTimeInterface && $startDate > $today) {
            throw new \InvalidArgumentException('Travel story start date cannot be in the future.');
        }

        if ($endDate instanceof \DateTimeInterface && $endDate > $today) {
            throw new \InvalidArgumentException('Travel story end date cannot be in the future.');
        }

        if ($startDate instanceof \DateTimeInterface && $endDate instanceof \DateTimeInterface && $startDate > $endDate) {
            throw new \InvalidArgumentException('Travel story start date must be before or equal to end date.');
        }

        $budget = $story->getTotalBudget();
        if ($budget !== null && (float) $budget < 0) {
            throw new \InvalidArgumentException('Travel story budget must be positive or zero.');
        }

        return true;
    }
}
