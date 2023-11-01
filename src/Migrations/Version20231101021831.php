<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231101021831 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE cambio_norma ADD titulo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE cambio_norma ADD nombre_archivo_cambio_norma VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE cambio_norma ALTER articulo DROP NOT NULL');

        $this->addSql('ALTER TABLE cambio_anexo ADD titulo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE cambio_anexo ADD nombre_archivo_cambio_anexo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE articulo_suprimido ADD titulo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE articulo_suprimido ADD nombre_archivo_articulo_suprimido VARCHAR(255) DEFAULT NULL');

        $this->addSql('ALTER TABLE articulo_suprimido ALTER articulo DROP NOT NULL');

        $this->addSql('ALTER TABLE cambio_anexo ALTER anexo DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');

        $this->addSql('ALTER TABLE cambio_norma DROP titulo');
        $this->addSql('ALTER TABLE cambio_norma DROP nombre_archivo_cambio_norma');
        $this->addSql('ALTER TABLE cambio_norma ALTER articulo SET NOT NULL');

        $this->addSql('ALTER TABLE articulo_suprimido DROP titulo');
        $this->addSql('ALTER TABLE articulo_suprimido DROP nombre_archivo_articulo_suprimido');
        $this->addSql('ALTER TABLE cambio_anexo DROP titulo');
        $this->addSql('ALTER TABLE cambio_anexo DROP nombre_archivo_cambio_anexo');

        $this->addSql('ALTER TABLE articulo_suprimido ALTER articulo SET NOT NULL');
        
        $this->addSql('ALTER TABLE cambio_anexo ALTER anexo SET NOT NULL');
    }
}
