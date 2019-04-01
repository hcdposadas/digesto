<?php

namespace App\Controller;

use App\Entity\Norma;
use App\Form\NormaType;
use App\Repository\NormaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administrador/norma")
 */
class NormaController extends AbstractController
{
    /**
     * @Route("/", name="norma_index", methods={"GET"})
     */
    public function index(NormaRepository $normaRepository, Request $request, PaginatorInterface $paginator): Response
    {

//	    $paginator  = $this->get('knp_paginator');
	    $normas = $paginator->paginate(
		    $normaRepository->findAll(), /* query NOT result */
		    $request->query->getInt('page', 1)/*page number*/,
		    10/*limit per page*/
	    );

        return $this->render('norma/index.html.twig', [
            'normas' => $normas,
        ]);
    }

    /**
     * @Route("/new", name="norma_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $norma = new Norma();
        $form = $this->createForm(NormaType::class, $norma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($norma);
            $entityManager->flush();

            return $this->redirectToRoute('norma_index');
        }

        return $this->render('norma/new.html.twig', [
            'norma' => $norma,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="norma_show", methods={"GET"})
     */
    public function show(Norma $norma): Response
    {
        return $this->render('norma/show.html.twig', [
            'norma' => $norma,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="norma_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Norma $norma): Response
    {
        $form = $this->createForm(NormaType::class, $norma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('norma_index', [
                'id' => $norma->getId(),
            ]);
        }

        return $this->render('norma/edit.html.twig', [
            'norma' => $norma,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="norma_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Norma $norma): Response
    {
        if ($this->isCsrfTokenValid('delete'.$norma->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($norma);
            $entityManager->flush();
        }

        return $this->redirectToRoute('norma_index');
    }
}
