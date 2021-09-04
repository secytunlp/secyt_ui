<?php
namespace Secyt\UI\pages\docentes\eliminar;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Secyt\Core\model\Docente;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * 
 * Enter description here ...
 * @author docente
 *
 */
class DocenteEliminar extends SecytPage{

	/**
	 * docente a eliminar.
	 * @var Docente
	 */
	private $docente;

	private $error;
	
	public function __construct(){
		
		//inicializamos el docente.
		$docente = new Docente();
		$this->setDocente($docente);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del docente 
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
		return $this->localize( "docente.eliminar.title" );
	}

	public function getType(){
		
		return "DocenteEliminar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		$xtpl->assign("legend", $this->localize( "docente.eliminar.legend" ) );
		
		$xtpl->assign("cancel", $this->getLinkDocentes() );
		$xtpl->assign("lbl_cancel", $this->localize( "form.cancelar" ) );
		
		$xtpl->assign("action", $this->getLinkActionEliminarDocente() );
		$xtpl->assign("lbl_submit", $this->localize( "form.aceptar" ) );
		$xtpl->assign("lbl_cuil", $this->localize("docente.cuil") );
		$xtpl->assign("lbl_nombre", $this->localize("docente.nombre") );
		$xtpl->assign("lbl_apellido", $this->localize("docente.apellido") );
		$xtpl->assign("lbl_facultad", $this->localize("docente.facultad") );
		
		$xtpl->assign("cuil", $this->getDocente()->getCuil() );
		$xtpl->assign("nombre", $this->getDocente()->getNombre() );
		$xtpl->assign("apellido", $this->getDocente()->getApellido() );
		$xtpl->assign("facultad", $this->getDocente()->getFacultad() );
		
		
		$error = $this->getError();
		if(!empty($error)){
			$xtpl->assign("msg", $error );	
			$xtpl->parse("main.msg_error" );
		}
		
	}

	public function getDocente(){
		
	    return $this->docente;
	}

	public function setDocente($docente)
	{
	    $this->docente = $docente;
	}
	

	public function getError()
	{
	    return $this->error;
	}

	public function setError($error)
	{
	    $this->error = $error;
	}
}
?>