<?php

namespace Secyt\UI\components\filter\proyecto;

use Secyt\UI\components\filter\model\UIProyectoCriteria;

use Secyt\UI\components\filter\model\UIFacultadCriteria;

use Secyt\UI\components\filter\model\UITipoAcreditacionCriteria;

use Secyt\UI\components\filter\model\UIEstadoProyectoCriteria;

use Secyt\UI\components\filter\model\UIDocenteCriteria;

use Secyt\UI\components\grid\model\ProyectoGridModel;

use Secyt\UI\service\finder\FacultadFinder;

use Secyt\UI\service\finder\TipoAcreditacionFinder;

use Secyt\UI\service\finder\EstadoProyectoFinder;

use Secyt\UI\service\finder\DocenteFinder;

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
class ProyectoFilter extends Filter{
		
	public function getType(){
		
		return "ProyectoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new ProyectoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIProyectoCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		
		$this->addProperty("codigo");
		
		$this->addProperty("filtroPredefinido");
		
		$this->addProperty("tipoAcreditacion");
		$this->addProperty("facultad");
		$this->addProperty("estado");
		
		$this->addProperty("director");
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_codigo",  $this->localize("criteria.codigo") );
		
		
		$xtpl->assign("lbl_tipoAcreditacion",  $this->localize("criteria.tipoAcreditacion") );
		$xtpl->assign("lbl_facultad",  $this->localize("criteria.facultad") );
		
		$xtpl->assign("lbl_estado",  $this->localize("proyecto.estado") );		
		
		$xtpl->assign("lbl_predefinidos",  $this->localize("criteria.predefinidos") );
		
		$xtpl->assign("lbl_director",  $this->localize("proyecto.director") );		
	}
	
	public function getFacultadFinderClazz(){
		
		return get_class( new FacultadFinder() );
		
	}	

	public function getFacultades(){
		
		$tipos = UIServiceFactory::getUIFacultadService()->getList( new UIFacultadCriteria() );
		
		return $tipos;		
	}
	
	public function getTipoAcreditacionFinderClazz(){
		
		return get_class( new TipoAcreditacionFinder() );
		
	}	

	public function getTipoAcreditacions(){
		
		$tipos = UIServiceFactory::getUITipoAcreditacionService()->getList( new UITipoAcreditacionCriteria() );
		
		return $tipos;		
	}
	
	public function getEstadoFinderClazz(){
		
		return get_class( new EstadoProyectoFinder() );
		
	}
	
	public function getEstados(){
		$criteria = new UIEstadoProyectoCriteria();
		
		$criteria->addOrder("nombre", "ASC");
		$facultades = UIServiceFactory::getUIEstadoProyectoService()->getList($criteria);
		
		return $facultades;
		
	}
	
	public function getFiltrosPredefinidos(){
		
		$items = array();
		
		
		$items[ UIProyectoCriteria::ANIO_ACTUAL ] = $this->localize("proyecto.filter.anioActual");
		
		
		return $items;
		
	}
	
	public function getDirectorFinderClazz(){
		
		return get_class( new DocenteFinder() );
		
	}
	
	public function getDirectores(){
		
		$criteria = new UIDocenteCriteria();
		
		$criteria->addOrder("apellido", "ASC");
		
		$docentes = UIServiceFactory::getUIDocenteService()->getList($criteria);
		
		return $docentes;
		
	}
	

	
}
?>