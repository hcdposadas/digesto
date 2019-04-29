<?php


namespace App\Form\Filter;

use App\Entity\Rama;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class NormaFilterForm extends AbstractType {

	public function buildForm( FormBuilderInterface $builder, array $options ) {


		$builder
			->add( 'rama',
				EntityType::class,
				[
					'class'       => Rama::class,
					'placeholder' => 'Rama...'
				] )
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
			->add( 'texto' )
			->add( 'buscar',
				SubmitType::class,
				[
					'attr' => [ 'class' => 'btn btn-primary' ]
				] )
			->add( 'limpiar', ResetType::class );
	}

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			'required' => false

		] );
	}
}