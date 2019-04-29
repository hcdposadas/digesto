<?php

namespace App\Controller;

use App\Entity\Identificador;
use App\Form\Identificador1Type;
use App\Repository\IdentificadorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/identificador")
 */
class IdentificadorController extends AbstractController
{
    /**
     * @Route("/", name="identificador_index", methods={"GET"})
     */
    public function index(IdentificadorRepository $identificadorRepository, Request $request,PaginatorInterface $paginator): Response
    {

	    $identificadores = $paginator->paginate(
		    $identificadorRepository->findAll(),
		    $request->query->getInt( 'page', 1 )/*page number*/,
		    10/*limit per page*/
	    );

        return $this->render('identificador/index.html.twig', [
            'identificadors' => $identificadores,
        ]);
    }

    /**
     * @Route("/new", name="identificador_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $identificador = new Identificador();
        $form = $this->createForm(Identificador1Type::class, $identificador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($identificador);
            $entityManager->flush();

            return $this->redirectToRoute('identificador_index');
        }

        return $this->render('identificador/new.html.twig', [
            'identificador' => $identificador,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="identificador_show", methods={"GET"})
     */
    public function show(Identificador $identificador): Response
    {
        return $this->render('identificador/show.html.twig', [
            'identificador' => $identificador,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="identificador_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Identificador $identificador): Response
    {
        $form = $this->createForm(Identificador1Type::class, $identificador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('identificador_index', [
                'id' => $identificador->getId(),
            ]);
        }

        return $this->render('identificador/edit.html.twig', [
            'identificador' => $identificador,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="identificador_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Identificador $identificador): Response
    {
        if ($this->isCsrfTokenValid('delete'.$identificador->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($identificador);
            $entityManager->flush();
        }

        return $this->redirectToRoute('identificador_index');
    }
}
