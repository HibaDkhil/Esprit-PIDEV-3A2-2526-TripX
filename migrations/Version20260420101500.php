<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260420101500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add admin moderation soft-removal fields to travel_story';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE travel_story ADD removed_by_admin TINYINT(1) DEFAULT 0 NOT NULL, ADD removal_reason LONGTEXT DEFAULT NULL, ADD removed_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE travel_story DROP removed_by_admin, DROP removal_reason, DROP removed_at');
    }
}
