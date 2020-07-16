<?php

namespace App\Form;

use App\Entity\Abrogacion;
use App\Entity\Caducidad;
use App\Entity\Consolidacion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbrogacionType extends AbstractType
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
            	'label' => 'Completa'
			])
            ->add('articulo', TextType::class, [
				'label' => 'Artículo',
				'required' => false
			])
            ->add('articuloAnexo', TextType::class, [
            	'label' => 'Artículo del anexo',
				'required' => false
			])
			->add('normaAbrogante')
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
            ->add('observaciones')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Abrogacion::class,
            'empty_data' => function (FormInterface $form) {
                $caducidad = new Caducidad();
                $caducidad->setConsolidacion($this->entityManager->getRepository(Consolidacion::class)->getConsolidacionEnCurso());
                return $caducidad;
            }
        ]);
    }
}
