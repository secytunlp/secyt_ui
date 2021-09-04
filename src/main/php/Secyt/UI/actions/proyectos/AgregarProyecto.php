<?php
namespace Secyt\UI\actions\proyectos;


use Secyt\UI\components\form\proyecto\ProyectoForm;

use Secyt\UI\service\UIServiceFactory;
use Secyt\Core\model\Proyecto;

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
 
class AgregarProyecto extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("ProyectoAgregar");
		
		$proyectoForm = $page->getComponentById("proyectoForm");
		
		try {
			
			//creamos una nueva proyecto.
			$proyecto = new Proyecto();
			
			//completados con los datos del formulario.
			$proyectoForm->fillEntity($proyecto);
			
			//agregamos el proyecto.
			UIServiceFactory::getUIProyectoService()->add( $proyecto );
			
			$forward->setPageName( $proyectoForm->getBackToOnSuccess() );
			$forward->addParam( "proyectoOid", $proyecto->getOid() );			
		
			$proyectoForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "ProyectoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$proyectoForm->save();
		}
		
		return $forward;
		
	}

}
?>