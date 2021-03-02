<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210228193642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE tipo_veto_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tipo_veto (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BD7D3EE9FE35D8C4 ON tipo_veto (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_BD7D3EE9F6167A1C ON tipo_veto (actualizado_por_id)');
        $this->addSql('ALTER TABLE tipo_veto ADD CONSTRAINT FK_BD7D3EE9FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_veto ADD CONSTRAINT FK_BD7D3EE9F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE norma ADD tipo_veto_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE norma ADD observaciones_veto TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE norma ADD CONSTRAINT FK_3EF6217EAF03385E FOREIGN KEY (tipo_veto_id) REFERENCES tipo_veto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3EF6217EAF03385E ON norma (tipo_veto_id)');
        $this->addSql('INSERT INTO tipo_veto (id, creado_por_id, actualizado_por_id, nombre, activo, fecha_creacion, fecha_actualizacion) VALUES (1, \'1\', \'1\', \'Parcial\', \'t\', \'2021-01-01 00:00:00\', \'2021-01-01 00:00:00\');');
        $this->addSql('INSERT INTO tipo_veto (id, creado_por_id, actualizado_por_id, nombre, activo, fecha_creacion, fecha_actualizacion) VALUES (2, \'1\', \'1\', \'Total\', \'t\', \'2021-01-01 00:00:00\', \'2021-01-01 00:00:00\');');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE norma DROP CONSTRAINT FK_3EF6217EAF03385E');
        $this->addSql('DROP SEQUENCE tipo_veto_id_seq CASCADE');
        $this->addSql('DROP TABLE tipo_veto');
        $this->addSql('DROP INDEX IDX_3EF6217EAF03385E');
        $this->addSql('ALTER TABLE norma DROP tipo_veto_id');
        $this->addSql('ALTER TABLE norma DROP observaciones_veto');
    }
}
