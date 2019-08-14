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
	if ( !empty($_POST['idSolicitud']) )          $idSolicitud             = $_POST['idSolicitud'];
	if ( !empty($_POST['idSistema']) )            $idSistema               = $_POST['idSistema'];
	if ( !empty($_POST['idPredio']) )             $idPredio                = $_POST['idPredio'];
	if ( !empty($_POST['idUsuario']) )            $idUsuario               = $_POST['idUsuario'];
	if ( !empty($_POST['idEstado']) )             $idEstado                = $_POST['idEstado'];
	if ( !empty($_POST['idTemporada']) )          $idTemporada             = $_POST['idTemporada'];
	if ( !empty($_POST['idEstadoFen']) )          $idEstadoFen             = $_POST['idEstadoFen'];
	if ( !empty($_POST['idCategoria']) )          $idCategoria             = $_POST['idCategoria'];
	if ( !empty($_POST['idProducto']) )           $idProducto              = $_POST['idProducto'];
	if ( !empty($_POST['f_creacion']) )           $f_creacion 	           = $_POST['f_creacion'];
	if ( !empty($_POST['f_programacion']) )       $f_programacion          = $_POST['f_programacion'];
	if ( !empty($_POST['f_programacion_fin']) )   $f_programacion_fin      = $_POST['f_programacion_fin'];
	if ( !empty($_POST['f_ejecucion']) )          $f_ejecucion             = $_POST['f_ejecucion'];
	if ( !empty($_POST['f_ejecucion_fin']) )      $f_ejecucion_fin         = $_POST['f_ejecucion_fin'];
	if ( !empty($_POST['f_termino']) )            $f_termino 	           = $_POST['f_termino'];
	if ( !empty($_POST['f_termino_fin']) )        $f_termino_fin 	       = $_POST['f_termino_fin'];
	if ( !empty($_POST['Observaciones']) )        $Observaciones           = $_POST['Observaciones'];
	if ( !empty($_POST['progDia']) )              $progDia                 = $_POST['progDia'];
	if ( !empty($_POST['progSemana']) )           $progSemana              = $_POST['progSemana'];
	if ( !empty($_POST['progMes']) )              $progMes                 = $_POST['progMes'];
	if ( !empty($_POST['progAno']) )              $progAno                 = $_POST['progAno'];
	if ( !empty($_POST['ejeDia']) )               $ejeDia                  = $_POST['ejeDia'];
	if ( !empty($_POST['ejeSemana']) )            $ejeSemana               = $_POST['ejeSemana'];
	if ( !empty($_POST['ejeMes']) )               $ejeMes                  = $_POST['ejeMes'];
	if ( !empty($_POST['ejeAno']) )               $ejeAno                  = $_POST['ejeAno'];
	if ( !empty($_POST['terDia']) )               $terDia                  = $_POST['terDia'];
	if ( !empty($_POST['terSemana']) )            $terSemana               = $_POST['terSemana'];
	if ( !empty($_POST['terMes']) )               $terMes                  = $_POST['terMes'];
	if ( !empty($_POST['terAno']) )               $terAno                  = $_POST['terAno'];
	if ( !empty($_POST['horaProg']) )             $horaProg                = $_POST['horaProg'];
	if ( !empty($_POST['horaProg_fin']) )         $horaProg_fin            = $_POST['horaProg_fin'];
	if ( !empty($_POST['horaEjecucion']) )        $horaEjecucion           = $_POST['horaEjecucion'];
	if ( !empty($_POST['horaEjecucion_fin']) )    $horaEjecucion_fin       = $_POST['horaEjecucion_fin'];
	if ( !empty($_POST['horaTermino']) )          $horaTermino             = $_POST['horaTermino'];
	if ( !empty($_POST['horaTermino_fin']) )      $horaTermino_fin         = $_POST['horaTermino_fin'];
	if ( isset($_POST['Mojamiento']) )            $Mojamiento              = $_POST['Mojamiento'];
	if ( isset($_POST['VelTractor']) )            $VelTractor              = $_POST['VelTractor'];
	if ( isset($_POST['VelViento']) )             $VelViento               = $_POST['VelViento'];
	if ( isset($_POST['TempMin']) )               $TempMin                 = $_POST['TempMin'];
	if ( isset($_POST['TempMax']) )               $TempMax                 = $_POST['TempMax'];
	if ( !empty($_POST['idPrioridad']) )          $idPrioridad             = $_POST['idPrioridad'];
	if ( !empty($_POST['Observacion']) )          $Observacion             = $_POST['Observacion'];
	if ( !empty($_POST['Creacion_fecha']) )       $Creacion_fecha          = $_POST['Creacion_fecha'];
	if ( !empty($_POST['idDosificador']) )        $idDosificador           = $_POST['idDosificador'];
	if ( !empty($_POST['idEjecucion']) )          $idEjecucion             = $_POST['idEjecucion'];
	if ( !empty($_POST['Nombre_cuartel']) )       $Nombre_cuartel          = $_POST['Nombre_cuartel'];
	if ( !empty($_POST['ID_cuartel']) )           $ID_cuartel              = $_POST['ID_cuartel'];
	

	
	//otros datos
	if ( !empty($_POST['idZona']) )               $idZona                  = $_POST['idZona'];
	if ( !empty($_POST['idTelemetria']) )         $idTelemetria            = $_POST['idTelemetria'];
	if ( !empty($_POST['idProducto']) )           $idProducto              = $_POST['idProducto'];
	if ( isset($_POST['DosisAplicar']) )          $DosisAplicar            = $_POST['DosisAplicar'];
	if ( !empty($_POST['Objetivo']) )             $Objetivo                = $_POST['Objetivo'];
	
	if ( isset($_POST['idInterno']) )             $idInterno               = $_POST['idInterno'];
	if ( isset($_POST['idInterno2']) )            $idInterno2              = $_POST['idInterno2'];
	if ( isset($_POST['idInterno3']) )            $idInterno3              = $_POST['idInterno3'];
	
	if ( !empty($_POST['idCuarteles']) )          $idCuarteles             = $_POST['idCuarteles'];
	if ( !empty($_POST['idTractores']) )          $idTractores             = $_POST['idTractores'];
	if ( !empty($_POST['idProdQuim']) )           $idProdQuim              = $_POST['idProdQuim'];
	if ( !empty($_POST['f_cierre']) )             $f_cierre                = $_POST['f_cierre'];
	if ( !empty($_POST['idEstadoActual']) )       $idEstadoActual          = $_POST['idEstadoActual'];
	if ( !empty($_POST['idVehiculo']) )           $idVehiculo              = $_POST['idVehiculo'];
	if ( !empty($_POST['idTrabajador']) )         $idTrabajador            = $_POST['idTrabajador'];
	
					
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
			case 'idSolicitud':           if(empty($idSolicitud)){            $error['idSolicitud']             = 'error/No ha ingresado el id del sistema';}break;
			case 'idSistema':             if(empty($idSistema)){              $error['idSistema']               = 'error/No ha ingresado el idSistema del sistema';}break;
			case 'idPredio':              if(empty($idPredio)){               $error['idPredio']                = 'error/No ha ingresado la maquina';}break;
			case 'idUsuario':             if(empty($idUsuario)){              $error['idUsuario']               = 'error/No ha ingresado el usuario';}break;
			case 'idEstado':              if(empty($idEstado)){               $error['idEstado']                = 'error/No ha ingresado el estado';}break;
			case 'idTemporada':           if(empty($idTemporada)){            $error['idTemporada']             = 'error/No ha ingresado la prioridad';}break;
			case 'idEstadoFen':           if(empty($idEstadoFen)){            $error['idEstadoFen']             = 'error/No ha ingresado el tipo';}break;
			case 'idCategoria':           if(empty($idCategoria)){            $error['idCategoria']             = 'error/No ha seleccionado la Especie';}break;
			case 'idProducto':            if(empty($idProducto)){             $error['idProducto']              = 'error/No ha seleccionado la variedad';}break;
			case 'f_creacion':            if(empty($f_creacion)){             $error['f_creacion']              = 'error/No ha ingresado la fecha de creacion';}break;
			case 'f_programacion':        if(empty($f_programacion)){         $error['f_programacion']          = 'error/No ha ingresado la fecha de programacion';}break;
			case 'f_programacion_fin':    if(empty($f_programacion_fin)){     $error['f_programacion_fin']      = 'error/No ha ingresado la fecha de termino de programacion';}break;
			case 'f_ejecucion':           if(empty($f_ejecucion)){            $error['f_ejecucion']             = 'error/No ha ingresado la fecha de ejecucion';}break;
			case 'f_ejecucion_fin':       if(empty($f_ejecucion_fin)){        $error['f_ejecucion_fin']         = 'error/No ha ingresado la fecha de termino de ejecucion';}break;
			case 'f_termino':             if(empty($f_termino)){              $error['f_termino']               = 'error/No ha ingresado la fecha de termino';}break;
			case 'f_termino_fin':         if(empty($f_termino_fin)){          $error['f_termino_fin']           = 'error/No ha ingresado la fecha de termino de termino';}break;
			case 'Observaciones':         if(empty($Observaciones)){          $error['Observaciones']           = 'error/No ha ingresado la observacion';}break;
			case 'progDia':               if(empty($progDia)){                $error['progDia']                 = 'error/No ha ingresado el dia de programacion';}break;
			case 'progSemana':            if(empty($progSemana)){             $error['progSemana']              = 'error/No ha ingresado la semana de programacion';}break;
			case 'progMes':               if(empty($progMes)){                $error['progMes']                 = 'error/No ha ingresado el mes de programacion';}break;
			case 'progAno':               if(empty($progAno)){                $error['progAno']                 = 'error/No ha ingresado el año de programacion';}break;
			case 'ejeDia':                if(empty($ejeDia)){                 $error['ejeDia']                  = 'error/No ha ingresado el dia de ejecucion';}break;
			case 'ejeSemana':             if(empty($ejeSemana)){              $error['ejeSemana']               = 'error/No ha ingresado la semana de ejecucion';}break;
			case 'ejeMes':                if(empty($ejeMes)){                 $error['ejeMes']                  = 'error/No ha ingresado el mes de ejecucion';}break;
			case 'ejeAno':                if(empty($ejeAno)){                 $error['ejeAno']                  = 'error/No ha ingresado el año de ejecucion';}break;
			case 'terDia':                if(empty($terDia)){                 $error['terDia']                  = 'error/No ha ingresado el dia de termino';}break;
			case 'terSemana':             if(empty($terSemana)){              $error['terSemana']               = 'error/No ha ingresado la semana de termino';}break;
			case 'terMes':                if(empty($terMes)){                 $error['terMes']                  = 'error/No ha ingresado el mes de termino';}break;
			case 'terAno':                if(empty($terAno)){                 $error['terAno']                  = 'error/No ha ingresado el año de termino';}break;
			case 'horaProg':              if(empty($horaProg)){               $error['horaProg']                = 'error/No ha ingresado la hora programada';}break;
			case 'horaProg_fin':          if(empty($horaProg_fin)){           $error['horaProg_fin']            = 'error/No ha ingresado la hora de termino programada';}break;
			case 'horaEjecucion':         if(empty($horaEjecucion)){          $error['horaEjecucion']           = 'error/No ha ingresado la hora de inicio';}break;
			case 'horaEjecucion_fin':     if(empty($horaEjecucion_fin)){      $error['horaEjecucion_fin']       = 'error/No ha ingresado la hora de termino de inicio';}break;
			case 'horaTermino':           if(empty($horaTermino)){            $error['horaTermino']             = 'error/No ha ingresado la hora de termino';}break;
			case 'horaTermino_fin':       if(empty($horaTermino_fin)){        $error['horaTermino_fin']         = 'error/No ha ingresado la hora de termino de termino';}break;
			case 'Mojamiento':            if(empty($Mojamiento)){             $error['Mojamiento']              = 'error/No ha ingresado el parametro de mojamiento';}break;
			case 'VelTractor':            if(empty($VelTractor)){             $error['VelTractor']              = 'error/No ha ingresado el parametro de velocidad de tractor';}break;
			case 'VelViento':             if(empty($VelViento)){              $error['VelViento']               = 'error/No ha ingresado el parametro de velocidad de viento';}break;
			case 'TempMin':               if(empty($TempMin)){                $error['TempMin']                 = 'error/No ha ingresado el parametro de temperatura minima';}break;
			case 'TempMax':               if(empty($TempMax)){                $error['TempMax']                 = 'error/No ha ingresado el parametro de temperatura maxima';}break;
			case 'idPrioridad':           if(empty($idPrioridad)){            $error['idPrioridad']             = 'error/No ha seleccionado la prioridad';}break;
			case 'Observacion':           if(empty($Observacion)){            $error['Observacion']             = 'error/No ha ingresado la observacion';}break;
			case 'Creacion_fecha':        if(empty($Creacion_fecha)){         $error['Creacion_fecha']          = 'error/No ha ingresado la fecha de creacion';}break;
			case 'idDosificador':         if(empty($idDosificador)){          $error['idDosificador']           = 'error/No ha seleccionado al dosificador';}break;
			
			
			case 'idZona':                if(empty($idZona)){                 $error['idZona']                 = 'error/No ha seleccionado el cuartel';}break;
			case 'idTelemetria':          if(empty($idTelemetria)){           $error['idTelemetria']           = 'error/No ha seleccionado el Equipo Aplicación';}break;
			case 'idProducto':            if(empty($idProducto)){             $error['idProducto']             = 'error/No ha seleccionado el producto';}break;
			case 'DosisAplicar':          if(empty($DosisAplicar)){           $error['DosisAplicar']           = 'error/No ha ingresado el parametro de dosis a aplicar';}break;
			case 'Objetivo':              if(empty($Objetivo)){               $error['Objetivo']               = 'error/No ha ingresado el parametro de objetivo';}break;
			
			case 'idInterno':             if(!isset($idInterno)){              $error['idInterno']              = 'error/No ha ingresado el id interno';}break;
			case 'idInterno2':            if(!isset($idInterno2)){             $error['idInterno2']             = 'error/No ha ingresado el id interno';}break;
			case 'idInterno3':            if(!isset($idInterno3)){             $error['idInterno3']             = 'error/No ha ingresado el id interno';}break;
			
			case 'idCuarteles':           if(empty($idCuarteles)){            $error['idCuarteles']            = 'error/No ha seleccionado el cuartel';}break;
			case 'idTractores':           if(empty($idTractores)){            $error['idTractores']            = 'error/No ha seleccionado el tractor';}break;
			case 'idProdQuim':            if(empty($idProdQuim)){             $error['idProdQuim']             = 'error/No ha seleccionado el producto quimico';}break;
			case 'f_cierre':              if(empty($f_cierre)){               $error['f_cierre']               = 'error/No ha ingresado la fecha de cierre';}break;
			case 'idEstadoActual':        if(empty($idEstadoActual)){         $error['idEstadoActual']         = 'error/No ha ingresado el estado actual';}break;
			case 'idVehiculo':            if(empty($idVehiculo)){             $error['idVehiculo']             = 'error/No ha seleccionado el tractor';}break;
			case 'idTrabajador':          if(empty($idTrabajador)){           $error['idTrabajador']           = 'error/No ha seleccionado el trabajador';}break;
			
		
		}
	}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'creacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Borro todas las sesiones
				unset($_SESSION['sol_apli_basicos']);
				unset($_SESSION['sol_apli_cuarteles']);
				unset($_SESSION['sol_apli_tractores']);
				unset($_SESSION['sol_apli_productos']);
				unset($_SESSION['sol_apli_temporal']);
				
				//Consultas a la base de datos
				/**********************************************/
				// Se traen todos los datos de la maquina
				$query = "SELECT 
				cross_predios_listado.Nombre AS Predio
				FROM `cross_predios_listado`
				WHERE cross_predios_listado.idPredio = ".$idPredio;
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
				$rowPredio = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				// Se traen todos los datos de las prioridades
				$query = "SELECT Codigo, Nombre
				FROM `cross_checking_temporada`
				WHERE idTemporada = ".$idTemporada;
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
				$rowTemporada = mysqli_fetch_assoc ($resultado); 
				/**********************************************/
				// Se traen todos los datos de los tipos de orden de trabajo
				$query = "SELECT Codigo, Nombre
				FROM `cross_checking_estado_fenologico`
				WHERE idEstadoFen = ".$idEstadoFen;
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
				$rowEstadoFen = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				// Se traen todos los datos de los tipos de orden de trabajo
				$query = "SELECT Nombre
				FROM `sistema_variedades_categorias`
				WHERE idCategoria = ".$idCategoria;
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
				$rowEspecie = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				// Se traen todos los datos de los tipos de orden de trabajo
				$query = "SELECT Nombre
				FROM `variedades_listado`
				WHERE idProducto = ".$idProducto;
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
				$rowVariedad = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				// Se traen todos los datos de los tipos de orden de trabajo
				$query = "SELECT Nombre
				FROM `core_cross_prioridad`
				WHERE idPrioridad = ".$idPrioridad;
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
				$rowPrioridad = mysqli_fetch_assoc ($resultado);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['sol_apli_basicos']['idPredio']            = $idPredio;
				$_SESSION['sol_apli_basicos']['idTemporada']         = $idTemporada;
				$_SESSION['sol_apli_basicos']['idEstadoFen']         = $idEstadoFen;
				$_SESSION['sol_apli_basicos']['idCategoria']         = $idCategoria;
				$_SESSION['sol_apli_basicos']['idProducto']          = $idProducto;
				$_SESSION['sol_apli_basicos']['f_programacion']      = $f_programacion;
				$_SESSION['sol_apli_basicos']['horaProg']            = $horaProg;
				$_SESSION['sol_apli_basicos']['f_programacion_fin']  = $f_programacion_fin;
				$_SESSION['sol_apli_basicos']['horaProg_fin']        = $horaProg_fin;
				$_SESSION['sol_apli_basicos']['idSistema']           = $idSistema;
				$_SESSION['sol_apli_basicos']['idUsuario']           = $idUsuario;
				$_SESSION['sol_apli_basicos']['idEstado']            = $idEstado;
				$_SESSION['sol_apli_basicos']['f_creacion']          = $f_creacion;
				$_SESSION['sol_apli_basicos']['Observaciones']       = $Observaciones;
				$_SESSION['sol_apli_basicos']['idPrioridad']         = $idPrioridad;
				//datos en blanco
				$_SESSION['sol_apli_basicos']['Mojamiento']          = 0;
				$_SESSION['sol_apli_basicos']['VelTractor']          = 0;
				$_SESSION['sol_apli_basicos']['VelViento']           = 0;
				$_SESSION['sol_apli_basicos']['TempMin']             = 0;
				$_SESSION['sol_apli_basicos']['TempMax']             = 0;
				
				//Datos guardados
				$_SESSION['sol_apli_basicos']['Predio']              = $rowPredio['Predio'];
				$_SESSION['sol_apli_basicos']['Temporada']           = $rowTemporada['Codigo'].' '.$rowTemporada['Nombre'];
				$_SESSION['sol_apli_basicos']['EstadoFen']           = $rowEstadoFen['Codigo'].' '.$rowEstadoFen['Nombre'];
				$_SESSION['sol_apli_basicos']['EspecieVariedad']     = $rowEspecie['Nombre'].' - '.$rowVariedad['Nombre'];
				$_SESSION['sol_apli_basicos']['Prioridad']           = $rowPrioridad['Nombre'];
				
			}
			
  
			header( 'Location: '.$location.'&view=true' );
			die;
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['sol_apli_basicos']);
			unset($_SESSION['sol_apli_cuarteles']);
			unset($_SESSION['sol_apli_tractores']);
			unset($_SESSION['sol_apli_productos']);
			unset($_SESSION['sol_apli_temporal']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'mod_base':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//si cambia la variedad se resetea todo
				if($_SESSION['sol_apli_basicos']['idProducto']!=$idProducto){
					//Borro todas las sesiones
					unset($_SESSION['sol_apli_cuarteles']);
					unset($_SESSION['sol_apli_tractores']);
					unset($_SESSION['sol_apli_productos']);
					unset($_SESSION['sol_apli_temporal']);
				}
				
				//Consultas a la base de datos
				/**********************************************/
				// Se traen todos los datos de la maquina
				$query = "SELECT 
				cross_predios_listado.Nombre AS Predio
				FROM `cross_predios_listado`
				WHERE cross_predios_listado.idPredio = ".$idPredio;
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
				$rowPredio = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				// Se traen todos los datos de las prioridades
				$query = "SELECT Codigo, Nombre
				FROM `cross_checking_temporada`
				WHERE idTemporada = ".$idTemporada;
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
				$rowTemporada = mysqli_fetch_assoc ($resultado); 
				/**********************************************/
				// Se traen todos los datos de los tipos de orden de trabajo
				$query = "SELECT Codigo, Nombre
				FROM `cross_checking_estado_fenologico`
				WHERE idEstadoFen = ".$idEstadoFen;
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
				$rowEstadoFen = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				// Se traen todos los datos de los tipos de orden de trabajo
				$query = "SELECT Nombre
				FROM `sistema_variedades_categorias`
				WHERE idCategoria = ".$idCategoria;
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
				$rowEspecie = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				// Se traen todos los datos de los tipos de orden de trabajo
				$query = "SELECT Nombre
				FROM `variedades_listado`
				WHERE idProducto = ".$idProducto;
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
				$rowVariedad = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				// Se traen todos los datos de los tipos de orden de trabajo
				$query = "SELECT Nombre
				FROM `core_cross_prioridad`
				WHERE idPrioridad = ".$idPrioridad;
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
				$rowPrioridad = mysqli_fetch_assoc ($resultado);
			
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['sol_apli_basicos']['idPredio']            = $idPredio;
				$_SESSION['sol_apli_basicos']['idTemporada']         = $idTemporada;
				$_SESSION['sol_apli_basicos']['idEstadoFen']         = $idEstadoFen;
				$_SESSION['sol_apli_basicos']['idCategoria']         = $idCategoria;
				$_SESSION['sol_apli_basicos']['idProducto']          = $idProducto;
				$_SESSION['sol_apli_basicos']['f_programacion']      = $f_programacion;
				$_SESSION['sol_apli_basicos']['horaProg']            = $horaProg;
				$_SESSION['sol_apli_basicos']['f_programacion_fin']  = $f_programacion_fin;
				$_SESSION['sol_apli_basicos']['horaProg_fin']        = $horaProg_fin;
				$_SESSION['sol_apli_basicos']['idSistema']           = $idSistema;
				$_SESSION['sol_apli_basicos']['idUsuario']           = $idUsuario;
				$_SESSION['sol_apli_basicos']['idEstado']            = $idEstado;
				$_SESSION['sol_apli_basicos']['f_creacion']          = $f_creacion;
				$_SESSION['sol_apli_basicos']['idPrioridad']         = $idPrioridad;
			
				//se actualizan datos de aplicacion
				$_SESSION['sol_apli_basicos']['Mojamiento']          = Cantidades_decimales_justos($Mojamiento);
				$_SESSION['sol_apli_basicos']['VelTractor']          = Cantidades_decimales_justos($VelTractor);
				$_SESSION['sol_apli_basicos']['VelViento']           = Cantidades_decimales_justos($VelViento);
				$_SESSION['sol_apli_basicos']['TempMin']             = Cantidades_decimales_justos($TempMin);
				$_SESSION['sol_apli_basicos']['TempMax']             = Cantidades_decimales_justos($TempMax);
				
				//Datos guardados
				$_SESSION['sol_apli_basicos']['Predio']              = $rowPredio['Predio'];
				$_SESSION['sol_apli_basicos']['Temporada']           = $rowTemporada['Codigo'].' '.$rowTemporada['Nombre'];
				$_SESSION['sol_apli_basicos']['EstadoFen']           = $rowEstadoFen['Codigo'].' '.$rowEstadoFen['Nombre'];
				$_SESSION['sol_apli_basicos']['EspecieVariedad']     = $rowEspecie['Nombre'].' - '.$rowVariedad['Nombre'];
				$_SESSION['sol_apli_basicos']['Prioridad']           = $rowPrioridad['Nombre'];
				
				//si existen cuarteles se actualizan sus datos internos
				if(isset($_SESSION['sol_apli_cuarteles'])&&$_SESSION['sol_apli_cuarteles']!=''){
					foreach ($_SESSION['sol_apli_cuarteles'] as $key => $cuartel){
						
						$_SESSION['sol_apli_cuarteles'][$cuartel['valor_id']]['Mojamiento']  = $Mojamiento;
						$_SESSION['sol_apli_cuarteles'][$cuartel['valor_id']]['VelTractor']  = $VelTractor;
						$_SESSION['sol_apli_cuarteles'][$cuartel['valor_id']]['VelViento']   = $VelViento;
						$_SESSION['sol_apli_cuarteles'][$cuartel['valor_id']]['TempMin']     = $TempMin;
						$_SESSION['sol_apli_cuarteles'][$cuartel['valor_id']]['TempMax']     = $TempMax;
				
					}
						
				} 
			
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}

				
		break;				
