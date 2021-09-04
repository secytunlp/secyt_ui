<?php
namespace Secyt\UI\components\filter\model;


use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\components\filter\model\UISecytCriteria;

use Rasty\utils\RastyUtils;
use Secyt\Core\criteria\IntegranteCriteria;

/**
 * Representa un criterio de búsqueda
 * para artists.
 * 
 * @author Marcos
 * @since 13/04/2020
 *
 */
class UIIntegranteCriteria extends UISecytCriteria{


	
	
	private $proyecto;
	private $codigo;
	private $documento;
	private $investigador;
	
	
	
		
	public function __construct(){

		parent::__construct();
		
		

	}
		
	protected function newCoreCriteria(){
		return new IntegranteCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		
		
		$criteria->setProyecto( $this->getProyecto() );
		$criteria->setCodigo( $this->getCodigo() );
		$criteria->setDocumento( $this->getDocumento() );
		$criteria->setInvestigador( $this->getInvestigador() );
		
		
		
		return $criteria;
	}




	public function getProyecto()
	{
	    return $this->proyecto;
	}

	public function setProyecto($proyecto)
	{
	    $this->proyecto = $proyecto;
	}

	public function getCodigo()
	{
	    return $this->codigo;
	}

	public function setCodigo($codigo)
	{
	    $this->codigo = $codigo;
	}

	public function getDocumento()
	{
	    return $this->documento;
	}

	public function setDocumento($documento)
	{
	    $this->documento = $documento;
	}

	public function getInvestigador()
	{
	    return $this->investigador;
	}

	public function setInvestigador($investigador)
	{
	    $this->investigador = $investigador;
	}
}