<?php

namespace App\Command\Migradores;




use App\Entity\Norma;
use App\Entity\Rama;
use App\Entity\TipoBoletin;
use App\Entity\TipoPromulgacion;

class MNorma extends Migrador
{
    protected $class = Norma::class;

    protected $tiposBoletin = [];
    protected $tiposPromulgacion = [];
    protected $ramas = [];

    protected function getSQL()
    {
        return 'SELECT * FROM normas';
    }

    protected function init()
    {
        $items = $this->em->getRepository(TipoBoletin::class)->findAll();
        foreach ($items as $item) {
            $this->tiposBoletin[$this->canon($item->getNombre())] = $item;
        }

        $items = $this->em->getRepository(TipoPromulgacion::class)->findAll();
        foreach ($items as $item) {
            $this->tiposPromulgacion[$this->canon($item->getNombre())] = $item;
        }

        $items = $this->em->getRepository(Rama::class)->findAll();
        foreach ($items as $item) {
            $this->ramas[$this->canon($item->getTitulo())] = $item;
        }
    }

    protected function mapRow($row)
    {
        $norma = new Norma();

        $norma->setDecretoPromulgatorio($row['decreto_promulgatorio']);
        $norma->setFechaPromulgacion($this->parseFecha($row['fecha_promulgacion']));
        $norma->setFechaSancion($this->parseFecha($row['fecha_sancion']));

        $numero = intval($row['numero']) ? intval($row['numero']) : 0;
        $norma->setNumero($numero);


        $norma->setObservacion($row['observaciones']);
        $norma->setPaginaBoletin($row['pagina']);
        $norma->setRama($this->ramas[$this->canon($row['rama'])]);
//        $norma->setRama($this->ramas[strtolower($row['rama'])]); vnc
        $norma->setTemaGeneral($row['tema_general']);
        if ($tb = $this->canon($row['tipo_boletin'])) {
            $norma->setTipoBoletin($this->tiposBoletin[$tb]);
        }
        if ($tp = $this->canon($row['tipo_promulgacion'])) {
            $norma->setTipoPromulgacion($this->tiposPromulgacion[$tp]);
        }

        return $norma;
    }

    private function parseFecha($fecha)
    {
        if (!$fecha) {
            print_r('null');
            return null;
        }

        if (strpos($fecha, '-')) {
            [$y, $m, $d] = explode('-', $fecha);
        } elseif (strpos($fecha, '/')) {
            [$d, $m, $y] = explode('/', $fecha);
        } else {
            print_r($fecha);
            return null;
        }

        $fecha = \DateTime::createFromFormat('Y-m-d', sprintf('%d-%02d-%02d', $y, $m, $d));

        if (!$fecha) {
            return null;
        }

        return $fecha;
    }
}
