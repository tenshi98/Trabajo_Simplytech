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

	//Variable de configuracion de la cantidad maxima de sensores
	$N_Maximo_Sensores = 72;


	//Traspaso de valores input a variables
	if ( !empty($_POST['idTelemetria']) )                      $idTelemetria                       = $_POST['idTelemetria'];
	if ( !empty($_POST['idSistema']) )                         $idSistema                          = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )                          $idEstado                           = $_POST['idEstado'];
	if ( !empty($_POST['Identificador']) )                     $Identificador                      = $_POST['Identificador'];
	if ( !empty($_POST['Nombre']) )                            $Nombre                             = $_POST['Nombre'];
	if ( !empty($_POST['idCiudad']) )                          $idCiudad                           = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )                          $idComuna                           = $_POST['idComuna'];
	if ( !empty($_POST['Direccion']) )                         $Direccion                          = $_POST['Direccion'];
	if ( !empty($_POST['GeoLatitud']) )                        $GeoLatitud                         = $_POST['GeoLatitud'];
	if ( !empty($_POST['GeoLongitud']) )                       $GeoLongitud                        = $_POST['GeoLongitud'];
	if ( !empty($_POST['GeoVelocidad']) )                      $GeoVelocidad                       = $_POST['GeoVelocidad'];
	if ( !empty($_POST['GeoDireccion']) )                      $GeoDireccion                       = $_POST['GeoDireccion'];
	if ( !empty($_POST['GeoMovimiento']) )                     $GeoMovimiento                      = $_POST['GeoMovimiento'];
	if ( !empty($_POST['GeoTiempoDetencion']) )                $GeoTiempoDetencion                 = $_POST['GeoTiempoDetencion'];
	if ( !empty($_POST['LastUpdateFecha']) )                   $LastUpdateFecha                    = $_POST['LastUpdateFecha'];
	if ( !empty($_POST['LastUpdateHora']) )                    $LastUpdateHora                     = $_POST['LastUpdateHora'];
	if ( !empty($_POST['id_Geo']) )                            $id_Geo                             = $_POST['id_Geo'];
	if ( !empty($_POST['id_Sensores']) )                       $id_Sensores                        = $_POST['id_Sensores'];
	if ( !empty($_POST['cantSensores']) )                      $cantSensores                       = $_POST['cantSensores'];
	if ( !empty($_POST['idDispositivo']) )                     $idDispositivo                      = $_POST['idDispositivo'];
	if ( isset($_POST['idShield']) )                           $idShield                           = $_POST['idShield'];
	if ( !empty($_POST['idGenerador']) )                       $idGenerador                        = $_POST['idGenerador'];
	if ( !empty($_POST['Sim_Num_Tel']) )                       $Sim_Num_Tel                        = $_POST['Sim_Num_Tel'];
	if ( !empty($_POST['Sim_Num_Serie']) )                     $Sim_Num_Serie                      = $_POST['Sim_Num_Serie'];
	if ( !empty($_POST['Sim_modelo']) )                        $Sim_modelo                         = $_POST['Sim_modelo'];
	if ( !empty($_POST['Sim_marca']) )                         $Sim_marca                          = $_POST['Sim_marca'];
	if ( !empty($_POST['Sim_Compania']) )                      $Sim_Compania                       = $_POST['Sim_Compania'];
	if ( !empty($_POST['tabla_relacionada']) )                 $tabla_relacionada                  = $_POST['tabla_relacionada'];
	if ( !empty($_POST['idEstadoEncendido']) )                 $idEstadoEncendido                  = $_POST['idEstadoEncendido'];
	if ( !empty($_POST['LimiteVelocidad']) )                   $LimiteVelocidad                    = $_POST['LimiteVelocidad'];
	if ( !empty($_POST['idAlarmaGeneral']) )                   $idAlarmaGeneral                    = $_POST['idAlarmaGeneral'];
	if ( isset($_POST['IdentificadorEmpresa']) )               $IdentificadorEmpresa               = $_POST['IdentificadorEmpresa'];
	if ( !empty($_POST['NDetenciones']) )                      $NDetenciones                       = $_POST['NDetenciones'];
	if ( !empty($_POST['TiempoFueraLinea']) )                  $TiempoFueraLinea                   = $_POST['TiempoFueraLinea'];
	if ( !empty($_POST['TiempoDetencion']) )                   $TiempoDetencion                    = $_POST['TiempoDetencion'];
	if ( !empty($_POST['idZona']) )                            $idZona                             = $_POST['idZona'];
	if ( !empty($_POST['IP_Client']) )                         $IP_Client                          = $_POST['SensorActivacionID'];
	if ( !empty($_POST['SensorActivacionID']) )                $SensorActivacionID                 = $_POST['SensorActivacionID'];
	if ( isset($_POST['SensorActivacionValor']) )              $SensorActivacionValor              = $_POST['SensorActivacionValor'];
	if ( !empty($_POST['Jornada_inicio']) )                    $Jornada_inicio                     = $_POST['Jornada_inicio'];
	if ( !empty($_POST['Jornada_termino']) )                   $Jornada_termino                    = $_POST['Jornada_termino'];
	if ( !empty($_POST['Colacion_inicio']) )                   $Colacion_inicio                    = $_POST['Colacion_inicio'];
	if ( !empty($_POST['Colacion_termino']) )                  $Colacion_termino                   = $_POST['Colacion_termino'];
	if ( !empty($_POST['Microparada']) )                       $Microparada                        = $_POST['Microparada'];
	if ( !empty($_POST['idUsoContrato']) )                     $idUsoContrato                      = $_POST['idUsoContrato'];
	if ( !empty($_POST['idContrato']) )                        $idContrato                         = $_POST['idContrato'];
	if ( !empty($_POST['Codigo']) )                            $Codigo                             = $_POST['Codigo'];
	if ( !empty($_POST['F_Inicio']) )                          $F_Inicio                           = $_POST['F_Inicio'];
	if ( !empty($_POST['F_Termino']) )                         $F_Termino                          = $_POST['F_Termino'];
	if ( !empty($_POST['idUsoPredio']) )                       $idUsoPredio                        = $_POST['idUsoPredio'];
	if ( !empty($_POST['idUsoGeocerca']) )                     $idUsoGeocerca                      = $_POST['idUsoGeocerca'];
	if ( !empty($_POST['NErroresGeocercaMax']) )               $NErroresGeocercaMax                = $_POST['NErroresGeocercaMax'];
	if ( !empty($_POST['idTipo']) )                            $idTipo                             = $_POST['idTipo'];
	if ( !empty($_POST['Marca']) )                             $Marca                              = $_POST['Marca'];
	if ( !empty($_POST['Modelo']) )                            $Modelo                             = $_POST['Modelo'];
	if ( !empty($_POST['Patente']) )                           $Patente                            = $_POST['Patente'];
	if ( !empty($_POST['Num_serie']) )                         $Num_serie                          = $_POST['Num_serie'];
	if ( !empty($_POST['AnoFab']) )                            $AnoFab                             = $_POST['AnoFab'];
	if ( !empty($_POST['CapacidadPersonas']) )                 $CapacidadPersonas                  = $_POST['CapacidadPersonas'];
	if ( !empty($_POST['CapacidadKilos']) )                    $CapacidadKilos                     = $_POST['CapacidadKilos'];
	if ( !empty($_POST['MCubicos']) )                          $MCubicos                           = $_POST['MCubicos'];
	if ( !empty($_POST['idTab']) )                             $idTab                              = $_POST['idTab'];
	if ( !empty($_POST['idMantencion']) )                      $idMantencion                       = $_POST['idMantencion'];
	if ( !empty($_POST['idUsuarioMan']) )                      $idUsuarioMan                       = $_POST['idUsuarioMan'];
	if ( !empty($_POST['idMatriz']) )                          $idMatriz                           = $_POST['idMatriz'];
	if ( !empty($_POST['CrossCrane_tiempo_revision']) )        $CrossCrane_tiempo_revision         = $_POST['CrossCrane_tiempo_revision'];
	if ( !empty($_POST['CrossCrane_grupo_amperaje']) )         $CrossCrane_grupo_amperaje          = $_POST['CrossCrane_grupo_amperaje'];
	if ( !empty($_POST['CrossCrane_grupo_elevacion']) )        $CrossCrane_grupo_elevacion         = $_POST['CrossCrane_grupo_elevacion'];
	if ( !empty($_POST['CrossCrane_grupo_giro']) )             $CrossCrane_grupo_giro              = $_POST['CrossCrane_grupo_giro'];
	if ( !empty($_POST['CrossCrane_grupo_carro']) )            $CrossCrane_grupo_carro             = $_POST['CrossCrane_grupo_carro'];
	if ( !empty($_POST['CrossCrane_grupo_voltaje']) )          $CrossCrane_grupo_voltaje           = $_POST['CrossCrane_grupo_voltaje'];
	if ( !empty($_POST['CrossCrane_grupo_motor_subida']) )     $CrossCrane_grupo_motor_subida      = $_POST['CrossCrane_grupo_motor_subida'];
	if ( !empty($_POST['CrossCrane_grupo_motor_bajada']) )     $CrossCrane_grupo_motor_bajada      = $_POST['CrossCrane_grupo_motor_bajada'];
	if ( !empty($_POST['FechaMantencionIni']) )                $FechaMantencionIni                 = $_POST['FechaMantencionIni'];
	if ( !empty($_POST['FechaMantencionTer']) )                $FechaMantencionTer                 = $_POST['FechaMantencionTer'];
	if ( !empty($_POST['HoraMantencionIni']) )                 $HoraMantencionIni                  = $_POST['HoraMantencionIni'];
	if ( !empty($_POST['HoraMantencionTer']) )                 $HoraMantencionTer                  = $_POST['HoraMantencionTer'];
	if ( !empty($_POST['Hor_idActivo_dia1']) )                 $Hor_idActivo_dia1                  = $_POST['Hor_idActivo_dia1'];
	if ( !empty($_POST['Hor_idActivo_dia2']) )                 $Hor_idActivo_dia2                  = $_POST['Hor_idActivo_dia2'];
	if ( !empty($_POST['Hor_idActivo_dia3']) )                 $Hor_idActivo_dia3                  = $_POST['Hor_idActivo_dia3'];
	if ( !empty($_POST['Hor_idActivo_dia4']) )                 $Hor_idActivo_dia4                  = $_POST['Hor_idActivo_dia4'];
	if ( !empty($_POST['Hor_idActivo_dia5']) )                 $Hor_idActivo_dia5                  = $_POST['Hor_idActivo_dia5'];
	if ( !empty($_POST['Hor_idActivo_dia6']) )                 $Hor_idActivo_dia6                  = $_POST['Hor_idActivo_dia6'];
	if ( !empty($_POST['Hor_idActivo_dia7']) )                 $Hor_idActivo_dia7                  = $_POST['Hor_idActivo_dia7'];
	if ( !empty($_POST['Hor_Inicio_dia1']) )                   $Hor_Inicio_dia1                    = $_POST['Hor_Inicio_dia1'];
	if ( !empty($_POST['Hor_Inicio_dia2']) )                   $Hor_Inicio_dia2                    = $_POST['Hor_Inicio_dia2'];
	if ( !empty($_POST['Hor_Inicio_dia3']) )                   $Hor_Inicio_dia3                    = $_POST['Hor_Inicio_dia3'];
	if ( !empty($_POST['Hor_Inicio_dia4']) )                   $Hor_Inicio_dia4                    = $_POST['Hor_Inicio_dia4'];
	if ( !empty($_POST['Hor_Inicio_dia5']) )                   $Hor_Inicio_dia5                    = $_POST['Hor_Inicio_dia5'];
	if ( !empty($_POST['Hor_Inicio_dia6']) )                   $Hor_Inicio_dia6                    = $_POST['Hor_Inicio_dia6'];
	if ( !empty($_POST['Hor_Inicio_dia7']) )                   $Hor_Inicio_dia7                    = $_POST['Hor_Inicio_dia7'];
	if ( !empty($_POST['Hor_Termino_dia1']) )                  $Hor_Termino_dia1                   = $_POST['Hor_Termino_dia1'];
	if ( !empty($_POST['Hor_Termino_dia2']) )                  $Hor_Termino_dia2                   = $_POST['Hor_Termino_dia2'];
	if ( !empty($_POST['Hor_Termino_dia3']) )                  $Hor_Termino_dia3                   = $_POST['Hor_Termino_dia3'];
	if ( !empty($_POST['Hor_Termino_dia4']) )                  $Hor_Termino_dia4                   = $_POST['Hor_Termino_dia4'];
	if ( !empty($_POST['Hor_Termino_dia5']) )                  $Hor_Termino_dia5                   = $_POST['Hor_Termino_dia5'];
	if ( !empty($_POST['Hor_Termino_dia6']) )                  $Hor_Termino_dia6                   = $_POST['Hor_Termino_dia6'];
	if ( !empty($_POST['Hor_Termino_dia7']) )                  $Hor_Termino_dia7                   = $_POST['Hor_Termino_dia7'];
	if ( !empty($_POST['Observacion']) )                       $Observacion                        = $_POST['Observacion'];
	if ( !empty($_POST['SensoresFechaUso_Fake']) )             $SensoresFechaUso_Fake              = $_POST['SensoresFechaUso_Fake'];
	if ( !empty($_POST['Capacidad']) )                         $Capacidad                          = $_POST['Capacidad'];
	if ( !empty($_POST['idBackup']) )                          $idBackup                           = $_POST['idBackup'];
	if ( !empty($_POST['NregBackup']) )                        $NregBackup                         = $_POST['NregBackup'];
	if ( !empty($_POST['idAlertaTemprana']) )                  $idAlertaTemprana                   = $_POST['idAlertaTemprana'];
	if ( !empty($_POST['idUsoFTP']) )                          $idUsoFTP                           = $_POST['idUsoFTP'];
	if ( !empty($_POST['FTP_Carpeta']) )                       $FTP_Carpeta                        = $_POST['FTP_Carpeta'];
	
	//Recorro la configuracion de los sensores
	for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
		if ( !empty($_POST['SensoresNombre_'.$i]) )            $SensoresNombre[$i]         = $_POST['SensoresNombre_'.$i];
		if ( !empty($_POST['SensoresTipo_'.$i]) )              $SensoresTipo[$i]           = $_POST['SensoresTipo_'.$i];
		if ( isset($_POST['SensoresMedMin_'.$i]) )             $SensoresMedMin[$i]         = $_POST['SensoresMedMin_'.$i];
		if ( isset($_POST['SensoresMedMax_'.$i]) )             $SensoresMedMax[$i]         = $_POST['SensoresMedMax_'.$i];
		if ( isset($_POST['SensoresMedErrores_'.$i]) )         $SensoresMedErrores_1[$i]   = $_POST['SensoresMedErrores_'.$i];
		if ( !empty($_POST['SensoresGrupo_'.$i]) )             $SensoresGrupo[$i]          = $_POST['SensoresGrupo_'.$i];
		if ( !empty($_POST['SensoresUniMed_'.$i]) )            $SensoresUniMed[$i]         = $_POST['SensoresUniMed_'.$i];
		if ( !empty($_POST['SensoresActivo_'.$i]) )            $SensoresActivo[$i]         = $_POST['SensoresActivo_'.$i];
		if ( !empty($_POST['SensoresUso_'.$i]) )               $SensoresUso[$i]            = $_POST['SensoresUso_'.$i];
		if ( !empty($_POST['SensoresFechaUso_'.$i]) )          $SensoresFechaUso[$i]       = $_POST['SensoresFechaUso_'.$i];
		if ( !empty($_POST['SensoresAccionC_'.$i]) )           $SensoresAccionC[$i]        = $_POST['SensoresAccionC_'.$i];
		if ( !empty($_POST['SensoresAccionT_'.$i]) )           $SensoresAccionT[$i]        = $_POST['SensoresAccionT_'.$i];
		if ( !empty($_POST['SensoresAccionAlerta_'.$i]) )      $SensoresAccionAlerta[$i]   = $_POST['SensoresAccionAlerta_'.$i];
		if ( !empty($_POST['SensoresRevision_'.$i]) )          $SensoresRevision[$i]       = $_POST['SensoresRevision_'.$i];
		if ( !empty($_POST['SensoresRevisionGrupo_'.$i]) )     $SensoresRevisionGrupo[$i]  = $_POST['SensoresRevisionGrupo_'.$i];
	}
	
	
	
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
			case 'idTelemetria':                      if(empty($idTelemetria)){                      $error['idTelemetria']                  = 'error/No ha ingresado el id';}break;
			case 'idSistema':                         if(empty($idSistema)){                         $error['idSistema']                     = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':                          if(empty($idEstado)){                          $error['idEstado']                      = 'error/No ha seleccionado el estado';}break;
			case 'Identificador':                     if(empty($Identificador)){                     $error['Identificador']                 = 'error/No ha ingresado el identificador';}break;
			case 'Nombre':                            if(empty($Nombre)){                            $error['Nombre']                        = 'error/No ha ingresado el nombre';}break;
			case 'idCiudad':                          if(empty($idCiudad)){                          $error['idCiudad']                      = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':                          if(empty($idComuna)){                          $error['idComuna']                      = 'error/No ha seleccionado la comuna';}break;
			case 'Direccion':                         if(empty($Direccion)){                         $error['Direccion']                     = 'error/No ha ingresado la direccion';}break;
			case 'GeoLatitud':                        if(empty($GeoLatitud)){                        $error['GeoLatitud']                    = 'error/No ha ingresado la latitud';}break;
			case 'GeoVelocidad':                      if(empty($GeoVelocidad)){                      $error['GeoVelocidad']                  = 'error/No ha ingresado la velocidad';}break;
			case 'GeoDireccion':                      if(empty($GeoDireccion)){                      $error['GeoDireccion']                  = 'error/No ha ingresado la direccion';}break;
			case 'GeoMovimiento':                     if(empty($GeoMovimiento)){                     $error['GeoMovimiento']                 = 'error/No ha ingresado el movimiento';}break;
			case 'GeoTiempoDetencion':                if(empty($GeoTiempoDetencion)){                $error['GeoTiempoDetencion']            = 'error/No ha ingresado el tiempo de detencion';}break;
			case 'LastUpdateFecha':                   if(empty($LastUpdateFecha)){                   $error['LastUpdateFecha']               = 'error/No ha ingresado la fecha de actualizacion';}break;
			case 'LastUpdateHora':                    if(empty($LastUpdateHora)){                    $error['LastUpdateHora']                = 'error/No ha ingresado la hora de actualizacion';}break;
			case 'id_Geo':                            if(empty($id_Geo)){                            $error['id_Geo']                        = 'error/No ha seleccionado la geolocalizacion';}break;
			case 'id_Sensores':                       if(empty($id_Sensores)){                       $error['id_Sensores']                   = 'error/No ha seleccionado los sensores';}break;
			case 'cantSensores':                      if(empty($cantSensores)){                      $error['cantSensores']                  = 'error/No ha ingresado la cantidad de sensores';}break;
			case 'idDispositivo':                     if(empty($idDispositivo)){                     $error['idDispositivo']                 = 'error/No ha seleccionado el dispositivo';}break;
			case 'idShield':                          if(!isset($idShield)){                         $error['idShield']                      = 'error/No ha seleccionado la placa shield';}break;
			case 'idGenerador':                       if(!isset($idGenerador)){                      $error['idGenerador']                   = 'error/No ha seleccionado la opcion de uso de generador';}break;
			case 'Sim_Num_Tel':                       if(empty($Sim_Num_Tel)){                       $error['Sim_Num_Tel']                   = 'error/No ha ingresado el numero telefonico de la SIM';}break;
			case 'Sim_Num_Serie':                     if(empty($Sim_Num_Serie)){                     $error['Sim_Num_Serie']                 = 'error/No ha ingresado el numero de serie de la SIM';}break;
			case 'Sim_marca':                         if(empty($Sim_marca)){                         $error['Sim_marca']                     = 'error/No ha seleccionado la bodega';}break;
			case 'Sim_modelo':                        if(empty($Sim_modelo)){                        $error['Sim_modelo']                    = 'error/No ha seleccionado la ruta';}break;
			case 'Sim_Compania':                      if(empty($Sim_Compania)){                      $error['Sim_Compania']                  = 'error/No ha seleccionado al trabajador';}break;
			case 'tabla_relacionada':                 if(empty($tabla_relacionada)){                 $error['tabla_relacionada']             = 'error/No ha ingresado la tabla relacionada';}break;
			case 'LimiteVelocidad':                   if(empty($LimiteVelocidad)){                   $error['LimiteVelocidad']               = 'error/No ha ingresado el limite de velocidad';}break;
			case 'idAlarmaGeneral':                   if(empty($idAlarmaGeneral)){                   $error['idAlarmaGeneral']               = 'error/No ha seleccionado la alrama general';}break;
			case 'IdentificadorEmpresa':              if(!isset($IdentificadorEmpresa)){             $error['IdentificadorEmpresa']          = 'error/No ha ingresado el identificador de la empresa';}break;
			case 'NDetenciones':                      if(empty($NDetenciones)){                      $error['NDetenciones']                  = 'error/No ha ingresado el numero de detenciones';}break;
			case 'TiempoFueraLinea':                  if(empty($TiempoFueraLinea)){                  $error['TiempoFueraLinea']              = 'error/No ha ingresado el tiempo fuera de linea';}break;
			case 'TiempoDetencion':                   if(empty($TiempoDetencion)){                   $error['TiempoDetencion']               = 'error/No ha ingresado el tiempo de detencion';}break;
			case 'idZona':                            if(empty($idZona)){                            $error['idZona']                        = 'error/No ha seleccionado la zona';}break;
			case 'IP_Client':                         if(empty($IP_Client)){                         $error['IP_Client']                     = 'error/No ha ingresado el IP del cliente';}break;
			case 'SensorActivacionID':                if(empty($SensorActivacionID)){                $error['SensorActivacionID']            = 'error/No ha seleccionado el sensor de activacion';}break;
			case 'SensorActivacionValor':             if(!isset($SensorActivacionValor)){            $error['SensorActivacionValor']         = 'error/No ha ingresado el valor del sensor de activacion';}break;
			case 'Jornada_inicio':                    if(empty($Jornada_inicio)){                    $error['Jornada_inicio']                = 'error/No ha ingresado la hora de inicio de la jornada de trabajo';}break;
			case 'Jornada_termino':                   if(empty($Jornada_termino)){                   $error['Jornada_termino']               = 'error/No ha ingresado la hora de termino de la jornada de trabajo';}break;
			case 'Colacion_inicio':                   if(empty($Colacion_inicio)){                   $error['Colacion_inicio']               = 'error/No ha ingresado la hora de inicio de la colacion';}break;
			case 'Colacion_termino':                  if(empty($Colacion_termino)){                  $error['Colacion_termino']              = 'error/No ha ingresado la hora de termino de la colacion';}break;
			case 'Microparada':                       if(empty($Microparada)){                       $error['Microparada']                   = 'error/No ha ingresado el tiempo de las microparadas';}break;
			case 'idUsoContrato':                     if(empty($idUsoContrato)){                     $error['idUsoContrato']                 = 'error/No ha seleccionado el uso del contrato';}break;
			case 'idContrato':                        if(empty($idContrato)){                        $error['idContrato']                    = 'error/No ha seleccionado el contrato relacionado';}break;
			case 'Codigo':                            if(empty($Codigo)){                            $error['Codigo']                        = 'error/No ha ingresado el codigo';}break;
			case 'F_Inicio':                          if(empty($F_Inicio)){                          $error['F_Inicio']                      = 'error/No ha ingresado la fecha de inicio';}break;
			case 'F_Termino':                         if(empty($F_Termino)){                         $error['F_Termino']                     = 'error/No ha ingresado la fecha de termino';}break;
			case 'idUsoPredio':                       if(empty($idUsoPredio)){                       $error['idUsoPredio']                   = 'error/No ha seleccionado el uso del predio';}break;
			case 'idUsoGeocerca':                     if(empty($idUsoGeocerca)){                     $error['idUsoGeocerca']                 = 'error/No ha seleccionado el uso de la geocerca';}break;
			case 'NErroresGeocercaMax':               if(empty($NErroresGeocercaMax)){               $error['NErroresGeocercaMax']           = 'error/No ha ingresado el numero maximo de errores de fuera de geocerca';}break;
			case 'idTipo':                            if(empty($idTipo)){                            $error['idTipo']                        = 'error/No ha seleccionado el tipo de vehiculo';}break;
			case 'Marca':                             if(empty($Marca)){                             $error['Marca']                         = 'error/No ha ingresado la marca del vehiculo';}break;
			case 'Modelo':                            if(empty($Modelo)){                            $error['Modelo']                        = 'error/No ha ingresado el modelo del vehiculo';}break;
			case 'Patente':                           if(empty($Patente)){                           $error['Patente']                       = 'error/No ha ingresado la patente del vehiculo';}break;
			case 'Num_serie':                         if(empty($Num_serie)){                         $error['Num_serie']                     = 'error/No ha ingresado el numero de serie del vehiculo';}break;
			case 'AnoFab':                            if(empty($AnoFab)){                            $error['AnoFab']                        = 'error/No ha ingresado el año de fabricacion del vehiculo';}break;
			case 'CapacidadPersonas':                 if(empty($CapacidadPersonas)){                 $error['CapacidadPersonas']             = 'error/No ha ingresado la capacidad de personas del vehiculo';}break;
			case 'CapacidadKilos':                    if(empty($CapacidadKilos)){                    $error['CapacidadKilos']                = 'error/No ha ingresado la capacidad de kilos del vehiculo';}break;
			case 'MCubicos':                          if(empty($MCubicos)){                          $error['MCubicos']                      = 'error/No ha ingresado los metros cubicos del vehiculo';}break;
			case 'idTab':                             if(empty($idTab)){                             $error['idTab']                         = 'error/No ha seleccionado el tab de utilizacion';}break;
			case 'idMantencion':                      if(empty($idMantencion)){                      $error['idMantencion']                  = 'error/No ha ingresado el id de mantencion';}break;
			case 'idUsuarioMan':                      if(empty($idUsuarioMan)){                      $error['idUsuarioMan']                  = 'error/No ha seleccionado el usuario de la mantencion';}break;
			case 'idMatriz':                          if(empty($idMatriz)){                          $error['idMatriz']                      = 'error/No ha seleccionado la matriz de mantencion';}break;
			case 'CrossCrane_tiempo_revision':        if(empty($CrossCrane_tiempo_revision)){        $error['CrossCrane_tiempo_revision']    = 'error/No ha ingresado el tiempo de revision';}break;
			case 'CrossCrane_grupo_amperaje':         if(empty($CrossCrane_grupo_amperaje)){         $error['CrossCrane_grupo_amperaje']     = 'error/No ha seleccionado el grupo de alimentacion';}break;
			case 'CrossCrane_grupo_elevacion':        if(empty($CrossCrane_grupo_elevacion)){        $error['CrossCrane_grupo_elevacion']    = 'error/No ha seleccionado el grupo de elevacion';}break;
			case 'CrossCrane_grupo_giro':             if(empty($CrossCrane_grupo_giro)){             $error['CrossCrane_grupo_giro']         = 'error/No ha seleccionado el grupo de giro';}break;
			case 'CrossCrane_grupo_carro':            if(empty($CrossCrane_grupo_carro)){            $error['CrossCrane_grupo_carro']        = 'error/No ha seleccionado el grupo de carro';}break;
			case 'CrossCrane_grupo_voltaje':          if(empty($CrossCrane_grupo_voltaje)){          $error['CrossCrane_grupo_voltaje']      = 'error/No ha seleccionado el grupo de voltaje';}break;
			case 'CrossCrane_grupo_motor_subida':     if(empty($CrossCrane_grupo_motor_subida)){     $error['CrossCrane_grupo_motor_subida'] = 'error/No ha seleccionado el grupo de motor de subida';}break;
			case 'CrossCrane_grupo_motor_bajada':     if(empty($CrossCrane_grupo_motor_bajada)){     $error['CrossCrane_grupo_motor_bajada'] = 'error/No ha seleccionado el grupo de motor de bajada';}break;
			case 'FechaMantencionIni':                if(empty($FechaMantencionIni)){                $error['FechaMantencionIni']            = 'error/No ha ingresado la fecha de inicio de mantencion';}break;
			case 'FechaMantencionTer':                if(empty($FechaMantencionTer)){                $error['FechaMantencionTer']            = 'error/No ha ingresado la fecha de termino de mantencion';}break;
			case 'HoraMantencionIni':                 if(empty($HoraMantencionIni)){                 $error['HoraMantencionIni']             = 'error/No ha ingresado la hora de inicio de mantencion';}break;
			case 'HoraMantencionTer':                 if(empty($HoraMantencionTer)){                 $error['HoraMantencionTer']             = 'error/No ha ingresado la hora de termino de mantencion';}break;
			case 'Hor_idActivo_dia1':                 if(empty($Hor_idActivo_dia1)){                 $error['Hor_idActivo_dia1']             = 'error/No ha seleccionado el dia de activacion 1';}break;
			case 'Hor_idActivo_dia2':                 if(empty($Hor_idActivo_dia2)){                 $error['Hor_idActivo_dia2']             = 'error/No ha seleccionado el dia de activacion 2';}break;
			case 'Hor_idActivo_dia3':                 if(empty($Hor_idActivo_dia3)){                 $error['Hor_idActivo_dia3']             = 'error/No ha seleccionado el dia de activacion 3';}break;
			case 'Hor_idActivo_dia4':                 if(empty($Hor_idActivo_dia4)){                 $error['Hor_idActivo_dia4']             = 'error/No ha seleccionado el dia de activacion 4';}break;
			case 'Hor_idActivo_dia5':                 if(empty($Hor_idActivo_dia5)){                 $error['Hor_idActivo_dia5']             = 'error/No ha seleccionado el dia de activacion 5';}break;
			case 'Hor_idActivo_dia6':                 if(empty($Hor_idActivo_dia6)){                 $error['Hor_idActivo_dia6']             = 'error/No ha seleccionado el dia de activacion 6';}break;
			case 'Hor_idActivo_dia7':                 if(empty($Hor_idActivo_dia7)){                 $error['Hor_idActivo_dia7']             = 'error/No ha seleccionado el dia de activacion 7';}break;
			case 'Hor_Inicio_dia1':                   if(empty($Hor_Inicio_dia1)){                   $error['Hor_Inicio_dia1']               = 'error/No ha ingresado la hora de inicio del dia 1';}break;
			case 'Hor_Inicio_dia2':                   if(empty($Hor_Inicio_dia2)){                   $error['Hor_Inicio_dia2']               = 'error/No ha ingresado la hora de inicio del dia 2';}break;
			case 'Hor_Inicio_dia3':                   if(empty($Hor_Inicio_dia3)){                   $error['Hor_Inicio_dia3']               = 'error/No ha ingresado la hora de inicio del dia 3';}break;
			case 'Hor_Inicio_dia4':                   if(empty($Hor_Inicio_dia4)){                   $error['Hor_Inicio_dia4']               = 'error/No ha ingresado la hora de inicio del dia 4';}break;
			case 'Hor_Inicio_dia5':                   if(empty($Hor_Inicio_dia5)){                   $error['Hor_Inicio_dia5']               = 'error/No ha ingresado la hora de inicio del dia 5';}break;
			case 'Hor_Inicio_dia6':                   if(empty($Hor_Inicio_dia6)){                   $error['Hor_Inicio_dia6']               = 'error/No ha ingresado la hora de inicio del dia 6';}break;
			case 'Hor_Inicio_dia7':                   if(empty($Hor_Inicio_dia7)){                   $error['Hor_Inicio_dia7']               = 'error/No ha ingresado la hora de inicio del dia 7';}break;
			case 'Hor_Termino_dia1':                  if(empty($Hor_Termino_dia1)){                  $error['Hor_Termino_dia1']              = 'error/No ha ingresado la hora de termino del dia 1';}break;
			case 'Hor_Termino_dia2':                  if(empty($Hor_Termino_dia2)){                  $error['Hor_Termino_dia2']              = 'error/No ha ingresado la hora de termino del dia 2';}break;
			case 'Hor_Termino_dia3':                  if(empty($Hor_Termino_dia3)){                  $error['Hor_Termino_dia3']              = 'error/No ha ingresado la hora de termino del dia 3';}break;
			case 'Hor_Termino_dia4':                  if(empty($Hor_Termino_dia4)){                  $error['Hor_Termino_dia4']              = 'error/No ha ingresado la hora de termino del dia 4';}break;
			case 'Hor_Termino_dia5':                  if(empty($Hor_Termino_dia5)){                  $error['Hor_Termino_dia5']              = 'error/No ha ingresado la hora de termino del dia 5';}break;
			case 'Hor_Termino_dia6':                  if(empty($Hor_Termino_dia6)){                  $error['Hor_Termino_dia6']              = 'error/No ha ingresado la hora de termino del dia 6';}break;
			case 'Hor_Termino_dia7':                  if(empty($Hor_Termino_dia7)){                  $error['Hor_Termino_dia7']              = 'error/No ha ingresado la hora de termino del dia 7';}break;
			case 'Observacion':                       if(empty($Observacion)){                       $error['Observacion']                   = 'error/No ha ingresado una observacion';}break;
			case 'Capacidad':                         if(empty($Capacidad)){                         $error['Capacidad']                     = 'error/No ha ingresado la capacidad';}break;
			case 'idBackup':                          if(empty($idBackup)){                          $error['idBackup']                      = 'error/No ha Seleccionado si se respalda la tabla relacionada';}break;
			case 'NregBackup':                        if(empty($NregBackup)){                        $error['NregBackup']                    = 'error/No ha ingresado la cantidad de registros a respaldar';}break;
			case 'idAlertaTemprana':                  if(empty($idAlertaTemprana)){                  $error['idAlertaTemprana']              = 'error/No ha Seleccionado si se envia la alerta temprana';}break;
			case 'idUsoFTP':                          if(empty($idUsoFTP)){                          $error['idUsoFTP']                      = 'error/No ha Seleccionado si utiliza carpeta';}break;
			case 'FTP_Carpeta':                       if(empty($FTP_Carpeta)){                       $error['FTP_Carpeta']                   = 'error/No ha ingresado el nombre de la carpeta';}break;
			
	
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
//Si se ingresaron la utilizacion de los sensores
	if(isset($id_Sensores)&&$id_Sensores==1&&isset($cantSensores)&&$cantSensores==0){                    $error['cantSensores']         = 'error/No ha ingresado la cantidad de sensores a utilizar'; }	
	if(isset($idUsoGeocerca)&&$idUsoGeocerca==1&&isset($NErroresGeocercaMax)&&$NErroresGeocercaMax==0){  $error['NErroresGeocercaMax']  = 'error/No ha ingresado la cantidad de errores de fuera de geocerca'; }
	if(isset($FTP_Carpeta)&&strpos($FTP_Carpeta, " ")){                                                  $error['FTP_Carpeta']          = 'error/El nombre de la carpeta FTP contiene espacios';}	
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Identificador)&&contar_palabras_censuradas($Identificador)!=0){  $error['Identificador'] = 'error/Edita Identificador, contiene palabras no permitidas'; }	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){                $error['Nombre']        = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Direccion)&&contar_palabras_censuradas($Direccion)!=0){          $error['Direccion']     = 'error/Edita Direccion, contiene palabras no permitidas'; }	
	if(isset($Codigo)&&contar_palabras_censuradas($Codigo)!=0){                $error['Codigo']        = 'error/Edita Codigo, contiene palabras no permitidas'; }	
	if(isset($Marca)&&contar_palabras_censuradas($Marca)!=0){                  $error['Marca']         = 'error/Edita Marca, contiene palabras no permitidas'; }	
	if(isset($Modelo)&&contar_palabras_censuradas($Modelo)!=0){                $error['Modelo']        = 'error/Edita Modelo, contiene palabras no permitidas'; }	
	if(isset($Patente)&&contar_palabras_censuradas($Patente)!=0){              $error['Patente']       = 'error/Edita Patente, contiene palabras no permitidas'; }	
	if(isset($Num_serie)&&contar_palabras_censuradas($Num_serie)!=0){          $error['Num_serie']     = 'error/Edita Num_serie, contiene palabras no permitidas'; }	
	if(isset($Observacion)&&contar_palabras_censuradas($Observacion)!=0){      $error['Observacion']   = 'error/Edita Observacion, contiene palabras no permitidas'; }	
	if(isset($FTP_Carpeta)&&contar_palabras_censuradas($FTP_Carpeta)!=0){      $error['FTP_Carpeta']   = 'error/Edita FTP Carpeta, contiene palabras no permitidas'; }	
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico otros datos
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'telemetria_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//Se verifica si el dato existe
			if(isset($Identificador)&&isset($idSistema)){
				$ndata_2 = db_select_nrows (false, 'Nombre', 'telemetria_listado', '', "Identificador='".$Identificador."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ingresado ya existe';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El identificador ingresado ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                                          $a  = "'".$idSistema."'" ;                          }else{$a  ="''";}
				if(isset($Identificador) && $Identificador != ''){                                  $a .= ",'".$Identificador."'" ;                     }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                                                $a .= ",'".$Nombre."'" ;                            }else{$a .= ",''";}
				if(isset($id_Geo) && $id_Geo != ''){                                                $a .= ",'".$id_Geo."'" ;                            }else{$a .= ",''";}
				if(isset($id_Sensores) && $id_Sensores != ''){                                      $a .= ",'".$id_Sensores."'" ;                       }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                                            $a .= ",'".$idEstado."'" ;                          }else{$a .= ",''";}
				if(isset($idAlarmaGeneral) && $idAlarmaGeneral != ''){                              $a .= ",'".$idAlarmaGeneral."'" ;                   }else{$a .= ",''";}
				if(isset($idUsoContrato) && $idUsoContrato != ''){                                  $a .= ",'".$idUsoContrato."'" ;                     }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia1) && $Hor_idActivo_dia1 != ''){                          $a .= ",'".$Hor_idActivo_dia1."'" ;                 }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia2) && $Hor_idActivo_dia2 != ''){                          $a .= ",'".$Hor_idActivo_dia2."'" ;                 }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia3) && $Hor_idActivo_dia3 != ''){                          $a .= ",'".$Hor_idActivo_dia3."'" ;                 }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia4) && $Hor_idActivo_dia4 != ''){                          $a .= ",'".$Hor_idActivo_dia4."'" ;                 }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia5) && $Hor_idActivo_dia5 != ''){                          $a .= ",'".$Hor_idActivo_dia5."'" ;                 }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia6) && $Hor_idActivo_dia6 != ''){                          $a .= ",'".$Hor_idActivo_dia6."'" ;                 }else{$a .= ",''";}
				if(isset($Hor_idActivo_dia7) && $Hor_idActivo_dia7 != ''){                          $a .= ",'".$Hor_idActivo_dia7."'" ;                 }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia1) && $Hor_Inicio_dia1 != ''){                              $a .= ",'".$Hor_Inicio_dia1."'" ;                   }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia2) && $Hor_Inicio_dia2 != ''){                              $a .= ",'".$Hor_Inicio_dia2."'" ;                   }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia3) && $Hor_Inicio_dia3 != ''){                              $a .= ",'".$Hor_Inicio_dia3."'" ;                   }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia4) && $Hor_Inicio_dia4 != ''){                              $a .= ",'".$Hor_Inicio_dia4."'" ;                   }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia5) && $Hor_Inicio_dia5 != ''){                              $a .= ",'".$Hor_Inicio_dia5."'" ;                   }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia6) && $Hor_Inicio_dia6 != ''){                              $a .= ",'".$Hor_Inicio_dia6."'" ;                   }else{$a .= ",''";}
				if(isset($Hor_Inicio_dia7) && $Hor_Inicio_dia7 != ''){                              $a .= ",'".$Hor_Inicio_dia7."'" ;                   }else{$a .= ",''";}
				if(isset($Hor_Termino_dia1) && $Hor_Termino_dia1 != ''){                            $a .= ",'".$Hor_Termino_dia1."'" ;                  }else{$a .= ",''";}
				if(isset($Hor_Termino_dia2) && $Hor_Termino_dia2 != ''){                            $a .= ",'".$Hor_Termino_dia2."'" ;                  }else{$a .= ",''";}
				if(isset($Hor_Termino_dia3) && $Hor_Termino_dia3 != ''){                            $a .= ",'".$Hor_Termino_dia3."'" ;                  }else{$a .= ",''";}
				if(isset($Hor_Termino_dia4) && $Hor_Termino_dia4 != ''){                            $a .= ",'".$Hor_Termino_dia4."'" ;                  }else{$a .= ",''";}
				if(isset($Hor_Termino_dia5) && $Hor_Termino_dia5 != ''){                            $a .= ",'".$Hor_Termino_dia5."'" ;                  }else{$a .= ",''";}
				if(isset($Hor_Termino_dia6) && $Hor_Termino_dia6 != ''){                            $a .= ",'".$Hor_Termino_dia6."'" ;                  }else{$a .= ",''";}
				if(isset($Hor_Termino_dia7) && $Hor_Termino_dia7 != ''){                            $a .= ",'".$Hor_Termino_dia7."'" ;                  }else{$a .= ",''";}
				if(isset($idMantencion) && $idMantencion != ''){                                    $a .= ",'".$idMantencion."'" ;                      }else{$a .= ",''";}
				if(isset($idEstadoEncendido) && $idEstadoEncendido != ''){                          $a .= ",'".$idEstadoEncendido."'" ;                 }else{$a .= ",''";}
				if(isset($idUsoPredio) && $idUsoPredio != ''){                                      $a .= ",'".$idUsoPredio."'" ;                       }else{$a .= ",''";}
				if(isset($idUsoGeocerca) && $idUsoGeocerca != ''){                                  $a .= ",'".$idUsoGeocerca."'" ;                     }else{$a .= ",''";}
				if(isset($CrossCrane_tiempo_revision) && $CrossCrane_tiempo_revision != ''){        $a .= ",'".$CrossCrane_tiempo_revision."'" ;        }else{$a .= ",''";}
				if(isset($CrossCrane_grupo_amperaje) && $CrossCrane_grupo_amperaje != ''){          $a .= ",'".$CrossCrane_grupo_amperaje."'" ;         }else{$a .= ",''";}
				if(isset($CrossCrane_grupo_elevacion) && $CrossCrane_grupo_elevacion != ''){        $a .= ",'".$CrossCrane_grupo_elevacion."'" ;        }else{$a .= ",''";}
				if(isset($CrossCrane_grupo_giro) && $CrossCrane_grupo_giro != ''){                  $a .= ",'".$CrossCrane_grupo_giro."'" ;             }else{$a .= ",''";}
				if(isset($CrossCrane_grupo_carro) && $CrossCrane_grupo_carro != ''){                $a .= ",'".$CrossCrane_grupo_carro."'" ;            }else{$a .= ",''";}
				if(isset($CrossCrane_grupo_voltaje) && $CrossCrane_grupo_voltaje != ''){            $a .= ",'".$CrossCrane_grupo_voltaje."'" ;          }else{$a .= ",''";}
				if(isset($CrossCrane_grupo_motor_subida) && $CrossCrane_grupo_motor_subida != ''){  $a .= ",'".$CrossCrane_grupo_motor_subida."'" ;     }else{$a .= ",''";}
				if(isset($CrossCrane_grupo_motor_bajada) && $CrossCrane_grupo_motor_bajada != ''){  $a .= ",'".$CrossCrane_grupo_motor_bajada."'" ;     }else{$a .= ",''";}
				if(isset($idBackup) && $idBackup != ''){                                            $a .= ",'".$idBackup."'" ;                          }else{$a .= ",''";}
				if(isset($idGenerador) && $idGenerador != ''){                                      $a .= ",'".$idGenerador."'" ;                       }else{$a .= ",''";}
				if(isset($idAlertaTemprana) && $idAlertaTemprana != ''){                            $a .= ",'".$idAlertaTemprana."'" ;                  }else{$a .= ",''";}
				if(isset($idUsoFTP) && $idUsoFTP != ''){                                            $a .= ",'".$idUsoFTP."'" ;                          }else{$a .= ",''";}
				if(isset($FTP_Carpeta) && $FTP_Carpeta != ''){                                      $a .= ",'".$FTP_Carpeta."'" ;                       }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_listado` (idSistema, Identificador, Nombre, id_Geo, 
				id_Sensores, idEstado, idAlarmaGeneral, idUsoContrato, Hor_idActivo_dia1, 
				Hor_idActivo_dia2, Hor_idActivo_dia3, Hor_idActivo_dia4, Hor_idActivo_dia5, 
				Hor_idActivo_dia6, Hor_idActivo_dia7, Hor_Inicio_dia1, Hor_Inicio_dia2, 
				Hor_Inicio_dia3, Hor_Inicio_dia4, Hor_Inicio_dia5, Hor_Inicio_dia6, 
				Hor_Inicio_dia7, Hor_Termino_dia1, Hor_Termino_dia2, Hor_Termino_dia3, 
				Hor_Termino_dia4, Hor_Termino_dia5, Hor_Termino_dia6, Hor_Termino_dia7,
				idMantencion, idEstadoEncendido, idUsoPredio, idUsoGeocerca,CrossCrane_tiempo_revision,
				CrossCrane_grupo_amperaje, CrossCrane_grupo_elevacion, CrossCrane_grupo_giro,
				CrossCrane_grupo_carro, CrossCrane_grupo_voltaje, CrossCrane_grupo_motor_subida,
				CrossCrane_grupo_motor_bajada, idBackup, idGenerador, idAlertaTemprana,
				idUsoFTP, FTP_Carpeta) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if(!$resultado){
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
					
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
				}else{
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
					
					// elimino la tabla si es que existe
					$query  = "DROP TABLE IF EXISTS `telemetria_listado_tablarelacionada_".$ultimo_id."`";
					$result = mysqli_query($dbConn, $query);
					
					//Variable para columnas
					$tr_column = '';
					//Recorro la configuracion de los sensores
					for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
						$tr_column .= '`Sensor_'.$i.'` decimal(20,6) NOT NULL,';
					}
					// se crea la nueva tabla
					$query  = "CREATE TABLE `telemetria_listado_tablarelacionada_".$ultimo_id."` (
					`idTabla` int(11) unsigned NOT NULL AUTO_INCREMENT,
					`idTelemetria` int(11) unsigned NOT NULL,
					`idContrato` int(11) unsigned NOT NULL,
					`idSolicitud` int(11) unsigned NOT NULL,
					`idZona` int(11) unsigned NOT NULL,
					`idGeocerca` int(11) unsigned NOT NULL,
					`Fecha` date NOT NULL,
					`Hora` time NOT NULL,
					`FechaSistema` date NOT NULL,
					`HoraSistema` time NOT NULL,
					`TimeStamp` datetime NOT NULL,
					`GeoLatitud` double NOT NULL,
					`GeoLongitud` double NOT NULL,
					`GeoVelocidad` decimal(20,6) NOT NULL,
					`GeoDireccion` decimal(20,6) NOT NULL,
					`GeoMovimiento` decimal(20,6) NOT NULL,
					`Segundos` int(11) unsigned NOT NULL,
					`Diferencia` decimal(20,6) NOT NULL,
					".$tr_column."
					  PRIMARY KEY (`idTabla`)
					) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Dinamica';";
					$result = mysqli_query($dbConn, $query);
					
					/*******************************************************/
					//se actualizan los datos
					$a = "tabla_relacionada='telemetria_listado_tablarelacionada_".$ultimo_id."'" ;
					$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$ultimo_id.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					//Si ejecuto correctamente la consulta
					if($resultado==true){
						
						header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
						die;
					}
				}
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico otros datos
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'telemetria_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idTelemetria!='".$idTelemetria."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//Se verifica si el dato existe
			if(isset($Identificador)&&isset($idSistema)){
				$ndata_2 = db_select_nrows (false, 'Nombre', 'telemetria_listado', '', "Identificador='".$Identificador."' AND idSistema='".$idSistema."' AND idTelemetria!='".$idTelemetria."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ingresado ya existe';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El identificador ingresado ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idTelemetria='".$idTelemetria."'" ;
				if(isset($idSistema) && $idSistema != ''){                                                $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){                                                  $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($Identificador) && $Identificador != ''){                                        $a .= ",Identificador='".$Identificador."'" ;}
				if(isset($Nombre) && $Nombre != ''){                                                      $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($idCiudad) && $idCiudad != ''){                                                  $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna != ''){                                                  $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Direccion) && $Direccion != ''){                                                $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($GeoLatitud) && $GeoLatitud != ''){                                              $a .= ",GeoLatitud='".$GeoLatitud."'" ;}
				if(isset($GeoLongitud) && $GeoLongitud != ''){                                            $a .= ",GeoLongitud='".$GeoLongitud."'" ;}
				if(isset($GeoVelocidad) && $GeoVelocidad != ''){                                          $a .= ",GeoVelocidad='".$GeoVelocidad."'" ;}
				if(isset($GeoDireccion) && $GeoDireccion != ''){                                          $a .= ",GeoDireccion='".$GeoDireccion."'" ;}
				if(isset($GeoMovimiento) && $GeoMovimiento != ''){                                        $a .= ",GeoMovimiento='".$GeoMovimiento."'" ;}
				if(isset($GeoTiempoDetencion) && $GeoTiempoDetencion != ''){                              $a .= ",GeoTiempoDetencion='".$GeoTiempoDetencion."'" ;}
				if(isset($LastUpdateFecha) && $LastUpdateFecha != ''){                                    $a .= ",LastUpdateFecha='".$LastUpdateFecha."'" ;}
				if(isset($LastUpdateHora) && $LastUpdateHora != ''){                                      $a .= ",LastUpdateHora='".$LastUpdateHora."'" ;}
				if(isset($id_Geo) && $id_Geo != ''){                                                      $a .= ",id_Geo='".$id_Geo."'" ;}
				if(isset($id_Sensores) && $id_Sensores != ''){                                            $a .= ",id_Sensores='".$id_Sensores."'" ;}
				if(isset($cantSensores) && $cantSensores != ''){                                          $a .= ",cantSensores='".$cantSensores."'" ;}
				if(isset($idDispositivo) && $idDispositivo != ''){                                        $a .= ",idDispositivo='".$idDispositivo."'" ;}
				if(isset($idShield) ){                                                                    $a .= ",idShield='".$idShield."'" ;}
				if(isset($idGenerador) && $idGenerador != ''){                                            $a .= ",idGenerador='".$idGenerador."'" ;}
				if(isset($Direccion_img) && $Direccion_img != ''){                                        $a .= ",Direccion_img='".$Direccion_img."'" ;}
				if(isset($Sim_Num_Tel) && $Sim_Num_Tel != ''){                                            $a .= ",Sim_Num_Tel='".$Sim_Num_Tel."'" ;}
				if(isset($Sim_Num_Serie) && $Sim_Num_Serie != ''){                                        $a .= ",Sim_Num_Serie='".$Sim_Num_Serie."'" ;}
				if(isset($Sim_modelo) && $Sim_modelo != ''){                                              $a .= ",Sim_modelo='".$Sim_modelo."'" ;}
				if(isset($Sim_marca) && $Sim_marca != ''){                                                $a .= ",Sim_marca='".$Sim_marca."'" ;}
				if(isset($Sim_Compania) && $Sim_Compania != ''){                                          $a .= ",Sim_Compania='".$Sim_Compania."'" ;}
				if(isset($tabla_relacionada)&& $tabla_relacionada != '' ){                                $a .= ",tabla_relacionada='".$tabla_relacionada."'" ;}
				if(isset($LimiteVelocidad) ){                                                             $a .= ",LimiteVelocidad='".$LimiteVelocidad."'" ;}
				if(isset($idAlarmaGeneral) ){                                                             $a .= ",idAlarmaGeneral='".$idAlarmaGeneral."'" ;}
				if(isset($IdentificadorEmpresa) ){                                                        $a .= ",IdentificadorEmpresa='".$IdentificadorEmpresa."'" ;}
				if(isset($NDetenciones) ){                                                                $a .= ",NDetenciones='".$NDetenciones."'" ;}
				if(isset($NErrores) ){                                                                    $a .= ",NErrores='".$NErrores."'" ;}
				if(isset($NAlertas) ){                                                                    $a .= ",NAlertas='".$NAlertas."'" ;}
				if(isset($idAlertaTemprana)&& $idAlertaTemprana != '' ){                                  $a .= ",idAlertaTemprana='".$idAlertaTemprana."'" ;}
				if(isset($idUsoFTP)&& $idUsoFTP != '' ){                                                  $a .= ",idUsoFTP='".$idUsoFTP."'" ;}
				if(isset($FTP_Carpeta)&& $FTP_Carpeta != '' ){                                            $a .= ",FTP_Carpeta='".$FTP_Carpeta."'" ;}
				if(isset($idBackup)&& $idBackup != '' ){                                                  $a .= ",idBackup='".$idBackup."'" ;}
				if(isset($NregBackup) ){                                                                  $a .= ",NregBackup='".$NregBackup."'" ;}
				if(isset($Estado) ){                                                                      $a .= ",Estado='".$Estado."'" ;}
				if(isset($TiempoFueraLinea) ){                                                            $a .= ",TiempoFueraLinea='".$TiempoFueraLinea."'" ;}
				if(isset($TiempoDetencion) ){                                                             $a .= ",TiempoDetencion='".$TiempoDetencion."'" ;}
				if(isset($idZona) ){                                                                      $a .= ",idZona='".$idZona."'" ;}
				if(isset($IP_Client)&& $IP_Client != '' ){                                                $a .= ",IP_Client='".$IP_Client."'" ;}
				if(isset($SensorActivacionID) ){                                                          $a .= ",SensorActivacionID='".$SensorActivacionID."'" ;}
				if(isset($SensorActivacionValor) ){                                                       $a .= ",SensorActivacionValor='".$SensorActivacionValor."'" ;}
				if(isset($Jornada_inicio)&& $Jornada_inicio != '' ){                                      $a .= ",Jornada_inicio='".$Jornada_inicio."'" ;}
				if(isset($Jornada_termino)&& $Jornada_termino != '' ){                                    $a .= ",Jornada_termino='".$Jornada_termino."'" ;}
				if(isset($Colacion_inicio)&& $Colacion_inicio != '' ){                                    $a .= ",Colacion_inicio='".$Colacion_inicio."'" ;}
				if(isset($Colacion_termino)&& $Colacion_termino != '' ){                                  $a .= ",Colacion_termino='".$Colacion_termino."'" ;}
				if(isset($Microparada)&& $Microparada != '' ){                                            $a .= ",Microparada='".$Microparada."'" ;}
				if(isset($idUsoContrato)&& $idUsoContrato != '' ){                                        $a .= ",idUsoContrato='".$idUsoContrato."'" ;}
				if(isset($idContrato)&& $idContrato != '' ){                                              $a .= ",idContrato='".$idContrato."'" ;}
				if(isset($Capacidad)&& $Capacidad != '' ){                                                $a .= ",Capacidad='".$Capacidad."'" ;}
				if(isset($Codigo)&& $Codigo != '' ){                                                      $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($F_Inicio)&& $F_Inicio != '' ){                                                  $a .= ",F_Inicio='".$F_Inicio."'" ;}
				if(isset($F_Termino)&& $F_Termino != '' ){                                                $a .= ",F_Termino='".$F_Termino."'" ;}
				if(isset($idUsoPredio)&& $idUsoPredio != '' ){                                            $a .= ",idUsoPredio='".$idUsoPredio."'" ;}
				if(isset($idUsoGeocerca)&& $idUsoGeocerca != '' ){                                        $a .= ",idUsoGeocerca='".$idUsoGeocerca."'" ;}
				if(isset($NErroresGeocercaMax)&& $NErroresGeocercaMax != '' ){                            $a .= ",NErroresGeocercaMax='".$NErroresGeocercaMax."'" ;}
				if(isset($idTipo)&& $idTipo != '' ){                                                      $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($Marca)&& $Marca != '' ){                                                        $a .= ",Marca='".$Marca."'" ;}
				if(isset($Modelo)&& $Modelo != '' ){                                                      $a .= ",Modelo='".$Modelo."'" ;}
				if(isset($Patente)&& $Patente != '' ){                                                    $a .= ",Patente='".$Patente."'" ;}
				if(isset($Num_serie)&& $Num_serie != '' ){                                                $a .= ",Num_serie='".$Num_serie."'" ;}
				if(isset($AnoFab)&& $AnoFab != '' ){                                                      $a .= ",AnoFab='".$AnoFab."'" ;}
				if(isset($CapacidadPersonas)&& $CapacidadPersonas != '' ){                                $a .= ",CapacidadPersonas='".$CapacidadPersonas."'" ;}
				if(isset($CapacidadKilos)&& $CapacidadKilos != '' ){                                      $a .= ",CapacidadKilos='".$CapacidadKilos."'" ;}
				if(isset($MCubicos)&& $MCubicos != '' ){                                                  $a .= ",MCubicos='".$MCubicos."'" ;}
				if(isset($idTab)&& $idTab != '' ){                                                        $a .= ",idTab='".$idTab."'" ;}
				if(isset($idMantencion)&& $idMantencion != '' ){                                          $a .= ",idMantencion='".$idMantencion."'" ;}
				if(isset($idUsuarioMan)&& $idUsuarioMan != '' ){                                          $a .= ",idUsuarioMan='".$idUsuarioMan."'" ;}
				if(isset($idMatriz)&& $idMatriz != '' ){                                                  $a .= ",idMatriz='".$idMatriz."'" ;}
				if(isset($CrossCrane_tiempo_revision)&& $CrossCrane_tiempo_revision != '' ){              $a .= ",CrossCrane_tiempo_revision='".$CrossCrane_tiempo_revision."'" ;}
				if(isset($CrossCrane_grupo_amperaje)&& $CrossCrane_grupo_amperaje != '' ){                $a .= ",CrossCrane_grupo_amperaje='".$CrossCrane_grupo_amperaje."'" ;}
				if(isset($CrossCrane_grupo_elevacion)&& $CrossCrane_grupo_elevacion != '' ){              $a .= ",CrossCrane_grupo_elevacion='".$CrossCrane_grupo_elevacion."'" ;}
				if(isset($CrossCrane_grupo_giro)&& $CrossCrane_grupo_giro != '' ){                        $a .= ",CrossCrane_grupo_giro='".$CrossCrane_grupo_giro."'" ;}
				if(isset($CrossCrane_grupo_carro)&& $CrossCrane_grupo_carro != '' ){                      $a .= ",CrossCrane_grupo_carro='".$CrossCrane_grupo_carro."'" ;}
				if(isset($CrossCrane_grupo_voltaje)&& $CrossCrane_grupo_voltaje != '' ){                  $a .= ",CrossCrane_grupo_voltaje='".$CrossCrane_grupo_voltaje."'" ;}
				if(isset($CrossCrane_grupo_motor_subida)&& $CrossCrane_grupo_motor_subida != '' ){        $a .= ",CrossCrane_grupo_motor_subida='".$CrossCrane_grupo_motor_subida."'" ;}
				if(isset($CrossCrane_grupo_motor_bajada)&& $CrossCrane_grupo_motor_bajada != '' ){        $a .= ",CrossCrane_grupo_motor_bajada='".$CrossCrane_grupo_motor_bajada."'" ;}
				if(isset($FechaMantencionIni)&& $FechaMantencionIni != '' ){                              $a .= ",FechaMantencionIni='".$FechaMantencionIni."'" ;}
				if(isset($FechaMantencionTer)&& $FechaMantencionTer != '' ){                              $a .= ",FechaMantencionTer='".$FechaMantencionTer."'" ;}
				if(isset($HoraMantencionIni)&& $HoraMantencionIni != '' ){                                $a .= ",HoraMantencionIni='".$HoraMantencionIni."'" ;}
				if(isset($HoraMantencionTer)&& $HoraMantencionTer != '' ){                                $a .= ",HoraMantencionTer='".$HoraMantencionTer."'" ;}
				if(isset($Hor_idActivo_dia1)&& $Hor_idActivo_dia1 != '' ){                                $a .= ",Hor_idActivo_dia1='".$Hor_idActivo_dia1."'" ;}
				if(isset($Hor_idActivo_dia2)&& $Hor_idActivo_dia2 != '' ){                                $a .= ",Hor_idActivo_dia2='".$Hor_idActivo_dia2."'" ;}
				if(isset($Hor_idActivo_dia3)&& $Hor_idActivo_dia3 != '' ){                                $a .= ",Hor_idActivo_dia3='".$Hor_idActivo_dia3."'" ;}
				if(isset($Hor_idActivo_dia4)&& $Hor_idActivo_dia4 != '' ){                                $a .= ",Hor_idActivo_dia4='".$Hor_idActivo_dia4."'" ;}
				if(isset($Hor_idActivo_dia5)&& $Hor_idActivo_dia5 != '' ){                                $a .= ",Hor_idActivo_dia5='".$Hor_idActivo_dia5."'" ;}
				if(isset($Hor_idActivo_dia6)&& $Hor_idActivo_dia6 != '' ){                                $a .= ",Hor_idActivo_dia6='".$Hor_idActivo_dia6."'" ;}
				if(isset($Hor_idActivo_dia7)&& $Hor_idActivo_dia7 != '' ){                                $a .= ",Hor_idActivo_dia7='".$Hor_idActivo_dia7."'" ;}
				if(isset($Hor_Inicio_dia1)&& $Hor_Inicio_dia1 != '' ){                                    $a .= ",Hor_Inicio_dia1='".$Hor_Inicio_dia1."'" ;}
				if(isset($Hor_Inicio_dia2)&& $Hor_Inicio_dia2 != '' ){                                    $a .= ",Hor_Inicio_dia2='".$Hor_Inicio_dia2."'" ;}
				if(isset($Hor_Inicio_dia3)&& $Hor_Inicio_dia3 != '' ){                                    $a .= ",Hor_Inicio_dia3='".$Hor_Inicio_dia3."'" ;}
				if(isset($Hor_Inicio_dia4)&& $Hor_Inicio_dia4 != '' ){                                    $a .= ",Hor_Inicio_dia4='".$Hor_Inicio_dia4."'" ;}
				if(isset($Hor_Inicio_dia5)&& $Hor_Inicio_dia5 != '' ){                                    $a .= ",Hor_Inicio_dia5='".$Hor_Inicio_dia5."'" ;}
				if(isset($Hor_Inicio_dia6)&& $Hor_Inicio_dia6 != '' ){                                    $a .= ",Hor_Inicio_dia6='".$Hor_Inicio_dia6."'" ;}
				if(isset($Hor_Inicio_dia7)&& $Hor_Inicio_dia7 != '' ){                                    $a .= ",Hor_Inicio_dia7='".$Hor_Inicio_dia7."'" ;}
				if(isset($Hor_Termino_dia1)&& $Hor_Termino_dia1 != '' ){                                  $a .= ",Hor_Termino_dia1='".$Hor_Termino_dia1."'" ;}
				if(isset($Hor_Termino_dia2)&& $Hor_Termino_dia2 != '' ){                                  $a .= ",Hor_Termino_dia2='".$Hor_Termino_dia2."'" ;}
				if(isset($Hor_Termino_dia3)&& $Hor_Termino_dia3 != '' ){                                  $a .= ",Hor_Termino_dia3='".$Hor_Termino_dia3."'" ;}
				if(isset($Hor_Termino_dia4)&& $Hor_Termino_dia4 != '' ){                                  $a .= ",Hor_Termino_dia4='".$Hor_Termino_dia4."'" ;}
				if(isset($Hor_Termino_dia5)&& $Hor_Termino_dia5 != '' ){                                  $a .= ",Hor_Termino_dia5='".$Hor_Termino_dia5."'" ;}
				if(isset($Hor_Termino_dia6)&& $Hor_Termino_dia6 != '' ){                                  $a .= ",Hor_Termino_dia6='".$Hor_Termino_dia6."'" ;}
				if(isset($Hor_Termino_dia7)&& $Hor_Termino_dia7 != '' ){                                  $a .= ",Hor_Termino_dia7='".$Hor_Termino_dia7."'" ;}
				
				//Recorro la configuracion de los sensores
				for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
					if(isset($SensoresNombre[$i]) && $SensoresNombre[$i] != ''){                 $a .= ",SensoresNombre_".$i."='".$SensoresNombre[$i]."'" ;}
					if(isset($SensoresTipo[$i]) && $SensoresTipo[$i] != ''){                     $a .= ",SensoresTipo_".$i."='".$SensoresTipo[$i]."'" ;}
					if(isset($SensoresMedMin[$i]) && $SensoresMedMin[$i] != ''){                 $a .= ",SensoresMedMin_".$i."='".$SensoresMedMin[$i]."'" ;}
					if(isset($SensoresMedMax[$i]) && $SensoresMedMax[$i] != ''){                 $a .= ",SensoresMedMax_".$i."='".$SensoresMedMax[$i]."'" ;}
					if(isset($SensoresMedErrores_1[$i]) && $SensoresMedErrores_1[$i] != ''){     $a .= ",SensoresMedErrores_".$i."='".$SensoresMedErrores_1[$i]."'" ;}
					if(isset($SensoresGrupo[$i]) && $SensoresGrupo[$i] != ''){                   $a .= ",SensoresGrupo_".$i."='".$SensoresGrupo[$i]."'" ;}
					if(isset($SensoresUniMed[$i]) && $SensoresUniMed[$i] != ''){                 $a .= ",SensoresUniMed_".$i."='".$SensoresUniMed[$i]."'" ;}
					if(isset($SensoresActivo[$i]) && $SensoresActivo[$i] != ''){                 $a .= ",SensoresActivo_".$i."='".$SensoresActivo[$i]."'" ;}
					if(isset($SensoresUso[$i]) && $SensoresUso[$i] != ''){                       $a .= ",SensoresUso_".$i."='".$SensoresUso[$i]."'" ;}
					if(isset($SensoresAccionC[$i]) && $SensoresAccionC[$i] != ''){               $a .= ",SensoresAccionC_".$i."='".$SensoresAccionC[$i]."'" ;}
					if(isset($SensoresAccionT[$i]) && $SensoresAccionT[$i] != ''){               $a .= ",SensoresAccionT_".$i."='".($SensoresAccionT[$i]*3600)."'" ;}
					if(isset($SensoresAccionAlerta[$i]) && $SensoresAccionAlerta[$i] != ''){     $a .= ",SensoresAccionAlerta_".$i."='".$SensoresAccionAlerta[$i]."'" ;}
					if(isset($SensoresRevision[$i]) && $SensoresRevision[$i] != ''){             $a .= ",SensoresRevision_".$i."='".$SensoresRevision[$i]."'" ;}
					if(isset($SensoresRevisionGrupo[$i]) && $SensoresRevisionGrupo[$i] != ''){   $a .= ",SensoresRevisionGrupo_".$i."='".$SensoresRevisionGrupo[$i]."'" ;}
							
					if(isset($SensoresFechaUso[$i]) && $SensoresFechaUso[$i] != ''&&$SensoresFechaUso[$i]!=$SensoresFechaUso_Fake){                 
						$a .= ",SensoresFechaUso_".$i."='".$SensoresFechaUso[$i]."'" ;
						$a .= ",SensoresAccionMedC_".$i."=''" ;
						$a .= ",SensoresAccionMedT_".$i."=''" ;
					}
				}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$idTelemetria.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
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
				$rowdata = db_select_data (false, 'Direccion_img', 'telemetria_listado', '', 'idTelemetria = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//se borran los datos
				$resultado = db_delete_data (false, 'telemetria_listado', 'idTelemetria = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					// elimino la tabla si es que existe
					$query  = "DROP TABLE IF EXISTS `telemetria_listado_tablarelacionada_".$indice."`";
					$result = mysqli_query($dbConn, $query);
						
					//se elimina el archivo
					if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){
						try {
							if(!is_writable('upload/'.$rowdata['Direccion_img'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$rowdata['Direccion_img']);
							}
						}catch(Exception $e) { 
							//guardar el dato en un archivo log
						}
					}
					
					//redirijo
					header( 'Location: '.$location.'&deleted=true' );
					die;
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			
			

		break;	
			
/*******************************************************************************************************************/
		//Cambia el nivel del permiso
		case 'submit_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["Direccion_img"]["error"] > 0){ 
				$error['Direccion_img'] = 'error/'.uploadPHPError($_FILES["Direccion_img"]["error"]); 
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 1000;
				//Sufijo
				$sufijo = 'tel_img_';
			  
				if (in_array($_FILES['Direccion_img']['type'], $permitidos) && $_FILES['Direccion_img']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['Direccion_img']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						//$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], $ruta);
						//Muevo el archivo
						$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], "upload/xxxsxx_".$_FILES['Direccion_img']['name']);
						if ($move_result){		
							//se selecciona la imagen
							switch ($_FILES['Direccion_img']['type']) {
								case 'image/jpg':
									$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									break;
								case 'image/jpeg':
									$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									break;
								case 'image/gif':
									$imgBase = imagecreatefromgif('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									break;
								case 'image/png':
									$imgBase = imagecreatefrompng('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
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
								if(!is_writable('upload/xxxsxx_'.$_FILES['Direccion_img']['name'])){
									//throw new Exception('File not writable');
								}else{
									unlink('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
								}
							}catch(Exception $e) { 
								//guardar el dato en un archivo log
							}
							//se eliminan las imagenes de la memoria
							imagedestroy($imgBase);
							
						
						
							//Filtro para idSistema
							if ( !empty($_POST['idTelemetria']) )    $idTelemetria       = $_POST['idTelemetria'];
							
							$a = "Direccion_img='".$sufijo.$_FILES['Direccion_img']['name']."'" ;
							
							/*******************************************************/
							//se actualizan los datos
							$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$idTelemetria.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
							//Si ejecuto correctamente la consulta
							if($resultado==true){
								header( 'Location: '.$location.'&id='.$idTelemetria );
								die;
							}
							
						} else {
							$error['Direccion_img']     = 'error/Ocurrio un error al mover el archivo'; 
						}
					} else {
					  $error['Direccion_img']     = 'error/El archivo '.$_FILES['Direccion_img']['name'].' ya existe'; 
					}
				} else {
					$error['Direccion_img']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
				}
			}


		break;	
/*******************************************************************************************************************/
		case 'del_img':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$rowdata = db_select_data (false, 'Direccion_img', 'telemetria_listado', '', 'idTelemetria = "'.$_GET['del_img'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			/*******************************************************/
			//se actualizan los datos
			$a = "Direccion_img=''" ;
			$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$_GET['del_img'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				
				//se elimina el archivo
				if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['Direccion_img'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['Direccion_img']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&id='.$_GET['del_img'] );
				die;
				
			}
				
			
		break;	
/*******************************************************************************************************************/
		//Cambio el estado de activo a inactivo
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$idTelemetria  = $_GET['id'];
			$idEstado      = simpleDecode($_GET['estado'], fecha_actual());
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idTelemetria)&&$idTelemetria!=''){
				$ndata_1 = db_select_nrows (false, 'idEstado', 'telemetria_listado', '', "idEstado=2 AND idMantencion=1 AND idTelemetria='".$idTelemetria."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El equipo de telemetria se encuentra en mantencion , favor esperar a que la mantencion sea terminada';}
			/*******************************************************************/
			
				
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*******************************************************/
				//se actualizan los datos
				$a = "idEstado='".$idEstado."'" ;
				$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$idTelemetria.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
			}
			
		break;
		
/*******************************************************************************************************************/
		//Cambio la alerta general de activo a inactivo
		case 'alerta':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idTelemetria  = $_GET['id'];
			$idAlerta      = $_GET['alerta'];
			/*******************************************************/
			//se actualizan los datos
			$a = "idAlarmaGeneral='".$idAlerta."'" ;
			$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$idTelemetria.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				
				header( 'Location: '.$location.'&edited=true' );
				die;
				
			}

			 

		break;	
/*******************************************************************************************************************/
		case 'clone_Equipo':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//obtengo los datos de la maquina previamente seleccionada
			$rowdata = db_select_data (false, 'idSistema', 'telemetria_listado', '', 'idTelemetria = '.$idTelemetria, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($rowdata['idSistema'])){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'telemetria_listado', '', "Nombre='".$Nombre."' AND idSistema='".$rowdata['idSistema']."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//Se verifica si el dato existe
			if(isset($Identificador)&&isset($rowdata['idSistema'])){
				$ndata_2 = db_select_nrows (false, 'Identificador', 'telemetria_listado', '', "Identificador='".$Identificador."' AND idSistema='".$rowdata['idSistema']."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre del equipo ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El identificador del equipo ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//bucle
				$qry = '';
				//Recorro la configuracion de los sensores
				for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
					$qry .= ',SensoresNombre_'.$i;
					$qry .= ',SensoresTipo_'.$i;
					$qry .= ',SensoresMedMin_'.$i;
					$qry .= ',SensoresMedMax_'.$i;
					$qry .= ',SensoresMedErrores_'.$i;
					$qry .= ',SensoresGrupo_'.$i;
					$qry .= ',SensoresUniMed_'.$i;
					$qry .= ',SensoresActivo_'.$i;
					$qry .= ',SensoresUso_'.$i;
					$qry .= ',SensoresFechaUso_'.$i;
					$qry .= ',SensoresAccionC_'.$i;
					$qry .= ',SensoresAccionT_'.$i;
					$qry .= ',SensoresAccionAlerta_'.$i;
					$qry .= ',SensoresMant_'.$i;
					$qry .= ',SensoresRevision_'.$i;
					$qry .= ',SensoresRevisionGrupo_'.$i;
					
				}

				/*******************************************************************/
				// Se traen todos los datos de la maquina
				$SIS_query = 'idSistema,idCiudad,idComuna,Direccion,GeoLatitud,GeoLongitud,GeoVelocidad,
				GeoDireccion,GeoMovimiento,GeoTiempoDetencion,id_Geo,id_Sensores,cantSensores,idDispositivo,
				idShield,idEstadoEncendido,LimiteVelocidad,idAlarmaGeneral,NDetenciones,TiempoFueraLinea,
				TiempoDetencion,Direccion_img,idZona,IP_Client,SensorActivacionID,SensorActivacionValor,
				Jornada_inicio,Jornada_termino,Colacion_inicio,Colacion_termino,Microparada,idUsoContrato,
				idContrato,Codigo,Capacidad,F_Inicio,F_Termino,idUsoPredio,idUsoGeocerca,
				NErroresGeocercaMax,idTipo,Marca,Modelo,Patente,Num_serie,AnoFab,CapacidadPersonas,
				CapacidadKilos,MCubicos,idTab,idMatriz,CrossCrane_tiempo_revision,
				CrossCrane_grupo_amperaje,CrossCrane_grupo_elevacion,CrossCrane_grupo_giro,
				CrossCrane_grupo_carro,CrossCrane_grupo_voltaje,CrossCrane_grupo_motor_subida,
				CrossCrane_grupo_motor_bajada,FechaMantencionIni,FechaMantencionTer,HoraMantencionIni,
				HoraMantencionTer,Hor_idActivo_dia1,Hor_idActivo_dia2,Hor_idActivo_dia3,Hor_idActivo_dia4,
				Hor_idActivo_dia5,Hor_idActivo_dia6,Hor_idActivo_dia7,Hor_Inicio_dia1,Hor_Inicio_dia2,
				Hor_Inicio_dia3,Hor_Inicio_dia4,Hor_Inicio_dia5,Hor_Inicio_dia6,Hor_Inicio_dia7,
				Hor_Termino_dia1,Hor_Termino_dia2,Hor_Termino_dia3,Hor_Termino_dia4,Hor_Termino_dia5,
				Hor_Termino_dia6,Hor_Termino_dia7'.$qry;
				$rowdata = db_select_data (false, $SIS_query, 'telemetria_listado', '', 'idTelemetria = '.$idTelemetria, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				/*******************************************************************/
				//Datos ingresados
				if(isset($idEstado) && $idEstado != ''){           $a = "'".$idEstado."'" ;          }else{$a = "''";}
				if(isset($Identificador) && $Identificador != ''){ $a .= ",'".$Identificador."'" ;   }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){               $a .= ",'".$Nombre."'" ;          }else{$a .= ",''";}
				
				//Datos copiados
				if(isset($rowdata['idSistema']) && $rowdata['idSistema'] != ''){                                          $a .= ",'".$rowdata['idSistema']."'" ;                       }else{$a .= ",''";}
				if(isset($rowdata['idCiudad']) && $rowdata['idCiudad'] != ''){                                            $a .= ",'".$rowdata['idCiudad']."'" ;                        }else{$a .= ",''";}
				if(isset($rowdata['idComuna']) && $rowdata['idComuna'] != ''){                                            $a .= ",'".$rowdata['idComuna']."'" ;                        }else{$a .= ",''";}
				if(isset($rowdata['Direccion']) && $rowdata['Direccion'] != ''){                                          $a .= ",'".$rowdata['Direccion']."'" ;                       }else{$a .= ",''";}
				if(isset($rowdata['GeoLatitud']) && $rowdata['GeoLatitud'] != ''){                                        $a .= ",'".$rowdata['GeoLatitud']."'" ;                      }else{$a .= ",''";}
				if(isset($rowdata['GeoLongitud']) && $rowdata['GeoLongitud'] != ''){                                      $a .= ",'".$rowdata['GeoLongitud']."'" ;                     }else{$a .= ",''";}
				if(isset($rowdata['GeoVelocidad']) && $rowdata['GeoVelocidad'] != ''){                                    $a .= ",'".$rowdata['GeoVelocidad']."'" ;                    }else{$a .= ",''";}
				if(isset($rowdata['GeoDireccion']) && $rowdata['GeoDireccion'] != ''){                                    $a .= ",'".$rowdata['GeoDireccion']."'" ;                    }else{$a .= ",''";}
				if(isset($rowdata['GeoMovimiento']) && $rowdata['GeoMovimiento'] != ''){                                  $a .= ",'".$rowdata['GeoMovimiento']."'" ;                   }else{$a .= ",''";}
				if(isset($rowdata['GeoTiempoDetencion']) && $rowdata['GeoTiempoDetencion'] != ''){                        $a .= ",'".$rowdata['GeoTiempoDetencion']."'" ;              }else{$a .= ",''";}
				if(isset($rowdata['id_Geo']) && $rowdata['id_Geo'] != ''){                                                $a .= ",'".$rowdata['id_Geo']."'" ;                          }else{$a .= ",''";}
				if(isset($rowdata['id_Sensores']) && $rowdata['id_Sensores'] != ''){                                      $a .= ",'".$rowdata['id_Sensores']."'" ;                     }else{$a .= ",''";}
				if(isset($rowdata['cantSensores']) && $rowdata['cantSensores'] != ''){                                    $a .= ",'".$rowdata['cantSensores']."'" ;                    }else{$a .= ",''";}
				if(isset($rowdata['idDispositivo']) && $rowdata['idDispositivo'] != ''){                                  $a .= ",'".$rowdata['idDispositivo']."'" ;                   }else{$a .= ",''";}
				if(isset($rowdata['idShield']) && $rowdata['idShield'] != ''){                                            $a .= ",'".$rowdata['idShield']."'" ;                        }else{$a .= ",''";}
				if(isset($rowdata['idEstadoEncendido']) && $rowdata['idEstadoEncendido'] != ''){                          $a .= ",'".$rowdata['idEstadoEncendido']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['LimiteVelocidad']) && $rowdata['LimiteVelocidad'] != ''){                              $a .= ",'".$rowdata['LimiteVelocidad']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['idAlarmaGeneral']) && $rowdata['idAlarmaGeneral'] != ''){                              $a .= ",'".$rowdata['idAlarmaGeneral']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['TiempoFueraLinea']) && $rowdata['TiempoFueraLinea'] != ''){                            $a .= ",'".$rowdata['TiempoFueraLinea']."'" ;                }else{$a .= ",''";}
				if(isset($rowdata['TiempoDetencion']) && $rowdata['TiempoDetencion'] != ''){                              $a .= ",'".$rowdata['TiempoDetencion']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['Direccion_img']) && $rowdata['Direccion_img'] != ''){                                  $a .= ",'".$rowdata['Direccion_img']."'" ;                   }else{$a .= ",''";}
				if(isset($rowdata['idZona']) && $rowdata['idZona'] != ''){                                                $a .= ",'".$rowdata['idZona']."'" ;                          }else{$a .= ",''";}
				if(isset($rowdata['SensorActivacionID']) && $rowdata['SensorActivacionID'] != ''){                        $a .= ",'".$rowdata['SensorActivacionID']."'" ;              }else{$a .= ",''";}
				if(isset($rowdata['SensorActivacionValor']) && $rowdata['SensorActivacionValor'] != ''){                  $a .= ",'".$rowdata['SensorActivacionValor']."'" ;           }else{$a .= ",''";}
				if(isset($rowdata['Jornada_inicio']) && $rowdata['Jornada_inicio'] != ''){                                $a .= ",'".$rowdata['Jornada_inicio']."'" ;                  }else{$a .= ",''";}
				if(isset($rowdata['Jornada_termino']) && $rowdata['Jornada_termino'] != ''){                              $a .= ",'".$rowdata['Jornada_termino']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['Colacion_inicio']) && $rowdata['Colacion_inicio'] != ''){                              $a .= ",'".$rowdata['Colacion_inicio']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['Colacion_termino']) && $rowdata['Colacion_termino'] != ''){                            $a .= ",'".$rowdata['Colacion_termino']."'" ;                }else{$a .= ",''";}
				if(isset($rowdata['Microparada']) && $rowdata['Microparada'] != ''){                                      $a .= ",'".$rowdata['Microparada']."'" ;                     }else{$a .= ",''";}
				if(isset($rowdata['idUsoContrato']) && $rowdata['idUsoContrato'] != ''){                                  $a .= ",'".$rowdata['idUsoContrato']."'" ;                   }else{$a .= ",''";}
				if(isset($rowdata['idContrato']) && $rowdata['idContrato'] != ''){                                        $a .= ",'".$rowdata['idContrato']."'" ;                      }else{$a .= ",''";}
				if(isset($rowdata['Codigo']) && $rowdata['Codigo'] != ''){                                                $a .= ",'".$rowdata['Codigo']."'" ;                          }else{$a .= ",''";}
				if(isset($rowdata['Capacidad']) && $rowdata['Capacidad'] != ''){                                          $a .= ",'".$rowdata['Capacidad']."'" ;                       }else{$a .= ",''";}
				if(isset($rowdata['F_Inicio']) && $rowdata['F_Inicio'] != ''){                                            $a .= ",'".$rowdata['F_Inicio']."'" ;                        }else{$a .= ",''";}
				if(isset($rowdata['F_Termino']) && $rowdata['F_Termino'] != ''){                                          $a .= ",'".$rowdata['F_Termino']."'" ;                       }else{$a .= ",''";}
				if(isset($rowdata['idUsoPredio']) && $rowdata['idUsoPredio'] != ''){                                      $a .= ",'".$rowdata['idUsoPredio']."'" ;                     }else{$a .= ",''";}
				if(isset($rowdata['idUsoGeocerca']) && $rowdata['idUsoGeocerca'] != ''){                                  $a .= ",'".$rowdata['idUsoGeocerca']."'" ;                   }else{$a .= ",''";}
				if(isset($rowdata['NErroresGeocercaMax']) && $rowdata['NErroresGeocercaMax'] != ''){                      $a .= ",'".$rowdata['NErroresGeocercaMax']."'" ;             }else{$a .= ",''";}
				if(isset($rowdata['idTipo']) && $rowdata['idTipo'] != ''){                                                $a .= ",'".$rowdata['idTipo']."'" ;                          }else{$a .= ",''";}
				if(isset($rowdata['Marca']) && $rowdata['Marca'] != ''){                                                  $a .= ",'".$rowdata['Marca']."'" ;                           }else{$a .= ",''";}
				if(isset($rowdata['Modelo']) && $rowdata['Modelo'] != ''){                                                $a .= ",'".$rowdata['Modelo']."'" ;                          }else{$a .= ",''";}
				if(isset($rowdata['Patente']) && $rowdata['Patente'] != ''){                                              $a .= ",'".$rowdata['Patente']."'" ;                         }else{$a .= ",''";}
				if(isset($rowdata['Num_serie']) && $rowdata['Num_serie'] != ''){                                          $a .= ",'".$rowdata['Num_serie']."'" ;                       }else{$a .= ",''";}
				if(isset($rowdata['AnoFab']) && $rowdata['AnoFab'] != ''){                                                $a .= ",'".$rowdata['AnoFab']."'" ;                          }else{$a .= ",''";}
				if(isset($rowdata['CapacidadPersonas']) && $rowdata['CapacidadPersonas'] != ''){                          $a .= ",'".$rowdata['CapacidadPersonas']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['CapacidadKilos']) && $rowdata['CapacidadKilos'] != ''){                                $a .= ",'".$rowdata['CapacidadKilos']."'" ;                  }else{$a .= ",''";}
				if(isset($rowdata['MCubicos']) && $rowdata['MCubicos'] != ''){                                            $a .= ",'".$rowdata['MCubicos']."'" ;                        }else{$a .= ",''";}
				if(isset($rowdata['idTab']) && $rowdata['idTab'] != ''){                                                  $a .= ",'".$rowdata['idTab']."'" ;                           }else{$a .= ",''";}
				if(isset($rowdata['idMatriz']) && $rowdata['idMatriz'] != ''){                                            $a .= ",'".$rowdata['idMatriz']."'" ;                        }else{$a .= ",''";}
				if(isset($rowdata['CrossCrane_tiempo_revision']) && $rowdata['CrossCrane_tiempo_revision'] != ''){        $a .= ",'".$rowdata['CrossCrane_tiempo_revision']."'" ;      }else{$a .= ",''";}
				if(isset($rowdata['CrossCrane_grupo_amperaje']) && $rowdata['CrossCrane_grupo_amperaje'] != ''){          $a .= ",'".$rowdata['CrossCrane_grupo_amperaje']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['CrossCrane_grupo_elevacion']) && $rowdata['CrossCrane_grupo_elevacion'] != ''){        $a .= ",'".$rowdata['CrossCrane_grupo_elevacion']."'" ;      }else{$a .= ",''";}
				if(isset($rowdata['CrossCrane_grupo_giro']) && $rowdata['CrossCrane_grupo_giro'] != ''){                  $a .= ",'".$rowdata['CrossCrane_grupo_giro']."'" ;           }else{$a .= ",''";}
				if(isset($rowdata['CrossCrane_grupo_carro']) && $rowdata['CrossCrane_grupo_carro'] != ''){                $a .= ",'".$rowdata['CrossCrane_grupo_carro']."'" ;          }else{$a .= ",''";}
				if(isset($rowdata['CrossCrane_grupo_voltaje']) && $rowdata['CrossCrane_grupo_voltaje'] != ''){            $a .= ",'".$rowdata['CrossCrane_grupo_voltaje']."'" ;        }else{$a .= ",''";}
				if(isset($rowdata['CrossCrane_grupo_motor_subida']) && $rowdata['CrossCrane_grupo_motor_subida'] != ''){  $a .= ",'".$rowdata['CrossCrane_grupo_motor_subida']."'" ;   }else{$a .= ",''";}
				if(isset($rowdata['CrossCrane_grupo_motor_bajada']) && $rowdata['CrossCrane_grupo_motor_bajada'] != ''){  $a .= ",'".$rowdata['CrossCrane_grupo_motor_bajada']."'" ;   }else{$a .= ",''";}
				if(isset($rowdata['FechaMantencionIni']) && $rowdata['FechaMantencionIni'] != ''){                        $a .= ",'".$rowdata['FechaMantencionIni']."'" ;              }else{$a .= ",''";}
				if(isset($rowdata['FechaMantencionTer']) && $rowdata['FechaMantencionTer'] != ''){                        $a .= ",'".$rowdata['FechaMantencionTer']."'" ;              }else{$a .= ",''";}
				if(isset($rowdata['HoraMantencionIni']) && $rowdata['HoraMantencionIni'] != ''){                          $a .= ",'".$rowdata['HoraMantencionIni']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['HoraMantencionTer']) && $rowdata['HoraMantencionTer'] != ''){                          $a .= ",'".$rowdata['HoraMantencionTer']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia1']) && $rowdata['Hor_idActivo_dia1'] != ''){                          $a .= ",'".$rowdata['Hor_idActivo_dia1']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia2']) && $rowdata['Hor_idActivo_dia2'] != ''){                          $a .= ",'".$rowdata['Hor_idActivo_dia2']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia3']) && $rowdata['Hor_idActivo_dia3'] != ''){                          $a .= ",'".$rowdata['Hor_idActivo_dia3']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia4']) && $rowdata['Hor_idActivo_dia4'] != ''){                          $a .= ",'".$rowdata['Hor_idActivo_dia4']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia5']) && $rowdata['Hor_idActivo_dia5'] != ''){                          $a .= ",'".$rowdata['Hor_idActivo_dia5']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia6']) && $rowdata['Hor_idActivo_dia6'] != ''){                          $a .= ",'".$rowdata['Hor_idActivo_dia6']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['Hor_idActivo_dia7']) && $rowdata['Hor_idActivo_dia7'] != ''){                          $a .= ",'".$rowdata['Hor_idActivo_dia7']."'" ;               }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia1']) && $rowdata['Hor_Inicio_dia1'] != ''){                              $a .= ",'".$rowdata['Hor_Inicio_dia1']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia2']) && $rowdata['Hor_Inicio_dia2'] != ''){                              $a .= ",'".$rowdata['Hor_Inicio_dia2']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia3']) && $rowdata['Hor_Inicio_dia3'] != ''){                              $a .= ",'".$rowdata['Hor_Inicio_dia3']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia4']) && $rowdata['Hor_Inicio_dia4'] != ''){                              $a .= ",'".$rowdata['Hor_Inicio_dia4']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia5']) && $rowdata['Hor_Inicio_dia5'] != ''){                              $a .= ",'".$rowdata['Hor_Inicio_dia5']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia6']) && $rowdata['Hor_Inicio_dia6'] != ''){                              $a .= ",'".$rowdata['Hor_Inicio_dia6']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['Hor_Inicio_dia7']) && $rowdata['Hor_Inicio_dia7'] != ''){                              $a .= ",'".$rowdata['Hor_Inicio_dia7']."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia1']) && $rowdata['Hor_Termino_dia1'] != ''){                            $a .= ",'".$rowdata['Hor_Termino_dia1']."'" ;                }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia2']) && $rowdata['Hor_Termino_dia2'] != ''){                            $a .= ",'".$rowdata['Hor_Termino_dia2']."'" ;                }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia3']) && $rowdata['Hor_Termino_dia3'] != ''){                            $a .= ",'".$rowdata['Hor_Termino_dia3']."'" ;                }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia4']) && $rowdata['Hor_Termino_dia4'] != ''){                            $a .= ",'".$rowdata['Hor_Termino_dia4']."'" ;                }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia5']) && $rowdata['Hor_Termino_dia5'] != ''){                            $a .= ",'".$rowdata['Hor_Termino_dia5']."'" ;                }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia6']) && $rowdata['Hor_Termino_dia6'] != ''){                            $a .= ",'".$rowdata['Hor_Termino_dia6']."'" ;                }else{$a .= ",''";}
				if(isset($rowdata['Hor_Termino_dia7']) && $rowdata['Hor_Termino_dia7'] != ''){                            $a .= ",'".$rowdata['Hor_Termino_dia7']."'" ;                }else{$a .= ",''";}
				
				//datos en bruto
				$a .= ",'0'" ; //GeoErrores
				$a .= ",'0'" ; //LastUpdateFecha
				$a .= ",'0'" ; //LastUpdateHora
				$a .= ",''" ;  //Sim_Num_Tel
				$a .= ",''" ;  //Sim_Num_Serie
				$a .= ",''" ;  //Sim_marca
				$a .= ",''" ;  //Sim_modelo
				$a .= ",''" ;  //Sim_Compania
				$a .= ",''" ;  //IdentificadorEmpresa
				$a .= ",'0'" ; //NErrores
				$a .= ",'0'" ; //NAlertas
				$a .= ",'2'" ; //idUsoFTP
				$a .= ",''" ;  //FTP_Carpeta
				$a .= ",'2'" ; //idBackup
				$a .= ",'0'" ; //NregBackup
				$a .= ",''" ;  //Estado
				$a .= ",'2'" ; //idAlertaTemprana
				$a .= ",'2'" ; //idGenerador
				$a .= ",'0'" ; //NErroresGeocerca
				$a .= ",'2'" ; //idMantencion
				$a .= ",'0'" ; //idUsuarioMan
				$a .= ",'0'" ; //NDetenciones
				$a .= ",''" ;  //tabla_relacionada
				
				//bucle
				$qry = '';
				//Recorro la configuracion de los sensores
				for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
					if(isset($rowdata['SensoresNombre_'.$i]) && $rowdata['SensoresNombre_'.$i] != ''){                $a .= ",'".$rowdata['SensoresNombre_'.$i]."'" ;         }else{$a .= ",''";}
					if(isset($rowdata['SensoresTipo_'.$i]) && $rowdata['SensoresTipo_'.$i] != ''){                    $a .= ",'".$rowdata['SensoresTipo_'.$i]."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['SensoresMedMin_'.$i]) && $rowdata['SensoresMedMin_'.$i] != ''){                $a .= ",'".$rowdata['SensoresMedMin_'.$i]."'" ;         }else{$a .= ",''";}
					if(isset($rowdata['SensoresMedMax_'.$i]) && $rowdata['SensoresMedMax_'.$i] != ''){                $a .= ",'".$rowdata['SensoresMedMax_'.$i]."'" ;         }else{$a .= ",''";}
					if(isset($rowdata['SensoresMedErrores_'.$i]) && $rowdata['SensoresMedErrores_'.$i] != ''){        $a .= ",'".$rowdata['SensoresMedErrores_'.$i]."'" ;     }else{$a .= ",''";}
					if(isset($rowdata['SensoresGrupo_'.$i]) && $rowdata['SensoresGrupo_'.$i] != ''){                  $a .= ",'".$rowdata['SensoresGrupo_'.$i]."'" ;          }else{$a .= ",''";}
					if(isset($rowdata['SensoresUniMed_'.$i]) && $rowdata['SensoresUniMed_'.$i] != ''){                $a .= ",'".$rowdata['SensoresUniMed_'.$i]."'" ;         }else{$a .= ",''";}
					if(isset($rowdata['SensoresActivo_'.$i]) && $rowdata['SensoresActivo_'.$i] != ''){                $a .= ",'".$rowdata['SensoresActivo_'.$i]."'" ;         }else{$a .= ",''";}
					if(isset($rowdata['SensoresUso_'.$i]) && $rowdata['SensoresUso_'.$i] != ''){                      $a .= ",'".$rowdata['SensoresUso_'.$i]."'" ;            }else{$a .= ",''";}
					if(isset($rowdata['SensoresFechaUso_'.$i]) && $rowdata['SensoresFechaUso_'.$i] != ''){            $a .= ",'".$rowdata['SensoresFechaUso_'.$i]."'" ;       }else{$a .= ",''";}
					if(isset($rowdata['SensoresAccionC_'.$i]) && $rowdata['SensoresAccionC_'.$i] != ''){              $a .= ",'".$rowdata['SensoresAccionC_'.$i]."'" ;        }else{$a .= ",''";}
					if(isset($rowdata['SensoresAccionT_'.$i]) && $rowdata['SensoresAccionT_'.$i] != ''){              $a .= ",'".$rowdata['SensoresAccionT_'.$i]."'" ;        }else{$a .= ",''";}
					if(isset($rowdata['SensoresAccionAlerta_'.$i]) && $rowdata['SensoresAccionAlerta_'.$i] != ''){    $a .= ",'".$rowdata['SensoresAccionAlerta_'.$i]."'" ;   }else{$a .= ",''";}
					if(isset($rowdata['SensoresMant_'.$i]) && $rowdata['SensoresMant_'.$i] != ''){                    $a .= ",'".$rowdata['SensoresMant_'.$i]."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['SensoresRevision_'.$i]) && $rowdata['SensoresRevision_'.$i] != ''){            $a .= ",'".$rowdata['SensoresRevision_'.$i]."'" ;       }else{$a .= ",''";}
					if(isset($rowdata['SensoresRevisionGrupo_'.$i]) && $rowdata['SensoresRevisionGrupo_'.$i] != ''){  $a .= ",'".$rowdata['SensoresRevisionGrupo_'.$i]."'" ;  }else{$a .= ",''";}
					
					//lineas a completar
					$qry .= ',SensoresNombre_'.$i;
					$qry .= ',SensoresTipo_'.$i;
					$qry .= ',SensoresMedMin_'.$i;
					$qry .= ',SensoresMedMax_'.$i;
					$qry .= ',SensoresMedErrores_'.$i;
					$qry .= ',SensoresGrupo_'.$i;
					$qry .= ',SensoresUniMed_'.$i;
					$qry .= ',SensoresActivo_'.$i;
					$qry .= ',SensoresUso_'.$i;
					$qry .= ',SensoresFechaUso_'.$i;
					$qry .= ',SensoresAccionC_'.$i;
					$qry .= ',SensoresAccionT_'.$i;
					$qry .= ',SensoresAccionAlerta_'.$i;
					$qry .= ',SensoresMant_'.$i;
					$qry .= ',SensoresRevision_'.$i;
					$qry .= ',SensoresRevisionGrupo_'.$i;
				}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_listado` (idEstado,Identificador,Nombre,idSistema,
				idCiudad,idComuna,Direccion,GeoLatitud,GeoLongitud,GeoVelocidad,GeoDireccion,GeoMovimiento,
				GeoTiempoDetencion,id_Geo,id_Sensores,cantSensores,idDispositivo,idShield,idEstadoEncendido,
				LimiteVelocidad,idAlarmaGeneral,TiempoFueraLinea,TiempoDetencion,Direccion_img,idZona,
				SensorActivacionID,SensorActivacionValor,Jornada_inicio,Jornada_termino,Colacion_inicio,
				Colacion_termino,Microparada,idUsoContrato,idContrato,Codigo,Capacidad,F_Inicio,F_Termino,
				idUsoPredio,idUsoGeocerca,NErroresGeocercaMax,idTipo,Marca,Modelo,Patente,Num_serie,AnoFab,
				CapacidadPersonas,CapacidadKilos,MCubicos,idTab,idMatriz,CrossCrane_tiempo_revision,
				CrossCrane_grupo_amperaje,CrossCrane_grupo_elevacion,CrossCrane_grupo_giro,
				CrossCrane_grupo_carro,CrossCrane_grupo_voltaje,CrossCrane_grupo_motor_subida,
				CrossCrane_grupo_motor_bajada,FechaMantencionIni,FechaMantencionTer,HoraMantencionIni,
				HoraMantencionTer,Hor_idActivo_dia1,Hor_idActivo_dia2,Hor_idActivo_dia3,Hor_idActivo_dia4,
				Hor_idActivo_dia5,Hor_idActivo_dia6,Hor_idActivo_dia7,Hor_Inicio_dia1,Hor_Inicio_dia2,
				Hor_Inicio_dia3,Hor_Inicio_dia4,Hor_Inicio_dia5,Hor_Inicio_dia6,Hor_Inicio_dia7,
				Hor_Termino_dia1,Hor_Termino_dia2,Hor_Termino_dia3,Hor_Termino_dia4,Hor_Termino_dia5,
				Hor_Termino_dia6,Hor_Termino_dia7,GeoErrores,LastUpdateFecha,LastUpdateHora,Sim_Num_Tel,
				Sim_Num_Serie,Sim_marca,Sim_modelo,Sim_Compania,IdentificadorEmpresa,NErrores,NAlertas,
				idUsoFTP,FTP_Carpeta,idBackup,NregBackup,Estado,idAlertaTemprana,idGenerador,NErroresGeocerca,
				idMantencion,idUsuarioMan,NDetenciones,tabla_relacionada
				".$qry.") 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if(!$resultado){
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
					
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
				}else{
					//recibo el último id generado por mi sesion
					$telemetria_id = mysqli_insert_id($dbConn);
					
					// elimino la tabla si es que existe
					$query  = "DROP TABLE IF EXISTS `telemetria_listado_tablarelacionada_".$telemetria_id."`";
					$result = mysqli_query($dbConn, $query);
					
					$tr_column = '';
					//Recorro la configuracion de los sensores
					for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
						$tr_column .= '`Sensor_'.$i.'` decimal(20,6) NOT NULL,';
					}
					// se crea la nueva tabla
					$query  = "CREATE TABLE `telemetria_listado_tablarelacionada_".$telemetria_id."` (
					`idTabla` int(11) unsigned NOT NULL AUTO_INCREMENT,
					`idTelemetria` int(11) unsigned NOT NULL,
					`idContrato` int(11) unsigned NOT NULL,
					`idSolicitud` int(11) unsigned NOT NULL,
					`idZona` int(11) unsigned NOT NULL,
					`idGeocerca` int(11) unsigned NOT NULL,
					`Fecha` date NOT NULL,
					`Hora` time NOT NULL,
					`FechaSistema` date NOT NULL,
					`HoraSistema` time NOT NULL,
					`TimeStamp` datetime NOT NULL,
					`GeoLatitud` double NOT NULL,
					`GeoLongitud` double NOT NULL,
					`GeoVelocidad` decimal(20,6) NOT NULL,
					`GeoDireccion` decimal(20,6) NOT NULL,
					`GeoMovimiento` decimal(20,6) NOT NULL,
					`Segundos` int(11) unsigned NOT NULL,
					`Diferencia` decimal(20,6) NOT NULL,
					".$tr_column."
					  PRIMARY KEY (`idTabla`)
					) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='Dinamica';";
					$result = mysqli_query($dbConn, $query);
					
					/*******************************************************/
					//se actualizan los datos
					$a = "tabla_relacionada='telemetria_listado_tablarelacionada_".$telemetria_id."'" ;
					$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$telemetria_id.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					//Si ejecuto correctamente la consulta
					if($resultado==true){
						
						/*******************************************************/
						//Consulto las alertas personalizadas
						$arrLVL_1 = array();
						$arrLVL_1 = db_select_array (false, 'idAlarma, Nombre, idTipo, idTipoAlerta, idUniMed, valor_error, valor_diferencia, Rango_ini, Rango_fin, NErroresMax', 'telemetria_listado_alarmas_perso', '', 'idTelemetria = '.$idTelemetria, 'idAlarma ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
						$arrLVL_2 = array();
						$arrLVL_2 = db_select_array (false, 'idAlarma, Sensor_N, Rango_ini, Rango_fin, valor_especifico', 'telemetria_listado_alarmas_perso_items', '', 'idTelemetria = '.$idTelemetria, 'idAlarma ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
						
						foreach ($arrLVL_1 as $lvl_1) {
					
							//Se crea la maquina
							$a  = "'".$telemetria_id."'" ;          
							$a .= ",'".$lvl_1['Nombre']."'" ;
							$a .= ",'".$lvl_1['idTipo']."'" ;
							$a .= ",'".$lvl_1['idTipoAlerta']."'" ;
							$a .= ",'".$lvl_1['idUniMed']."'" ;
							$a .= ",'".$lvl_1['valor_error']."'" ;
							$a .= ",'".$lvl_1['valor_diferencia']."'" ;
							$a .= ",'".$lvl_1['Rango_ini']."'" ; 
							$a .= ",'".$lvl_1['Rango_fin']."'" ; 
							$a .= ",'".$lvl_1['NErroresMax']."'" ; 
							$a .= ",'0'" ; 
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `telemetria_listado_alarmas_perso` (idTelemetria,Nombre,
							idTipo,idTipoAlerta,idUniMed,valor_error,valor_diferencia,Rango_ini,Rango_fin,
							NErroresMax,NErroresActual) 
							VALUES (".$a.")";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//recibo el último id generado por mi sesion
							$id_lvl_1 = mysqli_insert_id($dbConn);
							
							//Nivel 2
							foreach ($arrLVL_2 as $lvl_2) {
								//Se verifica que sea el mismo sensor
								if($lvl_1['idAlarma']==$lvl_2['idAlarma']){
									
									//Se crea la maquina
									$a  = "'".$telemetria_id."'" ; 
									$a .= ",'".$id_lvl_1."'" ; 
									$a .= ",'".$lvl_2['Sensor_N']."'" ;
									$a .= ",'".$lvl_2['Rango_ini']."'" ;
									$a .= ",'".$lvl_2['Rango_fin']."'" ;
									$a .= ",'".$lvl_2['valor_especifico']."'" ;
					 
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `telemetria_listado_alarmas_perso_items` (idTelemetria,
									idAlarma,Sensor_N,Rango_ini,Rango_fin,valor_especifico) 
									VALUES (".$a.")";
									//Consulta
									$resultado = mysqli_query ($dbConn, $query);
									
								}
							}
						}
						
						/*******************************************************/
						//Consulto las definiciones operacionales
						$SIS_query = 'N_Sensor, ValorActivo, RangoMinimo, RangoMaximo, idFuncion';
						$SIS_join  = '';
						$SIS_where = 'idTelemetria ='.$idTelemetria;
						$SIS_order = 'idDefinicion ASC';
						$arrOperaciones = array();
						$arrOperaciones = db_select_array (false, $SIS_query, 'telemetria_listado_definicion_operacional', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrOperaciones');
						
						//recorro las definiciones
						foreach ($arrOperaciones as $oper) {
							//filtros
							if(isset($telemetria_id) && $telemetria_id != ''){             $a  = "'".$telemetria_id."'" ;          }else{$a  ="''";}
							if(isset($oper['N_Sensor']) && $oper['N_Sensor'] != ''){       $a .= ",'".$oper['N_Sensor']."'" ;      }else{$a .= ",''";}
							if(isset($oper['ValorActivo']) && $oper['ValorActivo'] != ''){ $a .= ",'".$oper['ValorActivo']."'" ;   }else{$a .= ",''";}
							if(isset($oper['RangoMinimo']) && $oper['RangoMinimo'] != ''){ $a .= ",'".$oper['RangoMinimo']."'" ;   }else{$a .= ",''";}
							if(isset($oper['RangoMaximo']) && $oper['RangoMaximo'] != ''){ $a .= ",'".$oper['RangoMaximo']."'" ;   }else{$a .= ",''";}
							if(isset($oper['idFuncion']) && $oper['idFuncion'] != ''){     $a .= ",'".$oper['idFuncion']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `telemetria_listado_definicion_operacional` (idTelemetria, N_Sensor, 
							ValorActivo, RangoMinimo, RangoMaximo, idFuncion) VALUES (".$a.")";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
						}
						
						/*******************************************************/
						//Redirijo
						header( 'Location: '.$location.'&id='.$telemetria_id.'&created=true' );
						die;
						
					}
				}
			}
			
		break;	
/*******************************************************************************************************************/		
		case 'mant_create':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idTelemetria='".$idTelemetria."'" ;
				if(isset($idEstado) && $idEstado != ''){                            $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idMantencion)&& $idMantencion != '' ){                    $a .= ",idMantencion='".$idMantencion."'" ;}
				if(isset($idUsuarioMan)&& $idUsuarioMan != '' ){                    $a .= ",idUsuarioMan='".$idUsuarioMan."'" ;}
				if(isset($idMatriz)&& $idMatriz != '' ){                            $a .= ",idMatriz='".$idMatriz."'" ;}
				if(isset($FechaMantencionIni)&& $FechaMantencionIni != '' ){        $a .= ",FechaMantencionIni='".$FechaMantencionIni."'" ;}
				if(isset($HoraMantencionIni)&& $HoraMantencionIni != '' ){          $a .= ",HoraMantencionIni='".$HoraMantencionIni."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$idTelemetria.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					header( 'Location: '.$location.'&create=true&verify='.$idTelemetria );
					die;
				}
			}
		
	
		break;	
