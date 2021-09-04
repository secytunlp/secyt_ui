<?php
namespace Secyt\UI\pages\errores;


use Secyt\UI\pages\SecytPage;

use Secyt\UI\utils\SecytUIUtils;

use Rasty\utils\XTemplate;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


class ErrorNoEsperado extends SecytPage{

	private $mensaje;
	
	public function __construct(){
		
		
	}
	
	
	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		return array();
	}
	
	public function getTitle(){
		return $this->localize( "error.noesperado.title" );
	}

	public function getType(){
		
		return "ErrorNoEsperado";
		
	}	

	
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		$xtpl->assign("mensaje", $this->localize( $this->getMensaje() ));
		
	}


	public function getMensaje()
	{
	    return $this->mensaje;
	}

	public function setMensaje($mensaje)
	{
	    $this->mensaje = $mensaje;
	}
}
?>