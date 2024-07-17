<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                                Validaciones                                                     */
/*******************************************************************************************************************/
//Funcion
/*function validarRut($Rut) {
    $Rut=str_replace('.', '', $Rut);
    if (preg_match('/^(\d{1,9})-((\d|k|K){1})$/',$Rut,$d)) {
        $s=1;$r=$d[1];for($m=0;$r!=0;$r/=10)$s=($s+$r%10*(9-$m++%6))%11;
        return chr($s?$s+47:75)==strtoupper($d[2]);
    }   
}
/**********************************************************************/
//Funcion
/*function ValidarPatente($patente){
	//elimino los posibles guones
	$value = str_replace("-","",$patente);
 	//caracteres admitidos
 	$regex = '/^[a-z]{2}[\.\- ]?[0-9]{2}[\.\- ]?[0-9]{2}|[b-d,f-h,j-l,p,r-t,v-z]{2}[\-\. ]?[b-d,f-h,j-l,p,r-t,v-z]{2}[\.\- ]?[0-9]{2}$/i';
	//valida formato
	if (preg_match($regex, $patente)){
		return TRUE; 
	}else{
		return FALSE;
	}
}
/**********************************************************************/
//Funcion
/*function validarURL($url){
    return (bool) filter_var($url, FILTER_VALIDATE_URL);
}
/**********************************************************************/
//Funcion
/*function validarHttps(){
	if ((isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
		return true; 
	}else{
		return false;
	}
}
/**********************************************************************/
//Funcion
/*function validarAjax(){
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }
    return false;
}
/**********************************************************************/
//Funcion
function validaHora($time) {
	$pattern1 = "/^([0-9][0-9])[\:]([0-5][0-9])[\:]([0-5][0-9])$/";
    $pattern2 = "/^([0-9][0-9])[\:]([0-5][0-9])$/";
    
    if(preg_match($pattern1,$time)){
        return true;
	}else{
		if(preg_match($pattern2,$time)){
			return true;
		}else{
			return false;
		}
	}
}
/**********************************************************************/
//Funcion
function validaFecha($date, $format = 'Y-m-d'){
	if($date=='0000-00-00'){
		return 'Sin Fecha';
	}else{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
}
/**********************************************************************/
//Funcion
function validaEntero($input){
    //se verifica si es un numero lo que se recibe
	if (is_numeric($input)){ 
		return(ctype_digit(strval($input)));
	} else { 
		return 'El dato ingresado no es un numero';
	}	
}
/**********************************************************************/
//Funcion
/*function validaDispositivoMovil(){
    $useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
		return true;
	}else{	
		return false;
	}
}
/*******************************************************************************************************************/
/*                                                  Funciones                                                      */
/*******************************************************************************************************************/
//~ //Agrega un separador de valores
function Cantidades($valor, $n_decimales){	
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($valor)&&validarnumero($n_decimales)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($n_decimales)){ 
				//valido los valores en 0
				if($valor!=0){
					return number_format($valor,$n_decimales,',','.');
				}else{
					return 0;
				}
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}

//~ //Agrega un separador de valores
function Cantidades3($valor, $n_decimales){	
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($valor)&&validarnumero($n_decimales)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($n_decimales)){ 
				//valido los valores en 0
				if($valor!=0){
					$valor = number_format($valor,$n_decimales,',','');
					$valor = str_replace(',', '.', $valor);
					return $valor;
				}else{
					return 0;
				}
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
/*******************************************************************************************************************/
//Agrega ceros a un numero designado
function n_doc($valor, $n_ceros){	
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($valor)&&validarnumero($n_ceros)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($valor)&&validaEntero($n_ceros)){ 
				return str_pad($valor, $n_ceros, "0", STR_PAD_LEFT);
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
/*******************************************************************************************************************/
//Agrega un separador de valoresjunto con dos decimales
function Valores($valor, $n_decimales){	
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($valor)&&validarnumero($n_decimales)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($n_decimales)){ 
				return '$ '.number_format($valor,$n_decimales,',','.');
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '$ 0';
	}
}
/*******************************************************************************************************************/
//Agrega un separador de valores
function valores_enteros($valor){	
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($valor)){ 
			if($valor==0){
				return 0;
			}else{
				return floatval(number_format($valor, 0, '.', ''));
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
/*******************************************************************************************************************/
//Trunca los valores
function valores_truncados($valor){	
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($valor)){ 
			if($valor==0){
				return 0;
			}else{
				return floor($valor);
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
/*******************************************************************************************************************/
//Agrega un separador de valores
function Cantidades_decimales_justos($valor){	
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($valor)){ 
			if($valor==0){
				return 0;
			}else{
				//valido si es un numero entero para eliminar el punto despues del valor
				if (ctype_digit($valor)) {
					return floatval(number_format($valor, 0, '.', ''));
				}else{
					$dec = strlen($valor) - strrpos($valor, '.') - 1;
					return floatval(number_format($valor, $dec, '.', ''));
				}	
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}	
}
/*******************************************************************************************************************/
//Reemplaza el punto por una coma
function cantidades_excel($valor){	
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($valor)){ 
			if($valor==0){
				return 0;
			}else{
				return str_replace(',', '.', $valor);	
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
	
}
/*******************************************************************************************************************/
//reduce la cantidad de caracteres
function cortar($texto, $cuantos){
	//se verifica si es un numero lo que se recibe
	if (validarnumero($cuantos)){ 
		//Verifica si el numero recibido es un entero
		if (validaEntero($cuantos)){ 
			//si el largo texto es inferior a la cantidad a cortar
			if (strlen($texto) <= $cuantos){
				return $texto;
			//si el largo texto es superior a la cantidad a cortar
			}else{
				return substr($texto, 0, $cuantos) . '...';	
			}
		} else { 
			return 'El dato ingresado no es un numero entero';
		}
	} else { 
		return 'El dato ingresado no es un numero';
	}
}
/*******************************************************************************************************************/
//reduce la cantidad de caracteres
function cortarRut($Rut){
	//verifico si existe el guion	
	$var1 = substr_count($Rut, '-');
	//se verifica el largo del texto
	$var2 = strlen($Rut);
	//se consulta
	if($var1==1){
		$x = $var2 - 2;
		return substr($Rut, 0, $x);
	}else{
		return $Rut;
	}
}
/*******************************************************************************************************************/
// Muestra la fecha completa en el navegador
function Fecha_completa($Fecha){	
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			if($Fecha=='0000-00-00'){
				return 'Sin Fecha';
			}else{
				$mes_c = new DateTime($Fecha);
				$dia = $mes_c->format('d');
				$me = $mes_c->format('m');
				$ano = $mes_c->format('Y');
				switch ($me) {
					case 1:  $mes='Enero'; break;
					case 2:  $mes='Febrero'; break;
					case 3:  $mes='Marzo'; break;
					case 4:  $mes='Abril'; break;
					case 5:  $mes='Mayo'; break;
					case 6:  $mes='Junio'; break;
					case 7:  $mes='Julio'; break;
					case 8:  $mes='Agosto'; break;
					case 9:  $mes='Septiembre'; break;
					case 10: $mes='Octubre'; break;
					case 11: $mes='Noviembre'; break;
					case 12: $mes='Diciembre'; break;
				}
				$cadena = $mes.' '.$dia.' del '.$ano;
				return $cadena;
			}
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}	
}
/*******************************************************************************************************************/
// Muestra la fecha completa en el navegador
function Fecha_completa_alt($Fecha){	
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			if($Fecha=='0000-00-00'){
				return 'Sin Fecha';
			}else{
				$mes_c = new DateTime($Fecha);
				$dia = $mes_c->format('d');
				$me = $mes_c->format('m');
				$ano = $mes_c->format('Y');
				switch ($me) {
					case 1:  $mes='Enero'; break;
					case 2:  $mes='Febrero'; break;
					case 3:  $mes='Marzo'; break;
					case 4:  $mes='Abril'; break;
					case 5:  $mes='Mayo'; break;
					case 6:  $mes='Junio'; break;
					case 7:  $mes='Julio'; break;
					case 8:  $mes='Agosto'; break;
					case 9:  $mes='Septiembre'; break;
					case 10: $mes='Octubre'; break;
					case 11: $mes='Noviembre'; break;
					case 12: $mes='Diciembre'; break;
				};
				$cadena = $dia.' de '.$mes.' de '.$ano;
				return $cadena;
			}
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}	
}
/*******************************************************************************************************************/
// Muestra la fecha completa en el navegador
function Devolver_mes($mes){	
	switch ($mes) {
		case 'Ene':  $meslargo='Enero'; break;
		case 'Feb':  $meslargo='Febrero'; break;
		case 'Mar':  $meslargo='Marzo'; break;
		case 'Abr':  $meslargo='Abril'; break;
		case 'May':  $meslargo='Mayo'; break;
		case 'Jun':  $meslargo='Junio'; break;
		case 'Jul':  $meslargo='Julio'; break;
		case 'Ago':  $meslargo='Agosto'; break;
		case 'Sep':  $meslargo='Septiembre'; break;
		case 'Oct':  $meslargo='Octubre'; break;
		case 'Nov':  $meslargo='Noviembre'; break;
		case 'Dic':  $meslargo='Diciembre'; break;
	};

	return $meslargo;
}
/*******************************************************************************************************************/
//Muestra el dia en el navegador
function Fecha_dia($Fecha){	
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			if($Fecha=='0000-00-00'){
				return 'Sin Fecha';
			}else{
				$dia1 = new DateTime($Fecha);
				$dia = $dia1->format('d');
				return $dia;
			}
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}		
}
/*******************************************************************************************************************/
// Muestra la fecha completa en el navegador
function Fecha_estandar($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			if($Fecha=='0000-00-00'){
				return 'Sin Fecha';
			}else{
				$date = date_create($Fecha);
				return date_format($date, 'd-m-Y');
			}
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}	
}
/*******************************************************************************************************************/
//Muestra el mes completo en el navegador
function Fecha_mes($Fecha){	
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			if($Fecha=='0000-00-00'){
				return 'Sin Fecha';
			}else{
				$subdato = new DateTime($Fecha);
				$me      = $subdato->format("n");
				switch ($me) {
					case 1:  $mes='Enero'; break;
					case 2:  $mes='Febrero'; break;
					case 3:  $mes='Marzo'; break;
					case 4:  $mes='Abril'; break;
					case 5:  $mes='Mayo'; break;
					case 6:  $mes='Junio'; break;
					case 7:  $mes='Julio'; break;
					case 8:  $mes='Agosto'; break;
					case 9:  $mes='Septiembre'; break;
					case 10: $mes='Octubre'; break;
					case 11: $mes='Noviembre'; break;
					case 12: $mes='Diciembre'; break;
				}
				return $mes;
			}
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}	
}
/*******************************************************************************************************************/
//Muestra solo las primeras 3 letras del mes en el navegador	
function Fecha_mes_c($Fecha){	
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			if($Fecha=='0000-00-00'){
				return 'Sin Fecha';
			}else{
				$subdato = new DateTime($Fecha);
				$me      = $subdato->format("n");
				switch ($me) {
					case 1:  $mes='Ene'; break;
					case 2:  $mes='Feb'; break;
					case 3:  $mes='Mar'; break;
					case 4:  $mes='Abr'; break;
					case 5:  $mes='May'; break;
					case 6:  $mes='Jun'; break;
					case 7:  $mes='Jul'; break;
					case 8:  $mes='Ago'; break;
					case 9:  $mes='Sep'; break;
					case 10: $mes='Oct'; break;
					case 11: $mes='Nov'; break;
					case 12: $mes='Dic'; break;
				}
				return $mes;
			}
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}	
}
/*******************************************************************************************************************/
// Muestra el mes segido del año designado
function Fecha_mes_año($Fecha){	
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			if($Fecha=='0000-00-00'){
				return 'Sin Fecha';
			}else{
				$mes_c = new DateTime($Fecha);
				$me    = $mes_c->format('m');
				$agno  = $mes_c->format('Y');
				switch ($me) {
					case 1:  $mes='Enero'; break;
					case 2:  $mes='Febrero'; break;
					case 3:  $mes='Marzo'; break;
					case 4:  $mes='Abril'; break;
					case 5:  $mes='Mayo'; break;
					case 6:  $mes='Junio'; break;
					case 7:  $mes='Julio'; break;
					case 8:  $mes='Agosto'; break;
					case 9:  $mes='Septiembre'; break;
					case 10: $mes='Octubre'; break;
					case 11: $mes='Noviembre'; break;
					case 12: $mes='Diciembre'; break;
				}
				$cadena = $mes.' del '.$agno;
				return $cadena;
			}
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}	
}
/*******************************************************************************************************************/
//Muestra el valor numerico correspondiente al mes seleccionado
function Fecha_mes_n($Fecha){	
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			if($Fecha=='0000-00-00'){
				return 'Sin Fecha';
			}else{
				$subdato   = new DateTime($Fecha);
				$datofinal = $subdato->format("m");
				$mes       = '';
				switch ($datofinal) {
					case 1:  $mes='01'; break;
					case 2:  $mes='02'; break;
					case 3:  $mes='03'; break;
					case 4:  $mes='04'; break;
					case 5:  $mes='05'; break;
					case 6:  $mes='06'; break;
					case 7:  $mes='07'; break;
					case 8:  $mes='08'; break;
					case 9:  $mes='09'; break;
					case 10: $mes='10'; break;
					case 11: $mes='11'; break;
					case 12: $mes='12'; break;
				}
				return $mes;
			}
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}
}
/*******************************************************************************************************************/
//Muestra el valor numerico correspondiente al mes seleccionado
function numero_mes1($valor){	
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($valor)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($valor)){ 
				//valido los valores en 0
				if($valor!=0){
					switch ($valor) {
						case 1:  $mes='01'; break;
						case 2:  $mes='02'; break;
						case 3:  $mes='03'; break;
						case 4:  $mes='04'; break;
						case 5:  $mes='05'; break;
						case 6:  $mes='06'; break;
						case 7:  $mes='07'; break;
						case 8:  $mes='08'; break;
						case 9:  $mes='09'; break;
						case 10: $mes='10'; break;
						case 11: $mes='11'; break;
						case 12: $mes='12'; break;
					}
					return $mes;
				}else{
					return 'El dato ingresado es 0';
				}
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
/*******************************************************************************************************************/
//Muestra el valor numerico correspondiente al mes seleccionado
function numero_mes2($valor){	
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($valor)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($valor)){ 
				//valido los valores en 0
				if($valor!=0){
					switch ($valor) {
						case 1:  $mes='Enero'; break;
						case 2:  $mes='Febrero'; break;
						case 3:  $mes='Marzo'; break;
						case 4:  $mes='Abril'; break;
						case 5:  $mes='Mayo'; break;
						case 6:  $mes='Junio'; break;
						case 7:  $mes='Julio'; break;
						case 8:  $mes='Agosto'; break;
						case 9:  $mes='Septiembre'; break;
						case 10: $mes='Octubre'; break;
						case 11: $mes='Noviembre'; break;
						case 12: $mes='Diciembre'; break;
					}
					return $mes;
				}else{
					return 'El dato ingresado es 0';
				}
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
/*******************************************************************************************************************/
//Muestra el valor numerico correspondiente al mes seleccionado
function Fecha_mes_n2($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			if($Fecha=='0000-00-00'){
				return 'Sin Fecha';
			}else{
				$subdato   = new DateTime($Fecha);
				$datofinal = $subdato->format("m");
				return $datofinal;
			}
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}	
}
/*******************************************************************************************************************/
// Muestra solo el año en el navegador
function Fecha_año($Fecha){	
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			if($Fecha=='0000-00-00'){
				return 'Sin Fecha';
			}else{
				$subdato   = new DateTime($Fecha);
				$datofinal = $subdato->format("Y");
				return $datofinal;
			}
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}
}

