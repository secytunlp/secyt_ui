<?php
namespace Secyt\UI\pages\docentes\agregar;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\pages\SecytPage;

use Rasty\utils\XTemplate;
use Secyt\Core\model\Docente;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class DocenteAgregar extends SecytPage{

	/**
	 * docente a agregar.
	 * @var Docente
	 */
	private $docente;

	
	public function __construct(){
		
		//inicializamos el docente.
		$docente = new Docente();
		
		
		$this->setDocente($docente);

		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();

		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "docente.agregar.title" );
	}

	public function getType(){
		
		return "DocenteAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$docenteForm = $this->getComponentById("docenteForm");
		$docenteForm->fillFromSaved( $this->getDocente() );
		
	}


	public function getDocente()
	{
	    return $this->docente;
	}

	public function setDocente($docente)
	{
	    $this->docente = $docente;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>