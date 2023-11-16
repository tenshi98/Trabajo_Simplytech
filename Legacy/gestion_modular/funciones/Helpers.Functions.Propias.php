<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo (Access Code 1006-002).');
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                   Requires                                                      */
/*                                                                                                                 */
/*******************************************************************************************************************/
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Arduino.php';                    //Funciones para la generacion de codigo para las placas arduino
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Common.Data.php';                //Funciones comunes de manejo de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Common.Notifications.php';       //Funciones notificaciones por pantalla
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Convertions.php';                //Conversiones de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Date.php';                  //Funciones relacionadas a las fechas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Numbers.php';               //Funciones relacionadas a los numeros
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Operations.php';            //Funciones relacionadas a operaciones matematicas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Text.php';                  //Funciones relacionadas a los textos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Time.php';                  //Funciones relacionadas a las horas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Validations.php';           //Funciones de validacion de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.DataBase.php';                   //Funciones relacionadas a la base de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Location.php';                   //Funciones relacionadas a la geolozalizacion
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Security.AntiSql_Injection.php'; //Funciones de seguridad para los sql injection
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Security.Codification.php';      //Funciones de seguridad para la codificacion y decodificacion de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Security.Passwords.php';         //Funciones de seguridad para la generacion de password o palabras unicas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Server.Client.php';              //Funciones para entregar información del cliente
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Server.Notifications.php';       //Funciones para el envio de notificaciones a traves de mail, mensajes pushup, etc
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Server.Server.php';              //Funciones para entregar información del servidor
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Server.Social.php';              //Funciones para el envio de mensajes a traves de redes sociales
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Server.Web.php';                 //Funciones para entregar información de la web

