<?php

namespace App\Repository;

use App\Entity\Fundamentacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Fundamentacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fundamentacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fundamentacion[]    findAll()
 * @method Fundamentacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FundamentacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fundamentacion::class);
    }

    // /**
    //  * @return Fundamentacion[] Returns an array of Fundamentacion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fundamentacion
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
