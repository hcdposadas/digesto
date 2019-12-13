<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebDigestoTextoRepository")
 * @Vich\Uploadable
 */
class WebDigestoTexto extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $prologo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resenia;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $metodologiaTrabajo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $renumeracion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $instructivoInformativo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactoFacebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactoInstagram;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactoTwitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactoMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactoTelefono;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactoDireccion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactoHorarioAtencion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $presidenteHCD;

	/**
	 * @Vich\UploadableField(mapping="recursos_web", fileNameProperty="nombreArchivoFotoPresidente")
	 * @var File
	 */
	private $archivoFotoPresidente;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreArchivoFotoPresidente;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $directorDigesto;

	/**
	 * @Vich\UploadableField(mapping="recursos_web", fileNameProperty="nombreArchivoFotoDirector")
	 * @var File
	 */
	private $archivoFotoDirector;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreArchivoFotoDirector;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="slug", type="string", length=255, nullable=true)
	 */
	private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vicePresidentePrimeroHCD;

	/**
	 * @Vich\UploadableField(mapping="recursos_web", fileNameProperty="nombreArchivoFotoVicePresidentePrimero")
	 * @var File
	 */
	private $archivoFotoVicePresidentePrimero;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreArchivoFotoVicePresidentePrimero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vicePresidenteSegundoHCD;

	/**
	 * @Vich\UploadableField(mapping="recursos_web", fileNameProperty="nombreArchivoFotoVicePresidenteSegundo")
	 * @var File
	 */
	private $archivoFotoVicePresidenteSegundo;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreArchivoFotoVicePresidenteSegundo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vicePresidentePrimeroCargo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vicePresidenteSegundoCargo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $directorCargo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $presidenteCargo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrologo(): ?string
    {
        return $this->prologo;
    }

    public function setPrologo(?string $prologo): self
    {
        $this->prologo = $prologo;

        return $this;
    }

    public function getResenia(): ?string
    {
        return $this->resenia;
    }

    public function setResenia(string $resenia): self
    {
        $this->resenia = $resenia;

        return $this;
    }

    public function getMetodologiaTrabajo(): ?string
    {
        return $this->metodologiaTrabajo;
    }

    public function setMetodologiaTrabajo(?string $metodologiaTrabajo): self
    {
        $this->metodologiaTrabajo = $metodologiaTrabajo;

        return $this;
    }

    public function getRenumeracion(): ?string
    {
        return $this->renumeracion;
    }

    public function setRenumeracion(?string $renumeracion): self
    {
        $this->renumeracion = $renumeracion;

        return $this;
    }

    public function getInstructivoInformativo(): ?string
    {
        return $this->instructivoInformativo;
    }

    public function setInstructivoInformativo(?string $instructivoInformativo): self
    {
        $this->instructivoInformativo = $instructivoInformativo;

        return $this;
    }

    public function getContactoFacebook(): ?string
    {
        return $this->contactoFacebook;
    }

    public function setContactoFacebook(?string $contactoFacebook): self
    {
        $this->contactoFacebook = $contactoFacebook;

        return $this;
    }

    public function getContactoInstagram(): ?string
    {
        return $this->contactoInstagram;
    }

    public function setContactoInstagram(?string $contactoInstagram): self
    {
        $this->contactoInstagram = $contactoInstagram;

        return $this;
    }

    public function getContactoTwitter(): ?string
    {
        return $this->contactoTwitter;
    }

    public function setContactoTwitter(?string $contactoTwitter): self
    {
        $this->contactoTwitter = $contactoTwitter;

        return $this;
    }

    public function getContactoMail(): ?string
    {
        return $this->contactoMail;
    }

    public function setContactoMail(?string $contactoMail): self
    {
        $this->contactoMail = $contactoMail;

        return $this;
    }

    public function getContactoTelefono(): ?string
    {
        return $this->contactoTelefono;
    }

    public function setContactoTelefono(?string $contactoTelefono): self
    {
        $this->contactoTelefono = $contactoTelefono;

        return $this;
    }

    public function getContactoDireccion(): ?string
    {
        return $this->contactoDireccion;
    }

    public function setContactoDireccion(?string $contactoDireccion): self
    {
        $this->contactoDireccion = $contactoDireccion;

        return $this;
    }

    public function getContactoHorarioAtencion(): ?string
    {
        return $this->contactoHorarioAtencion;
    }

    public function setContactoHorarioAtencion(?string $contactoHorarioAtencion): self
    {
        $this->contactoHorarioAtencion = $contactoHorarioAtencion;

        return $this;
    }

    public function getPresidenteHCD(): ?string
    {
        return $this->presidenteHCD;
    }

    public function setPresidenteHCD(?string $presidenteHCD): self
    {
        $this->presidenteHCD = $presidenteHCD;

        return $this;
    }

    public function getDirectorDigesto(): ?string
    {
        return $this->directorDigesto;
    }

    public function setDirectorDigesto(?string $directorDigesto): self
    {
        $this->directorDigesto = $directorDigesto;

        return $this;
    }



	/**
	 * @return string
	 */
	public function getSlug(): string {
                                                      		return $this->slug;
                                                      	}

	/**
	 * @param string $slug
	 */
	public function setSlug( string $slug ): void {
                                                      		$this->slug = $slug;
                                                      	}

    public function getVicePresidentePrimeroHCD(): ?string
    {
        return $this->vicePresidentePrimeroHCD;
    }

    public function setVicePresidentePrimeroHCD(?string $vicePresidentePrimeroHCD): self
    {
        $this->vicePresidentePrimeroHCD = $vicePresidentePrimeroHCD;

        return $this;
    }

    public function getVicePresidenteSegundoHCD(): ?string
    {
        return $this->vicePresidenteSegundoHCD;
    }

    public function setVicePresidenteSegundoHCD(?string $vicePresidenteSegundoHCD): self
    {
        $this->vicePresidenteSegundoHCD = $vicePresidenteSegundoHCD;

        return $this;
    }

	/**
	 * @return File
	 */
	public function getArchivoFotoPresidente(): ?File {
                                    		return $this->archivoFotoPresidente;
                                    	}

	/**
	 * @param File $archivoFotoPresidente
	 */
	public function setArchivoFotoPresidente( File $archivoFotoPresidente ): void {
                                    		$this->archivoFotoPresidente = $archivoFotoPresidente;
                                    
                                    		if ($archivoFotoPresidente) {
                                    			// if 'updatedAt' is not defined in your entity, use another property
                                    			$this->fechaActualizacion = new \DateTime('now');
                                    		}
                                    	}

	/**
	 * @return mixed
	 */
	public function getNombreArchivoFotoPresidente() {
                                    		return $this->nombreArchivoFotoPresidente;
                                    	}

	/**
	 * @param mixed $nombreArchivoFotoPresidente
	 */
	public function setNombreArchivoFotoPresidente( $nombreArchivoFotoPresidente ): void {
                                    		$this->nombreArchivoFotoPresidente = $nombreArchivoFotoPresidente;
                                    	}

	/**
	 * @return File
	 */
	public function getArchivoFotoDirector(): ?File {
                                    		return $this->archivoFotoDirector;
                                    	}

	/**
	 * @param File $archivoFotoDirector
	 */
	public function setArchivoFotoDirector( File $archivoFotoDirector ): void {
                                    		$this->archivoFotoDirector = $archivoFotoDirector;
                                    
                                    		if ($archivoFotoDirector) {
                                    			// if 'updatedAt' is not defined in your entity, use another property
                                    			$this->fechaActualizacion = new \DateTime('now');
                                    		}
                                    	}

	/**
	 * @return mixed
	 */
	public function getNombreArchivoFotoDirector() {
                                    		return $this->nombreArchivoFotoDirector;
                                    	}

	/**
	 * @param mixed $nombreArchivoFotoDirector
	 */
	public function setNombreArchivoFotoDirector( $nombreArchivoFotoDirector ): void {
                                    		$this->nombreArchivoFotoDirector = $nombreArchivoFotoDirector;
                                    	}

	/**
	 * @return File
	 */
	public function getArchivoFotoVicePresidentePrimero(): ?File {
                                    		return $this->archivoFotoVicePresidentePrimero;
                                    	}

	/**
	 * @param File $archivoFotoVicePresidentePrimero
	 */
	public function setArchivoFotoVicePresidentePrimero( File $archivoFotoVicePresidentePrimero ): void {
                                    		$this->archivoFotoVicePresidentePrimero = $archivoFotoVicePresidentePrimero;
                                    
                                    		if ($archivoFotoVicePresidentePrimero) {
                                    			// if 'updatedAt' is not defined in your entity, use another property
                                    			$this->fechaActualizacion = new \DateTime('now');
                                    		}
                                    	}

	/**
	 * @return mixed
	 */
	public function getNombreArchivoFotoVicePresidentePrimero() {
                                    		return $this->nombreArchivoFotoVicePresidentePrimero;
                                    	}

	/**
	 * @param mixed $nombreArchivoFotoVicePresidentePrimero
	 */
	public function setNombreArchivoFotoVicePresidentePrimero( $nombreArchivoFotoVicePresidentePrimero ): void {
                                    		$this->nombreArchivoFotoVicePresidentePrimero = $nombreArchivoFotoVicePresidentePrimero;
                                    	}

	/**
	 * @return File
	 */
	public function getArchivoFotoVicePresidenteSegundo(): ?File {
                                    		return $this->archivoFotoVicePresidenteSegundo;
                                    	}

	/**
	 * @param File $archivoFotoVicePresidenteSegundo
	 */
	public function setArchivoFotoVicePresidenteSegundo( File $archivoFotoVicePresidenteSegundo ): void {
                                    
                                    		$this->archivoFotoVicePresidenteSegundo = $archivoFotoVicePresidenteSegundo;
                                    
                                    		// VERY IMPORTANT:
                                    		// It is required that at least one field changes if you are using Doctrine,
                                    		// otherwise the event listeners won't be called and the file is lost
                                    		if ($archivoFotoVicePresidenteSegundo) {
                                    			// if 'updatedAt' is not defined in your entity, use another property
                                    			$this->fechaActualizacion = new \DateTime('now');
                                    		}
                                    	}

	/**
	 * @return mixed
	 */
	public function getNombreArchivoFotoVicePresidenteSegundo() {
                                    		return $this->nombreArchivoFotoVicePresidenteSegundo;
                                    	}

	/**
	 * @param mixed $nombreArchivoFotoVicePresidenteSegundo
	 */
	public function setNombreArchivoFotoVicePresidenteSegundo( $nombreArchivoFotoVicePresidenteSegundo ): void {
                                    		$this->nombreArchivoFotoVicePresidenteSegundo = $nombreArchivoFotoVicePresidenteSegundo;
                                    	}

    public function getVicePresidentePrimeroCargo(): ?string
    {
        return $this->vicePresidentePrimeroCargo;
    }

    public function setVicePresidentePrimeroCargo(?string $vicePresidentePrimeroCargo): self
    {
        $this->vicePresidentePrimeroCargo = $vicePresidentePrimeroCargo;

        return $this;
    }

    public function getVicePresidenteSegundoCargo(): ?string
    {
        return $this->vicePresidenteSegundoCargo;
    }

    public function setVicePresidenteSegundoCargo(?string $vicePresidenteSegundoCargo): self
    {
        $this->vicePresidenteSegundoCargo = $vicePresidenteSegundoCargo;

        return $this;
    }

    public function getDirectorCargo(): ?string
    {
        return $this->directorCargo;
    }

    public function setDirectorCargo(?string $directorCargo): self
    {
        $this->directorCargo = $directorCargo;

        return $this;
    }

    public function getPresidenteCargo(): ?string
    {
        return $this->presidenteCargo;
    }

    public function setPresidenteCargo(?string $presidenteCargo): self
    {
        $this->presidenteCargo = $presidenteCargo;

        return $this;
    }

}
