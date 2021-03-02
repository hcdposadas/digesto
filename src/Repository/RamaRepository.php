<?php

namespace App\Repository;

use App\Entity\Rama;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rama|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rama|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rama[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RamaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rama::class);
    }

    /**
     * @return Rama[]
     */
    public function findAll()
    {
        return $this->findBy(array(), array('orden' => 'ASC'));
    }

    public function getRamaParticular(): Rama {
        return $this->findOneBy(array(
            'numeroRomano' => 'IX'
        ));
    }
}
