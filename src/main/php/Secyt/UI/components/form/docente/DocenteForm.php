<?php

namespace Secyt\UI\components\form\docente;

use Secyt\UI\service\finder\FacultadFinder;

use Secyt\UI\service\finder\ProvinciaFinder;

use Secyt\UI\service\finder\CategoriaFinder;

use Secyt\UI\service\finder\UniversidadFinder;

use Secyt\UI\service\finder\UnidadFinder;

use Secyt\UI\service\finder\TituloFinder;

use Secyt\UI\service\finder\CargoFinder;

use Secyt\UI\service\finder\DeddocFinder;

use Secyt\UI\service\finder\CarrerainvFinder;

use Secyt\UI\service\finder\OrganismoFinder;

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

use Secyt\UI\service\UICargoService;

use Secyt\UI\service\UIDeddocService;

use Secyt\UI\service\UIFacultadService;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Secyt\Core\model\Docente;


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
class DocenteForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Docente
	 */
	private $docente;
	
	
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("apellido");
		$this->addProperty("nombre");
		$this->addProperty("nacimiento");
		$this->addProperty("sexo");
		$this->addProperty("mail");
		$this->addProperty("telefono");
		$this->addProperty("calle");
		$this->addProperty("nro");
		$this->addProperty("piso");
		$this->addProperty("depto");
		$this->addProperty("localidad");
		$this->addProperty("provincia");
		$this->addProperty("cp");
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
		
		
		$this->setBackToOnSuccess("Docentes");
		$this->setBackToOnCancel("Docentes");
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "DocenteForm";
		
	}
	
	public function fillEntity($entity){
	
		parent::fillEntity($entity);
		
		/*$titulos = SecytUIUtils::getTitulosDocenteSession();
		$titulosArray =  array();
		foreach ($titulos as $titulojson) {
			
			$titulo = UIServiceFactory::getUITituloService()->get($titulojson["titulo_oid"]) ;
			
			$titulosArray[]=$titulo;
			
		}
		$entity->setTitulos( $titulosArray );
		SecytUIUtils::vaciarTitulosDocenteSession();
		
		$cargos = SecytUIUtils::getCargosDocenteSession();
		
		$cargosArray =  array();
		foreach ($cargos as $cargojson) {
			//Logger::logObject($cargojson);
			$docenteCargo = new DocenteCargo();

			$docenteCargo->setDocente($entity);
			
			$cargo = UICargoService::getInstance()->get( $cargojson["cargo_oid"] ) ;
			$docenteCargo->setCargo($cargo);
			
			$deddoc = UIDeddocService::getInstance()->get( $cargojson["deddoc_oid"] ) ;
			$docenteCargo->setDeddoc($deddoc);
			
			$facultad = UIFacultadService::getInstance()->get( $cargojson["facultad_oid"] ) ;
			$docenteCargo->setFacultad($facultad);
			
			$docenteCargo->setFechaDesde(date_format($cargojson["cargo_desde"],"Y-m-d"));
			$docenteCargo->setFechaHasta(date_format($cargojson["cargo_hasta"],"Y-m-d"));
			
			
			$cargosArray[]=$docenteCargo;
		}
		$entity->setCargos( $cargosArray );
		SecytUIUtils::vaciarCargosDocenteSession();*/
		//separo el cuil.
		$cuil =  RastyUtils::getParamPOST("cuil");
		
		$separarCUIL = explode('-',$cuil);
		$entity->setPrecuil($separarCUIL[0]);
		$entity->setDocumento($separarCUIL[1]);
		$entity->setPostcuil($separarCUIL[2]);
		
		$entity->setBecario((RastyUtils::getParamPOST("orgbeca"))?1:0);
	
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("personal_tab", $this->localize("docente.personal") );
		$xtpl->assign("titulos_tab", $this->localize("docente.titulos") );
		$xtpl->assign("docencia_tab", $this->localize("docente.docencia") );
		$xtpl->assign("investigacion_tab", $this->localize("docente.investigacion") );
		
		
		$xtpl->assign("lbl_nombre", $this->localize("docente.nombre") );
		$xtpl->assign("lbl_apellido", $this->localize("docente.apellido") );
		$xtpl->assign("lbl_cuil", $this->localize("docente.cuil") );
		$xtpl->assign("lbl_sexo", $this->localize("docente.sexo") );
		$xtpl->assign("lbl_nacimiento", $this->localize("docente.nacimiento") );
		$xtpl->assign("lbl_facultad", $this->localize("docente.facultad") );
		$xtpl->assign("lbl_mail", $this->localize("docente.mail") );
		$xtpl->assign("lbl_telefono", $this->localize("docente.telefono") );
		$xtpl->assign("lbl_calle", $this->localize("docente.calle") );
		$xtpl->assign("lbl_nro", $this->localize("docente.nro") );
		$xtpl->assign("lbl_piso", $this->localize("docente.piso") );
		$xtpl->assign("lbl_depto", $this->localize("docente.depto") );
		$xtpl->assign("lbl_localidad", $this->localize("docente.localidad") );
		$xtpl->assign("lbl_provincia", $this->localize("docente.provincia") );
		$xtpl->assign("lbl_cp", $this->localize("docente.cp") );
		$xtpl->assign("lbl_categoria", $this->localize("docente.categoria") );
		$xtpl->assign("lbl_universidad", $this->localize("docente.universidad") );
		$xtpl->assign("lbl_unidad", $this->localize("docente.unidad") );
		
		$xtpl->assign("lbl_titulo", $this->localize("docente.titulo") );
		$xtpl->assign("lbl_tituloPost", $this->localize("docente.tituloPost") );
		
		/*$xtpl->assign("lbl_titulo_nombre", $this->localize("titulo.nombre") );
		$xtpl->assign("lbl_titulo_universidad", $this->localize("titulo.universidad") );
		$xtpl->assign("lbl_titulo_nivel", $this->localize("titulo.nivel") );
		
		if ($this->getDocente()->getTitulos()) {
			$i=0;
			foreach ($this->getDocente()->getTitulos() as $titulo) {
				$xtpl->assign( "titulo_nombre", $titulo->getNombre() );
				$xtpl->assign( "titulo_universidad", $titulo->getUniversidad()->getNombre() );
				$xtpl->assign( "titulo_nivel", SecytUiUtils::getNivelLabel($titulo->getNivel())) ; 
				$xtpl->assign( "titulo_item", $i );
				$i++;
				$xtpl->parse( "main.titulo" );
				
				
			}
		}
		$xtpl->assign("cargos_legend", $this->localize("cargos") );*/
		$xtpl->assign("lbl_cargo_nombre", $this->localize("cargo.nombre") );
		$xtpl->assign("lbl_cargo_dedicacion", $this->localize("cargo.dedicacion") );
		$xtpl->assign("lbl_cargo_desde", $this->localize("cargo.desde") );
		$xtpl->assign("lbl_cargo_hasta", $this->localize("cargo.hasta") );
		$xtpl->assign("lbl_cargo_facultad", $this->localize("cargo.facultad") );
		
		/*if ($this->getDocente()->getCargos()) {
			$i=0;
			foreach ($this->getDocente()->getCargos() as $docenteCargo) {
				$xtpl->assign( "cargo_nombre", $docenteCargo->getCargo()->getNombre() );
				$xtpl->assign( "cargo_dedicacion", $docenteCargo->getDeddoc()->getNombre() );
				$xtpl->assign( "cargo_desde", $docenteCargo->getFechaDesde() );
				$xtpl->assign( "cargo_hasta", $docenteCargo->getFechaHasta() );
				$xtpl->assign( "cargo_facultad", $docenteCargo->getFacultad()->getNombre() );
				$xtpl->assign( "cargo_item", $i );
				$i++;
				$xtpl->parse( "main.cargo" );
				
				
			}
		}
		
		$xtpl->assign("linkAgregarTitulo", $this->getLinkActionAgregarTitulo() );
		$xtpl->assign("linkBorrarTitulo", $this->getLinkActionBorrarTitulo() );
		$xtpl->assign("linkAgregarCargo", $this->getLinkActionAgregarCargo() );
		$xtpl->assign("linkBorrarCargo", $this->getLinkActionBorrarCargo() );*/
		
		$xtpl->assign("lbl_carrerainv_legend", $this->localize("carrerainvs") );
		$xtpl->assign("lbl_carrerainv", $this->localize("carrera.nombre") );
		$xtpl->assign("lbl_organismo", $this->localize("organismo.nombre") );
		
		$xtpl->assign("lbl_becas_legend", $this->localize("becas") );
		$xtpl->assign("lbl_orgbeca", $this->localize("beca.organismo") );
		$xtpl->assign("lbl_tipobeca", $this->localize("beca.tipo") );
		
		$xtpl->assign("lbl_blBecaEstimulo", $this->localize("beca.evc") );
		
		
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
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	
	

	public function getDocente()
	{
	    return $this->docente;
	}

	public function setDocente($docente)
	{
	    $this->docente = $docente;
	    
		
		
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
	
	public function getSexos(){
		
		$items = array();
		
		$items['0'] = $this->localize("criteria.sin_especificar");
		$items[ 'F' ] = $this->localize("docente.femenino");
		$items[ 'M' ] = $this->localize("docente.masculino");
		
		
		
		return $items;
		
	}
	
	public function getProvinciaFinderClazz(){
		
		return get_class( new ProvinciaFinder() );
		
	}
	
	public function getProvincias(){
		$criteria = new UIProvinciaCriteria();
		
		$criteria->addOrder("nombre", "ASC");
		$facultades = UIServiceFactory::getUIProvinciaService()->getList($criteria);
		
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
	
	
	public function getLinkDameTipoBeca(){
		
		return LinkBuilder::getActionAjaxUrl( "DameTipoBecaJson") ;
	}
	
}
?>