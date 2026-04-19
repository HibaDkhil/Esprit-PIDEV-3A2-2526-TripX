<?php

namespace App\Controller\user;

use App\service\ActivityService;
use App\service\DestinationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivityFrontController extends AbstractController
{
    private ActivityService $activityService;
    private DestinationService $destinationService;

    public function __construct(
        ActivityService $activityService,
        DestinationService $destinationService,
    ) {
        $this->activityService = $activityService;
        $this->destinationService = $destinationService;
    }

    /**
     * Activity detail page — shows full activity info + parent destination.
     */
    #[Route('/activities/{id}', name: 'activity_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id): Response
    {
        $activity = $this->activityService->find($id);
        if (!$activity) {
            $this->addFlash('error', 'Activity not found.');
            return $this->redirectToRoute('activities');
        }

        // Get parent destination if linked
        $destination = null;
        if ($activity->getDestinationId()) {
            $destination = $this->destinationService->find($activity->getDestinationId());
        }

        $destName = $destination ? $destination->getName() : 'Unknown';

        return $this->render('front/activity_detail.html.twig', [
            'activity' => $activity,
            'destination' => $destination,
            'destName' => $destName,
        ]);
    }
}
