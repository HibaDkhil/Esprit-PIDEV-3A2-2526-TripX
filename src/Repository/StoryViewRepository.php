<?php

namespace App\Repository;

use App\Entity\StoryView;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StoryViewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StoryView::class);
    }

    public function findSeenStoryIdsForViewerAndStories(int $viewerId, array $storyIds): array
    {
        if (empty($storyIds)) {
            return [];
        }

        $rows = $this->createQueryBuilder('sv')
            ->select('IDENTITY(sv.story) AS sid')
            ->leftJoin('sv.viewer', 'v')
            ->where('v.userId = :viewerId')
            ->andWhere('sv.story IN (:storyIds)')
            ->setParameter('viewerId', $viewerId)
            ->setParameter('storyIds', $storyIds)
            ->getQuery()
            ->getArrayResult();

        return array_map(static fn(array $row): int => (int) $row['sid'], $rows);
    }

    public function findViewersForStory(int $storyId, ?int $excludeUserId = null): array
    {
        $qb = $this->createQueryBuilder('sv')
            ->select('sv.seenAt AS seenAt, v.userId AS viewerId, v.firstName AS firstName, v.lastName AS lastName')
            ->leftJoin('sv.viewer', 'v')
            ->where('IDENTITY(sv.story) = :storyId')
            ->setParameter('storyId', $storyId)
            ->orderBy('sv.seenAt', 'DESC');

        if ($excludeUserId !== null) {
            $qb->andWhere('v.userId <> :excludeUserId')
                ->setParameter('excludeUserId', $excludeUserId);
        }

        $rows = $qb->getQuery()->getArrayResult();

        return array_map(static function (array $row): array {
            $fullName = trim((string) ($row['firstName'] ?? '') . ' ' . (string) ($row['lastName'] ?? ''));

            return [
                'viewerId' => (int) $row['viewerId'],
                'name' => $fullName !== '' ? $fullName : 'User #' . (int) $row['viewerId'],
                'seenAt' => $row['seenAt'] instanceof \DateTimeInterface ? $row['seenAt']->format(DATE_ATOM) : null,
            ];
        }, $rows);
    }
}
