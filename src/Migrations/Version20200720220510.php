<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720220510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE refundicion ALTER articulo DROP NOT NULL');
        $this->addSql('ALTER TABLE refundicion ALTER articulo_anexo DROP NOT NULL');
        $this->addSql('ALTER TABLE refundicion ALTER articulo_refundido DROP NOT NULL');
        $this->addSql('ALTER TABLE refundicion ALTER articulo_anexo_refundido DROP NOT NULL');
        $this->addSql('ALTER TABLE refundicion ALTER observaciones DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE refundicion ALTER articulo SET NOT NULL');
        $this->addSql('ALTER TABLE refundicion ALTER articulo_anexo SET NOT NULL');
        $this->addSql('ALTER TABLE refundicion ALTER articulo_refundido SET NOT NULL');
        $this->addSql('ALTER TABLE refundicion ALTER articulo_anexo_refundido SET NOT NULL');
        $this->addSql('ALTER TABLE refundicion ALTER observaciones SET NOT NULL');
    }
}
