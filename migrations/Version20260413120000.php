<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260413120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create stories table for instagram-style user stories (24h expiry)';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS stories (
            id INT AUTO_INCREMENT NOT NULL,
            user_id INT NOT NULL,
            image_url VARCHAR(500) NOT NULL,
            caption VARCHAR(255) DEFAULT NULL,
            created_at DATETIME NOT NULL,
            expires_at DATETIME NOT NULL,
            INDEX IDX_STORIES_USER (user_id),
            INDEX IDX_STORIES_EXPIRES (expires_at),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE stories ADD CONSTRAINT FK_STORIES_USER FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS stories');
    }
}
