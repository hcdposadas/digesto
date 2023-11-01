<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
/**
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="App\Repository\CambioAnexoRepository")
 */
class CambioAnexo extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Consolidacion", inversedBy="cambiosAnexos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consolidacion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="cambiosAnexos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $anexo;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion = '';

   	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $titulo;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreArchivoCambioAnexo;

	/**
	 * @Vich\UploadableField(mapping="cambios_anexo", fileNameProperty="nombreArchivoCambioAnexo")
	 * @var File
	 */
	private $archivoCambioAnexo;

    public function getArchivoCambioAnexo()
    {
        return $this->archivoCambioAnexo;
    }

    public function setArchivoCambioAnexo(File $file = null)
    {
        $this->archivoCambioAnexo= $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->fechaActualizacion = new \DateTime('now');
        }
    }

    public function getNombreArchivoCambioAnexo(): ?string
    {
        return $this->nombreArchivoCambioAnexo;
    }

    public function setNombreArchivoCambioAnexo(?string $nombreArchivoCambioAnexo): self
    {
        $this->nombreArchivoCambioAnexo = $nombreArchivoCambioAnexo;

        return $this;
    }

    public function setTitulo($titulo)
    {
        $this->titulo=$titulo;
		return $this;
    }

	public function getTitulo()
    {
        return $this->titulo;
    }

    public function __construct()
    {
        $this->fecha = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNorma(): ?Norma
    {
        return $this->norma;
    }

    public function setNorma(?Norma $norma): self
    {
        $this->norma = $norma;

        return $this;
    }

    public function getAnexo(): ?string
    {
        return $this->anexo;
    }

    public function setAnexo(string $anexo): self
    {
        $this->anexo = $anexo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConsolidacion()
    {
        return $this->consolidacion;
    }

    /**
     * @param mixed $consolidacion
     */
    public function setConsolidacion($consolidacion): void
    {
        $this->consolidacion = $consolidacion;
    }

    /**
     * @return \DateTime
     */
    public function getFecha(): \DateTime
    {
        return $this->fecha;
    }

    /**
     * @param \DateTime $fecha
     */
    public function setFecha(\DateTime $fecha): void
    {
        $this->fecha = $fecha;
    }
}
