<?php

namespace App\Controller;

use App\Entity\Consolidacion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConsolidacionesController extends AbstractController
{
    /**
     * @Route("/consolidaciones", name="consolidaciones")
     */
    public function index()
    {

        $consolidaciones = $this->getDoctrine()->getRepository(Consolidacion::class)->getActivas();

        return $this->render('consolidaciones/index.html.twig', [
            'consolidaciones' => $consolidaciones,
        ]);
    }

    /**
     * @Route("/consolidaciones/en_curso", name="consolidacion_en_curso")
     */
    public function enCurso()
    {
        $consolidacion = $this->getDoctrine()->getRepository(Consolidacion::class)->getConsolidacionEnCurso();
        return $this->redirectToRoute('consolidaciones_show', [ 'id' => $consolidacion->getId() ]);
    }

    /**
     * @Route("/consolidaciones/{id}", name="consolidaciones_show", methods={"GET"})
     */
    public function show(Consolidacion $consolidacion)
    {
        return $this->render('consolidaciones/show.html.twig', [
            'consolidacion' => $consolidacion,
        ]);
    }
}
