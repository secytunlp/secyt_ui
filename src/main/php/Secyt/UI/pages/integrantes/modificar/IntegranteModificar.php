<?php
namespace Secyt\UI\pages\integrantes\modificar;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Secyt\Core\model\Integrante;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Secyt\UI\utils\SecytUIUtils;

class IntegranteModificar extends SecytPage{

	/**
	 * integrante a modificar.
	 * @var Integrante
	 */
	private $integrante;

	
	public function __construct(){
		
		//inicializamos el integrante.
		$integrante = new Integrante();
		$this->setIntegrante($integrante);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setIntegranteOid($oid){
		
		//a partir del id buscamos el integrante a modificar.
		$integrante = UIServiceFactory::getUIIntegranteService()->get($oid);
		
		$this->setIntegrante($integrante);
		
	}
	
	public function getTitle(){
		return $this->localize( "integrante.modificar.title" );
	}

	public function getType(){
		
		return "IntegranteModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$integranteForm = $this->getComponentById("integranteForm");
		$integranteForm->fillFromSaved( $this->getIntegrante() );
		
		
	}

	public function getIntegrante(){
		
	    return $this->integrante;
	}

	public function setIntegrante($integrante)
	{
	    $this->integrante = $integrante;
	}
}
?>