<?php

namespace App\Controller;

use App\Entity\Consolidacion;
use App\Entity\Descriptor;
use App\Entity\DescriptorNorma;
use App\Entity\Identificador;
use App\Entity\IdentificadorNorma;
use App\Entity\Norma;
use App\Entity\PalabraClave;
use App\Entity\PalabraClaveNorma;
use App\Entity\Tema;
use App\Entity\TemaNorma;
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

		$normaRepository->updateEstados();

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

        $consolidacionRepository = $this->getDoctrine()->getRepository(Consolidacion::class);
        $consolidacion = $consolidacionRepository->getConsolidacionEnCurso();

		$em = $this->getDoctrine()->getManager();

		$descriptores    = $norma->getDescriptoresNorma();
		$identificadores = $norma->getIdentificadoresNorma();
		$palabrasClave   = $norma->getPalabrasClaveNorma();
		$temas           = $norma->getTemaNormas();
		$form            = $this->createForm( NormaType::class,
			$norma,
			[
				'descriptores'    => $descriptores,
				'identificadores' => $identificadores,
				'palabrasClave'   => $palabrasClave,
                'temas'           => $temas,
			] );

		$descriptoresOriginales    = new ArrayCollection();
		$identificadoresOriginales = new ArrayCollection();
		$palabrasClaveOriginales   = new ArrayCollection();
        $temasOriginales           = new ArrayCollection();

		foreach ( $descriptores as $descriptor ) {
			$descriptoresOriginales->add( $descriptor );
		}
		foreach ( $identificadores as $identificador ) {
			$identificadoresOriginales->add( $identificador );
		}
		foreach ( $palabrasClave as $palabrasClave ) {
			$palabrasClaveOriginales->add( $palabrasClave );
		}
        foreach ( $temas as $tema ) {
            $temasOriginales->add( $tema );
        }

		$form->handleRequest( $request );

		if ( $form->isSubmitted()) {
            if ($form->isValid()) {

                $data = [];
                $data['descriptores'] = $form->get('descriptores')->getData();
                $data['identificadores'] = $form->get('identificadores')->getData();
                $data['palabrasClave'] = $form->get('palabrasClave')->getData();
                $data['temas'] = $form->get('temas')->getData();

                /* elimino descriptores */

                $descriptoresQueQuedan = $norma->getDescriptoresNorma()->filter(
                    function ($entry) use ($data) {
                        return in_array($entry->getDescriptor(), $data['descriptores']);
                    }
                );

                foreach ($descriptoresOriginales as $descriptor) {
                    if (false === $descriptoresQueQuedan->contains($descriptor)) {

                        $descriptor->setNorma(null);
                        $norma->getDescriptoresNorma()->removeElement($descriptor);

                        $em->remove($descriptor);
                    }
                }

                /* elimino identificadores */

                $identificadoresQueQuedan = $norma->getIdentificadoresNorma()->filter(
                    function ($entry) use ($data) {
                        return in_array($entry->getIdentificador(), $data['identificadores']);
                    }
                );

                foreach ($identificadoresOriginales as $identificador) {
                    if (false === $identificadoresQueQuedan->contains($identificador)) {

                        $identificador->setNorma(null);
                        $norma->getIdentificadoresNorma()->removeElement($identificador);

                        $em->remove($identificador);
                    }
                }

                /* elimino palabras clave */

                $palabraClaveQueQuedan = $norma->getPalabrasClaveNorma()->filter(
                    function ($entry) use ($data) {
                        return in_array($entry->getPalabraClave(), $data['palabrasClave']);
                    }
                );

                foreach ($palabrasClaveOriginales as $palabraClave) {
                    if (false === $palabraClaveQueQuedan->contains($palabraClave)) {

                        $palabraClave->setNorma(null);
                        $norma->getPalabrasClaveNorma()->removeElement($palabraClave);

                        $em->remove($palabraClave);
                    }
                }

                /* elimino temas */

                $temaQueQuedan = $norma->getTemaNormas()->filter(
                    function ($entry) use ($data) {
                        return in_array($entry->getTema(), $data['temas']);
                    }
                );

                foreach ($temasOriginales as $tema) {
                    if (false === $palabraClaveQueQuedan->contains($tema)) {

                        $tema->setNorma(null);
                        $norma->getTemaNormas()->removeElement($tema);

                        $em->remove($tema);
                    }
                }

                // agrego descriptores
                $this->addDescriptores($em, $data, $norma);

                // agrego identificadores
                $this->addIdentificadores($em, $data, $norma);

                // agrego palabras clave
                $this->addPalabrasClaves($em, $data, $norma);

                // agrego temas
                $this->addTemas($em, $data, $norma);

                if (!$norma->getTipoVeto()) {
                    $norma->setObservacionesVeto(null);
                }

                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Norma actualizada correctamente'
                );

                return $this->redirectToRoute('norma_edit',
                    [
                        'id' => $norma->getId(),
                    ]);
            } else {
                return $this->render('norma/edit.html.twig',
                    [
                        'norma' => $norma,
                        'form' => $form->createView(),
                        'consolidacion' => $consolidacion
                    ]);
            }
        }

        $anexoA = $consolidacionRepository->getAnexoA($consolidacion);
        $anexoB = $consolidacionRepository->getAnexoB($consolidacion);
        $anexoC = $consolidacionRepository->getAnexoC($consolidacion);
        $anexoD = $consolidacionRepository->getAnexoD($consolidacion);
        $anexoE = $consolidacionRepository->getAnexoE($consolidacion);
        $anexoF = $consolidacionRepository->getAnexoF($consolidacion);
        $anexoG = $consolidacionRepository->getAnexoG($consolidacion);
        $anexoH = $consolidacionRepository->getAnexoH($consolidacion);

        $enAnexoA = count(array_filter($anexoA, function (Norma $n) use ($norma) { return $norma->getId() === $n->getId(); })) > 0;
        $enAnexoB = count(array_filter($anexoB, function (Norma $n) use ($norma) { return $norma->getId() === $n->getId(); })) > 0;
        $enAnexoC = count(array_filter(array_map(function ($c) { return $c->getNorma(); }, $anexoC), function (Norma $n) use ($norma) { return $norma->getId() === $n->getId(); })) > 0;
        $enAnexoD = count(array_filter(array_map(function ($c) { return $c->getNorma(); }, $anexoD), function (Norma $n) use ($norma) { return $norma->getId() === $n->getId(); })) > 0;
        $enAnexoE = count(array_filter(array_map(function ($c) { return $c->getNorma(); }, $anexoE), function (Norma $n) use ($norma) { return $norma->getId() === $n->getId(); })) > 0;
        $enAnexoF = count(array_filter(array_map(function ($c) { return $c->getNorma(); }, $anexoF), function (Norma $n) use ($norma) { return $norma->getId() === $n->getId(); })) > 0;
        $enAnexoG = count(array_filter($anexoG, function (Norma $n) use ($norma) { return $norma->getId() === $n->getId(); })) > 0;
        $enAnexoH = count(array_filter($anexoH, function (Norma $n) use ($norma) { return $norma->getId() === $n->getId(); })) > 0;

        $anexos = [];
        if ($enAnexoA) {
            $anexos[] = 'A';
        }
        if ($enAnexoB) {
            $anexos[] = 'B';
        }
        if ($enAnexoC) {
            $anexos[] = 'C';
        }
        if ($enAnexoD) {
            $anexos[] = 'D';
        }
        if ($enAnexoE) {
            $anexos[] = 'E';
        }
        if ($enAnexoF) {
            $anexos[] = 'F';
        }
        if ($enAnexoG) {
            $anexos[] = 'G';
        }
        if ($enAnexoH) {
            $anexos[] = 'H';
        }

        return $this->render( 'norma/edit.html.twig',
			[
				'norma' => $norma,
				'form'  => $form->createView(),
                'anexos' => count($anexos) ? 'Anexos '.implode(', ', $anexos) : '',
                'consolidacion' => $consolidacion
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

    private function addTemas( $em, $data, &$norma ) {
        if ( isset( $data['temas'] ) ) {
            foreach ( $data['temas'] as $temaId ) {
                $tema      = $em->getRepository( Tema::class )->find( $temaId );
                $temaNorma = $em->getRepository( TemaNorma::class )->findOneBy([
                    'norma' => $norma,
                    'tema'  => $tema
                ]);
                if ( ! $temaNorma && $tema ) {
                    $temaNorma = new TemaNorma();
                    $temaNorma->setNorma( $norma );
                    $temaNorma->setTema( $tema );
                    $norma->addTemaNorma( $temaNorma );
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
