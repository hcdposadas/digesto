<?php

namespace App\Repository;

use App\Entity\TipoVeto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoVeto|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoVeto|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoVeto[]    findAll()
 * @method TipoVeto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoVetoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoVeto::class);
    }

    // /**
    //  * @return TipoVeto[] Returns an array of TipoVeto objects
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
    public function findOneBySomeField($value): ?TipoVeto
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
