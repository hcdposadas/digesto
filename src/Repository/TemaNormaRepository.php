<?php

namespace App\Repository;

use App\Entity\TemaNorma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TemaNorma|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemaNorma|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemaNorma[]    findAll()
 * @method TemaNorma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemaNormaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TemaNorma::class);
    }

    // /**
    //  * @return TemaNorma[] Returns an array of TemaNorma objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TemaNorma
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
