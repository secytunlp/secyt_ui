<?php
namespace Secyt\UI\pages\integranteEstados\agregar;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\pages\SecytPage;

use Rasty\utils\XTemplate;
use Secyt\Core\model\IntegranteEstado;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\utils\RastyUtils;

use Secyt\UI\service\UIServiceFactory;

use Secyt\UI\components\filter\model\UIIntegranteEstadoCriteria;


class IntegranteEstadoAgregar extends SecytPage{

	/**
	 * integranteEstado a agregar.
	 * @var IntegranteEstado
	 */
	private $integranteEstado;

	
	public function __construct(){
		
		//inicializamos el integranteEstado.
		
		
		if (RastyUtils::getParamGET("integranteOid")) {
			
			$integrante = UIServiceFactory::getUIIntegranteService()->get( RastyUtils::getParamGET("integranteOid") );
			
			$criteria = new UIIntegranteEstadoCriteria();
			$criteria->setIntegrante($integrante);
			$criteria->setHastaNull(1);
				
			
				
			$integranteEstado = UIServiceFactory::getUIIntegranteEstadoService()->getByCriteria($criteria);
			if($integranteEstado){
				$integranteEstado->setMotivo("");
			}
			else{
				$integranteEstado = new IntegranteEstado();
			}
			
		}
		else{
				$integranteEstado = new IntegranteEstado();
			}
		
		
		
		//
		$this->setIntegranteEstado($integranteEstado);

		
	}
	
	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("IntegranteEstados");
		$menuOption->addParam("proyectoOid",RastyUtils::getParamGET("proyectoOid"));
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "integranteEstado.agregar.title" );
	}

	public function getType(){
		
		return "IntegranteEstadoAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$integranteEstadoForm = $this->getComponentById("integranteEstadoForm");
		$integranteEstadoForm->fillFromSaved( $this->getIntegranteEstado() );
		
	}


	public function getIntegranteEstado()
	{
	    return $this->integranteEstado;
	}

	public function setIntegranteEstado($integranteEstado)
	{
	    $this->integranteEstado = $integranteEstado;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>