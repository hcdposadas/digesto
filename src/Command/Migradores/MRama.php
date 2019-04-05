<?php

namespace App\Command\Migradores;


use App\Entity\Rama;

class MRama extends Migrador
{
    protected $class = Rama::class;

    protected function getSQL()
    {
        return 'SELECT DISTINCT rama FROM normas';
    }

    protected function mapRow($row)
    {
        $titulo = trim($row['rama']);

        if (!$titulo) {
            return null;
        }

        $rama = new Rama();
        $rama->setTitulo($titulo);
        $rama->setNumeroRomano('-');
        $rama->setActivo(true);

        return $rama;
    }

    protected function getOldId($row, $entity)
    {
        return $entity->getTitulo();
    }
}
