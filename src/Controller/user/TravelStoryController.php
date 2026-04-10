<?php

namespace App\Controller\user;

use App\Entity\TravelStory;
use App\Entity\User;
use App\Form\TravelStoryType;
use App\Repository\TravelStoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/travel-stories')]
class TravelStoryController extends AbstractController
{
    #[Route('', name: 'travel_story_index', methods: ['GET'])]
    public function index(Request $request, TravelStoryRepository $travelStoryRepository): Response
    {
        $keyword = $request->query->get('keyword');
        $destination = $request->query->get('destination');
        $travelType = $request->query->get('travelType');
        $travelStyle = $request->query->get('travelStyle');
        $rating = $request->query->get('rating');

        if ($destination || $travelType || $travelStyle || $rating) {
            $stories = $travelStoryRepository->filterStories(
                $destination,
                $travelType,
                $travelStyle,
                $rating ? (int) $rating : null
            );
        } else {
            $stories = $travelStoryRepository->searchByKeyword($keyword);
        }

        return $this->render('front/blog/travel_story_index.html.twig', [
            'stories' => $stories,
        ]);
    }

    #[Route('/new', name: 'travel_story_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response {
        $user = $this->getAuthenticatedUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $travelStory = new TravelStory();
        $travelStory->setUserId($user->getId());

        $form = $this->createForm(TravelStoryType::class, $travelStory);
        $this->populateSupplementalFields($form, $travelStory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $travelStory->setTagsJson($this->textToArray($form->get('tagsText')->getData()));
            $travelStory->setMustVisitJson($this->textToArray($form->get('mustVisitText')->getData()));
            $travelStory->setMustDoJson($this->textToArray($form->get('mustDoText')->getData()));
            $travelStory->setMustTryJson($this->textToArray($form->get('mustTryText')->getData()));
            $travelStory->setFavoritePlacesJson($this->textToArray($form->get('favoritePlacesText')->getData()));

            $budgetRaw = $form->get('budgetText')->getData();
            if ($budgetRaw) {
                $decoded = json_decode($budgetRaw, true);
                $travelStory->setBudgetJson(is_array($decoded) ? $decoded : []);
            } else {
                $travelStory->setBudgetJson([]);
            }

            $uploadedImages = $form->get('imageFile')->getData();
            $savedImagePaths = [];

            if (!empty($uploadedImages)) {
                $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/travel_stories';
                $filesystem = new Filesystem();
                $filesystem->mkdir($uploadDir);

                foreach ($uploadedImages as $uploadedFile) {
                    if ($uploadedFile === null) {
                        continue;
                    }

                    $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid('', true) . '.' . ($uploadedFile->getClientOriginalExtension() ?: 'jpg');

                    try {
                        $uploadedFile->move($uploadDir, $newFilename);
                        $savedImagePaths[] = '/uploads/travel_stories/' . $newFilename;
                    } catch (FileException $e) {
                        $this->addFlash('error', 'One of the images could not be uploaded.');
                    }
                }
            }

            $travelStory->setImageUrlsJson($savedImagePaths);
            $travelStory->setCoverImageUrl($savedImagePaths[0] ?? null);

            if ($travelStory->getCreatedAt() === null) {
                $travelStory->setCreatedAt(new \DateTime());
            }
            $travelStory->setUpdatedAt(new \DateTime());

            $entityManager->persist($travelStory);
            $entityManager->flush();

            $this->addFlash('success', 'Travel story created successfully.');

            return $this->redirectToRoute('blog');
        }

