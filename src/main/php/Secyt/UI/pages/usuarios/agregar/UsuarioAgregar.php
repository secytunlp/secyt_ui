<?php
namespace Secyt\UI\pages\usuarios\agregar;

use Secyt\UI\pages\SecytPage;

use Rasty\utils\XTemplate;
use Cose\Security\model\User;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para alta de usuario
 * 
 * @author Bernardo
 * @since 17/06/2015
 *
 * @Rasty\security\annotations\Secured( permission='Agregar Usuario' )
 */

class UsuarioAgregar extends SecytPage{

	/**
	 * Usuario a agregar.
	 * @var User
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
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Usuarios");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "usuario.agregar.title" );
	}

	public function getType(){
		
		return "UsuarioAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		
	}


	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>