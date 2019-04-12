<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190412184725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE norma ADD tipo_ordenanza_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE norma ADD boletin_oficial_municipal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE norma ADD numero_anterior INT DEFAULT NULL');
        $this->addSql('ALTER TABLE norma ADD CONSTRAINT FK_3EF6217E89500F1D FOREIGN KEY (tipo_ordenanza_id) REFERENCES tipo_ordenanza (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE norma ADD CONSTRAINT FK_3EF6217E934D3676 FOREIGN KEY (boletin_oficial_municipal_id) REFERENCES boletin_oficial_municipal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3EF6217E89500F1D ON norma (tipo_ordenanza_id)');
        $this->addSql('CREATE INDEX IDX_3EF6217E934D3676 ON norma (boletin_oficial_municipal_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE norma DROP CONSTRAINT FK_3EF6217E89500F1D');
        $this->addSql('ALTER TABLE norma DROP CONSTRAINT FK_3EF6217E934D3676');
        $this->addSql('DROP INDEX IDX_3EF6217E89500F1D');
        $this->addSql('DROP INDEX IDX_3EF6217E934D3676');
        $this->addSql('ALTER TABLE norma DROP tipo_ordenanza_id');
        $this->addSql('ALTER TABLE norma DROP boletin_oficial_municipal_id');
        $this->addSql('ALTER TABLE norma DROP numero_anterior');
    }
}
