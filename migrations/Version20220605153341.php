<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605153341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE TripOrderDetails ADD COLUMN SizeID INT NULL AFTER ProductID');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE TripOrderDetaids DROP COLUMN SizeID');
    }
}
