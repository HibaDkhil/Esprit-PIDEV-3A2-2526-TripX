<?php

namespace App\Tests\Service;

use App\Entity\Offer;
use App\service\Validation\OfferManager;
use PHPUnit\Framework\TestCase;

final class OfferManagerTest extends TestCase
{
    public function testValidOfferPassesValidation(): void
    {
        $offer = (new Offer())
            ->setTitle('Spring Escape')
            ->setDiscountType('PERCENTAGE')
            ->setDiscountValue('20')
            ->setStartDate(new \DateTimeImmutable('-1 day'))
            ->setEndDate(new \DateTimeImmutable('+5 days'));

        self::assertTrue((new OfferManager())->validate($offer));
    }

    public function testOfferRejectsInvalidDateRange(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $offer = (new Offer())
            ->setTitle('Broken Offer')
            ->setDiscountType('PERCENTAGE')
            ->setDiscountValue('20')
            ->setStartDate(new \DateTimeImmutable('+2 days'))
            ->setEndDate(new \DateTimeImmutable('+1 day'));

        (new OfferManager())->validate($offer);
    }

    public function testOfferRejectsPercentageOverOneHundred(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $offer = (new Offer())
            ->setTitle('Too Much Discount')
            ->setDiscountType('PERCENTAGE')
            ->setDiscountValue('150')
            ->setStartDate(new \DateTimeImmutable('-1 day'))
            ->setEndDate(new \DateTimeImmutable('+1 day'));

        (new OfferManager())->validate($offer);
    }
}
