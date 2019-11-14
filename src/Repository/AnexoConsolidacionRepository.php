<?php

namespace App\Repository;

use App\Entity\AnexoConsolidacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AnexoConsolidacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnexoConsolidacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnexoConsolidacion[]    findAll()
 * @method AnexoConsolidacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnexoConsolidacionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AnexoConsolidacion::class);
    }

    // /**
    //  * @return AnexoConsolidacion[] Returns an array of AnexoConsolidacion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnexoConsolidacion
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
