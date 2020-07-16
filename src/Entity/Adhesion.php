<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adhesion
 *
 * @ORM\Table(name="adhesiones")
 * @ORM\Entity(repositoryClass="App\Repository\AdhesionRepository")
 */
class Adhesion extends BaseClass
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Norma", inversedBy="adhesiones")
     */
    private $norma;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $adhesion;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set creadoPor
     *
     * @param Usuario $creadoPor
     *
     * @return Iniciador
     */
    public function setCreadoPor(Usuario $creadoPor = null)
    {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    public function setActualizadoPor(Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }

    public function getNorma() : Norma
    {
        return $this->norma;
    }

    public function setNorma(?Norma $norma)
    {
        $this->norma = $norma;

        return $this;
    }


    public function getTipo() : ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getAdhesion()
	{
		return $this->adhesion;
	}

	/**
	 * @param mixed $adhesion
	 */
	public function setAdhesion($adhesion): void
	{
		$this->adhesion = $adhesion;
	}
}
