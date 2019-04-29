<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebDigestoDocumentoRepository")
 * @Vich\Uploadable
 */
class WebDigestoDocumento extends BaseClass {
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
	private $grupo;

	// ... files

	/**
	 * @Vich\UploadableField(mapping="documentos_web", fileNameProperty="nombreDocumento")
	 * @var File
	 */
	private $archivoDocumento;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\WebDigestoDocumentoAnexo", mappedBy="webDigestoDocumento", cascade={"persist"})
	 */
	private $anexos;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreDocumento;

	public function __construct() {
		$this->anexos = new ArrayCollection();
	}


	public function setArchivoDocumento( File $file = null ) {
		$this->archivoDocumento = $file;

		// VERY IMPORTANT:
		// It is required that at least one field changes if you are using Doctrine,
		// otherwise the event listeners won't be called and the file is lost
		if ( $file ) {
			// if 'updatedAt' is not defined in your entity, use another property
			$this->fechaActualizacion = new \DateTime( 'now' );
		}
	}

	public function getArchivoDocumento() {
		return $this->archivoDocumento;
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

	public function getGrupo(): ?string {
		return $this->grupo;
	}

	public function setGrupo( ?string $grupo ): self {
		$this->grupo = $grupo;

		return $this;
	}

	/**
	 * @return Collection|WebDigestoDocumentoAnexo[]
	 */
	public function getAnexos(): Collection {
		return $this->anexos;
	}

	public function addAnexo( WebDigestoDocumentoAnexo $anexo ): self {
		if ( ! $this->anexos->contains( $anexo ) ) {
			$this->anexos[] = $anexo;
			$anexo->setWebDigestoDocumento( $this );
		}

		return $this;
	}

	public function removeAnexo( WebDigestoDocumentoAnexo $anexo ): self {
		if ( $this->anexos->contains( $anexo ) ) {
			$this->anexos->removeElement( $anexo );
			// set the owning side to null (unless already changed)
			if ( $anexo->getWebDigestoDocumento() === $this ) {
				$anexo->setWebDigestoDocumento( null );
			}
		}

		return $this;
	}

	public function getNombreDocumento(): ?string {
		return $this->nombreDocumento;
	}

	public function setNombreDocumento( ?string $nombreDocumento ): self {
		$this->nombreDocumento = $nombreDocumento;

		return $this;
	}
}
