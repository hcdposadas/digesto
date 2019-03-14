<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 2019-03-11
 * Time: 10:48
 */

namespace App\Controller;


use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use FOS\UserBundle\Model\UserManagerInterface;


class AdminController extends EasyAdminController {

	private $userManager;

	public function __construct(UserManagerInterface $userManager)
	{
		$this->userManager = $userManager;
    }

	public function listUsuarioAction()
	{
		if (!$this->isGranted("ROLE_ADMIN")) {
			return $this->redirectToRoute('administrador');
//			return $this->redirectToRoute('administrador', ['entity' => 'Usuario', 'action' => 'edit', 'id' => $this->getUser()->getId()]);
		}
		return $this->listAction();
	}

	public function createNewUsuarioEntity() {
		return $this->userManager->createUser();
	}

	public function updateUsuarioEntity( $user ) {
		$this->container->get( 'fos_user.user_manager' )->updateUser( $user, false );
		parent::updateEntity( $user );
	}

	public function prePersistUsuarioEntity( $user ) {
		$this->get( 'fos_user.user_manager' )->updateUser( $user, false );
	}

	public function preUpdateUsuarioEntity( $user ) {
		$this->get( 'fos_user.user_manager' )->updateUser( $user, false );
	}
}