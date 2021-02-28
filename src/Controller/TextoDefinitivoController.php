<?php

namespace App\Controller;

use App\Entity\Consolidacion;
use App\Entity\Norma;
use App\Entity\TextoDefinitivo;
use App\Form\TextoDefinitivoType;
use App\Repository\ConsolidacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administrador/norma/{norma}/textoDefinitivo")
 */
class TextoDefinitivoController extends AbstractController
{
    private function getTextoDefinitivoNoConsolidado(Norma $norma): TextoDefinitivo
    {
        $textoDefinitivo = $norma->getTextoDefinitivoNoConsolidado();
        if ($textoDefinitivo) {
            return $textoDefinitivo;
        }

        $em = $this->getDoctrine()->getManager();
        $textoDefinitivo = new TextoDefinitivo();
        $textoDefinitivo->setConsolidacion(
            $this->getDoctrine()->getRepository(Consolidacion::class)->getConsolidacionEnCurso()
        );
        $textoDefinitivo->setTextoDefinitivo('');
        $norma->addTextosDefinitivo($textoDefinitivo);

        $em->persist($norma);
        $em->flush();

        return $textoDefinitivo;
    }

    /**
     * @Route("/consolidado", name="texto_definitivo_consolidado_show", methods={"GET"})
     */
    public function showTextoDefinitivoConsolidado (Request $request, Norma $norma): Response
    {
        $textoDefinitivo = $norma->getTextoDefinitivoConsolidado();

        return $this->render('texto_definitivo/show.html.twig', [
            'texto_definitivo' => $textoDefinitivo,
            'norma' => $norma
        ]);
    }

    /**
     * @Route("/show/{textoDefinitivo}", name="texto_definitivo_consolidado_show_id", methods={"GET"})
     */
    public function showTextoDefinitivoConsolidadoId (Request $request, TextoDefinitivo $textoDefinitivo): Response
    {
        return $this->render('texto_definitivo/show.html.twig', [
            'texto_definitivo' => $textoDefinitivo,
            'norma' => $textoDefinitivo->getNorma()
        ]);
    }

    /**
     * @Route("/consolidado/cargar", name="texto_definitivo_consolidado_create", methods={"GET","POST"})
     */
    public function createTextoConsolidado (Request $request, Norma $norma): Response
    {
        $textoDefinitivo = $norma->getTextoDefinitivoConsolidado();
        if ($textoDefinitivo ) {
            throw new \Exception('La norma ya cuanta con texto consolidado. No se puede cargar uno nuevo.');
        }

        $ultimaConsolidacion = $this->getDoctrine()->getRepository(Consolidacion::class)->getUltimaConsolidacion();

        $textoDefinitivo = new TextoDefinitivo();
        $textoDefinitivo->setNorma($norma);
        $textoDefinitivo->setConsolidacion($ultimaConsolidacion);
        $form = $this->createForm(TextoDefinitivoType::class, $textoDefinitivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($textoDefinitivo);
            $em->flush();

            $this->get( 'session' )->getFlashBag()->add(
                'success',
                'Texto consolidado cargado correctamente'
            );


            return $this->redirectToRoute('norma_edit', [
                'id' => $norma->getId()
            ]);
        }

        return $this->render('texto_definitivo/new.html.twig', [
            'norma' => $norma,
            'form' => $form->createView(),
            'ultimaConsolidacion' => $ultimaConsolidacion
        ]);
    }

    /**
     * @Route("/edit", name="texto_definitivo_no_consolidado_editar", methods={"GET","POST"})
     */
    public function editTextoNoConsolidado (Request $request, Norma $norma): Response
    {
        $textoDefinitivo = $this->getTextoDefinitivoNoConsolidado($norma);

        $form = $this->createForm(TextoDefinitivoType::class, $textoDefinitivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('norma_edit', [
                'id' => $norma->getId()
            ]);
        }

        return $this->render('texto_definitivo/edit.html.twig', [
            'texto_definitivo' => $textoDefinitivo,
            'norma' => $norma,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete", name="texto_definitivo_delete", methods={"GET"})
     */
    public function delete(Request $request, Norma $norma): Response
    {
        $textoDefinitivo = $this->getTextoDefinitivoNoConsolidado($norma);
        $textoDefinitivo->setTextoDefinitivo('');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($textoDefinitivo);
        $entityManager->flush();

        return $this->redirectToRoute('norma_edit', array(
            'id' => $norma->getId(),
            '_fragment' => 'anchorTextoDefinitivo'
        ));
    }

    /**
     * @Route("/copiar/{textoDefinitivoOrigen}", name="texto_definitivo_copiar", methods={"GET"})
     */
    public function copiar (Request $request, Norma $norma, TextoDefinitivo $textoDefinitivoOrigen): Response
    {
        $norma->getTextoDefinitivoNoConsolidado()->setTextoDefinitivo($textoDefinitivoOrigen->getTextoDefinitivo());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($norma);
        $entityManager->flush();

        return $this->redirectToRoute('norma_edit', array(
            'id' => $norma->getId(),
            '_fragment' => 'anchorTextoDefinitivo'
        ));
    }
}
