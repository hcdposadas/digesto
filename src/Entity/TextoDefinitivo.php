<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Vich\Uploadable
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

    	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $nombreArchivoTextoDefinitivo;

	/**
	 * @Vich\UploadableField(mapping="textos_definitivos_consolidacion", fileNameProperty="nombreArchivoTextoDefinitivo")
	 * @var File
	 */
	private $archivoTextoDefinitivo;

    public function getArchivoTextoDefinitivo()
    {
        return $this->archivoTextoDefinitivo;
    }

    public function setArchivoTextoDefinitivo(File $file = null)
    {
        $this->archivoTextoDefinitivo = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->fechaActualizacion = new \DateTime('now');
        }
    }

    public function getNombreArchivoTextoDefinitivo(): ?string
    {
        return $this->nombreArchivoTextoDefinitivo;
    }

    public function setNombreArchivoTextoDefinitivo(?string $nombreArchivoTextoDefinitivo): self
    {
        $this->nombreArchivoTextoDefinitivo = $nombreArchivoTextoDefinitivo;

        return $this;
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
        if($this->nombreArchivoTextoDefinitivo){
            return $this->nombreArchivoTextoDefinitivo;
        }
        return $this->textoDefinitivo;
    }

    public function setTextoDefinitivo($textoDefinitivo): self
    {
        $this->textoDefinitivo = $textoDefinitivo ?? '';

        return $this;
    }
}
