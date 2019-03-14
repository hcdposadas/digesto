<?php

namespace App\Repository;

use App\Entity\DescriptorNorma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DescriptorNorma|null find($id, $lockMode = null, $lockVersion = null)
 * @method DescriptorNorma|null findOneBy(array $criteria, array $orderBy = null)
 * @method DescriptorNorma[]    findAll()
 * @method DescriptorNorma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DescriptorNormaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DescriptorNorma::class);
    }

    // /**
    //  * @return DescriptorNorma[] Returns an array of DescriptorNorma objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DescriptorNorma
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
