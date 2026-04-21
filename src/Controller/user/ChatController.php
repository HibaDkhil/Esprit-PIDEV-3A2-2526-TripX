<?php

namespace App\Controller\user;

use App\Entity\User;
use App\Entity\Preference;
use App\Entity\Destination;
use App\Entity\Activity;
use App\Entity\Accommodation;
use App\service\GeminiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\service\UserProfileService;
use App\Entity\Offer;

class ChatController extends AbstractController
{
    #[Route('/api/chat', name: 'api_chat', methods: ['POST'])]
    public function chat(Request $request, GeminiService $gemini, EntityManagerInterface $em, UserProfileService $profileService): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'You must be logged in'], 401);
        }

        $data = json_decode($request->getContent(), true);
        $message = $data['message'] ?? '';
        $image = $data['image'] ?? null;
        $imageMimeType = $data['imageMimeType'] ?? 'image/jpeg';

        if (empty($message) && !$image) {
            return $this->json(['error' => 'No message provided'], 400);
        }

        // Get user preferences
        /** @var Preference|null $preferences */
        $preferences = $em->getRepository(Preference::class)->findOneBy(['userId' => $user->getUserId()]);
        
        // Get destinations from database
        $destinations = $em->getRepository(Destination::class)->findAll();
        $destinationsData = [];
        foreach ($destinations as $dest) {
            $destinationsData[] = [
                'name' => $dest->getName(),
                'country' => $dest->getCountry(),
                'type' => $dest->getType(),
                'estimatedBudget' => $dest->getEstimatedBudget(),
            ];
        }

        // Get activities
        $activities = $em->getRepository(Activity::class)->findAll();
        $activitiesData = [];
        foreach ($activities as $act) {
            $activitiesData[] = [
                'name' => $act->getName(),
                'category' => $act->getCategory(),
                'destinationId' => $act->getDestinationId(),
                'price' => $act->getPrice(),
            ];
        }

        $accommodations = $em->getRepository(Accommodation::class)->findAll();
        $accommodationsData = [];
        foreach ($accommodations as $acc) {
            $accommodationsData[] = [
                'name' => $acc->getName(),
                'city' => $acc->getCity(),
                'country' => $acc->getCountry(),
                'type' => $acc->getType(),
                'stars' => $acc->getStars(),
                'rating' => $acc->getRating(),
            ];
        }

        // Get Offers for recommendations
        //$offers = $em->getRepository(Offer::class)->findAll();
        //$offersData = [];
        //foreach ($offers as $offer) {
            //$offersData[] = [
              //  'title' => $offer->getTitle(),
                //'discount' => $offer->getDiscountPercentage(),
                //'originalPrice' => $offer->getOriginalPrice(),
            //];
        //}

        // Get User Booking History
        // Use getProfileData to access the private getTripHistory data
        $profileData = $profileService->getProfileData($user);
        $tripHistory = $profileData['trips'] ?? [];

        $pageContext = $data['pageContext'] ?? null;
        $history = $data['history'] ?? [];

        $context = [
            'page' => $pageContext,
            'history' => $history,
            'user' => [
                'firstName' => $user->getFirstName(),
                'gender' => $user->getGender(),
                'birthYear' => $user->getBirthYear(),
            ],

            'preferences' => $preferences ? [
                'budgetMinPerNight' => $preferences->getBudgetMinPerNight(),
                'budgetMaxPerNight' => $preferences->getBudgetMaxPerNight(),
                'priorities' => $preferences->getPriorities(),
                'preferredClimate' => $preferences->getPreferredClimate(),
                'travelPace' => $preferences->getTravelPace(),
                'groupType' => $preferences->getGroupType(),
                'accommodationTypes' => $preferences->getAccommodationTypes(),
            ] : [],
            'destinations' => $destinationsData,
            'activities' => $activitiesData,
            'accommodations' => $accommodationsData,
            //'offers' => $offersData,
            'bookingHistory' => $tripHistory,
        ];

        try {
            if ($image) {
                try {
                    $response = $gemini->analyzeImage($image, $message, $imageMimeType);
                } catch (\Throwable $e) {
                    $response = $this->buildBriefOfflineReply($e->getMessage(), $destinationsData, $accommodationsData);
                }

                return $this->json(['response' => $response]);
            }

            // Default: natural conversation via Gemini (TripX data is in the prompt for grounding).
            try {
                $response = $gemini->chat($message, $context);

                return $this->json(['response' => $response]);
            } catch (\Throwable $e) {
                return $this->json([
                    'response' => $this->buildBriefOfflineReply($e->getMessage(), $destinationsData, $accommodationsData),
                    'fallback' => true,
                    'notice' => $e->getMessage(),
                ]);
            }
        } catch (\Throwable $e) {
            return $this->json(['error' => 'TripX assistant error: ' . $e->getMessage()], 500);
        }
    }

    private function buildBriefOfflineReply(string $reason, array $destinationsData, array $accommodationsData): string
    {
        $hint = 'Based on our latest trends, I have some tailored recommendations that might catch your eye! ';

        $place = '';
        if ($destinationsData !== []) {
            $d = $destinationsData[array_rand($destinationsData)];
            $place = sprintf('For instance, we have some breathtaking stays in **%s** (%s) right now. ', $d['name'], $d['country']);
        }

        $acc = '';
        if ($accommodationsData !== []) {
            $sample = array_slice($accommodationsData, 0, 3);
            $names = array_map(fn($a) => $a['name'], $sample);
            $acc = 'Some of our top-rated options include: **' . implode('**, **', $names) . '**.';
        }

        return $hint . $place . $acc . "\n\nFeel free to explore the platform menus to discover even more about these incredible experiences!";
    }



}