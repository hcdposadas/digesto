<?php

namespace App\Repository;

use App\Entity\WebDigestoDocumento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WebDigestoDocumento|null find( $id, $lockMode = null, $lockVersion = null )
 * @method WebDigestoDocumento|null findOneBy( array $criteria, array $orderBy = null )
 * @method WebDigestoDocumento[]    findAll()
 * @method WebDigestoDocumento[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
 */
class WebDigestoDocumentoRepository extends ServiceEntityRepository {
	public function __construct( RegistryInterface $registry ) {
		parent::__construct( $registry, WebDigestoDocumento::class );
	}

	// /**
	//  * @return WebDigestoDocumento[] Returns an array of WebDigestoDocumento objects
	//  */
	/*
	public function findByExampleField($value)
	{
		return $this->createQueryBuilder('w')
			->andWhere('w.exampleField = :val')
			->setParameter('val', $value)
			->orderBy('w.id', 'ASC')
			->setMaxResults(10)
			->getQuery()
			->getResult()
		;
	}
	*/

	/*
	public function findOneBySomeField($value): ?WebDigestoDocumento
	{
		return $this->createQueryBuilder('w')
			->andWhere('w.exampleField = :val')
			->setParameter('val', $value)
			->getQuery()
			->getOneOrNullResult()
		;
	}
	*/

	public function getDocumentosWeb() {
		return $this->createQueryBuilder( 'w' )
		            ->andWhere( 'w.activo = true' )
		            ->orderBy( 'w.grupo' )
		            ->getQuery()
		            ->getResult();
	}
}
