<?php

namespace App\Form;

use App\Entity\Caducidad;
use App\Entity\ConflictoNormativo;
use App\Entity\Consolidacion;
use App\Entity\TipoSolucionConflicto;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConflictoNormativoType extends AbstractType
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
			->add('normaCompleta')
            ->add('articulo')
            ->add('articuloAnexo')
			->add('conflictoConNorma')
            ->add('articuloConflicto')
            ->add('articuloAnexoConflicto')
            ->add('tipoSolucion', EntityType::class, [
                'class' => TipoSolucionConflicto::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nombre', 'ASC')
                        ->where('u.activo = true');
                }
            ])
            ->add('fundamentacion')
            ->add('observaciones')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ConflictoNormativo::class,
            'empty_data' => function (FormInterface $form) {
                $caducidad = new Caducidad();
                $caducidad->setConsolidacion($this->entityManager->getRepository(Consolidacion::class)->getConsolidacionEnCurso());
                return $caducidad;
            }
        ]);
    }
}
