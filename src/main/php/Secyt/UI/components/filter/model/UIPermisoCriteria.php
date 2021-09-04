<?php
namespace Secyt\UI\components\filter\model;


use Secyt\UI\components\filter\model\UISecytCriteria;

use Rasty\utils\RastyUtils;
use  Cose\Security\criteria\PermissionCriteria;

/**
 * Representa un criterio de búsqueda
 * para Permisos.
 * 
 * @author Bernardo
 * @since 27/12/2014
 *
 */
class UIPermisoCriteria extends UISecytCriteria{


	private $name;
	private $parent;
	
		
	public function __construct(){

		parent::__construct();

	}
		
	protected function newCoreCriteria(){
		return new PermissionCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setName( $this->getName() );
		$criteria->setParent( $this->getParent() );
		
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

	public function getParent()
	{
	    return $this->parent;
	}

	public function setParent($parent)
	{
	    $this->parent = $parent;
	}
}