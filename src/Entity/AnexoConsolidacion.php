<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnexoConsolidacionRepository")
 * @Vich\Uploadable
 */
class AnexoConsolidacion extends BaseClass {

    public const ANEXO_A = 1;
    public const ANEXO_B = 2;
    public const ANEXO_C = 3;
    public const ANEXO_D = 4;
    public const ANEXO_E = 5;
    public const ANEXO_F = 6;
    public const ANEXO_G = 7;
    public const ANEXO_H = 8;

    /**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $titulo;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $descripcion;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Consolidacion", inversedBy="anexoConsolidacions")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $consolidacion;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreArchivo;

	/**
	 * @Vich\UploadableField(mapping="anexos_consolidacion", fileNameProperty="nombreArchivo")
	 * @var File
	 */
	private $archivoAnexo;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	private $orden;

	public function getId(): ?int {
		return $this->id;
	}

	public function setArchivoAnexo( File $file = null ) {
		$this->archivoAnexo = $file;

		// VERY IMPORTANT:
		// It is required that at least one field changes if you are using Doctrine,
		// otherwise the event listeners won't be called and the file is lost
		if ( $file ) {
			// if 'updatedAt' is not defined in your entity, use another property
			$this->fechaActualizacion = new \DateTime( 'now' );
		}
	}

	public function getArchivoAnexo() {
		return $this->archivoAnexo;
	}

	public function getTitulo(): ?string {
		return $this->titulo;
	}

	public function setTitulo( string $titulo ): self {
		$this->titulo = $titulo;

		return $this;
	}

	public function getDescripcion(): ?string {
		return $this->descripcion;
	}

	public function setDescripcion( ?string $descripcion ): self {
		$this->descripcion = $descripcion;

		return $this;
	}

	public function getConsolidacion(): ?Consolidacion {
		return $this->consolidacion;
	}

	public function setConsolidacion( ?Consolidacion $consolidacion ): self {
		$this->consolidacion = $consolidacion;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getNombreArchivo() {
		return $this->nombreArchivo;
	}

	/**
	 * @param mixed $nombreArchivo
	 */
	public function setNombreArchivo( $nombreArchivo ): void {
		$this->nombreArchivo = $nombreArchivo;
	}

	public function getOrden(): ?int {
		return $this->orden;
	}

	public function setOrden( ?int $orden ): self {
		$this->orden = $orden;

		return $this;
	}
}
