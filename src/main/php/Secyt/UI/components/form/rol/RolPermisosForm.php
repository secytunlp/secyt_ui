<?php

namespace Secyt\UI\components\form\rol;

use Secyt\UI\components\filter\model\UIRolCriteria;
use Secyt\UI\components\filter\model\UIPermisoCriteria;

use Secyt\UI\service\finder\RolFinder;

use Secyt\UI\utils\SecytUIUtils;

use Secyt\UI\service\UIServiceFactory;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Secyt\Core\model\Rol;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para asignar permisos a un rol

 * @author Bernardo
 * @since 21/01/2015
 */
class RolPermisosForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Rol
	 */
	private $rol;

	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		//$this->addProperty("name");

		$this->setBackToOnSuccess("Roles");
		$this->setBackToOnCancel("Roles");
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		//agregamos los permisos.
		$permisos_oids = RastyUtils::getParamPOST('permisos') ;
		$permisos = array();
		foreach ($permisos_oids as $permisoOid) {
			$permisos[] = UIServiceFactory::getUIPermisoService()->get($permisoOid);
			
		}
		$entity->setPermissions($permisos);
		
	}
	
	public function getType(){
		
		return "RolPermisosForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_name", $this->localize("rol.name") );
		
		$legend = $this->localize("rol.asignarPermisos.legend");
		$legend = SecytUIUtils::formatMessage($legend, array($this->getRol()->getName()));
		$xtpl->assign("legend",  $legend  );
		
		//mostrar todos los permisos marcando los permisos asignados al rol.
		
		$uiCriteria = new UIPermisoCriteria();
		$permisos = UIServiceFactory::getUIPermisoService()->getList( $uiCriteria );
		
		
		
		foreach ($permisos as $permiso) {
			$xtpl->assign("permiso_oid", $permiso->getOid() );
			$xtpl->assign("permiso_name", $permiso->__toString() );
			
			if( $this->getRol()->hasPermissionByName($permiso->getName()) )
				$xtpl->assign ( 'checked', "checked" );
			else	
				$xtpl->assign ( 'checked', "" );
				
			$xtpl->parse("main.permiso" );
		}
		
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getRol()
	{
	    return $this->rol;
	}

	public function setRol($rol)
	{
	    $this->rol = $rol;
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	
}
?>