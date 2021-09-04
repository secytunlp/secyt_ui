<?php
namespace Secyt\UI\actions\integrantes;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\service\UIServiceFactory;
//use Secyt\UI\utils\SecytUtils;

use Secyt\Core\utils\SecytUtils;

use Rasty\actions\JsonAction;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;



/**
 * 
 * 
 * @author Marcos
 * @since 13/04/2020
 */
class DameDocenteJson extends JsonAction{

	
	public function execute(){

		$forward = new Forward();
		
		try {
			//print_r($_POST);
			$docentePOST = RastyUtils::getParamPOST("docente") ;
			
			$docente = UIServiceFactory::getUIDocenteService()->get( $docentePOST );
			
			
			
			
			$result['mail'] = $docente->getMail();
			$result['orgbeca'] = $docente->getOrgbeca();
			$result['tipobeca'] = $docente->getTipobeca();
			$result['dtBeca'] = SecytUIUtils::formatDateToView($docente->getDtBeca());
			$result['dtBecaHasta'] = SecytUIUtils::formatDateToView($docente->getDtBecaHasta());
			
			$result['categoria'] = ($docente->getCategoria())?$docente->getCategoria()->getOid():'';
			
			$result['carrerainv'] = ($docente->getCarrerainv())?$docente->getCarrerainv()->getOid():'';
			$result['organismo'] = ($docente->getOrganismo())?$docente->getOrganismo()->getOid():'';
			$result['dtCarrerainv'] = SecytUIUtils::formatDateToView($docente->getDtCarrerainv());
			$result['cargo'] = ($docente->getCargo())?$docente->getCargo()->getOid():'';
			$result['deddoc'] = ($docente->getDeddoc())?$docente->getDeddoc()->getOid():'';
			$result['facultad'] = ($docente->getFacultad())?$docente->getFacultad()->getOid():'';
			$result['universidad'] = ($docente->getUniversidad())?$docente->getUniversidad()->getOid():'';
			$result['dtCargo'] = SecytUIUtils::formatDateToView($docente->getDtCargo());
			$result['titulo'] = ($docente->getTitulo())?$docente->getTitulo()->getOid():'';
			$result['tituloPost'] = ($docente->getTitulopost())?$docente->getTitulopost()->getOid():'';
			$result['unidad'] = ($docente->getUnidad())?$docente->getUnidad()->getOid():'';
			$result['blBecaEstimulo'] = ($docente->getBlBecaEstimulo())?1:0;
			$result['dtBecaEstimulo'] = SecytUIUtils::formatDateToView($docente->getDtBecaEstimulo());
			$result['dtBecaEstimuloHasta'] = SecytUIUtils::formatDateToView($docente->getDtBecaEstimuloHasta());
			
			$result["info"] = "success";
			
			
			
		} catch (RastyException $e) {
			
			$result["error"] =$this->localize( $e->getMessage() );
			
		}
		
		return $result;
		
	}

}
?>