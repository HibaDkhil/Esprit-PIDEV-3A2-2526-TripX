<?php

namespace App\service;

/**
 * Lightweight, synchronous (no-API) text moderation used by the admin
 * dashboard as a fallback when no OpenAI / Akismet record exists.
 *
 * Centralises every keyword list that was previously duplicated inside
 * BlogAdminController so that both the admin view and any future service
 * share exactly one source of truth.
 */
class BlogModerationAnalyzer
{
    private const HATE_WORDS       = ['hate', 'hate you', 'i hate you', 'racist', 'inferior', 'go back', 'dirty'];
    private const HARASSMENT_WORDS = ['idiot', 'stupid', 'loser', 'worthless', 'shut up', 'fuck you', 'fucker', 'fuckers', 'you suck', 'suck', 'sucks'];
    private const SELF_HARM_WORDS  = ['suicide', 'kill myself', 'end my life', 'self harm'];
    private const VIOLENCE_WORDS   = ['kill', 'murder', 'attack', 'bomb', 'shoot'];
    private const SPAM_WORDS       = ['buy now', 'cheap', 'click here', 'free money', 'promo code'];
    /** Kept for the local fallback only – real detection uses the bad-words.txt file via ContentModerationService */
    private const PROFANITY_WORDS  = ['fuck', 'shit', 'bitch', 'asshole', 'bastard'];

    public function __construct(
        private readonly ContentModerationService $moderationService
    ) {}

    // ── Public API ──────────────────────────────────────────────────────

    /**
     * Analyse a piece of content locally (no external API calls).
     * Returns the same shape as ContentModerationService::evaluateContent()
     * so the Twig templates work unchanged.
     */
    public function analyzeText(string $title, string $body): array
    {
        $text = mb_strtolower(trim($title . "\n" . $body));

        $hateCount       = $this->countHits($text, self::HATE_WORDS);
        $harassmentCount = $this->countHits($text, self::HARASSMENT_WORDS);
        $selfHarmCount   = $this->countHits($text, self::SELF_HARM_WORDS);
        $violenceCount   = $this->countHits($text, self::VIOLENCE_WORDS);
        $spamCount       = $this->countHits($text, self::SPAM_WORDS);

        // Use the shared bad-words file (via ContentModerationService) to avoid the duplicate list
        $profanityMatched = $this->moderationService->detectProfanityWords($text);
        // Fallback to the local constants if the file is unavailable / empty
        if ($profanityMatched === []) {
            foreach (self::PROFANITY_WORDS as $word) {
                if ($this->matchesProfanityVariant($text, $word)) {
                    $profanityMatched[] = $word;
                }
            }
        }

        $openAi = [
            'hate'       => min(1.0, $hateCount * 0.35),
            'harassment' => min(1.0, $harassmentCount * 0.35),
            'self_harm'  => min(1.0, $selfHarmCount * 0.45),
            'violence'   => min(1.0, $violenceCount * 0.35),
        ];

        $spamProbability = min(1.0, $spamCount * 0.35 + ($profanityMatched !== [] ? 0.05 : 0.0));

        $state = 'SAFE';
        if ($openAi['self_harm'] >= 0.8 || $openAi['violence'] >= 0.8) {
            $state = 'AUTO_HIDDEN';
        } elseif ($openAi['hate'] >= 0.75 || $openAi['harassment'] >= 0.75) {
            $state = 'HIGH_RISK';
        } elseif ($spamProbability > 0.75) {
            $state = 'SPAM';
        } elseif (
            $openAi['hate'] >= 0.35 ||
            $openAi['harassment'] >= 0.35 ||
            $openAi['self_harm'] >= 0.45 ||
            $openAi['violence'] >= 0.45 ||
            $profanityMatched !== []
        ) {
            $state = 'REVIEW';
        }

        $flaggedByAi = ($openAi['hate'] >= 0.45)
            || ($openAi['harassment'] >= 0.45)
            || ($openAi['self_harm'] >= 0.45)
            || ($openAi['violence'] >= 0.45);

        return [
            'state'           => $state,
            'flaggedByAi'     => $flaggedByAi,
            'openai'          => $openAi,
            'spam_probability' => $spamProbability,
            'profanity_count' => count($profanityMatched),
            'profanity_words' => $profanityMatched,
            'flagged_phrases' => array_values(array_unique(array_merge(
                $this->collectMatches($text, self::HATE_WORDS),
                $this->collectMatches($text, self::HARASSMENT_WORDS),
                $this->collectMatches($text, self::SELF_HARM_WORDS),
                $this->collectMatches($text, self::VIOLENCE_WORDS),
                $this->collectMatches($text, self::SPAM_WORDS),
            ))),
        ];
    }

