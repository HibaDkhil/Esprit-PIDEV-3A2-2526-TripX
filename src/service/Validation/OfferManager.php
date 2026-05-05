<?php

namespace App\service\Validation;

use App\Entity\Offer;

final class OfferManager
{
    public function validate(Offer $offer): bool
    {
        $startDate = $offer->getStartDate();
        $endDate = $offer->getEndDate();
        if (!$startDate instanceof \DateTimeInterface || !$endDate instanceof \DateTimeInterface) {
            throw new \InvalidArgumentException('Offer dates are required.');
        }

        if ($endDate <= $startDate) {
            throw new \InvalidArgumentException('Offer end date must be after the start date.');
        }

        $discountValue = (float) $offer->getDiscountValue();
        if ($discountValue <= 0) {
            throw new \InvalidArgumentException('Offer discount value must be greater than zero.');
        }

        $discountType = $offer->getDiscountType();
        if (!in_array($discountType, ['PERCENTAGE', 'FIXED'], true)) {
            throw new \InvalidArgumentException('Offer discount type must be supported.');
        }

        if ($discountType === 'PERCENTAGE' && $discountValue > 100) {
            throw new \InvalidArgumentException('Percentage discount cannot exceed 100.');
        }

        return true;
    }
}
