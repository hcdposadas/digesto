<?php

namespace App\Repository;

use App\Entity\TipoOrdenanza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TipoOrdenanza|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoOrdenanza|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoOrdenanza[]    findAll()
 * @method TipoOrdenanza[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoOrdenanzaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TipoOrdenanza::class);
    }

    // /**
    //  * @return TipoOrdenanza[] Returns an array of TipoOrdenanza objects
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
    public function findOneBySomeField($value): ?TipoOrdenanza
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
