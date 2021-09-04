<?php
namespace Secyt\UI\utils;


use Secyt\Core\utils\SecytUtils;

use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;
use Rasty\exception\UserRequiredException;
use Rasty\exception\UserPermissionException;

use Rasty\i18n\Locale;
use Rasty\conf\RastyConfig;

use Cose\Security\model\Usergroup;
use Cose\Security\model\User;

use Rasty\security\RastySecurityContext;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

use Rasty\factory\PageFactory;

use Secyt\Core\model\Titulo;
use Secyt\Core\model\Nivel;
use Secyt\Core\model\DocenteCargo;

/**
 * Utilidades para el sistema Secyt.
 *
 * @author Bernardo
 * @since 05-11-2014
 */
class SecytUIUtils {

	const DATE_FORMAT = 'd/m/Y';
	const DATETIME_FORMAT = 'd/m/y H:i:s';
	const TIME_FORMAT = 'H:i';
	
	//números
	const DECIMALES = '2';
	const SEPARADOR_DECIMAL = ',';
	const SEPARADOR_MILES = '.';

	//moneda.
	const MONEDA_SIMBOLO = '€';
	const MONEDA_ISO = 'EUR';
	const MONEDA_NOMBRE = 'Euros';
	const MONEDA_POSICION_IZQ = 1;

	
	public static function getWebPath(){
	
		return RastyConfig::getInstance()->getWebPath();
		
	}
	
	public static function getAppPath(){
	
		return RastyConfig::getInstance()->getAppPath();
		
	}
	
	public static function getChartsWebPath(){
	
		return RastyConfig::getInstance()->getWebPath() . "/tmp/";
		
	}
	
	public static function getChartsAppPath(){
	
		return RastyConfig::getInstance()->getAppPath() . "/tmp/";
		
	}
	
	public static function getChartsFontPath(){
	
		return "vendor/realityking/pchart/Fonts/";
	}
	
	/**
	 * se formateo un monto a visualizar
	 * @param $monto
	 * @return string
	 */
	public static function formatMontoToView( $monto ){
	
		if( empty($monto) )
		$monto = 0;

		$res = $monto;
		//si es negativo, le quito el signo para agregarlo antes de la moneda.
		if( $monto < 0 ){
			$res = $res * (-1);
		}
			
		$res = number_format ( $res ,  self::DECIMALES , self::SEPARADOR_DECIMAL, self::SEPARADOR_MILES );



		if( self::MONEDA_POSICION_IZQ ){
			$res = self::MONEDA_SIMBOLO . $res;
				
		}else
		$res = $res. self::MONEDA_SIMBOLO ;

		//si es negativo lo mostramos rojo y le agrego el signo.
		if( $monto < 0 ){
			$res = "<span style='color:red;'>- $res</span>";
		}

		return $res;
	}


	//Formato fecha yyyy-mm-dd
	public static function differenceBetweenDates($fecha_fin, $fecha_Ini, $formato_salida = "d") {
		$valueFI = str_replace('/', '-', $fecha_Ini);
		$valueFF = str_replace('/', '-', $fecha_fin);
		$f0 = strtotime($valueFF);
		$f1 = strtotime($valueFI);
		if ($f0 < $f1) {
			$tmp = $f1;
			$f1 = $f0;
			$f0 = $tmp;
		}
		return date($formato_salida, $f0 - $f1);
	}

	
	public static function formatMesToView( $mes ){
	
		$meses = array (
			"1" => "Enero",
			"2" => "Febrero",
			"3" => "Marzo",
			"4" => "Abril",
			"5" => "Mayo",
			"6" => "Junio",
			"7" => "Julio",
			"8" => "Agosto",
			"9" => "Septiembre",
			"10" => "Octubre",
			"11" => "Noviembre",
			"12" => "Diciembre"
		);
		
		return $meses[$mes];
	}
	
