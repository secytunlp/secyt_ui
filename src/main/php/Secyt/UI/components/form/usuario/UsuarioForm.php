<?php

namespace Secyt\UI\components\form\usuario;

use Secyt\UI\components\filter\model\UIUsuarioCriteria;

use Secyt\UI\service\finder\UsuarioFinder;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\service\UIServiceFactory;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Secyt\Core\model\Usuario;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para usuario

 * @author Bernardo
 * @since 05/11/2014
 */
class UsuarioForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Usuario
	 */
	private $usuario;

	private $passwordRepeat;
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("username");
		$this->addProperty("name");
		//$this->addProperty("lastname");
		$this->addProperty("email");
		$this->addProperty("password");

		$this->setBackToOnSuccess("Usuarios");
		$this->setBackToOnCancel("Usuarios");
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "UsuarioForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_username", $this->localize("usuario.username") );
		$xtpl->assign("lbl_name", $this->localize("usuario.name") );
		//$xtpl->assign("lbl_lastname", $this->localize("usuario.lastname") );
		$xtpl->assign("lbl_email", $this->localize("usuario.email") );
		$xtpl->assign("lbl_password", $this->localize("usuario.password") );
		$xtpl->assign("lbl_passwordRepeat", $this->localize("usuario.password.repeat") );
		
		$xtpl->assign("claveFormato", $this->localize("usuario.clave.formato") );	
	}
	

	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		//agregamos la password repeat.
		$this->setPasswordRepeat( RastyUtils::getParamPOST('passwordRepeat') );
	
		
		//uppercase 
		$entity->setName( ( $entity->getName() ) );
		//$entity->setLastname( ( $entity->getLastname() ) );
		$entity->setUsername( ( $entity->getUsername() ) );
		
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	
	public function getPasswordRepeat()
	{
	    return $this->passwordRepeat;
	}

	public function setPasswordRepeat($passwordRepeat)
	{
	    $this->passwordRepeat = $passwordRepeat;
	}
	
	public function getClaveProperties(){
		
		return array("data-custom" => "checkFormatoClave", 
						"data-custom-msg" => "formato incorrecto");
	}
}
?>