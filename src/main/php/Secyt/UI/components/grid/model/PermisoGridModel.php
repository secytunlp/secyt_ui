<?php
namespace Secyt\UI\components\grid\model;

use Secyt\UI\service\finder\PermisoFinder;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\components\filter\model\UIPermisoCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;

use Secyt\UI\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

use Rasty\Grid\entitygrid\model\GridDatetimeFormat;

/**
 * Model para la grilla de Permiso.
 * 
 * @author Bernardo
 * @since 27/12/2014
 */
class PermisoGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();
        
    }
    
    public function getService(){
    	
    	return UIServiceFactory::getUIPermisoService();
    }
    
    public function getFilter(){
    	
    	$filter = new UIPermisoCriteria();
		return $filter;    	
    }


    public function getEntityId( $anObject ){
			
    	$finder = new PermisoFinder();
		return  $finder->getEntityCode( $anObject );
			
	}
	
	protected function initModel() {
		
		$this->setHasCheckboxes( false );
		
		$column = GridModelBuilder::buildColumn( "oid", "permiso.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$column->setCssClass("no-phone");
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "name", "permiso.name", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "description", "permiso.description", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "parent", "permiso.padre", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
	}

	public function getDefaultFilterField() {
        return "name";
    }

	public function getDefaultOrderField(){
		return "name";
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
		$menuOption->setLabel( $this->localize( "menu.permisos.modificar") );
		$menuOption->setPageName( "PermisoModificar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setIconClass( "icon-editar" );
		$options[] = $menuOption ;
		
		$group->setMenuOptions( $options );
		
		return array( $group );
		
	} 
    
}
?>