<?php

namespace Secyt\UI\components\filter\integranteEstado;

use Secyt\UI\components\filter\model\UIIntegranteEstadoCriteria;

use Secyt\UI\components\filter\model\UIIntegranteCriteria;



use Secyt\UI\components\grid\model\IntegranteEstadoGridModel;

use Secyt\UI\service\finder\IntegranteFinder;



use Secyt\UI\service\UIServiceFactory;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

/**
 * 
 * Enter description here ...
 * @author marcos.piñero
 *
 */
class IntegranteEstadoFilter extends Filter{
		
	public function getType(){
		
		return "IntegranteEstadoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new IntegranteEstadoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIIntegranteEstadoCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		
		
		
		
		
		$this->addProperty("integrante");
		
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		
		
		parent::parseXTemplate($xtpl);
		
		
		
		
		$xtpl->assign("lbl_integrante",  $this->localize("criteria.integrante") );
		
		$integrante = UIServiceFactory::getUIIntegranteService()->get( RastyUtils::getParamGET("integranteOid") );
		
		if( !empty( $integrante)  ){
			
			$this->fillInput("integrante", $integrante );
		}
		
		
	}
	
	public function getIntegranteFinderClazz(){
		
		return get_class( new IntegranteFinder() );
		
	}	

	public function getIntegrantes(){
		
		$tipos = UIServiceFactory::getUIIntegranteService()->getList( new UIIntegranteCriteria() );
		
		return $tipos;		
	}
	
	
	
}
?>