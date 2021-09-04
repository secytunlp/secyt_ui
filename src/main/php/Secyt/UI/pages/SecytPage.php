<?php
namespace Secyt\UI\pages;

use Rasty\components\RastyPage;
use Rasty\actions\Forward;
use Rasty\utils\LinkBuilder;


/**
 * página genérica para la app de Secyt
 * 
 * @author Marcos
 * @since 15/06/2015
 */
abstract class SecytPage extends RastyPage{


	public function errorNoEsperado( $mensaje ){
		
		$forward = new Forward();
		$forward->setPageName( "ErrorNoEsperado" );
		$forward->addError( $mensaje );
		$forward->addParam("layout", $this->getLayoutType() );
				
		header ( 'Location: '.  $forward->buildForwardUrl() );
	}
	
	public function getTitle(){
		return $this->localize( "Secyt_app.title" );
	}

	public function getMenuGroups(){

		return array();
	}


	public function getLinkLogin(){
		
		return LinkBuilder::getPageUrl( "Login") ;
		
	}

	
	public function getLinkUsuarios(){
		
		return LinkBuilder::getPageUrl( "Usuarios") ;
		
	}

	public function getLinkUsuarioAgregar(){
		
		return LinkBuilder::getPageUrl( "UsuarioAgregar") ;
		
	}
	
	public function getLinkActionAgregarUsuario(){
		
		return LinkBuilder::getActionUrl( "AgregarUsuario") ;
		
	}

	public function getLinkActionModificarUsuario(){
		
		return LinkBuilder::getActionUrl( "ModificarUsuario") ;
		
	}

	
	
	public function getLinkRoles(){
		
		return LinkBuilder::getPageUrl( "Roles") ;
		
	}

	public function getLinkRolAgregar(){
		
		return LinkBuilder::getPageUrl( "RolAgregar") ;
		
	}
	
	public function getLinkActionAgregarRol(){
		
		return LinkBuilder::getActionUrl( "AgregarRol") ;
		
	}

	public function getLinkActionModificarRol(){
		
		return LinkBuilder::getActionUrl( "ModificarRol") ;
		
	}

	
	
	public function getLinkPermisos(){
		
		return LinkBuilder::getPageUrl( "Permisos") ;
		
	}

	public function getLinkPermisoAgregar(){
		
		return LinkBuilder::getPageUrl( "PermisoAgregar") ;
		
	}
	
	public function getLinkActionAgregarPermiso(){
		
		return LinkBuilder::getActionUrl( "AgregarPermiso") ;
		
	}

	public function getLinkActionModificarPermiso(){
		
		return LinkBuilder::getActionUrl( "ModificarPermiso") ;
		
	}

	
	public function getLinkRegistracionSuccess(){
		
		return LinkBuilder::getActionUrl( "RegistracionAgregarSuccess") ;
		
	}
	
	
	public function getLinkActionAgregarRegistracion(){
		
		return LinkBuilder::getActionUrl( "AgregarRegistracion") ;
		
	}
	
	public function getLinkActionConfirmarRegistracion(){
		
		return LinkBuilder::getActionUrl( "ConfirmarRegistracion") ;
		
	}
	
	public function getLinkActionConfirmarNuevaClave(){

		return LinkBuilder::getActionUrl( "ConfirmarNuevaClave") ;
		
	}
	
	public function getLinkActionAsignarPermisosRol(){

		return LinkBuilder::getActionUrl( "AsignarPermisosRol") ;
		
	}
	
	public function getLinkActionAsignarRolesUsuario(){

		return LinkBuilder::getActionUrl( "AsignarRolesUsuario") ;
		
	}
			
	public function getLinkActionEliminarUsuario(){

		return LinkBuilder::getActionUrl( "EliminarUsuario") ;
		
	}
	
	public function getLinkDocentes(){
		
		return LinkBuilder::getPageUrl( "Docentes") ;
		
	}


	
	public function getLinkActionAgregarDocente(){
		
		return LinkBuilder::getActionUrl( "AgregarDocente") ;
		
	}

	public function getLinkActionModificarDocente(){
		
		return LinkBuilder::getActionUrl( "ModificarDocente") ;
		
	}
	
	public function getLinkActionEliminarDocente(){

		return LinkBuilder::getActionUrl( "EliminarDocente") ;
		
	}
	
	public function getLinkProyectos(){
		
		return LinkBuilder::getPageUrl( "Proyectos") ;
		
	}
	
	public function getLinkActionAgregarProyecto(){
		
		return LinkBuilder::getActionUrl( "AgregarProyecto") ;
		
	}
	
	public function getLinkActionModificarProyecto(){
		
		return LinkBuilder::getActionUrl( "ModificarProyecto") ;
		
	}
	
	public function getLinkActionEliminarProyecto(){

		return LinkBuilder::getActionUrl( "EliminarProyecto") ;
		
	}
	
	public function getLinkIntegrantes(){
		
		return LinkBuilder::getPageUrl( "Integrantes") ;
		
	}
	
	
	public function getLinkActionAgregarIntegrante(){
		
		return LinkBuilder::getActionUrl( "AgregarIntegrante") ;
		
	}
	
	public function getLinkActionModificarIntegrante(){
		
		return LinkBuilder::getActionUrl( "ModificarIntegrante") ;
		
	}
	
	public function getLinkIntegranteEstados(){
		
		return LinkBuilder::getPageUrl( "IntegranteEstados") ;
		
	}
	
	
	public function getLinkActionAgregarIntegranteEstado(){
		
		return LinkBuilder::getActionUrl( "AgregarIntegranteEstado") ;
		
	}
	


}
?>