<?php
// src/Controller/user/OAuthController.php

namespace App\Controller\user;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class OAuthController extends AbstractController
{
    #[Route('/connect/google', name: 'google_auth_start')]
    public function connectGoogle(ClientRegistry $clientRegistry): RedirectResponse
    {
        return $clientRegistry
            ->getClient('google')
            ->redirect(['openid', 'email', 'profile'], []);
    }

    #[Route('/connect/google/check', name: 'google_auth_check')]
    public function connectGoogleCheck(): void
    {
        // This is intercepted by GoogleAuthenticator — never actually executes
        throw new \LogicException('This should never be reached.');
    }
}