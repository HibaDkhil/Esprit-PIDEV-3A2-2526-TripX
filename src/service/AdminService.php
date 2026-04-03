<?php

namespace App\service;

use App\Entity\User;
use App\Entity\UserActivityLog;
use Doctrine\ORM\EntityManagerInterface;

class AdminService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getDashboardStats(): array
    {
        $userRepo = $this->em->getRepository(User::class);
        $activityRepo = $this->em->getRepository(UserActivityLog::class);

        return [
            'totalUsers' => $userRepo->count([]),
            'males' => $userRepo->count(['gender' => 'Male']),
            'females' => $userRepo->count(['gender' => 'Female']),
            'totalLogs' => $activityRepo->count([]),
        ];
    }

    public function getAllUsers(string $query = '', string $sortBy = 'userId', string $order = 'ASC'): array
    {
        $qb = $this->em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u');

        if (!empty($query)) {
            $qb->where('u.email LIKE :query OR u.firstName LIKE :query OR u.lastName LIKE :query')
               ->setParameter('query', '%' . $query . '%');
        }

        $qb->orderBy('u.' . $sortBy, $order);

        return $qb->getQuery()->getResult();
    }

    public function banUser(int $id): ?User
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if ($user) {
            $user->setStatus('banned');
            $user->setUpdatedAt(new \DateTime());
            $this->em->flush();
        }
        return $user;
    }

    public function deleteUser(int $id): bool
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if ($user) {
            $this->em->remove($user);
            $this->em->flush();
            return true;
        }
        return false;
    }

    public function updateUserRole(int $id, string $role): ?User
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if ($user) {
            $user->setRole($role);
            $user->setUpdatedAt(new \DateTime());
            $this->em->flush();
        }
        return $user;
    }

    public function updateUser(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }
}
