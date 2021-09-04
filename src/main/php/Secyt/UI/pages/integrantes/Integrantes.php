<?php
namespace Secyt\UI\pages\integrantes;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\components\filter\model\UIIntegranteCriteria;

use Secyt\UI\components\grid\model\IntegranteGridModel;

use Secyt\UI\service\UIIntegranteService;

use Secyt\UI\utils\SecytUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Drink\Core\criteria\IntegranteCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los integrantes
 * 
 * @author Marcos
 * @since 12/04/2020
 * @Rasty\Security\annotation\Secured( permission='Listar integrantes' )
 * 
 */

class Integrantes extends SecytPage{

	private $integranteCriteria;
	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "integrantes.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del integrante 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "integrante.agregar") );
		$menuOption->setPageName("IntegranteAgregar");
		$menuOption->addParam("proyectoOid",RastyUtils::getParamGET("proyectoOid"));
		$menuOption->setIconClass( "icon-agregar" );
		$menuGroup->addMenuOption( $menuOption );
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Integrantes";
		
	}	

	public function getModelClazz(){
		return get_class( new IntegranteGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIIntegranteCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("lbl_add", $this->localize("menu.integrantes.agregar") );
		//$xtpl->assign("linkAdd", $this->getLinkIntegranteAgregar() );
		
		$xtpl->parse("main.opciones.add");
		$xtpl->parse("main.opciones");
		
		
		$integranteFilter = $this->getComponentById("integrantesFilter");
		
		$integranteFilter->fillFromSaved( $this->getIntegranteCriteria() );
	}


	public function getIntegranteCriteria()
	{
	    return $this->integranteCriteria;
	}

	public function setIntegranteCriteria($integranteCriteria)
	{
	    $this->integranteCriteria = $integranteCriteria;
	}
}
?>