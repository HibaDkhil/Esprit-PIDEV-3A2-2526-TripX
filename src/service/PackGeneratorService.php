<?php

namespace App\service;

use App\Entity\PackCategory;
use App\Repository\AccommodationRepository;
use Doctrine\ORM\EntityManagerInterface;

class PackGeneratorService
{
    public function __construct(
        private GeminiPackService       $geminiPackService,
        private DestinationService      $destinationService,
        private ActivityService         $activityService,
        private AccommodationRepository $accommodationRepo,
        private TransportService        $transportService,
        private EntityManagerInterface  $em
    ) {}

    /**
     * Generate a pack proposal from the 4 admin seed inputs.
     *
     * @param string      $vibe        e.g. "Luxury"
     * @param string|null $country     e.g. "France" or null (surprise me)
     * @param string      $duration    "short" | "medium" | "long"
     * @param string      $audience    e.g. "Couples"
     *
     * @return array  Decoded Gemini JSON + resolved label strings for the preview card
     * @throws \RuntimeException
     */
    public function generate(string $vibe, ?string $country, string $duration, string $audience): array
    {
        $prompt = $this->buildPrompt($vibe, $country, $duration, $audience);
        $proposal = $this->geminiPackService->generateJson($prompt);

        // Validate required keys so the controller can trust the shape
        $required = ['title', 'description', 'destination_id', 'accommodation_id',
                     'activity_id', 'transport_id', 'category_id', 'duration_days',
                     'base_price', 'reasoning'];

        foreach ($required as $key) {
            if (!array_key_exists($key, $proposal)) {
                throw new \RuntimeException("Gemini response missing required key: $key");
            }
        }

        // Attach human-readable labels so the JS preview card can display them without extra fetches
        $proposal['_labels'] = $this->resolveLabels($proposal);

        return $proposal;
    }

    // ─────────────────────────────────────────────────────────────────────────

    private function buildPrompt(string $vibe, ?string $country, string $duration, string $audience): string
    {
        $durationRange = match ($duration) {
            'short'  => '2–4 days',
            'long'   => '8–14 days',
            default  => '5–7 days',   // medium
        };

        $destinationFilter = $country
            ? "Prefer a destination in or related to: $country."
            : "You may pick any destination from the list — surprise the admin.";

        // ── Collect DB context ───────────────────────────────────────────────
        $destinations   = array_slice($this->destinationService->getAll(), 0, 20);
        $accommodations = array_slice($this->accommodationRepo->findAll(), 0, 20);
        $activities     = array_slice($this->activityService->getAll(), 0, 20);
        $transports     = array_slice($this->transportService->getAllTransports(), 0, 15);
        $categories     = $this->em->getRepository(PackCategory::class)->findAll();

        $destLines = array_map(
            fn($d) => sprintf('%d|%s|%s|%s', $d->getDestinationId(), $d->getName(), $d->getType(), $d->getCountry()),
            $destinations
        );

        $accLines = array_map(
            fn($a) => sprintf('%d|%s|%s|%s★', $a->getId(), $a->getName(), $a->getType(), $a->getStars()),
            $accommodations
        );

        $actLines = array_map(
            fn($a) => sprintf('%d|%s|%s', $a->getActivityId(), $a->getName(), $a->getCategory()),
            $activities
        );

        $transLines = array_map(
            fn($t) => sprintf('%d|%s|%s', $t->getTransportId(), $t->getProviderName(), $t->getTransportType()),
            $transports
        );

        $catLines = array_map(
            fn($c) => sprintf('%d|%s', $c->getIdCategory(), $c->getName()),
            $categories
        );

        // ── Build prompt ─────────────────────────────────────────────────────
        return <<<PROMPT
You are a travel product manager for TripX, a premium travel platform.
Generate a complete travel pack proposal based on the inputs below.

INPUTS:
- Vibe: {$vibe}
- Duration: {$durationRange}
- Audience: {$audience}
- Destination preference: {$destinationFilter}

AVAILABLE DATA (use ONLY IDs from these lists):

DESTINATIONS (id|name|type|country):
{$this->listToString($destLines)}

ACCOMMODATIONS (id|name|type|stars):
{$this->listToString($accLines)}

ACTIVITIES (id|name|category):
{$this->listToString($actLines)}

TRANSPORTS (id|providerName|type):
{$this->listToString($transLines)}

PACK CATEGORIES (id|name):
{$this->listToString($catLines)}

INSTRUCTIONS:
1. Pick ONE item from each list that best fits the vibe, duration, and audience.
2. Choose a duration_days integer within the given range.
3. Set base_price in EUR — realistic for the vibe (Budget < 1000, Mid 1000–3000, Premium 3000–6000, Luxury > 6000).
4. Write a compelling title (max 60 chars) and a 2–3 sentence description.
5. Explain your choices in "reasoning" (2–3 sentences, friendly tone).
6. Return ONLY a valid JSON object — no markdown, no extra text, no code fences.

REQUIRED JSON SHAPE:
{
  "title": "string",
  "description": "string",
  "destination_id": integer,
  "accommodation_id": integer,
  "activity_id": integer,
  "transport_id": integer,
  "category_id": integer,
  "duration_days": integer,
  "base_price": number,
  "reasoning": "string"
}
PROMPT;
    }

    private function listToString(array $lines): string
    {
        return implode("\n", $lines) ?: '(none available)';
    }

    /**
     * Resolve human-readable labels from the returned IDs for the frontend preview.
     */
    private function resolveLabels(array $p): array
    {
        $labels = [];

        // Destination
        $dests = $this->destinationService->getAll();
        foreach ($dests as $d) {
            if ($d->getDestinationId() == $p['destination_id']) {
                $labels['destination'] = $d->getName() . ' — ' . $d->getCountry();
                break;
            }
        }

        // Accommodation
        $acc = $this->accommodationRepo->find($p['accommodation_id']);
        $labels['accommodation'] = $acc ? $acc->getName() . ' — ' . $acc->getCity() : '#' . $p['accommodation_id'];

        // Activity
        $acts = $this->activityService->getAll();
        foreach ($acts as $a) {
            if ($a->getActivityId() == $p['activity_id']) {
                $labels['activity'] = $a->getName();
                break;
            }
        }

        // Transport
        $transports = $this->transportService->getAllTransports();
        foreach ($transports as $t) {
            if ($t->getTransportId() == $p['transport_id']) {
                $labels['transport'] = $t->getProviderName() . ' (' . $t->getTransportType() . ')';
                break;
            }
        }

        // Category
        $cats = $this->em->getRepository(PackCategory::class)->findAll();
        foreach ($cats as $c) {
            if ($c->getIdCategory() == $p['category_id']) {
                $labels['category'] = $c->getName();
                break;
            }
        }

        return $labels;
    }
}
