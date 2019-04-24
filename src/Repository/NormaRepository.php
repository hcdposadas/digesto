<?php

namespace App\Repository;

use App\Entity\Norma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Norma|null find($id, $lockMode = null, $lockVersion = null)
 * @method Norma|null findOneBy(array $criteria, array $orderBy = null)
 * @method Norma[]    findAll()
 * @method Norma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NormaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Norma::class);
    }

    // /**
    //  * @return Norma[] Returns an array of Norma objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Norma
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getQbAll()
    {
        $qb = $this->createQueryBuilder('n');
        return $qb;
    }

    public function search()
    {
        $qb = $this->getQbAll();

        $qb->orderBy('n.id', 'ASC');

        return $qb;
    }

    public function buscarNormas($data)
    {
        $qb = $this->getQbAll();

        if (isset($data['rama'])) {
            $qb->andWhere('n.rama = :rama')
                ->setParameter('rama', $data['rama']);

        }
        if (isset($data['numero'])) {

            $qb->andWhere('n.numero = :numero')
                ->setParameter('numero', $data['numero']);

            $qb->orWhere('n.numeroAnterior = :numeroAnterior')
                ->setParameter('numeroAnterior', $data['numero']);

        }
        if (isset($data['anio'])) {
            $qb->andWhere('YEAR(n.fechaSancion) = :anio')
                ->setParameter('anio', $data['anio']);

        }
        if (isset($data['palabra'])) {
            $qb->leftJoin('n.descriptoresNorma', 'descriptoresNorma')
                ->leftJoin('descriptoresNorma.descriptor', 'descriptor')
                ->leftJoin('n.identificadoresNorma', 'identificadoresNorma')
                ->leftJoin('identificadoresNorma.identificador', 'identificador')
                ->leftJoin('n.palabrasClaveNorma', 'palabrasClaveNorma')
                ->leftJoin('palabrasClaveNorma.palabraClave', 'palabraClave');

            $qb->andWhere($qb->expr()->orX()->addMultiple([
                'UPPER(palabraClave.nombre) LIKE UPPER(:criteria)',
                'UPPER(descriptor.nombre) LIKE UPPER(:criteria)',
                'UPPER(identificador.nombre) LIKE UPPER(:criteria)'
            ]))
                ->setParameter('criteria', $data['palabra']);


        }

        $qb->andWhere('n.activo = true');

        $qb->addOrderBy('n.numero', 'ASC');

        return $qb;

    }

}