/*******************************************************************************************************************/		
		case 'addCuartel':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idZona)){      $ndata_1 = count($idZona);      }else{$ndata_1 = 0;}
			if(isset($idVehiculo)){  $ndata_2 = count($idVehiculo);  }else{$ndata_2 = 0;}
			if(isset($idProducto)){  $ndata_3 = count($idProducto);  }else{$ndata_3 = 0;}
			//generacion de errores
			if($ndata_1==0) {$error['ndata_1'] = 'error/No hay cuarteles agregados';}
			if($ndata_2==0) {$error['ndata_2'] = 'error/No hay tractores agregados';}
			if($ndata_3==0) {$error['ndata_3'] = 'error/No hay productos quimicos agregados';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/**********************************************/
				//Se trae un listado con los productos	
				$arrCuarteles = array();
				$query = "SELECT idZona, Nombre
				FROM `cross_predios_listado_zonas`
				WHERE idPredio = {$_SESSION['sol_apli_basicos']['idPredio']}
				ORDER BY Nombre ASC";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrCuarteles,$row );
				}
				$arrCuart = array();
				foreach ($arrCuarteles as $prod) {
					$arrCuart[$prod['idZona']]['Nombre']  = $prod['Nombre'];
				}
				/**********************************************/
				//Se trae un listado con los productos	
				$arrVehiculos = array();
				$query = "SELECT idVehiculo, Nombre
				FROM `vehiculos_listado`
				WHERE idSistema = ".$_SESSION['sol_apli_basicos']['idSistema']." AND idEstado=1
				ORDER BY Nombre ASC";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrVehiculos,$row );
				}
				$arrVeh = array();
				foreach ($arrVehiculos as $prod) {
					$arrVeh[$prod['idVehiculo']]['Nombre']  = $prod['Nombre'];
				}

				/**********************************************/
				//Se trae un listado con los productos	
				$arrTelemetria = array();
				$query = "SELECT idTelemetria, Nombre
				FROM `telemetria_listado`
				WHERE idSistema = ".$_SESSION['sol_apli_basicos']['idSistema']." AND idEstado=1
				ORDER BY Nombre ASC";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTelemetria,$row );
				}
				$arrTel = array();
				foreach ($arrTelemetria as $prod) {
					$arrTel[$prod['idTelemetria']]['Nombre']  = $prod['Nombre'];
				}
				/**********************************************/
				//Se trae un listado con los productos	
				$arrTrabajadores = array();
				$query = "SELECT idTrabajador, Rut,Nombre,ApellidoPat
				FROM `trabajadores_listado`
				WHERE idSistema = ".$_SESSION['sol_apli_basicos']['idSistema']." AND idEstado=1
				ORDER BY idTrabajador ASC";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTrabajadores,$row );
				}
				$arrTrab = array();
				foreach ($arrTrabajadores as $prod) {
					$arrTrab[$prod['idTrabajador']]['Nombre']  = $prod['Rut'].' - '.$prod['Nombre'].' '.$prod['ApellidoPat'];
				}
				/**********************************************/
				//Se trae un listado con los productos	
				$arrProductos = array();
				$query = "SELECT 
				productos_listado.idProducto,
				productos_listado.Nombre AS NombreProducto,
				productos_listado.DosisRecomendada,
				sistema_productos_uml.Nombre AS Unimed
				FROM `productos_listado`
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
				ORDER BY sistema_productos_uml.Nombre";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
				$arrProd = array();
				foreach ($arrProductos as $prod) {
					$arrProd[$prod['idProducto']]['Nombre']            = $prod['NombreProducto'];
					$arrProd[$prod['idProducto']]['Unimed']            = $prod['Unimed'];
					$arrProd[$prod['idProducto']]['DosisRecomendada']  = $prod['DosisRecomendada'];
				}
				
				/*******************************************************************************/
				//se borran todos los cuarteles
				unset($_SESSION['sol_apli_cuarteles']);
				unset($_SESSION['sol_apli_productos']);
				unset($_SESSION['sol_apli_tractores']);
			
				//Guardo los datos de Parámetros de Aplicación
				$_SESSION['sol_apli_basicos']['Mojamiento']  = Cantidades_decimales_justos($Mojamiento);
				$_SESSION['sol_apli_basicos']['VelTractor']  = Cantidades_decimales_justos($VelTractor);
				$_SESSION['sol_apli_basicos']['VelViento']   = Cantidades_decimales_justos($VelViento);
				$_SESSION['sol_apli_basicos']['TempMin']     = Cantidades_decimales_justos($TempMin);
				$_SESSION['sol_apli_basicos']['TempMax']     = Cantidades_decimales_justos($TempMax);
				
				//Recorro los cuarteles
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					//Para mostrar en la creacion
					$_SESSION['sol_apli_cuarteles'][$j1]['idZona']        = $idZona[$j1];
					$_SESSION['sol_apli_cuarteles'][$j1]['Mojamiento']    = Cantidades_decimales_justos($Mojamiento);
					$_SESSION['sol_apli_cuarteles'][$j1]['VelTractor']    = Cantidades_decimales_justos($VelTractor);
					$_SESSION['sol_apli_cuarteles'][$j1]['VelViento']     = Cantidades_decimales_justos($VelViento);
					$_SESSION['sol_apli_cuarteles'][$j1]['TempMin']       = Cantidades_decimales_justos($TempMin);
					$_SESSION['sol_apli_cuarteles'][$j1]['TempMax']       = Cantidades_decimales_justos($TempMax);
					$_SESSION['sol_apli_cuarteles'][$j1]['valor_id']      = $j1;
					$_SESSION['sol_apli_cuarteles'][$j1]['CuartelNombre'] = $arrCuart[$idZona[$j1]]['Nombre'];
					
					//Recorro los tractores
					for($j2 = 0; $j2 < $ndata_2; $j2++){
						//Para mostrar en la creacion
						$_SESSION['sol_apli_tractores'][$j1][$j2]['idVehiculo']    = $idVehiculo[$j2];
						$_SESSION['sol_apli_tractores'][$j1][$j2]['idTelemetria']  = $idTelemetria[$j2];
						$_SESSION['sol_apli_tractores'][$j1][$j2]['idTrabajador']  = $idTrabajador[$j2];
						$_SESSION['sol_apli_tractores'][$j1][$j2]['valor_id']      = $j2;	
						$_SESSION['sol_apli_tractores'][$j1][$j2]['Vehiculo']      = $arrVeh[$idVehiculo[$j2]]['Nombre'];
						$_SESSION['sol_apli_tractores'][$j1][$j2]['Telemetria']    = $arrTel[$idTelemetria[$j2]]['Nombre'];
						$_SESSION['sol_apli_tractores'][$j1][$j2]['Trabajador']    = $arrTrab[$idTrabajador[$j2]]['Nombre'];
							
					}
					
					//Recorro los productos
					for($j3 = 0; $j3 < $ndata_3; $j3++){
						//Para mostrar en la creacion
						$_SESSION['sol_apli_productos'][$j1][$j3]['idProducto']        = $idProducto[$j3];
						$_SESSION['sol_apli_productos'][$j1][$j3]['DosisAplicar']      = $DosisAplicar[$j3];
						$_SESSION['sol_apli_productos'][$j1][$j3]['Objetivo']          = $Objetivo[$j3];
						$_SESSION['sol_apli_productos'][$j1][$j3]['valor_id']          = $j3;
						$_SESSION['sol_apli_productos'][$j1][$j3]['Producto']          = $arrProd[$idProducto[$j3]]['Nombre'];
						$_SESSION['sol_apli_productos'][$j1][$j3]['DosisRecomendada']  = $arrProd[$idProducto[$j3]]['DosisRecomendada'];
						$_SESSION['sol_apli_productos'][$j1][$j3]['Unimed']            = $arrProd[$idProducto[$j3]]['Unimed'];
						
					}
				}
			}
			
			//se redirije	
			header( 'Location: '.$location.'&view=true' );
			die;
		break;				
