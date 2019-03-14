<?php

namespace App\Repository;

use App\Entity\TipoBoletin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TipoBoletin|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoBoletin|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoBoletin[]    findAll()
 * @method TipoBoletin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoBoletinRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TipoBoletin::class);
    }

    // /**
    //  * @return TipoBoletin[] Returns an array of TipoBoletin objects
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
    public function findOneBySomeField($value): ?TipoBoletin
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
