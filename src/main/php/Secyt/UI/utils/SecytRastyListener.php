<?php
namespace Secyt\UI\utils;

use Secyt\UI\service\UIServiceFactory;

use Rasty\components\RastyPage;
use Rasty\components\RastyComponent;
use Rasty\actions\Action;
use Rasty\actions\JsonAction;

use Rasty\app\IApplicationListener;


/**
 * Utilidades para el sistema Secyt ui.
 *
 * @author Bernardo
 * @since 05-11-2014
 */
class SecytRastyListener implements IApplicationListener {


	/**
	 * se ejecuta una página
	 * @param $page
	 */
	function pageExecuted( RastyPage $page) {
	
		SecytUIUtils::log("executando page " . get_class($page) );
	
	}
	
	/**
	 * se ejecuta un componente
	 * @param $component
	 */
	function componentExecuted( RastyComponent $component) {
		SecytUIUtils::log("executando componente " . get_class($component) );		
	}
	
	/**
	 * se ejecuta un action
	 * @param $action
	 */
	function actionExecuted( Action $action) {
	
		SecytUIUtils::log("executando action " . get_class($action) );
	}
	
	/**
	 * se ejecuta un action json
	 * @param $action
	 */	
	function actionJsonExecuted( JsonAction $action) {
	
		SecytUIUtils::log("executando json action " . get_class($action) );
		
	}    
}