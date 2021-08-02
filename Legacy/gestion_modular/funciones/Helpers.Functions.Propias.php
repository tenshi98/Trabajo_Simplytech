<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                  Funciones                                                      */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/
/* Toma dos input y calcula valores*/
function prod_print_value($tabla1, $input_1, $input_result_1, $input_result_2, $dbConn) {
    
    $arrProductos = array();
	$query = "SELECT 
	".$tabla1.".idProducto AS IdAlgo,
	sistema_productos_uml.Nombre AS Unimed,
	proveedor_listado.Nombre AS Proveedor
	FROM `".$tabla1."`
	LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml      = ".$tabla1.".idUml
	LEFT JOIN `proveedor_listado`       ON proveedor_listado.idProveedor    = ".$tabla1.".idProveedor
	ORDER BY sistema_productos_uml.Nombre ASC";
	$resultado = mysqli_query($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrProductos,$row );
	}
	
	$cadena = '';			
	$cadena .= '<script>';
	foreach ($arrProductos as $prod) {
		$cadena .= 'var id_data_'.$prod['IdAlgo'].'= "'.$prod['Unimed'].'";';	
	}
	foreach ($arrProductos as $prod) {
		if(isset($prod['Proveedor'])&&$prod['Proveedor']!=''){$prov=$prod['Proveedor'];}else{$prov='Sin proveedor';}
		$cadena .= 'var id_prov_'.$prod['IdAlgo'].'= "'.$prov.'";';	
	}
	$cadena .= '</script>';
				
    
    $cadena .= '
    <script>
		document.getElementById("'.$input_1.'").onchange = function() {myFunction_'.$input_1.'()};

		function myFunction_'.$input_1.'() {
			var Componente = document.getElementById("'.$input_1.'").value;
			if (Componente != "") {
				id_data1=eval("id_data_" + Componente)
				id_data2=eval("id_prov_" + Componente)
				//escribo dentro del input
				var elem1 = document.getElementById("'.$input_result_1.'");
				var elem2 = document.getElementById("'.$input_result_2.'");
				elem1.value = id_data1;
				elem2.value = id_data2;
			}
		}
	</script>
    ';
    return $cadena;
}
/*******************************************************************************************************************/
/* Toma dos input y calcula valores*/
function sell_print_value($tabla1, $input_1, $input_result_1, $input_result_2, $dbConn) {
    
    $arrProductos = array();
	$query = "SELECT 
	".$tabla1.".idProducto AS IdAlgo,
	sistema_productos_uml.Nombre AS Unimed,
	clientes_listado.Nombre AS Cliente
	FROM `".$tabla1."`
	LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml   = ".$tabla1.".idUml
	LEFT JOIN `clientes_listado`        ON clientes_listado.idCliente    = ".$tabla1.".idCliente
	ORDER BY sistema_productos_uml.Nombre";
	$resultado = mysqli_query($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrProductos,$row );
	}
	
	$cadena = '';			
	$cadena .= '<script>';
	foreach ($arrProductos as $prod) {
		$cadena .= 'var id_data_'.$prod['IdAlgo'].'= "'.$prod['Unimed'].'";';	
	}
	foreach ($arrProductos as $prod) {
		if(isset($prod['Cliente'])&&$prod['Cliente']!=''){$prov=$prod['Cliente'];}else{$prov='Sin cliente';}
		$cadena .= 'var id_prov_'.$prod['IdAlgo'].'= "'.$prov.'";';	
	}
	$cadena .= '</script>';
				
    
    $cadena .= '
    <script>
		document.getElementById("'.$input_1.'").onchange = function() {myFunction_'.$input_1.'()};

		function myFunction_'.$input_1.'() {
			var Componente = document.getElementById("'.$input_1.'").value;
			if (Componente != "") {
				id_data1=eval("id_data_" + Componente)
				id_data2=eval("id_prov_" + Componente)
				//escribo dentro del input
				var elem1 = document.getElementById("'.$input_result_1.'");
				var elem2 = document.getElementById("'.$input_result_2.'");
				elem1.value = id_data1;
				elem2.value = id_data2;
			}
		}
	</script>
    ';
    return $cadena;
}
/*******************************************************************************************************************/
/* Toma dos input y calcula valores*/
function venta_print_value($tabla1, $input_1, $input_result_1, $dbConn) {
    
    $arrProductos = array();
	$query = "SELECT 
	".$tabla1.".idProducto AS IdAlgo,
	sistema_productos_uml.Nombre AS Unimed
	FROM `".$tabla1."`
	LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml      = ".$tabla1.".idUml
	ORDER BY sistema_productos_uml.Nombre";
	$resultado = mysqli_query($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrProductos,$row );
	}
	
	$cadena = '';			
	$cadena .= '<script>';
	foreach ($arrProductos as $prod) {
		$cadena .= 'var id_data_'.$prod['IdAlgo'].'= "'.$prod['Unimed'].'";';	
	}
	$cadena .= '</script>';
				
    
    $cadena .= '
    <script>
		document.getElementById("'.$input_1.'").onchange = function() {myFunction_'.$input_1.'()};

		function myFunction_'.$input_1.'() {
			var Componente = document.getElementById("'.$input_1.'").value;
			if (Componente != "") {
				id_data1=eval("id_data_" + Componente)
				//escribo dentro del input
				var elem1 = document.getElementById("'.$input_result_1.'");
				elem1.value = id_data1;
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
			var elem1 = document.getElementById("'.$input_1.'").value
			if (elem1 != "") {
				var elem2 = document.getElementById("'.$input_2.'").value;
								
				result=elem2 '.$oper.' elem1;
				//escribo dentro del input
				var '.$input_result_1.' = document.getElementById("'.$input_result_1.'");
				var '.$input_result_2.' = document.getElementById("'.$input_result_2.'");
				'.$input_result_1.'.value = result;
				'.$input_result_2.'.value = result;
			}
		}
		
		function myFunction_'.$input_2.'() {
			var elem1 = document.getElementById("'.$input_2.'").value
			if (elem1 != "") {
				var elem2 = document.getElementById("'.$input_1.'").value;
								
				result=elem1 '.$oper.' elem2;
				//escribo dentro del input
				var '.$input_result_1.' = document.getElementById("'.$input_result_1.'");
				var '.$input_result_2.' = document.getElementById("'.$input_result_2.'");
				'.$input_result_1.'.value = result;
				'.$input_result_2.'.value = result;
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
	$arrTipo = array();
	$query = "SELECT 
	".$tabla1.".idProducto,
	".$tabla1.".".$dato." AS Valorizacion,
	sistema_productos_uml.Nombre AS Unimed,
				
		(SELECT 
		SUM(Cantidad_ing) AS ingreso
		FROM `".$tabla2."`
		WHERE idProducto = ".$tabla1.".idProducto 
		AND idBodega=".$idBodega.") AS ingreso,
					
		(SELECT 
		SUM(Cantidad_eg) AS egreso
		FROM `".$tabla2."`
		WHERE idProducto = ".$tabla1.".idProducto 
		AND idBodega=".$idBodega.") AS egreso
					
	FROM `".$tabla1."`
	LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = ".$tabla1.".idUml
	WHERE ".$tabla1.".idEstado=1
	ORDER BY sistema_productos_uml.Nombre";
	$resultado = mysqli_query($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrTipo,$row );
	}
				
	
	$cadena = '';
	
	$cadena .= '<script>';
	foreach ($arrTipo as $tipo) {
		$cadena .= 'var uml_data_'.$tipo['idProducto'].'= "'.$tipo['Unimed'].'";';	
	}
	foreach ($arrTipo as $tipo) {
		$cadena .= 'var valor_data_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($tipo['Valorizacion']).'";';	
	}
	foreach ($arrTipo as $tipo) {
		$Total_existencias = $tipo['ingreso'] - $tipo['egreso'];
		$cadena .= 'var existencia_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($Total_existencias).'";';	
	}
	$cadena .= '</script>';			
							
	
				
    
    $cadena .= '
    <script>
    document.getElementById("'.$input_select.'").onchange = function() {myFunction_'.$input_select.'()};

		function myFunction_'.$input_select.'() {
			var Componente = document.getElementById("'.$input_select.'").value;
			if (Componente != "") {
						
				uml_data   = eval("uml_data_" + Componente)
				valor_data = eval("valor_data_" + Componente)
				existencia = eval("existencia_" + Componente)
						
				var elem1 = document.getElementById("'.$input_result_1.'");
				var elem2 = document.getElementById("'.$input_result_2.'");
				var elem3 = document.getElementById("'.$input_result_3.'");
				var elem4 = document.getElementById("'.$input_result_4.'");
						
				elem1.value = uml_data;
				elem2.value = valor_data;
				elem3.value = existencia;
				elem4.value = valor_data;
			}
		}
	</script>
    ';
    return $cadena;
}
/*******************************************************************************************************************/
//Funcion para seleccionar el tipo de input en los analisis
function print_select ($tipo, $Nombre, $idNombre, $valor, $Validacion) {
	//Verifico el tipo de dato
	switch ($tipo) {
		//Medicion (Decimal) con parametros limitantes
		case 1:
			return form_input_number($Nombre, $idNombre, $valor, 1);
			break;
		//Medicion (Decimal) sin parametros limitantes
		case 2:
			return form_input_number($Nombre, $idNombre, $valor, 1);
			break;
		//Medicion (Enteros) con parametros limitantes
		case 3:
			return form_input_number_integer($Nombre, $idNombre, $valor, 1);
			break;
		//Medicion (Enteros) sin parametros limitantes
		case 4:
			return form_input_number_integer($Nombre, $idNombre, $valor, 1);
			break;
		//Fecha
		case 5:
			return form_date($Nombre,$idNombre, $valor, 1);
			break;
		//Hora
		case 6:
			return form_time_popover($Nombre,$idNombre, $valor, 1, 1, 24);
			break;
		//Texto Libre
		case 7:
			return form_textarea($Nombre,$idNombre, $valor, 1, 160);
			break;
		//Seleccion 1 a 3
		case 8:
			return form_select_n_auto($Nombre,$idNombre, $valor, 1, 1, 3);
			break;
		//Seleccion 1 a 5
		case 9:
			return form_select_n_auto($Nombre,$idNombre, $valor, 1, 1, 5);
			break;
		//Seleccion 1 a 10
		case 10:
			return form_select_n_auto($Nombre,$idNombre, $valor, 1, 1, 10);
			break;
		//Texto Libre con Validacion
		case 11:
			echo form_input_validate($Nombre,$idNombre, $valor, 1, $Validacion);
			break;		
										
	}
 
}
/*******************************************************************************************************************/
//Verifico si los parametros estan dentro del radio
function TituloMenu( $Nombre ) {  
    
    $xdata  = array("1 - ", "2 - ", "3 - ", "4 - ", "5 - ", "6 - ", "7 - ", "8 - ", "9 - ", "10 - ", 
					"11 - ", "12 - ", "13 - ", "14 - ", "15 - ", "16 - ", "17 - ", "18 - ", "19 - ", "20 - ", 
					"21 - ", "22 - ", "23 - ", "24 - ", "25 - ", "26 - ", "27 - ", "28 - ", "29 - ", "30 - ", 
					"31 - ", "32 - ", "33 - ", "34 - ", "35 - ", "36 - ", "37 - ", "38 - ", "39 - ", "40 - ", 
					"41 - ", "42 - ", "43 - ", "44 - ", "45 - ", "46 - ", "47 - ", "48 - ", "49 - ", "50 - ", 
					"51 - ", "52 - ", "53 - ", "54 - ", "55 - ", "56 - ", "57 - ", "58 - ", "59 - ", "60 - ", 
					"61 - ", "62 - ", "63 - ", "64 - ", "65 - ", "66 - ", "67 - ", "68 - ", "69 - ", "70 - ", 
					"71 - ", "72 - ", "73 - ", "74 - ", "75 - ", "76 - ", "77 - ", "78 - ", "79 - ", "80 - ", 
					"81 - ", "82 - ", "83 - ", "84 - ", "85 - ", "86 - ", "87 - ", "88 - ", "89 - ", "90 - ");
	
	$newText = str_replace($xdata, "", $Nombre);

    return $newText;  
}
/*******************************************************************************************************************/
//Permite verificar si se trata de ingresar a un sitio a la fuerza
function checkbrute($usuario, $email, $IP_Client, $table, $dbConn) {
    // Obtiene el timestamp del tiempo actual.
    $now = time();
 
    // Todos los intentos de inicio de sesión se cuentan desde las 2 horas anteriores.
    $valid_attempts = $now - (2 * 60 * 60);
		
	//variables vacias
	$num_rows = 0;
	
	//Consulto si el usuario ha tratado de ingresar en reiteradas ocaciones
	if(isset($usuario)&&$usuario!=''&&$num_rows==0){
		$query      = "SELECT COUNT(idAcceso) AS Acceso FROM `".$table."` WHERE usuario = '".$usuario."' AND Time > '".$valid_attempts."'";
		$resultado  = mysqli_query($dbConn, $query);
		$rowSis     = mysqli_fetch_array($resultado);
		$num_rows   = $num_rows + $rowSis['Acceso'];
	}

	//Consulto si el ip ha tratado de ingresar en reiteradas ocaciones
	if(isset($IP_Client)&&$IP_Client!=''&&$num_rows==0){
		$query      = "SELECT COUNT(idAcceso) AS Acceso FROM `".$table."` WHERE IP_Client = '".$IP_Client."' AND Time > '".$valid_attempts."'";
		$resultado  = mysqli_query($dbConn, $query);
		$rowSis     = mysqli_fetch_array($resultado);
		$num_rows   = $num_rows + $rowSis['Acceso'];
	}
	
	//Consulto si el ip ha tratado de ingresar en reiteradas ocaciones
	if(isset($email)&&$email!=''&&$num_rows==0){
		$query      = "SELECT COUNT(idAcceso) AS Acceso FROM `".$table."` WHERE email = '".$email."' AND Time > '".$valid_attempts."'";
		$resultado  = mysqli_query($dbConn, $query);
		$rowSis     = mysqli_fetch_array($resultado);
		$num_rows   = $num_rows + $rowSis['Acceso'];
	}
   
    // Si ha habido más de 5 intentos de inicio de sesión fallidos.
    if ($num_rows > 5) {
        return true;
    } else {
        return false;
    }
        
}
/*******************************************************************************************************************/
//Funcion para guardar datos
function valida_latxlong($Direccion, $Config_IDGoogle,  $idSubasta, $dbConn){
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
					
		if(isset($idSubasta) && $idSubasta != ''){        $a  = "'".$idSubasta."'" ;      }else{$a  = "''";}
		if(isset($GeoLatitud) && $GeoLatitud != ''){      $a .= ",'".$GeoLatitud."'" ;    }else{$a .= ",''";}
		if(isset($GeoLongitud) && $GeoLongitud != ''){    $a .= ",'".$GeoLongitud."'" ;   }else{$a .= ",''";}
		if(isset($Direccion) && $Direccion != ''){        $a .= ",'".$Direccion."'" ;     }else{$a .= ",''";}
								
		// inserto los datos de registro en la db
		$query  = "INSERT INTO `subastas_listado_ubicaciones` (idSubasta, GeoLatitud,GeoLongitud,Direccion) 
		VALUES (".$a.")";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
			
	}
}
?>
