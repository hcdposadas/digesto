<?php

namespace App\Form;

use App\Entity\Adhesion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdhesionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo', ChoiceType::class, [
				'choices' => [
					'Ley Nacional' => 'ley-nacional',
					'Decreto Nacional' => 'decreto-provincial',
					'Ley Provincial' => 'ley-provincial',
					'Decreto Provincial' => 'decreto-provincial',

				]
            ])
            ->add('adhesion', TextType::class, [
                'label' => 'Norma a la que adhiere'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adhesion::class,
        ]);
    }
}
