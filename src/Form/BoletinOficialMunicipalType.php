<?php

namespace App\Form;

use App\Entity\BoletinOficialMunicipal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class BoletinOficialMunicipalType extends AbstractType {
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'numero' )
			->add( 'fechaPublicacion',
				DateType::class,
				[
					'widget'   => 'single_text',
					'html5'    => true,
					'required' => false
				] )
			->add( 'paginas' )
			->add( 'archivoBoletin', VichFileType::class )
			->add( 'activo' );
	}

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			'data_class' => BoletinOficialMunicipal::class,
		] );
	}
}
