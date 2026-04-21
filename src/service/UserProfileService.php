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
        $logs  = $this->em->getRepository(UserActivityLog::class)->findBy(
            ['userId' => $user->getUserId()],
            ['timestamp' => 'DESC'],
            200
        );

        // ── Base stats ──────────────────────────────────────────────
        $totalMinutes  = 0;
        $pageVisits    = 0;
        $aiInteractions = 0;
        $activityStats = ['VISIT' => 0, 'SEARCH' => 0, 'BOOKING' => 0, 'AI_FEATURE' => 0, 'NAV' => 0];

        // hourly activity: 0–23
        $hourlyActivity = array_fill(0, 24, 0);

        // top pages
        $pageCount = [];

        // destination clicks
        $destClicks = [];
        $recentSearches = [];
        $pageCategoryCounts = [
            'Home' => 0,
            'Destinations' => 0,
            'Activities' => 0,
            'Offers' => 0,
            'Accommodations' => 0,
            'Transport' => 0,
            'Blog' => 0,
            'Profile' => 0,
            'Other' => 0,
        ];

        foreach ($logs as $log) {
            $type   = $log->getActivityType();
            $target = $log->getTargetId() ?? '';
            $hour   = (int) ($log->getTimestamp() ? $log->getTimestamp()->format('G') : 0);

            $hourlyActivity[$hour]++;

            if ($type === 'TIME_SPENT') {
                $totalMinutes += (int) $target / 60;
            } elseif ($type === 'VISIT') {
                $pageVisits++;
                $activityStats['VISIT']++;
                $pageCount[$target] = ($pageCount[$target] ?? 0) + 1;
                $pageCategory = $this->mapPageCategory($target);
                $pageCategoryCounts[$pageCategory]++;
            } elseif ($type === 'SEARCH') {
                $activityStats['SEARCH']++;
                if (count($recentSearches) < 10 && $target !== '') {
                    $recentSearches[] = [
                        'query' => $this->formatTargetLabel($target),
                        'timestampLabel' => $log->getTimestamp() ? $log->getTimestamp()->format('M d, Y H:i') : 'Unknown',
                    ];
                }
            } elseif ($type === 'BOOKING') {
                $activityStats['BOOKING']++;
            } elseif ($type === 'AI_FEATURE') {
                $activityStats['AI_FEATURE']++;
                $aiInteractions++;
            } elseif ($type === 'NAV') {
                $activityStats['NAV']++;
            } elseif ($type === 'DESTINATION') {
                $destClicks[$target] = ($destClicks[$target] ?? 0) + 1;
            }
        }

        // top 5 pages
        arsort($pageCount);
        $topPages = array_slice($pageCount, 0, 5, true);

        // top 5 destination clicks
        arsort($destClicks);
        $destinationClicks = array_slice($destClicks, 0, 5, true);
        $pageBreakdown = [];
        foreach ($pageCategoryCounts as $label => $count) {
            if ($count > 0) {
                $pageBreakdown[$label] = $count;
            }
        }

        // ── Engagement score (0-100) ─────────────────────────────────
        // Weighted: 40% visits, 30% time, 20% AI use, 10% bookings
        $visitScore   = min(40, $pageVisits * 2);
        $timeScore    = min(30, (int)($totalMinutes / 2));
        $aiScore      = min(20, $aiInteractions * 4);
        $bookingScore = min(10, $activityStats['BOOKING'] * 5);
        $engagementScore = $visitScore + $timeScore + $aiScore + $bookingScore;

        // ── Travel Persona ───────────────────────────────────────────
        $travelPersona = $this->deriveTravelPersona($prefs, $activityStats, $aiInteractions);

        $activityLogsView = [];
        foreach (array_slice($logs, 0, 10) as $log) {
            $activityLogsView[] = [
                'activityType' => (string) $log->getActivityType(),
                'targetLabel' => $this->formatTargetLabel((string) ($log->getTargetId() ?? '')),
                'timestampLabel' => $log->getTimestamp() ? $log->getTimestamp()->format('M d, Y H:i') : 'Unknown',
            ];
        }

        return [
            'user'            => $user,
            'preferences'     => $prefs,
            'prefPriorities'    => $this->decodePrefArray($prefs?->getPriorities()),
            'prefClimate'       => $this->decodePrefArray($prefs?->getPreferredClimate()),
            'prefLocations'     => $this->decodePrefArray($prefs?->getLocationPreferences()),
            'prefAccommodation' => $this->decodePrefArray($prefs?->getAccommodationTypes()),
            'prefStyles'        => $this->decodePrefArray($prefs?->getStylePreferences()),
            'prefDietary'       => $this->decodePrefArray($prefs?->getDietaryRestrictions()),
            'activity_logs'   => array_slice($logs, 0, 10),
            'activityLogsView' => $activityLogsView,
            'recentSearches'  => $recentSearches,
            'totalMinutes'    => round($totalMinutes, 1),
            'pageVisits'      => $pageVisits,
            'activityStats'   => $activityStats,
            'hourlyActivity'  => array_values($hourlyActivity),
            'pageBreakdown'   => $pageBreakdown,
            'topPages'        => $topPages,
            'destinationClicks' => $destinationClicks,
            'aiInteractions'  => $aiInteractions,
            'travelPersona'   => $travelPersona,
            'engagementScore' => min(100, $engagementScore),
            'profileHandle'   => $this->buildProfileHandle($user),
            'profileSidebarBadges' => $this->buildProfileSidebarBadges($prefs, $travelPersona),
            'profileStatBookings' => $activityStats['BOOKING'],
            'profileStatDestinationsTapped' => count($destinationClicks),
            'profileStatMinutes' => (int) round($totalMinutes),
        ];
    }

    private function buildProfileHandle(User $user): string
    {
        $email = (string) ($user->getEmail() ?? '');
        if ($email !== '' && str_contains($email, '@')) {
            $local = strstr($email, '@', true);

            return $local !== false ? $local : strtolower((string) $user->getFirstName()) . $user->getUserId();
        }

        return strtolower((string) $user->getFirstName()) . $user->getUserId();
    }

    /**
     * @return list<string>
     */
    private function buildProfileSidebarBadges(?Preference $prefs, string $travelPersona): array
    {
        $badges = [$travelPersona];
        if ($prefs === null) {
            return array_slice($badges, 0, 3);
        }

        $climates = $this->decodePrefArray($prefs->getPreferredClimate());
        if ($climates !== []) {
            $badges[] = 'Climate: ' . implode(', ', array_slice($climates, 0, 2));
        }

        if ($prefs->getTravelPace()) {
            $badges[] = $prefs->getTravelPace() . ' pace';
        }

        if ($prefs->getGroupType()) {
            $badges[] = $prefs->getGroupType();
        }

        $priorities = $this->decodePrefArray($prefs->getPriorities());
        if ($priorities !== [] && count($badges) < 4) {
            $badges[] = implode(' · ', array_slice($priorities, 0, 2));
        }

        $badges = array_values(array_unique(array_filter($badges)));

        return array_slice($badges, 0, 3);
    }

    private function deriveTravelPersona(?Preference $prefs, array $stats, int $aiUse): string
    {
        if (!$prefs) return 'Free Spirit';

        $pace    = strtolower($prefs->getTravelPace() ?? '');
        $climate = strtolower($prefs->getPreferredClimate() ?? '');
        $group   = strtolower($prefs->getGroupType() ?? '');
        $style   = strtolower($prefs->getStylePreferences() ?? '');

        // AI enthusiast
        if ($aiUse >= 5) return 'AI-Powered Explorer';

        // Luxury
        if ($prefs->getBudgetMinPerNight() >= 200) return 'Luxury Wanderer';

        // Budget backpacker
        if ($prefs->getBudgetMaxPerNight() <= 60) return 'Budget Backpacker';

        // Climate based
        if (str_contains($climate, 'beach') || str_contains($climate, 'tropical')) return 'Beach Seeker';
        if (str_contains($climate, 'mountain') || str_contains($climate, 'cold')) return 'Mountain Soul';

        // Pace based
        if ($pace === 'slow') return 'Slow Travel Connoisseur';
        if ($pace === 'fast') return 'Adrenaline Chaser';

        // Group
        if (str_contains($group, 'family')) return 'Family Adventure Planner';
        if (str_contains($group, 'solo')) return 'Solo Pathfinder';
        if (str_contains($group, 'couple')) return 'Romantic Voyager';

        // Style
        if (str_contains($style, 'culture') || str_contains($style, 'history')) return 'Cultural Wanderer';
        if (str_contains($style, 'food')) return 'Culinary Nomad';

        // Fallback by stats
        if ($stats['SEARCH'] > $stats['VISIT']) return 'Research-Driven Planner';

        return 'Global Nomad';
    }

    private function mapPageCategory(string $target): string
    {
        $value = strtolower(trim($target));
        if ($value === '' || $value === '/' || $value === 'home' || str_contains($value, 'index')) return 'Home';
        if (str_contains($value, 'destination')) return 'Destinations';
        if (str_contains($value, 'activity')) return 'Activities';
        if (str_contains($value, 'offer')) return 'Offers';
        if (str_contains($value, 'accommodation')) return 'Accommodations';
        if (str_contains($value, 'transport')) return 'Transport';
        if (str_contains($value, 'blog')) return 'Blog';
        if (str_contains($value, 'user') || str_contains($value, 'profile')) return 'Profile';
        return 'Other';
    }

    private function formatTargetLabel(string $target): string
    {
        $value = trim($target);
        if ($value === '' || $value === '/') return 'Home';
        $clean = trim($value, '/');
        if ($clean === '') return 'Home';
        $clean = str_replace(['-', '_'], ' ', $clean);
        return ucwords($clean);
    }

    public function updateProfile(User $user, array $data): void
    {
        $user->setFirstName($data['firstName'] ?? $user->getFirstName());
        $user->setLastName($data['lastName'] ?? $user->getLastName());
        $user->setEmail($data['email'] ?? $user->getEmail());
        $user->setPhoneNumber($data['phone'] ?? $user->getPhoneNumber());
        $user->setBio($data['bio'] ?? $user->getBio());
        $this->em->flush();
    }

    public function changePassword(User $user, string $plainPassword): void
    {
        $hashed = $this->hasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashed);
        $this->em->flush();
    }

    public function deleteAccount(User $user): void
    {
        $uid = (int) $user->getUserId();

        // 1. Delete associated activities logs (UserActivityLog)
        $logs = $this->em->getRepository(\App\Entity\UserActivityLog::class)->findBy(['userId' => $uid]);
        foreach ($logs as $log) {
            $this->em->remove($log);
        }

        // 2. Clear related accommodation bookings (BookingAcc)
        $accBookings = $this->em->getRepository(\App\Entity\BookingAcc::class)->findBy(['userId' => $uid]);
        foreach ($accBookings as $b) {
            $this->em->remove($b);
        }

        // 3. Clear related transport bookings (Bookingtrans)
        $transBookings = $this->em->getRepository(\App\Entity\Bookingtrans::class)->findBy(['userId' => $uid]);
        foreach ($transBookings as $b) {
            $this->em->remove($b);
        }

        // 4. Delete preferences
        $preferences = $this->em->getRepository(\App\Entity\Preference::class)->findOneBy(['userId' => $uid]);
        if ($preferences) {
            $this->em->remove($preferences);
        }

        // 5. Delete price alerts
        $alerts = $this->em->getRepository(\App\Entity\PriceAlert::class)->findBy(['userId' => $uid]);
        foreach ($alerts as $a) {
            $this->em->remove($a);
        }

        // 6. Hard delete the user
        $this->em->remove($user);
        $this->em->flush();
    }

    /**
     * @return list<string>
     */
    private function decodePrefArray(?string $json): array
    {
        if ($json === null || $json === '') {
            return [];
        }
        $decoded = json_decode($json, true);
        if (!is_array($decoded)) {
            return [];
        }

        return array_values(array_filter(array_map('strval', $decoded)));
    }
}
