<?php

namespace App\Controller\user;

use App\Entity\UserActivityLog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActivityController extends AbstractController
{
    #[Route('/activity/log', name: 'app_activity_log', methods: ['POST'])]
    public function log(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['success' => false, 'message' => 'Not authenticated'], 401);
        }

        $data = json_decode($request->getContent(), true);
        if (!$data) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid data'], 400);
        }

        $log = new UserActivityLog();
        $log->setUserId($user->getUserId());
        $log->setActivityType($data['activity_type'] ?? 'VISIT');
        $log->setTargetId($data['target_id'] ?? null);
        $log->setTargetType($data['target_type'] ?? 'PAGE');
        $log->setTimestamp(new \DateTime());

        $em->persist($log);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }
}
