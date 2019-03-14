<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Dictamen;
use Expediente;


/**
 * OrdenDelDia
 *
 * @ORM\Table(name="orden_del_dia")
 * @ORM\Entity(repositoryClass="App\Repository\OrdenDelDiaRepository")
 */
class OrdenDelDia extends BaseClass
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
     * @var Sesion $sesion
     *
     * @ORM\ManyToOne(targetEntity="Sesion", inversedBy="od")
     * @ORM\JoinColumn(name="sesion_id", referencedColumnName="id", nullable=true)
     */
    private $sesion;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="DictamenOD", mappedBy="ordenDelDia", cascade={"persist", "remove"})
     *
     */
    private $dictamenes;

    /**
     * @var bool
     *
     * @ORM\Column(name="cerrado", type="boolean")
     */
    private $cerrado;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cerrado
     *
     * @param boolean $cerrado
     *
     * @return OrdenDelDia
     */
    public function setCerrado($cerrado)
    {
        $this->cerrado = $cerrado;

        return $this;
    }

    /**
     * Get cerrado
     *
     * @return bool
     */
    public function getCerrado()
    {
        return $this->cerrado;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return OrdenDelDia
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     *
     * @return OrdenDelDia
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Set sesion
     *
     * @param Sesion $sesion
     *
     * @return OrdenDelDia
     */
    public function setSesion(Sesion $sesion = null)
    {
        $this->sesion = $sesion;

        return $this;
    }

    /**
     * Get sesion
     *
     * @return Sesion
     */
    public function getSesion()
    {
        return $this->sesion;
    }

    /**
     * Set creadoPor
     *
     * @param Usuario $creadoPor
     *
     * @return OrdenDelDia
     */
    public function setCreadoPor(Usuario $creadoPor = null)
    {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    /**
     * Set actualizadoPor
     *
     * @param Usuario $actualizadoPor
     *
     * @return OrdenDelDia
     */
    public function setActualizadoPor(Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dictamenes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add dictamene
     *
     * @param DictamenOD $dictamene
     *
     * @return OrdenDelDia
     */
    public function addDictamene(DictamenOD $dictamene)
    {

        $dictamene->setOrdenDelDia($this);

        $this->dictamenes->add($dictamene);

        return $this;
    }

    /**
     * Remove dictamene
     *
     * @param DictamenOD $dictamene
     */
    public function removeDictamene(DictamenOD $dictamene)
    {
        $this->dictamenes->removeElement($dictamene);
    }

    /**
     * Get dictamenes
     *
     * @return \Doctrine\Common\Collections\Collection|DictamenOD[]
     */
    public function getDictamenes()
    {
        return $this->dictamenes;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|DictamenOD[]
     */
    public function getDictamenesConTratamientoPreferencial()
    {
        return $this->ordenarProyectos(
            $this->getDictamenes()->filter(function (DictamenOD $dod) {
                $dictamen = $dod->getDictamen();
                if (!$dictamen) {
                    return false;
                }

                return $dictamen->getTipoProyecto()
                    && $dod->getTieneTratamientoPreferencial();
            })
        );
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|DictamenOD[]
     */
    public function getDictamenesDeDeclaracion()
    {
        return $this->ordenarProyectos(
            $this->getDictamenes()->filter(function (DictamenOD $dod) {
                $dictamen = $dod->getDictamen();
                if (!$dictamen) {
                    return false;
                }

                return $dictamen->getTipoProyecto()
                    && $dictamen->getTipoProyecto()->esTipoDeclaracion();
            })
        );
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|DictamenOD[]
     */
    public function getDictamenesDeComunicacion()
    {
        return $this->ordenarProyectos(
            $this->getDictamenes()->filter(function (DictamenOD $dod) {
                $dictamen = $dod->getDictamen();
                if (!$dictamen) {
                    return false;
                }

                return $dictamen->getTipoProyecto()
                    && $dictamen->getTipoProyecto()->esTipoComunicacion();
            })
        );
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|DictamenOD[]
     */
    public function getDictamenesDeResolucion()
    {
        return $this->ordenarProyectos(
            $this->getDictamenes()->filter(function (DictamenOD $dod) {
                $dictamen = $dod->getDictamen();
                if (!$dictamen) {
                    return false;
                }

                return $dictamen->getTipoProyecto()
                    && $dictamen->getTipoProyecto()->esTipoResolucion();
            })
        );
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|DictamenOD[]
     */
    public function getDictamenesDeOrdenanza()
    {
        return $this->ordenarProyectos(
            $this->getDictamenes()->filter(function (DictamenOD $dod) {
                $dictamen = $dod->getDictamen();
                if (!$dictamen) {
                    return false;
                }

                return $dictamen->getTipoProyecto()
                    && $dictamen->getTipoProyecto()->esTipoOrdenanza();
            })
        );
    }

    /**
     * @param \Doctrine\Common\Collections\Collection|DictamenOD[] $proyectos
     * @return \Doctrine\Common\Collections\Collection|DictamenOD[]
     */
    private function ordenarProyectos($proyectos)
    {
        $iterator = $proyectos->getIterator();

        $iterator->uasort(function (DictamenOD $a, DictamenOD $b) {
            list($numeroa, $letraa, $anioa) = explode('-', $a->getDictamen()->getExpediente()->__toString(), 3);
            list($numerob, $letrab, $aniob) = explode('-', $b->getDictamen()->getExpediente()->__toString(), 3);


            if ($anioa < $aniob){
                return -1;
            } elseif ($anioa > $aniob) {
                return 1;
            } else {
                if ($numeroa < $numerob) {
                    return -1;
                } elseif ($numeroa > $numerob) {
                    return 1;
                } else {
                    return 0;
                }
            }
        });

        return new ArrayCollection(iterator_to_array($iterator));
    }
}
