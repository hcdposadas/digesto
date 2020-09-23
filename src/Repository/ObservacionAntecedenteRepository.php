<?php

namespace App\Repository;

use App\Entity\ObservacionAntecedente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ObservacionAntecedente|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObservacionAntecedente|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObservacionAntecedente[]    findAll()
 * @method ObservacionAntecedente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObservacionAntecedenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ObservacionAntecedente::class);
    }

    // /**
    //  * @return ObservacionAntecedente[] Returns an array of ObservacionAntecedente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ObservacionAntecedente
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
