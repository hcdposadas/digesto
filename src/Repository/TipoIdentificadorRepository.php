<?php

namespace App\Repository;

use App\Entity\TipoIdentificador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TipoIdentificador|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoIdentificador|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoIdentificador[]    findAll()
 * @method TipoIdentificador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoIdentificadorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TipoIdentificador::class);
    }

    // /**
    //  * @return TipoIdentificador[] Returns an array of TipoIdentificador objects
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
    public function findOneBySomeField($value): ?TipoIdentificador
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
