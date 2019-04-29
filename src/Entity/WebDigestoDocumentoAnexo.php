<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebDigestoDocumentoAnexoRepository")
 * @Vich\Uploadable
 */
class WebDigestoDocumentoAnexo extends BaseClass {
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

	// ... files

	/**
	 * @Vich\UploadableField(mapping="documentos_anexos_web", fileNameProperty="nombreDocumentoAnexo")
	 * @var File
	 */
	private $archivoDocumentoAnexo;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\WebDigestoDocumento", inversedBy="anexos")
	 */
	private $webDigestoDocumento;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreDocumentoAnexo;

	public function __construct() {
		$this->documento = new ArrayCollection();
	}


	public function setArchivoDocumentoAnexo( File $file = null ) {
		$this->archivoDocumentoAnexo = $file;

		// VERY IMPORTANT:
		// It is required that at least one field changes if you are using Doctrine,
		// otherwise the event listeners won't be called and the file is lost
		if ( $file ) {
			// if 'updatedAt' is not defined in your entity, use another property
			$this->fechaActualizacion = new \DateTime( 'now' );
		}
	}

	public function getArchivoDocumentoAnexo() {
		return $this->archivoDocumentoAnexo;
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

	public function getWebDigestoDocumento(): ?WebDigestoDocumento {
		return $this->webDigestoDocumento;
	}

	public function setWebDigestoDocumento( ?WebDigestoDocumento $webDigestoDocumento ): self {
		$this->webDigestoDocumento = $webDigestoDocumento;

		return $this;
	}

	public function getNombreDocumentoAnexo(): ?string {
		return $this->nombreDocumentoAnexo;
	}

	public function setNombreDocumentoAnexo( ?string $nombreDocumentoAnexo ): self {
		$this->nombreDocumentoAnexo = $nombreDocumentoAnexo;

		return $this;
	}
}
