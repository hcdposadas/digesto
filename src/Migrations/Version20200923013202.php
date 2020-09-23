<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200923013202 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE fundamentacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE fundamentacion (id INT NOT NULL, consolidacion_id INT NOT NULL, norma_id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, fundamentacion TEXT DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E1813AE656F6E268 ON fundamentacion (consolidacion_id)');
        $this->addSql('CREATE INDEX IDX_E1813AE6E06FC29E ON fundamentacion (norma_id)');
        $this->addSql('CREATE INDEX IDX_E1813AE6FE35D8C4 ON fundamentacion (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_E1813AE6F6167A1C ON fundamentacion (actualizado_por_id)');
        $this->addSql('ALTER TABLE fundamentacion ADD CONSTRAINT FK_E1813AE656F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fundamentacion ADD CONSTRAINT FK_E1813AE6E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fundamentacion ADD CONSTRAINT FK_E1813AE6FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fundamentacion ADD CONSTRAINT FK_E1813AE6F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE log_norma');
        $this->addSql('DROP TABLE log_texto_definitivo');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE fundamentacion_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE log_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE log_norma_id_seq1 INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE log_texto_definitivo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE log_texto_definitivo_id_seq1 INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE log_norma (id SERIAL NOT NULL, operation CHAR(1) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE log_texto_definitivo (id SERIAL NOT NULL, operation CHAR(1) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE fundamentacion');
    }
}
