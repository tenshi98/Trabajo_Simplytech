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
	if ( !empty($_POST['idTablaImpuesto']) )  $idTablaImpuesto   = $_POST['idTablaImpuesto'];
	if ( !empty($_POST['Tramo']) )            $Tramo             = $_POST['Tramo'];
	if ( isset($_POST['UTM_Desde']) )         $UTM_Desde         = $_POST['UTM_Desde'];
	if ( isset($_POST['UTM_Hasta']) )         $UTM_Hasta         = $_POST['UTM_Hasta'];
	if ( isset($_POST['Tasa']) )              $Tasa              = $_POST['Tasa'];
	if ( isset($_POST['Rebaja']) )            $Rebaja            = $_POST['Rebaja'];
	
	
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
			case 'idTablaImpuesto':  if(empty($idTablaImpuesto)){   $error['idTablaImpuesto']  = 'error/No ha ingresado el id';}break;
			case 'Tramo':            if(empty($Tramo)){             $error['Tramo']            = 'error/No ha ingresado el nombre del Tramo';}break;
			case 'UTM_Desde':        if(empty($UTM_Desde)){         $error['UTM_Desde']        = 'error/No ha ingresado la cantidad desde';}break;
			case 'UTM_Hasta':        if(empty($UTM_Hasta)){         $error['UTM_Hasta']        = 'error/No ha ingresado la cantidad hasta';}break;
			case 'Tasa':             if(empty($Tasa)){              $error['Tasa']             = 'error/No ha ingresado la tasa';}break;
			case 'Rebaja':           if(empty($Rebaja)){            $error['Rebaja']           = 'error/No ha ingresado la rebaja';}break;
			
		}
	}
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Tramo)&&isset($idTablaImpuesto)){
				$ndata_1 = db_select_nrows ('Tramo', 'sistema_rrhh_tabla_iusc', '', "Tramo='".$Tramo."' AND idTablaImpuesto!='".$idTablaImpuesto."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idTablaImpuesto='".$idTablaImpuesto."'" ;
				if(isset($Tramo) && $Tramo != ''){          $a .= ",Tramo='".$Tramo."'" ;}
				if(isset($UTM_Desde) && $UTM_Desde != ''){  $a .= ",UTM_Desde='".$UTM_Desde."'" ;}
				if(isset($UTM_Hasta) && $UTM_Hasta != ''){  $a .= ",UTM_Hasta='".$UTM_Hasta."'" ;}
				if(isset($Tasa) && $Tasa != ''){            $a .= ",Tasa='".$Tasa."'" ;}
				if(isset($Rebaja) && $Rebaja != ''){        $a .= ",Rebaja='".$Rebaja."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `sistema_rrhh_tabla_iusc` SET ".$a." WHERE idTablaImpuesto = '$idTablaImpuesto'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'?edited=true' );
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
	}
?>
