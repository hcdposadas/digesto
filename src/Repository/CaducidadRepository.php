<?php

namespace App\Repository;

use App\Entity\Caducidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Caducidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caducidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caducidad[]    findAll()
 * @method Caducidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaducidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caducidad::class);
    }

    // /**
    //  * @return Caducidad[] Returns an array of Caducidad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Caducidad
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
