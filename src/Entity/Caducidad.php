<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaducidadRepository")
 */
class Caducidad extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Consolidacion", inversedBy="caducidades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consolidacion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="caducidades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoCaducidad")
     */
    private $tipoCaducidad;

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

    public function getNormaCompleta(): ?bool
    {
        return $this->normaCompleta;
    }

    public function setNormaCompleta(bool $normaCompleta): self
    {
        $this->normaCompleta = $normaCompleta;

        return $this;
    }

    public function getArticulo(): ?string
    {
        return $this->articulo;
    }

    public function setArticulo(?string $articulo): self
    {
        $this->articulo = $articulo;

        return $this;
    }

    public function getArticuloAnexo(): ?string
    {
        return $this->articuloAnexo;
    }

    public function setArticuloAnexo(?string $articuloAnexo): self
    {
        $this->articuloAnexo = $articuloAnexo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoCaducidad()
    {
        return $this->tipoCaducidad;
    }

    /**
     * @param mixed $tipoCaducidad
     */
    public function setTipoCaducidad($tipoCaducidad): void
    {
        $this->tipoCaducidad = $tipoCaducidad;
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

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }
}
