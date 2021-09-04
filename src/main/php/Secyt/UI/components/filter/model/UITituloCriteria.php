<?php
namespace Secyt\UI\components\filter\model;


use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\components\filter\model\UISecytCriteria;

use Rasty\utils\RastyUtils;
use Secyt\Core\criteria\TituloCriteria;

/**
 * Representa un criterio de búsqueda
 * para artists.
 * 
 * @author Marcos
 * @since 23/06/2015
 *
 */
class UITituloCriteria extends UISecytCriteria{


	
	
	private $nombreUniversidad;
	
	private $nombre;

	private $universidad;
	
	private $nivel;
	
		
	public function __construct(){

		parent::__construct();
		
		

	}
		
	protected function newCoreCriteria(){
		return new TituloCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		
		
		$criteria->setNombreUniversidad( $this->getNombreUniversidad() );
		$criteria->setNombre( $this->getNombre() );
		$criteria->setUniversidad( $this->getUniversidad() );
		
		$criteria->setNivel( $this->getNivel() );
		
		
		
		return $criteria;
	}



	

	

	public function getNombreUniversidad()
	{
	    return $this->nombreUniversidad;
	}

	public function setNombreUniversidad($nombreUniversidad)
	{
	    $this->nombreUniversidad = $nombreUniversidad;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getUniversidad()
	{
	    return $this->universidad;
	}

	public function setUniversidad($universidad)
	{
	    $this->universidad = $universidad;
	}

	public function getNivel()
	{
	    return $this->nivel;
	}

	public function setNivel($nivel)
	{
	    $this->nivel = $nivel;
	}
}