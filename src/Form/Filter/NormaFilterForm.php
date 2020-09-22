<?php


namespace App\Form\Filter;

use App\Entity\Descriptor;
use App\Entity\Identificador;
use App\Entity\PalabraClave;
use App\Entity\Rama;
use App\Entity\TipoEstadoNorma;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;


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
			->add( 'decretoPromulgatorio' )
            ->add( 'estado', EntityType::class, [
                'empty_data' => null,
                'required' => false,
                'class' => TipoEstadoNorma::class
            ])
			->add( 'descriptores',
				Select2EntityType::class,
				[
					'class'         => Descriptor::class,
					'text_property' => 'nombre',
					'remote_route'  => 'get_descriptores',
					'allow_clear'   => false,
					'multiple'      => true,
					'language'      => 'es',
//					'mapped'        => false,
//					'data'          => $aCDescriptor
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
//					'mapped'        => false,
//					'data'          => $aCIdentificador
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
//					'mapped'        => false,
//					'data'          => $aCPalabraClave

				] )
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
