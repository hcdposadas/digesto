<?php

namespace App\Repository;

use App\Entity\Abrogacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Abrogacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Abrogacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Abrogacion[]    findAll()
 * @method Abrogacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbrogacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Abrogacion::class);
    }

    // /**
    //  * @return Abrogacion[] Returns an array of Abrogacion objects
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
    public function findOneBySomeField($value): ?Abrogacion
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
