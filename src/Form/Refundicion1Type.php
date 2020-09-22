<?php

namespace App\Form;

use App\Entity\Refundicion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Refundicion1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('articulo')
            ->add('articuloAnexo')
            ->add('normaCompleta')
            ->add('articuloRefundido')
            ->add('articuloAnexoRefundido')
            ->add('fundamentacion')
            ->add('observaciones')
            ->add('activo')
            ->add('fechaCreacion')
            ->add('fechaActualizacion')
            ->add('consolidacion')
            ->add('norma')
            ->add('normaRefundida')
            ->add('creadoPor')
            ->add('actualizadoPor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Refundicion::class,
        ]);
    }
}
