<?php

namespace App\Repository;

use App\Entity\AnexoNorma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AnexoNorma|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnexoNorma|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnexoNorma[]    findAll()
 * @method AnexoNorma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnexoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AnexoNorma::class);
    }

    // /**
    //  * @return Anexo[] Returns an array of Anexo objects
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
    public function findOneBySomeField($value): ?Anexo
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
