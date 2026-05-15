<?php

namespace App\Tests\Service;

use App\Entity\Transport;
use App\service\Validation\TransportManager;
use PHPUnit\Framework\TestCase;

final class TransportManagerTest extends TestCase
{
    public function testValidTransportPassesValidation(): void
    {
        $transport = (new Transport())
            ->setTransportType('FLIGHT')
            ->setProviderName('TripX Air')
            ->setVehicleModel('A320')
            ->setBasePrice(220.0)
            ->setCapacity(180)
            ->setAvailableUnits(90)
            ->setSustainabilityRating(4.2);

        self::assertTrue((new TransportManager())->validate($transport));
    }

    public function testTransportRejectsInvalidType(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $transport = (new Transport())
            ->setTransportType('BOAT')
            ->setProviderName('TripX Air')
            ->setVehicleModel('A320')
            ->setBasePrice(220.0)
            ->setCapacity(180)
            ->setAvailableUnits(90)
            ->setSustainabilityRating(4.2);

        (new TransportManager())->validate($transport);
    }

    public function testTransportRejectsAvailableUnitsAboveCapacity(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $transport = (new Transport())
            ->setTransportType('VEHICLE')
            ->setProviderName('TripX Cars')
            ->setVehicleModel('Van')
            ->setBasePrice(120.0)
            ->setCapacity(7)
            ->setAvailableUnits(9)
            ->setSustainabilityRating(3.5);

        (new TransportManager())->validate($transport);
    }
}
