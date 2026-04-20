<?php

namespace App\service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;

class BotProtectionService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $recaptchaSecretKey = '',
        private readonly float $recaptchaMinScore = 0.5
    ) {
    }

    public function validateRequest(Request $request, string $action = 'submit'): ?string
    {
        // Honeypot: bots often fill hidden fields.
        $honeypot = trim((string) ($request->request->get('_hp') ?? ''));
        if ($honeypot !== '') {
            return 'Bot-like activity detected (honeypot triggered).';
        }

        if (trim($this->recaptchaSecretKey) === '') {
            return null;
        }

        $token = trim((string) ($request->request->get('_recaptcha_token') ?? $request->headers->get('X-Recaptcha-Token', '')));
        if ($token === '') {
            return 'reCAPTCHA token is missing.';
        }

        try {
            $response = $this->httpClient->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                'body' => [
                    'secret' => $this->recaptchaSecretKey,
                    'response' => $token,
                    'remoteip' => (string) ($request->getClientIp() ?? ''),
                ],
                'timeout' => 5,
            ]);

            $payload = $response->toArray(false);
            if (($payload['success'] ?? false) !== true) {
                $codes = array_values(array_filter(array_map(
                    static fn($v) => trim((string) $v),
                    (array) ($payload['error-codes'] ?? [])
                )));

                if ($codes !== []) {
                    return 'reCAPTCHA validation failed (' . implode(', ', $codes) . ').';
                }

                return 'reCAPTCHA validation failed.';
            }

            $score = isset($payload['score']) ? (float) $payload['score'] : null;
            if ($score !== null && $score < $this->recaptchaMinScore) {
                return sprintf('reCAPTCHA score too low (%.2f).', $score);
            }

            $responseAction = (string) ($payload['action'] ?? '');
            if ($responseAction !== '' && $action !== '' && $responseAction !== $action) {
                return 'reCAPTCHA action mismatch.';
            }

            return null;
        } catch (\Throwable) {
            return 'Could not validate reCAPTCHA.';
        }
    }
}