/*******************************************************************************************************************/		
		case 'mant_reset':			
		
		//Se elimina la restriccion del sql 5.7
		mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
		//Traigo todos los valores	
		$a = "SensoresMant_1=''";
		//Recorro la configuracion de los sensores
		for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
			$a .= ",SensoresMant_".$i."=''";
		}
		
		/*******************************************************/
		//se actualizan los datos
		$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$_GET['verify'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
		//Si ejecuto correctamente la consulta
		if($resultado==true){
			header( 'Location: '.$location.'&reseted=true' );
			die;
		}
		

		break;	
/*******************************************************************************************************************/		
		case 'mant_end':	
		
		//Se elimina la restriccion del sql 5.7
		mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
		/***************************************************************/
		//Se consultan los datos
		$subquery = '';
		//Recorro la configuracion de los sensores
		for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
			$subquery .= ',SensoresMant_'.$i.' AS Tel_Sensor_Valor_'.$i;
		}

		// consulto los datos
		$rowdata = db_select_data (false, 'idTelemetria, idUsuarioMan, idMatriz, FechaMantencionIni, HoraMantencionIni '.$subquery, 'telemetria_listado', '', 'idTelemetria = '.$_GET['verify'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
		
		/***************************************************************/
		//Se guardan los datos
		if(isset($rowdata['idTelemetria']) && $rowdata['idTelemetria'] != ''){              $a  = "'".$rowdata['idTelemetria']."'" ;          }else{$a ="''";}
		if(isset($rowdata['idUsuarioMan']) && $rowdata['idUsuarioMan'] != ''){              $a .= ",'".$rowdata['idUsuarioMan']."'" ;         }else{$a .= ",''";}
		if(isset($rowdata['idMatriz']) && $rowdata['idMatriz'] != ''){                      $a .= ",'".$rowdata['idMatriz']."'" ;             }else{$a .= ",''";}
		if(isset($rowdata['FechaMantencionIni']) && $rowdata['FechaMantencionIni'] != ''){  $a .= ",'".$rowdata['FechaMantencionIni']."'" ;   }else{$a .= ",''";}
		if(isset($rowdata['HoraMantencionIni']) && $rowdata['HoraMantencionIni'] != ''){    $a .= ",'".$rowdata['HoraMantencionIni']."'" ;    }else{$a .= ",''";}
		$a .= ",'".fecha_actual()."'" ;		
		$a .= ",'".hora_actual()."'" ;		
		$a .= ",'1'" ;	
		$a .= ",'Sin Observaciones'" ;	
		
		//Se guardan los datos en la tabla de mantenciones ejecutadas
		$in_qry = '';
		//Recorro la configuracion de los sensores
		for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
			$in_qry .= ',SensoresMant_'.$i;
			$a .= ",'".$rowdata['Tel_Sensor_Valor_'.$i]."'" ;	
		}
		
		$query  = "INSERT INTO `telemetria_mantencion_ejecutada` (idTelemetria,idUsuarioMan,
		idMatriz,FechaMantencionIni,HoraMantencionIni,FechaMantencionTer,HoraMantencionTer,
		idEstado, Observacion
		".$in_qry."
		) 
		VALUES (".$a.")";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
					
			//Genero numero aleatorio
			$vardata = genera_password(8,'alfanumerico');
					
			//Guardo el error en una variable temporal
			$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
			$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
			$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
		}
		
		
		/***************************************************************/
		//Actualizo el estado y saco la maquina de mantencion
		$a = "idMantencion='2'";
		$a .= ",idEstado='1'";
		
		/*******************************************************/
		//se actualizan los datos
		$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$rowdata['idTelemetria'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
		//Si ejecuto correctamente la consulta
		if($resultado==true){
			header( 'Location: '.$location.'&ended=true' );
			die;		
		}
		

		
		break;	
/*******************************************************************************************************************/		
		case 'mant_cancel':	
		
		//Se elimina la restriccion del sql 5.7
		mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
		/***************************************************************/
		//Se consultan los datos
		$subquery = '';
		//Recorro la configuracion de los sensores
		for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
			$subquery .= ',SensoresMant_'.$i.' AS Tel_Sensor_Valor_'.$i;
		}

		// consulto los datos
		$rowdata = db_select_data (false, 'idTelemetria, idUsuarioMan, idMatriz, FechaMantencionIni, HoraMantencionIni '.$subquery, 'telemetria_listado', '', 'idTelemetria = '.$idTelemetria, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
		
		/***************************************************************/
		//Se guardan los datos
		if(isset($rowdata['idTelemetria']) && $rowdata['idTelemetria'] != ''){              $a  = "'".$rowdata['idTelemetria']."'" ;          }else{$a ="''";}
		if(isset($rowdata['idUsuarioMan']) && $rowdata['idUsuarioMan'] != ''){              $a .= ",'".$rowdata['idUsuarioMan']."'" ;         }else{$a .= ",''";}
		if(isset($rowdata['idMatriz']) && $rowdata['idMatriz'] != ''){                      $a .= ",'".$rowdata['idMatriz']."'" ;             }else{$a .= ",''";}
		if(isset($rowdata['FechaMantencionIni']) && $rowdata['FechaMantencionIni'] != ''){  $a .= ",'".$rowdata['FechaMantencionIni']."'" ;   }else{$a .= ",''";}
		if(isset($rowdata['HoraMantencionIni']) && $rowdata['HoraMantencionIni'] != ''){    $a .= ",'".$rowdata['HoraMantencionIni']."'" ;    }else{$a .= ",''";}
		$a .= ",'".fecha_actual()."'" ;		
		$a .= ",'".hora_actual()."'" ;		
		$a .= ",'2'" ;	
		$a .= ",'".$Observacion."'" ;	
		
		//Se guardan los datos en la tabla de mantenciones ejecutadas
		$in_qry = '';
		//Recorro la configuracion de los sensores
		for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
			$in_qry .= ',SensoresMant_'.$i;
			$a .= ",'".$rowdata['Tel_Sensor_Valor_'.$i]."'" ;	
		}
		
		$query  = "INSERT INTO `telemetria_mantencion_ejecutada` (idTelemetria,idUsuarioMan,
		idMatriz,FechaMantencionIni,HoraMantencionIni,FechaMantencionTer,HoraMantencionTer,
		idEstado, Observacion
		".$in_qry."
		) 
		VALUES (".$a.")";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
					
			//Genero numero aleatorio
			$vardata = genera_password(8,'alfanumerico');
					
			//Guardo el error en una variable temporal
			$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
			$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
			$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
		}
		
		
		/***************************************************************/
		//Actualizo el estado y saco la maquina de mantencion
		$a = "idMantencion='2'";
		$a .= ",idEstado='1'";
		
		/*******************************************************/
		//se actualizan los datos
		$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$rowdata['idTelemetria'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
		//Si ejecuto correctamente la consulta
		if($resultado==true){
			header( 'Location: '.$location.'&ended=true' );
			die;		
		}
		
		
		break;	

/*******************************************************************************************************************/
		//Cambio el estado de activo a inactivo
		case 'EstadoEncendido':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$idTelemetria       = $_GET['idTelemetria'];
			$idEstadoEncendido  = $_GET['idEstadoEncendido'];
			$idUsuario          = $_SESSION['usuario']['basic_data']['idUsuario'];
			$Fecha              = fecha_actual();
			$Hora               = hora_actual();
			$TimeStamp          = fecha_actual().' '.hora_actual();
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica el tipo de usuario
			if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
				//Se verifica si el dato existe
				if(isset($idTelemetria)&&$idTelemetria!=''){
					$ndata_1 = db_select_nrows (false, 'idTelemetria', 'usuarios_equipos_telemetria', '', "idTelemetria='".$idTelemetria."' AND idUsuario='".$idUsuario."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				//generacion de errores
				if($ndata_1==0) {$error['ndata_1'] = 'error/No tiene permiso para la edicion de este equipo de telemetria';}
			}
			/*******************************************************************/
			
				
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*******************************************************/
				//se actualizan los datos
				$a = "idEstadoEncendido='".$idEstadoEncendido."'" ;
				$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$idTelemetria.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//filtros
					if(isset($idTelemetria) && $idTelemetria != ''){            $a  = "'".$idTelemetria."'" ;         }else{$a  ="''";}
					if(isset($Fecha) && $Fecha != ''){                          $a .= ",'".$Fecha."'" ;               }else{$a .=",''";}
					if(isset($Hora) && $Hora != ''){                            $a .= ",'".$Hora."'" ;                }else{$a .=",''";}
					if(isset($TimeStamp) && $TimeStamp != ''){                  $a .= ",'".$TimeStamp."'" ;           }else{$a .=",''";}
					if(isset($idEstadoEncendido) && $idEstadoEncendido != ''){  $a .= ",'".$idEstadoEncendido."'" ;   }else{$a .=",''";}
					if(isset($idUsuario) && $idUsuario != ''){                  $a .= ",'".$idUsuario."'" ;           }else{$a .=",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `telemetria_listado_historial_encendidos` (idTelemetria, Fecha, Hora, TimeStamp,
					idEstadoEncendido, idUsuario) VALUES (".$a.")";
					//Consulta
					$result = mysqli_query ($dbConn, $query);
					//Si ejecuto correctamente la consulta
					/*if($result){
						
						try {
							if(!is_writable('upload/equipo_tel_'.$idTelemetria.'.json')){
								//Contenido del archivo
								$content = '{"sensor": "'.$idEstadoEncendido.'"}';
								//creacion del archivo
								file_put_contents('upload/equipo_tel_'.$idTelemetria.'.json', $content, FILE_APPEND | LOCK_EX);
							}else{
								//Elimino el archivo
								unlink('upload/equipo_tel_'.$idTelemetria.'.json');
								//Contenido del archivo
								$content = '{"sensor": "'.$idEstadoEncendido.'"}';
								//creacion del archivo
								file_put_contents('upload/equipo_tel_'.$idTelemetria.'.json', $content, FILE_APPEND | LOCK_EX);	
							}
						}catch(Exception $e) { 
							//guardar el dato en un archivo log
						}
						//Redirijo
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
					
					}*/
					
					
				}
			}
			
		break;
