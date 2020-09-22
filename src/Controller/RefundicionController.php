<?php

namespace App\Controller;

use App\Entity\Refundicion;
use App\Form\Refundicion1Type;
use App\Repository\RefundicionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/refundicion")
 */
class RefundicionController extends AbstractController
{
    /**
     * @Route("/", name="refundicion_index", methods={"GET"})
     */
    public function index(RefundicionRepository $refundicionRepository): Response
    {
        return $this->render('refundicion/index.html.twig', [
            'refundicions' => $refundicionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="refundicion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $refundicion = new Refundicion();
        $form = $this->createForm(Refundicion1Type::class, $refundicion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($refundicion);
            $entityManager->flush();

            return $this->redirectToRoute('refundicion_index');
        }

        return $this->render('refundicion/new.html.twig', [
            'refundicion' => $refundicion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="refundicion_show", methods={"GET"})
     */
    public function show(Refundicion $refundicion): Response
    {
        return $this->render('refundicion/show.html.twig', [
            'refundicion' => $refundicion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="refundicion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Refundicion $refundicion): Response
    {
        $form = $this->createForm(Refundicion1Type::class, $refundicion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('refundicion_index');
        }

        return $this->render('refundicion/edit.html.twig', [
            'refundicion' => $refundicion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="refundicion_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Refundicion $refundicion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$refundicion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($refundicion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('refundicion_index');
    }
}
