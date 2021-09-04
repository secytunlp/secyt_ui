<?php

namespace Secyt\UI\layouts;

use Rasty\Layout\layout\RastyLayout;

use Rasty\utils\XTemplate;
use Rasty\conf\RastyConfig;

use Rasty\utils\Logger;

class SecytMetroLayout extends RastyLayout{

	private $menuGroups;
	
	public function getContent(){
		
		
		$header = $this->getComponentById("header");
		//Logger::logObject($header);
		
		if(!empty($header))
			$header->setTitle( $this->getPage()->getTitle() );
			
		//contenido del componente..
				
		$xtpl = $this->getXTemplate( dirname(__DIR__) . "/layouts/SecytMetroLayout.htm" );
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
		
		return "SecytMetroLayout";
		
	}	


	protected function initStyles(){
		parent::initStyles();
		
		$webPath = RastyConfig::getInstance()->getWebPath();
		
		
		$this->addStyle( "$webPath/css/jquery/jVal.css");
		
		//$this->addScript( "$webPath/js/jquery/jquery-ui-1.11.2.custom/jquery-ui.css");
		$this->addStyle( "$webPath/metro/css/jquery/jquery.ui.all.css");
		
		$this->addStyle( "$webPath/metro/css/metro-bootstrap-responsive.css");
		$this->addStyle( "$webPath/metro/css/metro-bootstrap.css");
		$this->addStyle( "$webPath/metro/css/metro.css");
		$this->addStyle( "$webPath/metro/css/rasty.css");
		//$this->addStyle( "$webPath/metro/css/rasty_custom.css");

		$this->addStyle( "$webPath/css/jquery.rasty.css");
		
 		//$this->addStyle( "$webPath/metro/less/metro-bootstrap.less");
		
		$this->addStyle( "$webPath/metro/css/waliba.css");
		$this->addStyle( "$webPath/metro/css/waliba_forms.css");
		
		$this->addStyle( "$webPath/css/jquery/imgareaselect-default.css");
		
		$this->addStyle( "$webPath/css/menu.css");
		//$this->addStyle( "$webPath/css/flexnav.css");
		
				
//		$this->addStyle( "http://fonts.googleapis.com/css?family=Droid+Sans:400,700");
//		$this->addStyle( "http://fonts.googleapis.com/css?family=Raleway:400,700,600");
//		$this->addStyle( "http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700");

		$this->addStyle("https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css");
		
	}
	