/*******************************************************************************************************************/
// Muestra la fecha completa en el navegador
function Hora_estandar($Hora){
	//valido la hora
	if(validaHora($Hora)){
		if($Hora!='00:00:00'){
			$date = date_create($Hora);
			return date_format($date, 'H:i');
		}else{
			return 'Sin Hora';
		}
	}else{
		return 'El dato ingresado no es una hora';
	}	
}
/*******************************************************************************************************************/
//Transforma un valor a mes
function numero_a_mes($numero){	
	switch ($numero) {
		case 1:  $mes='Enero'; break;
		case 2:  $mes='Febrero'; break;
		case 3:  $mes='Marzo'; break;
		case 4:  $mes='Abril'; break;
		case 5:  $mes='Mayo'; break;
		case 6:  $mes='Junio'; break;
		case 7:  $mes='Julio'; break;
		case 8:  $mes='Agosto'; break;
		case 9:  $mes='Septiembre'; break;
		case 10: $mes='Octubre'; break;
		case 11: $mes='Noviembre'; break;
		case 12: $mes='Diciembre'; break;
	}
	return $mes;
}
/*******************************************************************************************************************/
//Transforma un valor a mes
function numero_a_mes_c($numero){	
	switch ($numero) {
		case 1:  $mes='Ene'; break;
		case 2:  $mes='Feb'; break;
		case 3:  $mes='Mar'; break;
		case 4:  $mes='Abr'; break;
		case 5:  $mes='May'; break;
		case 6:  $mes='Jun'; break;
		case 7:  $mes='Jul'; break;
		case 8:  $mes='Ago'; break;
		case 9:  $mes='Sep'; break;
		case 10: $mes='Oct'; break;
		case 11: $mes='Nov'; break;
		case 12: $mes='Dic'; break;
	}
	return $mes;
}
/*******************************************************************************************************************/
//Devuelve la hora programada
function Hora_prog($Hora){	
	//valido la hora
	//if(validaHora($Hora)){
		if($Hora!='00:00:00'){
			return date("H:i:s", strtotime($Hora));
		}else{
			return 'Sin Hora';
		}
	/*}else{
		return 'El dato ingresado no es una hora';
	}*/	
}
/*******************************************************************************************************************/
//Se encarga de generar un array multinivel
function filtrar(&$array, $clave_orden ) {
	// inicializamos un nuevo array
	$array_filtrado = array(); 
	// creamos un bucle foreach para recorrer el array original y “acomodar” los datos
	foreach($array as $index=>$array_value) {
		// guardamos temporalmente el nombre de la categoría
		$value = $array_value[$clave_orden];
		// eliminamos la categoria del registro, ya no la necesitaremos
		unset($array_value[$clave_orden]);
		// creamos una clave en nuestro nuevo array, con el nombre de la categoria
		$array_filtrado[$value][] = $array_value;
	}
	// modificamos automáticamente nuestro array global $row
	$array = $array_filtrado; 
}
/*******************************************************************************************************************/
//Funcion para devolver horas
function minutos2horas($mins) {
	//se verifica si es un numero lo que se recibe
	if (validarnumero($mins)){ 
		//if(validaEntero($mins)){
			$extraIntH = intval($mins/60);
			$extraIntHs = ($mins/60);            
			$whole = floor($extraIntHs);      
			$fraction = $extraIntHs - $whole; 
			$extraIntHss =  round($fraction*60); 
			//Se agrega el 0
			if (strlen($extraIntHss) < 2){
				$extraIntHss = '0'.$extraIntHss;
			}
			//Se agrega el 0
			if (strlen($extraIntH) < 2){
				$extraIntH = '0'.$extraIntH;
			}

			return $extraIntH.':'.$extraIntHss.':00';
		//}else { 
		//	return 'El dato ingresado no es un numero entero';
		//}
	} else { 
		return 'El dato ingresado no es un numero';
	}
}
/*******************************************************************************************************************/
//Funcion para dividir horas
function divHoras($hora,$divisor) {
	//valido la hora
	if(validaHora($hora)){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($divisor)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($divisor)){ 
				$minutos = horas2minutos($hora);
				$difm    = $minutos/$divisor;
				return $difm;
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return 'El dato ingresado no es una hora';
	}  
}
/*******************************************************************************************************************/
//Transforma valores a porcentaje
function porcentaje($valor){
	//se verifica si es un numero lo que se recibe
	if (validarnumero($valor)){ 
		$porcentaje = $valor *100;
		return number_format($porcentaje,0,',','.').' %';
	} else { 
		return 'El dato ingresado no es un numero';
	}
}
/*******************************************************************************************************************/
/**
 * Validador de RUT con digito verificador 
 *
 * @param string $rut
 * @return boolean
 */
