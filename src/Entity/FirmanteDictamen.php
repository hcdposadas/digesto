<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * FirmanteDictamen
 *
 * @ORM\Table(name="firmante_dictamen")
 * @ORM\Entity()
 * @UniqueEntity(
 *     fields={"iniciador", "dictamen"},
 *     errorPath="iniciador",
 *     message="El firmante está duplicado"
 * )
 */
class FirmanteDictamen extends BaseClass {
	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="Dictamen", inversedBy="firmantes")
	 * @ORM\JoinColumn(name="dictamen_id", referencedColumnName="id")
	 */
	private $dictamen;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="Iniciador")
	 * @ORM\JoinColumn(name="iniciador_id", referencedColumnName="id")
	 */
	private $iniciador;


	/**
	 * @var bool
	 *
	 * @ORM\Column(name="presidente", type="boolean", options={"default":false})
	 */
	private $presidente = false;


	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	

    /**
     * Set presidente
     *
     * @param boolean $presidente
     *
     * @return FirmanteDictamen
     */
    public function setPresidente($presidente)
    {
        $this->presidente = $presidente;

        return $this;
    }

    /**
     * Get presidente
     *
     * @return boolean
     */
    public function getPresidente()
    {
        return $this->presidente;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return FirmanteDictamen
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
     * @return FirmanteDictamen
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Set dictamen
     *
     * @param Dictamen $dictamen
     *
     * @return FirmanteDictamen
     */
    public function setDictamen(Dictamen $dictamen = null)
    {
        $this->dictamen = $dictamen;

        return $this;
    }

    /**
     * Get dictamen
     *
     * @return Dictamen
     */
    public function getDictamen()
    {
        return $this->dictamen;
    }

    /**
     * Set iniciador
     *
     * @param Iniciador $iniciador
     *
     * @return FirmanteDictamen
     */
    public function setIniciador(Iniciador $iniciador = null)
    {
        $this->iniciador = $iniciador;

        return $this;
    }

    /**
     * Get iniciador
     *
     * @return Iniciador
     */
    public function getIniciador()
    {
        return $this->iniciador;
    }

    /**
     * Set creadoPor
     *
     * @param Usuario $creadoPor
     *
     * @return FirmanteDictamen
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
     * @return FirmanteDictamen
     */
    public function setActualizadoPor(Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
