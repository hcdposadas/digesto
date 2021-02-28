<?php

namespace App\Repository;

use App\Entity\Tema;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tema|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tema|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tema[]    findAll()
 * @method Tema[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tema::class);
    }

    /**
     * @param $string
     * @return Tema[]
     */
    public function getByLike( $string )
    {
        $qb = $this->createQueryBuilder('pc');
        $qb->where('UPPER(pc.titulo) LIKE UPPER(:string)');
        $qb->setParameter( 'string', '%' . $string . '%' );
        $qb->orderBy('pc.titulo');

        return $qb->getQuery()->getResult();
    }
}
