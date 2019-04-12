<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AnexoRepository")
 * @Vich\Uploadable
 */
class AnexoNorma extends BaseClass {
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
	 * @ORM\Column(type="date", nullable=true)
	 */
	private $fecha;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $archivo;


    /**
	 * @Vich\UploadableField(mapping="anexos", fileNameProperty="archivo")
	 * @var File
	 */
	private $archivoAnexo;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="anexos")
	 */
	private $norma;


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

	public function getId(): ?int {
		return $this->id;
	}

	public function getTitulo(): ?string {
		return $this->titulo;
	}

	public function setTitulo( string $titulo ): self {
		$this->titulo = $titulo;

		return $this;
	}

	public function getFecha(): ?\DateTimeInterface {
		return $this->fecha;
	}

	public function setFecha( ?\DateTimeInterface $fecha ): self {
		$this->fecha = $fecha;

		return $this;
	}

    /**
     * @return string
     */
    public function getArchivo(): ?string
    {
        return $this->archivo;
    }

    /**
     * @param string $archivo
     */
    public function setArchivo(string $archivo): void
    {
        $this->archivo = $archivo;
    }

	public function getNorma(): ?Norma {
		return $this->norma;
	}

	public function setNorma( ?Norma $norma ): self {
		$this->norma = $norma;

		return $this;
	}
}
