<?php

namespace App\Form;

use App\Entity\Refundicion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefundicionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('articulo')
            ->add('articuloAnexo')
            ->add('normaCompleta')
            ->add('normaRefundida')
            ->add('articuloRefundido')
            ->add('articuloAnexoRefundido')
            ->add('fundamentacion')
            ->add('observaciones')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Refundicion::class,
        ]);
    }
}
