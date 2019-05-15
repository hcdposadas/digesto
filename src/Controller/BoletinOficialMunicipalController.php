<?php

namespace App\Controller;

use App\Entity\BoletinOficialMunicipal;
use App\Form\Filter\BoletinOficialMunicipalFilterType;
use App\Form\BoletinOficialMunicipalType;
use App\Repository\BoletinOficialMunicipalRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/boletin/oficial/municipal")
 */
class BoletinOficialMunicipalController extends AbstractController {
	/**
	 * @Route("/", name="boletin_oficial_municipal_index", methods={"GET"})
	 */
	public function index(
		BoletinOficialMunicipalRepository $boletinOficialMunicipalRepository,
		Request $request,
		PaginatorInterface $paginator
	): Response {

		$em = $this->getDoctrine()->getManager();

		$filterForm = $this->createForm( BoletinOficialMunicipalFilterType::class,
			null,
			[
				'method' => 'GET'
			] );


		$filterForm->handleRequest( $request );

		if ( $filterForm->get( 'buscar' )->isClicked() ) {
			$boletinOficialMunicipals = $em->getRepository( BoletinOficialMunicipal::class )->getQbBuscar( $filterForm->getData() );
		} else {
			$boletinOficialMunicipals = $em->getRepository( BoletinOficialMunicipal::class )->search();
		}

		$boletinOficialMunicipals = $paginator->paginate(
			$boletinOficialMunicipals,
			$request->query->getInt( 'page', 1 )/*page number*/,
			10/*limit per page*/
		);


		return $this->render( 'boletin_oficial_municipal/index.html.twig',
			[
				'boletin_oficial_municipals' => $boletinOficialMunicipals,
				'filter_type' => $filterForm->createView()
			] );
	}

	/**
	 * @Route("/new", name="boletin_oficial_municipal_new", methods={"GET","POST"})
	 */
	public function new( Request $request ): Response {
		$boletinOficialMunicipal = new BoletinOficialMunicipal();
		$form                    = $this->createForm( BoletinOficialMunicipalType::class, $boletinOficialMunicipal );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist( $boletinOficialMunicipal );
			$entityManager->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				'Boletin creado correctamente'
			);

			return $this->redirectToRoute( 'boletin_oficial_municipal_edit',
				[
					'id' => $boletinOficialMunicipal->getId(),
				] );
		}

		return $this->render( 'boletin_oficial_municipal/new.html.twig',
			[
				'boletin_oficial_municipal' => $boletinOficialMunicipal,
				'form'                      => $form->createView(),
			] );
	}

	/**
	 * @Route("/{id}", name="boletin_oficial_municipal_show", methods={"GET"})
	 */
	public function show( BoletinOficialMunicipal $boletinOficialMunicipal ): Response {
		return $this->render( 'boletin_oficial_municipal/show.html.twig',
			[
				'boletin_oficial_municipal' => $boletinOficialMunicipal,
			] );
	}

	/**
	 * @Route("/{id}/edit", name="boletin_oficial_municipal_edit", methods={"GET","POST"})
	 */
	public function edit( Request $request, BoletinOficialMunicipal $boletinOficialMunicipal ): Response {
		$form = $this->createForm( BoletinOficialMunicipalType::class, $boletinOficialMunicipal );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$this->getDoctrine()->getManager()->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				'Boletin actualizado correctamente'
			);

			return $this->redirectToRoute( 'boletin_oficial_municipal_edit',
				[
					'id' => $boletinOficialMunicipal->getId(),
				] );
		}

		return $this->render( 'boletin_oficial_municipal/edit.html.twig',
			[
				'boletin_oficial_municipal' => $boletinOficialMunicipal,
				'form'                      => $form->createView(),
			] );
	}

	/**
	 * @Route("/{id}", name="boletin_oficial_municipal_delete", methods={"DELETE"})
	 */
	public function delete( Request $request, BoletinOficialMunicipal $boletinOficialMunicipal ): Response {
		if ( $this->isCsrfTokenValid( 'delete' . $boletinOficialMunicipal->getId(),
			$request->request->get( '_token' ) ) ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove( $boletinOficialMunicipal );
			$entityManager->flush();
		}

		return $this->redirectToRoute( 'boletin_oficial_municipal_index' );
	}
}
