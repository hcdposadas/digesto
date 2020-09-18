<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsolidacionRepository")
 * @Vich\Uploadable
 */
class Consolidacion extends BaseClass {
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $anio;

	/**
	 * @ORM\Column(type="date")
	 */
	private $fecha;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $titulo;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\NormaConsolidacion", mappedBy="consolidacion", orphanRemoval=true)
	 */
	private $normaConsolidacions;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $url;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\AnexoConsolidacion", mappedBy="consolidacion", orphanRemoval=true)
	 * @ORM\OrderBy({"orden" = "ASC"})
	 */
	private $anexoConsolidacions;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreArchivoProyecto;

	/**
	 * @Vich\UploadableField(mapping="consolidaciones", fileNameProperty="nombreArchivoProyecto")
	 * @var File
	 */
	private $archivoProyecto;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Caducidad", mappedBy="consolidacion", orphanRemoval=true)
     */
	private $caducidades;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Abrogacion", mappedBy="consolidacion", orphanRemoval=true)
     */
    private $abrogaciones;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Refundicion", mappedBy="consolidacion", orphanRemoval=true)
     */
    private $refundidas;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $enCurso = false;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $ultima = false;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $visible = false;

    /**
	 * @return mixed
	 */
	public function getNombreArchivoProyecto() {
		return $this->nombreArchivoProyecto;
	}

	/**
	 * @param mixed $nombreArchivoProyecto
	 */
	public function setNombreArchivoProyecto( $nombreArchivoProyecto ): void {
		$this->nombreArchivoProyecto = $nombreArchivoProyecto;
	}

	public function setArchivoProyecto( File $file = null ) {
		$this->archivoProyecto = $file;

		// VERY IMPORTANT:
		// It is required that at least one field changes if you are using Doctrine,
		// otherwise the event listeners won't be called and the file is lost
		if ( $file ) {
			// if 'updatedAt' is not defined in your entity, use another property
			$this->fechaActualizacion = new \DateTime( 'now' );
		}
	}

	public function getArchivoProyecto() {
		return $this->archivoProyecto;
	}

	public function __toString(): string {
		return $this->titulo;
	}

	public function __construct() {
		$this->normaConsolidacions = new ArrayCollection();
		$this->anexoConsolidacions = new ArrayCollection();
		$this->caducidades = new ArrayCollection();
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getAnio(): ?int {
		return $this->anio;
	}

	public function setAnio( int $anio ): self {
		$this->anio = $anio;

		return $this;
	}

	public function getFecha(): ?\DateTimeInterface {
		return $this->fecha;
	}

	public function setFecha( \DateTimeInterface $fecha ): self {
		$this->fecha = $fecha;

		return $this;
	}

	public function getTitulo(): ?string {
		return $this->titulo;
	}

	public function setTitulo( ?string $titulo ): self {
		$this->titulo = $titulo;

		return $this;
	}

	/**
	 * @return Collection|NormaConsolidacion[]
	 */
	public function getNormaConsolidacions(): Collection {
		return $this->normaConsolidacions;
	}

	public function addNormaConsolidacion( NormaConsolidacion $normaConsolidacion ): self {
		if ( ! $this->normaConsolidacions->contains( $normaConsolidacion ) ) {
			$this->normaConsolidacions[] = $normaConsolidacion;
			$normaConsolidacion->setConsolidacion( $this );
		}

		return $this;
	}

	public function removeNormaConsolidacion( NormaConsolidacion $normaConsolidacion ): self {
		if ( $this->normaConsolidacions->contains( $normaConsolidacion ) ) {
			$this->normaConsolidacions->removeElement( $normaConsolidacion );
			// set the owning side to null (unless already changed)
			if ( $normaConsolidacion->getConsolidacion() === $this ) {
				$normaConsolidacion->setConsolidacion( null );
			}
		}

		return $this;
	}

	public function getUrl(): ?string {
		return $this->url;
	}

	public function setUrl( ?string $url ): self {
		$this->url = $url;

		return $this;
	}

	/**
	 * @return Collection|AnexoConsolidacion[]
	 */
	public function getAnexoConsolidacions(): Collection {
		return $this->anexoConsolidacions;
	}

	public function addAnexoConsolidacion( AnexoConsolidacion $anexoConsolidacion ): self {
		if ( ! $this->anexoConsolidacions->contains( $anexoConsolidacion ) ) {
			$this->anexoConsolidacions[] = $anexoConsolidacion;
			$anexoConsolidacion->setConsolidacion( $this );
		}

		return $this;
	}

	public function removeAnexoConsolidacion( AnexoConsolidacion $anexoConsolidacion ): self {
		if ( $this->anexoConsolidacions->contains( $anexoConsolidacion ) ) {
			$this->anexoConsolidacions->removeElement( $anexoConsolidacion );
			// set the owning side to null (unless already changed)
			if ( $anexoConsolidacion->getConsolidacion() === $this ) {
				$anexoConsolidacion->setConsolidacion( null );
			}
		}

		return $this;
	}

    /**
     * @return bool
     */
    public function isEnCurso(): bool
    {
        return $this->enCurso;
    }

    /**
     * @param bool $enCurso
     */
    public function setEnCurso(bool $enCurso): void
    {
        $this->enCurso = $enCurso;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->visible;
    }

    /**
     * @param bool $visible
     */
    public function setVisible(bool $visible): void
    {
        $this->visible = $visible;
    }

    /**
     * @return bool
     */
    public function isUltima(): bool
    {
        return $this->ultima;
    }

    /**
     * @param bool $ultima
     */
    public function setUltima(bool $ultima): void
    {
        $this->ultima = $ultima;
    }

    /**
     * @return Caducidad[]
     */
    public function getCaducidades(): Collection
    {
        return $this->caducidades;
    }

    /**
     * @param Caducidad[] $caducidades
     */
    public function setCaducidades(Collection $caducidades): void
    {
        $this->caducidades = $caducidades;
    }

    /**
     * @return Abrogacion[]
     */
    public function getAbrogaciones(): Collection
    {
        return $this->abrogaciones;
    }

    /**
     * @param Abrogacion[] $abrogaciones
     */
    public function setAbrogaciones($abrogaciones): void
    {
        $this->abrogaciones = $abrogaciones;
    }

    /**
     * @return Refundicion[]
     */
    public function getRefundidas(): Collection
    {
        return $this->refundidas;
    }

    /**
     * @param Refundicion[] $refundidas
     */
    public function setRefundidas($refundidas): void
    {
        $this->refundidas = $refundidas;
    }


    /**
     * @return array
     */
    public function getAnexoA(): Collection
    {
        return new ArrayCollection();
    }

    /**
     * @return array
     */
    public function getAnexoB(): Collection
    {
        return new ArrayCollection();
    }

    /**
     * @return Caducidad[]
     */
    public function getAnexoC(): Collection
    {
        return $this->getCaducidades();
    }

    /**
     * @return Abrogacion[]
     */
    public function getAnexoD(): Collection
    {
        return $this->getAbrogaciones();
    }

    /**
     * Listado de Ordenanzas que fueron expresamente abrogadas por otras Ordenanzas
     * @return Abrogacion[]
     */
    public function getAnexoE(): Collection
    {
        return $this->getAbrogaciones();
    }

    /**
     * @return Refundicion[]
     */
    public function getAnexoF(): Collection
    {
        return $this->getRefundidas();
    }

    /**
     * @return array
     */
    public function getAnexoG(): Collection
    {
        return new ArrayCollection();
    }

    /**
     * @return array
     */
    public function getAnexoH(): Collection
    {
        return new ArrayCollection();
    }
}
