<?php

namespace App\service;

use App\Entity\Offer;
use Doctrine\ORM\EntityManagerInterface;

class OfferService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function getAll(string $query = ''): array
    {
        $qb = $this->em->createQueryBuilder()
            ->select('o')
            ->from(Offer::class, 'o');

        if (!empty($query)) {
            $qb->where('o.title LIKE :q OR o.description LIKE :q')
               ->setParameter('q', '%' . $query . '%');
        }

        return $qb->orderBy('o.idOffer', 'DESC')->getQuery()->getResult();
    }

    public function getActiveOffers(): array
    {
        $today = new \DateTime();
        return $this->em->createQueryBuilder()
            ->select('o')
            ->from(Offer::class, 'o')
            ->where('o.isActive = true AND o.startDate <= :today AND o.endDate >= :today')
            ->setParameter('today', $today)
            ->getQuery()->getResult();
    }

    public function getActiveOfferForPack(int $packId): ?Offer
    {
        $today = new \DateTime();
        return $this->em->createQueryBuilder()
            ->select('o')
            ->from(Offer::class, 'o')
            ->where('o.packId = :packId AND o.isActive = true AND o.startDate <= :today AND o.endDate >= :today')
            ->setParameter('packId', $packId)
            ->setParameter('today', $today)
            ->setMaxResults(1)
            ->getQuery()->getOneOrNullResult();
    }

    public function find(int $id): ?Offer
    {
        return $this->em->getRepository(Offer::class)->find($id);
    }

    public function save(Offer $offer): void
    {
        $this->em->persist($offer);
        $this->em->flush();
    }

    public function delete(int $id): bool
    {
        $offer = $this->find($id);
        if ($offer) {
            $this->em->remove($offer);
            $this->em->flush();
            return true;
        }
        return false;
    }

    public function getStats(): array
    {
        $all    = $this->getAll();
        $active = $this->getActiveOffers();
        return [
            'total'  => count($all),
            'active' => count($active),
        ];
    }
}
