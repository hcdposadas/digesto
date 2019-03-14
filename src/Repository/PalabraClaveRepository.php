<?php

namespace App\Repository;

use App\Entity\PalabraClave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PalabraClave|null find($id, $lockMode = null, $lockVersion = null)
 * @method PalabraClave|null findOneBy(array $criteria, array $orderBy = null)
 * @method PalabraClave[]    findAll()
 * @method PalabraClave[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PalabraClaveRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PalabraClave::class);
    }

    // /**
    //  * @return PalabraClave[] Returns an array of PalabraClave objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PalabraClave
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
