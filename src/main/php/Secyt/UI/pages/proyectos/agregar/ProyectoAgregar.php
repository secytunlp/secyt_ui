<?php
namespace Secyt\UI\pages\proyectos\agregar;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\pages\SecytPage;

use Rasty\utils\XTemplate;
use Secyt\Core\model\Proyecto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class ProyectoAgregar extends SecytPage{

	/**
	 * proyecto a agregar.
	 * @var Proyecto
	 */
	private $proyecto;

	
	public function __construct(){
		
		//inicializamos el proyecto.
		$proyecto = new Proyecto();
		
		
		$this->setProyecto($proyecto);

		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();

		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "proyecto.agregar.title" );
	}

	public function getType(){
		
		return "ProyectoAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$proyectoForm = $this->getComponentById("proyectoForm");
		$proyectoForm->fillFromSaved( $this->getProyecto() );
		
	}


	public function getProyecto()
	{
	    return $this->proyecto;
	}

	public function setProyecto($proyecto)
	{
	    $this->proyecto = $proyecto;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>