<?php

namespace App\Controller;

use App\Entity\BoletinOficialMunicipal;
use App\Entity\Norma;
use App\Entity\WebDigestoDocumento;
use App\Entity\WebDigestoTexto;
use App\Form\BuscarOrdenanzaType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

	/**
	 * @Route("/", name="public")
	 */
	public function index() {


		$web            = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();

		if ( ! $web ) {
			return new Response( '<h1>Sitio En construccion</h1>' );
		}

		return $this->render( 'Web/index.html.twig',
			[
				'web'             => $web,
				'anios_boletines' => $aniosBoletines
			] );
	}

	/**
	 * @Route("/buscador", name="buscador")
	 */
	public function buscador( Request $request, PaginatorInterface $paginator ) {

		$titulo = 'Buscador';

		$web            = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();

		if ( ! $web ) {
			return new Response( '<h1>Sitio En construccion</h1>' );
		}

		$resultados = [];

		$form = $this->createForm( BuscarOrdenanzaType::class,
			[],
			[
				'method' => 'GET'
			] );

		$form->handleRequest( $request );

		if ( $form->isSubmitted() ) {
			$data = $form->getData();

			$em         = $this->getDoctrine();
			$resultados = $em->getRepository( Norma::class )->buscarNormas( $data );


			$resultados = $paginator->paginate(
				$resultados,
				$request->query->get( 'page', 1 )/* page number */,
				10/* limit per page */
			);

		}


		return $this->render( 'Web/buscador.html.twig',
			[
				'web'             => $web,
				'titulo'          => $titulo,
				'anios_boletines' => $aniosBoletines,
				'form'            => $form->createView(),
				'resultados'      => $resultados

			] );
	}

	/**
	 * @Route("/documentos", name="documentos")
	 */
	public function documentos() {
		$titulo = 'Documentos';

		$web            = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();

		if ( ! $web ) {
			return new Response( '<h1>Sitio En construccion</h1>' );
		}

		$documentos = $this->getDoctrine()->getRepository( WebDigestoDocumento::class )->getDocumentosWeb();

		return $this->render( 'Web/documentos.html.twig',
			[
				'web'             => $web,
				'titulo'          => $titulo,
				'anios_boletines' => $aniosBoletines,
				'documentos'      => $documentos
			] );
	}

	/**
	 * @Route("/pagina/{pagina}", name="pagina")
	 */
	public function pagina( Request $request ) {

		$web            = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();

		if ( ! $web ) {
			return new Response( '<h1>Sitio En construcción</h1>' );
		}

		$titulo    = 'No Encontrado';
		$pagina    = $request->get( 'pagina' );
		$contenido = '"' . $pagina . '" contenido no encontrado';

		switch ( $pagina ) {
			case 'renumeracion':
				$titulo    = 'Renumeración';
				$contenido = $web->getRenumeracion();
				break;
			case 'resenia':
				$titulo    = 'Reseña';
				$contenido = $web->getResenia();
				break;
			case 'metodologiaTrabajo':
				$titulo    = 'Metodología de Trabajo';
				$contenido = $web->getMetodologiaTrabajo();
				break;
			case 'instructivoInformativo':
				$titulo    = 'Instructivo Informativo';
				$contenido = $web->getInstructivoInformativo();
				break;
		}


		return $this->render( 'Web/pagina.html.twig',
			[
				'web'             => $web,
				'titulo'          => $titulo,
				'anios_boletines' => $aniosBoletines,
				'contenido'       => $contenido,

			] );
	}


	/**
	 * @Route("/administrador", name="administrador")
	 */
	public function administrador() {

		return $this->render( 'default/index.html.twig',
			[
				'controller_name' => 'DefaultController',
			] );
	}

	/**
	 * @Route("/ver_ordenanza/{id}", name="ver_ordenanza")
	 */
	public function verOrdenanza( Request $request, Norma $norma ) {
		$web            = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();

		$titulo = $norma->getRama() . ' ' . $norma->getRama()->getNumeroRomano() . ' - ' . $norma->getNumero();

		return $this->render( 'Web/ordenanza.html.twig',
			[
				'web'             => $web,
				'anios_boletines' => $aniosBoletines,
				'titulo'          => $titulo,
				'norma'           => $norma,
			] );
	}

	/**
	 * @Route("/boletines/{anio}", name="boletines")
	 */
	public function boletines( Request $request, $anio ) {
		$web            = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();

		$titulo = 'Boletines oficiales del ' . $anio;


		$boletines = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->findBoletinesByYear($anio);

		return $this->render( 'Web/boletines.html.twig',
			[
				'web'             => $web,
				'anios_boletines' => $aniosBoletines,
				'titulo'          => $titulo,
				'boletines'       => $boletines
			] );
	}
}
