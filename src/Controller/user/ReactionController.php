<?php

namespace App\Controller\user;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Reaction;
use App\Entity\TravelStory;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReactionController extends AbstractController
{
    private const ALLOWED = ['like', 'love', 'haha', 'wow', 'sad', 'angry'];

    // ── POST reaction ────────────────────────────────────────────────────
    #[Route('/post/{id}/react/{type}', name: 'post_react', methods: ['POST'])]
    public function reactToPost(
        int $id,
        string $type,
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user instanceof User) {
            return $this->json(['error' => 'Not logged in'], Response::HTTP_UNAUTHORIZED);
        }

        if (!in_array($type, self::ALLOWED, true)) {
            return $this->json(['error' => 'Invalid reaction'], Response::HTTP_BAD_REQUEST);
        }

        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            return $this->json(['error' => 'Post not found'], Response::HTTP_NOT_FOUND);
        }

        $userId = (int) $user->getId();
        $repo   = $em->getRepository(Reaction::class);

        $existing = $repo->findOneBy(['user_id' => $userId, 'post_id' => $id]);

        $userReaction = null;

        if ($existing) {
            if ($existing->getType() === $type) {
                // Same reaction → remove (toggle off)
                $em->remove($existing);
            } else {
                // Different reaction → update
                $existing->setType($type);
                $userReaction = $type;
            }
        } else {
            $r = new Reaction();
            $r->setUserId($userId);
            $r->setPostId($id);
            $r->setType($type);
            $em->persist($r);
            $userReaction = $type;
        }

        $em->flush();

        return $this->json([
            'userReaction' => $userReaction,
            'counts'       => $this->countsByPost($em, $id),
        ]);
    }

    // ── TRAVEL STORY reaction ────────────────────────────────────────────────
    #[Route('/travel-story/{id}/react/{type}', name: 'travel_story_react', methods: ['POST'])]
    public function reactToTravelStory(
        int $id,
        string $type,
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user instanceof User) {
            return $this->json(['error' => 'Not logged in'], Response::HTTP_UNAUTHORIZED);
        }

        if (!in_array($type, self::ALLOWED, true)) {
            return $this->json(['error' => 'Invalid reaction'], Response::HTTP_BAD_REQUEST);
        }

        $story = $em->getRepository(TravelStory::class)->find($id);
        if (!$story) {
            return $this->json(['error' => 'Travel story not found'], Response::HTTP_NOT_FOUND);
        }

        $userId = (int) $user->getId();
        $repo   = $em->getRepository(Reaction::class);

        $existing = $repo->findOneBy(['user_id' => $userId, 'travel_story_id' => $id]);

        $userReaction = null;

        if ($existing) {
            if ($existing->getType() === $type) {
                // Same reaction → remove (toggle off)
                $em->remove($existing);
            } else {
                // Different reaction → update
                $existing->setType($type);
                $userReaction = $type;
            }
        } else {
            $r = new Reaction();
            $r->setUserId($userId);
            $r->setTravelStoryId($id);
            $r->setType($type);
            $em->persist($r);
            $userReaction = $type;
        }

        $em->flush();

        return $this->json([
            'userReaction' => $userReaction,
            'counts'       => $this->countsByTravelStory($em, $id),
        ]);
    }

    // ── COMMENT reaction ─────────────────────────────────────────────────
    #[Route('/comment/{id}/react/{type}', name: 'comment_react', methods: ['POST'])]
    public function reactToComment(
        int $id,
        string $type,
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user instanceof User) {
            return $this->json(['error' => 'Not logged in'], Response::HTTP_UNAUTHORIZED);
        }

        if (!in_array($type, self::ALLOWED, true)) {
            return $this->json(['error' => 'Invalid reaction'], Response::HTTP_BAD_REQUEST);
        }

        $comment = $em->getRepository(Comment::class)->find($id);
        if (!$comment) {
            return $this->json(['error' => 'Comment not found'], Response::HTTP_NOT_FOUND);
        }

        $userId = (int) $user->getId();
        $repo   = $em->getRepository(Reaction::class);

        $existing = $repo->findOneBy(['user_id' => $userId, 'comment_id' => $id]);

        $userReaction = null;

        if ($existing) {
            if ($existing->getType() === $type) {
                $em->remove($existing);
            } else {
                $existing->setType($type);
                $userReaction = $type;
            }
        } else {
            $r = new Reaction();
            $r->setUserId($userId);
            $r->setCommentId($id);
            $r->setType($type);
            $em->persist($r);
            $userReaction = $type;
        }

        $em->flush();

        return $this->json([
            'userReaction' => $userReaction,
            'counts'       => $this->countsByComment($em, $id),
        ]);
    }

    // ── Helpers ──────────────────────────────────────────────────────────
    private function countsByPost(EntityManagerInterface $em, int $postId): array
    {
        return $this->buildCounts(
            $em->getRepository(Reaction::class)->findBy(['post_id' => $postId])
        );
    }

    private function countsByComment(EntityManagerInterface $em, int $commentId): array
    {
        return $this->buildCounts(
            $em->getRepository(Reaction::class)->findBy(['comment_id' => $commentId])
        );
    }

    private function countsByTravelStory(EntityManagerInterface $em, int $storyId): array
    {
        return $this->buildCounts(
            $em->getRepository(Reaction::class)->findBy(['travel_story_id' => $storyId])
        );
    }

    private function buildCounts(array $reactions): array
    {
        $counts = array_fill_keys(self::ALLOWED, 0);
        foreach ($reactions as $r) {
            $t = strtolower(trim((string) $r->getType()));
            if (isset($counts[$t])) {
                $counts[$t]++;
            }
        }
        return $counts;
    }
}