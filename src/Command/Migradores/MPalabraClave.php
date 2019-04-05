<?php

namespace App\Command\Migradores;



use App\Entity\PalabraClave;

class MPalabraClave extends Migrador
{
    protected $class = PalabraClave::class;

    protected function getSQL()
    {
        return 'SELECT * FROM palabras_claves';
    }

    protected function mapRow($row)
    {
        $palabraClave = new PalabraClave();
        $palabraClave->setNombre($row['nombre']);
        $palabraClave->setActivo(true);

        return $palabraClave;
    }
}