	public static function formatDateToView($value, $format=self::DATE_FORMAT) {
		
		$res = "";
		if( !empty( $value) )
			$res = $value->format($format);
		else $res = "";
		
		$meses = array (
			"January" => "Enero",
			"Febraury" => "Febrero",
			"March" => "Marzo",
			"April" => "Abril",
			"May" => "Mayo",
			"June" => "Junio",
			"July" => "Julio",
			"August" => "Agosto",
			"September" => "Septiembre",
			"October" => "Octubre",
			"November" => "Noviembre",
			"December" => "Diciembre",
			"Jan" => "Ene",
			"Feb" => "Feb",
			"Mar" => "Mar",
			"Apr" => "Abr",
			"May" => "May",
			"Jun" => "Jun",
			"Jul" => "Jul",
			"Aug" => "Ago",
			"Sep" => "Sep",
			"Oct" => "Oct",
			"Nov" => "Nov",
			"Dec" => "Dic"
		);
		
		$dias = array(
			'Monday' => 'Lunes',
			'Tuesday' => 'Martes',
			'Wednesday' => 'Miércoles',
			'Thursday' => 'Jueves',
			'Friday' => 'Viernes',
			'Saturday' => 'Sábado',
			'Sunday' => 'Domingo',
			'Mon' => 'Lun',
			'Tue' => 'Mar',
			'Wed' => 'Mie',
			'Thu' => 'Jue',
			'Fri' => 'Vie',
			'Sat' => 'Sab',
			'Sun' => 'Dom',
		);
		foreach ($meses as $key => $value) {
			$res = str_replace($key, $value, $res);
		}
		foreach ($dias as $key => $value) {
			$res = str_replace($key, $value, $res);
		}
		
		return $res ;
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date($format, strtotime($value));
		}else
		$dt = "";

