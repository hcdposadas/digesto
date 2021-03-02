<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210227031943 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE tema ADD creado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tema ADD actualizado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tema ADD activo BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE tema ADD fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE tema ADD fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE tema ADD CONSTRAINT FK_61E3A538FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tema ADD CONSTRAINT FK_61E3A538F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_61E3A538FE35D8C4 ON tema (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_61E3A538F6167A1C ON tema (actualizado_por_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE tema DROP CONSTRAINT FK_61E3A538FE35D8C4');
        $this->addSql('ALTER TABLE tema DROP CONSTRAINT FK_61E3A538F6167A1C');
        $this->addSql('DROP INDEX IDX_61E3A538FE35D8C4');
        $this->addSql('DROP INDEX IDX_61E3A538F6167A1C');
        $this->addSql('ALTER TABLE tema DROP creado_por_id');
        $this->addSql('ALTER TABLE tema DROP actualizado_por_id');
        $this->addSql('ALTER TABLE tema DROP activo');
        $this->addSql('ALTER TABLE tema DROP fecha_creacion');
        $this->addSql('ALTER TABLE tema DROP fecha_actualizacion');
    }
}
