<?php

namespace App\Command\Migradores;


use App\Entity\Descriptor;
use App\Entity\DescriptorNorma;
use App\Entity\Norma;

class MDescriptorNorma extends Migrador
{
    protected $class = DescriptorNorma::class;

    protected function getSQL()
    {
        return 'SELECT * FROM descriptores_normas';
    }

    protected function mapRow($row)
    {
        $in = new DescriptorNorma();

        $descriptorId = $this->getNewId(MDescriptor::class, $row['id_descriptor']);
        $normaId = $this->getNewId(MNorma::class, $row['id_norma']);

        if (!$descriptorId) {
            return null;
        }
        if (!$normaId) {
            return null;
        }

        $in->setActivo(true);
        $in->setDescriptor($this->em->getReference(Descriptor::class, $descriptorId));
        $in->setNorma($this->em->getReference(Norma::class, $normaId));

        return $in;
    }
}
