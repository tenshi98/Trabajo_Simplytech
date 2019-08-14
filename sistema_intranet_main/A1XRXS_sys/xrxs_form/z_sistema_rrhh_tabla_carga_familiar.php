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
	if ( !empty($_POST['idTablaCarga']) )  $idTablaCarga   = $_POST['idTablaCarga'];
	if ( !empty($_POST['Tramo']) )         $Tramo          = $_POST['Tramo'];
	if ( isset($_POST['Valor_Desde']) )    $Valor_Desde    = $_POST['Valor_Desde'];
	if ( isset($_POST['Valor_Hasta']) )    $Valor_Hasta    = $_POST['Valor_Hasta'];
	if ( isset($_POST['Valor_Pago']) )     $Valor_Pago     = $_POST['Valor_Pago'];
	
	
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
			case 'idTablaCarga':  if(empty($idTablaCarga)){   $error['idTablaCarga']  = 'error/No ha ingresado el id';}break;
			case 'Tramo':         if(empty($Tramo)){          $error['Tramo']         = 'error/No ha ingresado el nombre del Tramo';}break;
			case 'Valor_Desde':   if(empty($Valor_Desde)){    $error['Valor_Desde']   = 'error/No ha ingresado el valor desde';}break;
			case 'Valor_Hasta':   if(empty($Valor_Hasta)){    $error['Valor_Hasta']   = 'error/No ha ingresado el valor hasta';}break;
			case 'Valor_Pago':    if(empty($Valor_Pago)){     $error['Valor_Pago']    = 'error/No ha ingresado el valor a pagar';}break;
			
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
			if(isset($Tramo)&&isset($idTablaCarga)){
				$ndata_1 = db_select_nrows ('Tramo', 'sistema_rrhh_tabla_carga_familiar', '', "Tramo='".$Tramo."' AND idTablaCarga!='".$idTablaCarga."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idTablaCarga='".$idTablaCarga."'" ;
				if(isset($Tramo) && $Tramo != ''){              $a .= ",Tramo='".$Tramo."'" ;}
				if(isset($Valor_Desde) && $Valor_Desde != ''){  $a .= ",Valor_Desde='".$Valor_Desde."'" ;}
				if(isset($Valor_Hasta) && $Valor_Hasta != ''){  $a .= ",Valor_Hasta='".$Valor_Hasta."'" ;}
				if(isset($Valor_Pago) && $Valor_Pago != ''){    $a .= ",Valor_Pago='".$Valor_Pago."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `sistema_rrhh_tabla_carga_familiar` SET ".$a." WHERE idTablaCarga = '$idTablaCarga'";
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
