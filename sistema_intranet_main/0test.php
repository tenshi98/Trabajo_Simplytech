<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
/**********************************************************************************************************************************/
/*                                   Se filtran las entradas para evitar ataques                                                  */
/**********************************************************************************************************************************/
require_once '../A2XRXS_gears/xrxs_seguridad/AntiXSS.php';
require_once '../A2XRXS_gears/xrxs_seguridad/Bootup.php';
require_once '../A2XRXS_gears/xrxs_seguridad/UTF8.php';
//Inicializo funcion
$security = new AntiXSS();
//Se limpian datos recibidos
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
//Configuracion de la plataforma
require_once 'A1XRXS_sys/xrxs_configuracion/config.php';
require_once 'core/rename.php';

//Carga de las funciones del nucleo
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Utils.Load.php';                  //Carga de variables
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Common.php';            //Funciones comunes
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Convertions.php';       //Conversiones de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Date.php';         //Funciones relacionadas a las fechas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Numbers.php';      //Funciones relacionadas a los numeros
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Operations.php';   //Funciones relacionadas a operaciones matematicas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Text.php';         //Funciones relacionadas a los textos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Time.php';         //Funciones relacionadas a las horas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Validations.php';  //Funciones de validacion de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.DataBase.php';          //Funciones relacionadas a la base de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Location.php';          //Funciones relacionadas a la geolozalizacion
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Server.Client.php';     //Funciones para entregar informacion del cliente
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Server.Server.php';     //Funciones para entregar informacion del servidor
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Server.Web.php';        //Funciones para entregar informacion de la web

//carga librerias propias de la plataforma
require_once '../Legacy/gestion_modular/funciones/Helpers.Functions.Propias.php';

// obtengo puntero de conexion con la db
$dbConn = conectar();
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  

//Libreria
require_once '../LIBS_php/PHP_ML/vendor/autoload.php';
//Funcion
use Phpml\Regression\LeastSquares;
			
//Configuracion del sistema a correr el cron
$SISTEMA = 1;