/*******************************************************************************************************************/		
		case 'editCuartel':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			

			if ( empty($error) ) {
				
				/**********************************************/
				//Se trae un listado con los productos	
				$query = "SELECT  Nombre
				FROM `cross_predios_listado_zonas`
				WHERE idZona = ".$idZona;
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
				$rowCuart = mysqli_fetch_assoc ($resultado);
				
				/***************************************************/
				//Para mostrar en la creacion
				$_SESSION['sol_apli_cuarteles'][$idInterno]['idZona']         = $idZona;
				$_SESSION['sol_apli_cuarteles'][$idInterno]['CuartelNombre']  = $rowCuart['Nombre'];
				
				
				/************************************************************/
				//se redirije	
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;
/*******************************************************************************************************************/		
		case 'del_Cuartel':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['sol_apli_cuarteles'][$_GET['del_Cuartel']]);
			unset($_SESSION['sol_apli_tractores'][$_GET['del_Cuartel']]);
			unset($_SESSION['sol_apli_productos'][$_GET['del_Cuartel']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'addtractor':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/************************************************************/
			//se establece variable inicial		
			$idInterno2 = 0;
						
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['sol_apli_tractores'][$idInterno])){
				foreach ($_SESSION['sol_apli_tractores'][$idInterno] as $key => $trabajos){
					if(isset($trabajos['valor_id'])&&$trabajos['valor_id']!=''){
						$idInterno2 = $trabajos['valor_id'];
						//verifico si tractor existe
						if($trabajos['idVehiculo']==$idVehiculo){
							$error['ndata_1'] = 'error/El tractor que esta agregando ya ha sido agregado';
						}
						if($trabajos['idTelemetria']==$idTelemetria){
							$error['ndata_1'] = 'error/El equipo de aplicacion que esta agregando ya ha sido agregado';
						}
					}
				}
			}
				
			if ( empty($error) ) {

				/**********************************************/
				//Se trae un listado con los productos	
				$query = "SELECT Nombre
				FROM `vehiculos_listado`
				WHERE idVehiculo = ".$idVehiculo;
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
				$rowVehiculos = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				//Se trae un listado con los productos	
				$query = "SELECT Nombre
				FROM `telemetria_listado`
				WHERE idTelemetria = ".$idTelemetria;
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
				$rowTelemetria = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				//Se trae un listado con los productos	
				$query = "SELECT Rut,Nombre,ApellidoPat
				FROM `trabajadores_listado`
				WHERE idTrabajador = ".$idTrabajador;
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
				$rowTrabajadores = mysqli_fetch_assoc ($resultado);
					
				/**********************************************/
				$idInterno2 = $idInterno2+1;
				//Para mostrar en la creacion
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['idVehiculo']    = $idVehiculo;
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['idTelemetria']  = $idTelemetria;
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['idTrabajador']  = $idTrabajador;
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['valor_id']      = $idInterno2;
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['Vehiculo']      = $rowVehiculos['Nombre'];
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['Telemetria']    = $rowTelemetria['Nombre'];
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['Trabajador']    = $rowTrabajadores['Rut'].' - '.$rowTrabajadores['Nombre'].' '.$rowTrabajadores['ApellidoPat'];
							
					
				/************************************************************/
				//se redirije	
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;	
/*******************************************************************************************************************/		
		case 'edittractor':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el dato ya existe
			if(isset($_SESSION['sol_apli_tractores'][$idInterno])){
				foreach ($_SESSION['sol_apli_tractores'][$idInterno] as $key => $trabajos){
					if(isset($trabajos['valor_id'])&&$trabajos['valor_id']!=''&&$trabajos['valor_id']!=$idInterno2){
						//verifico si tractor existe
						if($trabajos['idVehiculo']==$idVehiculo){
							$error['ndata_1'] = 'error/El tractor que esta agregando ya ha sido agregado';
						}
						if($trabajos['idTelemetria']==$idTelemetria){
							$error['ndata_1'] = 'error/El equipo de aplicacion que esta agregando ya ha sido agregado';
						}
					}
				}
			}
			
			if ( empty($error) ) {
				
				/**********************************************/
				//Se trae un listado con los productos	
				$query = "SELECT Nombre
				FROM `vehiculos_listado`
				WHERE idVehiculo = ".$idVehiculo;
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
				$rowVehiculos = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				//Se trae un listado con los productos	
				$query = "SELECT Nombre
				FROM `telemetria_listado`
				WHERE idTelemetria = ".$idTelemetria;
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
				$rowTelemetria = mysqli_fetch_assoc ($resultado);
				/**********************************************/
				//Se trae un listado con los productos	
				$query = "SELECT Rut,Nombre,ApellidoPat
				FROM `trabajadores_listado`
				WHERE idTrabajador = ".$idTrabajador;
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
				$rowTrabajadores = mysqli_fetch_assoc ($resultado);
					
				/**********************************************/
				//Para mostrar en la creacion
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['idVehiculo']    = $idVehiculo;
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['idTelemetria']  = $idTelemetria;
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['idTrabajador']  = $idTrabajador;
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['valor_id']      = $idInterno2;
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['Vehiculo']      = $rowVehiculos['Nombre'];
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['Telemetria']    = $rowTelemetria['Nombre'];
				$_SESSION['sol_apli_tractores'][$idInterno][$idInterno2]['Trabajador']    = $rowTrabajadores['Rut'].' - '.$rowTrabajadores['Nombre'].' '.$rowTrabajadores['ApellidoPat'];
				
				
				/************************************************************/
				//se redirije	
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;	
/*******************************************************************************************************************/		
		case 'del_trac':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['sol_apli_tractores'][$_GET['cuartel_id']][$_GET['del_trac']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'addproducto':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/************************************************************/
			//se establece variable inicial		
			$idInterno3 = 0;
						
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['sol_apli_productos'][$idInterno])){
				foreach ($_SESSION['sol_apli_productos'][$idInterno] as $key => $trabajos){
					if(isset($trabajos['valor_id'])&&$trabajos['valor_id']!=''){
						$idInterno3 = $trabajos['valor_id'];
						//verifico si tractor existe
						if($trabajos['idProducto']==$idProducto){
							$error['ndata_1'] = 'error/El producto quimico que esta agregando ya ha sido agregado';
						}
					}
				}
			}
				
			
			if ( empty($error) ) {
				
				/**********************************************/
				//Se trae un listado con los productos	
				$query = "SELECT 
				productos_listado.Nombre AS NombreProducto,
				productos_listado.DosisRecomendada,
				sistema_productos_uml.Nombre AS Unimed
				FROM `productos_listado`
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
				WHERE productos_listado.idProducto = ".$idProducto;
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
				$rowProductos = mysqli_fetch_assoc ($resultado);
				
				/**********************************************/
				$idInterno3 = $idInterno3+1;
				//Para mostrar en la creacion
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['idProducto']        = $idProducto;
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['DosisAplicar']      = $DosisAplicar;
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['Objetivo']          = $Objetivo;
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['valor_id']          = $idInterno3;
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['Producto']          = $rowProductos['NombreProducto'];
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['DosisRecomendada']  = $rowProductos['Unimed'];
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['Unimed']            = $rowProductos['DosisRecomendada'];
						
				/************************************************************/
				//se redirije	
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;	
/*******************************************************************************************************************/		
		case 'editproducto':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['sol_apli_productos'][$idInterno])){
				foreach ($_SESSION['sol_apli_productos'][$idInterno] as $key => $trabajos){
					if(isset($trabajos['valor_id'])&&$trabajos['valor_id']!=''&&$trabajos['valor_id']!=$idInterno3){
						//verifico si tractor existe
						if($trabajos['idProducto']==$idProducto){
							$error['ndata_1'] = 'error/El producto quimico que esta agregando ya ha sido agregado';
						}
					}
				}
			}
			
			if ( empty($error) ) {
	
				/**********************************************/
				//Se trae un listado con los productos	
				$query = "SELECT 
				productos_listado.Nombre AS NombreProducto,
				productos_listado.DosisRecomendada,
				sistema_productos_uml.Nombre AS Unimed
				FROM `productos_listado`
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
				WHERE productos_listado.idProducto = ".$idProducto;
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
				$rowProductos = mysqli_fetch_assoc ($resultado);
				
				/**********************************************/
				//Para mostrar en la creacion
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['idProducto']        = $idProducto;
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['DosisAplicar']      = $DosisAplicar;
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['Objetivo']          = $Objetivo;
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['Producto']          = $rowProductos['NombreProducto'];
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['DosisRecomendada']  = $rowProductos['Unimed'];
				$_SESSION['sol_apli_productos'][$idInterno][$idInterno3]['Unimed']            = $rowProductos['DosisRecomendada'];
				
				/************************************************************/
				//se redirije	
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;	
/*******************************************************************************************************************/		
		case 'del_prod':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['sol_apli_productos'][$_GET['cuartel_id']][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
	
/*******************************************************************************************************************/		
		case 'add_obs':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['sol_apli_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['sol_apli_temporal'] = $_SESSION['sol_apli_basicos']['Observaciones'];
			$_SESSION['sol_apli_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'crear_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
			/*********************************************************************/
			//variables
			$n_cuarteles = 0;
			$n_tractores = 0;
			$n_productos = 0;
			
			
			//Se verifican los datos basicos
			if (isset($_SESSION['sol_apli_basicos'])){
				if(!isset($_SESSION['sol_apli_basicos']['idPredio']) or $_SESSION['sol_apli_basicos']['idPredio']=='' ){                       $error['idPredio']             = 'error/No ha seleccionado el predio';}
				if(!isset($_SESSION['sol_apli_basicos']['idTemporada']) or $_SESSION['sol_apli_basicos']['idTemporada']=='' ){                 $error['idTemporada']          = 'error/No ha seleccionado la temporada';}
				if(!isset($_SESSION['sol_apli_basicos']['idEstadoFen']) or $_SESSION['sol_apli_basicos']['idEstadoFen']=='' ){                 $error['idEstadoFen']          = 'error/No ha seleccionado el estado fenologico';}
				if(!isset($_SESSION['sol_apli_basicos']['idCategoria']) or $_SESSION['sol_apli_basicos']['idCategoria']=='' ){                 $error['idCategoria']          = 'error/No ha seleccionado la especie';}
				if(!isset($_SESSION['sol_apli_basicos']['idProducto']) or $_SESSION['sol_apli_basicos']['idProducto']=='' ){                   $error['idProducto']           = 'error/No ha seleccionado la variedad';}
				if(!isset($_SESSION['sol_apli_basicos']['f_programacion']) or $_SESSION['sol_apli_basicos']['f_programacion']=='' ){           $error['f_programacion']       = 'error/No ha ingresado la Fecha inicio programación';}
				if(!isset($_SESSION['sol_apli_basicos']['f_programacion_fin']) or $_SESSION['sol_apli_basicos']['f_programacion_fin']=='' ){   $error['f_programacion_fin']   = 'error/No ha ingresado la Fecha termino programación';}
				if(!isset($_SESSION['sol_apli_basicos']['idSistema']) or $_SESSION['sol_apli_basicos']['idSistema']=='' ){                     $error['idSistema']            = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['sol_apli_basicos']['idUsuario']) or $_SESSION['sol_apli_basicos']['idUsuario']=='' ){                     $error['idUsuario']            = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['sol_apli_basicos']['idEstado']) or $_SESSION['sol_apli_basicos']['idEstado']=='' ){                       $error['idEstado']             = 'error/No ha seleccionado el estado';}
				if(!isset($_SESSION['sol_apli_basicos']['f_creacion']) or $_SESSION['sol_apli_basicos']['f_creacion']=='' ){                   $error['f_creacion']           = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['sol_apli_basicos']['Observaciones']) or $_SESSION['sol_apli_basicos']['Observaciones']=='' ){             $error['Observaciones']        = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['sol_apli_basicos']['horaProg']) or $_SESSION['sol_apli_basicos']['horaProg']=='' ){                       $error['horaProg']             = 'error/No ha ingresado la hora inicio programada';}
				if(!isset($_SESSION['sol_apli_basicos']['horaProg_fin']) or $_SESSION['sol_apli_basicos']['horaProg_fin']=='' ){               $error['horaProg_fin']         = 'error/No ha ingresado la hora termino programada';}
				if(!isset($_SESSION['sol_apli_basicos']['idPrioridad']) or $_SESSION['sol_apli_basicos']['idPrioridad']=='' ){                 $error['idPrioridad']          = 'error/No ha seleccionado la prioridad';}
			
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados a la solicitud';
			}
			
			if(isset($_SESSION['sol_apli_cuarteles'])&&$_SESSION['sol_apli_cuarteles']!=''){
				//sumo los cuarteles
				$n_cuarteles++;
				foreach ($_SESSION['sol_apli_cuarteles'] as $key => $cuartel){
				
					if($_SESSION['sol_apli_tractores'][$cuartel['valor_id']]){
						//Se recorren los tractores
						foreach ($_SESSION['sol_apli_tractores'][$cuartel['valor_id']] as $key => $tract){
							//se verifican que existan todos los datos del tractor
							if(!isset($_SESSION['sol_apli_tractores'][$cuartel['valor_id']][$tract['valor_id']]['idVehiculo']) or $_SESSION['sol_apli_tractores'][$cuartel['valor_id']][$tract['valor_id']]['idVehiculo']=='' ){         $error['idVehiculo']    = 'error/No ha seleccionado el tractor';}
							if(!isset($_SESSION['sol_apli_tractores'][$cuartel['valor_id']][$tract['valor_id']]['idTelemetria']) or $_SESSION['sol_apli_tractores'][$cuartel['valor_id']][$tract['valor_id']]['idTelemetria']=='' ){     $error['idTelemetria']  = 'error/No ha seleccionado el Equipo Aplicación';}
							if(!isset($_SESSION['sol_apli_tractores'][$cuartel['valor_id']][$tract['valor_id']]['idTrabajador']) or $_SESSION['sol_apli_tractores'][$cuartel['valor_id']][$tract['valor_id']]['idTrabajador']=='' ){     $error['idTrabajador']  = 'error/No ha seleccionado el Trabajador';}
							//suma
							$n_tractores++;		
						}
					}
					if($_SESSION['sol_apli_productos'][$cuartel['valor_id']]){
						//Se recorren los quimicos a utilizar
						foreach ($_SESSION['sol_apli_productos'][$cuartel['valor_id']] as $key => $prod){
							$n_productos++;
						}
					}
				}
			}
			
			//Se verifican los cuarteles
			if(isset($n_cuarteles)&&$n_cuarteles==0){
				$error['cuarteles'] = 'error/No tiene cuarteles asignados a la solicitud';
			}
			//Se verifican los tractores
			if(isset($n_tractores)&&$n_tractores==0){
				$error['trabajos'] = 'error/No tiene tractores asignados a la solicitud';
			}
			//Se verifican los productos
			if(isset($n_productos)&&$n_productos==0){
				$error['trabajos'] = 'error/No tiene productos asignados a la solicitud';
			}
			
			

			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/**********************************************/
				//Se trae un listado con los productos	
				$arrProductos = array();
				$query = "SELECT  idProducto, DosisRecomendada, idUml AS Unimed
				FROM `productos_listado`
				ORDER BY idProducto";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
				$arrProd = array();
				foreach ($arrProductos as $prod) {
					$arrProd[$prod['idProducto']]['Unimed']            = $prod['Unimed'];
					$arrProd[$prod['idProducto']]['DosisRecomendada']  = $prod['DosisRecomendada'];
				}

				/**********************************************/
				//Se guardan los datos basicos
				if(isset($_SESSION['sol_apli_basicos']['idSistema']) && $_SESSION['sol_apli_basicos']['idSistema'] != ''){            $a  = "'".$_SESSION['sol_apli_basicos']['idSistema']."'" ;        }else{$a  ="''";}
				if(isset($_SESSION['sol_apli_basicos']['idPredio']) && $_SESSION['sol_apli_basicos']['idPredio'] != ''){              $a .= ",'".$_SESSION['sol_apli_basicos']['idPredio']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['idUsuario']) && $_SESSION['sol_apli_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['sol_apli_basicos']['idUsuario']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['idEstado']) && $_SESSION['sol_apli_basicos']['idEstado'] != ''){              $a .= ",'".$_SESSION['sol_apli_basicos']['idEstado']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['idTemporada']) && $_SESSION['sol_apli_basicos']['idTemporada'] != ''){        $a .= ",'".$_SESSION['sol_apli_basicos']['idTemporada']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['idEstadoFen']) && $_SESSION['sol_apli_basicos']['idEstadoFen'] != ''){        $a .= ",'".$_SESSION['sol_apli_basicos']['idEstadoFen']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['idCategoria']) && $_SESSION['sol_apli_basicos']['idCategoria'] != ''){        $a .= ",'".$_SESSION['sol_apli_basicos']['idCategoria']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['idProducto']) && $_SESSION['sol_apli_basicos']['idProducto'] != ''){          $a .= ",'".$_SESSION['sol_apli_basicos']['idProducto']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['f_creacion']) && $_SESSION['sol_apli_basicos']['f_creacion'] != ''){          $a .= ",'".$_SESSION['sol_apli_basicos']['f_creacion']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['f_programacion']) && $_SESSION['sol_apli_basicos']['f_programacion'] != ''){  
					$a .= ",'".$_SESSION['sol_apli_basicos']['f_programacion']."'" ;  
					$a .= ",'".fecha2NdiaMes($_SESSION['sol_apli_basicos']['f_programacion'])."'" ;
					$a .= ",'".fecha2NSemana($_SESSION['sol_apli_basicos']['f_programacion'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['sol_apli_basicos']['f_programacion'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['sol_apli_basicos']['f_programacion'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['sol_apli_basicos']['f_programacion_fin']) && $_SESSION['sol_apli_basicos']['f_programacion_fin'] != ''){  
					$a .= ",'".$_SESSION['sol_apli_basicos']['f_programacion_fin']."'" ;  
					$a .= ",'".fecha2NdiaMes($_SESSION['sol_apli_basicos']['f_programacion_fin'])."'" ;
					$a .= ",'".fecha2NSemana($_SESSION['sol_apli_basicos']['f_programacion_fin'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['sol_apli_basicos']['f_programacion_fin'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['sol_apli_basicos']['f_programacion_fin'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['sol_apli_basicos']['horaProg']) && $_SESSION['sol_apli_basicos']['horaProg'] != ''){             $a .= ",'".$_SESSION['sol_apli_basicos']['horaProg']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['horaProg_fin']) && $_SESSION['sol_apli_basicos']['horaProg_fin'] != ''){     $a .= ",'".$_SESSION['sol_apli_basicos']['horaProg_fin']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['Mojamiento']) && $_SESSION['sol_apli_basicos']['Mojamiento'] != ''){         $a .= ",'".$_SESSION['sol_apli_basicos']['Mojamiento']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['VelTractor']) && $_SESSION['sol_apli_basicos']['VelTractor'] != ''){         $a .= ",'".$_SESSION['sol_apli_basicos']['VelTractor']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['VelViento']) && $_SESSION['sol_apli_basicos']['VelViento'] != ''){           $a .= ",'".$_SESSION['sol_apli_basicos']['VelViento']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['TempMin']) && $_SESSION['sol_apli_basicos']['TempMin'] != ''){               $a .= ",'".$_SESSION['sol_apli_basicos']['TempMin']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['TempMax']) && $_SESSION['sol_apli_basicos']['TempMax'] != ''){               $a .= ",'".$_SESSION['sol_apli_basicos']['TempMax']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['sol_apli_basicos']['idPrioridad']) && $_SESSION['sol_apli_basicos']['idPrioridad'] != ''){       $a .= ",'".$_SESSION['sol_apli_basicos']['idPrioridad']."'" ;   }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_solicitud_aplicacion_listado` (idSistema, idPredio, idUsuario, idEstado, idTemporada,
				idEstadoFen, idCategoria, idProducto, f_creacion, f_programacion, progDia, progSemana, progMes, progAno, f_programacion_fin, 
				progDia_fin, progSemana_fin, progMes_fin, progAno_fin, horaProg, horaProg_fin, Mojamiento, VelTractor, VelViento, TempMin, 
				TempMax, idPrioridad) 
				VALUES ({$a} )";
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
					
					//Solo si se ejecuto correctamente
					if(isset($ultimo_id)&&$ultimo_id!=''){
						/*********************************************************************/		
						//Se guarda en historial la accion
						if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
						if(isset($_SESSION['sol_apli_basicos']['f_creacion']) && $_SESSION['sol_apli_basicos']['f_creacion'] != ''){  
							$a .= ",'".$_SESSION['sol_apli_basicos']['f_creacion']."'" ;  
						}else{
							$a .= ",''";
						}
						$a .= ",'".$_SESSION['sol_apli_basicos']['Observaciones']."'";    //Observacion
						$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
						$a .= ",'".$_SESSION['sol_apli_basicos']['idEstado']."'" ;        //Guardo el estado 
					
									
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `cross_solicitud_aplicacion_listado_historial` (idSolicitud, 
						Creacion_fecha, Observacion, idUsuario, idEstado) 
						VALUES ({$a} )";
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
					
					
						
						//se guardan los cuarteles
						if(isset($_SESSION['sol_apli_cuarteles'])&&$_SESSION['sol_apli_cuarteles']!=''){
							
							/*******************************************/
							//se recorren los cuarteles
							foreach ($_SESSION['sol_apli_cuarteles'] as $key => $cuartel){
								
								//filtros
								if(isset($ultimo_id) && $ultimo_id != ''){                          $a = "'".$ultimo_id."'" ;                  }else{$a  = "''";}
								if(isset($cuartel['idZona']) && $cuartel['idZona'] != ''){          $a .= ",'".$cuartel['idZona']."'" ;        }else{$a .= ",''";}
								if(isset($cuartel['Mojamiento']) && $cuartel['Mojamiento'] != ''){  $a .= ",'".$cuartel['Mojamiento']."'" ;    }else{$a .= ",''";}
								if(isset($cuartel['VelTractor']) && $cuartel['VelTractor'] != ''){  $a .= ",'".$cuartel['VelTractor']."'" ;    }else{$a .= ",''";}
								if(isset($cuartel['VelViento']) && $cuartel['VelViento'] != ''){    $a .= ",'".$cuartel['VelViento']."'" ;     }else{$a .= ",''";}
								if(isset($cuartel['TempMin']) && $cuartel['TempMin'] != ''){        $a .= ",'".$cuartel['TempMin']."'" ;       }else{$a .= ",''";}
								if(isset($cuartel['TempMax']) && $cuartel['TempMax'] != ''){        $a .= ",'".$cuartel['TempMax']."'" ;       }else{$a .= ",''";}
								$a .= ",'1'" ; //se asigna el estado
								
								// inserto los datos de registro en la db
								mysqli_query($dbConn, "SET SESSION sql_mode = ''");
								$query  = "INSERT INTO `cross_solicitud_aplicacion_listado_cuarteles` (idSolicitud, idZona, 
								Mojamiento, VelTractor, VelViento, TempMin, TempMax, idEstado) 
								VALUES ({$a} )";
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
								$ultimo_cuartel = mysqli_insert_id($dbConn);
						
								/*******************************************/
								//se recorren los tractores
								if($_SESSION['sol_apli_tractores'][$cuartel['valor_id']]){
									//Se recorren los tractores
									foreach ($_SESSION['sol_apli_tractores'][$cuartel['valor_id']] as $key => $tract){
										//filtros
										if(isset($ultimo_id) && $ultimo_id != ''){                          $a = "'".$ultimo_id."'" ;                 }else{$a  = "''";}
										if(isset($ultimo_cuartel) && $ultimo_cuartel != ''){                $a .= ",'".$ultimo_cuartel."'" ;          }else{$a .= ",''";}
										if(isset($tract['idTelemetria']) && $tract['idTelemetria'] != ''){  $a .= ",'".$tract['idTelemetria']."'" ;   }else{$a .= ",''";}
										if(isset($tract['idVehiculo']) && $tract['idVehiculo'] != ''){      $a .= ",'".$tract['idVehiculo']."'" ;     }else{$a .= ",''";}
										if(isset($tract['idTrabajador']) && $tract['idTrabajador'] != ''){  $a .= ",'".$tract['idTrabajador']."'" ;   }else{$a .= ",''";}
										
										// inserto los datos de registro en la db
										mysqli_query($dbConn, "SET SESSION sql_mode = ''");
										$query  = "INSERT INTO `cross_solicitud_aplicacion_listado_tractores` (idSolicitud, idCuarteles, 
										idTelemetria, idVehiculo, idTrabajador) 
										VALUES ({$a} )";
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
									}
								}
								/*******************************************/
								//se recorren los cuarteles
								if($_SESSION['sol_apli_productos'][$cuartel['valor_id']]){
									//Se recorren los quimicos a utilizar
									foreach ($_SESSION['sol_apli_productos'][$cuartel['valor_id']] as $key => $prod){
										
										$DosisRecomendada = $arrProd[$prod['idProducto']]['DosisRecomendada'];
										$idUml            = $arrProd[$prod['idProducto']]['Unimed'];
										
										//filtros
										if(isset($ultimo_id) && $ultimo_id != ''){                          $a = "'".$ultimo_id."'" ;                }else{$a  = "''";}
										if(isset($ultimo_cuartel) && $ultimo_cuartel != ''){                $a .= ",'".$ultimo_cuartel."'" ;         }else{$a .= ",''";}
										if(isset($prod['idProducto']) && $prod['idProducto'] != ''){        $a .= ",'".$prod['idProducto']."'" ;     }else{$a .= ",''";}
										if(isset($DosisRecomendada) && $DosisRecomendada != ''){            $a .= ",'".$DosisRecomendada."'" ;       }else{$a .= ",''";}
										if(isset($prod['DosisAplicar']) && $prod['DosisAplicar'] != ''){    $a .= ",'".$prod['DosisAplicar']."'" ;   }else{$a .= ",''";}
										if(isset($idUml) && $idUml != ''){                                  $a .= ",'".$idUml."'" ;                  }else{$a .= ",''";}
										if(isset($prod['Objetivo']) && $prod['Objetivo'] != ''){            $a .= ",'".$prod['Objetivo']."'" ;       }else{$a .= ",''";}
										
										
							
										// inserto los datos de registro en la db
										mysqli_query($dbConn, "SET SESSION sql_mode = ''");
										$query  = "INSERT INTO `cross_solicitud_aplicacion_listado_productos` (idSolicitud, idCuarteles, 
										idProducto, DosisRecomendada, DosisAplicar, idUml, Objetivo) 
										VALUES ({$a} )";
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
									}
								}
							}
						}
					
						/******************************************/
						//En base al estado se hacen las consultas
						$transaccion = 'cross_solicitud_aplicacion_ejecutar.php';
						$xbody = '
						<h3>Se ha creado la solicitud N° '.n_doc($ultimo_id, 5).'</h3>
						<p>Se ha cambiado el estado a Programado en la siguiente solicitud</p>
						<a href="http://agropraxis.exilon360.com/view_solicitud_aplicacion.php?view='.$ultimo_id.'">Ver Aqui</a>';
						

						//Permisos a las transacciones
						$arrCorreos = array();
						$query = "SELECT 
						usuarios_listado.usuario AS UsuarioNick,
						usuarios_listado.email AS UsuarioNombre,
						usuarios_listado.Nombre AS UsuarioEmail

						FROM `core_permisos_listado`
						INNER JOIN `usuarios_permisos`  ON usuarios_permisos.idAdmpm    = core_permisos_listado.idAdmpm
						LEFT JOIN `usuarios_listado`    ON usuarios_listado.idUsuario   = usuarios_permisos.idUsuario
						WHERE core_permisos_listado.Direccionbase='".$transaccion."'
						";
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
						while ( $row = mysqli_fetch_assoc ($resultado)) {
						array_push( $arrCorreos,$row );
						}
							
							
						//Notificaciones a los correos
						foreach ($arrCorreos as $correo) {
							/*******************/
							//Carga de la libreria de envio de correos
							require_once '../LIBS_php/PHPMailer/PHPMailerAutoload.php';	
							//Instanciacion
							$mail = new PHPMailer;
							//Quien envia el correo
							$mail->setFrom($_SESSION['usuario']['basic_data']['CorreoInterno'], $_SESSION['usuario']['basic_data']['RazonSocial']);
							//A quien responder el correo
							$mail->addReplyTo($_SESSION['usuario']['basic_data']['CorreoInterno'], $_SESSION['usuario']['basic_data']['RazonSocial']);
							//Destinatarios
							$mail->addAddress($correo['UsuarioEmail'], $correo['UsuarioNombre']);
							//Asunto
							$mail->Subject = 'Notificacion creacion de Consolidacion';
							//Cuerpo del mensaje
							$mail->msgHTML($xbody);
							//Envio del mensaje
							if (!$mail->send()) {
								//echo "Mailer Error: " . $mail->ErrorInfo;
							} else {
								//echo "Message sent!";
							}
						}
					
					
						/*****************************************************/
						//Borro todas las sesiones una vez grabados los datos
						unset($_SESSION['sol_apli_basicos']);
						unset($_SESSION['sol_apli_cuarteles']);
						unset($_SESSION['sol_apli_tractores']);
						unset($_SESSION['sol_apli_productos']);
						unset($_SESSION['sol_apli_temporal']);
					
						header( 'Location: '.$location.'&created=true' );
						die;
					}
				}
				
				
				
			}	
	

		break;	
/*******************************************************************************************************************/		
		case 'del_Solicitud':		
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$ndata_1 = 0;
	
			/*******************************************************************/
			//se verifica si existen cuarteles cerrados
			if(isset($_GET['del_Solicitud'])){
				$ndata_1 = db_select_nrows ('idCuarteles', 'cross_solicitud_aplicacion_listado_cuarteles', '', "idSolicitud='".$_GET['del_Solicitud']."' AND idEstado='2'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/Hay '.$ndata_1.' cuarteles con cierre realizado, no puede eliminar la solicitud';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				
				
				//se borran los datos de la tabla principal
				$query  = "DELETE FROM `cross_solicitud_aplicacion_listado` WHERE idSolicitud = {$_GET['del_Solicitud']}";
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
				
				//se borran los cuarteles
				$query  = "DELETE FROM `cross_solicitud_aplicacion_listado_cuarteles` WHERE idSolicitud = {$_GET['del_Solicitud']}";
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
				
				//se borran los productos usados
				$query  = "DELETE FROM `cross_solicitud_aplicacion_listado_productos` WHERE idSolicitud = {$_GET['del_Solicitud']}";
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
				
				//se borran los tractores
				$query  = "DELETE FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idSolicitud = {$_GET['del_Solicitud']}";
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
				
				//se redirije			
				header( 'Location: '.$location.'&deleted=true' );
				die;
				
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'updt_mod_base':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			/*******************************************************************/
			//si se esta cerrando la solicitud, verificar que todos los cuarteles esten cerrados
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($idSolicitud)&&isset($idEstado)&&$idEstado==3){
				$ndata_1 = db_select_nrows ('idCuarteles', 'cross_solicitud_aplicacion_listado_cuarteles', '', "idSolicitud='".$idSolicitud."' AND idEstado!='2'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/Aun existen '.$ndata_1.' cuarteles con cierre pendiente';}
			/*******************************************************************/
			//Se verifica concordancia fecha y hora
			if(isset($f_ejecucion)&&$f_ejecucion!='0000-00-00'&&isset($f_termino)&&$f_termino!='0000-00-00'&&$f_ejecucion==$f_termino){
				if(isset($horaEjecucion)&&$horaEjecucion!='0000-00-00'&&isset($horaTermino)&&$horaTermino!='0000-00-00'&&$horaEjecucion>$horaTermino){
					$error['ejecucion'] = 'error/La hora de ejecucion es superior a la hora de termino';
				}
			}
			/*******************************************************************/
			//Se verifica que no existan cuarteles ya cerrados en caso de cancelar ejecucion
			if(isset($idEstado)&&$idEstado==1&&isset($idEstadoActual)&&$idEstadoActual==2){
				if(isset($idSolicitud)){
					$ndata_2 = db_select_nrows ('idCuarteles', 'cross_solicitud_aplicacion_listado_cuarteles', '', "idSolicitud='".$idSolicitud."' AND idEstado='2'", $dbConn);
				}
				//generacion de errores
				if($ndata_2 > 0) {$error['ndata_2'] = 'error/Hay '.$ndata_2.' cuarteles con cierre realizado, no puede cancelar la ejecucion';}
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen todos los datos de mi usuario
				$query = "SELECT idProducto
				FROM `cross_solicitud_aplicacion_listado`
				WHERE idSolicitud = ".$idSolicitud;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$row_data = mysqli_fetch_assoc ($resultado);

				//si cambia la variedad se resetea todo
				if(isset($idProducto)&&$row_data['idProducto']!=$idProducto){
					//Borro todos los datos
					$query  = "DELETE FROM `cross_solicitud_aplicacion_listado_cuarteles` WHERE idSolicitud = ".$idSolicitud;
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
					
					$query  = "DELETE FROM `cross_solicitud_aplicacion_listado_productos` WHERE idSolicitud = ".$idSolicitud;
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
					
					$query  = "DELETE FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idSolicitud = ".$idSolicitud;
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
					
				}
				
				//Filtros
				$a = "idSolicitud='".$idSolicitud."'" ;
				if(isset($idSistema) && $idSistema != ''){                     $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idPredio) && $idPredio != ''){                       $a .= ",idPredio='".$idPredio."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){                     $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idEstado) && $idEstado != ''){                       $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idTemporada) && $idTemporada != ''){                 $a .= ",idTemporada='".$idTemporada."'" ;}
				if(isset($idEstadoFen) && $idEstadoFen != ''){                 $a .= ",idEstadoFen='".$idEstadoFen."'" ;}
				if(isset($idCategoria) && $idCategoria != ''){                 $a .= ",idCategoria='".$idCategoria."'" ;}
				if(isset($idProducto) && $idProducto != ''){                   $a .= ",idProducto='".$idProducto."'" ;}
				if(isset($f_creacion) && $f_creacion != ''){                   $a .= ",f_creacion='".$f_creacion."'" ;}
				if(isset($f_programacion) && $f_programacion != ''){           $a .= ",f_programacion='".$f_programacion."'" ;}
				if(isset($f_ejecucion) && $f_ejecucion != ''){                 $a .= ",f_ejecucion='".$f_ejecucion."'" ;}
				if(isset($f_termino) && $f_termino != ''){                     $a .= ",f_termino='".$f_termino."'" ;}
				if(isset($Observaciones) && $Observaciones != ''){             $a .= ",Observaciones='".$Observaciones."'" ;}
				if(isset($horaProg) && $horaProg != ''){                       $a .= ",horaProg='".$horaProg."'" ;}
				if(isset($horaEjecucion) && $horaEjecucion != ''){             $a .= ",horaEjecucion='".$horaEjecucion."'" ;}
				if(isset($horaTermino) && $horaTermino != ''){                 $a .= ",horaTermino='".$horaTermino."'" ;}
				if(isset($Mojamiento) && $Mojamiento != ''){                   $a .= ",Mojamiento='".$Mojamiento."'" ;}
				if(isset($VelTractor) && $VelTractor != ''){                   $a .= ",VelTractor='".$VelTractor."'" ;}
				if(isset($VelViento) && $VelViento != ''){                     $a .= ",VelViento='".$VelViento."'" ;}
				if(isset($TempMin) && $TempMin != ''){                         $a .= ",TempMin='".$TempMin."'" ;}
				if(isset($TempMax) && $TempMax != ''){                         $a .= ",TempMax='".$TempMax."'" ;}
				if(isset($idPrioridad) && $idPrioridad != ''){                 $a .= ",idPrioridad='".$idPrioridad."'" ;}
				if(isset($horaProg_fin) && $horaProg_fin != ''){               $a .= ",horaProg_fin='".$horaProg_fin."'" ;}
				if(isset($horaEjecucion_fin) && $horaEjecucion_fin != ''){     $a .= ",horaEjecucion_fin='".$horaEjecucion_fin."'" ;}
				if(isset($horaTermino_fin) && $horaTermino_fin != ''){         $a .= ",horaTermino_fin='".$horaTermino_fin."'" ;}
				if(isset($f_programacion_fin) && $f_programacion_fin != ''){   $a .= ",f_programacion_fin='".$f_programacion_fin."'" ;}
				if(isset($f_ejecucion_fin) && $f_ejecucion_fin != ''){         $a .= ",f_ejecucion_fin='".$f_ejecucion_fin."'" ;}
				if(isset($f_termino_fin) && $f_termino_fin != ''){             $a .= ",f_termino_fin='".$f_termino_fin."'" ;}
				if(isset($idDosificador) && $idDosificador != ''){             $a .= ",idDosificador='".$idDosificador."'" ;}
				
				if(isset($f_programacion) && $f_programacion != ''){  
					$a .= ",progDia='".fecha2NdiaMes($f_programacion)."'" ;
					$a .= ",progSemana='".fecha2NSemana($f_programacion)."'" ;
					$a .= ",progMes='".fecha2NMes($f_programacion)."'" ;
					$a .= ",progAno='".fecha2Ano($f_programacion)."'" ;
				}
				if(isset($f_ejecucion) && $f_ejecucion != ''){  
					$a .= ",ejeDia='".fecha2NdiaMes($f_ejecucion)."'" ;
					$a .= ",ejeSemana='".fecha2NSemana($f_ejecucion)."'" ;
					$a .= ",ejeMes='".fecha2NMes($f_ejecucion)."'" ;
					$a .= ",ejeAno='".fecha2Ano($f_ejecucion)."'" ;
				}
				if(isset($f_termino) && $f_termino != ''){  
					$a .= ",terDia='".fecha2NdiaMes($f_termino)."'" ;
					$a .= ",terSemana='".fecha2NSemana($f_termino)."'" ;
					$a .= ",terMes='".fecha2NMes($f_termino)."'" ;
					$a .= ",terAno='".fecha2Ano($f_termino)."'" ;
				}
				if(isset($f_programacion_fin) && $f_programacion_fin != ''){  
					$a .= ",progDia_fin='".fecha2NdiaMes($f_programacion_fin)."'" ;
					$a .= ",progSemana_fin='".fecha2NSemana($f_programacion_fin)."'" ;
					$a .= ",progMes_fin='".fecha2NMes($f_programacion_fin)."'" ;
					$a .= ",progAno_fin='".fecha2Ano($f_programacion_fin)."'" ;
				}
				if(isset($f_ejecucion_fin) && $f_ejecucion_fin != ''){  
					$a .= ",ejeDia_fin='".fecha2NdiaMes($f_ejecucion_fin)."'" ;
					$a .= ",ejeSemana_fin='".fecha2NSemana($f_ejecucion_fin)."'" ;
					$a .= ",ejeMes_fin='".fecha2NMes($f_ejecucion_fin)."'" ;
					$a .= ",ejeAno_fin='".fecha2Ano($f_ejecucion_fin)."'" ;
				}
				if(isset($f_termino_fin) && $f_termino_fin != ''){  
					$a .= ",terDia_fin='".fecha2NdiaMes($f_termino_fin)."'" ;
					$a .= ",terSemana_fin='".fecha2NSemana($f_termino_fin)."'" ;
					$a .= ",terMes_fin='".fecha2NMes($f_termino_fin)."'" ;
					$a .= ",terAno_fin='".fecha2Ano($f_termino_fin)."'" ;
				}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `cross_solicitud_aplicacion_listado` SET ".$a." WHERE idSolicitud = '$idSolicitud'";
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
					
					//se actualizan los datos internos de los cuarteles
					$a = "idSolicitud='".$idSolicitud."'" ;
					if(isset($Mojamiento) && $Mojamiento != ''){           $a .= ",Mojamiento='".$Mojamiento."'" ;}
					if(isset($VelTractor) && $VelTractor != ''){           $a .= ",VelTractor='".$VelTractor."'" ;}
					if(isset($VelViento) && $VelViento != ''){             $a .= ",VelViento='".$VelViento."'" ;}
					if(isset($TempMin) && $TempMin != ''){                 $a .= ",TempMin='".$TempMin."'" ;}
					if(isset($TempMax) && $TempMax != ''){                 $a .= ",TempMax='".$TempMax."'" ;}
					
					// inserto los datos de registro en la db
					$query  = "UPDATE `cross_solicitud_aplicacion_listado_cuarteles` SET ".$a." WHERE idSolicitud = '".$idSolicitud."'";
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
						
						/******************************************/
						//Historial
						if(isset($Observacion)&&$Observacion!=''){
							if(isset($idSolicitud) && $idSolicitud != ''){       $a  = "'".$idSolicitud."'" ;       }else{$a  ="''";}
							if(isset($Creacion_fecha) && $Creacion_fecha != ''){ $a .= ",'".$Creacion_fecha."'" ;   }else{$a .=",''";}
							if(isset($idUsuario) && $idUsuario != ''){           $a .= ",'".$idUsuario."'" ;        }else{$a .=",''";}
							if(isset($Observacion) && $Observacion != ''){       $a .= ",'".$Observacion."'" ;      }else{$a .=",''";}
							if(isset($idEstado) && $idEstado != ''){             $a .= ",'".$idEstado."'" ;         }else{$a .=",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `cross_solicitud_aplicacion_listado_historial` (idSolicitud, 
							Creacion_fecha, idUsuario, Observacion, idEstado) 
							VALUES ({$a} )";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
						}
						
						/******************************************/
						//En base al estado se hacen las consultas
						switch ($idEstado) {
							//Solicitado
							case 1:
								$transaccion = 'cross_solicitud_aplicacion_crear.php';
								$xbody = '
								<h3>Se ha rechazado solicitud</h3>
								<p>Se ha cambiado el estado a Solicitado por el siguiente motivo:</p>
								<p><strong>Observacion :</strong>'.$Observacion.'</p>
								<a href="http://agropraxis.exilon360.com/view_solicitud_aplicacion.php?view='.$idSolicitud.'">Ver Aqui</a>';
								break;
							//Programado
							case 2:
								$transaccion = 'cross_solicitud_aplicacion_ejecutar.php';
								$xbody = '
								<h3>Se ha programado la solicitud N° '.n_doc($idSolicitud, 5).'</h3>
								<p>Se ha cambiado el estado a Programado en la siguiente solicitud</p>
								<a href="http://agropraxis.exilon360.com/view_solicitud_aplicacion.php?view='.$idSolicitud.'">Ver Aqui</a>';
								break;
							//Ejecutado
							case 3:
								$transaccion = 'cross_solicitud_aplicacion_ejecucion.php';
								$xbody = '
								<h3>Se ha cerrado la solicitud N° '.n_doc($idSolicitud, 5).'</h3>
								<p>Se ha cambiado el estado a Cerrado en la siguiente solicitud</p>
								<a href="http://agropraxis.exilon360.com/view_solicitud_aplicacion.php?view='.$idSolicitud.'">Ver Aqui</a>';
								break;
						}

						//Permisos a las transacciones
						$arrCorreos = array();
						$query = "SELECT 
						usuarios_listado.usuario AS UsuarioNick,
						usuarios_listado.email AS UsuarioNombre,
						usuarios_listado.Nombre AS UsuarioEmail

						FROM `core_permisos_listado`
						INNER JOIN `usuarios_permisos`  ON usuarios_permisos.idAdmpm    = core_permisos_listado.idAdmpm
						LEFT JOIN `usuarios_listado`    ON usuarios_listado.idUsuario   = usuarios_permisos.idUsuario
						WHERE core_permisos_listado.Direccionbase='".$transaccion."'
						";
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
						while ( $row = mysqli_fetch_assoc ($resultado)) {
						array_push( $arrCorreos,$row );
						}
						
						
						//Notificaciones a los correos
						foreach ($arrCorreos as $correo) {
							/*******************/
							//Carga de la libreria de envio de correos
							require_once '../LIBS_php/PHPMailer/PHPMailerAutoload.php';	
							//Instanciacion
							$mail = new PHPMailer;
							//Quien envia el correo
							$mail->setFrom($_SESSION['usuario']['basic_data']['CorreoInterno'], $_SESSION['usuario']['basic_data']['RazonSocial']);
							//A quien responder el correo
							$mail->addReplyTo($_SESSION['usuario']['basic_data']['CorreoInterno'], $_SESSION['usuario']['basic_data']['RazonSocial']);
							//Destinatarios
							$mail->addAddress($correo['UsuarioEmail'], $correo['UsuarioNombre']);
							//Asunto
							$mail->Subject = 'Notificacion creacion de Consolidacion';
							//Cuerpo del mensaje
							$mail->msgHTML($xbody);
							//Envio del mensaje
							if (!$mail->send()) {
								//echo "Mailer Error: " . $mail->ErrorInfo;
							} else {
								//echo "Message sent!";
							}
						}
						
						//Notificaciones dentro del sistema
						
					
						header( 'Location: '.$location.'&not_modbase=true' );
						die;
					}
				}
				
				
			}

				
		break;		
		
/*******************************************************************************************************************/		
		case 'updt_addCuartel':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
				
				/******************************************/
				//Cuarteles
				if(isset($idSolicitud) && $idSolicitud != ''){  $a  = "'".$idSolicitud."'" ;   }else{$a  ="''";}
				if(isset($idZona) && $idZona != ''){            $a .= ",'".$idZona."'" ;       }else{$a .=",''";}
				if(isset($Mojamiento) && $Mojamiento != ''){    $a .= ",'".$Mojamiento."'" ;   }else{$a .=",''";}
				if(isset($VelTractor) && $VelTractor != ''){    $a .= ",'".$VelTractor."'" ;   }else{$a .=",''";}
				if(isset($VelViento) && $VelViento != ''){      $a .= ",'".$VelViento."'" ;    }else{$a .=",''";}
				if(isset($TempMin) && $TempMin != ''){          $a .= ",'".$TempMin."'" ;      }else{$a .=",''";}
				if(isset($TempMax) && $TempMax != ''){          $a .= ",'".$TempMax."'" ;      }else{$a .=",''";}
				$a .= ",'1'" ; //se asigna el estado
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_solicitud_aplicacion_listado_cuarteles` (idSolicitud, idZona,
				Mojamiento, VelTractor, VelViento, TempMin, TempMax, idEstado) 
				VALUES ({$a} )";
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
				//recibo el último id generado por mi sesion
				$idCuarteles_id = mysqli_insert_id($dbConn);
				
				/******************************************/
				//tractores
				if(isset($idSolicitud) && $idSolicitud != ''){        $a  = "'".$idSolicitud."'" ;      }else{$a  ="''";}
				if(isset($idCuarteles_id) && $idCuarteles_id != ''){  $a .= ",'".$idCuarteles_id."'" ;  }else{$a .=",''";}
				if(isset($idTelemetria) && $idTelemetria != ''){      $a .= ",'".$idTelemetria."'" ;    }else{$a .=",''";}
				if(isset($idVehiculo) && $idVehiculo != ''){          $a .= ",'".$idVehiculo."'" ;      }else{$a .=",''";}
				if(isset($idTrabajador) && $idTrabajador != ''){      $a .= ",'".$idTrabajador."'" ;    }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_solicitud_aplicacion_listado_tractores` (idSolicitud, idCuarteles,
				idTelemetria, idVehiculo, idTrabajador) 
				VALUES ({$a} )";
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
				
				/******************************************/
				//Producto
				if(isset($idSolicitud) && $idSolicitud != ''){           $a  = "'".$idSolicitud."'" ;       }else{$a  ="''";}
				if(isset($idCuarteles_id) && $idCuarteles_id != ''){     $a .= ",'".$idCuarteles_id."'" ;   }else{$a .=",''";}
				if(isset($idProducto) && $idProducto != ''){             $a .= ",'".$idProducto."'" ;       }else{$a .=",''";}
				if(isset($DosisRecomendada) && $DosisRecomendada != ''){ $a .= ",'".$DosisRecomendada."'" ; }else{$a .=",''";}
				if(isset($DosisAplicar) && $DosisAplicar != ''){         $a .= ",'".$DosisAplicar."'" ;     }else{$a .=",''";}
				if(isset($idUml) && $idUml != ''){                       $a .= ",'".$idUml."'" ;            }else{$a .=",''";}
				if(isset($Objetivo) && $Objetivo != ''){                 $a .= ",'".$Objetivo."'" ;         }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_solicitud_aplicacion_listado_productos` (idSolicitud, idCuarteles,
				idProducto, DosisRecomendada, DosisAplicar, idUml, Objetivo) 
				VALUES ({$a} )";
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
					
				
				/************************************************************/
				//se redirije	
				header( 'Location: '.$location.'&not_addcuartel=true' );
				die;
				
			}

		break;	
