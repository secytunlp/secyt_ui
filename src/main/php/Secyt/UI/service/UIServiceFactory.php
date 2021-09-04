<?php

namespace Secyt\UI\service;


/**
 * Factory de servicios de UI
 *  
 * @author Marcos
 * @since 10/04/2020
 *
 */

class UIServiceFactory {

		
	/**
	 * @return UIPermisoService
	 */
	public static function getUIPermisoService(){
	
		return UIPermisoService::getInstance();	
	}

	/**
	 * @return UIRolService
	 */
	public static function getUIRolService(){
	
		return UIRolService::getInstance();	
	}
	
	/**
	 * @return UIUsuarioService
	 */
	public static function getUIUserService(){
	
		return UIUsuarioService::getInstance();	
	}
	

	/**
	 * @return UIUsuarioService
	 */
	public static function getUIUsuarioService(){
	
		return UIUsuarioService::getInstance();	
	}
	
	/**
	 * @return UIDocenteService
	 */
	public static function getUIDocenteService(){
	
		return UIDocenteService::getInstance();	
	}
	
	/**
	 * @return UIFacultadService
	 */
	public static function getUIFacultadService(){
	
		return UIFacultadService::getInstance();	
	}
	
	/**
	 * @return UICategoriaService
	 */
	public static function getUICategoriaService(){
	
		return UICategoriaService::getInstance();	
	}
	
	/**
	 * @return UIProvinciaService
	 */
	public static function getUIProvinciaService(){
	
		return UIProvinciaService::getInstance();	
	}
	
	/**
	 * @return UIUniversidadService
	 */
	public static function getUIUniversidadService(){
	
		return UIUniversidadService::getInstance();	
	}
	
	/**
	 * @return UIUnidadService
	 */
	public static function getUIUnidadService(){
	
		return UIUnidadService::getInstance();	
	}
	
	/**
	 * @return UITituloService
	 */
	public static function getUITituloService(){
	
		return UITituloService::getInstance();	
	}
	
	/**
	 * @return UICargoService
	 */
	public static function getUICargoService(){
	
		return UICargoService::getInstance();	
	}
	
	/**
	 * @return UIDeddocService
	 */
	public static function getUIDeddocService(){
	
		return UIDeddocService::getInstance();	
	}
	
	/**
	 * @return UICarrerainvService
	 */
	public static function getUICarrerainvService(){
	
		return UICarrerainvService::getInstance();	
	}
	
	/**
	 * @return UIOrganismoService
	 */
	public static function getUIOrganismoService(){
	
		return UIOrganismoService::getInstance();	
	}
	
	/**
	 * @return UITipoAcreditacionService
	 */
	public static function getUITipoAcreditacionService(){
	
		return UITipoAcreditacionService::getInstance();	
	}
	
	/**
	 * @return UIProyectoService
	 */
	public static function getUIProyectoService(){
	
		return UIProyectoService::getInstance();	
	}
	
	/**
	 * @return UIEstadoProyectoService
	 */
	public static function getUIEstadoProyectoService(){
	
		return UIEstadoProyectoService::getInstance();	
	}
	
	/**
	 * @return UIDisciplinaService
	 */
	public static function getUIDisciplinaService(){
	
		return UIDisciplinaService::getInstance();	
	}
	
	/**
	 * @return UIEspecialidadService
	 */
	public static function getUIEspecialidadService(){
	
		return UIEspecialidadService::getInstance();	
	}
	
	/**
	 * @return UICampoService
	 */
	public static function getUICampoService(){
	
		return UICampoService::getInstance();	
	}
	
	/**
	 * @return UIIntegranteService
	 */
	public static function getUIIntegranteService(){
	
		return UIIntegranteService::getInstance();	
	}
	
	/**
	 * @return UITipoInvestigadorService
	 */
	public static function getUITipoInvestigadorService(){
	
		return UITipoInvestigadorService::getInstance();	
	}
	
	/**
	 * @return UIEstadoIntegranteService
	 */
	public static function getUIEstadoIntegranteService(){
	
		return UIEstadoIntegranteService::getInstance();	
	}
	
	/**
	 * @return UIIntegranteEstadoService
	 */
	public static function getUIIntegranteEstadoService(){
	
		return UIIntegranteEstadoService::getInstance();	
	}
}