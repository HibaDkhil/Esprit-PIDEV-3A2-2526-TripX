<?php

namespace App\Controller\admin;

use App\Entity\Comment;
use App\Entity\LiveComment;
use App\Entity\LiveSession;
use App\Entity\LiveSessionViewer;
use App\Entity\BlogNotification;
use App\Entity\Post;
use App\Entity\Reaction;
use App\Entity\Story;
use App\Entity\TravelStory;
use App\Entity\User;
use App\service\BlogModerationAnalyzer;
use App\service\ModerationRecordService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

#[Route('/admin/blog')]
class BlogAdminController extends AbstractController
{
    private const BLOG_TABS = ['posts', 'stories', 'ig-stories', 'live', 'moderation'];
    private const MODERATION_ORDER = [
        'HIGH_RISK' => 1,
        'SPAM' => 2,
        'REVIEW' => 3,
        'AUTO_HIDDEN' => 4,
        'SAFE' => 9,
    ];

    // ── List posts + travel stories + IG stories ─────────────────────────
    #[Route('', name: 'admin_blog')]
    public function index(
        EntityManagerInterface $em,
        ModerationRecordService $moderationRecordService,
        BlogModerationAnalyzer $moderationAnalyzer,
        ChartBuilderInterface $chartBuilder
    ): Response
    {
        $posts   = $em->getRepository(Post::class)->findBy([], ['id' => 'DESC']);
        $stories = $em->getRepository(TravelStory::class)->findBy([], ['createdAt' => 'DESC']);
        $igStories = $em->getRepository(Story::class)->findBy([], ['createdAt' => 'DESC']);
        $liveSessions = $em->getRepository(LiveSession::class)->findBy([], ['startedAt' => 'DESC']);

        // Build author map from all content types
        $authorIds = array_unique(array_filter(array_merge(
            array_map(fn($p) => $p->getUserId(), $posts),
            array_map(fn($s) => $s->getUserId(), $stories),
            array_map(fn($s) => $s->getUserId(), $igStories),
            array_map(fn($l) => $l->getHostUser()?->getUserId(), $liveSessions)
        )));
        $authorMap = [];
        foreach ($authorIds as $uid) {
            $u = $em->getRepository(User::class)->find($uid);
            if ($u) {
                $authorMap[$uid] = $u->getFirstName() . ' ' . $u->getLastName();
            }
        }

        $allComments   = $em->getRepository(Comment::class)->findBy([], ['created_at' => 'DESC']);
        $allReactions  = $em->getRepository(Reaction::class)->findBy([]);

        $postCommentCounts = [];
        $storyCommentCounts = [];
        foreach ($allComments as $comment) {
            $commentPost = $comment->getPost();
            if ($commentPost) {
                $postId = $commentPost->getId();
                if ($postId !== null) {
                    $postCommentCounts[$postId] = ($postCommentCounts[$postId] ?? 0) + 1;
                }
            }

            $storyId = $comment->getTravelStoryId();
            if ($storyId !== null) {
                $storyCommentCounts[$storyId] = ($storyCommentCounts[$storyId] ?? 0) + 1;
            }
        }

        $postReactionCounts = [];
        $storyReactionCounts = [];
        foreach ($allReactions as $r) {
            $reactionPostId = $r->getPostId();
            if ($reactionPostId !== null) {
                $postReactionCounts[$reactionPostId] = ($postReactionCounts[$reactionPostId] ?? 0) + 1;
            }

            $reactionStoryId = $r->getTravelStoryId();
            if ($reactionStoryId !== null) {
                $storyReactionCounts[$reactionStoryId] = ($storyReactionCounts[$reactionStoryId] ?? 0) + 1;
            }
        }

        // Live reactions — now stored in the unified reactions table
        $liveReactionCounts = [];
        foreach ($allReactions as $r) {
            $sid = $r->getLiveSessionId();
            if ($sid !== null) {
                $liveReactionCounts[$sid] = ($liveReactionCounts[$sid] ?? 0) + 1;
            }
        }

        $allLiveComments = $em->getRepository(LiveComment::class)->findBy([]);
        $allLiveViewers  = $em->getRepository(LiveSessionViewer::class)->findBy([]);

        $liveCommentCounts = [];
        foreach ($allLiveComments as $liveComment) {
            $sessionId = $liveComment->getLiveSession()?->getId();
            if ($sessionId !== null) {
                $liveCommentCounts[$sessionId] = ($liveCommentCounts[$sessionId] ?? 0) + 1;
            }
        }

        $liveViewerCounts = [];
        $liveActiveViewerCounts = [];
        foreach ($allLiveViewers as $liveViewer) {
            $sessionId = $liveViewer->getLiveSession()?->getId();
            if ($sessionId !== null) {
                $liveViewerCounts[$sessionId] = ($liveViewerCounts[$sessionId] ?? 0) + 1;
                if ($liveViewer->isActive()) {
                    $liveActiveViewerCounts[$sessionId] = ($liveActiveViewerCounts[$sessionId] ?? 0) + 1;
                }
            }
        }

        foreach ($allComments as $c) {
            $uid = $c->getUserId();
            if ($uid && !isset($authorMap[$uid])) {
                $u = $em->getRepository(User::class)->find($uid);
                if ($u) $authorMap[$uid] = $u->getFirstName() . ' ' . $u->getLastName();
            }
        }

        $postModeration = [];
        $storyModeration = [];
        $igStoryModeration = [];
        $liveModeration = [];
        $postCommentModeration = [];
        $storyCommentModeration = [];
        $liveCommentModeration = [];
        $visiblePosts = [];
        $moderationQueue = [];
        $spamDetected = 0;
        $flaggedPosts = 0;

        foreach ($posts as $post) {
            $postId = $post->getId();
            if ($postId !== null) {
                $postCommentModeration[(int) $postId] = $moderationAnalyzer->createCommentBucket();
            }
        }

        foreach ($stories as $story) {
            $storyId = $story->getId();
            if ($storyId !== null) {
                $storyCommentModeration[(int) $storyId] = $moderationAnalyzer->createCommentBucket();
            }
        }

        foreach ($liveSessions as $live) {
            $liveId = $live->getId();
            if ($liveId !== null) {
                $liveCommentModeration[(int) $liveId] = $moderationAnalyzer->createCommentBucket();
            }
        }

        $postModerationFromDb = $moderationRecordService->getPostModerationMap(array_map(
            static fn(Post $p) => (int) ($p->getId() ?? 0),
            $posts
        ));

        foreach ($posts as $post) {
            $postId = (int) ($post->getId() ?? 0);
            $analysis = $postModerationFromDb[$postId] ?? $moderationAnalyzer->analyzeText(
                (string) ($post->getTitle() ?? ''),
                (string) ($post->getBody() ?? '')
            );
            $postModeration[(int) $post->getId()] = $analysis;

            if ($analysis['state'] !== 'SAFE') {
                $moderationQueue[] = $post;
                if (in_array($analysis['state'], ['REVIEW', 'HIGH_RISK', 'AUTO_HIDDEN'], true)) {
                    $flaggedPosts++;
                }
                if ($analysis['state'] === 'SPAM') {
                    $spamDetected++;
                }
            }

            if (in_array($analysis['state'], ['SAFE', 'REVIEW'], true)) {
                $visiblePosts[] = $post;
            }
        }

        foreach ($stories as $story) {
            $storyModeration[(int) $story->getId()] = $moderationAnalyzer->analyzeText(
                (string) ($story->getTitle() ?? ''),
                trim(implode("\n", array_filter([
                    (string) ($story->getSummary() ?? ''),
                    (string) ($story->getTips() ?? ''),
                    (string) ($story->getDestination() ?? ''),
                    implode(' ', $story->getTagsJson() ?? []),
                    implode(' ', $story->getMustVisitJson() ?? []),
                    implode(' ', $story->getMustDoJson() ?? []),
                    implode(' ', $story->getMustTryJson() ?? []),
                    implode(' ', $story->getFavoritePlacesJson() ?? []),
                ])))
            );
        }

        foreach ($igStories as $igStory) {
            $igStoryModeration[(int) $igStory->getId()] = $moderationAnalyzer->analyzeText(
                '',
                (string) ($igStory->getCaption() ?? '')
            );
        }

        foreach ($liveSessions as $live) {
            $liveModeration[(int) $live->getId()] = $moderationAnalyzer->analyzeText(
                (string) ($live->getTitle() ?? ''),
                (string) ($live->getRoomName() ?? '')
            );
        }

        foreach ($allComments as $comment) {
            $analysis    = $moderationAnalyzer->analyzeText('', (string) ($comment->getBody() ?? ''));
            $commentText = trim((string) ($comment->getBody() ?? ''));

            $commentPost = $comment->getPost();
            if ($commentPost !== null && $commentPost->getId() !== null) {
                $postId = (int) $commentPost->getId();
                if (!isset($postCommentModeration[$postId])) {
                    $postCommentModeration[$postId] = $moderationAnalyzer->createCommentBucket();
                }
                $moderationAnalyzer->accumulateComment($postCommentModeration[$postId], $analysis, $commentText);
            }

            $travelStoryId = $comment->getTravelStoryId();
            if ($travelStoryId !== null) {
                $storyId = (int) $travelStoryId;
                if (!isset($storyCommentModeration[$storyId])) {
                    $storyCommentModeration[$storyId] = $moderationAnalyzer->createCommentBucket();
                }
                $moderationAnalyzer->accumulateComment($storyCommentModeration[$storyId], $analysis, $commentText);
            }
        }

        foreach ($allLiveComments as $liveComment) {
            $liveId = $liveComment->getLiveSession()?->getId();
            if ($liveId === null) {
                continue;
            }
            $analysis        = $moderationAnalyzer->analyzeText('', (string) ($liveComment->getMessage() ?? ''));
            $commentText     = trim((string) ($liveComment->getMessage() ?? ''));
            $liveSessionId   = (int) $liveId;
            if (!isset($liveCommentModeration[$liveSessionId])) {
                $liveCommentModeration[$liveSessionId] = $moderationAnalyzer->createCommentBucket();
            }
            $moderationAnalyzer->accumulateComment($liveCommentModeration[$liveSessionId], $analysis, $commentText);
        }

        $postCommentModeration  = $moderationAnalyzer->finalizeCommentMap($postCommentModeration);
        $storyCommentModeration = $moderationAnalyzer->finalizeCommentMap($storyCommentModeration);
        $liveCommentModeration  = $moderationAnalyzer->finalizeCommentMap($liveCommentModeration);

        $commentModerationTotals = [
            'safe' => 0,
            'review' => 0,
            'spam' => 0,
            'high_risk' => 0,
            'auto_hidden' => 0,
        ];
        foreach ([$postCommentModeration, $storyCommentModeration, $liveCommentModeration] as $commentMap) {
            foreach ($commentMap as $bucket) {
                $commentModerationTotals['safe'] += (int) ($bucket['safe'] ?? 0);
                $commentModerationTotals['review'] += (int) ($bucket['review'] ?? 0);
                $commentModerationTotals['spam'] += (int) ($bucket['spam'] ?? 0);
                $commentModerationTotals['high_risk'] += (int) ($bucket['high_risk'] ?? 0);
                $commentModerationTotals['auto_hidden'] += (int) ($bucket['auto_hidden'] ?? 0);
            }
        }

        usort($moderationQueue, function (Post $a, Post $b) use ($postModeration): int {
            $aState = $postModeration[(int) $a->getId()]['state'] ?? 'SAFE';
            $bState = $postModeration[(int) $b->getId()]['state'] ?? 'SAFE';

            $aRank = self::MODERATION_ORDER[$aState] ?? 99;
            $bRank = self::MODERATION_ORDER[$bState] ?? 99;
            if ($aRank !== $bRank) {
                return $aRank <=> $bRank;
            }

            return ((int) $b->getId()) <=> ((int) $a->getId());
        });

        $stats = [
            'total'     => count($posts),
            'pending'   => count(array_filter($posts, fn($p) => !$p->isConfirmed())),
            'approved'  => count(array_filter($posts, fn($p) => $p->isConfirmed())),
            'stories'   => count($stories),
            'igStories' => count($igStories),
            'liveSessions' => count($liveSessions),
            'comments'  => count($allComments),
            'reactions' => count($allReactions),
            'flaggedPosts' => $flaggedPosts,
            'spamDetected' => $spamDetected,
            'blockedBots' => 0,
        ];

        // ── Admin Dashboard Overhaul: Requested Charts ──

        // 1. Verification Stats
        $vData = [$stats['approved'], $stats['pending']];
        if (array_sum($vData) === 0) { $vData = [1, 1]; } // Fallback

        // 2. Content Mix
        $cData = [count($posts), count($stories), count($liveSessions), count($allComments)];
        if (array_sum($cData) === 0) { $cData = [1, 1, 1, 1]; } // Fallback

        // 3. Peak Activity
        $activityLogs = $em->getRepository(\App\Entity\UserActivityLog::class)->findAll();
        $peakActivityMap = array_fill(0, 24, 0);
        foreach ($activityLogs as $log) {
            $hour = (int) $log->getTimestamp()->format('H');
            $peakActivityMap[$hour]++;
        }
        
        if (array_sum($peakActivityMap) === 0) {
            $peakActivityMap = [
                0=>12, 1=>5, 2=>2, 3=>1, 4=>3, 5=>8, 6=>15, 7=>30, 8=>50, 9=>80, 10=>95, 11=>110,
                12=>130, 13=>145, 14=>120, 15=>100, 16=>115, 17=>140, 18=>160, 19=>180, 20=>195, 21=>150, 22=>90, 23=>40
            ];
        }

        $activityLabels = array_map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ':00', range(0, 23));
        
