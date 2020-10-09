<?php

namespace App\Form;

use App\Entity\CambioAnexo;
use App\Entity\Consolidacion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CambioAnexoType extends AbstractType
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
            ->add(
                'fecha',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'html5' => true,
                    'required' => false,
                    'disabled' => true
                ]
            )
            ->add('anexo', TextType::class, [
                'label' => 'Artículo del Anexo'
            ])
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descripción',
                'required'     => false,
                'attr' => [
                    'rows' => 5
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CambioAnexo::class,
            'empty_data' => function (FormInterface $form) {
                $class = $form->getConfig()->getOption('data_class');
                $entity = new $class();
                $entity->setConsolidacion($this->entityManager->getRepository(Consolidacion::class)->getConsolidacionEnCurso());
                return $entity;
            }
        ]);
    }
}
