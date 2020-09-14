<?php

namespace App\Form;

use App\Entity\Caducidad;
use App\Entity\Consolidacion;
use App\Entity\TipoCaducidad;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaducidadType extends AbstractType
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
                'help' => 'Tildar si la caducidad aplica a la norma completa',
                'required' => false
            ])
            ->add('articulo', TextType::class, [
                'label' => 'Artículo',
                'required' => false
            ])
            ->add('articuloAnexo', TextType::class, [
                'label' => 'Artículo del anexo',
                'required' => false
            ])
            ->add('tipoCaducidad', EntityType::class, [
                'label' => 'Tipo de Caducidad',
                'class' => TipoCaducidad::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nombre', 'ASC')
                        ->where('u.activo = true');
                }
            ])
            ->add('fundamentacion', TextType::class, [
                'label' => 'Fundamentación'
            ])
            ->add('observaciones', TextType::class, [
                'label' => 'Observaciones',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Caducidad::class,
            'empty_data' => function (FormInterface $form) {
                $caducidad = new Caducidad();
                $caducidad->setConsolidacion($this->entityManager->getRepository(Consolidacion::class)->getConsolidacionEnCurso());
                return $caducidad;
            }
        ]);
    }
}
