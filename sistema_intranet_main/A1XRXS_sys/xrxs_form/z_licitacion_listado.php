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

	//Formulario para licitaciones
	if ( !empty($_POST['idLicitacion']) )        $idLicitacion         = $_POST['idLicitacion'];
	if ( !empty($_POST['idSistema']) )           $idSistema            = $_POST['idSistema'];
	if ( !empty($_POST['Codigo']) )              $Codigo               = $_POST['Codigo'];
	if ( !empty($_POST['Nombre']) )              $Nombre               = $_POST['Nombre'];
	if ( !empty($_POST['FechaInicio']) )         $FechaInicio          = $_POST['FechaInicio'];
	if ( !empty($_POST['FechaTermino']) )        $FechaTermino         = $_POST['FechaTermino'];
	if ( isset($_POST['Presupuesto']) )          $Presupuesto          = $_POST['Presupuesto'];
	if ( !empty($_POST['idEstado']) )            $idEstado             = $_POST['idEstado'];
	if ( !empty($_POST['idBodegaProd']) )        $idBodegaProd         = $_POST['idBodegaProd'];
	if ( !empty($_POST['idBodegaIns']) )         $idBodegaIns          = $_POST['idBodegaIns'];
	if ( !empty($_POST['idAprobado']) )          $idAprobado           = $_POST['idAprobado'];
	if ( !empty($_POST['idCliente']) )           $idCliente            = $_POST['idCliente'];
	if ( !empty($_POST['idTipoLicitacion']) )    $idTipoLicitacion     = $_POST['idTipoLicitacion'];
	if ( isset($_POST['ValorMensual']) )         $ValorMensual         = $_POST['ValorMensual'];
	if ( !empty($_POST['idOpcionItem']) )        $idOpcionItem         = $_POST['idOpcionItem'];
	
	if ( !empty($_POST['idUtilizable']) )        $idUtilizable         = $_POST['idUtilizable'];
	if ( isset($_POST['idFrecuencia']) )         $idFrecuencia         = $_POST['idFrecuencia'];
	if ( isset($_POST['Cantidad']) )             $Cantidad             = $_POST['Cantidad'];
	if ( isset($_POST['Valor']) )                $Valor                = $_POST['Valor'];
	if ( isset($_POST['ValorTotal']) )           $ValorTotal           = $_POST['ValorTotal'];
	if ( !empty($_POST['TiempoProgramado']) )    $TiempoProgramado     = $_POST['TiempoProgramado'];
	if ( !empty($_POST['idTrabajo']) )           $idTrabajo            = $_POST['idTrabajo'];
	
	
	if ( !empty($_POST['lvl']) )                 $lvl                  = $_POST['lvl'];
	
	
	
	//formulariopara el itemizado
	//Traspaso de valores input a variables
	$idLevel = array();
	if ( !empty($_POST['idLevel_1']) )      $idLevel[1]      = $_POST['idLevel_1'];
	if ( !empty($_POST['idLevel_2']) )      $idLevel[2]      = $_POST['idLevel_2'];
	if ( !empty($_POST['idLevel_3']) )      $idLevel[3]      = $_POST['idLevel_3'];
	if ( !empty($_POST['idLevel_4']) )      $idLevel[4]      = $_POST['idLevel_4'];
	if ( !empty($_POST['idLevel_5']) )      $idLevel[5]      = $_POST['idLevel_5'];
	if ( !empty($_POST['idLevel_6']) )      $idLevel[6]      = $_POST['idLevel_6'];
	if ( !empty($_POST['idLevel_7']) )      $idLevel[7]      = $_POST['idLevel_7'];
	if ( !empty($_POST['idLevel_8']) )      $idLevel[8]      = $_POST['idLevel_8'];
	if ( !empty($_POST['idLevel_9']) )      $idLevel[9]      = $_POST['idLevel_9'];
	if ( !empty($_POST['idLevel_10']) )     $idLevel[10]     = $_POST['idLevel_10'];
	if ( !empty($_POST['idLevel_11']) )     $idLevel[11]     = $_POST['idLevel_11'];
	if ( !empty($_POST['idLevel_12']) )     $idLevel[12]     = $_POST['idLevel_12'];
	if ( !empty($_POST['idLevel_13']) )     $idLevel[13]     = $_POST['idLevel_13'];
	if ( !empty($_POST['idLevel_14']) )     $idLevel[14]     = $_POST['idLevel_14'];
	if ( !empty($_POST['idLevel_15']) )     $idLevel[15]     = $_POST['idLevel_15'];
	if ( !empty($_POST['idLevel_16']) )     $idLevel[16]     = $_POST['idLevel_16'];
	if ( !empty($_POST['idLevel_17']) )     $idLevel[17]     = $_POST['idLevel_17'];
	if ( !empty($_POST['idLevel_18']) )     $idLevel[18]     = $_POST['idLevel_18'];
	if ( !empty($_POST['idLevel_19']) )     $idLevel[19]     = $_POST['idLevel_19'];
	if ( !empty($_POST['idLevel_20']) )     $idLevel[20]     = $_POST['idLevel_20'];
	if ( !empty($_POST['idLevel_21']) )     $idLevel[21]     = $_POST['idLevel_21'];
	if ( !empty($_POST['idLevel_22']) )     $idLevel[22]     = $_POST['idLevel_22'];
	if ( !empty($_POST['idLevel_23']) )     $idLevel[23]     = $_POST['idLevel_23'];
	if ( !empty($_POST['idLevel_24']) )     $idLevel[24]     = $_POST['idLevel_24'];
	if ( !empty($_POST['idLevel_25']) )     $idLevel[25]     = $_POST['idLevel_25'];

	
	
	
	
	

	
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
			case 'idLicitacion':        if(empty($idLicitacion)){         $error['idLicitacion']          = 'error/No ha seleccionado la licitacion';}break;
			case 'idSistema':           if(empty($idSistema)){            $error['idSistema']             = 'error/No ha seleccionado el sistema';}break;
			case 'Codigo':              if(empty($Codigo)){               $error['Codigo']                = 'error/No ha ingresado el codigo';}break;
			case 'Nombre':              if(empty($Nombre)){               $error['Nombre']                = 'error/No ha ingresado el nombre';}break;
			case 'FechaInicio':         if(empty($FechaInicio)){          $error['FechaInicio']           = 'error/No ha ingresado la Fecha de inicio';}break;
			case 'FechaTermino':        if(empty($FechaTermino)){         $error['FechaTermino']          = 'error/No ha ingresado la Fecha de termino';}break;
			case 'Presupuesto':         if(empty($Presupuesto)){          $error['Presupuesto']           = 'error/No ha ingresado el presupuesto';}break;
			case 'idEstado':            if(empty($idEstado)){             $error['idEstado']              = 'error/No ha seleccionado el estado';}break;
			case 'idBodegaProd':        if(empty($idBodegaProd)){         $error['idBodegaProd']          = 'error/No ha seleccionado la bodega de productos';}break;
			case 'idBodegaIns':         if(empty($idBodegaIns)){          $error['idBodegaIns']           = 'error/No ha seleccionado la bodega de insumos';}break;
			case 'idAprobado':          if(empty($idAprobado)){           $error['idAprobado']            = 'error/No ha seleccionado el estado de aprobacion';}break;
			case 'idCliente':           if(empty($idCliente)){            $error['idCliente']             = 'error/No ha seleccionado el cliente';}break;
			case 'idTipoLicitacion':    if(empty($idTipoLicitacion)){     $error['idTipoLicitacion']      = 'error/No ha seleccionado el tipo de contrato';}break;
			case 'ValorMensual':        if(empty($ValorMensual)){         $error['ValorMensual']          = 'error/No ha ingresado el valor mensual';}break;
			case 'idOpcionItem':        if(empty($idOpcionItem)){         $error['idOpcionItem']          = 'error/No ha seleccionado la opcion de mostrar itemizado';}break;
			
			case 'idUtilizable':        if(empty($idUtilizable)){         $error['idUtilizable']          = 'error/No ha seleccionado si es utilizable';}break;
			case 'idFrecuencia':        if(empty($idFrecuencia)){         $error['idFrecuencia']          = 'error/No ha seleccionado la unidad de medida';}break;
			case 'Cantidad':            if(empty($Cantidad)){             $error['Cantidad']              = 'error/No ha ingresado la cantidad';}break;
			case 'Valor':               if(empty($Valor)){                $error['Valor']                 = 'error/No ha ingresado el valor';}break;
			case 'ValorTotal':          if(empty($ValorTotal)){           $error['ValorTotal']            = 'error/No ha ingresado el valor total';}break;
			case 'TiempoProgramado':    if(empty($TiempoProgramado)){     $error['TiempoProgramado']      = 'error/No ha ingresado el tiempo programado';}break;
			case 'idTrabajo':           if(empty($idTrabajo)){            $error['idTrabajo']             = 'error/No ha seleccionado el tipo de trabajo';}break;
			case 'lvl':                 if(empty($lvl)){                  $error['lvl']                   = 'error/No ha ingresado el nivel';}break;
			
			case 'idLevel_1':           if(empty($idLevel[1])){           $error['idLevel_1']             = 'error/No ha ingresado el idLevel_1';}break;
			case 'idLevel_2':           if(empty($idLevel[2])){           $error['idLevel_2']             = 'error/No ha ingresado el idLevel_2';}break;
			case 'idLevel_3':           if(empty($idLevel[3])){           $error['idLevel_3']             = 'error/No ha ingresado el idLevel_3';}break;
			case 'idLevel_4':           if(empty($idLevel[4])){           $error['idLevel_4']             = 'error/No ha ingresado el idLevel_4';}break;
			case 'idLevel_5':           if(empty($idLevel[5])){           $error['idLevel_5']             = 'error/No ha ingresado el idLevel_5';}break;
			case 'idLevel_6':           if(empty($idLevel[6])){           $error['idLevel_6']             = 'error/No ha ingresado el idLevel_6';}break;
			case 'idLevel_7':           if(empty($idLevel[7])){           $error['idLevel_7']             = 'error/No ha ingresado el idLevel_7';}break;
			case 'idLevel_8':           if(empty($idLevel[8])){           $error['idLevel_8']             = 'error/No ha ingresado el idLevel_8';}break;
			case 'idLevel_9':           if(empty($idLevel[9])){           $error['idLevel_9']             = 'error/No ha ingresado el idLevel_9';}break;
			case 'idLevel_10':          if(empty($idLevel[10])){          $error['idLevel_10']            = 'error/No ha ingresado el idLevel_10';}break;
			case 'idLevel_11':          if(empty($idLevel[11])){          $error['idLevel_11']            = 'error/No ha ingresado el idLevel_11';}break;
			case 'idLevel_12':          if(empty($idLevel[12])){          $error['idLevel_12']            = 'error/No ha ingresado el idLevel_12';}break;
			case 'idLevel_13':          if(empty($idLevel[13])){          $error['idLevel_13']            = 'error/No ha ingresado el idLevel_13';}break;
			case 'idLevel_14':          if(empty($idLevel[14])){          $error['idLevel_14']            = 'error/No ha ingresado el idLevel_14';}break;
			case 'idLevel_15':          if(empty($idLevel[15])){          $error['idLevel_15']            = 'error/No ha ingresado el idLevel_15';}break;
			case 'idLevel_16':          if(empty($idLevel[16])){          $error['idLevel_16']            = 'error/No ha ingresado el idLevel_16';}break;
			case 'idLevel_17':          if(empty($idLevel[17])){          $error['idLevel_17']            = 'error/No ha ingresado el idLevel_17';}break;
			case 'idLevel_18':          if(empty($idLevel[18])){          $error['idLevel_18']            = 'error/No ha ingresado el idLevel_18';}break;
			case 'idLevel_19':          if(empty($idLevel[19])){          $error['idLevel_19']            = 'error/No ha ingresado el idLevel_19';}break;
			case 'idLevel_20':          if(empty($idLevel[20])){          $error['idLevel_20']            = 'error/No ha ingresado el idLevel_20';}break;
			case 'idLevel_21':          if(empty($idLevel[21])){          $error['idLevel_21']            = 'error/No ha ingresado el idLevel_21';}break;
			case 'idLevel_22':          if(empty($idLevel[22])){          $error['idLevel_22']            = 'error/No ha ingresado el idLevel_22';}break;
			case 'idLevel_23':          if(empty($idLevel[23])){          $error['idLevel_23']            = 'error/No ha ingresado el idLevel_23';}break;
			case 'idLevel_24':          if(empty($idLevel[24])){          $error['idLevel_24']            = 'error/No ha ingresado el idLevel_24';}break;
			case 'idLevel_25':          if(empty($idLevel[25])){          $error['idLevel_25']            = 'error/No ha ingresado el idLevel_25';}break;
	

		}
	}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'createBasicData':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Nombre', 'licitacion_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre de la licitacion ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                $a  = "'".$idSistema."'" ;         }else{$a  ="''";}
				if(isset($Codigo) && $Codigo != ''){                      $a .= ",'".$Codigo."'" ;           }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){                      $a .= ",'".$Nombre."'" ;           }else{$a .=",''";}
				if(isset($FechaInicio) && $FechaInicio != ''){            $a .= ",'".$FechaInicio."'" ;      }else{$a .=",''";}
				if(isset($FechaTermino) && $FechaTermino != ''){          $a .= ",'".$FechaTermino."'" ;     }else{$a .=",''";}
				if(isset($Presupuesto) && $Presupuesto != ''){            $a .= ",'".$Presupuesto."'" ;      }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){                  $a .= ",'".$idEstado."'" ;         }else{$a .=",''";}
				if(isset($idBodegaProd) && $idBodegaProd != ''){          $a .= ",'".$idBodegaProd."'" ;     }else{$a .=",''";}
				if(isset($idBodegaIns) && $idBodegaIns != ''){            $a .= ",'".$idBodegaIns."'" ;      }else{$a .=",''";}
				if(isset($idAprobado) && $idAprobado != ''){              $a .= ",'".$idAprobado."'" ;       }else{$a .=",''";}
				if(isset($idCliente) && $idCliente != ''){                $a .= ",'".$idCliente."'" ;        }else{$a .=",''";}
				if(isset($idTipoLicitacion) && $idTipoLicitacion != ''){  $a .= ",'".$idTipoLicitacion."'" ; }else{$a .=",''";}
				if(isset($ValorMensual) && $ValorMensual != ''){          $a .= ",'".$ValorMensual."'" ;     }else{$a .=",''";}
				if(isset($idOpcionItem) && $idOpcionItem != ''){          $a .= ",'".$idOpcionItem."'" ;     }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `licitacion_listado` (idSistema, Codigo, Nombre, FechaInicio, FechaTermino, Presupuesto,
				idEstado, idBodegaProd, idBodegaIns, idAprobado, idCliente, idTipoLicitacion, ValorMensual, idOpcionItem) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
					
					/*********************************************************************/
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					$a .= ",'".fecha_actual()."'";
					$a .= ",'1'";                                                    //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                               //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `licitacion_listado_historial` (idLicitacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
		case 'updateBasicData':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idLicitacion)){
				$ndata_1 = db_select_nrows ('Nombre', 'licitacion_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idLicitacion!='".$idLicitacion."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre de la licitacion ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*****************************************************/
				// Se traen todos los datos de la licitacion
				$query = "SELECT Codigo, Nombre, FechaInicio, FechaTermino, Presupuesto, idBodegaProd, idBodegaIns,
				idSistema, idAprobado, idCliente, idEstado, idTipoLicitacion, ValorMensual, idOpcionItem
				FROM `licitacion_listado`
				WHERE idLicitacion = ".$idLicitacion;
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
				$rowdata = mysqli_fetch_assoc ($resultado);
					
				/*****************************************************/
				// Se traen todos los datos de la licitacion
				$a = "idLicitacion='".$idLicitacion."'" ;
				if(isset($idSistema) && $idSistema != ''){                $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Codigo) && $Codigo != ''){                      $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($Nombre) && $Nombre != ''){                      $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($FechaInicio) && $FechaInicio != ''){            $a .= ",FechaInicio='".$FechaInicio."'" ;}
				if(isset($FechaTermino) && $FechaTermino != ''){          $a .= ",FechaTermino='".$FechaTermino."'" ;}
				if(isset($Presupuesto) && $Presupuesto != ''){            $a .= ",Presupuesto='".$Presupuesto."'" ;}
				if(isset($idEstado) && $idEstado != ''){                  $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idBodegaProd) && $idBodegaProd != ''){          $a .= ",idBodegaProd='".$idBodegaProd."'" ;}
				if(isset($idBodegaIns) && $idBodegaIns != ''){            $a .= ",idBodegaIns='".$idBodegaIns."'" ;}
				if(isset($idAprobado) && $idAprobado != ''){              $a .= ",idAprobado='".$idAprobado."'" ;}
				if(isset($idCliente) && $idCliente != ''){                $a .= ",idCliente='".$idCliente."'" ;}
				if(isset($idTipoLicitacion) && $idTipoLicitacion != ''){  $a .= ",idTipoLicitacion='".$idTipoLicitacion."'" ;}
				if(isset($ValorMensual) && $ValorMensual != ''){          $a .= ",ValorMensual='".$ValorMensual."'" ;}
				if(isset($idOpcionItem) && $idOpcionItem != ''){          $a .= ",idOpcionItem='".$idOpcionItem."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `licitacion_listado` SET ".$a." WHERE idLicitacion = '$idLicitacion'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					
					
					/*****************************************************/
					//se crean el mensaje
					$hist_Observacion = '<strong>Modificaciones:</strong><br/>';
					
					if(isset($idSistema) && $idSistema != $rowdata['idSistema']){                      $hist_Observacion .= '-Se cambia el sistema<br/>';}
					if(isset($Codigo) && $Codigo != $rowdata['Codigo']){                               $hist_Observacion .= '-Se cambia el Codigo, de <strong>'.$rowdata['Codigo'].'</strong> a <strong>'.$Codigo.'</strong><br/>';}
					if(isset($Nombre) && $Nombre != $rowdata['Nombre']){                               $hist_Observacion .= '-Se cambia el Nombre, de <strong>'.$rowdata['Nombre'].'</strong> a <strong>'.$Nombre.'</strong><br/>';}
					if(isset($FechaInicio) && $FechaInicio != $rowdata['FechaInicio']){                $hist_Observacion .= '-Se cambia la Fecha de Inicio, de <strong>'.fecha_estandar($rowdata['FechaInicio']).'</strong> a <strong>'.fecha_estandar($FechaInicio).'</strong><br/>';}
					if(isset($FechaTermino) && $FechaTermino != $rowdata['FechaTermino']){             $hist_Observacion .= '-Se cambia la Fecha de Termino, de <strong>'.fecha_estandar($rowdata['FechaTermino']).'</strong> a <strong>'.fecha_estandar($FechaTermino).'</strong><br/>';}
					if(isset($Presupuesto) && $Presupuesto != $rowdata['Presupuesto']){                $hist_Observacion .= '-Se cambia el Presupuesto, de <strong>'.valores($rowdata['Presupuesto'], 0).'</strong> a <strong>'.valores($Presupuesto, 0).'</strong><br/>';}
					if(isset($idEstado) && $idEstado != $rowdata['idEstado']){                         $hist_Observacion .= '-Se cambia el Estado<br/>';}
					if(isset($idBodegaProd) && $idBodegaProd != $rowdata['idBodegaProd']){             $hist_Observacion .= '-Se cambia la Bodega de Productos<br/>';}
					if(isset($idBodegaIns) && $idBodegaIns != $rowdata['idBodegaIns']){                $hist_Observacion .= '-Se cambia la Bodega de Insumos<br/>';}
					if(isset($idAprobado) && $idAprobado != $rowdata['idAprobado']){                   $hist_Observacion .= '-Se cambia el estado de aprobacion<br/>';}
					if(isset($idCliente) && $idCliente != $rowdata['idCliente']){                      $hist_Observacion .= '-Se cambia el cliente<br/>';}
					if(isset($idTipoLicitacion) && $idTipoLicitacion != $rowdata['idTipoLicitacion']){ $hist_Observacion .= '-Se cambia el Tipo de Contrato<br/>';}
					if(isset($ValorMensual) && $ValorMensual != $rowdata['ValorMensual']){             $hist_Observacion .= '-Se cambia el valor mensual del contrato<br/>';}
					if(isset($idOpcionItem) && $idOpcionItem != $rowdata['idOpcionItem']){             $hist_Observacion .= '-Se cambia la opcion de telemetria<br/>';}
					
				
					/*****************************************************/
					//se guarda el registro
					if(isset($hist_Observacion)&&$hist_Observacion!='<strong>Modificaciones:</strong><br/>'){
						//Se guarda en historial la accion
						$a  = "'".$idLicitacion."'";
						$a .= ",'".fecha_actual()."'";
						$a .= ",'2'";                                                    //Creacion Satisfactoria
						$a .= ",'".$hist_Observacion."'";                                //Observacion
						$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
						
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `licitacion_listado_historial` (idLicitacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
		case 'delBasicData':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//maximo de registros
			$nmax = 25;
			//se borra la licitacion
			$query  = "DELETE FROM `licitacion_listado` WHERE idLicitacion = {$_GET['del']}";
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
			
			
			//se borran los datos relacionados
			for ($i = 1; $i <= $nmax; $i++) {
				$query  = "DELETE FROM `licitacion_listado_level_".$i."` WHERE idLicitacion = {$_GET['del']}";
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
				
			//redirijo			
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;	
				
/*******************************************************************************************************************/		
		case 'insert_item':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico otros datos
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($lvl)&&isset($Nombre)&&isset($idLicitacion)&&isset($idSistema)&&isset($Codigo)){
				$ndata_1 = db_select_nrows ('Nombre', 'licitacion_listado_level_'.$lvl, '', "Nombre='".$Nombre."' AND idLicitacion='".$idLicitacion."' AND idSistema='".$idSistema."' AND Codigo='".$Codigo."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El dato ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el Nombre	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                $a = "'".$idSistema."'" ;           }else{$a ="''";}
				if(isset($idLicitacion) && $idLicitacion != ''){          $a .= ",'".$idLicitacion."'" ;      }else{$a .=",''";}
				if(isset($idUtilizable) && $idUtilizable != ''){          $a .= ",'".$idUtilizable."'" ;      }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){                      $a .= ",'".$Nombre."'" ;            }else{$a .=",''";}
				if(isset($Codigo) && $Codigo != ''){                      $a .= ",'".$Codigo."'" ;            }else{$a .=",''";}
				if(isset($idFrecuencia) && $idFrecuencia != ''){          $a .= ",'".$idFrecuencia."'" ;      }else{$a .=",''";}
				if(isset($Cantidad) && $Cantidad != ''){                  $a .= ",'".$Cantidad."'" ;          }else{$a .=",''";}
				if(isset($Valor) && $Valor != ''){                        $a .= ",'".$Valor."'" ;             }else{$a .=",''";}
				if(isset($ValorTotal) && $ValorTotal != ''){              $a .= ",'".$ValorTotal."'" ;        }else{$a .=",''";}
				if(isset($TiempoProgramado) && $TiempoProgramado != ''){  $a .= ",'".$TiempoProgramado."'" ;  }else{$a .=",''";}
				if(isset($idTrabajo) && $idTrabajo != ''){                $a .= ",'".$idTrabajo."'" ;         }else{$a .=",''";}
				
				$xbla = '';
				for ($i = 2; $i <= $lvl; $i++) {
					//Ubico correctamente el puntero
					$point = $i - 1;
					//Valor a insertar
					if(isset($idLevel[$point]) && $idLevel[$point] != ''){   $a .= ",'".$idLevel[$point]."'" ;   }else{$a .=",''";}
					//donde insertar
					$xbla .= ',idLevel_'.$point;
				}
			
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `licitacion_listado_level_".$lvl."` (idSistema,idLicitacion, idUtilizable,Nombre,Codigo,idFrecuencia,Cantidad,Valor,ValorTotal,
				TiempoProgramado, idTrabajo
				".$xbla." ) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					/*****************************************************/
					//se crean el mensaje
					$hist_Observacion = '<strong>Modificaciones:</strong><br/>';
					
					if(isset($Nombre) && $Nombre != ''){    $hist_Observacion .= '-Se crea el itemizado '.$Nombre.'<br/>';}
				
					/*****************************************************/
					//se guarda el registro
					if(isset($hist_Observacion)&&$hist_Observacion!='<strong>Modificaciones:</strong><br/>'){
						//Se guarda en historial la accion
						$a  = "'".$idLicitacion."'";
						$a .= ",'".fecha_actual()."'";
						$a .= ",'2'";                                                    //Creacion Satisfactoria
						$a .= ",'".$hist_Observacion."'";                                //Observacion
						$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
							
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `licitacion_listado_historial` (idLicitacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
		case 'update_item':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el Nombre	
			if ( empty($error) ) {
				/*****************************************************/
				// Se traen todos los datos de la licitacion
				$query = "SELECT idSistema, idLicitacion, idUtilizable, Nombre, Codigo, 
				idFrecuencia, Cantidad, Valor, ValorTotal, TiempoProgramado, idTrabajo
				FROM `licitacion_listado_level_".$lvl."`
				WHERE idLevel_".$lvl." = '".$idLevel[$lvl]."'";
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
				$rowdata = mysqli_fetch_assoc ($resultado);
					
				/*****************************************************/
				//Filtros
				$a = "idLevel_".$lvl."='".$idLevel[$lvl]."'" ;
				if(isset($idSistema) && $idSistema != ''){                 $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idLicitacion) && $idLicitacion != ''){           $a .= ",idLicitacion='".$idLicitacion."'" ;}
				if(isset($idUtilizable) && $idUtilizable != ''){           $a .= ",idUtilizable='".$idUtilizable."'" ;}
				if(isset($Nombre) && $Nombre != ''){                       $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Codigo) && $Codigo != ''){                       $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($idFrecuencia) && $idFrecuencia != ''){           $a .= ",idFrecuencia='".$idFrecuencia."'" ;}
				if(isset($Cantidad) && $Cantidad != ''){                   $a .= ",Cantidad='".$Cantidad."'" ;}
				if(isset($Valor) && $Valor != ''){                         $a .= ",Valor='".$Valor."'" ;}
				if(isset($ValorTotal) && $ValorTotal != ''){               $a .= ",ValorTotal='".$ValorTotal."'" ;}
				if(isset($TiempoProgramado) && $TiempoProgramado != ''){   $a .= ",TiempoProgramado='".$TiempoProgramado."'" ;}
				if(isset($idTrabajo) && $idTrabajo != ''){                 $a .= ",idTrabajo='".$idTrabajo."'" ;}
				
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `licitacion_listado_level_".$lvl."` SET ".$a." WHERE idLevel_".$lvl." = '".$idLevel[$lvl]."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
						
					/*****************************************************/
					//se crean el mensaje
					$hist_Observacion = '<strong>Modificaciones:</strong><br/>';
						
					if(isset($idSistema) && $idSistema != $rowdata['idSistema']){                       $hist_Observacion .= '-Se cambia el sistema del item '.$rowdata['Nombre'].'<br/>';}
					if(isset($idLicitacion) && $idLicitacion != $rowdata['idLicitacion']){              $hist_Observacion .= '-Se cambia la licitacion del item '.$rowdata['Nombre'].'<br/>';}
					if(isset($idUtilizable) && $idUtilizable != $rowdata['idUtilizable']){              $hist_Observacion .= '-Se cambia el estado de utilizacion del item '.$rowdata['Nombre'].'<br/>';}
					if(isset($Nombre) && $Nombre != $rowdata['Nombre']){                                $hist_Observacion .= '-Se cambia el nombre del item '.$rowdata['Nombre'].', de <strong>'.$rowdata['Nombre'].'</strong> a <strong>'.$Nombre.'</strong><br/>';}
					if(isset($Codigo) && $Codigo != $rowdata['Codigo']){                                $hist_Observacion .= '-Se cambia el codigo del item '.$rowdata['Nombre'].', de <strong>'.$rowdata['Codigo'].'</strong> a <strong>'.$Codigo.'</strong><br/>';}
					if(isset($idFrecuencia) && $idFrecuencia != $rowdata['idFrecuencia']){              $hist_Observacion .= '-Se cambia la fecuencia del item '.$rowdata['Nombre'].'<br/>';}
					if(isset($Cantidad) && $Cantidad != $rowdata['Cantidad']){                          $hist_Observacion .= '-Se cambia la cantidad del item '.$rowdata['Nombre'].', de <strong>'.cantidades($rowdata['Cantidad'], 0).'</strong> a <strong>'.cantidades($Cantidad, 0).'</strong><br/>';}
					if(isset($Valor) && $Valor != $rowdata['Valor']){                                   $hist_Observacion .= '-Se cambia el valor unitario del item '.$rowdata['Nombre'].', de <strong>'.valores($rowdata['Valor'], 0).'</strong> a <strong>'.valores($Valor, 0).'</strong><br/>';}
					if(isset($ValorTotal) && $ValorTotal != $rowdata['ValorTotal']){                    $hist_Observacion .= '-Se cambia el valor total del item '.$rowdata['Nombre'].', de <strong>'.valores($rowdata['ValorTotal'], 0).'</strong> a <strong>'.valores($ValorTotal, 0).'</strong><br/>';}
					if(isset($TiempoProgramado) && $TiempoProgramado != $rowdata['TiempoProgramado']){  $hist_Observacion .= '-Se cambia el tiempo programado del item '.$rowdata['Nombre'].', de <strong>'.$rowdata['TiempoProgramado'].'</strong> a <strong>'.$TiempoProgramado.'</strong><br/>';}
					if(isset($idTrabajo) && $idTrabajo != $rowdata['idTrabajo']){                       $hist_Observacion .= '-Se cambia el tipo de trabajo del item '.$rowdata['Nombre'].'<br/>';}
					
					/*****************************************************/
					//se guarda el registro
					if(isset($hist_Observacion)&&$hist_Observacion!='<strong>Modificaciones:</strong><br/>'){
						//Se guarda en historial la accion
						$a  = "'".$idLicitacion."'";
						$a .= ",'".fecha_actual()."'";
						$a .= ",'2'";                                                    //Creacion Satisfactoria
						$a .= ",'".$hist_Observacion."'";                                //Observacion
						$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
							
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `licitacion_listado_historial` (idLicitacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
		case 'del_item':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los datos
			for ($i = $_GET['lvl']; $i <= $_GET['nmax']; $i++) {
				
				/*****************************************************/
				// Se traen todos los datos de la licitacion
				$query = "SELECT Nombre
				FROM `licitacion_listado_level_".$i."`
				WHERE idLevel_".$_GET['lvl']." = {$_GET['del_idLevel']}";
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
				$rowdata = mysqli_fetch_assoc ($resultado);
				
				/*****************************************************/
				// Se traen todos los datos de la licitacion
				$query  = "DELETE FROM `licitacion_listado_level_".$i."` WHERE idLevel_".$_GET['lvl']." = {$_GET['del_idLevel']}";
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
					
				/*****************************************************/
				//se crean el mensaje
				$hist_Observacion = '<strong>Modificaciones:</strong><br/>';
				$hist_Observacion .= '-Se elimina el item '.$rowdata['Nombre'].'<br/>';
					
				/*****************************************************/
				//se guarda el registro
				if(isset($hist_Observacion)&&$hist_Observacion!='<strong>Modificaciones:</strong><br/>'){
					//Se guarda en historial la accion
					$a  = "'".$idLicitacion."'";
					$a .= ",'".fecha_actual()."'";
					$a .= ",'3'";                                                    //Creacion Satisfactoria
					$a .= ",'".$hist_Observacion."'";                                //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
							
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `licitacion_listado_historial` (idLicitacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				
			//redirijo			
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
/*******************************************************************************************************************/
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idLicitacion  = $_GET['id'];
			$estado        = $_GET['estado'];
			
			/*****************************************************/
			// Se traen todos los datos de la licitacion
			$query = "SELECT idEstado
			FROM `licitacion_listado`
			WHERE idLicitacion = ".$idLicitacion;
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
			$rowdata = mysqli_fetch_assoc ($resultado);
				
			/*****************************************************/
			// Se traen todos los datos de la licitacion
			$query  = "UPDATE licitacion_listado SET idEstado = '$estado'	
			WHERE idLicitacion    = '$idLicitacion'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
					
				/*****************************************************/
				//se crean el mensaje
				$hist_Observacion = '<strong>Modificaciones:</strong><br/>';
					
				if(isset($estado) && $estado != $rowdata['idEstado']){   $hist_Observacion .= '-Se cambia el Estado<br/>';}
				
				/*****************************************************/
				//se guarda el registro
				if(isset($hist_Observacion)&&$hist_Observacion!='<strong>Modificaciones:</strong><br/>'){
					//Se guarda en historial la accion
					$a  = "'".$idLicitacion."'";
					$a .= ",'".fecha_actual()."'";
					$a .= ",'2'";                                                    //Creacion Satisfactoria
					$a .= ",'".$hist_Observacion."'";                                //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
						
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `licitacion_listado_historial` (idLicitacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
		case 'createBasicDataContrato':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Nombre', 'licitacion_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre de la licitacion ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){         $a = "'".$idSistema."'" ;       }else{$a ="''";}
				if(isset($Codigo) && $Codigo != ''){               $a .= ",'".$Codigo."'" ;        }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){               $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
				if(isset($FechaInicio) && $FechaInicio != ''){     $a .= ",'".$FechaInicio."'" ;   }else{$a .=",''";}
				if(isset($FechaTermino) && $FechaTermino != ''){   $a .= ",'".$FechaTermino."'" ;  }else{$a .=",''";}
				if(isset($Presupuesto) && $Presupuesto != ''){     $a .= ",'".$Presupuesto."'" ;   }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){           $a .= ",'".$idEstado."'" ;      }else{$a .=",''";}
				if(isset($idBodegaProd) && $idBodegaProd != ''){   $a .= ",'".$idBodegaProd."'" ;  }else{$a .=",''";}
				if(isset($idBodegaIns) && $idBodegaIns != ''){     $a .= ",'".$idBodegaIns."'" ;   }else{$a .=",''";}
				if(isset($idAprobado) && $idAprobado != ''){       $a .= ",'".$idAprobado."'" ;    }else{$a .=",''";}
				if(isset($idCliente) && $idCliente != ''){         $a .= ",'".$idCliente."'" ;     }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `licitacion_listado` (idSistema, Codigo, Nombre, FechaInicio, FechaTermino, Presupuesto,
				idEstado, idBodegaProd, idBodegaIns, idAprobado, idCliente) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
						
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
		case 'estadoContrato':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idLicitacion  = $_GET['status'];
			$estado        = $_GET['estado'];
			$query  = "UPDATE licitacion_listado SET idEstado = '$estado'	
			WHERE idLicitacion    = '$idLicitacion'";
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
	}
?>
