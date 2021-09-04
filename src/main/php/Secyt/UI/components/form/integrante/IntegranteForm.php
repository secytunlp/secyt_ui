<?php

namespace Secyt\UI\components\form\integrante;

use Secyt\UI\service\finder\FacultadFinder;

use Secyt\UI\service\finder\CategoriaFinder;

use Secyt\UI\service\finder\UniversidadFinder;

use Secyt\UI\service\finder\UnidadFinder;

use Secyt\UI\service\finder\TituloFinder;

use Secyt\UI\service\finder\CargoFinder;

use Secyt\UI\service\finder\DeddocFinder;

use Secyt\UI\service\finder\CarrerainvFinder;

use Secyt\UI\service\finder\OrganismoFinder;

use Secyt\UI\service\finder\ProyectoFinder;

use Secyt\UI\service\finder\TipoInvestigadorFinder;

use Secyt\UI\service\finder\DocenteFinder;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\service\UIServiceFactory;

use Secyt\UI\components\filter\model\UIFacultadCriteria;

use Secyt\UI\components\filter\model\UIProvinciaCriteria;

use Secyt\UI\components\filter\model\UICategoriaCriteria;

use Secyt\UI\components\filter\model\UIUniversidadCriteria;

use Secyt\UI\components\filter\model\UIUnidadCriteria;

use Secyt\UI\components\filter\model\UITituloCriteria;

use Secyt\UI\components\filter\model\UICargoCriteria;

use Secyt\UI\components\filter\model\UIDeddocCriteria;

use Secyt\UI\components\filter\model\UICarrerainvCriteria;

use Secyt\UI\components\filter\model\UIOrganismoCriteria;

use Secyt\UI\components\filter\model\UIProyectoCriteria;

use Secyt\UI\components\filter\model\UITipoInvestigadorCriteria;

use Secyt\UI\components\filter\model\UIDocenteCriteria;

use Secyt\UI\service\UICargoService;

use Secyt\UI\service\UIDeddocService;

