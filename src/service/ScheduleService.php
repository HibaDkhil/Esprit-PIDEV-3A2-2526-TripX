<?php
namespace App\service;

use App\Entity\Schedule;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class ScheduleService
{
    private EntityManagerInterface $entityManager;
    private ScheduleRepository $repository;
    private CacheInterface $cache;
    private BookingtransService $bookingtransService;

    public function __construct(
        EntityManagerInterface $entityManager, 
        ScheduleRepository $repository, 
        CacheInterface $cache,
        BookingtransService $bookingtransService
    ) {
        $this->entityManager = $entityManager;
        $this->repository    = $repository;
        $this->cache         = $cache;
        $this->bookingtransService = $bookingtransService;
    }

    public function addSchedule(Schedule $s): void
    {
        $this->entityManager->persist($s);
        $this->entityManager->flush();
        $this->cache->delete('schedules_all');
    }

    public function getAllSchedules(bool &$fromCache = null): array
    {
        $hit = true;
        $data = $this->cache->get('schedules_all', function (ItemInterface $item) use (&$hit) {
            $hit = false;
            $item->expiresAfter(300);
            return $this->repository->findAll();
        });
        if ($fromCache !== null) {
            $fromCache = $hit;
        }
        return $data;
    }

    public function updateSchedule(Schedule $s): void
    {
        $uow = $this->entityManager->getUnitOfWork();
        $uow->computeChangeSets();
        $changeset = $uow->getEntityChangeSet($s);

        $this->entityManager->flush();
        $this->cache->delete('schedules_all');

        // Check if status has changed to notify users
        if (isset($changeset['status'])) {
            $oldStatus = $changeset['status'][0] ?? null;
            $newStatus = $changeset['status'][1] ?? null;

            if ($oldStatus !== $newStatus && in_array($newStatus, ['CANCELLED', 'DELAYED'])) {
                $delayMinutes = ($newStatus === 'DELAYED') ? $s->getDelayMinutes() : null;
                $this->bookingtransService->notifyImpactedUsers($s->getScheduleId(), $newStatus, $delayMinutes);
            }
        }
    }

    public function deleteSchedule(int $id): void
    {
        $schedule = $this->repository->find($id);
        if ($schedule) {
            $this->entityManager->remove($schedule);
            $this->entityManager->flush();
            $this->cache->delete('schedules_all');
        }
    }

    public function getSchedulesByTransportId(int $transportId): array
    {
        return $this->repository->findBy(['transportId' => $transportId]);
    }

    public function getSchedulesByStatus(string $status): array
    {
        return $this->repository->findBy(['status' => $status]);
    }

    public function getSchedulesByTravelClass(string $travelClass): array
    {
        return $this->repository->findBy(['travelClass' => $travelClass]);
    }

    public function findById(int $id): ?Schedule
    {
        return $this->repository->find($id);
    }

    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
    // ★★★ NEW — wraps the repository QB search for the AJAX endpoint ★★★

    public function searchSchedulesByType(

        array  $transportIds,

        string $cls     = '',

        string $depDate = '',

        string $rsStart = '',

        string $rsEnd   = ''

    ): array {

        return $this->repository->searchSchedulesByType(

            $transportIds, $cls, $depDate, $rsStart, $rsEnd

        );

    }

    // ★★★ END NEW ★★★
}