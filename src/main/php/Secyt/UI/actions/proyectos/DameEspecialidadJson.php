<?php
namespace Secyt\UI\actions\proyectos;

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

use Secyt\UI\components\filter\model\UIEspecialidadCriteria;

/**
 * 
 * 
 * @author Marcos
 * @since 11/04/2020
 */
class DameEspecialidadJson extends JsonAction{

	
	public function execute(){

		$forward = new Forward();
		
		try {

			$disciplinaPOST = RastyUtils::getParamPOST("disciplina") ;
			
			$disciplina = UIServiceFactory::getUIDisciplinaService()->get( $disciplinaPOST );
			
			
			$criteria = new UIEspecialidadCriteria();
			$criteria->setDisciplina($disciplina);
				
			
				
			$especialidades = UIServiceFactory::getUIEspecialidadService()->getList( $criteria );
				
			
			
			
			foreach ($especialidades as $esp) {
				$espe = array();
				$espe["cd"]=$esp->getOid() ;
				$espe["ds"]=$esp->__toString();
				$espes[]=$espe;
			}
			
			$result['especialidades'] = $espes;
			
			$result["info"] = "success";
			
		} catch (RastyException $e) {
			
			$result["error"] =$this->localize( $e->getMessage() );
			
		}
		
		return $result;
		
	}

}
?>