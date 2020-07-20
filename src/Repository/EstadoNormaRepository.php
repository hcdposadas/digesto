<?php

namespace App\Repository;

use App\Entity\EstadoNorma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EstadoNorma|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoNorma|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoNorma[]    findAll()
 * @method EstadoNorma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoNormaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoNorma::class);
    }

    // /**
    //  * @return EstadoNorma[] Returns an array of EstadoNorma objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EstadoNorma
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
