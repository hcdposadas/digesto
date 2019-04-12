<?php

namespace App\Form;

use App\Entity\Norma;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\BootstrapCollectionType;

class NormaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rama')
            ->add('ramaVigenteNoConsolidada')
            ->add('fechaSancion',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'html5' => true
                ])
            ->add('temaGeneral')
            ->add('numero')
            ->add('paginaBoletin')
            ->add('observacion')
            ->add('decretoPromulgatorio')
            ->add('fechaPromulgacion',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'html5' => true
                ])
            ->add('tipoPromulgacion')
            ->add('tipoBoletin')
            ->add('anexos', BootstrapCollectionType::class, [
                'entry_type' => AnexoNormaType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Anexos'
            ])
            ->add('descriptoresNorma', CollectionType::class, [
                'entry_type' => DescriptorNormaType::class,
                'entry_options' => [
                    'label' => false,
                    'by_reference' => false,
                ],
                'allow_add' => true
            ])
            ->add('palabrasClaveNorma', CollectionType::class, [
                'entry_type' => PalabraClaveNormaType::class,
                'entry_options' => [
                    'label' => false,
                    'by_reference' => false,
                ],
                'allow_add' => true
            ])
            ->add('beneficiarioNormas', BootstrapCollectionType::class, [
                'entry_type' => BeneficiarioNormaType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Beneficiarios'
            ])
            ->add('identificadoresNorma', CollectionType::class, [
                'entry_type' => IdentificadorNormaType::class,
                'entry_options' => [
                    'label' => false,
                    'by_reference' => false,
                ],
                'allow_add' => true
            ])
            ->add('activo');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Norma::class,
        ]);
    }
}
