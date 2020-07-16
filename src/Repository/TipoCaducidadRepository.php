<?php

namespace App\Repository;

use App\Entity\TipoCaducidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoCaducidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoCaducidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoCaducidad[]    findAll()
 * @method TipoCaducidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoCaducidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoCaducidad::class);
    }

    // /**
    //  * @return TipoCaducidad[] Returns an array of TipoCaducidad objects
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
    public function findOneBySomeField($value): ?TipoCaducidad
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
