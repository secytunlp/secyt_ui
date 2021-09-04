<?php
namespace Secyt\UI\components\grid\model;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\components\filter\model\UIIntegranteEstadoCriteria;

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
class IntegranteEstadoGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();
        
    }
    
    public function getService(){
    	
    	return UIServiceFactory::getUIIntegranteEstadoService();
    }
    
    public function getFilter(){
	    
    	$filter = new UIIntegranteEstadoCriteria();
		return $filter;    	
    }
        
	protected function initModel() {

		$this->setHasCheckboxes( false );
		
		$column = GridModelBuilder::buildColumn( "oid", "integrante.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "estado", "integrante.estado", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "integrante.proyecto", "integrante.proyecto", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "tipo", "integrante.tipo", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "integrante.investigador", "integrante.investigador", 20, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "categoria", "docente.categoria", 5, EntityGrid::TEXT_ALIGN_CENTER ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "cargoDed", "cargo.nombre", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		

		$column = GridModelBuilder::buildColumn( "carrera", "carrerainvs", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "becas", "becas", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "alta", "integrante.alta", 20, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y") );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "baja", "integrante.baja", 20, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y") );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "facultad", "docente.facultad", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "horasinv", "integrante.horasinv", 5, EntityGrid::TEXT_ALIGN_CENTER ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "desde", "integranteEstado.desde", 20, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y H:i:s") );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "hasta", "integranteEstado.hasta", 20, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y H:i:s") );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "motivo", "integranteEstado.motivo", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "usuario", "integranteEstado.user", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
	}

	
	
    /**
	 * opciones de menú dado el item
	 * @param unknown_type $item
	 */
	public function getMenuGroups( $item ){
	
		$group = new MenuGroup();
		
		
		
		return array( $group );
		
	} 
	
	public function getRowStyleClass($item){
		
		//return SecytUIUtils::getEstadoIntegranteEstadoCss($item->getEstado());
		
	}
	
}
?>