function RutValidate($Rut) {
    $Rut=str_replace('.', '', $Rut);
    if (preg_match('/^(\d{1,9})-((\d|k|K){1})$/',$Rut,$d)) {
        $s=1;$r=$d[1];for($m=0;$r!=0;$r/=10)$s=($s+$r%10*(9-$m++%6))%11;
        return chr($s?$s+47:75)==strtoupper($d[2]);
    }   
}
/*******************************************************************************************************************/
//esta funcion valida el email
function validaremail($Direccion, $tempEmailAllowed = false){ 
	if (!preg_match('{^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$}',$Direccion)){
        return FALSE; 
    }else { 
		return TRUE; 
	}
}
/*******************************************************************************************************************/
//esta funcion valida el numero
function validarnumero($numero){ 
	//Verfica si es un numero
	if(is_numeric($numero)) {
		return TRUE; 
	} else {
		return FALSE;
	}
}

/*******************************************************************************************************************/
//Verifica el largo del texto
function palabra_largo($oracion,$largo){
	//se verifica si es un numero lo que se recibe
	if (validarnumero($largo)){ 
		//Verifica si el numero recibido es un entero
		if (validaEntero($largo)){ 
			//se verifica el largo
			if (strlen($oracion) < $largo) { 
				return 'El dato ingresado debe tener al menos '.$largo.' caracteres';
			}
		} else { 
			return 'El dato ingresado no es un numero entero';
		}
	} else { 
			return 'El dato ingresado no es un numero';
	}
	
}
/*******************************************************************************************************************/
//Verifica lo corto del texto
function palabra_corto($oracion,$largo){
	//se verifica si es un numero lo que se recibe
	if (validarnumero($largo)){ 
		//Verifica si el numero recibido es un entero
		if (validaEntero($largo)){ 
			//se verifica el corto
			if (strlen($oracion) > $largo) { 
				return 'El dato ingresado debe tener no mas de '.$largo.' caracteres';
			}
		} else { 
			return 'El dato ingresado no es un numero entero';
		}
	} else { 
			return 'El dato ingresado no es un numero';
	}
}
/*******************************************************************************************************************/
//Fecha actual
function fecha_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$fecha_actual = date("Y-m-d");
	return $fecha_actual; 
}
/*******************************************************************************************************************/
//Hora actual
function hora_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$hora_actual = date("H:i:s");
	return $hora_actual; 
}
/*******************************************************************************************************************/
//Hora actual
function hora_actual_val(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$hora_actual = date("H-i-s");
	return $hora_actual; 
}
/*******************************************************************************************************************/
//dia actual
function dia_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$dia_actual = date("j");
	return $dia_actual; 
}
/*******************************************************************************************************************/
//semana actual
function semana_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$semana_actual = date("W");
	return $semana_actual; 
}
/*******************************************************************************************************************/
//mes actual
function mes_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$mes_actual = date("n");
	return $mes_actual; 
}
/*******************************************************************************************************************/
//año actual
function ano_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$ano_actual = date("Y");
	return $ano_actual; 
}
/*******************************************************************************************************************/
//dia transformado
function dia_transformado($dato){
	//transformo el dato entregado al formato que necesito
	$subdato = new DateTime($dato);
	$datofinal = $subdato->format("j");
	return $datofinal; 
}
/*******************************************************************************************************************/
//dia transformado
function dia_transformado2($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			$dias = new DateTime($Fecha);
			$me = $dias->format('N');
			switch ($me) {
				case 1: $dia = 'Lunes'; break;
				case 2: $dia = 'Martes'; break;
				case 3: $dia = 'Miercoles'; break;
				case 4: $dia = 'Jueves'; break;
				case 5: $dia = 'Viernes'; break;
				case 6: $dia = 'Sabado'; break;
				case 7: $dia = 'Domingo'; break;
			}
			return $dia;
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}	
}
/*******************************************************************************************************************/
//semana transformado
function semana_transformado($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			$subdato = new DateTime($Fecha);
			$datofinal = $subdato->format("W");
			return $datofinal;
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}
}
/*******************************************************************************************************************/
//mes transformado
function mes_transformado($dato){
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			$subdato = new DateTime($Fecha);
			$datofinal = $subdato->format("n");
			return $datofinal;
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}
}
/*******************************************************************************************************************/
//año transformado
function ano_transformado($dato){
	//Se verifica que se recibe algo
	if($Fecha!=''){
		//valido la fecha
		if(validaFecha($Fecha)){
			$subdato = new DateTime($Fecha);
			$datofinal = $subdato->format("Y");
			return $datofinal;
		}else{
			return 'El dato ingresado no es una fecha';
		}
	}else{
		return 'Sin Fecha';
	}
}
/*******************************************************************************************************************/
//Limpiar textos
function limpiarString($texto){
    //Limpieza caracteres normales
    $texto = preg_replace('([^A-Za-z0-9.])', ' ', $texto);
    //Se eliminan saltos de linea y pagina
    $texto = str_replace(array("\n", "\r"), '', $texto);
    $texto = strip_tags($texto, '');	     					
    return $texto;
}
/*******************************************************************************************************************/
//Generar un password aleatorio
function genera_password($longitud,$tipo){
	
	//verifico si los datos estan bien entregados
	if (validarnumero($longitud)&&($tipo=="alfanumerico" || $tipo=="numerico")){
		
		//selecciono el tipo de password
		if ($tipo=="alfanumerico"){
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		} elseif ($tipo=="numerico"){
			$alphabet = '1234567890';
		}
		
		//creo la password
		$password = substr(str_shuffle($alphabet), 0, $longitud);

		return $password;
	}else{
		return 'Datos requeridos mal ingresados';
	}
}
/*******************************************************************************************************************/
//Generar un password aleatorio
function ValidaPatente($patente){
	//elimino los posibles guones
	$value = str_replace("-","",$patente);
 	//caracteres admitidos
 	$regex = '/^[a-z]{2}[\.\- ]?[0-9]{2}[\.\- ]?[0-9]{2}|[b-d,f-h,j-l,p,r-t,v-z]{2}[\-\. ]?[b-d,f-h,j-l,p,r-t,v-z]{2}[\.\- ]?[0-9]{2}$/i';
	//valida formato
	if (preg_match($regex, $patente)){
		return TRUE; 
	}else{
		return FALSE;
	}
}
/*******************************************************************************************************************/
//construye el listado de errores
function errors_list($errores){
	$despliegue = '<script type="text/javascript">
					$(document).ready(function() {
						setTimeout(function() {
							$(".div_alert").fadeOut(1500);
						},3000);
					});
					</script>';
	if (!empty($errores)) {  
		foreach ($errores as $mensaje) { 
			list($tipo, $error) = explode("/", $mensaje);
			$despliegue .= '<div class="alert_'.$tipo.' div_alert" >'.$error.'</div>';
		} 
	}	
	return $despliegue;
}
/*******************************************************************************************************************/
//construye el listado de errores
function notifications_list($errores){
	
	$despliegue = '<div id="notifications_list">Notificaciones <a id="close_btn_noti">cerrar</a>';
	
	if (!empty($errores)) {  
		foreach ($errores as $mensaje) { 
			list($tipo, $error) = explode("/", $mensaje);
			$despliegue .= '<p><img src="img/icon_'.$tipo.'.png" height="24" width="24">  '.$error.'</p>';
		} 
	}

	$despliegue .= '</div>';
	
	$despliegue .= "<script type='text/javascript'>
					document.getElementById('close_btn_noti').addEventListener('click', function() {
					document.getElementById('notifications_list').style.display = 'none';
					}, false);
					</script>";
		
	return $despliegue;
}
/*******************************************************************************************************************/
//paginador
function paginador_1($total_paginas, $original, $search, $num_pag){
	$paginador='';
	

	//Verifico si hay mas de una pagina, sino coulto el paginador
	if($total_paginas>1){
	//Cargamos la ubicacion original
	$location = $original;
	$location .='?pagina=';

	$paginador .='<div class="row">
			<div class="contaux">
				<div class="dataTables_paginate paging_bootstrap">
					<ul class="pagination menucent">';
						if(($num_pag - 1) > 0) { 
							$paginador .='<li class="prev"><a href="'.$location.($num_pag-1).$search.'">← Anterior</a></li>';
						} else {
							$paginador .='<li class="prev disabled"><a href="">← Anterior</a></li>';
						} 
						
						if ($total_paginas>10){
							if(0>$num_pag-5){
								for ($i = 1; $i <= 10; $i++) { 
									if ($i==$num_pag){ $xx='class="active"';}else{ $xx='';}
									$paginador .='<li '.$xx.'><a href="'.$location.$i.$search.'">'.$i.'</a></li>';
								 }
							}elseif($total_paginas<$num_pag+5){
								for ($i = $num_pag-5; $i <= $total_paginas; $i++) {
									if ($i==$num_pag){ $xx='class="active"';}else{ $xx='';}
									$paginador .='<li '.$xx.'><a href="'.$location.$i.$search.'">'.$i.'</a></li>';
								 }	
							}else{
								for ($i = $num_pag-4; $i <= $num_pag+5; $i++) { 
									if ($i==$num_pag){ $xx='class="active"';}else{ $xx='';}
									$paginador .='<li '.$xx.'><a href="'.$location.$i.$search.'">'.$i.'</a></li>';
								}	
							}		
						}else{
							for ($i = 1; $i <= $total_paginas; $i++) { 
								if ($i==$num_pag){ $xx='class="active"';}else{ $xx='';}
								$paginador .='<li '.$xx.'><a href="'.$location.$i.$search.'">'.$i.'</a></li>';
							}
						}
						if(($num_pag + 1)<=$total_paginas) { 
							$paginador .='<li class="next"><a href="'.$location.($num_pag+1).$search.'">Siguiente → </a></li>';
						} else {
							$paginador .='<li class="next disabled"><a href="">Siguiente → </a></li>';
						} 
					$paginador .='</ul>
				</div> 
			</div>
		</div>';
	}	
	return $paginador; 
}
/*******************************************************************************************************************/
//paginador
function paginador_2($nombre, $total_paginas, $original, $search, $num_pag){
	$paginador='';
	

	//Verifico si hay mas de una pagina, sino coulto el paginador
	if($total_paginas>1){
	//Cargamos la ubicacion original
	$location = $original;
	$location .='?pagina=';

	$paginador .='
				<div id="dataTable_paginate" class="dataTables_paginate paging_simple_numbers fright">
					<ul class="pagination tablepag custom-pagination">';
						if(($num_pag - 1) > 0) { 
							$paginador .='<li class="prev"><a href="'.$location.($num_pag-1).$search.'"><i class="fa fa-angle-double-left"></i></a></li>';
						} else {
							$paginador .='<li class="prev disabled"><a href=""><i class="fa fa-angle-double-left"></i></a></li>';
						} 
						
						
						$paginador .='<li>
						<select class="form-control" id="'.$nombre.'" onchange="myFunction'.$nombre.'()">';
						for ($i = 1; $i <= $total_paginas; $i++) { 
							if ($i==$num_pag){ $xx='selected="selected"';}else{ $xx='';}
							$paginador .='<option value="'.$i.'" '.$xx.' >'.$i.'</option>';
						}
						$paginador .='</select>
						</li>
						<script>
							function myFunction'.$nombre.'() {
								var npage = document.getElementById("'.$nombre.'").value;
								window.location.href = "'.$location.'"+npage+"'.$search.'";
							}
						</script>';
						
						if(($num_pag + 1)<=$total_paginas) { 
							$paginador .='<li class="next"><a href="'.$location.($num_pag+1).$search.'"><i class="fa fa-angle-double-right"></i></a></li>';
						} else {
							$paginador .='<li class="next disabled"><a href=""><i class="fa fa-angle-double-right"></i></a></li>';
						} 
					$paginador .='</ul>
				</div>
				<div class="clearfix"></div>';
	}	
	return $paginador; 
}
/*******************************************************************************************************************/
/* reemplaza los espacios po guines*/
function espacio_guion($dato) {
    $dato = str_replace(' ', '_', $dato);
    return $dato;
}
/*******************************************************************************************************************/
//Despliega un mapa en base a los datos entregados
function mapa1($Latitud, $Longitud, $Titulo){	
$mapa = '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyByK7Sc1NVgqz10pVRx3EfViR_gdO2N8FI&sensor=false"></script>
		<script type="text/javascript">
			  function initialize() {
				  var myLatlng = new google.maps.LatLng('.$Latitud.', '.$Longitud.');
				  var mapOptions = {
					zoom: 15,
					scrollwheel: false,
					center: myLatlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				  }
				  var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
				
				  var marker_1 = new google.maps.Marker({
					  position:  new google.maps.LatLng('.$Latitud.', '.$Longitud.'),
					  map: map,
					  title:"'.$Titulo.'"

				  });
		  		
			  }  
		</script>';
$mapa .= '<div id="map_canvas" style="width:100%; height:500px">
               <script type="text/javascript">initialize();</script>
          </div>';	

	return $mapa;
}

