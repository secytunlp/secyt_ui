<?php
namespace Secyt\UI\pages\proyectos\eliminar;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Secyt\Core\model\Proyecto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * 
 * Enter description here ...
 * @author proyecto
 *
 */
class ProyectoEliminar extends SecytPage{

	/**
	 * proyecto a eliminar.
	 * @var Proyecto
	 */
	private $proyecto;

	private $error;
	
	public function __construct(){
		
		//inicializamos el proyecto.
		$proyecto = new Proyecto();
		$this->setProyecto($proyecto);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del proyecto 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setProyectoOid($oid){
		
		//a partir del id buscamos el proyecto a modificar.
		$proyecto = UIServiceFactory::getUIProyectoService()->get($oid);
		
		$this->setProyecto($proyecto);
		
	}
	
	public function getTitle(){
		return $this->localize( "proyecto.eliminar.title" );
	}

	public function getType(){
		
		return "ProyectoEliminar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		$xtpl->assign("legend", $this->localize( "proyecto.eliminar.legend" ) );
		
		$xtpl->assign("cancel", $this->getLinkProyectos() );
		$xtpl->assign("lbl_cancel", $this->localize( "form.cancelar" ) );
		
		$xtpl->assign("action", $this->getLinkActionEliminarProyecto() );
		$xtpl->assign("lbl_submit", $this->localize( "form.aceptar" ) );
		$xtpl->assign("lbl_codigo", $this->localize("proyecto.codigo") );
		$xtpl->assign("lbl_titulo", $this->localize("proyecto.titulo") );
		
		
		$xtpl->assign("codigo", $this->getProyecto()->getCodigo() );
		$xtpl->assign("titulo", $this->getProyecto()->getTitulo() );
		
		
		
		$error = $this->getError();
		if(!empty($error)){
			$xtpl->assign("msg", $error );	
			$xtpl->parse("main.msg_error" );
		}
		
	}

	public function getProyecto(){
		
	    return $this->proyecto;
	}

	public function setProyecto($proyecto)
	{
	    $this->proyecto = $proyecto;
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