<?php

namespace App\Form;

use App\Entity\Caducidad;
use App\Entity\Consolidacion;
use App\Entity\Norma;
use App\Entity\Refundicion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class RefundicionActivaType extends AbstractType
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
            ->add('normaRefundida', Select2EntityType::class, [
                'class'         => Norma::class,
                'remote_route'  => 'get_normas',
                'allow_clear'   => false,
                'multiple'      => false,
                'language'      => 'es',
                'placeholder'   => 'Seleccione una norma',
                'minimum_input_length' => 1
            ])
            ->add('normaCompleta')
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
                $refundicion = new Refundicion();
                $refundicion->setConsolidacion($this->entityManager->getRepository(Consolidacion::class)->getConsolidacionEnCurso());
                return $refundicion;
            }
        ]);
    }
}
