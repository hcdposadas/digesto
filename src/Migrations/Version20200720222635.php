<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720222635 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE cambio_norma DROP CONSTRAINT fk_5499fc5056f6e268');
        $this->addSql('DROP INDEX idx_5499fc5056f6e268');
        $this->addSql('ALTER TABLE cambio_norma DROP consolidacion_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE cambio_norma ADD consolidacion_id INT NOT NULL');
        $this->addSql('ALTER TABLE cambio_norma ADD CONSTRAINT fk_5499fc5056f6e268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5499fc5056f6e268 ON cambio_norma (consolidacion_id)');
    }
}
