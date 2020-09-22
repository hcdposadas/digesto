<?php

namespace App\Repository;

use App\Entity\CambioNorma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CambioNorma|null find($id, $lockMode = null, $lockVersion = null)
 * @method CambioNorma|null findOneBy(array $criteria, array $orderBy = null)
 * @method CambioNorma[]    findAll()
 * @method CambioNorma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CambioNormaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CambioNorma::class);
    }
}
