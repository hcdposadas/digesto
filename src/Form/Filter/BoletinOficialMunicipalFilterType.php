<?php

namespace App\Form\Filter;

use App\Entity\BoletinOficialMunicipal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class BoletinOficialMunicipalFilterType extends AbstractType {
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'numero' )
			->add( 'buscar',
				SubmitType::class,
				[
					'attr' => [ 'class' => 'btn btn-primary' ]
				] )
			->add( 'limpiar', ResetType::class );;
	}

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [

			'required'   => false
		] );
	}
}