        return $this->render('front/blog/travel_story_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'travel_story_show', methods: ['GET'])]
    public function show(TravelStory $travelStory, EntityManagerInterface $entityManager): Response
    {
        $author = $entityManager->getRepository(User::class)->find($travelStory->getUserId());
        $authorName = $author instanceof User
            ? trim((string) $author->getFirstName() . ' ' . (string) $author->getLastName())
            : '';

        return $this->render('front/blog/travel_story_show.html.twig', [
            'story' => $travelStory,
            'authorName' => $authorName !== '' ? $authorName : 'Traveler #' . $travelStory->getUserId(),
            'tripLengthDays' => $this->calculateTripLengthDays($travelStory),
            'canManageStory' => $this->canManageStory($travelStory),
        ]);
    }

    #[Route('/{id}/edit', name: 'travel_story_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        TravelStory $travelStory,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response {
        $user = $this->getAuthenticatedUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }
        if (!$this->canManageStory($travelStory)) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(TravelStoryType::class, $travelStory);
        $this->populateSupplementalFields($form, $travelStory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $travelStory->setTagsJson($this->textToArray($form->get('tagsText')->getData()));
            $travelStory->setMustVisitJson($this->textToArray($form->get('mustVisitText')->getData()));
            $travelStory->setMustDoJson($this->textToArray($form->get('mustDoText')->getData()));
            $travelStory->setMustTryJson($this->textToArray($form->get('mustTryText')->getData()));
            $travelStory->setFavoritePlacesJson($this->textToArray($form->get('favoritePlacesText')->getData()));

            $budgetRaw = $form->get('budgetText')->getData();
            if ($budgetRaw) {
                $decoded = json_decode($budgetRaw, true);
                $travelStory->setBudgetJson(is_array($decoded) ? $decoded : []);
            } else {
                $travelStory->setBudgetJson([]);
            }

            $existingImages = $travelStory->getImageUrlsJson() ?? [];
            $uploadedImages = $form->get('imageFile')->getData();

            if (!empty($uploadedImages)) {
                $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/travel_stories';
                $filesystem = new Filesystem();
                $filesystem->mkdir($uploadDir);

                foreach ($uploadedImages as $uploadedFile) {
                    if ($uploadedFile === null) {
                        continue;
                    }

                    $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid('', true) . '.' . ($uploadedFile->getClientOriginalExtension() ?: 'jpg');

                    try {
                        $uploadedFile->move($uploadDir, $newFilename);
                        $existingImages[] = '/uploads/travel_stories/' . $newFilename;
                    } catch (FileException $e) {
                        $this->addFlash('error', 'One of the images could not be uploaded.');
                    }
                }
            }

            $existingImages = array_values(array_unique(array_filter($existingImages)));
            $travelStory->setImageUrlsJson($existingImages);
            $travelStory->setCoverImageUrl($existingImages[0] ?? $travelStory->getCoverImageUrl());
            $travelStory->setUpdatedAt(new \DateTime());

            $entityManager->flush();

            $this->addFlash('success', 'Travel story updated successfully.');

            return $this->redirectToRoute('travel_story_show', [
                'id' => $travelStory->getId(),
            ]);
        }

        return $this->render('front/blog/travel_story_new.html.twig', [
            'form' => $form->createView(),
            'story' => $travelStory,
        ]);
    }

    #[Route('/{id}/delete', name: 'travel_story_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        TravelStory $travelStory,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getAuthenticatedUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }
        if (!$this->canManageStory($travelStory)) {
            throw $this->createAccessDeniedException();
        }

        if (!$this->isCsrfTokenValid('delete_travel_story_' . $travelStory->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid delete request.');

            return $this->redirectToRoute('travel_story_show', [
                'id' => $travelStory->getId(),
            ]);
        }

        $this->removeUploadedImages($travelStory);
        $entityManager->remove($travelStory);
        $entityManager->flush();

        $this->addFlash('success', 'Travel story deleted.');

        return $this->redirectToRoute('travel_story_index');
    }

    private function textToArray(?string $text): array
    {
        if (!$text) {
            return [];
        }

        $items = preg_split('/[\r\n,]+/', $text);
        $items = array_map('trim', $items);
        $items = array_filter($items, static fn ($item) => $item !== '');

        return array_values($items);
    }

    private function arrayToTextarea(?array $items): string
    {
        if (empty($items)) {
            return '';
        }

        return implode("\n", array_filter(array_map(static fn ($item) => is_scalar($item) ? trim((string) $item) : '', $items)));
    }

    private function populateSupplementalFields(FormInterface $form, TravelStory $travelStory): void
    {
        $form->get('tagsText')->setData($this->arrayToTextarea($travelStory->getTagsJson()));
        $form->get('favoritePlacesText')->setData($this->arrayToTextarea($travelStory->getFavoritePlacesJson()));
        $form->get('mustVisitText')->setData($this->arrayToTextarea($travelStory->getMustVisitJson()));
        $form->get('mustDoText')->setData($this->arrayToTextarea($travelStory->getMustDoJson()));
        $form->get('mustTryText')->setData($this->arrayToTextarea($travelStory->getMustTryJson()));

        $budgetJson = $travelStory->getBudgetJson();
        $form->get('budgetText')->setData(
            !empty($budgetJson)
                ? (json_encode($budgetJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?: '')
                : ''
        );
    }

    private function getAuthenticatedUser(): ?User
    {
        $user = $this->getUser();

        return $user instanceof User ? $user : null;
    }

    private function canManageStory(TravelStory $travelStory): bool
    {
        $user = $this->getAuthenticatedUser();
        if (!$user instanceof User) {
            return false;
        }

        return $travelStory->getUserId() === $user->getId()
            || $this->isGranted('ROLE_ADMIN')
            || $this->isGranted('ROLE_ADMIN_BLOG');
    }

    private function calculateTripLengthDays(TravelStory $travelStory): ?int
    {
        $startDate = $travelStory->getStartDate();
        $endDate = $travelStory->getEndDate();

        if (!$startDate instanceof \DateTimeInterface || !$endDate instanceof \DateTimeInterface) {
            return null;
        }

        return ((int) $startDate->diff($endDate)->format('%a')) + 1;
    }

    private function removeUploadedImages(TravelStory $travelStory): void
    {
        $projectDir = (string) $this->getParameter('kernel.project_dir');
        $filesystem = new Filesystem();
        $paths = array_unique(array_filter(array_merge(
            $travelStory->getImageUrlsJson() ?? [],
            [$travelStory->getCoverImageUrl()]
        )));

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
}
