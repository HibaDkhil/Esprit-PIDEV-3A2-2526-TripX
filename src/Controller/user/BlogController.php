<?php

namespace App\Controller\user;

use App\Entity\Comment;
use App\Entity\Following;
use App\Entity\Reaction;
use App\Entity\SavedPost;
use App\Entity\User;
use App\Repository\FollowingRepository;
use App\Repository\PostRepository;
use App\Repository\TravelStoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
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
        EntityManagerInterface $em,
        string $search,
        string $typeFilter
    ): array {
        $postTypes = ['inquiry', 'story', 'review', 'advice', 'other'];

        $showPosts   = ($typeFilter === '' || in_array($typeFilter, $postTypes, true));
        $showStories = ($typeFilter === '' || $typeFilter === 'travel_story');

        $posts = [];
        if ($showPosts) {
            $posts = $postRepository->findFiltered(
                $search,
                in_array($typeFilter, $postTypes, true) ? $typeFilter : ''
            );
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
            } elseif ($item['feedType'] === 'travel_story') {
                $userIds[] = (int) $item['entity']->getUserId();
            }
        }
        $userIds = array_values(array_unique(array_filter($userIds)));

        $authorMap  = [];
        $avatarMap  = [];

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
                $avatarMap[(int) $u->getUserId()] = $u->getAvatarId();
            }
        }

        $reactionSummary = [];
        $userReactions   = [];

        $savedPostIds = [];
        if ($currentUserId !== null) {
            foreach ($em->getRepository(SavedPost::class)->findBy(['user_id' => $currentUserId]) as $savedPost) {
                $savedPostIds[] = (int) $savedPost->getPostId();
            }
        }
        
        $tsComments = [];
        foreach ($feed as $item) {
            if ($item['feedType'] === 'post') {
                $post = $item['entity'];
                $pid  = (int) $post->getId();
                $reactionSummary['p_' . $pid] = ['like' => 0, 'love' => 0, 'haha' => 0, 'wow' => 0, 'sad' => 0, 'angry' => 0];
                foreach ($em->getRepository(Reaction::class)->findBy(['post_id' => $pid]) as $reaction) {
                    $type = strtolower(trim((string) $reaction->getType()));
                    if (isset($reactionSummary['p_' . $pid][$type])) {
                        $reactionSummary['p_' . $pid][$type]++;
                    }
                    if ($currentUserId !== null && (int) $reaction->getUserId() === $currentUserId) {
                        $userReactions['p_' . $pid] = $type;
                    }
                }
            } elseif ($item['feedType'] === 'travel_story') {
                $story = $item['entity'];
                $sid = (int) $story->getId();
                $comments = $em->getRepository(Comment::class)->findBy(['travel_story_id' => $sid], ['created_at' => 'ASC']);
                $tsComments[$sid] = $comments;

                foreach ($comments as $comment) {
                    $userIds[] = (int) $comment->getUserId();
                }

                $reactionSummary['ts_' . $sid] = ['like' => 0, 'love' => 0, 'haha' => 0, 'wow' => 0, 'sad' => 0, 'angry' => 0];
                foreach ($em->getRepository(Reaction::class)->findBy(['travel_story_id' => $sid]) as $reaction) {
                    $type = strtolower(trim((string) $reaction->getType()));
                    if (isset($reactionSummary['ts_' . $sid][$type])) {
                        $reactionSummary['ts_' . $sid][$type]++;
                    }
                    if ($currentUserId !== null && (int) $reaction->getUserId() === $currentUserId) {
                        $userReactions['ts_' . $sid] = $type;
                    }
                }
            }
        }

        // Must run users mapped AGAIN if new users were found in tsComments, but we'll cheat since we map above.
        // Let's defer mapping or just map them! Wait, instead of duplicate, I will update authorMap if it's missing in Twig, or maybe reload it.
        // Actually, let's just do another fetch for any missing userIds.
        $userIds = array_values(array_unique(array_filter($userIds)));
        if (!empty($userIds)) {
            $users = $em->createQueryBuilder()->select('u')->from(User::class, 'u')->where('u.userId IN (:ids)')->setParameter('ids', $userIds)->getQuery()->getResult();
            foreach ($users as $u) {
                $name = trim($u->getFirstName() . ' ' . $u->getLastName());
                $authorMap[(int) $u->getUserId()] = $name ?: 'User #' . $u->getUserId();
                $avatarMap[(int) $u->getUserId()] = $u->getAvatarId();
            }
        }

        // Following IDs of current user (so we can show "Following" on buttons)
        $followingIds = [];
        if ($currentUserId !== null) {
            $followrows = $em->getRepository(Following::class)->findBy(['follower_id' => $currentUserId]);
            foreach ($followrows as $f) {
                $followingIds[] = (int) $f->getFollowedId();
            }
        }

        return [
            'authorMap'       => $authorMap,
            'avatarMap'       => $avatarMap,
            'reactionSummary' => $reactionSummary,
            'userReactions'   => $userReactions,
            'savedPostIds'    => $savedPostIds,
            'followingIds'    => $followingIds,
            'tsComments'      => $tsComments,
        ];
    }

    #[Route('/blog', name: 'blog')]
    public function index(
        Request $request,
        EntityManagerInterface $em,
        PostRepository $postRepository,
        TravelStoryRepository $tsRepository,
        FollowingRepository $followingRepo
    ): Response {
        $search     = trim((string) $request->query->get('q', ''));
        $typeFilter = trim((string) $request->query->get('type', 'explore'));

        /** @var User|null $me */
        $me            = $this->getUser();
        $currentUserId = ($me instanceof User) ? (int) $me->getUserId() : null;

        // Real follower / following counts
        $myFollowers  = 0;
        $myFollowing  = 0;
        $myPostsCount = 0;

        if ($currentUserId !== null) {
            $myFollowers  = $followingRepo->count(['followed_id' => $currentUserId]);
            $myFollowing  = $followingRepo->count(['follower_id' => $currentUserId]);
            $myPostsCount = $postRepository->count(['user_id' => $currentUserId]);
        }

        $feed = $this->buildFeed($postRepository, $tsRepository, $em, $search, $typeFilter);
        $ctx  = $this->buildFeedContext($feed, $em, $currentUserId);

        // Fetch all suggested users (independent of feed)
        $qb = $em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->setMaxResults(50);
            
        if ($currentUserId) {
            $qb->where('u.userId != :cid')->setParameter('cid', $currentUserId);
        }
        $suggestedUsers = $qb->getQuery()->getResult();
        
        // Fetch recent travel stories for the bubble row
        $topStories = $tsRepository->findBy([], ['createdAt' => 'DESC'], 15);

        $tsUserIds = [];
        foreach ($topStories as $ts) {
            $tsUserIds[] = $ts->getUserId();
        }
        $tsUserIds = array_diff(array_unique($tsUserIds), array_keys($ctx['authorMap']));
        if (!empty($tsUserIds)) {
            $tsUsers = $em->createQueryBuilder()->select('u')->from(User::class, 'u')->where('u.userId IN (:ids)')->setParameter('ids', $tsUserIds)->getQuery()->getResult();
            foreach ($tsUsers as $u) {
                $ctx['authorMap'][(int)$u->getUserId()] = trim($u->getFirstName() . ' ' . $u->getLastName()) ?: 'User #' . $u->getUserId();
            }
        }

        // Fetch the user's actual followers
        $followerIds = [];
        if ($currentUserId) {
            $followerRows = $followingRepo->findBy(['followed_id' => $currentUserId]);
            foreach ($followerRows as $r) {
                $followerIds[] = (int) $r->getFollowerId();
            }
        }

        $followersList = [];
        if (!empty($followerIds)) {
            $followersList = $em->createQueryBuilder()
                ->select('u')
                ->from(User::class, 'u')
                ->where('u.userId IN (:fids)')
                ->setParameter('fids', $followerIds)
                ->setMaxResults(20)
                ->getQuery()
                ->getResult();
        }

        return $this->render('front/blog/blog.html.twig', [
            'feed'            => $feed,
            'authorMap'       => $ctx['authorMap'],
            'avatarMap'       => $ctx['avatarMap'],
            'reactionSummary' => $ctx['reactionSummary'],
            'userReactions'   => $ctx['userReactions'],
            'savedPostIds'    => $ctx['savedPostIds'],
            'followingIds'    => $ctx['followingIds'],
            'tsComments'      => $ctx['tsComments'],
            'currentUserId'   => $currentUserId,
            'search'          => $search,
            'typeFilter'      => $typeFilter,
            'myFollowers'     => $myFollowers,
            'myFollowing'     => $myFollowing,
            'myPostsCount'    => $myPostsCount,
            'suggestedUsers'  => $suggestedUsers,
            'followersList'   => $followersList,
            'topStories'      => $topStories,
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
        $typeFilter = trim((string) $request->query->get('type', 'explore'));

        /** @var User|null $me */
        $me            = $this->getUser();
        $currentUserId = ($me instanceof User) ? (int) $me->getUserId() : null;

        $feed = $this->buildFeed($postRepository, $tsRepository, $em, $search, $typeFilter);
        $ctx  = $this->buildFeedContext($feed, $em, $currentUserId);

        return $this->render('front/blog/_feed_items.html.twig', [
            'feed'            => $feed,
            'authorMap'       => $ctx['authorMap'],
            'avatarMap'       => $ctx['avatarMap'],
            'reactionSummary' => $ctx['reactionSummary'],
            'userReactions'   => $ctx['userReactions'],
            'savedPostIds'    => $ctx['savedPostIds'],
            'followingIds'    => $ctx['followingIds'],
            'tsComments'      => $ctx['tsComments'],
            'currentUserId'   => $currentUserId,
        ]);
    }
}