//si se ha ingresado el isistema	
if(isset($SISTEMA)&&$SISTEMA!=''){
	
	//Variables
	$idSistema        = $SISTEMA;

	//Datos de la tabla a utilizar
	$Select_Fecha         = 'Fecha';
	$Select_Hora          = 'Hora';
	$Select_Temperatura   = 't';
	$Select_Humedad       = 'h';
	$Select_Rocio         = 'pr';
	$Select_Presion       = 'pa';
	$TablaSelect          = 'telemetria_listado_test';
	$Select_Order         = 'id';
	
	
	/*************************************************************/
	//Obtengo los datos del sistema
	$query = "SELECT CrossTech_TempMin, CrossTech_TempMax, CrossTech_FechaTempMin, 
	CrossTech_FechaTempMax, CrossTech_FechaUnidadFrio, CrossTech_DiasTempMin, 
	CrossTech_FechaDiasTempMin, CrossTech_HoraPrevRev, CrossTech_HoraPrevision,
	CrossTech_HoraPrevCuenta, CrossTech_HeladaTemp, Nombre
	FROM `core_sistemas` 
	WHERE idSistema=".$idSistema;
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		
		//variables
		$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

		//generar log
		php_error_log('Test', $Transaccion, 'Test', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
	}
	$rowSistema = mysqli_fetch_assoc ($resultado);
	

	
	
	/*************************************************************/
	//Obtengo los datos de la tabla
	$arrEquipo = array();
	$query = "SELECT 
	".$Select_Fecha." AS LastUpdateFecha,
	".$Select_Hora." AS LastUpdateHora,
	".$Select_Temperatura." AS SensoresMedActual_1,
	".$Select_Humedad." AS SensoresMedActual_2,
	".$Select_Rocio." AS SensoresMedActual_3,
	".$Select_Presion." AS SensoresMedActual_4
	
	FROM `".$TablaSelect."` 

	ORDER BY ".$Select_Order." ASC
	";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		
		//variables
		$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

		//generar log
		php_error_log('Test', $Transaccion, 'Test', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
	
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrEquipo,$row );
	}

	
	//Horas de revision de la base de datos
	if(isset($rowSistema['CrossTech_HoraPrevRev'])&&$rowSistema['CrossTech_HoraPrevRev']!='00:00:00'){
		$h_Retroceso   = $rowSistema['CrossTech_HoraPrevRev'];
	}else{
		$h_Retroceso   = '02:00:00';
	}
	//Prevision de las temperaturas
	if(isset($rowSistema['CrossTech_HoraPrevision'])&&$rowSistema['CrossTech_HoraPrevision']!='00:00:00'){
		$h_Prediccion  = $rowSistema['CrossTech_HoraPrevision'];
	}else{
		$h_Prediccion  = '02:00:00';
	}
	//Numero de Predicciones de las temperaturas (Considerar las seleccionadas en la BD)
	if(isset($rowSistema['CrossTech_HoraPrevCuenta'])&&$rowSistema['CrossTech_HoraPrevCuenta']!='0'){
		$n_Prediccion  = $rowSistema['CrossTech_HoraPrevCuenta'];
	}else{
		$n_Prediccion  = 24;
	}
		
	/*************************************************************/
	//Se insertan datos en la tabla auxiliar
	foreach ($arrEquipo as $data) {
		
		//Variables
		$HoraSistema      = $data['LastUpdateHora']; 
		$FechaSistema     = $data['LastUpdateFecha'];
		$TimeStamp        = $data['LastUpdateFecha'].' '.$data['LastUpdateHora'];
		
		/*************************************************************/
		//Obtengo los datos del ultimo insert de la tabla auxiliar
		$query = "SELECT Hora, HorasBajoGrados, HorasSobreGrados, UnidadesFrio,
		CrossTech_TempMin,CrossTech_TempMax, CrossTech_FechaTempMin, 
		CrossTech_FechaTempMax, CrossTech_FechaUnidadFrio,
		CrossTech_DiasTempMin, CrossTech_FechaDiasTempMin,
		Dias_acumulado,Dias_anterior
		FROM `telemetria_listado_aux` 
		WHERE idSistema=".$idSistema." 
		ORDER BY idAuxiliar DESC
		LIMIT 1";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
			
			//variables
			$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

			//generar log
			php_error_log('Test', $Transaccion, 'Test', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
		}
		$rowAux = mysqli_fetch_assoc ($resultado);
		
		
		/*************************************************************/
		//variables
		$Temperatura_Actual   = str_replace(",", ".",Cantidades($data['SensoresMedActual_1'], 2));
		$Humedad_Actual       = str_replace(",", ".",Cantidades($data['SensoresMedActual_2'], 2));
		$Rocio_Actual         = str_replace(",", ".",Cantidades($data['SensoresMedActual_3'], 2));
		$Presion_Actual       = str_replace(",", ".",Cantidades($data['SensoresMedActual_4'], 2));
		
	
		/*************************************************************/
		//Se calcula lapso de tiempo condicionando dias hacia atras
		$Hora_real   = restahoras($h_Retroceso,$HoraSistema);
		$Fecha_real  = $FechaSistema;
		if($HoraSistema<$h_Retroceso){
			$Fecha_real = restarDias($FechaSistema,1);
		}
		
		//Se calcula prediccion de tiempo condicionando dias hacia adelante
		$Hora_Prediccion   = sumahoras($h_Prediccion,$HoraSistema);
		$Fecha_Prediccion  = $FechaSistema;
		if($Hora_Prediccion>'24:00:00'){
			$Hora_Prediccion   = restahoras('24:00:00',$Hora_Prediccion);
			$Fecha_Prediccion  = sumarDias($Fecha_Prediccion,1);
		}
	
		/************************************************************/
		//consulta
		$arrPrevision = array();
		$query = "SELECT Temperatura
		FROM `telemetria_listado_aux` 
		WHERE idSistema=".$idSistema." 
		AND `TimeStamp` >='".$Fecha_real." ".$Hora_real."'
		ORDER BY idAuxiliar ASC
		";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
			
			//variables
			$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

			//generar log
			php_error_log('Test', $Transaccion, 'Test', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
			
		}
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrPrevision,$row );
		}
	
		/*************************************************************/
		//Calculo de helada
		$arrContador     = array();
		$arrTemperatura  = array();
		$counter         = 0;
		
		foreach ($arrPrevision as $prev) {
			$arrContador[$counter][0]   = $counter;
			$arrTemperatura[$counter]   = cantidades_google(cantidades($prev['Temperatura'], 2));
			$counter++;
		}
		
		if($counter>1){
			$regression = new LeastSquares();
			$regression->train($arrContador, $arrTemperatura);
			//se guarda dato (60 datos por 5 horas + 36 datos por 3 horas a futuro)
			$Helada = $regression->predict([$n_Prediccion]);
		}else{
			$Helada = 0;
		}

		/*************************************************************/
		//Mientras la hora actual sea superior a la ultima hora registrada
		if(isset($rowAux['Hora'])&&$rowAux['Hora']!=''){
			if($HoraSistema>$rowAux['Hora']){
				$minutos = restahoras($rowAux['Hora'],$HoraSistema);		
			}else{
				$minutos = restahoras($HoraSistema, $rowAux['Hora']);
			}
		}else{
			$minutos = 0;
		}
		
		
		//conversion
		$minutos  = horas2minutos($minutos);
		$minutos2 = $minutos;
		
	
		
		//valido que sea un numero el resultado
		if (!validarNumero($minutos)&&$minutos!=''){ 
			$minutos = 0;
		}else{
			$minutos = $minutos/60;
		}
			
		//si la temperatura general esta bajo cierta temperatura
		if($Temperatura_Actual<$rowSistema['CrossTech_TempMin']){
			$HorasBajoGrados = $rowAux['HorasBajoGrados'] + $minutos;
		}else{
			$HorasBajoGrados = $rowAux['HorasBajoGrados'];
		}
		//si la temperatura general esta sobre cierta temperatura
		if($Temperatura_Actual>$rowSistema['CrossTech_TempMax']){
			$HorasSobreGrados = $rowAux['HorasSobreGrados'] + $minutos;
		}else{
			$HorasSobreGrados = $rowAux['HorasSobreGrados'];
		}
		
		
		/*************************************************************/
		//calculo Unidades de frio
		$UnidadesFrio = $rowAux['UnidadesFrio'];
		if($Temperatura_Actual<1.4){
			$UnidadesFrio = $rowAux['UnidadesFrio'] + ((0 / 60) * $minutos2);
		}elseif($Temperatura_Actual>=1.5&&$Temperatura_Actual<=2.4){
			$UnidadesFrio = $rowAux['UnidadesFrio'] + ((0.5 / 60) * $minutos2);
		}elseif($Temperatura_Actual>=2.5&&$Temperatura_Actual<=9.1){
			$UnidadesFrio = $rowAux['UnidadesFrio'] + ((1.0 / 60) * $minutos2);
		}elseif($Temperatura_Actual>=9.2&&$Temperatura_Actual<=12.4){
			$UnidadesFrio = $rowAux['UnidadesFrio'] + ((0.5 / 60) * $minutos2);
		}elseif($Temperatura_Actual>=12.5&&$Temperatura_Actual<=15.9){
			$UnidadesFrio = $rowAux['UnidadesFrio'] + ((0 / 60) * $minutos2);
		}elseif($Temperatura_Actual>=16&&$Temperatura_Actual<=18){
			$UnidadesFrio = $rowAux['UnidadesFrio'] - ((0.5 / 60) * $minutos2);
		}elseif($Temperatura_Actual>=19){
			$UnidadesFrio = $rowAux['UnidadesFrio'] - ((1.0 / 60) * $minutos2);
		}		
		
		/*************************************************************/
		//se guardan datos de referencia
		if(isset($rowAux['CrossTech_DiasTempMin']) && $rowAux['CrossTech_DiasTempMin'] != ''){             $CrossTech_DiasTempMin        = $rowAux['CrossTech_DiasTempMin'];         }else{$CrossTech_DiasTempMin        = $rowSistema['CrossTech_DiasTempMin'];}
		if(isset($rowAux['CrossTech_TempMin']) && $rowAux['CrossTech_TempMin'] != ''){                     $CrossTech_TempMin            = $rowAux['CrossTech_TempMin'];             }else{$CrossTech_TempMin            = $rowSistema['CrossTech_TempMin'];}
		if(isset($rowAux['CrossTech_TempMax']) && $rowAux['CrossTech_TempMax'] != ''){                     $CrossTech_TempMax            = $rowAux['CrossTech_TempMax'];             }else{$CrossTech_TempMax            = $rowSistema['CrossTech_TempMax'];}
		if(isset($rowAux['CrossTech_FechaDiasTempMin']) && $rowAux['CrossTech_FechaDiasTempMin'] != ''){   $CrossTech_FechaDiasTempMin   = $rowAux['CrossTech_FechaDiasTempMin'];    }else{$CrossTech_FechaDiasTempMin   = $rowSistema['CrossTech_FechaDiasTempMin'];}
		if(isset($rowAux['CrossTech_FechaTempMin']) && $rowAux['CrossTech_FechaTempMin'] != ''){           $CrossTech_FechaTempMin       = $rowAux['CrossTech_FechaTempMin'];        }else{$CrossTech_FechaTempMin       = $rowSistema['CrossTech_FechaTempMin'];}
		if(isset($rowAux['CrossTech_FechaTempMax']) && $rowAux['CrossTech_FechaTempMax'] != ''){           $CrossTech_FechaTempMax       = $rowAux['CrossTech_FechaTempMax'];        }else{$CrossTech_FechaTempMax       = $rowSistema['CrossTech_FechaTempMax'];}
		if(isset($rowAux['CrossTech_FechaUnidadFrio']) && $rowAux['CrossTech_FechaUnidadFrio'] != ''){     $CrossTech_FechaUnidadFrio    = $rowAux['CrossTech_FechaUnidadFrio'];     }else{$CrossTech_FechaUnidadFrio    = $rowSistema['CrossTech_FechaUnidadFrio'];}
		if(isset($rowAux['Dias_acumulado']) && $rowAux['Dias_acumulado'] != ''){                           $Dias_acumulado               = $rowAux['Dias_acumulado'];                }else{$Dias_acumulado               = 0;}
		if(isset($rowAux['Dias_anterior']) && $rowAux['Dias_anterior'] != ''){                             $Dias_anterior                = $rowAux['Dias_anterior'];                 }else{$Dias_anterior                = 0;}
		
		
		/*************************************************************/
		//Insertar datos
		if(isset($idSistema) && $idSistema != ''){                                    $a  = "'".$idSistema."'" ;                    }else{$a  ="''";}
		if(isset($FechaSistema) && $FechaSistema != ''){                              $a .= ",'".$FechaSistema."'" ;                }else{$a .= ",''";}
		if(isset($HoraSistema) && $HoraSistema != ''){                                $a .= ",'".$HoraSistema."'" ;                 }else{$a .= ",''";}
		if(isset($TimeStamp) && $TimeStamp != ''){                                    $a .= ",'".$TimeStamp."'" ;                   }else{$a .= ",''";}
		if(isset($Temperatura_Actual) && $Temperatura_Actual != ''){                  $a .= ",'".$Temperatura_Actual."'" ;          }else{$a .= ",''";}
		if(isset($Humedad_Actual) && $Humedad_Actual != ''){                          $a .= ",'".$Humedad_Actual."'" ;              }else{$a .= ",''";}
		if(isset($Rocio_Actual) && $Rocio_Actual != ''){                              $a .= ",'".$Rocio_Actual."'" ;                }else{$a .= ",''";}
		if(isset($Presion_Actual) && $Presion_Actual != ''){                          $a .= ",'".$Presion_Actual."'" ;              }else{$a .= ",''";}
		if(isset($Helada) && $Helada != ''){                                          $a .= ",'".$Helada."'" ;                      }else{$a .= ",''";}
		if(isset($Hora_Prediccion) && $Hora_Prediccion != ''){                        $a .= ",'".$Hora_Prediccion."'" ;             }else{$a .= ",''";}
		if(isset($Fecha_Prediccion) && $Fecha_Prediccion != ''){                      $a .= ",'".$Fecha_Prediccion."'" ;            }else{$a .= ",''";}
		if(isset($HorasBajoGrados) && $HorasBajoGrados != ''){                        $a .= ",'".$HorasBajoGrados."'" ;             }else{$a .= ",''";}
		if(isset($HorasSobreGrados) && $HorasSobreGrados != ''){                      $a .= ",'".$HorasSobreGrados."'" ;            }else{$a .= ",''";}
		if(isset($UnidadesFrio) && $UnidadesFrio != ''){                              $a .= ",'".$UnidadesFrio."'" ;                }else{$a .= ",''";}
		if(isset($CrossTech_DiasTempMin) && $CrossTech_DiasTempMin != ''){            $a .= ",'".$CrossTech_DiasTempMin."'" ;       }else{$a .= ",''";}
		if(isset($CrossTech_TempMin) && $CrossTech_TempMin != ''){                    $a .= ",'".$CrossTech_TempMin."'" ;           }else{$a .= ",''";}
		if(isset($CrossTech_TempMax) && $CrossTech_TempMax != ''){                    $a .= ",'".$CrossTech_TempMax."'" ;           }else{$a .= ",''";}
		if(isset($CrossTech_FechaDiasTempMin) && $CrossTech_FechaDiasTempMin != ''){  $a .= ",'".$CrossTech_FechaDiasTempMin."'" ;  }else{$a .= ",''";}
		if(isset($CrossTech_FechaTempMin) && $CrossTech_FechaTempMin != ''){          $a .= ",'".$CrossTech_FechaTempMin."'" ;      }else{$a .= ",''";}
		if(isset($CrossTech_FechaTempMax) && $CrossTech_FechaTempMax != ''){          $a .= ",'".$CrossTech_FechaTempMax."'" ;      }else{$a .= ",''";}
		if(isset($CrossTech_FechaUnidadFrio) && $CrossTech_FechaUnidadFrio != ''){    $a .= ",'".$CrossTech_FechaUnidadFrio."'" ;   }else{$a .= ",''";}
		if(isset($Dias_acumulado) && $Dias_acumulado != ''){                          $a .= ",'".$Dias_acumulado."'" ;              }else{$a .= ",''";}
		if(isset($Dias_anterior) && $Dias_anterior != ''){                            $a .= ",'".$Dias_anterior."'" ;               }else{$a .= ",''";}
				
		// inserto los datos de registro en la db
		$query  = "INSERT INTO `telemetria_listado_aux` (idSistema, Fecha, Hora, TimeStamp, Temperatura,
		Humedad, PuntoRocio, PresionAtmos, Helada, HeladaHora, HeladaDia, HorasBajoGrados, HorasSobreGrados, 
		UnidadesFrio, CrossTech_DiasTempMin, CrossTech_TempMin, CrossTech_TempMax, CrossTech_FechaDiasTempMin, 
		CrossTech_FechaTempMin, CrossTech_FechaTempMax, CrossTech_FechaUnidadFrio,
		Dias_acumulado, Dias_anterior) 
		VALUES (".$a.")";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
			
			//variables
			$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

			//generar log
			php_error_log('Test', $Transaccion, 'Test', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
		}
		echo $query.';<br/>';
		
		
					
	}
}
	
	
	
	
	
?>
