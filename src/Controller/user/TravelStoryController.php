<?php

namespace App\Controller\user;

use App\Entity\TravelStory;
use App\Form\TravelStoryType;
use App\Repository\TravelStoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
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
        $travelStory = new TravelStory();

        // Set userId BEFORE form handling so NotNull validation passes
        $travelStory->setUserId(
            $this->getUser() && method_exists($this->getUser(), 'getId')
                ? $this->getUser()->getId()
                : 1
        );

        $form = $this->createForm(TravelStoryType::class, $travelStory);
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

            return $this->redirectToRoute('travel_story_index');
        }

        return $this->render('front/blog/travel_story_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'travel_story_show', methods: ['GET'])]
    public function show(TravelStory $travelStory): Response
    {
        return $this->render('front/blog/travel_story_show.html.twig', [
            'story' => $travelStory,
        ]);
    }

    #[Route('/{id}/edit', name: 'travel_story_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        TravelStory $travelStory,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response {
        $form = $this->createForm(TravelStoryType::class, $travelStory);
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
}