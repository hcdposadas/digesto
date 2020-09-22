<?php

namespace App\Repository;

use App\Entity\TipoNormaAdhesion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoNormaAdhesion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoNormaAdhesion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoNormaAdhesion[]    findAll()
 * @method TipoNormaAdhesion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoNormaAdhesionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoNormaAdhesion::class);
    }

    // /**
    //  * @return TipoNormaAdhesion[] Returns an array of TipoNormaAdhesion objects
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
    public function findOneBySomeField($value): ?TipoNormaAdhesion
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
