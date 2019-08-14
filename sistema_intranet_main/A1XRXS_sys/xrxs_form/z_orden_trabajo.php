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
	if ( !empty($_POST['idOT']) )                 $idOT                    = $_POST['idOT'];
	if ( !empty($_POST['idSistema']) )            $idSistema               = $_POST['idSistema'];
	if ( !empty($_POST['idCliente']) )            $idCliente               = $_POST['idCliente'];
	if ( !empty($_POST['idMaquina']) )            $idMaquina               = $_POST['idMaquina'];
	if ( !empty($_POST['idUsuario']) )            $idUsuario               = $_POST['idUsuario'];
	if ( !empty($_POST['idEstado']) )             $idEstado                = $_POST['idEstado'];
	if ( !empty($_POST['idPrioridad']) )          $idPrioridad             = $_POST['idPrioridad'];
	if ( !empty($_POST['idTipo']) )               $idTipo                  = $_POST['idTipo'];
	if ( !empty($_POST['f_creacion']) )           $f_creacion 	           = $_POST['f_creacion'];
	if ( !empty($_POST['f_programacion']) )       $f_programacion          = $_POST['f_programacion'];
	if ( !empty($_POST['f_ejecucion']) )          $f_ejecucion             = $_POST['f_ejecucion'];
	if ( !empty($_POST['f_termino']) )            $f_termino 	           = $_POST['f_termino'];
	if ( !empty($_POST['Observaciones']) )        $Observaciones           = $_POST['Observaciones'];
	if ( !empty($_POST['progDia']) )              $progDia                 = $_POST['progDia'];
	if ( !empty($_POST['progMes']) )              $progMes                 = $_POST['progMes'];
	if ( !empty($_POST['progAno']) )              $progAno                 = $_POST['progAno'];
	if ( !empty($_POST['terDia']) )               $terDia                  = $_POST['terDia'];
	if ( !empty($_POST['terMes']) )               $terMes                  = $_POST['terMes'];
	if ( !empty($_POST['terAno']) )               $terAno                  = $_POST['terAno'];
	if ( !empty($_POST['idSupervisor']) )         $idSupervisor            = $_POST['idSupervisor'];
	if ( !empty($_POST['horaProg']) )             $horaProg                = $_POST['horaProg'];
	if ( !empty($_POST['horaInicio']) )           $horaInicio              = $_POST['horaInicio'];
	if ( !empty($_POST['horaTermino']) )          $horaTermino             = $_POST['horaTermino'];
	
	//Traspaso de valores input a variables
	$idLevel = array();
	if ( !empty($_POST['idLevel_1']) )            $idLevel[1]              = $_POST['idLevel_1'];
	if ( !empty($_POST['idLevel_2']) )            $idLevel[2]              = $_POST['idLevel_2'];
	if ( !empty($_POST['idLevel_3']) )            $idLevel[3]              = $_POST['idLevel_3'];
	if ( !empty($_POST['idLevel_4']) )            $idLevel[4]              = $_POST['idLevel_4'];
	if ( !empty($_POST['idLevel_5']) )            $idLevel[5]              = $_POST['idLevel_5'];
	if ( !empty($_POST['idLevel_6']) )            $idLevel[6]              = $_POST['idLevel_6'];
	if ( !empty($_POST['idLevel_7']) )            $idLevel[7]              = $_POST['idLevel_7'];
	if ( !empty($_POST['idLevel_8']) )            $idLevel[8]              = $_POST['idLevel_8'];
	if ( !empty($_POST['idLevel_9']) )            $idLevel[9]              = $_POST['idLevel_9'];
	if ( !empty($_POST['idLevel_10']) )           $idLevel[10]             = $_POST['idLevel_10'];
	if ( !empty($_POST['idLevel_11']) )           $idLevel[11]             = $_POST['idLevel_11'];
	if ( !empty($_POST['idLevel_12']) )           $idLevel[12]             = $_POST['idLevel_12'];
	if ( !empty($_POST['idLevel_13']) )           $idLevel[13]             = $_POST['idLevel_13'];
	if ( !empty($_POST['idLevel_14']) )           $idLevel[14]             = $_POST['idLevel_14'];
	if ( !empty($_POST['idLevel_15']) )           $idLevel[15]             = $_POST['idLevel_15'];
	if ( !empty($_POST['idLevel_16']) )           $idLevel[16]             = $_POST['idLevel_16'];
	if ( !empty($_POST['idLevel_17']) )           $idLevel[17]             = $_POST['idLevel_17'];
	if ( !empty($_POST['idLevel_18']) )           $idLevel[18]             = $_POST['idLevel_18'];
	if ( !empty($_POST['idLevel_19']) )           $idLevel[19]             = $_POST['idLevel_19'];
	if ( !empty($_POST['idLevel_20']) )           $idLevel[20]             = $_POST['idLevel_20'];
	if ( !empty($_POST['idLevel_21']) )           $idLevel[21]             = $_POST['idLevel_21'];
	if ( !empty($_POST['idLevel_22']) )           $idLevel[22]             = $_POST['idLevel_22'];
	if ( !empty($_POST['idLevel_23']) )           $idLevel[23]             = $_POST['idLevel_23'];
	if ( !empty($_POST['idLevel_24']) )           $idLevel[24]             = $_POST['idLevel_24'];
	if ( !empty($_POST['idLevel_25']) )           $idLevel[25]             = $_POST['idLevel_25'];
	
	//otros datos
	if ( !empty($_POST['idTrabajador']) )         $idTrabajador            = $_POST['idTrabajador'];
	if ( !empty($_POST['idProducto']) )           $idProducto              = $_POST['idProducto'];
	if ( !empty($_POST['Cantidad']) )             $Cantidad                = $_POST['Cantidad'];
	if ( !empty($_POST['idItemizado']) )          $idItemizado             = $_POST['idItemizado'];
	if ( !empty($_POST['tabla']) )                $tabla                   = $_POST['tabla'];
	if ( !empty($_POST['id_tabla']) )             $id_tabla                = $_POST['id_tabla'];
	if ( !empty($_POST['idInterno']) )            $idInterno               = $_POST['idInterno'];
	if ( !empty($_POST['tablaitem']) )            $tablaitem               = $_POST['tablaitem'];
	if ( !empty($_POST['idUml']) )                $idUml                   = $_POST['idUml'];
	if ( isset($_POST['Grasa_inicial']) )         $Grasa_inicial           = $_POST['Grasa_inicial'];
	if ( isset($_POST['Grasa_relubricacion']) )   $Grasa_relubricacion     = $_POST['Grasa_relubricacion'];
	if ( isset($_POST['Aceite']) )                $Aceite                  = $_POST['Aceite'];
	if ( isset($_POST['idSubTipo']) )             $idSubTipo               = $_POST['idSubTipo'];
	if ( !empty($_POST['idResponsable']) )        $idResponsable           = $_POST['idResponsable'];
	if ( !empty($_POST['idInsumos']) )            $idInsumos               = $_POST['idInsumos'];
	if ( !empty($_POST['idProductos']) )          $idProductos             = $_POST['idProductos'];
	if ( !empty($_POST['idAnalisis']) )           $idAnalisis              = $_POST['idAnalisis'];
	if ( !empty($_POST['Observacion']) )          $Observacion             = $_POST['Observacion'];
			
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
			case 'idOT':                  if(empty($idOT)){                   $error['idOT']                    = 'error/No ha ingresado el id del sistema';}break;
			case 'idSistema':             if(empty($idSistema)){              $error['idSistema']               = 'error/No ha ingresado el idSistema del sistema';}break;
			case 'idCliente':             if(empty($idCliente)){              $error['idCliente']               = 'error/No ha seleccionado un cliente';}break;
			case 'idMaquina':             if(empty($idMaquina)){              $error['idMaquina']               = 'error/No ha ingresado la maquina';}break;
			case 'idUsuario':             if(empty($idUsuario)){              $error['idUsuario']               = 'error/No ha ingresado el usuario';}break;
			case 'idEstado':              if(empty($idEstado)){               $error['idEstado']                = 'error/No ha ingresado el estado';}break;
			case 'idPrioridad':           if(empty($idPrioridad)){            $error['idPrioridad']             = 'error/No ha ingresado la prioridad';}break;
			case 'idTipo':                if(empty($idTipo)){                 $error['idTipo']                  = 'error/No ha ingresado el tipo';}break;
			case 'f_creacion':            if(empty($f_creacion)){             $error['f_creacion']              = 'error/No ha ingresado la fecha de creacion';}break;
			case 'f_programacion':        if(empty($f_programacion)){         $error['f_programacion']          = 'error/No ha ingresado la fecha de programacion';}break;
			case 'f_ejecucion':           if(empty($f_ejecucion)){            $error['f_ejecucion']             = 'error/No ha ingresado la fecha de ejecucion';}break;
			case 'f_termino':             if(empty($f_termino)){              $error['f_termino']               = 'error/No ha ingresado la fecha de termino';}break;
			case 'Observaciones':         if(empty($Observaciones)){          $error['Observaciones']           = 'error/No ha ingresado la observacion';}break;
			case 'progDia':               if(empty($progDia)){                $error['progDia']                 = 'error/No ha ingresado el dia de programacion';}break;
			case 'progMes':               if(empty($progMes)){                $error['progMes']                 = 'error/No ha ingresado el mes de programacion';}break;
			case 'progAno':               if(empty($progAno)){                $error['progAno']                 = 'error/No ha ingresado el año de programacion';}break;
			case 'terDia':                if(empty($terDia)){                 $error['terDia']                  = 'error/No ha ingresado el dia de termino';}break;
			case 'terMes':                if(empty($terMes)){                 $error['terMes']                  = 'error/No ha ingresado el mes de termino';}break;
			case 'terAno':                if(empty($terAno)){                 $error['terAno']                  = 'error/No ha ingresado el año de termino';}break;
			case 'idSupervisor':          if(empty($idSupervisor)){           $error['idSupervisor']            = 'error/No ha seleccionado el supervisor';}break;
			case 'horaProg':              if(empty($horaProg)){               $error['horaProg']                = 'error/No ha ingresado la hora programada';}break;
			case 'horaInicio':            if(empty($horaInicio)){             $error['horaInicio']              = 'error/No ha ingresado la hora de inicio';}break;
			case 'horaTermino':           if(empty($horaTermino)){            $error['horaTermino']             = 'error/No ha ingresado la hora de termino';}break;
			 
			case 'idLevel_1':             if(empty($idLevel[1])){             $error['idLevel_1']               = 'error/No ha ingresado el idLevel_1';}break;
			case 'idLevel_2':             if(empty($idLevel[2])){             $error['idLevel_2']               = 'error/No ha ingresado el idLevel_2';}break;
			case 'idLevel_3':             if(empty($idLevel[3])){             $error['idLevel_3']               = 'error/No ha ingresado el idLevel_3';}break;
			case 'idLevel_4':             if(empty($idLevel[4])){             $error['idLevel_4']               = 'error/No ha ingresado el idLevel_4';}break;
			case 'idLevel_5':             if(empty($idLevel[5])){             $error['idLevel_5']               = 'error/No ha ingresado el idLevel_5';}break;
			case 'idLevel_6':             if(empty($idLevel[6])){             $error['idLevel_6']               = 'error/No ha ingresado el idLevel_6';}break;
			case 'idLevel_7':             if(empty($idLevel[7])){             $error['idLevel_7']               = 'error/No ha ingresado el idLevel_7';}break;
			case 'idLevel_8':             if(empty($idLevel[8])){             $error['idLevel_8']               = 'error/No ha ingresado el idLevel_8';}break;
			case 'idLevel_9':             if(empty($idLevel[9])){             $error['idLevel_9']               = 'error/No ha ingresado el idLevel_9';}break;
			case 'idLevel_10':            if(empty($idLevel[10])){            $error['idLevel_10']              = 'error/No ha ingresado el idLevel_10';}break;
			case 'idLevel_11':            if(empty($idLevel[11])){            $error['idLevel_11']              = 'error/No ha ingresado el idLevel_11';}break;
			case 'idLevel_12':            if(empty($idLevel[12])){            $error['idLevel_12']              = 'error/No ha ingresado el idLevel_12';}break;
			case 'idLevel_13':            if(empty($idLevel[13])){            $error['idLevel_13']              = 'error/No ha ingresado el idLevel_13';}break;
			case 'idLevel_14':            if(empty($idLevel[14])){            $error['idLevel_14']              = 'error/No ha ingresado el idLevel_14';}break;
			case 'idLevel_15':            if(empty($idLevel[15])){            $error['idLevel_15']              = 'error/No ha ingresado el idLevel_15';}break;
			case 'idLevel_16':            if(empty($idLevel[16])){            $error['idLevel_16']              = 'error/No ha ingresado el idLevel_16';}break;
			case 'idLevel_17':            if(empty($idLevel[17])){            $error['idLevel_17']              = 'error/No ha ingresado el idLevel_17';}break;
			case 'idLevel_18':            if(empty($idLevel[18])){            $error['idLevel_18']              = 'error/No ha ingresado el idLevel_18';}break;
			case 'idLevel_19':            if(empty($idLevel[19])){            $error['idLevel_19']              = 'error/No ha ingresado el idLevel_19';}break;
			case 'idLevel_20':            if(empty($idLevel[20])){            $error['idLevel_20']              = 'error/No ha ingresado el idLevel_20';}break;
			case 'idLevel_21':            if(empty($idLevel[21])){            $error['idLevel_21']              = 'error/No ha ingresado el idLevel_21';}break;
			case 'idLevel_22':            if(empty($idLevel[22])){            $error['idLevel_22']              = 'error/No ha ingresado el idLevel_22';}break;
			case 'idLevel_23':            if(empty($idLevel[23])){            $error['idLevel_23']              = 'error/No ha ingresado el idLevel_23';}break;
			case 'idLevel_24':            if(empty($idLevel[24])){            $error['idLevel_24']              = 'error/No ha ingresado el idLevel_24';}break;
			case 'idLevel_25':            if(empty($idLevel[25])){            $error['idLevel_25']              = 'error/No ha ingresado el idLevel_25';}break;

			case 'idTrabajador':          if(empty($idTrabajador)){           $error['idTrabajador']            = 'error/No ha ingresado el trabajador';}break;
			case 'idProducto':            if(empty($idProducto)){             $error['idProducto']              = 'error/No ha ingresado el componente';}break;
			case 'idItemizado':           if(empty($idItemizado)){            $error['idItemizado']             = 'error/No ha ingresado la observacion';}break;
			case 'tabla':                 if(empty($tabla)){                  $error['tabla']                   = 'error/No ha ingresado el trabajo';}break;
			case 'id_tabla':              if(empty($id_tabla)){               $error['id_tabla']                = 'error/No ha ingresado la tabla';}break;
			case 'idInterno':             if(empty($idInterno)){              $error['idInterno']               = 'error/No ha ingresado el id de tabla';}break;
			case 'tablaitem':             if(empty($tablaitem)){              $error['tablaitem']               = 'error/No ha ingresado la tabla itemizado';}break;
			case 'idUml':                 if(empty($idUml)){                  $error['idUml']                   = 'error/No ha ingresado el id unidad medida';}break;
			case 'Grasa_inicial':         if(empty($Grasa_inicial)){          $error['Grasa_inicial']           = 'error/No ha ingresado la cantidad de grasa inicial';}break;
			case 'Grasa_relubricacion':   if(empty($Grasa_relubricacion)){    $error['Grasa_relubricacion']     = 'error/No ha ingresado la cantidad de grasa de relubricacion';}break;
			case 'Aceite':                if(empty($Aceite)){                 $error['Aceite']                  = 'error/No ha ingresado la cantidad de aceite';}break;
			case 'Cantidad':              if(empty($Cantidad)){               $error['Cantidad']                = 'error/No ha ingresado la cantidad';}break;
			case 'idSubTipo':             if(empty($idSubTipo)){              $error['idSubTipo']               = 'error/No ha seleccionado el tipo de trabajo';}break;
			case 'idResponsable':         if(empty($idResponsable)){          $error['idResponsable']           = 'error/No ha seleccionado el responsable';}break;
			case 'idInsumos':             if(empty($idInsumos)){              $error['idInsumos']               = 'error/No ha seleccionado el insumo';}break;
			case 'idProductos':           if(empty($idProductos)){            $error['idProductos']             = 'error/No ha seleccionado el producto';}break;
			case 'idAnalisis':            if(empty($idAnalisis)){             $error['idAnalisis']              = 'error/No ha seleccionado el analisis';}break;
			case 'Observacion':           if(empty($Observacion)){            $error['Observacion']             = 'error/No ha ingresado la observacion';}break;
			
	
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
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones="Sin observaciones";}
					
				//Borro todas las sesiones
				unset($_SESSION['ot_basicos']);
				unset($_SESSION['ot_trabajador']);
				unset($_SESSION['ot_trabajos']);
				unset($_SESSION['ot_temporal']);
				unset($_SESSION['ot_insumos']);
				unset($_SESSION['ot_productos']);
				
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['ot_basicos']['idMaquina']       = $idMaquina;
				$_SESSION['ot_basicos']['idPrioridad']     = $idPrioridad;
				$_SESSION['ot_basicos']['idTipo']          = $idTipo;
				$_SESSION['ot_basicos']['f_programacion']  = $f_programacion;
				$_SESSION['ot_basicos']['idSistema']       = $idSistema;
				$_SESSION['ot_basicos']['idUsuario']       = $idUsuario;
				$_SESSION['ot_basicos']['idEstado']        = $idEstado;
				$_SESSION['ot_basicos']['f_creacion']      = $f_creacion;
				$_SESSION['ot_basicos']['Observaciones']   = $Observaciones;
				
				//Se guarda el trabajador asignado
				$_SESSION['ot_trabajador'][$idTrabajador]['idTrabajador'] = $idTrabajador;

				//Si se ha seleccionado un cliente
				if(isset($idCliente)&&$idCliente!=''){
					$_SESSION['ot_basicos']['idCliente']       = $idCliente;
				}else{
					$_SESSION['ot_basicos']['idCliente']       = '';
				}
			
				/********************************************************************************/
				if(isset($idMaquina) && $idMaquina != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT 
					maquinas_listado.Nombre AS NombreMaquina,
					clientes_listado.Nombre AS NombreCliente
					FROM `maquinas_listado`
					LEFT JOIN `clientes_listado`     ON clientes_listado.idCliente      = maquinas_listado.idCliente
					WHERE maquinas_listado.idMaquina = ".$idMaquina;
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
					$rowMaquina = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['ot_basicos']['NombreMaquina'] = $rowMaquina['NombreMaquina'];
					$_SESSION['ot_basicos']['NombreCliente'] = $rowMaquina['NombreCliente'];
				}else{
					$_SESSION['ot_basicos']['NombreMaquina'] = '';
					$_SESSION['ot_basicos']['NombreCliente'] = '';
				}
				/****************************************************/
				if(isset($idPrioridad) && $idPrioridad != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_ot_prioridad`
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
					//se guarda dato
					$_SESSION['ot_basicos']['Prioridad'] = $rowPrioridad['Nombre'];
				}else{
					$_SESSION['ot_basicos']['Prioridad'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_ot_tipos`
					WHERE idTipo = ".$idTipo;
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
					$rowTipo = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['ot_basicos']['Tipo'] = $rowTipo['Nombre'];
				}else{
					$_SESSION['ot_basicos']['Tipo'] = '';
				}
				/****************************************************/
				if(isset($idTrabajador) && $idTrabajador != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre, ApellidoPat, ApellidoMat, Cargo, Rut
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
					$rowTrabajador = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['ot_trabajador'][$idTrabajador]['Trabajador']   = $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'].' '.$rowTrabajador['ApellidoMat'];
					$_SESSION['ot_trabajador'][$idTrabajador]['Cargo']        = $rowTrabajador['Cargo'];
					$_SESSION['ot_trabajador'][$idTrabajador]['Rut']          = $rowTrabajador['Rut'];
				}else{
					$_SESSION['ot_trabajador'][$idTrabajador]['Trabajador']   = '';
					$_SESSION['ot_trabajador'][$idTrabajador]['Cargo']        = '';
					$_SESSION['ot_trabajador'][$idTrabajador]['Rut']          = '';
				}
			

				header( 'Location: '.$location.'&view=true' );
				die;
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ot_basicos']);
			unset($_SESSION['ot_trabajador']);
			unset($_SESSION['ot_trabajos']);
			unset($_SESSION['ot_temporal']);
			unset($_SESSION['ot_insumos']);
			unset($_SESSION['ot_productos']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'mod_base':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				unset($_SESSION['ot_trabajos']);
				unset($_SESSION['ot_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['ot_basicos']['idMaquina']       = $idMaquina;
				$_SESSION['ot_basicos']['idPrioridad']     = $idPrioridad;
				$_SESSION['ot_basicos']['idTipo']          = $idTipo;
				$_SESSION['ot_basicos']['f_programacion']  = $f_programacion;
				$_SESSION['ot_basicos']['idSistema']       = $idSistema;
				$_SESSION['ot_basicos']['idUsuario']       = $idUsuario;
				$_SESSION['ot_basicos']['idEstado']        = $idEstado;
				$_SESSION['ot_basicos']['f_creacion']      = $f_creacion;
			
				
				//Si se ha seleccionado un cliente
				if(isset($idCliente)&&$idCliente!=''){
					$_SESSION['ot_basicos']['idCliente']       = $idCliente;
				}else{
					$_SESSION['ot_basicos']['idCliente']       = '';
				}
				/********************************************************************************/
				if(isset($idMaquina) && $idMaquina != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT 
					maquinas_listado.Nombre AS NombreMaquina,
					clientes_listado.Nombre AS NombreCliente
					FROM `maquinas_listado`
					LEFT JOIN `clientes_listado`     ON clientes_listado.idCliente      = maquinas_listado.idCliente
					WHERE maquinas_listado.idMaquina = ".$idMaquina;
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
					$rowMaquina = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['ot_basicos']['NombreMaquina'] = $rowMaquina['NombreMaquina'];
					$_SESSION['ot_basicos']['NombreCliente'] = $rowMaquina['NombreCliente'];
				}else{
					$_SESSION['ot_basicos']['NombreMaquina'] = '';
					$_SESSION['ot_basicos']['NombreCliente'] = '';
				}
				/****************************************************/
				if(isset($idPrioridad) && $idPrioridad != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_ot_prioridad`
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
					//se guarda dato
					$_SESSION['ot_basicos']['Prioridad'] = $rowPrioridad['Nombre'];
				}else{
					$_SESSION['ot_basicos']['Prioridad'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_ot_tipos`
					WHERE idTipo = ".$idTipo;
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
					$rowTipo = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['ot_basicos']['Tipo'] = $rowTipo['Nombre'];
				}else{
					$_SESSION['ot_basicos']['Tipo'] = '';
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}

				
		break;
/*******************************************************************************************************************/		
		case 'addTrab':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, ApellidoPat, ApellidoMat, Cargo, Rut
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
				$rowTrabajador = mysqli_fetch_assoc ($resultado);
				
				//Se guarda el trabajador asignado
				$_SESSION['ot_trabajador'][$idTrabajador]['idTrabajador'] = $idTrabajador;
				$_SESSION['ot_trabajador'][$idTrabajador]['Trabajador']   = $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'].' '.$rowTrabajador['ApellidoMat'];
				$_SESSION['ot_trabajador'][$idTrabajador]['Cargo']        = $rowTrabajador['Cargo'];
				$_SESSION['ot_trabajador'][$idTrabajador]['Rut']          = $rowTrabajador['Rut'];
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;	
/*******************************************************************************************************************/		
		case 'del_trab':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ot_trabajador'][$_GET['del_trab']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'add_ins':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen todos los datos de mi usuario
				$query = "SELECT 
				insumos_listado.Nombre AS NombreProducto,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado`
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE insumos_listado.idProducto = ".$idProducto;
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
				$rowProducto = mysqli_fetch_assoc ($resultado);
				
				//Se guarda el insumos asignado
				$_SESSION['ot_insumos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['ot_insumos'][$idProducto]['Cantidad']   = $Cantidad;
				$_SESSION['ot_insumos'][$idProducto]['Nombre']     = $rowProducto['NombreProducto'];
				$_SESSION['ot_insumos'][$idProducto]['Unimed']     = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;
/*******************************************************************************************************************/		
		case 'del_ins':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ot_insumos'][$_GET['del_ins']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'add_prod':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen todos los datos de mi usuario
				$query = "SELECT 
				productos_listado.Nombre AS NombreProducto,
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
				$rowProducto = mysqli_fetch_assoc ($resultado);
				
				//Se guarda el productos asignado
				$_SESSION['ot_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['ot_productos'][$idProducto]['Cantidad']   = $Cantidad;
				$_SESSION['ot_productos'][$idProducto]['Nombre']     = $rowProducto['NombreProducto'];
				$_SESSION['ot_productos'][$idProducto]['Unimed']     = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;	
/*******************************************************************************************************************/		
		case 'del_prod':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ot_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'submit_tarea':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if(isset($idLevel[1])&&$idLevel[1]!=''){   $id_tabla = $idLevel[1];  $tabla=1;  $id_tabla_madre = 0;            $tabla_madre=0; }
			if(isset($idLevel[2])&&$idLevel[2]!=''){   $id_tabla = $idLevel[2];  $tabla=2;  $id_tabla_madre = $idLevel[1];  $tabla_madre=1; }
			if(isset($idLevel[3])&&$idLevel[3]!=''){   $id_tabla = $idLevel[3];  $tabla=3;  $id_tabla_madre = $idLevel[2];  $tabla_madre=2; }
			if(isset($idLevel[4])&&$idLevel[4]!=''){   $id_tabla = $idLevel[4];  $tabla=4;  $id_tabla_madre = $idLevel[3];  $tabla_madre=3; }
			if(isset($idLevel[5])&&$idLevel[5]!=''){   $id_tabla = $idLevel[5];  $tabla=5;  $id_tabla_madre = $idLevel[4];  $tabla_madre=4; }
			if(isset($idLevel[6])&&$idLevel[6]!=''){   $id_tabla = $idLevel[6];  $tabla=6;  $id_tabla_madre = $idLevel[5];  $tabla_madre=5; }
			if(isset($idLevel[7])&&$idLevel[7]!=''){   $id_tabla = $idLevel[7];  $tabla=7;  $id_tabla_madre = $idLevel[6];  $tabla_madre=6; }
			if(isset($idLevel[8])&&$idLevel[8]!=''){   $id_tabla = $idLevel[8];  $tabla=8;  $id_tabla_madre = $idLevel[7];  $tabla_madre=7; }
			if(isset($idLevel[9])&&$idLevel[9]!=''){   $id_tabla = $idLevel[9];  $tabla=9;  $id_tabla_madre = $idLevel[8];  $tabla_madre=8; }
			if(isset($idLevel[10])&&$idLevel[10]!=''){ $id_tabla = $idLevel[10]; $tabla=10; $id_tabla_madre = $idLevel[9];  $tabla_madre=9; }
			if(isset($idLevel[11])&&$idLevel[11]!=''){ $id_tabla = $idLevel[11]; $tabla=11; $id_tabla_madre = $idLevel[10]; $tabla_madre=10; }
			if(isset($idLevel[12])&&$idLevel[12]!=''){ $id_tabla = $idLevel[12]; $tabla=12; $id_tabla_madre = $idLevel[11]; $tabla_madre=11; }
			if(isset($idLevel[13])&&$idLevel[13]!=''){ $id_tabla = $idLevel[13]; $tabla=13; $id_tabla_madre = $idLevel[12]; $tabla_madre=12; }
			if(isset($idLevel[14])&&$idLevel[14]!=''){ $id_tabla = $idLevel[14]; $tabla=14; $id_tabla_madre = $idLevel[13]; $tabla_madre=13; }
			if(isset($idLevel[15])&&$idLevel[15]!=''){ $id_tabla = $idLevel[15]; $tabla=15; $id_tabla_madre = $idLevel[14]; $tabla_madre=14; }
			if(isset($idLevel[16])&&$idLevel[16]!=''){ $id_tabla = $idLevel[16]; $tabla=16; $id_tabla_madre = $idLevel[15]; $tabla_madre=15; }
			if(isset($idLevel[17])&&$idLevel[17]!=''){ $id_tabla = $idLevel[17]; $tabla=17; $id_tabla_madre = $idLevel[16]; $tabla_madre=16; }
			if(isset($idLevel[18])&&$idLevel[18]!=''){ $id_tabla = $idLevel[18]; $tabla=18; $id_tabla_madre = $idLevel[17]; $tabla_madre=17; }
			if(isset($idLevel[19])&&$idLevel[19]!=''){ $id_tabla = $idLevel[19]; $tabla=19; $id_tabla_madre = $idLevel[18]; $tabla_madre=18; }
			if(isset($idLevel[20])&&$idLevel[20]!=''){ $id_tabla = $idLevel[20]; $tabla=20; $id_tabla_madre = $idLevel[19]; $tabla_madre=19; }
			if(isset($idLevel[21])&&$idLevel[21]!=''){ $id_tabla = $idLevel[21]; $tabla=21; $id_tabla_madre = $idLevel[20]; $tabla_madre=20; }
			if(isset($idLevel[22])&&$idLevel[22]!=''){ $id_tabla = $idLevel[22]; $tabla=22; $id_tabla_madre = $idLevel[21]; $tabla_madre=21; }
			if(isset($idLevel[23])&&$idLevel[23]!=''){ $id_tabla = $idLevel[23]; $tabla=23; $id_tabla_madre = $idLevel[22]; $tabla_madre=22; }
			if(isset($idLevel[24])&&$idLevel[24]!=''){ $id_tabla = $idLevel[24]; $tabla=24; $id_tabla_madre = $idLevel[23]; $tabla_madre=23; }
			if(isset($idLevel[25])&&$idLevel[25]!=''){ $id_tabla = $idLevel[25]; $tabla=25; $id_tabla_madre = $idLevel[24]; $tabla_madre=24; }
			
			// Se traen los datos de la tabla madre
			if(isset($id_tabla_madre)&&$id_tabla_madre!=0){
				$query = "SELECT idUtilizable,tabla, table_value, idLicitacion
				FROM `maquinas_listado_level_".$tabla_madre."`
				WHERE idLevel_".$tabla_madre." = {$id_tabla_madre}";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_m = mysqli_fetch_assoc ($resultado);
				//se verifica que sea un componente
				if(isset($rowdata_m['idUtilizable'])&&$rowdata_m['idUtilizable']!=3&&$rowdata_m['tabla']==0){
					$error['tabla'] = 'error/El dato seleccionado no posee tareas asignadas';
				}
				
			}
			
			// Se traen todos los datos de la maquina
			$query = "SELECT 
			maquinas_listado_level_".$tabla.".Nombre,
			maquinas_listado_level_".$tabla.".Codigo,
			maquinas_listado_level_".$tabla.".idUtilizable,
			maquinas_listado_level_".$tabla.".idSubTipo,
			maquinas_listado_level_".$tabla.".idProducto,
			maquinas_listado_level_".$tabla.".Grasa_inicial,
			maquinas_listado_level_".$tabla.".Grasa_relubricacion,
			maquinas_listado_level_".$tabla.".Aceite,
			maquinas_listado_level_".$tabla.".Cantidad,
			maquinas_listado_level_".$tabla.".idUml,
			productos_listado.Nombre AS Producto,
			sistema_productos_uml.Nombre AS Unimed
			
			FROM `maquinas_listado_level_".$tabla."`
			LEFT JOIN `productos_listado`       ON productos_listado.idProducto  = maquinas_listado_level_".$tabla.".idProducto
			LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml   = maquinas_listado_level_".$tabla.".idUml
			WHERE idLevel_".$tabla." = {$id_tabla}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			//se verifica que sea un subcomponente
			if(isset($rowdata['idUtilizable'])&&$rowdata['idUtilizable']!=''&&$rowdata['idUtilizable']!=3){
				$error['subcomponente'] = 'error/El dato seleccionado no es un subcomponente';
			}	
	
			
			//se establece variable inicial		
			$idInterno = 0;
				
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['ot_trabajos'][$tabla][$id_tabla])){
				foreach ($_SESSION['ot_trabajos'][$tabla][$id_tabla] as $key => $trabajos){
					if(isset($trabajos['valor_id'])&&$trabajos['valor_id']!=''){
						$idInterno = $trabajos['valor_id'];
					}
				}
			}
			
			if ( empty($error) ) {

					$idInterno = $idInterno+1;
					//Para mostrar en la creacion
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Nombre']      = $rowdata['Nombre'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Codigo']      = $rowdata['Codigo'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Producto']    = $rowdata['Producto'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Unimed']      = $rowdata['Unimed'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['valor_id']    = $idInterno;
					
					//variables vacias
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_1']       = '';
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_2']       = '';
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_t']       = '';
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Item_Codigo']  = '';
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Item_Nombre']  = '';
					
					//Datos para guardar en la base de datos
					//subcomponente seleccionado
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['id_tabla']       = $id_tabla;
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['tabla']          = $tabla;
					//tabla madre del itemizado
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['tabla_m']        = $rowdata_m['tabla'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['tabla_m_value']  = $rowdata_m['table_value'];
					//productos a utilizar
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['idProducto']  = $rowdata['idProducto'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['idUml']       = $rowdata['idUml'];
					//medidas
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Grasa_inicial']        = $rowdata['Grasa_inicial'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Grasa_relubricacion']  = $rowdata['Grasa_relubricacion'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Aceite']               = $rowdata['Aceite'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Cantidad']             = $rowdata['Cantidad'];
					//idSubTipo
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['idSubTipo']   = $rowdata['idSubTipo'];
					//Licitacion relacionada
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['idLicitacion']   = $rowdata_m['idLicitacion'];
					
					switch ($rowdata['idSubTipo']) {
						case 1://Grasa
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_1'] = $rowdata['Grasa_inicial'];
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_2'] = $rowdata['Grasa_relubricacion'];
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_t'] = 'Grasa Lub/Relub';
							break;
						case 2://Aceite
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_1'] = $rowdata['Aceite'];
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_t'] = 'Aceite';
							break;
						case 3://Normal
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_1'] = $rowdata['Cantidad'];
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_t'] = 'Normal';
							break;
						case 4://Otro
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_t'] = 'Otro';
							
							break;
					}
		
					header( 'Location: '.$location.'&view=true' );
					die;
				
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_tarea':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ot_trabajos'][$_GET['tabla']][$_GET['id_tabla']][$_GET['idInterno']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'submit_itemizado':		
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se traen todos los datos de la tarea
			$query = "SELECT 
			licitacion_listado_level_".$tablaitem.".Nombre, 
			licitacion_listado_level_".$tablaitem.".Codigo, 
			licitacion_listado_level_".$tablaitem.".idTrabajo,
			core_licitacion_trabajos.Nombre as Trabajo
			FROM `licitacion_listado_level_".$tablaitem."`
			LEFT JOIN `core_licitacion_trabajos`   ON core_licitacion_trabajos.idTrabajo   = licitacion_listado_level_".$tablaitem.".idTrabajo
			WHERE idLevel_".$tablaitem." = {$idItemizado}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			if ( empty($error) ) {

					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Item_Nombre']      = $rowdata['Nombre'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Item_Codigo']      = $rowdata['Codigo'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Item_Trabajo']     = $rowdata['Trabajo'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['idTrabajo']        = $rowdata['idTrabajo'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['idItemizado']      = $idItemizado;
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['tablaitem']        = $tablaitem;


					switch ($rowdata['idTrabajo']) {
						case 1: //Analisis
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Grasa_inicial']        = 0;
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Grasa_relubricacion']  = 0;
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Aceite']               = 0;
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Cantidad']             = 0;
									
						break;
						case 2: //Consumo de Materiales
									
						break;
						case 3: //Observacion
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Grasa_inicial']        = 0;
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Grasa_relubricacion']  = 0;
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Aceite']               = 0;
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Cantidad']             = 0;
									
						break;
					}
					
								
					header( 'Location: '.$location.'&view=true' );
					die;
			}
				
		break;
/*******************************************************************************************************************/		
		case 'submit_producto':		
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se traen todos los datos del producto
			$query = "SELECT 
			productos_listado.idProducto,
			productos_listado.Nombre AS Producto,
			sistema_productos_uml.Nombre AS Unimed,
			productos_listado.idUml
			FROM `productos_listado`
			LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
			WHERE productos_listado.idProducto = {$idProducto}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			if ( empty($error) ) {

					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['idProducto']  = $rowdata['idProducto'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['idUml']       = $rowdata['idUml'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Producto']    = $rowdata['Producto'];
					$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Unimed']      = $rowdata['Unimed'];
					
					
					
					switch ($idSubTipo) {
						case 1: //Grasa
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_t']         = 'Grasa Lub/Relub';
							if(isset($Grasa_inicial)&&$Grasa_inicial!='') {              
								$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Grasa_inicial']  = $Grasa_inicial;
								$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_1']         = $Grasa_inicial; 
							}
							if(isset($Grasa_relubricacion)&&$Grasa_relubricacion!='') {  
								$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Grasa_relubricacion']  = $Grasa_relubricacion;    
								$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_2']               = $Grasa_relubricacion;    
							}
							break;
							
						case 2: //Aceite
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Aceite'] = $Aceite; 
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_1'] = $Aceite; 
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_2'] = '';
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_t'] = 'Aceite';
							break;
							
						case 3: //Normal
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['Cantidad'] = $Cantidad;
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_1']   = $Cantidad;
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_2']   = '';
							$_SESSION['ot_trabajos'][$tabla][$id_tabla][$idInterno]['data_t']   = 'Normal';
							break;
							
						case 4: //Otro
						   
							break;
					}

					
					header( 'Location: '.$location.'&view=true' );
					die;
			}
				
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
				$_SESSION['ot_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['ot_temporal'] = $_SESSION['ot_basicos']['Observaciones'];
			$_SESSION['ot_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'crear_ot':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
			/*********************************************************************/
			//variables
			$n_trabajadores = 0;
			$n_trabajos = 0;
			
			
			//Se verifican los datos basicos
			if (isset($_SESSION['ot_basicos'])){
				if(!isset($_SESSION['ot_basicos']['idSistema']) or $_SESSION['ot_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha ingresado el id del sistema';}
				if(!isset($_SESSION['ot_basicos']['idMaquina']) or $_SESSION['ot_basicos']['idMaquina']=='' ){           $error['idMaquina']        = 'error/No ha seleccionado la maquina';}
				if(!isset($_SESSION['ot_basicos']['idUsuario']) or $_SESSION['ot_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['ot_basicos']['idEstado']) or $_SESSION['ot_basicos']['idEstado']=='' ){             $error['idEstado']         = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['ot_basicos']['idPrioridad']) or $_SESSION['ot_basicos']['idPrioridad']=='' ){       $error['idPrioridad']      = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['ot_basicos']['idTipo']) or $_SESSION['ot_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
				if(!isset($_SESSION['ot_basicos']['f_creacion']) or $_SESSION['ot_basicos']['f_creacion']=='' ){         $error['f_creacion']       = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['ot_basicos']['f_programacion']) or $_SESSION['ot_basicos']['f_programacion']=='' ){ $error['f_programacion']   = 'error/No ha ingresado la fecha de programacion';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados a la orden de trabajo';
			}
			//Se verifica que tenga trabajadores asignados
			if (isset($_SESSION['ot_trabajador'])){
				foreach ($_SESSION['ot_trabajador'] as $key => $trabajador){
					if(!isset($trabajador['idTrabajador']) or $trabajador['idTrabajador'] == ''){  $error['idTrabajador']   = 'error/No ha ingresado un trabajador';}
					$n_trabajadores++;
				}
			}else{
				$error['trabajador'] = 'error/No tiene trabajadores asignados a la orden de trabajo';
			}
			//Se verifica que los trabajos tengan datos asignados
			if (isset($_SESSION['ot_trabajos'])){
				foreach ($_SESSION['ot_trabajos'] as $key => $x_tabla){
					foreach ($x_tabla as $x_id_tabla) {
						foreach ($x_id_tabla as $x_idInterno) {
							if(!isset($x_idInterno['idItemizado']) or $x_idInterno['idItemizado'] == ''){   $error['idItemizado']   = 'error/No ha seleccionado un trabajo para el subcomponente';}
							if(!isset($x_idInterno['idSubTipo']) or $x_idInterno['idSubTipo'] == ''){       $error['idSubTipo']     = 'error/No ha seleccionado un tipo de subcomponente';}
							if(!isset($x_idInterno['id_tabla']) or $x_idInterno['id_tabla'] == ''){         $error['id_tabla']      = 'error/No ha seleccionado un subcomponente';}
							if(!isset($x_idInterno['tabla']) or $x_idInterno['tabla'] == ''){               $error['tabla']         = 'error/No ha seleccionado un subcomponente';}
							if(!isset($x_idInterno['idLicitacion']) or $x_idInterno['idLicitacion'] == ''){ $error['idLicitacion']  = 'error/No ha seleccionado una licitacion';}
							$n_trabajos++;
							//variable reseteada
							$n_grasa = 0;
							//Se revisa por tipo de trabajo
							if(!isset($x_idInterno['idTrabajo']) or $x_idInterno['idTrabajo'] == ''){               
								$error['idTrabajo'] = 'error/No ha seleccionado un trabajo';
							}else{	
								switch ($x_idInterno['idTrabajo']) {
									case 1: //Analisis
												
									break;
									case 2: //Consumo de Materiales
										//verifico si en grasa tiene ambas cantidades guardadas
										if(isset($x_idInterno['Grasa_inicial']) && $x_idInterno['Grasa_inicial'] != '' && $x_idInterno['Grasa_inicial'] != 0){ $n_grasa++;}
										if(isset($x_idInterno['Grasa_relubricacion']) && $x_idInterno['Grasa_relubricacion'] != '' && $x_idInterno['Grasa_relubricacion'] != 0){ $n_grasa++;}
										//Se verifica si lubricacion y relubricacion estan activos
										if(isset($n_grasa)&&$n_grasa==2){
											$error['n_grasa2'] = 'error/Un punto de trabajo tiene lubricacion y relubricacion asignado simultaneamente';
										}
										//Se verifica si lubricacion y relubricacion estan activos
										if(isset($x_idInterno['idSubTipo']) && $x_idInterno['idSubTipo'] != ''&& $x_idInterno['idSubTipo'] ==1){
											if(isset($n_grasa)&&$n_grasa==0){
												$error['n_grasa0'] = 'error/Un punto de trabajo no tiene lubricacion o relubricacion asignado';
											}
										}		
									break;
									case 3: //Observacion
												
									break;
								}
							}	
						}
					}
				}
			}else{
				$error['trabajos'] = 'error/No tiene trabajos asignados a la orden de trabajo';
			}
			
			//Se verifica el minimo de trabajadores
			if(isset($n_trabajadores)&&$n_trabajadores==0){
				$error['trabajos'] = 'error/No tiene trabajadores asignados a la orden de trabajo';
			}
			
			//Se verifica el minimo de trabajos
			if(isset($n_trabajos)&&$n_trabajos==0){
				$error['trabajos'] = 'error/No tiene trabajos asignados a la orden de trabajo';
			}	
			
			


			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['ot_basicos']['idSistema']) && $_SESSION['ot_basicos']['idSistema'] != ''){            $a = "'".$_SESSION['ot_basicos']['idSistema']."'" ;         }else{$a ="''";}
				if(isset($_SESSION['ot_basicos']['idMaquina']) && $_SESSION['ot_basicos']['idMaquina'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idMaquina']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['ot_basicos']['idUsuario']) && $_SESSION['ot_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idUsuario']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['ot_basicos']['idEstado']) && $_SESSION['ot_basicos']['idEstado'] != ''){              $a .= ",'".$_SESSION['ot_basicos']['idEstado']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['ot_basicos']['idPrioridad']) && $_SESSION['ot_basicos']['idPrioridad'] != ''){        $a .= ",'".$_SESSION['ot_basicos']['idPrioridad']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['ot_basicos']['idTipo']) && $_SESSION['ot_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['ot_basicos']['idTipo']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['ot_basicos']['f_creacion']) && $_SESSION['ot_basicos']['f_creacion'] != ''){          $a .= ",'".$_SESSION['ot_basicos']['f_creacion']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['ot_basicos']['f_programacion']) && $_SESSION['ot_basicos']['f_programacion'] != ''){  
					$a .= ",'".$_SESSION['ot_basicos']['f_programacion']."'" ;  
					$a .= ",'".fecha2NdiaMes($_SESSION['ot_basicos']['f_programacion'])."'" ;
					$a .= ",'".fecha2NSemana($_SESSION['ot_basicos']['f_programacion'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['ot_basicos']['f_programacion'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['ot_basicos']['f_programacion'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['ot_basicos']['Observaciones']) && $_SESSION['ot_basicos']['Observaciones'] != ''){          $a .= ",'".$_SESSION['ot_basicos']['Observaciones']."'" ;      }else{$a .= ",'Sin Observaciones'";}
				if(isset($_SESSION['ot_basicos']['idCliente']) && $_SESSION['ot_basicos']['idCliente'] != ''){                  $a .= ",'".$_SESSION['ot_basicos']['idCliente']."'" ;          }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `orden_trabajo_listado` (idSistema, idMaquina, idUsuario, idEstado, idPrioridad,
				idTipo, f_creacion, f_programacion, progDia, progSemana, progMes, progAno, Observaciones,idCliente) 
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
				
					/*****************************************************/
					//Se guardan los datos de los trabajadores de la ot			
					foreach ($_SESSION['ot_trabajador'] as $key => $trabajador){
					
						//filtros
						if(isset($ultimo_id) && $ultimo_id != ''){                                                                $a = "'".$ultimo_id."'" ;                                   }else{$a  = "''";}
						if(isset($_SESSION['ot_basicos']['idSistema']) && $_SESSION['ot_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idSistema']."'" ;       }else{$a .= ",''";}
						if(isset($_SESSION['ot_basicos']['idMaquina']) && $_SESSION['ot_basicos']['idMaquina'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idMaquina']."'" ;       }else{$a .= ",''";}
						if(isset($_SESSION['ot_basicos']['idUsuario']) && $_SESSION['ot_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idUsuario']."'" ;       }else{$a .= ",''";}
						if(isset($_SESSION['ot_basicos']['idEstado']) && $_SESSION['ot_basicos']['idEstado'] != ''){              $a .= ",'".$_SESSION['ot_basicos']['idEstado']."'" ;        }else{$a .= ",''";}
						if(isset($_SESSION['ot_basicos']['idPrioridad']) && $_SESSION['ot_basicos']['idPrioridad'] != ''){        $a .= ",'".$_SESSION['ot_basicos']['idPrioridad']."'" ;     }else{$a .= ",''";}
						if(isset($_SESSION['ot_basicos']['idTipo']) && $_SESSION['ot_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['ot_basicos']['idTipo']."'" ;          }else{$a .= ",''";}
						if(isset($_SESSION['ot_basicos']['f_creacion']) && $_SESSION['ot_basicos']['f_creacion'] != ''){          $a .= ",'".$_SESSION['ot_basicos']['f_creacion']."'" ;      }else{$a .= ",''";}
						if(isset($_SESSION['ot_basicos']['f_programacion']) && $_SESSION['ot_basicos']['f_programacion'] != ''){  $a .= ",'".$_SESSION['ot_basicos']['f_programacion']."'" ;  }else{$a .= ",''";}
						if(isset($trabajador['idTrabajador']) && $trabajador['idTrabajador'] != ''){                              $a .= ",'".$trabajador['idTrabajador']."'" ;                }else{$a .= ",''";}
						
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `orden_trabajo_listado_responsable` (idOT,idSistema, idMaquina, idUsuario,
						idEstado,idPrioridad, idTipo, f_creacion, f_programacion, idTrabajador) 
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
					
					/*****************************************************/
					//Se guardan los datos de los insumos si es que existen			
					if (isset($_SESSION['ot_insumos'])){
						foreach ($_SESSION['ot_insumos'] as $key => $insumos){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                $a = "'".$ultimo_id."'" ;                                   }else{$a  = "''";}
							if(isset($_SESSION['ot_basicos']['idSistema']) && $_SESSION['ot_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idSistema']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['idMaquina']) && $_SESSION['ot_basicos']['idMaquina'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idMaquina']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['idUsuario']) && $_SESSION['ot_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idUsuario']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['idEstado']) && $_SESSION['ot_basicos']['idEstado'] != ''){              $a .= ",'".$_SESSION['ot_basicos']['idEstado']."'" ;        }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['idPrioridad']) && $_SESSION['ot_basicos']['idPrioridad'] != ''){        $a .= ",'".$_SESSION['ot_basicos']['idPrioridad']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['idTipo']) && $_SESSION['ot_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['ot_basicos']['idTipo']."'" ;          }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['f_creacion']) && $_SESSION['ot_basicos']['f_creacion'] != ''){          $a .= ",'".$_SESSION['ot_basicos']['f_creacion']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['f_programacion']) && $_SESSION['ot_basicos']['f_programacion'] != ''){  $a .= ",'".$_SESSION['ot_basicos']['f_programacion']."'" ;  }else{$a .= ",''";}
							if(isset($insumos['idProducto']) && $insumos['idProducto'] != ''){                                        $a .= ",'".$insumos['idProducto']."'" ;   				  }else{$a .= ",''";}
							if(isset($insumos['Cantidad']) && $insumos['Cantidad'] != ''){                                            $a .= ",'".$insumos['Cantidad']."'" ;                       }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							mysqli_query($dbConn, "SET SESSION sql_mode = ''");
							$query  = "INSERT INTO `orden_trabajo_listado_insumos` (idOT, idSistema, idMaquina, idUsuario, idEstado,
							idPrioridad, idTipo, f_creacion, f_programacion, idProducto,Cantidad ) 
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
					
					/*****************************************************/
					//Se guardan los datos de los productos si es que existen			
					if (isset($_SESSION['ot_productos'])){
						foreach ($_SESSION['ot_productos'] as $key => $prod){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                $a = "'".$ultimo_id."'" ;                                   }else{$a  = "''";}
							if(isset($_SESSION['ot_basicos']['idSistema']) && $_SESSION['ot_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idSistema']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['idMaquina']) && $_SESSION['ot_basicos']['idMaquina'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idMaquina']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['idUsuario']) && $_SESSION['ot_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idUsuario']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['idEstado']) && $_SESSION['ot_basicos']['idEstado'] != ''){              $a .= ",'".$_SESSION['ot_basicos']['idEstado']."'" ;        }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['idPrioridad']) && $_SESSION['ot_basicos']['idPrioridad'] != ''){        $a .= ",'".$_SESSION['ot_basicos']['idPrioridad']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['idTipo']) && $_SESSION['ot_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['ot_basicos']['idTipo']."'" ;          }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['f_creacion']) && $_SESSION['ot_basicos']['f_creacion'] != ''){          $a .= ",'".$_SESSION['ot_basicos']['f_creacion']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['ot_basicos']['f_programacion']) && $_SESSION['ot_basicos']['f_programacion'] != ''){  $a .= ",'".$_SESSION['ot_basicos']['f_programacion']."'" ;  }else{$a .= ",''";}
							if(isset($prod['idProducto']) && $prod['idProducto'] != ''){                                              $a .= ",'".$prod['idProducto']."'" ;   				      }else{$a .= ",''";}
							if(isset($prod['Cantidad']) && $prod['Cantidad'] != ''){                                                  $a .= ",'".$prod['Cantidad']."'" ;                          }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							mysqli_query($dbConn, "SET SESSION sql_mode = ''");
							$query  = "INSERT INTO `orden_trabajo_listado_productos` (idOT, idSistema, idMaquina, idUsuario, idEstado,
							idPrioridad, idTipo, f_creacion, f_programacion, idProducto,Cantidad ) 
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
					
					/*****************************************************/
					//Se guardan los trabajos a realizar
					if (isset($_SESSION['ot_trabajos'])){
						foreach ($_SESSION['ot_trabajos'] as $key => $x_tabla){
							foreach ($x_tabla as $x_id_tabla) {
								foreach ($x_id_tabla as $x_idInterno) {
									//filtros
									if(isset($ultimo_id) && $ultimo_id != ''){                                                                $a = "'".$ultimo_id."'" ;                                   }else{$a  = "''";}
									if(isset($_SESSION['ot_basicos']['idSistema']) && $_SESSION['ot_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idSistema']."'" ;       }else{$a .= ",''";}
									if(isset($_SESSION['ot_basicos']['idMaquina']) && $_SESSION['ot_basicos']['idMaquina'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idMaquina']."'" ;       }else{$a .= ",''";}
									if(isset($_SESSION['ot_basicos']['idUsuario']) && $_SESSION['ot_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['ot_basicos']['idUsuario']."'" ;       }else{$a .= ",''";}
									if(isset($_SESSION['ot_basicos']['idEstado']) && $_SESSION['ot_basicos']['idEstado'] != ''){              $a .= ",'".$_SESSION['ot_basicos']['idEstado']."'" ;        }else{$a .= ",''";}
									if(isset($_SESSION['ot_basicos']['idPrioridad']) && $_SESSION['ot_basicos']['idPrioridad'] != ''){        $a .= ",'".$_SESSION['ot_basicos']['idPrioridad']."'" ;     }else{$a .= ",''";}
									if(isset($_SESSION['ot_basicos']['idTipo']) && $_SESSION['ot_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['ot_basicos']['idTipo']."'" ;          }else{$a .= ",''";}
									if(isset($_SESSION['ot_basicos']['f_creacion']) && $_SESSION['ot_basicos']['f_creacion'] != ''){          $a .= ",'".$_SESSION['ot_basicos']['f_creacion']."'" ;      }else{$a .= ",''";}
									if(isset($_SESSION['ot_basicos']['f_programacion']) && $_SESSION['ot_basicos']['f_programacion'] != ''){  $a .= ",'".$_SESSION['ot_basicos']['f_programacion']."'" ;  }else{$a .= ",''";}
									if(isset($x_idInterno['id_tabla']) && $x_idInterno['id_tabla'] != ''){                                    $a .= ",'".$x_idInterno['id_tabla']."'" ;                   }else{$a .= ",''";}
									if(isset($x_idInterno['tabla']) && $x_idInterno['tabla'] != ''){                                          $a .= ",'".$x_idInterno['tabla']."'" ;                      }else{$a .= ",''";}
									if(isset($x_idInterno['tabla_m_value']) && $x_idInterno['tabla_m_value'] != ''){                          $a .= ",'".$x_idInterno['tabla_m_value']."'" ;              }else{$a .= ",''";}
									if(isset($x_idInterno['tabla_m']) && $x_idInterno['tabla_m'] != ''){                                      $a .= ",'".$x_idInterno['tabla_m']."'" ;                    }else{$a .= ",''";}
									if(isset($x_idInterno['idItemizado']) && $x_idInterno['idItemizado'] != ''){                              $a .= ",'".$x_idInterno['idItemizado']."'" ;                }else{$a .= ",''";}
									if(isset($x_idInterno['tablaitem']) && $x_idInterno['tablaitem'] != ''){                                  $a .= ",'".$x_idInterno['tablaitem']."'" ;                  }else{$a .= ",''";}
									if(isset($x_idInterno['idSubTipo']) && $x_idInterno['idSubTipo'] != ''){                                  $a .= ",'".$x_idInterno['idSubTipo']."'" ;                  }else{$a .= ",''";}
									if(isset($x_idInterno['idTrabajo']) && $x_idInterno['idTrabajo'] != ''){                                  $a .= ",'".$x_idInterno['idTrabajo']."'" ;                  }else{$a .= ",''";}
									if(isset($x_idInterno['idProducto']) && $x_idInterno['idProducto'] != ''){                                $a .= ",'".$x_idInterno['idProducto']."'" ;                 }else{$a .= ",''";}
									if(isset($x_idInterno['idUml']) && $x_idInterno['idUml'] != ''){                                          $a .= ",'".$x_idInterno['idUml']."'" ;                      }else{$a .= ",''";}
									if(isset($x_idInterno['Grasa_inicial']) && $x_idInterno['Grasa_inicial'] != ''){                          $a .= ",'".$x_idInterno['Grasa_inicial']."'" ;              }else{$a .= ",''";}
									if(isset($x_idInterno['Grasa_relubricacion']) && $x_idInterno['Grasa_relubricacion'] != ''){              $a .= ",'".$x_idInterno['Grasa_relubricacion']."'" ;        }else{$a .= ",''";}
									if(isset($x_idInterno['Aceite']) && $x_idInterno['Aceite'] != ''){                                        $a .= ",'".$x_idInterno['Aceite']."'" ;                     }else{$a .= ",''";}
									if(isset($x_idInterno['Cantidad']) && $x_idInterno['Cantidad'] != ''){                                    $a .= ",'".$x_idInterno['Cantidad']."'" ;                   }else{$a .= ",''";}
									//Se guardan los nombres de los componentes
									if(isset($x_idInterno['Nombre']) && $x_idInterno['Nombre'] != ''){               $a .= ",'".$x_idInterno['Codigo'].' - '.$x_idInterno['Nombre']."'" ;                 }else{$a .= ",''";}
									if(isset($x_idInterno['Item_Nombre']) && $x_idInterno['Item_Nombre'] != ''){     $a .= ",'".$x_idInterno['Item_Trabajo'].': '.$x_idInterno['Item_Codigo'].' - '.$x_idInterno['Item_Nombre']."'" ;  }else{$a .= ",''";}
									//Se agrega el dato de la observacion
									$a .= ",'Sin Observaciones'" ; 
									//Se guarda la licitacion
									if(isset($x_idInterno['idLicitacion']) && $x_idInterno['idLicitacion'] != ''){     $a .= ",'".$x_idInterno['idLicitacion']."'" ;  }else{$a .= ",''";}
									 
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `orden_trabajo_listado_trabajos` (idOT, idSistema, idMaquina, idUsuario, idEstado, idPrioridad,
									idTipo, f_creacion, f_programacion, comp_tabla_id, comp_tabla, item_m_tabla_id, item_m_tabla, item_tabla_id, item_tabla,
									idSubTipo, idTrabajo, idProducto, idUml, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, NombreComponente, NombreTrabajo, 
									Observacion, idLicitacion) 
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
					
				
					/*****************************************************/
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['ot_basicos']);
					unset($_SESSION['ot_trabajador']);
					unset($_SESSION['ot_trabajos']);
					unset($_SESSION['ot_temporal']);
					unset($_SESSION['ot_insumos']);
					unset($_SESSION['ot_productos']);
				
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;		
/*******************************************************************************************************************/		
		case 'del_ot':		
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los datos de la tabla principal
			$query  = "DELETE FROM `orden_trabajo_listado` WHERE idOT = {$_GET['del_ot']}";
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
			
			//se borran los responsables
			$query  = "DELETE FROM `orden_trabajo_listado_responsable` WHERE idOT = {$_GET['del_ot']}";
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
			
			//se borran los trabajos
			$query  = "DELETE FROM `orden_trabajo_listado_trabajos` WHERE idOT = {$_GET['del_ot']}";
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
			
			//se borran los insumos
			$query  = "DELETE FROM `orden_trabajo_listado_insumos` WHERE idOT = {$_GET['del_ot']}";
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
			
			//se borran los productos
			$query  = "DELETE FROM `orden_trabajo_listado_productos` WHERE idOT = {$_GET['del_ot']}";
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
						
			header( 'Location: '.$location.'&deleted=true' );
			die;
		
		break;
/*******************************************************************************************************************/		
		case 'clone':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*****************************************************/
				// Se traen todos los datos de la ot seleccionada
				$query = "SELECT idSistema,idMaquina,idPrioridad,idTipo,Observaciones,idCliente
				FROM `orden_trabajo_listado`
				WHERE idOT = {$idOT}";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata = mysqli_fetch_assoc ($resultado);
				
				/*****************************************************/
				// Se trae un listado con los trabajadores de la OT
				$arrTrabajadores = array();
				$query = "SELECT idSistema,idMaquina,idPrioridad,idTipo,idTrabajador
				FROM `orden_trabajo_listado_responsable`
				WHERE idOT = {$idOT}";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTrabajadores,$row );
				}

				/*****************************************************/
				// Se trae un listado de los trabajos a realizar
				$arrTrabajo = array();
				$query = "SELECT  idSistema,idMaquina,idPrioridad,idTipo,comp_tabla_id,comp_tabla,item_m_tabla_id,
				item_m_tabla,item_tabla_id,item_tabla,idSubTipo,idTrabajo,idProducto,idUml,Grasa_inicial,Grasa_relubricacion,
				Aceite,Cantidad,NombreComponente,NombreTrabajo,idLicitacion
				FROM `orden_trabajo_listado_trabajos`
				WHERE idOT = {$idOT} ";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTrabajo,$row );
				}
		
				/*****************************************************/
				//Se guardan los datos basicos
				if(isset($rowdata['idSistema']) &&$rowdata['idSistema'] != ''){        $a = "'".$rowdata['idSistema']."'" ;         }else{$a ="''";}
				if(isset($rowdata['idMaquina']) && $rowdata['idMaquina'] != ''){       $a .= ",'".$rowdata['idMaquina']."'" ;       }else{$a .= ",''";}
				if(isset($idUsuario) && $idUsuario != ''){                             $a .= ",'".$idUsuario."'" ;                  }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                               $a .= ",'".$idEstado."'" ;                   }else{$a .= ",''";}
				if(isset($rowdata['idPrioridad']) && $rowdata['idPrioridad'] != ''){   $a .= ",'".$rowdata['idPrioridad']."'" ;     }else{$a .= ",''";}
				if(isset($rowdata['idTipo']) && $rowdata['idTipo']!= ''){              $a .= ",'".$rowdata['idTipo']."'" ;          }else{$a .= ",''";}
				if(isset($f_creacion) && $f_creacion != ''){                           $a .= ",'".$f_creacion."'" ;                 }else{$a .= ",''";}
				if(isset($f_programacion) && $f_programacion != ''){  
					$a .= ",'".$f_programacion."'" ;  
					$a .= ",'".fecha2NdiaMes($f_programacion)."'" ;
					$a .= ",'".fecha2NSemana($f_programacion)."'" ;
					$a .= ",'".fecha2NMes($f_programacion)."'" ;
					$a .= ",'".fecha2Ano($f_programacion)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($rowdata['Observaciones']) && $rowdata['Observaciones'] != ''){   $a .= ",'".$rowdata['Observaciones']."'" ;      }else{$a .= ",'Sin Observaciones'";}
				if(isset($rowdata['idCliente']) && $rowdata['idCliente'] != ''){           $a .= ",'".$rowdata['idCliente']."'" ;          }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `orden_trabajo_listado` (idSistema, idMaquina, idUsuario, idEstado, idPrioridad,
				idTipo, f_creacion, f_programacion, progDia, progSemana, progMes, progAno, Observaciones,idCliente) 
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
		
					
					/*****************************************************/
					//Se guardan los datos de los trabajadores			
					foreach ($arrTrabajadores AS $trabajador){
					
						//filtros
						if(isset($ultimo_id) &&$ultimo_id != ''){                                    $a = "'".$ultimo_id."'" ;                    }else{$a ="''";}
						if(isset($trabajador['idSistema']) && $trabajador['idSistema'] != ''){       $a .= ",'".$trabajador['idSistema']."'" ;    }else{$a .= ",''";}
						if(isset($trabajador['idMaquina']) && $trabajador['idMaquina'] != ''){       $a .= ",'".$trabajador['idMaquina']."'" ;    }else{$a .= ",''";}
						if(isset($idUsuario) && $idUsuario != ''){                                   $a .= ",'".$idUsuario."'" ;                  }else{$a .= ",''";}
						if(isset($idEstado) && $idEstado != ''){                                     $a .= ",'".$idEstado."'" ;                   }else{$a .= ",''";}
						if(isset($trabajador['idPrioridad']) && $trabajador['idPrioridad'] != ''){   $a .= ",'".$trabajador['idPrioridad']."'" ;  }else{$a .= ",''";}
						if(isset($trabajador['idTipo']) && $trabajador['idTipo']!= ''){              $a .= ",'".$trabajador['idTipo']."'" ;       }else{$a .= ",''";}
						if(isset($f_creacion) && $f_creacion != ''){                                 $a .= ",'".$f_creacion."'" ;                 }else{$a .= ",''";}
						if(isset($f_programacion) && $f_programacion != ''){                         $a .= ",'".$f_programacion."'" ;             }else{$a .= ",''";}
						if(isset($trabajador['idTrabajador']) && $trabajador['idTrabajador'] != ''){ $a .= ",'".$trabajador['idTrabajador']."'" ; }else{$a .= ",''";}
						
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `orden_trabajo_listado_responsable` (idOT,idSistema,idMaquina,idUsuario,
						idEstado,idPrioridad,idTipo,f_creacion,f_programacion,idTrabajador) 
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
					
					/*****************************************************/
					//Se guardan los trabajos a realizar
					foreach ($arrTrabajo AS $trabajos){
				
						//filtros
						if(isset($ultimo_id) &&$ultimo_id != ''){                                               $a  = "'".$ultimo_id."'" ;                         }else{$a  ="''";}
						if(isset($trabajos['idSistema']) && $trabajos['idSistema'] != ''){                      $a .= ",'".$trabajos['idSistema']."'" ;            }else{$a .= ",''";}
						if(isset($trabajos['idMaquina']) && $trabajos['idMaquina'] != ''){                      $a .= ",'".$trabajos['idMaquina']."'" ;            }else{$a .= ",''";}
						if(isset($idUsuario) && $idUsuario != ''){                                              $a .= ",'".$idUsuario."'" ;                        }else{$a .= ",''";}
						if(isset($idEstado) && $idEstado != ''){                                                $a .= ",'".$idEstado."'" ;                         }else{$a .= ",''";}
						if(isset($trabajos['idPrioridad']) && $trabajos['idPrioridad'] != ''){                  $a .= ",'".$trabajos['idPrioridad']."'" ;          }else{$a .= ",''";}
						if(isset($trabajos['idTipo']) && $trabajos['idTipo']!= ''){                             $a .= ",'".$trabajos['idTipo']."'" ;               }else{$a .= ",''";}
						if(isset($f_creacion) && $f_creacion != ''){                                            $a .= ",'".$f_creacion."'" ;                       }else{$a .= ",''";}
						if(isset($f_programacion) && $f_programacion != ''){                                    $a .= ",'".$f_programacion."'" ;                   }else{$a .= ",''";}
						if(isset($trabajos['comp_tabla_id']) && $trabajos['comp_tabla_id'] != ''){              $a .= ",'".$trabajos['comp_tabla_id']."'" ;        }else{$a .= ",''";}
						if(isset($trabajos['comp_tabla']) && $trabajos['comp_tabla'] != ''){                    $a .= ",'".$trabajos['comp_tabla']."'" ;           }else{$a .= ",''";}
						if(isset($trabajos['item_m_tabla_id']) && $trabajos['item_m_tabla_id'] != ''){          $a .= ",'".$trabajos['item_m_tabla_id']."'" ;      }else{$a .= ",''";}
						if(isset($trabajos['item_m_tabla']) && $trabajos['item_m_tabla'] != ''){                $a .= ",'".$trabajos['item_m_tabla']."'" ;         }else{$a .= ",''";}
						if(isset($trabajos['item_tabla_id']) && $trabajos['item_tabla_id'] != ''){              $a .= ",'".$trabajos['item_tabla_id']."'" ;        }else{$a .= ",''";}
						if(isset($trabajos['item_tabla']) && $trabajos['item_tabla'] != ''){                    $a .= ",'".$trabajos['item_tabla']."'" ;           }else{$a .= ",''";}
						if(isset($trabajos['idSubTipo']) && $trabajos['idSubTipo'] != ''){                      $a .= ",'".$trabajos['idSubTipo']."'" ;            }else{$a .= ",''";}
						if(isset($trabajos['idTrabajo']) && $trabajos['idTrabajo'] != ''){                      $a .= ",'".$trabajos['idTrabajo']."'" ;            }else{$a .= ",''";}
						if(isset($trabajos['idProducto']) && $trabajos['idProducto'] != ''){                    $a .= ",'".$trabajos['idProducto']."'" ;           }else{$a .= ",''";}
						if(isset($trabajos['idUml']) && $trabajos['idUml'] != ''){                              $a .= ",'".$trabajos['idUml']."'" ;                }else{$a .= ",''";}
						if(isset($trabajos['Grasa_inicial']) && $trabajos['Grasa_inicial'] != ''){              $a .= ",'".$trabajos['Grasa_inicial']."'" ;        }else{$a .= ",''";}
						if(isset($trabajos['Grasa_relubricacion']) && $trabajos['Grasa_relubricacion'] != ''){  $a .= ",'".$trabajos['Grasa_relubricacion']."'" ;  }else{$a .= ",''";}
						if(isset($trabajos['Aceite']) && $trabajos['Aceite'] != ''){                            $a .= ",'".$trabajos['Aceite']."'" ;               }else{$a .= ",''";}
						if(isset($trabajos['Cantidad']) && $trabajos['Cantidad'] != ''){                        $a .= ",'".$trabajos['Cantidad']."'" ;             }else{$a .= ",''";}
						if(isset($trabajos['NombreComponente']) && $trabajos['NombreComponente'] != ''){        $a .= ",'".$trabajos['NombreComponente']."'" ;     }else{$a .= ",''";}
						if(isset($trabajos['NombreTrabajo']) && $trabajos['NombreTrabajo'] != ''){              $a .= ",'".$trabajos['NombreTrabajo']."'" ;        }else{$a .= ",''";}
						//Se agrega el dato de la observacion
						$a .= ",'Sin Observaciones'" ; 
						if(isset($trabajos['idLicitacion']) && $trabajos['idLicitacion'] != ''){                $a .= ",'".$trabajos['idLicitacion']."'" ;         }else{$a .= ",''";}
									
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `orden_trabajo_listado_trabajos` (idOT, idSistema, idMaquina, idUsuario,idEstado,
						idPrioridad, idTipo, f_creacion, f_programacion, comp_tabla_id, comp_tabla, item_m_tabla_id, item_m_tabla,
						item_tabla_id, item_tabla, idSubTipo, idTrabajo, idProducto, idUml, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad,
						NombreComponente, NombreTrabajo, Observacion, idLicitacion) 
						
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

					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;		
/*******************************************************************************************************************/
/*                                         Se actualizan los datos maestros                                        */
/*******************************************************************************************************************/		
		case 'edit_ot_list':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Secreanlas variables temporales
			if(isset($f_programacion) && $f_programacion != ''){  
				$progDia    = fecha2NdiaMes($f_programacion);
				$progSemana = fecha2NSemana($f_programacion);
				$progMes    = fecha2NMes($f_programacion);
				$progAno    = fecha2Ano($f_programacion);
			}
			if(isset($f_termino) && $f_termino != ''){  
				$terDia    = fecha2NdiaMes($f_termino);
				$terSemana = fecha2NSemana($f_termino);
				$terMes    = fecha2NMes($f_termino);
				$terAno    = fecha2Ano($f_termino);
			}	
				
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idOT='".$idOT."'" ;
				if(isset($idSistema) && $idSistema != ''){              $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idMaquina) && $idMaquina != ''){              $a .= ",idMaquina='".$idMaquina."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idPrioridad) && $idPrioridad != ''){          $a .= ",idPrioridad='".$idPrioridad."'" ;}
				if(isset($idTipo) && $idTipo != ''){                    $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($f_creacion) && $f_creacion != ''){            $a .= ",f_creacion='".$f_creacion."'" ;}
				if(isset($f_programacion) && $f_programacion != ''){    $a .= ",f_programacion='".$f_programacion."'" ;}
				if(isset($f_termino) && $f_termino != ''){              $a .= ",f_termino='".$f_termino."'" ;}
				if(isset($Observaciones) && $Observaciones != ''){      $a .= ",Observaciones='".$Observaciones."'" ;}
				if(isset($progDia) && $progDia != ''){                  $a .= ",progDia='".$progDia."'" ;}
				if(isset($progSemana) && $progSemana != ''){            $a .= ",progSemana='".$progSemana."'" ;}
				if(isset($progMes) && $progMes != ''){                  $a .= ",progMes='".$progMes."'" ;}
				if(isset($progAno) && $progAno != ''){                  $a .= ",progAno='".$progAno."'" ;}
				if(isset($terDia) && $terDia != ''){                    $a .= ",terDia='".$terDia."'" ;}
				if(isset($terSemana) && $terSemana != ''){              $a .= ",terSemana='".$terSemana."'" ;}
				if(isset($terMes) && $terMes != ''){                    $a .= ",terMes='".$terMes."'" ;}
				if(isset($terAno) && $terAno != ''){                    $a .= ",terAno='".$terAno."'" ;}
				if(isset($idSupervisor) && $idSupervisor != ''){        $a .= ",idSupervisor='".$idSupervisor."'" ;}
				if(isset($horaProg) && $horaProg != ''){                $a .= ",horaProg='".$horaProg."'" ;}
				if(isset($horaInicio) && $horaInicio != ''){            $a .= ",horaInicio='".$horaInicio."'" ;}
				if(isset($horaTermino) && $horaTermino != ''){          $a .= ",horaTermino='".$horaTermino."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `orden_trabajo_listado` SET ".$a." WHERE idOT = '$idOT'";
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
				
				
			}
		
		break;	
/*******************************************************************************************************************/		
		case 'edit_addTrab':	

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idTrabajador)&&isset($idOT)){
				$ndata_1 = db_select_nrows ('idResponsable', 'orden_trabajo_listado_responsable', '', "idTrabajador='".$idTrabajador."' AND idOT='".$idOT."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El trabajador seleccionado ya esta asignado a esta OT';}
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
					
				//filtros
				if(isset($idOT) && $idOT != ''){                        $a = "'".$idOT."'" ;                }else{$a ="''";}
				if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;         }else{$a .= ",''";}
				if(isset($idMaquina) && $idMaquina != ''){              $a .= ",'".$idMaquina."'" ;         }else{$a .= ",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;         }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;          }else{$a .= ",''";}
				if(isset($idPrioridad) && $idPrioridad != ''){          $a .= ",'".$idPrioridad."'" ;       }else{$a .= ",''";}
				if(isset($idTipo) && $idTipo != ''){                    $a .= ",'".$idTipo."'" ;            }else{$a .= ",''";}
				if(isset($f_creacion) && $f_creacion != ''){            $a .= ",'".$f_creacion."'" ;        }else{$a .= ",''";}
				if(isset($f_programacion) && $f_programacion != ''){    $a .= ",'".$f_programacion."'" ;    }else{$a .= ",''";}
				if(isset($idTrabajador) && $idTrabajador != ''){        $a .= ",'".$idTrabajador."'" ;      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `orden_trabajo_listado_responsable` (idOT,idSistema,idMaquina,idUsuario,
				idEstado,idPrioridad,idTipo,f_creacion,f_programacion,idTrabajador) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&addtrab=true' );
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
		case 'edit_editTrab':	

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idTrabajador)&&isset($idOT)){
				$ndata_1 = db_select_nrows ('idResponsable', 'orden_trabajo_listado_responsable', '', "idTrabajador='".$idTrabajador."' AND idOT='".$idOT."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El trabajador seleccionado ya esta asignado a esta OT';}
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
					
				//filtros
				$a = "idResponsable='".$idResponsable."'" ;
				if(isset($idTrabajador) && $idTrabajador != ''){    $a .= ",idTrabajador='".$idTrabajador."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `orden_trabajo_listado_responsable` SET ".$a." WHERE idResponsable = '$idResponsable'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&edittrab=true' );
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
		case 'edit_delTrab':	
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los datos
			$query  = "DELETE FROM `orden_trabajo_listado_responsable` WHERE idResponsable = {$_GET['del_trab']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&deltrab=true' );
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
		case 'edit_addIns':	

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idProducto)&&isset($idOT)){
				$ndata_1 = db_select_nrows ('idInsumos', 'orden_trabajo_listado_insumos', '', "idProducto='".$idProducto."' AND idOT='".$idOT."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Insumo seleccionado ya esta asignado a esta OT';}
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
					
				//filtros
				if(isset($idOT) && $idOT != ''){                        $a = "'".$idOT."'" ;                }else{$a ="''";}
				if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;         }else{$a .= ",''";}
				if(isset($idMaquina) && $idMaquina != ''){              $a .= ",'".$idMaquina."'" ;         }else{$a .= ",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;         }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;          }else{$a .= ",''";}
				if(isset($idPrioridad) && $idPrioridad != ''){          $a .= ",'".$idPrioridad."'" ;       }else{$a .= ",''";}
				if(isset($idTipo) && $idTipo != ''){                    $a .= ",'".$idTipo."'" ;            }else{$a .= ",''";}
				if(isset($f_creacion) && $f_creacion != ''){            $a .= ",'".$f_creacion."'" ;        }else{$a .= ",''";}
				if(isset($f_programacion) && $f_programacion != ''){    $a .= ",'".$f_programacion."'" ;    }else{$a .= ",''";}
				if(isset($idProducto) && $idProducto != ''){            $a .= ",'".$idProducto."'" ;        }else{$a .= ",''";}
				if(isset($Cantidad) && $Cantidad != ''){                $a .= ",'".$Cantidad."'" ;          }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `orden_trabajo_listado_insumos` (idOT,idSistema,idMaquina,idUsuario,
				idEstado,idPrioridad,idTipo,f_creacion,f_programacion,idProducto, Cantidad) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&addins=true' );
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
		case 'edit_editIns':	

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idProducto)&&isset($idOT)&&isset($idInsumos)){
				$ndata_1 = db_select_nrows ('idInsumos', 'orden_trabajo_listado_insumos', '', "idProducto='".$idProducto."' AND idOT='".$idOT."' AND idInsumos!='".$idInsumos."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Insumo seleccionado ya esta asignado a esta OT';}
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
					
				//filtros
				$a = "idInsumos='".$idInsumos."'" ;
				if(isset($idProducto) && $idProducto != ''){    $a .= ",idProducto='".$idProducto."'" ;}
				if(isset($Cantidad) && $Cantidad != ''){        $a .= ",Cantidad='".$Cantidad."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `orden_trabajo_listado_insumos` SET ".$a." WHERE idInsumos = '$idInsumos'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&editins=true' );
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
		case 'edit_delIns':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los datos
			$query  = "DELETE FROM `orden_trabajo_listado_insumos` WHERE idInsumos = {$_GET['del_ins']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&delins=true' );
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
		case 'edit_addProd':	

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idProducto)&&isset($idOT)){
				$ndata_1 = db_select_nrows ('idProductos', 'orden_trabajo_listado_productos', '', "idProducto='".$idProducto."' AND idOT='".$idOT."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Producto seleccionado ya esta asignado a esta OT';}
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
					
				//filtros
				if(isset($idOT) && $idOT != ''){                        $a = "'".$idOT."'" ;                }else{$a ="''";}
				if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;         }else{$a .= ",''";}
				if(isset($idMaquina) && $idMaquina != ''){              $a .= ",'".$idMaquina."'" ;         }else{$a .= ",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;         }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;          }else{$a .= ",''";}
				if(isset($idPrioridad) && $idPrioridad != ''){          $a .= ",'".$idPrioridad."'" ;       }else{$a .= ",''";}
				if(isset($idTipo) && $idTipo != ''){                    $a .= ",'".$idTipo."'" ;            }else{$a .= ",''";}
				if(isset($f_creacion) && $f_creacion != ''){            $a .= ",'".$f_creacion."'" ;        }else{$a .= ",''";}
				if(isset($f_programacion) && $f_programacion != ''){    $a .= ",'".$f_programacion."'" ;    }else{$a .= ",''";}
				if(isset($idProducto) && $idProducto != ''){            $a .= ",'".$idProducto."'" ;        }else{$a .= ",''";}
				if(isset($Cantidad) && $Cantidad != ''){                $a .= ",'".$Cantidad."'" ;          }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `orden_trabajo_listado_productos` (idOT,idSistema,idMaquina,idUsuario,
				idEstado,idPrioridad,idTipo,f_creacion,f_programacion,idProducto, Cantidad) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&addprod=true' );
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
		case 'edit_editProd':	

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idProducto)&&isset($idOT)&&isset($idProductos)){
				$ndata_1 = db_select_nrows ('idProductos', 'orden_trabajo_listado_productos', '', "idProducto='".$idProducto."' AND idOT='".$idOT."' AND idProductos!='".$idProductos."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Producto seleccionado ya esta asignado a esta OT';}
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
					
				//filtros
				$a = "idProductos='".$idProductos."'" ;
				if(isset($idProducto) && $idProducto != ''){    $a .= ",idProducto='".$idProducto."'" ;}
				if(isset($Cantidad) && $Cantidad != ''){        $a .= ",Cantidad='".$Cantidad."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `orden_trabajo_listado_productos` SET ".$a." WHERE idProductos = '$idProductos'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&editprod=true' );
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
		case 'edit_delProd':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los datos
			$query  = "DELETE FROM `orden_trabajo_listado_productos` WHERE idProductos = {$_GET['del_prod']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&delprod=true' );
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
		case 'del_tarea_row':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `orden_trabajo_listado_trabajos` WHERE idTrabajoOT = {$_GET['idInterno']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&deltarea=true' );
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
		case 'submit_itemizado_row':		
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se traen todos los datos de la tarea
			$query = "SELECT 
			licitacion_listado_level_".$tablaitem.".Nombre, 
			licitacion_listado_level_".$tablaitem.".Codigo, 
			licitacion_listado_level_".$tablaitem.".idTrabajo,
			core_licitacion_trabajos.Nombre as Trabajo
			FROM `licitacion_listado_level_".$tablaitem."`
			LEFT JOIN `core_licitacion_trabajos`   ON core_licitacion_trabajos.idTrabajo   = licitacion_listado_level_".$tablaitem.".idTrabajo
			WHERE idLevel_".$tablaitem." = {$idItemizado}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
		
			if ( empty($error) ) {

				//filtros
				$a = "idTrabajoOT='".$idInterno."'" ;
				if(isset($rowdata['Nombre'])&&isset($rowdata['Codigo'])&&isset($rowdata['Trabajo'])){    $a .= ",NombreTrabajo='".$rowdata['Trabajo'].': '.$rowdata['Codigo'].' - '.$rowdata['Nombre']."'" ;}
				if(isset($rowdata['idTrabajo']) && $rowdata['idTrabajo'] != ''){                         $a .= ",idTrabajo='".$rowdata['idTrabajo']."'" ;}
				if(isset($idItemizado) && $idItemizado != ''){                                           $a .= ",item_tabla_id='".$idItemizado."'" ;}
				if(isset($tablaitem) && $tablaitem != ''){                                               $a .= ",item_tabla='".$tablaitem."'" ;}
					
				//Se ejecuta si se hace un cambio en el tipo de tarea
				switch ($rowdata['idTrabajo']) {
					case 1: //Analisis
						$a .= ",Grasa_inicial=''";	
						$a .= ",Grasa_relubricacion=''";
						$a .= ",Aceite=''";
						$a .= ",Cantidad=''";	
					break;
					case 2: //Consumo de Materiales
									
	
					break;
					case 3: //Observacion
						$a .= ",Grasa_inicial=''";	
						$a .= ",Grasa_relubricacion=''";
						$a .= ",Aceite=''";
						$a .= ",Cantidad=''";		
					break;
				}
							
				// inserto los datos de registro en la db
				$query  = "UPDATE `orden_trabajo_listado_trabajos` SET ".$a." WHERE idTrabajoOT = '$idInterno'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&edittarea=true' );
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
		case 'submit_producto_row':		
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se traen todos los datos del producto
			$query = "SELECT  idProducto, idUml
			FROM `productos_listado`
			WHERE idProducto = {$idProducto}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);

			if ( empty($error) ) {
					
					//filtros
					$a = "idTrabajoOT='".$idInterno."'" ;
					if(isset($rowdata['idProducto']) && $rowdata['idProducto'] != ''){   $a .= ",idProducto='".$rowdata['idProducto']."'" ;}
					if(isset($rowdata['idUml']) && $rowdata['idUml'] != ''){             $a .= ",idUml='".$rowdata['idUml']."'" ;}
					if(isset($Grasa_inicial) && $Grasa_inicial!= ''){                    $a .= ",Grasa_inicial='".$Grasa_inicial."'" ;              }else{$a .= ",Grasa_inicial=''" ;}
					if(isset($Grasa_relubricacion) && $Grasa_relubricacion!= ''){        $a .= ",Grasa_relubricacion='".$Grasa_relubricacion."'" ;  }else{$a .= ",Grasa_relubricacion=''" ;}
					if(isset($Aceite) && $Aceite!= ''){                                  $a .= ",Aceite='".$Aceite."'" ;                            }else{$a .= ",Aceite=''" ;}
					if(isset($Cantidad) && $Cantidad!= ''){                              $a .= ",Cantidad='".$Cantidad."'" ;                        }else{$a .= ",Cantidad=''" ;}
					
					// inserto los datos de registro en la db
					$query  = "UPDATE `orden_trabajo_listado_trabajos` SET ".$a." WHERE idTrabajoOT = '$idInterno'";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
					//Si ejecuto correctamente la consulta
					if($resultado){
						
						header( 'Location: '.$location.'&edittarea=true' );
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
		case 'submit_tarea_edit':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if(isset($idLevel[1])&&$idLevel[1]!=''){   $id_tabla = $idLevel[1];  $tabla=1;  $id_tabla_madre = 0;            $tabla_madre=0; }
			if(isset($idLevel[2])&&$idLevel[2]!=''){   $id_tabla = $idLevel[2];  $tabla=2;  $id_tabla_madre = $idLevel[1];  $tabla_madre=1; }
			if(isset($idLevel[3])&&$idLevel[3]!=''){   $id_tabla = $idLevel[3];  $tabla=3;  $id_tabla_madre = $idLevel[2];  $tabla_madre=2; }
			if(isset($idLevel[4])&&$idLevel[4]!=''){   $id_tabla = $idLevel[4];  $tabla=4;  $id_tabla_madre = $idLevel[3];  $tabla_madre=3; }
			if(isset($idLevel[5])&&$idLevel[5]!=''){   $id_tabla = $idLevel[5];  $tabla=5;  $id_tabla_madre = $idLevel[4];  $tabla_madre=4; }
			if(isset($idLevel[6])&&$idLevel[6]!=''){   $id_tabla = $idLevel[6];  $tabla=6;  $id_tabla_madre = $idLevel[5];  $tabla_madre=5; }
			if(isset($idLevel[7])&&$idLevel[7]!=''){   $id_tabla = $idLevel[7];  $tabla=7;  $id_tabla_madre = $idLevel[6];  $tabla_madre=6; }
			if(isset($idLevel[8])&&$idLevel[8]!=''){   $id_tabla = $idLevel[8];  $tabla=8;  $id_tabla_madre = $idLevel[7];  $tabla_madre=7; }
			if(isset($idLevel[9])&&$idLevel[9]!=''){   $id_tabla = $idLevel[9];  $tabla=9;  $id_tabla_madre = $idLevel[8];  $tabla_madre=8; }
			if(isset($idLevel[10])&&$idLevel[10]!=''){ $id_tabla = $idLevel[10]; $tabla=10; $id_tabla_madre = $idLevel[9];  $tabla_madre=9; }
			if(isset($idLevel[11])&&$idLevel[11]!=''){ $id_tabla = $idLevel[11]; $tabla=11; $id_tabla_madre = $idLevel[10]; $tabla_madre=10; }
			if(isset($idLevel[12])&&$idLevel[12]!=''){ $id_tabla = $idLevel[12]; $tabla=12; $id_tabla_madre = $idLevel[11]; $tabla_madre=11; }
			if(isset($idLevel[13])&&$idLevel[13]!=''){ $id_tabla = $idLevel[13]; $tabla=13; $id_tabla_madre = $idLevel[12]; $tabla_madre=12; }
			if(isset($idLevel[14])&&$idLevel[14]!=''){ $id_tabla = $idLevel[14]; $tabla=14; $id_tabla_madre = $idLevel[13]; $tabla_madre=13; }
			if(isset($idLevel[15])&&$idLevel[15]!=''){ $id_tabla = $idLevel[15]; $tabla=15; $id_tabla_madre = $idLevel[14]; $tabla_madre=14; }
			if(isset($idLevel[16])&&$idLevel[16]!=''){ $id_tabla = $idLevel[16]; $tabla=16; $id_tabla_madre = $idLevel[15]; $tabla_madre=15; }
			if(isset($idLevel[17])&&$idLevel[17]!=''){ $id_tabla = $idLevel[17]; $tabla=17; $id_tabla_madre = $idLevel[16]; $tabla_madre=16; }
			if(isset($idLevel[18])&&$idLevel[18]!=''){ $id_tabla = $idLevel[18]; $tabla=18; $id_tabla_madre = $idLevel[17]; $tabla_madre=17; }
			if(isset($idLevel[19])&&$idLevel[19]!=''){ $id_tabla = $idLevel[19]; $tabla=19; $id_tabla_madre = $idLevel[18]; $tabla_madre=18; }
			if(isset($idLevel[20])&&$idLevel[20]!=''){ $id_tabla = $idLevel[20]; $tabla=20; $id_tabla_madre = $idLevel[19]; $tabla_madre=19; }
			if(isset($idLevel[21])&&$idLevel[21]!=''){ $id_tabla = $idLevel[21]; $tabla=21; $id_tabla_madre = $idLevel[20]; $tabla_madre=20; }
			if(isset($idLevel[22])&&$idLevel[22]!=''){ $id_tabla = $idLevel[22]; $tabla=22; $id_tabla_madre = $idLevel[21]; $tabla_madre=21; }
			if(isset($idLevel[23])&&$idLevel[23]!=''){ $id_tabla = $idLevel[23]; $tabla=23; $id_tabla_madre = $idLevel[22]; $tabla_madre=22; }
			if(isset($idLevel[24])&&$idLevel[24]!=''){ $id_tabla = $idLevel[24]; $tabla=24; $id_tabla_madre = $idLevel[23]; $tabla_madre=23; }
			if(isset($idLevel[25])&&$idLevel[25]!=''){ $id_tabla = $idLevel[25]; $tabla=25; $id_tabla_madre = $idLevel[24]; $tabla_madre=24; }
			
			// Se traen los datos de la tabla madre
			if(isset($id_tabla_madre)&&$id_tabla_madre!=0){
				$query = "SELECT idUtilizable,tabla, table_value, idLicitacion
				FROM `maquinas_listado_level_".$tabla_madre."`
				WHERE idLevel_".$tabla_madre." = {$id_tabla_madre}";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_m = mysqli_fetch_assoc ($resultado);
				//se verifica que sea un componente
				if(isset($rowdata_m['idUtilizable'])&&$rowdata_m['idUtilizable']!=3&&$rowdata_m['tabla']==0){
					$error['tabla'] = 'error/El dato seleccionado no posee tareas asignadas';
				}
			}
			
			// Se traen todos los datos de la maquina
			$query = "SELECT 
			maquinas_listado_level_".$tabla.".Nombre,
			maquinas_listado_level_".$tabla.".Codigo,
			maquinas_listado_level_".$tabla.".idUtilizable,
			maquinas_listado_level_".$tabla.".idSubTipo,
			maquinas_listado_level_".$tabla.".idProducto,
			maquinas_listado_level_".$tabla.".Grasa_inicial,
			maquinas_listado_level_".$tabla.".Grasa_relubricacion,
			maquinas_listado_level_".$tabla.".Aceite,
			maquinas_listado_level_".$tabla.".Cantidad,
			maquinas_listado_level_".$tabla.".idUml,
			productos_listado.Nombre AS Producto,
			sistema_productos_uml.Nombre AS Unimed
			
			FROM `maquinas_listado_level_".$tabla."`
			LEFT JOIN `productos_listado`       ON productos_listado.idProducto  = maquinas_listado_level_".$tabla.".idProducto
			LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml   = maquinas_listado_level_".$tabla.".idUml
			WHERE idLevel_".$tabla." = {$id_tabla}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			//se verifica que sea un subcomponente
			if(isset($rowdata['idUtilizable'])&&$rowdata['idUtilizable']!=''&&$rowdata['idUtilizable']!=3){
				$error['subcomponente'] = 'error/El dato seleccionado no es un subcomponente';
			}	
	
			
			//se establece variable inicial		
			$idInterno = 0;
				
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['ot_trabajos_temp'][$tabla][$id_tabla])){
				foreach ($_SESSION['ot_trabajos_temp'][$tabla][$id_tabla] as $key => $trabajos){
					if(isset($trabajos['valor_id'])&&$trabajos['valor_id']!=''){
						$idInterno = $trabajos['valor_id'];
					}
				}
			}
			
			if ( empty($error) ) {

					$idInterno = $idInterno+1;
					//Para mostrar en la creacion
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Nombre']      = $rowdata['Nombre'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Codigo']      = $rowdata['Codigo'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Producto']    = $rowdata['Producto'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Unimed']      = $rowdata['Unimed'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['valor_id']    = $idInterno;
					
					//variables vacias
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_1']       = '';
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_2']       = '';
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_t']       = '';
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Item_Codigo']  = '';
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Item_Nombre']  = '';
					
					//Datos para guardar en la base de datos
					//subcomponente seleccionado
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['id_tabla']       = $id_tabla;
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['tabla']          = $tabla;
					//tabla madre del itemizado
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['tabla_m']        = $rowdata_m['tabla'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['tabla_m_value']  = $rowdata_m['table_value'];
					//productos a utilizar
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['idProducto']  = $rowdata['idProducto'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['idUml']       = $rowdata['idUml'];
					//medidas
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Grasa_inicial']        = $rowdata['Grasa_inicial'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Grasa_relubricacion']  = $rowdata['Grasa_relubricacion'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Aceite']               = $rowdata['Aceite'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Cantidad']             = $rowdata['Cantidad'];
					//idSubTipo
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['idSubTipo']   = $rowdata['idSubTipo'];
					//Licitacion
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['idLicitacion']   = $rowdata_m['idLicitacion'];
					
					switch ($rowdata['idSubTipo']) {
						case 1://Grasa
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_1'] = $rowdata['Grasa_inicial'];
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_2'] = $rowdata['Grasa_relubricacion'];
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_t'] = 'Grasa Lub/Relub';
							break;
						case 2://Aceite
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_1'] = $rowdata['Aceite'];
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_t'] = 'Aceite';
							break;
						case 3://Normal
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_1'] = $rowdata['Cantidad'];
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_t'] = 'Normal';
							break;
						case 4://Otro
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_t'] = 'Otro';
							
							break;
					}
		
					header( 'Location: '.$location.'&addtarea=true' );
					die;
				
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_tarea_edit':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ot_trabajos_temp'][$_GET['tabla']][$_GET['id_tabla']][$_GET['idInterno']]);
			
			header( 'Location: '.$location.'&deltarea=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'submit_itemizado_edit':		
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se traen todos los datos de la tarea
			$query = "SELECT 
			licitacion_listado_level_".$tablaitem.".Nombre, 
			licitacion_listado_level_".$tablaitem.".Codigo, 
			licitacion_listado_level_".$tablaitem.".idTrabajo,
			core_licitacion_trabajos.Nombre as Trabajo
			FROM `licitacion_listado_level_".$tablaitem."`
			LEFT JOIN `core_licitacion_trabajos`   ON core_licitacion_trabajos.idTrabajo   = licitacion_listado_level_".$tablaitem.".idTrabajo
			WHERE idLevel_".$tablaitem." = {$idItemizado}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			if ( empty($error) ) {

					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Item_Nombre']      = $rowdata['Nombre'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Item_Codigo']      = $rowdata['Codigo'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Item_Trabajo']     = $rowdata['Trabajo'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['idTrabajo']        = $rowdata['idTrabajo'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['idItemizado']      = $idItemizado;
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['tablaitem']        = $tablaitem;


					switch ($rowdata['idTrabajo']) {
						case 1: //Analisis
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Grasa_inicial']        = 0;
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Grasa_relubricacion']  = 0;
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Aceite']               = 0;
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Cantidad']             = 0;
									
						break;
						case 2: //Consumo de Materiales
									
						break;
						case 3: //Observacion
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Grasa_inicial']        = 0;
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Grasa_relubricacion']  = 0;
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Aceite']               = 0;
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Cantidad']             = 0;
									
						break;
					}
					
								
					header( 'Location: '.$location.'&edittarea=true' );
					die;
			}
				
		break;
/*******************************************************************************************************************/		
		case 'submit_producto_edit':		
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se traen todos los datos del producto
			$query = "SELECT 
			productos_listado.idProducto,
			productos_listado.Nombre AS Producto,
			sistema_productos_uml.Nombre AS Unimed,
			productos_listado.idUml
			FROM `productos_listado`
			LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
			WHERE productos_listado.idProducto = {$idProducto}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			if ( empty($error) ) {

					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['idProducto']  = $rowdata['idProducto'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['idUml']       = $rowdata['idUml'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Producto']    = $rowdata['Producto'];
					$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Unimed']      = $rowdata['Unimed'];
					
					
					
					switch ($idSubTipo) {
						case 1: //Grasa
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_t']         = 'Grasa Lub/Relub';
							if(isset($Grasa_inicial)&&$Grasa_inicial!='') {              
								$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Grasa_inicial']  = $Grasa_inicial;
								$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_1']         = $Grasa_inicial; 
							}
							if(isset($Grasa_relubricacion)&&$Grasa_relubricacion!='') {  
								$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Grasa_relubricacion']  = $Grasa_relubricacion;    
								$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_2']               = $Grasa_relubricacion;    
							}
							break;
							
						case 2: //Aceite
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Aceite'] = $Aceite; 
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_1'] = $Aceite; 
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_2'] = '';
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_t'] = 'Aceite';
							break;
							
						case 3: //Normal
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['Cantidad'] = $Cantidad;
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_1']   = $Cantidad;
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_2']   = '';
							$_SESSION['ot_trabajos_temp'][$tabla][$id_tabla][$idInterno]['data_t']   = 'Normal';
							break;
							
						case 4: //Otro
						   
							break;
					}

					
					header( 'Location: '.$location.'&edittarea=true' );
					die;
			}
				
		break;
/*******************************************************************************************************************/		
		case 'aprobar_trabajo':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
			/*********************************************************************/
			//variables
			$n_trabajos = 0;
			
			
			//Se verifica que los trabajos tengan datos asignados
			if (isset($_SESSION['ot_trabajos_temp'])){
				foreach ($_SESSION['ot_trabajos_temp'] as $key => $x_tabla){
					foreach ($x_tabla as $x_id_tabla) {
						foreach ($x_id_tabla as $x_idInterno) {
							if(!isset($x_idInterno['idItemizado']) or $x_idInterno['idItemizado'] == ''){   $error['idItemizado']   = 'error/No ha seleccionado un trabajo para el subcomponente';}
							if(!isset($x_idInterno['idSubTipo']) or $x_idInterno['idSubTipo'] == ''){       $error['idSubTipo']     = 'error/No ha seleccionado un tipo de subcomponente';}
							if(!isset($x_idInterno['id_tabla']) or $x_idInterno['id_tabla'] == ''){         $error['id_tabla']      = 'error/No ha seleccionado un subcomponente';}
							if(!isset($x_idInterno['tabla']) or $x_idInterno['tabla'] == ''){               $error['tabla']         = 'error/No ha seleccionado un subcomponente';}
							$n_trabajos++;
							//variable reseteada
							$n_grasa = 0;
							//Se revisa por tipo de trabajo
							if(!isset($x_idInterno['idTrabajo']) or $x_idInterno['idTrabajo'] == ''){               
								$error['idTrabajo'] = 'error/No ha seleccionado un trabajo';
							}else{
								switch ($x_idInterno['idTrabajo']) {
									case 1: //Analisis
												
									break;
									case 2: //Consumo de Materiales
										//verifico si en grasa tiene ambas cantidades guardadas
										if(isset($x_idInterno['Grasa_inicial']) && $x_idInterno['Grasa_inicial'] != '' && $x_idInterno['Grasa_inicial'] != 0){ $n_grasa++;}
										if(isset($x_idInterno['Grasa_relubricacion']) && $x_idInterno['Grasa_relubricacion'] != '' && $x_idInterno['Grasa_relubricacion'] != 0){ $n_grasa++;}
										//Se verifica si lubricacion y relubricacion estan activos
										if(isset($n_grasa)&&$n_grasa==2){
											$error['n_grasa2'] = 'error/Un punto de trabajo tiene lubricacion y relubricacion asignado simultaneamente';
										}
										//Se verifica si lubricacion y relubricacion estan activos
										if(isset($x_idInterno['idSubTipo']) && $x_idInterno['idSubTipo'] != ''&& $x_idInterno['idSubTipo'] ==1){
											if(isset($n_grasa)&&$n_grasa==0){
												$error['n_grasa0'] = 'error/Un punto de trabajo no tiene lubricacion o relubricacion asignado';
											}
										}		
									break;
									case 3: //Observacion
												
									break;
								}
							}	
						}
					}
				}
			}else{
				$error['trabajos'] = 'error/No tiene trabajos asignados a la orden de trabajo';
			}
			
			//Se verifica el minimo de trabajos
			if(isset($n_trabajos)&&$n_trabajos==0){
				$error['trabajos'] = 'error/No tiene trabajos asignados a la orden de trabajo';
			}	
			
			


			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos de la ot
				$query = "SELECT idSistema, idMaquina, idUsuario, idEstado, idPrioridad, idTipo,
				f_creacion,f_programacion 
				FROM `orden_trabajo_listado`
				WHERE idOT = {$_GET['view']}";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata = mysqli_fetch_assoc ($resultado);
			
				
				
				/*****************************************************/
				//Se guardan los trabajos a realizar
				if (isset($_SESSION['ot_trabajos_temp'])){
					foreach ($_SESSION['ot_trabajos_temp'] as $key => $x_tabla){
						foreach ($x_tabla as $x_id_tabla) {
							foreach ($x_id_tabla as $x_idInterno) {
								//filtros
								if(isset($_GET['view']) && $_GET['view'] != ''){                                               $a = "'".$_GET['view']."'" ;                                   }else{$a  = "''";}
								if(isset($rowdata['idSistema']) && $rowdata['idSistema'] != ''){                               $a .= ",'".$rowdata['idSistema']."'" ;                 }else{$a .= ",''";}
								if(isset($rowdata['idMaquina']) && $rowdata['idMaquina'] != ''){                               $a .= ",'".$rowdata['idMaquina']."'" ;                 }else{$a .= ",''";}
								if(isset($rowdata['idUsuario']) && $rowdata['idUsuario'] != ''){                               $a .= ",'".$rowdata['idUsuario']."'" ;                 }else{$a .= ",''";}
								if(isset($rowdata['idEstado']) && $rowdata['idEstado'] != ''){                                 $a .= ",'".$rowdata['idEstado']."'" ;                  }else{$a .= ",''";}
								if(isset($rowdata['idPrioridad']) && $rowdata['idPrioridad'] != ''){                           $a .= ",'".$rowdata['idPrioridad']."'" ;               }else{$a .= ",''";}
								if(isset($rowdata['idTipo']) && $rowdata['idTipo'] != ''){                                     $a .= ",'".$rowdata['idTipo']."'" ;                    }else{$a .= ",''";}
								if(isset($rowdata['f_creacion']) && $rowdata['f_creacion'] != ''){                             $a .= ",'".$rowdata['f_creacion']."'" ;                }else{$a .= ",''";}
								if(isset($rowdata['f_programacion']) && $rowdata['f_programacion'] != ''){                     $a .= ",'".$rowdata['f_programacion']."'" ;            }else{$a .= ",''";}
								if(isset($x_idInterno['id_tabla']) && $x_idInterno['id_tabla'] != ''){                         $a .= ",'".$x_idInterno['id_tabla']."'" ;              }else{$a .= ",''";}
								if(isset($x_idInterno['tabla']) && $x_idInterno['tabla'] != ''){                               $a .= ",'".$x_idInterno['tabla']."'" ;                 }else{$a .= ",''";}
								if(isset($x_idInterno['tabla_m_value']) && $x_idInterno['tabla_m_value'] != ''){               $a .= ",'".$x_idInterno['tabla_m_value']."'" ;         }else{$a .= ",''";}
								if(isset($x_idInterno['tabla_m']) && $x_idInterno['tabla_m'] != ''){                           $a .= ",'".$x_idInterno['tabla_m']."'" ;               }else{$a .= ",''";}
								if(isset($x_idInterno['idItemizado']) && $x_idInterno['idItemizado'] != ''){                   $a .= ",'".$x_idInterno['idItemizado']."'" ;           }else{$a .= ",''";}
								if(isset($x_idInterno['tablaitem']) && $x_idInterno['tablaitem'] != ''){                       $a .= ",'".$x_idInterno['tablaitem']."'" ;             }else{$a .= ",''";}
								if(isset($x_idInterno['idSubTipo']) && $x_idInterno['idSubTipo'] != ''){                       $a .= ",'".$x_idInterno['idSubTipo']."'" ;             }else{$a .= ",''";}
								if(isset($x_idInterno['idTrabajo']) && $x_idInterno['idTrabajo'] != ''){                       $a .= ",'".$x_idInterno['idTrabajo']."'" ;             }else{$a .= ",''";}
								if(isset($x_idInterno['idProducto']) && $x_idInterno['idProducto'] != ''){                     $a .= ",'".$x_idInterno['idProducto']."'" ;            }else{$a .= ",''";}
								if(isset($x_idInterno['idUml']) && $x_idInterno['idUml'] != ''){                               $a .= ",'".$x_idInterno['idUml']."'" ;                 }else{$a .= ",''";}
								if(isset($x_idInterno['Grasa_inicial']) && $x_idInterno['Grasa_inicial'] != ''){               $a .= ",'".$x_idInterno['Grasa_inicial']."'" ;         }else{$a .= ",''";}
								if(isset($x_idInterno['Grasa_relubricacion']) && $x_idInterno['Grasa_relubricacion'] != ''){   $a .= ",'".$x_idInterno['Grasa_relubricacion']."'" ;   }else{$a .= ",''";}
								if(isset($x_idInterno['Aceite']) && $x_idInterno['Aceite'] != ''){                             $a .= ",'".$x_idInterno['Aceite']."'" ;                }else{$a .= ",''";}
								if(isset($x_idInterno['Cantidad']) && $x_idInterno['Cantidad'] != ''){                         $a .= ",'".$x_idInterno['Cantidad']."'" ;              }else{$a .= ",''";}
								//Se guardan los nombres de los componentes
								if(isset($x_idInterno['Nombre']) && $x_idInterno['Nombre'] != ''){               $a .= ",'".$x_idInterno['Codigo'].' - '.$x_idInterno['Nombre']."'" ;                 }else{$a .= ",''";}
								if(isset($x_idInterno['Item_Nombre']) && $x_idInterno['Item_Nombre'] != ''){     $a .= ",'".$x_idInterno['Item_Trabajo'].': '.$x_idInterno['Item_Codigo'].' - '.$x_idInterno['Item_Nombre']."'" ;  }else{$a .= ",''";}
								//Se agrega el dato de la observacion
								$a .= ",'Sin Observaciones'" ; 
								//Se guarda la licitacion
								if(isset($x_idInterno['idLicitacion']) && $x_idInterno['idLicitacion'] != ''){     $a .= ",'".$x_idInterno['idLicitacion']."'" ;  }else{$a .= ",''";}
								 
								// inserto los datos de registro en la db
								$query  = "INSERT INTO `orden_trabajo_listado_trabajos` (idOT, idSistema, idMaquina, idUsuario, idEstado, idPrioridad,
								idTipo, f_creacion, f_programacion, comp_tabla_id, comp_tabla, item_m_tabla_id, item_m_tabla, item_tabla_id, item_tabla,
								idSubTipo, idTrabajo, idProducto, idUml, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad, NombreComponente, NombreTrabajo, 
								Observacion, idLicitacion) 
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
				
			
				/*****************************************************/
				//Borro todas las sesiones una vez grabados los datos
				unset($_SESSION['ot_trabajos_temp']);
			
				header( 'Location: '.$location.'&addtarea=true' );
				die;
				
			}	
	

		break;		
/*******************************************************************************************************************/		
		case 'submit_editTrabajo':		
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 1;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($idAnalisis)){
				$ndata_1 = db_select_nrows ('idAnalisis', 'analisis_listado', '', "idAnalisis='".$idAnalisis."'", $dbConn);
			}
			if(isset($idAnalisis)&&isset($idOT)){
				$ndata_2 = db_select_nrows ('idOT', 'analisis_listado', '', "idAnalisis='".$idAnalisis."' AND idOT!='".$idOT."'", $dbConn);
				$rowan   = db_select_data ('idOT', 'analisis_listado', '', "idAnalisis='".$idAnalisis."' AND idOT!='".$idOT."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 == 0) {$error['ndata_1'] = 'error/El Analisis que esta tratando de ingresar no existe';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Analisis que esta tratando de ingresar fue utilizado en la OT N° '.$rowan['idOT'];}
			/*******************************************************************/
			
			if ( empty($error) ) {

				//filtros
				$a = "idTrabajoOT='".$idInterno."'" ;
				if(isset($idAnalisis) && $idAnalisis != ''){     $a .= ",idAnalisis='".$idAnalisis."'" ;}
				if(isset($Observacion) && $Observacion != ''){   $a .= ",Observacion='".$Observacion."'" ;}
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `orden_trabajo_listado_trabajos` SET ".$a." WHERE idTrabajoOT = '$idInterno'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					/******************************************************************/
					//Guardo el numero de la OT en el analisis
					if(isset($idAnalisis)){
						$a = "idAnalisis='".$idAnalisis."'" ;
						if(isset($idOT) && $idOT != ''){   $a .= ",idOT='".$idOT."'" ;}

						// inserto los datos de registro en la db
						$query  = "UPDATE `analisis_listado` SET ".$a." WHERE idAnalisis = '$idAnalisis'";
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
						
					header( 'Location: '.$location.'&edittarea=true' );
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
		case 'cerrar_ot':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			/*********************************************************************/
			//Se traen los datos de la OT
			$query = "SELECT 
			orden_trabajo_listado.idSistema, 
			orden_trabajo_listado.idMaquina, 
			orden_trabajo_listado.idUsuario, 
			orden_trabajo_listado.idEstado, 
			orden_trabajo_listado.idPrioridad, 
			orden_trabajo_listado.idTipo,
			orden_trabajo_listado.f_creacion, 
			orden_trabajo_listado.f_programacion, 
			orden_trabajo_listado.f_termino, 
			orden_trabajo_listado.idSupervisor,
			core_sistemas.OT_idBodegaProd,
			core_sistemas.OT_idBodegaIns
			
			FROM `orden_trabajo_listado`
			LEFT JOIN `core_sistemas`   ON core_sistemas.idSistema   = orden_trabajo_listado.idSistema
			WHERE idOT = {$_GET['view']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//Se verifican los datos basicos
			if(!isset($rowdata['idSistema']) or $rowdata['idSistema']=='' or $rowdata['idSistema']==0){                            $error['idSistema']        = 'error/No ha ingresado el id del sistema';}
			if(!isset($rowdata['idMaquina']) or $rowdata['idMaquina']=='' or $rowdata['idMaquina']==0){                            $error['idMaquina']        = 'error/No ha seleccionado la maquina';}
			if(!isset($rowdata['idUsuario']) or $rowdata['idUsuario']=='' or $rowdata['idUsuario']==0){                            $error['idUsuario']        = 'error/No ha ingresado el id del usuario';}
			if(!isset($rowdata['idEstado']) or $rowdata['idEstado']=='' or $rowdata['idEstado']==0){                               $error['idEstado']         = 'error/No ha ingresado el id del estado';}
			if(!isset($rowdata['idPrioridad']) or $rowdata['idPrioridad']=='' or $rowdata['idPrioridad']==0){                      $error['idPrioridad']      = 'error/No ha seleccionado la prioridad';}
			if(!isset($rowdata['idTipo']) or $rowdata['idTipo']=='' or $rowdata['idTipo']==0){                                     $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
			if(!isset($rowdata['f_creacion']) or $rowdata['f_creacion']=='' or $rowdata['f_creacion']=='0000-00-00'){              $error['f_creacion']       = 'error/No ha ingresado la fecha de creacion';}
			if(!isset($rowdata['f_programacion']) or $rowdata['f_programacion']=='' or $rowdata['f_programacion']=='0000-00-00'){  $error['f_programacion']   = 'error/No ha ingresado la fecha de programacion';}
			if(!isset($rowdata['f_termino']) or $rowdata['f_termino']=='' or $rowdata['f_termino']=='0000-00-00'){                 $error['f_termino']        = 'error/No ha ingresado la fecha de termino';}
			if(!isset($rowdata['idSupervisor']) or $rowdata['idSupervisor']=='' or $rowdata['idSupervisor']==0){                   $error['idSupervisor']     = 'error/No ha seleccionado el supervisor';}
				
			/*********************************************************************/
			//Se traen a todos los trabajadores relacionados a las ot
			$arrTrabajadores = array();
			$query = "SELECT idTrabajador
			FROM `orden_trabajo_listado_responsable`
			WHERE idOT = {$_GET['view']}";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrTrabajadores,$row );
			}
			//variables
			$n_trabajadores = 0;
			//Se verifica que tenga trabajadores asignados
			foreach ($arrTrabajadores as $trabajador){
				if(!isset($trabajador['idTrabajador']) or $trabajador['idTrabajador'] == '' or $trabajador['idTrabajador'] == 0){  $error['idTrabajador']   = 'error/No ha ingresado un trabajador';}
				$n_trabajadores++;
			}
			//Se verifica el minimo de trabajadores
			if(isset($n_trabajadores)&&$n_trabajadores==0){
				$error['trabajos'] = 'error/No tiene trabajadores asignados a la orden de trabajo';
			}
			/*********************************************************************/
			// Se trae un listado con todos los trabajos relacionados a la orden
			$arrTrabajo = array();
			$query = "SELECT idTrabajoOT, idSubTipo, comp_tabla_id, comp_tabla, idTrabajo,
			idAnalisis, idProducto, idUml, Grasa_inicial, Grasa_relubricacion, Aceite, Cantidad,
			item_m_tabla_id, item_m_tabla, Observacion 
			FROM `orden_trabajo_listado_trabajos`
			WHERE idOT = {$_GET['view']} ";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrTrabajo,$row );
			}
			//variables
			$n_trabajos = 0;
			//Se verifica que los trabajos tengan datos asignados
			foreach ($arrTrabajo as $trab){
				if(!isset($trab['idTrabajoOT']) or $trab['idTrabajoOT'] == '' or $trab['idTrabajoOT'] == 0){              $error['idTrabajoOT']      = 'error/No ha seleccionado un trabajo para el subcomponente';}
				if(!isset($trab['idSubTipo']) or $trab['idSubTipo'] == '' or $trab['idSubTipo'] == 0){                    $error['idSubTipo']        = 'error/No ha seleccionado un tipo de subcomponente';}
				if(!isset($trab['comp_tabla_id']) or $trab['comp_tabla_id'] == '' or $trab['comp_tabla_id'] == 0){        $error['comp_tabla_id']    = 'error/No ha seleccionado un subcomponente';}
				if(!isset($trab['comp_tabla']) or $trab['comp_tabla'] == '' or $trab['comp_tabla'] == 0){                 $error['comp_tabla']       = 'error/No ha seleccionado un subcomponente';}
				if(!isset($trab['item_m_tabla_id']) or $trab['item_m_tabla_id'] == '' or $trab['item_m_tabla_id'] == 0){  $error['item_m_tabla_id']  = 'error/No ha seleccionado un subcomponente';}
				if(!isset($trab['item_m_tabla']) or $trab['item_m_tabla'] == '' or $trab['item_m_tabla'] == 0){           $error['item_m_tabla']     = 'error/No ha seleccionado un subcomponente';}
				$n_trabajos++;
				//variable reseteada
				$n_grasa = 0;
				//Se revisa por tipo de trabajo
				if(!isset($trab['idTrabajo']) or $trab['idTrabajo'] == '' or $trab['idTrabajo'] == 0){               
					$error['idTrabajo'] = 'error/No ha seleccionado un trabajo';
				}else{	
					switch ($trab['idTrabajo']) {
						case 1: //Analisis
							if(!isset($trab['idAnalisis']) or $trab['idAnalisis'] == '' or $trab['idAnalisis'] == 0){   $error['idAnalisis'] = 'error/No ha ingresado un analisis';}
						break;
						case 2: //Consumo de Materiales
							if(!isset($trab['idProducto']) or $trab['idProducto'] == '' or $trab['idProducto'] == ''){ $error['idProducto'] = 'error/No ha seleccionado un producto';}
							if(!isset($trab['idUml']) or $trab['idUml'] == '' or $trab['idUml'] == ''){                $error['idUml']      = 'error/No ha seleccionado una unidad de medida';}
							//verifico si en grasa tiene ambas cantidades guardadas
							if(isset($trab['Grasa_inicial']) && $trab['Grasa_inicial'] != '' && $trab['Grasa_inicial'] != 0){ $n_grasa++;}
							if(isset($trab['Grasa_relubricacion']) && $trab['Grasa_relubricacion'] != '' && $trab['Grasa_relubricacion'] != 0){ $n_grasa++;}
							//Se verifica si lubricacion y relubricacion estan activos
							if(isset($n_grasa)&&$n_grasa==2){
								$error['n_grasa2'] = 'error/Un punto de trabajo tiene lubricacion y relubricacion asignado simultaneamente';
							}
							switch ($trab['idSubTipo']) {
								case 1: //Grasa
									if(isset($n_grasa)&&$n_grasa==0){
										$error['n_grasa0'] = 'error/Un punto de trabajo no tiene lubricacion o relubricacion asignado';
									}
								break;
								case 2: //Aceite
									if(!isset($trab['Aceite']) or $trab['Aceite'] == '' or $trab['Aceite'] == 0){   $error['Aceite'] = 'error/No ha ingresado una cantidad de aceite';}
								break;
								case 3: //Normal
									if(!isset($trab['Cantidad']) or $trab['Cantidad'] == '' or $trab['Cantidad'] == 0){   $error['Cantidad'] = 'error/No ha ingresado una cantidad';}
								break;
								case 4: //Otro
								
								break;
							}
		
						break;
						case 3: //Observacion
							if(!isset($trab['Observacion']) or $trab['Observacion'] == '' ){   $error['Observacion'] = 'error/No ha ingresado una observacion';}
						break;
					}
				}	
			}
			//Se verifica el minimo de trabajos
			if(isset($n_trabajos)&&$n_trabajos==0){
				$error['trabajos'] = 'error/No tiene trabajos asignados a la orden de trabajo';
			}
			/*********************************************************************/
			// Se trae un listado con todos los trabajos relacionados a la orden y si existen materiales para hacerlo
			$arrConsumosOT = array();
			$query = "SELECT
			orden_trabajo_listado_trabajos.idSubTipo,
			orden_trabajo_listado_trabajos.NombreComponente,
			orden_trabajo_listado_trabajos.NombreTrabajo,
			SUM(orden_trabajo_listado_trabajos.Grasa_inicial) AS sum_ginicial,
			SUM(orden_trabajo_listado_trabajos.Grasa_relubricacion) AS sum_grelu,
			SUM(orden_trabajo_listado_trabajos.Aceite) AS sum_aceite,
			SUM(orden_trabajo_listado_trabajos.Cantidad) AS sum_cantidad,
			orden_trabajo_listado_trabajos.idProducto,
			licitacion_listado.idBodegaProd,
			licitacion_listado.idBodegaIns,
			productos_listado.Nombre AS NombreProducto,
			(SELECT SUM(Cantidad_ing) FROM bodegas_productos_facturacion_existencias  WHERE idProducto = orden_trabajo_listado_trabajos.idProducto AND idBodega=licitacion_listado.idBodegaProd LIMIT 1) AS BodegaProdIngresos,
			(SELECT SUM(Cantidad_eg)  FROM bodegas_productos_facturacion_existencias  WHERE idProducto = orden_trabajo_listado_trabajos.idProducto AND idBodega=licitacion_listado.idBodegaProd LIMIT 1) AS BodegaProdEgresos
			
			FROM `orden_trabajo_listado_trabajos`
			LEFT JOIN `licitacion_listado`  ON licitacion_listado.idLicitacion   = orden_trabajo_listado_trabajos.idLicitacion
			LEFT JOIN `productos_listado`   ON productos_listado.idProducto      = orden_trabajo_listado_trabajos.idProducto
			WHERE orden_trabajo_listado_trabajos.idOT = {$_GET['view']} 
			GROUP BY orden_trabajo_listado_trabajos.idLicitacion, orden_trabajo_listado_trabajos.idProducto";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrConsumosOT,$row );
			}
			//Se verifica que los trabajos tengan datos asignados
			foreach ($arrConsumosOT as $trab){
				if(!isset($trab['idBodegaProd']) or $trab['idBodegaProd'] == '' or $trab['idBodegaProd'] == 0){   $error['idTrabajoOT']      = 'error/El Componente '.$trab['NombreComponente'].' con el trabajo '.$trab['NombreTrabajo'].', la licitacion relacionada no posee una bodega de productos asignada';}
				if(!isset($trab['idBodegaIns']) or $trab['idBodegaIns'] == '' or $trab['idBodegaIns'] == 0){      $error['idTrabajoOT']      = 'error/El Componente '.$trab['NombreComponente'].' con el trabajo '.$trab['NombreTrabajo'].', la licitacion relacionada no posee una bodega de insumos asignada';}
				//Se revisa si existe la cantidad sificiente de materiales
				switch ($trab['idSubTipo']) {
					case 1: $valor = $trab['sum_ginicial']+$trab['sum_grelu']; break;   //Grasa
					case 2: $valor = $trab['sum_aceite']; break;                        //Aceite
					case 3: $valor = $trab['sum_cantidad']; break;                      //Normal
				}		
				//Realizo las operaciones
				$ingreso = $trab['BodegaProdIngresos'];
				$egreso  = $trab['BodegaProdEgresos'] + $valor;
				$total   = $trab['BodegaProdIngresos'] - $trab['BodegaProdEgresos'];
				//condiciono el error
				if($ingreso < $egreso){
					$error['productos1'] = 'error/No hay suficientes '.$trab['NombreProducto'].', en bodega solo hay '.$total.' y necesitas '.$valor;	
				}	
			}
			/*********************************************************************/
			//Se verifica el stock de productos de la bodega de productos	
			$arrProdCons = array();
			$query = "SELECT
			SUM(orden_trabajo_listado_productos.Cantidad) AS Cantidad,
			orden_trabajo_listado_productos.idProducto,
			productos_listado.Nombre AS NombreProducto,
			core_sistemas.OT_idBodegaProd,
			(SELECT SUM(Cantidad_ing) FROM bodegas_productos_facturacion_existencias  WHERE idProducto = orden_trabajo_listado_productos.idProducto AND idBodega=core_sistemas.OT_idBodegaProd LIMIT 1) AS BodegaProdIngresos,
			(SELECT SUM(Cantidad_eg)  FROM bodegas_productos_facturacion_existencias  WHERE idProducto = orden_trabajo_listado_productos.idProducto AND idBodega=core_sistemas.OT_idBodegaProd LIMIT 1) AS BodegaProdEgresos
			
			FROM `orden_trabajo_listado_productos`
			LEFT JOIN `productos_listado`   ON productos_listado.idProducto      = orden_trabajo_listado_productos.idProducto
			LEFT JOIN `core_sistemas`       ON core_sistemas.idSistema           = orden_trabajo_listado_productos.idSistema
			WHERE orden_trabajo_listado_productos.idOT = {$_GET['view']} 
			GROUP BY orden_trabajo_listado_productos.idProducto";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrTrabajo,$row );
			}
			//Verifico resultados
			$xan = 0;
			foreach ($arrProdCons as $trab){
				$xan++;
			}
			//Se verifica que los trabajos tengan datos asignados
			if($xan!=0){
				foreach ($arrProdCons as $trab){
					if(!isset($trab['OT_idBodegaProd']) or $trab['OT_idBodegaProd'] == '' or $trab['OT_idBodegaProd'] == 0){   $error['idTrabajoOT']      = 'error/La empresa no tiene una bodega de productos asignada a la OT';}		
					//Realizo las operaciones
					$ingreso = $trab['BodegaProdIngresos'];
					$egreso  = $trab['BodegaProdEgresos'] + $trab['Cantidad'];
					$total   = $trab['BodegaProdIngresos'] - $trab['BodegaProdEgresos'];
					//condiciono el error
					if($ingreso < $egreso){
						$error['productos2'] = 'error/No hay suficientes '.$trab['NombreProducto'].', en bodega solo hay '.$total.' y necesitas '.$trab['Cantidad'];	
					}	
				}
			}
			/*********************************************************************/
			//Se verifica el stock de productos de la bodega de insumos	
			$arrInsCons = array();
			$query = "SELECT
			SUM(orden_trabajo_listado_insumos.Cantidad) AS Cantidad,
			orden_trabajo_listado_insumos.idProducto,
			insumos_listado.Nombre AS NombreProducto,
			core_sistemas.OT_idBodegaIns,
			(SELECT SUM(Cantidad_ing) FROM bodegas_insumos_facturacion_existencias  WHERE idProducto = orden_trabajo_listado_insumos.idProducto AND idBodega=core_sistemas.OT_idBodegaIns LIMIT 1) AS BodegaProdIngresos,
			(SELECT SUM(Cantidad_eg)  FROM bodegas_insumos_facturacion_existencias  WHERE idProducto = orden_trabajo_listado_insumos.idProducto AND idBodega=core_sistemas.OT_idBodegaIns LIMIT 1) AS BodegaProdEgresos
			
			FROM `orden_trabajo_listado_insumos`
			LEFT JOIN `insumos_listado`     ON insumos_listado.idProducto        = orden_trabajo_listado_insumos.idProducto
			LEFT JOIN `core_sistemas`       ON core_sistemas.idSistema           = orden_trabajo_listado_insumos.idSistema
			WHERE orden_trabajo_listado_insumos.idOT = {$_GET['view']} 
			GROUP BY orden_trabajo_listado_insumos.idProducto";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrInsCons,$row );
			}
			//Verifico resultados
			$xan = 0;
			foreach ($arrInsCons as $trab){
				$xan++;
			}
			//Se verifica que los trabajos tengan datos asignados
			if($xan!=0){
				foreach ($arrInsCons as $trab){
					if(!isset($trab['OT_idBodegaIns']) or $trab['OT_idBodegaIns'] == '' or $trab['OT_idBodegaIns'] == 0){   $error['idTrabajoOT']      = 'error/La empresa no tiene una bodega de productos asignada a la OT';}		
					//Realizo las operaciones
					$ingreso = $trab['BodegaProdIngresos'];
					$egreso  = $trab['BodegaProdEgresos'] + $trab['Cantidad'];
					$total   = $trab['BodegaProdIngresos'] - $trab['BodegaProdEgresos'];
					//condiciono el error
					if($ingreso < $egreso){
						$error['productos3'] = 'error/No hay suficientes '.$trab['NombreProducto'].', en bodega solo hay '.$total.' y necesitas '.$trab['Cantidad'];	
					}	
				}
			}


			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*************************************************************************/
				//Se actualizan los estados de todos los registros
				//filtros
				$a = "idEstado='2'" ;
				if(isset($rowdata['idSistema']) && $rowdata['idSistema']=='' && $rowdata['idSistema']==0){                            $a .= ",idAnalisis='".$rowdata['idSistema']."'" ;}
				if(isset($rowdata['idMaquina']) && $rowdata['idMaquina']=='' && $rowdata['idMaquina']==0){                            $a .= ",idMaquina='".$rowdata['idMaquina']."'" ;}
				if(isset($rowdata['idUsuario']) && $rowdata['idUsuario']=='' && $rowdata['idUsuario']==0){                            $a .= ",idUsuario='".$rowdata['idUsuario']."'" ;}
				if(isset($rowdata['idPrioridad']) && $rowdata['idPrioridad']=='' && $rowdata['idPrioridad']==0){                      $a .= ",idPrioridad='".$rowdata['idPrioridad']."'" ;}
				if(isset($rowdata['idTipo']) && $rowdata['idTipo']=='' && $rowdata['idTipo']==0){                                     $a .= ",idTipo='".$rowdata['idTipo']."'" ;}
				if(isset($rowdata['f_creacion']) && $rowdata['f_creacion']=='' && $rowdata['f_creacion']=='0000-00-00'){              $a .= ",f_creacion='".$rowdata['f_creacion']."'" ;}
				if(isset($rowdata['f_programacion']) && $rowdata['f_programacion']=='' && $rowdata['f_programacion']=='0000-00-00'){  $a .= ",f_programacion='".$rowdata['f_programacion']."'" ;}
				if(isset($rowdata['f_termino']) && $rowdata['f_termino']=='' && $rowdata['f_termino']=='0000-00-00'){                 $a .= ",f_termino='".$rowdata['f_termino']."'" ;}
				
				// Actualizo la tabla principal
				$query  = "UPDATE `orden_trabajo_listado` SET ".$a." WHERE idOT = '{$_GET['view']}'";
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
				
				// Actualizo los insumos
				$query  = "UPDATE `orden_trabajo_listado_insumos` SET ".$a." WHERE idOT = '{$_GET['view']}'";
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
				
				// Actualizo los productos
				$query  = "UPDATE `orden_trabajo_listado_productos` SET ".$a." WHERE idOT = '{$_GET['view']}'";
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
				
				// Actualizo los trabajadores
				$query  = "UPDATE `orden_trabajo_listado_responsable` SET ".$a." WHERE idOT = '{$_GET['view']}'";
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
				
				// Actualizo los trabajos
				$query  = "UPDATE `orden_trabajo_listado_trabajos` SET ".$a." WHERE idOT = '{$_GET['view']}'";
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
				
				/*********************************************************************/
				// Se actualizan los analisis utilizados
				$arrAnalisis = array();
				$query = "SELECT idAnalisis
				FROM `orden_trabajo_listado_trabajos`
				WHERE idOT = {$_GET['view']} AND idAnalisis!=0 AND idTrabajo=1";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrAnalisis,$row );
				}
				//Se actualizan los registros
				foreach ($arrAnalisis as $trab){
					if(isset($trab['idAnalisis']) && $trab['idAnalisis'] == '' && $trab['idAnalisis'] == 0){  
						$query  = "UPDATE `analisis_listado` SET idOT = '{$_GET['view']}' WHERE idAnalisis = '{$trab['idAnalisis']}'";
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
				
				/*************************************************************************/
				/*************************************************************************/
				
				$Observaciones  = 'Consumo de materiales desde la OT '.$_GET['view'] ;
				$idTipo         = 7;
				$fecha_auto     = fecha_actual();
				
				/*********************************************************************/
				//Se Se verifica que exista bodega y que existan consumos
				if($arrProdCons&&isset($rowdata['OT_idBodegaProd']) && $rowdata['OT_idBodegaProd'] != ''){    
					$a  = "'".$rowdata['OT_idBodegaProd']."'" ;  
					if(isset($_GET['view']) && $_GET['view'] != ''){                  $a .= ",'".$_GET['view']."'" ;            }else{$a .= ",''";}
					if(isset($Observaciones) && $Observaciones != ''){                $a .= ",'".$Observaciones."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['idSistema']) && $rowdata['idSistema'] != ''){  $a .= ",'".$rowdata['idSistema']."'" ;    }else{$a .= ",''";}
					if(isset($rowdata['idUsuario']) && $rowdata['idUsuario'] != ''){  $a .= ",'".$rowdata['idUsuario']."'" ;    }else{$a .= ",''";}
					if(isset($idTipo) && $idTipo != ''){                              $a .= ",'".$idTipo."'" ;                  }else{$a .= ",''";}
					if(isset($rowdata['f_termino']) && $rowdata['f_termino'] != ''){  
						$a .= ",'".$rowdata['f_termino']."'" ;  
						$a .= ",'".fecha2NMes($rowdata['f_termino'])."'" ;
						$a .= ",'".fecha2Ano($rowdata['f_termino'])."'" ;
					}else{
						$a .= ",''";
						$a .= ",''";
						$a .= ",''";
					}
					if(isset($fecha_auto) && $fecha_auto != ''){    $a .= ",'".$fecha_auto."'" ;   }else{$a .= ",''";}

					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_productos_facturacion` (idBodegaOrigen, idOT, Observaciones, idSistema, 
					idUsuario, idTipo, Creacion_fecha, Creacion_mes, Creacion_ano, fecha_auto) 
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
				
						/*********************************************************************/
						//Se guardan los datos 		
						foreach ($arrProdCons as $trab){

							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                    $a  = "'".$ultimo_id."'" ;                     }else{$a  = "''";}
							if(isset($_GET['view']) && $_GET['view'] != ''){                              $a .= ",'".$_GET['view']."'" ;                 }else{$a .= ",''";}
							if(isset($rowdata['OT_idBodegaProd']) && $rowdata['OT_idBodegaProd'] != ''){  $a .= ",'".$rowdata['OT_idBodegaProd']."'" ;   }else{$a .= ",''";}
							if(isset($rowdata['idSistema']) && $rowdata['idSistema'] != ''){              $a .= ",'".$rowdata['idSistema']."'" ;         }else{$a .= ",''";}
							if(isset($rowdata['idUsuario']) && $rowdata['idUsuario'] != ''){              $a .= ",'".$rowdata['idUsuario']."'" ;         }else{$a .= ",''";}
							if(isset($rowdata['f_termino']) && $rowdata['f_termino'] != ''){  
								$a .= ",'".$rowdata['f_termino']."'" ;  
								$a .= ",'".fecha2NMes($rowdata['f_termino'])."'" ;
								$a .= ",'".fecha2Ano($rowdata['f_termino'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($idTipo) && $idTipo != ''){                             $a .= ",'".$idTipo."'" ;                }else{$a .= ",''";}
							if(isset($trab['idProducto']) && $trab['idProducto'] != ''){     $a .= ",'".$trab['idProducto']."'" ;    }else{$a .= ",''";}
							if(isset($trab['Cantidad']) && $trab['Cantidad'] != ''){         $a .= ",'".$trab['Cantidad']."'" ;      }else{$a .= ",''";}
							if(isset($fecha_auto) && $fecha_auto != ''){                     $a .= ",'".$fecha_auto."'" ;            }else{$a .= ",''";}
						
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_productos_facturacion_existencias` (idFacturacion, idOT, idBodega, 
							idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano,  idTipo, idProducto, 
							Cantidad_eg, fecha_auto) 
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
				/*********************************************************************/
				//Se Se verifica que exista bodega y que existan consumos
				if($arrInsCons&&isset($rowdata['OT_idBodegaIns']) && $rowdata['OT_idBodegaIns'] != ''){    
					$a  = "'".$rowdata['OT_idBodegaIns']."'" ;  
					if(isset($_GET['view']) && $_GET['view'] != ''){                  $a .= ",'".$_GET['view']."'" ;            }else{$a .= ",''";}
					if(isset($Observaciones) && $Observaciones != ''){                $a .= ",'".$Observaciones."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['idSistema']) && $rowdata['idSistema'] != ''){  $a .= ",'".$rowdata['idSistema']."'" ;    }else{$a .= ",''";}
					if(isset($rowdata['idUsuario']) && $rowdata['idUsuario'] != ''){  $a .= ",'".$rowdata['idUsuario']."'" ;    }else{$a .= ",''";}
					if(isset($idTipo) && $idTipo != ''){                              $a .= ",'".$idTipo."'" ;                  }else{$a .= ",''";}
					if(isset($rowdata['f_termino']) && $rowdata['f_termino'] != ''){  
						$a .= ",'".$rowdata['f_termino']."'" ;  
						$a .= ",'".fecha2NMes($rowdata['f_termino'])."'" ;
						$a .= ",'".fecha2Ano($rowdata['f_termino'])."'" ;
					}else{
						$a .= ",''";
						$a .= ",''";
						$a .= ",''";
					}
					if(isset($fecha_auto) && $fecha_auto != ''){    $a .= ",'".$fecha_auto."'" ;   }else{$a .= ",''";}

					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion` (idBodegaOrigen, idOT, Observaciones, idSistema, 
					idUsuario, idTipo, Creacion_fecha, Creacion_mes, Creacion_ano, fecha_auto) 
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
				
						/*********************************************************************/
						//Se guardan los datos 		
						foreach ($arrInsCons as $trab){

							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                    $a  = "'".$ultimo_id."'" ;                     }else{$a  = "''";}
							if(isset($_GET['view']) && $_GET['view'] != ''){                              $a .= ",'".$_GET['view']."'" ;                 }else{$a .= ",''";}
							if(isset($rowdata['OT_idBodegaIns']) && $rowdata['OT_idBodegaIns'] != ''){    $a .= ",'".$rowdata['OT_idBodegaIns']."'" ;    }else{$a .= ",''";}
							if(isset($rowdata['idSistema']) && $rowdata['idSistema'] != ''){              $a .= ",'".$rowdata['idSistema']."'" ;         }else{$a .= ",''";}
							if(isset($rowdata['idUsuario']) && $rowdata['idUsuario'] != ''){              $a .= ",'".$rowdata['idUsuario']."'" ;         }else{$a .= ",''";}
							if(isset($rowdata['f_termino']) && $rowdata['f_termino'] != ''){  
								$a .= ",'".$rowdata['f_termino']."'" ;  
								$a .= ",'".fecha2NMes($rowdata['f_termino'])."'" ;
								$a .= ",'".fecha2Ano($rowdata['f_termino'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($idTipo) && $idTipo != ''){                             $a .= ",'".$idTipo."'" ;                }else{$a .= ",''";}
							if(isset($trab['idProducto']) && $trab['idProducto'] != ''){     $a .= ",'".$trab['idProducto']."'" ;    }else{$a .= ",''";}
							if(isset($trab['Cantidad']) && $trab['Cantidad'] != ''){         $a .= ",'".$trab['Cantidad']."'" ;      }else{$a .= ",''";}
							if(isset($fecha_auto) && $fecha_auto != ''){                     $a .= ",'".$fecha_auto."'" ;            }else{$a .= ",''";}
						
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idOT, idBodega, 
							idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano,  idTipo, idProducto, 
							Cantidad_eg, fecha_auto) 
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
				
				
			
				header( 'Location: orden_trabajo_terminar.php?terminated=true' );
				die;
				
			}	
	

		break;		
		
						
/*******************************************************************************************************************/
	}
?>
