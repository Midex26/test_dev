<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213160741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fabricants CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE materiels CHANGE commentaire commentaire TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE metiers CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE types CHANGE id id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fabricants CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE materiels CHANGE commentaire commentaire VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE metiers CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE types CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
