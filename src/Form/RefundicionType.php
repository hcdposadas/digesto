<?php

namespace App\Form;

use App\Entity\Caducidad;
use App\Entity\Consolidacion;
use App\Entity\Refundicion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefundicionType extends AbstractType
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
            'empty_data' => function (FormInterface $form) {
                $caducidad = new Caducidad();
                $caducidad->setConsolidacion($this->entityManager->getRepository(Consolidacion::class)->getConsolidacionEnCurso());
                return $caducidad;
            }
        ]);
    }
}
