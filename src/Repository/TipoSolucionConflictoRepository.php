<?php

namespace App\Repository;

use App\Entity\TipoSolucionConflicto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoSolucionConflicto|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoSolucionConflicto|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoSolucionConflicto[]    findAll()
 * @method TipoSolucionConflicto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoSolucionConflictoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoSolucionConflicto::class);
    }

    // /**
    //  * @return TipoSolucionConflicto[] Returns an array of TipoSolucionConflicto objects
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
    public function findOneBySomeField($value): ?TipoSolucionConflicto
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
