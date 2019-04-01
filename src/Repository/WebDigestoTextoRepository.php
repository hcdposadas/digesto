<?php

namespace App\Repository;

use App\Entity\WebDigestoTexto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WebDigestoTexto|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebDigestoTexto|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebDigestoTexto[]    findAll()
 * @method WebDigestoTexto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebDigestoTextoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WebDigestoTexto::class);
    }

    // /**
    //  * @return WebDigestoTexto[] Returns an array of WebDigestoTexto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WebDigestoTexto
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
