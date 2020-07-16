<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716002903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE refundicion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE refundicion (id INT NOT NULL, norma_id INT NOT NULL, norma_refundida_id INT NOT NULL, articulo VARCHAR(255) NOT NULL, articulo_anexo VARCHAR(255) NOT NULL, norma_completa BOOLEAN NOT NULL, articulo_refundido VARCHAR(255) NOT NULL, articulo_anexo_refundido VARCHAR(255) NOT NULL, fundamentacion TEXT NOT NULL, observaciones TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CBFA0E8DE06FC29E ON refundicion (norma_id)');
        $this->addSql('CREATE INDEX IDX_CBFA0E8D99305259 ON refundicion (norma_refundida_id)');
        $this->addSql('ALTER TABLE refundicion ADD CONSTRAINT FK_CBFA0E8DE06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE refundicion ADD CONSTRAINT FK_CBFA0E8D99305259 FOREIGN KEY (norma_refundida_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE refundicion_id_seq CASCADE');
        $this->addSql('DROP TABLE refundicion');
    }
}
