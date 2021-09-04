<?php
namespace Secyt\UI\actions\docentes;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\service\UICargoService;

use Secyt\UI\service\UIServiceFactory;

use Rasty\actions\JsonAction;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;

use Rasty\app\RastyMapHelper;
use Rasty\factory\ComponentFactory;
use Rasty\factory\ComponentConfig;

/**
 * se borra un detalle de docente para la edición
 * en sesión.
 * 
 * @author Marcos
 * @since 26/06/2015
 */
class BorrarCargoDocenteJson extends JsonAction{

	
	public function execute(){

		$rasty= RastyMapHelper::getInstance();
		
		try {

			//indice del detalle a eliminar.
			$index = RastyUtils::getParamPOST("index");
			if(empty($index))
				$index = 0;
			//eliminamos el detalle dado el índice
			SecytUIUtils::deleteCargoDocenteSession($index);			
			
			$cargos = SecytUIUtils::getCargosDocenteSession();
			$result["cargos"] = $cargos;
			
			
			
			
						
		} catch (RastyException $e) {
		
			$result["error"] = $e->getMessage();
		}
		
		return $result;
		
	}

}
?>