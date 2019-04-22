<?php

namespace App\Command\Migradores;


use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

abstract class Migrador
{
    /**
     * @var Connection
     */
    protected $conn;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var SymfonyStyle
     */
    protected $io;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var array old -> new
     */
    public $ids = [];

    /**
     * @var Migrador[]
     */
    protected $migradores;

    /**
     * @var int
     */
    protected $chunckSize = 20000;

    public function __construct(Connection $conn, EntityManagerInterface $em, SymfonyStyle $io)
    {
        $this->conn = $conn;
        $this->em = $em;
        $this->io = $io;
    }

    public function migrar($migradores)
    {
        $this->migradores = $migradores;

        $this->init();

        $rows = $this->queryRows();

        $chunck = 0;
        $this->io->progressStart(count($rows));
        foreach ($rows as $row) {
            $entity = $this->mapRow($row);

            if ($entity) {
                $this->persist($entity);
                $this->ids[$this->getOldId($row, $entity)] = $entity;
            }

            if (++$chunck == $this->chunckSize) {
                $this->em->flush();
                $chunck = 0;
            }

            $this->io->progressAdvance();

        }
        $this->io->progressFinish();

        $this->finish();
    }

    public function truncate()
    {
        if (!$this->class) {
            return;
        }


        $items = $this->em->getRepository($this->class)->findAll();

        if (count($items) === 0) {
            $this->io->note('Nothing to truncate');
            return;
        }

        $chunck = 0;
        $this->io->progressStart(count($items));
        foreach ($items as $i) {
            $this->em->remove($i);

            if (++$chunck == $this->chunckSize) {
                $this->em->flush();
                $chunck = 0;
            }

            $this->io->progressAdvance();
        }
        $this->em->flush();
        $this->io->progressFinish();


        $table = $this->em->getClassMetadata($this->class)->getTableName();
        $seq = $table.'_id_seq';
        $sql = 'ALTER SEQUENCE '.$seq.' RESTART WITH 1';
        $this->em->getConnection()->exec($sql);
        $this->em->flush();
    }

    protected function init()
    {

    }

    protected function finish()
    {
        $this->em->flush();
    }

    protected function queryRows()
    {
        return $this->conn->fetchAll($this->getSQL());
    }

    protected function getSQL()
    {
        return 'SELECT 1';
    }

    protected function mapRow($row)
    {
        return $row;
    }

    protected function persist($entity)
    {
        $this->em->persist($entity);
    }

    protected function trim($str)
    {
        return trim($str, ". \t\n\r\0\x0B");
    }

    protected function canon($str)
    {
        $str = strtolower($this->trim($str));

        $str = preg_replace('~ +~', ' ', $str);
        $str = preg_replace('~í~i', 'i', $str);
        $str = preg_replace('~Í~i', 'i', $str);

        return $str;
    }

    protected function getOldId($row, $entity)
    {
        return strval($row['id']);
    }

    protected function getNewId($class, $oldId)
    {
        $oldId = strval($oldId);
        if (!array_key_exists( $oldId, $this->migradores[$class]->ids)) {
            return null;
        }
        return $this->migradores[$class]->ids[$oldId]->getId();
    }

    public function getClass()
    {
        return $this->class;
    }
}