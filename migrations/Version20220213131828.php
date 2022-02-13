<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213131828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE types ADD metier_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE types ADD CONSTRAINT FK_59308930448B3F5B FOREIGN KEY (metier_id_id) REFERENCES metiers (id)');
        $this->addSql('CREATE INDEX IDX_59308930448B3F5B ON types (metier_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE types DROP FOREIGN KEY FK_59308930448B3F5B');
        $this->addSql('DROP INDEX IDX_59308930448B3F5B ON types');
        $this->addSql('ALTER TABLE types DROP metier_id_id');
    }
}
