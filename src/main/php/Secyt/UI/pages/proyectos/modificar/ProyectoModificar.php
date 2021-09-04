<?php
namespace Secyt\UI\pages\proyectos\modificar;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Secyt\Core\model\Proyecto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Secyt\UI\utils\SecytUIUtils;

class ProyectoModificar extends SecytPage{

	/**
	 * proyecto a modificar.
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
	
	public function setProyectoOid($oid){
		
		//a partir del id buscamos el proyecto a modificar.
		$proyecto = UIServiceFactory::getUIProyectoService()->get($oid);
		
		$this->setProyecto($proyecto);
		
	}
	
	public function getTitle(){
		return $this->localize( "proyecto.modificar.title" );
	}

	public function getType(){
		
		return "ProyectoModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$proyectoForm = $this->getComponentById("proyectoForm");
		$proyectoForm->fillFromSaved( $this->getProyecto() );
		
		
	}

	public function getProyecto(){
		
	    return $this->proyecto;
	}

	public function setProyecto($proyecto)
	{
	    $this->proyecto = $proyecto;
	}
}
?>