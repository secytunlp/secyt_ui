<?php
namespace Secyt\UI\service;

use Secyt\UI\components\filter\model\UIProvinciaCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Secyt\Core\model\Provincia;

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
 
class UIProvinciaService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIProvinciaService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIProvinciaCriteria $uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			//$criteria->addOrder("fechaHora", "ASC");
			
			$service = ServiceFactory::getProvinciaService();
			
			$provincias = $service->getList( $criteria );
	
			return $provincias;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	public function get( $oid ){

		try{
			
			$service = ServiceFactory::getProvinciaService();
		
			return $service->get( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function add( Provincia $provincia ){

		try {
			
			$service = ServiceFactory::getProvinciaService();
			
			return $service->add( $provincia );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}

	public function update( Provincia $provincia ){

		try {
			
			$service = ServiceFactory::getProvinciaService();
			
			return $service->update( $provincia );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getProvinciaService();
			$provincias = $service->getCount( $criteria );
			
			return $provincias;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
		
	public function delete( $oid ){

		try{
			
			$service = ServiceFactory::getProvinciaService();
		
			//TODO podríamos hacer algunas validaciones (p.ej que no sean un cliente).
			
			
				
			return $service->delete( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	

	
}
?>