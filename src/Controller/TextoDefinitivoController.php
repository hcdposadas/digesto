<?php

namespace App\Controller;

use App\Entity\Consolidacion;
use App\Entity\Norma;
use App\Entity\TextoDefinitivo;
use App\Form\TextoDefinitivoType;
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
     * @Route("/delete", name="texto_definitivo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TextoDefinitivo $textoDefinitivo): Response
    {
//        if ($this->isCsrfTokenValid('delete'.$textoDefinitivo->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($textoDefinitivo);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('texto_definitivo_index');
    }
}
