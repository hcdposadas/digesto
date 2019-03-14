<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * BoletinAsuntoEntrado
 *
 * @ORM\Table(name="boletin_asuntos_entrados")
 * @ORM\Entity(repositoryClass="App\Repository\BoletinAsuntoEntradoRepository")
 */
class BoletinAsuntoEntrado extends BaseClass {
	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var Sesion $sesion
	 *
	 * @ORM\ManyToOne(targetEntity="Sesion", inversedBy="bae")
	 * @ORM\JoinColumn(name="sesion_id", referencedColumnName="id", nullable=true)
	 */
	private $sesion;

	/**
	 * @var ProyectoBAE[]
	 *
	 * @ORM\OneToMany(targetEntity="ProyectoBAE", mappedBy="boletinAsuntoEntrado", cascade={"persist", "remove"})
	 *
	 */
	private $proyectos;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="cerrado", type="boolean")
	 */
	private $cerrado;

	public function __toString() {
	return $this->sesion->__toString();
	}


	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set cerrado
	 *
	 * @param boolean $cerrado
	 *
	 * @return BoletinAsuntoEntrado
	 */
	public function setCerrado( $cerrado ) {
		$this->cerrado = $cerrado;

		return $this;
	}

	/**
	 * Get cerrado
	 *
	 * @return boolean
	 */
	public function getCerrado() {
		return $this->cerrado;
	}

	/**
	 * Set fechaCreacion
	 *
	 * @param \DateTime $fechaCreacion
	 *
	 * @return BoletinAsuntoEntrado
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
	 * @return BoletinAsuntoEntrado
	 */
	public function setFechaActualizacion( $fechaActualizacion ) {
		$this->fechaActualizacion = $fechaActualizacion;

		return $this;
	}

	/**
	 * Set sesion
	 *
	 * @param Sesion $sesion
	 *
	 * @return BoletinAsuntoEntrado
	 */
	public function setSesion( Sesion $sesion = null ) {
		$this->sesion = $sesion;

		return $this;
	}

	/**
	 * Get sesion
	 *
	 * @return Sesion
	 */
	public function getSesion() {
		return $this->sesion;
	}

	/**
	 * Set creadoPor
	 *
	 * @param Usuario $creadoPor
	 *
	 * @return BoletinAsuntoEntrado
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
	 * @return BoletinAsuntoEntrado
	 */
	public function setActualizadoPor( Usuario $actualizadoPor = null ) {
		$this->actualizadoPor = $actualizadoPor;

		return $this;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->proyectos = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add proyecto
	 *
	 * @param ProyectoBAE $proyecto
	 *
	 * @return BoletinAsuntoEntrado
	 */
	public function addProyecto( ProyectoBAE $proyecto ) {
		$proyecto->setBoletinAsuntoEntrado( $this );

		$this->proyectos->add( $proyecto );

		return $this;
	}

	/**
	 * Remove proyecto
	 *
	 * @param ProyectoBAE $proyecto
	 */
	public function removeProyecto( ProyectoBAE $proyecto ) {
		$this->proyectos->removeElement( $proyecto );
	}

	/**
	 * Get proyectos
	 *
	 * @return \Doctrine\Common\Collections\Collection|ProyectoBAE[]
	 */
	public function getProyectos() {
		return $this->proyectos;
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection|ProyectoBAE[]
	 */
	public function getProyectosDeConcejales() {
		return $this->ordenarProyectos(
			$this->proyectos->filter( function ( ProyectoBAE $proyectoBae ) {
				return $proyectoBae->getExpediente()->esProyectoDeConcejal()
				       && ! $proyectoBae->getEsInformeDem();
			} )
		);
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection|ProyectoBAE[]
	 */
	public function getProyectosDeDEM() {
		return $this->ordenarProyectos(
			$this->proyectos->filter( function ( ProyectoBAE $proyectoBae ) {
				return $proyectoBae->getExpediente() && $proyectoBae->getExpediente()->esProyectoDeDEM()
				       && ! $proyectoBae->getEsInformeDem();
			} )
		);
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection|ProyectoBAE[]
	 */
	public function getInformesDeDEM() {
		return $this->ordenarProyectos(
			$this->proyectos->filter( function ( ProyectoBAE $proyectoBae ) {
				return $proyectoBae->getExpediente() && $proyectoBae->getEsInformeDem();
			} )
		);
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection|ProyectoBAE[]
	 */
	public function getProyectosDeDefensor() {
		return $this->ordenarProyectos(
			$this->proyectos->filter( function ( ProyectoBAE $proyectoBae ) {
				return $proyectoBae->getExpediente()->esProyectoDeDefensor() && !$proyectoBae->getEsInformeDem();
			} )
		);
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection|ProyectoBAE[] $proyectos
	 *
	 * @return \Doctrine\Common\Collections\Collection|ProyectoBAE[]
	 */
	private function ordenarProyectos( $proyectos ) {
		$iterator = $proyectos->getIterator();

		$iterator->uasort( function ( ProyectoBAE $a, ProyectoBAE $b ) {
			list( $numeroa, $letraa, $anioa ) = explode( '-', $a->getExpediente()->__toString(), 3 );
			list( $numerob, $letrab, $aniob ) = explode( '-', $b->getExpediente()->__toString(), 3 );


			if ( $anioa < $aniob ) {
				return - 1;
			} elseif ( $anioa > $aniob ) {
				return 1;
			} else {
				if ( $numeroa < $numerob ) {
					return - 1;
				} elseif ( $numeroa > $numerob ) {
					return 1;
				} else {
					return 0;
				}
			}
		} );

		return new ArrayCollection( iterator_to_array( $iterator ) );
	}
}
