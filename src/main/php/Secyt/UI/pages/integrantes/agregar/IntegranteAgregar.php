<?php
namespace Secyt\UI\pages\integrantes\agregar;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\pages\SecytPage;

use Rasty\utils\XTemplate;
use Secyt\Core\model\Integrante;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\utils\RastyUtils;

use Secyt\UI\service\UIServiceFactory;


class IntegranteAgregar extends SecytPage{

	/**
	 * integrante a agregar.
	 * @var Integrante
	 */
	private $integrante;

	
	public function __construct(){
		
		//inicializamos el integrante.
		$integrante = new Integrante();
		
		if (RastyUtils::getParamGET("proyectoOid")) {
			$proyecto = UIServiceFactory::getUIProyectoService()->get( RastyUtils::getParamGET("proyectoOid") );
			$integrante->setProyecto($proyecto);
		}
		
		
		//
		$this->setIntegrante($integrante);

		
	}
	
	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Integrantes");
		$menuOption->addParam("proyectoOid",RastyUtils::getParamGET("proyectoOid"));
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "integrante.agregar.title" );
	}

	public function getType(){
		
		return "IntegranteAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$integranteForm = $this->getComponentById("integranteForm");
		$integranteForm->fillFromSaved( $this->getIntegrante() );
		
	}


	public function getIntegrante()
	{
	    return $this->integrante;
	}

	public function setIntegrante($integrante)
	{
	    $this->integrante = $integrante;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>