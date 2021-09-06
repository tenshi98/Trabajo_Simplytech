<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idSistema']) )                        $idSistema                         = $_POST['idSistema'];
	if ( !empty($_POST['Nombre']) )                           $Nombre                            = $_POST['Nombre'];
	if ( isset($_POST['email_principal']) )                   $email_principal                   = $_POST['email_principal'];
	if ( !empty($_POST['Rut']) )                              $Rut                               = $_POST['Rut'];
	if ( isset($_POST['idCiudad']) )                          $idCiudad                          = $_POST['idCiudad'];
	if ( isset($_POST['idComuna']) )                          $idComuna                          = $_POST['idComuna'];
	if ( !empty($_POST['Direccion']) )                        $Direccion                         = $_POST['Direccion'];
	if ( isset($_POST['CajaChica']) )                         $CajaChica                         = $_POST['CajaChica'];
	if ( isset($_POST['Contacto_Nombre']) )                   $Contacto_Nombre                   = $_POST['Contacto_Nombre'];
	if ( isset($_POST['Contacto_Fono1']) )                    $Contacto_Fono1                    = $_POST['Contacto_Fono1'];
	if ( isset($_POST['Contacto_Fono2']) )                    $Contacto_Fono2                    = $_POST['Contacto_Fono2'];
	if ( isset($_POST['Contacto_Fax']) )                      $Contacto_Fax                      = $_POST['Contacto_Fax'];
	if ( isset($_POST['Contacto_Email']) )                    $Contacto_Email                    = $_POST['Contacto_Email'];
	if ( isset($_POST['Contacto_Web']) )                      $Contacto_Web                      = $_POST['Contacto_Web'];
	if ( isset($_POST['Contrato_Nombre']) )                   $Contrato_Nombre                   = $_POST['Contrato_Nombre'];
	if ( !empty($_POST['Contrato_Numero']) )                  $Contrato_Numero                   = $_POST['Contrato_Numero'];
	if ( !empty($_POST['Contrato_Fecha']) )                   $Contrato_Fecha                    = $_POST['Contrato_Fecha'];
	if ( !empty($_POST['Contrato_Duracion']) )                $Contrato_Duracion                 = $_POST['Contrato_Duracion'];
	if ( !empty($_POST['Config_IDGoogle']) )                  $Config_IDGoogle                   = $_POST['Config_IDGoogle'];
	if ( !empty($_POST['Config_Google_apiKey']) )             $Config_Google_apiKey              = $_POST['Config_Google_apiKey'];
	if ( !empty($_POST['Config_FCM_apiKey']) )                $Config_FCM_apiKey                 = $_POST['Config_FCM_apiKey'];
	if ( !empty($_POST['Config_FCM_Main_apiKey']) )           $Config_FCM_Main_apiKey            = $_POST['Config_FCM_Main_apiKey'];
	if ( !empty($_POST['Config_imgLogo']) )                   $Config_imgLogo                    = $_POST['Config_imgLogo'];
	if ( !empty($_POST['Config_idTheme']) )                   $Config_idTheme                    = $_POST['Config_idTheme'];
	if ( !empty($_POST['Config_CorreoRespaldo']) )            $Config_CorreoRespaldo             = $_POST['Config_CorreoRespaldo'];
	if ( !empty($_POST['Config_Gmail_Usuario']) )             $Config_Gmail_Usuario              = $_POST['Config_Gmail_Usuario'];
	if ( !empty($_POST['Config_Gmail_Password']) )            $Config_Gmail_Password             = $_POST['Config_Gmail_Password'];
	if ( !empty($_POST['Config_WhatsappToken']) )             $Config_WhatsappToken              = $_POST['Config_WhatsappToken'];
	if ( !empty($_POST['Config_WhatsappInstanceId']) )        $Config_WhatsappInstanceId         = $_POST['Config_WhatsappInstanceId'];
	if ( !empty($_POST['idOpcionesGen_1']) )                  $idOpcionesGen_1                   = $_POST['idOpcionesGen_1'];
	if ( !empty($_POST['idOpcionesGen_2']) )                  $idOpcionesGen_2                   = $_POST['idOpcionesGen_2'];
	if ( !empty($_POST['idOpcionesGen_3']) )                  $idOpcionesGen_3                   = $_POST['idOpcionesGen_3'];
	if ( !empty($_POST['idOpcionesGen_4']) )                  $idOpcionesGen_4                   = $_POST['idOpcionesGen_4'];
	if ( !empty($_POST['idOpcionesGen_5']) )                  $idOpcionesGen_5                   = $_POST['idOpcionesGen_5'];
	if ( isset($_POST['idOpcionesGen_6']) )                   $idOpcionesGen_6                   = $_POST['idOpcionesGen_6'];
	if ( !empty($_POST['idOpcionesGen_7']) )                  $idOpcionesGen_7                   = $_POST['idOpcionesGen_7'];
	if ( !empty($_POST['idOpcionesGen_8']) )                  $idOpcionesGen_8                   = $_POST['idOpcionesGen_8'];
	if ( !empty($_POST['idOpcionesGen_9']) )                  $idOpcionesGen_9                   = $_POST['idOpcionesGen_9'];
	if ( !empty($_POST['idOpcionesGen_10']) )                 $idOpcionesGen_10                  = $_POST['idOpcionesGen_10'];
	if ( !empty($_POST['idOpcionesGen_11']) )                 $idOpcionesGen_11                  = $_POST['idOpcionesGen_11'];
	if ( !empty($_POST['idOpcionesGen_12']) )                 $idOpcionesGen_12                  = $_POST['idOpcionesGen_12'];
	if ( !empty($_POST['idOpcionesGen_13']) )                 $idOpcionesGen_13                  = $_POST['idOpcionesGen_13'];
	if ( !empty($_POST['idOpcionesGen_14']) )                 $idOpcionesGen_14                  = $_POST['idOpcionesGen_14'];
	if ( !empty($_POST['idOpcionesGen_15']) )                 $idOpcionesGen_15                  = $_POST['idOpcionesGen_15'];
	if ( !empty($_POST['idOpcionesGen_16']) )                 $idOpcionesGen_16                  = $_POST['idOpcionesGen_16'];
	if ( !empty($_POST['idOpcionesGen_17']) )                 $idOpcionesGen_17                  = $_POST['idOpcionesGen_17'];
	if ( !empty($_POST['idOpcionesGen_18']) )                 $idOpcionesGen_18                  = $_POST['idOpcionesGen_18'];
	if ( !empty($_POST['idOpcionesGen_19']) )                 $idOpcionesGen_19                  = $_POST['idOpcionesGen_19'];
	if ( !empty($_POST['idOpcionesGen_20']) )                 $idOpcionesGen_20                  = $_POST['idOpcionesGen_20'];
	if ( !empty($_POST['OT_idBodegaProd']) )                  $OT_idBodegaProd                   = $_POST['OT_idBodegaProd'];
	if ( !empty($_POST['OT_idBodegaIns']) )                   $OT_idBodegaIns                    = $_POST['OT_idBodegaIns'];
	if ( !empty($_POST['Rubro']) )                            $Rubro                             = $_POST['Rubro'];
	if ( !empty($_POST['idOpcionesTel']) )                    $idOpcionesTel                     = $_POST['idOpcionesTel'];
	if ( !empty($_POST['idConfigRam']) )                      $idConfigRam                       = $_POST['idConfigRam'];
	if ( !empty($_POST['idConfigTime']) )                     $idConfigTime                      = $_POST['idConfigTime'];
	if ( !empty($_POST['idEstado']) )                         $idEstado                          = $_POST['idEstado'];
	if ( !empty($_POST['CrossTech_DiasTempMin']) )            $CrossTech_DiasTempMin             = $_POST['CrossTech_DiasTempMin'];
	if ( !empty($_POST['CrossTech_TempMin']) )                $CrossTech_TempMin                 = $_POST['CrossTech_TempMin'];
	if ( !empty($_POST['CrossTech_TempMax']) )                $CrossTech_TempMax                 = $_POST['CrossTech_TempMax'];
	if ( !empty($_POST['CrossTech_FechaDiasTempMin']) )       $CrossTech_FechaDiasTempMin        = $_POST['CrossTech_FechaDiasTempMin'];
	if ( !empty($_POST['CrossTech_FechaTempMin']) )           $CrossTech_FechaTempMin            = $_POST['CrossTech_FechaTempMin'];
	if ( !empty($_POST['CrossTech_FechaTempMax']) )           $CrossTech_FechaTempMax            = $_POST['CrossTech_FechaTempMax'];
	if ( !empty($_POST['CrossTech_FechaUnidadFrio']) )        $CrossTech_FechaUnidadFrio         = $_POST['CrossTech_FechaUnidadFrio'];
	if ( !empty($_POST['CrossTech_HoraPrevRev']) )            $CrossTech_HoraPrevRev             = $_POST['CrossTech_HoraPrevRev'];
	if ( !empty($_POST['CrossTech_HoraPrevision']) )          $CrossTech_HoraPrevision           = $_POST['CrossTech_HoraPrevision'];
	if ( !empty($_POST['CrossTech_HoraPrevCuenta']) )         $CrossTech_HoraPrevCuenta          = $_POST['CrossTech_HoraPrevCuenta'];
	if ( !empty($_POST['CrossTech_HeladaTemp']) )             $CrossTech_HeladaTemp              = $_POST['CrossTech_HeladaTemp'];
	if ( !empty($_POST['CrossTech_HeladaMailHoraIni']) )      $CrossTech_HeladaMailHoraIni       = $_POST['CrossTech_HeladaMailHoraIni'];
	if ( !empty($_POST['CrossTech_HeladaMailHoraTerm']) )     $CrossTech_HeladaMailHoraTerm      = $_POST['CrossTech_HeladaMailHoraTerm'];
	if ( !empty($_POST['Social_idUso']) )                     $Social_idUso                      = $_POST['Social_idUso'];
	if ( isset($_POST['Social_facebook']) )                   $Social_facebook                   = $_POST['Social_facebook'];
	if ( isset($_POST['Social_twitter']) )                    $Social_twitter                    = $_POST['Social_twitter'];
	if ( isset($_POST['Social_instagram']) )                  $Social_instagram                  = $_POST['Social_instagram'];
	if ( isset($_POST['Social_linkedin']) )                   $Social_linkedin                   = $_POST['Social_linkedin'];
	if ( isset($_POST['Social_rss']) )                        $Social_rss                        = $_POST['Social_rss'];
	if ( isset($_POST['Social_youtube']) )                    $Social_youtube                    = $_POST['Social_youtube'];
	if ( isset($_POST['Social_tumblr']) )                     $Social_tumblr                     = $_POST['Social_tumblr'];
	
	
	if ( !empty($_POST['CrossTech_FechaDiasTempMinOld']) )    $CrossTech_FechaDiasTempMinOld     = $_POST['CrossTech_FechaDiasTempMinOld'];
	if ( !empty($_POST['CrossTech_FechaTempMinOld']) )        $CrossTech_FechaTempMinOld         = $_POST['CrossTech_FechaTempMinOld'];
	if ( !empty($_POST['CrossTech_FechaTempMaxOld']) )        $CrossTech_FechaTempMaxOld         = $_POST['CrossTech_FechaTempMaxOld'];
	if ( !empty($_POST['CrossTech_FechaUnidadFrioOld']) )     $CrossTech_FechaUnidadFrioOld      = $_POST['CrossTech_FechaUnidadFrioOld'];
	
	
