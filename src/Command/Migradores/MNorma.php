<?php

namespace App\Command\Migradores;




use App\Entity\Norma;
use App\Entity\Rama;
use App\Entity\TipoBoletin;
use App\Entity\TipoOrdenanza;
use App\Entity\TipoPromulgacion;

class MNorma extends Migrador
{
    protected $class = Norma::class;

    protected $tiposBoletin = [];
    protected $tiposOrdenanza = [];
    protected $tiposPromulgacion = [];
    protected $ramas = [];

    private $mapRamas = [
        'Comercio y Promoci?n Industrial' => 'Comercio y Promoción Industrial',
        'Cultura y Educaci?n' => 'Cultura y Educación',
        'Deporte, Recreaci?n y Turismo' => 'Deporte, Recreación y Turismo',
        'MERCOSUR e Integraci?n Regional' => 'MERCOSUR e Integración Regional',
        'P?blico Municipal' => 'Público Municipal',
        'Polic?a Municipal' => 'Policía Municipal',
        'Trabajo, Seguridad Social y R?gimen Previsional' => 'Trabajo, Seguridad Social y Régimen Previsional',
        'Transporte y Tr?nsito' => 'Transporte y Tránsito',
        'Vivienda, Planificaci?n Urbana y Obras P?blicas' => 'Vivienda, Planificación Urbana y Obras Públicas',
        'Genero' => 'Género',
    ];

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

        $items = $this->em->getRepository(TipoOrdenanza::class)->findAll();
        foreach ($items as $item) {
            $this->tiposOrdenanza[$this->canon($item->getNombre())] = $item;
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
        $norma->setNumeroAnterior($row['numero_anterior']);


        $rama = $row['rama'];
        if (strtolower($rama) !== 'vigentes no consolidadas') {
            if (array_key_exists($rama, $this->mapRamas)) {
                $rama = $this->mapRamas[$rama];
            }
            $rama = $this->canon($rama);
            $rama = $this->ramas[$rama];
        } else {
            $rama = null;
        }

        $ramaVnc = $row['rama_vnc'];
        if (strtolower($ramaVnc) !== 'vigentes no consolidadas') {
            if (array_key_exists($ramaVnc, $this->mapRamas)) {
                $ramaVnc = $this->mapRamas[$ramaVnc];
            }
            $ramaVnc = $this->canon($ramaVnc);
            $ramaVnc = $this->ramas[$ramaVnc];
        } else {
            $ramaVnc = null;
        }


        $norma->setObservacion($row['observaciones']);
        $norma->setPaginaBoletin($row['pagina']);
        $norma->setRama($rama);
        $norma->setRamaVigenteNoConsolidada($ramaVnc);
        $norma->setTemaGeneral($row['tema_general']);
        if ($tb = $this->canon($row['tipo_boletin'])) {
            $norma->setTipoBoletin($this->tiposBoletin[$tb]);
        }
        if ($to = $this->canon($row['tipo'])) {
            $norma->setTipoOrdenanza($this->tiposOrdenanza[$to]);
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
