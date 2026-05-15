<?php

namespace App\Tests\Service;

use App\Entity\Accommodation;
use App\service\Validation\AccommodationManager;
use PHPUnit\Framework\TestCase;

final class AccommodationManagerTest extends TestCase
{
    public function testValidAccommodationPassesValidation(): void
    {
        $accommodation = (new Accommodation())
            ->setName('TripX Hotel')
            ->setStars(4)
            ->setLatitude('36.8065')
            ->setLongitude('10.1815')
            ->setEmail('hotel@tripx.tn')
            ->setWebsite('https://tripx.tn/hotel')
            ->setPhone('+216 71 000 000');

        self::assertTrue((new AccommodationManager())->validate($accommodation));
    }

    public function testAccommodationRejectsInvalidStars(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $accommodation = (new Accommodation())
            ->setStars(6)
            ->setLatitude('36.8065')
            ->setLongitude('10.1815')
            ->setEmail('hotel@tripx.tn')
            ->setWebsite('https://tripx.tn/hotel')
            ->setPhone('+216 71 000 000');

        (new AccommodationManager())->validate($accommodation);
    }

    public function testAccommodationRejectsInvalidCoordinates(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $accommodation = (new Accommodation())
            ->setStars(4)
            ->setLatitude('120.0000')
            ->setLongitude('10.1815')
            ->setEmail('hotel@tripx.tn')
            ->setWebsite('https://tripx.tn/hotel')
            ->setPhone('+216 71 000 000');

        (new AccommodationManager())->validate($accommodation);
    }
}
