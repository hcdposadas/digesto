<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TemaRepository")
 */
class Tema extends BaseClass
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
    private $titulo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rama", inversedBy="temas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rama;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tema", inversedBy="temas")
     */
    private $temaPadre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tema", cascade={"persist", "remove"}, mappedBy="temaPadre")
     */
    private $temas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TemaNorma", cascade={"persist", "remove"}, mappedBy="tema", orphanRemoval=true)
     */
    private $temaNormas;

    public function __construct()
    {
        $this->temas = new ArrayCollection();
        $this->temaNormas = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getRama(): ?Rama
    {
        return $this->rama;
    }

    public function setRama(?Rama $rama): self
    {
        $this->rama = $rama;

        return $this;
    }

    public function getTemaPadre(): ?self
    {
        return $this->temaPadre;
    }

    public function setTemaPadre(?self $temaPadre): self
    {
        $this->temaPadre = $temaPadre;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getTemas(): Collection
    {
        return $this->temas;
    }

    public function addTema(self $tema): self
    {
        if (!$this->temas->contains($tema)) {
            $this->temas[] = $tema;
            $tema->setTemaPadre($this);
        }

        return $this;
    }

    public function removeTema(self $tema): self
    {
        if ($this->temas->contains($tema)) {
            $this->temas->removeElement($tema);
            // set the owning side to null (unless already changed)
            if ($tema->getTemaPadre() === $this) {
                $tema->setTemaPadre(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->titulo ?? '';
    }

    /**
     * @return Tema[]
     */
    public function getBreadcrumbs()
    {
        $parents = [];
        $tema = $this->getTemaPadre();
        while ($tema) {
            $parents[] = $tema;
            $tema = $tema->getTemaPadre();
        }
        return array_reverse($parents);
    }

    /**
     * @return Collection|TemaNorma[]
     */
    public function getTemaNormas(): Collection
    {
        return $this->temaNormas;
    }

    public function addTemaNorma(TemaNorma $temaNorma): self
    {
        if (!$this->temaNormas->contains($temaNorma)) {
            $this->temaNormas[] = $temaNorma;
            $temaNorma->setTema($this);
        }

        return $this;
    }

    public function removeTemaNorma(TemaNorma $temaNorma): self
    {
        if ($this->temaNormas->contains($temaNorma)) {
            $this->temaNormas->removeElement($temaNorma);
            // set the owning side to null (unless already changed)
            if ($temaNorma->getTema() === $this) {
                $temaNorma->setTema(null);
            }
        }

        return $this;
    }
}
