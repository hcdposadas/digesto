<?php

namespace App\Command\Migradores;


use App\Entity\Identificador;
use App\Entity\IdentificadorNorma;
use App\Entity\Norma;

class MIdentificadorNorma extends Migrador
{
    protected $class = IdentificadorNorma::class;

    protected function getSQL()
    {
        return 'SELECT * FROM identificadores_normas';
    }

    protected function mapRow($row)
    {
        $in = new IdentificadorNorma();

        $identificadorId = $this->getNewId(MIdentificador::class, $row['id_identificador']);
        $normaId = $this->getNewId(MNorma::class, $row['id_norma']);

        if (!$identificadorId) {
//            $this->io->warning('Missing Identificador#'.$row['id_identificador']);
            return null;
        }
        if (!$normaId) {
//            $this->io->warning('Missing Norma#'.$row['id_norma']);
            return null;
        }

        $in->setActivo(true);
        $in->setIdentificador($this->em->getReference(Identificador::class, $identificadorId));
        $in->setNorma($this->em->getReference(Norma::class, $normaId));

        return $in;
    }
}
