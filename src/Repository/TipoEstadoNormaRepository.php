<?php

namespace App\Repository;

use App\Entity\TipoEstadoNorma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoEstadoNorma|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoEstadoNorma|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoEstadoNorma[]    findAll()
 * @method TipoEstadoNorma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoEstadoNormaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoEstadoNorma::class);
    }

    /**
     * @return TipoEstadoNorma
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getPendiente()
    {
        return $this->createQueryBuilder('e')
            ->where('e.nombre = \'Pendiente\'')
            ->getQuery()
            ->getSingleResult();
    }

    // /**
    //  * @return TipoEstadoNorma[] Returns an array of TipoEstadoNorma objects
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
    public function findOneBySomeField($value): ?TipoEstadoNorma
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
