<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConflictoNormativoRepository")
 */
class ConflictoNormativo extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Consolidacion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consolidacion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="conflictosNormativos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="conflictosConNormas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $conflictoConNorma;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $normaCompleta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $articulo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $articuloAnexo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $articuloConflicto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $articuloAnexoConflicto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoSolucionConflicto")
     */
    private $tipoSolucion;

    /**
     * @ORM\Column(type="text")
     */
    private $fundamentacion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observaciones;

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

    public function getConflictoConNorma(): ?Norma
    {
        return $this->conflictoConNorma;
    }

    public function setConflictoConNorma(?Norma $conflictoConNorma): self
    {
        $this->conflictoConNorma = $conflictoConNorma;

        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getNormaCompleta()
	{
		return $this->normaCompleta;
	}

	/**
	 * @param mixed $normaCompleta
	 */
	public function setNormaCompleta($normaCompleta): void
	{
		$this->normaCompleta = $normaCompleta;
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

    public function getArticuloAnexo(): ?string
    {
        return $this->articuloAnexo;
    }

    public function setArticuloAnexo(string $articuloAnexo): self
    {
        $this->articuloAnexo = $articuloAnexo;

        return $this;
    }

    public function getArticuloConflicto(): ?string
    {
        return $this->articuloConflicto;
    }

    public function setArticuloConflicto(string $articuloConflicto): self
    {
        $this->articuloConflicto = $articuloConflicto;

        return $this;
    }

    public function getArticuloAnexoConflicto(): ?string
    {
        return $this->articuloAnexoConflicto;
    }

    public function setArticuloAnexoConflicto(string $articuloAnexoConflicto): self
    {
        $this->articuloAnexoConflicto = $articuloAnexoConflicto;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoSolucion()
    {
        return $this->tipoSolucion;
    }

    /**
     * @param mixed $tipoSolucion
     */
    public function setTipoSolucion($tipoSolucion): void
    {
        $this->tipoSolucion = $tipoSolucion;
    }

    public function getFundamentacion(): ?string
    {
        return $this->fundamentacion;
    }

    public function setFundamentacion(string $fundamentacion): self
    {
        $this->fundamentacion = $fundamentacion;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }
}
