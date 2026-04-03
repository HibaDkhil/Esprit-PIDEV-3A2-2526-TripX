<?php

namespace App\service;

use App\Entity\Preference;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class PreferenceService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Saves user preferences and some user metadata.
     */
    public function savePreferences(int $userId, array $data): bool
    {
        $user = $this->em->getRepository(User::class)->find($userId);
        if (!$user) {
            return false;
        }

        // 1. Update User metadata
        if (!empty($data['gender']) && in_array($data['gender'], ['Male', 'Female'])) {
            $user->setGender($data['gender']);
        }
        if (!empty($data['birth_year'])) {
            $user->setBirthYear((string)$data['birth_year']);
        }
        $this->em->persist($user);

        // 2. Update Preference entity
        $pref = $this->em->getRepository(Preference::class)->findOneBy(['userId' => $userId])
             ?? new Preference();

        $pref->setUserId($userId);
        
        $pref->setBudgetMinPerNight(!empty($data['budget_min_per_night']) ? (float)$data['budget_min_per_night'] : null);
        $pref->setBudgetMaxPerNight(!empty($data['budget_max_per_night']) ? (float)$data['budget_max_per_night'] : null);
        
        $arr = fn($v) => is_array($v) ? json_encode($v) : (is_string($v) && (str_starts_with($v, '[') || $v === '[]') ? $v : json_encode([]));

        $pref->setPriorities($arr($data['priorities'] ?? []));
        $pref->setLocationPreferences($arr($data['location_preferences'] ?? []));
        $pref->setAccommodationTypes($arr($data['accommodation_types'] ?? []));
        $pref->setStylePreferences($arr($data['style_preferences'] ?? []));
        $pref->setDietaryRestrictions($arr($data['dietary_restrictions'] ?? []));
        $pref->setPreferredClimate($arr($data['preferred_climate'] ?? []));

        $validPace = ['Relaxed', 'Moderate', 'Fast-paced'];
        $pace = $data['travel_pace'] ?? 'Moderate';
        $pref->setTravelPace(in_array($pace, $validPace) ? $pace : 'Moderate');

        $validGroup = ['Solo', 'Couple', 'Family', 'Friends', 'Business'];
        $group = $data['group_type'] ?? null;
        $pref->setGroupType(in_array($group, $validGroup) ? $group : null);

        $pref->setAccessibilityNeeds(!empty($data['accessibility_needs']) && $data['accessibility_needs'] === true);

        $this->em->persist($pref);
        $this->em->flush();

        return true;
    }

    /**
     * Checks if a user has completed their profile/preferences.
     */
    public function hasCompletedPreferences(int $userId): bool
    {
        $pref = $this->em->getRepository(Preference::class)->findOneBy(['userId' => $userId]);
        return $pref && $pref->getTravelPace();
    }
}
