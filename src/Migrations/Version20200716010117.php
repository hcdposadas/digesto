<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716010117 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE refundicion ADD creado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE refundicion ADD actualizado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE refundicion ADD activo BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE refundicion ADD fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE refundicion ADD fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE refundicion ADD CONSTRAINT FK_CBFA0E8DFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE refundicion ADD CONSTRAINT FK_CBFA0E8DF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CBFA0E8DFE35D8C4 ON refundicion (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_CBFA0E8DF6167A1C ON refundicion (actualizado_por_id)');
        $this->addSql('ALTER TABLE conflicto_normativo ADD creado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ADD actualizado_por_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ADD norma_completa BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ADD activo BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ADD fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ADD fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE conflicto_normativo ADD CONSTRAINT FK_90E7D3F0FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE conflicto_normativo ADD CONSTRAINT FK_90E7D3F0F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_90E7D3F0FE35D8C4 ON conflicto_normativo (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_90E7D3F0F6167A1C ON conflicto_normativo (actualizado_por_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE conflicto_normativo DROP CONSTRAINT FK_90E7D3F0FE35D8C4');
        $this->addSql('ALTER TABLE conflicto_normativo DROP CONSTRAINT FK_90E7D3F0F6167A1C');
        $this->addSql('DROP INDEX IDX_90E7D3F0FE35D8C4');
        $this->addSql('DROP INDEX IDX_90E7D3F0F6167A1C');
        $this->addSql('ALTER TABLE conflicto_normativo DROP creado_por_id');
        $this->addSql('ALTER TABLE conflicto_normativo DROP actualizado_por_id');
        $this->addSql('ALTER TABLE conflicto_normativo DROP norma_completa');
        $this->addSql('ALTER TABLE conflicto_normativo DROP activo');
        $this->addSql('ALTER TABLE conflicto_normativo DROP fecha_creacion');
        $this->addSql('ALTER TABLE conflicto_normativo DROP fecha_actualizacion');
        $this->addSql('ALTER TABLE refundicion DROP CONSTRAINT FK_CBFA0E8DFE35D8C4');
        $this->addSql('ALTER TABLE refundicion DROP CONSTRAINT FK_CBFA0E8DF6167A1C');
        $this->addSql('DROP INDEX IDX_CBFA0E8DFE35D8C4');
        $this->addSql('DROP INDEX IDX_CBFA0E8DF6167A1C');
        $this->addSql('ALTER TABLE refundicion DROP creado_por_id');
        $this->addSql('ALTER TABLE refundicion DROP actualizado_por_id');
        $this->addSql('ALTER TABLE refundicion DROP activo');
        $this->addSql('ALTER TABLE refundicion DROP fecha_creacion');
        $this->addSql('ALTER TABLE refundicion DROP fecha_actualizacion');
    }
}
