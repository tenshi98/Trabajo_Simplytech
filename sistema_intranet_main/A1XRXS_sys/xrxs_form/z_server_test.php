<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['email']) )           $email            = $_POST['email'];
	if ( !empty($_POST['texto']) )           $texto            = $_POST['texto'];
	if ( !empty($_POST['email_principal']) ) $email_principal  = $_POST['email_principal'];
	

/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $_SESSION['form_require']);
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'email':           if(empty($email)){            $error['email']             = 'error/No ha ingresado el email';}break;
			case 'texto':           if(empty($texto)){            $error['texto']             = 'error/No ha ingresado el texto de prueba';}break;
			case 'email_principal': if(empty($email_principal)){  $error['email_principal']   = 'error/No ha ingresado el email';}break;
			
		}
	}
					
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                  Pago Normal                                                    */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/
		case 'send_mail':	

			//Carga de la libreria de envio de correos
			require_once '../LIBS_php/PHPMailer/PHPMailerAutoload.php';	
			//Instanciacion
			$mail = new PHPMailer;
			//Quien envia el correo
			$mail->setFrom($email_principal, 'Exilon360');
			//A quien responder el correo
			$mail->addReplyTo($email_principal, 'Exilon360');
			//Destinatarios
			$mail->addAddress($email, 'Receptor');
			//Asunto
			$mail->Subject = 'Notificacion';
			//Cuerpo del mensaje
			$mail->msgHTML($texto);
			//Datos Adjuntos
			//$mail->addAttachment('images/phpmailer_mini.png');
			//Envio del mensaje
			if (!$mail->send()) {
				header( 'Location: '.$location.'?error='.$mail->ErrorInfo );
				die;
			} else {
				$error['texto']    = 'sucess/Email enviado correctamente';
				header( 'Location: '.$location.'?send=true' );
				die;
			}

		break;	
/*******************************************************************************************************************/
		case 'del_error':	

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `error_log` WHERE idErrorLog = {$_GET['del_error']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location );
				die;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}	
						
			

		break;		
/*******************************************************************************************************************/
	}
?>
