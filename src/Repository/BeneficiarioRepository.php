<?php

namespace App\Repository;

use App\Entity\Beneficiario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Beneficiario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beneficiario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beneficiario[]    findAll()
 * @method Beneficiario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeneficiarioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Beneficiario::class);
    }

    // /**
    //  * @return Beneficiario[] Returns an array of Beneficiario objects
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
    public function findOneBySomeField($value): ?Beneficiario
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
