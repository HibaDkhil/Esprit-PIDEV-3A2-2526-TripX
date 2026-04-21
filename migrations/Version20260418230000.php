<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260418230000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add recording_url column to live_sessions for saved live playback';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE live_sessions ADD recording_url VARCHAR(500) DEFAULT NULL");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("ALTER TABLE live_sessions DROP recording_url");
    }
}
