<?php

namespace App\Controller;

use App\Entity\AnexoConsolidacion;
use App\Entity\BoletinOficialMunicipal;
use App\Entity\Consolidacion;
use App\Entity\Norma;
use App\Entity\TextoDefinitivo;
use App\Entity\WebDigestoDocumento;
use App\Entity\WebDigestoTexto;
use App\Form\BuscarBoletinType;
use App\Form\BuscarOrdenanzaType;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
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


		$web             = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines  = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();
		$consolidaciones = $this->getDoctrine()->getRepository( Consolidacion::class )->getConsolidacionesOrdenadas();

		if ( ! $web ) {
			return new Response( '<h1>Sitio En construccion</h1>' );
		}

		return $this->render( 'Web/index.html.twig',
			[
				'web'             => $web,
				'anios_boletines' => $aniosBoletines,
				'consolidaciones' => $consolidaciones
			] );
	}

	/**
	 * @Route("/buscador", name="buscador")
	 */
	public function buscador( Request $request, PaginatorInterface $paginator ) {

		$titulo = 'Buscador';

		$web             = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines  = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();
		$consolidaciones = $this->getDoctrine()->getRepository( Consolidacion::class )->getConsolidacionesOrdenadas();

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
				'resultados'      => $resultados,
				'consolidaciones' => $consolidaciones

			] );
	}

	/**
	 * @Route("/documentos", name="documentos")
	 */
	public function documentos() {
		$titulo = 'Documentos';

		$web             = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines  = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();
		$consolidaciones = $this->getDoctrine()->getRepository( Consolidacion::class )->getConsolidacionesOrdenadas();

		if ( ! $web ) {
			return new Response( '<h1>Sitio En construccion</h1>' );
		}

		$documentos = $this->getDoctrine()->getRepository( WebDigestoDocumento::class )->getDocumentosWeb();

		return $this->render( 'Web/documentos.html.twig',
			[
				'web'             => $web,
				'titulo'          => $titulo,
				'anios_boletines' => $aniosBoletines,
				'documentos'      => $documentos,
				'consolidaciones' => $consolidaciones
			] );
	}

	/**
	 * @Route("/pagina/{pagina}", name="pagina")
	 */
	public function pagina( Request $request ) {

		$web             = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines  = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();
		$consolidaciones = $this->getDoctrine()->getRepository( Consolidacion::class )->getConsolidacionesOrdenadas();

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
				'consolidaciones' => $consolidaciones
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
		$web             = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines  = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();
		$consolidaciones = $this->getDoctrine()->getRepository( Consolidacion::class )->getConsolidacionesOrdenadas();

		$titulo = $norma->getRama()->getNumeroRomano() . ' - ' . $norma->getRama()->getTitulo() . ' - ' . $norma->getNumero();

		return $this->render( 'Web/ordenanza.html.twig',
			[
				'web'             => $web,
				'anios_boletines' => $aniosBoletines,
				'titulo'          => $titulo,
				'norma'           => $norma,
				'consolidaciones' => $consolidaciones
			] );
	}

	/**
	 * @Route("/boletines/{anio}", name="boletines")
	 */
	public function boletines( Request $request, PaginatorInterface $paginator, $anio ) {
		$web             = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines  = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();
		$consolidaciones = $this->getDoctrine()->getRepository( Consolidacion::class )->getConsolidacionesOrdenadas();

		$titulo = 'Boletines oficiales del ' . $anio;


		$boletines = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->findBoletinesByYear( $anio );


		$form = $this->createForm( BuscarBoletinType::class,
			[],
			[
				'method' => 'GET'
			] );

		$form->handleRequest( $request );

		if ( $form->isSubmitted() ) {
			$data = $form->getData();

			$em           = $this->getDoctrine();
			$data['anio'] = $anio;
			$boletines    = $em->getRepository( BoletinOficialMunicipal::class )->getQbBuscar( $data );


			$boletines = $paginator->paginate(
				$boletines,
				$request->query->get( 'page', 1 )/* page number */,
				10/* limit per page */
			);

		}

		return $this->render( 'Web/boletines.html.twig',
			[
				'web'             => $web,
				'anios_boletines' => $aniosBoletines,
				'titulo'          => $titulo,
				'boletines'       => $boletines,
				'form'            => $form->createView(),
				'consolidaciones' => $consolidaciones
			] );
	}

	/**
	 * @Route("/buscador_app", name="buscador_app")
	 */
	public function buscadorApp( Request $request, PaginatorInterface $paginator ) {

		$titulo = 'Buscador';

		$web = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );


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

			return $this->render( 'app_temp/resultados_app.html.twig',
				[

					'titulo'     => $titulo,
					'resultados' => $resultados

				] );

		}


		return $this->render( 'app_temp/buscador_app.html.twig',
			[

				'titulo' => $titulo,
				'form'   => $form->createView(),

			] );
	}

	/**
	 * @Route("/ver_ordenanza_app/{id}", name="ver_ordenanza_app")
	 */
	public function verOrdenanzaApp( Request $request, Norma $norma ) {
		$web = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );

		$titulo = $norma->getRama() . ' ' . $norma->getRama()->getNumeroRomano() . ' - ' . $norma->getNumero();

		return $this->render( 'app_temp/ver_ordenanza_app.html.twig',
			[
				'web'    => $web,
				'titulo' => $titulo,
				'norma'  => $norma,
			] );
	}

	/**
	 * @Route("/consolidacion/{id}", name="ver_consolidacion")
	 */
	public function verConsolidacion( Request $request, Consolidacion $consolidacion ) {
		$web             = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines  = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();
		$consolidaciones = $this->getDoctrine()->getRepository( Consolidacion::class )->getConsolidacionesOrdenadas();

		$titulo = $consolidacion->getTitulo();

		return $this->render( 'Web/consolidacion.html.twig',
			[
				'web'             => $web,
				'anios_boletines' => $aniosBoletines,
				'titulo'          => $titulo,
				'consolidacion'   => $consolidacion,
				'consolidaciones' => $consolidaciones
			] );
	}

	/**
	 * @Route("/consolidacion/{id}/anexo/{anexo}", name="ver_anexo_consolidacion")
	 */
	public function verAnexoConsolidacion( Request $request, Consolidacion $consolidacion, AnexoConsolidacion $anexo ) {
		$web             = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines  = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();
		$consolidaciones = $this->getDoctrine()->getRepository( Consolidacion::class )->getConsolidacionesOrdenadas();

		$titulo = $consolidacion->getTitulo();

		$anexoA = null;
		$anexoB = null;
		$anexoC = null;
		$anexoD = null;
		$anexoE = null;
		$anexoF = null;
		$anexoG = null;
		$anexoH = null;

		$consolidacionRepository = $this->getDoctrine()->getRepository( Consolidacion::class );
		if ( $anexo->getOrden() === AnexoConsolidacion::ANEXO_A ) {
			$anexoA = $consolidacionRepository->getAnexoA( $consolidacion );
		}
		if ( $anexo->getOrden() === AnexoConsolidacion::ANEXO_B ) {
			$anexoB = $consolidacionRepository->getAnexoB( $consolidacion );
		}
		if ( $anexo->getOrden() === AnexoConsolidacion::ANEXO_C ) {
			$anexoC = $consolidacionRepository->getAnexoC( $consolidacion );
		}
		if ( $anexo->getOrden() === AnexoConsolidacion::ANEXO_D ) {
			$anexoD = $consolidacionRepository->getAnexoD( $consolidacion );
		}
		if ( $anexo->getOrden() === AnexoConsolidacion::ANEXO_E ) {
			$anexoE = $consolidacionRepository->getAnexoE( $consolidacion );
		}
		if ( $anexo->getOrden() === AnexoConsolidacion::ANEXO_F ) {
			$anexoF = $consolidacionRepository->getAnexoF( $consolidacion );
		}
		if ( $anexo->getOrden() === AnexoConsolidacion::ANEXO_G ) {
			$anexoG = $consolidacionRepository->getAnexoG( $consolidacion );
		}
		if ( $anexo->getOrden() === AnexoConsolidacion::ANEXO_H ) {
			$anexoH = $consolidacionRepository->getAnexoH( $consolidacion );
		}

		return $this->render( 'Web/anexo_consolidacion.html.twig',
			[
				'web'             => $web,
				'anios_boletines' => $aniosBoletines,
				'titulo'          => $titulo,
				'consolidacion'   => $consolidacion,
				'consolidaciones' => $consolidaciones,
				'anexoA'          => $anexoA,
				'anexoB'          => $anexoB,
				'anexoC'          => $anexoC,
				'anexoD'          => $anexoD,
				'anexoE'          => $anexoE,
				'anexoF'          => $anexoF,
				'anexoG'          => $anexoG,
				'anexoH'          => $anexoH
			] );
	}

	/**
	 * @Route("/consolidacion/{consolidacion}/norma/{norma}", name="ver_ordenanza_en_consolidacion")
	 */
	public function verOrdenanzaEnConsolidacion( Request $request, Consolidacion $consolidacion, Norma $norma ) {
		$web             = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
		$aniosBoletines  = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();
		$consolidaciones = $this->getDoctrine()->getRepository( Consolidacion::class )->getConsolidacionesOrdenadas();

		$textoDefinitivo = $this->getDoctrine()->getRepository( TextoDefinitivo::class )->findOneBy( array(
			'consolidacion' => $consolidacion,
			'norma'         => $norma,
			'activo'        => true
		) );

		$titulo = $norma->getRama()->getNumeroRomano() . ' - ' . $norma->getRama()->getTitulo() . ' - ' . $norma->getNumero();

		return $this->render( 'Web/ordenanza.html.twig',
			[
				'web'             => $web,
				'anios_boletines' => $aniosBoletines,
				'titulo'          => $titulo,
				'norma'           => $norma,
				'consolidaciones' => $consolidaciones,
				'textoDefinitivo' => $textoDefinitivo
			] );
	}

	/**
	 * @Route("/texto-sin-consolidar/{norma}", name="texto_sin_consolidar", methods={"GET"})
	 */
	public function pdfTexoSinConsolidar( Norma $norma, \Knp\Snappy\Pdf $snappy ) {

		$html = $this->renderView( 'Web/texto_sin_consolidar.pdf.twig',
			[
				'norma' => $norma
			] );

		$titulo = $norma->getRama()->getNumeroRomano() . ' - ' . $norma->getNumero();

		return new PdfResponse(
			$snappy->getOutputFromHtml( $html, [
				'margin-top' => "5cm",
				'margin-bottom' => "3cm",
				'margin-right' => "2.5cm",
				'margin-left' => "2.5cm",
			] ),
			$titulo . '.pdf',
			'application/pdf',
			'inline'
		);
	}
}
