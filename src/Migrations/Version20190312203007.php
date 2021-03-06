<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190312203007 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE anexo_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE consolidacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_promulgacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE palabra_clave_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE palabra_clave_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE boletin_oficial_municipal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rama_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE identificador_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE descriptor_norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE identificador_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_ordenanza_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE descriptor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_boletin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE norma_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE beneficiario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_identificador_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE anexo_norma (id INT NOT NULL, norma_id INT DEFAULT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, fecha DATE DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2440D254E06FC29E ON anexo_norma (norma_id)');
        $this->addSql('CREATE INDEX IDX_2440D254FE35D8C4 ON anexo_norma (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_2440D254F6167A1C ON anexo_norma (actualizado_por_id)');
        $this->addSql('CREATE TABLE consolidacion (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, anio INT NOT NULL, fecha DATE NOT NULL, titulo VARCHAR(255) DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F22AF2BDFE35D8C4 ON consolidacion (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_F22AF2BDF6167A1C ON consolidacion (actualizado_por_id)');
        $this->addSql('CREATE TABLE tipo_promulgacion (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F8BD80A8FE35D8C4 ON tipo_promulgacion (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_F8BD80A8F6167A1C ON tipo_promulgacion (actualizado_por_id)');
        $this->addSql('CREATE TABLE palabra_clave_norma (id INT NOT NULL, norma_id INT NOT NULL, palabra_clave_id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_58F066A9E06FC29E ON palabra_clave_norma (norma_id)');
        $this->addSql('CREATE INDEX IDX_58F066A97E0CD09E ON palabra_clave_norma (palabra_clave_id)');
        $this->addSql('CREATE INDEX IDX_58F066A9FE35D8C4 ON palabra_clave_norma (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_58F066A9F6167A1C ON palabra_clave_norma (actualizado_por_id)');
        $this->addSql('CREATE TABLE palabra_clave (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8CAF1CFAFE35D8C4 ON palabra_clave (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_8CAF1CFAF6167A1C ON palabra_clave (actualizado_por_id)');
        $this->addSql('CREATE TABLE boletin_oficial_municipal (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, numero INT NOT NULL, fecha_publicacion DATE NOT NULL, paginas INT DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4D4D4FD4FE35D8C4 ON boletin_oficial_municipal (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_4D4D4FD4F6167A1C ON boletin_oficial_municipal (actualizado_por_id)');
        $this->addSql('CREATE TABLE rama (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, color VARCHAR(255) DEFAULT NULL, color_letra VARCHAR(255) DEFAULT NULL, especial BOOLEAN DEFAULT NULL, numero_romano VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_43815238FE35D8C4 ON rama (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_43815238F6167A1C ON rama (actualizado_por_id)');
        $this->addSql('CREATE TABLE identificador_norma (id INT NOT NULL, norma_id INT NOT NULL, identificador_id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29C6DD41E06FC29E ON identificador_norma (norma_id)');
        $this->addSql('CREATE INDEX IDX_29C6DD41BFD0B734 ON identificador_norma (identificador_id)');
        $this->addSql('CREATE INDEX IDX_29C6DD41FE35D8C4 ON identificador_norma (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_29C6DD41F6167A1C ON identificador_norma (actualizado_por_id)');
        $this->addSql('CREATE TABLE descriptor_norma (id INT NOT NULL, norma_id INT NOT NULL, descriptor_id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9A9BEEF0E06FC29E ON descriptor_norma (norma_id)');
        $this->addSql('CREATE INDEX IDX_9A9BEEF02A13D45 ON descriptor_norma (descriptor_id)');
        $this->addSql('CREATE INDEX IDX_9A9BEEF0FE35D8C4 ON descriptor_norma (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_9A9BEEF0F6167A1C ON descriptor_norma (actualizado_por_id)');
        $this->addSql('CREATE TABLE identificador (id INT NOT NULL, tipo_identificador_id INT DEFAULT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A82558811A0C582F ON identificador (tipo_identificador_id)');
        $this->addSql('CREATE INDEX IDX_A8255881FE35D8C4 ON identificador (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_A8255881F6167A1C ON identificador (actualizado_por_id)');
        $this->addSql('CREATE TABLE tipo_ordenanza (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_46BCFAB5FE35D8C4 ON tipo_ordenanza (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_46BCFAB5F6167A1C ON tipo_ordenanza (actualizado_por_id)');
        $this->addSql('CREATE TABLE descriptor (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3927602FE35D8C4 ON descriptor (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_3927602F6167A1C ON descriptor (actualizado_por_id)');
        $this->addSql('CREATE TABLE tipo_boletin (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_76E9DFDDFE35D8C4 ON tipo_boletin (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_76E9DFDDF6167A1C ON tipo_boletin (actualizado_por_id)');
        $this->addSql('CREATE TABLE norma (id INT NOT NULL, tipo_promulgacion_id INT DEFAULT NULL, rama_id INT NOT NULL, rama_vigente_no_consolidada_id INT DEFAULT NULL, tipo_boletin_id INT DEFAULT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, fecha_sancion DATE NOT NULL, tema_general VARCHAR(255) NOT NULL, numero INT NOT NULL, pagina_boletin INT DEFAULT NULL, observacion TEXT DEFAULT NULL, decreto_promulgatorio VARCHAR(255) DEFAULT NULL, fecha_promulgacion DATE DEFAULT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3EF6217E3F799E6A ON norma (tipo_promulgacion_id)');
        $this->addSql('CREATE INDEX IDX_3EF6217E5E0BFD3B ON norma (rama_id)');
        $this->addSql('CREATE INDEX IDX_3EF6217E82F348F1 ON norma (rama_vigente_no_consolidada_id)');
        $this->addSql('CREATE INDEX IDX_3EF6217E3C66E029 ON norma (tipo_boletin_id)');
        $this->addSql('CREATE INDEX IDX_3EF6217EFE35D8C4 ON norma (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_3EF6217EF6167A1C ON norma (actualizado_por_id)');
        $this->addSql('CREATE TABLE beneficiario (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E8D0B617FE35D8C4 ON beneficiario (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_E8D0B617F6167A1C ON beneficiario (actualizado_por_id)');
        $this->addSql('CREATE TABLE tipo_identificador (id INT NOT NULL, creado_por_id INT DEFAULT NULL, actualizado_por_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, activo BOOLEAN DEFAULT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_actualizacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A8960BDFFE35D8C4 ON tipo_identificador (creado_por_id)');
        $this->addSql('CREATE INDEX IDX_A8960BDFF6167A1C ON tipo_identificador (actualizado_por_id)');
        $this->addSql('ALTER TABLE anexo_norma ADD CONSTRAINT FK_2440D254E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE anexo_norma ADD CONSTRAINT FK_2440D254FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE anexo_norma ADD CONSTRAINT FK_2440D254F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE consolidacion ADD CONSTRAINT FK_F22AF2BDFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE consolidacion ADD CONSTRAINT FK_F22AF2BDF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_promulgacion ADD CONSTRAINT FK_F8BD80A8FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_promulgacion ADD CONSTRAINT FK_F8BD80A8F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE palabra_clave_norma ADD CONSTRAINT FK_58F066A9E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE palabra_clave_norma ADD CONSTRAINT FK_58F066A97E0CD09E FOREIGN KEY (palabra_clave_id) REFERENCES palabra_clave (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE palabra_clave_norma ADD CONSTRAINT FK_58F066A9FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE palabra_clave_norma ADD CONSTRAINT FK_58F066A9F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE palabra_clave ADD CONSTRAINT FK_8CAF1CFAFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE palabra_clave ADD CONSTRAINT FK_8CAF1CFAF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE boletin_oficial_municipal ADD CONSTRAINT FK_4D4D4FD4FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE boletin_oficial_municipal ADD CONSTRAINT FK_4D4D4FD4F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rama ADD CONSTRAINT FK_43815238FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rama ADD CONSTRAINT FK_43815238F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE identificador_norma ADD CONSTRAINT FK_29C6DD41E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE identificador_norma ADD CONSTRAINT FK_29C6DD41BFD0B734 FOREIGN KEY (identificador_id) REFERENCES identificador (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE identificador_norma ADD CONSTRAINT FK_29C6DD41FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE identificador_norma ADD CONSTRAINT FK_29C6DD41F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE descriptor_norma ADD CONSTRAINT FK_9A9BEEF0E06FC29E FOREIGN KEY (norma_id) REFERENCES norma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE descriptor_norma ADD CONSTRAINT FK_9A9BEEF02A13D45 FOREIGN KEY (descriptor_id) REFERENCES descriptor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE descriptor_norma ADD CONSTRAINT FK_9A9BEEF0FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE descriptor_norma ADD CONSTRAINT FK_9A9BEEF0F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE identificador ADD CONSTRAINT FK_A82558811A0C582F FOREIGN KEY (tipo_identificador_id) REFERENCES tipo_identificador (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE identificador ADD CONSTRAINT FK_A8255881FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE identificador ADD CONSTRAINT FK_A8255881F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_ordenanza ADD CONSTRAINT FK_46BCFAB5FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_ordenanza ADD CONSTRAINT FK_46BCFAB5F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE descriptor ADD CONSTRAINT FK_3927602FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE descriptor ADD CONSTRAINT FK_3927602F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_boletin ADD CONSTRAINT FK_76E9DFDDFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_boletin ADD CONSTRAINT FK_76E9DFDDF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE norma ADD CONSTRAINT FK_3EF6217E3F799E6A FOREIGN KEY (tipo_promulgacion_id) REFERENCES tipo_promulgacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE norma ADD CONSTRAINT FK_3EF6217E5E0BFD3B FOREIGN KEY (rama_id) REFERENCES rama (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE norma ADD CONSTRAINT FK_3EF6217E82F348F1 FOREIGN KEY (rama_vigente_no_consolidada_id) REFERENCES rama (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE norma ADD CONSTRAINT FK_3EF6217E3C66E029 FOREIGN KEY (tipo_boletin_id) REFERENCES tipo_boletin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE norma ADD CONSTRAINT FK_3EF6217EFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE norma ADD CONSTRAINT FK_3EF6217EF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE beneficiario ADD CONSTRAINT FK_E8D0B617FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE beneficiario ADD CONSTRAINT FK_E8D0B617F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_identificador ADD CONSTRAINT FK_A8960BDFFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_identificador ADD CONSTRAINT FK_A8960BDFF6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mocion ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE contacto ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE expedientes_adjuntos ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE orden_del_dia ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE votacion ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE cargo_persona ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE tipo_mayoria ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE sesion ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE iniciador_expediente ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE area_administrativa ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE domicilio ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE anexo_dictamen ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE personal_legajo ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE proyecto_b_a_e ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE persona ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE dictamen ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE tipo_expediente ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE log_expediente ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE contacto_persona ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE documento ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE anexo_expediente ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE domicilio_persona ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE giro ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE expediente ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE dependencia ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE firmante_dictamen ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE cargo ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE tipo_relacion_persona ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE periodo_legislativo ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE log ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE tipo_proyecto ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE dictamen_o_d ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE comision ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE persona_a_cargo ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE giro_administrativo ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE bloque ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE boletin_asuntos_entrados ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE iniciador ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE parametro ALTER activo DROP NOT NULL');
        $this->addSql('ALTER TABLE voto ALTER activo DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE norma DROP CONSTRAINT FK_3EF6217E3F799E6A');
        $this->addSql('ALTER TABLE palabra_clave_norma DROP CONSTRAINT FK_58F066A97E0CD09E');
        $this->addSql('ALTER TABLE norma DROP CONSTRAINT FK_3EF6217E5E0BFD3B');
        $this->addSql('ALTER TABLE norma DROP CONSTRAINT FK_3EF6217E82F348F1');
        $this->addSql('ALTER TABLE identificador_norma DROP CONSTRAINT FK_29C6DD41BFD0B734');
        $this->addSql('ALTER TABLE descriptor_norma DROP CONSTRAINT FK_9A9BEEF02A13D45');
        $this->addSql('ALTER TABLE norma DROP CONSTRAINT FK_3EF6217E3C66E029');
        $this->addSql('ALTER TABLE anexo_norma DROP CONSTRAINT FK_2440D254E06FC29E');
        $this->addSql('ALTER TABLE palabra_clave_norma DROP CONSTRAINT FK_58F066A9E06FC29E');
        $this->addSql('ALTER TABLE identificador_norma DROP CONSTRAINT FK_29C6DD41E06FC29E');
        $this->addSql('ALTER TABLE descriptor_norma DROP CONSTRAINT FK_9A9BEEF0E06FC29E');
        $this->addSql('ALTER TABLE identificador DROP CONSTRAINT FK_A82558811A0C582F');
        $this->addSql('DROP SEQUENCE anexo_norma_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE consolidacion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_promulgacion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE palabra_clave_norma_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE palabra_clave_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE boletin_oficial_municipal_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rama_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE identificador_norma_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE descriptor_norma_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE identificador_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_ordenanza_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE descriptor_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_boletin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE norma_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE beneficiario_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_identificador_id_seq CASCADE');
        $this->addSql('DROP TABLE anexo_norma');
        $this->addSql('DROP TABLE consolidacion');
        $this->addSql('DROP TABLE tipo_promulgacion');
        $this->addSql('DROP TABLE palabra_clave_norma');
        $this->addSql('DROP TABLE palabra_clave');
        $this->addSql('DROP TABLE boletin_oficial_municipal');
        $this->addSql('DROP TABLE rama');
        $this->addSql('DROP TABLE identificador_norma');
        $this->addSql('DROP TABLE descriptor_norma');
        $this->addSql('DROP TABLE identificador');
        $this->addSql('DROP TABLE tipo_ordenanza');
        $this->addSql('DROP TABLE descriptor');
        $this->addSql('DROP TABLE tipo_boletin');
        $this->addSql('DROP TABLE norma');
        $this->addSql('DROP TABLE beneficiario');
        $this->addSql('DROP TABLE tipo_identificador');
        $this->addSql('ALTER TABLE firmante_dictamen ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE parametro ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE domicilio_persona ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE cargo ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE log ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE contacto ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE contacto_persona ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE area_administrativa ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE giro_administrativo ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE domicilio ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE iniciador ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE iniciador_expediente ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE tipo_relacion_persona ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE persona_a_cargo ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE documento ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE comision ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE giro ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE votacion ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE mocion ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE voto ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE anexo_expediente ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE orden_del_dia ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE dictamen_o_d ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE personal_legajo ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE persona ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE tipo_expediente ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE dependencia ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE cargo_persona ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE periodo_legislativo ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE tipo_proyecto ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE sesion ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE log_expediente ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE tipo_mayoria ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE bloque ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE dictamen ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE expediente ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE anexo_dictamen ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE boletin_asuntos_entrados ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE proyecto_b_a_e ALTER activo SET NOT NULL');
        $this->addSql('ALTER TABLE expedientes_adjuntos ALTER activo SET NOT NULL');
    }
}
