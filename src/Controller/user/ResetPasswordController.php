<?php

namespace App\Controller\user;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ResetPasswordController extends AbstractController
{
    #[Route('/forgot-password', name: 'app_forgot_password', methods: ['GET', 'POST'])]
    public function forgotPassword(Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $emailAddress = $request->request->get('email');

            if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                try {
                    $email = (new Email())
                        ->from('comptetest740@gmail.com')
                        ->to($emailAddress)
                        ->subject('TripX — Password Reset Request')
                        ->html('
                            <div style="font-family:sans-serif;max-width:520px;margin:auto;padding:32px;background:#0b1220;color:#e2e8f0;border-radius:12px;">
                                <h2 style="color:#00a6ed;margin-bottom:8px;">TripX ✈</h2>
                                <h3 style="margin-bottom:16px;">Password Reset Request</h3>
                                <p style="color:#9ca3af;line-height:1.6;">We received a request to reset the password for your TripX account.</p>
                                <p style="color:#9ca3af;line-height:1.6;">If you made this request, please contact support or wait for the full reset link feature to be enabled.</p>
                                <p style="color:#9ca3af;line-height:1.6;">If you did not request a password reset, you can safely ignore this email.</p>
                                <hr style="border-color:#1e293b;margin:24px 0;">
                                <p style="font-size:12px;color:#4b5563;">This email was sent by TripX. Please do not reply to this email.</p>
                            </div>
                        ');

                    $mailer->send($email);
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Could not send email. Please try again later.');
                    return $this->redirectToRoute('app_forgot_password');
                }
            }

            // Always show success (prevents email enumeration)
            $this->addFlash('success', 'If an account with that email exists, you will receive a password reset email shortly.');
            return $this->redirectToRoute('app_forgot_password');
        }

        return $this->render('front/forgot_password.html.twig');
    }
}
