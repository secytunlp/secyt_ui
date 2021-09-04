<?php
namespace Secyt\UI\pages\usuarios\modificar;

use Secyt\UI\pages\Page;

use Secyt\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Cose\Security\model\User;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class ClaveModificar extends SecytPage{

	/**
	 * usuario a modificar la clave.
	 * @var Usuario
	 */
	private $usuario;

	
	public function __construct(){
		
		//inicializamos el usuario.
		$usuario = new User();
		$this->setUsuario($usuario);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setUsuarioOid($oid){
		
		//a partir del id buscamos el usuario a modificar.
		$usuario = UIServiceFactory::getUIUsuarioService()->get($oid);
		
		$this->setUsuario($usuario);
		
	}
	
	public function getTitle(){
		return $this->localize( "usuario.modificar.clave.title" );
	}

	public function getType(){
		
		return "ClaveModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getUsuario(){
		
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}
}
?>