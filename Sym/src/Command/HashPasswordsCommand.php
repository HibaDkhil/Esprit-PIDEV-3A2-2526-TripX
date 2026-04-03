<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:hash-passwords', description: 'Hash all plain text passwords')]
class HashPasswordsCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $users = $this->em->getRepository(User::class)->findAll();
        $updated = 0;

        foreach ($users as $user) {
            $currentPw = $user->getPassword();
            
            // Check if password is already hashed (bcrypt hashes start with $2y$)
            if (!str_starts_with($currentPw, '$2y$')) {
                $newHash = $this->hasher->hashPassword($user, $currentPw);
                $user->setPassword($newHash);
                $updated++;
                $output->writeln("Updated password for: " . $user->getEmail());
            }
        }

        $this->em->flush();
        $output->writeln("Done! Updated $updated users.");
        
        return Command::SUCCESS;
    }
}