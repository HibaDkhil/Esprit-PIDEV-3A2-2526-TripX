<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260418223500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add saved_to_profile columns to live_sessions for profile lives archive';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE live_sessions ADD saved_to_profile TINYINT(1) NOT NULL DEFAULT 0, ADD saved_to_profile_at DATETIME DEFAULT NULL");
        $this->addSql("CREATE INDEX IDX_LIVE_SESSIONS_SAVED ON live_sessions (saved_to_profile, saved_to_profile_at)");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP INDEX IDX_LIVE_SESSIONS_SAVED ON live_sessions");
        $this->addSql("ALTER TABLE live_sessions DROP saved_to_profile, DROP saved_to_profile_at");
    }
}
