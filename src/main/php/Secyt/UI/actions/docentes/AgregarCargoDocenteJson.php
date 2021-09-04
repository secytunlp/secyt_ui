<?php
namespace Secyt\UI\actions\docentes;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\service\UICargoService;

use Secyt\UI\service\UIDeddocService;

use Secyt\UI\service\UIFacultadService;

use Secyt\UI\service\UIServiceFactory;

use Secyt\Core\model\DocenteCargo;

use Rasty\actions\JsonAction;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;

use Rasty\app\RastyMapHelper;
use Rasty\factory\ComponentFactory;
use Rasty\factory\ComponentConfig;
use Rasty\utils\Logger;

/**
 * se agrega un cargo de docente para la ediciÃ³n
 * en sesiÃ³n.
 * 
 * @author Marcos
 * @since 26-06-2015
 */
class AgregarCargoDocenteJson extends JsonAction{

	
	public function execute(){

		$rasty= RastyMapHelper::getInstance();
		
		try {

			//creamos el cargo de docente.
			$docenteCargo = new DocenteCargo();

			$cargoOid = RastyUtils::getParamPOST("cargo");
			
			$cargo = UICargoService::getInstance()->get( $cargoOid ) ;
			$docenteCargo->setCargo($cargo);
			
			$deddocOid = RastyUtils::getParamPOST("deddoc");
			
			$deddoc = UIDeddocService::getInstance()->get( $deddocOid ) ;
			$docenteCargo->setDeddoc($deddoc);
			
			$facultadOid = RastyUtils::getParamPOST("cargoFacultad");
			$facultad = UIFacultadService::getInstance()->get( $facultadOid ) ;
			
			$docenteCargo->setFacultad($facultad);
			
			$docenteCargo->setFechaDesde(RastyUtils::getParamPOST("cargoDesde"));
			$docenteCargo->setFechaHasta(RastyUtils::getParamPOST("cargoHasta"));
			
			
			//tomamos los cargos de sesiÃ³n y agregamos el nuevo.
			SecytUIUtils::addCargoDocenteSession($docenteCargo);			
			
			$cargos = SecytUIUtils::getCargosDocenteSession();
			$result["cargos"] = $cargos;
			
			
			
			
						
		} catch (RastyException $e) {
		
			$result["error"] = $e->getMessage();
		}
		
		return $result;
		
	}

}
?>