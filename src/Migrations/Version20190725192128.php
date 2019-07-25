<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190725192128 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE web_digesto_texto ADD nombre_archivo_foto_presidente VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE web_digesto_texto ADD nombre_archivo_foto_director VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE web_digesto_texto ADD vice_presidente_primero_hcd VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE web_digesto_texto ADD nombre_archivo_foto_vice_presidente_primero VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE web_digesto_texto ADD vice_presidente_segundo_hcd VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE web_digesto_texto ADD nombre_archivo_foto_vice_presidente_segundo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE web_digesto_texto DROP nombre_archivo_foto_presidente');
        $this->addSql('ALTER TABLE web_digesto_texto DROP nombre_archivo_foto_director');
        $this->addSql('ALTER TABLE web_digesto_texto DROP vice_presidente_primero_hcd');
        $this->addSql('ALTER TABLE web_digesto_texto DROP nombre_archivo_foto_vice_presidente_primero');
        $this->addSql('ALTER TABLE web_digesto_texto DROP vice_presidente_segundo_hcd');
        $this->addSql('ALTER TABLE web_digesto_texto DROP nombre_archivo_foto_vice_presidente_segundo');
    }
}
