<?php
namespace Secyt\UI\service;

use Secyt\UI\components\filter\model\UIEstadoProyectoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Secyt\Core\model\EstadoProyecto;

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
 
class UIEstadoProyectoService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIEstadoProyectoService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIEstadoProyectoCriteria $uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			//$criteria->addOrder("fechaHora", "ASC");
			
			$service = ServiceFactory::getEstadoProyectoService();
			
			$tipoAcreditacions = $service->getList( $criteria );
	
			return $tipoAcreditacions;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	public function get( $oid ){

		try{
			
			$service = ServiceFactory::getEstadoProyectoService();
		
			return $service->get( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function add( EstadoProyecto $tipoAcreditacion ){

		try {
			
			$service = ServiceFactory::getEstadoProyectoService();
			
			return $service->add( $tipoAcreditacion );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}

	public function update( EstadoProyecto $tipoAcreditacion ){

		try {
			
			$service = ServiceFactory::getEstadoProyectoService();
			
			return $service->update( $tipoAcreditacion );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getEstadoProyectoService();
			$tipoAcreditacions = $service->getCount( $criteria );
			
			return $tipoAcreditacions;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
		
	public function delete( $oid ){

		try{
			
			$service = ServiceFactory::getEstadoProyectoService();
		
			//TODO podríamos hacer algunas validaciones (p.ej que no sean un cliente).
			
			
				
			return $service->delete( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	

	
}
?>