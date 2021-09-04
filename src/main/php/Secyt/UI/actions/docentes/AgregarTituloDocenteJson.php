<?php
namespace Secyt\UI\actions\docentes;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\service\UITituloService;

use Secyt\UI\service\UIServiceFactory;

use Secyt\Core\model\Titulo;

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
 * se agrega un titulo de docente para la ediciÃ³n
 * en sesiÃ³n.
 * 
 * @author Marcos
 * @since 24-06-2015
 */
class AgregarTituloDocenteJson extends JsonAction{

	
	public function execute(){

		$rasty= RastyMapHelper::getInstance();
		
		try {

			//creamos el titulo de docente.
			//$titulo = new Titulo();

			$tituloOid = RastyUtils::getParamPOST("titulo");
			
			
			$titulo = UITituloService::getInstance()->get( $tituloOid ) ;
			
			//tomamos los titulos de sesiÃ³n y agregamos el nuevo.
			SecytUIUtils::addTituloDocenteSession($titulo);			
			
			$titulos = SecytUIUtils::getTitulosDocenteSession();
			$result["titulos"] = $titulos;
			
			
			
			
						
		} catch (RastyException $e) {
		
			$result["error"] = $e->getMessage();
		}
		
		return $result;
		
	}

}
?>