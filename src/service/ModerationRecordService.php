<?php

namespace App\service;

use Doctrine\DBAL\Connection;

class ModerationRecordService
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function upsert(string $contentType, int $contentId, array $result, string $source = 'api'): void
    {
        $state = (string) ($result['state'] ?? 'SAFE');
        $blocked = (bool) ($result['blocked'] ?? false);
        $issueMessage = $result['issue_message'] ?? null;
        $spamProbability = isset($result['spam_probability']) ? (float) $result['spam_probability'] : null;

        $openAi = is_array($result['openai'] ?? null) ? $result['openai'] : [];
        $openAiFlagged = (bool) ($openAi['flagged'] ?? false);
        $openAiModel = isset($openAi['model']) ? (string) $openAi['model'] : null;
        $openAiCategories = is_array($openAi['categories'] ?? null) ? $openAi['categories'] : [];
        $openAiScores = is_array($openAi['scores'] ?? null) ? $openAi['scores'] : [];

        $profanityWords = array_values(array_filter(array_map('strval', (array) ($result['profanity_words'] ?? []))));
        $flaggedPhrases = array_values(array_filter(array_map('strval', (array) ($result['flagged_phrases'] ?? []))));

        $contentHash = isset($result['content_hash']) ? (string) $result['content_hash'] : null;
        $lastError = isset($result['last_error']) ? (string) $result['last_error'] : null;

        $this->connection->executeStatement(
            'INSERT INTO content_moderation (
                content_type,
                content_id,
                moderation_state,
                is_blocked,
                blocked_reason,
                spam_probability,
                openai_flagged,
                openai_model,
                openai_categories_json,
                openai_scores_json,
                akismet_result,
                profanity_count,
                profanity_words_json,
                flagged_phrases_json,
                source,
                last_error,
                content_hash,
                created_at,
                updated_at
            ) VALUES (
                :content_type,
                :content_id,
                :moderation_state,
                :is_blocked,
                :blocked_reason,
                :spam_probability,
                :openai_flagged,
                :openai_model,
                :openai_categories_json,
                :openai_scores_json,
                :akismet_result,
                :profanity_count,
                :profanity_words_json,
                :flagged_phrases_json,
                :source,
                :last_error,
                :content_hash,
                NOW(),
                NOW()
            )
            ON DUPLICATE KEY UPDATE
                moderation_state = VALUES(moderation_state),
                is_blocked = VALUES(is_blocked),
                blocked_reason = VALUES(blocked_reason),
                spam_probability = VALUES(spam_probability),
                openai_flagged = VALUES(openai_flagged),
                openai_model = VALUES(openai_model),
                openai_categories_json = VALUES(openai_categories_json),
                openai_scores_json = VALUES(openai_scores_json),
                akismet_result = VALUES(akismet_result),
                profanity_count = VALUES(profanity_count),
                profanity_words_json = VALUES(profanity_words_json),
                flagged_phrases_json = VALUES(flagged_phrases_json),
                source = VALUES(source),
                last_error = VALUES(last_error),
                content_hash = VALUES(content_hash),
                updated_at = NOW()',
            [
                'content_type' => $contentType,
                'content_id' => $contentId,
                'moderation_state' => $state,
                'is_blocked' => $blocked ? 1 : 0,
                'blocked_reason' => $issueMessage,
                'spam_probability' => $spamProbability,
                'openai_flagged' => $openAiFlagged ? 1 : 0,
                'openai_model' => $openAiModel,
                'openai_categories_json' => json_encode($openAiCategories, JSON_UNESCAPED_UNICODE),
                'openai_scores_json' => json_encode($openAiScores, JSON_UNESCAPED_UNICODE),
                'akismet_result' => (string) ($result['akismet_result'] ?? ''),
                'profanity_count' => count($profanityWords),
                'profanity_words_json' => json_encode($profanityWords, JSON_UNESCAPED_UNICODE),
                'flagged_phrases_json' => json_encode($flaggedPhrases, JSON_UNESCAPED_UNICODE),
                'source' => $source,
                'last_error' => $lastError,
                'content_hash' => $contentHash,
            ]
        );
    }

    public function getPostModerationMap(array $postIds): array
    {
        $ids = array_values(array_unique(array_filter(array_map('intval', $postIds))));
        if ($ids === []) {
            return [];
        }

        $rows = $this->connection->fetchAllAssociative(
            'SELECT content_id, moderation_state, spam_probability, openai_flagged, openai_scores_json, profanity_count, profanity_words_json, flagged_phrases_json
             FROM content_moderation
             WHERE content_type = :type AND content_id IN (:ids)',
            [
                'type' => 'post',
                'ids' => $ids,
            ],
            [
                'ids' => Connection::PARAM_INT_ARRAY,
            ]
        );

        $map = [];
        foreach ($rows as $row) {
            $contentId = (int) ($row['content_id'] ?? 0);
            if ($contentId <= 0) {
                continue;
            }

            $scores = $this->decodeJsonArray($row['openai_scores_json'] ?? null);
            $profanityWords = $this->decodeJsonList($row['profanity_words_json'] ?? null);
            $flaggedPhrases = $this->decodeJsonList($row['flagged_phrases_json'] ?? null);

            $map[$contentId] = [
                'state' => (string) ($row['moderation_state'] ?? 'SAFE'),
                'flaggedByAi' => ((int) ($row['openai_flagged'] ?? 0)) === 1,
                'openai' => [
                    'hate' => $this->scoreMax($scores, ['hate', 'hate/threatening']),
                    'harassment' => $this->scoreMax($scores, ['harassment', 'harassment/threatening']),
                    'self_harm' => $this->scoreMax($scores, ['self-harm', 'self-harm/intent', 'self-harm/instructions']),
                    'violence' => $this->scoreMax($scores, ['violence', 'violence/graphic']),
                ],
                'spam_probability' => isset($row['spam_probability']) ? (float) $row['spam_probability'] : 0.0,
                'profanity_count' => (int) ($row['profanity_count'] ?? 0),
                'profanity_words' => $profanityWords,
                'flagged_phrases' => $flaggedPhrases,
            ];
        }

        return $map;
    }

    private function decodeJsonArray(?string $value): array
    {
        if (!is_string($value) || trim($value) === '') {
            return [];
        }

        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

    private function decodeJsonList(?string $value): array
    {
        $decoded = $this->decodeJsonArray($value);

        return array_values(array_filter(array_map('strval', $decoded), static fn(string $v) => trim($v) !== ''));
    }

    private function scoreMax(array $scores, array $keys): float
    {
        $max = 0.0;
        foreach ($keys as $key) {
            $value = isset($scores[$key]) ? (float) $scores[$key] : 0.0;
            if ($value > $max) {
                $max = $value;
            }
        }

        return $max;
    }
}
