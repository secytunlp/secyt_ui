<?php
namespace Secyt\UI\actions\docentes;

use Secyt\UI\components\form\docente\DocenteForm;

use Secyt\UI\service\UIServiceFactory;
use Secyt\Core\model\Docente;

use Rasty\actions\Action;
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
 * Enter description here ...
 * @author usuario
 *
 */
class EliminarDocente extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$oid = RastyUtils::getParamPOST("oid");			
						
		try {

			//eliminamos el usuario
			UIServiceFactory::getUIDocenteService()->delete( $oid );
			
			$forward->setPageName( "Docentes" );
			
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "DocenteEliminar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
		}
		
		return $forward;
		
	}

}
?>