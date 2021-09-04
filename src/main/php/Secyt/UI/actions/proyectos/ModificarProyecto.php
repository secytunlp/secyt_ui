<?php
namespace Secyt\UI\actions\proyectos;

use Secyt\UI\components\form\proyecto\ProyectoForm;

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
class ModificarProyecto extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("ProyectoModificar");
		
		$proyectoForm = $page->getComponentById("proyectoForm");
			
		$oid = $proyectoForm->getOid();
		
		
						
		try {
			
			//obtenemos la proyecto.
			$proyecto = UIServiceFactory::getUIProyectoService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$proyectoForm->fillEntity($proyecto);
			
			
			
			//guardamos los cambios.
			UIServiceFactory::getUIProyectoService()->update( $proyecto );
			
			$forward->setPageName( $proyectoForm->getBackToOnSuccess() );
			$forward->addParam( "proyectoOid", $proyecto->getOid() );
			
			$proyectoForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "ProyectoModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$proyectoForm->save();
			
		}
		return $forward;
		
	}

}
?>