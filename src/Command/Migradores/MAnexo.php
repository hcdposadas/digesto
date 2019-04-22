<?php

namespace App\Command\Migradores;


use App\Entity\AnexoNorma;
use App\Entity\Norma;

class MAnexo extends Migrador
{
    protected $class = AnexoNorma::class;

    protected function getSQL()
    {
        return 'SELECT * FROM anexos';
    }

    protected function mapRow($row)
    {
        $anexo = new AnexoNorma();

        $normaId = $this->getNewId(MNorma::class, $row['id_album']);

        if (!$normaId) {
            return null;
        }

        $anexo->setActivo(true);
        $anexo->setTitulo('');
        $anexo->setNorma($this->em->getReference(Norma::class, $normaId));
        $anexo->setArchivo($row['nombre']);
        $anexo->setArchivoAnexo(null);
        $anexo->setOrden($row['orden']);

        return $anexo;
    }
}
