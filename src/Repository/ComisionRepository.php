<?php

namespace App\Repository;

use App\Entity\Comision;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Comision|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comision|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comision[]    findAll()
 * @method Comision[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComisionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comision::class);
    }

    // /**
    //  * @return Comision[] Returns an array of Comision objects
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
    public function findOneBySomeField($value): ?Comision
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
