<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

	/**
	 * @Route("/", name="public")
	 */
	public function index() {
		return $this->render( 'Web/index.html.twig' );
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
