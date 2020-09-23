<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200922234159 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE log_norma_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE log_norma_id_seq1 CASCADE');
        $this->addSql('DROP SEQUENCE log_texto_definitivo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE log_texto_definitivo_id_seq1 CASCADE');
        $this->addSql('CREATE SEQUENCE anexo_original_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE anexo_original_norma (id INT NOT NULL, norma_id INT DEFAULT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, titulo VARCHAR(255) DEFAULT NULL, fecha DATE DEFAULT NULL, archivo VARCHAR(255) NOT NULL, orden INT NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7695817FE06FC29E ON anexo_original_norma (norma_id)');
        $this->addSql('CREATE INDEX IDX_7695817FFE35D8C4 ON anexo_original_norma (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_7695817FF6167A1C ON anexo_original_norma (actualizado_por_id)');
        $this->addSql('ALTER TABLE anexo_original_norma ADD CONSTRAINT FK_7695817FE06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE anexo_original_norma ADD CONSTRAINT FK_7695817FFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE anexo_original_norma ADD CONSTRAINT FK_7695817FF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE log_norma');
        $this->addSql('DROP TABLE log_texto_definitivo');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE anexo_original_norma_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE log_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE log_norma_id_seq1 INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE log_texto_definitivo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE log_texto_definitivo_id_seq1 INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE log_norma (id SERIAL NOT NULL, operation CHAR(1) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE log_texto_definitivo (id SERIAL NOT NULL, operation CHAR(1) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE anexo_original_norma');
    }
}
