<?php
namespace Secyt\UI\pages\proyectos;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\components\filter\model\UIProyectoCriteria;

use Secyt\UI\components\grid\model\ProyectoGridModel;

use Secyt\UI\service\UIProyectoService;

use Secyt\UI\utils\SecytUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Drink\Core\criteria\ProyectoCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los proyectos
 * 
 * @author Marcos
 * @since 10/04/2020
 *
 * @Rasty\Security\annotation\Secured( permission='Listar Proyectos' )
 */

class Proyectos extends SecytPage{

	private $proyectoCriteria;
	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "proyectos.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del proyecto 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "proyecto.agregar") );
		$menuOption->setPageName("ProyectoAgregar");
		$menuOption->setIconClass( "icon-agregar" );
		$menuGroup->addMenuOption( $menuOption );
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Proyectos";
		
	}	

	public function getModelClazz(){
		return get_class( new ProyectoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIProyectoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("lbl_add", $this->localize("menu.proyectos.agregar") );
		//$xtpl->assign("linkAdd", $this->getLinkProyectoAgregar() );
		
		$xtpl->parse("main.opciones.add");
		$xtpl->parse("main.opciones");
		
		
		$proyectoFilter = $this->getComponentById("proyectosFilter");
		
		$proyectoFilter->fillFromSaved( $this->getProyectoCriteria() );
	}


	public function getProyectoCriteria()
	{
	    return $this->proyectoCriteria;
	}

	public function setProyectoCriteria($proyectoCriteria)
	{
	    $this->proyectoCriteria = $proyectoCriteria;
	}
}
?>