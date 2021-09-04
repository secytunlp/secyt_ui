<?php
namespace Secyt\UI\actions\login;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\service\UIServiceFactory;
//use Secyt\UI\utils\SecytUtils;

use Secyt\Core\utils\SecytUtils;

use Rasty\actions\JsonAction;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * 
 * 
 * @author Marcos
 * @since 17/06/2015
 */
class DamePerfilJson extends JsonAction{

	
	public function execute(){

		$forward = new Forward();
		
		try {

			$cuilOid = RastyUtils::getParamPOST("username") ;
			
			$user = SecytUtils::getUserByUsername($cuilOid);
			
			
			$roles = $user->getGroups();
			$perfiles = array();
			foreach ($roles as $rol) {
				$perfil = array();
				$perfil["cd"]=$rol->getOid() ;
				$perfil["ds"]=$rol->__toString();
				$perfiles[]=$perfil;
			}
			
			$result['roles'] = $perfiles;
			
			$result["info"] = "success";
			
		} catch (RastyException $e) {
			
			$result["error"] =$this->localize( $e->getMessage() );
			
		}
		
		return $result;
		
	}

}
?>