<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:fix-admin', description: 'Creates or fixes the admin user')]
class FixAdminCommand extends Command
{
    private $em;
    private $hasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $hasher)
    {
        parent::__construct();
        $this->em = $em;
        $this->hasher = $hasher;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = 'admin@tripx.com';
        $password = 'admin123';

        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user) {
            $user = new User();
            $user->setEmail($email);
            $user->setFirstName('Admin');
            $user->setLastName('TripX');
            $user->setRole('admin');
            $user->setStatus('active');
            $user->setEmailVerified(true);
            $this->em->persist($user);
            $output->writeln("Creating new admin user: $email");
        } else {
            $output->writeln("Updating existing admin user: $email");
        }

        $hashed = $this->hasher->hashPassword($user, $password);
        $user->setPassword($hashed);
        $user->setRole('admin'); // Ensure they have the correct role

        $this->em->flush();

        $output->writeln("[OK] Admin user fixed. Password: $password");

        return Command::SUCCESS;
    }
}
