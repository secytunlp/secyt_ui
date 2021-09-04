<?php
namespace Secyt\UI\pages\home;

use Secyt\UI\pages\SecytPage;

use Secyt\UI\service\UIServiceFactory;

use Secyt\UI\utils\SecytUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;

use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;

use Rasty\security\RastySecurityContext;

use Rasty\utils\Logger;

/**
 * Page home del backoffice
 * @author Marcos
 * @since 16/06/2015
 *
 */
class AdminHome extends SecytPage{

	
	public function __construct(){

		
		
	}

	public function getTitle(){
		return $this->localize( "admin_home.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
		
	protected function parseMenuUser(XTemplate $xtpl){
		
		$user = RastySecurityContext::getUser();
		$xtpl->assign("user", $user->getName() );
		
		$this->parseMenuExit($xtpl);
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		Logger::logObject($_SESSION);
		$title = $this->localize("admin_home.title");
		$subtitle = $this->localize("admin_home.subtitle");
		$xtpl->assign("app_title", $title );
		//$xtpl->assign("app_subtitle", $subtitle );
		
		$this->parseMenuUser($xtpl);

		$this->parseLinks($xtpl);
		
	}
	
	public function parseLinks( XTemplate $xtpl){
		
		/* seguridad */
		$xtpl->assign("menu_seguridad", $this->localize("menu.seguridad") );
		
		$xtpl->assign("menu_usuarios", $this->localize("menu.usuarios") );
		$xtpl->assign("linkUsuarios", $this->getLinkUsuarios() );
		
		$xtpl->assign("menu_usuarios_agregar", $this->localize("menu.usuarios.agregar") );
		$xtpl->assign("linkUsuarioAgregar", $this->getLinkUsuarioAgregar() );
		
		$xtpl->assign("menu_roles", $this->localize("menu.roles") );
		$xtpl->assign("linkRoles", $this->getLinkRoles() );
		
		$xtpl->assign("menu_roles_agregar", $this->localize("menu.roles.agregar") );
		$xtpl->assign("linkRolAgregar", $this->getLinkRolAgregar() );
		
		$xtpl->assign("menu_permisos", $this->localize("menu.permisos") );
		$xtpl->assign("linkPermisos", $this->getLinkPermisos() );
		
		$xtpl->assign("menu_permisos_agregar", $this->localize("menu.permisos.agregar") );
		$xtpl->assign("linkPermisoAgregar", $this->getLinkPermisoAgregar() );
		
	}
	
	public function parseMenuExit( XTemplate $xtpl){
	
		$menuOption = new MenuActionOption();
		$menuOption->setLabel( $this->localize( "menu.logout") );
		$menuOption->setIconClass( "icon-exit" );
		$menuOption->setActionName( "Logout");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/logout.png" );
	
		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionExit");
	
	}
	
	public function getType(){

		return "AdminHome";

	}

	public function parseMenuOption( XTemplate $xtpl, MenuOption $menuOption, $blockName){
		$xtpl->assign("label", $menuOption->getLabel() );
		$xtpl->assign("onclick", $menuOption->getOnclick());
		$img = $menuOption->getImageSource();
		if(!empty($img)){
			$xtpl->assign("src", $img );
			$xtpl->parse("$blockName.image");
		}
		$xtpl->assign("iconClass", $menuOption->getIconClass());
	
		$xtpl->parse("$blockName");
	}
	
}
?>