		return $dt;
		*/
	}

	public static function formatDateToPersist($value) {

		return $value->format("Y-m-d");
		
		/*		
		$value = str_replace('/', '-', $value);
		
		if (!empty($value))
		$dt = date("Y-m-d", strtotime($value));
		else
		$dt = "";
		return $dt;*/
	}

	public static function formatDateTimeToView($value) {
		
		if(!empty($value))
			return $value->format(self::DATETIME_FORMAT);
		else
			return "";
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date(self:DATE_FORMAT, strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}

	public static function formatDateTimeToPersist($value) {
		
		return $value->format("Y-m-d H:i:s");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value))
		$dt = date("Y-m-d H:i:s", strtotime($value));
		else
		$dt = "";

		return $dt;*/
	}

	public static function addDays($date, $dateFormat="", $days){

		$date->modify("+$days day");
		return $date;
		/*
		$newDate = strtotime ( "+$days day" , strtotime ( $date ) ) ;
		$newDate = date ( $dateFormat , $newDate );
		
		return $newDate;
		*/
	}

	public static function substractDays($date, $dateFormat, $days){

		$date->modify("-$days day");
		return $date;
		/*
		$newDate = strtotime ( "-$days day" , strtotime ( $date ) ) ;
		$newDate = date ( $dateFormat , $newDate );

		return $newDate;
		*/
	}

	public static function addMinutes($date, $dateFormat, $minutes){
		
		//$date->modify("+$minutes minutes");
		//return $date;
		
		$newDate = strtotime ( "+$minutes minutes" , strtotime ( $date ) ) ;
		$newDate = date ( $dateFormat , $newDate );
		
		return $newDate;
	}
	
	public static function isSameDay( $dt_date, $dt_another){

		return $dt_date->format("Ymd") == $dt_another->format("Ymd");
		 
		/*
		$dt_dateAux = strtotime ( $dt_date ) ;
		$dt_dateAux = date ( "Ymd" , $dt_dateAux );

		$dt_anotherAux = strtotime ( $dt_another ) ;
		$dt_anotherAux = date ( "Ymd" , $dt_anotherAux );

		return $dt_dateAux == $dt_anotherAux ;*/
	}


	public static function formatTimeToView($value, $format=self::TIME_FORMAT) {
		
		if(!empty($value))
		
			return $value->format($format);

		else return "";	
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date(self:TIME_FORMAT, strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}

	public static function getHorasItems() {
		
		$desde = new \DateTime();
		$desde->setTime(0,0,0);
		$duracion = 15;
		$i=0;
		while( $i<97 ){
			
			$items[$desde->format("H:i")] = $desde->format("H:i");
			
			$desde->modify("+$duracion minutes");
			
			$i++;	
			
		}
		
		return $items;
		
	}

	public static function formatEdad( $edad ){
	
		if( !empty($edad) ){
		
			if( $edad > 1)
				return "$edad años";
			else
				return "$edad año";
		}return "";
	}
	
	public static function getYears($fecha, $hoy = null){
		list($dia,$mes,$year) = explode("/",$fecha);
		if ($hoy==null) {
			$hoy = Date('d/m/Y');
		}
		list($diaH,$mesH,$yearH) = explode("/",$hoy);
		$year_dif = $yearH - $year;
		$mes_dif = $mesH - $mes;
		$dia_dif = $diaH - $dia;
		if ($dia_dif < 0 || $mes_dif < 0)
		$year_dif--;
		return $year_dif;
	}
	
	

	
	public static function dayOfDate(\DateTime $value) {
		
		return $value->format("d");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date("d", strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}

	public static function monthOfDate($value) {
		
		return $value->format("m");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date("m", strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}
	
	public static function yearOfDate($value) {
		
		return $value->format("Y");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date("Y", strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}
	
	public static function strtotime($value) {
		
		$value = str_replace('/', '-', $value);
		
		return strtotime($value);
	}


	public static function newDateTime($value) {
		
		$value = str_replace('/', '-', $value);
		$time = strtotime($value);
		
		$dateTime = new \DateTime();
		$dateTime->setDate(date("Y", $time), date("m", $time), date("d", $time));
		$dateTime->setTime(date("H", $time), date("i", $time), date("s", $time));
		
		return $dateTime;
	}
	
	
	public static function localize($keyMessage){
	
		return Locale::localize( $keyMessage );
	}
	
	
	public static function localizeEntities($enumeratedEntities){
		
		$items = array();
		
		foreach ($enumeratedEntities as $key => $keyMessage) {
			$items[$key] = self::localize($keyMessage);
		}
		
		return $items;
	}
	
	public static function formatMessage($msg, $params){
		
		if(!empty($params)){
			
			$count = count ( $params );
			$i=1;
			while ( $i <= $count ) {
				$param = $params [$i-1];
				
				$msg = str_replace('$'.$i, $param, $msg);
				
				$i ++;
			}
			
		}
		return $msg;
		
	
	}
	
	
	public static function getNewDate($dia,$mes,$anio){
	
		$date = new \DateTime();
		$date->setDate($anio, $mes, $dia);
		return $date;
	}
	
	
	public static function getFirstDayOfWeek(\Datetime $fecha){
	
		$f = new \Datetime();
		$f->setTimestamp( $fecha->getTimestamp() );
    	
		//si es lunes, no hacemos nada, sino, buscamos el lunes anterior.
		if( $f->format("N") > 1 )
			$f->modify("last monday");
    	
    	return $f;
	}
	
	
	public static function getLastDayOfWeek(\Datetime $fecha){
	
		$f = new \Datetime();
		$f->setTimestamp( $fecha->getTimestamp() );
    	$f->modify("next monday");
    	
    	//si no es lunes, restamos un día.
    	if( $fecha->format("N") > 1 )
			$f->sub(new \DateInterval('P1D'));
    	
    	return $f;
	}
	
	public static function fechasIguales(\Datetime $fecha1, \Datetime $fecha2){
		return $fecha1->format("Ymd") == $fecha2->format("Ymd");
	}
	
	public static function horaSuperpuesta( $hora, $desde, $hasta  ){
	
		$superpuesta = false;
		
		if( empty($hora)  || empty($desde)  || empty($hasta) )
			$superpuesta = false;
			
		$timeHora = strtotime($hora);
		$timeDesde = strtotime($desde);
		$timeHasta = strtotime($hasta);
		
		
			
		if( ($timeDesde <= $timeHora)  && ($timeHasta > $timeHora) )
			$superpuesta = true;

		//Logger::log( " horaSuperpuesta( $hora, $desde, $hasta ) = $superpuesta");		
		
		return $superpuesta;
	}
	
   	/**
	 * registramos la sesión del admin
	 * @param User $user
	 */
	public static function loginAdmin(User $user) {
		
		$appName = RastyConfig::getInstance()->getAppName();
		
        $_SESSION [$appName]["admin_oid"] = $user->getOid();
		$_SESSION [$appName]["admin_name"] = $user->getName();
		$_SESSION [$appName]["admin_username"] = $user->getUsername();
        
    }
   	
	
	/**
     * @return true si hay un admin logueado.
     */
    public static function isAdminLogged() {
    	
    	$appName = RastyConfig::getInstance()->getAppName();
    	
    	$data = RastyUtils::getParamSESSION($appName);
		
		$logueado =  ($data != "");
		
		if( $logueado ){
			$logueado = isset($data["admin_oid"]) && !empty($data["admin_oid"]); 
		}
		return $logueado;
    }
    
    /**
     * @return admin logueado
     */
    public static function getAdminLogged() {
        
    	$appName = RastyConfig::getInstance()->getAppName();
    	
    	$data = RastyUtils::getParamSESSION( $appName );
    	
    	
    	if( !self::isAdminLogged() )
    		return null;
    	
    	$user = new User();
        $user->setOid($data["admin_oid"]);
        $user->setName($data["admin_name"]);
        $user->setUsername($data["admin_username"]);
       
        return $user;
    }
	

    /**
	 * se formateo un número a visualizar como porcentaje
	 * @param $numero
	 * @return string
	 */
	public static function formatPorcentajeToView( $numero ){
	
		if( empty($numero) )
		$numero = 0;

		$res = $numero;
		//si es negativo, le quito el signo para agregarlo antes de la moneda.
		if( $numero < 0 ){
			$res = $res * (-1);
		}
			
		$res = number_format ( $res ,  2 , self::SEPARADOR_DECIMAL, self::SEPARADOR_MILES );

		$res = $res. "%" ;

		return $res;
	}

	public static function getOpcionesBooleanasEmpty(){
		
		$items = array();
		
		$items[-1] = self::localize("criteria.sin_especificar");
		$items[1] = self::localize("criteria.si");
		$items[2] = self::localize("criteria.no");
		
		return $items;
		
	}

	public static function getOpcionesBooleanas(){
		
		$items = array();
		
		$items[2] = self::localize("criteria.no");
		$items[1] = self::localize("criteria.si");
		
		return $items;
		
	}

    /**
     * finalizamos la sesión
     */
    public static function logout() {
    	
    	$appName = RastyConfig::getInstance()->getAppName();
		
        $_SESSION [$appName]["admin_oid"] = null;
		$_SESSION [$appName]["admin_name"] = null;
		$_SESSION [$appName]["admin_username"] = null;
		unset($_SESSION [$appName]["admin_oid"]);
		unset($_SESSION [$appName]["admin_name"]);
		unset($_SESSION [$appName]["admin_username"]);
    }
	

    /**
     * @return true si hay un usuario logueado.
     */
    public static function isUserLogged() {
    	
    	$user = RastySecurityContext::getUser();
    	
    	$logueado =  ($user != null);
		
		return $logueado;
    }
    
    public static function getUserLogged(){
    
    	$user = RastySecurityContext::getUser();
			
		//$user = WalibaUtils::getUserByUsername($user->getUsername());
		return $user;
    }
    
	public static function log($msg, $clazz=__CLASS__){
    	Logger::log($msg, $clazz);
    }

    public static function logObject($obj, $clazz=__CLASS__){
    	Logger::logObject($obj, $clazz);
    }
    
	
 	public static function is_empty($var, $allow_false = false, $allow_ws = false) {
	    if (!isset($var) || is_null($var) || ($allow_ws == false && trim($var) == "" && !is_bool($var)) || ($allow_false === false && is_bool($var) && $var === false) || (is_array($var) && empty($var))) {   
	        return true;
	    } else {
	        return false;
	    }
	}

	
	public static function addMenuOption(MenuOption $menuOption, $options){

		//si tiene permisos agrego el menú.
		if( self::tienePermisoAPagina( $menuOption->getPageName() )){
			$options[] = $menuOption ;
		}
		
		return $options;
			
	}
	
	public static function addMenuOptionToGroup(MenuOption $menuOption, $menuGroup){

		//si tiene permisos agrego el menú.
		if( self::tienePermisoAPagina( $menuOption->getPageName() )){
			$menuGroup->addMenuOption( $menuOption );
		}
			
	}
	
	/**
	 * chequea si el usuario logueado tiene acceso a una página
	 * @param string $pageName
	 */
	public static function tienePermisoAPagina($pageName){

		//si tiene permisos agrego el menú.
		SecytUIUtils::log("autorizando la page $pageName");
		
		$page = PageFactory::build( $pageName );
		
		try {

			if( !empty($page)){
				RastySecurityContext::authorize($page);
				return true;
			}
			
							
			
		} catch (UserRequiredException $e) {
			
		} catch (UserPermissionException $e) {
			
		}
		
		return false;
			
	}
	
	public static function startsWith($haystack, $needle) {
	    // search backwards starting from haystack length characters from the end
	    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
	
	public static function endsWith($haystack, $needle) {
	    // search forward starting from end minus needle length characters
	    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}	
	
	public static function addTituloDocenteSession(Titulo $titulo) {
		
		$titulos = self::getTitulosDocenteSession();

		//si ya estaba incremento la cantidad
		$existe = false;
		$indexExistente = 0;
		$index = 0;
		foreach ($titulos as $titulojson) {
			//mismo titulo
			if(( $titulo->getOid() == $titulojson["titulo_oid"] ) ){
				$existe = true;
				
				$indexExistente = $index;
			}
			$index++;
		}
		
		$titulojson = array();
		$titulojson["titulo_oid"] = $titulo->getOid();
		$titulojson["titulo_nombre"] = $titulo->getNombre();
	    $titulojson["titulo_universidad"] = $titulo->getUniversidad()->getNombre();
	    $titulojson["titulo_nivel"] = self::getNivelLabel($titulo->getNivel()) ;
	        
		if($existe){
	        
			//unset($titulos[$indexExistente]);
        	//$titulos = array_values($titulos);
        	
		}else{
			$titulos[] = $titulojson;
		}
		
		
		self::setTitulosDocenteSession($titulos);
    }
    
	public static function deleteTituloDocenteSession( $index=0 ) {
		
		$titulos = self::getTitulosDocenteSession();

		unset($titulos[$index]);
        $titulos = array_values($titulos);
        
		self::setTitulosDocenteSession($titulos);
    }
    
    public static function getTitulosDocenteSession() {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
    	$data = RastyUtils::getParamSESSION($appName);
	
		if( isset( $data['titulosDocente_session']) )
			$titulos = unserialize( $data['titulosDocente_session']);
		else 
			$titulos = array();
			
		return $titulos;
   	}
 
   	public static function setTitulosDocenteSession( $titulos ) {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
		$_SESSION[$appName]['titulosDocente_session'] = serialize($titulos);
		
			
   	}
   	
	public static function vaciarTitulosDocenteSession(  ) {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
		unset($_SESSION[$appName]['titulosDocente_session']);
		
			
   	}
   	
	public static function setVariableSession( $nameVar, $var ) {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
		$_SESSION[$appName][$nameVar] = $var;
		
			
   	}
   	
	public static function getVariableSession( $nameVar ) {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
		
		 return $_SESSION[$appName][$nameVar];
			
   	}
   	
	public static function getNivelLabel($nivel){
		
		return self::localize( Nivel::getLabel( $nivel )  );
		
	}
	
	public static function addCargoDocenteSession(DocenteCargo $docenteCargo) {
		
		$cargos = self::getCargosDocenteSession();

		$cargojson = array();
		$cargojson["cargo_oid"] = $docenteCargo->getCargo()->getOid();
		$cargojson["cargo_nombre"] = $docenteCargo->getCargo()->getNombre();
		$cargojson["deddoc_oid"] = $docenteCargo->getDeddoc()->getOid();
	    $cargojson["cargo_dedicacion"] = $docenteCargo->getDeddoc()->getNombre();
	    $cargojson["facultad_oid"] = $docenteCargo->getFacultad()->getOid();
	    $cargojson["cargo_facultad"] = $docenteCargo->getFacultad()->getNombre();
	    $cargojson["cargo_desde"] = $docenteCargo->getFechaDesde();
	    $cargojson["cargo_hasta"] = $docenteCargo->getFechaHasta();
	       
		$cargos[] = $cargojson;
		
		self::setCargosDocenteSession($cargos);
    }
    
	public static function deleteCargoDocenteSession( $index=0 ) {
		
		$cargos = self::getCargosDocenteSession();

		unset($cargos[$index]);
        $cargos = array_values($cargos);
        
		self::setCargosDocenteSession($cargos);
    }
    
    public static function getCargosDocenteSession() {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
    	$data = RastyUtils::getParamSESSION($appName);
	
		if( isset( $data['cargosDocente_session']) )
			$cargos = unserialize( $data['cargosDocente_session']);
		else 
			$cargos = array();
			
		return $cargos;
   	}
 
   	public static function setCargosDocenteSession( $cargos ) {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
		$_SESSION[$appName]['cargosDocente_session'] = serialize($cargos);
		
			
   	}
   	
	public static function vaciarCargosDocenteSession(  ) {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
		unset($_SESSION[$appName]['cargosDocente_session']);
		
			
   	}

}