<?php

namespace App\Controller\user;

use App\service\AIRecommenderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/blog/ai')]
class AIRecommenderController extends AbstractController
{
    #[Route('/recommend', name: 'blog_ai_recommend', methods: ['POST'])]
    public function recommend(AIRecommenderService $aiService): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['ok' => false, 'message' => 'Please log in to get a recommendation.'], 401);
        }

        $htmlPlan = $aiService->generateTripPlan($user);

        return new JsonResponse([
            'ok' => true,
            'html' => $htmlPlan
        ]);
    }
}
