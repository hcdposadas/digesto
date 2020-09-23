<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200923010512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE observacion_antecedente_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE observacion_antecedente (id INT NOT NULL, consolidacion_id INT NOT NULL, norma_id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, observaciones TEXT DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9ED78A2956F6E268 ON observacion_antecedente (consolidacion_id)');
        $this->addSql('CREATE INDEX IDX_9ED78A29E06FC29E ON observacion_antecedente (norma_id)');
        $this->addSql('CREATE INDEX IDX_9ED78A29FE35D8C4 ON observacion_antecedente (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_9ED78A29F6167A1C ON observacion_antecedente (actualizado_por_id)');
        $this->addSql('ALTER TABLE observacion_antecedente ADD CONSTRAINT FK_9ED78A2956F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE observacion_antecedente ADD CONSTRAINT FK_9ED78A29E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE observacion_antecedente ADD CONSTRAINT FK_9ED78A29FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE observacion_antecedente ADD CONSTRAINT FK_9ED78A29F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE observacion_antecedente_id_seq CASCADE');
        $this->addSql('DROP TABLE observacion_antecedente');
    }
}
