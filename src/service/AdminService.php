<?php

namespace App\service;

use App\Entity\User;
use App\Entity\UserActivityLog;
use Doctrine\ORM\EntityManagerInterface;

class AdminService
{
    private $em;
    private $profileService;

    public function __construct(EntityManagerInterface $em, UserProfileService $profileService)
    {
        $this->em = $em;
        $this->profileService = $profileService;
    }

    /**
     * Gathers statistics for the admin dashboard.
     * Fetches counts using the repository layer.
     * 
     * @return array Array consisting of total users, demographic stats, and total logs.
     */
    public function getDashboardStats(): array
    {
        $userRepo = $this->em->getRepository(User::class);
        $activityRepo = $this->em->getRepository(UserActivityLog::class);
        
        $growthByMonth = $userRepo->getUserGrowthByMonth();

        return [
            // Calling custom Query Builder methods from UserRepository
            'totalUsers' => $userRepo->countAllUsers(),
            'males' => $userRepo->countUsersByGender('Male'),
            'females' => $userRepo->countUsersByGender('Female'),
            // Real User Growth
            'growthLabels' => array_keys($growthByMonth),
            'growthData' => array_values($growthByMonth),
            // Global Activity
            'totalLogs' => $activityRepo->count([]),
            'averageMinutes' => $activityRepo->getGlobalAverageTimeSpent(),
        ];
    }

    /**
     * Retrieves a QueryBuilder object for fetching all users with optional filtering and sorting.
     * We pass this QueryBuilder directly to KnpPaginator in the controller.
     * 
     * @param string $query  Search term
     * @param string $sortBy Column to sort by
     * @param string $order  Sort direction (ASC/DESC)
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getAllUsers(string $query = '', string $sortBy = 'userId', string $order = 'ASC'): \Doctrine\ORM\QueryBuilder
    {
        $userRepo = $this->em->getRepository(User::class);
        
        // Delegate the data-fetching logic entirely to the Repository layer (DQL/QB)
        return $userRepo->findAllUsersQueryBuilder($query, $sortBy, $order);
    }

    /**
     * Sets a user's status to 'banned'.
     * 
     * @param int $id The user ID
     * @return User|null The updated user object if found, otherwise null
     */
    public function banUser(int $id): ?User
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if ($user) {
            $user->setStatus('banned');
            $user->setUpdatedAt(new \DateTime());
            $this->em->flush(); // Commit the transaction to the database
        }
        return $user;
    }

    /**
     * Permanently deletes a user from the database.
     * 
     * @param int $id The user ID
     * @return bool True if successfully deleted, false if user not found.
     */
    public function deleteUser(int $id): bool
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if ($user) {
            $this->profileService->deleteAccount($user);
            return true;
        }
        return false;
    }

    /**
     * Updates the user's role.
     * 
     * @param int $id The user ID
     * @param string $role The assigned role (e.g. 'admin')
     * @return User|null The updated user object if found, otherwise null
     */
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

    /**
     * Saves a user entity manually using the EntityManager.
     * 
     * @param User $user The entity object to save
     */
    public function updateUser(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }
}
