<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ExpedienteAdjunto
 *
 * @ORM\Table(name="expedientes_adjuntos")
 * @ORM\Entity()
 * @UniqueEntity(
 *     fields={"expediente"},
 *     errorPath="expediente",
 *     message="Este expediente ya está adjunto"
 * )
 */
class ExpedienteAdjunto extends BaseClass {
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
	 * @ORM\ManyToOne(targetEntity="Expediente", inversedBy="expedientesAdjunto")
	 * @ORM\JoinColumn(name="expediente_id", referencedColumnName="id", nullable=true)
	 */
	private $expediente;


	/**
	 * @var Expediente $adjunto
	 *
	 * @ORM\ManyToOne(targetEntity="Expediente")
	 * @ORM\JoinColumn(name="expediente_adjunto_id", referencedColumnName="id", nullable=true)
	 */
	private $adjunto;


	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set fechaCreacion
	 *
	 * @param \DateTime $fechaCreacion
	 *
	 * @return ExpedienteAdjunto
	 */
	public function setFechaCreacion( $fechaCreacion ) {
		$this->fechaCreacion = $fechaCreacion;

		return $this;
	}

	/**
	 * Set fechaActualizacion
	 *
	 * @param \DateTime $fechaActualizacion
	 *
	 * @return ExpedienteAdjunto
	 */
	public function setFechaActualizacion( $fechaActualizacion ) {
		$this->fechaActualizacion = $fechaActualizacion;

		return $this;
	}

	/**
	 * Set expediente
	 *
	 * @param Expediente $expediente
	 *
	 * @return ExpedienteAdjunto
	 */
	public function setExpediente( Expediente $expediente = null ) {
		$this->expediente = $expediente;

		return $this;
	}

	/**
	 * Get expediente
	 *
	 * @return Expediente
	 */
	public function getExpediente() {
		return $this->expediente;
	}



    /**
     * Set adjunto
     *
     * @param Expediente $adjunto
     *
     * @return ExpedienteAdjunto
     */
    public function setAdjunto(Expediente $adjunto = null)
    {
        $this->adjunto = $adjunto;

        return $this;
    }

    /**
     * Get adjunto
     *
     * @return Expediente
     */
    public function getAdjunto()
    {
        return $this->adjunto;
    }

    /**
     * Set creadoPor
     *
     * @param Usuario $creadoPor
     *
     * @return ExpedienteAdjunto
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
     * @return ExpedienteAdjunto
     */
    public function setActualizadoPor(Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
