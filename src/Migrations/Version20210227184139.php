<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210227184139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE tema_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tema_norma (id INT NOT NULL, tema_id INT NOT NULL, norma_id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_69FF1705A64A8A17 ON tema_norma (tema_id)');
        $this->addSql('CREATE INDEX IDX_69FF1705E06FC29E ON tema_norma (norma_id)');
        $this->addSql('CREATE INDEX IDX_69FF1705FE35D8C4 ON tema_norma (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_69FF1705F6167A1C ON tema_norma (actualizado_por_id)');
        $this->addSql('ALTER TABLE tema_norma ADD CONSTRAINT FK_69FF1705A64A8A17 FOREIGN KEY (tema_id) REFERENCES tema (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tema_norma ADD CONSTRAINT FK_69FF1705E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tema_norma ADD CONSTRAINT FK_69FF1705FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tema_norma ADD CONSTRAINT FK_69FF1705F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE tema_norma_id_seq CASCADE');
        $this->addSql('DROP TABLE tema_norma');
    }
}
