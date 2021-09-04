<?php
namespace Secyt\UI\pages\integranteEstados;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\components\filter\model\UIIntegranteEstadoCriteria;

use Secyt\UI\components\grid\model\IntegranteEstadoGridModel;

use Secyt\UI\service\UIIntegranteEstadoService;

use Secyt\UI\utils\SecytUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Drink\Core\criteria\IntegranteEstadoCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los integranteEstados
 * 
 * @author Marcos
 * @since 14/04/2020
 *
 * @Rasty\Security\annotation\Secured( permission='Listar estados' )
 */

class IntegranteEstados extends SecytPage{

	private $integranteEstadoCriteria;
	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "integranteEstados.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del integranteEstado 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "integranteEstado.agregar") );
		$menuOption->setPageName("IntegranteEstadoAgregar");
		$menuOption->addParam("integranteOid",RastyUtils::getParamGET("integranteOid"));
		$menuOption->setIconClass( "icon-agregar" );
		$menuGroup->addMenuOption( $menuOption );
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "IntegranteEstados";
		
	}	

	public function getModelClazz(){
		return get_class( new IntegranteEstadoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIIntegranteEstadoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("lbl_add", $this->localize("menu.integranteEstados.agregar") );
		//$xtpl->assign("linkAdd", $this->getLinkIntegranteEstadoAgregar() );
		
		$xtpl->parse("main.opciones.add");
		$xtpl->parse("main.opciones");
		
		
		$integranteEstadoFilter = $this->getComponentById("integranteEstadosFilter");
		
		$integranteEstadoFilter->fillFromSaved( $this->getIntegranteEstadoCriteria() );
	}


	public function getIntegranteEstadoCriteria()
	{
	    return $this->integranteEstadoCriteria;
	}

	public function setIntegranteEstadoCriteria($integranteEstadoCriteria)
	{
	    $this->integranteEstadoCriteria = $integranteEstadoCriteria;
	}
}
?>