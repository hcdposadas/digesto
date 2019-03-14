<?php

namespace App\Repository;

use App\Entity\IdentificadorNorma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IdentificadorNorma|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdentificadorNorma|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdentificadorNorma[]    findAll()
 * @method IdentificadorNorma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentificadorNormaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IdentificadorNorma::class);
    }

    // /**
    //  * @return IdentificadorNorma[] Returns an array of IdentificadorNorma objects
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
    public function findOneBySomeField($value): ?IdentificadorNorma
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
