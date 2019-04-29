<?php

namespace App\Form;

use App\Entity\WebDigestoDocumento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class WebDigestoDocumentoType extends AbstractType {
	public function buildForm( FormBuilderInterface $builder, array $options ) {

		$builder
			->add( 'titulo' )
			->add( 'grupo' )
			->add( 'archivoDocumento',
				VichFileType::class,
				[
					'label'        => 'Texto',
					'required'     => false,
					'allow_delete' => true,
				] )
			->add( 'anexos',
				BootstrapCollectionType::class,
				[
					'entry_type'   => WebDigestoDocumentoAnexoType::class,
					'allow_add'    => true,
					'allow_delete' => true,
					'by_reference' => false,
					'label'        => 'Anexos'
				] );
	}

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			'data_class' => WebDigestoDocumento::class,
		] );
	}
}
