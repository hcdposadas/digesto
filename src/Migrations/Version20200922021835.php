<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200922021835 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE log_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE log_norma (id SERIAL NOT NULL, operation CHAR(1) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data TEXT DEFAULT NULL, PRIMARY KEY(id))');

        $this->addSql('CREATE SEQUENCE log_texto_definitivo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE log_texto_definitivo (id SERIAL NOT NULL, operation CHAR(1) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data TEXT DEFAULT NULL, PRIMARY KEY(id))');

        $this->addSql('
            CREATE OR REPLACE FUNCTION process_log_norma() RETURNS TRIGGER AS $log_norma$
            BEGIN --
              IF (TG_OP = \'DELETE\') THEN
                INSERT INTO log_norma (operation, created_at, "data")
                  SELECT \'D\',
                    now(),
                    ROW(OLD.*);
              ELSIF (TG_OP = \'UPDATE\') THEN
                INSERT INTO log_norma (operation, created_at, "data")
                  SELECT \'U\',
                    now(),
                    ROW(NEW.*);
              ELSIF (TG_OP = \'INSERT\') THEN
                INSERT INTO log_norma (operation, created_at, "data")
                  SELECT \'I\',
                    now(),
                    ROW(NEW.*);
              END IF;
              RETURN NULL;
              -- result is ignored since this is an AFTER trigger
            END;
            $log_norma$ LANGUAGE plpgsql;');
        $this->addSql('CREATE TRIGGER log_norma AFTER INSERT OR UPDATE OR DELETE ON norma FOR EACH ROW EXECUTE PROCEDURE process_log_norma()');


        $this->addSql('
            CREATE OR REPLACE FUNCTION process_log_texto_definitivo() RETURNS TRIGGER AS $log_texto_definitivo$
            BEGIN --
              IF (TG_OP = \'DELETE\') THEN
                INSERT INTO log_texto_definitivo (operation, created_at, "data")
                  SELECT \'D\',
                    now(),
                    ROW(OLD.*);
              ELSIF (TG_OP = \'UPDATE\') THEN
                INSERT INTO log_texto_definitivo (operation, created_at, "data")
                  SELECT \'U\',
                    now(),
                    ROW(NEW.*);
              ELSIF (TG_OP = \'INSERT\') THEN
                INSERT INTO log_texto_definitivo (operation, created_at, "data")
                  SELECT \'I\',
                    now(),
                    ROW(NEW.*);
              END IF;
              RETURN NULL;
              -- result is ignored since this is an AFTER trigger
            END;
            $log_texto_definitivo$ LANGUAGE plpgsql;');
        $this->addSql('CREATE TRIGGER log_texto_definitivo AFTER INSERT OR UPDATE OR DELETE ON texto_definitivo FOR EACH ROW EXECUTE PROCEDURE process_log_texto_definitivo()');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');

        $this->addSql('DROP TRIGGER IF EXISTS log_norma ON norma');
        $this->addSql('DROP SEQUENCE log_norma_id_seq CASCADE');
        $this->addSql('DROP TABLE log_norma');

        $this->addSql('DROP TRIGGER IF EXISTS log_texto_definitivo ON texto_definitivo');
        $this->addSql('DROP SEQUENCE log_texto_definitivo_id_seq CASCADE');
        $this->addSql('DROP TABLE log_texto_definitivo');
    }
}
