<?php

namespace App\service;

use App\Entity\User;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;

class ContentModerationService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $akismetApiKey = '',
        private readonly string $akismetBlogUrl = '',
        private readonly string $openAiApiKey = '',
        private readonly string $openAiModerationModel = 'omni-moderation-latest',
        private readonly string $badWordsFile = ''
    ) {
    }

    public function validateContent(
        array $textParts,
        string $contentType,
        Request $request,
        ?User $user = null
    ): ?string {
        $result = $this->evaluateContent($textParts, $contentType, $request, $user);

        return $result['issue_message'] ?? null;
    }

    public function evaluateContent(
        array $textParts,
        string $contentType,
        Request $request,
        ?User $user = null
    ): array {
        $normalizedParts = [];
        foreach ($textParts as $part) {
            $text = trim((string) $part);
            if ($text !== '') {
                $normalizedParts[] = $text;
            }
        }

        if ($normalizedParts === []) {
            return [
                'state' => 'SAFE',
                'blocked' => false,
                'issue_message' => null,
                'akismet_result' => 'not_checked',
                'spam_probability' => 0.0,
                'profanity_words' => [],
                'flagged_phrases' => [],
                'openai' => [
                    'flagged' => false,
                    'issue' => null,
                    'model' => $this->openAiModerationModel,
                    'categories' => [],
                    'scores' => [],
                    'error' => null,
                ],
                'content_hash' => null,
                'last_error' => null,
            ];
        }

        $combined = mb_substr(implode("\n", $normalizedParts), 0, 15000);
        $matchedBadWords = $this->detectBadWords($combined);

        $akismetSpam = $this->isAkismetSpam($combined, $contentType, $request, $user);
        $openAi = $this->analyzeOpenAiModeration($combined);

        $issueMessage = null;
        $state = 'SAFE';
        $blocked = false;

        if ($matchedBadWords !== []) {
            $issueMessage = 'Content contains prohibited language.';
            $state = 'REVIEW';
            $blocked = true;
        }

        if ($akismetSpam) {
            $issueMessage = 'Content was flagged as spam by Akismet. Please rewrite and try again.';
            $state = 'SPAM';
            $blocked = true;
        }

        if ($openAi['issue'] !== null) {
            $issueMessage = sprintf('Content was flagged by safety moderation (%s).', $openAi['issue']);
            $state = in_array($openAi['issue'], ['self-harm/intent', 'self-harm/instructions', 'violence/graphic'], true) ? 'HIGH_RISK' : 'REVIEW';
            $blocked = true;
        }

        $flaggedPhrases = [];
        if ($openAi['issue'] !== null) {
            $flaggedPhrases[] = (string) $openAi['issue'];
        }

        return [
            'state' => $state,
            'blocked' => $blocked,
            'issue_message' => $issueMessage,
            'akismet_result' => $akismetSpam ? 'spam' : 'ham',
            'spam_probability' => $akismetSpam ? 1.0 : 0.0,
            'profanity_words' => $matchedBadWords,
            'flagged_phrases' => $flaggedPhrases,
            'openai' => $openAi,
            'content_hash' => hash('sha256', $combined),
            'last_error' => $openAi['error'],
        ];
    }

    private function detectBadWords(string $text): array
    {
        $words = $this->loadBadWords();
        if ($words === []) {
            return [];
        }

        $matched = [];
        foreach ($words as $word) {
            $pattern = '/\\b' . preg_quote($word, '/') . '\\b/iu';
            if (preg_match($pattern, $text) === 1) {
                $matched[] = $word;
            }
        }

        return array_values(array_unique($matched));
    }

    private function loadBadWords(): array
    {
        $path = trim($this->badWordsFile);
        if ($path === '' || !is_file($path)) {
            return [];
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return [];
        }

        $words = [];
        foreach ($lines as $line) {
            $line = trim((string) $line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }
            $words[] = mb_strtolower($line);
        }

        return array_values(array_unique($words));
    }

    private function isAkismetSpam(string $content, string $contentType, Request $request, ?User $user): bool
    {
        if (trim($this->akismetApiKey) === '' || trim($this->akismetBlogUrl) === '') {
            return false;
        }

        $authorName = '';
        $authorEmail = '';
        if ($user instanceof User) {
            $authorName = trim((string) $user->getFirstName() . ' ' . (string) $user->getLastName());
            if (method_exists($user, 'getEmail')) {
                $authorEmail = (string) $user->getEmail();
            }
        }

        $ip = (string) ($request->getClientIp() ?? '');
        $ua = (string) ($request->headers->get('User-Agent') ?? '');
        $ref = (string) ($request->headers->get('Referer') ?? '');

        try {
            $response = $this->httpClient->request(
                'POST',
                sprintf('https://%s.rest.akismet.com/1.1/comment-check', $this->akismetApiKey),
                [
                    'body' => [
                        'blog' => $this->akismetBlogUrl,
                        'user_ip' => $ip,
                        'user_agent' => $ua,
                        'referrer' => $ref,
                        'comment_type' => $contentType,
                        'comment_author' => $authorName,
                        'comment_author_email' => $authorEmail,
                        'comment_content' => $content,
                        'blog_lang' => 'en',
                        'blog_charset' => 'UTF-8',
                    ],
                    'timeout' => 4,
                ]
            );

            $body = trim((string) $response->getContent(false));
            return $body === 'true';
        } catch (\Throwable) {
            return false;
        }
    }

    private function analyzeOpenAiModeration(string $content): array
    {
        if (trim($this->openAiApiKey) === '') {
            return [
                'flagged' => false,
                'issue' => null,
                'model' => $this->openAiModerationModel,
                'categories' => [],
                'scores' => [],
                'error' => null,
            ];
        }

        try {
            $response = $this->httpClient->request('POST', 'https://api.openai.com/v1/moderations', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->openAiApiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => $this->openAiModerationModel,
                    'input' => $content,
                ],
                'timeout' => 6,
            ]);

            $payload = $response->toArray(false);
            $result = $payload['results'][0] ?? null;
            if (!is_array($result)) {
                return [
                    'flagged' => false,
                    'issue' => null,
                    'model' => $this->openAiModerationModel,
                    'categories' => [],
                    'scores' => [],
                    'error' => 'invalid_payload',
                ];
            }

            $categories = is_array($result['categories'] ?? null) ? $result['categories'] : [];
            $scores = is_array($result['category_scores'] ?? null) ? $result['category_scores'] : [];
            $watchList = [
                'self-harm',
                'self-harm/intent',
                'self-harm/instructions',
                'hate',
                'hate/threatening',
                'harassment',
                'harassment/threatening',
                'violence',
                'violence/graphic',
            ];

            $issue = null;
            foreach ($watchList as $categoryKey) {
                if (($categories[$categoryKey] ?? false) === true) {
                    $issue = $categoryKey;
                    break;
                }
            }

            $flagged = (bool) ($result['flagged'] ?? false);
            if ($issue === null && $flagged) {
                $issue = 'policy';
            }

            return [
                'flagged' => $flagged,
                'issue' => $issue,
                'model' => (string) ($payload['model'] ?? $this->openAiModerationModel),
                'categories' => $categories,
                'scores' => $scores,
                'error' => null,
            ];
        } catch (\Throwable) {
            return [
                'flagged' => false,
                'issue' => null,
                'model' => $this->openAiModerationModel,
                'categories' => [],
                'scores' => [],
                'error' => 'request_failed',
            ];
        }
    }
}
