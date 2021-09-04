<?php

namespace Secyt\UI\Test\tareas;

use Secyt\UI\components\filter\model\UITareaCriteria;

use Secyt\UI\service\UIServiceFactory;

include_once dirname(__DIR__). '/conf/init.php';

use Secyt\UI\Test\GenericTest;


class ListarTareasTest extends GenericTest{
	
	/**
	 */
	public function test(){

		$this->log("listando Reclamos", __CLASS__);
		
		$tareas = UIServiceFactory::getUITareaService()->getList(new UITareaCriteria());
		foreach ($tareas as $tarea) {
			$this->log("tarea " . $tarea, __CLASS__);
		}
		
		
		
	}
}
?>