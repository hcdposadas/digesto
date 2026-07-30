<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Agrega los documentos de Proyecto, Dictamen y Sanción a la norma.
 */
final class Version20260730085010 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Agrega los archivos de proyecto, dictamen y sanción a la norma';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE norma ADD nombre_archivo_proyecto VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE norma ADD nombre_archivo_dictamen VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE norma ADD nombre_archivo_sancion VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE norma DROP nombre_archivo_proyecto');
        $this->addSql('ALTER TABLE norma DROP nombre_archivo_dictamen');
        $this->addSql('ALTER TABLE norma DROP nombre_archivo_sancion');
    }
}
