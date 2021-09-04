<?php
namespace Secyt\UI\components\filter\model;


use Secyt\Core\utils\SecytUtils;

use Secyt\UI\components\filter\model\UISecytCriteria;

use Rasty\utils\RastyUtils;
use Secyt\Core\criteria\ProyectoCriteria;

use Rasty\utils\Logger;

/**
 * Representa un criterio de búsqueda
 * para artists.
 * 
 * @author Marcos
 * @since 10/04/2020
 *
 */
class UIProyectoCriteria extends UISecytCriteria{


	const ANIO_ACTUAL = "proyectosAnioActual";
	
	private $codigo;
	
	private $tipoAcreditacion;
	private $facultad;
	
	private $estado;
	
	private $fechaDesde;
	
	private $fechaHasta;
	
	private $director;
		
	public function __construct(){

		parent::__construct();
		//$this->setFiltroPredefinido( self::ANIO_ACTUAL );
		

	}
		
	protected function newCoreCriteria(){
		return new ProyectoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
		
		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );
		
		$criteria->setCodigo( $this->getCodigo() );
		
		$criteria->setTipoAcreditacion( $this->getTipoAcreditacion() );
		$criteria->setFacultad( $this->getFacultad() );
		$criteria->setEstado( $this->getEstado() );
		
		$criteria->setDirector( $this->getDirector() );
		
		return $criteria;
	}


	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}
	

	public function getCodigo()
	{
	    return $this->codigo;
	}

	public function setCodigo($codigo)
	{
	    $this->codigo = $codigo;
	}

	public function getTipoAcreditacion()
	{
	    return $this->tipoAcreditacion;
	}

	public function setTipoAcreditacion($tipoAcreditacion)
	{
	    $this->tipoAcreditacion = $tipoAcreditacion;
	}

	public function getFacultad()
	{
	    return $this->facultad;
	}

	public function setFacultad($facultad)
	{
	    $this->facultad = $facultad;
	}

	public function getEstado()
	{
	    return $this->estado;
	}

	public function setEstado($estado)
	{
	    $this->estado = $estado;
	}
	
	public function proyectosAnioActual(){

		$fechaDesde = SecytUtils::getFirstDayOfYear( new \Datetime() );
		$fechaHasta = SecytUtils::getLastDayOfYear( new \Datetime());
		
		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}
	
	public function getDirector()
    {
        return $this->director;
    }

    public function setDirector($director)
    {
        $this->director = $director;
    }
}