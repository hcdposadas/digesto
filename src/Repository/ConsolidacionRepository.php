<?php

namespace App\Repository;

use App\Entity\Consolidacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Consolidacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consolidacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consolidacion[]    findAll()
 * @method Consolidacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsolidacionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Consolidacion::class);
    }

    // /**
    //  * @return Consolidacion[] Returns an array of Consolidacion objects
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
    public function findOneBySomeField($value): ?Consolidacion
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
