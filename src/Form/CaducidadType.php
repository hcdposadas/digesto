<?php

namespace App\Form;

use App\Entity\Caducidad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaducidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('normaCompleta')
            ->add('articulo')
            ->add('articuloAnexo')
            ->add('causal', ChoiceType::class, [
				'choices' => [
					'Plazo vencido' => 'plazo-vencido',
					'Objetivo cumplido' => 'objetivo-cumplido',
					'Cumplimiento de la condición' => 'cumplimiento-condicion',
					'Refundición' => 'refundicion',
				]
			])
            ->add('fundamentacion')
            ->add('observaciones')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Caducidad::class,
        ]);
    }
}
