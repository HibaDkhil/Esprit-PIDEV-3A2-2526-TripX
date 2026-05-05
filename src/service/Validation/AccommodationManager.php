<?php

namespace App\service\Validation;

use App\Entity\Accommodation;

final class AccommodationManager
{
    public function validate(Accommodation $accommodation): bool
    {
        $stars = $accommodation->getStars();
        if ($stars === null || $stars < 1 || $stars > 5) {
            throw new \InvalidArgumentException('Accommodation stars must be between 1 and 5.');
        }

        $latitude = $accommodation->getLatitude();
        $longitude = $accommodation->getLongitude();
        if ($latitude === null || $longitude === null) {
            throw new \InvalidArgumentException('Accommodation coordinates are required.');
        }

        if ((float) $latitude < -90 || (float) $latitude > 90) {
            throw new \InvalidArgumentException('Accommodation latitude must be between -90 and 90.');
        }

        if ((float) $longitude < -180 || (float) $longitude > 180) {
            throw new \InvalidArgumentException('Accommodation longitude must be between -180 and 180.');
        }

        $email = $accommodation->getEmail();
        if ($email === null || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Accommodation email must be valid.');
        }

        $website = $accommodation->getWebsite();
        if ($website === null || filter_var($website, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('Accommodation website must be valid.');
        }

        $phone = $accommodation->getPhone();
        if ($phone === null || preg_match('/^[0-9\+][0-9\s\-\(\)]+$/', $phone) !== 1) {
            throw new \InvalidArgumentException('Accommodation phone number format is invalid.');
        }

        return true;
    }
}
