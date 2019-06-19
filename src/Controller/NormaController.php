<?php

namespace App\Controller;

use App\Entity\Descriptor;
use App\Entity\DescriptorNorma;
use App\Entity\Identificador;
use App\Entity\IdentificadorNorma;
use App\Entity\Norma;
use App\Entity\PalabraClave;
use App\Entity\PalabraClaveNorma;
use App\Form\Filter\NormaFilterForm;
use App\Form\NormaType;
use App\Repository\NormaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administrador/norma")
 */
class NormaController extends AbstractController {
	/**
	 * @Route("/", name="norma_index", methods={"GET"})
	 */
	public function index(
		NormaRepository $normaRepository,
		Request $request,
		PaginatorInterface $paginator
	): Response {

		$em = $this->getDoctrine()->getManager();

		$filterForm = $this->createForm( NormaFilterForm::class,
			null,
			[
				'method' => 'GET'
			] );


		$filterForm->handleRequest( $request );

		if ( $filterForm->get( 'buscar' )->isClicked() ) {
			$normas = $em->getRepository( Norma::class )->getQbBuscar( $filterForm->getData() );
		} else {
			$normas = $em->getRepository( Norma::class )->search();
		}


		$normas = $paginator->paginate(
			$normas,
			$request->query->getInt( 'page', 1 )/*page number*/,
			10/*limit per page*/
		);

		return $this->render( 'norma/index.html.twig',
			[
				'normas'      => $normas,
				'filter_type' => $filterForm->createView()
			] );
	}

	/**
	 * @Route("/new", name="norma_new", methods={"GET","POST"})
	 */
	public function new( Request $request ): Response {
		$norma = new Norma();
		$form  = $this->createForm( NormaType::class, $norma );
		$form->handleRequest( $request );


		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();

			$data = $request->get( $form->getName() );

			// agrego descriptores
			$this->addDescriptores( $em, $data, $norma );

			// agrego descriptores
			$this->addIdentificadores( $em, $data, $norma );

			// agrego descriptores
			$this->addPalabrasClaves( $em, $data, $norma );

			$em->persist( $norma );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				'Norma creada correctamente'
			);

