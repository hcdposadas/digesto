<?php

namespace App\Repository;

use App\Entity\BeneficiarioNorma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BeneficiarioNorma|null find($id, $lockMode = null, $lockVersion = null)
 * @method BeneficiarioNorma|null findOneBy(array $criteria, array $orderBy = null)
 * @method BeneficiarioNorma[]    findAll()
 * @method BeneficiarioNorma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeneficiarioNormaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BeneficiarioNorma::class);
    }

    // /**
    //  * @return BeneficiarioNorma[] Returns an array of BeneficiarioNorma objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BeneficiarioNorma
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
