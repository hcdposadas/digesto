<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201009000420 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE articulo_suprimido_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE articulo_suprimido (id INT NOT NULL, consolidacion_id INT NOT NULL, norma_id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, fecha DATE NOT NULL, articulo VARCHAR(255) NOT NULL, descripcion TEXT DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_50F5BDAF56F6E268 ON articulo_suprimido (consolidacion_id)');
        $this->addSql('CREATE INDEX IDX_50F5BDAFE06FC29E ON articulo_suprimido (norma_id)');
        $this->addSql('CREATE INDEX IDX_50F5BDAFFE35D8C4 ON articulo_suprimido (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_50F5BDAFF6167A1C ON articulo_suprimido (actualizado_por_id)');
        $this->addSql('ALTER TABLE articulo_suprimido ADD CONSTRAINT FK_50F5BDAF56F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE articulo_suprimido ADD CONSTRAINT FK_50F5BDAFE06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE articulo_suprimido ADD CONSTRAINT FK_50F5BDAFFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE articulo_suprimido ADD CONSTRAINT FK_50F5BDAFF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cambio_norma DROP articulos_suprimidos');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE articulo_suprimido_id_seq CASCADE');
        $this->addSql('DROP TABLE articulo_suprimido');
        $this->addSql('ALTER TABLE cambio_norma ADD articulos_suprimidos TEXT DEFAULT NULL');
    }
}
