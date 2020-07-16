<?php

namespace App\Form;

use App\Entity\ConflictoNormativo;
use App\Entity\TipoSolucionConflicto;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('tipoSolucion', EntityType::class, [
                'class' => TipoSolucionConflicto::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nombre', 'ASC')
                        ->where('u.activo = true');
                }
            ])
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
