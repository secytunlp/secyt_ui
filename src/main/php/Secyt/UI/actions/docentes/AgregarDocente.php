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

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;

use Rasty\utils\Logger;


/**
 * 
 * Enter description here ...
 * @author marcos.piñero
 *
 */
 
class AgregarDocente extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("DocenteAgregar");
		
		$docenteForm = $page->getComponentById("docenteForm");
		
		try {
			
			//creamos una nueva docente.
			$docente = new Docente();
			
			//completados con los datos del formulario.
			$docenteForm->fillEntity($docente);
			
			//agregamos el docente.
			UIServiceFactory::getUIDocenteService()->add( $docente );
			
			$forward->setPageName( $docenteForm->getBackToOnSuccess() );
			$forward->addParam( "docenteOid", $docente->getOid() );			
		
			$docenteForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "DocenteAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$docenteForm->save();
		}
		
		return $forward;
		
	}

}
?>