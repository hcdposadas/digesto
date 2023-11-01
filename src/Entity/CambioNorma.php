<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\TextoDefinitivoRepository")
 */

/**
 * CambioNorma
 * @Vich\Uploadable
 * @ORM\Table(name="cambio_norma")
 * @ORM\Entity(repositoryClass="App\Repository\CambioNormaRepository")
 */
class CambioNorma extends BaseClass
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Consolidacion", inversedBy="cambios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consolidacion;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="cambiosNormas")
	 */
	private $norma;

	/**
	 * @ORM\Column(type="date", nullable=false)
	 */
	private $fecha;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $articulo;

	/**
	 * @ORM\Column(type="string", length=2048, nullable=true)
	 */
	private $fuente;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $titulo;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $remisionExterna;

		/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreArchivoCambioNorma;

	/**
	 * @Vich\UploadableField(mapping="cambios_norma", fileNameProperty="nombreArchivoCambioNorma")
	 * @var File
	 */
	private $archivoCambioNorma;

    public function getArchivoCambioNorma()
    {
        return $this->archivoCambioNorma;
    }

    public function setArchivoCambioNorma(File $file = null)
    {
        $this->archivoCambioNorma= $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->fechaActualizacion = new \DateTime('now');
        }
    }

    public function getNombreArchivoCambioNorma(): ?string
    {
        return $this->nombreArchivoCambioNorma;
    }

    public function setNombreArchivoCambioNorma(?string $nombreArchivoCambioNorma): self
    {
        $this->nombreArchivoCambioNorma = $nombreArchivoCambioNorma;

        return $this;
    }

	public function __construct()
    {
        $this->fecha = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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

    public function setCreadoPor(Usuario $creadoPor = null)
    {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    /**
     * Set actualizadoPor
     *
     * @param Usuario $actualizadoPor
     *
     * @return Iniciador
     */
    public function setActualizadoPor(Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
	}



	/**
	 * Get the value of articulo
	 */
	public function getArticulo()
	{
		return $this->articulo;
	}

	/**
	 * Set the value of articulo
	 *
	 * @return  self
	 */
	public function setArticulo($articulo)
	{
		$this->articulo = $articulo;

		return $this;
	}

	/**
	 * Get the value of fuente
	 */
	public function getFuente()
	{
		return $this->fuente;
	}

	/**
	 * Set the value of fuente
	 *
	 * @return  self
	 */
	public function setFuente($fuente)
	{
		$this->fuente = $fuente;

		return $this;
	}

	/**
	 * Get the value of remisionExterna
	 */
	public function getRemisionExterna()
	{
		return $this->remisionExterna;
	}

	/**
	 * Set the value of remisionExterna
	 *
	 * @return  self
	 */
	public function setRemisionExterna($remisionExterna)
	{
		$this->remisionExterna = $remisionExterna;

		return $this;
	}

	/**
	 * Get the value of norma
	 */
	public function getNorma()
	{
		return $this->norma;
	}

	/**
	 * Set the value of norma
	 *
	 * @return  self
	 */
	public function setNorma($norma)
	{
		$this->norma = $norma;

		return $this;
	}

	/**
	 * Get the value of fecha
	 */
	public function getFecha()
	{
		return $this->fecha;
	}

	/**
	 * Set the value of fecha
	 *
	 * @return  self
	 */
	public function setFecha($fecha)
	{
		$this->fecha = $fecha;

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
}
