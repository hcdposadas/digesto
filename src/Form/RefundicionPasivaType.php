<?php

namespace App\Form;

use App\Entity\Consolidacion;
use App\Entity\Norma;
use App\Entity\Refundicion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class RefundicionPasivaType extends AbstractType
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
            ->add('normaCompleta', CheckboxType::class, [
                'label' => 'Completa',
                'help' => 'Tildar si la refundición aplica a la norma completa',
                'required' => false
            ])
            ->add('articuloRefundido', TextType::class, [
                'label' => 'Artículo refundido',
                'required' => false
            ])
            ->add('articuloAnexoRefundido', TextType::class, [
                'label' => 'Artículo anexo refundido',
                'required' => false
            ])
            ->add('norma', Select2EntityType::class, [
                'class'         => Norma::class,
                'remote_route'  => 'get_normas',
                'allow_clear'   => false,
                'multiple'      => false,
                'language'      => 'es',
                'placeholder'   => 'Seleccione una norma',
                'minimum_input_length' => 1,
                'width' => 300
            ])
            ->add('articulo', TextType::class, [
                'label' => 'Artículo',
                'required' => false
            ])
            ->add('articuloAnexo', TextType::class, [
                'label' => 'Artículo del anexo',
                'required' => false
            ])
            ->add('fundamentacion', TextareaType::class, [
                'label' => 'Fundamentación',
                'attr' => array('style' => 'width: 125px;height:400px')
            ])
            ->add('observaciones', TextareaType::class, [
                'label' => 'Observaciones',
                'required' => false,
                'attr' => array('style' => 'width: 125px;height:400px')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Refundicion::class,
            'empty_data' => function (FormInterface $form) {
                $class = $form->getConfig()->getOption('data_class');
                $entity = new $class();
                $entity->setConsolidacion($this->entityManager->getRepository(Consolidacion::class)->getConsolidacionEnCurso());
                return $entity;
            }
        ]);
    }
}
