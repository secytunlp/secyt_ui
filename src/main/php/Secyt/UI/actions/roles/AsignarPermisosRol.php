<?php
namespace Secyt\UI\actions\roles;

use Secyt\UI\components\form\rol\RolForm;

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
 * se asignan permisos a un rol.
 * 
 * @author Bernardo
 * @since 21/01/2015
 */
class AsignarPermisosRol extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("PermisoAsignar");
		
		$rolPermisosForm = $page->getComponentById("rolPermisosForm");
			
		$oid = $rolPermisosForm->getOid();
						
		try {

			//obtenemos el rol.
			$rol = UIServiceFactory::getUIRolService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$rolPermisosForm->fillEntity($rol);
			
			//guardamos los cambios.
			UIServiceFactory::getUIRolService()->update( $rol );
			
			$forward->setPageName( $rolPermisosForm->getBackToOnSuccess() );
			$forward->addParam( "rolOid", $rol->getOid() );
			
			$rolPermisosForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "PermisoAsignar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$rolPermisosForm->save();
			
		}
		return $forward;
		
	}

}
?>