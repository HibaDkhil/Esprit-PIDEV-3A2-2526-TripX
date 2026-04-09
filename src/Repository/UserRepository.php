<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 * 
 * This repository is responsible for handling all database operations 
 * related to the User entity. We keep queries here to maintain clean controllers/services.
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Searches for active users by a search query using Doctrine Query Builder (QB).
     * This is useful for the live AJAX search endpoint.
     * 
     * @param string $query  The user's search text from the frontend
     * @param string $sortBy The column to sort by (default: userId)
     * @param string $order  The direction to sort (ASC or DESC)
     * @return array         An array of User objects matching the criteria
     */
    public function searchByDQL(string $query, string $sortBy = 'userId', string $order = 'ASC'): array
    {
        // 1. Create a QueryBuilder instance aliasing the User table as 'u'
        $qb = $this->createQueryBuilder('u')
            // 2. Add conditions to filter by first name, last name, or email
            ->where('u.firstName LIKE :q')
            ->orWhere('u.lastName LIKE :q')
            ->orWhere('u.email LIKE :q')
            // 3. Bind the actual query value to the :q parameter (protects against SQL injection)
            ->setParameter('q', "%$query%")
            // 4. Sort the result dynamically based on the parameters
            ->orderBy("u.$sortBy", $order);
            
        // 5. Convert the QueryBuilder to a Query, execute it, and return the result array
        return $qb->getQuery()->getResult();
    }

    /**
     * Returns a QueryBuilder for finding all users, filtered and sorted.
     * Returning a QueryBuilder instead of an array allows KnpPaginator to 
     * efficiently paginate results without loading all users into memory.
     * 
     * @param string $query  The text to search for (filters email, firstName, lastName)
     * @param string $sortBy The class property name to sort by
     * @param string $order  The sorting direction (ASC or DESC)
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findAllUsersQueryBuilder(string $query = '', string $sortBy = 'userId', string $order = 'ASC'): \Doctrine\ORM\QueryBuilder
    {
        // Initialize the QueryBuilder ('u' is standard prefix for the entity table alias)
        $qb = $this->createQueryBuilder('u');

        // If the user typed a search query, append conditions using QueryBuilder (QB)
        if (!empty($query)) {
            $qb->andWhere('u.email LIKE :query OR u.firstName LIKE :query OR u.lastName LIKE :query')
               ->setParameter('query', '%' . $query . '%');
        }

        // Apply sorting to the query builder
        $qb->orderBy('u.' . $sortBy, $order);

        // We return the query builder object, avoiding ->getResult(), so KnpPaginator handles execution
        return $qb;
    }

    /**
     * Counts all total users in the database using QueryBuilder.
     * 
     * @return int The total number of users
     */
    public function countAllUsers(): int
    {
        // Equivalent to SELECT COUNT(u.id) FROM User u
        return (int) $this->createQueryBuilder('u')
            ->select('count(u.userId)') // Select only the count
            ->getQuery()
            ->getSingleScalarResult(); // Returns a single numeric value instead of an object/array
    }

    /**
     * Counts users belonging to a specific gender using Query Builder.
     * 
     * @param string $gender The gender to filter by (e.g., 'Male', 'Female')
     * @return int Count of users matching the gender
     */
    public function countUsersByGender(string $gender): int
    {
        return (int) $this->createQueryBuilder('u')
            ->select('count(u.userId)') // We only want the total figure
            ->where('u.gender = :gender') // Condition to filter the gender
            ->setParameter('gender', $gender) // Bind value to prevent SQL injection
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Calculates user growth over the last 6 months.
     * Returns an associative array of ['Month' => Count]
     * 
     * @return array<string, int>
     */
    public function getUserGrowthByMonth(): array
    {
        // Fetch all create dates to agnostically aggregate them in PHP
        // without relying on missing YEAR() or MONTH() doctrine SQL extensions
        $results = $this->createQueryBuilder('u')
            ->select('u.createdAt')
            ->where('u.createdAt IS NOT NULL')
            ->getQuery()
            ->getArrayResult();

        // Initialize last 6 months with 0
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthLabel = (new \DateTime())->modify("-$i months")->format('M Y');
            $chartData[$monthLabel] = 0;
        }

        // Aggregate counts linearly
        foreach ($results as $row) {
            /** @var \DateTimeInterface $date */
            $date = $row['createdAt'];
            $label = $date->format('M Y');
            if (isset($chartData[$label])) {
                $chartData[$label]++;
            }
        }

        return $chartData;
    }
}