<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260504120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Convert transport and booking transport money fields from float to decimal.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE transport CHANGE base_price base_price NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE bookingtrans CHANGE total_price total_price NUMERIC(10, 2) NOT NULL, CHANGE ai_price_prediction ai_price_prediction NUMERIC(10, 2) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE transport CHANGE base_price base_price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE bookingtrans CHANGE total_price total_price DOUBLE PRECISION NOT NULL, CHANGE ai_price_prediction ai_price_prediction DOUBLE PRECISION NOT NULL');
    }
}
