<?php

namespace App\service;

use App\Entity\User;
use App\Entity\Preference;
use App\Entity\UserActivityLog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserProfileService
{
    private $em;
    private $hasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $hasher)
    {
        $this->em = $em;
        $this->hasher = $hasher;
    }

    public function getProfileData(User $user): array
    {
        $prefs = $this->em->getRepository(Preference::class)->findOneBy(['userId' => $user->getUserId()]);
        $logs = $this->em->getRepository(UserActivityLog::class)->findBy(['userId' => $user->getUserId()], ['timestamp' => 'DESC'], 50);
        
        $totalMinutes = 0;
        $pageVisits = 0;
        $activityStats = ['VISIT' => 0, 'SEARCH' => 0, 'BOOKING' => 0, 'SOCIAL' => 0];

        foreach ($logs as $log) {
            $type = $log->getActivityType();
            if ($type === 'TIME_SPENT') {
                $totalMinutes += (int)$log->getTargetId() / 60;
            } elseif ($type === 'VISIT') {
                $pageVisits++;
                $activityStats['VISIT']++;
            } elseif (isset($activityStats[$type])) {
                $activityStats[$type]++;
            }
        }

        return [
            'user' => $user,
            'preferences' => $prefs,
            'activity_logs' => array_slice($logs, 0, 5),
            'totalMinutes' => round($totalMinutes, 1),
            'pageVisits' => $pageVisits,
            'activityStats' => $activityStats
        ];
    }

    public function updateProfile(User $user, array $data): void
    {
        $user->setFirstName($data['firstName'] ?? $user->getFirstName());
        $user->setLastName($data['lastName'] ?? $user->getLastName());
        $user->setEmail($data['email'] ?? $user->getEmail());
        $user->setBio($data['bio'] ?? $user->getBio());
        $this->em->flush();
    }

    public function changePassword(User $user, string $plainPassword): void
    {
        $hashed = $this->hasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashed);
        $this->em->flush();
    }
}
