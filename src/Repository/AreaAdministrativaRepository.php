<?php

namespace App\Repository;

use App\Entity\AreaAdministrativa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AreaAdministrativa|null find($id, $lockMode = null, $lockVersion = null)
 * @method AreaAdministrativa|null findOneBy(array $criteria, array $orderBy = null)
 * @method AreaAdministrativa[]    findAll()
 * @method AreaAdministrativa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AreaAdministrativaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AreaAdministrativa::class);
    }

    // /**
    //  * @return AreaAdministrativa[] Returns an array of AreaAdministrativa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AreaAdministrativa
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
