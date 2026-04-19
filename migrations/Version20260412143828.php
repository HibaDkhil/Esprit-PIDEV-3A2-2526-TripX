<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Create the reviews table for destination reviews.
 */
final class Version20260412143828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create reviews table for destination reviews with rating and comment';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS reviews (review_id BIGINT AUTO_INCREMENT NOT NULL, destination_id BIGINT NOT NULL, user_id INT NOT NULL, rating SMALLINT NOT NULL, comment LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_6970EB0F816C6140 (destination_id), INDEX IDX_6970EB0FA76ED395 (user_id), PRIMARY KEY(review_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS reviews');
    }
}
