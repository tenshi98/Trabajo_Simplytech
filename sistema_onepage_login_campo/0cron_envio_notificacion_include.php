<?php
//verifico si el dato ingresado existe dentro de las opciones
if (in_array($diaSem, $diaEnvio)){
	/***********************************************************************/
	//Se traen los datos de la plataforma
	$SIS_query = '
	Config_WhatsappToken AS SistemaWhatsappToken,
	Config_WhatsappInstanceId AS SistemaWhatsappInstanceId';
	$SIS_join  = '';
	$SIS_where = 'idSistema='.$SIS_idSistema;
	$rowSistema = db_select_data (false, $SIS_query, 'core_sistemas',$SIS_join, $SIS_where, $dbConn, 'ardu_include_notificaciones', basename($_SERVER["REQUEST_URI"], ".php"), 'arrCorreos');

	//Variables
	$WhatsappToken       = $rowSistema['SistemaWhatsappToken'];
	$WhatsappInstanceId  = $rowSistema['SistemaWhatsappInstanceId'];

	//Verifico la hora para cambiar el mensaje
	if($hora<'12:00:00'){
		$msgBody = "¡Buenos días! Por favor *registrar entrada* a jornada laboral cuando se encuentren dentro del lugar de trabajo, haciendo click en el siguiente link ⬇️ https://asistencia.simplytech.cl

	Muchas gracias";

	}else{
		$msgBody = "¡A descansar! Les deseamos un buen regreso a casa. Por favor *registrar salida* de jornada laboral dentro del lugar de trabajo en el siguiente link ⬇️ https://asistencia.simplytech.cl

	Muchas gracias";
	}

							
	/***********************************************************************/
	//verificacion que el cuerpo tiene datos
	if($msgBody!=''&&$WhatsappChat_id!=''){
		//envio notificacion	
		WhatsappGroupSendMessage($WhatsappToken, $WhatsappInstanceId, $WhatsappChat_id, $msgBody);
	}

}

							
	
?>
