<?php

namespace App\Repository;

use App\Entity\UserActivityLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserActivityLog>
 */
class UserActivityLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserActivityLog::class);
    }

//    /**
//     * @return UserActivityLog[] Returns an array of UserActivityLog objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserActivityLog
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    /**
     * Calculates the average time spent on the website by users.
     * Selects all TIME_SPENT logs and averages out the durations per active user.
     * 
     * @return int The average time in minutes.
     */
    public function getGlobalAverageTimeSpent(): int
    {
        // We select the raw targetId (which tracks seconds in TIME_SPENT logs) 
        // and the user who triggered it to calculate distinct user average.
        $logs = $this->createQueryBuilder('l')
            ->select('l.targetId, l.userId')
            ->where('l.activityType = :type')
            ->setParameter('type', 'TIME_SPENT')
            ->getQuery()
            ->getArrayResult();

        if (count($logs) === 0) {
            return 0; // No time logged yet
        }

        $totalSeconds = 0;
        $uniqueUsers = [];

        foreach ($logs as $log) {
            // PHP handles numeric coercion smoothly without failing on DB engines
            $totalSeconds += (int) $log['targetId'];
            $uniqueUsers[$log['userId']] = true; // Track unique active users
        }

        $activeUserCount = count($uniqueUsers);
        if ($activeUserCount === 0) return 0;

        $averageSeconds = $totalSeconds / $activeUserCount;
        
        // Convert to minutes
        return (int) round($averageSeconds / 60);
    }
}
