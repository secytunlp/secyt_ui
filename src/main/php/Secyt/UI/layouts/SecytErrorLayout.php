<?php

namespace Secyt\UI\layouts;

use Rasty\Layout\layout\RastyLayout;

use Rasty\utils\XTemplate;
use Rasty\conf\RastyConfig;

class SecytErrorLayout extends SecytMetroLayout{


	protected function initStyles(){
		parent::initStyles();
		
		$webPath = RastyConfig::getInstance()->getWebPath();
		
	}
	
	public function getContent(){
		
		
		//contenido del componente..
				
		$xtpl = $this->getXTemplate( dirname(__DIR__) . "/layouts/SecytErrorLayout.htm" );
		$xtpl->assign('WEB_PATH', RastyConfig::getInstance()->getWebPath() );
		
		$this->parseMetaTags($xtpl);
        $this->parseStyles($xtpl);
        $this->parseScripts($xtpl);
        $this->parseLinks($xtpl);
        
        $this->parseErrors($xtpl);
        
		
		$xtpl->assign('title', $this->oPage->getTitle());
		
		$xtpl->assign('page',   $this->oPage->render() );

		//chequeamos si hay que mostrar errores.
		
		
		$xtpl->parse("main");
		$content = $xtpl->text("main");
		
		/*
		echo "<pre>";
		var_dump($xtpl);
		echo "</pre>";
		*/
		
		return $content;
	}
	
	
	public function getType(){
		
		return "SecytErrorLayout";
		
	}	

}
?>