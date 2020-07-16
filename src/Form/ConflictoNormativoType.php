<?php

namespace App\Form;

use App\Entity\ConflictoNormativo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConflictoNormativoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('normaCompleta')
            ->add('articulo')
            ->add('articuloAnexo')
			->add('conflictoConNorma')
            ->add('articuloConflicto')
            ->add('articuloAnexoConflicto')
            ->add('solucionAdoptada')
            ->add('fundamentacion')
            ->add('observaciones')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ConflictoNormativo::class,
        ]);
    }
}
