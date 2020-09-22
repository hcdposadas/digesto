<?php

namespace App\Repository;

use App\Entity\TextoDefinitivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TextoDefinitivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextoDefinitivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextoDefinitivo[]    findAll()
 * @method TextoDefinitivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextoDefinitivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextoDefinitivo::class);
    }

    // /**
    //  * @return TextoDefinitivo[] Returns an array of TextoDefinitivo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TextoDefinitivo
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