/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $_SESSION['form_require']);
	$INT_piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($INT_piezas as $INT_valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($INT_valor) {
			case 'idSistema':                          if(empty($idSistema)){                           $error['idSistema']                           = 'error/No ha ingresado el id';}break;
			case 'Nombre':                             if(empty($Nombre)){                              $error['Nombre']                              = 'error/No ha ingresado el Nombre';}break;
			case 'email_principal':                    if(!isset($email_principal)){                    $error['email_principal']                     = 'error/No ha ingresado el email';}break;
			case 'Rut':                                if(empty($Rut)){                                 $error['Rut']                                 = 'error/No ha ingresado el Rut';}break;
			case 'idCiudad':                           if(!isset($idCiudad)){                           $error['idCiudad']                            = 'error/No ha seleccionado la region';}break;
			case 'idComuna':                           if(!isset($idComuna)){                           $error['idComuna']                            = 'error/No ha seleccionado la comuna';}break;
			case 'Direccion':                          if(empty($Direccion)){                           $error['Direccion']                           = 'error/No ha ingresado la direccion';}break;
			case 'CajaChica':                          if(!isset($CajaChica)){                          $error['CajaChica']                           = 'error/No ha ingresado el Nombre monto de la caja chica';}break;
			case 'Contacto_Nombre':                    if(!isset($Contacto_Nombre)){                    $error['Contacto_Nombre']                     = 'error/No ha ingresado el Nombre del contacto';}break;
			case 'Contacto_Fono1':                     if(!isset($Contacto_Fono1)){                     $error['Contacto_Fono1']                      = 'error/No ha ingresado el telefono 1';}break;
			case 'Contacto_Fono2':                     if(!isset($Contacto_Fono2)){                     $error['Contacto_Fono2']                      = 'error/No ha ingresado el telefono 2';}break;
			case 'Contacto_Fax':                       if(!isset($Contacto_Fax)){                       $error['Contacto_Fax']                        = 'error/No ha ingresado el fax';}break;
			case 'Contacto_Email':                     if(!isset($Contacto_Email)){                     $error['Contacto_Email']                      = 'error/No ha ingresado el email del sistema';}break;
			case 'Contacto_Web':                       if(!isset($Contacto_Web)){                       $error['Contacto_Web']                        = 'error/No ha ingresado la pagina web';}break;
			case 'Contrato_Nombre':                    if(!isset($Contrato_Nombre)){                    $error['Contrato_Nombre']                     = 'error/No ha ingresado el Nombre del contrato';}break;
			case 'Contrato_Numero':                    if(empty($Contrato_Numero)){                     $error['Contrato_Numero']                     = 'error/No ha ingresado el numero de contrato';}break;
			case 'Contrato_Fecha':                     if(empty($Contrato_Fecha)){                      $error['Contrato_Fecha']                      = 'error/No ha ingresado la fecha de contrato';}break;
			case 'Contrato_Duracion':                  if(empty($Contrato_Duracion)){                   $error['Contrato_Duracion']                   = 'error/No ha ingresado la duracion del contrato';}break;
			case 'Config_IDGoogle':                    if(empty($Config_IDGoogle)){                     $error['Config_IDGoogle']                     = 'error/No ha ingresado la ID de Google';}break;
			case 'Config_Google_apiKey':               if(empty($Config_Google_apiKey)){                $error['Config_Google_apiKey']                = 'error/No ha ingresado la ID de Android';}break;
			case 'Config_FCM_apiKey':                  if(empty($Config_FCM_apiKey)){                   $error['Config_FCM_apiKey']                   = 'error/No ha ingresado la ID de Firebase';}break;
			case 'Config_FCM_Main_apiKey':             if(empty($Config_FCM_Main_apiKey)){              $error['Config_FCM_Main_apiKey']              = 'error/No ha ingresado la ID Maestra de Firebase';}break;
			case 'Config_imgLogo':                     if(empty($Config_imgLogo)){                      $error['Config_imgLogo']                      = 'error/No ha subido el logo';}break;
			case 'Config_idTheme':                     if(empty($Config_idTheme)){                      $error['Config_idTheme']                      = 'error/No ha seleccionado el tema';}break;
			case 'Config_CorreoRespaldo':              if(empty($Config_CorreoRespaldo)){               $error['Config_CorreoRespaldo']               = 'error/No ha ingresado el correo de respaldo';}break;
			case 'Config_Gmail_Usuario':               if(empty($Config_Gmail_Usuario)){                $error['Config_Gmail_Usuario']                = 'error/No ha ingresado el usuario de gmail';}break;
			case 'Config_Gmail_Password':              if(empty($Config_Gmail_Password)){               $error['Config_Gmail_Password']               = 'error/No ha ingresado la contraseña del usuario de gmail';}break;
			case 'Config_WhatsappToken':               if(empty($Config_WhatsappToken)){                $error['Config_WhatsappToken']                = 'error/No ha ingresado el Whatsapp Token';}break;
			case 'Config_WhatsappInstanceId':          if(empty($Config_WhatsappInstanceId)){           $error['Config_WhatsappInstanceId']           = 'error/No ha ingresado el Whatsapp Instance Id';}break;
			case 'idOpcionesGen_1':                    if(empty($idOpcionesGen_1)){                     $error['idOpcionesGen_1']                     = 'error/No ha seleccionado la opcion 1';}break;
			case 'idOpcionesGen_2':                    if(empty($idOpcionesGen_2)){                     $error['idOpcionesGen_2']                     = 'error/No ha seleccionado la opcion 2';}break;
			case 'idOpcionesGen_3':                    if(empty($idOpcionesGen_3)){                     $error['idOpcionesGen_3']                     = 'error/No ha seleccionado la opcion 3';}break;
			case 'idOpcionesGen_4':                    if(empty($idOpcionesGen_4)){                     $error['idOpcionesGen_4']                     = 'error/No ha seleccionado la opcion 4';}break;
			case 'idOpcionesGen_5':                    if(empty($idOpcionesGen_5)){                     $error['idOpcionesGen_5']                     = 'error/No ha seleccionado la opcion 5';}break;
			case 'idOpcionesGen_6':                    if(!isset($idOpcionesGen_6)){                    $error['idOpcionesGen_6']                     = 'error/No ha seleccionado la opcion 6';}break;
			case 'idOpcionesGen_7':                    if(empty($idOpcionesGen_7)){                     $error['idOpcionesGen_7']                     = 'error/No ha seleccionado la opcion 7';}break;
			case 'idOpcionesGen_8':                    if(empty($idOpcionesGen_8)){                     $error['idOpcionesGen_8']                     = 'error/No ha seleccionado la opcion 8';}break;
			case 'idOpcionesGen_9':                    if(empty($idOpcionesGen_9)){                     $error['idOpcionesGen_9']                     = 'error/No ha seleccionado la opcion 9';}break;
			case 'idOpcionesGen_10':                   if(empty($idOpcionesGen_10)){                    $error['idOpcionesGen_10']                    = 'error/No ha seleccionado la opcion 10';}break;
			case 'idOpcionesGen_11':                   if(empty($idOpcionesGen_11)){                    $error['idOpcionesGen_11']                    = 'error/No ha seleccionado la opcion 11';}break;
			case 'idOpcionesGen_12':                   if(empty($idOpcionesGen_12)){                    $error['idOpcionesGen_12']                    = 'error/No ha seleccionado la opcion 12';}break;
			case 'idOpcionesGen_13':                   if(empty($idOpcionesGen_13)){                    $error['idOpcionesGen_13']                    = 'error/No ha seleccionado la opcion 13';}break;
			case 'idOpcionesGen_14':                   if(empty($idOpcionesGen_14)){                    $error['idOpcionesGen_14']                    = 'error/No ha seleccionado la opcion 14';}break;
			case 'idOpcionesGen_15':                   if(empty($idOpcionesGen_15)){                    $error['idOpcionesGen_15']                    = 'error/No ha seleccionado la opcion 15';}break;
			case 'idOpcionesGen_16':                   if(empty($idOpcionesGen_16)){                    $error['idOpcionesGen_16']                    = 'error/No ha seleccionado la opcion 16';}break;
			case 'idOpcionesGen_17':                   if(empty($idOpcionesGen_17)){                    $error['idOpcionesGen_17']                    = 'error/No ha seleccionado la opcion 17';}break;
			case 'idOpcionesGen_18':                   if(empty($idOpcionesGen_18)){                    $error['idOpcionesGen_18']                    = 'error/No ha seleccionado la opcion 18';}break;
			case 'idOpcionesGen_19':                   if(empty($idOpcionesGen_19)){                    $error['idOpcionesGen_19']                    = 'error/No ha seleccionado la opcion 19';}break;
			case 'idOpcionesGen_20':                   if(empty($idOpcionesGen_20)){                    $error['idOpcionesGen_20']                    = 'error/No ha seleccionado la opcion 20';}break;
			case 'OT_idBodegaProd':                    if(empty($OT_idBodegaProd)){                     $error['OT_idBodegaProd']                     = 'error/No ha seleccionado la bodega de productos';}break;
			case 'OT_idBodegaIns':                     if(empty($OT_idBodegaIns)){                      $error['OT_idBodegaIns']                      = 'error/No ha seleccionado la bodega de insumos';}break;
			case 'Rubro':                              if(empty($Rubro)){                               $error['Rubro']                               = 'error/No ha ingresado el rubro';}break;
			case 'idOpcionesTel':                      if(empty($idOpcionesTel)){                       $error['idOpcionesTel']                       = 'error/No ha seleccionado el resumen de telemetria a mostrar';}break;
			case 'idConfigRam':                        if(empty($idConfigRam)){                         $error['idConfigRam']                         = 'error/No ha seleccionado la configuracion de la ram';}break;
			case 'idConfigTime':                       if(empty($idConfigTime)){                        $error['idConfigTime']                        = 'error/No ha seleccionado la configuracion del tiempo de espera';}break;
			case 'idEstado':                           if(empty($idEstado)){                            $error['idEstado']                            = 'error/No ha seleccionado el sistema';}break;
			case 'CrossTech_DiasTempMin':              if(empty($CrossTech_DiasTempMin)){               $error['CrossTech_DiasTempMin']               = 'error/No ha ingresado la temperatura minima de los dias';}break;
			case 'CrossTech_TempMin':                  if(empty($CrossTech_TempMin)){                   $error['CrossTech_TempMin']                   = 'error/No ha ingresado la temperatura minima';}break;
			case 'CrossTech_TempMax':                  if(empty($CrossTech_TempMax)){                   $error['CrossTech_TempMax']                   = 'error/No ha ingresado la temperatura maxima';}break;
			case 'CrossTech_FechaDiasTempMin':         if(empty($CrossTech_FechaDiasTempMin)){          $error['CrossTech_FechaDiasTempMin']          = 'error/No ha ingresado la fecha de temperatura minima de los dias';}break;
			case 'CrossTech_FechaTempMin':             if(empty($CrossTech_FechaTempMin)){              $error['CrossTech_FechaTempMin']              = 'error/No ha ingresado la fecha de temperatura minima';}break;
			case 'CrossTech_FechaTempMax':             if(empty($CrossTech_FechaTempMax)){              $error['CrossTech_FechaTempMax']              = 'error/No ha ingresado la fecha de temperatura maxima';}break;
			case 'CrossTech_FechaUnidadFrio':          if(empty($CrossTech_FechaUnidadFrio)){           $error['CrossTech_FechaUnidadFrio']           = 'error/No ha ingresado la fecha de la unidad de frio';}break;
			case 'CrossTech_HoraPrevRev':              if(empty($CrossTech_HoraPrevRev)){               $error['CrossTech_HoraPrevRev']               = 'error/No ha ingresado las horas a revisar para la prevision';}break;
			case 'CrossTech_HoraPrevision':            if(empty($CrossTech_HoraPrevision)){             $error['CrossTech_HoraPrevision']             = 'error/No ha ingresado las horas de prevision';}break;
			case 'CrossTech_HoraPrevCuenta':           if(empty($CrossTech_HoraPrevCuenta)){            $error['CrossTech_HoraPrevCuenta']            = 'error/No ha ingresado la cuenta de las horas de prevision';}break;
			case 'CrossTech_HeladaTemp':               if(empty($CrossTech_HeladaTemp)){                $error['CrossTech_HeladaTemp']                = 'error/No ha ingresado la hora minima de notificacion de helada';}break;
			case 'CrossTech_HeladaMailHoraIni':        if(empty($CrossTech_HeladaMailHoraIni)){         $error['CrossTech_HeladaMailHoraIni']         = 'error/No ha ingresado la hora de inicio de envio de correo';}break;
			case 'CrossTech_HeladaMailHoraTerm':       if(empty($CrossTech_HeladaMailHoraTerm)){        $error['CrossTech_HeladaMailHoraTerm']        = 'error/No ha ingresado la hora de termino de envio de correo';}break;
			case 'Social_idUso':                       if(empty($Social_idUso)){                        $error['Social_idUso']                        = 'error/No ha Seleccionado la opcion de mostrar widget sociales';}break;
			case 'Social_facebook':                    if(!isset($Social_facebook)){                    $error['Social_facebook']                     = 'error/No ha ingresado los datos de facebook';}break;
			case 'Social_twitter':                     if(!isset($Social_twitter)){                     $error['Social_twitter']                      = 'error/No ha ingresado los datos de twitter';}break;
			case 'Social_instagram':                   if(!isset($Social_instagram)){                   $error['Social_instagram']                    = 'error/No ha ingresado los datos de instagram';}break;
			case 'Social_linkedin':                    if(!isset($Social_linkedin)){                    $error['Social_linkedin']                     = 'error/No ha ingresado los datos de linkedin';}break;
			case 'Social_rss':                         if(!isset($Social_rss)){                         $error['Social_rss']                          = 'error/No ha ingresado los datos de rss';}break;
			case 'Social_youtube':                     if(!isset($Social_youtube)){                     $error['Social_youtube']                      = 'error/No ha ingresado los datos de youtube';}break;
			case 'Social_tumblr':                      if(!isset($Social_tumblr)){                      $error['Social_tumblr']                       = 'error/No ha ingresado los datos de tumblr';}break;
			
			case 'CrossTech_FechaDiasTempMinOld':      if(empty($CrossTech_FechaDiasTempMinOld)){       $error['CrossTech_FechaDiasTempMinOld']       = 'error/No ha ingresado la fecha de temperatura minima de los dias';}break;
			case 'CrossTech_FechaTempMinOld':          if(empty($CrossTech_FechaTempMinOld)){           $error['CrossTech_FechaTempMinOld']           = 'error/No ha ingresado la fecha de temperatura minima';}break;
			case 'CrossTech_FechaTempMaxOld':          if(empty($CrossTech_FechaTempMaxOld)){           $error['CrossTech_FechaTempMaxOld']           = 'error/No ha ingresado la fecha de temperatura maxima';}break;
			case 'CrossTech_FechaUnidadFrioOld':       if(empty($CrossTech_FechaUnidadFrioOld)){        $error['CrossTech_FechaUnidadFrioOld']        = 'error/No ha ingresado la fecha de temperatura maxima';}break;
			
		}
	}
	
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($email_principal)&&$email_principal!=''&&!validarEmail($email_principal)){ $error['email_principal']   = 'error/El Email de sistema ingresado no es valido'; }
	if(isset($Contacto_Fono1)&&$Contacto_Fono1!=''&&!validarNumero($Contacto_Fono1)) {  $error['Fono1']	            = 'error/Ingrese un numero telefonico valido'; }
	if(isset($Contacto_Fono2)&&$Contacto_Fono2!=''&&!validarNumero($Contacto_Fono2)) {  $error['Fono2']	            = 'error/Ingrese un numero telefonico valido'; }
	if(isset($Rut)&&$Rut!=''&&!validarRut($Rut)){                                       $error['Rut']               = 'error/El Rut ingresado no es valido'; }
	if(isset($Contacto_Email)&&$email_principal!=''&&!validarEmail($Contacto_Email)){   $error['Contacto_Email']    = 'error/El Email de contacto ingresado no es valido'; }	
	
	
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'core_sistemas', '', "Nombre='".$Nombre."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'core_sistemas', '', "Rut='".$Rut."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){                                               $a  = "'".$Nombre."'" ;                              }else{$a  ="''";}
				if(isset($email_principal) && $email_principal != ''){                             $a .= ",'".$email_principal."'" ;                    }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){                                                     $a .= ",'".$Rut."'" ;                                }else{$a .= ",''";}
				if(isset($idCiudad) && $idCiudad != ''){                                           $a .= ",'".$idCiudad."'" ;                           }else{$a .= ",''";}
				if(isset($idComuna) && $idComuna != ''){                                           $a .= ",'".$idComuna."'" ;                           }else{$a .= ",''";}
				if(isset($Direccion) && $Direccion != ''){                                         $a .= ",'".$Direccion."'" ;                          }else{$a .= ",''";}
				if(isset($CajaChica) && $CajaChica != ''){                                         $a .= ",'".$CajaChica."'" ;                          }else{$a .= ",''";}
				if(isset($Contacto_Nombre) && $Contacto_Nombre != ''){                             $a .= ",'".$Contacto_Nombre."'" ;                    }else{$a .= ",''";}
				if(isset($Contacto_Fono1) && $Contacto_Fono1 != ''){                               $a .= ",'".$Contacto_Fono1."'" ;                     }else{$a .= ",''";}
				if(isset($Contacto_Fono2) && $Contacto_Fono2 != ''){                               $a .= ",'".$Contacto_Fono2."'" ;                     }else{$a .= ",''";}
				if(isset($Contacto_Fax) && $Contacto_Fax != ''){                                   $a .= ",'".$Contacto_Fax."'" ;                       }else{$a .= ",''";}
				if(isset($Contacto_Email) && $Contacto_Email != ''){                               $a .= ",'".$Contacto_Email."'" ;                     }else{$a .= ",''";}
				if(isset($Contacto_Web) && $Contacto_Web != ''){                                   $a .= ",'".$Contacto_Web."'" ;                       }else{$a .= ",''";}
				if(isset($Contrato_Nombre) && $Contrato_Nombre != ''){                             $a .= ",'".$Contrato_Nombre."'" ;                    }else{$a .= ",''";}
				if(isset($Contrato_Numero) && $Contrato_Numero != ''){                             $a .= ",'".$Contrato_Numero."'" ;                    }else{$a .= ",''";}
				if(isset($Contrato_Fecha) && $Contrato_Fecha != ''){                               $a .= ",'".$Contrato_Fecha."'" ;                     }else{$a .= ",''";}
				if(isset($Contrato_Duracion) && $Contrato_Duracion != ''){                         $a .= ",'".$Contrato_Duracion."'" ;                  }else{$a .= ",''";}
				if(isset($Config_IDGoogle) && $Config_IDGoogle != ''){                             $a .= ",'".$Config_IDGoogle."'" ;                    }else{$a .= ",''";}
				if(isset($Config_Google_apiKey) && $Config_Google_apiKey != ''){                   $a .= ",'".$Config_Google_apiKey."'" ;               }else{$a .= ",''";}
				if(isset($Config_FCM_apiKey) && $Config_FCM_apiKey != ''){                         $a .= ",'".$Config_FCM_apiKey."'" ;                  }else{$a .= ",''";}
				if(isset($Config_FCM_Main_apiKey) && $Config_FCM_Main_apiKey != ''){               $a .= ",'".$Config_FCM_Main_apiKey."'" ;             }else{$a .= ",''";}
				if(isset($Config_imgLogo) && $Config_imgLogo != ''){                               $a .= ",'".$Config_imgLogo."'" ;                     }else{$a .= ",''";}
				if(isset($Config_idTheme) && $Config_idTheme != ''){                               $a .= ",'".$Config_idTheme."'" ;                     }else{$a .= ",''";}
				if(isset($Config_CorreoRespaldo) && $Config_CorreoRespaldo != ''){                 $a .= ",'".$Config_CorreoRespaldo."'" ;              }else{$a .= ",''";}
				if(isset($Config_Gmail_Usuario) && $Config_Gmail_Usuario != ''){                   $a .= ",'".$Config_Gmail_Usuario."'" ;               }else{$a .= ",''";}
				if(isset($Config_Gmail_Password) && $Config_Gmail_Password != ''){                 $a .= ",'".$Config_Gmail_Password."'" ;              }else{$a .= ",''";}
				if(isset($Config_WhatsappToken) && $Config_WhatsappToken != ''){                   $a .= ",'".$Config_WhatsappToken."'" ;               }else{$a .= ",''";}
				if(isset($Config_WhatsappInstanceId) && $Config_WhatsappInstanceId != ''){         $a .= ",'".$Config_WhatsappInstanceId."'" ;          }else{$a .= ",''";}
				if(isset($idOpcionesGen_1) && $idOpcionesGen_1 != ''){                             $a .= ",'".$idOpcionesGen_1."'" ;                    }else{$a .= ",''";}
				if(isset($idOpcionesGen_2) && $idOpcionesGen_2 != ''){                             $a .= ",'".$idOpcionesGen_2."'" ;                    }else{$a .= ",''";}
				if(isset($idOpcionesGen_3) && $idOpcionesGen_3 != ''){                             $a .= ",'".$idOpcionesGen_3."'" ;                    }else{$a .= ",''";}
				if(isset($idOpcionesGen_4) && $idOpcionesGen_4 != ''){                             $a .= ",'".$idOpcionesGen_4."'" ;                    }else{$a .= ",''";}
				if(isset($idOpcionesGen_5) && $idOpcionesGen_5 != ''){                             $a .= ",'".$idOpcionesGen_5."'" ;                    }else{$a .= ",''";}
				if(isset($idOpcionesGen_6) && $idOpcionesGen_6 != ''){                             $a .= ",'".$idOpcionesGen_6."'" ;                    }else{$a .= ",''";}
				if(isset($idOpcionesGen_7) && $idOpcionesGen_7 != ''){                             $a .= ",'".$idOpcionesGen_7."'" ;                    }else{$a .= ",''";}
				if(isset($idOpcionesGen_8) && $idOpcionesGen_8 != ''){                             $a .= ",'".$idOpcionesGen_8."'" ;                    }else{$a .= ",''";}
				if(isset($idOpcionesGen_9) && $idOpcionesGen_9 != ''){                             $a .= ",'".$idOpcionesGen_9."'" ;                    }else{$a .= ",''";}
				if(isset($idOpcionesGen_10) && $idOpcionesGen_10 != ''){                           $a .= ",'".$idOpcionesGen_10."'" ;                   }else{$a .= ",''";}
				if(isset($idOpcionesGen_11) && $idOpcionesGen_11 != ''){                           $a .= ",'".$idOpcionesGen_11."'" ;                   }else{$a .= ",''";}
				if(isset($idOpcionesGen_12) && $idOpcionesGen_12 != ''){                           $a .= ",'".$idOpcionesGen_12."'" ;                   }else{$a .= ",''";}
				if(isset($idOpcionesGen_13) && $idOpcionesGen_13 != ''){                           $a .= ",'".$idOpcionesGen_13."'" ;                   }else{$a .= ",''";}
				if(isset($idOpcionesGen_14) && $idOpcionesGen_14 != ''){                           $a .= ",'".$idOpcionesGen_14."'" ;                   }else{$a .= ",''";}
				if(isset($idOpcionesGen_15) && $idOpcionesGen_15 != ''){                           $a .= ",'".$idOpcionesGen_15."'" ;                   }else{$a .= ",''";}
				if(isset($idOpcionesGen_16) && $idOpcionesGen_16 != ''){                           $a .= ",'".$idOpcionesGen_16."'" ;                   }else{$a .= ",''";}
				if(isset($idOpcionesGen_17) && $idOpcionesGen_17 != ''){                           $a .= ",'".$idOpcionesGen_17."'" ;                   }else{$a .= ",''";}
				if(isset($idOpcionesGen_18) && $idOpcionesGen_18 != ''){                           $a .= ",'".$idOpcionesGen_18."'" ;                   }else{$a .= ",''";}
				if(isset($idOpcionesGen_19) && $idOpcionesGen_19 != ''){                           $a .= ",'".$idOpcionesGen_19."'" ;                   }else{$a .= ",''";}
				if(isset($idOpcionesGen_20) && $idOpcionesGen_20 != ''){                           $a .= ",'".$idOpcionesGen_20."'" ;                   }else{$a .= ",''";}
				if(isset($OT_idBodegaProd) && $OT_idBodegaProd != ''){                             $a .= ",'".$OT_idBodegaProd."'" ;                    }else{$a .= ",''";}
				if(isset($OT_idBodegaIns) && $OT_idBodegaIns != ''){                               $a .= ",'".$OT_idBodegaIns."'" ;                     }else{$a .= ",''";}
				if(isset($Rubro) && $Rubro != ''){                                                 $a .= ",'".$Rubro."'" ;                              }else{$a .= ",''";}
				if(isset($idOpcionesTel) && $idOpcionesTel != ''){                                 $a .= ",'".$idOpcionesTel."'" ;                      }else{$a .= ",''";}
				if(isset($idConfigRam) && $idConfigRam != ''){                                     $a .= ",'".$idConfigRam."'" ;                        }else{$a .= ",''";}
				if(isset($idConfigTime) && $idConfigTime != ''){                                   $a .= ",'".$idConfigTime."'" ;                       }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                                           $a .= ",'".$idEstado."'" ;                           }else{$a .= ",''";}
				if(isset($CrossTech_DiasTempMin) && $CrossTech_DiasTempMin != ''){                 $a .= ",'".$CrossTech_DiasTempMin."'" ;              }else{$a .= ",''";}
				if(isset($CrossTech_TempMin) && $CrossTech_TempMin != ''){                         $a .= ",'".$CrossTech_TempMin."'" ;                  }else{$a .= ",''";}
				if(isset($CrossTech_TempMax) && $CrossTech_TempMax != ''){                         $a .= ",'".$CrossTech_TempMax."'" ;                  }else{$a .= ",''";}
				if(isset($CrossTech_FechaDiasTempMin) && $CrossTech_FechaDiasTempMin != ''){       $a .= ",'".$CrossTech_FechaDiasTempMin."'" ;         }else{$a .= ",''";}
				if(isset($CrossTech_FechaTempMin) && $CrossTech_FechaTempMin != ''){               $a .= ",'".$CrossTech_FechaTempMin."'" ;             }else{$a .= ",''";}
				if(isset($CrossTech_FechaTempMax) && $CrossTech_FechaTempMax != ''){               $a .= ",'".$CrossTech_FechaTempMax."'" ;             }else{$a .= ",''";}
				if(isset($CrossTech_FechaUnidadFrio) && $CrossTech_FechaUnidadFrio != ''){         $a .= ",'".$CrossTech_FechaUnidadFrio."'" ;          }else{$a .= ",''";}
				if(isset($CrossTech_HoraPrevRev) && $CrossTech_HoraPrevRev != ''){                 $a .= ",'".$CrossTech_HoraPrevRev."'" ;              }else{$a .= ",''";}
				if(isset($CrossTech_HoraPrevision) && $CrossTech_HoraPrevision != ''){             $a .= ",'".$CrossTech_HoraPrevision."'" ;            }else{$a .= ",''";}
				if(isset($CrossTech_HoraPrevCuenta) && $CrossTech_HoraPrevCuenta != ''){           $a .= ",'".$CrossTech_HoraPrevCuenta."'" ;           }else{$a .= ",''";}
				if(isset($CrossTech_HeladaTemp) && $CrossTech_HeladaTemp != ''){                   $a .= ",'".$CrossTech_HeladaTemp."'" ;               }else{$a .= ",''";}
				if(isset($CrossTech_HeladaMailHoraIni) && $CrossTech_HeladaMailHoraIni != ''){     $a .= ",'".$CrossTech_HeladaMailHoraIni."'" ;        }else{$a .= ",''";}
				if(isset($CrossTech_HeladaMailHoraTerm) && $CrossTech_HeladaMailHoraTerm != ''){   $a .= ",'".$CrossTech_HeladaMailHoraTerm."'" ;       }else{$a .= ",''";}
				if(isset($Social_idUso) && $Social_idUso != ''){                                   $a .= ",'".$Social_idUso."'" ;                       }else{$a .= ",''";}
				if(isset($Social_facebook) && $Social_facebook != ''){                             $a .= ",'".$Social_facebook."'" ;                    }else{$a .= ",''";}
				if(isset($Social_twitter) && $Social_twitter != ''){                               $a .= ",'".$Social_twitter."'" ;                     }else{$a .= ",''";}
				if(isset($Social_instagram) && $Social_instagram != ''){                           $a .= ",'".$Social_instagram."'" ;                   }else{$a .= ",''";}
				if(isset($Social_linkedin) && $Social_linkedin != ''){                             $a .= ",'".$Social_linkedin."'" ;                    }else{$a .= ",''";}
				if(isset($Social_rss) && $Social_rss != ''){                                       $a .= ",'".$Social_rss."'" ;                         }else{$a .= ",''";}
				if(isset($Social_youtube) && $Social_youtube != ''){                               $a .= ",'".$Social_youtube."'" ;                     }else{$a .= ",''";}
				if(isset($Social_tumblr) && $Social_tumblr != ''){                                 $a .= ",'".$Social_tumblr."'" ;                      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `core_sistemas` (Nombre, email_principal, Rut, idCiudad,idComuna, Direccion,
				CajaChica, Contacto_Nombre, Contacto_Fono1, Contacto_Fono2, Contacto_Fax, Contacto_Email, Contacto_Web, 
				Contrato_Nombre, Contrato_Numero, Contrato_Fecha, Contrato_Duracion, Config_IDGoogle,Config_Google_apiKey,
				Config_FCM_apiKey, Config_FCM_Main_apiKey, Config_imgLogo, Config_idTheme, Config_CorreoRespaldo, 
				Config_Gmail_Usuario, Config_Gmail_Password, Config_WhatsappToken, Config_WhatsappInstanceId, 
				idOpcionesGen_1, idOpcionesGen_2, idOpcionesGen_3, idOpcionesGen_4, idOpcionesGen_5, idOpcionesGen_6, 
				idOpcionesGen_7, idOpcionesGen_8, idOpcionesGen_9, idOpcionesGen_10, idOpcionesGen_11, idOpcionesGen_12, 
				idOpcionesGen_13, idOpcionesGen_14, idOpcionesGen_15, idOpcionesGen_16, idOpcionesGen_17, 
				idOpcionesGen_18, idOpcionesGen_19, idOpcionesGen_20, OT_idBodegaProd, OT_idBodegaIns, Rubro, idOpcionesTel, 
				idConfigRam, idConfigTime, idEstado, CrossTech_DiasTempMin, CrossTech_TempMin, CrossTech_TempMax,
				CrossTech_FechaDiasTempMin, CrossTech_FechaTempMin, CrossTech_FechaTempMax, CrossTech_FechaUnidadFrio,
				CrossTech_HoraPrevRev, CrossTech_HoraPrevision, CrossTech_HoraPrevCuenta, CrossTech_HeladaTemp,
				CrossTech_HeladaMailHoraIni, CrossTech_HeladaMailHoraTerm, Social_idUso, Social_facebook, Social_twitter,
				Social_instagram, Social_linkedin, Social_rss, Social_youtube, Social_tumblr) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
						
					header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
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
				
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'core_sistemas', '', "Nombre='".$Nombre."' AND idSistema!='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'core_sistemas', '', "Rut='".$Rut."' AND idSistema!='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idSistema='".$idSistema."'" ;
				if(isset($Nombre) && $Nombre != ''){                                               $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($email_principal) && $email_principal != ''){                             $a .= ",email_principal='".$email_principal."'" ;}
				if(isset($Rut) && $Rut != ''){                                                     $a .= ",Rut='".$Rut."'" ;}
				if(isset($idCiudad) && $idCiudad != ''){                                           $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna != ''){                                           $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Direccion) && $Direccion != ''){                                         $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($CajaChica) && $CajaChica != ''){                                         $a .= ",CajaChica='".$CajaChica."'" ;}
				if(isset($Contacto_Nombre) && $Contacto_Nombre != ''){                             $a .= ",Contacto_Nombre='".$Contacto_Nombre."'" ;}
				if(isset($Contacto_Fono1) && $Contacto_Fono1 != ''){                               $a .= ",Contacto_Fono1='".$Contacto_Fono1."'" ;}
				if(isset($Contacto_Fono2) && $Contacto_Fono2 != ''){                               $a .= ",Contacto_Fono2='".$Contacto_Fono2."'" ;}
				if(isset($Contacto_Fax) && $Contacto_Fax != ''){                                   $a .= ",Contacto_Fax='".$Contacto_Fax."'" ;}
				if(isset($Contacto_Email) && $Contacto_Email != ''){                               $a .= ",Contacto_Email='".$Contacto_Email."'" ;}
				if(isset($Contacto_Web) && $Contacto_Web != ''){                                   $a .= ",Contacto_Web='".$Contacto_Web."'" ;}
				if(isset($Contrato_Nombre) && $Contrato_Nombre != ''){                             $a .= ",Contrato_Nombre='".$Contrato_Nombre."'" ;}
				if(isset($Contrato_Numero) && $Contrato_Numero != ''){                             $a .= ",Contrato_Numero='".$Contrato_Numero."'" ;}
				if(isset($Contrato_Fecha) && $Contrato_Fecha != ''){                               $a .= ",Contrato_Fecha='".$Contrato_Fecha."'" ;}
				if(isset($Contrato_Duracion) && $Contrato_Duracion != ''){                         $a .= ",Contrato_Duracion='".$Contrato_Duracion."'" ;}
				if(isset($Config_IDGoogle) && $Config_IDGoogle != ''){                             $a .= ",Config_IDGoogle='".$Config_IDGoogle."'" ;}
				if(isset($Config_Google_apiKey) && $Config_Google_apiKey != ''){                   $a .= ",Config_Google_apiKey='".$Config_Google_apiKey."'" ;}
				if(isset($Config_FCM_apiKey) && $Config_FCM_apiKey != ''){                         $a .= ",Config_FCM_apiKey='".$Config_FCM_apiKey."'" ;}
				if(isset($Config_FCM_Main_apiKey) && $Config_FCM_Main_apiKey != ''){               $a .= ",Config_FCM_Main_apiKey='".$Config_FCM_Main_apiKey."'" ;}
				if(isset($Config_imgLogo) && $Config_imgLogo != ''){                               $a .= ",Config_imgLogo='".$Config_imgLogo."'" ;}
				if(isset($Config_idTheme) && $Config_idTheme != ''){                               $a .= ",Config_idTheme='".$Config_idTheme."'" ;}
				if(isset($Config_CorreoRespaldo) && $Config_CorreoRespaldo != ''){                 $a .= ",Config_CorreoRespaldo='".$Config_CorreoRespaldo."'" ;}
				if(isset($Config_Gmail_Usuario) && $Config_Gmail_Usuario != ''){                   $a .= ",Config_Gmail_Usuario='".$Config_Gmail_Usuario."'" ;}
				if(isset($Config_Gmail_Password) && $Config_Gmail_Password != ''){                 $a .= ",Config_Gmail_Password='".$Config_Gmail_Password."'" ;}
				if(isset($Config_WhatsappToken) && $Config_WhatsappToken != ''){                   $a .= ",Config_WhatsappToken='".$Config_WhatsappToken."'" ;}
				if(isset($Config_WhatsappInstanceId) && $Config_WhatsappInstanceId != ''){         $a .= ",Config_WhatsappInstanceId='".$Config_WhatsappInstanceId."'" ;}
				if(isset($idOpcionesGen_1) && $idOpcionesGen_1 != ''){                             $a .= ",idOpcionesGen_1='".$idOpcionesGen_1."'" ;}
				if(isset($idOpcionesGen_2) && $idOpcionesGen_2 != ''){                             $a .= ",idOpcionesGen_2='".$idOpcionesGen_2."'" ;}
				if(isset($idOpcionesGen_3) && $idOpcionesGen_3 != ''){                             $a .= ",idOpcionesGen_3='".$idOpcionesGen_3."'" ;}
				if(isset($idOpcionesGen_4) && $idOpcionesGen_4 != ''){                             $a .= ",idOpcionesGen_4='".$idOpcionesGen_4."'" ;}
				if(isset($idOpcionesGen_5) && $idOpcionesGen_5 != ''){                             $a .= ",idOpcionesGen_5='".$idOpcionesGen_5."'" ;}
				if(isset($idOpcionesGen_6) && $idOpcionesGen_6 != ''){                             $a .= ",idOpcionesGen_6='".$idOpcionesGen_6."'" ;}
				if(isset($idOpcionesGen_7) && $idOpcionesGen_7 != ''){                             $a .= ",idOpcionesGen_7='".$idOpcionesGen_7."'" ;}
				if(isset($idOpcionesGen_8) && $idOpcionesGen_8 != ''){                             $a .= ",idOpcionesGen_8='".$idOpcionesGen_8."'" ;}
				if(isset($idOpcionesGen_9) && $idOpcionesGen_9 != ''){                             $a .= ",idOpcionesGen_9='".$idOpcionesGen_9."'" ;}
				if(isset($idOpcionesGen_10) && $idOpcionesGen_10 != ''){                           $a .= ",idOpcionesGen_10='".$idOpcionesGen_10."'" ;}
				if(isset($idOpcionesGen_11) && $idOpcionesGen_11 != ''){                           $a .= ",idOpcionesGen_11='".$idOpcionesGen_11."'" ;}
				if(isset($idOpcionesGen_12) && $idOpcionesGen_12 != ''){                           $a .= ",idOpcionesGen_12='".$idOpcionesGen_12."'" ;}
				if(isset($idOpcionesGen_13) && $idOpcionesGen_13 != ''){                           $a .= ",idOpcionesGen_13='".$idOpcionesGen_13."'" ;}
				if(isset($idOpcionesGen_14) && $idOpcionesGen_14 != ''){                           $a .= ",idOpcionesGen_14='".$idOpcionesGen_14."'" ;}
				if(isset($idOpcionesGen_15) && $idOpcionesGen_15 != ''){                           $a .= ",idOpcionesGen_15='".$idOpcionesGen_15."'" ;}
				if(isset($idOpcionesGen_16) && $idOpcionesGen_16 != ''){                           $a .= ",idOpcionesGen_16='".$idOpcionesGen_16."'" ;}
				if(isset($idOpcionesGen_17) && $idOpcionesGen_17 != ''){                           $a .= ",idOpcionesGen_17='".$idOpcionesGen_17."'" ;}
				if(isset($idOpcionesGen_18) && $idOpcionesGen_18 != ''){                           $a .= ",idOpcionesGen_18='".$idOpcionesGen_18."'" ;}
				if(isset($idOpcionesGen_19) && $idOpcionesGen_19 != ''){                           $a .= ",idOpcionesGen_19='".$idOpcionesGen_19."'" ;}
				if(isset($idOpcionesGen_20) && $idOpcionesGen_20 != ''){                           $a .= ",idOpcionesGen_20='".$idOpcionesGen_20."'" ;}
				if(isset($OT_idBodegaProd) && $OT_idBodegaProd != ''){                             $a .= ",OT_idBodegaProd='".$OT_idBodegaProd."'" ;}
				if(isset($OT_idBodegaIns) && $OT_idBodegaIns != ''){                               $a .= ",OT_idBodegaIns='".$OT_idBodegaIns."'" ;}
				if(isset($Rubro) && $Rubro != ''){                                                 $a .= ",Rubro='".$Rubro."'" ;}
				if(isset($idOpcionesTel) && $idOpcionesTel != ''){                                 $a .= ",idOpcionesTel='".$idOpcionesTel."'" ;}
				if(isset($idConfigRam) && $idConfigRam != ''){                                     $a .= ",idConfigRam='".$idConfigRam."'" ;}
				if(isset($idConfigTime) && $idConfigTime != ''){                                   $a .= ",idConfigTime='".$idConfigTime."'" ;}
				if(isset($idEstado) && $idEstado != ''){                                           $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($CrossTech_DiasTempMin) && $CrossTech_DiasTempMin != ''){                 $a .= ",CrossTech_DiasTempMin='".$CrossTech_DiasTempMin."'" ;}
				if(isset($CrossTech_TempMin) && $CrossTech_TempMin != ''){                         $a .= ",CrossTech_TempMin='".$CrossTech_TempMin."'" ;}
				if(isset($CrossTech_TempMax) && $CrossTech_TempMax != ''){                         $a .= ",CrossTech_TempMax='".$CrossTech_TempMax."'" ;}
				if(isset($CrossTech_FechaDiasTempMin) && $CrossTech_FechaDiasTempMin != ''){       $a .= ",CrossTech_FechaDiasTempMin='".$CrossTech_FechaDiasTempMin."'" ;}
				if(isset($CrossTech_FechaTempMin) && $CrossTech_FechaTempMin != ''){               $a .= ",CrossTech_FechaTempMin='".$CrossTech_FechaTempMin."'" ;}
				if(isset($CrossTech_FechaTempMax) && $CrossTech_FechaTempMax != ''){               $a .= ",CrossTech_FechaTempMax='".$CrossTech_FechaTempMax."'" ;}
				if(isset($CrossTech_FechaUnidadFrio) && $CrossTech_FechaUnidadFrio != ''){         $a .= ",CrossTech_FechaUnidadFrio='".$CrossTech_FechaUnidadFrio."'" ;}
				if(isset($CrossTech_HoraPrevRev) && $CrossTech_HoraPrevRev != ''){                 $a .= ",CrossTech_HoraPrevRev='".$CrossTech_HoraPrevRev."'" ;}
				if(isset($CrossTech_HoraPrevision) && $CrossTech_HoraPrevision != ''){             $a .= ",CrossTech_HoraPrevision='".$CrossTech_HoraPrevision."'" ;}
				if(isset($CrossTech_HoraPrevCuenta) && $CrossTech_HoraPrevCuenta != ''){           $a .= ",CrossTech_HoraPrevCuenta='".$CrossTech_HoraPrevCuenta."'" ;}
				if(isset($CrossTech_HeladaTemp) && $CrossTech_HeladaTemp != ''){                   $a .= ",CrossTech_HeladaTemp='".$CrossTech_HeladaTemp."'" ;}
				if(isset($CrossTech_HeladaMailHoraIni) && $CrossTech_HeladaMailHoraIni != ''){     $a .= ",CrossTech_HeladaMailHoraIni='".$CrossTech_HeladaMailHoraIni."'" ;}
				if(isset($CrossTech_HeladaMailHoraTerm) && $CrossTech_HeladaMailHoraTerm != ''){   $a .= ",CrossTech_HeladaMailHoraTerm='".$CrossTech_HeladaMailHoraTerm."'" ;}
				if(isset($Social_idUso) && $Social_idUso != ''){                                   $a .= ",Social_idUso='".$Social_idUso."'" ;}
				if(isset($Social_facebook) ){                                                      $a .= ",Social_facebook='".$Social_facebook."'" ;}
				if(isset($Social_twitter) ){                                                       $a .= ",Social_twitter='".$Social_twitter."'" ;}
				if(isset($Social_instagram) ){                                                     $a .= ",Social_instagram='".$Social_instagram."'" ;}
				if(isset($Social_linkedin) ){                                                      $a .= ",Social_linkedin='".$Social_linkedin."'" ;}
				if(isset($Social_rss) ){                                                           $a .= ",Social_rss='".$Social_rss."'" ;}
				if(isset($Social_youtube) ){                                                       $a .= ",Social_youtube='".$Social_youtube."'" ;}
				if(isset($Social_tumblr) ){                                                        $a .= ",Social_tumblr='".$Social_tumblr."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'core_sistemas', 'idSistema = "'.$idSistema.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					//Si se ejecuta correctamente se actualizan los datos
					if(isset($Social_idUso) ){      $_SESSION['usuario']['basic_data']['Social_idUso'] = $Social_idUso;}
					if(isset($Social_facebook) ){   $_SESSION['usuario']['basic_data']['Social_facebook'] = $Social_facebook;}
					if(isset($Social_twitter) ){    $_SESSION['usuario']['basic_data']['Social_twitter'] = $Social_twitter;}
					if(isset($Social_instagram) ){  $_SESSION['usuario']['basic_data']['Social_instagram'] = $Social_instagram;}
					if(isset($Social_linkedin) ){   $_SESSION['usuario']['basic_data']['Social_linkedin'] = $Social_linkedin;}
					if(isset($Social_rss) ){        $_SESSION['usuario']['basic_data']['Social_rss'] = $Social_rss;}
					if(isset($Social_youtube) ){    $_SESSION['usuario']['basic_data']['Social_youtube'] = $Social_youtube;}
					if(isset($Social_tumblr) ){     $_SESSION['usuario']['basic_data']['Social_tumblr'] = $Social_tumblr;}
				
					//redirijo
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
				
				
			}
		
	
		break;	

						
