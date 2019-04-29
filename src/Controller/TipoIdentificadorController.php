<?php

namespace App\Controller;

use App\Entity\TipoIdentificador;
use App\Form\TipoIdentificadorType;
use App\Repository\TipoIdentificadorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tipo/identificador")
 */
class TipoIdentificadorController extends AbstractController
{
    /**
     * @Route("/", name="tipo_identificador_index", methods={"GET"})
     */
    public function index(TipoIdentificadorRepository $tipoIdentificadorRepository, Request $request,PaginatorInterface $paginator): Response
    {

	    $tipoIdentificadors = $paginator->paginate(
		    $tipoIdentificadorRepository->findAll(),
		    $request->query->getInt( 'page', 1 )/*page number*/,
		    10/*limit per page*/
	    );

        return $this->render('tipo_identificador/index.html.twig', [
            'tipo_identificadors' => $tipoIdentificadors,
        ]);
    }

    /**
     * @Route("/new", name="tipo_identificador_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoIdentificador = new TipoIdentificador();
        $form = $this->createForm(TipoIdentificadorType::class, $tipoIdentificador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipoIdentificador);
            $entityManager->flush();

            return $this->redirectToRoute('tipo_identificador_index');
        }

        return $this->render('tipo_identificador/new.html.twig', [
            'tipo_identificador' => $tipoIdentificador,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_identificador_show", methods={"GET"})
     */
    public function show(TipoIdentificador $tipoIdentificador): Response
    {
        return $this->render('tipo_identificador/show.html.twig', [
            'tipo_identificador' => $tipoIdentificador,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tipo_identificador_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoIdentificador $tipoIdentificador): Response
    {
        $form = $this->createForm(TipoIdentificadorType::class, $tipoIdentificador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipo_identificador_index', [
                'id' => $tipoIdentificador->getId(),
            ]);
        }

        return $this->render('tipo_identificador/edit.html.twig', [
            'tipo_identificador' => $tipoIdentificador,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_identificador_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TipoIdentificador $tipoIdentificador): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoIdentificador->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoIdentificador);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tipo_identificador_index');
    }
}
