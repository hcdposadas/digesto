<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Console\Descriptor\TextDescriptor;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NormaRepository")
 * @Vich\Uploadable
 * @Gedmo\Loggable(logEntryClass="Gedmo\Loggable\Entity\LogEntry")
 * @ApiResource(
 *   itemOperations={
 *      "get"={"method"="GET"}
 *   },
 *   collectionOperations={
 *      "get"={"method"="GET"}
 *   },
 *   normalizationContext={"groups"={"norma"}},
 *   denormalizationContext={"groups"={"norma"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *     "palabrasClaveNorma.palabraClave.nombre": "partial",
 *     "descriptoresNorma.descriptor.nombre": "partial",
 *     "identificadoresNorma.identificador.nombre": "partial",
 *     "beneficiarioNormas.beneficiario.nombre": "partial"
 * })
 * @ApiFilter(DateFilter::class, properties={"fechaSancion"})
 * @ApiFilter(OrderFilter::class)
 * @UniqueEntity(
 *     fields={"numero", "rama"},
 *     errorPath="numero",
 *     message="Ya existe la norma para esta Rama"
 * )
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
     * @Groups({"norma"})
     */
    private $fechaSancion;
    /**
     * @ORM\Column(type="string", length=2048)
     * @Groups({"norma"})
     */
    private $temaGeneral;
    /**
     * @ORM\Column(type="integer")
     * @Groups({"norma"})
     * @ApiFilter(SearchFilter::class)
     */
    private $numero;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"norma"})
     */
    private $paginaBoletin;
    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"norma"})
     */
    private $observacion;
    /**
     * @Vich\UploadableField(mapping="textos_definitivos_normas", fileNameProperty="nombreArchivo")
     * @var File
     * @Groups({"norma"})
     */
    private $archivoNorma;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"norma"})
     */
    private $decretoPromulgatorio;
    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"norma"})
     */
    private $fechaPromulgacion;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoPromulgacion")
     * @Groups({"norma"})
     */
    private $tipoPromulgacion;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rama")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"norma"})
     * @ApiFilter(SearchFilter::class)
     */
    private $rama;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rama")
     * @Groups({"norma"})
     */
    private $ramaVigenteNoConsolidada;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoBoletin")
     * @Groups({"norma"})
     */
    private $tipoBoletin;
    /**
     * @ORM\OneToMany(targetEntity="AnexoNorma", mappedBy="norma", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"id" = "ASC", "orden"= "ASC" })
     * @Groups({"norma"})
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
     * @Groups({"norma"})
     */
    private $tipoOrdenanza;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"norma"})
     * @ApiFilter(SearchFilter::class)
     */
    private $numeroAnterior;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BoletinOficialMunicipal", inversedBy="normas")
     * @Groups({"norma"})
     */
    private $boletinOficialMunicipal;
    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"norma"})
     */
    private $texto;

    /**
     * @var bool
     *
     * @ORM\Column(name="vigente_no_consolidada", type="boolean", nullable=true)
     * @Groups({"norma"})
     */
    protected $vigenteNoConsolidada;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"norma"})
     */
    private $nombreArchivo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"norma"})
     */
    private $numeroBoletin;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"norma"})
     */
    private $fechaPublicacionBoletin;

    /**
     * Tabla de cambios
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CambioNorma", mappedBy="norma", cascade={"persist", "remove"}, orphanRemoval=true))
     */
    private $cambiosNormas;

    /**
     * Lista de adhesiones a leyes/decretos
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Adhesion", mappedBy="norma", cascade={"persist", "remove"}, orphanRemoval=true))
     */
    private $adhesiones;

    /**
     * Lista de abrogaciones que sufre esta norma o sus articulos (este lado se abroga, el otro lado queda vigente)
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Abrogacion", mappedBy="norma", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $abrogaciones;

    /**
     * Lista de abrogaciones que produce esta norma (el otro lado se abroga, este lado queda vigente)
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Abrogacion", mappedBy="normaAbrogante", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $abrogadas;

    /**
     * Lista de caducidades que caducan esta norma o sus articulos
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Caducidad", mappedBy="norma", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $caducidades;

    /**
     * Lista de conflictos que tiene esta norma o sus articulos, por los que caduca
     * Esta es la norma o los articulos que caducan (el otro lado sigue vigente)
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ConflictoNormativo", mappedBy="norma", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $conflictosNormativos;

    /**
     * Lista de conflictos que tienen otra normas con esta
     * Esta norma o sus articulos siguen vigentes (el otro lado caduca)
     * @ORM\OneToMany(targetEntity="App\Entity\ConflictoNormativo", mappedBy="conflictoConNorma", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $conflictosConNormas;

    /**
     * Lista de las refundiciones que recibe esta norma
     * Es decir, esta norma o articulo sigue siendo vigente (el otro lado caduca)
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Refundicion", mappedBy="norma", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $refundiciones;

    /**
     * Lista de las refundiciones sobre esta norma
     * Es decir, esta normao o sus articulos caducan por refundicion (el otro lado sigue vigente)
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Refundicion", mappedBy="normaRefundida", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $refundidas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TextoDefinitivo", mappedBy="norma", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $textosDefinitivos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EstadoNorma", mappedBy="norma", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $estadosNormas;

    public function __construct()
    {
        $this->anexos = new ArrayCollection();
        $this->beneficiarioNormas = new ArrayCollection();
        $this->palabrasClaveNorma = new ArrayCollection();
        $this->descriptoresNorma = new ArrayCollection();
        $this->identificadoresNorma = new ArrayCollection();
        $this->cambiosNormas = new ArrayCollection();
        $this->adhesiones = new ArrayCollection();
        $this->abrogaciones = new ArrayCollection();
        $this->abrogadas = new ArrayCollection();
        $this->caducidades = new ArrayCollection();
        $this->conflictosNormativos = new ArrayCollection();
        $this->conflictosConNormas = new ArrayCollection();
        $this->refundiciones = new ArrayCollection();
        $this->refundidas = new ArrayCollection();
        $this->textosDefinitivos = new ArrayCollection();
        $this->estadosNormas = new ArrayCollection();
    }

    public function __toString()
    {
        if ($this->getRama()) {
            return $this->getRama()->getNumeroRomano() . ' - ' . $this->getNumero();
        }
        return '#' . $this->getId();
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

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArchivoNorma()
    {
        return $this->archivoNorma;
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
    public function isVigenteNoConsolidada()
    {
        return $this->vigenteNoConsolidada;
    }

    /**
     * @param bool $vigenteNoConsolidada
     */
    public function setVigenteNoConsolidada(bool $vigenteNoConsolidada): void
    {
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


    /**
     * Get the value of cambiosNormas
     */
    public function getCambiosNormas()
    {
        return $this->cambiosNormas;
    }

    /**
     * Set the value of cambiosNormas
     *
     * @return  self
     */
    public function setCambiosNormas($cambiosNormas)
    {
        $this->cambiosNormas = $cambiosNormas;

        return $this;
    }

    public function addCambiosNorma(CambioNorma $cambioNorma): self
    {
        if (!$this->cambiosNormas->contains($cambioNorma)) {
            $this->cambiosNormas[] = $cambioNorma;
            $cambioNorma->setNorma($this);
        }

        return $this;
    }

    public function removeCambiosNorma(CambioNorma $cambioNorma): self
    {
        if ($this->cambiosNormas->contains($cambioNorma)) {
            $this->cambiosNormas->removeElement($cambioNorma);
            if ($cambioNorma->getNorma() === $this) {
                $cambioNorma->setNorma(null);
            }
        }

        return $this;
    }

    /**
     * @return ollection
     */
    public function getAdhesiones(): Collection
    {
        return $this->adhesiones;
    }

    /**
     * @param Collection $adhesiones
     */
    public function setAdhesiones(Collection $adhesiones): void
    {
        $this->adhesiones = $adhesiones;
    }

    public function addAdhesion(Adhesion $adhesion): self
    {
        if (!$this->adhesiones->contains($adhesion)) {
            $this->adhesiones[] = $adhesion;
            $adhesion->setNorma($this);
        }

        return $this;
    }

    public function removeAdhesion(Adhesion $adhesion): self
    {
        if ($this->adhesiones->contains($adhesion)) {
            $this->adhesiones->removeElement($adhesion);
            if ($adhesion->getNorma() === $this) {
                $adhesion->setNorma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Abrogacion[]
     */
    public function getAbrogaciones(): Collection
    {
        return $this->abrogaciones;
    }

    public function addAbrogacion(Abrogacion $abrogacion): self
    {
        if (!$this->abrogaciones->contains($abrogacion)) {
            $this->abrogaciones[] = $abrogacion;
            $abrogacion->setNorma($this);
        }

        return $this;
    }

    public function removeAbrogacion(Abrogacion $abrogacion): self
    {
        if ($this->abrogaciones->contains($abrogacion)) {
            $this->abrogaciones->removeElement($abrogacion);
            // set the owning side to null (unless already changed)
            if ($abrogacion->getNorma() === $this) {
                $abrogacion->setNorma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Abrogacion[]
     */
    public function getAbrogadas(): Collection
    {
        return $this->abrogadas;
    }

    public function addAbrogada(Abrogacion $abrogada): self
    {
        if (!$this->abrogadas->contains($abrogada)) {
            $this->abrogadas[] = $abrogada;
            $abrogada->setNormaAbrogante($this);
        }

        return $this;
    }

    public function removeAbrogada(Abrogacion $abrogada): self
    {
        if ($this->abrogadas->contains($abrogada)) {
            $this->abrogadas->removeElement($abrogada);
            // set the owning side to null (unless already changed)
            if ($abrogada->getNormaAbrogante() === $this) {
                $abrogada->setNormaAbrogante(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Caducidad[]
     */
    public function getCaducidades(): Collection
    {
        return $this->caducidades;
    }

    public function addCaducidade(Caducidad $caducidade): self
    {
        if (!$this->caducidades->contains($caducidade)) {
            $this->caducidades[] = $caducidade;
            $caducidade->setNorma($this);
        }

        return $this;
    }

    public function removeCaducidade(Caducidad $caducidade): self
    {
        if ($this->caducidades->contains($caducidade)) {
            $this->caducidades->removeElement($caducidade);
            // set the owning side to null (unless already changed)
            if ($caducidade->getNorma() === $this) {
                $caducidade->setNorma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ConflictoNormativo[]
     */
    public function getConflictosNormativos(): Collection
    {
        return $this->conflictosNormativos;
    }

    public function addConflictosNormativo(ConflictoNormativo $conflictosNormativo): self
    {
        if (!$this->conflictosNormativos->contains($conflictosNormativo)) {
            $this->conflictosNormativos[] = $conflictosNormativo;
            $conflictosNormativo->setNorma($this);
        }

        return $this;
    }

    public function removeConflictosNormativo(ConflictoNormativo $conflictosNormativo): self
    {
        if ($this->conflictosNormativos->contains($conflictosNormativo)) {
            $this->conflictosNormativos->removeElement($conflictosNormativo);
            // set the owning side to null (unless already changed)
            if ($conflictosNormativo->getNorma() === $this) {
                $conflictosNormativo->setNorma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ConflictoNormativo[]
     */
    public function getConflictosConNormas(): Collection
    {
        return $this->conflictosConNormas;
    }

    public function addConflictosConNorma(ConflictoNormativo $conflictosConNorma): self
    {
        if (!$this->conflictosConNormas->contains($conflictosConNorma)) {
            $this->conflictosConNormas[] = $conflictosConNorma;
            $conflictosConNorma->setConflictoConNorma($this);
        }

        return $this;
    }

    public function removeConflictosConNorma(ConflictoNormativo $conflictosConNorma): self
    {
        if ($this->conflictosConNormas->contains($conflictosConNorma)) {
            $this->conflictosConNormas->removeElement($conflictosConNorma);
            // set the owning side to null (unless already changed)
            if ($conflictosConNorma->getConflictoConNorma() === $this) {
                $conflictosConNorma->setConflictoConNorma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Refundicion[]
     */
    public function getRefundiciones(): Collection
    {
        return $this->refundiciones;
    }

    public function addRefundicione(Refundicion $refundicione): self
    {
        if (!$this->refundiciones->contains($refundicione)) {
            $this->refundiciones[] = $refundicione;
            $refundicione->setNorma($this);
        }

        return $this;
    }

    public function removeRefundicione(Refundicion $refundicione): self
    {
        if ($this->refundiciones->contains($refundicione)) {
            $this->refundiciones->removeElement($refundicione);
            // set the owning side to null (unless already changed)
            if ($refundicione->getNorma() === $this) {
                $refundicione->setNorma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Refundicion[]
     */
    public function getRefundidas(): Collection
    {
        return $this->refundidas;
    }

    public function addRefundida(Refundicion $refundida): self
    {
        if (!$this->refundidas->contains($refundida)) {
            $this->refundidas[] = $refundida;
            $refundida->setNormaRefundida($this);
        }

        return $this;
    }

    public function removeRefundida(Refundicion $refundida): self
    {
        if ($this->refundidas->contains($refundida)) {
            $this->refundidas->removeElement($refundida);
            // set the owning side to null (unless already changed)
            if ($refundida->getNormaRefundida() === $this) {
                $refundida->setNormaRefundida(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TextoDefinitivo[]
     */
    public function getTextosDefinitivos(): Collection
    {
        return $this->textosDefinitivos;
    }

    public function addTextosDefinitivo(TextoDefinitivo $textosDefinitivo): self
    {
        if (!$this->textosDefinitivos->contains($textosDefinitivo)) {
            $this->textosDefinitivos[] = $textosDefinitivo;
            $textosDefinitivo->setNorma($this);
        }

        return $this;
    }

    public function removeTextosDefinitivo(TextoDefinitivo $textosDefinitivo): self
    {
        if ($this->textosDefinitivos->contains($textosDefinitivo)) {
            $this->textosDefinitivos->removeElement($textosDefinitivo);
            // set the owning side to null (unless already changed)
            if ($textosDefinitivo->getNorma() === $this) {
                $textosDefinitivo->setNorma(null);
            }
        }

        return $this;
    }

    public function setTextoDefinitivoNoConsolidado(TextoDefinitivo $textoDefinitivo): self
    {
        if ($textoDefinitivo->getConsolidacion()->isEnCurso()) {
            $this->addTextosDefinitivo($textoDefinitivo);
        }
        return $this;
    }

    public function getTextoDefinitivoNoConsolidado(): ?TextoDefinitivo
    {
        foreach ($this->getTextosDefinitivos() as $textoDefinitivo) {
            if ($textoDefinitivo->getConsolidacion()->isEnCurso()) {
                return $textoDefinitivo;
            }
        }
        return null;
    }

    public function getTextoDefinitivoConsolidado(): ?TextoDefinitivo
    {
        foreach ($this->getTextosDefinitivos() as $textoDefinitivo) {
            if ($textoDefinitivo->getConsolidacion()->isUltima()) {
                return $textoDefinitivo;
            }
        }
        return null;
    }

    /**
     * @return Collection|EstadoNorma[]
     */
    public function getEstadosNormas(): Collection
    {
        return $this->estadosNormas;
    }

    public function addEstadosNorma(EstadoNorma $estadosNorma): self
    {
        if (!$this->estadosNormas->contains($estadosNorma)) {
            $this->estadosNormas[] = $estadosNorma;
            $estadosNorma->setNorma($this);
        }

        return $this;
    }

    public function removeEstadosNorma(EstadoNorma $estadosNorma): self
    {
        if ($this->estadosNormas->contains($estadosNorma)) {
            $this->estadosNormas->removeElement($estadosNorma);
            // set the owning side to null (unless already changed)
            if ($estadosNorma->getNorma() === $this) {
                $estadosNorma->setNorma(null);
            }
        }

        return $this;
    }

    public function getEstadoNorma(): ?EstadoNorma
    {
        foreach ($this->getEstadosNormas() as $estadoNorma) {
            if ($estadoNorma->getConsolidacion()->isEnCurso()) {
                return $estadoNorma;
            }
        }
        return null;
    }

    public function getEstado(): ?TipoEstadoNorma
    {
        foreach ($this->getEstadosNormas() as $estadoNorma) {
            if ($estadoNorma->getConsolidacion()->isEnCurso()) {
                return $estadoNorma->getEstado();
            }
        }
        return null;
    }

    public function setEstado(TipoEstadoNorma $estado) : self
    {
        foreach ($this->getEstadosNormas() as $estadoNorma) {
            if ($estadoNorma->getConsolidacion()->isEnCurso()) {
                $estadoNorma->setEstado($estado);
                return $this;
            }
        }
        return $this;
    }
}
