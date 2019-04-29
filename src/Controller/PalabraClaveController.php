<?php

namespace App\Controller;

use App\Entity\PalabraClave;
use App\Form\PalabraClave1Type;
use App\Repository\PalabraClaveRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/palabra/clave")
 */
class PalabraClaveController extends AbstractController {
	/**
	 * @Route("/", name="palabra_clave_index", methods={"GET"})
	 */
	public function index(
		PalabraClaveRepository $palabraClaveRepository,
		Request $request,
		PaginatorInterface $paginator
	): Response {

		$palabra_claves = $paginator->paginate(
			$palabraClaveRepository->findAll(),
			$request->query->getInt( 'page', 1 )/*page number*/,
			10/*limit per page*/
		);

		return $this->render( 'palabra_clave/index.html.twig',
			[
				'palabra_claves' => $palabra_claves,
			] );
	}

	/**
	 * @Route("/new", name="palabra_clave_new", methods={"GET","POST"})
	 */
	public function new( Request $request ): Response {
		$palabraClave = new PalabraClave();
		$form         = $this->createForm( PalabraClave1Type::class, $palabraClave );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist( $palabraClave );
			$entityManager->flush();

			return $this->redirectToRoute( 'palabra_clave_index' );
		}

		return $this->render( 'palabra_clave/new.html.twig',
			[
				'palabra_clave' => $palabraClave,
				'form'          => $form->createView(),
			] );
	}

	/**
	 * @Route("/{id}", name="palabra_clave_show", methods={"GET"})
	 */
	public function show( PalabraClave $palabraClave ): Response {
		return $this->render( 'palabra_clave/show.html.twig',
			[
				'palabra_clave' => $palabraClave,
			] );
	}

	/**
	 * @Route("/{id}/edit", name="palabra_clave_edit", methods={"GET","POST"})
	 */
	public function edit( Request $request, PalabraClave $palabraClave ): Response {
		$form = $this->createForm( PalabraClave1Type::class, $palabraClave );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute( 'palabra_clave_index',
				[
					'id' => $palabraClave->getId(),
				] );
		}

		return $this->render( 'palabra_clave/edit.html.twig',
			[
				'palabra_clave' => $palabraClave,
				'form'          => $form->createView(),
			] );
	}

	/**
	 * @Route("/{id}", name="palabra_clave_delete", methods={"DELETE"})
	 */
	public function delete( Request $request, PalabraClave $palabraClave ): Response {
		if ( $this->isCsrfTokenValid( 'delete' . $palabraClave->getId(), $request->request->get( '_token' ) ) ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove( $palabraClave );
			$entityManager->flush();
		}

		return $this->redirectToRoute( 'palabra_clave_index' );
	}
}
