<?php

namespace App\Repository;

use App\Entity\AnexoOriginalNorma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AnexoOriginalNorma|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnexoOriginalNorma|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnexoOriginalNorma[]    findAll()
 * @method AnexoOriginalNorma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnexoOriginalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AnexoOriginalNorma::class);
    }
}
