<?php

namespace App\Controller;

use App\Entity\Consolidacion;
use App\Entity\Norma;
use App\Entity\Rama;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
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
        $consolidacionRepository = $this->getDoctrine()->getRepository(Consolidacion::class);
        $consolidacion = $consolidacionRepository->getConsolidacionEnCurso();
        return $this->redirectToRoute('consolidaciones_show', [ 'id' => $consolidacion->getId() ]);
    }

    /**
     * @Route("/consolidaciones/{id}", name="consolidaciones_show", methods={"GET"})
     */
    public function show(Consolidacion $consolidacion)
    {
        $consolidacionRepository = $this->getDoctrine()->getRepository(Consolidacion::class);

        $anexoA = $consolidacionRepository->getAnexoA($consolidacion);
        $anexoB = $consolidacionRepository->getAnexoB($consolidacion);
        $anexoC = $consolidacionRepository->getAnexoC($consolidacion);
        $anexoD = $consolidacionRepository->getAnexoD($consolidacion);
        $anexoE = $consolidacionRepository->getAnexoE($consolidacion);
        $anexoF = $consolidacionRepository->getAnexoF($consolidacion);
        $anexoG = $consolidacionRepository->getAnexoG($consolidacion);
        $anexoH = $consolidacionRepository->getAnexoH($consolidacion);

        return $this->render('consolidaciones/show.html.twig', [
            'consolidacion' => $consolidacion,
            'anexoA' => $anexoA,
            'anexoB' => $anexoB,
            'anexoC' => $anexoC,
            'anexoD' => $anexoD,
            'anexoE' => $anexoE,
            'anexoF' => $anexoF,
            'anexoG' => $anexoG,
            'anexoH' => $anexoH,
        ]);
    }

    /**
     * @Route("/consolidaciones/{consolidacion}/a", name="consolidaciones_pdf_anexo_a", methods={"GET"})
     */
    public function pdfAnexoA(Consolidacion $consolidacion, \Knp\Snappy\Pdf $snappy)
    {
        $consolidacionRepository = $this->getDoctrine()->getRepository(Consolidacion::class);

        $anexoA = $consolidacionRepository->getAnexoA($consolidacion);

        $html = $this->renderView('consolidaciones/anexo-a.pdf.twig', array(
            'consolidacion' => $consolidacion,
            'anexoA'  => $anexoA
        ));

        return new PdfResponse(
            $snappy->getOutputFromHtml($html),
            'Consolidacion '.$consolidacion->getAnio().' - Anexo A'.($consolidacion->isEnCurso() ? ' - Provisorio' : '').'.pdf',
            'application/pdf',
            'inline'
        );
    }

    /**
     * @Route("/consolidaciones/{consolidacion}/b", name="consolidaciones_pdf_anexo_b", methods={"GET"})
     */
    public function pdfAnexoB(Consolidacion $consolidacion, \Knp\Snappy\Pdf $snappy)
    {
        $consolidacionRepository = $this->getDoctrine()->getRepository(Consolidacion::class);

        $normas = $consolidacionRepository->getAnexoB($consolidacion);

        $anexoB = array();
        foreach ($normas as $norma) {
            $orden = $norma->getRama()->getOrden();
            if (!array_key_exists($orden, $anexoB)) {
                $anexoB[$orden] = array(
                    'rama' => $norma->getRama(),
                    'normas' => array()
                );
            }

            $anexoB[$orden]['normas'][] = $norma;
        }


        $html = $this->renderView('consolidaciones/anexo-b.pdf.twig', array(
            'consolidacion' => $consolidacion,
            'anexoB'  => $anexoB
        ));

        return new PdfResponse(
            $snappy->getOutputFromHtml($html, [
                'margin-top'    => 25,
                'margin-right'  => 25,
                'margin-bottom' => 25,
                'margin-left'   => 25,
            ]),
            'Consolidacion '.$consolidacion->getAnio().' - Anexo B'.($consolidacion->isEnCurso() ? ' - Provisorio' : '').'.pdf',
            'application/pdf',
            'inline'
        );
    }
}
