<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TemaNormaRepository")
 */
class TemaNorma extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tema", inversedBy="temaNormas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tema;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="temaNormas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTema(): ?Tema
    {
        return $this->tema;
    }

    public function setTema(?Tema $tema): self
    {
        $this->tema = $tema;

        return $this;
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
}
