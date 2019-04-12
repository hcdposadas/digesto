<?php

namespace App\Repository;

use App\Entity\Identificador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Identificador|null find($id, $lockMode = null, $lockVersion = null)
 * @method Identificador|null findOneBy(array $criteria, array $orderBy = null)
 * @method Identificador[]    findAll()
 * @method Identificador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentificadorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Identificador::class);
    }

    // /**
    //  * @return Identificador[] Returns an array of Identificador objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Identificador
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getQbAll() {
        $qb = $this->createQueryBuilder( 'i' );

        return $qb;
    }

    public function getByLike( $string ) {


        $qb = $this->createQueryBuilder('i');
        $qb->where('UPPER(i.nombre) LIKE UPPER(:string)');
        $qb->setParameter( 'string', '%' . $string . '%' );

        $return = $qb->getQuery()->getArrayResult();

        return $return;
    }
}
