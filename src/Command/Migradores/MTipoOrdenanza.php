<?php

namespace App\Command\Migradores;



use App\Entity\TipoOrdenanza;

class MTipoOrdenanza extends Migrador
{
    protected $class = TipoOrdenanza::class;

    protected function getSQL()
    {
        return 'SELECT DISTINCT tipo FROM normas';
    }

    protected function mapRow($row)
    {
        $nombre = trim($row['tipo']);

        if (!$nombre) {
            return null;
        }

        $tipoOrdenanza = new TipoOrdenanza();
        $tipoOrdenanza->setNombre($nombre);
        $tipoOrdenanza->setActivo(true);

        return $tipoOrdenanza;
    }

    protected function getOldId($row, $entity)
    {
        return $entity->getNombre();
    }
}
