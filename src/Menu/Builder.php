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

		$menu->addChild(
			'Ver Web',
			[ 'route' => 'public' ]
		)->setAttribute( 'class', '' )
		     ->setExtra( 'icon', 'fa fa-globe' );

		if ( $this->authorizationChecker->isGranted( 'ROLE_USER' ) ) {

			$keyAdministracion = 'ADMINISTRACIÓN';
			$menu->addChild(
				$keyAdministracion,
				array(
					'childrenAttributes' => array(
						'class' => 'treeview-menu',
                        'style' => 'display: block'
					),
				)
			)
			     ->setUri( '#' )
			     ->setExtra( 'icon', 'fa fa-folder-open-o' )
			     ->setAttribute( 'class', 'treeview menu-open' )
			     ->setAttribute('data-expand-sidebar', 'true');

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
						'Web Documentos',
						array(
							'route' => 'web_digesto_documento_index',
						)
					);
				$menu[ $keyAdministracion ]
					->addChild(
						'Normas',
						array(
							'route' => 'norma_index',
						)
					);
				$menu[ $keyAdministracion ]
					->addChild(
						'Boletín Oficial',
						array(
							'route' => 'boletin_oficial_municipal_index',
						)
					);
				$menu[ $keyAdministracion ]
					->addChild(
						'Descriptores',
						array(
							'route' => 'descriptor_index',
						)
					);
				$menu[ $keyAdministracion ]
					->addChild(
						'Tipo Identificador',
						array(
							'route' => 'tipo_identificador_index',
						)
					);
				$menu[ $keyAdministracion ]
					->addChild(
						'Identificadores',
						array(
							'route' => 'identificador_index',
						)
					);
				$menu[ $keyAdministracion ]
					->addChild(
						'Palabras Clave',
						array(
							'route' => 'palabra_clave_index',
						)
					);
                $menu[ $keyAdministracion ]
                    ->addChild(
                        'Listado de consolidaciones',
                        array(
                            'route' => 'consolidaciones',
                        )
                    );
                $menu[ $keyAdministracion ]
                    ->addChild(
                        'Consolidación en curso',
                        array(
                            'route' => 'consolidacion_en_curso',
                        )
                    );
                $menu[ $keyAdministracion ]
                    ->addChild(
                        'Índice Temático Básico',
                        array(
                            'route' => 'temas_index',
                        )
                    );


			}

		}


		return $menu;
	}
}