/*******************************************************************************************************************/		
		case 'updt_editCuartel':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
				
				
				//Filtros
				$a = "idCuarteles='".$idCuarteles."'" ;
				if(isset($idSolicitud) && $idSolicitud != ''){   $a .= ",idSolicitud='".$idSolicitud."'" ;}
				if(isset($idZona) && $idZona != ''){             $a .= ",idZona='".$idZona."'" ;}
				if(isset($Mojamiento) && $Mojamiento != ''){     $a .= ",Mojamiento='".$Mojamiento."'" ;}
				if(isset($VelTractor) && $VelTractor != ''){     $a .= ",VelTractor='".$VelTractor."'" ;}
				if(isset($VelViento) && $VelViento != ''){       $a .= ",VelViento='".$VelViento."'" ;}
				if(isset($TempMin) && $TempMin != ''){           $a .= ",TempMin='".$TempMin."'" ;}
				if(isset($TempMax) && $TempMax != ''){           $a .= ",TempMax='".$TempMax."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `cross_solicitud_aplicacion_listado_cuarteles` SET ".$a." WHERE idCuarteles = '$idCuarteles'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&not_editprod=true' );
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
		case 'updt_close_Cuartel':
		
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/***********************************************************/
			//Si no fue ejecutado
			if(isset($idEjecucion)&&$idEjecucion==1){
				
				/***************************************/
				//se cierra el cuartel
				$a  = "idEstado='2'" ;
				$a .= ",f_cierre='".$f_cierre."'" ;
				$a .= ",idUsuario='".$idUsuario."'" ;
				$a .= ",idEjecucion='".$idEjecucion."'" ;
						
				// inserto los datos de registro en la db
				$query  = "UPDATE `cross_solicitud_aplicacion_listado_cuarteles` SET ".$a." WHERE idCuarteles = '".$idCuarteles."'";
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
					header( 'Location: '.$location.'&not_closecuartel=true' );
					die;
				}
					
					
					
			//Si fue ejecutado	
			}elseif(isset($idEjecucion)&&$idEjecucion==2){
				/***********************************************************/
				//Cuento si el cuartel tiene trabajos realizados
				//Se trae un listado con los tractores	
				$arrTractores = array();
				$query = "SELECT 
				cross_solicitud_aplicacion_listado_tractores.idTractores,
				cross_solicitud_aplicacion_listado_tractores.idTelemetria,
				cross_solicitud_aplicacion_listado_cuarteles.idZona,
				cross_solicitud_aplicacion_listado.idSolicitud,
				telemetria_listado.cantSensores,
				telemetria_listado.Nombre AS Tractor
					
				FROM `cross_solicitud_aplicacion_listado_tractores`
				LEFT JOIN `cross_solicitud_aplicacion_listado_cuarteles`  ON cross_solicitud_aplicacion_listado_cuarteles.idCuarteles  = cross_solicitud_aplicacion_listado_tractores.idCuarteles
				LEFT JOIN `cross_solicitud_aplicacion_listado`            ON cross_solicitud_aplicacion_listado.idSolicitud            = cross_solicitud_aplicacion_listado_tractores.idSolicitud
				LEFT JOIN `telemetria_listado`                            ON telemetria_listado.idTelemetria                           = cross_solicitud_aplicacion_listado_tractores.idTelemetria
					
				WHERE cross_solicitud_aplicacion_listado_tractores.idCuarteles = ".$idCuarteles." 
				ORDER BY cross_solicitud_aplicacion_listado_tractores.idTractores";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTractores,$row );
				}
					
				/*******************************************************************/
				//variables
				$ndata_1      = 0;
				$ntractores   = 0;
				//se recorren los tractores
				foreach ($arrTractores as $trac) {
					$ndata_1 = db_select_nrows ('idTabla', 'telemetria_listado_tablarelacionada_'.$trac['idTelemetria'], '', "idZona = ".$trac['idZona']." AND idSolicitud=0 AND (FechaSistema BETWEEN '".$f_ejecucion."' AND '".$f_ejecucion_fin."') AND Sensor_1!=0 AND Sensor_2!=0", $dbConn);
					//mientras sea distinto de 0
					if($ndata_1!=0) {
						$ntractores++;
					}
				}
				//generacion de errores
				if($ntractores==0) {$error['ndata_1'] = 'error/Ninguno de los equipos ha realizado su recorrido en el cuartel';}
				/*******************************************************************/
				
				if ( empty($error) ) {
					
					
					//se recorren los tractores
					foreach ($arrTractores as $trac) {
						/***************************************/
						$aa = '';
						//se recorre deacuerdo a la cantidad de sensores
						for ($i = 1; $i <= $trac['cantSensores']; $i++) { 
							$aa .= ',MIN(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_'.$i.'_Min';
							$aa .= ',MAX(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_'.$i.'_Max';
							$aa .= ',AVG(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_'.$i.'_Prom';
							$aa .= ',SUM(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_'.$i.'_Sum';
						}
						
						/****************************************************************/
						//Si esta dentro del cuartel
						//se consulta por los datos
						$query = "SELECT 
						MIN(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadMin,
						MAX(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadMax,
						AVG(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadProm,
						SUM(GeoMovimiento) AS GeoDistance,
						SUM(Diferencia) AS Diferencia
						".$aa."
						
						FROM `telemetria_listado_tablarelacionada_".$trac['idTelemetria']."`
						WHERE idZona = ".$trac['idZona']." AND idSolicitud=0 AND (FechaSistema BETWEEN '".$f_ejecucion."' AND '".$f_ejecucion_fin."')
						AND Sensor_1!=0 AND Sensor_2!=0
						ORDER BY FechaSistema ASC, HoraSistema ASC ";
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
						$rowTablaRel = mysqli_fetch_assoc ($resultado);
						
						/****************************************************************/
						//Si esta fuera del cuartel
						//se consulta por los datos
						$query = "SELECT 
						MIN(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadMin,
						MAX(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadMax,
						AVG(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadProm,
						SUM(GeoMovimiento) AS GeoDistance,
						SUM(Diferencia) AS Diferencia
						".$aa."
								
						FROM `telemetria_listado_tablarelacionada_".$trac['idTelemetria']."`
						WHERE idZona = 0 AND idSolicitud=0 AND (FechaSistema BETWEEN '".$f_ejecucion."' AND '".$f_ejecucion_fin."') 	
						ORDER BY FechaSistema ASC, HoraSistema ASC ";
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
						$rowTablaRel_out = mysqli_fetch_assoc ($resultado);
								
								
						/***************************************/
						//se guardan los datos
						$a = "idTractores='".$trac['idTractores']."'" ;
						if(isset($rowTablaRel['GeoVelocidadMin']) && $rowTablaRel['GeoVelocidadMin'] != ''){             $a .= ",GeoVelocidadMin='".$rowTablaRel['GeoVelocidadMin']."'" ;}
						if(isset($rowTablaRel['GeoVelocidadMax']) && $rowTablaRel['GeoVelocidadMax'] != ''){             $a .= ",GeoVelocidadMax='".$rowTablaRel['GeoVelocidadMax']."'" ;}
						if(isset($rowTablaRel['GeoVelocidadProm']) && $rowTablaRel['GeoVelocidadProm'] != ''){           $a .= ",GeoVelocidadProm='".$rowTablaRel['GeoVelocidadProm']."'" ;}
						if(isset($rowTablaRel['GeoDistance']) && $rowTablaRel['GeoDistance'] != ''){                     $a .= ",GeoDistance='".$rowTablaRel['GeoDistance']."'" ;}
						if(isset($rowTablaRel['Diferencia']) && $rowTablaRel['Diferencia'] != ''){                       $a .= ",Diferencia='".$rowTablaRel['Diferencia']."'" ;}
						
						if(isset($rowTablaRel_out['GeoVelocidadMin']) && $rowTablaRel_out['GeoVelocidadMin'] != ''){     $a .= ",GeoVelocidadMin_out='".$rowTablaRel_out['GeoVelocidadMin']."'" ;}
						if(isset($rowTablaRel_out['GeoVelocidadMax']) && $rowTablaRel_out['GeoVelocidadMax'] != ''){     $a .= ",GeoVelocidadMax_out='".$rowTablaRel_out['GeoVelocidadMax']."'" ;}
						if(isset($rowTablaRel_out['GeoVelocidadProm']) && $rowTablaRel_out['GeoVelocidadProm'] != ''){   $a .= ",GeoVelocidadProm_out='".$rowTablaRel_out['GeoVelocidadProm']."'" ;}
						if(isset($rowTablaRel_out['GeoDistance']) && $rowTablaRel_out['GeoDistance'] != ''){             $a .= ",GeoDistance_out='".$rowTablaRel_out['GeoDistance']."'" ;}
						if(isset($rowTablaRel_out['Diferencia']) && $rowTablaRel_out['Diferencia'] != ''){               $a .= ",Diferencia_out='".$rowTablaRel_out['Diferencia']."'" ;}
						
						//se recorre deacuerdo a la cantidad de sensores
						for ($i = 1; $i <= $trac['cantSensores']; $i++) { 
							if(isset($rowTablaRel['Sensor_'.$i.'_Prom']) && $rowTablaRel['Sensor_'.$i.'_Prom'] != ''){           $a .= ",Sensor_".$i."_Prom='".$rowTablaRel['Sensor_'.$i.'_Prom']."'" ;}
							if(isset($rowTablaRel['Sensor_'.$i.'_Min']) && $rowTablaRel['Sensor_'.$i.'_Min'] != ''){             $a .= ",Sensor_".$i."_Min='".$rowTablaRel['Sensor_'.$i.'_Min']."'" ;}
							if(isset($rowTablaRel['Sensor_'.$i.'_Max']) && $rowTablaRel['Sensor_'.$i.'_Max'] != ''){             $a .= ",Sensor_".$i."_Max='".$rowTablaRel['Sensor_'.$i.'_Max']."'" ;}
							if(isset($rowTablaRel['Sensor_'.$i.'_Sum']) && $rowTablaRel['Sensor_'.$i.'_Sum'] != ''){             $a .= ",Sensor_".$i."_Sum='".$rowTablaRel['Sensor_'.$i.'_Sum']."'" ;}
							if(isset($rowTablaRel_out['Sensor_'.$i.'_Prom']) && $rowTablaRel_out['Sensor_'.$i.'_Prom'] != ''){   $a .= ",Sensor_out_".$i."_Prom='".$rowTablaRel_out['Sensor_'.$i.'_Prom']."'" ;}
							if(isset($rowTablaRel_out['Sensor_'.$i.'_Min']) && $rowTablaRel_out['Sensor_'.$i.'_Min'] != ''){     $a .= ",Sensor_out_".$i."_Min='".$rowTablaRel_out['Sensor_'.$i.'_Min']."'" ;}
							if(isset($rowTablaRel_out['Sensor_'.$i.'_Max']) && $rowTablaRel_out['Sensor_'.$i.'_Max'] != ''){     $a .= ",Sensor_out_".$i."_Max='".$rowTablaRel_out['Sensor_'.$i.'_Max']."'" ;}
							if(isset($rowTablaRel_out['Sensor_'.$i.'_Sum']) && $rowTablaRel_out['Sensor_'.$i.'_Sum'] != ''){     $a .= ",Sensor_out_".$i."_Sum='".$rowTablaRel_out['Sensor_'.$i.'_Sum']."'" ;}
						}
						
						// inserto los datos de registro en la db
						$query  = "UPDATE `cross_solicitud_aplicacion_listado_tractores` SET ".$a." WHERE idTractores = '".$trac['idTractores']."'";
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
						
						/***************************************/
						//se actualiza la solicitud
						$a = "idSolicitud='".$trac['idSolicitud']."'" ;
							
						// inserto los datos de registro en la db
						$query  = "UPDATE `telemetria_listado_tablarelacionada_".$trac['idTelemetria']."` SET ".$a." WHERE idZona = ".$trac['idZona']." AND idSolicitud=0 AND (FechaSistema BETWEEN '".$f_ejecucion."' AND '".$f_ejecucion_fin."') AND Sensor_1!=0 AND Sensor_2!=0 ";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);
						// inserto los datos de registro en la db
						$query  = "UPDATE `telemetria_listado_tablarelacionada_".$trac['idTelemetria']."` SET ".$a." WHERE idZona = 0 AND idSolicitud=0 AND (FechaSistema BETWEEN '".$f_ejecucion."' AND '".$f_ejecucion_fin."') ";
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
					}
					
					/***************************************/
					//se cierra el cuartel
					$a  = "idEstado='2'" ;
					$a .= ",f_cierre='".$f_cierre."'" ;
					$a .= ",idUsuario='".$idUsuario."'" ;
					$a .= ",idEjecucion='".$idEjecucion."'" ;
						
					// inserto los datos de registro en la db
					$query  = "UPDATE `cross_solicitud_aplicacion_listado_cuarteles` SET ".$a." WHERE idCuarteles = '".$idCuarteles."'";
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
					
					header( 'Location: '.$location.'&not_closecuartel=true' );
					die;
					
				}
			}
			
		
		

		
		break;	
/*******************************************************************************************************************/		
		case 'updt_close_all_Cuartel':
		
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			/*******************************************************************/
			//variables
			if(isset($idEjecucion)){      $ndata_0 = count($idEjecucion);      }else{$ndata_0 = 0;}

			//generacion de errores
			if($ndata_0==0) {
				$error1['ndata_0'] = 'error/No hay cuarteles agregados';
			}else{

				//Recorro los cuarteles
				for($j1 = 0; $j1 < $ndata_0; $j1++){
					//Para mostrar en la creacion
					
					/***********************************************************/
					//Si no fue ejecutado
					if(isset($idEjecucion[$j1])&&$idEjecucion[$j1]==1){
						
					//Si fue ejecutado	
					}elseif(isset($idEjecucion[$j1])&&$idEjecucion[$j1]==2){	
						/***********************************************************/
						//Cuento si el cuartel tiene trabajos realizados
						//Se trae un listado con los tractores	
						$arrTractores = array();
						$query = "SELECT 
						cross_solicitud_aplicacion_listado_tractores.idTractores,
						cross_solicitud_aplicacion_listado_tractores.idTelemetria,
						cross_solicitud_aplicacion_listado_cuarteles.idZona,
						cross_solicitud_aplicacion_listado.idSolicitud,
						telemetria_listado.cantSensores,
						telemetria_listado.Nombre AS Tractor
							
						FROM `cross_solicitud_aplicacion_listado_tractores`
						LEFT JOIN `cross_solicitud_aplicacion_listado_cuarteles`  ON cross_solicitud_aplicacion_listado_cuarteles.idCuarteles  = cross_solicitud_aplicacion_listado_tractores.idCuarteles
						LEFT JOIN `cross_solicitud_aplicacion_listado`            ON cross_solicitud_aplicacion_listado.idSolicitud            = cross_solicitud_aplicacion_listado_tractores.idSolicitud
						LEFT JOIN `telemetria_listado`                            ON telemetria_listado.idTelemetria                           = cross_solicitud_aplicacion_listado_tractores.idTelemetria
							
						WHERE cross_solicitud_aplicacion_listado_tractores.idCuarteles = ".$ID_cuartel[$j1]." 
						ORDER BY cross_solicitud_aplicacion_listado_tractores.idTractores";
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
						while ( $row = mysqli_fetch_assoc ($resultado)) {
						array_push( $arrTractores,$row );
						}
						/*******************************************************************/
						//variables
						$ndata_1      = 0;
						$ntractores   = 0;
						//se recorren los tractores
						foreach ($arrTractores as $trac) {
							$ndata_1 = db_select_nrows ('idTabla', 'telemetria_listado_tablarelacionada_'.$trac['idTelemetria'], '', "idZona = ".$trac['idZona']." AND idSolicitud=0 AND (FechaSistema BETWEEN '".$f_ejecucion."' AND '".$f_ejecucion_fin."')  AND Sensor_1!=0 AND Sensor_2!=0", $dbConn);
							//mientras sea distinto de 0
							if($ndata_1!=0) {
								$ntractores++;
							}
						}
						//generacion de errores
						if($ntractores==0) {$error1['ndata_1'.$j1] = 'error/Ninguno de los equipos ha realizado su recorrido en el cuartel '.$Nombre_cuartel[$j1];}
						/*******************************************************************/
						
					}
				}
			}		
						
			/*******************************************************************/
						
						
			if ( empty($error1) ) {
				//Variables
				$ntotal_err = 0;
				//Recorro los cuarteles
				for($j1 = 0; $j1 < $ndata_0; $j1++){
					//Para mostrar en la creacion
					
					/***********************************************************/
					//Si no fue ejecutado
					if(isset($idEjecucion[$j1])&&$idEjecucion[$j1]==1){
						
						/***************************************/
						//se cierra el cuartel
						$a  = "idEstado='2'" ;
						$a .= ",f_cierre='".$f_cierre[$j1]."'" ;
						$a .= ",idUsuario='".$idUsuario."'" ;
						$a .= ",idEjecucion='".$idEjecucion[$j1]."'" ;
								
						// inserto los datos de registro en la db
						$query  = "UPDATE `cross_solicitud_aplicacion_listado_cuarteles` SET ".$a." WHERE idCuarteles = '".$ID_cuartel[$j1]."'";
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
							
							
							
					//Si fue ejecutado	
					}elseif(isset($idEjecucion[$j1])&&$idEjecucion[$j1]==2){
						/***********************************************************/
						//Cuento si el cuartel tiene trabajos realizados
						//Se trae un listado con los tractores	
						$arrTractores = array();
						$query = "SELECT 
						cross_solicitud_aplicacion_listado_tractores.idTractores,
						cross_solicitud_aplicacion_listado_tractores.idTelemetria,
						cross_solicitud_aplicacion_listado_cuarteles.idZona,
						cross_solicitud_aplicacion_listado.idSolicitud,
						telemetria_listado.cantSensores,
						telemetria_listado.Nombre AS Tractor
							
						FROM `cross_solicitud_aplicacion_listado_tractores`
						LEFT JOIN `cross_solicitud_aplicacion_listado_cuarteles`  ON cross_solicitud_aplicacion_listado_cuarteles.idCuarteles  = cross_solicitud_aplicacion_listado_tractores.idCuarteles
						LEFT JOIN `cross_solicitud_aplicacion_listado`            ON cross_solicitud_aplicacion_listado.idSolicitud            = cross_solicitud_aplicacion_listado_tractores.idSolicitud
						LEFT JOIN `telemetria_listado`                            ON telemetria_listado.idTelemetria                           = cross_solicitud_aplicacion_listado_tractores.idTelemetria
							
						WHERE cross_solicitud_aplicacion_listado_tractores.idCuarteles = ".$ID_cuartel[$j1]." 
						ORDER BY cross_solicitud_aplicacion_listado_tractores.idTractores";
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
						while ( $row = mysqli_fetch_assoc ($resultado)) {
						array_push( $arrTractores,$row );
						}
							
						/*******************************************************************/
						//variables
						$ndata_1      = 0;
						$ntractores   = 0;
						//se recorren los tractores
						foreach ($arrTractores as $trac) {
							$ndata_1 = db_select_nrows ('idTabla', 'telemetria_listado_tablarelacionada_'.$trac['idTelemetria'], '', "idZona = ".$trac['idZona']." AND idSolicitud=0 AND (FechaSistema BETWEEN '".$f_ejecucion."' AND '".$f_ejecucion_fin."')  AND Sensor_1!=0 AND Sensor_2!=0", $dbConn);
							//mientras sea distinto de 0
							if($ndata_1!=0) {
								$ntractores++;
							}
						}
						//generacion de errores
						if($ntractores==0) {$error['ndata_1'.$j1] = 'error/Ninguno de los equipos ha realizado su recorrido en el cuartel '.$Nombre_cuartel[$j1];$ntotal_err++;}
						/*******************************************************************/
						
						if ( empty($error) ) {
							
							
							//se recorren los tractores
							foreach ($arrTractores as $trac) {
								/***************************************/
								$aa = '';
								//se recorre deacuerdo a la cantidad de sensores
								for ($i = 1; $i <= $trac['cantSensores']; $i++) { 
									$aa .= ',MIN(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_'.$i.'_Min';
									$aa .= ',MAX(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_'.$i.'_Max';
									$aa .= ',AVG(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_'.$i.'_Prom';
									$aa .= ',SUM(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_'.$i.'_Sum';
								}
								
								/****************************************************************/
								//Si esta dentro del cuartel
								//se consulta por los datos
								$query = "SELECT 
								MIN(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadMin,
								MAX(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadMax,
								AVG(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadProm,
								SUM(GeoMovimiento) AS GeoDistance
								".$aa."
								
								FROM `telemetria_listado_tablarelacionada_".$trac['idTelemetria']."`
								WHERE idZona = ".$trac['idZona']." AND idSolicitud=0 AND (FechaSistema BETWEEN '".$f_ejecucion."' AND '".$f_ejecucion_fin."') 
								AND Sensor_1!=0 AND Sensor_2!=0
								ORDER BY FechaSistema ASC, HoraSistema ASC ";
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
								$rowTablaRel = mysqli_fetch_assoc ($resultado);
								
								/****************************************************************/
								//Si esta fuera del cuartel
								//se consulta por los datos
								$query = "SELECT 
								MIN(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadMin,
								MAX(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadMax,
								AVG(NULLIF(IF(GeoVelocidad!=0,GeoVelocidad,0),0)) AS GeoVelocidadProm,
								SUM(GeoMovimiento) AS GeoDistance
								".$aa."
								
								FROM `telemetria_listado_tablarelacionada_".$trac['idTelemetria']."`
								WHERE idZona = 0 AND idSolicitud=0 AND (FechaSistema BETWEEN '".$f_ejecucion."' AND '".$f_ejecucion_fin."') 
								
								ORDER BY FechaSistema ASC, HoraSistema ASC ";
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
								$rowTablaRel_out = mysqli_fetch_assoc ($resultado);
								
								/***************************************/
								//se guardan los datos
								$a = "idTractores='".$trac['idTractores']."'" ;
								if(isset($rowTablaRel['GeoVelocidadMin']) && $rowTablaRel['GeoVelocidadMin'] != ''){             $a .= ",GeoVelocidadMin='".$rowTablaRel['GeoVelocidadMin']."'" ;}
								if(isset($rowTablaRel['GeoVelocidadMax']) && $rowTablaRel['GeoVelocidadMax'] != ''){             $a .= ",GeoVelocidadMax='".$rowTablaRel['GeoVelocidadMax']."'" ;}
								if(isset($rowTablaRel['GeoVelocidadProm']) && $rowTablaRel['GeoVelocidadProm'] != ''){           $a .= ",GeoVelocidadProm='".$rowTablaRel['GeoVelocidadProm']."'" ;}
								if(isset($rowTablaRel['GeoDistance']) && $rowTablaRel['GeoDistance'] != ''){                     $a .= ",GeoDistance='".$rowTablaRel['GeoDistance']."'" ;}
								if(isset($rowTablaRel_out['GeoVelocidadMin']) && $rowTablaRel_out['GeoVelocidadMin'] != ''){     $a .= ",GeoVelocidadMin_out='".$rowTablaRel_out['GeoVelocidadMin']."'" ;}
								if(isset($rowTablaRel_out['GeoVelocidadMax']) && $rowTablaRel_out['GeoVelocidadMax'] != ''){     $a .= ",GeoVelocidadMax_out='".$rowTablaRel_out['GeoVelocidadMax']."'" ;}
								if(isset($rowTablaRel_out['GeoVelocidadProm']) && $rowTablaRel_out['GeoVelocidadProm'] != ''){   $a .= ",GeoVelocidadProm_out='".$rowTablaRel_out['GeoVelocidadProm']."'" ;}
								if(isset($rowTablaRel_out['GeoDistance']) && $rowTablaRel_out['GeoDistance'] != ''){             $a .= ",GeoDistance_out='".$rowTablaRel_out['GeoDistance']."'" ;}
								//se recorre deacuerdo a la cantidad de sensores
								for ($i = 1; $i <= $trac['cantSensores']; $i++) { 
									if(isset($rowTablaRel['Sensor_'.$i.'_Prom']) && $rowTablaRel['Sensor_'.$i.'_Prom'] != ''){           $a .= ",Sensor_".$i."_Prom='".$rowTablaRel['Sensor_'.$i.'_Prom']."'" ;}
									if(isset($rowTablaRel['Sensor_'.$i.'_Min']) && $rowTablaRel['Sensor_'.$i.'_Min'] != ''){             $a .= ",Sensor_".$i."_Min='".$rowTablaRel['Sensor_'.$i.'_Min']."'" ;}
									if(isset($rowTablaRel['Sensor_'.$i.'_Max']) && $rowTablaRel['Sensor_'.$i.'_Max'] != ''){             $a .= ",Sensor_".$i."_Max='".$rowTablaRel['Sensor_'.$i.'_Max']."'" ;}
									if(isset($rowTablaRel['Sensor_'.$i.'_Sum']) && $rowTablaRel['Sensor_'.$i.'_Sum'] != ''){             $a .= ",Sensor_".$i."_Sum='".$rowTablaRel['Sensor_'.$i.'_Sum']."'" ;}
									if(isset($rowTablaRel_out['Sensor_'.$i.'_Prom']) && $rowTablaRel_out['Sensor_'.$i.'_Prom'] != ''){   $a .= ",Sensor_out_".$i."_Prom='".$rowTablaRel_out['Sensor_'.$i.'_Prom']."'" ;}
									if(isset($rowTablaRel_out['Sensor_'.$i.'_Min']) && $rowTablaRel_out['Sensor_'.$i.'_Min'] != ''){     $a .= ",Sensor_out_".$i."_Min='".$rowTablaRel_out['Sensor_'.$i.'_Min']."'" ;}
									if(isset($rowTablaRel_out['Sensor_'.$i.'_Max']) && $rowTablaRel_out['Sensor_'.$i.'_Max'] != ''){     $a .= ",Sensor_out_".$i."_Max='".$rowTablaRel_out['Sensor_'.$i.'_Max']."'" ;}
									if(isset($rowTablaRel_out['Sensor_'.$i.'_Sum']) && $rowTablaRel_out['Sensor_'.$i.'_Sum'] != ''){     $a .= ",Sensor_out_".$i."_Sum='".$rowTablaRel_out['Sensor_'.$i.'_Sum']."'" ;}
								}
								
								// inserto los datos de registro en la db
								$query  = "UPDATE `cross_solicitud_aplicacion_listado_tractores` SET ".$a." WHERE idTractores = '".$trac['idTractores']."'";
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
								
								/***************************************/
								//se actualiza la solicitud
								$a = "idSolicitud='".$trac['idSolicitud']."'" ;
									
								// inserto los datos de registro en la db
								$query  = "UPDATE `telemetria_listado_tablarelacionada_".$trac['idTelemetria']."` SET ".$a." WHERE idZona = ".$trac['idZona']." AND idSolicitud=0 AND (FechaSistema BETWEEN '".$f_ejecucion."' AND '".$f_ejecucion_fin."') AND Sensor_1!=0 AND Sensor_2!=0 ";
								//Consulta
								$resultado = mysqli_query ($dbConn, $query);
								// inserto los datos de registro en la db
								$query  = "UPDATE `telemetria_listado_tablarelacionada_".$trac['idTelemetria']."` SET ".$a." WHERE idZona = 0 AND idSolicitud=0 AND (FechaSistema BETWEEN '".$f_ejecucion."' AND '".$f_ejecucion_fin."') ";
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
							}
							
							/***************************************/
							//se cierra el cuartel
							$a  = "idEstado='2'" ;
							$a .= ",f_cierre='".$f_cierre[$j1]."'" ;
							$a .= ",idUsuario='".$idUsuario."'" ;
							$a .= ",idEjecucion='".$idEjecucion[$j1]."'" ;
								
							// inserto los datos de registro en la db
							$query  = "UPDATE `cross_solicitud_aplicacion_listado_cuarteles` SET ".$a." WHERE idCuarteles = '".$ID_cuartel[$j1]."'";
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
						}
					}
				}
				
				//Verifico que no existan errores
				if($ntotal_err==0){
					//redirijo una vez terminado
					header( 'Location: '.$location.'&not_closecuartel=true' );
					die;
				}
				
			}
			

		
		break;	
/*******************************************************************************************************************/		
		case 'updt_del_Cuartel':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todos los datos
			$query  = "DELETE FROM `cross_solicitud_aplicacion_listado_cuarteles` WHERE idCuarteles = ".$_GET['del_cuartel'];
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
					
			$query  = "DELETE FROM `cross_solicitud_aplicacion_listado_productos` WHERE idCuarteles = ".$_GET['del_cuartel'];
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
					
			$query  = "DELETE FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles = ".$_GET['del_cuartel'];
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
			
			header( 'Location: '.$location.'&not_delcuartel=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'updt_addtractor':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {

				/******************************************/
				//tractores
				if(isset($idSolicitud) && $idSolicitud != ''){    $a  = "'".$idSolicitud."'" ;   }else{$a  ="''";}
				if(isset($idCuarteles) && $idCuarteles != ''){    $a .= ",'".$idCuarteles."'" ;  }else{$a .=",''";}
				if(isset($idTelemetria) && $idTelemetria != ''){  $a .= ",'".$idTelemetria."'" ; }else{$a .=",''";}
				if(isset($idVehiculo) && $idVehiculo != ''){      $a .= ",'".$idVehiculo."'" ;   }else{$a .=",''";}
				if(isset($idTrabajador) && $idTrabajador != ''){  $a .= ",'".$idTrabajador."'" ; }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_solicitud_aplicacion_listado_tractores` (idSolicitud, idCuarteles,
				idTelemetria, idVehiculo, idTrabajador) 
				VALUES ({$a} )";
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
					//se redirije	
					header( 'Location: '.$location.'&not_addtractor=true' );
					die;
				}	
					
				
			}

		break;	
/*******************************************************************************************************************/		
		case 'updt_edittractor':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
				
				//Filtros
				$a = "idTractores='".$idTractores."'" ;
				if(isset($idSolicitud) && $idSolicitud != ''){     $a .= ",idSolicitud='".$idSolicitud."'" ;}
				if(isset($idCuarteles) && $idCuarteles != ''){     $a .= ",idCuarteles='".$idCuarteles."'" ;}
				if(isset($idTelemetria) && $idTelemetria != ''){   $a .= ",idTelemetria='".$idTelemetria."'" ;}
				if(isset($idVehiculo) && $idVehiculo != ''){       $a .= ",idVehiculo='".$idVehiculo."'" ;}
				if(isset($idTrabajador) && $idTrabajador != ''){   $a .= ",idTrabajador='".$idTrabajador."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `cross_solicitud_aplicacion_listado_tractores` SET ".$a." WHERE idTractores = '$idTractores'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&not_edittrac=true' );
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
		case 'updt_del_trac':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idTractores = ".$_GET['del_trac'];
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
				header( 'Location: '.$location.'&not_deltractor=true' );
				die;
			}
			

		break;		
/*******************************************************************************************************************/		
		case 'updt_addproducto':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
	
				/******************************************/
				//Producto
				if(isset($idSolicitud) && $idSolicitud != ''){           $a  = "'".$idSolicitud."'" ;       }else{$a  ="''";}
				if(isset($idCuarteles) && $idCuarteles != ''){           $a .= ",'".$idCuarteles."'" ;      }else{$a .=",''";}
				if(isset($idProducto) && $idProducto != ''){             $a .= ",'".$idProducto."'" ;       }else{$a .=",''";}
				if(isset($DosisRecomendada) && $DosisRecomendada != ''){ $a .= ",'".$DosisRecomendada."'" ; }else{$a .=",''";}
				if(isset($DosisAplicar) && $DosisAplicar != ''){         $a .= ",'".$DosisAplicar."'" ;     }else{$a .=",''";}
				if(isset($idUml) && $idUml != ''){                       $a .= ",'".$idUml."'" ;            }else{$a .=",''";}
				if(isset($Objetivo) && $Objetivo != ''){                 $a .= ",'".$Objetivo."'" ;         }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_solicitud_aplicacion_listado_productos` (idSolicitud, idCuarteles,
				idProducto, DosisRecomendada, DosisAplicar, idUml, Objetivo) 
				VALUES ({$a} )";
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
					//se redirije	
					header( 'Location: '.$location.'&not_addprod=true' );
					die;
				}
				
				
			}

		break;	
/*******************************************************************************************************************/		
		case 'updt_editproducto':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
				
				//Filtros
				$a = "idProdQuim='".$idProdQuim."'" ;
				if(isset($idSolicitud) && $idSolicitud != ''){            $a .= ",idSolicitud='".$idSolicitud."'" ;}
				if(isset($idCuarteles) && $idCuarteles != ''){            $a .= ",idCuarteles='".$idCuarteles."'" ;}
				if(isset($idProducto) && $idProducto != ''){              $a .= ",idProducto='".$idProducto."'" ;}
				if(isset($DosisRecomendada) && $DosisRecomendada != ''){  $a .= ",DosisRecomendada='".$DosisRecomendada."'" ;}
				if(isset($DosisAplicar) && $DosisAplicar != ''){          $a .= ",DosisAplicar='".$DosisAplicar."'" ;}
				if(isset($idUml) && $idUml != ''){                        $a .= ",idUml='".$idUml."'" ;}
				if(isset($Objetivo) && $Objetivo != ''){                  $a .= ",Objetivo='".$Objetivo."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `cross_solicitud_aplicacion_listado_productos` SET ".$a." WHERE idProdQuim = '$idProdQuim'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&not_editprod=true' );
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
		case 'updt_del_prod':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `cross_solicitud_aplicacion_listado_productos` WHERE idProdQuim = {$_GET['del_prod']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&not_delprod=true' );
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
		case 'updt_adddetalle':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
	
				/******************************************/
				//Producto
				if(isset($idSolicitud) && $idSolicitud != ''){       $a  = "'".$idSolicitud."'" ;       }else{$a  ="''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){ $a .= ",'".$Creacion_fecha."'" ;   }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){           $a .= ",'".$idUsuario."'" ;        }else{$a .=",''";}
				if(isset($Observacion) && $Observacion != ''){       $a .= ",'".$Observacion."'" ;      }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){             $a .= ",'".$idEstado."'" ;         }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_solicitud_aplicacion_listado_historial` (idSolicitud, 
				Creacion_fecha, idUsuario, Observacion, idEstado) 
				VALUES ({$a} )";
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
					//se redirije	
					header( 'Location: '.$location.'&not_adddetalle=true' );
					die;
				}
				
				
			}
			
		break;		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
		
						
/*******************************************************************************************************************/
	}
?>
