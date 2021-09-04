<?php
namespace Secyt\UI\actions\integrantes;

use Secyt\UI\components\form\integrante\IntegranteForm;

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
class ModificarIntegrante extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("IntegranteModificar");
		
		$integranteForm = $page->getComponentById("integranteForm");
			
		$oid = $integranteForm->getOid();
		
		
						
		try {
			
			//obtenemos la integrante.
			$integrante = UIServiceFactory::getUIIntegranteService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$integranteForm->fillEntity($integrante);
			
			
			
			//guardamos los cambios.
			UIServiceFactory::getUIIntegranteService()->update( $integrante );
			
			$forward->setPageName( $integranteForm->getBackToOnSuccess() );
			$forward->addParam( "proyectoOid", $integrante->getProyecto()->getOid() );
			
			$integranteForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "IntegranteModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$integranteForm->save();
			
		}
		return $forward;
		
	}

}
?>