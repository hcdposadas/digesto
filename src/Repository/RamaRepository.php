<?php

namespace App\Repository;

use App\Entity\Rama;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rama|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rama|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rama[]    findAll()
 * @method Rama[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RamaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rama::class);
    }

    // /**
    //  * @return Rama[] Returns an array of Rama objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rama
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getRamaParticular(): Rama {
        return $this->findOneBy(array(
            'numeroRomano' => 'IX'
        ));
    }
}
