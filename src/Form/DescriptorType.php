<?php

namespace App\Form;

use App\Entity\Descriptor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DescriptorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('activo')
            ->add('fechaCreacion')
            ->add('fechaActualizacion')
            ->add('creadoPor')
            ->add('actualizadoPor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Descriptor::class,
        ]);
    }
}
