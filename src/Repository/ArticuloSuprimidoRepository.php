<?php

namespace App\Repository;

use App\Entity\ArticuloSuprimido;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArticuloSuprimido|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticuloSuprimido|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticuloSuprimido[]    findAll()
 * @method ArticuloSuprimido[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticuloSuprimidoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticuloSuprimido::class);
    }

    // /**
    //  * @return ArticuloSuprimido[] Returns an array of ArticuloSuprimido objects
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
    public function findOneBySomeField($value): ?ArticuloSuprimido
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
