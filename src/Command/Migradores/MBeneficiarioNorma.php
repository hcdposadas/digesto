<?php

namespace App\Command\Migradores;


use App\Entity\Beneficiario;
use App\Entity\BeneficiarioNorma;
use App\Entity\Norma;

class MBeneficiarioNorma extends Migrador
{
    protected $class = BeneficiarioNorma::class;

    protected function getSQL()
    {
        return 'SELECT * FROM beneficiarios_normas';
    }

    protected function mapRow($row)
    {
        $in = new BeneficiarioNorma();

        $beneficiarioId = $this->getNewId(MBeneficiario::class, $row['id_beneficiario']);
        $normaId = $this->getNewId(MNorma::class, $row['id_norma']);

        if (!$beneficiarioId) {
            return null;
        }
        if (!$normaId) {
            return null;
        }

        $in->setActivo(true);
        $in->setBeneficiario($this->em->getReference(Beneficiario::class, $beneficiarioId));
        $in->setNorma($this->em->getReference(Norma::class, $normaId));

        return $in;
    }
}
