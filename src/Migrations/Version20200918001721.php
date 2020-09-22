<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200918001721 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE conflicto_normativo DROP CONSTRAINT fk_90e7d3f08b566d3b');
        $this->addSql('DROP SEQUENCE tipo_solucion_conflicto_id_seq CASCADE');
        $this->addSql('DROP TABLE tipo_solucion_conflicto');
        $this->addSql('DROP INDEX idx_90e7d3f08b566d3b');
        $this->addSql('ALTER TABLE conflicto_normativo DROP tipo_solucion_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE tipo_solucion_conflicto_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tipo_solucion_conflicto (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_52ae3b3f6167a1c ON tipo_solucion_conflicto (actualizado_por_id)');
        $this->addSql('CREATE INDEX idx_52ae3b3fe35d8c4 ON tipo_solucion_conflicto (creado_por_id)');
        $this->addSql('ALTER TABLE tipo_solucion_conflicto ADD CONSTRAINT fk_52ae3b3fe35d8c4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_solucion_conflicto ADD CONSTRAINT fk_52ae3b3f6167a1c FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE conflicto_normativo ADD tipo_solucion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ADD CONSTRAINT fk_90e7d3f08b566d3b FOREIGN KEY (tipo_solucion_id) REFERENCES tipo_solucion_conflicto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_90e7d3f08b566d3b ON conflicto_normativo (tipo_solucion_id)');
    }
}
