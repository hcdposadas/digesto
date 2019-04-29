<?php

namespace App\Form;

use App\Entity\WebDigestoDocumentoAnexo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class WebDigestoDocumentoAnexoType extends AbstractType {
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'titulo' )
			->add( 'archivoDocumentoAnexo',
				VichFileType::class,
				[
					'required'     => false,
					'allow_delete' => true
				] )
			->add( 'activo' );
	}

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			'data_class' => WebDigestoDocumentoAnexo::class,
		] );
	}
}
