<?php

namespace Secyt\UI\components\filter\docente;

use Secyt\UI\components\filter\model\UIDocenteCriteria;

use Secyt\UI\components\filter\model\UIFacultadCriteria;

use Secyt\UI\components\filter\model\UICategoriaCriteria;

use Secyt\UI\components\grid\model\DocenteGridModel;

use Secyt\UI\service\finder\FacultadFinder;

use Secyt\UI\service\finder\CategoriaFinder;

use Secyt\UI\service\UIServiceFactory;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * 
 * Enter description here ...
 * @author marcos.piñero
 *
 */
class DocenteFilter extends Filter{
		
	public function getType(){
		
		return "DocenteFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new DocenteGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIDocenteCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		
		$this->addProperty("apellido");
		
		$this->addProperty("nombre");
		$this->addProperty("documento");
		$this->addProperty("categoria");
		$this->addProperty("facultad");
		
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_apellido",  $this->localize("criteria.apellido") );
		
		$xtpl->assign("lbl_nombre",  $this->localize("criteria.nombre") );
		$xtpl->assign("lbl_documento",  $this->localize("criteria.documento") );
		$xtpl->assign("lbl_categoria",  $this->localize("criteria.categoria") );
		$xtpl->assign("lbl_facultad",  $this->localize("criteria.facultad") );
		
				
		
		
	}
	
	public function getFacultadFinderClazz(){
		
		return get_class( new FacultadFinder() );
		
	}	

	public function getFacultades(){
		
		$tipos = UIServiceFactory::getUIFacultadService()->getList( new UIFacultadCriteria() );
		
		return $tipos;		
	}
	
	public function getCategoriaFinderClazz(){
		
		return get_class( new CategoriaFinder() );
		
	}	

	public function getCategorias(){
		
		$tipos = UIServiceFactory::getUICategoriaService()->getList( new UICategoriaCriteria() );
		
		return $tipos;		
	}
	
	
}
?>