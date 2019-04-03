<?php

namespace App\Controller;

use App\Entity\WebDigestoTexto;
use App\Form\BuscarOrdenanzaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

	/**
	 * @Route("/", name="public")
	 */
	public function index() {


		$web = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );

		if ( ! $web ) {
			return new Response( '<h1>Sitio En construccion</h1>' );
		}

		return $this->render( 'Web/index.html.twig',
			[
				'web' => $web
			] );
	}

	/**
	 * @Route("/buscador", name="buscador")
	 */
	public function buscador() {

		$titulo = 'Buscador';

		$web = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );

		if ( ! $web ) {
			return new Response( '<h1>Sitio En construccion</h1>' );
		}

		$form = $this->createForm( BuscarOrdenanzaType::class );


		return $this->render( 'Web/buscador.html.twig',
			[
				'web'    => $web,
				'titulo' => $titulo,
				'form'   => $form->createView(),

			] );
	}

	/**
	 * @Route("/documentos", name="documentos")
	 */
	public function documentos() {
		$titulo = 'Documentos';

		$web = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );

		if ( ! $web ) {
			return new Response( '<h1>Sitio En construccion</h1>' );
		}

		return $this->render( 'Web/documentos.html.twig',
			[
				'web'    => $web,
				'titulo' => $titulo,
			] );
	}

	/**
	 * @Route("/pagina/{pagina}", name="pagina")
	 */
	public function pagina( Request $request ) {

		$web = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );

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
				'web'       => $web,
				'titulo'    => $titulo,
				'contenido' => $contenido,

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
}
