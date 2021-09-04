<?php
namespace Secyt\UI\actions\docentes;

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

use Secyt\Core\model\Tipobeca;

/**
 * 
 * 
 * @author Marcos
 * @since 09/04/2020
 */
class DameTipoBecaJson extends JsonAction{

	
	public function execute(){

		$forward = new Forward();
		
		try {

			$orgbeca = RastyUtils::getParamPOST("orgbeca") ;
			
			foreach (Tipobeca::getItems($orgbeca) as $key => $value) {
				$result['tipos'][ $key] = $this->localize($value);
			}
					
			//$result['tipos'] = Tipobeca::getItems($orgbeca);
			
			$result["info"] = "success";
			
		} catch (RastyException $e) {
			
			$result["error"] =$this->localize( $e->getMessage() );
			
		}
		
		return $result;
		
	}

}
?>