<?php
namespace Secyt\UI\components\filter\model;


use Secyt\UI\components\filter\model\UISecytCriteria;

use Rasty\utils\RastyUtils;
use  Cose\Security\criteria\UserCriteria;

/**
 * Representa un criterio de búsqueda
 * para usuarios.
 * 
 * @author Bernardo
 * @since 06/11/2014
 *
 */
class UIUsuarioCriteria extends UISecytCriteria{


	private $username;
	private $usergroupNotIn;
		
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new UserCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setUsernameLike( $this->getUsername() );
		$criteria->setUsergroupNotIn( $this->getUsergroupNotIn() );
		
		return $criteria;
	}


	public function getUsername()
	{
	    return $this->username;
	}

	public function setUsername($username)
	{
	    $this->username = $username;
	}

	public function getUsergroupNotIn()
	{
	    return $this->usergroupNotIn;
	}

	public function setUsergroupNotIn($usergroupNotIn)
	{
	    $this->usergroupNotIn = $usergroupNotIn;
	}
}