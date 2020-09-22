<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200917235838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE cambio_norma ADD articulos_suprimidos TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE cambio_norma ALTER remision_externa TYPE TEXT');
        $this->addSql('ALTER TABLE cambio_norma ALTER remision_externa DROP DEFAULT');
        $this->addSql('ALTER TABLE cambio_norma ALTER remision_externa TYPE TEXT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cambio_norma DROP articulos_suprimidos');
        $this->addSql('ALTER TABLE cambio_norma ALTER remision_externa TYPE VARCHAR(2048)');
        $this->addSql('ALTER TABLE cambio_norma ALTER remision_externa DROP DEFAULT');
    }
}