/*******************************************************************************************************************/		
		case 'insert_geocerca':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($idTelemetria)&&isset($idZona)){
				$ndata_1 = db_select_nrows (false, 'idTelemetria', 'telemetria_listado_geocercas', '', "idTelemetria='".$idTelemetria."' AND idZona='".$idZona."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La Geocerca ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idTelemetria) && $idTelemetria != ''){  $a  = "'".$idTelemetria."'" ; }else{$a  ="''";}
				if(isset($idZona) && $idZona != ''){              $a .= ",'".$idZona."'" ;      }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_listado_geocercas` (idTelemetria, idZona ) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
				
					header( 'Location: '.$location.'&created=true' );
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
		case 'del_geocerca':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['del_geocerca']) OR !validaEntero($_GET['del_geocerca']))&&$_GET['del_geocerca']!=''){
				$indice = simpleDecode($_GET['del_geocerca'], fecha_actual());
			}else{
				$indice = $_GET['del_geocerca'];
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
				$resultado = db_delete_data (false, 'telemetria_listado_geocercas', 'idGeocerca = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//redirijo
					header( 'Location: '.$location.'&deleted=true' );
					die;
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			

		break;	
/*******************************************************************************************************************/		
		case 'update_Sensor_Act':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$idTelemetria = $_GET['id'];
				$a  = "SensorActivacionID=''" ;
				$a .= ",SensorActivacionValor=''" ;
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'telemetria_listado', 'idTelemetria = "'.$idTelemetria.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					header( 'Location: '.$location.'&edited=true' );
					die;
				}
			}
		
	
		break;		
/*******************************************************************************************************************/
	}
?>
