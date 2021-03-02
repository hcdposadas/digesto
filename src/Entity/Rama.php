<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RamaRepository")
 * @ApiResource(
 *   itemOperations={
 *      "get"={"method"="GET"}
 *   },
 *   collectionOperations={
 *      "get"={"method"="GET"}
 *   }
 * )
 */
class Rama extends BaseClass
{
    public const RAMA_PARTICULAR = 'IX';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"norma"})
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colorLetra;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $especial;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"norma"})
     */
    private $numeroRomano;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $orden;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tema", mappedBy="rama", orphanRemoval=true)
     */
    private $temas;

    public function __construct()
    {
        $this->temas = new ArrayCollection();
    }

	public function __toString() {
        return $this->numeroRomano . ' - '. $this->titulo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getColorLetra(): ?string
    {
        return $this->colorLetra;
    }

    public function setColorLetra(?string $colorLetra): self
    {
        $this->colorLetra = $colorLetra;

        return $this;
    }

    public function getEspecial(): ?bool
    {
        return $this->especial;
    }

    public function setEspecial(bool $especial): self
    {
        $this->especial = $especial;

        return $this;
    }

    public function getNumeroRomano(): ?string
    {
        return $this->numeroRomano;
    }

    public function setNumeroRomano(string $numeroRomano): self
    {
        $this->numeroRomano = $numeroRomano;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(?int $orden): self
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * @return Collection|Tema[]
     */
    public function getTemas(): Collection
    {
        return $this->temas;
    }

    public function addTema(Tema $tema): self
    {
        if (!$this->temas->contains($tema)) {
            $this->temas[] = $tema;
            $tema->setRama($this);
        }

        return $this;
    }

    public function removeTema(Tema $tema): self
    {
        if ($this->temas->contains($tema)) {
            $this->temas->removeElement($tema);
            // set the owning side to null (unless already changed)
            if ($tema->getRama() === $this) {
                $tema->setRama(null);
            }
        }

        return $this;
    }
}
