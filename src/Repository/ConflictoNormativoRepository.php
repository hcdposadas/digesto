<?php

namespace App\Repository;

use App\Entity\ConflictoNormativo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ConflictoNormativo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConflictoNormativo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConflictoNormativo[]    findAll()
 * @method ConflictoNormativo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConflictoNormativoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConflictoNormativo::class);
    }

    // /**
    //  * @return ConflictoNormativo[] Returns an array of ConflictoNormativo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ConflictoNormativo
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
