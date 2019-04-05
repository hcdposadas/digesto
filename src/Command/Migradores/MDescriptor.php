<?php

namespace App\Command\Migradores;


use App\Entity\Descriptor;

class MDescriptor extends Migrador
{
    protected $class = Descriptor::class;

    protected function getSQL()
    {
        return 'SELECT * FROM descriptores';
    }

    protected function mapRow($row)
    {
        $d = new Descriptor();
        $d->setNombre($row['nombre']);
        $d->setActivo(true);

        return $d;
    }
}