	protected function initScripts(){
		parent::initScripts();
		
		$webPath = RastyConfig::getInstance()->getWebPath();
		
		$this->addScript( "$webPath/js/fix/console_fix.js");
		
		//$this->addScript( "$webPath/js/json2.js");
		
		//$this->addScript( "$webPath/metro/js/jquery/jquery.min.js");
		//$this->addScript( "$webPath/js/jquery/jquery-1.11.2.min.js");
		//$this->addScript( "$webPath/js/jquery/jquery-2.1.3.min.js");
		
		
		$this->addScript( "$webPath/js/jquery/jquery-ui-1.11.2.custom/jquery-ui.js");
		
		//$this->addScript( "$webPath/metro/js/jquery/jquery.widget.min.js");
		//$this->addScript( "$webPath/metro/js/jquery/jquery.mousewheel.js");
		
		
		//$this->addScript( "$webPath/metro/jquery-ui-1.10.4/js/jquery-ui-1.10.4.js");
		//$this->addScript( "$webPath/metro/jquery-ui-1.10.4/js/jquery-1.10.2.js");
		
		
		//$this->addScript( "$webPath/metro/js/metro/metro-loader.js");
		
		$this->addScript( "$webPath/metro/js/metro/metro-core.js");
		$this->addScript( "$webPath/metro/js/metro/metro-button-set.js");
		$this->addScript( "$webPath/metro/js/metro/metro-dropdown.js");
		$this->addScript( "$webPath/metro/js/metro/metro-input-control.js");
		$this->addScript( "$webPath/metro/js/metro/metro-live-tile.js");
		$this->addScript( "$webPath/metro/js/metro/metro-tab-control.js");
		$this->addScript( "$webPath/metro/js/metro/metro-dialog.js");
		$this->addScript( "$webPath/metro/js/metro/metro-notify.js");
		$this->addScript( "$webPath/metro/js/metro/metro-listview.js");
		//$this->addScript( "$webPath/metro/js/metro/metro-drag-title.js");
		$this->addScript( "$webPath/metro/js/metro/metro-fluentmenu.js");
		$this->addScript( "$webPath/metro/js/metro/metro-hint.js");
		
		//$this->addScript( "$webPath/metro/js/metro/metro-plugin-template.js");
		
		
		/*
		$this->addScript(  "$webPath/metro/js/jquery/jquery.ui.core.js" );
		$this->addScript(  "$webPath/metro/js/jquery/jquery.ui.datepicker.js" );
		$this->addScript(  "$webPath/metro/js/jquery/jquery.ui.button.js" );
		$this->addScript(  "$webPath/metro/js/jquery/jquery.ui.dialog.js" );
		$this->addScript(  "$webPath/metro/js/jquery/jquery.ui.position.js" );
		$this->addScript(  "$webPath/metro/js/jquery/jquery.ui.resizable.js" );
		$this->addScript(  "$webPath/metro/js/jquery/jquery.ui.selectable.js" );
		
		*/
		/*
		$this->addScript(  "$webPath/metro/js/jquery/i18n/jquery-ui-i18n.js" );
		$this->addScript(  "$webPath/metro/js/jquery/i18n/jquery.ui.datepicker-es.js" );
		
		*/
		
		$this->addScript(  "$webPath/metro/js/jquery/jquery.maskedinput.min-1.4.js" );
		
		$this->addScript(  "$webPath/metro/js/docs.js" );
		
		$this->addScript(  "$webPath/js/jquery/jVal.js" );
    	$this->addScript(  "$webPath/js/jquery/ajaxfileupload.js" );
    	$this->addScript(  "$webPath/js/jquery/browser_jqueryfix.js" );
    	
    	$this->addScript(  "$webPath/js/jquery/jquery.imgareaselect.pack.js" );
    	
		//$this->addScript("$webPath/js/rasty_observer.js");
		//$this->addScript("$webPath/js/historiaAyuda.js");
		//$this->addScript("$webPath/js/app_observer.js");
		$this->addScript("$webPath/js/rasty.js");
		
		$this->addScript("$webPath/js/jquery.rasty.js");
		
		$this->addScript("$webPath/js/menu.js");
		
		$this->addScript("$webPath/js/waliba.js");
		$this->addScript("$webPath/js/waliba_utils.js");
		$this->addScript("$webPath/js/waliba_forms.js");
		
		
		$this->addScript(  "$webPath/js/jquery/jquery.inputmask.js" );
		$this->addScript(  "$webPath/js/jquery/jquery.inputmask.extensions.js" );
		$this->addScript(  "$webPath/js/jquery/jquery.inputmask.regex.extensions.js" );
		$this->addScript(  "$webPath/js/jquery/jquery.inputmask.numeric.extensions.js" );
		$this->addScript(  "$webPath/js/jquery/jquery.inputmask.date.extensions.js" );
		
		$this->addScript("https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js");
		
		//$this->addScript("$webPath/js/fix/placeholder_fix.js");
		
		//$this->addScript("$webPath/js/jquery/jquery.flexnav.min.js");
		
		
		//$this->addScript("$webPath/js/soft.js");
	}
	
	protected function initLinks(){
		parent::initLinks();
	}
	


	protected function parseMetaTags($xtpl) {

		$xtpl->assign('http_equiv', 'X-UA-Compatible');
        $xtpl->assign('meta_content', 'IE=7');
        $xtpl->parse('main.meta_tag');

        $xtpl->assign('http_equiv', 'Content-Type');
        $xtpl->parse('main.meta_tag');
        
        $xtpl->assign('name', 'viewport');
        $xtpl->assign('meta_content', 'width=device-width, initial-scale=1.0');
        $xtpl->assign('http_equiv', '');
        $xtpl->parse('main.meta_tag');
        
    }

    protected function parseStyles($xtpl) {

    	foreach ($this->getStyles() as $style) {
			$xtpl->assign('css', $style);
        	$xtpl->parse('main.style');			
		}
    }
	
	public function parseLinks(XTemplate $xtpl){
		
    	foreach ($this->getLinks() as $link) {
			$xtpl->assign('rel', $link["rel"]);
			$xtpl->assign('href', $link["href"]);
			$xtpl->assign('type', $link["type"]);
    		$xtpl->parse('main.link');			
		}
    }
    
	protected function parseScripts($xtpl) {

		foreach ($this->getScripts() as $script) {
			$xtpl->assign('js', $script);
        	$xtpl->parse('main.script');			
		}

    }

	protected function parseErrors($xtpl) {

		//chequemos los errores en el forward del page.
		$msg = $this->oPage->getMsgError();
		
		if( !empty($msg) ){
			
			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}			
		

    }
    
	public function getMenuGroups()
	{
	    return $this->menuGroups;
	}

	public function setMenuGroups($menuGroups)
	{
	    $this->menuGroups = $menuGroups;
	}
}
?>