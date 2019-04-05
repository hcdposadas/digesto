<?php

namespace App\Command\Migradores;


use App\Entity\Identificador;
use App\Entity\TipoIdentificador;

class MIdentificador extends Migrador
{
    protected $class = Identificador::class;
    protected $tipos = [];

    protected function init()
    {
        $tis = $this->em->getRepository(TipoIdentificador::class)->findAll();

        foreach ($tis as $t) {
            $this->tipos[mb_strtolower($t->getNombre())] = $t;
        }
    }

    protected function getSQL()
    {
        return 'SELECT * FROM identificadores';
    }

    protected function mapRow($row)
    {
        $i = new Identificador();
        $i->setNombre($row['nombre']);
        $i->setActivo(true);
        $i->setTipoIdentificador($this->tipos[strtolower($row['tipo'])]);

        return $i;
    }
}
