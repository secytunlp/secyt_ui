<?php
namespace Secyt\UI\components\filter\model;


use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\components\filter\model\UISecytCriteria;

use Rasty\utils\RastyUtils;
use Secyt\Core\criteria\ProvinciaCriteria;

/**
 * Representa un criterio de búsqueda
 * para artists.
 * 
 * @author Marcos
 * @since 19/06/2015
 *
 */
class UIProvinciaCriteria extends UISecytCriteria{


	
	
	private $nombre;
	
	
		
	public function __construct(){

		parent::__construct();
		
		

	}
		
	protected function newCoreCriteria(){
		return new ProvinciaCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		
		
		$criteria->setNombre( $this->getNombre() );
		
		
		return $criteria;
	}



	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}
}