/*******************************************************************************************************************/
//Despliega un mapa en base a los datos entregados
function mapa2($Ubicacion){	
	
	$Ubicacion = str_replace('Nº', '', $Ubicacion);
	$Ubicacion = str_replace('nº', '', $Ubicacion);
	$Ubicacion = str_replace(' n ', '', $Ubicacion);
	
	$Ubicacion = str_replace("'", '', $Ubicacion);
	
	$Ubicacion = str_replace("Av.", 'Avenida', $Ubicacion);
	$Ubicacion = str_replace("av.", 'Avenida', $Ubicacion);
	
	
$mapa = '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAjU0EJWnWPMv7oQ-jjS7dYxSPW5CJgpdgO_s4yyMovOaVh_KvvhSfpvagV18eOyDWu7VytS6Bi1CWxw"
      type="text/javascript"></script>
    <script type="text/javascript">

    var map = null;
    var geocoder = null;

    function initialize() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map_canvas"));
        map.setCenter(new GLatLng(37.4419, -122.1419), 1);
        map.setUIToDefault();
        geocoder = new GClientGeocoder();
      }
    }

    function showAddress(address) {
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
              map.setCenter(point, 15);
              var marker = new GMarker(point, {draggable: true});
              map.addOverlay(marker);
             
            }
          }
        );
      }
    }
    </script>
