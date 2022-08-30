<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605152834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE TripOrderDetails ADD ProductID INT NOT NULL AFTER OrderID');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE TripOrderDetails DROP COLUMN ProductID');
    }
}
