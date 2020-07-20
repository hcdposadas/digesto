<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720215948 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE abrogacion ALTER fundamentacion SET NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ALTER articulo DROP NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ALTER articulo_anexo DROP NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ALTER articulo_conflicto DROP NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ALTER articulo_anexo_conflicto DROP NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ALTER observaciones DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE abrogacion ALTER fundamentacion DROP NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ALTER articulo SET NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ALTER articulo_anexo SET NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ALTER articulo_conflicto SET NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ALTER articulo_anexo_conflicto SET NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ALTER observaciones SET NOT NULL');
    }
}
