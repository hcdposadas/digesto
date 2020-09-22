<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstadoNormaRepository")
 */
class EstadoNorma extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="estadosNormas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Consolidacion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consolidacion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoEstadoNorma")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getEstado()->getNombre();
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

    public function getConsolidacion(): ?Consolidacion
    {
        return $this->consolidacion;
    }

    public function setConsolidacion(?Consolidacion $consolidacion): self
    {
        $this->consolidacion = $consolidacion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstado() : TipoEstadoNorma
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado(TipoEstadoNorma $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
