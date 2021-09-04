<?php
namespace Secyt\UI\pages\docentes\modificar;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Secyt\Core\model\Docente;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Secyt\UI\utils\SecytUIUtils;

class DocenteModificar extends SecytPage{

	/**
	 * docente a modificar.
	 * @var Docente
	 */
	private $docente;

	
	public function __construct(){
		
		//inicializamos el docente.
		$docente = new Docente();
		$this->setDocente($docente);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setDocenteOid($oid){
		
		//a partir del id buscamos el docente a modificar.
		$docente = UIServiceFactory::getUIDocenteService()->get($oid);
		
		$this->setDocente($docente);
		
	}
	
	public function getTitle(){
		return $this->localize( "docente.modificar.title" );
	}

	public function getType(){
		
		return "DocenteModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$docenteForm = $this->getComponentById("docenteForm");
		$docenteForm->fillFromSaved( $this->getDocente() );
		/*SecytUIUtils::setTitulosDocenteSession(array());
		$titulos = $this->getDocente()->getTitulos();
		foreach ($titulos as $titulo) {
			SecytUIUtils::addTituloDocenteSession($titulo);	
		}
		
		SecytUIUtils::setCargosDocenteSession(array());
		$cargos = $this->getDocente()->getCargos();
		foreach ($cargos as $cargo) {
			SecytUIUtils::addCargoDocenteSession($cargo);	
		}*/
		
	}

	public function getDocente(){
		
	    return $this->docente;
	}

	public function setDocente($docente)
	{
	    $this->docente = $docente;
	}
}
?>