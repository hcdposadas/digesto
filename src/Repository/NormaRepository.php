<?php

namespace App\Repository;

use App\Entity\Norma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Norma|null find($id, $lockMode = null, $lockVersion = null)
 * @method Norma|null findOneBy(array $criteria, array $orderBy = null)
 * @method Norma[]    findAll()
 * @method Norma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NormaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Norma::class);
    }

    // /**
    //  * @return Norma[] Returns an array of Norma objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Norma
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
