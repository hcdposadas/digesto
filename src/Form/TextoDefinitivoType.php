<?php

namespace App\Form;

use App\Entity\Caducidad;
use App\Entity\Consolidacion;
use App\Entity\TextoDefinitivo;
use Doctrine\ORM\EntityManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
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
            ->add('textoDefinitivo', CKEditorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TextoDefinitivo::class,
            'empty_data' => function (FormInterface $form) {
                $caducidad = new Caducidad();
                $caducidad->setConsolidacion($this->entityManager->getRepository(Consolidacion::class)->getConsolidacionEnCurso());
                return $caducidad;
            }
        ]);
    }
}
