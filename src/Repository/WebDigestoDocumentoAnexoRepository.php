<?php

namespace App\Repository;

use App\Entity\WebDigestoDocumentoAnexo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WebDigestoDocumentoAnexo|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebDigestoDocumentoAnexo|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebDigestoDocumentoAnexo[]    findAll()
 * @method WebDigestoDocumentoAnexo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebDigestoDocumentoAnexoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WebDigestoDocumentoAnexo::class);
    }

    // /**
    //  * @return WebDigestoDocumentoAnexo[] Returns an array of WebDigestoDocumentoAnexo objects
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
    public function findOneBySomeField($value): ?WebDigestoDocumentoAnexo
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
