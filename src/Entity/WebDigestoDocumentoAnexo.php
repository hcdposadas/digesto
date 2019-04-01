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
	 * @Vich\UploadableField(mapping="documentos_anexos_web", fileNameProperty="titulo")
	 * @var File
	 */
	private $archivoDocumentoAnexo;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\WebDigestoDocumento", mappedBy="webDigestoDocumentoAnexo")
	 */
	private $documento;

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

	/**
	 * @return Collection|WebDigestoDocumento[]
	 */
	public function getDocumento(): Collection {
		return $this->documento;
	}

	public function addDocumento( WebDigestoDocumento $documento ): self {
		if ( ! $this->documento->contains( $documento ) ) {
			$this->documento[] = $documento;
			$documento->setWebDigestoDocumentoAnexo( $this );
		}

		return $this;
	}

	public function removeDocumento( WebDigestoDocumento $documento ): self {
		if ( $this->documento->contains( $documento ) ) {
			$this->documento->removeElement( $documento );
			// set the owning side to null (unless already changed)
			if ( $documento->getWebDigestoDocumentoAnexo() === $this ) {
				$documento->setWebDigestoDocumentoAnexo( null );
			}
		}

		return $this;
	}
}
