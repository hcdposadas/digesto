<?php

namespace App\Command\Migradores;


use App\Entity\BoletinOficialMunicipal;

class MBoletinOficialMunicipal extends Migrador
{
    protected $class = BoletinOficialMunicipal::class;

    protected function getSQL()
    {
        return 'SELECT * FROM boletinoficial ORDER BY titulo ASC';
    }

    protected function mapRow($row)
    {
        $boletinOficialMunicipal = new BoletinOficialMunicipal();

        $fecha = \DateTime::createFromFormat('Y-m-d', $row['fecha']);

        $boletinOficialMunicipal->setNumero(intval($row['titulo']));
        $boletinOficialMunicipal->setActivo(true);
        $boletinOficialMunicipal->setFechaPublicacion($fecha);
        $boletinOficialMunicipal->setPaginas(0);

        return $boletinOficialMunicipal;
    }
}
