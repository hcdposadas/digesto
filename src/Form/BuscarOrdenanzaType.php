<?php

namespace App\Form;

use App\Entity\Rama;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuscarOrdenanzaType extends AbstractType {
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'rama',
				EntityType::class,
				[
					'class'       => Rama::class,
					'label'       => 'Rama',
					'placeholder' => 'Rama...'
				] )
			->add( 'numero',
				NumberType::class,
				[
					'label' => 'Número'
				] )
			->add( 'anio',
				TextType::class,
				[
					'label' => 'Año'
				] )
			->add( 'palabra',
				TextType::class,
				[
					'label' => 'Palabra'
				] );
	}

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			// Configure your form options here
			'required' => false
		] );
	}
}
