<?php
namespace Secyt\UI\components\filter\model;


use Secyt\UI\components\filter\model\UISecytCriteria;

use Rasty\utils\RastyUtils;
use  Cose\Security\criteria\UserGroupCriteria;

/**
 * Representa un criterio de búsqueda
 * para Roles.
 * 
 * @author Bernardo
 * @since 27/12/2014
 *
 */
class UIRolCriteria extends UISecytCriteria{


	private $name;
	
		
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new UserGroupCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNameLike( $this->getName() );
		
		return $criteria;
	}



	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}
}