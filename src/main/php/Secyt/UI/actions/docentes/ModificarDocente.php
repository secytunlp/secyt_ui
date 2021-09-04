<?php
namespace Secyt\UI\actions\docentes;

use Secyt\UI\components\form\docente\DocenteForm;

use Secyt\UI\service\UIServiceFactory;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

use Rasty\utils\Logger;
/**
 * 
 * Enter description here ...
 * @author marcos.piñero
 *
 */
class ModificarDocente extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("DocenteModificar");
		
		$docenteForm = $page->getComponentById("docenteForm");
			
		$oid = $docenteForm->getOid();
		
		
						
		try {
			
			//obtenemos la docente.
			$docente = UIServiceFactory::getUIDocenteService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$docenteForm->fillEntity($docente);
			
			
			
			//guardamos los cambios.
			UIServiceFactory::getUIDocenteService()->update( $docente );
			
			$forward->setPageName( $docenteForm->getBackToOnSuccess() );
			$forward->addParam( "docenteOid", $docente->getOid() );
			
			$docenteForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "DocenteModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$docenteForm->save();
			
		}
		return $forward;
		
	}

}
?>