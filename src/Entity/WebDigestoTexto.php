<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebDigestoTextoRepository")
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
    private $remuneracion;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $directorDigesto;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="slug", type="string", length=255, nullable=true)
	 */
	private $slug;

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

    public function getRemuneracion(): ?string
    {
        return $this->remuneracion;
    }

    public function setRemuneracion(?string $remuneracion): self
    {
        $this->remuneracion = $remuneracion;

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
}
