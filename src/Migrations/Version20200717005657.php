<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200717005657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE estado_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_estado_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE estado_norma (id INT NOT NULL, norma_id INT NOT NULL, consolidacion_id INT NOT NULL, estado_id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_340DA78CE06FC29E ON estado_norma (norma_id)');
        $this->addSql('CREATE INDEX IDX_340DA78C56F6E268 ON estado_norma (consolidacion_id)');
        $this->addSql('CREATE INDEX IDX_340DA78C9F5A440B ON estado_norma (estado_id)');
        $this->addSql('CREATE INDEX IDX_340DA78CFE35D8C4 ON estado_norma (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_340DA78CF6167A1C ON estado_norma (actualizado_por_id)');
        $this->addSql('CREATE TABLE tipo_estado_norma (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_875EF98CFE35D8C4 ON tipo_estado_norma (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_875EF98CF6167A1C ON tipo_estado_norma (actualizado_por_id)');
        $this->addSql('ALTER TABLE estado_norma ADD CONSTRAINT FK_340DA78CE06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE estado_norma ADD CONSTRAINT FK_340DA78C56F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE estado_norma ADD CONSTRAINT FK_340DA78C9F5A440B FOREIGN KEY (estado_id) REFERENCES tipo_estado_norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE estado_norma ADD CONSTRAINT FK_340DA78CFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE estado_norma ADD CONSTRAINT FK_340DA78CF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_estado_norma ADD CONSTRAINT FK_875EF98CFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_estado_norma ADD CONSTRAINT FK_875EF98CF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE texto_definitivo ADD creado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE texto_definitivo ADD actualizado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE texto_definitivo ADD activo BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE texto_definitivo ADD fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE texto_definitivo ADD fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE texto_definitivo ADD CONSTRAINT FK_E313F079FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE texto_definitivo ADD CONSTRAINT FK_E313F079F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E313F079FE35D8C4 ON texto_definitivo (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_E313F079F6167A1C ON texto_definitivo (actualizado_por_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE estado_norma DROP CONSTRAINT FK_340DA78C9F5A440B');
        $this->addSql('DROP SEQUENCE estado_norma_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_estado_norma_id_seq CASCADE');
        $this->addSql('DROP TABLE estado_norma');
        $this->addSql('DROP TABLE tipo_estado_norma');
        $this->addSql('ALTER TABLE texto_definitivo DROP CONSTRAINT FK_E313F079FE35D8C4');
        $this->addSql('ALTER TABLE texto_definitivo DROP CONSTRAINT FK_E313F079F6167A1C');
        $this->addSql('DROP INDEX IDX_E313F079FE35D8C4');
        $this->addSql('DROP INDEX IDX_E313F079F6167A1C');
        $this->addSql('ALTER TABLE texto_definitivo DROP creado_por_id');
        $this->addSql('ALTER TABLE texto_definitivo DROP actualizado_por_id');
        $this->addSql('ALTER TABLE texto_definitivo DROP activo');
        $this->addSql('ALTER TABLE texto_definitivo DROP fecha_creacion');
        $this->addSql('ALTER TABLE texto_definitivo DROP fecha_actualizacion');
    }
}
