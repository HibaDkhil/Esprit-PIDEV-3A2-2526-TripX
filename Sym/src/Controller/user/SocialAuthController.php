<?php

namespace App\Controller\user;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class SocialAuthController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process
     */
    #[Route('/connect/google', name: 'connect_google_start')]
    public function connectGoogle(ClientRegistry $clientRegistry): RedirectResponse
    {
        return $clientRegistry->getClient('google')->redirect([], []);
    }

    /**
     * After going to Google, you're redirected back here
     * because your redirect_route is set to google_auth_check
     */
    #[Route('/connect/google/check', name: 'google_auth_check')]
    public function connectGoogleCheck(): void
    {
        // This method will not be executed - the authenticator handles it
    }
}