<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200715235702 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE caducidad_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE caducidad (id INT NOT NULL, norma_id INT NOT NULL, norma_completa BOOLEAN NOT NULL, articulo VARCHAR(255) DEFAULT NULL, articulo_anexo VARCHAR(255) DEFAULT NULL, causal VARCHAR(255) NOT NULL, fundamentacion TEXT NOT NULL, observaciones TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5AEBD421E06FC29E ON caducidad (norma_id)');
        $this->addSql('ALTER TABLE caducidad ADD CONSTRAINT FK_5AEBD421E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE caducidad_id_seq CASCADE');
        $this->addSql('DROP TABLE caducidad');
    }
}
