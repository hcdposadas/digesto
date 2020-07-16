<?php

namespace App\Form;

use App\Entity\CambioNorma;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CambioNormaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'fecha',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'html5' => true,
                    'required' => false
                ]
            )
            ->add('articulo', TextType::class, [
                'label' => 'Artículo del Texto Definitivo'
            ])
            ->add('fuente', TextareaType::class, [
                'label' => 'Fuente'
            ])
            ->add('remisionExterna', TextareaType::class, [
                'label' => 'Remisión Externa'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CambioNorma::class,
        ]);
    }
}
