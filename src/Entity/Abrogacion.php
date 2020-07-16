<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AbrogacionRepository")
 */
class Abrogacion extends BaseClass
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
	 * La norma abrogada
	 *
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="abrogaciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

	/**
	 * La norma abrogante
	 *
	 * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="abrogadas")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $normaAbrogante;

    /**
	 * Si se abroga la norma completa
	 *
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
    private $articuloAbrogante;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $anexoAbrogante;

    /**
     * @ORM\Column(type="text", nullable=true)
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

    public function getNormaAbrogante(): ?Norma
    {
        return $this->normaAbrogante;
    }

    public function setNormaAbrogante(?Norma $normaAbrogante): self
    {
        $this->normaAbrogante = $normaAbrogante;

        return $this;
    }

    public function getArticuloAbrogante(): ?string
    {
        return $this->articuloAbrogante;
    }

    public function setArticuloAbrogante(?string $articuloAbrogante): self
    {
        $this->articuloAbrogante = $articuloAbrogante;

        return $this;
    }

    public function getAnexoAbrogante(): ?string
    {
        return $this->anexoAbrogante;
    }

    public function setAnexoAbrogante(?string $anexoAbrogante): self
    {
        $this->anexoAbrogante = $anexoAbrogante;

        return $this;
    }

    public function getFundamentacion(): ?string
    {
        return $this->fundamentacion;
    }

    public function setFundamentacion(?string $fundamentacion): self
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
