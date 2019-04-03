<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403194244 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE web_digesto_documento_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE web_digesto_documento_anexo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE web_digesto_documento (id INT NOT NULL, web_digesto_documento_anexo_id INT DEFAULT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, grupo VARCHAR(255) DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B7A67A7FD6CA87C1 ON web_digesto_documento (web_digesto_documento_anexo_id)');
        $this->addSql('CREATE INDEX IDX_B7A67A7FFE35D8C4 ON web_digesto_documento (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_B7A67A7FF6167A1C ON web_digesto_documento (actualizado_por_id)');
        $this->addSql('CREATE TABLE web_digesto_documento_anexo (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A641AA86FE35D8C4 ON web_digesto_documento_anexo (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_A641AA86F6167A1C ON web_digesto_documento_anexo (actualizado_por_id)');
        $this->addSql('ALTER TABLE web_digesto_documento ADD CONSTRAINT FK_B7A67A7FD6CA87C1 FOREIGN KEY (web_digesto_documento_anexo_id) REFERENCES web_digesto_documento_anexo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE web_digesto_documento ADD CONSTRAINT FK_B7A67A7FFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE web_digesto_documento ADD CONSTRAINT FK_B7A67A7FF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE web_digesto_documento_anexo ADD CONSTRAINT FK_A641AA86FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE web_digesto_documento_anexo ADD CONSTRAINT FK_A641AA86F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE web_digesto_texto RENAME COLUMN remuneracion TO renumeracion');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE web_digesto_documento DROP CONSTRAINT FK_B7A67A7FD6CA87C1');
        $this->addSql('DROP SEQUENCE web_digesto_documento_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE web_digesto_documento_anexo_id_seq CASCADE');
        $this->addSql('DROP TABLE web_digesto_documento');
        $this->addSql('DROP TABLE web_digesto_documento_anexo');
        $this->addSql('ALTER TABLE web_digesto_texto RENAME COLUMN renumeracion TO remuneracion');
    }
}
