<?php
namespace Secyt\UI\pages\roles\modificar;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Cose\Security\model\UserGroup;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class RolModificar extends SecytPage{

	/**
	 * rol a modificar.
	 * @var Rol
	 */
	private $rol;

	
	public function __construct(){
		
		//inicializamos el rol.
		$rol = new UserGroup();
		$this->setRol($rol);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del rol 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setRolOid($oid){
		
		//a partir del id buscamos el rol a modificar.
		$rol = UIServiceFactory::getUIRolService()->get($oid);
		
		$this->setRol($rol);
		
	}
	
	public function getTitle(){
		return $this->localize( "rol.modificar.title" );
	}

	public function getType(){
		
		return "RolModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getRol(){
		
	    return $this->rol;
	}

	public function setRol($rol)
	{
	    $this->rol = $rol;
	}
}
?>