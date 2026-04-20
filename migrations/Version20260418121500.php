<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260418121500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create live session tables for blog live feature (sessions, comments, reactions, viewers)';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS live_sessions (
            id INT AUTO_INCREMENT NOT NULL,
            host_user_id INT NOT NULL,
            title VARCHAR(255) DEFAULT NULL,
            status VARCHAR(20) NOT NULL,
            room_name VARCHAR(255) NOT NULL,
            stream_token VARCHAR(500) DEFAULT NULL,
            thumbnail_url VARCHAR(500) DEFAULT NULL,
            started_at DATETIME NOT NULL,
            ended_at DATETIME DEFAULT NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            INDEX IDX_LIVE_SESSIONS_HOST (host_user_id),
            INDEX IDX_LIVE_SESSIONS_STATUS (status),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE live_sessions ADD CONSTRAINT FK_LIVE_SESSIONS_HOST FOREIGN KEY (host_user_id) REFERENCES user (user_id) ON DELETE CASCADE');

        $this->addSql('CREATE TABLE IF NOT EXISTS live_comments (
            id INT AUTO_INCREMENT NOT NULL,
            live_session_id INT NOT NULL,
            user_id INT NOT NULL,
            message LONGTEXT NOT NULL,
            created_at DATETIME NOT NULL,
            INDEX IDX_LIVE_COMMENTS_SESSION (live_session_id),
            INDEX IDX_LIVE_COMMENTS_USER (user_id),
            INDEX IDX_LIVE_COMMENTS_CREATED (created_at),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE live_comments ADD CONSTRAINT FK_LIVE_COMMENTS_SESSION FOREIGN KEY (live_session_id) REFERENCES live_sessions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE live_comments ADD CONSTRAINT FK_LIVE_COMMENTS_USER FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE');

        $this->addSql('CREATE TABLE IF NOT EXISTS live_reactions (
            id INT AUTO_INCREMENT NOT NULL,
            live_session_id INT NOT NULL,
            user_id INT NOT NULL,
            type VARCHAR(20) NOT NULL,
            created_at DATETIME NOT NULL,
            INDEX IDX_LIVE_REACTIONS_SESSION (live_session_id),
            INDEX IDX_LIVE_REACTIONS_USER (user_id),
            INDEX IDX_LIVE_REACTIONS_TYPE (type),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE live_reactions ADD CONSTRAINT FK_LIVE_REACTIONS_SESSION FOREIGN KEY (live_session_id) REFERENCES live_sessions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE live_reactions ADD CONSTRAINT FK_LIVE_REACTIONS_USER FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE');

        $this->addSql('CREATE TABLE IF NOT EXISTS live_session_viewers (
            id INT AUTO_INCREMENT NOT NULL,
            live_session_id INT NOT NULL,
            viewer_user_id INT NOT NULL,
            joined_at DATETIME NOT NULL,
            left_at DATETIME DEFAULT NULL,
            is_active TINYINT(1) NOT NULL,
            UNIQUE INDEX uniq_live_session_viewer (live_session_id, viewer_user_id),
            INDEX IDX_LIVE_VIEWERS_SESSION (live_session_id),
            INDEX IDX_LIVE_VIEWERS_USER (viewer_user_id),
            INDEX IDX_LIVE_VIEWERS_ACTIVE (is_active),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE live_session_viewers ADD CONSTRAINT FK_LIVE_VIEWERS_SESSION FOREIGN KEY (live_session_id) REFERENCES live_sessions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE live_session_viewers ADD CONSTRAINT FK_LIVE_VIEWERS_USER FOREIGN KEY (viewer_user_id) REFERENCES user (user_id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS live_session_viewers');
        $this->addSql('DROP TABLE IF EXISTS live_reactions');
        $this->addSql('DROP TABLE IF EXISTS live_comments');
        $this->addSql('DROP TABLE IF EXISTS live_sessions');
    }
}
