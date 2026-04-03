<?php

namespace App\Controller\user;

use App\service\GeminiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestGeminiController extends AbstractController
{
    #[Route('/test-gemini', name: 'test_gemini')]
    public function test(GeminiService $gemini): JsonResponse
    {
        try {
            $response = $gemini->chat("Say hello", []);
            return $this->json(['success' => true, 'response' => $response]);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}