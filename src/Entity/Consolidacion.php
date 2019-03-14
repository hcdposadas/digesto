<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsolidacionRepository")
 */
class Consolidacion extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $anio;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NormaConsolidacion", mappedBy="consolidacion", orphanRemoval=true)
     */
    private $normaConsolidacions;

    public function __construct()
    {
        $this->normaConsolidacions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnio(): ?int
    {
        return $this->anio;
    }

    public function setAnio(int $anio): self
    {
        $this->anio = $anio;

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

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * @return Collection|NormaConsolidacion[]
     */
    public function getNormaConsolidacions(): Collection
    {
        return $this->normaConsolidacions;
    }

    public function addNormaConsolidacion(NormaConsolidacion $normaConsolidacion): self
    {
        if (!$this->normaConsolidacions->contains($normaConsolidacion)) {
            $this->normaConsolidacions[] = $normaConsolidacion;
            $normaConsolidacion->setConsolidacion($this);
        }

        return $this;
    }

    public function removeNormaConsolidacion(NormaConsolidacion $normaConsolidacion): self
    {
        if ($this->normaConsolidacions->contains($normaConsolidacion)) {
            $this->normaConsolidacions->removeElement($normaConsolidacion);
            // set the owning side to null (unless already changed)
            if ($normaConsolidacion->getConsolidacion() === $this) {
                $normaConsolidacion->setConsolidacion(null);
            }
        }

        return $this;
    }
}
