<?php
namespace Secyt\UI\service;

use Secyt\UI\components\filter\model\UITipoInvestigadorCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Secyt\Core\model\TipoInvestigador;

use Secyt\Core\service\ServiceFactory;
use Cose\Security\model\User;

use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * Enter description here ...
 * @author marcos.piñero
 *
 */
 
class UITipoInvestigadorService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UITipoInvestigadorService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UITipoInvestigadorCriteria $uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			//$criteria->addOrder("fechaHora", "ASC");
			
			$service = ServiceFactory::getTipoInvestigadorService();
			
			$tipoInvestigadors = $service->getList( $criteria );
	
			return $tipoInvestigadors;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	public function get( $oid ){

		try{
			
			$service = ServiceFactory::getTipoInvestigadorService();
		
			return $service->get( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function add( TipoInvestigador $tipoInvestigador ){

		try {
			
			$service = ServiceFactory::getTipoInvestigadorService();
			
			return $service->add( $tipoInvestigador );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}

	public function update( TipoInvestigador $tipoInvestigador ){

		try {
			
			$service = ServiceFactory::getTipoInvestigadorService();
			
			return $service->update( $tipoInvestigador );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getTipoInvestigadorService();
			$tipoInvestigadors = $service->getCount( $criteria );
			
			return $tipoInvestigadors;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
		
	public function delete( $oid ){

		try{
			
			$service = ServiceFactory::getTipoInvestigadorService();
		
			//TODO podríamos hacer algunas validaciones (p.ej que no sean un cliente).
			
			
				
			return $service->delete( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	

	
}
?>