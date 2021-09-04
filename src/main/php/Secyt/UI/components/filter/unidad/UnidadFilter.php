<?php

namespace Secyt\UI\components\filter\unidad;

use Secyt\UI\components\filter\model\UIUnidadCriteria;

use Secyt\UI\components\grid\model\UnidadGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * 
 * Enter description here ...
 * @author marcos.piñero
 *
 */
class UnidadFilter extends Filter{
		
	public function getType(){
		
		return "UnidadFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new UnidadGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIUnidadCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		
		$this->addProperty("nombre");
		$this->addProperty("sigla");
		$this->addProperty("padre");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		
		
		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("lbl_nombre",  $this->localize("criteria.nombre") );
		$xtpl->assign("lbl_sigla",  $this->localize("criteria.sigla") );
		$xtpl->assign("lbl_padre",  $this->localize("criteria.padre") );
				
		
		
	}
	
	
}
?>