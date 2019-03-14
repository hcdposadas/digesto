<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190314194204 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE norma_consolidacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE norma_consolidacion (id INT NOT NULL, norma_id INT NOT NULL, consolidacion_id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C3CAEDC8E06FC29E ON norma_consolidacion (norma_id)');
        $this->addSql('CREATE INDEX IDX_C3CAEDC856F6E268 ON norma_consolidacion (consolidacion_id)');
        $this->addSql('CREATE INDEX IDX_C3CAEDC8FE35D8C4 ON norma_consolidacion (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_C3CAEDC8F6167A1C ON norma_consolidacion (actualizado_por_id)');
        $this->addSql('ALTER TABLE norma_consolidacion ADD CONSTRAINT FK_C3CAEDC8E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE norma_consolidacion ADD CONSTRAINT FK_C3CAEDC856F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE norma_consolidacion ADD CONSTRAINT FK_C3CAEDC8FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE norma_consolidacion ADD CONSTRAINT FK_C3CAEDC8F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE norma_consolidacion_id_seq CASCADE');
        $this->addSql('DROP TABLE norma_consolidacion');
    }
}
