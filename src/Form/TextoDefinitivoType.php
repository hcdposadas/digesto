<?php

namespace App\Form;

use App\Entity\Caducidad;
use App\Entity\Consolidacion;
use App\Entity\TextoDefinitivo;
use Doctrine\ORM\EntityManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextoDefinitivoType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('textoDefinitivo', CKEditorType::class, array(
                'label'  => 'Texto Definitivo',
                'config' => ['uiColor' => '#ffffff']
            ));

        if ($options['show_consolidacion']) {
            $builder
                ->add('consolidacion', EntityType::class, array(
                    'label' => 'Consolidación',
                    'class' => Consolidacion::class
                ));
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TextoDefinitivo::class,
            'empty_data' => function (FormInterface $form) {
                $class = $form->getConfig()->getOption('data_class');
                $entity = new $class();
                $entity->setConsolidacion($this->entityManager->getRepository(Consolidacion::class)->getConsolidacionEnCurso());
                return $entity;
            },
            'show_consolidacion' => true,
        ]);

        $resolver->setAllowedTypes('show_consolidacion', 'bool');
    }
}
