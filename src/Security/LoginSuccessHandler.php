<?php

namespace App\Security;

use App\service\PreferenceService;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private EntityManagerInterface $em,
        private PreferenceService $preferenceService
    ) {
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        // Reset session attempts on successful login
        $session = $request->getSession();
        $session->remove('login_attempts');
        $session->remove('locked_until');
        $session->remove('login_error_type');
        
        $user = $token->getUser();
        $roles = $user->getRoles();
        
        $adminRoles = [
            'ROLE_ADMIN',
            'ROLE_ADMIN_DESTINATION',
            'ROLE_ADMIN_ACCOMODATION',
            'ROLE_ADMIN_OFFERS',
            'ROLE_ADMIN_BLOG',
            'ROLE_ADMIN_TRANSPORT'
        ];

        foreach ($adminRoles as $role) {
            if (in_array($role, $roles)) {
                return new RedirectResponse($this->urlGenerator->generate('admin_dashboard'));
            }
        }

        if (!$user instanceof User) {
            return new RedirectResponse($this->urlGenerator->generate('index'));
        }

        $userId = $user->getUserId();
        
        if (!$this->preferenceService->hasCompletedPreferences((int)$userId)) {
            $request->getSession()->set('onboarding_user_id', $userId);
            return new RedirectResponse($this->urlGenerator->generate('app_onboarding'));
        }

        return new RedirectResponse($this->urlGenerator->generate('index'));
    }
}