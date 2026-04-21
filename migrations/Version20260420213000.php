<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Blog module schema cleanup:
 *  - Merge live_reactions into reactions (add live_session_id column)
 *  - Drop unused tables: live_reactions, shares, content_moderation_history
 *  - Create blog_notifications for user moderation alerts
 */
final class Version20260420213000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Blog: merge live_reactions→reactions, drop shares & content_moderation_history, add blog_notifications';
    }

    public function up(Schema $schema): void
    {
        // 1. Add live_session_id to the unified reactions table
        $this->addSql('ALTER TABLE reactions ADD live_session_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_reactions_live_session ON reactions (live_session_id)');
        $this->addSql('ALTER TABLE reactions ADD CONSTRAINT FK_reactions_live_session FOREIGN KEY (live_session_id) REFERENCES live_sessions (id) ON DELETE CASCADE');

        // 2. Migrate existing live_reactions data into reactions
        $this->addSql('
            INSERT INTO reactions (user_id, live_session_id, type, created_at)
            SELECT user_id, live_session_id, type, created_at
            FROM live_reactions
        ');

        // 3. Drop the now-redundant live_reactions table
        $this->addSql('DROP TABLE IF EXISTS live_reactions');

        // 4. Drop unused shares table
        $this->addSql('DROP TABLE IF EXISTS shares');

        // 5. Drop content_moderation_history (use server logs instead)
        $this->addSql('DROP TABLE IF EXISTS content_moderation_history');

        // 6. Create blog_notifications for moderation alerts delivered to users
        $this->addSql('
            CREATE TABLE blog_notifications (
                id          INT AUTO_INCREMENT NOT NULL,
                user_id     INT NOT NULL,
                type        VARCHAR(40) NOT NULL DEFAULT \'moderation\',
                message     LONGTEXT NOT NULL,
                is_read     TINYINT(1) NOT NULL DEFAULT 0,
                created_at  DATETIME NOT NULL,
                PRIMARY KEY (id),
                INDEX IDX_blog_notif_user (user_id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        ');
    }

    public function down(Schema $schema): void
    {
        // Reverse: drop blog_notifications
        $this->addSql('DROP TABLE IF EXISTS blog_notifications');

        // Restore live_reactions table
        $this->addSql('
            CREATE TABLE live_reactions (
                id              INT AUTO_INCREMENT NOT NULL,
                live_session_id INT NOT NULL,
                user_id         INT NOT NULL,
                type            VARCHAR(20) NOT NULL,
                created_at      DATETIME NOT NULL,
                PRIMARY KEY (id),
                INDEX IDX_live_react_session (live_session_id),
                CONSTRAINT FK_live_react_session FOREIGN KEY (live_session_id) REFERENCES live_sessions (id) ON DELETE CASCADE
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        ');

        // Move live data back
        $this->addSql('
            INSERT INTO live_reactions (user_id, live_session_id, type, created_at)
            SELECT user_id, live_session_id, type, created_at
            FROM reactions
            WHERE live_session_id IS NOT NULL
        ');

        // Remove the column we added
        $this->addSql('ALTER TABLE reactions DROP FOREIGN KEY FK_reactions_live_session');
        $this->addSql('DROP INDEX IDX_reactions_live_session ON reactions');
        $this->addSql('ALTER TABLE reactions DROP COLUMN live_session_id');
    }
}
