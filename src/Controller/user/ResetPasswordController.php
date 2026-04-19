<?php

namespace App\Controller\user;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ResetPasswordController extends AbstractController
{
    #[Route('/forgot-password/send-code', name: 'app_forgot_password_send_code', methods: ['POST'])]
    public function sendCode(Request $request, UserRepository $userRepository, MailerInterface $mailer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $emailAddress = $data['email'] ?? '';

        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid email address.'], 400);
        }

        $user = $userRepository->findOneBy(['email' => $emailAddress]);
        if (!$user) {
            // For security, still return success but don't send anything
            return new JsonResponse(['success' => true]);
        }

        $code = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $session = $request->getSession();
        $session->set('reset_code', $code);
        $session->set('reset_email', $emailAddress);
        $session->set('reset_expires', time() + 600); // 10 minutes

        try {
            $email = (new Email())
                ->from('comptetest740@gmail.com')
                ->to($emailAddress)
                ->subject('TripX — Your Reset Code: ' . $code)
                ->html('
                    <div style="font-family:sans-serif;max-width:520px;margin:auto;padding:32px;background:#0b1220;color:#e2e8f0;border-top: 4px solid #00a6ed;">
                        <h2 style="color:#00a6ed;margin-bottom:8px;">TripX Reset Code ✈</h2>
                        <p style="font-size: 16px;">Use the code below to reset your password:</p>
                        <div style="background:rgba(255,255,255,0.05); padding:24px; text-align:center; border-radius:12px; margin:24px 0;">
                            <span style="font-size:32px; letter-spacing:8px; font-weight:800; color:#fff;">' . $code . '</span>
                        </div>
                        <p style="color:#9ca3af; font-size:14px;">This code expires in 10 minutes.</p>
                    </div>
                ');

            $mailer->send($email);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => false, 'message' => 'Error sending email.'], 500);
        }

        return new JsonResponse(['success' => true]);
    }

    #[Route('/forgot-password/verify-code', name: 'app_forgot_password_verify', methods: ['POST'])]
    public function verifyCode(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $inputCode = $data['code'] ?? '';
        $session = $request->getSession();

        $storedCode = $session->get('reset_code');
        $expires = $session->get('reset_expires');

        if (!$storedCode || !$expires || time() > $expires) {
            return new JsonResponse(['success' => false, 'message' => 'Code expired or invalid.'], 400);
        }

        if ($inputCode !== $storedCode) {
            return new JsonResponse(['success' => false, 'message' => 'Incorrect code.'], 400);
        }

        $session->set('reset_authorized', true);
        return new JsonResponse(['success' => true]);
    }

    #[Route('/forgot-password/reset', name: 'app_forgot_password_reset', methods: ['POST'])]
    public function resetPassword(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $hasher, EntityManagerInterface $em): JsonResponse
    {
        $session = $request->getSession();
        if (!$session->get('reset_authorized')) {
            return new JsonResponse(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $data = json_decode($request->getContent(), true);
        $newPassword = $data['password'] ?? '';
        $email = $session->get('reset_email');

        // Password requirements: 8+ chars, upper, lower, numbers
        if (strlen($newPassword) < 8 || 
            !preg_match('/[A-Z]/', $newPassword) || 
            !preg_match('/[a-z]/', $newPassword) || 
            !preg_match('/[0-9]/', $newPassword)) {
            return new JsonResponse(['success' => false, 'message' => 'Password too weak.'], 400);
        }

        $user = $userRepository->findOneBy(['email' => $email]);
        if (!$user) {
            return new JsonResponse(['success' => false, 'message' => 'User error.'], 400);
        }

        $user->setPassword($hasher->hashPassword($user, $newPassword));
        $em->flush();

        $session->remove('reset_code');
        $session->remove('reset_email');
        $session->remove('reset_expires');
        $session->remove('reset_authorized');

        return new JsonResponse(['success' => true]);
    }
}
