<?php

namespace App\Command\Migradores;



use App\Entity\TipoPromulgacion;

class MTipoPromulgacion extends Migrador
{
    protected $class = TipoPromulgacion::class;

    protected function getSQL()
    {
        return 'SELECT DISTINCT tipo_promulgacion FROM normas';
    }

    protected function mapRow($row)
    {
        $nombre = trim($row['tipo_promulgacion']);

        if (!$nombre) {
            return null;
        }

        $tipoPromulgacion = new TipoPromulgacion();
        $tipoPromulgacion->setNombre($nombre);
        $tipoPromulgacion->setActivo(true);

        return $tipoPromulgacion;
    }

    protected function getOldId($row, $entity)
    {
        return $entity->getNombre();
    }
}
