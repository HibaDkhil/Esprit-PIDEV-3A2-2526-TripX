<?php

namespace App\service\Validation;

use App\Entity\User;

final class UserManager
{
    public function validateRegistration(User $user): bool
    {
        $email = $user->getEmail();
        if ($email === null || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('User email must be valid.');
        }

        $plainPassword = $user->getPlainPassword();
        if ($plainPassword === null || strlen($plainPassword) < 8) {
            throw new \InvalidArgumentException('User password must be at least 8 characters long.');
        }

        if (preg_match('/[A-Z]/', $plainPassword) !== 1) {
            throw new \InvalidArgumentException('User password must contain an uppercase letter.');
        }

        if (preg_match('/[a-z]/', $plainPassword) !== 1) {
            throw new \InvalidArgumentException('User password must contain a lowercase letter.');
        }

        if (preg_match('/[0-9]/', $plainPassword) !== 1) {
            throw new \InvalidArgumentException('User password must contain a number.');
        }

        return true;
    }

    public function activateVerifiedUser(User $user): bool
    {
        if (!$user->isEmailVerified()) {
            throw new \InvalidArgumentException('User email must be verified before activation.');
        }

        $user->setStatus('active');

        return true;
    }

    /**
     * @return array<int, string>
     */
    public function resolveApplicationRoles(User $user): array
    {
        return $user->getRoles();
    }
}
