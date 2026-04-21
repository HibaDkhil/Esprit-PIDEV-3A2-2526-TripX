<?php

namespace App\Controller\user;

use App\Entity\LiveComment;
use App\Entity\LiveSession;
use App\Entity\LiveSessionViewer;
use App\Entity\BlogNotification;
use App\Entity\Reaction;
use App\Entity\User;
use App\Repository\LiveCommentRepository;
use App\Repository\LiveSessionRepository;
use App\Repository\LiveSessionViewerRepository;
use App\Repository\ReactionRepository;
use App\service\BotProtectionService;
use App\service\ContentModerationService;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/blog/live')]
class LiveController extends AbstractController
{
    private const ALLOWED_REACTIONS = ['like', 'love', 'fire', 'wow', 'clap'];

    #[Route('/list', name: 'blog_live_list', methods: ['GET'])]
    public function list(
        LiveSessionRepository $sessionRepository,
        LiveSessionViewerRepository $viewerRepository,
        ReactionRepository $reactionRepository
    ): JsonResponse {
        /** @var User|null $me */
        $me = $this->getUser();
        $myId = $me instanceof User ? (int) $me->getUserId() : null;

        $sessions = $sessionRepository->findActiveOrdered();
        $payload = [];

        foreach ($sessions as $session) {
            $payload[] = $this->serializeSessionCard($session, $viewerRepository, $reactionRepository, $myId);
        }

        return $this->json([
            'ok' => true,
            'sessions' => $payload,
            'me' => $myId,
        ]);
    }

