<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716015054 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE conflicto_normativo ADD tipo_solucion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo DROP solucion_adoptada');
        $this->addSql('ALTER TABLE conflicto_normativo ADD CONSTRAINT FK_90E7D3F08B566D3B FOREIGN KEY (tipo_solucion_id) REFERENCES tipo_solucion_conflicto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_90E7D3F08B566D3B ON conflicto_normativo (tipo_solucion_id)');
        $this->addSql('ALTER TABLE caducidad ADD tipo_caducidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE caducidad DROP causal');
        $this->addSql('ALTER TABLE caducidad ADD CONSTRAINT FK_5AEBD4213E118C56 FOREIGN KEY (tipo_caducidad_id) REFERENCES tipo_caducidad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5AEBD4213E118C56 ON caducidad (tipo_caducidad_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE conflicto_normativo DROP CONSTRAINT FK_90E7D3F08B566D3B');
        $this->addSql('DROP INDEX IDX_90E7D3F08B566D3B');
        $this->addSql('ALTER TABLE conflicto_normativo ADD solucion_adoptada VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo DROP tipo_solucion_id');
        $this->addSql('ALTER TABLE caducidad DROP CONSTRAINT FK_5AEBD4213E118C56');
        $this->addSql('DROP INDEX IDX_5AEBD4213E118C56');
        $this->addSql('ALTER TABLE caducidad ADD causal VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE caducidad DROP tipo_caducidad_id');
    }
}
