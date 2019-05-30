<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NormaRepository")
 * @Vich\Uploadable
 * @Gedmo\Loggable(logEntryClass="Gedmo\Loggable\Entity\LogEntry")
 */
class Norma extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaSancion;

    /**
     * @ORM\Column(type="string", length=2048)
     */
    private $temaGeneral;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $paginaBoletin;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observacion;

    /**
     * @Vich\UploadableField(mapping="textos_definitivos_normas", fileNameProperty="nombreArchivo")
     * @var File
     */
    private $archivoNorma;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $decretoPromulgatorio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaPromulgacion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoPromulgacion")
     */
    private $tipoPromulgacion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rama")
     * @ORM\JoinColumn(nullable=true)
     */
    private $rama;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rama")
     */
    private $ramaVigenteNoConsolidada;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoBoletin")
     */
    private $tipoBoletin;

    /**
     * @ORM\OneToMany(targetEntity="AnexoNorma", mappedBy="norma", cascade={"persist"})
     * @ORM\OrderBy({"id" = "ASC", "orden"= "ASC" })
     */
    private $anexos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BeneficiarioNorma", mappedBy="norma", orphanRemoval=true, cascade={"persist"})
     */
    private $beneficiarioNormas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PalabraClaveNorma", mappedBy="norma", orphanRemoval=true, cascade={"persist"})
     */
    private $palabrasClaveNorma;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DescriptorNorma", mappedBy="norma", orphanRemoval=true, cascade={"persist"})
     */
    private $descriptoresNorma;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IdentificadorNorma", mappedBy="norma", orphanRemoval=true, cascade={"persist"})
     */
    private $identificadoresNorma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoOrdenanza")
     */
    private $tipoOrdenanza;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroAnterior;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BoletinOficialMunicipal", inversedBy="normas")
     */
    private $boletinOficialMunicipal;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="text", nullable=true)
     */
    private $texto;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="vigente_no_consolidada", type="boolean", nullable=true)
	 */
	protected $vigenteNoConsolidada;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombreArchivo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroBoletin;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaPublicacionBoletin;

    public function __construct()
    {
        $this->anexos = new ArrayCollection();
        $this->beneficiarioNormas = new ArrayCollection();
        $this->palabrasClaveNorma = new ArrayCollection();
        $this->descriptoresNorma = new ArrayCollection();
        $this->identificadoresNorma = new ArrayCollection();
    }


    public function setArchivoNorma(File $file = null)
    {
        $this->archivoNorma = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->fechaActualizacion = new \DateTime('now');
        }
    }

    public function getArchivoNorma()
    {
        return $this->archivoNorma;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaSancion(): ?\DateTimeInterface
    {
        return $this->fechaSancion;
    }

    public function setFechaSancion(?\DateTimeInterface $fechaSancion): self
    {
        $this->fechaSancion = $fechaSancion;

        return $this;
    }

    public function getTemaGeneral(): ?string
    {
        return $this->temaGeneral;
    }

    public function setTemaGeneral(string $temaGeneral): self
    {
        $this->temaGeneral = $temaGeneral;

        return $this;
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

    public function getPaginaBoletin(): ?int
    {
        return $this->paginaBoletin;
    }

    public function setPaginaBoletin(?int $paginaBoletin): self
    {
        $this->paginaBoletin = $paginaBoletin;

        return $this;
    }

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }

    public function getDecretoPromulgatorio(): ?string
    {
        return $this->decretoPromulgatorio;
    }

    public function setDecretoPromulgatorio(?string $decretoPromulgatorio): self
    {
        $this->decretoPromulgatorio = $decretoPromulgatorio;

        return $this;
    }

    public function getFechaPromulgacion(): ?\DateTimeInterface
    {
        return $this->fechaPromulgacion;
    }

    public function setFechaPromulgacion(?\DateTimeInterface $fechaPromulgacion): self
    {
        $this->fechaPromulgacion = $fechaPromulgacion;

        return $this;
    }

    public function getTipoPromulgacion(): ?TipoPromulgacion
    {
        return $this->tipoPromulgacion;
    }

    public function setTipoPromulgacion(?TipoPromulgacion $tipoPromulgacion): self
    {
        $this->tipoPromulgacion = $tipoPromulgacion;

        return $this;
    }

    public function getRama(): ?Rama
    {
        return $this->rama;
    }

    public function setRama(?Rama $rama): self
    {
        $this->rama = $rama;

        return $this;
    }

    public function getRamaVigenteNoConsolidada(): ?Rama
    {
        return $this->ramaVigenteNoConsolidada;
    }

    public function setRamaVigenteNoConsolidada(?Rama $ramaVigenteNoConsolidada): self
    {
        $this->ramaVigenteNoConsolidada = $ramaVigenteNoConsolidada;

        return $this;
    }

    public function getTipoBoletin(): ?TipoBoletin
    {
        return $this->tipoBoletin;
    }

    public function setTipoBoletin(?TipoBoletin $tipoBoletin): self
    {
        $this->tipoBoletin = $tipoBoletin;

        return $this;
    }

    /**
     * @return Collection|AnexoNorma[]
     */
    public function getAnexos(): Collection
    {
        return $this->anexos;
    }

    public function addAnexo(AnexoNorma $anexo): self
    {
        if (!$this->anexos->contains($anexo)) {
            $this->anexos[] = $anexo;
            $anexo->setNorma($this);
        }

        return $this;
    }

    public function removeAnexo(AnexoNorma $anexo): self
    {
        if ($this->anexos->contains($anexo)) {
            $this->anexos->removeElement($anexo);
            // set the owning side to null (unless already changed)
            if ($anexo->getNorma() === $this) {
                $anexo->setNorma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BeneficiarioNorma[]
     */
    public function getBeneficiarioNormas(): Collection
    {
        return $this->beneficiarioNormas;
    }

    public function addBeneficiarioNorma(BeneficiarioNorma $beneficiarioNorma): self
    {
        if (!$this->beneficiarioNormas->contains($beneficiarioNorma)) {
            $this->beneficiarioNormas[] = $beneficiarioNorma;
            $beneficiarioNorma->setNorma($this);
        }

        return $this;
    }

    public function removeBeneficiarioNorma(BeneficiarioNorma $beneficiarioNorma): self
    {
        if ($this->beneficiarioNormas->contains($beneficiarioNorma)) {
            $this->beneficiarioNormas->removeElement($beneficiarioNorma);
            // set the owning side to null (unless already changed)
            if ($beneficiarioNorma->getNorma() === $this) {
                $beneficiarioNorma->setNorma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PalabraClaveNorma[]
     */
    public function getPalabrasClaveNorma(): Collection
    {
        return $this->palabrasClaveNorma;
    }

    public function addPalabrasClaveNorma(PalabraClaveNorma $palabraClaveNorma): self
    {
        if (!$this->palabrasClaveNorma->contains($palabraClaveNorma)) {
            $this->palabrasClaveNorma[] = $palabraClaveNorma;
            $palabraClaveNorma->setNorma($this);
        }

        return $this;
    }

    public function removePalabrasClaveNorma(PalabraClaveNorma $palabraClaveNorma): self
    {
        if ($this->palabrasClaveNorma->contains($palabraClaveNorma)) {
            $this->palabrasClaveNorma->removeElement($palabraClaveNorma);
            // set the owning side to null (unless already changed)
            if ($palabraClaveNorma->getNorma() === $this) {
                $palabraClaveNorma->setNorma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IdentificadorNorma[]
     */
    public function getIdentificadoresNorma(): Collection
    {
        return $this->identificadoresNorma;
    }

    public function addIdentificadoresNorma(IdentificadorNorma $identificadorNorma): self
    {
        if (!$this->identificadoresNorma->contains($identificadorNorma)) {
            $this->identificadoresNorma[] = $identificadorNorma;
            $identificadorNorma->setNorma($this);
        }

        return $this;
    }

    public function removeIdentificadoresNorma(IdentificadorNorma $identificadorNorma): self
    {
        if ($this->identificadoresNorma->contains($identificadorNorma)) {
            $this->identificadoresNorma->removeElement($identificadorNorma);
            // set the owning side to null (unless already changed)
            if ($identificadorNorma->getNorma() === $this) {
                $identificadorNorma->setNorma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DescriptorNorma[]
     */
    public function getDescriptoresNorma(): Collection
    {
        return $this->descriptoresNorma;
    }

    public function addDescriptoresNorma(DescriptorNorma $descriptorNorma): self
    {
        if (!$this->descriptoresNorma->contains($descriptorNorma)) {
            $this->descriptoresNorma[] = $descriptorNorma;
            $descriptorNorma->setNorma($this);
        }

        return $this;
    }

    public function removeDescriptoresNorma(DescriptorNorma $descriptorNorma): self
    {
        if ($this->descriptoresNorma->contains($descriptorNorma)) {
            $this->descriptoresNorma->removeElement($descriptorNorma);
            // set the owning side to null (unless already changed)
            if ($descriptorNorma->getNorma() === $this) {
                $descriptorNorma->setNorma(null);
            }
        }

        return $this;
    }

    public function getTipoOrdenanza(): ?TipoOrdenanza
    {
        return $this->tipoOrdenanza;
    }

    public function setTipoOrdenanza(?TipoOrdenanza $tipoOrdenanza): self
    {
        $this->tipoOrdenanza = $tipoOrdenanza;

        return $this;
    }

    public function getNumeroAnterior(): ?int
    {
        return $this->numeroAnterior;
    }

    public function setNumeroAnterior(?int $numeroAnterior): self
    {
        $this->numeroAnterior = $numeroAnterior;

        return $this;
    }

    public function getBoletinOficialMunicipal(): ?BoletinOficialMunicipal
    {
        return $this->boletinOficialMunicipal;
    }

    public function setBoletinOficialMunicipal(?BoletinOficialMunicipal $boletinOficialMunicipal): self
    {
        $this->boletinOficialMunicipal = $boletinOficialMunicipal;

        return $this;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(?string $texto): self
    {
        $this->texto = $texto;

        return $this;
    }

	/**
	 * @return bool
	 */
	public function isVigenteNoConsolidada() {
                           		return $this->vigenteNoConsolidada;
                           	}

	/**
	 * @param bool $vigenteNoConsolidada
	 */
	public function setVigenteNoConsolidada( bool $vigenteNoConsolidada ): void {
                           		$this->vigenteNoConsolidada = $vigenteNoConsolidada;
                           	}

    public function getNombreArchivo(): ?string
    {
        return $this->nombreArchivo;
    }

    public function setNombreArchivo(?string $nombreArchivo): self
    {
        $this->nombreArchivo = $nombreArchivo;

        return $this;
    }

    public function getNumeroBoletin(): ?int
    {
        return $this->numeroBoletin;
    }

    public function setNumeroBoletin(?int $numeroBoletin): self
    {
        $this->numeroBoletin = $numeroBoletin;

        return $this;
    }

    public function getFechaPublicacionBoletin(): ?\DateTimeInterface
    {
        return $this->fechaPublicacionBoletin;
    }

    public function setFechaPublicacionBoletin(?\DateTimeInterface $fechaPublicacionBoletin): self
    {
        $this->fechaPublicacionBoletin = $fechaPublicacionBoletin;

        return $this;
    }


}
