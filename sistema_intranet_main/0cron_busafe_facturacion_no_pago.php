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


//Se elimina la restriccion del sql 5.7
mysqli_query($dbConn, "SET SESSION sql_mode = ''");

//Consulto las facturaciones pendientes de pago
$arrFactPendientes = array();
$query = "SELECT 
COUNT(vehiculos_facturacion_apoderados_listado_detalle.idFacturacionDetalle) AS NAtrasos,
vehiculos_facturacion_apoderados_listado_detalle.idApoderado,
apoderados_listado.email,
sistema_planes_transporte.Valor_Mensual AS MontoPactado,
core_sistemas.Nombre AS EmpresaNombre, 
core_sistemas.email_principal AS EmpresaEmail, 
core_sistemas.Config_Gmail_Usuario AS Gmail_Usuario, 
core_sistemas.Config_Gmail_Password AS Gmail_Password

FROM `vehiculos_facturacion_apoderados_listado_detalle`
LEFT JOIN `apoderados_listado`         ON apoderados_listado.idApoderado    = vehiculos_facturacion_apoderados_listado_detalle.idApoderado
LEFT JOIN `sistema_planes_transporte`  ON sistema_planes_transporte.idPlan  = apoderados_listado.idPlan
LEFT JOIN `core_sistemas`              ON core_sistemas.idSistema           = apoderados_listado.idSistema
WHERE vehiculos_facturacion_apoderados_listado_detalle.idEstadoPago = 1
GROUP BY vehiculos_facturacion_apoderados_listado_detalle.idApoderado ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log('Cron', $Transaccion, 'cron', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFactPendientes,$row );
}
	
	
	

//Recorro los datos	
foreach ($arrFactPendientes as $pend) {
	
	//Cuerpo del correo
	$BodyMail  = '<p>';
	$BodyMail .= 'Estimado '.$pend['Nombre'].' '.$pend['ApellidoPat'].' '.$pend['ApellidoMat'].'<br/>';
	$BodyMail .= '<br/>';
	
	//Variables
	$Mes_1 = fecha2NombreMes(restarDias(fecha_actual(), 15));
	$Mes_2 = fecha2NombreMes(restarDias(fecha_actual(), 45));
	$Mes_3 = fecha2NombreMes(restarDias(fecha_actual(), 75));
	
	
	/*******************************************************************/
	//Defino el cuerpo por el numero de atrasos
	switch ($pend['NAtrasos']) {
		case 1:
			$BodyMail .= 'Junto con saludar, nos dirigimos a usted para entregar la siguiente información. Al día de hoy, presenta un pago pendiente de la mensualidad, correspondiente al mes de '.$Mes_1.'.<br/>';
			break;
		case 2:
			$BodyMail .= 'Junto con saludar, nos dirigimos a usted para entregar la siguiente información. Al día de hoy, presenta dos pagos pendientes de la mensualidad, correspondiente a los meses de '.$Mes_2.' y '.$Mes_1.'.<br/>';
			break;
		case 3:
			$BodyMail .= 'Junto con saludar, nos dirigimos a usted para entregar la siguiente información. Al día de hoy, presenta tres pagos pendientes de la mensualidad, correspondiente a los meses de '.$Mes_3.', '.$Mes_2.' y '.$Mes_1.'.<br/>';
			$BodyMail .= 'Se le informa que sera limitado su acceso a la app busafe y su perfil en el sitio de Apoderados. Para restaurar el servicio y acceder nuevamente a la app con sistema de notificaciones de recorrido debe pagar sólo el último mes adeudado ('.$Mes_1.') .<br/>';
			break;
		case 4:
			$BodyMail .= 'Junto con saludar, nos dirigimos a usted para entregar la siguiente información. Su perfil ha sido desactivado.<br/>';
			$BodyMail .= 'Si desea activar nuevamente su perfil, solo debe pagar el ultimo mes adeudado ('.$Mes_1.') .<br/>';
			
			/****************************************/
			//Variables
			$idApoderado  = $pend['idApoderado'];
			$idUsuario    = 3;
			$Fecha        = fecha_actual();
			$Observacion  = 'Desactivacion de perfil por atraso de pagos planes furgones';
			
			/****************************************/
			//desactivar usuario
			$query  = "UPDATE `apoderados_listado` SET idEstado='2' WHERE idApoderado='".$idApoderado."'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//variables
				$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

				//generar log
				php_error_log('Cron', $Transaccion, 'cron', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
	
			}
			
			/****************************************/	
			//Guardo observacion
			if(isset($idApoderado) && $idApoderado != ''){ $a  = "'".$idApoderado."'" ;    }else{$a  ="''";}
			if(isset($idUsuario) && $idUsuario != ''){     $a .= ",'".$idUsuario."'" ;     }else{$a .= ",''";}
			if(isset($Fecha) && $Fecha != ''){             $a .= ",'".$Fecha."'" ;         }else{$a .= ",''";}
			if(isset($Observacion) && $Observacion != ''){ $a .= ",'".$Observacion."'" ;   }else{$a .= ",''";}
				
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `apoderados_observaciones` (idApoderado, idUsuario, Fecha, Observacion) VALUES (".$a.")";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//variables
				$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

				//generar log
				php_error_log('Cron', $Transaccion, 'cron', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
	
			}
			
			break;
	}
	
	$BodyMail .= '<br/>';
	$BodyMail .= 'Si tiene más dudas, comuníquese con nosotros al correo contacto@busafe.cl<br/>';
	$BodyMail .= 'Detalle:<br/>';
	$BodyMail .= '<strong>Plan:</strong>'.$pend['NombrePlan'].'<br/>';
	$BodyMail .= '<strong>Monto:</strong>'.valores($pend['MontoPactado'], 0).'<br/>';
	$BodyMail .= '<br/>';
	$BodyMail .= 'Sin otro particular, muchas gracias.<br/>';
	$BodyMail .= 'Se despide<br/>';
	$BodyMail .= 'Equipo Busafe<br/>';
	$BodyMail .= '</p>';
	
	//envio el correo	
	if(isset($pend['EmpresaEmail'])&&$pend['EmpresaEmail']!=''&&isset($pend['email'])&&$pend['email']!=''&&isset($BodyMail)&&$BodyMail!=''){
		$rmail = tareas_envio_correo($pend['EmpresaEmail'], $pend['EmpresaNombre'], 
									$pend['email'], 'Receptor', 
									'', '', 
									'Notificacion Atraso Pagos', 
									$BodyMail,'', 
									'', 
									1, 
									$pend['Gmail_Usuario'], 
									$pend['Gmail_Password']);
		//se guarda el log
		log_response(1, $rmail, $pend['email'].'(Asunto:Notificacion Atraso Pagos)');	
	}	
}
	
	
		
	
?>
