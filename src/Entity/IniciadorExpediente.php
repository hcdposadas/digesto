<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * IniciadorExpediente
 *
 * @ORM\Table(name="iniciador_expediente")
 * @ORM\Entity(repositoryClass="App\Repository\IniciadorExpedienteRepository")
 */
class IniciadorExpediente extends BaseClass {
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
	 * @ORM\ManyToOne(targetEntity="Expediente", inversedBy="iniciadores")
	 * @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
	 */
	private $expediente;

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
	 * @ORM\Column(name="autor", type="boolean", options={"default":false})
	 */
	private $autor = false;


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
	 * @return IniciadorExpediente
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
	 * @return IniciadorExpediente
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
	 * @return IniciadorExpediente
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
	 * Set iniciador
	 *
	 * @param Iniciador $iniciador
	 *
	 * @return IniciadorExpediente
	 */
	public function setIniciador( Iniciador $iniciador = null ) {
		$this->iniciador = $iniciador;

		return $this;
	}

	/**
	 * Get iniciador
	 *
	 * @return Iniciador
	 */
	public function getIniciador() {
		return $this->iniciador;
	}

	/**
	 * Set creadoPor
	 *
	 * @param Usuario $creadoPor
	 *
	 * @return IniciadorExpediente
	 */
	public function setCreadoPor( Usuario $creadoPor = null ) {
		$this->creadoPor = $creadoPor;

		return $this;
	}

	/**
	 * Set actualizadoPor
	 *
	 * @param Usuario $actualizadoPor
	 *
	 * @return IniciadorExpediente
	 */
	public function setActualizadoPor( Usuario $actualizadoPor = null ) {
		$this->actualizadoPor = $actualizadoPor;

		return $this;
	}

	/**
	 * Set autor
	 *
	 * @param boolean $autor
	 *
	 * @return IniciadorExpediente
	 */
	public function setAutor( $autor ) {
		$this->autor = $autor;

		return $this;
	}

	/**
	 * Get autor
	 *
	 * @return boolean
	 */
	public function getAutor() {
		return $this->autor;
	}
}
