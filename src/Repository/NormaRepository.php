<?php

namespace App\Repository;

use App\Entity\Consolidacion;
use App\Entity\EstadoNorma;
use App\Entity\Norma;
use App\Entity\TipoEstadoNorma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Norma|null find( $id, $lockMode = null, $lockVersion = null )
 * @method Norma|null findOneBy( array $criteria, array $orderBy = null )
 * @method Norma[]    findAll()
 * @method Norma[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
 */
class NormaRepository extends ServiceEntityRepository {
	public function __construct( RegistryInterface $registry ) {
		parent::__construct( $registry, Norma::class );
	}

	public function getByLike($texto)
    {
        $texto = trim(strtolower($texto));
        $texto = trim(preg_replace('/ +/', ' ', $texto));

        if (preg_match('/[ivx]+\s*(-+\s*)?\d+/i', $texto)) {
            $numero = preg_replace('/\D+/i', '', $texto);
            $numeroRomano = preg_replace('/[^ivx]+/i', '', $texto);
            $titulo = null;
        } else {
            $numero = preg_replace('/\D+/i', '', $texto);
            $numeroRomano = preg_replace('/[^ivx]+/i', '', $texto);
            $titulo = $texto;
            if ($numero || $numeroRomano) {
                $titulo = preg_replace('/(' . implode('|', [$numero, $numeroRomano]) . ')/i', ' ', $titulo);
            }
        }

        $qb = $this->createQueryBuilder('n');
        $qb->join('n.rama', 'r');

        if ($numero) {
            $qb->andWhere('n.numero = :numero');
            $qb->setParameter('numero', $numero);
        }
        if ($numeroRomano) {
            $qb->andWhere('LOWER(r.numeroRomano) = :numeroRomano');
            $qb->setParameter('numeroRomano', $numeroRomano);
        }
        if ($titulo) {
            $qb->andWhere('LOWER(r.titulo) LIKE :titulo');
            $qb->setParameter('titulo', '%'.$titulo.'%');
        }

        $qb->orderBy('r.orden');
        $qb->addOrderBy('n.numero');

	    return $qb->getQuery()->getResult();
    }

	public function getQbAll() {
		return $this->createQueryBuilder( 'n' )
            ->join('n.rama', 'r');
	}

	public function search() {
		$qb = $this->getQbAll();

        $qb->orderBy( 'r.orden', 'ASC' );
		$qb->addOrderBy( 'n.numero', 'ASC' );

		return $qb;
	}


	/**
	 * @param QueryBuilder $qb
	 * @param $data
	 *
	 * @return QueryBuilder
	 */
	private function setFiltros( $qb, $data ) {
		if ( isset( $data['rama'] ) ) {
			$qb->andWhere( 'n.rama = :rama' )
			   ->setParameter( 'rama', $data['rama'] );

		}
		if ( isset( $data['numero'] ) ) {

			$qb->andWhere( 'n.numero = :numero' )
			   ->setParameter( 'numero', $data['numero'] );

			$qb->orWhere( 'n.numeroAnterior = :numeroAnterior' )
			   ->setParameter( 'numeroAnterior', $data['numero'] );

		}
		if ( isset( $data['anio'] ) ) {
			$qb->andWhere( 'YEAR(n.fechaSancion) = :anio' )
			   ->setParameter( 'anio', $data['anio'] );

		}
		if ( isset( $data['palabra'] ) ) {
			$qb->leftJoin( 'n.descriptoresNorma', 'descriptoresNorma' )
			   ->leftJoin( 'descriptoresNorma.descriptor', 'descriptor' )
			   ->leftJoin( 'n.identificadoresNorma', 'identificadoresNorma' )
			   ->leftJoin( 'identificadoresNorma.identificador', 'identificador' )
			   ->leftJoin( 'n.palabrasClaveNorma', 'palabrasClaveNorma' )
			   ->leftJoin( 'palabrasClaveNorma.palabraClave', 'palabraClave' );

			$qb->andWhere( $qb->expr()->orX()->addMultiple( [
				'UPPER(palabraClave.nombre) LIKE UPPER(:criteria)',
				'UPPER(descriptor.nombre) LIKE UPPER(:criteria)',
				'UPPER(identificador.nombre) LIKE UPPER(:criteria)'
			] ) )
			   ->setParameter( 'criteria', '%' . $data['palabra'] . '%' );


		}

		if ( $data['descriptores']) {
			$qb->leftJoin( 'n.descriptoresNorma', 'descriptoresNorma' );

			$qb->orWhere( $qb->expr()->in( 'descriptoresNorma.descriptor', ':descriptores' ) );

			$qb->setParameter( 'descriptores', [ $data['descriptores'] ] );

		}
		if ( $data['identificadores'] ) {
			$qb->leftJoin( 'n.identificadoresNorma', 'identificadoresNorma' );

			$qb->orWhere( $qb->expr()->in( 'identificadoresNorma.identificador', ':identificadores' ) );

			$qb->setParameter( 'identificadores', [ $data['identificadores'] ] );
		}
		if ( $data['palabrasClave'] ) {
			$qb->leftJoin( 'n.palabrasClaveNorma', 'palabrasClaveNorma' );

			$qb->orWhere( $qb->expr()->in( 'palabrasClaveNorma.palabraClave', ':palabrasClave' ) );

			$qb->setParameter( 'palabrasClave', [ $data['palabrasClave'] ] );
		}

		if ( isset( $data['fechaSancion'] ) ) {

			$qb->andWhere( 'n.fechaSancion = :fechaSancion' )
			   ->setParameter( 'fechaSancion', $data['fechaSancion'] );;

		}

		if ( isset( $data['temaGeneral'] ) ) {

			$qb->andWhere( 'UPPER(n.temaGeneral) LIKE UPPER(:temaGeneral)' )
			   ->setParameter( 'temaGeneral', '%' . $data['temaGeneral'] . '%' );

		}


		if ( isset( $data['paginaBoletin'] ) ) {

			$qb->andWhere( 'n.paginaBoletin = :paginaBoletin' )
			   ->setParameter( 'paginaBoletin', $data['paginaBoletin'] );;

		}

		if ( isset( $data['decretoPromulgatorio'] ) ) {
			$qb->andWhere( 'n.decretoPromulgatorio = :decretoPromulgatorio' )
			   ->setParameter( 'decretoPromulgatorio', $data['decretoPromulgatorio'] );

		}

        if ( isset( $data['estado'] ) ) {
            $qb->join('n.estadosNormas', 'en')
                ->join('en.estado', 'e')
                ->andWhere('e.id = :estadoId')
                ->setParameter( 'estadoId', $data['estado'] );

        }

		return $qb;
	}

	public function getQbBuscar( $data ) {
		$qb = $this->setFiltros( $this->getQbAll(), $data );

		$qb->orderBy( 'n.numero', 'ASC' );

		return $qb;
	}

	public function buscarNormas( $data ) {
		$qb = $this->setFiltros( $this->getQbAll(), $data );


		$qb->andWhere( 'n.activo = true' );

		$qb->addOrderBy( 'n.numero', 'ASC' );

		return $qb;

	}

	public function updateEstados()
    {
        $consolidacion = $this->getEntityManager()->getRepository(Consolidacion::class)->getConsolidacionEnCurso();
        $pendiente = $this->getEntityManager()->getRepository(TipoEstadoNorma::class)->getPendiente();


	    $normasConEstado = $this->createQueryBuilder('n')
            ->join('n.estadosNormas', 'e')
            ->join('e.consolidacion', 'c')
            ->where('c.enCurso = true')
            ->getQuery()
            ->getResult();

	    if (count($normasConEstado)) {
            $normasSinEstado = $this->createQueryBuilder('n')
                ->where('n.id NOT IN (:ids)')
                ->setParameters([
                    'ids' => array_map(function ($n) { return $n->getId(); }, $normasConEstado)
                ])
                ->getQuery()
                ->getResult();
        } else {
            $normasSinEstado = $this->createQueryBuilder('n')
                ->getQuery()
                ->getResult();
        }



	    /** @var $norma Norma */
	    foreach ($normasSinEstado as $norma) {
	        $estado = new EstadoNorma();
	        $estado->setEstado($pendiente);
	        $estado->setConsolidacion($consolidacion);
	        $norma->addEstadosNorma($estado);
	        $this->getEntityManager()->persist($norma);
        }

        $this->getEntityManager()->flush();
    }

}