<div id="map_canvas" style="width:100%; height:500px">
        <script type="text/javascript">initialize();showAddress("'.$Ubicacion.'");</script>
</div>';

	return $mapa;
}
/*******************************************************************************************************************/
//funcion para sumar horas
function sumahoras($hora,$horasuma){
	//valido la hora
	//if(validaHora($hora)&&validaHora($horasuma)){
		$hora=explode(":",$hora);
		$horasuma=explode(":",$horasuma);
		$horas=(int)$hora[0]+(int)$horasuma[0];
		$minutos=(int)$hora[1]+(int)$horasuma[1];
		$segundos=(int)$hora[2]+(int)$horasuma[2];
		$horas+=(int)($minutos/60);
		$minutos=(int)($minutos%60)+(int)($segundos/60);
		$segundos=(int)($segundos%60);
		return (intval($horas)<10?'0'.intval($horas):intval($horas)).':'.($minutos<10?'0'.$minutos:$minutos).':'.($segundos<10?'0'.$segundos:$segundos); 
	//}else{
	//	return 'El dato ingresado no es una hora';
	//} 
}
/*******************************************************************************************************************/
//funcion para sumar horas
function restahoras($hora, $horaresta){
		
	//valido la hora
	if(validaHora($hora)&&validaHora($horaresta)){
		
		//Se verifica cual es el mayor
		if(strtotime($hora)>strtotime($horaresta)){
			$horaresta  = sumahoras($horaresta, '24:00:00');
		}
		
		$horai = substr($hora,0,2);
		$mini  = substr($hora,3,2);
		$segi  = substr($hora,6,2);

		$horaf = substr($horaresta,0,2);
		$minf  = substr($horaresta,3,2);
		$segf  = substr($horaresta,6,2);
		
		$ini   = ((($horai*60)*60)+($mini*60)+$segi);
		$fin   = ((($horaf*60)*60)+($minf*60)+$segf);
		
		$dif   = $fin-$ini;
		
		return segundos2horas($dif);
	}else{
		return 'El dato ingresado no es una hora';
	} 
}
/*******************************************************************************************************************/
//funcion para sumar horas
function sumarDias($Fecha,$nDias){
	//valido las fechas
	if(validaFecha($Fecha)){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($nDias)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($nDias)){ 
				$nuevafecha = strtotime ( '+'.$nDias.' day' , strtotime ( $Fecha ) ) ;
				$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
				return $nuevafecha;
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		} 
	}else{
		return 'El dato ingresado no es una fecha';
	}
} 
/*******************************************************************************************************************/
//funcion para sumar horas
function restarDias($Fecha,$nDias){
	//valido las fechas
	if(validaFecha($Fecha)){
		//se verifica si es un numero lo que se recibe
		if (validarnumero($nDias)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($nDias)){ 
				$nuevafecha = strtotime ( '-'.$nDias.' day' , strtotime ( $Fecha ) ) ;
				$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
				return $nuevafecha; 
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		} 
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
/*******************************************************************************************************************/
//funcion comparar valores
function compara1($valor,$val1,$val2,$val3){
	
	if($valor!=0){
		if($valor>=0 && $valor<=$val1){
			$class = 'success';
		}else if($valor>$val1 && $valor<$val2){
			$class = 'warning';
		}else if($valor>$val2 && $valor<$val3){
			$class = 'danger';
		}else{
			$class = '';
		}
	}else{
		$class = '';
	}

	return $class; 
} 
/*******************************************************************************************************************/
//funcion comparar valores
function compara2($valor,$val1,$val2,$val3){
	
	if($valor!=0){
		if($valor>=$val1 && $valor<=99999 && $val1!=0){
			$class = 'danger';
		}else if($valor>$val1 && $valor<$val2){
			$class = 'warning';
		}else if($valor>$val2 && $valor<$val3){
			$class = 'success';
		}else{
			$class = '';
		}
	}else{
		$class = '';
	}

	return $class; 
}
/*******************************************************************************************************************/
//funcion que indica la diferencia de dias entre fechas
function dias_transcurridos($fecha_i,$fecha_f){
	//valido las fechas
	if(validaFecha($fecha_i)){
		if(validaFecha($fecha_f)){
			$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
			$dias 	= abs($dias); 
			$dias   = floor($dias);		
			
			return $dias;
		}else{
			return 'Fecha de termino no es una fecha';
		}
	}else{
		return 'Fecha de inicio no es una fecha';
	}
}
/*******************************************************************************************************************/
//funcion que cambia de numeros a letras
function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }
 
    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }
 
            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                             
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                             
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                             
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO
 
        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";
 
        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";
 
        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO PESOS ";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN PESO  ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " PESOS  "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}
 
// END FUNCTION
 
function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}


















?>
