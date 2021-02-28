<?php

namespace App\Form;

use App\Entity\Descriptor;
use App\Entity\Identificador;
use App\Entity\Norma;
use App\Entity\PalabraClave;
use App\Entity\Rama;
use App\Entity\Tema;
use App\Entity\TipoBoletin;
use App\Entity\TipoEstadoNorma;
use App\Entity\TipoVeto;
use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class NormaType extends AbstractType {
	public function buildForm( FormBuilderInterface $builder, array $options ) {


		$descriptores    = $options['descriptores'];
		$identificadores = $options['identificadores'];
		$palabrasClaves  = $options['palabrasClave'];
        $temas  = $options['temas'];


        $aCDescriptor = null;
		foreach ( $descriptores as $descriptore ) {
			$aCDescriptor[] = $descriptore->getDescriptor();
		}

		$aCIdentificador = null;
		foreach ( $identificadores as $identificador ) {
			$aCIdentificador[] = $identificador->getIdentificador();
		}

		$aCPalabraClave = null;
		foreach ( $palabrasClaves as $palabraClave ) {
			$aCPalabraClave[] = $palabraClave->getPalabraClave();
		}
        $aCtema = null;
        foreach ( $temas as $tema ) {
            $aCtema[] = $tema->getTema();
        }


		$builder
            ->add('estado', EntityType::class, [
                'class' => TipoEstadoNorma::class
            ])

			->add( 'rama',
				EntityType::class,
				[
					'class'         => Rama::class,
					'query_builder' => function ( EntityRepository $er ) {
						return $er->createQueryBuilder( 'r' )
						          ->orderBy( 'r.orden', 'ASC' );
					},
				] )
			->add( 'ramaVigenteNoConsolidada',
				EntityType::class,
				[
					'class'         => Rama::class,
					'query_builder' => function ( EntityRepository $er ) {
						return $er->createQueryBuilder( 'r' )
						          ->orderBy( 'r.orden', 'ASC' );
					},
				] )
			->add( 'fechaSancion',
				DateType::class,
				[
					'widget' => 'single_text',
					'html5'  => true
				] )
			->add( 'temaGeneral' )
			->add( 'numero' )
			->add( 'paginaBoletin' )
			->add( 'numeroBoletin' )
			->add( 'observacion' )
			->add( 'decretoPromulgatorio' )
			->add( 'fechaPromulgacion',
				DateType::class,
				[
					'widget'   => 'single_text',
					'html5'    => true,
					'required' => false
				] )
			->add( 'tipoPromulgacion' )
            ->add( 'tipoVeto',
                EntityType::class,
                [
                    'required' => false,
                    'class' => TipoVeto::class,
                    'attr'  => [ 'class' => 'tipo-veto' ],
                    'label' => 'Veto'
                ])
            ->add('observacionesVeto',
                CKEditorType::class,
                [
                    'label'  => 'Observaciones Veto',
                    'config' => [ 'uiColor' => '#ffffff' ],
                    'attr'  => [ 'class' => 'observaciones-veto' ],
                ] )
			->add( 'tipoOrdenanza' )
			->add( 'numeroAnterior' )
			->add( 'tipoBoletin',
				EntityType::class,
				[
					'class' => TipoBoletin::class,
					'attr'  => [ 'class' => 'tipo-boletin' ]

				] )
			->add( 'fechaPublicacionBoletin',
				DateType::class,
				[
					'widget'   => 'single_text',
					'html5'    => true,
					'required' => false
				] )
			->add( 'boletinOficialMunicipal' )
			->add( 'anexos',
				BootstrapCollectionType::class,
				[
					'entry_type'   => AnexoNormaType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false,
					'label'        => 'Anexos'
				] )
            ->add( 'anexosOriginales',
                BootstrapCollectionType::class,
                [
                    'entry_type'   => AnexoOriginalNormaType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label'        => 'Anexos Originales'
                ] )
			->add( 'descriptores',
				Select2EntityType::class,
				[
					'class'         => Descriptor::class,
					'text_property' => 'nombre',
					'remote_route'  => 'get_descriptores',
					'allow_clear'   => false,
					'multiple'      => true,
					'language'      => 'es',
					'mapped'        => false,
					'data'          => $aCDescriptor
				] )
			->add( 'identificadores',
				Select2EntityType::class,
				[
					'class'         => Identificador::class,
					'text_property' => 'nombre',
					'remote_route'  => 'get_identificadores',
					'allow_clear'   => false,
					'multiple'      => true,
					'language'      => 'es',
					'mapped'        => false,
					'data'          => $aCIdentificador
				] )
			->add( 'palabrasClave',
				Select2EntityType::class,
				[
					'class'         => PalabraClave::class,
					'text_property' => 'nombre',
					'remote_route'  => 'get_palabras_clave',
					'allow_clear'   => false,
					'multiple'      => true,
					'language'      => 'es',
					'mapped'        => false,
					'data'          => $aCPalabraClave

				] )
            ->add( 'temas',
                Select2EntityType::class,
                [
                    'label'         => 'Índice Temático Básico',
                    'class'         => Tema::class,
                    'text_property' => 'titulo',
                    'remote_route'  => 'get_temas',
                    'allow_clear'   => false,
                    'multiple'      => true,
                    'language'      => 'es',
                    'mapped'        => false,
                    'data'          => $aCtema

                ] )
			->add( 'beneficiarioNormas',
				BootstrapCollectionType::class,
				[
					'entry_type'   => BeneficiarioNormaType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false,
					'label'        => 'Beneficiarios'
				] )
			->add( 'texto',
				CKEditorType::class,
				[
					'label'  => 'Texto',
					'config' => [ 'uiColor' => '#ffffff' ]
				] )
            ->add(
                'cambiosNormas',
                BootstrapCollectionType::class,
                [
                    'entry_type'   => CambioNormaType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label'        => 'Tabla de Antecedentes'
                ]
            )
            ->add(
                'articulosSuprimidos',
                BootstrapCollectionType::class,
                [
                    'entry_type'   => ArticuloSuprimidoType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label'        => 'Artículos Suprimidos'
                ]
            )
            ->add(
                'cambiosAnexos',
                BootstrapCollectionType::class,
                [
                    'entry_type'   => CambioAnexoType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label'        => 'Antecedentes de los anexos'
                ]
            )
            ->add(
                'observacionAntecedente', ObservacionAntecedenteType::class
            )
            ->add(
                'fundamentacion', FundamentacionType::class
            )
			->add(
				'adhesiones',
				BootstrapCollectionType::class,
				[
					'entry_type'   => AdhesionType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false,
					'label'        => 'Adhesiones'
				]
			)

			->add(
				'abrogaciones',
				BootstrapCollectionType::class,
				[
					'entry_type'   => AbrogacionPasivaType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false,
					'label'        => 'Abrogaciones (pasiva)'
				]
			)
            ->add(
                'abrogadas',
                BootstrapCollectionType::class,
                [
                    'entry_type'   => AbrogacionActivaType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label'        => 'Abrogaciones (activa)'
                ]
            )

			->add(
				'caducidades',
				BootstrapCollectionType::class,
				[
					'entry_type'   => CaducidadType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false,
					'label'        => 'Caducidades'
				]
			)

            ->add(
                'conflictosConNormas',
                BootstrapCollectionType::class,
                [
                    'entry_type'   => ConflictoNormativoActivaType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label'        => 'Conflictos Normativos (activa)'
                ]
            )

			->add(
				'conflictosNormativos',
				BootstrapCollectionType::class,
				[
					'entry_type'   => ConflictoNormativoPasivaType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false,
					'label'        => 'Conflictos Normativos (pasiva)'
				]
			)

			->add(
				'refundiciones',
				BootstrapCollectionType::class,
				[
					'entry_type'   => RefundicionActivaType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false,
					'label'        => 'Refundiciones (activa)'
				]
			)
            ->add(
                'refundidas',
                BootstrapCollectionType::class,
                [
                    'entry_type'   => RefundicionPasivaType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label'        => 'Refundiciones (pasiva)'
                ]
            )

            ->add('textoDefinitivoNoConsolidado', TextoDefinitivoType::class, [
                'show_consolidacion' => false
            ])

			->add( 'archivoNorma',
				VichFileType::class,
				[
					'required'     => false,
					'allow_delete' => true,
					'label'        => 'Texto'
				] )

			->add( 'activo' )
			->add( 'vigenteNoConsolidada' );
	}

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			'data_class'      => Norma::class,
			'csrf_protection' => false,
			'descriptores'    => [],
			'identificadores' => [],
			'palabrasClave'   => [],
            'temas'           => [],
		] );
	}
}
