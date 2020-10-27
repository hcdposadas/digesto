<?php

namespace App\Repository;

use App\Entity\Abrogacion;
use App\Entity\Caducidad;
use App\Entity\ConflictoNormativo;
use App\Entity\Consolidacion;
use App\Entity\Norma;
use App\Entity\Rama;
use App\Entity\Refundicion;
use App\Entity\TextoDefinitivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Consolidacion|null find( $id, $lockMode = null, $lockVersion = null )
 * @method Consolidacion|null findOneBy( array $criteria, array $orderBy = null )
 * @method Consolidacion[]    findAll()
 * @method Consolidacion[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
 */
class ConsolidacionRepository extends ServiceEntityRepository {
	public function __construct( RegistryInterface $registry ) {
		parent::__construct( $registry, Consolidacion::class );
	}

	public function getConsolidacionesOrdenadas() {


		return $this->createQueryBuilder( 'c' )
		            ->where( 'c.activo = true' )
                    ->andWhere( 'c.visible = true' )
		            ->orderBy( 'c.anio', 'DESC' )
		            ->getQuery()
		            ->getResult();
	}

    public function getActivas() {
        return $this->createQueryBuilder( 'c' )
            ->where( 'c.activo = true' )
            ->orderBy( 'c.anio', 'ASC' )
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Consolidacion
     */
    public function getConsolidacionEnCurso()
    {
        return $this->createQueryBuilder('c')
            ->where('c.enCurso = true')
            ->getQuery()
            ->getSingleResult();
	}

    /**
     * @return Consolidacion
     */
    public function getUltimaConsolidacion()
    {
        return $this->createQueryBuilder('c')
            ->where('c.ultima = true')
            ->getQuery()
            ->getSingleResult();
    }

    public function consolidar(Consolidacion $consolidacion, $definitivo = false)
    {
//        if (!$consolidacion->isEnCurso()) {
//            return;
//        }
//
//        // Las modificaciones a las normas están cargadas y asociadas en las distintas entidades, pero acá
//        // toca agregar las vigentes no consolidadas a la la consolidación (siempre controlando de que no
//        // se hayan agregado ya).
//        // Si la consolidación es definitiva, hay que cambiar las normas vigentes no consolidadas a false
//        // para no volver a agregarlas
//
//        $ramaParticular = $this->getEntityManager()->getRepository(Rama::class)->getRamaParticular();
//
//        $fecha = \DateTime::createFromFormat('Y-m-d', sprintf('%d-10-31', $consolidacion->getAnio()));
//        $normasParaAgregarAnexoG = $this->getEntityManager()->getRepository(Norma::class)->getVigentesNoConsolidadas($fecha ,$ramaParticular);
//
//        foreach ($normasParaAgregarAnexoG as $norma) {
////            if (!$this->getEntityManager()->getRepository(NormaConsolidacion::class)->findBy(
//
//
////            $consolidacion->getNormaConsolidacions()->add($norma)
//        }
    }

    /**
     * Todas las normas del Anexo B que no sean particulares
     *
     * @param Consolidacion $consolidacion
     * @return Norma[]
     */
    public function getAnexoA(Consolidacion $consolidacion)
    {
        $normas = $this->getAnexoB($consolidacion);

        $normas = $this->quitarParticulares($normas);

        return $this->ordenarNormas($normas);
    }

    /**
     * Todas las normas (particulares o no) que tengan texto definitivo cargado en esta consolidacion
     *
     * @param Consolidacion $consolidacion
     * @return Norma[]
     */
    public function getAnexoB(Consolidacion $consolidacion) {
        $textos = $this->getEntityManager()->getRepository(TextoDefinitivo::class)->findBy(array(
            'consolidacion' => $consolidacion,
            'activo' => true
        ));

        $textos = array_filter($textos, function (TextoDefinitivo $textoDefinitivo) {
            return $textoDefinitivo->getTextoDefinitivo() != '';
        });

        $normas = array_map(function (TextoDefinitivo $texto) {
            return $texto->getNorma();
        }, $textos);

        return $this->ordenarNormas($normas);
    }

    /**
     * Lista de normas que tengan cargado el formulario de Caducidad
     *
     * @param Consolidacion $consolidacion
     * @return Caducidad[]
     */
    public function getAnexoC(Consolidacion $consolidacion) {
        $caducidades = $consolidacion->getCaducidades();

        return $this->ordenarNormas($caducidades->toArray());
    }

    /**
     * Lista de normas que tengan cargado el formulario de Abrogación Implícita (conflicto normativo)
     *
     * @param Consolidacion $consolidacion
     * @return ConflictoNormativo[]
     */
    public function getAnexoD(Consolidacion $consolidacion) {
        $conflictos = $consolidacion->getConflictosNormativos();

        return $this->ordenarNormas($conflictos->toArray());
    }

    /**
     * Lista de normas que tengan cargado el formulario de Abrogaciones
     *
     * @param Consolidacion $consolidacion
     * @return Abrogacion[]
     */
    public function getAnexoE(Consolidacion $consolidacion) {
        $abrogaciones = $consolidacion->getAbrogaciones();

        return $this->ordenarNormas($abrogaciones->toArray());
    }

    /**
     * Lista de normas que tengan cargado el formulario de Refundición
     *
     * @param Consolidacion $consolidacion
     * @return Refundicion[]
     */
    public function getAnexoF(Consolidacion $consolidacion) {
        $refundidas = $consolidacion->getRefundidas();

        return $this->ordenarNormas($refundidas->toArray());
    }

    /**
     * Normas vigentes no consolidadas, de rama prticular, publicadas hasta el 31/10
     *
     * @param Consolidacion $consolidacion
     * @return Norma[]
     */
    public function getAnexoG(Consolidacion $consolidacion) {
        $fecha = \DateTime::createFromFormat('Y-m-d', sprintf('%d-10-31', $consolidacion->getAnio()));

        $normas = $this->getAnexoB($consolidacion);

        $normas = $this->quitarNoParticulares($normas);

        $normas = array_filter($normas, function (Norma $norma) use ($fecha) {
            return $norma->isVigenteNoConsolidada() && $norma->getFechaPublicacionBoletin() <= $fecha;
        });

        return $this->ordenarNormas($normas);
    }

    public function getAnexoH(Consolidacion $consolidacion) {
        $normas = $this->getEntityManager()->getRepository(Norma::class)->findBy(array(
            'activo' => true
        ));

        $normas = array_filter($normas, function (Norma $norma) use ($consolidacion) {
            if (!$norma->getRama()) {
                return false;
            }
            foreach ($this->getAnexoC($consolidacion) as $caducidad) {
                if ($caducidad->getNorma()->getId() === $norma->getId()) {
                    return false;
                }
            }
            foreach ($this->getAnexoD($consolidacion) as $conflictoNormativo) {
                if ($conflictoNormativo->getNorma()->getId() === $norma->getId()) {
                    return false;
                }
            }
            foreach ($this->getAnexoE($consolidacion) as $abrogacion) {
                if ($abrogacion->getNorma()->getId() === $norma->getId()) {
                    return false;
                }
            }
            foreach ($this->getAnexoF($consolidacion) as $refundicion) {
                if ($refundicion->getNorma()->getId() === $norma->getId()) {
                    return false;
                }
            }

            return true;
        });

        return $this->ordenarNormas($normas);
    }

    /**
     * @param array $normas
     * @return array
     */
    protected function ordenarNormas($normas) {
        usort($normas, function ($norma1, $norma2) {
            if (!($norma1 instanceof Norma)) {
                $norma1 = $norma1->getNorma();
            }
            if (!($norma2 instanceof Norma)) {
                $norma2 = $norma2->getNorma();
            }

            if ($norma1->getRama()->getId() != $norma2->getRama()->getId()) {
                return $norma1->getRama()->getOrden() - $norma2->getRama()->getOrden();
            }
            return $norma1->getNumero() - $norma2->getNumero();
        });

        return $normas;
    }

    /**
     * @param Norma[] $normas
     * @return Norma[]
     */
    protected function quitarParticulares($normas) {
        $normas = array_filter($normas, function (Norma $norma) {
            return $norma->getRama()->getNumeroRomano() !== Rama::RAMA_PARTICULAR;
        });

        return $normas;
    }

    /**
     * @param Norma[] $normas
     * @return Norma[]
     */
    protected function quitarNoParticulares($normas) {
        $normas = array_filter($normas, function (Norma $norma) {
            return $norma->getRama()->getNumeroRomano() == Rama::RAMA_PARTICULAR;
        });

        return $normas;
    }
}
