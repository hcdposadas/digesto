<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716001530 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE conflicto_normativo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE conflicto_normativo (id INT NOT NULL, norma_id INT NOT NULL, conflicto_con_norma_id INT NOT NULL, articulo VARCHAR(255) NOT NULL, articulo_anexo VARCHAR(255) NOT NULL, articulo_conflicto VARCHAR(255) NOT NULL, articulo_anexo_conflicto VARCHAR(255) NOT NULL, solucion_adoptada VARCHAR(255) NOT NULL, fundamentacion TEXT NOT NULL, observaciones TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_90E7D3F0E06FC29E ON conflicto_normativo (norma_id)');
        $this->addSql('CREATE INDEX IDX_90E7D3F0C60326CB ON conflicto_normativo (conflicto_con_norma_id)');
        $this->addSql('ALTER TABLE conflicto_normativo ADD CONSTRAINT FK_90E7D3F0E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE conflicto_normativo ADD CONSTRAINT FK_90E7D3F0C60326CB FOREIGN KEY (conflicto_con_norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE conflicto_normativo_id_seq CASCADE');
        $this->addSql('DROP TABLE conflicto_normativo');
    }
}
