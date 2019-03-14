<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IdentificadorRepository")
 */
class Identificador extends BaseClass
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
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoIdentificador")
     */
    private $tipoIdentificador;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTipoIdentificador(): ?TipoIdentificador
    {
        return $this->tipoIdentificador;
    }

    public function setTipoIdentificador(?TipoIdentificador $tipoIdentificador): self
    {
        $this->tipoIdentificador = $tipoIdentificador;

        return $this;
    }
}
