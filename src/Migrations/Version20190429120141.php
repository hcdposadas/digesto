<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429120141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE web_digesto_documento DROP CONSTRAINT fk_b7a67a7fd6ca87c1');
        $this->addSql('DROP INDEX idx_b7a67a7fd6ca87c1');
        $this->addSql('ALTER TABLE web_digesto_documento ADD nombre_documento VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE web_digesto_documento DROP web_digesto_documento_anexo_id');
        $this->addSql('ALTER TABLE web_digesto_documento_anexo ADD web_digesto_documento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE web_digesto_documento_anexo ADD nombre_documento_anexo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE web_digesto_documento_anexo ADD CONSTRAINT FK_A641AA86D3897D4B FOREIGN KEY (web_digesto_documento_id) REFERENCES web_digesto_documento (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A641AA86D3897D4B ON web_digesto_documento_anexo (web_digesto_documento_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE web_digesto_documento ADD web_digesto_documento_anexo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE web_digesto_documento DROP nombre_documento');
        $this->addSql('ALTER TABLE web_digesto_documento ADD CONSTRAINT fk_b7a67a7fd6ca87c1 FOREIGN KEY (web_digesto_documento_anexo_id) REFERENCES web_digesto_documento_anexo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_b7a67a7fd6ca87c1 ON web_digesto_documento (web_digesto_documento_anexo_id)');
        $this->addSql('ALTER TABLE web_digesto_documento_anexo DROP CONSTRAINT FK_A641AA86D3897D4B');
        $this->addSql('DROP INDEX IDX_A641AA86D3897D4B');
        $this->addSql('ALTER TABLE web_digesto_documento_anexo DROP web_digesto_documento_id');
        $this->addSql('ALTER TABLE web_digesto_documento_anexo DROP nombre_documento_anexo');
    }
}
