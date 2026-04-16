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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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

    #[Route('/ai-assist', name: 'travel_story_ai_assist', methods: ['POST'])]
    public function aiAssist(Request $request, HttpClientInterface $httpClient): JsonResponse
    {
        $user = $this->getAuthenticatedUser();
        if (!$user instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], 401);
        }

        $payload = json_decode($request->getContent(), true);
        if (!is_array($payload)) {
            return $this->json(['ok' => false, 'message' => 'Invalid request payload.'], 400);
        }

        $mode = (string) ($payload['mode'] ?? '');
        if (!in_array($mode, ['spelling', 'summary'], true)) {
            return $this->json(['ok' => false, 'message' => 'Invalid AI mode.'], 400);
        }

        $title = trim((string) ($payload['title'] ?? ''));
        $destination = trim((string) ($payload['destination'] ?? ''));
        $summary = trim((string) ($payload['summary'] ?? ''));
        $tips = trim((string) ($payload['tips'] ?? ''));

        if ($mode === 'summary' && ($title === '' || $destination === '')) {
            return $this->json([
                'ok' => false,
                'message' => 'Please provide both title and destination to generate a summary.'
            ], 400);
        }

        $apiKey = $this->resolveGroqApiKey();
        if (!$apiKey) {
            if ($mode === 'spelling') {
                return $this->json([
                    'ok' => false,
                    'message' => 'AI spelling correction is unavailable (missing GROQ_API_KEY or TRANSPORTAI).'
                ], 503);
            }

            return $this->json($this->fallbackAiAssist($mode, $title, $destination, $summary, $tips));
        }

        try {
            $response = $httpClient->request('POST', 'https://api.groq.com/openai/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'llama-3.1-8b-instant',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $mode === 'spelling'
                                ? 'You are a writing assistant for travel stories. Correct spelling and grammar while preserving meaning and tone. Return ONLY a valid JSON object with keys: title, summary, tips.'
                                : 'You are a travel writing assistant. Generate a concise, engaging travel story summary based on title and destination. Return ONLY a valid JSON object with key: summary.'
                        ],
                        [
                            'role' => 'user',
                            'content' => json_encode([
                                'title' => $title,
                                'destination' => $destination,
                                'summary' => $summary,
                                'tips' => $tips,
                            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
                        ]
                    ],
                    'temperature' => 0.4,
                    'max_tokens' => 600,
                ]
            ]);

            $result = $response->toArray(false);
            $content = (string) ($result['choices'][0]['message']['content'] ?? '');
            $decoded = $this->extractFirstJsonObject($content);

            if (!is_array($decoded)) {
                if ($mode === 'spelling') {
                    return $this->json([
                        'ok' => false,
                        'message' => 'AI response could not be parsed for spelling correction. Please try again.'
                    ], 502);
                }

                return $this->json($this->fallbackAiAssist($mode, $title, $destination, $summary, $tips));
            }

            if ($mode === 'spelling') {
                return $this->json([
                    'ok' => true,
                    'mode' => 'spelling',
                    'title' => $this->normalizeWhitespace((string) ($decoded['title'] ?? $title)),
                    'summary' => $this->normalizeWhitespace((string) ($decoded['summary'] ?? $summary)),
                    'tips' => $this->normalizeWhitespace((string) ($decoded['tips'] ?? $tips)),
                ]);
            }

            return $this->json([
                'ok' => true,
                'mode' => 'summary',
                'summary' => $this->normalizeWhitespace((string) ($decoded['summary'] ?? '')),
            ]);
        } catch (\Throwable $e) {
            if ($mode === 'spelling') {
                return $this->json([
                    'ok' => false,
                    'message' => 'AI spelling correction failed. Please try again in a moment.'
                ], 502);
            }

            return $this->json($this->fallbackAiAssist($mode, $title, $destination, $summary, $tips));
        }
    }

    #[Route('/destination/geocode', name: 'travel_story_destination_geocode', methods: ['GET'])]
    public function geocodeDestination(Request $request, HttpClientInterface $httpClient): JsonResponse
    {
        $destination = trim((string) $request->query->get('q', ''));
        if (mb_strlen($destination) < 2) {
            return $this->json([
                'ok' => false,
                'message' => 'Please provide at least 2 characters for destination lookup.',
            ], 400);
        }

        try {
            $response = $httpClient->request('GET', 'https://nominatim.openstreetmap.org/search', [
                'query' => [
                    'q' => $destination,
                    'format' => 'jsonv2',
                    'limit' => 1,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Language' => 'en',
                ],
            ]);

            if ($response->getStatusCode() >= 400) {
                return $this->json([
                    'ok' => false,
                    'message' => 'Map lookup service is unavailable right now.',
                ], 502);
            }

            $results = $response->toArray(false);
            if (!is_array($results) || empty($results[0]) || !is_array($results[0])) {
                return $this->json([
                    'ok' => false,
                    'message' => 'No map result found for this destination.',
                ], 404);
            }

            $first = $results[0];
            $lat = isset($first['lat']) ? (float) $first['lat'] : null;
            $lon = isset($first['lon']) ? (float) $first['lon'] : null;
            if ($lat === null || $lon === null) {
                return $this->json([
                    'ok' => false,
                    'message' => 'Destination coordinates could not be resolved.',
                ], 404);
            }

            return $this->json([
                'ok' => true,
                'destination' => $destination,
                'displayName' => (string) ($first['display_name'] ?? $destination),
                'lat' => $lat,
                'lon' => $lon,
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                'ok' => false,
                'message' => 'Destination lookup failed. Please try again.',
            ], 502);
        }
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

    private function fallbackAiAssist(string $mode, string $title, string $destination, string $summary, string $tips): array
    {
        $generated = sprintf(
            "%s takes you through %s with practical details, key moments, and a clear snapshot of what to expect. This travel story highlights the atmosphere, experiences, and useful context to help readers quickly understand why this destination stands out and how to plan a smoother trip.",
            $title !== '' ? $title : 'This travel story',
            $destination !== '' ? $destination : 'the destination'
        );

        return [
            'ok' => true,
            'mode' => 'summary',
            'summary' => $this->normalizeWhitespace($generated),
        ];
    }

    private function extractFirstJsonObject(string $text): ?array
    {
        $text = trim($text);
        if ($text === '') {
            return null;
        }

        $decoded = json_decode($text, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        if (preg_match('/\{.*\}/s', $text, $matches) === 1) {
            $decoded = json_decode($matches[0], true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        return null;
    }

    private function normalizeWhitespace(string $value): string
    {
        $value = preg_replace('/\r\n?/', "\n", $value) ?? $value;
        $value = preg_replace('/[\t ]+/', ' ', $value) ?? $value;
        $value = preg_replace('/\n{3,}/', "\n\n", $value) ?? $value;

        return trim($value);
    }

    private function resolveGroqApiKey(): ?string
    {
        foreach (['GROQ_API_KEY', 'TRANSPORTAI'] as $name) {
            $value = $_ENV[$name] ?? $_SERVER[$name] ?? getenv($name);
            if (is_string($value) && trim($value) !== '') {
                return trim($value);
            }
        }

        return null;
    }
}
