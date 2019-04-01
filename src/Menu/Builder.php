<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


class Builder {

	private $factory;
	private $authorizationChecker;

	/**
	 * @param FactoryInterface $factory
	 *
	 * Add any other dependency you need
	 */
	public function __construct( FactoryInterface $factory, AuthorizationCheckerInterface $authorizationChecker ) {
		$this->factory              = $factory;
		$this->authorizationChecker = $authorizationChecker;
	}

	public function mainMenu( array $options ) {
//		$menu = $factory->createItem('root');
//
//		$menu->addChild('Home', array('route' => 'app_homepage'));

		$menu = $this->factory->createItem(
			'root',
			array(
				'childrenAttributes' => array(
					'class'       => 'sidebar-menu tree',
					'data-widget' => 'tree'
				),
			)
		);

		$menu->addChild(
			'MENU PRINCIPAL'
		)->setAttribute( 'class', 'header' );

		if ( $this->authorizationChecker->isGranted( 'ROLE_USER' ) ) {

			$keyAdministracion = 'ADMINISTRACIÓN';
			$menu->addChild(
				$keyAdministracion,
				array(
					'childrenAttributes' => array(
						'class' => 'treeview-menu',
					),
				)
			)
			     ->setUri( '#' )
			     ->setExtra( 'icon', 'fa fa-folder-open-o' )
			     ->setAttribute( 'class', 'treeview' );

			if ( $this->authorizationChecker->isGranted( 'ROLE_DIGESTO_ADMIN' ) ) {

				$menu[ $keyAdministracion ]
					->addChild(
						'Parámetros',
						array(
							'route' => 'easyadmin',
						)
					);

				$menu[ $keyAdministracion ]
					->addChild(
						'WEB',
						array(
							'route' => 'web_digesto_texto_index',
						)
					);

			}

			if ( $this->authorizationChecker->isGranted( 'ROLE_DIGESTO' ) ) {
				$menu[ $keyAdministracion ]
					->addChild(
						'Normas',
						array(
							'route' => 'norma_index',
						)
					);


			}

		}


		return $menu;
	}
}