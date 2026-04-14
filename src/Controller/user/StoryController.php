<?php

namespace App\Controller\user;

use App\Entity\Story;
use App\Entity\StoryView;
use App\Entity\User;
use App\Repository\StoryRepository;
use App\Repository\StoryViewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/stories')]
class StoryController extends AbstractController
{
	#[Route('/create', name: 'story_create', methods: ['POST'])]
	public function create(
		Request $request,
		EntityManagerInterface $em,
		SluggerInterface $slugger
	): JsonResponse|RedirectResponse {
		/** @var User|null $me */
		$me = $this->getUser();
		if (!$me instanceof User) {
			return $this->json(['ok' => false, 'message' => 'Authentication required.'], 401);
		}

		$file = $request->files->get('story_image');
		if ($file === null) {
			return $this->json(['ok' => false, 'message' => 'Please select an image.'], 422);
		}

		$mime = (string) $file->getMimeType();
		if (!str_starts_with($mime, 'image/')) {
			return $this->json(['ok' => false, 'message' => 'Only image files are allowed.'], 422);
		}

		$uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/stories';
		(new Filesystem())->mkdir($uploadDir);

		$originalName = pathinfo((string) $file->getClientOriginalName(), PATHINFO_FILENAME);
		$safeBase = (string) $slugger->slug($originalName);
		$ext = $file->guessExtension() ?: $file->getClientOriginalExtension() ?: 'jpg';
		$newName = ($safeBase !== '' ? $safeBase : 'story') . '-' . uniqid('', true) . '.' . $ext;

		$file->move($uploadDir, $newName);

		$now = new \DateTimeImmutable();
		$story = new Story();
		$story->setUser($me);
		$story->setImageUrl('/uploads/stories/' . $newName);
		$story->setCaption(trim((string) $request->request->get('caption', '')) ?: null);
		$story->setCreatedAt($now);
		$story->setExpiresAt($now->modify('+24 hours'));

		$em->persist($story);
		$em->flush();

		$name = trim((string) $me->getFirstName() . ' ' . (string) $me->getLastName());

		return $this->json([
			'ok' => true,
			'story' => [
				'id' => $story->getId(),
				'imageUrl' => $story->getImageUrl(),
				'caption' => $story->getCaption() ?? '',
				'createdAt' => $story->getCreatedAt()?->format(DATE_ATOM),
				'expiresAt' => $story->getExpiresAt()?->format(DATE_ATOM),
				'userId' => $me->getUserId(),
				'userName' => $name !== '' ? $name : 'User #' . $me->getUserId(),
			],
		]);
	}

	#[Route('/user/{id}', name: 'story_user_list', methods: ['GET'], requirements: ['id' => '\\d+'])]
	public function listByUser(int $id, StoryRepository $storyRepository): JsonResponse
	{
		$stories = $storyRepository->findActiveForUser($id);
		$payload = array_map(static function (Story $story): array {
			return [
				'id' => $story->getId(),
				'imageUrl' => $story->getImageUrl(),
				'caption' => $story->getCaption() ?? '',
				'createdAt' => $story->getCreatedAt()?->format(DATE_ATOM),
				'expiresAt' => $story->getExpiresAt()?->format(DATE_ATOM),
			];
		}, $stories);

		return $this->json([
			'ok' => true,
			'stories' => $payload,
		]);
	}

	#[Route('/{id}/delete', name: 'story_delete', methods: ['POST'], requirements: ['id' => '\\d+'])]
	public function delete(int $id, Request $request, EntityManagerInterface $em): JsonResponse
	{
		/** @var User|null $me */
		$me = $this->getUser();
		if (!$me instanceof User) {
			return $this->json(['ok' => false, 'message' => 'Authentication required.'], 401);
		}

		$story = $em->getRepository(Story::class)->find($id);
		if (!$story instanceof Story) {
			return $this->json(['ok' => false, 'message' => 'Story not found.'], 404);
		}

		if ((int) $story->getUserId() !== (int) $me->getUserId()) {
			return $this->json(['ok' => false, 'message' => 'Not allowed.'], 403);
		}

		if (!$this->isCsrfTokenValid('delete_story_' . $id, (string) $request->request->get('_token'))) {
			return $this->json(['ok' => false, 'message' => 'Invalid token.'], 400);
		}

		$imagePath = (string) $story->getImageUrl();
		if (str_starts_with($imagePath, '/uploads/stories/')) {
			$abs = $this->getParameter('kernel.project_dir') . '/public' . $imagePath;
			if (is_file($abs)) {
				(new Filesystem())->remove($abs);
			}
		}

		$em->remove($story);
		$em->flush();

		return $this->json(['ok' => true]);
	}

	#[Route('/{id}/seen', name: 'story_seen_mark', methods: ['POST'], requirements: ['id' => '\\d+'])]
	public function markSeen(int $id, EntityManagerInterface $em): JsonResponse
	{
		/** @var User|null $me */
		$me = $this->getUser();
		if (!$me instanceof User) {
			return $this->json(['ok' => false, 'message' => 'Authentication required.'], 401);
		}

		$story = $em->getRepository(Story::class)->find($id);
		if (!$story instanceof Story || $story->isExpired()) {
			return $this->json(['ok' => false, 'message' => 'Story not found.'], 404);
		}

		if ((int) $story->getUserId() === (int) $me->getUserId()) {
			return $this->json(['ok' => true, 'selfView' => true]);
		}

		$existing = $em->getRepository(StoryView::class)->findOneBy([
			'story' => $story,
			'viewer' => $me,
		]);

		if (!$existing instanceof StoryView) {
			$existing = new StoryView();
			$existing->setStory($story);
			$existing->setViewer($me);
			$existing->setSeenAt(new \DateTimeImmutable());
			$em->persist($existing);
			$em->flush();
		}

		return $this->json(['ok' => true]);
	}

	#[Route('/{id}/viewers', name: 'story_viewers_list', methods: ['GET'], requirements: ['id' => '\\d+'])]
	public function viewers(int $id, EntityManagerInterface $em, StoryViewRepository $storyViewRepository): JsonResponse
	{
		/** @var User|null $me */
		$me = $this->getUser();
		if (!$me instanceof User) {
			return $this->json(['ok' => false, 'message' => 'Authentication required.'], 401);
		}

		$story = $em->getRepository(Story::class)->find($id);
		if (!$story instanceof Story || $story->isExpired()) {
			return $this->json(['ok' => false, 'message' => 'Story not found.'], 404);
		}

		if ((int) $story->getUserId() !== (int) $me->getUserId()) {
			return $this->json(['ok' => false, 'message' => 'Not allowed.'], 403);
		}

		$viewers = $storyViewRepository->findViewersForStory((int) $story->getId(), (int) $me->getUserId());

		return $this->json([
			'ok' => true,
			'count' => count($viewers),
			'viewers' => $viewers,
		]);
	}
}
