<?php
namespace App\service;

use App\Entity\Schedule;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;

class ScheduleService
{
    private EntityManagerInterface $entityManager;
    private ScheduleRepository $repository;

    public function __construct(EntityManagerInterface $entityManager, ScheduleRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository    = $repository;
    }

    public function addSchedule(Schedule $s): void
    {
        $this->entityManager->persist($s);
        $this->entityManager->flush();
    }

    public function getAllSchedules(): array
    {
        return $this->repository->findAll();
    }

    public function updateSchedule(Schedule $s): void
    {
        $this->entityManager->flush();
    }

    public function deleteSchedule(int $id): void
    {
        $schedule = $this->repository->find($id);
        if ($schedule) {
            $this->entityManager->remove($schedule);
            $this->entityManager->flush();
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