<?php
namespace Secyt\UI\components\filter\model;


use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\components\filter\model\UISecytCriteria;

use Rasty\utils\RastyUtils;
use Secyt\Core\criteria\EspecialidadCriteria;

/**
 * Representa un criterio de búsqueda
 * para artists.
 * 
 * @author Marcos
 * @since 11/04/2020
 *
 */
class UIEspecialidadCriteria extends UISecytCriteria{


	
	
	private $nombre;
	
	private $disciplina;
	
	
		
	public function __construct(){

		parent::__construct();
		
		

	}
		
	protected function newCoreCriteria(){
		return new EspecialidadCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		
		
		$criteria->setNombre( $this->getNombre() );
		$criteria->setDisciplina( $this->getDisciplina() );
		
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

	public function getDisciplina()
	{
	    return $this->disciplina;
	}

	public function setDisciplina($disciplina)
	{
	    $this->disciplina = $disciplina;
	}
}