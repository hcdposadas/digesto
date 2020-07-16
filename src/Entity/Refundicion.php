<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RefundicionRepository")
 */
class Refundicion extends BaseClass
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="refundiciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="refundidas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $normaRefundida;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $articulo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $articuloAnexo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $normaCompleta;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $articuloRefundido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $articuloAnexoRefundido;

    /**
     * @ORM\Column(type="text")
     */
    private $fundamentacion;

    /**
     * @ORM\Column(type="text")
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

    public function getNormaRefundida(): ?Norma
    {
        return $this->normaRefundida;
    }

    public function setNormaRefundida(?Norma $normaRefundida): self
    {
        $this->normaRefundida = $normaRefundida;

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

    public function getArticuloAnexo(): ?string
    {
        return $this->articuloAnexo;
    }

    public function setArticuloAnexo(string $articuloAnexo): self
    {
        $this->articuloAnexo = $articuloAnexo;

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

    public function getArticuloRefundido(): ?string
    {
        return $this->articuloRefundido;
    }

    public function setArticuloRefundido(string $articuloRefundido): self
    {
        $this->articuloRefundido = $articuloRefundido;

        return $this;
    }

    public function getArticuloAnexoRefundido(): ?string
    {
        return $this->articuloAnexoRefundido;
    }

    public function setArticuloAnexoRefundido(string $articuloAnexoRefundido): self
    {
        $this->articuloAnexoRefundido = $articuloAnexoRefundido;

        return $this;
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
