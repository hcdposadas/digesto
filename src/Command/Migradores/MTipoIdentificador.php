<?php

namespace App\Command\Migradores;


use App\Entity\TipoIdentificador;

class MTipoIdentificador extends Migrador
{
    protected $class = TipoIdentificador::class;

    protected $id = 'tipo';

    protected function getSQL()
    {
        return 'SELECT DISTINCT tipo FROM identificadores';
    }

    protected function mapRow($row)
    {
        $ti = new TipoIdentificador();
        $ti->setNombre($row['tipo']);
        $ti->setActivo(true);

        return $ti;
    }

    protected function getOldId($row, $entity)
    {
        return $row['tipo'];
    }
}
