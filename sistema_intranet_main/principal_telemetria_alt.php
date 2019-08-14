<?php session_start();
/**********************************************************************************************************************************/
/*                                                     Ejecucion codigo                                                           */
/**********************************************************************************************************************************/



echo '<span class="panel-title"  style="color: #1E90FF;font-weight: 700 !important;">Hora Refresco: '.hora_actual().'</span>';
		

switch ($_GET['idOpcionesTel']) {
	/*****************************************************/
	//Si no esta configurado
	case 0:
		echo widget_GPS_equipos('Equipos Telemetria','Equipos', 2, 2, $_GET['idSistema'], 
					$_GET['Config_IDGoogle'],
					$_GET['idTipoUsuario'],
					$_GET['idUsuario'],$dbConn);	
		echo widget_GPS_equipos_lista('Ultimas Mediciones', 2, 0, $_GET['trans_8'], 
				$_GET['idSistema'],
				$_GET['idTipoUsuario'],
				$_GET['idUsuario'], $dbConn);
	break;
	/*****************************************************/
	//Detalle por GPS
	case 1:
		echo widget_GPS_equipos('Equipos GPS','Vehiculos', 1, 2, $_GET['idSistema'], 
					$_GET['Config_IDGoogle'],
					$_GET['idTipoUsuario'],
					$_GET['idUsuario'],$dbConn);
		echo widget_Resumen_GPS_equipos('Vehiculos', 1, $_GET['idSistema'],
				$_GET['idTipoUsuario'],
				$_GET['idUsuario'],$dbConn);
	break;
	/*****************************************************/
	//Lista Equipos
	case 2:
		echo widget_GPS_equipos('Equipos Fijos','Fijos', 2, 2, $_GET['idSistema'], 
					$_GET['Config_IDGoogle'],
					$_GET['idTipoUsuario'],
					$_GET['idUsuario'],$dbConn);	
		echo widget_GPS_equipos_lista('Ultimas Mediciones', 2, 0, $_GET['trans_8'], 
				$_GET['idSistema'],
				$_GET['idTipoUsuario'],
				$_GET['idUsuario'], $dbConn);
	break;
	/*****************************************************/
	//Detalle por Equipos
	case 3:
		echo widget_Equipos('Equipos Telemetria', 2, 0,$_GET['trans_9'], $_GET['idSistema'],
				$_GET['idTipoUsuario'],
				$_GET['idUsuario'], $dbConn);
		echo widget_Resumen_equipo('Ultimas Mediciones', 2, 0, 0, 
			$_GET['idSistema'],
			$_GET['idTipoUsuario'],
			$_GET['idUsuario'], $dbConn);
	break;	
	/*****************************************************/
	//Lista GPS
	case 4:
		echo widget_GPS_equipos('Equipos GPS','Vehiculos', 1, 2, $_GET['idSistema'], 
					$_GET['Config_IDGoogle'],
					$_GET['idTipoUsuario'],
					$_GET['idUsuario'],$dbConn);
		echo widget_GPS_lista('Ultimas Mediciones', 1, 0, $_GET['trans_8'], 
				  $_GET['idSistema'],
				  $_GET['idTipoUsuario'],
				  $_GET['idUsuario'], $dbConn);
	break;
	/*****************************************************/
	//Detalle por GPS y Detalle por Equipos
	case 5:
		//Detalle por GPS
		echo widget_GPS_equipos('Equipos GPS','Vehiculos', 1, 2, $_GET['idSistema'], 
					$_GET['Config_IDGoogle'],
					$_GET['idTipoUsuario'],
					$_GET['idUsuario'],$dbConn);
		echo widget_Resumen_GPS_equipos('Vehiculos', 1, $_GET['idSistema'],
				$_GET['idTipoUsuario'],
				$_GET['idUsuario'],$dbConn);
		//Detalle por Equipos
		echo widget_Equipos('Equipos Telemetria', 2, 0,$_GET['trans_9'], $_GET['idSistema'],
				$_GET['idTipoUsuario'],
				$_GET['idUsuario'], $dbConn);
		echo widget_Resumen_equipo('Ultimas Mediciones', 2, 0, 0, 
			$_GET['idSistema'],
			$_GET['idTipoUsuario'],
			$_GET['idUsuario'], $dbConn);
	break;
	/*****************************************************/
	//Detalle por GPS y Lista Equipos
	case 6:
		//Detalle por GPS
		echo widget_GPS_equipos('Equipos GPS','Vehiculos', 1, 2, $_GET['idSistema'], 
					$_GET['Config_IDGoogle'],
					$_GET['idTipoUsuario'],
					$_GET['idUsuario'],$dbConn);
		echo widget_Resumen_GPS_equipos('Vehiculos', 1, $_GET['idSistema'],
				$_GET['idTipoUsuario'],
				$_GET['idUsuario'],$dbConn);
		//Lista Equipos
		echo widget_GPS_equipos('Equipos Fijos','Fijos', 2, 2, $_GET['idSistema'], 
					$_GET['Config_IDGoogle'],
					$_GET['idTipoUsuario'],
					$_GET['idUsuario'],$dbConn);	
		echo widget_GPS_equipos_lista('Ultimas Mediciones', 2, 0, $_GET['trans_8'], 
				$_GET['idSistema'],
				$_GET['idTipoUsuario'],
				$_GET['idUsuario'], $dbConn);
	break;
	/*****************************************************/
	//Lista GPS y Detalle por Equipos
	case 7:
		//Lista GPS
		echo widget_GPS_equipos('Equipos GPS','Vehiculos', 1, 2, $_GET['idSistema'], 
					$_GET['Config_IDGoogle'],
					$_GET['idTipoUsuario'],
					$_GET['idUsuario'],$dbConn);
		echo widget_GPS_lista('Ultimas Mediciones', 1, 0, $_GET['trans_8'], 
				  $_GET['idSistema'],
				  $_GET['idTipoUsuario'],
				  $_GET['idUsuario'], $dbConn);
		//Detalle por Equipos
		echo widget_Equipos('Equipos Telemetria', 2, 0,$_GET['trans_9'], $_GET['idSistema'],
				$_GET['idTipoUsuario'],
				$_GET['idUsuario'], $dbConn);
		echo widget_Resumen_equipo('Ultimas Mediciones', 2, 0, 0, 
			$_GET['idSistema'],
			$_GET['idTipoUsuario'],
			$_GET['idUsuario'], $dbConn);
	break;
	/*****************************************************/
	//Lista GPS y Lista Equipos
	case 8:
		//Lista GPS
		echo widget_GPS_equipos('Equipos GPS','Vehiculos', 1, 2, $_GET['idSistema'], 
					$_GET['Config_IDGoogle'],
					$_GET['idTipoUsuario'],
					$_GET['idUsuario'],$dbConn);
		echo widget_GPS_lista('Ultimas Mediciones', 1, 0, $_GET['trans_8'], 
				  $_GET['idSistema'],
				  $_GET['idTipoUsuario'],
				  $_GET['idUsuario'], $dbConn);
		//Lista Equipos
		echo widget_GPS_equipos('Equipos Fijos','Fijos', 2, 2, $_GET['idSistema'], 
					$_GET['Config_IDGoogle'],
					$_GET['idTipoUsuario'],
					$_GET['idUsuario'],$dbConn);	
		echo widget_GPS_equipos_lista('Ultimas Mediciones', 2, 0, $_GET['trans_8'], 
				$_GET['idSistema'],
				$_GET['idTipoUsuario'],
				$_GET['idUsuario'], $dbConn);		  
	break;
	
	
	
	
	
}
			

		
?>
