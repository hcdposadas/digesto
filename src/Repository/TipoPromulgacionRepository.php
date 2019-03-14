<?php

namespace App\Repository;

use App\Entity\TipoPromulgacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TipoPromulgacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoPromulgacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoPromulgacion[]    findAll()
 * @method TipoPromulgacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoPromulgacionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TipoPromulgacion::class);
    }

    // /**
    //  * @return TipoPromulgacion[] Returns an array of TipoPromulgacion objects
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
    public function findOneBySomeField($value): ?TipoPromulgacion
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
