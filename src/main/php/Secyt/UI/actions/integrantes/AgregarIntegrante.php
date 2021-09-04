<?php
namespace Secyt\UI\actions\integrantes;


use Secyt\UI\components\form\integrante\IntegranteForm;

use Secyt\UI\service\UIServiceFactory;
use Secyt\Core\model\Integrante;


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
 
class AgregarIntegrante extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("IntegranteAgregar");
		
		$integranteForm = $page->getComponentById("integranteForm");
		
		try {
			
			//creamos una nueva integrante.
			$integrante = new Integrante();
			
			//completados con los datos del formulario.
			$integranteForm->fillEntity($integrante);
			
			$estado = UIServiceFactory::getUIEstadoIntegranteService()->get( 3 );
			
			$integrante->setEstado($estado);
			
			//agregamos el integrante.
			UIServiceFactory::getUIIntegranteService()->add( $integrante );
			
			
			
			$forward->setPageName( $integranteForm->getBackToOnSuccess() );
			$forward->addParam( "proyectoOid", $integrante->getProyecto()->getOid() );		
		
			$integranteForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "IntegranteAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$integranteForm->save();
		}
		
		return $forward;
		
	}

}
?>