/*******************************************************************************************************************/
		case 'del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['del']) OR !validaEntero($_GET['del']))&&$_GET['del']!=''){
				$indice = simpleDecode($_GET['del'], fecha_actual());
			}else{
				$indice = $_GET['del'];
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
				
			}
			
			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice)&&$indice!=''){ 
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){ 
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}
			
			if($errorn==0){
				// Se obtiene el nombre del logo
				$rowdata = db_select_data (false, 'Config_imgLogo', 'core_sistemas', '', 'idSistema = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				//se borran los datos
				$resultado = db_delete_data (false, 'core_sistemas', 'idSistema = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//se elimina el archivo
					if(isset($rowdata['Config_imgLogo'])&&$rowdata['Config_imgLogo']!=''){
						try {
							if(!is_writable('upload/'.$rowdata['Config_imgLogo'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$rowdata['Config_imgLogo']);
							}
						}catch(Exception $e) { 
							//guardar el dato en un archivo log
						}
					}
					
					//Redirijo			
					header( 'Location: '.$location.'&deleted=true' );
					die;
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			
			

		break;							
/*******************************************************************************************************************/
		case 'submit_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["Config_imgLogo"]["error"] > 0){
				$error['Config_imgLogo'] = 'error/'.uploadPHPError($_FILES["Config_imgLogo"]["error"]);
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 1000;
				//Sufijo
				$sufijo = 'logos_';
				  
				if (in_array($_FILES['Config_imgLogo']['type'], $permitidos) && $_FILES['Config_imgLogo']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['Config_imgLogo']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						//$move_result = @move_uploaded_file($_FILES["Config_imgLogo"]["tmp_name"], $ruta);
						//Muevo el archivo
						$move_result = @move_uploaded_file($_FILES["Config_imgLogo"]["tmp_name"], "upload/xxxsxx_".$_FILES['Config_imgLogo']['name']);
						
						if ($move_result){
							//se selecciona la imagen
							switch ($_FILES['Config_imgLogo']['type']) {
								case 'image/jpg':
									$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name']);
									break;
								case 'image/jpeg':
									$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name']);
									break;
								case 'image/gif':
									$imgBase = imagecreatefromgif('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name']);
									break;
								case 'image/png':
									$imgBase = imagecreatefrompng('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name']);
									break;
							}
								
							//se reescala la imagen en caso de ser necesario
							$imgBase_width = imagesx( $imgBase );
							$imgBase_height = imagesy( $imgBase );
								
							//Se establece el tamaño maximo
							$max_width  = 640;
							$max_height = 640;

							if ($imgBase_width > $imgBase_height) {
								if($imgBase_width < $max_width){
									$newwidth = $imgBase_width;
								}else{
									$newwidth = $max_width;	
								}
								$divisor = $imgBase_width / $newwidth;
								$newheight = floor( $imgBase_height / $divisor);
							}else {
								if($imgBase_height < $max_height){
									$newheight = $imgBase_height;
								}else{
									$newheight =  $max_height;
								} 
								$divisor = $imgBase_height / $newheight;
								$newwidth = floor( $imgBase_width / $divisor );
							}

							$imgBase = imagescale($imgBase, $newwidth, $newheight);

							//se establece la calidad del archivo
							$quality = 75;
								
							//se crea la imagen
							imagejpeg($imgBase, $ruta, $quality);
								
							//se elimina la imagen base
							try {
								if(!is_writable('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name'])){
									//throw new Exception('File not writable');
								}else{
									unlink('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name']);
								}
							}catch(Exception $e) { 
								//guardar el dato en un archivo log
							}
							//se eliminan las imagenes de la memoria
							imagedestroy($imgBase);
							
								
							//Filtro para idSistema
							if ( !empty($_POST['idSistema']) )    $idSistema       = $_POST['idSistema'];
									
							$a = "Config_imgLogo='".$sufijo.$_FILES['Config_imgLogo']['name']."'" ;

							/*******************************************************/
							//se actualizan los datos
							$resultado = db_update_data (false, $a, 'core_sistemas', 'idSistema = "'.$idSistema.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
							//Si ejecuto correctamente la consulta
							if($resultado==true){
								
								header( 'Location: '.$location.'&img_id='.$idSistema );
								die;
								
							}
									
						} else {
							$error['Config_imgLogo']       = 'error/Ocurrio un error al mover el archivo';
						}
					} else {
						$error['Config_imgLogo']       = 'error/El archivo '.$_FILES['Config_imgLogo']['name'].' ya existe';
					}
				} else {
					$error['Config_imgLogo']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}

		break;
