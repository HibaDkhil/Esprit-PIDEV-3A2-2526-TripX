<?php

namespace App\Controller\user;

use App\Entity\Reaction;
use App\Entity\SavedPost;
use App\Entity\User;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\ReactionRepository;
use App\Repository\TravelStoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    private function normalizeFeedTypeFilter(string $typeFilter): string
    {
        $normalized = strtolower(trim($typeFilter));

        return match ($normalized) {
            '', 'all' => 'all',
            'posts' => 'posts',
            'travel_story' => 'travel_story',
            default => 'all',
        };
    }

    #[Route('/blog/user-names', name: 'blog_user_names', methods: ['GET'])]
    public function userNames(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $raw = trim((string) $request->query->get('ids', ''));
        if ($raw === '') {
            return $this->json([]);
        }

        $ids = array_values(array_unique(array_filter(array_map('intval', explode(',', $raw)))));
        if (empty($ids)) {
            return $this->json([]);
        }

        $users = $em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.userId IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();

        $map = [];
        foreach ($users as $u) {
            $name = trim($u->getFirstName() . ' ' . $u->getLastName());
            $map[(string) $u->getUserId()] = $name ?: 'User #' . $u->getUserId();
        }

        return $this->json($map);
    }

    private function buildFeed(
        PostRepository $postRepository,
        TravelStoryRepository $tsRepository,
        string $search,
        string $typeFilter
    ): array {
        // Allowed filters: all | posts | travel_story
        $showPosts   = ($typeFilter === 'all' || $typeFilter === 'posts');
        $showStories = ($typeFilter === 'all' || $typeFilter === 'travel_story');

        $posts = [];
        if ($showPosts) {
            $posts = $postRepository->findFiltered($search, '');
        }

        $stories = [];
        if ($showStories) {
            $stories = $tsRepository->findFiltered($search);
        }

        $feed = [];

        foreach ($posts as $post) {
            $feed[] = [
                'feedType'  => 'post',
                'entity'    => $post,
                'createdAt' => $post->getCreatedAt() ?? new \DateTime('2000-01-01'),
            ];
        }

        foreach ($stories as $story) {
            $feed[] = [
                'feedType'  => 'travel_story',
                'entity'    => $story,
                'createdAt' => $story->getCreatedAt() ?? new \DateTime('2000-01-01'),
            ];
        }

        usort($feed, fn($a, $b) => $b['createdAt'] <=> $a['createdAt']);

        return $feed;
    }

    private function buildFeedContext(
        array $feed,
        EntityManagerInterface $em,
        ?int $currentUserId
    ): array {
        $userIds = [];
        foreach ($feed as $item) {
            if ($item['feedType'] === 'post') {
                $post = $item['entity'];
                $userIds[] = (int) $post->getUserId();
                foreach ($post->getComments() as $comment) {
                    $userIds[] = (int) $comment->getUserId();
                }
            } else {
                $story = $item['entity'];
                $userIds[] = (int) $story->getUserId();
                foreach ($em->getRepository(\App\Entity\Comment::class)->findBy(['travel_story_id' => (int) $story->getId()]) as $comment) {
                    $userIds[] = (int) $comment->getUserId();
                }
            }
        }
        $userIds = array_values(array_unique(array_filter($userIds)));

        $authorMap = [];
        if (!empty($userIds)) {
            $users = $em->createQueryBuilder()
                ->select('u')
                ->from(User::class, 'u')
                ->where('u.userId IN (:ids)')
                ->setParameter('ids', $userIds)
                ->getQuery()
                ->getResult();

            foreach ($users as $u) {
                $name = trim($u->getFirstName() . ' ' . $u->getLastName());
                $authorMap[(int) $u->getUserId()] = $name ?: 'User #' . $u->getUserId();
            }
        }

        $reactionSummary = [];
        $userReactions   = [];
        $storyReactionSummary = [];
        $storyUserReactions = [];
        $storyComments = [];

        /** @var ReactionRepository $reactionRepo */
        $reactionRepo = $em->getRepository(Reaction::class);
        /** @var CommentRepository $commentRepo */
        $commentRepo = $em->getRepository(\App\Entity\Comment::class);

        foreach ($feed as $item) {
            if ($item['feedType'] === 'post') {
                $post = $item['entity'];
                $pid  = (int) $post->getId();
                $reactionSummary[$pid] = [
                    'like' => 0, 'love' => 0, 'haha' => 0,
                    'wow'  => 0, 'sad'  => 0, 'angry' => 0,
                ];

                foreach ($reactionRepo->findBy(['post_id' => $pid]) as $reaction) {
                    $type = strtolower(trim((string) $reaction->getType()));
                    if (isset($reactionSummary[$pid][$type])) {
                        $reactionSummary[$pid][$type]++;
                    }
                    if ($currentUserId !== null && (int) $reaction->getUserId() === $currentUserId) {
                        $userReactions[$pid] = $type;
                    }
                }

                continue;
            }

            $story = $item['entity'];
            $sid = (int) $story->getId();
            $storyReactionSummary[$sid] = [
                'like' => 0, 'love' => 0, 'haha' => 0,
                'wow'  => 0, 'sad'  => 0, 'angry' => 0,
            ];

            foreach ($reactionRepo->findBy(['travel_story_id' => $sid]) as $reaction) {
                $type = strtolower(trim((string) $reaction->getType()));
                if (isset($storyReactionSummary[$sid][$type])) {
                    $storyReactionSummary[$sid][$type]++;
                }
                if ($currentUserId !== null && (int) $reaction->getUserId() === $currentUserId) {
                    $storyUserReactions[$sid] = $type;
                }
            }

            $storyComments[$sid] = $commentRepo->findBy(
                ['travel_story_id' => $sid],
                ['created_at' => 'ASC', 'id' => 'ASC']
            );
        }

        $savedPostIds = [];
        if ($currentUserId !== null) {
            foreach ($em->getRepository(SavedPost::class)->findBy(['user_id' => $currentUserId]) as $savedPost) {
                $savedPostIds[] = (int) $savedPost->getPostId();
            }
        }

        return [
            'authorMap'       => $authorMap,
            'reactionSummary' => $reactionSummary,
            'userReactions'   => $userReactions,
            'storyReactionSummary' => $storyReactionSummary,
            'storyUserReactions' => $storyUserReactions,
            'storyComments' => $storyComments,
            'savedPostIds'    => $savedPostIds,
        ];
    }

    #[Route('/blog', name: 'blog')]
    public function index(
        Request $request,
        EntityManagerInterface $em,
        PostRepository $postRepository,
        TravelStoryRepository $tsRepository
    ): Response {
        $search     = trim((string) $request->query->get('q', ''));
        $typeFilter = $this->normalizeFeedTypeFilter((string) $request->query->get('type', 'all'));

        /** @var User|null $me */
        $me = $this->getUser();
        $currentUserId = ($me instanceof User) ? (int) $me->getUserId() : null;

        $feed = $this->buildFeed($postRepository, $tsRepository, $search, $typeFilter);
        $ctx  = $this->buildFeedContext($feed, $em, $currentUserId);

        return $this->render('front/blog/blog.html.twig', [
            'feed'            => $feed,
            'authorMap'       => $ctx['authorMap'],
            'reactionSummary' => $ctx['reactionSummary'],
            'userReactions'   => $ctx['userReactions'],
            'storyReactionSummary' => $ctx['storyReactionSummary'],
            'storyUserReactions'   => $ctx['storyUserReactions'],
            'storyComments'        => $ctx['storyComments'],
            'savedPostIds'    => $ctx['savedPostIds'],
            'currentUserId'   => $currentUserId,
            'search'          => $search,
            'typeFilter'      => $typeFilter,
        ]);
    }

    #[Route('/blog/filter', name: 'blog_filter', methods: ['GET'])]
    public function filter(
        Request $request,
        EntityManagerInterface $em,
        PostRepository $postRepository,
        TravelStoryRepository $tsRepository
    ): Response {
        $search     = trim((string) $request->query->get('q', ''));
        $typeFilter = $this->normalizeFeedTypeFilter((string) $request->query->get('type', 'all'));

        /** @var User|null $me */
        $me = $this->getUser();
        $currentUserId = ($me instanceof User) ? (int) $me->getUserId() : null;

        $feed = $this->buildFeed($postRepository, $tsRepository, $search, $typeFilter);
        $ctx  = $this->buildFeedContext($feed, $em, $currentUserId);

        return $this->render('front/blog/_feed_items.html.twig', [
            'feed'            => $feed,
            'authorMap'       => $ctx['authorMap'],
            'reactionSummary' => $ctx['reactionSummary'],
            'userReactions'   => $ctx['userReactions'],
            'storyReactionSummary' => $ctx['storyReactionSummary'],
            'storyUserReactions'   => $ctx['storyUserReactions'],
            'storyComments'        => $ctx['storyComments'],
            'savedPostIds'    => $ctx['savedPostIds'],
            'currentUserId'   => $currentUserId,
        ]);
    }
}
