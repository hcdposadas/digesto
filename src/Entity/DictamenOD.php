<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * DictamenOD
 *
 * @ORM\Table(name="dictamen_o_d")
 * @ORM\Entity(repositoryClass="App\Repository\DictamenODRepository")
 * @UniqueEntity(
 *     fields={"expediente", "ordenDelDia"},
 *     errorPath="expediente",
 *     message="Este Dictámen ya existe en el OD"
 * )
 */
class DictamenOD extends BaseClass
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
	 * @var Expediente $expediente
	 *
	 * @ORM\ManyToOne(targetEntity="Expediente")
	 * @ORM\JoinColumn(name="expediente_id", referencedColumnName="id", nullable=true)
	 */
	private $expediente;

    /**
     * @var Dictamen $dictamen
     *
     * @ORM\ManyToOne(targetEntity="Dictamen")
     * @ORM\JoinColumn(name="dictamen_id", referencedColumnName="id", nullable=true)
     */
    private $dictamen;

	/**
	 * @var OrdenDelDia $ordenDelDia
	 *
	 * @ORM\ManyToOne(targetEntity="App\Entity\OrdenDelDia", inversedBy="dictamenes")
	 * @ORM\JoinColumn(name="orden_del_dia_id", referencedColumnName="id", nullable=true)
	 */
	private $ordenDelDia;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="extracto", type="text", nullable=true)
	 */
	private $extracto;

	/**
	 * @var $tieneTratamientoPreferencial
	 *
	 * @ORM\Column(name="tiene_tratamiento_preferencial", type="boolean", nullable=true)
	 */
	private $tieneTratamientoPreferencial;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return DictamenOD
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     *
     * @return DictamenOD
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * @return Dictamen
     */
    public function getDictamen()
    {
        return $this->dictamen;
    }

    /**
     * @param Dictamen $dictamen
     */
    public function setDictamen(Dictamen $dictamen)
    {
        $this->dictamen = $dictamen;
    }

    /**
     * Set ordenDelDia
     *
     * @param OrdenDelDia $ordenDelDia
     *
     * @return DictamenOD
     */
    public function setOrdenDelDia(OrdenDelDia $ordenDelDia = null)
    {
        $this->ordenDelDia = $ordenDelDia;

        return $this;
    }

    /**
     * Get ordenDelDia
     *
     * @return OrdenDelDia
     */
    public function getOrdenDelDia()
    {
        return $this->ordenDelDia;
    }

    /**
     * Set creadoPor
     *
     * @param Usuario $creadoPor
     *
     * @return DictamenOD
     */
    public function setCreadoPor(Usuario $creadoPor = null)
    {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    /**
     * Set actualizadoPor
     *
     * @param Usuario $actualizadoPor
     *
     * @return DictamenOD
     */
    public function setActualizadoPor(Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }

    /**
     * Set extracto
     *
     * @param string $extracto
     *
     * @return DictamenOD
     */
    public function setExtracto($extracto)
    {
        $this->extracto = $extracto;

        return $this;
    }

    /**
     * Get extracto
     *
     * @return string
     */
    public function getExtracto()
    {
        return $this->extracto;
    }

    /**
     * Set tieneTratamientoPreferencial
     *
     * @param boolean $tieneTratamientoPreferencial
     *
     * @return DictamenOD
     */
    public function setTieneTratamientoPreferencial($tieneTratamientoPreferencial)
    {
        $this->tieneTratamientoPreferencial = $tieneTratamientoPreferencial;

        return $this;
    }

    /**
     * Get tieneTratamientoPreferencial
     *
     * @return boolean
     */
    public function getTieneTratamientoPreferencial()
    {
        return $this->tieneTratamientoPreferencial;
    }
}
