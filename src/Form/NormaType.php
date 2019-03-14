<?php

namespace App\Form;

use App\Entity\Norma;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\BootstrapCollectionType;

class NormaType extends AbstractType {
	public function buildForm( FormBuilderInterface $builder, array $options ) {
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
			->add( 'observacion' )
			->add( 'decretoPromulgatorio' )
			->add( 'fechaPromulgacion',
				DateType::class,
				[
					'widget' => 'single_text',
					'html5'  => true
				] )
			->add( 'tipoPromulgacion' )

			->add( 'tipoBoletin' )
			->add('anexos', BootstrapCollectionType::class, [
				'entry_type'   => AnexoNormaType::class,
				'allow_add'    => true,
				'allow_delete' => true,
				'by_reference' => false,
				'label'        => 'Anexos'
			])
			->add('descriptoresNorma')
			->add('palabrasClaveNorma')
			->add('beneficiarioNormas', BootstrapCollectionType::class, [
				'entry_type'   => BeneficiarioNormaType::class,
				'allow_add'    => true,
				'allow_delete' => true,
				'by_reference' => false,
				'label'        => 'Beneficiarios'
			])
			->add('identificadoresNorma')
			->add( 'activo' );
	}

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			'data_class' => Norma::class,
		] );
	}
}
