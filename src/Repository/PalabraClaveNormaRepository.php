<?php

namespace App\Repository;

use App\Entity\PalabraClaveNorma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PalabraClaveNorma|null find($id, $lockMode = null, $lockVersion = null)
 * @method PalabraClaveNorma|null findOneBy(array $criteria, array $orderBy = null)
 * @method PalabraClaveNorma[]    findAll()
 * @method PalabraClaveNorma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PalabraClaveNormaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PalabraClaveNorma::class);
    }

    // /**
    //  * @return PalabraClaveNorma[] Returns an array of PalabraClaveNorma objects
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
    public function findOneBySomeField($value): ?PalabraClaveNorma
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
