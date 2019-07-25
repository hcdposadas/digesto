<?php

namespace App\Form;

use App\Entity\WebDigestoTexto;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class WebDigestoTextoType extends AbstractType {
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'presidenteHCD',
				null,
				[
					'label' => 'Presidente HCD'
				] )
			->add( 'archivoFotoPresidente',
				VichFileType::class,
				[
					'required'     => false,
					'allow_delete' => true,
					'label'        => 'Foto Presidente'
				] )
			->add( 'vicePresidentePrimeroHCD',
				null,
				[
					'label' => 'Vice Presidenta 1º HCD'
				] )
			->add( 'archivoFotoVicePresidentePrimero',
				VichFileType::class,
				[
					'required'     => false,
					'allow_delete' => true,
					'label'        => 'Foto Vicepresidente 1º'
				] )
			->add( 'vicePresidenteSegundoHCD',
				null,
				[
					'label' => 'Vice Presidente 2º HCD'
				] )
			->add( 'archivoFotoVicePresidenteSegundo',
				VichFileType::class,
				[
					'required'     => false,
					'allow_delete' => true,
					'label'        => 'Foto Vicepresidente 2º'
				] )
			->add( 'directorDigesto',
				null,
				[
					'label' => 'Director Digesto'
				] )
			->add( 'archivoFotoDirector',
				VichFileType::class,
				[
					'required'     => false,
					'allow_delete' => true,
					'label'        => 'Foto Director'
				] )
			->add( 'prologo',
				CKEditorType::class,
				[
					'label'  => 'Prólogo',
					'config' => [ 'uiColor' => '#ffffff' ]
				] )
			->add( 'resenia',
				CKEditorType::class,
				[
					'label'  => 'Reseña',
					'config' => [ 'uiColor' => '#ffffff' ]
				] )
			->add( 'metodologiaTrabajo',
				CKEditorType::class,
				[
					'label'  => 'Metodología de trabajo',
					'config' => [ 'uiColor' => '#ffffff' ]
				] )
			->add( 'renumeracion',
				CKEditorType::class,
				[
					'label'  => 'Remuneración',
					'config' => [ 'uiColor' => '#ffffff' ]
				] )
			->add( 'instructivoInformativo',
				CKEditorType::class,
				[
					'config' => [ 'uiColor' => '#ffffff' ]
				] )
			->add( 'contactoFacebook',
				null,
				[
					'label' => 'Facebook'
				] )
			->add( 'contactoInstagram',
				null,
				[
					'label' => 'Instagram'
				] )
			->add( 'contactoTwitter',
				null,
				[
					'label' => 'Twitter'
				] )
			->add( 'contactoMail',
				null,
				[
					'label' => 'Mail'
				] )
			->add( 'contactoTelefono',
				null,
				[
					'label' => 'Teléfono'
				] )
			->add( 'contactoDireccion',
				null,
				[
					'label' => 'Dirección'
				] )
			->add( 'contactoHorarioAtencion',
				null,
				[
					'label' => 'Horario de Atención'
				] );
	}

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			'data_class' => WebDigestoTexto::class,
		] );
	}
}
