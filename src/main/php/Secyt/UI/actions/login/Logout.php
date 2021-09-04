<?php
namespace Secyt\UI\actions\login;

use Secyt\UI\service\UIServiceFactory;
use Secyt\UI\utils\SecytUIUtils;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;

/**
 * se realiza el logout del sistema.
 * 
 * @author Bernardo
 * @since 05/11/2014
 */
class Logout extends Action{

	
	public function execute(){

		$forward = new Forward();			
		try {

			RastySecurityContext::logout();
			
			SecytUIUtils::logout();
			
			$forward->setPageName( "Login" );
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "Login" );
			$forward->addError( $e->getMessage() );
			
		}
		
		return $forward;
		
	}

}
?>