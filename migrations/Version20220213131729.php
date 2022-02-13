<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213131729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE metiers DROP FOREIGN KEY FK_FF51A00D8EB23357');
        $this->addSql('DROP INDEX IDX_FF51A00D8EB23357 ON metiers');
        $this->addSql('ALTER TABLE metiers DROP types_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE metiers ADD types_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE metiers ADD CONSTRAINT FK_FF51A00D8EB23357 FOREIGN KEY (types_id) REFERENCES types (id)');
        $this->addSql('CREATE INDEX IDX_FF51A00D8EB23357 ON metiers (types_id)');
    }
}
