<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TextoDefinitivoRepository")
 */
class TextoDefinitivo extends BaseClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="textosDefinitivos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $norma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Consolidacion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consolidacion;

    /**
     * @ORM\Column(type="text")
     */
    private $textoDefinitivo;

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

    public function getConsolidacion(): ?Consolidacion
    {
        return $this->consolidacion;
    }

    public function setConsolidacion(?Consolidacion $consolidacion): self
    {
        $this->consolidacion = $consolidacion;

        return $this;
    }

    public function getTextoDefinitivo(): ?string
    {
        return $this->textoDefinitivo;
    }

    public function setTextoDefinitivo(string $textoDefinitivo): self
    {
        $this->textoDefinitivo = $textoDefinitivo;

        return $this;
    }
}