/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                  Funciones                                                      */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/
/* Toma dos input y calcula valores*/
function prod_print_value($tabla1, $input_1, $input_result_1, $input_result_2, $dbConn) {

    /******************************************************/
	$SIS_query =
    $tabla1.'.idProducto AS idAlgo,
	sistema_productos_uml.Nombre AS Unimed,
	proveedor_listado.Nombre AS Proveedor';
	$SIS_join  = '
	LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml   = '.$tabla1.'.idUml
	LEFT JOIN `proveedor_listado`     ON proveedor_listado.idProveedor = '.$tabla1.'.idProveedor';
	$SIS_where = '';
	$SIS_order = 'sistema_productos_uml.Nombre ASC';
	$arrProductos = array();
	$arrProductos = db_select_array (false, $SIS_query, $tabla1, $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrProductos');

	/******************************************************/
	$cadena = '';
	$cadena .= '<script>';
	foreach ($arrProductos as $prod) {
		$cadena .= 'let id_data_'.$prod['idAlgo'].'= "'.$prod['Unimed'].'";';
	}
	foreach ($arrProductos as $prod) {
		if(isset($prod['Proveedor'])&&$prod['Proveedor']!=''){$prov=$prod['Proveedor'];}else{$prov='Sin proveedor';}
		$cadena .= 'let id_prov_'.$prod['idAlgo'].'= "'.$prov.'";';
	}
	$cadena .= '</script>';

    $cadena .= '
    <script>
		document.getElementById("'.$input_1.'").onchange = function() {myFunction_'.$input_1.'()};

		function myFunction_'.$input_1.'() {
			const Componente = document.getElementById("'.$input_1.'").value;
			if (Componente != "") {
				document.getElementById("'.$input_result_1.'").value = eval("id_data_" + Componente);
				document.getElementById("'.$input_result_2.'").value = eval("id_prov_" + Componente);
			}
		}
	</script>
    ';
    return $cadena;
}
/*******************************************************************************************************************/
/* Toma dos input y calcula valores*/
function sell_print_value($tabla1, $input_1, $input_result_1, $input_result_2, $dbConn) {

    /******************************************************/
	$SIS_query =
    $tabla1.'.idProducto AS idAlgo,
	sistema_productos_uml.Nombre AS Unimed,
	clientes_listado.Nombre AS Cliente';
	$SIS_join  = '
	LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = '.$tabla1.'.idUml
	LEFT JOIN `clientes_listado`      ON clientes_listado.idCliente  = '.$tabla1.'.idCliente';
	$SIS_where = '';
	$SIS_order = 'sistema_productos_uml.Nombre ASC';
	$arrProductos = array();
	$arrProductos = db_select_array (false, $SIS_query, $tabla1, $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrProductos');

	/******************************************************/
	$cadena = '';
	$cadena .= '<script>';
	foreach ($arrProductos as $prod) {
		$cadena .= 'let id_data_'.$prod['idAlgo'].'= "'.$prod['Unimed'].'";';
	}
	foreach ($arrProductos as $prod) {
		if(isset($prod['Cliente'])&&$prod['Cliente']!=''){$prov=$prod['Cliente'];}else{$prov='Sin cliente';}
		$cadena .= 'let id_prov_'.$prod['idAlgo'].'= "'.$prov.'";';
	}
	$cadena .= '</script>';

    $cadena .= '
    <script>
		document.getElementById("'.$input_1.'").onchange = function() {myFunction_'.$input_1.'()};

		function myFunction_'.$input_1.'() {
			const Componente = document.getElementById("'.$input_1.'").value;
			if (Componente != "") {
				document.getElementById("'.$input_result_1.'").value = eval("id_data_" + Componente);
				document.getElementById("'.$input_result_2.'").value = eval("id_prov_" + Componente);
			}
		}
	</script>
    ';
    return $cadena;
}
/*******************************************************************************************************************/
/* Toma dos input y calcula valores*/
function venta_print_value($tabla1, $input_1, $input_result_1, $dbConn) {

    /******************************************************/
	$SIS_query =
    $tabla1.'.idProducto AS idAlgo,
	sistema_productos_uml.Nombre AS Unimed';
	$SIS_join  = 'LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = '.$tabla1.'.idUml';
	$SIS_where = '';
	$SIS_order = 'sistema_productos_uml.Nombre ASC';
	$arrProductos = array();
	$arrProductos = db_select_array (false, $SIS_query, $tabla1, $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrProductos');

	/******************************************************/
	$cadena = '';
	$cadena .= '<script>';
	foreach ($arrProductos as $prod) {
		$cadena .= 'let id_data_'.$prod['idAlgo'].'= "'.$prod['Unimed'].'";';
	}
	$cadena .= '</script>';

    $cadena .= '
    <script>
		document.getElementById("'.$input_1.'").onchange = function() {myFunction_'.$input_1.'()};

		function myFunction_'.$input_1.'() {
			const Componente = document.getElementById("'.$input_1.'").value;
			if (Componente != "") {
				document.getElementById("'.$input_result_1.'").value = eval("id_data_" + Componente);
			}
		}
	</script>
    ';
    return $cadena;
}
/*******************************************************************************************************************/
/* Toma dos input y calcula valores*/
function operacion_input($input_1, $input_2, $input_result_1, $input_result_2, $operation) {

    switch ($operation) {
		case 1: $oper = '+'; break;
		case 2: $oper = '-'; break;
		case 3: $oper = '*'; break;
		case 4: $oper = '/'; break;
	}

    $cadena = '
    <script>
		document.getElementById("'.$input_1.'").onkeyup = function() {myFunction_'.$input_1.'()};
		document.getElementById("'.$input_2.'").onkeyup = function() {myFunction_'.$input_2.'()};

		function myFunction_'.$input_1.'() {
			const elem1 = document.getElementById("'.$input_1.'").value;
			const elem2 = document.getElementById("'.$input_2.'").value;
			if (elem1 != "" && elem2 != "") {
				document.getElementById("'.$input_result_1.'").value = elem2 '.$oper.' elem1;
				document.getElementById("'.$input_result_2.'").value = elem2 '.$oper.' elem1;
			}
		}

		function myFunction_'.$input_2.'() {
			const elem1 = document.getElementById("'.$input_2.'").value;
			const elem2 = document.getElementById("'.$input_1.'").value;
			if (elem1 != "" && elem2 != "") {
				document.getElementById("'.$input_result_1.'").value = elem1 '.$oper.' elem2;
				document.getElementById("'.$input_result_2.'").value = elem1 '.$oper.' elem2;
			}
		}
	</script>
    ';
    return $cadena;
}
/*******************************************************************************************************************/
/* Toma dos input y calcula valores*/
function prod_print_venta($idBodega, $dato, $tabla1, $tabla2, $input_select, $input_result_1, $input_result_2,
						  $input_result_3,$input_result_4, $dbConn) {

	//Imprimo las variables
	$SIS_query =
	$tabla1.'.idProducto,
	'.$tabla1.'.'.$dato.' AS Valorizacion,
	sistema_productos_uml.Nombre AS Unimed,
	(SELECT SUM(Cantidad_ing) AS ingreso FROM `'.$tabla2.'` WHERE idProducto = '.$tabla1.'.idProducto AND idBodega='.$idBodega.') AS ingreso,
	(SELECT SUM(Cantidad_eg) AS egreso FROM `'.$tabla2.'` WHERE idProducto = '.$tabla1.'.idProducto AND idBodega='.$idBodega.') AS egreso';
	$SIS_join  = 'LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = '.$tabla1.'.idUml';
	$SIS_where = $tabla1.'.idEstado=1';
	$SIS_order = 'sistema_productos_uml.Nombre ASC';
	$arrTipo = array();
	$arrTipo = db_select_array (false, $SIS_query, $tabla1, $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTipo');

	/***********************************************/
	$cadena = '';

	$cadena .= '<script>';
	foreach ($arrTipo as $tipo) {
		$Total_existencias = $tipo['ingreso'] - $tipo['egreso'];
		$cadena .= 'let uml_data_'.$tipo['idProducto'].'= "'.$tipo['Unimed'].'";';
		$cadena .= 'let valor_data_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($tipo['Valorizacion']).'";';
		$cadena .= 'let existencia_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($Total_existencias).'";';
	}
	$cadena .= '</script>';

    $cadena .= '
    <script>
    document.getElementById("'.$input_select.'").onchange = function() {myFunction_'.$input_select.'()};

		function myFunction_'.$input_select.'() {
			const Componente = document.getElementById("'.$input_select.'").value;
			if (Componente != "") {
				document.getElementById("'.$input_result_1.'").value = eval("uml_data_" + Componente);
				document.getElementById("'.$input_result_2.'").value = eval("valor_data_" + Componente);
				document.getElementById("'.$input_result_3.'").value = eval("existencia_" + Componente);
				document.getElementById("'.$input_result_4.'").value = eval("valor_data_" + Componente);
			}
		}
	</script>
    ';
    return $cadena;
}
/*******************************************************************************************************************/
//Funcion para seleccionar el tipo de input en los analisis
function print_select ($tipo, $Nombre,$idNombre,$valor, $Validacion) {
	//Verifico el tipo de dato
	switch ($tipo) {
		//Medicion (Decimal) con parametros limitantes
		case 1:
			return form_input_number($Nombre,$idNombre,$valor, 1);
			break;
		//Medicion (Decimal) sin parametros limitantes
		case 2:
			return form_input_number($Nombre,$idNombre,$valor, 1);
			break;
		//Medicion (Enteros) con parametros limitantes
		case 3:
			return form_input_number_integer($Nombre,$idNombre,$valor, 1);
			break;
		//Medicion (Enteros) sin parametros limitantes
		case 4:
			return form_input_number_integer($Nombre,$idNombre,$valor, 1);
			break;
		//Fecha
		case 5:
			return form_date($Nombre,$idNombre,$valor, 1);
			break;
		//Hora
		case 6:
			return form_time_popover($Nombre,$idNombre,$valor, 1, 1, 24);
			break;
		//Texto Libre
		case 7:
			return form_textarea($Nombre,$idNombre,$valor, 1);
			break;
		//Seleccion 1 a 3
		case 8:
			return form_select_n_auto($Nombre,$idNombre,$valor, 1, 1, 3);
			break;
		//Seleccion 1 a 5
		case 9:
			return form_select_n_auto($Nombre,$idNombre,$valor, 1, 1, 5);
			break;
		//Seleccion 1 a 10
		case 10:
			return form_select_n_auto($Nombre,$idNombre,$valor, 1, 1, 10);
			break;
		//Texto Libre con Validacion
		case 11:
			echo form_input_validate($Nombre,$idNombre,$valor, 1, $Validacion);
			break;

	}

}
/*******************************************************************************************************************/
//Verifico si los parametros estan dentro del radio
function TituloMenu( $Nombre ) {

    $xdata  = array("81 - ", "82 - ", "83 - ", "84 - ", "85 - ", "86 - ", "87 - ", "88 - ", "89 - ", "90 - ",
					"71 - ", "72 - ", "73 - ", "74 - ", "75 - ", "76 - ", "77 - ", "78 - ", "79 - ", "80 - ",
					"61 - ", "62 - ", "63 - ", "64 - ", "65 - ", "66 - ", "67 - ", "68 - ", "69 - ", "70 - ",
					"51 - ", "52 - ", "53 - ", "54 - ", "55 - ", "56 - ", "57 - ", "58 - ", "59 - ", "60 - ",
					"41 - ", "42 - ", "43 - ", "44 - ", "45 - ", "46 - ", "47 - ", "48 - ", "49 - ", "50 - ",
					"31 - ", "32 - ", "33 - ", "34 - ", "35 - ", "36 - ", "37 - ", "38 - ", "39 - ", "40 - ",
					"21 - ", "22 - ", "23 - ", "24 - ", "25 - ", "26 - ", "27 - ", "28 - ", "29 - ", "30 - ",
					"11 - ", "12 - ", "13 - ", "14 - ", "15 - ", "16 - ", "17 - ", "18 - ", "19 - ", "20 - ",
					"01 - ", "02 - ", "03 - ", "04 - ", "05 - ", "06 - ", "07 - ", "08 - ", "09 - ", "10 - ",
					"1 - ", "2 - ", "3 - ", "4 - ", "5 - ", "6 - ", "7 - ", "8 - ", "9 - ");

	$newText = str_replace($xdata, "", $Nombre);

    return $newText;
}
/*******************************************************************************************************************/
//Permite verificar si se trata de ingresar a un sitio a la fuerza
function checkbrute($usuario, $email, $IP_Client, $table, $dbConn) {
    /**********************************************************************/
	// Obtiene el timestamp del tiempo actual.
    $now = time();

    // Todos los intentos de inicio de sesión se cuentan desde las 2 horas anteriores.
    $valid_attempts = $now - (2 * 60 * 60);

	//variables vacias
	$num_rows = 0;

	/**********************************************************************/
	//Consulto si el usuario ha tratado de ingresar en reiteradas ocaciones
	if($num_rows==0&&isset($usuario)&&$usuario!=''){
		$num_rows = db_select_nrows (false, 'idAcceso', $table, '', 'usuario = "'.$usuario.'" AND Time > "'.$valid_attempts.'"', $dbConn, 'rowSis', basename($_SERVER["REQUEST_URI"], ".php"), 'rowSis');
	}

	//Consulto si el ip ha tratado de ingresar en reiteradas ocaciones
	if($num_rows==0&&isset($IP_Client)&&$IP_Client!=''){
		$num_rows = db_select_nrows (false, 'idAcceso', $table, '', 'IP_Client = "'.$IP_Client.'" AND Time > "'.$valid_attempts.'"', $dbConn, 'rowSis', basename($_SERVER["REQUEST_URI"], ".php"), 'rowSis');
	}

	//Consulto si el ip ha tratado de ingresar en reiteradas ocaciones
	if($num_rows==0&&isset($email)&&$email!=''){
		$num_rows = db_select_nrows (false, 'idAcceso', $table, '', 'email = "'.$email.'" AND Time > "'.$valid_attempts.'"', $dbConn, 'rowSis', basename($_SERVER["REQUEST_URI"], ".php"), 'rowSis');
	}

	/**********************************************************************/
    // Si ha habido más de 5 intentos de inicio de sesión fallidos.
    if ($num_rows > 5) {
        return true;
    } else {
        return false;
    }

}
/*******************************************************************************************************************/
//Funcion para guardar datos
function valida_latxlong($Direccion, $Config_IDGoogle){
	$geocodeData = getGeocodeData($Direccion, $Config_IDGoogle);
	if($geocodeData) {
		return true;
    } else {
        return false;
    }
}
/*******************************************************************************************************************/
//Funcion para guardar datos
function latxlong($Direccion, $Config_IDGoogle,  $idSubasta, $dbConn){
	$geocodeData = getGeocodeData($Direccion, $Config_IDGoogle);
	if($geocodeData) {
		$GeoLatitud  = $geocodeData[0];
		$GeoLongitud = $geocodeData[1];

		if(isset($idSubasta) && $idSubasta!=''){        $SIS_data  = "'".$idSubasta."'";      }else{$SIS_data  = "''";}
		if(isset($GeoLatitud) && $GeoLatitud!=''){      $SIS_data .= ",'".$GeoLatitud."'";    }else{$SIS_data .= ",''";}
		if(isset($GeoLongitud) && $GeoLongitud!=''){    $SIS_data .= ",'".$GeoLongitud."'";   }else{$SIS_data .= ",''";}
		if(isset($Direccion) && $Direccion!=''){        $SIS_data .= ",'".$Direccion."'";     }else{$SIS_data .= ",''";}

		// inserto los datos de registro en la db
		$SIS_columns = 'idSubasta, GeoLatitud,GeoLongitud,Direccion';
		$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'subastas_listado_ubicaciones', $dbConn, 'db_insert_data', basename($_SERVER["REQUEST_URI"], ".php"), 'db_insert_data');

	}
}
/*******************************************************************************************************************/
//Funcion para saber si esta o no dentro de un area
function inLocationPoint($arrZonas, $pointLocation, $GeoLatitud, $GeoLongitud){
	//variable
	$nx = 0;
	//recorro las areas
	foreach ($arrZonas as $todaszonas=>$zonas) {
		//arreglo para el pligono
		$polygon = array();
		//variables para cerrar el poligono
		$ini     = 0;
		$f_lat   = 0;
		$f_long  = 0;
		//recorro las zonas
		foreach ($zonas as $puntos) {
			array_push( $polygon,$puntos['Latitud'].' '.$puntos['Longitud'] );
			//si es el primer dato
			if($ini==0){
				$f_lat  = $puntos['Latitud'];
				$f_long = $puntos['Longitud'];
			}
			$ini++;
		}
		//inserto el primer dato como el ultimo para cerrar poligono
		array_push( $polygon,$f_lat.' '.$f_long );
		//verifico
		$c_chek =  $pointLocation->pointInPolygon($GeoLatitud.' '.$GeoLongitud, $polygon);
		//si esta dentro de la zona
		if($c_chek=='inside'){
			if($nx==0){
				$nx = $todaszonas;
			}
		}
	}
	//devuelvo
	return $nx;
}
/*******************************************************************************************************************/
//Funcion mostrar superficies
function SuperficieDisponible($idUniMed, $SupDisp, $UniMed){

	/********************************************************/
	//Definicion de errores
	$errorn = 0;
	//se definen las opciones disponibles
	$tipos = array(1,4);
	//verifico si el dato ingresado existe dentro de las opciones
	if (!in_array($idUniMed, $tipos)) {
		alert_post_data(4,1,1,0, 'La configuracion $idUniMed ('.$idUniMed.') entregada no esta dentro de las opciones');
		$errorn++;
	}
	/********************************************************/
	//Ejecucion si no hay errores
	if($errorn==0){

		/********************************************/
		//Si se envia valores
		if(isset($SupDisp)&&$SupDisp!=0){
			switch ($idUniMed) {
				/********************************************/
				//hectareas
				case 1:
					$S_1 = $SupDisp;
					$S_2 = $SupDisp * 10000;
					$U_1 = $UniMed;
					$U_2 = 'm<sup>2</sup>';

					$data = Cantidades($S_1, 2).' '.$U_1;
					$data.= ' / ';
					$data.= Cantidades($S_2, 0).' '.$U_2;

					break;
				/********************************************/
				//metro cuadrado
				case 4:
					$S_1 = $SupDisp / 10000;
					$S_2 = $SupDisp;
					$U_1 = 'hás';
					$U_2 = $UniMed;

					$data = Cantidades($S_1, 2).' '.$U_1;
					$data.= ' / ';
					$data.= Cantidades($S_2, 0).' '.$U_2;

					break;
			}
		/********************************************/
		//si no hay valor solo devuelve unidad medida
		}else{
			$data = $UniMed;
		}

		/********************************************/
		//devuelvo
		return $data;
	}
}
/*******************************************************************************************************************/
//Funcion mostrar superficies
function SuperficieDisponibleEdificios($idUniMed, $SupDisp, $UniMed){

	/********************************************************/
	//Definicion de errores
	$errorn = 0;
	//se definen las opciones disponibles
	$tipos = array(1,4);
	//verifico si el dato ingresado existe dentro de las opciones
	if (!in_array($idUniMed, $tipos)) {
		alert_post_data(4,1,1,0, 'La configuracion $idUniMed ('.$idUniMed.') entregada no esta dentro de las opciones');
		$errorn++;
	}
	/********************************************************/
	//Ejecucion si no hay errores
	if($errorn==0){

		/********************************************/
		//Si se envia valores
		if(isset($SupDisp)&&$SupDisp!=0){
			switch ($idUniMed) {
				/********************************************/
				//hectareas
				case 1:
					$S_2 = $SupDisp * 10000;
					$U_2 = 'm<sup>2</sup>';

					$data = Cantidades($S_2, 0).' '.$U_2;

					break;
				/********************************************/
				//metro cuadrado
				case 4:
					$S_2 = $SupDisp;
					$U_2 = $UniMed;

					$data = Cantidades($S_2, 0).' '.$U_2;

					break;
			}
		/********************************************/
		//si no hay valor solo devuelve unidad medida
		}else{
			$data = $UniMed;
		}

		/********************************************/
		//devuelvo
		return $data;
	}
}
/*******************************************************************************************************************/
//Funcion mostrar superficies
function SuperficieDisponibleCasas($idUniMed, $SupDisp, $UniMed){

	/********************************************************/
	//Definicion de errores
	$errorn = 0;
	//se definen las opciones disponibles
	$tipos = array(1,4);
	//verifico si el dato ingresado existe dentro de las opciones
	if (!in_array($idUniMed, $tipos)) {
		alert_post_data(4,1,1,0, 'La configuracion $idUniMed ('.$idUniMed.') entregada no esta dentro de las opciones');
		$errorn++;
	}
	/********************************************************/
	//Ejecucion si no hay errores
	if($errorn==0){

		/********************************************/
		//Si se envia valores
		if(isset($SupDisp)&&$SupDisp!=0){
			switch ($idUniMed) {
				/********************************************/
				//hectareas
				case 1:
					$S_1 = $SupDisp;
					$U_1 = $UniMed;

					$data = Cantidades($S_1, 2).' '.$U_1;

					break;
				/********************************************/
				//metro cuadrado
				case 4:
					$S_1 = $SupDisp / 10000;
					$U_1 = 'hás';

					$data = Cantidades($S_1, 2).' '.$U_1;

					break;
			}
		/********************************************/
		//si no hay valor solo devuelve unidad medida
		}else{
			$data = $UniMed;
		}

		/********************************************/
		//devuelvo
		return $data;
	}
}
/*******************************************************************************************************************/
//Funcion mostrar superficies
function NewClienteVet($ClientID, $dbConn){

	/*********************************************/
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_caniles_listado`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_duenos_listado`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_duenos_listado_historial`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_duenos_listado_mascotas`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_duenos_listado_mascotas_historial`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_facturacion_listado`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_facturacion_listado_consumos`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_facturacion_listado_descuentos`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_facturacion_listado_existencias`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_facturacion_listado_historial`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_facturacion_listado_servicios`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_hospitalizacion_listado`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_peluqueria_atencion_listado`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_peluqueria_dias_listado`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_productos_listado`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_productos_listado_historial`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_proveedores_listado`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_proveedores_listado_email`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_proveedores_listado_fono`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_proveedores_listado_historial`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_reservas_listado`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_servicios_listado`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_servicios_listado_historial`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_servicios_listado_productos`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_trabajadores_listado`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_trabajadores_listado_email`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_trabajadores_listado_fono`;";
	$result = mysqli_query($dbConn, $query);
	// elimino la tabla si es que existe
	$query  = "DROP TABLE IF EXISTS `clientes_list_".$ClientID."_vet_trabajadores_listado_historial`;";
	$result = mysqli_query($dbConn, $query);

	/*********************************************/
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_caniles_listado`  (
		`idCanil` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Ubicacion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		`Direccion_img` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`fCreacion` date NOT NULL,
		PRIMARY KEY (`idCanil`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_duenos_listado`  (
		`idDueno` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`Nombre` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Rut` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`email` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idCiudad` int UNSIGNED NOT NULL,
		`idComuna` int UNSIGNED NOT NULL,
		`Direccion` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Fono1` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Fono2` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Direccion_img` varchar(180) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		`password` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`InscripcionFecha` date NOT NULL,
		`idSexo` int UNSIGNED NOT NULL,
		`DNI_Image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idDueno`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_duenos_listado_historial`  (
		`idHistorial` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idDueno` bigint UNSIGNED NOT NULL,
		`idTrabajador` int UNSIGNED NOT NULL,
		`Creacion_fecha` date NOT NULL,
		`Observaciones` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idHistorial`, `idDueno`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_duenos_listado_mascotas`  (
		`idMascota` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idDueno` bigint UNSIGNED NOT NULL,
		`Nombre` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`fNacimiento` date NOT NULL,
		`idSexo` int UNSIGNED NOT NULL,
		`idTipo` int UNSIGNED NOT NULL,
		`idRaza` int UNSIGNED NOT NULL,
		`Observaciones` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Direccion_img` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		`FechaIngreso` date NOT NULL,
		`idTamano` int UNSIGNED NOT NULL,
		`EnfermedadesPrexist` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`ContraIndicaciones` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Microchip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idEstadoReproductivo` int UNSIGNED NOT NULL,
		`Color` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`GrupoSanguineo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idMascota`, `idDueno`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_duenos_listado_mascotas_historial`  (
		`idHistorial` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idMascota` bigint UNSIGNED NOT NULL,
		`idTrabajador` int UNSIGNED NOT NULL,
		`idAtencion` int UNSIGNED NOT NULL,
		`Creacion_fecha` date NOT NULL,
		`Creacion_hora` time NOT NULL,
		`idServicio` int UNSIGNED NOT NULL,
		`Peso` decimal(10, 2) UNSIGNED NOT NULL,
		`Temperatura` decimal(10, 2) UNSIGNED NOT NULL,
		`idConstantes` int UNSIGNED NOT NULL,
		`idBucal` int UNSIGNED NOT NULL,
		`Observaciones` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Sintomas` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Diagnostico` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idFacturacion` bigint UNSIGNED NOT NULL,
		PRIMARY KEY (`idHistorial`, `idMascota`, `idFacturacion`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_facturacion_listado`  (
		`idFacturacion` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idTipo` int UNSIGNED NOT NULL,
		`idProveedor` int UNSIGNED NOT NULL,
		`idDueno` bigint UNSIGNED NOT NULL,
		`idDocumentos` int UNSIGNED NOT NULL,
		`N_Doc` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Creacion_fecha` date NOT NULL,
		`Creacion_Semana` int UNSIGNED NOT NULL,
		`Creacion_mes` int UNSIGNED NOT NULL,
		`Creacion_ano` int UNSIGNED NOT NULL,
		`Creacion_hora` time NOT NULL,
		`Observaciones` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		`ValorNeto` int UNSIGNED NOT NULL,
		`IVA` int UNSIGNED NOT NULL,
		`ValorTotal` int UNSIGNED NOT NULL,
		`fecha_auto` date NOT NULL,
		`idUsoIVA` int UNSIGNED NOT NULL,
		`idDocPago` int UNSIGNED NOT NULL,
		`N_DocPago` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`MontoPagado` int UNSIGNED NOT NULL,
		`idConsulta` int UNSIGNED NOT NULL,
		`idTrabajador` int UNSIGNED NOT NULL,
		PRIMARY KEY (`idFacturacion`, `idDueno`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_facturacion_listado_consumos`  (
		`idConsumo` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idFacturacion` bigint UNSIGNED NOT NULL,
		`idServicio` int UNSIGNED NOT NULL,
		`idProducto` int UNSIGNED NOT NULL,
		`Number` decimal(11, 2) UNSIGNED NOT NULL,
		`idExistencia` bigint UNSIGNED NOT NULL,
		PRIMARY KEY (`idConsumo`, `idFacturacion`, `idExistencia`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Fixed;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_facturacion_listado_descuentos`  (
		`idDescuento` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idFacturacion` bigint UNSIGNED NOT NULL,
		`Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`DescuentoTotal` int UNSIGNED NOT NULL,
		PRIMARY KEY (`idDescuento`, `idFacturacion`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_facturacion_listado_existencias`  (
		`idExistencia` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idFacturacion` bigint UNSIGNED NOT NULL,
		`idProducto` int UNSIGNED NOT NULL,
		`Number` int UNSIGNED NOT NULL,
		`ValorTotal` int UNSIGNED NOT NULL,
		PRIMARY KEY (`idExistencia`, `idFacturacion`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Fixed;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_facturacion_listado_historial`  (
		`idHistorial` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idFacturacion` bigint UNSIGNED NOT NULL,
		`idTrabajador` int UNSIGNED NOT NULL,
		`Creacion_fecha` date NOT NULL,
		`Observacion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idHistorial`, `idFacturacion`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_facturacion_listado_servicios`  (
		`idExistencia` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idFacturacion` bigint UNSIGNED NOT NULL,
		`idServicio` int UNSIGNED NOT NULL,
		`Number` int UNSIGNED NOT NULL,
		`ValorTotal` int UNSIGNED NOT NULL,
		PRIMARY KEY (`idExistencia`, `idFacturacion`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Fixed;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_hospitalizacion_listado`  (
		`idHospitalizacion` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idDueno` bigint UNSIGNED NOT NULL,
		`idMascota` bigint UNSIGNED NOT NULL,
		`InicioFecha` date NOT NULL,
		`InicioHora` time NOT NULL,
		`TerminoFecha` date NOT NULL,
		`TerminoHora` time NOT NULL,
		`idServicio` int UNSIGNED NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		`Observacion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idTrabajador` int UNSIGNED NOT NULL,
		`idOrigen` int UNSIGNED NOT NULL,
		`idCanil` int UNSIGNED NOT NULL,
		`idFacturacion` bigint UNSIGNED NOT NULL,
		PRIMARY KEY (`idHospitalizacion`, `idDueno`, `idMascota`, `idFacturacion`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_peluqueria_atencion_listado`  (
		`idPeluqueria` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idDueno` bigint UNSIGNED NOT NULL,
		`idMascota` bigint UNSIGNED NOT NULL,
		`idFecha` bigint UNSIGNED NOT NULL,
		`Dia` int UNSIGNED NOT NULL,
		`Mes` int UNSIGNED NOT NULL,
		`Ano` int UNSIGNED NOT NULL,
		`idHora` int UNSIGNED NOT NULL,
		`idServicio` int UNSIGNED NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		`Observacion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idTrabajador` int UNSIGNED NOT NULL,
		`idFacturacion` bigint UNSIGNED NOT NULL,
		`idConfirmacion` int UNSIGNED NOT NULL,
		PRIMARY KEY (`idPeluqueria`, `idDueno`, `idMascota`, `idFacturacion`, `idFecha`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_peluqueria_dias_listado`  (
		`idFecha` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`Fecha` date NOT NULL,
		`Ano` int UNSIGNED NOT NULL,
		`Mes` int UNSIGNED NOT NULL,
		`Dia` int UNSIGNED NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		PRIMARY KEY (`idFecha`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Fixed;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_productos_listado`  (
		`idProducto` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`idTipo` int UNSIGNED NOT NULL,
		`idCategoria` int UNSIGNED NOT NULL,
		`idUml` int UNSIGNED NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		`Nombre` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Marca` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`StockActual` decimal(11, 2) NOT NULL,
		`StockLimite` decimal(11, 2) UNSIGNED NOT NULL,
		`ValorIngreso` decimal(20, 6) UNSIGNED NOT NULL,
		`ValorEgreso` decimal(20, 6) UNSIGNED NOT NULL,
		`Descripcion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Codigo` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Direccion_img` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idProducto`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_productos_listado_historial`  (
		`idHistorial` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`idProducto` int UNSIGNED NOT NULL,
		`idTrabajador` int UNSIGNED NOT NULL,
		`Creacion_fecha` date NOT NULL,
		`Observaciones` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idHistorial`, `idProducto`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_proveedores_listado`  (
		`idProveedor` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`Rut` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idCiudad` int UNSIGNED NOT NULL,
		`idComuna` int UNSIGNED NOT NULL,
		`Direccion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		`Direccion_img` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`fCreacion` date NOT NULL,
		`idTipo` int UNSIGNED NOT NULL,
		`Giro` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idProveedor`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_proveedores_listado_email`  (
		`idEmail` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`idProveedor` int UNSIGNED NOT NULL,
		`Email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Comentario` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idEmail`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_proveedores_listado_fono`  (
		`idFono` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`idProveedor` int UNSIGNED NOT NULL,
		`Fono` int UNSIGNED NOT NULL,
		`Comentario` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idFono`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_proveedores_listado_historial`  (
		`idHistorial` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`idProveedor` int UNSIGNED NOT NULL,
		`idTrabajador` int UNSIGNED NOT NULL,
		`Creacion_fecha` date NOT NULL,
		`Observaciones` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idHistorial`, `idProveedor`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_reservas_listado`  (
		`idReservas` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
		`idDueno` bigint UNSIGNED NOT NULL,
		`idMascota` bigint UNSIGNED NOT NULL,
		`Fecha` date NOT NULL,
		`Dia` int UNSIGNED NOT NULL,
		`Mes` int UNSIGNED NOT NULL,
		`Ano` int UNSIGNED NOT NULL,
		`Hora` time NOT NULL,
		`idServicio` int UNSIGNED NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		`Observacion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idTrabajador` int UNSIGNED NOT NULL,
		`idOrigen` int UNSIGNED NOT NULL,
		`idConfirmacion` int UNSIGNED NOT NULL,
		PRIMARY KEY (`idReservas`, `idDueno`, `idMascota`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_servicios_listado`  (
		`idServicio` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`idCategoria` int UNSIGNED NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		`Nombre` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`ValorEgreso` decimal(20, 6) UNSIGNED NOT NULL,
		`Descripcion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Codigo` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Direccion_img` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idServicioProg` int UNSIGNED NOT NULL,
		`nDiasProg` int UNSIGNED NOT NULL,
		PRIMARY KEY (`idServicio`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_servicios_listado_historial`  (
		`idHistorial` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`idServicio` int UNSIGNED NOT NULL,
		`idTrabajador` int UNSIGNED NOT NULL,
		`Creacion_fecha` date NOT NULL,
		`Observaciones` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idHistorial`, `idServicio`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_servicios_listado_productos`  (
		`idProdRel` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`idServicio` int UNSIGNED NOT NULL,
		`idProducto` int UNSIGNED NOT NULL,
		`Cantidad` decimal(11, 2) UNSIGNED NOT NULL,
		PRIMARY KEY (`idProdRel`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Fixed;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_trabajadores_listado`  (
		`idTrabajador` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`Rut` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`ApellidoPaterno` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`ApellidoMaterno` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`fNacimiento` date NOT NULL,
		`idSexo` int UNSIGNED NOT NULL,
		`idCiudad` int UNSIGNED NOT NULL,
		`idComuna` int UNSIGNED NOT NULL,
		`Direccion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idEstado` int UNSIGNED NOT NULL,
		`Direccion_img` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Cargo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`idMandatory` int UNSIGNED NOT NULL,
		`idCreator` int UNSIGNED NOT NULL,
		`fCreacion` date NOT NULL,
		`idDiaUso_1` int UNSIGNED NOT NULL,
		`idDiaUso_2` int UNSIGNED NOT NULL,
		`idDiaUso_3` int UNSIGNED NOT NULL,
		`idDiaUso_4` int UNSIGNED NOT NULL,
		`idDiaUso_5` int UNSIGNED NOT NULL,
		`idDiaUso_6` int UNSIGNED NOT NULL,
		`idDiaUso_7` int UNSIGNED NOT NULL,
		`DiaHoraInicio_1` time NOT NULL,
		`DiaHoraInicio_2` time NOT NULL,
		`DiaHoraInicio_3` time NOT NULL,
		`DiaHoraInicio_4` time NOT NULL,
		`DiaHoraInicio_5` time NOT NULL,
		`DiaHoraInicio_6` time NOT NULL,
		`DiaHoraInicio_7` time NOT NULL,
		`DiaHoraTermino_1` time NOT NULL,
		`DiaHoraTermino_2` time NOT NULL,
		`DiaHoraTermino_3` time NOT NULL,
		`DiaHoraTermino_4` time NOT NULL,
		`DiaHoraTermino_5` time NOT NULL,
		`DiaHoraTermino_6` time NOT NULL,
		`DiaHoraTermino_7` time NOT NULL,
		`idPermisosCaja` int UNSIGNED NOT NULL,
		`idPermisosAtencion` int UNSIGNED NOT NULL,
		`idPermisosBodegaIng` int UNSIGNED NOT NULL,
		`idPermisosBodegaGasto` int UNSIGNED NOT NULL,
		`idPermisosBodegaVenta` int UNSIGNED NOT NULL,
		`idPermisosReservas` int UNSIGNED NOT NULL,
		`idPermisosPeluqueria` int UNSIGNED NOT NULL,
		`idPermisosInformes` int UNSIGNED NOT NULL,
		PRIMARY KEY (`idTrabajador`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_trabajadores_listado_email`  (
		`idEmail` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`idTrabajador` int UNSIGNED NOT NULL,
		`Email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		`Comentario` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idEmail`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_trabajadores_listado_fono`  (
		`idFono` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`idTrabajador` int UNSIGNED NOT NULL,
		`Fono` int UNSIGNED NOT NULL,
		`Comentario` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idFono`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);
	// se crea la nueva tabla
	$query  = "CREATE TABLE `clientes_list_".$ClientID."_vet_trabajadores_listado_historial`  (
		`idHistorial` int UNSIGNED NOT NULL AUTO_INCREMENT,
		`idTrabajador` int UNSIGNED NOT NULL,
		`idTrabajadorID` int UNSIGNED NOT NULL,
		`Creacion_fecha` date NOT NULL,
		`Observaciones` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
		PRIMARY KEY (`idHistorial`, `idTrabajador`) USING BTREE
	  ) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Dinamica' ROW_FORMAT = Dynamic;";
	$result = mysqli_query($dbConn, $query);


}

?>
