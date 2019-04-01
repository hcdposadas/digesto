<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401170701 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE web_digesto_texto (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, prologo TEXT DEFAULT NULL, resenia TEXT DEFAULT NULL, metodologia_trabajo TEXT DEFAULT NULL, remuneracion TEXT DEFAULT NULL, instructivo_informativo TEXT DEFAULT NULL, contacto_facebook VARCHAR(255) DEFAULT NULL, contacto_instagram VARCHAR(255) DEFAULT NULL, contacto_twitter VARCHAR(255) DEFAULT NULL, contacto_mail VARCHAR(255) DEFAULT NULL, contacto_telefono VARCHAR(255) DEFAULT NULL, contacto_direccion VARCHAR(255) DEFAULT NULL, contacto_horario_atencion VARCHAR(255) DEFAULT NULL, presidente_hcd VARCHAR(255) DEFAULT NULL, director_digesto VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CD626C6AFE35D8C4 ON web_digesto_texto (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_CD626C6AF6167A1C ON web_digesto_texto (actualizado_por_id)');
        $this->addSql('ALTER TABLE web_digesto_texto ADD CONSTRAINT FK_CD626C6AFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE web_digesto_texto ADD CONSTRAINT FK_CD626C6AF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE web_digesto_texto');
    }
}
