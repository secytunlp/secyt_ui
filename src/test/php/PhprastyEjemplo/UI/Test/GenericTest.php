<?php

namespace Secyt\UI\Test;

use Cose\utils\Logger;
use Secyt\UI\conf\SecytUISetup;
use Secyt\Core\conf\SecytConfig;

class GenericTest extends \PHPUnit_Framework_TestCase{
	
	/**
	 * 
	 * @var \Cose\persistence\PersistenceContext
	 */
	//protected $persistenceContext;
	
	protected function setUp() {

		SecytUISetup::initialize("rastyejemplo_ui");		
		Logger::configure( dirname(__DIR__) . "/Test/conf/log4php.xml" );
		SecytConfig::getInstance()->initLogger(dirname(__DIR__) . "/Test/conf/log4php.xml");
	}
	
	protected function tearDown() {

		$this->log("successful!", __CLASS__);
		
    }
    
    protected function log($msg, $clazz=__CLASS__){
    	Logger::log($msg, $clazz);
    }
    
}
?>