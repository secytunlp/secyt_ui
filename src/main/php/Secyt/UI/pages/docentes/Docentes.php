<?php
namespace Secyt\UI\pages\docentes;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\components\filter\model\UIDocenteCriteria;

use Secyt\UI\components\grid\model\DocenteGridModel;

use Secyt\UI\service\UIDocenteService;

use Secyt\UI\utils\SecytUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Drink\Core\criteria\DocenteCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los docentes
 * 
 * @author Marcos
 * @since 18/06/2015
 *
 * @Rasty\Security\annotation\Secured( permission='Listar Docentes' )
 */

class Docentes extends SecytPage{

	private $docenteCriteria;
	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "docentes.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del docente 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "docente.agregar") );
		$menuOption->setPageName("DocenteAgregar");
		$menuOption->setIconClass( "icon-agregar" );
		$menuGroup->addMenuOption( $menuOption );
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Docentes";
		
	}	

	public function getModelClazz(){
		return get_class( new DocenteGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIDocenteCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("lbl_add", $this->localize("menu.docentes.agregar") );
		//$xtpl->assign("linkAdd", $this->getLinkDocenteAgregar() );
		
		$xtpl->parse("main.opciones.add");
		$xtpl->parse("main.opciones");
		
		
		$docenteFilter = $this->getComponentById("docentesFilter");
		
		$docenteFilter->fillFromSaved( $this->getDocenteCriteria() );
	}


	public function getDocenteCriteria()
	{
	    return $this->docenteCriteria;
	}

	public function setDocenteCriteria($docenteCriteria)
	{
	    $this->docenteCriteria = $docenteCriteria;
	}
}
?>