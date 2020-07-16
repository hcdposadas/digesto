<?php

namespace App\Repository;

use App\Entity\Adhesion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Adhesion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adhesion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adhesion[]    findAll()
 * @method Adhesion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdhesionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Adhesion::class);
    }
}
