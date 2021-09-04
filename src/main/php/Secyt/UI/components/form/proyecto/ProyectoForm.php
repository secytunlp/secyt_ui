<?php

namespace Secyt\UI\components\form\proyecto;

use Secyt\UI\service\finder\FacultadFinder;

use Secyt\UI\service\finder\EstadoProyectoFinder;

use Secyt\UI\service\finder\TipoAcreditacionFinder;

use Secyt\UI\service\finder\EspecialidadFinder;

use Secyt\UI\service\finder\UnidadFinder;

use Secyt\UI\service\finder\DisciplinaFinder;

use Secyt\UI\service\finder\CampoFinder;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\service\UIServiceFactory;

use Secyt\UI\components\filter\model\UIFacultadCriteria;

use Secyt\UI\components\filter\model\UIEstadoProyectoCriteria;

use Secyt\UI\components\filter\model\UITipoAcreditacionCriteria;

use Secyt\UI\components\filter\model\UIEspecialidadCriteria;

use Secyt\UI\components\filter\model\UIUnidadCriteria;

use Secyt\UI\components\filter\model\UIDisciplinaCriteria;

use Secyt\UI\components\filter\model\UICampoCriteria;

use Secyt\UI\service\UIFacultadService;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Secyt\Core\model\Proyecto;



use Rasty\utils\LinkBuilder;
use Rasty\utils\Logger;

use Secyt\Core\model\Institucion;
use Secyt\Core\model\Tipobeca;
/**
 * 
 * Enter description here ...
 * @author marcos.piñero
 *
 */
class ProyectoForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Proyecto
	 */
	private $proyecto;
	
	
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("codigo");
		$this->addProperty("tipoAcreditacion");
		$this->addProperty("inicio");
		$this->addProperty("fin");
		$this->addProperty("titulo");
		$this->addProperty("estado");
		$this->addProperty("codigoSIGEVA");
		$this->addProperty("facultad");
		$this->addProperty("unidad");
		$this->addProperty("abstract");
		$this->addProperty("abstractEng");
		$this->addProperty("clave1");
		$this->addProperty("clave2");
		$this->addProperty("clave3");
		$this->addProperty("clave4");
		$this->addProperty("claveEng1");
		$this->addProperty("claveEng2");
		$this->addProperty("claveEng3");
		$this->addProperty("claveEng4");
		$this->addProperty("especialidad");
		$this->addProperty("disciplina");
		$this->addProperty("tipo");
		$this->addProperty("campo");
		$this->addProperty("linea");
		
		$this->setBackToOnSuccess("Proyectos");
		$this->setBackToOnCancel("Proyectos");
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "ProyectoForm";
		
	}
	
	public function fillEntity($entity){
	
		parent::fillEntity($entity);
		
		$entity->setDuracion(SecytUIUtils::getYears(RastyUtils::getParamPOST("inicio"), RastyUtils::getParamPOST("fin"))+1 );
	
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("proyecto_tab", $this->localize("proyecto.basicos") );
		$xtpl->assign("entidades_tab", $this->localize("proyecto.entidades") );
		$xtpl->assign("resumen_tab", $this->localize("proyecto.resumen") );
		$xtpl->assign("claves_tab", $this->localize("proyecto.claves") );
		$xtpl->assign("otros_tab", $this->localize("proyecto.otros") );
		
		$xtpl->assign("lbl_tipoAcreditacion", $this->localize("proyecto.tipoAcreditacion") );
		$xtpl->assign("lbl_codigo", $this->localize("proyecto.codigo") );
		$xtpl->assign("lbl_inicio", $this->localize("proyecto.inicio") );
		$xtpl->assign("lbl_fin", $this->localize("proyecto.fin") );
		$xtpl->assign("lbl_titulo", $this->localize("proyecto.titulo") );
		$xtpl->assign("lbl_codigoSIGEVA", $this->localize("proyecto.codigoSIGEVA") );
		$xtpl->assign("lbl_estado", $this->localize("proyecto.estado") );
		$xtpl->assign("lbl_facultad", $this->localize("proyecto.facultad") );
		$xtpl->assign("lbl_unidad", $this->localize("proyecto.unidad") );
		$xtpl->assign("lbl_abstract", $this->localize("proyecto.abstract") );
		$xtpl->assign("lbl_abstractEng", $this->localize("proyecto.abstractEng") );
		$xtpl->assign("lbl_clave1", $this->localize("proyecto.clave1") );
		$xtpl->assign("lbl_clave2", $this->localize("proyecto.clave2") );
		$xtpl->assign("lbl_clave3", $this->localize("proyecto.clave3") );
		$xtpl->assign("lbl_clave4", $this->localize("proyecto.clave4") );
		$xtpl->assign("lbl_claveEng1", $this->localize("proyecto.claveEng1") );
		$xtpl->assign("lbl_claveEng2", $this->localize("proyecto.claveEng2") );
		$xtpl->assign("lbl_claveEng3", $this->localize("proyecto.claveEng3") );
		$xtpl->assign("lbl_claveEng4", $this->localize("proyecto.claveEng4") );
		$xtpl->assign("lbl_disciplina", $this->localize("proyecto.disciplina") );
		$xtpl->assign("lbl_especialidad", $this->localize("proyecto.especialidad") );
		$xtpl->assign("lbl_tipo", $this->localize("proyecto.tipo") );
		$xtpl->assign("lbl_campo", $this->localize("proyecto.campo") );
		$xtpl->assign("lbl_linea", $this->localize("proyecto.linea") );
		
		$xtpl->assign("linkDameEspecialidad", $this->getLinkDameEspecialidad() );
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	
	

	public function getProyecto()
	{
	    return $this->proyecto;
	}

	public function setProyecto($proyecto)
	{
	    $this->proyecto = $proyecto;
	    
		
		
	}

	
	
	public function getFacultadFinderClazz(){
		
		return get_class( new FacultadFinder() );
		
	}
	
	public function getFacultades(){
		
		$criteria = new UIFacultadCriteria();
		
		$criteria->addOrder("nombre", "ASC");
		
		$facultades = UIServiceFactory::getUIFacultadService()->getList($criteria);
		
		return $facultades;
		
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
	
	public function getTipoAcreditacionFinderClazz(){
		
		return get_class( new TipoAcreditacionFinder() );
		
	}
	
	public function getTipoAcreditaciones(){
		
		$categoriaes = UIServiceFactory::getUITipoAcreditacionService()->getList(new UITipoAcreditacionCriteria());
		
		return $categoriaes;
		
	}
	
	public function getEspecialidadFinderClazz(){
		
		return get_class( new EspecialidadFinder() );
		
	}
	
	public function getEspecialidades(){
		$criteria = new UIEspecialidadCriteria();
		
		$criteria->addOrder("nombre", "ASC");
		$universidades = UIServiceFactory::getUIEspecialidadService()->getList($criteria);
		
		return $universidades;
		
	}
	
	
	
	public function getDisciplinaFinderClazz(){
		
		return get_class( new DisciplinaFinder() );
		
	}
	
	public function getDisciplinas(){
		$criteria = new UIDisciplinaCriteria();
		$criteria->addOrder("nombre", "ASC");
		$titulos = UIServiceFactory::getUIDisciplinaService()->getList($criteria);
		
		return $titulos;
		
	}
	
	
	
	
	
	
	public function getUnidadFinderClazz(){
		
		return get_class( new UnidadFinder() );
		
	}
	
	
	public function getUnidades(){
		
		$criteria = new UIUnidadCriteria();
		
		$criteria->addOrder("nombre", "ASC");
		
		$facultades = UIServiceFactory::getUIUnidadService()->getList($criteria);
		
		return $facultades;
		
	}
	
	
	
	
	public function getLinkDameEspecialidad(){
		
		return LinkBuilder::getActionAjaxUrl( "DameEspecialidadJson") ;
	}
	
	public function getTipos(){
		
		$items = array();
		
		$items['0'] = $this->localize("criteria.sin_especificar");
		$items[ 'A' ] = $this->localize("tipo.aplicada");
		$items[ 'B' ] = $this->localize("tipo.basica");
		$items[ 'D' ] = $this->localize("tipo.desarrollo");
		
		
		
		return $items;
		
	}
	
	public function getCampoFinderClazz(){
		
		return get_class( new CampoFinder() );
		
	}
	
	public function getCampos(){
		$criteria = new UICampoCriteria();
		$criteria->addOrder("nombre", "ASC");
		$titulos = UIServiceFactory::getUICampoService()->getList($criteria);
		
		return $titulos;
		
	}
	
}
?>