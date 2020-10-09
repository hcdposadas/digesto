<?php

namespace App\Repository;

use App\Entity\CambioAnexo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CambioAnexo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CambioAnexo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CambioAnexo[]    findAll()
 * @method CambioAnexo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CambioAnexoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CambioAnexo::class);
    }

    // /**
    //  * @return CambioAnexo[] Returns an array of CambioAnexo objects
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
    public function findOneBySomeField($value): ?CambioAnexo
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
