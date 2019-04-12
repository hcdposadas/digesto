<?php

namespace App\Repository;

use App\Entity\Descriptor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Descriptor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Descriptor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Descriptor[]    findAll()
 * @method Descriptor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DescriptorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Descriptor::class);
    }

    // /**
    //  * @return Descriptor[] Returns an array of Descriptor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Descriptor
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getQbAll() {
        $qb = $this->createQueryBuilder( 'd' );

        return $qb;
    }

    public function getByLike( $string ) {


        $qb = $this->createQueryBuilder('d');
        $qb->where('UPPER(d.nombre) LIKE UPPER(:string)');
        $qb->setParameter( 'string', '%' . $string . '%' );

        $return = $qb->getQuery()->getArrayResult();

        return $return;
    }

}
