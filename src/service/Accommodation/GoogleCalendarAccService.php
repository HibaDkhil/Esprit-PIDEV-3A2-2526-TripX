<?php

namespace App\service\Accommodation;

use Google\Client;
use Google\Service\Calendar;

/**
 * Manages the Google OAuth2 client and token lifecycle
 * for the Accommodation booking calendar sync.
 *
 * Token is stored in: var/google_token_acc.json
 * Credentials from:   config/google/credentials_acc.json
 */
class GoogleCalendarAccService
{
    private const APPLICATION_NAME = 'TripX Accommodation Booking Sync';
    private const SCOPES           = [Calendar::CALENDAR_EVENTS];
    private const TOKEN_PATH       = 'var/google_token_acc.json';
    private const CREDENTIALS_PATH = 'config/google/credentials_acc.json';

    private string $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    // ── Build the Google Client (with token if available) ─────────────

    public function buildClient(): Client
    {
        $client = new Client();
        $client->setApplicationName(self::APPLICATION_NAME);
        $client->setScopes(self::SCOPES);
        $client->setAccessType('offline');
        $client->setPrompt('consent');                 // force refresh_token on first auth

        $credentialsFile = $this->projectDir . '/' . self::CREDENTIALS_PATH;
        if (!file_exists($credentialsFile)) {
            throw new \RuntimeException(
                'Google credentials not found at: ' . $credentialsFile . "\n" .
                'Download credentials.json from Google Console and place it there.'
            );
        }
        $client->setAuthConfig($credentialsFile);

        // Load persisted token
        $tokenFile = $this->projectDir . '/' . self::TOKEN_PATH;
        if (file_exists($tokenFile)) {
            $token = json_decode(file_get_contents($tokenFile), true);
            $client->setAccessToken($token);

            // Auto-refresh if expired
            if ($client->isAccessTokenExpired()) {
                $refreshToken = $client->getRefreshToken();
                if ($refreshToken) {
                    $client->fetchAccessTokenWithRefreshToken($refreshToken);
                    $this->saveToken($client->getAccessToken());
                }
            }
        }

        return $client;
    }

    // ── Build Calendar service ────────────────────────────────────────

    public function getCalendarService(): Calendar
    {
        $client = $this->buildClient();
        if (!$this->isAuthorized()) {
            throw new \RuntimeException(
                'Google Calendar not connected. Visit /admin/google-acc/authorize to connect.'
            );
        }
        return new Calendar($client);
    }

    // ── OAuth flow helpers ────────────────────────────────────────────

    public function getAuthorizationUrl(string $redirectUri): string
    {
        $client = $this->buildClient();
        $client->setRedirectUri($redirectUri);
        return $client->createAuthUrl();
    }

    public function exchangeCodeForToken(string $code, string $redirectUri): array
    {
        $client = $this->buildClient();
        $client->setRedirectUri($redirectUri);
        $token = $client->fetchAccessTokenWithAuthCode($code);

        if (isset($token['error'])) {
            throw new \RuntimeException('OAuth error: ' . $token['error_description'] ?? $token['error']);
        }

        $this->saveToken($token);
        return $token;
    }

    public function isAuthorized(): bool
    {
        $tokenFile = $this->projectDir . '/' . self::TOKEN_PATH;
        if (!file_exists($tokenFile)) { return false; }

        $token = json_decode(file_get_contents($tokenFile), true);
        if (empty($token)) { return false; }

        // Has refresh token = permanently authorized even if access token expired
        return !empty($token['refresh_token']) || !empty($token['access_token']);
    }

    public function revokeToken(): void
    {
        $tokenFile = $this->projectDir . '/' . self::TOKEN_PATH;
        if (file_exists($tokenFile)) {
            $client = $this->buildClient();
            $client->revokeToken();
            unlink($tokenFile);
        }
    }

    // ── Private ───────────────────────────────────────────────────────

    private function saveToken(array $token): void
    {
        $tokenFile = $this->projectDir . '/' . self::TOKEN_PATH;
        $dir       = dirname($tokenFile);

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        file_put_contents($tokenFile, json_encode($token, JSON_PRETTY_PRINT));
    }
}
