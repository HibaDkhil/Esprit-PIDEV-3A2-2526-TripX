<?php

namespace App\Tests\Service;

use App\Entity\TravelStory;
use App\service\Validation\TravelStoryManager;
use PHPUnit\Framework\TestCase;

final class TravelStoryManagerTest extends TestCase
{
    public function testValidTravelStoryPassesValidation(): void
    {
        $story = (new TravelStory())
            ->setUserId(1)
            ->setTitle('A Week in Rome')
            ->setStartDate(new \DateTimeImmutable('-7 days'))
            ->setEndDate(new \DateTimeImmutable('-1 day'))
            ->setTotalBudget('1500.00');

        self::assertTrue((new TravelStoryManager())->validate($story));
    }

    public function testTravelStoryRejectsFutureStartDate(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $story = (new TravelStory())
            ->setUserId(1)
            ->setTitle('Future Trip')
            ->setStartDate(new \DateTimeImmutable('+2 days'))
            ->setEndDate(new \DateTimeImmutable('+5 days'));

        (new TravelStoryManager())->validate($story);
    }

    public function testTravelStoryRejectsNegativeBudget(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $story = (new TravelStory())
            ->setUserId(1)
            ->setTitle('Budget Error')
            ->setStartDate(new \DateTimeImmutable('-5 days'))
            ->setEndDate(new \DateTimeImmutable('-3 days'))
            ->setTotalBudget('-10.00');

        (new TravelStoryManager())->validate($story);
    }
}
