<?php

namespace App\Form;

use App\Entity\Abrogacion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbrogacionType extends AbstractType
{
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
        ]);
    }
}
