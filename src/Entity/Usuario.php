<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Usuario extends BaseUser {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;


	public function __construct() {
		parent::__construct();
		// your own logic
	}

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="App\Entity\Persona")
	 * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", nullable=true)
	 */
	private $persona;
	public function esIniciador() {
		$return= false;
		foreach ( $this->getPersona()->getCargoPersona() as $cargoPersona ) {
			if ($cargoPersona->getIniciador()){
				$return = true;
			}
		}
		return $return;
	}

	/**
	 * Set persona
	 *
	 * @param \App\Entity\Persona $persona
	 *
	 * @return Usuario
	 */
	public function setPersona(\App\Entity\Persona $persona = null)
	{
		$this->persona = $persona;
		return $this;
	}
	/**
	 * Get persona
	 *
	 * @return \App\Entity\Persona
	 */
	public function getPersona()
	{
		return $this->persona;
	}
}