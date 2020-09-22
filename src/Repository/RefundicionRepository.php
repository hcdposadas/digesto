<?php

namespace App\Repository;

use App\Entity\Refundicion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Refundicion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Refundicion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Refundicion[]    findAll()
 * @method Refundicion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefundicionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Refundicion::class);
    }

    // /**
    //  * @return Refundicion[] Returns an array of Refundicion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Refundicion
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
