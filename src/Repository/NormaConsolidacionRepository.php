<?php

namespace App\Repository;

use App\Entity\NormaConsolidacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NormaConsolidacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method NormaConsolidacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method NormaConsolidacion[]    findAll()
 * @method NormaConsolidacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NormaConsolidacionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NormaConsolidacion::class);
    }

    // /**
    //  * @return NormaConsolidacion[] Returns an array of NormaConsolidacion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NormaConsolidacion
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
