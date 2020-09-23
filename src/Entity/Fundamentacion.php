<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FundamentacionRepository")
 */
class Fundamentacion extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Consolidacion", inversedBy="fundamentaciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consolidacion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="fundamentaciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $fundamentacion;

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

    public function getFundamentacion(): ?string
    {
        return $this->fundamentacion;
    }

    public function setFundamentacion(?string $fundamentacion): self
    {
        $this->fundamentacion = $fundamentacion;

        return $this;
    }
}
