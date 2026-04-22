<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator
    ) {}

    public function handle(Request $request, AccessDeniedException $accessDeniedException): RedirectResponse
    {
        // If a regular user tries to access an admin page, redirect them to the front-end home
        $request->getSession()->getFlashBag()->add(
            'error',
            'You do not have permission to access that page.'
        );

        return new RedirectResponse($this->urlGenerator->generate('index'));
    }
}
