<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="App\Repository\ArticuloSuprimidoRepository")
 */
class ArticuloSuprimido extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Consolidacion", inversedBy="articulosSuprimidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consolidacion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="articulosSuprimidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $articulo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion = '';

   	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $titulo;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreArchivoArticuloSuprimido;

	/**
	 * @Vich\UploadableField(mapping="articulos_suprimido", fileNameProperty="nombreArchivoArticuloSuprimido")
	 * @var File
	 */
	private $archivoArticuloSuprimido;

    public function getArchivoArticuloSuprimido()
    {
        return $this->archivoArticuloSuprimido;
    }

    public function setArchivoArticuloSuprimido(File $file = null)
    {
        $this->archivoArticuloSuprimido= $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->fechaActualizacion = new \DateTime('now');
        }
    }

    public function getNombreArchivoArticuloSuprimido(): ?string
    {
        return $this->nombreArchivoArticuloSuprimido;
    }

    public function setNombreArchivoArticuloSuprimido(?string $nombreArchivoArticuloSuprimido): self
    {
        $this->nombreArchivoArticuloSuprimido = $nombreArchivoArticuloSuprimido;

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

    public function getNorma(): ?Norma
    {
        return $this->norma;
    }

    public function setNorma(?Norma $norma): self
    {
        $this->norma = $norma;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getArticulo(): ?string
    {
        return $this->articulo;
    }

    public function setArticulo(string $articulo): self
    {
        $this->articulo = $articulo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }
}
