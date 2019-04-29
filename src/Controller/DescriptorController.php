<?php

namespace App\Controller;

use App\Entity\Descriptor;
use App\Form\Descriptor1Type;
use App\Repository\DescriptorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/descriptor")
 */
class DescriptorController extends AbstractController {
	/**
	 * @Route("/", name="descriptor_index", methods={"GET"})
	 */
	public function index(
		DescriptorRepository $descriptorRepository,
		Request $request,
		PaginatorInterface $paginator
	): Response {

		$descriptores = $paginator->paginate(
			$descriptorRepository->findAll(),
			$request->query->getInt( 'page', 1 )/*page number*/,
			10/*limit per page*/
		);

		return $this->render( 'descriptor/index.html.twig',
			[
				'descriptors' => $descriptores,
			] );
	}

	/**
	 * @Route("/new", name="descriptor_new", methods={"GET","POST"})
	 */
	public function new( Request $request ): Response {
		$descriptor = new Descriptor();
		$form       = $this->createForm( Descriptor1Type::class, $descriptor );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist( $descriptor );
			$entityManager->flush();

			return $this->redirectToRoute( 'descriptor_index' );
		}

		return $this->render( 'descriptor/new.html.twig',
			[
				'descriptor' => $descriptor,
				'form'       => $form->createView(),
			] );
	}

	/**
	 * @Route("/{id}", name="descriptor_show", methods={"GET"})
	 */
	public function show( Descriptor $descriptor ): Response {
		return $this->render( 'descriptor/show.html.twig',
			[
				'descriptor' => $descriptor,
			] );
	}

	/**
	 * @Route("/{id}/edit", name="descriptor_edit", methods={"GET","POST"})
	 */
	public function edit( Request $request, Descriptor $descriptor ): Response {
		$form = $this->createForm( Descriptor1Type::class, $descriptor );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute( 'descriptor_index',
				[
					'id' => $descriptor->getId(),
				] );
		}

		return $this->render( 'descriptor/edit.html.twig',
			[
				'descriptor' => $descriptor,
				'form'       => $form->createView(),
			] );
	}

	/**
	 * @Route("/{id}", name="descriptor_delete", methods={"DELETE"})
	 */
	public function delete( Request $request, Descriptor $descriptor ): Response {
		if ( $this->isCsrfTokenValid( 'delete' . $descriptor->getId(), $request->request->get( '_token' ) ) ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove( $descriptor );
			$entityManager->flush();
		}

		return $this->redirectToRoute( 'descriptor_index' );
	}
}