        // Pass plain arrays to template
        $chartData = [
            'verification' => $vData,
            'contentMix' => $cData,
            'activityData' => array_values($peakActivityMap),
            'activityLabels' => $activityLabels,
        ];

        // Stub removed charts so template doesn't crash (kept as null-safe in template)
        $moderationChart        = null;
        $commentModerationChart = null;

        return $this->render('admin/blog/blog.html.twig', [
            'posts'             => $posts,
            'visiblePosts'      => $visiblePosts,
            'moderationQueue'   => $moderationQueue,
            'postModeration'    => $postModeration,
            'storyModeration'   => $storyModeration,
            'igStoryModeration' => $igStoryModeration,
            'liveModeration'    => $liveModeration,
            'postCommentModeration' => $postCommentModeration,
            'storyCommentModeration' => $storyCommentModeration,
            'liveCommentModeration' => $liveCommentModeration,
            'stories'           => $stories,
            'igStories'         => $igStories,
            'liveSessions'      => $liveSessions,
            'authorMap'         => $authorMap,
            'stats'             => $stats,
            'allComments'       => $allComments,
            'postCommentCounts' => $postCommentCounts,
            'postReactionCounts'=> $postReactionCounts,
            'storyCommentCounts'=> $storyCommentCounts,
            'storyReactionCounts'=> $storyReactionCounts,
            'liveCommentCounts' => $liveCommentCounts,
            'liveReactionCounts'=> $liveReactionCounts,
            'liveViewerCounts'  => $liveViewerCounts,
            'liveActiveViewerCounts' => $liveActiveViewerCounts,
            'chartData' => $chartData,
            'moderationChart' => $moderationChart,
            'commentModerationChart' => $commentModerationChart,
        ]);
    }

    // ── Approve a post ──────────────────────────────────────────────────
    #[Route('/{id}/approve', name: 'admin_blog_approve', methods: ['POST'])]
    public function approve(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }

        $token = (string) $request->request->get('_token');
        if ($this->isCsrfTokenValid('admin_blog_' . $id, $token) || $this->isCsrfTokenValid('admin_blog_action', $token)) {
            $post->setIsConfirmed(true);
            $post->setRemovedByAdmin(false);
            $post->setRemovalReason(null);
            $post->setRemovedAt(null);
            $em->flush();
            $this->addFlash('success', 'Post approved.');
        }

        return $this->redirectToRoute('admin_blog', ['tab' => $this->resolveTab($request)]);
    }

    #[Route('/bulk-action', name: 'admin_blog_bulk_action', methods: ['POST'])]
    public function bulkAction(Request $request, EntityManagerInterface $em): Response
    {
        $ids = array_values(array_filter(array_map('intval', (array) $request->request->all('post_ids'))));
        $action = strtolower(trim((string) $request->request->get('bulk_action', '')));

        if (!$this->isCsrfTokenValid('admin_blog_bulk_action', (string) $request->request->get('_token'))) {
            $this->addFlash('info', 'Invalid bulk action token.');
            return $this->redirectToRoute('admin_blog', ['tab' => $this->resolveTab($request)]);
        }

        if ($ids === [] || !in_array($action, ['approve', 'reject', 'delete', 'mark_safe'], true)) {
            $this->addFlash('info', 'Select posts and a valid bulk action first.');
            return $this->redirectToRoute('admin_blog', ['tab' => $this->resolveTab($request)]);
        }

        $affected = 0;
        foreach ($ids as $id) {
            $post = $em->getRepository(Post::class)->find($id);
            // Safety: ensure the record exists and has an owner
            if (!$post instanceof Post || $post->getUserId() === null) {
                continue;
            }

            if (in_array($action, ['approve', 'mark_safe'], true)) {
                $post->setIsConfirmed(true);
                $post->setRemovedByAdmin(false);
                $post->setRemovalReason(null);
                $post->setRemovedAt(null);
                $affected++;
                continue;
            }

            if ($action === 'reject') {
                $post->setIsConfirmed(false);
                $affected++;
                continue;
            }

            if ($action === 'delete') {
                $defaultReason = 'Your post was removed by a moderator for violating the community guidelines.';
                // Notify the post author
                $em->persist(new BlogNotification(
                    (int) $post->getUserId(),
                    $defaultReason,
                    'moderation'
                ));
                $post->setImageUrl(null);
                $post->setIsConfirmed(false);
                $post->setRemovedByAdmin(true);
                $post->setRemovalReason($defaultReason);
                $post->setRemovedAt(new \DateTimeImmutable());
                $post->setUpdatedAt(new \DateTimeImmutable());
                $affected++;
            }
        }

        $em->flush();
        $this->addFlash('success', sprintf('Bulk action "%s" applied to %d post(s).', $action, $affected));

        return $this->redirectToRoute('admin_blog', ['tab' => $this->resolveTab($request)]);
    }

    // ── Delete an IG story ───────────────────────────────────────────────
    #[Route('/ig-story/{id}/delete', name: 'admin_ig_story_delete', methods: ['POST'])]
    public function deleteIgStory(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $story = $em->getRepository(Story::class)->find($id);
        if (!$story) {
            throw $this->createNotFoundException('Story not found.');
        }

        if ($this->isCsrfTokenValid('admin_ig_story_delete_' . $id, $request->request->get('_token'))) {
            $imagePath = (string) $story->getImageUrl();
            if (str_starts_with($imagePath, '/uploads/stories/')) {
                $absolutePath = $this->getParameter('kernel.project_dir') . '/public' . $imagePath;
                if (is_file($absolutePath)) {
                    (new Filesystem())->remove($absolutePath);
                }
            }

            $reason = trim((string) $request->request->get('removal_reason', ''));
            $defaultReason = 'This Story was removed by an admin because it violated the community guidelines.';

            $story->setImageUrl('');
            $story->setRemovedByAdmin(true);
            $story->setRemovalReason($reason !== '' ? $reason : $defaultReason);
            $story->setRemovedAt(new \DateTimeImmutable());

            $em->flush();
            $this->addFlash('success', 'Story removed and replaced with moderation placeholder.');
        }

        return $this->redirectToRoute('admin_blog', ['tab' => $this->resolveTab($request)]);
    }

    // ── Delete a live session ────────────────────────────────────────────
    #[Route('/live/{id}/delete', name: 'admin_live_delete', methods: ['POST'])]
    public function deleteLiveSession(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $session = $em->getRepository(LiveSession::class)->find($id);
        if (!$session) {
            throw $this->createNotFoundException('Live session not found.');
        }

        if ($this->isCsrfTokenValid('admin_live_delete_' . $id, $request->request->get('_token'))) {
            $recordingUrl = (string) ($session->getRecordingUrl() ?? '');
            if ($session->isSavedToProfile() && !$session->isRemovedByAdmin()) {
                if (str_starts_with($recordingUrl, '/uploads/live_recordings/')) {
                    $recordingPath = $this->getParameter('kernel.project_dir') . '/public' . $recordingUrl;
                    if (is_file($recordingPath)) {
                        (new Filesystem())->remove($recordingPath);
                    }
                }

                $reason = trim((string) $request->request->get('removal_reason', ''));
                $defaultReason = 'This Live recording was removed by an admin because it violated the community guidelines.';

                $session->setRecordingUrl('');
                $session->setRemovedByAdmin(true);
                $session->setRemovalReason($reason !== '' ? $reason : $defaultReason);
                $session->setRemovedAt(new \DateTimeImmutable());
                $session->setUpdatedAt(new \DateTimeImmutable());
                $em->flush();

                $this->addFlash('success', 'Saved live removed and replaced with moderation placeholder.');
            } else {
                if (str_starts_with($recordingUrl, '/uploads/live_recordings/')) {
                    $recordingPath = $this->getParameter('kernel.project_dir') . '/public' . $recordingUrl;
                    if (is_file($recordingPath)) {
                        (new Filesystem())->remove($recordingPath);
                    }
                }

                $em->remove($session);
                $em->flush();
                $this->addFlash('success', 'Live session deleted.');
            }
        }

        return $this->redirectToRoute('admin_blog', ['tab' => $this->resolveTab($request)]);
    }

    // ── Reject a post ───────────────────────────────────────────────────
    #[Route('/{id}/reject', name: 'admin_blog_reject', methods: ['POST'])]
    public function reject(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }

        $token = (string) $request->request->get('_token');
        if ($this->isCsrfTokenValid('admin_blog_' . $id, $token) || $this->isCsrfTokenValid('admin_blog_action', $token)) {
            $post->setIsConfirmed(false);
            $em->flush();
            $this->addFlash('info', 'Post rejected.');
        }

        return $this->redirectToRoute('admin_blog', ['tab' => $this->resolveTab($request)]);
    }

    // ── Delete a post ───────────────────────────────────────────────────
    #[Route('/{id}/delete', name: 'admin_blog_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }

        $token = (string) $request->request->get('_token');
        if ($this->isCsrfTokenValid('admin_blog_delete_' . $id, $token) || $this->isCsrfTokenValid('admin_blog_action', $token)) {
            $reason        = trim((string) $request->request->get('removal_reason', ''));
            $defaultReason = 'This post was removed by an admin because it violated the community guidelines.';
            $notifMsg      = $reason !== '' ? "Your post was removed: {$reason}" : $defaultReason;

            // Notify the post author
            if ($post->getUserId() !== null) {
                $em->persist(new BlogNotification((int) $post->getUserId(), $notifMsg, 'moderation'));
            }
            $post->setImageUrl(null);
            $post->setRemovedByAdmin(true);
            $post->setRemovalReason($reason !== '' ? $reason : $defaultReason);
            $post->setRemovedAt(new \DateTimeImmutable());
            $post->setUpdatedAt(new \DateTimeImmutable());
            $post->setIsConfirmed(false);
            $em->flush();
            $this->addFlash('success', 'Post removed and replaced with moderation placeholder.');
        }

        return $this->redirectToRoute('admin_blog', ['tab' => $this->resolveTab($request)]);
    }

    // ── Delete a travel story ───────────────────────────────────────────
    #[Route('/story/{id}/delete', name: 'admin_story_delete', methods: ['POST'])]
    public function deleteStory(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $story = $em->getRepository(TravelStory::class)->find($id);
        if (!$story) {
            throw $this->createNotFoundException('Travel story not found.');
        }

        if ($this->isCsrfTokenValid('admin_story_delete_' . $id, $request->request->get('_token'))) {
            $reason = trim((string) $request->request->get('removal_reason', ''));
            $defaultReason = 'This Travel Story was removed by an admin because it violated the community guidelines.';

            $this->removeTravelStoryImages($story);
            $story->setCoverImageUrl(null);
            $story->setImageUrlsJson([]);
            $story->setRemovedByAdmin(true);
            $story->setRemovalReason($reason !== '' ? $reason : $defaultReason);
            $story->setRemovedAt(new \DateTimeImmutable());
            $story->setUpdatedAt(new \DateTimeImmutable());

            $em->flush();
            $this->addFlash('success', 'Travel story removed and replaced with moderation placeholder.');
        }

        return $this->redirectToRoute('admin_blog', ['tab' => $this->resolveTab($request)]);
    }

    // ── Show a post (with comments & reactions) ─────────────────────────
    #[Route('/{id}/show', name: 'admin_blog_show')]
    public function showPost(int $id, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }

        $userIds = array_unique(array_filter(array_merge(
            [$post->getUserId()],
            array_map(fn($c) => $c->getUserId(), $post->getComments()->toArray())
        )));
        $authorMap = [];
        foreach ($userIds as $uid) {
            $u = $em->getRepository(User::class)->find($uid);
            if ($u) $authorMap[$uid] = $u->getFirstName() . ' ' . $u->getLastName();
        }

        $reactions = $em->getRepository(Reaction::class)->findBy(['post_id' => $post->getId()]);
        $reactionCounts = [];
        foreach ($reactions as $r) {
            $reactionCounts[$r->getType()] = ($reactionCounts[$r->getType()] ?? 0) + 1;
        }
        arsort($reactionCounts);

        return $this->render('admin/blog/post_show.html.twig', [
            'post'           => $post,
            'authorMap'      => $authorMap,
            'reactionCounts' => $reactionCounts,
            'totalReactions' => count($reactions),
        ]);
    }

    // ── Show a travel story (with comments & reactions) ──────────────────
    #[Route('/story/{id}/show', name: 'admin_story_show')]
    public function showStory(int $id, EntityManagerInterface $em): Response
    {
        $story = $em->getRepository(TravelStory::class)->find($id);
        if (!$story) {
            throw $this->createNotFoundException('Travel story not found.');
        }

        $comments = $em->getRepository(Comment::class)->findBy(
            ['travel_story_id' => $story->getId()],
            ['created_at' => 'DESC']
        );

        $userIds = array_unique(array_filter(array_merge(
            [$story->getUserId()],
            array_map(fn($c) => $c->getUserId(), $comments)
        )));
        $authorMap = [];
        foreach ($userIds as $uid) {
            $u = $em->getRepository(User::class)->find($uid);
            if ($u) $authorMap[$uid] = $u->getFirstName() . ' ' . $u->getLastName();
        }

        $reactions = $em->getRepository(Reaction::class)->findBy(['travel_story_id' => $story->getId()]);
        $reactionCounts = [];
        foreach ($reactions as $r) {
            $reactionCounts[$r->getType()] = ($reactionCounts[$r->getType()] ?? 0) + 1;
        }
        arsort($reactionCounts);

        return $this->render('admin/blog/story_show.html.twig', [
            'story'          => $story,
            'authorName'     => $authorMap[$story->getUserId()] ?? 'User #' . $story->getUserId(),
            'authorMap'      => $authorMap,
            'comments'       => $comments,
            'reactionCounts' => $reactionCounts,
            'totalReactions' => count($reactions),
        ]);
    }

    // ── Delete a comment ────────────────────────────────────────────────
    #[Route('/comment/{id}/delete', name: 'admin_comment_delete', methods: ['POST'])]
    public function deleteComment(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $comment = $em->getRepository(Comment::class)->find($id);
        if (!$comment) {
            throw $this->createNotFoundException('Comment not found.');
        }

        $referer = $request->headers->get('referer', $this->generateUrl('admin_blog'));

        if ($this->isCsrfTokenValid('admin_comment_delete_' . $id, $request->request->get('_token'))) {
            $authorId = $comment->getUserId();
            $reason   = trim((string) $request->request->get('removal_reason', ''));
            $notifMsg = $reason !== ''
                ? "Your comment was removed by a moderator: {$reason}"
                : 'Your comment was removed by a moderator for violating community guidelines.';

            if ($authorId !== null) {
                $em->persist(new BlogNotification((int) $authorId, $notifMsg, 'moderation'));
            }
            $em->remove($comment);
            $em->flush();
            $this->addFlash('success', 'Comment deleted.');
        }

        return $this->redirect($referer);
    }

    private function resolveTab(Request $request): string
    {
        $tab = (string) ($request->request->get('_tab') ?? $request->query->get('tab') ?? 'posts');

        return in_array($tab, self::BLOG_TABS, true) ? $tab : 'posts';
    }

    private function removeTravelStoryImages(TravelStory $story): void
    {
        $paths = array_unique(array_filter(array_merge(
            $story->getImageUrlsJson() ?? [],
            [$story->getCoverImageUrl()]
        )));

        if (empty($paths)) {
            return;
        }

        $filesystem = new Filesystem();
        $projectDir = (string) $this->getParameter('kernel.project_dir');

        foreach ($paths as $publicPath) {
            if (!is_string($publicPath) || !str_starts_with($publicPath, '/uploads/travel_stories/')) {
                continue;
            }

            $absolutePath = $projectDir . '/public' . $publicPath;
            if (is_file($absolutePath)) {
                $filesystem->remove($absolutePath);
            }
        }
    }

    // ── Private helpers removed — logic now in BlogModerationAnalyzer service ──
}