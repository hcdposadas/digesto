<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IdentificadorNormaRepository")
 */
class IdentificadorNorma extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="identificadoresNorma")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Identificador")
     * @ORM\JoinColumn(nullable=false)
     */
    private $identificador;

    public function __toString() {
	    return $this->identificador ? $this->identificador->__toString() : '';
    }

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

    public function getIdentificador(): ?Identificador
    {
        return $this->identificador;
    }

    public function setIdentificador(?Identificador $identificador): self
    {
        $this->identificador = $identificador;

        return $this;
    }
}
