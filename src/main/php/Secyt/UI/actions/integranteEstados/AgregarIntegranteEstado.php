<?php
namespace Secyt\UI\actions\integranteEstados;


use Secyt\UI\components\form\integranteEstado\IntegranteEstadoForm;

use Secyt\UI\service\UIServiceFactory;
use Secyt\Core\model\IntegranteEstado;


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
 
class AgregarIntegranteEstado extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("IntegranteEstadoAgregar");
		
		$integranteEstadoForm = $page->getComponentById("integranteEstadoForm");
		
		try {
			
			//creamos una nueva integranteEstado.
			$integranteEstado = new IntegranteEstado();
			
			//completados con los datos del formulario.
			$integranteEstadoForm->fillEntity($integranteEstado);
			
			
			
			//agregamos el integranteEstado.
			UIServiceFactory::getUIIntegranteEstadoService()->add( $integranteEstado );
			
			
			
			$forward->setPageName( $integranteEstadoForm->getBackToOnSuccess() );
			$forward->addParam( "integranteOid", $integranteEstado->getIntegrante()->getOid() );		
		
			$integranteEstadoForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "IntegranteEstadoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$integranteEstadoForm->save();
		}
		
		return $forward;
		
	}

}
?>