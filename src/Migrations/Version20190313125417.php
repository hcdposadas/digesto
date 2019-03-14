<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190313125417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE beneficiario_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE beneficiario_norma (id INT NOT NULL, norma_id INT NOT NULL, beneficiario_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B43F3AF4E06FC29E ON beneficiario_norma (norma_id)');
        $this->addSql('CREATE INDEX IDX_B43F3AF44B64ABC7 ON beneficiario_norma (beneficiario_id)');
        $this->addSql('ALTER TABLE beneficiario_norma ADD CONSTRAINT FK_B43F3AF4E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE beneficiario_norma ADD CONSTRAINT FK_B43F3AF44B64ABC7 FOREIGN KEY (beneficiario_id) REFERENCES beneficiario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE beneficiario_norma_id_seq CASCADE');
        $this->addSql('DROP TABLE beneficiario_norma');
    }
}
