<?php

namespace App\Controller\admin;

use App\Entity\User;
use App\service\ReviewService;
use App\service\DestinationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\ExpressionLanguage\Expression;

#[Route('/admin/reviews', name: 'admin_reviews_')]
#[IsGranted(new Expression("is_granted('ROLE_ADMIN') or is_granted('ROLE_ADMIN_DESTINATION')"))]
class ReviewAdminController extends AbstractController
{
    private ReviewService $reviewService;
    private DestinationService $destinationService;
    private EntityManagerInterface $em;

    public function __construct(
        ReviewService $reviewService,
        DestinationService $destinationService,
        EntityManagerInterface $em,
    ) {
        $this->reviewService = $reviewService;
        $this->destinationService = $destinationService;
        $this->em = $em;
    }

    /**
     * List all reviews with stats.
     */
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        $reviews = $this->reviewService->getAll();

        // Build destination name map
        $destNames = [];
        $allDests = $this->destinationService->getAll();
        foreach ($allDests as $d) {
            $destNames[$d->getDestinationId()] = $d->getName();
        }

        // Build user name map
        $userRepo = $this->em->getRepository(User::class);
        $userNames = [];
        foreach ($reviews as $r) {
            if (!isset($userNames[$r->getUserId()])) {
                $u = $userRepo->find($r->getUserId());
                $userNames[$r->getUserId()] = $u ? ($u->getFirstName() . ' ' . $u->getLastName()) : 'Unknown';
            }
        }

        // Stats
        $totalReviews = count($reviews);
        $totalRating = 0;
        $ratingDistribution = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        foreach ($reviews as $r) {
            $totalRating += $r->getRating();
            $ratingDistribution[$r->getRating()] = ($ratingDistribution[$r->getRating()] ?? 0) + 1;
        }
        $avgRating = $totalReviews > 0 ? round($totalRating / $totalReviews, 2) : 0;

        return $this->render('admin/reviews.html.twig', [
            'reviews' => $reviews,
            'destNames' => $destNames,
            'userNames' => $userNames,
            'stats' => [
                'total' => $totalReviews,
                'average' => $avgRating,
                'distribution' => $ratingDistribution,
            ],
        ]);
    }

    /**
     * Delete a review (admin).
     */
    #[Route('/{id}/delete', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete(int $id): Response
    {
        $review = $this->reviewService->find($id);
        if (!$review) {
            $this->addFlash('error', 'Review not found.');
            return $this->redirectToRoute('admin_reviews_index');
        }

        $destinationId = $review->getDestinationId();
        $this->reviewService->delete($id);
        $this->reviewService->recalculateAverageRating((int) $destinationId);

        $this->addFlash('success', 'Review deleted and average rating recalculated.');
        return $this->redirectToRoute('admin_reviews_index');
    }
}
