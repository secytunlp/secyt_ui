<?php
namespace Secyt\UI\pages\roles\permisos;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Cose\Security\model\UserGroup;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para asignar permisos a un rol
 * 
 * @author bernardo
 * @since 21-01-2014
 *
 */
class PermisoAsignar extends SecytPage{

	/**
	 * rol a asignar los permisos.
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
		return $this->localize( "rol.asignarPermisos.title" );
	}

	public function getType(){
		
		return "PermisoAsignar";
		
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