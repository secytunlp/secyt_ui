<?php
namespace Secyt\UI\pages\permisos\agregar;

use Secyt\UI\pages\SecytPage;

use Rasty\utils\XTemplate;
use Cose\Security\model\Permission;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class PermisoAgregar extends SecytPage{

	/**
	 * Permiso a agregar.
	 * @var Permiso
	 */
	private $permiso;

	
	public function __construct(){
		
		//inicializamos el permiso.
		$permiso = new Permission();
		
		$this->setPermiso($permiso);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del permiso 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Permisos");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "permiso.agregar.title" );
	}

	public function getType(){
		
		return "PermisoAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		
	}


	public function getPermiso()
	{
	    return $this->permiso;
	}

	public function setPermiso($permiso)
	{
	    $this->permiso = $permiso;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>