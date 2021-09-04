<?php

namespace Secyt\UI\layouts;

use Rasty\Layout\layout\Rasty\Layout;

use Rasty\utils\XTemplate;


class SecytLoginMetroLayout extends SecytMetroLayout{

	public function getXTemplate($file_template=null){
		return parent::getXTemplate( dirname(__DIR__) . "/layouts/SecytLoginMetroLayout.htm" );
	}

	public function getType(){
		
		return "SecytLoginMetroLayout";
		
	}	

}
?>