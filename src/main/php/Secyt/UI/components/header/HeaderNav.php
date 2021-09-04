<?php

namespace Secyt\UI\components\header;

use Secyt\UI\utils\SecytUIUtils;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;
use Rasty\utils\XTemplate;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\SubmenuOption;

class HeaderNav extends RastyComponent{

	private $title;
	
	private $pageMenuGroups;

	public function __construct(){
		$this->pageMenuGroups = array();
		//$this->setTitle($this->localize("app.title"));
	}
	
	public function getType(){
		
		return "HeaderNav";
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		
		//$xtpl->assign("cuentas_titulo", $this->localize("app.title"));
		$titles = array();
		$titles[] = $this->localize("app.title");
		$titles[] = $this->getTitle();
		
		$xtpl->assign("Secyt_titulo", implode(" / ", $titles));
		
		$xtpl->assign("menu_page", $this->localize("menu.page"));
		$xtpl->assign("menu_main", $this->localize("menu.main"));
		
	}
	
	public function getMainMenuGroups(){
		
		
		$menuGroups = array();
		if( SecytUIUtils::isAdminLogged() ){

			$menu = $this->getMenuSeguridad() ;
			if($menu)
				$menuGroups[] =  $menu;
				
			/*$menu = $this->getMenuMp3() ;
			if($menu)
				$menuGroups[] =  $menu;*/
									
			
				
		}
		$menu = $this->getMenuABM() ;
		if($menu)
			$menuGroups[] =  $menu;
				

		return $menuGroups;
	}
	
	public function getPageMenuGroups(){
		
		return $this->pageMenuGroups;
	}

	public function setPageMenuGroups($pageMenuGroups)
	{
	    $this->pageMenuGroups = $pageMenuGroups;
	}

	public function getTitle()
	{
	    return $this->title;
	}

	public function setTitle($title)
	{
		if(!empty($title))
	    	$this->title = $title;
	}
	
	
public function getMenuSeguridad(){
		
		$menuGroup = new MenuGroup();
		$menuGroup->setLabel( $this->localize( "menu.seguridad") );
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.usuarios") );
		$menuOption->setPageName( "Usuarios" );
		//$menuOption->setImageSource( $this->getWebPath() . "css/images/movimientos_32.png" );
		$menuOption->setIconClass("icon-user");
		//$menuGroup->addMenuOption( $menuOption );
		$menuGroup->addMenuOption($menuOption);
		
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.roles") );
		$menuOption->setIconClass("icon-roles");
		$menuOption->setPageName( "Roles");
		//$menuGroup->addMenuOption( $menuOption );
		$menuGroup->addMenuOption($menuOption);
			
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.permisos") );
		$menuOption->setPageName( "Permisos" );
		$menuOption->setIconClass("icon-permisos");
		//$menuGroup->addMenuOption( $menuOption );
		$menuGroup->addMenuOption($menuOption);
		
		

			$submenu = new SubmenuOption($menuGroup);
			$submenu->setIconClass("icon-seguridad");
			return $submenu;
			
		
		
		
	}
	
	public function getMenuABM(){
		
		$menuGroup = new MenuGroup();
		$menuGroup->setLabel( $this->localize( "menu.abm") );
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.docentes") );
		$menuOption->setPageName( "Docentes" );
		//$menuOption->setImageSource( $this->getWebPath() . "css/images/movimientos_32.png" );
		$menuOption->setIconClass("icon-user");
		//$menuGroup->addMenuOption( $menuOption );
		SecytUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.proyectos") );
		$menuOption->setPageName( "Proyectos" );
		
		SecytUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		
		
		if( count($menuGroup->getMenuOptions())> 0){

			$submenu = new SubmenuOption($menuGroup);
			$submenu->setIconClass("icon-seguridad");
			return $submenu;
			
		}else{
			return false;
		}
		
		
	}
	
}
?>