			return $this->redirectToRoute( 'norma_edit',
				[
					'id' => $norma->getId(),
				] );
		}

		return $this->render( 'norma/new.html.twig',
			[
				'norma' => $norma,
				'form'  => $form->createView(),
			] );
	}

	/**
	 * @Route("/{id}", name="norma_show", methods={"GET"})
	 */
	public function show( Norma $norma ): Response {
		return $this->render( 'norma/show.html.twig',
			[
				'norma' => $norma,
			] );
	}

	/**
	 * @Route("/{id}/edit", name="norma_edit", methods={"GET","POST"})
	 */
	public function edit( Request $request, Norma $norma ): Response {

		$em = $this->getDoctrine()->getManager();

		$descriptores    = $norma->getDescriptoresNorma();
		$identificadores = $norma->getIdentificadoresNorma();
		$palabrasClave   = $norma->getPalabrasClaveNorma();
		$form            = $this->createForm( NormaType::class,
			$norma,
			[
				'descriptores'    => $descriptores,
				'identificadores' => $identificadores,
				'palabrasClave'   => $palabrasClave
			] );

		$descriptoresOriginales    = new ArrayCollection();
		$identificadoresOriginales = new ArrayCollection();
		$palabrasClaveOriginales   = new ArrayCollection();

		foreach ( $descriptores as $descriptor ) {
			$descriptoresOriginales->add( $descriptor );
		}
		foreach ( $identificadores as $identificador ) {
			$identificadoresOriginales->add( $identificador );
		}
		foreach ( $palabrasClave as $palabrasClave ) {
			$palabrasClaveOriginales->add( $palabrasClave );
		}

		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {

//            $data = $request->get($form->getName());
			$data                    = [];
			$data['descriptores']    = $form->get( 'descriptores' )->getData();
			$data['identificadores'] = $form->get( 'identificadores' )->getData();
			$data['palabrasClave']   = $form->get( 'palabrasClave' )->getData();

			/* elimino descriptores */

			$descriptoresQueQuedan = $norma->getDescriptoresNorma()->filter(
				function ( $entry ) use ( $data ) {
					return in_array( $entry->getDescriptor(), $data['descriptores'] );
				}
			);

			foreach ( $descriptoresOriginales as $descriptor ) {
				if ( false === $descriptoresQueQuedan->contains( $descriptor ) ) {

					$descriptor->setNorma( null );
					$norma->getDescriptoresNorma()->removeElement( $descriptor );

					$em->remove( $descriptor );
				}
			}

			/* elimino identificadores */

			$identificadoresQueQuedan = $norma->getIdentificadoresNorma()->filter(
				function ( $entry ) use ( $data ) {
					return in_array( $entry->getIdentificador(), $data['identificadores'] );
				}
			);

			foreach ( $identificadoresOriginales as $identificador ) {
				if ( false === $identificadoresQueQuedan->contains( $identificador ) ) {

					$identificador->setNorma( null );
					$norma->getIdentificadoresNorma()->removeElement( $identificador );

					$em->remove( $identificador );
				}
			}

			/* elimino palabras clave */

			$palabraClaveQueQuedan = $norma->getPalabrasClaveNorma()->filter(
				function ( $entry ) use ( $data ) {
					return in_array( $entry->getPalabraClave(), $data['palabrasClave'] );
				}
			);

			foreach ( $palabrasClaveOriginales as $palabraClave ) {
				if ( false === $palabraClaveQueQuedan->contains( $palabraClave ) ) {

					$palabraClave->setNorma( null );
					$norma->getPalabrasClaveNorma()->removeElement( $palabraClave );

					$em->remove( $palabraClave );
				}
			}

			// agrego descriptores
			$this->addDescriptores( $em, $data, $norma );

			// agrego identificadores
			$this->addIdentificadores( $em, $data, $norma );

			// agrego palabras clave
			$this->addPalabrasClaves( $em, $data, $norma );

			$em->flush();

			$this->get( 'session' )->getFlashBag()->add(
				'success',
				'Norma actualizada correctamente'
			);

			return $this->redirectToRoute( 'norma_edit',
				[
					'id' => $norma->getId(),
				] );
		}

		return $this->render( 'norma/edit.html.twig',
			[
				'norma' => $norma,
				'form'  => $form->createView(),
			] );
	}

	private function addDescriptores( $em, $data, &$norma ) {
		if ( isset( $data['descriptores'] ) ) {
			foreach ( $data['descriptores'] as $descriptorId ) {
				$descriptor      = $em->getRepository( Descriptor::class )->find( $descriptorId );
				$descriptorNorma = $em->getRepository( DescriptorNorma::class )->findOneBy(
					[
						'norma'      => $norma,
						'descriptor' => $descriptor
					]
				);
				if ( ! $descriptorNorma && $descriptor ) {
					$descriptorNorma = new DescriptorNorma();
					$descriptorNorma->setNorma( $norma );
					$descriptorNorma->setDescriptor( $descriptor );
					$norma->addDescriptoresNorma( $descriptorNorma );
				}
			}
		}
	}

	private function addIdentificadores( $em, $data, &$norma ) {
		if ( isset( $data['identificadores'] ) ) {
			foreach ( $data['identificadores'] as $identificadorId ) {
				$identificador      = $em->getRepository( Identificador::class )->find( $identificadorId );
				$identificadorNorma = $em->getRepository( IdentificadorNorma::class )->findOneBy(
					[
						'norma'         => $norma,
						'identificador' => $identificador
					]
				);
				if ( ! $identificadorNorma && $identificador ) {
					$identificadorNorma = new IdentificadorNorma();
					$identificadorNorma->setNorma( $norma );
					$identificadorNorma->setIdentificador( $identificador );
					$norma->addIdentificadoresNorma( $identificadorNorma );
				}
			}
		}
	}

	private function addPalabrasClaves( $em, $data, &$norma ) {
		if ( isset( $data['palabrasClave'] ) ) {
			foreach ( $data['palabrasClave'] as $palabraClaveId ) {
				$palabraClave      = $em->getRepository( PalabraClave::class )->find( $palabraClaveId );
				$palabraClaveNorma = $em->getRepository( PalabraClaveNorma::class )->findOneBy(
					[
						'norma'        => $norma,
						'palabraClave' => $palabraClave
					]
				);
				if ( ! $palabraClaveNorma && $palabraClave ) {
					$palabraClaveNorma = new PalabraClaveNorma();
					$palabraClaveNorma->setNorma( $norma );
					$palabraClaveNorma->setPalabraClave( $palabraClave );
					$norma->addPalabrasClaveNorma( $palabraClaveNorma );
				}
			}
		}
	}

	/**
	 * @Route("/{id}", name="norma_delete", methods={"DELETE"})
	 */
	public function delete( Request $request, Norma $norma ): Response {
		if ( $this->isCsrfTokenValid( 'delete' . $norma->getId(), $request->request->get( '_token' ) ) ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove( $norma );
			$entityManager->flush();
		}

		return $this->redirectToRoute( 'norma_index' );
	}
}
