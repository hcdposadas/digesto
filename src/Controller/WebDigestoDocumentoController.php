<?php

namespace App\Controller;

use App\Entity\WebDigestoDocumento;
use App\Form\WebDigestoDocumentoType;
use App\Repository\WebDigestoDocumentoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/web/digesto/documento")
 */
class WebDigestoDocumentoController extends AbstractController {
	/**
	 * @Route("/", name="web_digesto_documento_index", methods={"GET"})
	 */
	public function index(
		WebDigestoDocumentoRepository $webDigestoDocumentoRepository,
		Request $request,
		PaginatorInterface $paginator
	): Response {

		$webDocumentos = $paginator->paginate(
			$webDigestoDocumentoRepository->findAll(),
			$request->query->getInt( 'page', 1 )/*page number*/,
			10/*limit per page*/
		);

		return $this->render( 'web_digesto_documento/index.html.twig',
			[
				'web_digesto_documentos' => $webDocumentos,
			] );
	}

	/**
	 * @Route("/new", name="web_digesto_documento_new", methods={"GET","POST"})
	 */
	public function new( Request $request ): Response {
		$webDigestoDocumento = new WebDigestoDocumento();
		$form                = $this->createForm( WebDigestoDocumentoType::class, $webDigestoDocumento );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$entityManager = $this->getDoctrine()->getManager();

//			$anexos = $form->get( 'webDigestoDocumentoAnexo' )->getData();
//
//			foreach ( $anexos as $anexo ) {
//				$webDigestoDocumento->setWebDigestoDocumentoAnexo( $anexo );
//			}

			$entityManager->persist( $webDigestoDocumento );
			$entityManager->flush();

			return $this->redirectToRoute( 'web_digesto_documento_index' );
		}

		return $this->render( 'web_digesto_documento/new.html.twig',
			[
				'web_digesto_documento' => $webDigestoDocumento,
				'form'                  => $form->createView(),
			] );
	}

	/**
	 * @Route("/{id}", name="web_digesto_documento_show", methods={"GET"})
	 */
	public function show( WebDigestoDocumento $webDigestoDocumento ): Response {
		return $this->render( 'web_digesto_documento/show.html.twig',
			[
				'web_digesto_documento' => $webDigestoDocumento,
			] );
	}

	/**
	 * @Route("/{id}/edit", name="web_digesto_documento_edit", methods={"GET","POST"})
	 */
	public function edit( Request $request, WebDigestoDocumento $webDigestoDocumento ): Response {
		$form = $this->createForm( WebDigestoDocumentoType::class,
			$webDigestoDocumento);
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {

//			$anexos = $form->get( 'webDigestoDocumentoAnexo' )->getData();
//
//			foreach ( $anexos as $anexo ) {
//				$webDigestoDocumento->setWebDigestoDocumentoAnexo( $anexo );
//			}

			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute( 'web_digesto_documento_edit',
				[
					'id' => $webDigestoDocumento->getId(),
				] );
		}

		return $this->render( 'web_digesto_documento/edit.html.twig',
			[
				'web_digesto_documento' => $webDigestoDocumento,
				'form'                  => $form->createView(),
			] );
	}

	/**
	 * @Route("/{id}", name="web_digesto_documento_delete", methods={"DELETE"})
	 */
	public function delete( Request $request, WebDigestoDocumento $webDigestoDocumento ): Response {
		if ( $this->isCsrfTokenValid( 'delete' . $webDigestoDocumento->getId(), $request->request->get( '_token' ) ) ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove( $webDigestoDocumento );
			$entityManager->flush();
		}

		return $this->redirectToRoute( 'web_digesto_documento_index' );
	}
}
