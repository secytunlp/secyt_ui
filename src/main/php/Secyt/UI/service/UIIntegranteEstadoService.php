<?php
namespace Secyt\UI\service;

use Secyt\UI\components\filter\model\UIIntegranteEstadoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Secyt\Core\model\IntegranteEstado;

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
 
class UIIntegranteEstadoService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIIntegranteEstadoService();
			
		}
		return self::$instance; 
	}

	
	public function getByCriteria( UIIntegranteEstadoCriteria $uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getIntegranteEstadoService();
			
			$integranteEstado = $service->getSingleResult( $criteria );
	
			return $integranteEstado;
			
		} catch (\Exception $e) {
			
			//throw new RastyException($e->getMessage());
			
		}
	}
	
	
	public function getList( UIIntegranteEstadoCriteria $uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			//$criteria->addOrder("fechaHora", "ASC");
			
			$service = ServiceFactory::getIntegranteEstadoService();
			
			$integranteEstados = $service->getList( $criteria );
	
			return $integranteEstados;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	public function get( $oid ){

		try{
			
			$service = ServiceFactory::getIntegranteEstadoService();
		
			return $service->get( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function add( IntegranteEstado $integranteEstado ){

		try {
			
			$service = ServiceFactory::getIntegranteEstadoService();
			
			return $service->add( $integranteEstado );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}

	public function update( IntegranteEstado $integranteEstado ){

		try {
			
			$service = ServiceFactory::getIntegranteEstadoService();
			
			return $service->update( $integranteEstado );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getIntegranteEstadoService();
			$integranteEstados = $service->getCount( $criteria );
			
			return $integranteEstados;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
		
	public function delete( $oid ){

		try{
			
			$service = ServiceFactory::getIntegranteEstadoService();
		
			//TODO podríamos hacer algunas validaciones (p.ej que no sean un cliente).
			
			
				
			return $service->delete( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	

	
}
?>