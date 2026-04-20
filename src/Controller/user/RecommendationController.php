<?php

namespace App\Controller\user;

use App\service\RecommendationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecommendationController extends AbstractController
{
    private RecommendationService $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    /**
     * Renders the recommendation page with preference form.
     * On first load (no filters), shows top-rated destinations as initial results.
     */
    #[Route('/destinations/recommendations', name: 'destination_recommendations')]
    public function index(Request $request): Response
    {
        $preferences = $this->extractPreferences($request);

        // If any preference was submitted, use them; otherwise show general top picks
        $hasFilters = !empty($preferences['season'])
                   || !empty($preferences['type'])
                   || !empty($preferences['minRating'])
                   || !empty($preferences['maxBudget']);

        $results = $this->recommendationService->getRecommendations(
            $hasFilters ? $preferences : [],
            12
        );

        return $this->render('front/recommendations.html.twig', [
            'results'     => $results,
            'preferences' => $preferences,
            'hasFilters'  => $hasFilters,
        ]);
    }

    /**
     * JSON API for AJAX-driven recommendation filtering.
     */
    #[Route('/api/destinations/recommendations', name: 'api_destination_recommendations', methods: ['POST'])]
    public function apiRecommendations(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true) ?? [];

        $preferences = [
            'season'    => $data['season'] ?? null,
            'type'      => $data['type'] ?? null,
            'minRating' => isset($data['minRating']) ? (float) $data['minRating'] : null,
            'maxBudget' => isset($data['maxBudget']) ? (float) $data['maxBudget'] : null,
        ];

        $results = $this->recommendationService->getRecommendations($preferences, 12);

        $payload = array_map(function (array $r) {
            /** @var \App\Entity\Destination $dest */
            $dest = $r['destination'];
            return [
                'id'           => $dest->getDestinationId(),
                'name'         => $dest->getName(),
                'country'      => $dest->getCountry(),
                'city'         => $dest->getCity(),
                'type'         => $dest->getType(),
                'bestSeason'   => $dest->getBestSeason(),
                'averageRating'=> $dest->getAverageRating(),
                'popularity'   => $dest->getPopularity(),
                'estimatedBudget' => $dest->getEstimatedBudget(),
                'imageUrl'     => $dest->getImageUrl(),
                'score'        => $r['score'],
                'matchReasons' => $r['matchReasons'],
            ];
        }, $results);

        return new JsonResponse(['results' => $payload]);
    }

    /**
     * Extract preference values from query parameters.
     */
    private function extractPreferences(Request $request): array
    {
        return [
            'season'    => $request->query->get('season'),
            'type'      => $request->query->get('type'),
            'minRating' => $request->query->get('minRating') ? (float) $request->query->get('minRating') : null,
            'maxBudget' => $request->query->get('maxBudget') ? (float) $request->query->get('maxBudget') : null,
        ];
    }
}
