<?php
namespace Secyt\UI\components\grid\model;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\components\filter\model\UIProyectoCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;
use Rasty\Grid\entitygrid\model\GridDatetimeFormat;
use Secyt\UI\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;



/**
 * 
 * Enter description here ...
 * @author marcos.piñero
 *
 */
class ProyectoGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();
        
    }
    
    public function getService(){
    	
    	return UIServiceFactory::getUIProyectoService();
    }
    
    public function getFilter(){
	    
    	$filter = new UIProyectoCriteria();
		return $filter;    	
    }
        
	protected function initModel() {

		$this->setHasCheckboxes( false );
		
		$column = GridModelBuilder::buildColumn( "oid", "proyecto.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "tipoAcreditacion", "proyecto.tipoAcreditacion", 5, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "codigo", "proyecto.codigo", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "titulo", "proyecto.titulo", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "director", "proyecto.director", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "inicio", "proyecto.inicio", 20, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y") );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "fin", "proyecto.fin", 20, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y") );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "facultad", "proyecto.facultad", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "estado", "proyecto.estado", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		
	}

	public function getDefaultFilterField() {
        return "codigo";
    }

	public function getDefaultOrderField(){
		return "codigo";
	}    

	public function getDefaultOrderType(){
		return "ASC";
	}
	
	
	
    /**
	 * opciones de menú dado el item
	 * @param unknown_type $item
	 */
	public function getMenuGroups( $item ){
	
		$group = new MenuGroup();
		$group->setLabel("grupo");
		$options = array();

		
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.proyectos.modificar") );
		$menuOption->setPageName( "ProyectoModificar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setIconClass( "icon-editar" );
		$options[] = $menuOption ;
		
		//SecytUIUtils::addMenuOptionToGroup($menuOption, $group);
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.proyectos.eliminar") );
		$menuOption->setPageName( "ProyectoEliminar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setIconClass( "icon-remove" );
		$options[] = $menuOption ;
		
		//SecytUIUtils::addMenuOptionToGroup($menuOption, $group);
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.proyectos.integrantes") );
		$menuOption->setPageName( "Integrantes" );
		$menuOption->setIconClass("icon-user");
		$menuOption->addParam("proyectoOid",$item->getOid());
		
		$options[] = $menuOption ;
		
		//SecytUIUtils::addMenuOptionToGroup($menuOption, $group);
		
		$group->setMenuOptions( $options );
		
		return array( $group );
		
	} 
	
	public function getRowStyleClass($item){
		
		//return SecytUIUtils::getEstadoProyectoCss($item->getEstado());
		
	}
	
}
?>