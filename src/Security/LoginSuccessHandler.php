<?php

namespace App\Security;

use App\service\PreferenceService;
use App\Entity\User;
use App\Entity\Preference;
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
        $user = $token->getUser();
        $roles = $user->getRoles();
        
        // Check if user has admin role
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
                error_log("LOGIN SUCCESS: ADMIN ROLE FOUND: " . $role . " FOR " . $user->getUserIdentifier());
                return new RedirectResponse($this->urlGenerator->generate('admin_dashboard'));
            }
        }

        // Check if user has completed onboarding (has preferences)
        if (!$user instanceof User) {
            error_log("LOGIN SUCCESS: USER NOT INSTANCE OF User, REDIRECTING TO INDEX");
            return new RedirectResponse($this->urlGenerator->generate('index'));
        }

        $userId = $user->getUserId();
        error_log("LOGIN SUCCESS: REGULAR USER " . $user->getUserIdentifier() . " (ID: $userId)");
        
        if (!$this->preferenceService->hasCompletedPreferences((int)$userId)) {
            error_log("LOGIN SUCCESS: ONBOARDING NOT COMPLETE FOR ID: $userId");
            $request->getSession()->set('onboarding_user_id', $userId);
            return new RedirectResponse($this->urlGenerator->generate('app_onboarding'));
        }

        error_log("LOGIN SUCCESS: REDIRECTING TO INDEX FOR " . $user->getUserIdentifier());
        // Redirect to home page
        return new RedirectResponse($this->urlGenerator->generate('index'));
    }
}