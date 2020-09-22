<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716014455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE adhesiones ADD tipo_norma_adhesion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adhesiones DROP tipo');
        $this->addSql('ALTER TABLE adhesiones ADD CONSTRAINT FK_EFBEDB9453347B49 FOREIGN KEY (tipo_norma_adhesion_id) REFERENCES tipo_norma_adhesion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EFBEDB9453347B49 ON adhesiones (tipo_norma_adhesion_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE adhesiones DROP CONSTRAINT FK_EFBEDB9453347B49');
        $this->addSql('DROP INDEX IDX_EFBEDB9453347B49');
        $this->addSql('ALTER TABLE adhesiones ADD tipo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE adhesiones DROP tipo_norma_adhesion_id');
    }
}
