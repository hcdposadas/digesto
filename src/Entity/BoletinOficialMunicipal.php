<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
	 * @Vich\UploadableField(mapping="boletin_oficial_municipal", fileNameProperty="nombreDocumento")
	 * @var File
	 */
	private $archivoBoletin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Norma", mappedBy="boletinOficialMunicipal")
     */
    private $normas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombreDocumento;

	public function __toString(): string {
         		return $this->numero;
         	}

    public function __construct()
    {
        $this->normas = new ArrayCollection();
    }


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

    /**
     * @return Collection|Norma[]
     */
    public function getNormas(): Collection
    {
        return $this->normas;
    }

    public function addNorma(Norma $norma): self
    {
        if (!$this->normas->contains($norma)) {
            $this->normas[] = $norma;
            $norma->setBoletinOficialMunicipal($this);
        }

        return $this;
    }

    public function removeNorma(Norma $norma): self
    {
        if ($this->normas->contains($norma)) {
            $this->normas->removeElement($norma);
            // set the owning side to null (unless already changed)
            if ($norma->getBoletinOficialMunicipal() === $this) {
                $norma->setBoletinOficialMunicipal(null);
            }
        }

        return $this;
    }

    public function getNombreDocumento(): ?string
    {
        return $this->nombreDocumento;
    }

    public function setNombreDocumento(?string $nombreDocumento): self
    {
        $this->nombreDocumento = $nombreDocumento;

        return $this;
    }
}
