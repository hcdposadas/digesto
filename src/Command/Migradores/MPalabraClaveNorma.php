<?php

namespace App\Command\Migradores;


use App\Entity\Norma;
use App\Entity\PalabraClave;
use App\Entity\PalabraClaveNorma;

class MPalabraClaveNorma extends Migrador
{
    protected $class = PalabraClaveNorma::class;

    protected function getSQL()
    {
        return 'SELECT * FROM palabras_claves_normas';
    }

    protected function mapRow($row)
    {
        $in = new PalabraClaveNorma();

        $palabraClaveId = $this->getNewId(MPalabraClave::class, $row['id_palabra_clave']);
        $normaId = $this->getNewId(MNorma::class, $row['id_norma']);

        if (!$palabraClaveId) {
            return null;
        }
        if (!$normaId) {
            return null;
        }

        $in->setActivo(true);
        $in->setPalabraClave($this->em->getReference(PalabraClave::class, $palabraClaveId));
        $in->setNorma($this->em->getReference(Norma::class, $normaId));

        return $in;
    }
}
