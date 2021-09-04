<?php
namespace Secyt\UI\components\filter\model;


use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\components\filter\model\UISecytCriteria;

use Rasty\utils\RastyUtils;
use Secyt\Core\criteria\IntegranteEstadoCriteria;

/**
 * Representa un criterio de búsqueda
 * para artists.
 * 
 * @author Marcos
 * @since 14/04/2020
 *
 */
class UIIntegranteEstadoCriteria extends UISecytCriteria{


	
	
	private $integrante;
	
	private $hastaNull;
	
	
	
	
		
	public function __construct(){

		parent::__construct();
		
		

	}
		
	protected function newCoreCriteria(){
		return new IntegranteEstadoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		
		
		$criteria->setIntegrante( $this->getIntegrante() );
		
		$criteria->setHastaNull( $this->getHastaNull() );
		
		
		return $criteria;
	}




	

	public function getIntegrante()
	{
	    return $this->integrante;
	}

	public function setIntegrante($integrante)
	{
	    $this->integrante = $integrante;
	}

	public function getHastaNull()
	{
	    return $this->hastaNull;
	}

	public function setHastaNull($hastaNull)
	{
	    $this->hastaNull = $hastaNull;
	}
}