<?php

namespace App\Command\Migradores;


use App\Entity\Beneficiario;

class MBeneficiario extends Migrador
{
    protected $class = Beneficiario::class;

    protected function getSQL()
    {
        return 'SELECT * FROM beneficiarios';
    }

    protected function mapRow($row)
    {
        $nombre = $row['nombre'];
        $apellido = '';

        if (strpos($nombre, ',')) {
            [$apellido, $nombre] = explode(',', $nombre, 2);
        }

        $apellido = trim($apellido);
        $nombre = trim($nombre);

        $d = new Beneficiario();
        $d->setNombre($nombre);
        $d->setApellido($apellido);
        $d->setActivo(true);

        return $d;
    }
}
