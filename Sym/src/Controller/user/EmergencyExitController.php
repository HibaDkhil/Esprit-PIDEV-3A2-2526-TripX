<?php

namespace App\Controller\user;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class EmergencyExitController extends AbstractController
{
    #[Route('/emergency-exit', name: 'app_emergency_exit')]
    public function exit(Request $request, TokenStorageInterface $tokenStorage): Response
    {
        // Forcefully clear the security token
        $tokenStorage->setToken(null);
        
        // Forcefully invalidate the session
        $request->getSession()->invalidate();
        
        // Redirect back to login
        return $this->redirectToRoute('app_login');
    }
}
