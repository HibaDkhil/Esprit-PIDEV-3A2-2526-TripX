<?php

namespace App\Controller\user;

use App\Entity\User;
use App\Repository\FollowingRepository;
use App\Repository\PostRepository;
use App\Repository\StoryRepository;
use App\Repository\TravelStoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    private function normalizeTab(string $tab): string
    {
        $normalized = strtolower(trim($tab));

        return match ($normalized) {
            'posts' => 'posts',
            'travel_stories' => 'travel_stories',
            'shared' => 'shared',
            default => 'shared',
        };
    }

    #[Route('/blog/legacy-profile/{id}', name: 'legacy_blog_user_profile', methods: ['GET'], requirements: ['id' => '\\d+'])]
    public function show(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        PostRepository $postRepository,
        TravelStoryRepository $travelStoryRepository,
        FollowingRepository $followingRepository,
        StoryRepository $storyRepository
    ): Response {
        $target = $em->getRepository(User::class)->find($id);
        if (!$target instanceof User) {
            throw $this->createNotFoundException('User not found');
        }

        /** @var User|null $me */
        $me = $this->getUser();
        $myId = $me instanceof User ? (int) $me->getUserId() : null;
        $isSelf = $myId !== null && $myId === (int) $target->getUserId();

        $tab = $this->normalizeTab((string) $request->query->get('tab', 'shared'));

        $posts = $postRepository->findPublicByUserId((int) $target->getUserId());
        $travelStories = $travelStoryRepository->findByUserId((int) $target->getUserId());

        $shared = [];
        foreach ($posts as $post) {
            $shared[] = [
                'kind' => 'post',
                'entity' => $post,
                'createdAt' => $post->getCreatedAt() ?? new \DateTime('2000-01-01'),
            ];
        }
        foreach ($travelStories as $story) {
            $shared[] = [
                'kind' => 'travel_story',
                'entity' => $story,
                'createdAt' => $story->getCreatedAt() ?? new \DateTime('2000-01-01'),
            ];
        }
        usort($shared, static fn(array $a, array $b): int => $b['createdAt'] <=> $a['createdAt']);

        $followersCount = (int) $followingRepository->count(['followed_id' => (int) $target->getUserId()]);
        $followingCount = (int) $followingRepository->count(['follower_id' => (int) $target->getUserId()]);

        $isFollowing = false;
        if ($myId !== null && !$isSelf) {
            $isFollowing = $followingRepository->findOneBy([
                'follower_id' => $myId,
                'followed_id' => (int) $target->getUserId(),
            ]) !== null;
        }

        $activeStoriesCount = count($storyRepository->findActiveForUser((int) $target->getUserId()));

        return $this->render('front/blog/blog_profile.html.twig', [
            'target' => $target,
            'tab' => $tab,
            'posts' => $posts,
            'travelStories' => $travelStories,
            'shared' => $shared,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
            'isFollowing' => $isFollowing,
            'isSelf' => $isSelf,
            'activeStoriesCount' => $activeStoriesCount,
        ]);
    }

    #[Route('/blog/legacy-profile/{id}/archive', name: 'legacy_blog_user_archive', methods: ['GET'], requirements: ['id' => '\\d+'])]
    public function archive(int $id, EntityManagerInterface $em, StoryRepository $storyRepository): Response
    {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User || (int) $me->getUserId() !== $id) {
            throw $this->createAccessDeniedException('Archive is only available on your own profile.');
        }

        $target = $em->getRepository(User::class)->find($id);
        if (!$target instanceof User) {
            throw $this->createNotFoundException('User not found');
        }

        $expiredStories = $storyRepository->findExpiredForUser($id);

        return $this->render('front/blog/blog_profile_archive.html.twig', [
            'target' => $target,
            'expiredStories' => $expiredStories,
        ]);
    }

    #[Route('/blog/legacy-profile/edit', name: 'legacy_blog_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        if ($request->isMethod('POST')) {
            $firstName = trim((string) $request->request->get('firstName', ''));
            $lastName = trim((string) $request->request->get('lastName', ''));
            $bio = trim((string) $request->request->get('bio', ''));
            $phoneNumber = trim((string) $request->request->get('phoneNumber', ''));

            if ($firstName !== '') {
                $me->setFirstName($firstName);
            }
            if ($lastName !== '') {
                $me->setLastName($lastName);
            }

            $me->setBio($bio !== '' ? $bio : null);
            $me->setPhoneNumber($phoneNumber !== '' ? $phoneNumber : null);
            $me->setUpdatedAt(new \DateTimeImmutable());

            $em->flush();
            $this->addFlash('success', 'Profile updated.');

            return $this->redirectToRoute('blog_user_profile', ['id' => $me->getUserId()]);
        }

        return $this->render('front/blog/blog_profile_edit.html.twig', [
            'me' => $me,
        ]);
    }
}
