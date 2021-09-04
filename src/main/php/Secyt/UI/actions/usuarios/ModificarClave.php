<?php
namespace Secyt\UI\actions\usuarios;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\components\form\usuario\CambiarClaveForm;

use Secyt\UI\service\UIServiceFactory;
use Secyt\UI\utils\SecytUtils;

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
 * se realiza la actualización de la clave
 * del usuario logueado.
 * 
 * @author Bernardo
 * @since 19/01/2015
 */
class ModificarClave extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("ClaveModificar");
		
		$cambiarClaveForm = $page->getComponentById("cambiarClaveForm");
			
		$oid = $cambiarClaveForm->getOid();
						
		try {

			//obtenemos el usuario.
			if(!SecytUIUtils::isUserLogged())
				throw new RastyException("usuario.cambiarClave.usuario.invalid");
			
			$usuario = SecytUIUtils::getUserLogged();	
			
			$cambiarClaveForm->fillEntity($usuario);
			
			//obtenemos las passwords desde el form.
			$oldPassword = $cambiarClaveForm->getOldPassword();
			$newPassword = $cambiarClaveForm->getNewPassword();
			$repetirNewPassword = $cambiarClaveForm->getRepetirNewPassword();
			
			if( $newPassword != $repetirNewPassword ){
				$cambiarClaveForm->save();
				throw new RastyException("usuario.cambiarClave.newPasswordRepetir.invalid");
			}
			
			//cambiamos la clave.
			UIServiceFactory::getUIUsuarioService()->cambiarClave( $usuario->getUsername(), $newPassword, $oldPassword );
			
			$forward->setPageName( $cambiarClaveForm->getBackToOnSuccess() );
			//$forward->addParam( "usuarioOid", $usuario->getOid() );
			
			$cambiarClaveForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "ClaveModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			//$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$cambiarClaveForm->save();
			
		}
		return $forward;
		
	}

}
?>