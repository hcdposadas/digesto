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
		}
		return $this->listAction();
	}

	public function createNewUsuarioEntity() {
		return $this->userManager->createUser();
	}

	public function updateUsuarioEntity( $user ) {
        $this->userManager->updateUser( $user, false );
		parent::updateEntity( $user );
	}

	public function prePersistUsuarioEntity( $user ) {
		$this->userManager->updateUser( $user, false );
	}

	public function preUpdateUsuarioEntity( $user ) {
		$this->userManager->updateUser( $user, false );
	}
}
