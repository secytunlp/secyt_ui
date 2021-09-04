<?php
namespace Secyt\UI\actions\docentes;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\service\UITituloService;

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
 * @author Bernardo
 * @since 27/05/2014
 */
class BorrarTituloDocenteJson extends JsonAction{

	
	public function execute(){

		$rasty= RastyMapHelper::getInstance();
		
		try {

			//indice del detalle a eliminar.
			$index = RastyUtils::getParamPOST("index");
			if(empty($index))
				$index = 0;
			//eliminamos el detalle dado el índice
			SecytUIUtils::deleteTituloDocenteSession($index);			
			
			$titulos = SecytUIUtils::getTitulosDocenteSession();
			$result["titulos"] = $titulos;
			
			
			
			
						
		} catch (RastyException $e) {
		
			$result["error"] = $e->getMessage();
		}
		
		return $result;
		
	}

}
?>