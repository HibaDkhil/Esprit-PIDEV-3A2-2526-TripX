<?php

namespace App\service;

use App\Entity\Destination;
use Doctrine\ORM\EntityManagerInterface;

class DestinationService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll(string $query = ''): array
    {
        $qb = $this->em->createQueryBuilder()
            ->select('d')
            ->from(Destination::class, 'd');

        if (!empty($query)) {
            $qb->where('d.name LIKE :query OR d.country LIKE :query OR d.type LIKE :query')
               ->setParameter('query', '%' . $query . '%');
        }

        return $qb->getQuery()->getResult();
    }

    public function find(int $id): ?Destination
    {
        return $this->em->getRepository(Destination::class)->find($id);
    }

    public function delete(int $id): bool
    {
        $dest = $this->find($id);
        if ($dest) {
            $this->em->remove($dest);
            $this->em->flush();
            return true;
        }
        return false;
    }

    public function save(Destination $destination): void
    {
        $this->em->persist($destination);
        $this->em->flush();
    }
}
