<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210227031253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE tema_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tema (id INT NOT NULL, rama_id INT NOT NULL, tema_padre_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, descripcion TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_61E3A5385E0BFD3B ON tema (rama_id)');
        $this->addSql('CREATE INDEX IDX_61E3A538C958426F ON tema (tema_padre_id)');
        $this->addSql('ALTER TABLE tema ADD CONSTRAINT FK_61E3A5385E0BFD3B FOREIGN KEY (rama_id) REFERENCES rama (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tema ADD CONSTRAINT FK_61E3A538C958426F FOREIGN KEY (tema_padre_id) REFERENCES tema (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE tema DROP CONSTRAINT FK_61E3A538C958426F');
        $this->addSql('DROP SEQUENCE tema_id_seq CASCADE');
        $this->addSql('DROP TABLE tema');
    }
}
