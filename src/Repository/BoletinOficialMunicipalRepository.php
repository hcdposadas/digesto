<?php

namespace App\Repository;

use App\Entity\BoletinOficialMunicipal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BoletinOficialMunicipal|null find( $id, $lockMode = null, $lockVersion = null )
 * @method BoletinOficialMunicipal|null findOneBy( array $criteria, array $orderBy = null )
 * @method BoletinOficialMunicipal[]    findAll()
 * @method BoletinOficialMunicipal[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
 */
class BoletinOficialMunicipalRepository extends ServiceEntityRepository {
	public function __construct( RegistryInterface $registry ) {
		parent::__construct( $registry, BoletinOficialMunicipal::class );
	}

	// /**
	//  * @return BoletinOficialMunicipal[] Returns an array of BoletinOficialMunicipal objects
	//  */
	/*
	public function findByExampleField($value)
	{
		return $this->createQueryBuilder('b')
			->andWhere('b.exampleField = :val')
			->setParameter('val', $value)
			->orderBy('b.id', 'ASC')
			->setMaxResults(10)
			->getQuery()
			->getResult()
		;
	}
	*/

	/*
	public function findOneBySomeField($value): ?BoletinOficialMunicipal
	{
		return $this->createQueryBuilder('b')
			->andWhere('b.exampleField = :val')
			->setParameter('val', $value)
			->getQuery()
			->getOneOrNullResult()
		;
	}
	*/

	public function getQbAll() {
		$qb = $this->createQueryBuilder( 'b' );

		return $qb;
	}

	public function search() {
		$qb = $this->getQbAll();

		$qb->orderBy( 'b.numero', 'DESC' );

		return $qb;
	}

	public function getQbBuscar( $data ) {
		$qb = $this->getQbAll();

		if ( $data['numero'] ) {
			$qb->where( 'b.numero = :numero' )
			   ->setParameter( 'numero', $data['numero'] );
		}

		if ( isset( $data['anio'] ) && $data['anio'] ) {
			$qb->andWhere( 'YEAR(b.fechaPublicacion) = :anio' )
			   ->setParameter( 'anio', $data['anio'] );
		}


		$qb->orderBy( 'b.numero', 'DESC' );

		return $qb;
	}

	public function getAniosBoletines() {
		return $this->createQueryBuilder( 'b' )
		            ->select( 'YEAR(b.fechaPublicacion) AS anio' )
		            ->groupBy( 'anio' )
		            ->orderBy( 'anio', 'DESC' )
		            ->getQuery()
		            ->getResult();
	}

	public function findBoletinesByYear( $anio ) {
		return $this->createQueryBuilder( 'b' )
		            ->where( 'YEAR(b.fechaPublicacion) = :anio' )
		            ->setParameter( 'anio', $anio )
		            ->orderBy( 'b.numero', 'DESC' )
		            ->getQuery()
		            ->getResult();
	}
}
