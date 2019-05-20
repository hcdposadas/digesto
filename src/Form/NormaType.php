<?php

namespace App\Form;

use App\Entity\Descriptor;
use App\Entity\Identificador;
use App\Entity\Norma;
use App\Entity\PalabraClave;
use App\Entity\TipoBoletin;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\BootstrapCollectionType;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class NormaType extends AbstractType {
	public function buildForm( FormBuilderInterface $builder, array $options ) {


		$descriptores    = $options['descriptores'];
		$identificadores = $options['identificadores'];
		$palabrasClaves  = $options['palabrasClave'];

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


		$builder
			->add( 'rama' )
			->add( 'ramaVigenteNoConsolidada' )
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
			->add( 'tipoOrdenanza' )
			->add( 'numeroAnterior' )
			->add( 'tipoBoletin',
				EntityType::class,
				[
					'class' => TipoBoletin::class,
					'attr'  => [ 'class' => 'tipo-boletin' ]

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
			'descriptores'    => [],
			'identificadores' => [],
			'palabrasClave'   => [],
		] );
	}
}
