<?php

namespace App\Controller\user;

use App\Entity\Following;
use App\Entity\User;
use App\Repository\FollowingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FollowController extends AbstractController
{
    // ── Toggle follow / unfollow ─────────────────────────────────────────
    #[Route('/follow/{id}', name: 'follow_toggle', methods: ['POST'])]
    public function toggle(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        FollowingRepository $followingRepo
    ): JsonResponse {
        /** @var User|null $me */
        $me = $this->getUser();

        if (!$me instanceof User) {
            return $this->json(['error' => 'Not logged in'], Response::HTTP_UNAUTHORIZED);
        }

        $myId = (int) $me->getUserId();

        if ($myId === $id) {
            return $this->json(['error' => 'Cannot follow yourself'], Response::HTTP_BAD_REQUEST);
        }

        if (!$this->isCsrfTokenValid('follow_' . $id, $request->request->get('_token'))) {
            return $this->json(['error' => 'Invalid token'], Response::HTTP_FORBIDDEN);
        }

        // Check target user exists
        $target = $em->getRepository(User::class)->find($id);
        if (!$target) {
            return $this->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $existing = $followingRepo->findOneBy([
            'follower_id' => $myId,
            'followed_id' => $id,
        ]);

        if ($existing) {
            $em->remove($existing);
            $em->flush();
            return $this->json([
                'following' => false,
                'status'    => 'none',
                'followerCount'  => $followingRepo->count(['followed_id' => $id, 'status' => Following::STATUS_ACCEPTED]),
                'followingCount' => $followingRepo->count(['follower_id' => $id, 'status' => Following::STATUS_ACCEPTED]),
            ]);
        } else {
            $f = new Following();
            $f->setFollowerId($myId);
            $f->setFollowedId($id);
            $f->setStatus(Following::STATUS_PENDING); // Start as pending
            $f->setCreatedAt(new \DateTime());
            $em->persist($f);
            $em->flush();
            
            return $this->json([
                'following' => true,
                'status'    => 'pending',
                'followerCount'  => $followingRepo->count(['followed_id' => $id, 'status' => Following::STATUS_ACCEPTED]),
                'followingCount' => $followingRepo->count(['follower_id' => $id, 'status' => Following::STATUS_ACCEPTED]),
            ]);
        }
    }

    #[Route('/follow/accept/{id}', name: 'follow_accept', methods: ['POST'])]
    public function acceptRequest(int $id, EntityManagerInterface $em, FollowingRepository $followingRepo): JsonResponse
    {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me) return $this->json(['error' => 'Unauthorized'], 401);

        $request = $followingRepo->findOneBy([
            'followed_id' => (int)$me->getUserId(),
            'follower_id' => $id,
            'status'      => Following::STATUS_PENDING
        ]);

        if (!$request) return $this->json(['error' => 'Request not found'], 404);

        $request->setStatus(Following::STATUS_ACCEPTED);
        $em->flush();

        return $this->json(['success' => true]);
    }

    #[Route('/follow/reject/{id}', name: 'follow_reject', methods: ['POST'])]
    public function rejectRequest(int $id, EntityManagerInterface $em, FollowingRepository $followingRepo): JsonResponse
    {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me) return $this->json(['error' => 'Unauthorized'], 401);

        $request = $followingRepo->findOneBy([
            'followed_id' => (int)$me->getUserId(),
            'follower_id' => $id,
            'status'      => Following::STATUS_PENDING
        ]);

        if (!$request) return $this->json(['error' => 'Request not found'], 404);

        $em->remove($request);
        $em->flush();

        return $this->json(['success' => true]);
    }

    // ── My follower / following stats ────────────────────────────────────
    #[Route('/blog/my-stats', name: 'blog_my_stats', methods: ['GET'])]
    public function myStats(EntityManagerInterface $em, FollowingRepository $followingRepo): JsonResponse
    {
        /** @var User|null $me */
        $me = $this->getUser();

        if (!$me instanceof User) {
            return $this->json(['followers' => 0, 'following' => 0, 'posts' => 0]);
        }

        $myId = (int) $me->getUserId();

        $followers  = $followingRepo->count(['followed_id' => $myId]);
        $following  = $followingRepo->count(['follower_id' => $myId]);

        return $this->json([
            'followers' => $followers,
            'following' => $following,
        ]);
    }

    // ── Check if I follow a specific user ─────────────────────────────────
    #[Route('/follow/{id}/status', name: 'follow_status', methods: ['GET'])]
    public function status(int $id, FollowingRepository $followingRepo): JsonResponse
    {
        /** @var User|null $me */
        $me = $this->getUser();

        if (!$me instanceof User) {
            return $this->json(['following' => false]);
        }

        $existing = $followingRepo->findOneBy([
            'follower_id' => (int) $me->getUserId(),
            'followed_id' => $id,
        ]);

        return $this->json(['following' => $existing !== null]);
    }
}
