<?php

namespace App\Form;

use App\Entity\AnexoNorma;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class AnexoNormaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('fecha',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'html5' => true,
                    'required'=> false
                ])
            ->add('archivoAnexo', VichFileType::class, [
                'required' => false,
                'allow_delete' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AnexoNorma::class,
        ]);
    }
}