/*******************************************************************************************************************/
		case 'del_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$rowdata = db_select_data (false, 'Config_imgLogo', 'core_sistemas', '', 'idSistema = "'.$_GET['del_img'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			/*******************************************************/
			//se actualizan los datos
			$a = "Config_imgLogo=''" ;
			$resultado = db_update_data (false, $a, 'core_sistemas', 'idSistema = "'.$_GET['del_img'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				
				//se elimina el archivo
				if(isset($rowdata['Config_imgLogo'])&&$rowdata['Config_imgLogo']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['Config_imgLogo'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['Config_imgLogo']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&img_id='.$_GET['del_img'] );
				die;
				
			}
			
			

		break;	
/*******************************************************************************************************************/
		case 'update_theme':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$idSistema       = $_GET['idSistema'];
			$Config_idTheme  = $_GET['idTheme'];
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idSistema='".$idSistema."'" ;
				if(isset($Config_idTheme) && $Config_idTheme != ''){    $a .= ",Config_idTheme='".$Config_idTheme."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'core_sistemas', 'idSistema = "'.$idSistema.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//Seteo la variable de sesion si existe
					if(isset($_SESSION['usuario']['basic_data']['Config_idTheme'])){
						$_SESSION['usuario']['basic_data']['Config_idTheme'] = $Config_idTheme;
					}
						
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
				
			}

		break;
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'sis_prod_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$id_sistema   = $_GET['id'];
			$idProducto   = $_GET['sis_prod_add'];
			$query  = "INSERT INTO `core_sistemas_productos` (idSistema, idProducto) 
			VALUES ('$id_sistema','$idProducto')";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&edited=true' );
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
		//borra un permiso del usuario
		case 'sis_prod_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['sis_prod_del']) OR !validaEntero($_GET['sis_prod_del']))&&$_GET['sis_prod_del']!=''){
				$indice = simpleDecode($_GET['sis_prod_del'], fecha_actual());
			}else{
				$indice = $_GET['sis_prod_del'];
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
				
			}
			
			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice)&&$indice!=''){ 
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){ 
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}
			
			if($errorn==0){
				//se borran los datos
				$resultado = db_delete_data (false, 'core_sistemas_productos', 'idSisProd = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//redirijo
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			
			
		break;	
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'sis_ins_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$id_sistema   = $_GET['id'];
			$idProducto   = $_GET['sis_ins_add'];
			$query  = "INSERT INTO `core_sistemas_insumos` (idSistema, idProducto) 
			VALUES ('$id_sistema','$idProducto')";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&edited=true' );
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
		//borra un permiso del usuario
		case 'sis_ins_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['sis_ins_del']) OR !validaEntero($_GET['sis_ins_del']))&&$_GET['sis_ins_del']!=''){
				$indice = simpleDecode($_GET['sis_ins_del'], fecha_actual());
			}else{
				$indice = $_GET['sis_ins_del'];
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
				
			}
			
			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice)&&$indice!=''){ 
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){ 
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}
			
			if($errorn==0){
				//se borran los datos
				$resultado = db_delete_data (false, 'core_sistemas_insumos', 'idSisProd = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//redirijo
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			
			
			
			
		break;	
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'sis_especie_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$id_sistema   = $_GET['id'];
			$idCategoria   = $_GET['sis_especie_add'];
			$query  = "INSERT INTO `core_sistemas_variedades_categorias` (idSistema, idCategoria) 
			VALUES ('$id_sistema','$idCategoria')";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&edited=true' );
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
		//borra un permiso del usuario
		case 'sis_especie_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['sis_especie_del']) OR !validaEntero($_GET['sis_especie_del']))&&$_GET['sis_especie_del']!=''){
				$indice = simpleDecode($_GET['sis_especie_del'], fecha_actual());
			}else{
				$indice = $_GET['sis_especie_del'];
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
				
			}
			
			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice)&&$indice!=''){ 
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){ 
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}
			
			if($errorn==0){
				/**************************/
				//Listado de productos
				$SIS_query = '
				variedades_listado.idProducto,
				(SELECT COUNT(idSisProd) FROM core_sistemas_variedades_listado WHERE idProducto = variedades_listado.idProducto AND idSistema = '.$_SESSION['usuario']['basic_data']['idSistema'].' LIMIT 1) AS contar,
				(SELECT idSisProd FROM core_sistemas_variedades_listado WHERE idProducto = variedades_listado.idProducto AND idSistema = '.$_SESSION['usuario']['basic_data']['idSistema'].' LIMIT 1) AS idpermiso';
				$SIS_join  = 'LEFT JOIN `variedades_listado` ON variedades_listado.idCategoria = core_sistemas_variedades_categorias.idCategoria';
				$SIS_where = 'core_sistemas_variedades_categorias.idSisProd = '.$indice.' AND variedades_listado.idEstado = 1';
				$SIS_order = 'core_sistemas_variedades_categorias.idSisProd ASC';
				$arrProductos = array();
				$arrProductos = db_select_array (false, $SIS_query, 'core_sistemas_variedades_categorias', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				
				/**************************/
				//elimino los productos relacionados a la categoria
				foreach ($arrProductos as $productos) {
					if ( isset($productos['contar'])&&$productos['contar']!='0' ) {
						$resultado = db_delete_data (false, 'core_sistemas_variedades_listado', 'idSisProd = "'.$productos['idpermiso'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					}
				}
				
				/**************************/
				//se borran los datos
				$resultado = db_delete_data (false, 'core_sistemas_variedades_categorias', 'idSisProd = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//redirijo
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			
			
			
		break;	
		
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'sis_variedad_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$id_sistema   = $_GET['id'];
			$idProducto   = $_GET['sis_variedad_add'];
			$query  = "INSERT INTO `core_sistemas_variedades_listado` (idSistema, idProducto) 
			VALUES ('$id_sistema','$idProducto')";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&edited=true' );
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
		//borra un permiso del usuario
		case 'sis_variedad_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['sis_variedad_del']) OR !validaEntero($_GET['sis_variedad_del']))&&$_GET['sis_variedad_del']!=''){
				$indice = simpleDecode($_GET['sis_variedad_del'], fecha_actual());
			}else{
				$indice = $_GET['sis_variedad_del'];
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
				
			}
			
			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice)&&$indice!=''){ 
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){ 
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}
			
			if($errorn==0){
				//se borran los datos
				$resultado = db_delete_data (false, 'core_sistemas_variedades_listado', 'idSisProd = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//redirijo
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			

			
		break;	
/*******************************************************************************************************************/
		//Cambio el estado de activo a inactivo
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idSistema  = $_GET['id'];
			$idEstado   = simpleDecode($_GET['estado'], fecha_actual());
			/*******************************************************/
			//se actualizan los datos
			$a = "idEstado='".$idEstado."'" ;
			$resultado = db_update_data (false, $a, 'core_sistemas', 'idSistema = "'.$idSistema.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				
				header( 'Location: '.$location.'&edited=true' );
				die; 
				
			}

		break;
/*******************************************************************************************************************/		
		case 'updateCrossTech':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idSistema='".$idSistema."'" ;
				if(isset($CrossTech_DiasTempMin) && $CrossTech_DiasTempMin != ''){                 $a .= ",CrossTech_DiasTempMin='".$CrossTech_DiasTempMin."'" ;}
				if(isset($CrossTech_TempMin) && $CrossTech_TempMin != ''){                         $a .= ",CrossTech_TempMin='".$CrossTech_TempMin."'" ;}
				if(isset($CrossTech_TempMax) && $CrossTech_TempMax != ''){                         $a .= ",CrossTech_TempMax='".$CrossTech_TempMax."'" ;}
				if(isset($CrossTech_HoraPrevRev) && $CrossTech_HoraPrevRev != ''){                 $a .= ",CrossTech_HoraPrevRev='".$CrossTech_HoraPrevRev."'" ;}
				if(isset($CrossTech_HoraPrevision) && $CrossTech_HoraPrevision != ''){             $a .= ",CrossTech_HoraPrevision='".$CrossTech_HoraPrevision."'" ;}
				if(isset($CrossTech_HoraPrevCuenta) && $CrossTech_HoraPrevCuenta != ''){           $a .= ",CrossTech_HoraPrevCuenta='".$CrossTech_HoraPrevCuenta."'" ;}
				if(isset($CrossTech_HeladaTemp) && $CrossTech_HeladaTemp != ''){                   $a .= ",CrossTech_HeladaTemp='".$CrossTech_HeladaTemp."'" ;}
				if(isset($CrossTech_HeladaMailHoraIni) && $CrossTech_HeladaMailHoraIni != ''){     $a .= ",CrossTech_HeladaMailHoraIni='".$CrossTech_HeladaMailHoraIni."'" ;}
				if(isset($CrossTech_HeladaMailHoraTerm) && $CrossTech_HeladaMailHoraTerm != ''){   $a .= ",CrossTech_HeladaMailHoraTerm='".$CrossTech_HeladaMailHoraTerm."'" ;}
				
				if(isset($CrossTech_FechaDiasTempMin) && $CrossTech_FechaDiasTempMin != ''&&isset($CrossTech_FechaDiasTempMinOld) && $CrossTech_FechaDiasTempMinOld != ''&&$CrossTech_FechaDiasTempMin != $CrossTech_FechaDiasTempMinOld ){   
					$a .= ",CrossTech_FechaDiasTempMin='".$CrossTech_FechaDiasTempMin."'" ;
				}
				if(isset($CrossTech_FechaTempMin) && $CrossTech_FechaTempMin != ''&&isset($CrossTech_FechaTempMinOld) && $CrossTech_FechaTempMinOld != ''&&$CrossTech_FechaTempMin != $CrossTech_FechaTempMinOld ){   
					$a .= ",CrossTech_FechaTempMin='".$CrossTech_FechaTempMin."'" ;
				}
				if(isset($CrossTech_FechaTempMax) && $CrossTech_FechaTempMax != ''&&isset($CrossTech_FechaTempMaxOld) && $CrossTech_FechaTempMaxOld != ''&&$CrossTech_FechaTempMax != $CrossTech_FechaTempMaxOld){   
					$a .= ",CrossTech_FechaTempMax='".$CrossTech_FechaTempMax."'" ;
				}
				if(isset($CrossTech_FechaUnidadFrio) && $CrossTech_FechaUnidadFrio != ''&&isset($CrossTech_FechaUnidadFrioOld) && $CrossTech_FechaUnidadFrioOld != ''&&$CrossTech_FechaUnidadFrio != $CrossTech_FechaUnidadFrioOld){   
					$a .= ",CrossTech_FechaUnidadFrio='".$CrossTech_FechaUnidadFrio."'" ;
				}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'core_sistemas', 'idSistema = "'.$idSistema.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					/*************************************************************/
					//se trae el ultimo registro
					$rowAux = db_select_data (false, 'idAuxiliar', 'telemetria_listado_aux', '', 'idSistema = "'.$idSistema.'" ORDER BY idAuxiliar DESC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
					/*************************************************************/
					//se actualiza el dato si existe registro
					if(isset($rowAux['idAuxiliar'])&&$rowAux['idAuxiliar']!=''){
						$a = "idAuxiliar='".$rowAux['idAuxiliar']."'" ;
						if(isset($CrossTech_DiasTempMin) && $CrossTech_DiasTempMin != ''){     $a .= ",CrossTech_DiasTempMin='".$CrossTech_DiasTempMin."'" ;}
						if(isset($CrossTech_TempMin) && $CrossTech_TempMin != ''){             $a .= ",CrossTech_TempMin='".$CrossTech_TempMin."'" ;}
						if(isset($CrossTech_TempMax) && $CrossTech_TempMax != ''){             $a .= ",CrossTech_TempMax='".$CrossTech_TempMax."'" ;}
						if(isset($CrossTech_FechaDiasTempMin) && $CrossTech_FechaDiasTempMin != ''&&isset($CrossTech_FechaDiasTempMinOld) && $CrossTech_FechaDiasTempMinOld != ''&&$CrossTech_FechaDiasTempMin != $CrossTech_FechaDiasTempMinOld ){   
							$a .= ",CrossTech_FechaDiasTempMin='".$CrossTech_FechaDiasTempMin."'" ;
							$a .= ",Dias_acumulado='0'" ;
						}
						if(isset($CrossTech_FechaTempMin) && $CrossTech_FechaTempMin != ''&&isset($CrossTech_FechaTempMinOld) && $CrossTech_FechaTempMinOld != ''&&$CrossTech_FechaTempMin != $CrossTech_FechaTempMinOld ){   
							$a .= ",CrossTech_FechaTempMin='".$CrossTech_FechaTempMin."'" ;
							$a .= ",HorasBajoGrados='0'" ;
						}
						if(isset($CrossTech_FechaTempMax) && $CrossTech_FechaTempMax != ''&&isset($CrossTech_FechaTempMaxOld) && $CrossTech_FechaTempMaxOld != ''&&$CrossTech_FechaTempMax != $CrossTech_FechaTempMaxOld){   
							$a .= ",CrossTech_FechaTempMax='".$CrossTech_FechaTempMax."'" ;
							$a .= ",HorasSobreGrados='0'" ;
						}
						if(isset($CrossTech_FechaUnidadFrio) && $CrossTech_FechaUnidadFrio != ''&&isset($CrossTech_FechaUnidadFrioOld) && $CrossTech_FechaUnidadFrioOld != ''&&$CrossTech_FechaUnidadFrio != $CrossTech_FechaUnidadFrioOld){   
							$a .= ",CrossTech_FechaUnidadFrio='".$CrossTech_FechaUnidadFrio."'" ;
							$a .= ",UnidadesFrio='0'" ;
						}
						
						/*******************************************************/
						//se actualizan los datos
						$resultado = db_update_data (false, $a, 'telemetria_listado_aux', 'idAuxiliar = "'.$rowAux['idAuxiliar'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
						
						//redirijo
						header( 'Location: '.$location.'&edited=true' );
						die;
					//se crea el dato en caso de no existir
					}else{
						
						//Variables
						$HoraSistema    = hora_actual(); 
						$FechaSistema   = fecha_actual();
						$TimeStamp      = fecha_actual().' '.hora_actual();
	
						//filtros
						$a  = "'".$idSistema."'" ; 
						$a .= ",'".$FechaSistema."'" ;
						$a .= ",'".$HoraSistema."'" ;
						$a .= ",'".$TimeStamp."'" ;   
						if(isset($CrossTech_DiasTempMin) && $CrossTech_DiasTempMin != ''){               $a .= ",'".$CrossTech_DiasTempMin."'" ;       }else{$a .= ",''" ;}
						if(isset($CrossTech_TempMin) && $CrossTech_TempMin != ''){                       $a .= ",'".$CrossTech_TempMin."'" ;           }else{$a .= ",''" ;}
						if(isset($CrossTech_TempMax) && $CrossTech_TempMax != ''){                       $a .= ",'".$CrossTech_TempMax."'" ;           }else{$a .= ",''" ;}
						if(isset($CrossTech_FechaDiasTempMin) && $CrossTech_FechaDiasTempMin != ''){     $a .= ",'".$CrossTech_FechaDiasTempMin."'" ;  }else{$a .= ",''" ;}
						if(isset($CrossTech_FechaTempMin) && $CrossTech_FechaTempMin != ''){             $a .= ",'".$CrossTech_FechaTempMin."'" ;      }else{$a .= ",''" ;}
						if(isset($CrossTech_FechaTempMax) && $CrossTech_FechaTempMax != ''){             $a .= ",'".$CrossTech_FechaTempMax."'" ;      }else{$a .= ",''" ;}
						if(isset($CrossTech_FechaUnidadFrio) && $CrossTech_FechaUnidadFrio != ''){       $a .= ",'".$CrossTech_FechaUnidadFrio."'" ;   }else{$a .= ",''" ;}
						
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `telemetria_listado_aux` (idSistema, Fecha, Hora, TimeStamp, 
						CrossTech_DiasTempMin, CrossTech_TempMin, CrossTech_TempMax, CrossTech_FechaDiasTempMin, 
						CrossTech_FechaTempMin, CrossTech_FechaTempMax, CrossTech_FechaUnidadFrio) 
						VALUES (".$a.")";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);
						
						//redirijo
						header( 'Location: '.$location.'&edited=true' );
						die;
					}
				}
			}
		
	
		break;	

/*******************************************************************************************************************/
	}
?>
