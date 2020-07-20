<?php

namespace App\Form;

use App\Entity\Abrogacion;
use App\Entity\Caducidad;
use App\Entity\Consolidacion;
use App\Entity\Norma;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class AbrogacionPasivaType extends AbstractType
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
			->add('normaAbrogante', Select2EntityType::class, [
                    'class'         => Norma::class,
                    'remote_route'  => 'get_normas',
                    'allow_clear'   => false,
                    'multiple'      => false,
                    'language'      => 'es',
                    'placeholder'   => 'Seleccione una norma',
                    'minimum_input_length' => 1
            ])
			->add('articuloAbrogante', TextType::class, [
				'label' => 'Artículo',
				'required' => false
			])
            ->add('anexoAbrogante', TextType::class, [
				'label' => 'Anexo',
				'required' => false
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
            'data_class' => Abrogacion::class,
            'empty_data' => function (FormInterface $form) {
                $class = $form->getConfig()->getOption('data_class');
                $entity = new $class();
                $entity->setConsolidacion($this->entityManager->getRepository(Consolidacion::class)->getConsolidacionEnCurso());
                return $entity;
            }
        ]);
    }
}
