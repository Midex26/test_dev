<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213131446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiels ADD type_id_id INT NOT NULL, ADD fabricant_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE materiels ADD CONSTRAINT FK_9C1EBE69714819A0 FOREIGN KEY (type_id_id) REFERENCES types (id)');
        $this->addSql('ALTER TABLE materiels ADD CONSTRAINT FK_9C1EBE69C3B29B27 FOREIGN KEY (fabricant_id_id) REFERENCES fabricants (id)');
        $this->addSql('CREATE INDEX IDX_9C1EBE69714819A0 ON materiels (type_id_id)');
        $this->addSql('CREATE INDEX IDX_9C1EBE69C3B29B27 ON materiels (fabricant_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiels DROP FOREIGN KEY FK_9C1EBE69714819A0');
        $this->addSql('ALTER TABLE materiels DROP FOREIGN KEY FK_9C1EBE69C3B29B27');
        $this->addSql('DROP INDEX IDX_9C1EBE69714819A0 ON materiels');
        $this->addSql('DROP INDEX IDX_9C1EBE69C3B29B27 ON materiels');
        $this->addSql('ALTER TABLE materiels DROP type_id_id, DROP fabricant_id_id');
    }
}
