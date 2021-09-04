<?php
namespace Secyt\UI\components\grid\model;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\components\filter\model\UIDocenteCriteria;

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
class DocenteGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();
        
    }
    
    public function getService(){
    	
    	return UIServiceFactory::getUIDocenteService();
    }
    
    public function getFilter(){
	    
    	$filter = new UIDocenteCriteria();
		return $filter;    	
    }
        
	protected function initModel() {

		$this->setHasCheckboxes( false );
		
		$column = GridModelBuilder::buildColumn( "oid", "docente.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );
		
		/*$column = GridModelBuilder::buildColumn( "ident", "docente.ident", 10, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );*/
		
		$column = GridModelBuilder::buildColumn( "apellido", "docente.apellido", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "nombre", "docente.nombre", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "cuil", "docente.cuil", 20, EntityGrid::TEXT_ALIGN_CENTER ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "categoria", "docente.categoria", 5, EntityGrid::TEXT_ALIGN_CENTER ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "cargoDed", "cargo.nombre", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "facultad", "docente.facultad", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "carrera", "carrerainvs", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "becas", "becas", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		
	}

	public function getDefaultFilterField() {
        return "apellido";
    }

	public function getDefaultOrderField(){
		return "apellido";
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
		$menuOption->setLabel( $this->localize( "menu.docentes.modificar") );
		$menuOption->setPageName( "DocenteModificar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setIconClass( "icon-editar" );
		$options[] = $menuOption ;
		
		//SecytUIUtils::addMenuOptionToGroup($menuOption, $group);
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.docentes.eliminar") );
		$menuOption->setPageName( "DocenteEliminar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setIconClass( "icon-remove" );
		$options[] = $menuOption ;
		
		//SecytUIUtils::addMenuOptionToGroup($menuOption, $group);
		$group->setMenuOptions( $options );
		return array( $group );
		
	} 
	
	public function getRowStyleClass($item){
		
		//return SecytUIUtils::getEstadoDocenteCss($item->getEstado());
		
	}
	
}
?>