    #[Route('/start', name: 'blog_live_start', methods: ['POST'])]
    public function start(
        Request $request,
        EntityManagerInterface $em,
        LiveSessionRepository $sessionRepository,
        LiveSessionViewerRepository $viewerRepository,
        ReactionRepository $reactionRepository,
        BotProtectionService $botProtectionService,
        ContentModerationService $contentModerationService
    ): JsonResponse {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], Response::HTTP_UNAUTHORIZED);
        }

        $existing = $sessionRepository->findLiveByHost($me);
        if ($existing instanceof LiveSession) {
            return $this->json([
                'ok' => true,
                'session' => $this->serializeSessionCard($existing, $viewerRepository, $reactionRepository, (int) $me->getUserId()),
                'alreadyLive' => true,
            ]);
        }

        $title = trim((string) $request->request->get('title', ''));
        if ($title === '') {
            $title = trim((string) $me->getFirstName() . ' ' . (string) $me->getLastName()) . ' is live';
        }

        $botIssue = $botProtectionService->validateRequest($request, 'live_start');
        if ($botIssue !== null) {
            return $this->json(['ok' => false, 'message' => $botIssue], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $moderationIssue = $contentModerationService->validateContent([$title], 'live_session', $request, $me);
        if ($moderationIssue !== null) {
            return $this->json(['ok' => false, 'message' => $moderationIssue], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $now = new \DateTimeImmutable();
        $roomName = sprintf('tripx-live-%d-%d', (int) $me->getUserId(), $now->getTimestamp());

        $session = new LiveSession();
        $session->setHostUser($me);
        $session->setTitle(mb_substr($title, 0, 255));
        $session->setStatus('live');
        $session->setRoomName($roomName);
        $session->setStreamToken(bin2hex(random_bytes(24)));
        $session->setStartedAt($now);
        $session->setCreatedAt($now);
        $session->setUpdatedAt($now);

        $em->persist($session);

        // Global Notification logic
        $allUsers = $em->getRepository(User::class)->findAll();
        $notifMsg = trim((string) $me->getFirstName() . ' ' . (string) $me->getLastName()) . ' is live now! Join the stream.';
        foreach ($allUsers as $u) {
            if ((int) $u->getUserId() !== (int) $me->getUserId()) {
                $em->persist(new BlogNotification((int) $u->getUserId(), $notifMsg, 'info'));
            }
        }

        $em->flush();

        return $this->json([
            'ok' => true,
            'session' => $this->serializeSessionCard($session, $viewerRepository, $reactionRepository, (int) $me->getUserId()),
            'alreadyLive' => false,
        ]);
    }

    #[Route('/{id}/end', name: 'blog_live_end', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function end(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        LiveSessionViewerRepository $viewerRepository
    ): JsonResponse {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], Response::HTTP_UNAUTHORIZED);
        }

        $session = $em->getRepository(LiveSession::class)->find($id);
        if (!$session instanceof LiveSession || $session->getStatus() !== 'live') {
            return $this->json(['ok' => false, 'message' => 'Live session not found.'], Response::HTTP_NOT_FOUND);
        }

        if ((int) $session->getHostUser()?->getUserId() !== (int) $me->getUserId()) {
            return $this->json(['ok' => false, 'message' => 'Only host can end this live.'], Response::HTTP_FORBIDDEN);
        }

        $now = new \DateTimeImmutable();
        $saveToProfile = $request->request->getBoolean('saveToProfile', false);
        $session->setStatus('ended');
        $session->setEndedAt($now);
        $session->setSavedToProfile($saveToProfile);
        $session->setSavedToProfileAt($saveToProfile ? $now : null);
        $session->setUpdatedAt($now);

        $activeViewers = $em->getRepository(LiveSessionViewer::class)->findBy([
            'liveSession' => $session,
            'isActive' => true,
        ]);

        foreach ($activeViewers as $viewer) {
            $viewer->setIsActive(false);
            $viewer->setLeftAt($now);
        }

        $em->flush();

        return $this->json([
            'ok' => true,
            'endedAt' => $session->getEndedAt()?->format(DATE_ATOM),
            'savedToProfile' => $session->isSavedToProfile(),
            'activeViewerCount' => $viewerRepository->countActiveBySession($session),
        ]);
    }

    #[Route('/{id}/join', name: 'blog_live_join', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function join(
        int $id,
        EntityManagerInterface $em,
        LiveSessionViewerRepository $viewerRepository
    ): JsonResponse {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], Response::HTTP_UNAUTHORIZED);
        }

        $session = $em->getRepository(LiveSession::class)->find($id);
        if (!$session instanceof LiveSession || $session->getStatus() !== 'live') {
            return $this->json(['ok' => false, 'message' => 'Live session not found.'], Response::HTTP_NOT_FOUND);
        }

        if ((int) $session->getHostUser()?->getUserId() !== (int) $me->getUserId()) {
            $viewer = $viewerRepository->findForSessionAndViewer($session, $me);
            $now = new \DateTimeImmutable();

            if (!$viewer instanceof LiveSessionViewer) {
                $viewer = new LiveSessionViewer();
                $viewer->setLiveSession($session);
                $viewer->setViewerUser($me);
                $viewer->setJoinedAt($now);
                $viewer->setIsActive(true);
                $viewer->setLeftAt(null);
                $em->persist($viewer);
            } else {
                $viewer->setIsActive(true);
                $viewer->setJoinedAt($now);
                $viewer->setLeftAt(null);
            }

            $session->setUpdatedAt($now);
            $em->flush();
        }

        return $this->json(['ok' => true]);
    }

    #[Route('/{id}/leave', name: 'blog_live_leave', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function leave(
        int $id,
        EntityManagerInterface $em,
        LiveSessionViewerRepository $viewerRepository
    ): JsonResponse {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], Response::HTTP_UNAUTHORIZED);
        }

        $session = $em->getRepository(LiveSession::class)->find($id);
        if (!$session instanceof LiveSession) {
            return $this->json(['ok' => false, 'message' => 'Live session not found.'], Response::HTTP_NOT_FOUND);
        }

        $viewer = $viewerRepository->findForSessionAndViewer($session, $me);
        if ($viewer instanceof LiveSessionViewer && $viewer->isActive()) {
            $viewer->setIsActive(false);
            $viewer->setLeftAt(new \DateTimeImmutable());
            $em->flush();
        }

        return $this->json(['ok' => true]);
    }

    #[Route('/{id}/comment', name: 'blog_live_comment', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function comment(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        BotProtectionService $botProtectionService,
        ContentModerationService $contentModerationService
    ): JsonResponse {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], Response::HTTP_UNAUTHORIZED);
        }

        $session = $em->getRepository(LiveSession::class)->find($id);
        if (!$session instanceof LiveSession || $session->getStatus() !== 'live') {
            return $this->json(['ok' => false, 'message' => 'Live session not found.'], Response::HTTP_NOT_FOUND);
        }

        $msg = trim((string) $request->request->get('message', ''));
        if ($msg === '') {
            return $this->json(['ok' => false, 'message' => 'Comment is required.'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (mb_strlen($msg) > 800) {
            return $this->json(['ok' => false, 'message' => 'Comment is too long.'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $botIssue = $botProtectionService->validateRequest($request, 'live_comment');
        if ($botIssue !== null) {
            return $this->json(['ok' => false, 'message' => $botIssue], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $moderationIssue = $contentModerationService->validateContent([$msg], 'live_comment', $request, $me);
        if ($moderationIssue !== null) {
            return $this->json(['ok' => false, 'message' => $moderationIssue], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $comment = new LiveComment();
        $comment->setLiveSession($session);
        $comment->setUser($me);
        $comment->setMessage($msg);
        $comment->setCreatedAt(new \DateTimeImmutable());

        $session->setUpdatedAt(new \DateTimeImmutable());

        $em->persist($comment);
        $em->flush();

        return $this->json([
            'ok' => true,
            'comment' => $this->serializeComment($comment),
        ]);
    }

    #[Route('/{id}/react/{type}', name: 'blog_live_react', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function react(
        int $id,
        string $type,
        EntityManagerInterface $em,
        ReactionRepository $reactionRepository
    ): JsonResponse {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], Response::HTTP_UNAUTHORIZED);
        }

        $type = strtolower(trim($type));
        if (!in_array($type, self::ALLOWED_REACTIONS, true)) {
            return $this->json(['ok' => false, 'message' => 'Invalid reaction.'], Response::HTTP_BAD_REQUEST);
        }

        $session = $em->getRepository(LiveSession::class)->find($id);
        if (!$session instanceof LiveSession || $session->getStatus() !== 'live') {
            return $this->json(['ok' => false, 'message' => 'Live session not found.'], Response::HTTP_NOT_FOUND);
        }

        $r = new Reaction();
        $r->setUserId((int) $me->getUserId());
        $r->setLiveSessionId((int) $session->getId());
        $r->setType($type);
        // created_at is set automatically in Reaction::__construct()

        $session->setUpdatedAt(new \DateTimeImmutable());

        $em->persist($r);
        $em->flush();

        return $this->json([
            'ok' => true,
            'counts' => $reactionRepository->countByTypeForSession($session),
        ]);
    }

    #[Route('/{id}/state', name: 'blog_live_state', methods: ['GET'], requirements: ['id' => '\\d+'])]
    public function state(
        int $id,
        LiveSessionRepository $sessionRepository,
        LiveSessionViewerRepository $viewerRepository,
        ReactionRepository $reactionRepository,
        LiveCommentRepository $commentRepository
    ): JsonResponse {
        /** @var User|null $me */
        $me = $this->getUser();
        $myId = $me instanceof User ? (int) $me->getUserId() : null;

        $session = $sessionRepository->find($id);
        if (!$session instanceof LiveSession) {
            return $this->json(['ok' => false, 'message' => 'Live session not found.'], Response::HTTP_NOT_FOUND);
        }

        $comments = $commentRepository->findLatestForSession($session, 60);

        return $this->json([
            'ok' => true,
            'session' => $this->serializeSessionCard($session, $viewerRepository, $reactionRepository, $myId),
            'comments' => array_map(fn (LiveComment $comment): array => $this->serializeComment($comment), $comments),
            'isHost' => $myId !== null && (int) $session->getHostUser()?->getUserId() === $myId,
        ]);
    }

    #[Route('/{id}/token', name: 'blog_live_token', methods: ['GET'], requirements: ['id' => '\\d+'])]
    public function token(int $id, LiveSessionRepository $sessionRepository): JsonResponse
    {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], Response::HTTP_UNAUTHORIZED);
        }

        $session = $sessionRepository->find($id);
        if (!$session instanceof LiveSession || $session->getStatus() !== 'live') {
            return $this->json(['ok' => false, 'message' => 'Live session not found.'], Response::HTTP_NOT_FOUND);
        }

        $apiKey = trim((string) ($_ENV['LIVEKIT_API_KEY'] ?? $_SERVER['LIVEKIT_API_KEY'] ?? ''));
        $apiSecret = trim((string) ($_ENV['LIVEKIT_API_SECRET'] ?? $_SERVER['LIVEKIT_API_SECRET'] ?? ''));
        $wsUrl = trim((string) ($_ENV['LIVEKIT_WS_URL'] ?? $_SERVER['LIVEKIT_WS_URL'] ?? ''));

        if ($apiKey === '' || $apiSecret === '' || $wsUrl === '') {
            $isDevEnv = (string) $this->getParameter('kernel.environment') === 'dev';
            if ($isDevEnv) {
                $apiKey = $apiKey !== '' ? $apiKey : 'devkey';
                $apiSecret = $apiSecret !== '' ? $apiSecret : 'devsecret';
                $wsUrl = $wsUrl !== '' ? $wsUrl : 'ws://127.0.0.1:7880';
            }
        }

        if ($apiKey === '' || $apiSecret === '' || $wsUrl === '') {
            return $this->json([
                'ok' => false,
                'message' => 'LiveKit is not configured. Set LIVEKIT_WS_URL, LIVEKIT_API_KEY and LIVEKIT_API_SECRET.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }

        $isHost = (int) $session->getHostUser()?->getUserId() === (int) $me->getUserId();
        $now = time();
        $identity = sprintf('u%d-live-%d-%d', (int) $me->getUserId(), (int) $session->getId(), $now);

        $claims = [
            'iss' => $apiKey,
            'sub' => $identity,
            'nbf' => $now - 5,
            'exp' => $now + 3600,
            'name' => $this->userDisplayName($me),
            'video' => [
                'roomJoin' => true,
                'room' => (string) $session->getRoomName(),
                'canPublish' => $isHost,
                'canSubscribe' => true,
                'canPublishData' => $isHost,
            ],
        ];

        $token = JWT::encode($claims, $apiSecret, 'HS256');

        return $this->json([
            'ok' => true,
            'wsUrl' => $wsUrl,
            'roomName' => (string) $session->getRoomName(),
            'token' => $token,
            'identity' => $identity,
            'isHost' => $isHost,
        ]);
    }

    #[Route('/{id}/recording', name: 'blog_live_recording_upload', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function uploadRecording(int $id, Request $request, LiveSessionRepository $sessionRepository, EntityManagerInterface $em): JsonResponse
    {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], Response::HTTP_UNAUTHORIZED);
        }

        $session = $sessionRepository->find($id);
        if (!$session instanceof LiveSession) {
            return $this->json(['ok' => false, 'message' => 'Live session not found.'], Response::HTTP_NOT_FOUND);
        }

        if ((int) $session->getHostUser()?->getUserId() !== (int) $me->getUserId()) {
            return $this->json(['ok' => false, 'message' => 'Only host can upload recording.'], Response::HTTP_FORBIDDEN);
        }

        $allowed = ['webm', 'mp4', 'mov', 'mkv'];
        $targetDir = (string) $this->getParameter('kernel.project_dir') . '/public/uploads/live_recordings';
        $tmpDir = (string) $this->getParameter('kernel.project_dir') . '/var/live_recordings_tmp';

        if (!is_dir($targetDir)) {
            @mkdir($targetDir, 0775, true);
        }
        if (!is_dir($tmpDir)) {
            @mkdir($tmpDir, 0775, true);
        }

        if (!is_dir($targetDir) || !is_dir($tmpDir)) {
            return $this->json(['ok' => false, 'message' => 'Could not prepare recording storage.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $chunk = $request->files->get('recordingChunk');
        $uploadId = trim((string) $request->request->get('uploadId', ''));
        $chunkIndex = (int) $request->request->get('chunkIndex', -1);
        $totalChunks = (int) $request->request->get('totalChunks', 0);
        $extFromClient = strtolower(trim((string) $request->request->get('ext', 'webm')));

        if ($chunk instanceof UploadedFile && $uploadId !== '' && $chunkIndex >= 0 && $totalChunks > 0) {
            if (!in_array($extFromClient, $allowed, true)) {
                $extFromClient = 'webm';
            }

            $safeUploadId = preg_replace('/[^a-zA-Z0-9_-]/', '', $uploadId) ?: bin2hex(random_bytes(6));
            $tmpPath = sprintf('%s/live-%d-u%d-%s.part', $tmpDir, (int) $session->getId(), (int) $me->getUserId(), $safeUploadId);

            if ($chunkIndex === 0 && is_file($tmpPath)) {
                @unlink($tmpPath);
            }

            $chunkData = @file_get_contents($chunk->getPathname());
            if ($chunkData === false) {
                return $this->json(['ok' => false, 'message' => 'Could not read recording chunk.'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            if (@file_put_contents($tmpPath, $chunkData, FILE_APPEND) === false) {
                return $this->json(['ok' => false, 'message' => 'Could not write recording chunk.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            if ($chunkIndex < $totalChunks - 1) {
                return $this->json(['ok' => true, 'chunkStored' => true]);
            }

            $finalName = sprintf('live-%d-%d.%s', (int) $session->getId(), time(), $extFromClient);
            $finalPath = $targetDir . '/' . $finalName;
            if (!@rename($tmpPath, $finalPath)) {
                return $this->json(['ok' => false, 'message' => 'Could not finalize recording file.'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $session->setRecordingUrl('/uploads/live_recordings/' . $finalName);
            $session->setUpdatedAt(new \DateTimeImmutable());
            $em->flush();

            return $this->json([
                'ok' => true,
                'recordingUrl' => $session->getRecordingUrl(),
            ]);
        }

        $recording = $request->files->get('recording');
        if (!$recording instanceof UploadedFile) {
            return $this->json(['ok' => false, 'message' => 'Recording file is required.'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($recording->getSize() !== null && $recording->getSize() > 512 * 1024 * 1024) {
            return $this->json(['ok' => false, 'message' => 'Recording is too large (max 512MB).'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $ext = strtolower((string) ($recording->guessExtension() ?: $recording->getClientOriginalExtension() ?: 'webm'));
        if (!in_array($ext, $allowed, true)) {
            $ext = 'webm';
        }

        $fileName = sprintf('live-%d-%d.%s', (int) $session->getId(), time(), $ext);
        $recording->move($targetDir, $fileName);

        $session->setRecordingUrl('/uploads/live_recordings/' . $fileName);
        $session->setUpdatedAt(new \DateTimeImmutable());
        $em->flush();

        return $this->json([
            'ok' => true,
            'recordingUrl' => $session->getRecordingUrl(),
        ]);
    }

    #[Route('/{id}/delete', name: 'blog_live_delete', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function delete(int $id, LiveSessionRepository $sessionRepository, EntityManagerInterface $em): JsonResponse
    {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], Response::HTTP_UNAUTHORIZED);
        }

        $session = $sessionRepository->find($id);
        if (!$session instanceof LiveSession) {
            return $this->json(['ok' => false, 'message' => 'Live session not found.'], Response::HTTP_NOT_FOUND);
        }

        if ((int) $session->getHostUser()?->getUserId() !== (int) $me->getUserId()) {
            return $this->json(['ok' => false, 'message' => 'Only host can delete this live.'], Response::HTTP_FORBIDDEN);
        }

        if ((string) $session->getStatus() === 'live') {
            return $this->json(['ok' => false, 'message' => 'End the live before deleting it.'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $deletedId = (int) $session->getId();
        $this->removeSessionWithRelations($session, $em);

        return $this->json([
            'ok' => true,
            'id' => $deletedId,
        ]);
    }

    #[Route('/{id}/dismiss-removed', name: 'blog_live_dismiss_removed', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function dismissRemoved(int $id, LiveSessionRepository $sessionRepository, EntityManagerInterface $em): JsonResponse
    {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], Response::HTTP_UNAUTHORIZED);
        }

        $session = $sessionRepository->find($id);
        if (!$session instanceof LiveSession || !$session->isRemovedByAdmin() || !$session->isSavedToProfile()) {
            return $this->json(['ok' => false, 'message' => 'Live session not found.'], Response::HTTP_NOT_FOUND);
        }

        if ((int) $session->getHostUser()?->getUserId() !== (int) $me->getUserId()) {
            return $this->json(['ok' => false, 'message' => 'Only host can remove this placeholder.'], Response::HTTP_FORBIDDEN);
        }

        $deletedId = (int) $session->getId();
        $this->removeSessionWithRelations($session, $em);

        return $this->json([
            'ok' => true,
            'id' => $deletedId,
        ]);
    }

    private function removeSessionWithRelations(LiveSession $session, EntityManagerInterface $em): void
    {
        $recordingUrl = (string) ($session->getRecordingUrl() ?? '');
        if (str_starts_with($recordingUrl, '/uploads/live_recordings/')) {
            $recordingPath = (string) $this->getParameter('kernel.project_dir') . '/public' . $recordingUrl;
            if (is_file($recordingPath)) {
                @unlink($recordingPath);
            }
        }

        $em->createQuery('DELETE FROM App\\Entity\\LiveComment c WHERE c.liveSession = :session')
            ->setParameter('session', $session)
            ->execute();
        $em->createQuery('DELETE FROM App\\Entity\\Reaction r WHERE r.live_session_id = :sid')
            ->setParameter('sid', (int) $session->getId())
            ->execute();
        $em->createQuery('DELETE FROM App\\Entity\\LiveSessionViewer v WHERE v.liveSession = :session')
            ->setParameter('session', $session)
            ->execute();

        $em->remove($session);
        $em->flush();
    }

    private function serializeSessionCard(
        LiveSession $session,
        LiveSessionViewerRepository $viewerRepository,
        ReactionRepository $reactionRepository,
        ?int $myId
    ): array {
        $host = $session->getHostUser();
        $hostId = $host?->getUserId();
        $viewerCount = $viewerRepository->countActiveBySession($session);
        $reactionCounts = $reactionRepository->countByTypeForSession($session);

        return [
            'id' => $session->getId(),
            'title' => (string) ($session->getTitle() ?? ''),
            'status' => (string) $session->getStatus(),
            'roomName' => (string) ($session->getRoomName() ?? ''),
            'thumbnailUrl' => (string) ($session->getThumbnailUrl() ?? ''),
            'recordingUrl' => (string) ($session->getRecordingUrl() ?? ''),
            'startedAt' => $session->getStartedAt()?->format(DATE_ATOM),
            'endedAt' => $session->getEndedAt()?->format(DATE_ATOM),
            'savedToProfile' => $session->isSavedToProfile(),
            'savedToProfileAt' => $session->getSavedToProfileAt()?->format(DATE_ATOM),
            'host' => [
                'id' => $hostId,
                'name' => $this->userDisplayName($host),
            ],
            'viewerCount' => $viewerCount,
            'reactionCounts' => $reactionCounts,
            'totalReactions' => array_sum($reactionCounts),
            'isHost' => $myId !== null && (int) $hostId === $myId,
        ];
    }

    private function serializeComment(LiveComment $comment): array
    {
        $user = $comment->getUser();

        return [
            'id' => $comment->getId(),
            'message' => (string) ($comment->getMessage() ?? ''),
            'createdAt' => $comment->getCreatedAt()?->format(DATE_ATOM),
            'user' => [
                'id' => $user?->getUserId(),
                'name' => $this->userDisplayName($user),
            ],
        ];
    }

    private function userDisplayName(?User $user): string
    {
        if (!$user instanceof User) {
            return 'User';
        }

        $name = trim((string) $user->getFirstName() . ' ' . (string) $user->getLastName());
        if ($name !== '') {
            return $name;
        }

        return 'User #' . $user->getUserId();
    }
}
