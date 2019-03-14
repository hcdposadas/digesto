<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BoletinOficialMunicipalRepository")
 * @Vich\Uploadable
 */
class BoletinOficialMunicipal extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaPublicacion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $paginas;


	// ... files

	/**
	 * @Vich\UploadableField(mapping="boletin_oficial_municipal", fileNameProperty="numero")
	 * @var File
	 */
	private $archivoBoletin;


	public function setArchivoBoletin(File $file = null)
	{
		$this->archivoBoletin = $file;

		// VERY IMPORTANT:
		// It is required that at least one field changes if you are using Doctrine,
		// otherwise the event listeners won't be called and the file is lost
		if ($file) {
			// if 'updatedAt' is not defined in your entity, use another property
			$this->fechaActualizacion = new \DateTime('now');
		}
	}

	public function getArchivoBoletin()
	{
		return $this->archivoBoletin;
	}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fechaPublicacion;
    }

    public function setFechaPublicacion(\DateTimeInterface $fechaPublicacion): self
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    public function getPaginas(): ?int
    {
        return $this->paginas;
    }

    public function setPaginas(?int $paginas): self
    {
        $this->paginas = $paginas;

        return $this;
    }
}
