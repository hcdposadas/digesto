<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716234240 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE texto_definitivo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE texto_definitivo (id INT NOT NULL, norma_id INT NOT NULL, consolidacion_id INT NOT NULL, texto_definitivo TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E313F079E06FC29E ON texto_definitivo (norma_id)');
        $this->addSql('CREATE INDEX IDX_E313F07956F6E268 ON texto_definitivo (consolidacion_id)');
        $this->addSql('ALTER TABLE texto_definitivo ADD CONSTRAINT FK_E313F079E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE texto_definitivo ADD CONSTRAINT FK_E313F07956F6E268 FOREIGN KEY (consolidacion_id) REFERENCES consolidacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE texto_definitivo_id_seq CASCADE');
        $this->addSql('DROP TABLE texto_definitivo');
    }
}
