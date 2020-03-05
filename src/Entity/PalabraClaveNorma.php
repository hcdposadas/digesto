<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PalabraClaveNormaRepository")
 */
class PalabraClaveNorma extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="palabrasClaveNorma")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PalabraClave")
     * @ORM\JoinColumn(nullable=false)
     */
    private $palabraClave;

	public function __toString() {
		return $this->palabraClave ? $this->palabraClave->__toString() : '';
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

    public function getPalabraClave(): ?PalabraClave
    {
        return $this->palabraClave;
    }

    public function setPalabraClave(?PalabraClave $palabraClave): self
    {
        $this->palabraClave = $palabraClave;

        return $this;
    }
}
