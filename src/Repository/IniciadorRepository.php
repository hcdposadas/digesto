<?php

namespace App\Repository;

use App\Entity\Iniciador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Iniciador|null find($id, $lockMode = null, $lockVersion = null)
 * @method Iniciador|null findOneBy(array $criteria, array $orderBy = null)
 * @method Iniciador[]    findAll()
 * @method Iniciador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IniciadorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Iniciador::class);
    }

    // /**
    //  * @return Iniciador[] Returns an array of Iniciador objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Iniciador
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
