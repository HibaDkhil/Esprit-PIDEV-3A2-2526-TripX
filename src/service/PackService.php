<?php

namespace App\service;

use App\Entity\Pack;
use Doctrine\ORM\EntityManagerInterface;

class PackService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function getAll(string $query = ''): array
    {
        $qb = $this->em->createQueryBuilder()
            ->select('p')
            ->from(Pack::class, 'p');

        if (!empty($query)) {
            $qb->where('p.title LIKE :q OR p.description LIKE :q')
               ->setParameter('q', '%' . $query . '%');
        }

        return $qb->orderBy('p.idPack', 'DESC')->getQuery()->getResult();
    }

    public function getActivePacks(): array
    {
        return $this->em->createQueryBuilder()
            ->select('p')
            ->from(Pack::class, 'p')
            ->where('p.status = :s')
            ->setParameter('s', 'ACTIVE')
            ->orderBy('p.idPack', 'DESC')
            ->getQuery()->getResult();
    }

    public function getByCategory(int $categoryId): array
    {
        return $this->em->createQueryBuilder()
            ->select('p')
            ->from(Pack::class, 'p')
            ->where('p.categoryId = :c AND p.status = :s')
            ->setParameter('c', $categoryId)
            ->setParameter('s', 'ACTIVE')
            ->getQuery()->getResult();
    }

    public function find(int $id): ?Pack
    {
        return $this->em->getRepository(Pack::class)->find($id);
    }

    public function save(Pack $pack): void
    {
        $this->em->persist($pack);
        $this->em->flush();
    }

    public function delete(int $id): bool
    {
        $pack = $this->find($id);
        if ($pack) {
            $this->em->remove($pack);
            $this->em->flush();
            return true;
        }
        return false;
    }

    public function getStats(): array
    {
        $all = $this->getAll();
        $active = array_filter($all, fn($p) => $p->getStatus() === 'ACTIVE');
        $prices = array_map(fn($p) => (float) $p->getBasePrice(), $all);

        return [
            'total'     => count($all),
            'active'    => count($active),
            'avg_price' => count($prices) > 0 ? round(array_sum($prices) / count($prices), 2) : 0,
        ];
    }
}
