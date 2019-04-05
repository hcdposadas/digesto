<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeneficiarioNormaRepository")
 */
class BeneficiarioNorma extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="beneficiarioNormas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Beneficiario")
     * @ORM\JoinColumn(nullable=false)
     */
    private $beneficiario;

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

    public function getBeneficiario(): ?Beneficiario
    {
        return $this->beneficiario;
    }

    public function setBeneficiario(?Beneficiario $beneficiario): self
    {
        $this->beneficiario = $beneficiario;

        return $this;
    }
}
