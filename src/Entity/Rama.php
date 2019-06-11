<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RamaRepository")
 * @ApiResource(
 *   itemOperations={
 *      "get"={"method"="GET"}
 *   },
 *   collectionOperations={
 *      "get"={"method"="GET"}
 *   }
 * )
 */
class Rama extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colorLetra;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $especial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numeroRomano;

	public function __toString() {
		return $this->numeroRomano . ' - '. $this->titulo;
	}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getColorLetra(): ?string
    {
        return $this->colorLetra;
    }

    public function setColorLetra(?string $colorLetra): self
    {
        $this->colorLetra = $colorLetra;

        return $this;
    }

    public function getEspecial(): ?bool
    {
        return $this->especial;
    }

    public function setEspecial(bool $especial): self
    {
        $this->especial = $especial;

        return $this;
    }

    public function getNumeroRomano(): ?string
    {
        return $this->numeroRomano;
    }

    public function setNumeroRomano(string $numeroRomano): self
    {
        $this->numeroRomano = $numeroRomano;

        return $this;
    }
}
