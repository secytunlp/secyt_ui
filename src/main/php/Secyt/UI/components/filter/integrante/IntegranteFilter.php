<?php

namespace Secyt\UI\components\filter\integrante;

use Secyt\UI\components\filter\model\UIIntegranteCriteria;

use Secyt\UI\components\filter\model\UIProyectoCriteria;



use Secyt\UI\components\grid\model\IntegranteGridModel;

use Secyt\UI\service\finder\ProyectoFinder;



use Secyt\UI\service\UIServiceFactory;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;

/**
 * 
 * Enter description here ...
 * @author marcos.piñero
 *
 */
class IntegranteFilter extends Filter{
		
	public function getType(){
		
		return "IntegranteFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new IntegranteGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIIntegranteCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		
		
		
		
		
		$this->addProperty("proyecto");
		$this->addProperty("codigo");
		$this->addProperty("investigador");
		$this->addProperty("documento");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_codigo",  $this->localize("criteria.codigo") );
		
		
		$xtpl->assign("lbl_proyecto",  $this->localize("criteria.proyecto") );
		$xtpl->assign("lbl_codigo",  $this->localize("criteria.codigo") );
		$xtpl->assign("lbl_investigador",  $this->localize("criteria.investigador") );
		
		$xtpl->assign("lbl_documento",  $this->localize("docente.documento") );		
		
		$proyecto = UIServiceFactory::getUIProyectoService()->get( RastyUtils::getParamGET("proyectoOid") );
		
		if( !empty( $proyecto)  ){
			
			$this->fillInput("proyecto", $proyecto );
		}
		
		
	}
	
	public function getProyectoFinderClazz(){
		
		return get_class( new ProyectoFinder() );
		
	}	

	public function getProyectos(){
		
		$tipos = UIServiceFactory::getUIProyectoService()->getList( new UIProyectoCriteria() );
		
		return $tipos;		
	}
	
	
	
}
?>