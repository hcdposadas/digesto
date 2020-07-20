<?php

namespace App\Form;

use App\Entity\EstadoNorma;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstadoNormaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activo')
            ->add('fechaCreacion')
            ->add('fechaActualizacion')
            ->add('norma')
            ->add('consolidacion')
            ->add('estado')
            ->add('creadoPor')
            ->add('actualizadoPor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EstadoNorma::class,
        ]);
    }
}
