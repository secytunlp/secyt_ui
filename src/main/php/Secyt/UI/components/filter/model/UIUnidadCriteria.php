<?php
namespace Secyt\UI\components\filter\model;


use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\components\filter\model\UISecytCriteria;

use Rasty\utils\RastyUtils;
use Secyt\Core\criteria\UnidadCriteria;

/**
 * Representa un criterio de búsqueda
 * para artists.
 * 
 * @author Marcos
 * @since 22/06/2015
 *
 */
class UIUnidadCriteria extends UISecytCriteria{


	
	
	private $nombreSigla;
	
	private $nombre;

	private $sigla;
	
	private $padre;
	
		
	public function __construct(){

		parent::__construct();
		
		

	}
		
	protected function newCoreCriteria(){
		return new UnidadCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		
		
		$criteria->setNombreSigla( $this->getNombreSigla() );
		$criteria->setNombre( $this->getNombre() );
		$criteria->setSigla( $this->getSigla() );
		
		$criteria->setPadre( $this->getPadre() );
		
		
		
		return $criteria;
	}



	

	public function getNombreSigla()
	{
	    return $this->nombreSigla;
	}

	public function setNombreSigla($nombreSigla)
	{
	    $this->nombreSigla = $nombreSigla;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getSigla()
	{
	    return $this->sigla;
	}

	public function setSigla($sigla)
	{
	    $this->sigla = $sigla;
	}

	public function getPadre()
	{
	    return $this->padre;
	}

	public function setPadre($padre)
	{
	    $this->padre = $padre;
	}
}