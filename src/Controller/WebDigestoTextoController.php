<?php

namespace App\Controller;

use App\Entity\WebDigestoTexto;
use App\Form\WebDigestoTextoType;
use App\Repository\WebDigestoTextoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administrador/web/digesto/texto")
 */
class WebDigestoTextoController extends AbstractController {
	/**
	 * @Route("/", name="web_digesto_texto_index", methods={"GET"})
	 */
	public function index( WebDigestoTextoRepository $webDigestoTextoRepository ): Response {

		$entityManager = $this->getDoctrine()->getManager();

		$web = $entityManager->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );

		if ( ! $web ) {
			$web = new WebDigestoTexto();
			$web->setSlug( 'web' );

			$entityManager->persist( $web );
			$entityManager->flush();

		}

		return $this->redirectToRoute( 'web_digesto_texto_edit',
			[
				'id' => $web->getId()
			] );

//		return $this->render( 'web_digesto_texto/index.html.twig',
//			[
//				'web_digesto_textos' => $webDigestoTextoRepository->findAll(),
//			] );
	}

	/**
	 * @Route("/new", name="web_digesto_texto_new", methods={"GET","POST"})
	 */
	public function new( Request $request ): Response {
		$webDigestoTexto = new WebDigestoTexto();
		$form            = $this->createForm( WebDigestoTextoType::class, $webDigestoTexto );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist( $webDigestoTexto );
			$entityManager->flush();

			return $this->redirectToRoute( 'web_digesto_texto_index' );
		}

		return $this->render( 'web_digesto_texto/new.html.twig',
			[
				'web_digesto_texto' => $webDigestoTexto,
				'form'              => $form->createView(),
			] );
	}

	/**
	 * @Route("/{id}", name="web_digesto_texto_show", methods={"GET"})
	 */
	public function show( WebDigestoTexto $webDigestoTexto ): Response {
		return $this->render( 'web_digesto_texto/show.html.twig',
			[
				'web_digesto_texto' => $webDigestoTexto,
			] );
	}

	/**
	 * @Route("/{id}/edit", name="web_digesto_texto_edit", methods={"GET","POST"})
	 */
	public function edit( Request $request, WebDigestoTexto $webDigestoTexto ): Response {
		$form = $this->createForm( WebDigestoTextoType::class, $webDigestoTexto );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute( 'web_digesto_texto_index',
				[
					'id' => $webDigestoTexto->getId(),
				] );
		}

		return $this->render( 'web_digesto_texto/edit.html.twig',
			[
				'web_digesto_texto' => $webDigestoTexto,
				'form'              => $form->createView(),
			] );
	}

	/**
	 * @Route("/{id}", name="web_digesto_texto_delete", methods={"DELETE"})
	 */
	public function delete( Request $request, WebDigestoTexto $webDigestoTexto ): Response {
		if ( $this->isCsrfTokenValid( 'delete' . $webDigestoTexto->getId(), $request->request->get( '_token' ) ) ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove( $webDigestoTexto );
			$entityManager->flush();
		}

		return $this->redirectToRoute( 'web_digesto_texto_index' );
	}
}
