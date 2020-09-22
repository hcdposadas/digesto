<?php

namespace App\Repository;

use App\Entity\Consolidacion;
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
}
