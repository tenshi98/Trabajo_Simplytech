<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
/*if( ! defined(DB_NAME)){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1014-004).');
}
/*******************************************************************************************************************/
/*                                                Se ejecuta codigo                                                */
/*******************************************************************************************************************/

/******************************************************************************************************/
/*                                                                                                    */
/*                                  GUARDADO DE LOS DATOS EN UN ARCHIVO TXT                           */
/*                                                                                                    */
/******************************************************************************************************/
//Archivos utilizados
$TextFile_1 = "logs_ardu_counter.txt";
$TextFile_2 = "logs_ardu_log.txt";
$TextFile_3 = "logs_ardu_log.txt";
/**********************************************/

switch ($Control_Type) {
    /***********************************************/
    //Escribir en el archivo contador
    case 1:
		$Count = trim (file_get_contents($TextFile_1));
		settype($Count, "integer");
		$Count++;
		//se guarda en el archivo
		if ($FP = fopen ($TextFile_1, "w")){
		  fwrite ($FP, $Count);
		  fclose ($FP);
		}
        break;
    /***********************************************/
    //Log de los datos
    case 2:
		//se guardan todos los datos que si se reciben
		$dir  = "\n";
		$dir .= "################################################################################\n";
		//$dir .= "Fecha del Log : ".fecha_actual()."\n";
		//$dir .= "Hora del Log : ".hora_actual()."\n";
		$dir .= "Datos :\n";
		$dir .= "	- Identificador = ".$Identificador."\n";
		$dir .= "	- Fecha = ".$Fecha."\n";
		$dir .= "	- Hora = ".$Hora."\n";
		$dir .= "	- GeoLatitud = ".$GeoLatitud."\n";
		$dir .= "	- GeoLongitud = ".$GeoLongitud."\n";
		$dir .= "	- GeoVelocidad = ".$GeoVelocidad."\n";
		$dir .= "	- GeoDireccion = ".$GeoDireccion."\n";
		$dir .= "	- lock = ".$lock."\n";
		//se verifica si hay sensores recibidos
		if(isset($Var_Counter)&&$Var_Counter!=''&&$Var_Counter!=0){
			for ($i = 1; $i <= $Var_Counter; $i++) {
				if(isset($Sensor[$i]['valor']) && $Sensor[$i]['valor']!=''){
					$dir .= "	- Sensor N°".$i." = ".$Sensor[$i]['valor']."\n";
				}else{
					$dir .= "	- Sensor N°".$i." = Sin Datos\n";
				}
			}
		}
		//se guarda en el archivo
		if ($FP = fopen ($TextFile_2, "a")){
		  fwrite ($FP, $dir);
		  fclose ($FP);
		}
        break;
	/***********************************************/
    //log con la captura de la dirección completa, con o sin variables predefinidas
    case 3:
        //captura
        $actual_link = " - http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]\n";
        //se guarda en el archivo
		if ($FP = fopen ($TextFile_3, "a")){
		  fwrite ($FP, $actual_link);
		  fclose ($FP);
		}
        break;
}



?>
