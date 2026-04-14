<?php

namespace App\Controller\user;

use App\Entity\Reaction;
use App\Entity\SavedPost;
use App\Entity\User;
use App\Repository\CommentRepository;
use App\Repository\FollowingRepository;
use App\Repository\PostRepository;
use App\Repository\ReactionRepository;
use App\Repository\StoryRepository;
use App\Repository\StoryViewRepository;
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
            'my_posts' => 'my_posts',
            'travel_story' => 'travel_story',
            'my_travel_story' => 'my_travel_story',
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
        string $typeFilter,
        ?int $currentUserId
    ): array {
        // Allowed filters: all | posts | my_posts | travel_story | my_travel_story
        $showPosts   = ($typeFilter === 'all' || $typeFilter === 'posts' || $typeFilter === 'my_posts');
        $showStories = ($typeFilter === 'all' || $typeFilter === 'travel_story' || $typeFilter === 'my_travel_story');

        $posts = [];
        if ($showPosts) {
            $posts = $postRepository->findFiltered($search, '');

            if ($typeFilter === 'my_posts') {
                if ($currentUserId === null) {
                    $posts = [];
                } else {
                    $posts = array_values(array_filter(
                        $posts,
                        static fn($post) => (int) $post->getUserId() === $currentUserId
                    ));
                }
            }
        }

        $stories = [];
        if ($showStories) {
            $stories = $tsRepository->findFiltered($search);

            if ($typeFilter === 'my_travel_story') {
                if ($currentUserId === null) {
                    $stories = [];
                } else {
                    $stories = array_values(array_filter(
                        $stories,
                        static fn($story) => (int) $story->getUserId() === $currentUserId
                    ));
                }
            }
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

    private function buildStoriesContext(
        StoryRepository $storyRepository,
        StoryViewRepository $storyViewRepository,
        ?int $currentUserId
    ): array
    {
        $activeStories = $storyRepository->findActive();
        $seenStoryIdsLookup = [];

        if ($currentUserId !== null && !empty($activeStories)) {
            $storyIds = array_map(static fn($story): int => (int) $story->getId(), $activeStories);
            $seenStoryIds = $storyViewRepository->findSeenStoryIdsForViewerAndStories($currentUserId, $storyIds);
            $seenStoryIdsLookup = array_fill_keys($seenStoryIds, true);
        }

        $storiesByUser = [];

        foreach ($activeStories as $story) {
            $user = $story->getUser();
            if (!$user instanceof User) {
                continue;
            }

            $uid = (int) $user->getUserId();
            if (!isset($storiesByUser[$uid])) {
                $name = trim((string) $user->getFirstName() . ' ' . (string) $user->getLastName());
                $storiesByUser[$uid] = [
                    'userId' => $uid,
                    'userName' => $name !== '' ? $name : 'User #' . $uid,
                    'stories' => [],
                ];
            }

            $storiesByUser[$uid]['stories'][] = [
                'id' => (int) $story->getId(),
                'imageUrl' => (string) $story->getImageUrl(),
                'caption' => (string) ($story->getCaption() ?? ''),
                'createdAt' => $story->getCreatedAt()?->format(DATE_ATOM),
                'expiresAt' => $story->getExpiresAt()?->format(DATE_ATOM),
                'isSeenByMe' => isset($seenStoryIdsLookup[(int) $story->getId()]),
            ];
        }

        $ordered = array_values($storiesByUser);

        foreach ($ordered as &$group) {
            $group['hasUnseen'] = false;
            foreach ($group['stories'] as $story) {
                if (!$story['isSeenByMe']) {
                    $group['hasUnseen'] = true;
                    break;
                }
            }
        }
        unset($group);

        if ($currentUserId !== null) {
            usort($ordered, static function (array $a, array $b) use ($currentUserId): int {
                if ((int) $a['userId'] === $currentUserId) {
                    return -1;
                }
                if ((int) $b['userId'] === $currentUserId) {
                    return 1;
                }

                return 0;
            });
        }

        return $ordered;
    }

    #[Route('/blog', name: 'blog')]
    public function index(
        Request $request,
        EntityManagerInterface $em,
        PostRepository $postRepository,
        TravelStoryRepository $tsRepository,
        StoryRepository $storyRepository,
        StoryViewRepository $storyViewRepository,
        FollowingRepository $followingRepository
    ): Response {
        $search     = trim((string) $request->query->get('q', ''));
        $typeFilter = $this->normalizeFeedTypeFilter((string) $request->query->get('type', 'all'));

        /** @var User|null $me */
        $me = $this->getUser();
        $currentUserId = ($me instanceof User) ? (int) $me->getUserId() : null;

        $ownerPostCount = 0;
        $ownerStoryCount = 0;
        if ($currentUserId !== null) {
            $ownerPostCount = (int) $postRepository->count(['user_id' => $currentUserId]);
            $ownerStoryCount = (int) $tsRepository->count(['userId' => $currentUserId]);
        }

        $feed = $this->buildFeed($postRepository, $tsRepository, $search, $typeFilter, $currentUserId);
        $ctx  = $this->buildFeedContext($feed, $em, $currentUserId);
        $storiesByUser = $this->buildStoriesContext($storyRepository, $storyViewRepository, $currentUserId);

        $followingLookup = [];
        if ($currentUserId !== null) {
            $suggestedIds = [];
            foreach ($feed as $item) {
                $uid = (int) $item['entity']->getUserId();
                if ($uid > 0 && $uid !== $currentUserId) {
                    $suggestedIds[$uid] = true;
                }
            }

            if (!empty($suggestedIds)) {
                $rows = $followingRepository->createQueryBuilder('f')
                    ->select('f.followed_id AS followedId')
                    ->where('f.follower_id = :me')
                    ->andWhere('f.followed_id IN (:ids)')
                    ->setParameter('me', $currentUserId)
                    ->setParameter('ids', array_keys($suggestedIds))
                    ->getQuery()
                    ->getArrayResult();

                foreach ($rows as $row) {
                    $followingLookup[(int) $row['followedId']] = true;
                }
            }
        }

        return $this->render('front/blog/blog.html.twig', [
            'feed'            => $feed,
            'authorMap'       => $ctx['authorMap'],
            'reactionSummary' => $ctx['reactionSummary'],
            'userReactions'   => $ctx['userReactions'],
            'storyReactionSummary' => $ctx['storyReactionSummary'],
            'storyUserReactions'   => $ctx['storyUserReactions'],
            'storyComments'        => $ctx['storyComments'],
            'savedPostIds'    => $ctx['savedPostIds'],
            'storiesByUser'   => $storiesByUser,
            'currentUserId'   => $currentUserId,
            'followingLookup' => $followingLookup,
            'ownerPostCount'  => $ownerPostCount,
            'ownerStoryCount' => $ownerStoryCount,
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

        $feed = $this->buildFeed($postRepository, $tsRepository, $search, $typeFilter, $currentUserId);
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
