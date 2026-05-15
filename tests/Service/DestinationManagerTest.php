<?php

namespace App\Tests\Service;

use App\Entity\Destination;
use App\service\Validation\DestinationManager;
use PHPUnit\Framework\TestCase;

final class DestinationManagerTest extends TestCase
{
    public function testValidDestinationPassesValidation(): void
    {
        $destination = (new Destination())
            ->setName('Rome')
            ->setType('city')
            ->setCountry('Italy')
            ->setCity('Rome')
            ->setBestSeason('spring')
            ->setLatitude('41.9028')
            ->setLongitude('12.4964')
            ->setEstimatedBudget('900.00')
            ->setPopularity(80);

        self::assertTrue((new DestinationManager())->validate($destination));
    }

    public function testDestinationRejectsInvalidType(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $destination = (new Destination())
            ->setName('Rome')
            ->setType('space')
            ->setCountry('Italy')
            ->setCity('Rome')
            ->setBestSeason('spring');

        (new DestinationManager())->validate($destination);
    }

    public function testDestinationRejectsNegativeBudget(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $destination = (new Destination())
            ->setName('Rome')
            ->setType('city')
            ->setCountry('Italy')
            ->setCity('Rome')
            ->setBestSeason('spring')
            ->setEstimatedBudget('-50.00');

        (new DestinationManager())->validate($destination);
    }
}
