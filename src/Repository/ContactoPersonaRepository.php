<?php

namespace App\Repository;

use App\Entity\ContactoPersona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContactoPersona|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactoPersona|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactoPersona[]    findAll()
 * @method ContactoPersona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactoPersonaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContactoPersona::class);
    }

    // /**
    //  * @return ContactoPersona[] Returns an array of ContactoPersona objects
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
    public function findOneBySomeField($value): ?ContactoPersona
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
