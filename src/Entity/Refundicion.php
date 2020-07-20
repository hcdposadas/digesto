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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $articulo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $articuloAnexo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $normaCompleta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $articuloRefundido;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $articuloAnexoRefundido;

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

    public function getNormaRefundida(): ?Norma
    {
        return $this->normaRefundida;
    }

    public function setNormaRefundida(?Norma $normaRefundida): self
    {
        $this->normaRefundida = $normaRefundida;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArticulo()
    {
        return $this->articulo;
    }

    /**
     * @param mixed $articulo
     */
    public function setArticulo($articulo): void
    {
        $this->articulo = $articulo;
    }

    /**
     * @return mixed
     */
    public function getArticuloAnexo()
    {
        return $this->articuloAnexo;
    }

    /**
     * @param mixed $articuloAnexo
     */
    public function setArticuloAnexo($articuloAnexo): void
    {
        $this->articuloAnexo = $articuloAnexo;
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

    /**
     * @return mixed
     */
    public function getArticuloRefundido()
    {
        return $this->articuloRefundido;
    }

    /**
     * @param mixed $articuloRefundido
     */
    public function setArticuloRefundido($articuloRefundido): void
    {
        $this->articuloRefundido = $articuloRefundido;
    }

    /**
     * @return mixed
     */
    public function getArticuloAnexoRefundido()
    {
        return $this->articuloAnexoRefundido;
    }

    /**
     * @param mixed $articuloAnexoRefundido
     */
    public function setArticuloAnexoRefundido($articuloAnexoRefundido): void
    {
        $this->articuloAnexoRefundido = $articuloAnexoRefundido;
    }

    /**
     * @return mixed
     */
    public function getFundamentacion()
    {
        return $this->fundamentacion;
    }

    /**
     * @param mixed $fundamentacion
     */
    public function setFundamentacion($fundamentacion): void
    {
        $this->fundamentacion = $fundamentacion;
    }

    /**
     * @return mixed
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @param mixed $observaciones
     */
    public function setObservaciones($observaciones): void
    {
        $this->observaciones = $observaciones;
    }
}
