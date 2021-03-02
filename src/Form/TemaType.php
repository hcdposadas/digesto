<?php

namespace App\Form;

use App\Entity\Tema;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TemaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', TextType::class, array(
                'required' => true,
                'label' => 'Título',
            ))
            ->add('descripcion', TextareaType::class, array(
                'required' => false,
                'label' => 'Descripción',
            ))
            ->add('rama', TextType::class, array(
                'disabled' => true,
                'label' => 'Rama',
            ))
            ->add('temaPadre', TextType::class, array(
                'disabled' => true,
                'label' => 'Tema padre',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tema::class,
        ]);
    }
}
