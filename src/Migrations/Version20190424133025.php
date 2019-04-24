<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190424133025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE web_digesto_texto_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE norma ALTER rama_id DROP NOT NULL');
        $this->addSql('ALTER TABLE norma ALTER fecha_sancion DROP NOT NULL');
        $this->addSql('ALTER TABLE norma ALTER tema_general TYPE VARCHAR(2048)');
        $this->addSql('ALTER TABLE beneficiario_norma ADD creado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE beneficiario_norma ADD actualizado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE beneficiario_norma ADD activo BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE beneficiario_norma ADD fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE beneficiario_norma ADD fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE beneficiario_norma ADD CONSTRAINT FK_B43F3AF4FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE beneficiario_norma ADD CONSTRAINT FK_B43F3AF4F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B43F3AF4FE35D8C4 ON beneficiario_norma (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_B43F3AF4F6167A1C ON beneficiario_norma (actualizado_por_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE web_digesto_texto_id_seq CASCADE');
        $this->addSql('ALTER TABLE beneficiario_norma DROP CONSTRAINT FK_B43F3AF4FE35D8C4');
        $this->addSql('ALTER TABLE beneficiario_norma DROP CONSTRAINT FK_B43F3AF4F6167A1C');
        $this->addSql('DROP INDEX IDX_B43F3AF4FE35D8C4');
        $this->addSql('DROP INDEX IDX_B43F3AF4F6167A1C');
        $this->addSql('ALTER TABLE beneficiario_norma DROP creado_por_id');
        $this->addSql('ALTER TABLE beneficiario_norma DROP actualizado_por_id');
        $this->addSql('ALTER TABLE beneficiario_norma DROP activo');
        $this->addSql('ALTER TABLE beneficiario_norma DROP fecha_creacion');
        $this->addSql('ALTER TABLE beneficiario_norma DROP fecha_actualizacion');
        $this->addSql('ALTER TABLE norma ALTER rama_id SET NOT NULL');
        $this->addSql('ALTER TABLE norma ALTER fecha_sancion SET NOT NULL');
        $this->addSql('ALTER TABLE norma ALTER tema_general TYPE VARCHAR(255)');
    }
}
