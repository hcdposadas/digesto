<?php

namespace App\Command\Migradores;



use App\Entity\TipoBoletin;

class MTipoBoletin extends Migrador
{
    protected $class = TipoBoletin::class;

    protected function getSQL()
    {
        return 'SELECT DISTINCT tipo_boletin FROM normas';
    }

    protected function mapRow($row)
    {
        $nombre = trim($row['tipo_boletin']);

        if (!$nombre) {
            return null;
        }

        $tipoBoletin = new TipoBoletin();
        $tipoBoletin->setNombre($nombre);
        $tipoBoletin->setActivo(true);

        return $tipoBoletin;
    }

    protected function getOldId($row, $entity)
    {
        return $entity->getNombre();
    }
}
