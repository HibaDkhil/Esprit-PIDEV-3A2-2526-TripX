<?php

namespace App\Controller\user;

use App\Entity\BlogProfile;
use App\Entity\User;
use App\Repository\BlogProfileRepository;
use App\Repository\FollowingRepository;
use App\Repository\LiveSessionRepository;
use App\Repository\PostRepository;
use App\Repository\StoryRepository;
use App\Repository\TravelStoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogProfileController extends AbstractController
{
    private function defaultUserNameFromUser(User $user): string
    {
        $name = trim((string) $user->getFirstName() . ' ' . (string) $user->getLastName());

        return $name !== '' ? $name : 'user_' . (int) $user->getUserId();
    }

    private function normalizeTab(string $tab): string
    {
        $normalized = strtolower(trim($tab));

        return match ($normalized) {
            'posts' => 'posts',
            'travel_stories' => 'travel_stories',
            'shared' => 'shared',
            'lives' => 'lives',
            default => 'shared',
        };
    }

    #[Route('/blog/profile/{id}', name: 'blog_user_profile', methods: ['GET'], requirements: ['id' => '\\d+'])]
    public function show(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        PostRepository $postRepository,
        TravelStoryRepository $travelStoryRepository,
        LiveSessionRepository $liveSessionRepository,
        FollowingRepository $followingRepository,
        StoryRepository $storyRepository,
        BlogProfileRepository $blogProfileRepository
    ): Response {
        $target = $em->getRepository(User::class)->find($id);
        if (!$target instanceof User) {
            throw $this->createNotFoundException('User not found');
        }

        /** @var User|null $me */
        $me = $this->getUser();
        $myId = $me instanceof User ? (int) $me->getUserId() : null;
        $isSelf = $myId !== null && $myId === (int) $target->getUserId();

        $blogProfile = $blogProfileRepository->findOneByUserId((int) $target->getUserId());

        $tab = $this->normalizeTab((string) $request->query->get('tab', 'shared'));

        $followersCount = (int) $followingRepository->count(['followed_id' => (int) $target->getUserId()]);
        $followingCount = (int) $followingRepository->count(['follower_id' => (int) $target->getUserId()]);

        $isFollowing = false;
        if ($myId !== null && !$isSelf) {
            $isFollowing = $followingRepository->findOneBy([
                'follower_id' => $myId,
                'followed_id' => (int) $target->getUserId(),
            ]) !== null;
        }

        $canViewContent = $isSelf || $isFollowing;

        $posts = [];
        $travelStories = [];
        $savedLives = [];
        $shared = [];

        if ($canViewContent) {
            $posts = $postRepository->findPublicByUserId((int) $target->getUserId());
            $travelStories = $travelStoryRepository->findByUserId((int) $target->getUserId());

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

            $savedLives = $liveSessionRepository->findSavedEndedByHostUserId((int) $target->getUserId(), 48, $isSelf);
            usort($shared, static fn(array $a, array $b): int => $b['createdAt'] <=> $a['createdAt']);
        }

        $activeStoriesCount = count($storyRepository->findActiveForUser((int) $target->getUserId()));

        return $this->render('front/blog/blog_profile.html.twig', [
            'target' => $target,
            'blogProfile' => $blogProfile,
            'tab' => $tab,
            'posts' => $posts,
            'travelStories' => $travelStories,
            'savedLives' => $savedLives,
            'shared' => $shared,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
            'isFollowing' => $isFollowing,
            'isSelf' => $isSelf,
            'canViewContent' => $canViewContent,
            'activeStoriesCount' => $activeStoriesCount,
        ]);
    }

    #[Route('/blog/profile/{id}/archive', name: 'blog_user_archive', methods: ['GET'], requirements: ['id' => '\\d+'])]
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

    #[Route('/blog/profile/edit', name: 'blog_profile_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        EntityManagerInterface $em,
        BlogProfileRepository $blogProfileRepository
    ): Response {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $profile = $blogProfileRepository->findOneByUserId((int) $me->getUserId());
        if (!$profile instanceof BlogProfile) {
            $profile = (new BlogProfile())
                ->setUser($me)
                ->setUserName($this->defaultUserNameFromUser($me))
                ->setBio($me->getBio())
                ->setAvatarId($me->getAvatarId());
            $em->persist($profile);
        }

        if ($request->isMethod('POST')) {
            $userName = trim((string) $request->request->get('userName', ''));
            $bio = trim((string) $request->request->get('bio', ''));
            $avatarIdRaw = trim((string) $request->request->get('avatarId', ''));
            $avatarId = $avatarIdRaw === '' ? null : (int) $avatarIdRaw;

            if ($avatarId !== null && $avatarId <= 0) {
                $avatarId = null;
            }

            if ($userName === '') {
                $userName = $this->defaultUserNameFromUser($me);
            }

            $profile
                ->setUserName($userName)
                ->setBio($bio !== '' ? $bio : null)
                ->setAvatarId($avatarId)
                ->setUpdatedAt(new \DateTimeImmutable());

            $em->flush();
            $this->addFlash('success', 'Blog profile updated.');

            return $this->redirectToRoute('blog_user_profile', ['id' => $me->getUserId()]);
        }

        return $this->render('front/blog/blog_profile_edit.html.twig', [
            'me' => $me,
            'profile' => $profile,
        ]);
    }
}
