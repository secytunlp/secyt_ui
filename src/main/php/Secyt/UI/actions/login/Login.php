<?php
namespace Secyt\UI\actions\login;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\service\UIServiceFactory;

use Secyt\Core\utils\SecytUtils;


use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;



/**
 * se realiza el login contra el core.
 * 
 * @author Marcos
 * @since 15/06/2015
 */
class Login extends Action{

	
	public function execute(){

		$forward = new Forward();			
		try {

			$username = RastyUtils::getParamPOST("username");
			$password = RastyUtils::getParamPOST("password");
			$usergroup_oid = RastyUtils::getParamPOST("usergroup_oid");
			
			if(empty($username))
				throw new RastyException("username.required");
			
			if(empty($password))
				throw new RastyException("password.required");
							
			RastySecurityContext::login( RastyUtils::getParamPOST("username"), RastyUtils::getParamPOST("password") );
			$user = RastySecurityContext::getUser();
			$user = SecytUtils::getUserByUsername($user->getUsername());
			
			SecytUtils::setGroup($user,$usergroup_oid);
			if( SecytUtils::isAdmin($usergroup_oid)){
				
				SecytUIUtils::loginAdmin($user);
				
			}
			
			
			
			
			//TODO cambiar a un panel principal
			$forward->setPageName( "Proyectos" );
			
				
		} catch (RastyException $e) {
		
			$forward->setPageName( $this->getErrorForward() );
			$forward->addError( $e->getMessage() );
			
		}
		
		return $forward;
		
	}
	
	public function isSecure(){
		return false;
	}

	protected function getErrorForward(){
		return "Login";
	}
}
?>