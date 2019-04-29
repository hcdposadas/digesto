<?php

namespace App\Controller;

use App\Entity\WebDigestoDocumentoAnexo;
use App\Form\WebDigestoDocumentoAnexoType;
use App\Repository\WebDigestoDocumentoAnexoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/web/digesto/documento/anexo")
 */
class WebDigestoDocumentoAnexoController extends AbstractController
{
    /**
     * @Route("/", name="web_digesto_documento_anexo_index", methods={"GET"})
     */
    public function index(WebDigestoDocumentoAnexoRepository $webDigestoDocumentoAnexoRepository): Response
    {
        return $this->render('web_digesto_documento_anexo/index.html.twig', [
            'web_digesto_documento_anexos' => $webDigestoDocumentoAnexoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="web_digesto_documento_anexo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $webDigestoDocumentoAnexo = new WebDigestoDocumentoAnexo();
        $form = $this->createForm(WebDigestoDocumentoAnexoType::class, $webDigestoDocumentoAnexo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($webDigestoDocumentoAnexo);
            $entityManager->flush();

            return $this->redirectToRoute('web_digesto_documento_anexo_index');
        }

        return $this->render('web_digesto_documento_anexo/new.html.twig', [
            'web_digesto_documento_anexo' => $webDigestoDocumentoAnexo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="web_digesto_documento_anexo_show", methods={"GET"})
     */
    public function show(WebDigestoDocumentoAnexo $webDigestoDocumentoAnexo): Response
    {
        return $this->render('web_digesto_documento_anexo/show.html.twig', [
            'web_digesto_documento_anexo' => $webDigestoDocumentoAnexo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="web_digesto_documento_anexo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, WebDigestoDocumentoAnexo $webDigestoDocumentoAnexo): Response
    {
        $form = $this->createForm(WebDigestoDocumentoAnexoType::class, $webDigestoDocumentoAnexo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('web_digesto_documento_anexo_index', [
                'id' => $webDigestoDocumentoAnexo->getId(),
            ]);
        }

        return $this->render('web_digesto_documento_anexo/edit.html.twig', [
            'web_digesto_documento_anexo' => $webDigestoDocumentoAnexo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="web_digesto_documento_anexo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, WebDigestoDocumentoAnexo $webDigestoDocumentoAnexo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$webDigestoDocumentoAnexo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($webDigestoDocumentoAnexo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('web_digesto_documento_anexo_index');
    }
}
