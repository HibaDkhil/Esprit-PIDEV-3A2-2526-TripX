<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260420123000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add admin moderation soft-removal fields to posts';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE posts ADD removed_by_admin TINYINT(1) DEFAULT 0 NOT NULL, ADD removal_reason LONGTEXT DEFAULT NULL, ADD removed_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE posts DROP removed_by_admin, DROP removal_reason, DROP removed_at');
    }
}
