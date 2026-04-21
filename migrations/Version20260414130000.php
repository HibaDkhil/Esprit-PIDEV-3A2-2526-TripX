<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260414130000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create blog_profiles table with user_name, bio and avatar_id synced from user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS blog_profiles (
            id INT AUTO_INCREMENT NOT NULL,
            user_id INT NOT NULL,
            user_name VARCHAR(160) NOT NULL,
            bio LONGTEXT DEFAULT NULL,
            avatar_id INT DEFAULT NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            UNIQUE INDEX uniq_blog_profiles_user (user_id),
            INDEX IDX_BLOG_PROFILES_USER (user_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE blog_profiles ADD CONSTRAINT FK_BLOG_PROFILES_USER FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE');

        $this->addSql('INSERT INTO blog_profiles (user_id, user_name, bio, avatar_id, created_at, updated_at)
            SELECT
                u.user_id,
                COALESCE(
                    NULLIF(TRIM(CONCAT(COALESCE(u.first_name, \'\'), \' \', COALESCE(u.last_name, \'\'))), \'\'),
                    CONCAT(\'user_\', u.user_id)
                ) AS user_name,
                u.bio,
                u.avatar_id,
                NOW(),
                NOW()
            FROM user u
            ON DUPLICATE KEY UPDATE
                user_name = VALUES(user_name),
                bio = VALUES(bio),
                avatar_id = VALUES(avatar_id),
                updated_at = NOW()');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS blog_profiles');
    }
}