use Secyt\UI\service\UIFacultadService;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Secyt\Core\model\Integrante;


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
class IntegranteForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Integrante
	 */
	private $integrante;
	
	
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		
		$this->addProperty("mail");
		
		
		$this->addProperty("proyecto");
		$this->addProperty("tipo");
		$this->addProperty("docente");
		$this->addProperty("mail");
		$this->addProperty("categoria");
		$this->addProperty("facultad");
		$this->addProperty("universidad");
		$this->addProperty("unidad");
		$this->addProperty("titulo");
		$this->addProperty("tituloPost");
		$this->addProperty("cargo");
		$this->addProperty("deddoc");
		$this->addProperty("dtCargo");
		$this->addProperty("carrerainv");
		$this->addProperty("organismo");
		$this->addProperty("dtCarrerainv");
		$this->addProperty("orgbeca");
		$this->addProperty("tipobeca");
		$this->addProperty("dtBeca");
		$this->addProperty("dtBecaHasta");
		$this->addProperty("blBecaEstimulo");
		$this->addProperty("dtBecaEstimulo");
		$this->addProperty("dtBecaEstimuloHasta");
		$this->addProperty("horasinv");
		$this->addProperty("alta");
		$this->addProperty("baja");
		
		$this->setBackToOnSuccess("Integrantes");
		$this->setBackToOnCancel("Integrantes");
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "IntegranteForm";
		
	}
	
	public function fillEntity($entity){
	
		parent::fillEntity($entity);
		
		
		/*$cuil =  RastyUtils::getParamPOST("cuil");
		
		$separarCUIL = explode('-',$cuil);
		$entity->setPrecuil($separarCUIL[0]);
		$entity->setDocumento($separarCUIL[1]);
		$entity->setPostcuil($separarCUIL[2]);*/
		
		$entity->setBecario((RastyUtils::getParamPOST("orgbeca"))?1:0);
	
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("personal_tab", $this->localize("integrante.proyecto") );
		$xtpl->assign("titulos_tab", $this->localize("docente.titulos") );
		$xtpl->assign("docencia_tab", $this->localize("docente.docencia") );
		$xtpl->assign("investigacion_tab", $this->localize("docente.investigacion") );
		
		
		$xtpl->assign("lbl_proyecto", $this->localize("integrante.proyecto") );
		$xtpl->assign("lbl_tipo", $this->localize("integrante.tipo") );
		$xtpl->assign("lbl_investigador", $this->localize("integrante.investigador") );
		$xtpl->assign("lbl_mail", $this->localize("docente.mail") );
		
		$xtpl->assign("lbl_horasinv", $this->localize("integrante.horasinv") );
		$xtpl->assign("lbl_alta", $this->localize("integrante.alta") );
		$xtpl->assign("lbl_baja", $this->localize("integrante.baja") );
		
		$xtpl->assign("lbl_categoria", $this->localize("docente.categoria") );
		$xtpl->assign("lbl_universidad", $this->localize("docente.universidad") );
		$xtpl->assign("lbl_unidad", $this->localize("docente.unidad") );
		
		$xtpl->assign("lbl_titulo", $this->localize("docente.titulo") );
		$xtpl->assign("lbl_tituloPost", $this->localize("docente.tituloPost") );
		
		
		$xtpl->assign("lbl_cargo_nombre", $this->localize("cargo.nombre") );
		$xtpl->assign("lbl_cargo_dedicacion", $this->localize("cargo.dedicacion") );
		$xtpl->assign("lbl_cargo_desde", $this->localize("cargo.desde") );
		$xtpl->assign("lbl_cargo_hasta", $this->localize("cargo.hasta") );
		$xtpl->assign("lbl_facultad", $this->localize("cargo.facultad") );
		
		
		
		$xtpl->assign("lbl_carrerainv_legend", $this->localize("carrerainvs") );
		$xtpl->assign("lbl_carrerainv", $this->localize("carrera.nombre") );
		$xtpl->assign("lbl_organismo", $this->localize("organismo.nombre") );
		
		$xtpl->assign("lbl_becas_legend", $this->localize("becas") );
		$xtpl->assign("lbl_orgbeca", $this->localize("beca.organismo") );
		$xtpl->assign("lbl_tipobeca", $this->localize("beca.tipo") );
		
		$xtpl->assign("lbl_blBecaEstimulo", $this->localize("beca.evc") );
		
		
		$xtpl->assign("linkDameDocente", $this->getLinkDameDocente() );
		$xtpl->assign("linkDameTipoBeca", $this->getLinkDameTipoBeca() );
		
		
		
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
		if (RastyUtils::getParamGET("proyectoOid")) {
			$proyecto = UIServiceFactory::getUIProyectoService()->get( RastyUtils::getParamGET("proyectoOid") );
		}
		else{
			$proyecto = $this->getIntegrante()->getProyecto();
		}
		$params = array('proyectoOid'=>$proyecto->getOid());
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	
	

	public function getIntegrante()
	{
	    return $this->integrante;
	}

	public function setIntegrante($integrante)
	{
	    $this->integrante = $integrante;
	    
		
		
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
	
	
	
	public function getCategoriaFinderClazz(){
		
		return get_class( new CategoriaFinder() );
		
	}
	
	public function getCategorias(){
		
		$categoriaes = UIServiceFactory::getUICategoriaService()->getList(new UICategoriaCriteria());
		
		return $categoriaes;
		
	}
	
	public function getUniversidadFinderClazz(){
		
		return get_class( new UniversidadFinder() );
		
	}
	
	public function getUniversidades(){
		$criteria = new UIUniversidadCriteria();
		
		$criteria->addOrder("nombre", "ASC");
		$universidades = UIServiceFactory::getUIUniversidadService()->getList($criteria);
		
		return $universidades;
		
	}
	
	
	
	public function getTituloFinderClazz(){
		
		return get_class( new TituloFinder() );
		
	}
	
	public function getTitulos(){
		$criteria = new UITituloCriteria();
		$criteria->setNivel(1);
		$criteria->addOrder("nombre", "ASC");
		$titulos = UIServiceFactory::getUITituloService()->getList($criteria);
		
		return $titulos;
		
	}
	
	public function getTitulosPost(){
		$criteria = new UITituloCriteria();
		$criteria->setNivel(2);
		$criteria->addOrder("nombre", "ASC");
		$titulos = UIServiceFactory::getUITituloService()->getList($criteria);
		
		return $titulos;
		
	}
	
	
	public function getCargoFinderClazz(){
		
		return get_class( new CargoFinder() );
		
	}
	
	public function getCargos(){
		$criteria = new UICargoCriteria();
		
		$criteria->addOrder("orden", "ASC");
		$cargos = UIServiceFactory::getUICargoService()->getList($criteria);
		
		return $cargos;
		
	}
	
	public function getDeddocFinderClazz(){
		
		return get_class( new DeddocFinder() );
		
	}
	
	public function getDeddocs(){
		
		$deddocs = UIServiceFactory::getUIDeddocService()->getList(new UIDeddocCriteria());
		
		return $deddocs;
		
	}
	
	public function getCarrerainvFinderClazz(){
		
		return get_class( new CarrerainvFinder() );
		
	}
	
	public function getCarrerainvs(){
		
		$criteria = new UICarrerainvCriteria();
		
		$criteria->addOrder("nombre", "ASC");
		
		$facultades = UIServiceFactory::getUICarrerainvService()->getList($criteria);
		
		return $facultades;
		
	}
	
	public function getOrganismoFinderClazz(){
		
		return get_class( new OrganismoFinder() );
		
	}
	
	
	public function getOrganismos(){
		
		$criteria = new UIOrganismoCriteria();
		
		$criteria->addOrder("codigo", "ASC");
		
		$facultades = UIServiceFactory::getUIOrganismoService()->getList($criteria);
		
		return $facultades;
		
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
	
	public function getOrgbecas(){
		
		$items = array();
		
		
		$items['0'] = $this->localize("criteria.sin_especificar");
		
		foreach (Institucion::getItems() as $key => $value) {
			$items[ $key] = $this->localize($value);
		}
		
		
		
		
		return $items;
		
	}
	
	public function getTipobecas(){
		
		$items = array();
		
		$items['0'] = $this->localize("criteria.sin_especificar");
		
	foreach (Tipobeca::getItems() as $key => $value) {
			$items[ $key] = $this->localize($value);
		}
		
		
		return $items;
		
	}
	
	
	public function getLinkDameDocente(){
		
		return LinkBuilder::getActionAjaxUrl( "DameDocenteJson") ;
	}
	
	public function getProyectoFinderClazz(){
		
		return get_class( new ProyectoFinder() );
		
	}
	
	
	public function getProyectos(){
		
		$criteria = new UIProyectoCriteria();
		
		$criteria->addOrder("codigo", "ASC");
		
		$proyectos = UIServiceFactory::getUIProyectoService()->getList($criteria);
		
		return $proyectos;
		
	}
	
	public function getTipoFinderClazz(){
		
		return get_class( new TipoInvestigadorFinder() );
		
	}
	
	
	public function getTipos(){
		
		$criteria = new UITipoInvestigadorCriteria();
		
		//$criteria->addOrder("nombre", "ASC");
		
		$tipos = UIServiceFactory::getUITipoInvestigadorService()->getList($criteria);
		
		return $tipos;
		
	}
	
	public function getDocenteFinderClazz(){
		
		return get_class( new DocenteFinder() );
		
	}
	
	
	public function getDocentes(){
		
		$criteria = new UIDocenteCriteria();
		
		$criteria->addOrder("apellido", "ASC");
		
		$docentes = UIServiceFactory::getUIDocenteService()->getList($criteria);
		
		return $docentes;
		
	}
	
	public function getLinkDameTipoBeca(){
		
		return LinkBuilder::getActionAjaxUrl( "DameTipoBecaJson") ;
	}
	
}
?>