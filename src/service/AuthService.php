<?php

namespace App\service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthService
{
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $hasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $hasher)
    {
        $this->em = $em;
        $this->hasher = $hasher;
    }

    /**
     * Checks if a user exists by email.
     */
    public function findUserByEmail(string $email): ?User
    {
        return $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
    }

    /**
     * Verifies user credentials (email and plain password).
     * This is used for custom logic, though Symfony Security handles form_login automatically.
     */
    public function verifyCredentials(string $email, string $plainPassword): ?User
    {
        $user = $this->findUserByEmail($email);
        if (!$user) {
            return null;
        }

        if ($this->hasher->isPasswordValid($user, $plainPassword)) {
            return $user;
        }

        return null;
    }

    /**
     * Creates a new user in the database.
     */
    public function registerUser(array $data): User
    {
        $user = new User();
        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        $user->setEmail($data['email']);
        $user->setPhoneNumber($data['phone_number'] ?? null);
        $user->setPassword($this->hasher->hashPassword($user, $data['password']));
        $user->setRole($data['role'] ?? 'user');
        $user->setStatus('pending_verification');
        $user->setEmailVerified(false);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
