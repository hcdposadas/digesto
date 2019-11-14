<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191114183302 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE anexo_consolidacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE anexo_consolidacion (id INT NOT NULL, consolidacion_id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, nombre_archivo VARCHAR(255) DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29C9D32C56F6E268 ON anexo_consolidacion (consolidacion_id)');
        $this->addSql('CREATE INDEX IDX_29C9D32CFE35D8C4 ON anexo_consolidacion (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_29C9D32CF6167A1C ON anexo_consolidacion (actualizado_por_id)');
        $this->addSql('ALTER TABLE anexo_consolidacion ADD CONSTRAINT FK_29C9D32C56F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE anexo_consolidacion ADD CONSTRAINT FK_29C9D32CFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE anexo_consolidacion ADD CONSTRAINT FK_29C9D32CF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE consolidacion ADD nombre_archivo_proyecto VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE anexo_consolidacion_id_seq CASCADE');
        $this->addSql('DROP TABLE anexo_consolidacion');
        $this->addSql('ALTER TABLE consolidacion DROP nombre_archivo_proyecto');
    }
}
