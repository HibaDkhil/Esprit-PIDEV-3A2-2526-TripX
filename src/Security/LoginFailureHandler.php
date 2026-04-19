<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class LoginFailureHandler implements AuthenticationFailureHandlerInterface
{
    private RouterInterface $router;
    private \App\Repository\UserRepository $userRepository;

    public function __construct(RouterInterface $router, \App\Repository\UserRepository $userRepository)
    {
        $this->router = $router;
        $this->userRepository = $userRepository;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): RedirectResponse
    {
        /** @var Session $session */
        $session = $request->getSession();
        $exceptionMessage = $exception->getMessageKey();
        
        // Track attempts in session
        $attempts = $session->get('login_attempts', 0);
        $attempts++;
        $session->set('login_attempts', $attempts);
        
        $lockedUntil = $session->get('locked_until');
        
        // Check if currently locked
        if ($lockedUntil && time() < $lockedUntil) {
            $secondsLeft = $lockedUntil - time();
            $minutesLeft = ceil($secondsLeft / 60);
            $session->getFlashBag()->add('error', "Too many attempts. Please wait {$minutesLeft} minute(s).");
            return new RedirectResponse($this->router->generate('app_login'));
        }
        
        // Clear lock if expired
        if ($lockedUntil && time() >= $lockedUntil) {
            $session->remove('locked_until');
            $attempts = 0;
            $session->set('login_attempts', 0);
        }
        
        // Determine error type by checking if user exists
        $email = $request->request->get('_username');
        $user = $this->userRepository->findOneBy(['email' => $email]);
        
        if (!$user) {
            $errorType = 'EMAIL_NOT_FOUND';
            $errorMessage = 'Email doesn\'t exist';
        } else {
            $errorType = 'INVALID_PASSWORD';
            $errorMessage = 'Wrong password';
        }
        
        $session->set('login_error_type', $errorType);

        $blockCount = $session->get('login_block_count', 0);

        // Apply lock based on attempts
        if ($attempts >= 3) {
            $session->set('login_attempts', 0); // Reset attempts after reaching threshold
            
            if ($blockCount >= 2) {
                // Tertiary block and beyond (10 minutes)
                $session->set('locked_until', time() + 600);
                $session->set('login_block_count', $blockCount + 1);
                $session->getFlashBag()->add('error', "Too many failed attempts. Please wait 10 minutes.");
            } elseif ($blockCount == 1) {
                // Secondary block (90s)
                $session->set('locked_until', time() + 90);
                $session->set('login_block_count', 2);
                $session->getFlashBag()->add('error', "Too many failed attempts. Please wait 1 minute 30 seconds.");
            } else {
                // Initial block (30s)
                $session->set('locked_until', time() + 30);
                $session->set('login_block_count', 1);
                $session->getFlashBag()->add('error', "Too many failed attempts. Please wait 30 seconds.");
            }
        } else {
            $session->getFlashBag()->add('error', $errorMessage);
        }
        
        return new RedirectResponse($this->router->generate('app_login'));
    }
}