<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DescriptorNormaRepository")
 */
class DescriptorNorma extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="descriptoresNorma")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Descriptor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $descriptor;

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

    public function getDescriptor(): ?Descriptor
    {
        return $this->descriptor;
    }

    public function setDescriptor(?Descriptor $descriptor): self
    {
        $this->descriptor = $descriptor;

        return $this;
    }
}
