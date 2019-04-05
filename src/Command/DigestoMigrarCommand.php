<?php

namespace App\Command;

use App\Command\Migradores\MBeneficiario;
use App\Command\Migradores\MBeneficiarioNorma;
use App\Command\Migradores\MDescriptor;
use App\Command\Migradores\MDescriptorNorma;
use App\Command\Migradores\MIdentificador;
use App\Command\Migradores\MIdentificadorNorma;
use App\Command\Migradores\MNorma;
use App\Command\Migradores\MPalabraClave;
use App\Command\Migradores\MPalabraClaveNorma;
use App\Command\Migradores\MRama;
use App\Command\Migradores\MTipoBoletin;
use App\Command\Migradores\MTipoIdentificador;
use App\Command\Migradores\MTipoPromulgacion;
use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DigestoMigrarCommand extends Command
{

    protected $migradores = [
        MBeneficiario::class,
        MPalabraClave::class,
        MTipoIdentificador::class,
        MIdentificador::class,
        MDescriptor::class,
        MTipoPromulgacion::class,
        MTipoBoletin::class,
        MRama::class,
        MNorma::class,
        MIdentificadorNorma::class,
        MPalabraClaveNorma::class,
        MDescriptorNorma::class,
        MBeneficiarioNorma::class
    ];


    /**
     * @var RegistryInterface
     */
    protected $registry;
    protected static $defaultName = 'digesto:migrar';

    public function __construct(RegistryInterface $registry)
    {
        ini_set('memory_limit', -1);
        parent::__construct();
        $this->registry = $registry;
    }

    protected function configure()
    {
        $this
            ->setDescription('Migra las tablas del digesto viejo al nuevo')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        /** @var Connection $c */
		$conn = $this->registry->getConnection('digesto_viejo');
		$em = $this->registry->getEntityManager();


        $migradores = $this->migradores;

        $x = [];
        foreach ($migradores as $i => $migrador) {
            $x[$migrador] = new $migrador($conn, $em, $io);
        }
        $migradores = $x;

        // Truncar de atras para adelante
        $migradores = array_reverse($migradores, true);

        $i = 1;
        /** @var Migrador $migrador */
        foreach ($migradores as $migrador) {
            $io->block('('.$i.'/'.count($migradores).') Truncando '.$migrador->getClass());
            $migrador->truncate();
            $i++;
        }

        $migradores = array_reverse($migradores, true);

        $i = 1;
        /** @var Migrador $migrador */
        foreach ($migradores as $migrador) {
            $io->block('('.$i.'/'.count($migradores).') Migrando '.$migrador->getClass());
            $migrador->migrar($migradores);
            $i++;
        }

        $io->success('Ready!');
    }


}
