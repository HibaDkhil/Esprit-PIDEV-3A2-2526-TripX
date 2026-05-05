<?php

namespace App\Tests\Service;

use App\Entity\User;
use App\service\Validation\UserManager;
use PHPUnit\Framework\TestCase;

final class UserManagerTest extends TestCase
{
    public function testValidUserRegistrationPassesValidation(): void
    {
        $user = (new User())
            ->setFirstName('Aya')
            ->setLastName('Ben Salem')
            ->setEmail('aya@example.com')
            ->setPlainPassword('StrongPass1');

        self::assertTrue((new UserManager())->validateRegistration($user));
    }

    public function testUserRegistrationRejectsWeakPassword(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $user = (new User())
            ->setEmail('aya@example.com')
            ->setPlainPassword('weak');

        (new UserManager())->validateRegistration($user);
    }

    public function testVerifiedUserCanBeActivated(): void
    {
        $user = (new User())
            ->setEmail('aya@example.com')
            ->setPlainPassword('StrongPass1')
            ->setEmailVerified(true)
            ->setStatus('pending_verification');

        $manager = new UserManager();

        self::assertTrue($manager->activateVerifiedUser($user));
        self::assertSame('active', $user->getStatus());
        self::assertContains('ROLE_USER', $manager->resolveApplicationRoles($user));
    }
}
