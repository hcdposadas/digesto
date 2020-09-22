<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716013925 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE tipo_solucion_conflicto_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_norma_adhesion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_caducidad_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tipo_solucion_conflicto (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_52AE3B3FE35D8C4 ON tipo_solucion_conflicto (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_52AE3B3F6167A1C ON tipo_solucion_conflicto (actualizado_por_id)');
        $this->addSql('CREATE TABLE tipo_norma_adhesion (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_537C3F2BFE35D8C4 ON tipo_norma_adhesion (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_537C3F2BF6167A1C ON tipo_norma_adhesion (actualizado_por_id)');
        $this->addSql('CREATE TABLE tipo_caducidad (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B8856B6FFE35D8C4 ON tipo_caducidad (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_B8856B6FF6167A1C ON tipo_caducidad (actualizado_por_id)');
        $this->addSql('ALTER TABLE tipo_solucion_conflicto ADD CONSTRAINT FK_52AE3B3FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_solucion_conflicto ADD CONSTRAINT FK_52AE3B3F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_norma_adhesion ADD CONSTRAINT FK_537C3F2BFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_norma_adhesion ADD CONSTRAINT FK_537C3F2BF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_caducidad ADD CONSTRAINT FK_B8856B6FFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_caducidad ADD CONSTRAINT FK_B8856B6FF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cambio_norma ADD consolidacion_id INT NOT NULL');
        $this->addSql('ALTER TABLE cambio_norma ADD CONSTRAINT FK_5499FC5056F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5499FC5056F6E268 ON cambio_norma (consolidacion_id)');
        $this->addSql('ALTER TABLE abrogacion ADD consolidacion_id INT NOT NULL');
        $this->addSql('ALTER TABLE abrogacion ADD CONSTRAINT FK_ABE8F69156F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_ABE8F69156F6E268 ON abrogacion (consolidacion_id)');
        $this->addSql('ALTER TABLE consolidacion ADD actual BOOLEAN DEFAULT \'false\' NOT NULL');
        $this->addSql('ALTER TABLE refundicion ADD consolidacion_id INT NOT NULL');
        $this->addSql('ALTER TABLE refundicion ADD CONSTRAINT FK_CBFA0E8D56F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CBFA0E8D56F6E268 ON refundicion (consolidacion_id)');
        $this->addSql('ALTER TABLE conflicto_normativo ADD consolidacion_id INT NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ADD CONSTRAINT FK_90E7D3F056F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_90E7D3F056F6E268 ON conflicto_normativo (consolidacion_id)');
        $this->addSql('ALTER TABLE adhesiones ADD consolidacion_id INT NOT NULL');
        $this->addSql('ALTER TABLE adhesiones ADD CONSTRAINT FK_EFBEDB9456F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EFBEDB9456F6E268 ON adhesiones (consolidacion_id)');
        $this->addSql('ALTER TABLE caducidad ADD consolidacion_id INT NOT NULL');
        $this->addSql('ALTER TABLE caducidad ADD creado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE caducidad ADD actualizado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE caducidad ADD activo BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE caducidad ADD fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE caducidad ADD fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE caducidad ADD CONSTRAINT FK_5AEBD42156F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE caducidad ADD CONSTRAINT FK_5AEBD421FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE caducidad ADD CONSTRAINT FK_5AEBD421F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5AEBD42156F6E268 ON caducidad (consolidacion_id)');
        $this->addSql('CREATE INDEX IDX_5AEBD421FE35D8C4 ON caducidad (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_5AEBD421F6167A1C ON caducidad (actualizado_por_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE tipo_solucion_conflicto_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_norma_adhesion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_caducidad_id_seq CASCADE');
        $this->addSql('DROP TABLE tipo_solucion_conflicto');
        $this->addSql('DROP TABLE tipo_norma_adhesion');
        $this->addSql('DROP TABLE tipo_caducidad');
        $this->addSql('ALTER TABLE consolidacion DROP actual');
        $this->addSql('ALTER TABLE cambio_norma DROP CONSTRAINT FK_5499FC5056F6E268');
        $this->addSql('DROP INDEX IDX_5499FC5056F6E268');
        $this->addSql('ALTER TABLE cambio_norma DROP consolidacion_id');
        $this->addSql('ALTER TABLE abrogacion DROP CONSTRAINT FK_ABE8F69156F6E268');
        $this->addSql('DROP INDEX IDX_ABE8F69156F6E268');
        $this->addSql('ALTER TABLE abrogacion DROP consolidacion_id');
        $this->addSql('ALTER TABLE adhesiones DROP CONSTRAINT FK_EFBEDB9456F6E268');
        $this->addSql('DROP INDEX IDX_EFBEDB9456F6E268');
        $this->addSql('ALTER TABLE adhesiones DROP consolidacion_id');
        $this->addSql('ALTER TABLE caducidad DROP CONSTRAINT FK_5AEBD42156F6E268');
        $this->addSql('ALTER TABLE caducidad DROP CONSTRAINT FK_5AEBD421FE35D8C4');
        $this->addSql('ALTER TABLE caducidad DROP CONSTRAINT FK_5AEBD421F6167A1C');
        $this->addSql('DROP INDEX IDX_5AEBD42156F6E268');
        $this->addSql('DROP INDEX IDX_5AEBD421FE35D8C4');
        $this->addSql('DROP INDEX IDX_5AEBD421F6167A1C');
        $this->addSql('ALTER TABLE caducidad DROP consolidacion_id');
        $this->addSql('ALTER TABLE caducidad DROP creado_por_id');
        $this->addSql('ALTER TABLE caducidad DROP actualizado_por_id');
        $this->addSql('ALTER TABLE caducidad DROP activo');
        $this->addSql('ALTER TABLE caducidad DROP fecha_creacion');
        $this->addSql('ALTER TABLE caducidad DROP fecha_actualizacion');
        $this->addSql('ALTER TABLE refundicion DROP CONSTRAINT FK_CBFA0E8D56F6E268');
        $this->addSql('DROP INDEX IDX_CBFA0E8D56F6E268');
        $this->addSql('ALTER TABLE refundicion DROP consolidacion_id');
        $this->addSql('ALTER TABLE conflicto_normativo DROP CONSTRAINT FK_90E7D3F056F6E268');
        $this->addSql('DROP INDEX IDX_90E7D3F056F6E268');
        $this->addSql('ALTER TABLE conflicto_normativo DROP consolidacion_id');
    }
}