    /** Create an empty comment-moderation accumulator bucket. */
    public function createCommentBucket(): array
    {
        return [
            'total'       => 0,
            'flagged'     => 0,
            'safe'        => 0,
            'review'      => 0,
            'spam'        => 0,
            'high_risk'   => 0,
            'auto_hidden' => 0,
            'top_terms'   => [],
            'samples'     => [],
            '_term_counts' => [],
        ];
    }

    /** Accumulate one comment's moderation result into a bucket. */
    public function accumulateComment(array &$bucket, array $analysis, string $commentText): void
    {
        $bucket['total']++;
        $state     = (string) ($analysis['state'] ?? 'SAFE');
        $isFlagged = $state !== 'SAFE';

        $isFlagged ? $bucket['flagged']++ : $bucket['safe']++;

        match ($state) {
            'REVIEW'     => $bucket['review']++,
            'SPAM'       => $bucket['spam']++,
            'HIGH_RISK'  => $bucket['high_risk']++,
            'AUTO_HIDDEN' => $bucket['auto_hidden']++,
            default      => null,
        };

        foreach (array_merge(
            (array) ($analysis['profanity_words'] ?? []),
            (array) ($analysis['flagged_phrases'] ?? [])
        ) as $term) {
            $n = mb_strtolower(trim((string) $term));
            if ($n !== '') {
                $bucket['_term_counts'][$n] = ($bucket['_term_counts'][$n] ?? 0) + 1;
            }
        }

        if ($isFlagged && $commentText !== '' && count($bucket['samples']) < 3) {
            $snippet = mb_substr($commentText, 0, 120);
            if (mb_strlen($commentText) > 120) {
                $snippet .= '…';
            }
            $bucket['samples'][] = sprintf('%s: %s', $state, $snippet);
        }
    }

    /** Finalise all buckets: sort term counts and strip the internal key. */
    public function finalizeCommentMap(array $map): array
    {
        foreach ($map as $id => $bucket) {
            $terms = (array) ($bucket['_term_counts'] ?? []);
            arsort($terms);
            $bucket['top_terms'] = array_slice(array_keys($terms), 0, 5);
            unset($bucket['_term_counts']);
            $map[$id] = $bucket;
        }

        return $map;
    }

    // ── Private helpers ─────────────────────────────────────────────────

    private function countHits(string $text, array $keywords): int
    {
        $count = 0;
        foreach ($keywords as $kw) {
            if ($kw !== '' && str_contains($text, mb_strtolower($kw))) {
                $count++;
            }
        }

        return $count;
    }

    private function collectMatches(string $text, array $keywords): array
    {
        $matched = [];
        foreach ($keywords as $kw) {
            if ($kw !== '' && str_contains($text, mb_strtolower($kw))) {
                $matched[] = $kw;
            }
        }

        return $matched;
    }

    private function matchesProfanityVariant(string $text, string $word): bool
    {
        $base = trim(mb_strtolower($word));
        if ($base === '') {
            return false;
        }

        return preg_match('/\b' . preg_quote($base, '/') . '[a-z]*\b/i', $text) === 1;
    }
}
