<?php

namespace App\Command\Migradores;


use App\Entity\Rama;

class MRama extends Migrador
{
    protected $class = Rama::class;

    private $map = [
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

    private $numeros = [
        'Administrativo' => 'I',
        'Comercio y Promoción Industrial' => 'II',
        'Cultura y Educación' => 'III',
        'Deporte, Recreación y Turismo' => 'IV',
        'Financiero' => 'V',
        'Medio Ambiente y Recursos Naturales' => 'VI',
        'Medios de Comunicación Social' => 'VII',
        'MERCOSUR e Integración Regional' => 'VIII',
        'Particulares' => 'IX',
        'Policía Municipal' => 'X',
        'Público Municipal' => 'XI',
        'Salud y Calidad de Vida' => 'XII',
        'Servicios Públicos' => 'XIII',
        'Tierras Fiscales' => 'XIV',
        'Trabajo, Seguridad Social y Régimen Previsional' => 'XV',
        'Transporte y Tránsito' => 'XVI',
        'Tributario' => 'XVII',
        'Vivienda, Planificación Urbana y Obras Públicas' => 'XVIII',
        'Género' => 'XIX',
    ];

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
        if (strtolower($titulo) === 'vigentes no consolidadas') {
            return null;
        }

        if (strtolower($titulo) === 'genero') {
            $titulo = 'Género';
        }

        if (array_key_exists($titulo, $this->map)) {
            return null;
        }

        $numero = '-';

        if (array_key_exists($titulo, $this->numeros)) {
            $numero = $this->numeros[$titulo];
        }

        $rama = new Rama();
        $rama->setTitulo($titulo);
        $rama->setNumeroRomano($numero);
        $rama->setActivo(true);

        return $rama;
    }

    protected function getOldId($row, $entity)
    {
        return $entity->getTitulo();
    }
}
