<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200715012702 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE cambio_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE abrogacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE adhesiones_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cambio_norma (id INT NOT NULL, norma_id INT DEFAULT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, fecha DATE NOT NULL, articulo VARCHAR(255) NOT NULL, fuente VARCHAR(2048) DEFAULT NULL, remision_externa VARCHAR(2048) DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5499FC50E06FC29E ON cambio_norma (norma_id)');
        $this->addSql('CREATE INDEX IDX_5499FC50FE35D8C4 ON cambio_norma (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_5499FC50F6167A1C ON cambio_norma (actualizado_por_id)');
        $this->addSql('CREATE TABLE abrogacion (id INT NOT NULL, norma_id INT NOT NULL, norma_abrogante_id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, norma_completa BOOLEAN NOT NULL, articulo VARCHAR(255) DEFAULT NULL, articulo_anexo VARCHAR(255) DEFAULT NULL, articulo_abrogante VARCHAR(255) DEFAULT NULL, anexo_abrogante VARCHAR(255) DEFAULT NULL, fundamentacion TEXT DEFAULT NULL, observaciones TEXT DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ABE8F691E06FC29E ON abrogacion (norma_id)');
        $this->addSql('CREATE INDEX IDX_ABE8F69163D6954A ON abrogacion (norma_abrogante_id)');
        $this->addSql('CREATE INDEX IDX_ABE8F691FE35D8C4 ON abrogacion (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_ABE8F691F6167A1C ON abrogacion (actualizado_por_id)');
        $this->addSql('CREATE TABLE adhesiones (id INT NOT NULL, norma_id INT DEFAULT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, tipo VARCHAR(255) NOT NULL, adhesion VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EFBEDB94E06FC29E ON adhesiones (norma_id)');
        $this->addSql('CREATE INDEX IDX_EFBEDB94FE35D8C4 ON adhesiones (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_EFBEDB94F6167A1C ON adhesiones (actualizado_por_id)');
        $this->addSql('ALTER TABLE cambio_norma ADD CONSTRAINT FK_5499FC50E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cambio_norma ADD CONSTRAINT FK_5499FC50FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cambio_norma ADD CONSTRAINT FK_5499FC50F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE abrogacion ADD CONSTRAINT FK_ABE8F691E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE abrogacion ADD CONSTRAINT FK_ABE8F69163D6954A FOREIGN KEY (norma_abrogante_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE abrogacion ADD CONSTRAINT FK_ABE8F691FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE abrogacion ADD CONSTRAINT FK_ABE8F691F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE adhesiones ADD CONSTRAINT FK_EFBEDB94E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE adhesiones ADD CONSTRAINT FK_EFBEDB94FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE adhesiones ADD CONSTRAINT FK_EFBEDB94F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE cambio_norma_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE abrogacion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE adhesiones_id_seq CASCADE');
        $this->addSql('DROP TABLE cambio_norma');
        $this->addSql('DROP TABLE abrogacion');
        $this->addSql('DROP TABLE adhesiones');
    }
}
