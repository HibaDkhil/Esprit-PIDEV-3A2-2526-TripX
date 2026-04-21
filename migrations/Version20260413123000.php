<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260413123000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create story_views table for seen/unseen tracking';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS story_views (
            id INT AUTO_INCREMENT NOT NULL,
            story_id INT NOT NULL,
            viewer_id INT NOT NULL,
            seen_at DATETIME NOT NULL,
            UNIQUE INDEX uniq_story_view (story_id, viewer_id),
            INDEX IDX_STORY_VIEWS_STORY (story_id),
            INDEX IDX_STORY_VIEWS_VIEWER (viewer_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE story_views ADD CONSTRAINT FK_STORY_VIEWS_STORY FOREIGN KEY (story_id) REFERENCES stories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE story_views ADD CONSTRAINT FK_STORY_VIEWS_VIEWER FOREIGN KEY (viewer_id) REFERENCES user (user_id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS story_views');
    }
}
