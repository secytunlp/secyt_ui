<?php

namespace Secyt\UI\components\filter\permiso;

use Secyt\UI\service\UIServiceFactory;

use Secyt\UI\components\filter\model\UIPermisoCriteria;

use Secyt\UI\components\grid\model\PermisoGridModel;
use Secyt\UI\service\finder\PermisoFinder;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar Permisos
 * 
 * @author Bernardo
 * @since 06/11/2014
 */
class PermisoFilter extends Filter{
		
	public function getType(){
		
		return "PermisoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new PermisoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIPermisoCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("name");
		$this->addProperty("parent");
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		$this->fillInput("name", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_name",  $this->localize("permiso.name") );
		$xtpl->assign("lbl_parent",  $this->localize("permiso.padre") );
		
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "PermisoModificar") );
		
		
	}
	
	public function getPermisoFinderClazz(){
		
		return get_class( new PermisoFinder() );
		
	}	

	public function getPermisos(){
		
		$categorias = UIServiceFactory::getUIPermisoService()->getList( new UIPermisoCriteria() );
		
		return $categorias;
		
	}
}
?>